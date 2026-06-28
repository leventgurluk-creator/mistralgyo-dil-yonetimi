<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * (c) 2013 - Arce Yazılım
 * Gökhan Kaya
 */

class Icerik_model extends CI_Model {
    private $sinirsizMenu;

	function __construct(){
		parent::__construct();
	}

	function sinirsizMenu($tablo, $ust_id = 0, $level = 0, $dil = 'tr') {
	    $this->db->select('*');
	    $this->db->where('dil', $dil);
	    $this->db->where('ust_id', $ust_id);
	    $this->db->order_by('sira', 'asc');

	    $data = $this->db->get($tablo);

	    if($data->num_rows()>0){
	        $this->sinirsizMenu .= '<ol class="dd-list">';
	        foreach($data->result() as $value){
	            $this->sinirsizMenu .= '<li class="dd-item '.($value->durum == 'pasif' ? 'dd-item-disabled' : '').'" data-id="'.$value->id.'">';
                $this->sinirsizMenu .= '<div class="dd-handle">'.$value->baslik.'</div>';
                $this->sinirsizMenu($tablo, $value->id, $level+1, $dil);
	            $this->sinirsizMenu .= '</li>';
	        }
	        $this->sinirsizMenu .= '</ol>';
	    }

	    return $this->sinirsizMenu;
	}

	// Belirtilen tablodan kayıtları getirir
	function kayitGetir($tablo, $kolon_gizli = "", $key = "", $value = "", $data = array()) {
		$this->db->select('*');

		if (isset($data['arama'])) $this->db->like($data['arama']['kolon'], $data['arama']['kelime']);
		if ($key != "" && $value != "") $this->db->where($key, $value);

		if (!in_array($tablo, array('urun_ilgililer', 'urun_kategoriler', 'urun_sektorler'))) {
            $this->db->where('dil', $this->session->userdata('_yonetici_dil'));
		}

		if (isset($data['limit'])) {
			$offset = (isset($data['offset'])) ? $data['offset'] : 0;
			$this->db->limit($data['limit'], $offset);
		}

		if($kolon_gizli != "") $this->db->order_by($kolon_gizli, "desc");

		return $this->db->get($tablo);
	}

	// Belirtilen tablodan ilişkili kayıtları getirir (recursive)
	var $sinirsizArray = array();

	function kayitGetirSinirsiz($tablo, $kolon1, $kolon2, $kolon3, $altId=0, $level=0){

		$this->db->select("*");
		$this->db->where($kolon1, $altId);
		$this->db->where('dil', $this->session->userdata('_yonetici_dil'));

		$data = $this->db->get($tablo);

		if($data->num_rows()>0){
			foreach($data->result() as $key => $value){
				$value->level=$level;

				array_push($this->sinirsizArray, $value);
				$this->kayitGetirSinirsiz($tablo, $kolon1, $kolon2, $kolon3, $value->$kolon2, $level+1);
			}

		}

		return $this->sinirsizArray;
	}

	// Belirtilen tabloya kayıt ekler
	function kayitEkle($table_name, $data = array()) {
		$val = false;

		// Dil otomatik olarak session'dan alınır (eğer data'da yoksa)
		if (!isset($data['dil'])) {
			$data['dil'] = $this->session->userdata('_yonetici_dil') ?: 'tr';
		}

		if ($this->db->insert($table_name, $data)) {
			$val = true;
		}

		return $val;
	}

	// Belirtilen tabloda güncelleme yapar
	function kayitDuzenle($table_name, $key, $value, $data = array()) {
		$val = false;

		$this->db->where($key, $value);

		if ($this->db->update($table_name, $data)) {
			$val = true;
		}

		return $val;
	}

	// Belirtilen tablodan kayıt siler (ajax kullanır)
	function kayitSil($tablo_adi, $key, $value) {

		// Dosya yüklenen kolonlar tespit edilir
		$this->db->select('column_name, column_comment');
		$this->db->where('table_name', $tablo_adi);
		$this->db->where('table_schema', 'database()', false);
		$columns = $this->db->get('information_schema.columns');

		// Kokon isimleri geçici diziye aktarılır
		$tmp_file_columns = array();
		foreach ($columns->result() as $k => $v) {
			// Kolon açıklaması varsa dosya yüklenmiş demektir.
			if ($v->column_comment != ""){
				$tmp_file_columns[] = $v->column_name;
			}
		}

		// İlgili kayıt getiriliyor
		if (count($tmp_file_columns) > 0) {

			$this->db->select('*');
			$this->db->where($key, $value);
			$record = $this->db->get($tablo_adi);

			if ($record->num_rows() > 0) {
				$record = $record->row();
			}

			// Tablo kaydı silineceği için, kayıt silinmeden içeriğinde ki dosya isimlerini tmp diziye taşı.
			$tmp_delete_file = array();
			foreach($tmp_file_columns as $k => $v) {
				$tmp_delete_file[] = $record->$v;
			}
		}

		// Db'den silme işlemi
		$val = false;
		$this->db->where($key, $value);

		if ($this->db->delete($tablo_adi)){

			// Silinecek dosya varsa sil
			if (isset($tmp_delete_file) && count($tmp_delete_file) > 0) {
				foreach ($tmp_delete_file as $v) {
					//Silme işlemi fiziki olarak burada yapılıyor.
					@unlink('static/uploads/'. $v);
				}
			}

			$val = true;
		}

		return $val;
	}

}