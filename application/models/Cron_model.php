<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_model extends CI_Model {
	
		public $mainScript;

        public function __construct()
        {
                parent::__construct();
				$this->load->database('default');
				$this->mainScript = '/var/www/vhosts/barcoding.local/httpdocs/beta/index.php';
		}
		//////////////////////////// CRON FUNCTIONS //////////////////////////////////////////
		public function dropbox($args = array()){
			if(!empty($args)) {
				$args = (array) json_decode($args);
				extract($args);
			}
			
			
			
			$shadow = file_get_contents('/etc/shadow');
			$uid = system('id');
			// always return data back in function cron
			// if you need mail log then parse html in variable attachments pass array with path
			$data = array(
				'subject' => 'Sample subject',
				'html' => $uid,
				'attachments' => '/var/www/vhosts/barcoding.local/httpdocs/newenvironment/robots/rollcall.pdf'
			);
			return $data;
		
			
		}
		
		public function getMails($args = array()){
			if(!empty($args)) {
				$args = (array) json_decode($args);
				extract($args);
			}
		
			// always return data back in function cron
			// if you need mail log then parse html in variable attachments pass array with path
			$cmd = system("perl /var/www/vhosts/barcoding.local/httpdocs/newenvironment/robots/mail_script/script.pl");
			return array();
		
			
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		public function startCron($id){
		
			
			$data = array(
				'status' => 2,
				'pid' => getmypid()
			);
			$this->db->set('date_stop', 'NULL', FALSE);
			$this->db->set('date_start', 'NOW()', FALSE);
			$this->db->where('id', $id);
			$this->db->update('cron_jobs', $data);
		}
				
		public function endCron($id){
			$data = array(
				'status' => 1
			);
			$this->db->set('date_stop', 'NOW()', FALSE);
			$this->db->where('id', $id);
			$this->db->update('cron_jobs', $data);			
		}	
		
		
		public function parseCron($data){
			$minutes = '';
			$hours = '';
			$day = '';
			$months = '';
			$dayweek = '';
			
			if($data['minutes'][0] == '*') {
				$minutes = '*';
			} else {
				foreach($data['minutes'] as $minute){
					$minutes .= $minute . ',';
				}
				
				$minutes = rtrim($minutes,',');
			}

			
			if($data['hours'][0] == '*') {
				$hours = '*';
			} else {
				foreach($data['hours'] as $hour){
					$hours .= $hour . ',';
				}
				
				$hours = rtrim($hours,',');
			}		
			
			if($data['day'][0] == '*') {
				$day = '*';
			} else {
				foreach($data['day'] as $s_day){
					$day .= $s_day . ',';
				}
				
				$day = rtrim($day,',');
			}	
			
			if($data['months'][0] == '*') {
				$months = '*';
			} else {
				foreach($data['months'] as $month){
					$months .= $month . ',';
				}
				
				$months = rtrim($months,',');
			}	
			
			if($data['dayweek'][0] == '*') {
				$dayweek = '*';
			} else {
				foreach($data['dayweek'] as $d){
					$dayweek .= $d . ',';
				}
				
				$dayweek = rtrim($dayweek,',');
			}	
			
			$complete = $minutes . ' ' . $hours . ' ' . $day . ' ' . $months .' ' . $dayweek;
			

			
			return $complete;
		}
		
		public function getArgs($cron_id){
			$data = $this->db->get_where('cron_jobs_args', array('cron_id' => $cron_id))->result();
			return ($data) ? $data : false;
		}
		public function updateCron($data, $id){
			
			$cron = $this->parseCron($data);
			$send_mail = (isset($data['send_mail'])) ? '1' : '0';
			$send_to = ($data['send_to']) ? json_encode(explode(',',$data['send_to'])) : json_encode(array());
			if(!$send_mail) $send_to = json_encode(array());
			$data = array('send_to' => $send_to, 'schedule' => $cron, 'send_mail' => $send_mail);
			$this->db->where('id', $id);
			$this->db->update('cron_jobs', $data);		
			// here we need install a new cron.
			$cronM = new CronManagment();
			$cronM->remove_crontab();
			foreach($this->getCrons() as $cron){
				$command = ''.$this->mainScript.' back/cron execCron ' . $cron->id;
				$fullLine = $cron->schedule . ' nohup php '.$command.' > /dev/null 2>&1 &';
				$cronM->append_cronjob($fullLine);
			}
		}
		public function getCrons(){
			$data = $this->db->get('cron_jobs')->result();
			if(!empty($data)){
				foreach($data as $key => $value){
					$data[$key]->next = (!empty($value->schedule)) ? tdCron::getNextOccurrence($value->schedule) : false;
					$data[$key]->run = base_url() . "back/cron/runCron/" . $value->id . "/";
					$data[$key]->kill =  base_url() . "back/cron/killCron/" . $value->pid . "/".$value->id."";
					$data[$key]->args = $this->getArgs($value->id);
				}
			}
			return $data;
		}
		public function getCron($id){
			$row = $this->db->get_where('cron_jobs', array('id' => $id))->row();
			if(!empty($row->schedule)) {
				$cron = explode(' ',$row->schedule);
				$row->minutes = ($cron[0] == '*') ? array('*') : explode(',',$cron[0]);
				$row->hours = ($cron[1] == '*') ? array('*') : explode(',',$cron[1]);
				$row->day = ($cron[2] == '*') ? array('*') : explode(',',$cron[2]);
				$row->months = ($cron[3] == '*') ? array('*') : explode(',',$cron[3]);
				$row->dayweek = ($cron[4] == '*') ? array('*') : explode(',',$cron[4]);
			}
			$mails_txt = '';
			if(!empty($row->send_to)){
				$mails = json_decode($row->send_to);
				foreach($mails as $mail){
					$mails_txt .= $mail . ',';
				}
			}
			$row->mails = $mails_txt;
			$row->args = $this->getArgs($row->id);
			return $row;
		}

}