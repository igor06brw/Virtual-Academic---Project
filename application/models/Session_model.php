<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Session_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
				$this->load->database('default');
        }
		
		public function editSession($session_id = false, $data) {
			
			$data['date_start'] = $data['date_start'] . ' ' . $data['date_start_time'];
			$data['date_stop'] = $data['date_stop'] . ' ' . $data['date_stop_time'];
			
			unset($data['date_start_time']);
			unset($data['date_stop_time']);
			unset($data['employee_name']);
			$this->db->where('session_id', $session_id);
			$this->db->update('session', $data);
			return true;
		}
		public function getSession($session_id){
			$this->db->select('jt.color,jt.controller,s.*,concat(e.firstname," ",e.lastname) as fullName,concat(b.part_number," ",b.part_description) as info');
			$this->db->select("time_format(timediff(s.date_stop,s.date_start),'%H:%m:%s') as total_time", FALSE);
			$this->db->from('session s');
			$this->db->join('jobs_type jt', 'jt.id = s.type');
			$this->db->join('employee e', 'e.employee_id = s.employee_id');
			$this->db->join('barcode b', 'b.barcode = s.barcode');
			$this->db->where('s.session_id', $session_id);
			$basic = $this->db->get()->row();
			return $basic;
		}
		
		public function getSessions($options = array()){
			

			$this->db->select('jt.color,jt.controller,s.*,concat(e.firstname," ",e.lastname) as fullName,concat(b.part_number," ",b.part_description) as info');
			$this->db->select("time_format(timediff(s.date_stop,s.date_start),'%H:%m:%s') as total_time", FALSE);
			$this->db->from('session s');
			$this->db->join('jobs_type jt', 'jt.id = s.type');
			$this->db->join('employee e', 'e.employee_id = s.employee_id');
			$this->db->join('barcode b', 'b.barcode = s.barcode');
			
			if(!empty($options['date_from'])) $this->db->where('DATE(s.date_start) >=', $options['date_from']);
			if(!empty($options['date_to'])) $this->db->where('DATE(s.date_start) <=', $options['date_to']);
			if(!empty($options['type'])) $this->db->where('s.type', $options['type']);
			
			$this->db->limit($options['start'],$options['length']);
			$basic = $this->db->get()->result();
			$data = array();
			if(!empty($basic)){
				
				foreach($basic as $value){
					$value2[0] = '<input type="checkbox" name="id[]" value="'.$value->session_id.'">';
					$value2[1] = date('Y-m-d',strtotime($value->date_start));
					$value2[2] = date('H:m:s',strtotime($value->date_start));
					$value2[3] = date('H:m:s',strtotime($value->date_stop));
					$value2[4] = (empty($value->total_time)) ? '(ongoing)' : $value->total_time;
					$value2[5] = $value->fullName;
					$value2[6] = $value->barcode;
					$value2[7] = $value->info;
					$value2[8] = '<span style="background-color:'.$value->color.'" class="label label-sm">'.$value->controller.'</span>';
					$value2[9] = '';
					array_push($data,$value2);
				}
			}
			$return = array(
				'recordsFiltered' => count($basic),
				'recordsTotal' => count($basic),
				'data' => $data
			);
			return $return;
			
		}
		
		public function getSessionsDhtmlX($options = array()){
			if(!empty($options)) extract($options);
			$this->db->select('s.session_id,jt.color,jt.controller,s.*,concat(e.firstname," ",e.lastname) as fullName,concat(b.part_number," ",b.part_description) as info');
			$this->db->select("time_format(timediff(s.date_stop,s.date_start),'%H:%m:%s') as total_time", FALSE);
			$this->db->from('session s');
			$this->db->join('jobs_type jt', 'jt.id = s.type', 'left');
			$this->db->join('employee e', 'e.employee_id = s.employee_id' ,'left');
			$this->db->join('barcode b', 'b.barcode = s.barcode' ,'left');
			
			if(isset($emp_id) && !empty($emp_id)) $this->db->where('s.employee_id', $emp_id);
			

			if(isset($barcode) && !empty($barcode)) $this->db->where('s.barcode', $barcode);
			if(isset($type) && !empty($type))  $this->db->where('s.type', $type);
			if(isset($status) && !empty($status)) $this->db->where('s.status', $status);
			if(isset($status) && strlen($status) > 0 && $status == 0) $this->db->where('s.status', '0');
			
			
			if(isset($date_from) && !empty($date_from)) $this->db->where('DATE(s.date_start) >=',$date_from);
			if(isset($date_to) && !empty($date_to)) $this->db->where('DATE(s.date_start) <=', $date_to);
			$this->db->order_by('s.date_start','DESC');
			//$this->db->limit(1000);			
			//$this->db->limit(1000);			
			$basic = $this->db->get()->result();
			$data = array();
			foreach($basic as $value){
					$value2 = array();
					$value2['session_id'] = $value->session_id;
					$value2['date_start'] = date('Y-m-d',strtotime($value->date_start));
					$value2['time_start'] = date('H:m:s',strtotime($value->date_start));
					$value2['time_stop'] = date('H:m:s',strtotime($value->date_stop));
					$value2['time_spent'] = (empty($value->total_time)) ? '(ongoing)' : $value->total_time;
					$value2['employee'] = $value->fullName;
					$value2['barcode'] = $value->barcode;
					$value2['info'] = '<i class="fa fa-info  popovers" data-container="body" data-trigger="hover" data-placement="bottom" data-content="'.$value->info.'" data-original-title="Part Number / Description"></i>';
					$value2['type'] = '<span style="background-color:'.$value->color.'" class="label label-sm">'.$value->controller.'</span>';
					$value2['actions'] = '
					
					<a class="edit" data-url="'.base_url().'back/sessionmanager/editModal/'.$value->session_id.'/" data-toggle="modal"> 
						<button type="button" class="btn-xs btn green"><i class="fa fa-edit"></i>
						</button>
					</a>
					<button class="delete btn btn-xs btn-danger" data-toggle="confirmation" data-placement="bottom" data-popout="true"><i class="fa fa-remove"></i></button>	
					
					
					';
					array_push($data,$value2);
			}
			
			return $data;
		}
		

}