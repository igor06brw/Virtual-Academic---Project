<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
				$this->load->database('default');
				$this->load->model('Employee_model');
        }
		public function getQtyLeft($barcode, $type_id){
		
			$this->db->select('qty');
			$this->db->from('barcode');
			$this->db->where('barcode', $barcode);
			$qty = $this->db->get()->row()->qty;
			$qty_ss = 0;
			
			$this->db->select('finish');
			$this->db->from('session');
			$this->db->where('barcode', $barcode);
			$this->db->where('type', $type_id);
			$qty_s = $this->db->get()->result();	
			if(!empty($qty_s)){
				
				foreach($qty_s as $value){
					$qty_ss += $value->finish;
				}
			}
			return $qty - $qty_ss;
			
		}
		
		
		public function getTypes(){
			return $this->db->get('jobs_type')->result();
		}
		
		public function getJobID($type){
			$query = $this->db->get_where('jobs_type', array('name' => $type), 1)->row();
			return ($query->id) ? $query->id : false;
		}
		public function getJob($job_name){
			$query = $this->db->get_where('jobs_type', array('name' => $job_name), 1)->row();
			return $query;
		}
		
		public function getLastIfBreak($employee_id){
			$this->db->select('s.type,s.break_id');
			$this->db->from('session s');
			$this->db->where('s.employee_id', $employee_id);
			$this->db->limit(1);
			$this->db->order_by("s.date_start", "desc"); 	
			$query = $this->db->get()->row();
			if($query){
				if($query->type == $this->config->item('barcoding_break_type_id')){
					return $query->break_id;
				} else {
					return false;
				}
			} else{
					return false;
			}

		}
		
		public function getJobFromID($type_id){
			$query = $this->db->get_where('jobs_type', array('id' => $type_id), 1)->row();
			return ($query->controller) ? $query->controller : false;		
		}
		public function getWONumber($barcode){
			$this->db->select('wo_number');
			$query = $this->db->get_where('barcode', array('barcode' => $barcode), 1)->row();
			return ($query->wo_number) ? $query->wo_number : false;
		}
		
		public function getLastJob($employee_id){
			$this->db->select('s.session_id,jt.controller');
			$this->db->from('session s');
			$this->db->join('jobs_type jt', 'jt.id = s.type');
			$this->db->where('s.status', 1);
			$this->db->where('s.employee_id', $employee_id);
			$this->db->where('DATE(s.date_start)', date('Y-m-d'));
			$this->db->where_in('s.type', $this->config->item('barcoding_production_group'));
			$this->db->limit(1);
			$this->db->order_by("s.date_start", "desc"); 
			$basic = $this->db->get()->row();
			return $basic;	
		}
		public function getCurrentJob($employee_id){
			$this->db->select('s.session_id,jt.color,jt.controller,s.date_stop,s.date_start,b.barcode,b.customer,s.wo_number,b.part_description');
			$this->db->select('TIMESTAMPDIFF(SECOND, s.date_start, NOW()) as time_spent', FALSE);
			$this->db->from('session s');
			$this->db->join('jobs_type jt', 'jt.id = s.type');
			$this->db->join('barcode b', 'b.barcode = s.barcode');
			$this->db->where('s.status', 0);
			$this->db->where('s.employee_id', $employee_id);
			$this->db->limit(1);
			$query = $this->db->get()->row();
			if($query){
				$query->lang_name = $query->controller;		
			}			
			return $query;
		}
		
		public function getCurrentJobBasic($employee_id){
			$this->db->select('s.barcode,s.session_id');
			$this->db->from('session s');
			$this->db->where('s.status', 0);
			$this->db->where('s.employee_id', $employee_id);
			$this->db->limit(1);
			$basic = $this->db->get()->row();
			return $basic;		
		}
		

			
		public function getTodayLastJobs($employee_id){
			$this->db->select('s.session_id,jt.color,jt.controller,s.date_stop,s.date_start,b.barcode,b.customer,s.wo_number,b.part_description');
			$this->db->select('TIMEDIFF(s.date_stop, s.date_start) as time_spent', FALSE);
			$this->db->from('session s');
			$this->db->join('jobs_type jt', 'jt.id = s.type');
			$this->db->join('barcode b', 'b.barcode = s.barcode');
			$this->db->where('s.status', 1);
			$this->db->where('s.employee_id', $employee_id);
			$this->db->where('DATE(s.date_start)', date('Y-m-d'));
			$this->db->where_in('s.type', $this->config->item('barcoding_production_group'));
			$this->db->limit(5);
			$query = $this->db->get()->result();
			if($query){
				foreach($query as $key => $value){
							$query[$key]->lang_name = $value->controller;
			
				}
			}
			return $query;
		
		}
		
		public function getSession($session_id){
			return $this->db->get_where('session', array('session_id' => $session_id), 1)->row();
		}
		
		
		public function insertSession($type,$barcode = false,$employee_id,$mikro = false){
			if(!is_numeric($type)) $type = $this->getJobID($type);
			$wo_number = $this->getWONumber($barcode);
			$data = array(
					'employee_id' => $employee_id,
					'barcode' => ($barcode) ? $barcode : NULL,
					'wo_number' => ($wo_number) ? $wo_number : NULL,
					'type' => $type
			);

			$this->db->set('date_start', 'NOW()', FALSE);
			if($mikro) $this->db->set('date_stop', 'NOW()', FALSE);
			$this->db->insert('session', $data);
			$session_id = $this->db->insert_id();
			$this->Employee_model->setLastMode($type);
			$this->Employee_model->setLastSession($session_id,$employee_id);
			return true;
			
		}	

		public function insertFinishSession($type,$barcode,$employee_id,$finish){
			if(!is_numeric($type)) $type = $this->getJobID($type);
			$wo_number = $this->getWONumber($barcode);
			$data = array(
					'employee_id' => $employee_id,
					'barcode' => $barcode,
					'wo_number' => $wo_number,
					'type' => $type,
					'finish' => $finish,
					'status' => 1
			);

			$this->db->set('date_start', 'NOW()', FALSE);
			$this->db->set('date_stop', 'NOW()', FALSE);
			
			$this->db->insert('session', $data);		
		}
		
		public function insertBreakSession($employee_id,$last_job = FALSE){
			// IMPORTANT! HERE SHOULD BE LINK TO FUNCTION INSERT SESSION !!!!!!!!!!

			$data = array(
					'employee_id' => $employee_id,
					'type' => $this->config->item('barcoding_break_type_id'),
					'status' => 1
			);

			if($last_job) $this->db->set('break_id', $last_job);
			$this->db->set('date_start', 'NOW()', FALSE);
			$this->db->set('date_stop', 'NOW()', FALSE);
			
			$this->db->insert('session', $data);
			$this->Employee_model->setLastMode($this->config->item('barcoding_break_type_id'));	
					
		}
		
		public function stopJob($session_id){
			$this->db->set('status', 1);
			$this->db->set('date_stop', 'NOW()', FALSE);
			$this->db->where('session_id', $session_id);
			$this->db->update('session');
			$session = $this->db->get_where('session', array('session_id' => $session_id), 1)->row();
			$this->Employee_model->setLastMode(false, 'idle');
			$this->Employee_model->unsetLastSession($session->employee_id);
			return true;
		}
		
		public function resumeJob($session_id){
			
			$session = $this->getSession($session_id);

			$finished = $this->Barcode_model->isFinish($session->barcode, $session->type);
			if($finished) {
					$array['alert'] = array(
						'type' => 'danger',
						'content' => '<p>Job was finished already...</p>'
					);
					$this->session->set_flashdata($array);
				return true;
			}
			
			$this->db->set('date_start', 'NOW()', FALSE);
			
			// IMPORTANT! HERE SHOULD BE LINK TO FUNCTION INSERT SESSION !!!!!!!!!!
			$this->db->insert('session',array(
			'employee_id' => $session->employee_id,
			'barcode' => $session->barcode,
			'wo_number' => $session->wo_number,
			'type' => $session->type,
			'finish' => $session->finish,
			'out' => $session->out,
			'outcost' => $session->outcost,
			'status' => 0
			));
			$inserted = $this->db->insert_id();
			$this->Employee_model->setLastMode($session->type);
			$this->Employee_model->setLastSession($inserted,$session->employee_id);
			return true;		
		}
}