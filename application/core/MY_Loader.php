<?php
class MY_Loader extends CI_Loader { 

	private function load_info($addData = null){
		$CI =& get_instance();
		$CI->load->model('Menu_model');
		if(!isset($addData['css']) && empty($addData['css'])) { $prepack['css'] = array(); } else { $prepack['css'] = $addData['css'];}
		if(!isset($addData['js']) && empty($addData['js'])) { $prepack['js'] = array(); } else { $prepack['js'] = $addData['js']; }
		if(isset($addData['packages']) && !empty($addData['packages'])){
			foreach($addData['packages'] as $pack){
				if(!empty($pack['css'])) {
					foreach($pack['css'] as $css){
						array_push($prepack['css'], $css);
					}
				}
				if(!empty($pack['js'])) {
					foreach($pack['js'] as $js){
						array_push($prepack['js'], $js);
					}	
				}
			}
		}
		$data['css'] = $prepack['css'];
		$data['js'] = $prepack['js'];
		$data['homeAdmin'] = base_url() . "back/";
		$data['breadcrumbs'] = (isset($addData['currentController']) && isset($addData['pageTitle'])) ? $CI->Menu_model->getBreadcrumbs($addData['currentController'], $addData['pageTitle'],$data['homeAdmin']) : false;
		$data['title'] = isset($addData['pageTitle']) ? 'Wirtualny Dziekanat '. ' > ' . $addData['pageTitle'] : 'Wirtualny Dziekanat';
		$data['alert'] = $CI->session->userdata('alert');
		$data['user'] = $CI->session->userdata('user');
		$data['menu'] = (isset($addData['currentController'])) ? $CI->Menu_model->getMenu($data['user'],$addData['currentController']) : false;
		$data['logoutURL'] = base_url() . 'main/logout';
		return $data;
	}
	
	public function template($template_name, $vars = array(), $header_footer = true,$where = '',$template = 'metronic'){
	   	$CI =& get_instance();



		$template = $where . '/' . $template; 
		$vars = array_merge($vars, $this->load_info($vars));
		if($header_footer) $this->view($template . '/common/header',$vars);
        $this->view($template . '/' . $template_name, $vars);
        if($header_footer) $this->view($template . '/common/footer',$vars);
		
	}
}