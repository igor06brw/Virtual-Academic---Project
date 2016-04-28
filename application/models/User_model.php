<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
				$this->load->database('default');
        }
		public function getTeachers($options = array()){
			if(!empty($options)) extract($options);
			$data = $this->db->get_where('users', array('user_group_id' => $this->config->item('teacher_group')))->result();
			return $data;
		}
		public function userData(){
			return $this->session->userdata('user');
		}
		public function ifAdmin($group_id = false){
			if(!$group_id) $group_id = $this->userData()['fullData']->user_group_id;
			return ($group_id == $this->config->item('admin_group')) ? TRUE : FALSE;
		}
		public function ifTeacher($group_id = false){
			if(!$group_id) $group_id = $this->userData()['fullData']->user_group_id;
			return ($group_id == $this->config->item('teacher_group')) ? TRUE : FALSE;
		}
		public function ifWorker($group_id = false){
			if(!$group_id) $group_id = $this->userData()['fullData']->user_group_id;
			return ($group_id == $this->config->item('worker_group')) ? TRUE : FALSE;
		}
		public function ifStudent($group_id = false){
			if(!$group_id) $group_id = $this->userData()['fullData']->user_group_id;
			return ($group_id == $this->config->item('student_group')) ? TRUE : FALSE;
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
				$this->db->select('e.*,g.name as group_name,g.icon as group_icon');
				$this->db->from('users e');
				$this->db->where('e.username', $username_password['username']);
				$this->db->join('users_groups g', 'g.id = e.user_group_id', 'left');
				$this->db->limit(1);
				$is = $this->db->get()->row();
				if($is){
					if($this->encryption->decrypt($is->password) == $username_password['password']){
						$logged = true;
						$array['user'] = array(
							'id' => $is->user_id,
							'full_name' => $is->firstname . ' '. $is->lastname,
							'logged_in' => true,
							'fullData' => $is,
							'group_name' => $is->group_name
						);
						$this->session->set_userdata($array);
					}
				}
				
				return $logged;
			}
			
		}
		
	
		
}