<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function getTeachers(){
        $this->load->database();

        $params = array(
            'database' => $this->db->database,
            'username' => $this->db->username,
            'password' => $this->db->password,
            'host' => $this->db->hostname
        );
        $this->load->library('KendoWrapper/DataSourceResult', $params, 'data_source');

        $request = json_decode(file_get_contents('php://input'));
        header('Content-Type: application/json');
        $data = array();
        $back = $this->User_model->getTeachers();
        if(!empty($back)){
            foreach($back as $emp){
                $object = array(
                    'teacher_label' => $emp->firstname .' ' . $emp->lastname
                );
                array_push($data, $object);
            }
        }


        echo json_encode($data);
        exit();
    }

}