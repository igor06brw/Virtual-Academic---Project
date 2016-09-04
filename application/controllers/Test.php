<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    function __construct() {
        parent::__construct();
        //

    }

    public function logout(){

    }
    public function index()
    {
        $this->load->model('Test_model');

        $data['currentController'] = 'test';
        $data['pageTitle'] = 'Plan zajęć';
        $data['smallTitle'] = '';

        $array = array(
            '1','2','3'
        );
        $data['testowa_zmienna'] = $array;
        $data['tabela'] = $this->Test_model->pobierzDane();



        $data['js'] = array(
            assets_url() . "template/js/testController.js"
        );



        $this->load->template('test/testowy' , $data);
    }

    public function json(){
        $this->load->model('Test_model');
        $dane = $this->Test_model->pobierzDane();
        echo json_encode($dane);
    }
}