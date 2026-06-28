<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $yonetici = $this->session->userdata('_yonetici');
        if (empty($yonetici['kullanici'])) {
            echo json_encode(['status' => 'error', 'message' => 'Login required']);
            exit;
        }
    }

    // Admin panel dil degistirme
    public function dil_degistir() {
        $dil = $this->input->post('dil');
        
        if (in_array($dil, ['tr', 'en'])) {
            $this->session->set_userdata('_yonetici_dil', $dil);
            echo json_encode(['status' => 'ok', 'dil' => $dil]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid language']);
        }
    }

}