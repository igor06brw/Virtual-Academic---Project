<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
				$this->load->database('default');
        }
        public function logout(){
                        $this->session->unset_userdata('user');
                        return true;
         }
       public function isLogged(){
                        $userData = $this->session->userdata('user');
                        return ($userData['logged_in']) ? true : false;
         }
		
		public function logIn($username_password = array()){
			
			if(!empty($username_password)){
				
				$logged = false;
				$this->db->select('*');
				$this->db->from('users e');
				$this->db->where('e.username', $username_password['username']);
				$this->db->limit(1);
				$is = $this->db->get()->row();
				if($is){
					if($this->encryption->decrypt($is->password) == $username_password['password']){
						$logged = true;
						$array['user'] = array(
							'id' => $is->employee_id,
							'full_name' => $is->firstname . ' '. $is->lastname,
							'logged_in' => true,
							'back' => true
						);
						$this->session->set_userdata($array);
					}
				}
				
				return $logged;
			}
			
		}
		
	
		
}