<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
			$this->load->model('User_model');
			if(!$this->User_model->isLogged()) redirect('main');
        }


        public function index(){
                $data['currentController'] = 'dashboard';
                $data['pageTitle'] = 'Dashboard';
                $data['smallTitle'] = '';
                $data['packages'] = $this->plugins->get(array('Pulsate','FormStuff','dhtmlXPro','Typehead'));
                $this->load->template('dashboard/index' ,$data);
        }


}
