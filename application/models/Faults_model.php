<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faults_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
				$this->barcoding_db = $this->load->database('barcoding', TRUE);
        }
		
		public function getFaults($options = array()){
		if(!empty($options)) extract($options);
		$day =new DateTime('last day of this month'); 
		$this->barcoding_db->select('c.short,c.name,b.part_number,s.employee_id,b.customer,s.qty,s.id,s.barcode,s.id_fault_category,s.status,s.date_created,
		concat(e1.firstname," ",e1.lastname) as employee_full,
		concat(e2.firstname," ",e2.lastname) as inspector_full,
		concat(e3.firstname," ",e3.lastname) as solved_inspector_full');
		$this->barcoding_db->from('rejection_slips s');
		$this->barcoding_db->join('rejection_fault_category c', 'c.id = s.id_fault_category', 'left');		
		$this->barcoding_db->join('barcode b', 'b.barcode = s.barcode', 'left');		
		$this->barcoding_db->join('employee e1', 'e1.employee_id = s.employee_id', 'left');		
		$this->barcoding_db->join('employee e2', 'e2.employee_id = s.inspector_id', 'left');		
		$this->barcoding_db->join('employee e3', 'e3.employee_id = s.inspector_id_approved_by', 'left');		
		/*
		$day =new DateTime('last day of this month'); 
		if(isset($id) && !empty($id)) $sql .= " AND s.id = '".$id."'";
		if(isset($barcode) && !empty($barcode)) $sql .= " AND s.barcode = '".$barcode."'";
		if(isset($inspector) && !empty($inspector) && !empty($inspector_id)) $sql .= " AND s.inspector_id = '".$inspector_id."'";
		if(isset($inspector_solved) && !empty($inspector_solved) && !empty($inspector_solved_id)) $sql .= " AND s.inspector_id_approved_by = '".$inspector_solved_id."'";
		if(isset($status) && !empty($status)) $sql .= " AND s.status = '".$status."'";
		if(isset($customer) && !empty($customer)) {
			$total = count($customer);
	
			$sql .= " AND b.customer = ";
			$c = 0; foreach($customer as $single){ $c++;
				if($c == 1){
					$sql  .= "'".$single."' ";
				} else {
					$sql .= "OR b.customer = '".$single."' ";
				}
			}
		
		}
		if(isset($assembly) && !empty($assembly)) $sql .= " AND b.part_number = '".$assembly."'";
		if(isset($categories) && !empty($categories)) $sql .= " AND s.id_fault_category = '".$categories."'";
		if(isset($employee_id) && !empty($employee)) $sql .= " AND s.employee_id = '".$employee_id."'";
		if(isset($date_from) && !empty($date_from)) {
			$sql .= " AND date(s.date_created) >= '".$date_from."'";
		} else {
			$sql .= " AND date(s.date_created) >= '".date('Y-m-d', strtotime(date('Y-m-1')))."'";
		}
		if(isset($date_to) && !empty($date_to)){
			$sql .= " AND date(s.date_created) <= '".$date_to."'";
		} else {
			$sql .= " AND date(s.date_created) <= '".$day->format('Y-m-d')."'";
		}
		$sql .=" ORDER BY s.id DESC";
		*/
		if(isset($emp_id) && !empty($emp_id)){
			$this->barcoding_db->where('s.employee_id', $emp_id);
		}
		if(isset($date_from) && !empty($date_from)) {
			$this->barcoding_db->where("date(s.date_created) >= '".$date_from."'", NULL, FALSE);
		} else {
			$this->barcoding_db->where("date(s.date_created) >= '".date('Y-m-d', strtotime(date('Y-m-1')))."'", NULL, FALSE);
		}
		if(isset($date_to) && !empty($date_to)){
			$this->barcoding_db->where("date(s.date_created) <= '".$date_to."'", NULL, FALSE);
		} else {
			$this->barcoding_db->where("date(s.date_created) <= '".$day->format('Y-m-d')."'", NULL, FALSE);
		}
		
		if(isset($status) && !empty($status)) {
			$this->barcoding_db->where('s.status', $status);			
		}
		$data = $this->barcoding_db->get()->result();
/*
		if(!empty($data)){
			foreach($data as $key => $value){

				$data[$key]['categories_list'] = '';
				$print_url = 'http://10.1.2.24/index.php?route=account/print_fault&id='.$value['id'].'&redirect=back';
				$data[$key]['edit'] = '
				<a class="edit" href="javascript:;" data-id="'.$value['id'].'">
					<button class="btn btn-primary"><i class="fa fa-edit"></i></button>
				</a>
				<a href="'.$print_url.'" data-id="'.$value['id'].'">
					<button class="btn btn-primary"><i class="fa fa-print"></i></button>
				</a>				
				';
					
			}
			
		}
	*/	
		return $data;
		}
}