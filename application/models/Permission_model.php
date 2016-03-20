<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
				$this->load->database('default');
        }
		
		public function havePermission($employee_id, $command = FALSE, $mode = FALSE){
			
			$this->db->select('p.id');
			$this->db->from('employee_groups_permission p');
			if($mode) $this->db->join('jobs_type jt_m', 'jt_m.id = p.mode' ,'left');
			if($command) $this->db->join('commands c', 'c.id = p.command', 'left');
			$this->db->where('p.group_id IN', '(SELECT group_id FROM '.$this->db->dbprefix.'employee_groups_relation gr WHERE gr.employee_id = '.$employee_id.')', FALSE);
			if($command) $this->db->where('p.command', $command);
			if($mode) $this->db->where('p.mode',$mode);
			$result = $this->db->get()->row();	
			return ($result) ? true : false;
		}
}