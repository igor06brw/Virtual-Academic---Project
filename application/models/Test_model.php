<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database('default');
    }

    public function pobierzDane(){
       return $this->db->get('test')->result();
        // $this->db->get_where('test', array("id" => 1))->result();
    }
}