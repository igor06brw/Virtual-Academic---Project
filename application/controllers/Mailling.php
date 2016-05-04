<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailling extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function autocomplete($query){
        $this->load->model('User_model');
        $return = array();
        $this->db->select('CONCAT(firstname,\' \', lastname) as name,user_id', FALSE);
        $this->db->from('users');
        $this->db->where('user_group_id','2');
        $this->db->where("CONCAT(firstname, ' ', lastname) LIKE '%".$query."%'", NULL, FALSE);
        $query = $this->db->get()->result();
        if(!empty($query)){
            foreach($query as $value) {
                $object = array(
                    'img' => 'http://dydaktykafizyki.us.edu.pl/pracownicy/prac_pol_pliki/image030.jpg',
                    'value' => $value->name,
                    'label' => $value->name,
                    'user_id' => $value->user_id
                );
                array_push($return, $object);
            }
        }

        echo json_encode($return);
        exit();
    }

    public function sendMail(){
        $id_msg = $this->input->post('tmp_catalog');
        $description = $this->input->post('description');
        $subject = $this->input->post('subject');
        $user_id = $this->input->post('user_id');
    }
    public function uploadFile(){
        $files = null;
        $upload_dir = FCPATH . '/assets/uploads/' . $this->input->post('tmp_catalog') . '/';

        $name = (isset($_FILES['files'])) ? $_FILES['files']['name'] : false;
        $type = (isset($_FILES['files'])) ? $_FILES['files']['type'] : false;
        $tmp_path = (isset($_FILES['files'])) ? $_FILES['files']['tmp_name'] : false;
        $size =(isset($_FILES['files'])) ? $_FILES['files']['size'] : false;


        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if(is_uploaded_file($tmp_path)) {

            move_uploaded_file($tmp_path, $upload_dir . $name);
            $info = new StdClass;
            $info->name = $name;
            $info->size = $size;
            $info->type = $type;
            $info->error = null;
            $files[] = $info;

        } else {
            $info = new StdClass;
            $info->error = 'error';
            $info->name = $name;
            $files[] = $info;
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode(array("files" => $files)));
    }

}