<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	
    function __construct() {
        parent::__construct();
		$this->load->model('User_model');
	}
	
	public function logout(){
		$this->User_model->logout();
		 redirect('main/index');
	}
	public function index()
	{
				if($this->User_model->isLogged()) redirect('back/dashboard');
		        $data['loginController'] = base_url() . "main/login";
                $this->load->template('login/index' ,$data, FALSE);
	
	}
      public function login(){
                $username_password = array(
                        'username' => $this->input->post('username'),
                        'password' => $this->input->post('password'),
                );
                if($this->User_model->logIn($username_password)){
                       redirect('dashboard');
                } else {
                        $array['alert'] = array(
                                'type' => 'danger',
                                'content' => '<p>You enter a valid user/pass...</p>'
                        );
                        $this->session->set_flashdata($array);
                        redirect('main/index');

                }
        }
	
}