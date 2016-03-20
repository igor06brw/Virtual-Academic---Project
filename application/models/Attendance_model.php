<?php
class Attendance_model extends CI_Model {

	    public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
				$this->load->database();
				$this->load->model('Job_model');
			
        }
		
		public function returnTypes(){
			$data = array('in','out','job_finish','job_start');
			return $data;
		}
		public function getLastSession($employee_id){
			$this->db->order_by('session_id','DESC');
			$data = $this->db->get_where('nf_attendance', array('employee_id' => $employee_id))->row();
			return $data;
		}
		public function haveSessionsTodayShopFloor($employee_id){
			$data = $this->db->query("SELECT employee_id FROM nf_employee WHERE employee_id = '".$employee_id."' AND DATE(status_date) = '".date('Y-m-d')."'")->row();
			return ($data) ? true : false;
		}
		public function haveSessionsToday($employee_id){
			$data = $this->db->query("SELECT employee_id FROM nf_employee WHERE employee_id = '".$employee_id."' AND DATE(status_date) = '".date('Y-m-d')."'")->row();
			return ($data) ? true : false;
		}
		public function stopSession($session_id, $employee_id){

			// first close all ongoing session from today
			$query = $this->db->get_where('employee', array('employee_id' => $employee_id))->row();
			if(!empty($query->last_session_id)) $this->Job_model->stopJob($query->last_session_id);
			
			
			$data = array(
				'status' => 0
			);
			
			$this->db->set('date_stop', 'NOW()', FALSE);
			$this->db->where('session_id', $session_id);
			$this->db->update('nf_attendance',$data);
			// now update status
			$data = array(
						   'status_date' => date('Y-m-d'),
						   'status_attendance' => 'offside',
						);

			$this->db->where('employee_id', $employee_id);
			$this->db->update('nf_employee', $data);
		}
		public function startSession($employee_id,$type,$token){
			$data = array(
				'employee_id' => $employee_id,
				'type' => $type,
				'status' => 1
			);
			$this->db->set('date_start', 'NOW()', FALSE);
			$this->db->insert('nf_attendance', $data);
			// now update status
			$data = array(
						   'status_date' => date('Y-m-d'),
						   'status_attendance' => 'onside',
						);

			$this->db->where('employee_id', $employee_id);
			$this->db->update('nf_employee', $data);
		}
		
		public function createJobStart($employee_id, $token){
			$data = array(
				'employee_id' => $employee_id,
				'type' => 'job_start',
				'status' => 0
			);
			$this->db->set('date_start', 'NOW()', FALSE);
			$this->db->set('date_stop', 'NOW()', FALSE);
			
			$this->db->insert('nf_attendance', $data);
			// now update status
			$data = array(
						   'status_date' => date('Y-m-d'),
						   'status_type' => 'job_start',
						);

			$this->db->where('employee_id', $employee_id);
			$this->db->update('nf_employee', $data); 
			return true;
		}
		public function getUser($token = false){
			if(!$token) return false;
			$userData = array();
			$userData['emp_name'] = $userData['img'] = '';
			$userData['status'] = false;
			$this->db->select('e.*');
			$this->db->from('nf_employee e');
			$this->db->where('e.token', $token);
			$query = $this->db->get()->row();
			if($query){
				$userData['status'] = true;
				$userData['emp_name'] = $query->firstname . ' ' . $query->lastname;
				$sm_img = preg_replace('/\\.[^.\\s]{3,4}$/', '', $query->image);
				$sm_img = $sm_img . '-200x200.jpg';
				$userData['img'] = (!empty($query->image)) ? 'http://10.1.2.24/image/cache/' . $sm_img : '';
				if(!empty($query->custom_mp3_w)) $userData['custom_mp3_w'] = $query->custom_mp3_w;
				if(!empty($query->custom_mp3_b)) $userData['custom_mp3_b'] = $query->custom_mp3_b;
				if(!$this->haveSessionsToday($query->employee_id)){
						$this->createJobStart($query->employee_id, $token);
						$this->startSession($query->employee_id,'onside',$token);
						$userData['msg_back'] = 'Welcome Sir!';
						$userData['welcome'] = true;
				} else {	
						$session = $this->getLastSession($query->employee_id);
						if($session && $session->status == 1) {
							$this->stopSession($session->session_id,$query->employee_id);
							$userData['msg_back'] = 'See You Soon';
							$userData['welcome'] = false;
						} else {
							$this->startSession($query->employee_id,'onside',$token);
							$userData['msg_back'] = 'Welcome Sir!';
							$userData['welcome'] = true;
						}
					
				}
				/*
				if($query->office_type == 1){
					// method for salary
					if(!$this->haveSessionsToday($query->employee_id)){
						$this->createJobStart($query->employee_id, $token);
						$this->startSession($query->employee_id,'salary',$token);
						$userData['msg_back'] = 'Welcome Sir!';
						$userData['welcome'] = true;
					} else {	
						$session = $this->getLastSession($query->employee_id);
						if($session->status == 1) {
							$this->stopSession($session->session_id,$query->employee_id);
							$userData['msg_back'] = 'See You Soon';
							$userData['welcome'] = false;
						} else {
							$this->startSession($query->employee_id,'salary',$token);
							$userData['msg_back'] = 'Welcome Sir!';
							$userData['welcome'] = true;
						}
					
					}			
				} else {
					// method for shop floor
					if(!$this->haveSessionsTodayShopFloor($query->employee_id)){
						$this->createJobStartShopFloor($query->employee_id, $token);
						$userData['msg_back'] = 'Welcome Sir!';
						$userData['welcome'] = true;
					} else {
						$userData['msg_back'] = 'You already started';
						$userData['status'] = false;
					}
				}
				*/

			
			}
			return $userData;
		}
		
			public function getSessionsDhtmlX($options = array()){
			if(!empty($options)) extract($options);
			$this->db->select('s.session_id,s.*,concat(e.firstname," ",e.lastname) as fullName');
			$this->db->select("time_format(timediff(s.date_stop,s.date_start),'%H:%m:%s') as total_time", FALSE);
			$this->db->from('attendance s');
			$this->db->join('employee e', 'e.employee_id = s.employee_id' ,'left');
			
			if(isset($emp_id) && !empty($emp_id)) $this->db->where('s.employee_id', $emp_id);
			

			if(isset($barcode) && !empty($barcode)) $this->db->where('s.barcode', $barcode);
			if(isset($type) && !empty($type)) {
				switch($type){
					case "out":
					 $this->db->where('s.status', '0');
					 $this->db->where('s.type !=', 'job_start');
					 $this->db->where('s.type !=', 'job_finish');
					break;
					case "in":
					 $this->db->where('s.status', '1');
					break;
					
					default:
					$this->db->where('s.type', $type);
				}
				if($type == 'out') {}
				if($type == 'in') {}
				
			}
			
			
			if(isset($date_from) && !empty($date_from)) $this->db->where('DATE(s.date_start) >=',$date_from);
			if(isset($date_to) && !empty($date_to)) $this->db->where('DATE(s.date_start) <=', $date_to);
			$this->db->order_by('s.date_start','DESC');
			//$this->db->limit(1000);			
			//$this->db->limit(1000);			
			$basic = $this->db->get()->result();
			$data = array();
			foreach($basic as $value){
					$value2 = array();
					if(empty($value->total_time)){
						$type = '<span class="label label-sm in">In</span>';
					}else{
						$type = '<span class="label label-sm out">Out</span>';
					}
					
					if($value->type == 'job_start'){
						$type = '<span class="label label-sm job_start">Job start</span>';
					}
					$value2['session_id'] = $value->session_id;
					$value2['date_start'] = date('Y-m-d',strtotime($value->date_start));
					$value2['time_start'] = date('H:m:s',strtotime($value->date_start));
					$value2['time_stop'] = date('H:m:s',strtotime($value->date_stop));
					$value2['time_spent'] = (empty($value->total_time)) ? '(ongoing)' : $value->total_time;
					$value2['employee'] = $value->fullName;
					$value2['type'] = $type;
					array_push($data,$value2);
			}
			
			return $data;
		}	
		

}