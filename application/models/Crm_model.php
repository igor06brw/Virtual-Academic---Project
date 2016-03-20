<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crm_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
				$this->load->database('default');
        }
		
		public function getCustomers($options = array()){
			if(!empty($options)) extract($options);
			$this->db->select('cu.*, concat(c.name," ",c.surname) as main_contact_full_name,c.id as main_contact_id');
			$this->db->from('crm_customers cu');
			$this->db->join('crm_contacts c', 'cu.main_contact_id = c.id', 'left');			
			if(isset($customer_id) && is_numeric($customer_id)) $this->db->where('cu.customer_id', $customer_id);
			if(isset($customer_like) && !empty($customer_like)) $this->db->like('cu.company', $customer_like);
			$data =  $this->db->get()->result();
			if($data){
				foreach($data as $key => $value){
				$data[$key]->edit = '';
				$data[$key]->main_contact_url = '';
				$data[$key]->preview = '';
				}
			}
			return $data;
		}		


		
		public function getQuotations($options = array()){
			if(!empty($options)) extract($options);
			$this->db->select('q.*, c.company, concat(e.firstname," ",e.lastname) as prepared_fullName, c.acc,c.customer_id');
			$this->db->from('crm_quotations q');
			$this->db->join('crm_customers c', 'q.customer_id = c.customer_id', 'left');
			$this->db->join('employee e', 'e.employee_id = q.prepared_by', 'left');
			if(isset($customer_id) && is_numeric($customer_id)) $this->db->where('c.customer_id', $customer_id);
			if(isset($prepared_by) && is_numeric($prepared_by)) $this->db->like('q.prepared_by', $prepared_by);
			$data =  $this->db->get()->result();
			if($data){
				foreach($data as $key => $value){
				$data[$key]->edit = '';
				$data[$key]->main_contact_url = '';
				$data[$key]->preview = '';
				}
			}
			return $data;					
		}
		
		public function getSuppliers($options = array()){
			if(!empty($options)) extract($options);		
			$this->db->select('cu.*, concat(c.name," ",c.surname) as main_contact_full_name,c.id as main_contact_id');
			$this->db->from('crm_suppliers cu');
			$this->db->join('crm_contacts c', 'cu.main_contact_id = c.id', 'left');
			if(isset($supplier_id) && is_numeric($supplier_id)) $this->db->where('cu.supplier_id', $supplier_id);
			if(isset($company_like)&& !empty($company_like)) $this->db->like('cu.company', $company_like);
			$data =  $this->db->get()->result();
			if($data){
				foreach($data as $key => $value){
				$data[$key]->edit = '';
				$data[$key]->main_contact_url = '';
				$data[$key]->preview = '';
				}
			}
			return $data;			
			
		}	
		public function getContacts($options = array()){
			if(!empty($options)) extract($options);				
			$this->db->select('c.*, cu.company');
			$this->db->from('crm_contacts c');
			$this->db->join('crm_customers cu', 'c.customer_id = cu.customer_id', 'left');	
			if(isset($contact_like) && !empty($contact_like)) $this->db->like('concat(c.name," " ,c.surname)', $contact_like);
			if(isset($contact_id) && is_numeric($contact_id)) $this->db->where('c.id', $contact_id);
			$data =  $this->db->get()->result();
			if($data){
				foreach($data as $key => $value){
					$data[$key]->edit = '';
					$data[$key]->main_contact_url = '';
					$data[$key]->preview = '';
					$data[$key]->fullName = $value->name . ' ' . $value->surname;
				}
			}
			return $data;			
		}
}