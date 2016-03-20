<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Command_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
				$this->load->database('default');
        }
		
		public function getCommand($commandName){
			$query = $this->db->get_where('commands', array('command' => $commandName), 1)->row();
			return ($query) ? $query : false;
		}
		
		public function getIDFromCommand($functionName){
			$query = $this->db->get_where('commands', array('function' => $functionName), 1)->row();
			return ($query->command) ? $query->command : false;		
		}
		
		public function getSpecialCommand($commandName){
			$this->db->select('l.function,s.command,s.user_id');
			$this->db->from('commands_spec s');
			$this->db->join('commands_spec_list l', 'l.id = s.spec_id');
			$this->db->where('s.status', 1);
			$this->db->where('s.command', $commandName);
			$basic = $this->db->get()->row();
			return ($basic) ? $basic : false;
		}
		
		
		////////////////////////////////////// HERE ALL ALL COMMANDS ////////////////////////////
		
		public function fun001(){
			if($this->Employee_model->isLogged()){
				if($job = $this->Job_model->getCurrentJob($this->Employee_model->getCurrentEmployeeID())){
					$this->Job_model->stopJob($job->session_id);
				}
				redirect('');
			} else {
				redirect('');
			}
		}
		
		//////// FINISH FUNCTION ///////////
		
		public function fun002(){
				
				$current_function = __FUNCTION__;
				$id_function = $this->getIDFromCommand($current_function);
				
				$type = $this->input->post('type');
				$type_id = $this->input->post('type_id');	
				$finish = $this->input->post('finish');
				$qty = $this->input->post('qty');
				$basic_current = $this->Job_model->getCurrentJobBasic($this->Employee_model->getCurrentEmployeeID());
				
				// if employee not working now you can't finish so redirect
				if(!$basic_current) {
					redirect('job/' . $this->Employee_model->getLastUserJob());
					return true;
				}
				
				
				if($finish) {
					// second etap. If modal was sended and employee set valid qty so stop sesion insert micro session and that's it.
					$session_id = $this->input->post('current_session_id');
					$this->Job_model->stopJob($session_id);
					$this->Job_model->insertFinishSession($finish,$basic_current->barcode,$this->Employee_model->getCurrentEmployeeID(),$qty);
					redirect('job/' . $this->Employee_model->getLastUserJob());
				} else {
					// first etap. Show modal to employee with qty input validate max qty with javascript and to go 'second etap' ($finish)
					$this->config->load('jobs/job_' . $type, FALSE , TRUE);
					$have_finish = (!empty($this->config->item('finish_type'))) ? $this->config->item('finish_type') : false;
					
					if(!$have_finish){
						redirect('job/' . $this->Employee_model->getLastUserJob());				
					}
					
					
					
					$max_qty = $this->Job_model->getQtyLeft($basic_current->barcode,$have_finish);
					
					$data['max_qty'] = $max_qty;
					$data['type'] = $type;
					$data['type_id'] = $type_id;
					$data['finish'] = $have_finish;
					$data['id_function'] = $id_function;
					$data['current_session_id'] = $basic_current->session_id;
					
					if($max_qty > 0){
						$array['modal'] = array(
								'max_qty' => 'test',
								'modal_body' => $this->load->view('front/default/job/functions/finish_modal', $data , true)
								
						);
						$this->session->set_flashdata($array);
					} else {
						$array['alert'] = array(
							'type' => 'danger',
							'content' => '<p>Job was finished already...</p>'
						);
						$this->session->set_flashdata($array);
					}
					
					redirect('job/' . $this->Employee_model->getLastUserJob());
				}
		}
		
		//////// RESTART FUNCTION ///////////
		
		public function fun003(){
			
			if($this->Job_model->getCurrentJobBasic($this->Employee_model->getCurrentEmployeeID())){
				redirect('job/' . $this->Employee_model->getLastUserJob());
			}
			
			$last_job = $this->Job_model->getLastJob($this->Employee_model->getCurrentEmployeeID());
			
			if($last_job){
				$this->Job_model->resumeJob($last_job->session_id);
				redirect('job/' . $last_job->controller);
			} else {
				redirect('job/' . $this->Employee_model->getLastUserJob());
			}
		}
		
		//////// BREAK FUNCTION /////////////
		
		public function fun004(){

			if($current_job = $this->Job_model->getCurrentJobBasic($this->Employee_model->getCurrentEmployeeID())){
				// if job current is save to break_id in session break type.
				$break_id = $current_job->session_id;
				$this->Job_model->stopJob($current_job->session_id);
				$this->Employee_model->setLastSession($break_id,$this->Employee_model->getCurrentEmployeeID());
			} else {
				$break_id = FALSE;
			}
			
			$this->Job_model->insertBreakSession($this->Employee_model->getCurrentEmployeeID(), $break_id);
			
			$this->Employee_model->logout();
			
			$array['alert'] = array(
					'type' => 'info',
					'content' => '<p style="text-align:center">You are on break now!</p>'
			);
			
			$this->session->set_flashdata($array);
			redirect('login');
		}
		
		//////// LOGOUT FUNCTION ////////
		
		public function fun005(){
			$this->Employee_model->logout();
			$array['alert'] = array(
					'type' => 'info',
					'content' => '<p style="text-align:center">You have successfully logged out!</p>'
			);
			
			$this->session->set_flashdata($array);
			
			redirect('login');			
		}
		
		
		//////// ADMIN FUNCTION ////////

		public function fun006($emp_id = false){
			$this->Employee_model->logout();
			$this->Employee_model->logIn(FALSE,FALSE,$emp_id);
			redirect('back/');
		}
		/////// JOB FINISH /////////
		public function fun007(){
			$this->load->model('Job_model');
			$this->Job_model->insertSession($this->config->item('barcoding_job_finish_type_id'),$barcode = false,$this->Employee_model->getCurrentEmployeeID(),true);
			$array['alert'] = array(
					'type' => 'info',
					'content' => '<p style="text-align:center">You finished your work for today. Goodbye!</p>'
			);
			
			$this->session->set_flashdata($array);
			$this->Employee_model->logout();
			redirect('login');
		}
		
		public function assembly_mode(){
			redirect('job/assembly');
		}
		
		public function cutting_mode(){
			redirect('job/cutting');
		}		
		public function test_mode(){
			redirect('job/test');
		}
		
		public function tools_mode(){
			redirect('job/tools');
		}		
}