<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subjects extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function getSubjects(){
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
        $back = $this->data_source->read('nf_subjects', array('name'));
        if(!empty($back['data'])){
            foreach($back['data'] as $emp){
                $object = array(
                    'subject_name' => $emp['name']
                );
                array_push($data, $object);
            }
        }

        echo json_encode($data);
        exit();
    }

    public function getTypes(){
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
        $back = $this->data_source->read('nf_activities_types', array('type'));
        if(!empty($back['data'])){
            foreach($back['data'] as $emp){
                $object = array(
                    'subject_type_label' => $emp['type']
                );
                array_push($data, $object);
            }
        }

        echo json_encode($data);
        exit();
    }
}