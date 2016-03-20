<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs_model extends CI_Model {

		public $time_start;
		public $time_end;
		
        public function __construct()
        {
            parent::__construct();
			$this->data = array();
        }
		public function getAutoLogs($request){
			$return = array();
			$this->mongo_db->like('text', $request);
			$this->mongo_db->limit(10);
			$data = $this->mongo_db->distinct('logs','text');
			if(!empty($data)){
				foreach($data as $text){
					$value['text'] = $text;
					array_push($return,$value);
				}
			}
			return $return;
		}
		
		public function getLogs($options = array()){
			$this->load->model('employee_model');
			if(!empty($options)) extract($options);
			if(isset($emp_id) && !empty($emp_id)) $this->mongo_db->where('user_id', $emp_id);
			if(isset($ip) && !empty($ip)) $this->mongo_db->where('ip', $ip);
			
			if(isset($status) && !empty($status)) $this->mongo_db->where('status', 1);
			if(isset($status) && strlen($status) > 0 && $status == 0) $this->mongo_db->where('status',0);
			if(isset($zdarzenie) && !empty($zdarzenie)) 	$this->mongo_db->like('text', $zdarzenie);
			
			if(isset($date_from) && !empty($date_from)) $this->mongo_db->where_between('created',(int) strtotime($date_from . ':00'),(int) strtotime($date_to . ':59'));
			$this->mongo_db->order_by(array('created' => 'DESC'));
			$data = $this->mongo_db->get('logs');
			if(!empty($data)){
				foreach($data as $key => $value){
					$data[$key]['username'] = (isset($value['user_id']) && !empty($value['user_id'])) ? $this->employee_model->getEmployeeFullName($value['user_id']) : false;
				}
			}
			return $data;
		
		}
		
		
		
		public function register($data, $no_time = false){
			$this->setTimeStart(microtime(true));
			$flash['logs'] = $data;
			$this->session->set_userdata($flash);
			if($no_time) $this->endRegister();
			return true;
		}
		public function setTimeStart($time){
			$data = array('time_start' => $time);
			$this->session->set_userdata($data);
		}
		
		public function setTimeEnd($time){
			$data = array('time_end' => $time);
			$this->session->set_userdata($data);
			if($this->session->userdata('logs')) $this->insertLog();
		}	
		
		public function endRegister(){
			$data = array('time_end' => microtime(true));
			$this->session->set_userdata($data);
			if($this->session->userdata('logs')) $this->insertLog();			
		}
		
		public function insertLog(){
			$this->load->model('employee_model');
			$data = $this->session->userdata('logs');
			$exec = $this->session->userdata('time_end') - $this->session->userdata('time_start');
			$data['created'] = time();
			$data['url'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
			$data['ip'] =  $_SERVER['REMOTE_ADDR'];
			$data['user_id'] = $this->employee_model->getCurrentEmployeeID();
			$data['time_execution'] = number_format($exec, 3, '.', '');
			$this->mongo_db->insert('logs', $data);
			$this->session->unset_userdata('logs');
			$this->session->unset_userdata('time_end');
			$this->session->unset_userdata('time_start');
			return true;
		}
		

}