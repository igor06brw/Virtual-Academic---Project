<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barcode_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
				$this->load->database('default');
        }
		
		public function getQtyBarcode($barcode){
			$this->db->select('qty');
			$this->db->from('barcode');
			$this->db->where('barcode', $barcode);
			$qty = $this->db->get()->row()->qty;
			return $qty;
		}
		public function validBarcode($barcode, $type){
			if(!is_numeric($type)) $type = $this->Job_model->getJobID($type);
			$this->db->select('barcode_id');
			$query = $this->db->get_where('barcode', array('barcode' => $barcode), 1)->row();
			$is_in_barcoding = ($query) ? true : false;
			
			$this->db->select('session_id');
			$query = $this->db->get_where('session', array('barcode' => $barcode, 'status' => '0', 'type' => $type), 1)->row();		
			
			$is_duplicate = ($query) ? true : false;
					
			return ($is_duplicate || !$is_in_barcoding) ? false : true;
		}
		
		public function isFinish($barcode, $type){
			if(is_numeric($type)) $type = $this->Job_model->getJobFromID($type);
			$this->config->load('jobs/job_' . $type, FALSE , TRUE);
			$finish_type = $this->config->item('finish_type');
			$type = $finish_type;
			$this->db->select('SUM(finish) as total', FALSE);
			$this->db->from('session');
			$this->db->where('barcode', $barcode);
			$this->db->where('type', $finish_type);
			$total = $this->db->get()->row()->total;
			return ($total == $this->getQtyBarcode($barcode)) ? true : false;
			
		
		}
		
		public function getBarcodeFromSession($session_id){
			$this->db->select('barcode');
			$this->db->from('session');
			$this->db->where('session_id', $session_id);
			return $this->db->get()->row()->barcode;
		
		}
		
		public function getBarcodes($options = array()){
			if(!empty($options)) extract($options);
			$this->db->select('barcode_id,barcode');
			$this->db->from('barcode');
			if(isset($barcode_like)) $this->db->like('barcode',$barcode_like);
			$data = $this->db->get()->result();
			if(!empty($data)){
				foreach($data as $key => $value){
					$data[$key]->value = $value->barcode;
				}
			}
			return $data;
		}

}