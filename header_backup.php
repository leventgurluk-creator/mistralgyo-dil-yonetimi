<!DOCTYPE html>
<!--[if IE 8]> <html lang="tr" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="tr" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="tr">
<!--<![endif]-->
<head>
    <base href="<?=base_url()?>" />
    <meta charset="utf-8"/>
    <title>Arce Yazılım | Yönetim Paneli</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <script src="<?=base_url('assets/yonetim/pace/pace.min.js')?>" type="text/javascript"></script>
    <link rel="shortcut icon" href="<?=base_url('favicon.ico')?>" type="image/x-icon"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
    <link href="<?=base_url('assets/yonetim/pace/pace-theme-flash.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url('assets/yonetim/font-awesome/font-awesome.min.css')?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('assets/yonetim/simple-line-icons/simple-line-icons.min.css')?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('assets/yonetim/bootstrap/bootstrap.min.css')?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('assets/yonetim/uniform/uniform.default.min.css')?>" rel="stylesheet" type="text/css">   
    <link href="<?=base_url('assets/yonetim/bootstrap-switch/bootstrap-switch.min.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url('assets/yonetim/bootstrap-datepicker/datepicker3.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url('assets/yonetim/bootstrap-timepicker/bootstrap-timepicker.min.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url('assets/yonetim/bootstrap-datetimepicker/datetimepicker.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('assets/yonetim/dropzone/dropzone.css')?>" rel="stylesheet"/>
    <link href="<?=base_url('assets/yonetim/jcrop/jquery.Jcrop.min.css')?>" rel="stylesheet"/>
    <link href="<?=base_url('assets/yonetim/bootstrap-toastr/toastr.min.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url('assets/yonetim/css/components.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url('assets/yonetim/css/plugins.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url('assets/yonetim/css/pagination.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url('assets/yonetim/css/layout.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url('assets/yonetim/css/default.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url('assets/yonetim/css/custom.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url('assets/yonetim/bootstrap-select2/select2.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url('assets/yonetim/bootstrap-toggle/bootstrap-toggle.min.css')?>" rel="stylesheet" type="text/css"/>
    <link href="<?=base_url('assets/yonetim/jquery-nestable/jquery.nestable.css')?>" rel="stylesheet" type="text/css"/>
</head>
<body class="page-header-fixed page-container-bg-solid page-sidebar-closed-hide-logo page-header-fixed-mobile">
    <div class="page-header navbar navbar-fixed-top">
    	<div class="page-header-inner">
    		<div class="page-logo">
    			<a href="<?=site_url("yonetim/anasayfa")?>">
    				<img src="<?=base_url('assets/yonetim/img/logo.png')?>" alt="logo" class="logo-default"/>
    			</a>
    			<div class="menu-toggler sidebar-toggler">
    			</div>
    		</div>
    		
    		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
    		</a>
    		
    		<div class="page-top">
    			<div class="top-menu">
    				<ul class="nav navbar-nav pull-right">
    					<li class="dropdown dropdown-user">
    						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
    						<img alt="" class="img-circle hide1" src="assets/yonetim/img/avatar.png"/>
    						<span class="username username-hide-on-mobile">
    						<?php 
    						$yonetici = $this->session->userdata("_yonetici");
    						echo $yonetici["kullanici"];
    						?> 
    						</span>
    						<i class="fa fa-angle-down"></i>
    						</a>
    						<ul class="dropdown-menu">
    							<li>
    								<a href="<?=site_url("yonetim/yonetici")?>">
    								<i class="fa fa-users"></i> Yönetici Listesi</a>
    							</li>
    							<li>
    								<a href="<?=site_url("yonetim/sifre_degistir")?>">
    								<i class="fa fa-key"></i> Şifre Değiştir</a>
    							</li>
    							<li>
    								<a href="<?=site_url("yonetim/cache_temizle")?>">
    								<i class="fa fa-history"></i> Cache Temizle</a>
    							</li>
    							<li>
    								<a href="<?=site_url("yonetim/cikis")?>">
    								<i class="fa fa-lock"></i> Çıkış Yap</a>
    							</li>
    						</ul>
    					</li>
    				</ul>
    			</div>
    			
    		</div>
    		
    	</div>
    	
    </div>
    
    <div class="clearfix">
    </div>
    
    <div class="page-container">
    
    	<div class="page-sidebar-wrapper">
    	
    		<div class="page-sidebar navbar-collapse collapse">
    		
    			<ul class="page-sidebar-menu <?php /*?>page-sidebar-menu-hover-submenu<?php */?>" data-auto-scroll="true" data-slide-speed="200">
    				<li class="start <?=$this->uri->segment(2)==""||$this->uri->segment(2)=="anasayfa"?'active':''?>">
    					<a href="<?=site_url("yonetim/anasayfa")?>">
    					<i class="fa fa-home"></i> 
    					<span class="title">Anasayfa</span>
    					</a>
    				</li>
    				
    				<?php if(in_array($this->session->userdata['_yonetici']['kullanici'], $this->config->item('olustur'))):?>
    				<li <?=$this->uri->segment(2)=="olustur"?'class="active open"':''?>>
    					<a href="javascript:;">
    					<i class="fa fa-rocket"></i> 
    					<span class="title">Oluştur</span>
    					<span class="selected"></span>
    					<span class="arrow open"></span>
    					</a>
    					<ul class="sub-menu">
    						<li <?=$this->uri->segment(2)=="olustur"&&$this->uri->segment(3)==""?'class="active"':''?>>
    							<a href="<?=site_url('yonetim/olustur')?>">
    							<i class="fa fa-pencil"></i> 
    							Başla</a>
    						</li>
    						<li <?=$this->uri->segment(2)=="olustur"&&$this->uri->segment(3)=="dokumantasyon"?'class="active"':''?>>
    							<a href="<?=site_url('yonetim/olustur/dokumantasyon')?>">
    							<i class="fa fa-question"></i> 
    							Dökümantasyon</a>
    						</li>
    					</ul>
    				</li>
    				<?php endif; ?>
    				<li <?=$this->uri->segment(2)=="yonetici"||$this->uri->segment(2)=="sifre_degistir"||$this->uri->segment(2)=="cache_temizle"?'class="active open"':''?>>
    					<a href="javascript:;">
    					<i class="fa fa-user"></i> 
    					<span class="title">Yönetici</span> 
    					<span class="selected"></span>
    					<span class="arrow open"></span>
    					</a>
    					<ul class="sub-menu">
    						<li <?=$this->uri->segment(2)=="yonetici"?'class="active"':''?>>
    							<a href="<?=site_url('yonetim/yonetici')?>">
    							<i class="fa fa-users"></i> 
    							Yönetici Listesi</a>
    						</li>
    						<li <?=$this->uri->segment(2)=="sifre_degistir"?'class="active"':''?>>
    							<a href="<?=site_url('yonetim/sifre_degistir')?>">
    							<i class="fa fa-key"></i> 
    							Şifre Değiştir</a>
    						</li>
    						<li <?=$this->uri->segment(2)=="cache_temizle"?'class="active"':''?>>
    							<a href="<?=site_url('yonetim/cache_temizle')?>">
    							<i class="fa fa-history"></i> 
    							Cache Temizle</a>
    						</li>
    						<li>
    							<a href="<?=site_url('yonetim/cikis')?>">
    							<i class="fa fa-lock"></i> 
    							Çıkış Yap</a>
    						</li>
    					</ul>
    				</li>
    				
    				<?php if ($_olustur_menu != false): ?>
    					<?php foreach ($_olustur_menu as $key => $value):?>
    					<li <?=$this->uri->segment(2)=="icerik"&&$this->uri->segment(4)==$value['id']?'class="active open"':''?>>
    						<a href="javascript:;">
    						<i class="<?=$value['icon']?>"></i> 
    						<span class="title"><?=$value['baslik']?></span>
    						<span class="selected"></span>
    						<span class="arrow open"></span>
    						</a>
    						<?php if ($value['alt_menu']):?>
    						<ul class="sub-menu">
    							<?php foreach ($value['alt_menu'] as $key2 => $value2):?>
    							<li <?=$this->uri->segment(2)=="icerik"&&$this->uri->segment(5)==$value2['id']?'class="active"':''?>>
    								<a href="<?=site_url('yonetim/icerik/index/'.$value['id'].'/'.$value2['id'])?>">
    								<i class="<?=$value2['icon']?>"></i>
    								<?=$value2['baslik']?></a>
    							</li>
    							<?php endforeach;?>
    						</ul>
    						<?php endif;?>
    					</li>
    					<?php endforeach; ?>
    				<?php endif; ?>
    				
    				
    			</ul>
    			
    		</div>
    	</div>
    	
    	<div class="page-content-wrapper">
    		<div class="page-content">
    			
<div class="text-right">
     				İçerik Dili: 
     				
     				<select id="icerikDilDegis" onChange="dilDegistir(this.value)">
						<?php foreach ($this->config->item('diller') as $dil): ?>
							<option value="<?=$dil?>" <?=$dil == $this->session->userdata('_yonetici_dil') ? 'selected="selected"' : ''?>><?=dilOkunus($dil)?></option>
						<?php endforeach; ?>
					</select>
     			</div>
     			
     			<script type="text/javascript">
     			function dilDegistir(dil) {
     			    $.ajax({
     			        url: '<?=site_url("yonetim/ajax/dil_degistir")?>',
     			        type: 'POST',
     			        data: {
     			            dil: dil,
     			            '<?=$this->security->get_csrf_token_name()?>': '<?=$this->security->get_csrf_hash()?>'
     			        },
     			        dataType: 'json',
     			        success: function(response) {
     			            if (response.status == 'ok') {
     			                location.reload();
     			            }
     			        }
     			    });
     			}
     			</script>
			