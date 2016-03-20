<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailslog_model extends CI_Model {

		public $time_start;
		public $time_end;
		
        public function __construct()
        {
            parent::__construct();
			$this->data = array();
        }
		
		public function getInfo(){

		}
		
		public function setRead($id){
			$this->mongo_db->where(array('_id'=>new MongoId($id)))->set('read', 1)->update('mails');
			return true;
		}
		public function getMail($id){
			$this->mongo_db->where('_id',new MongoId($id));
			$db = $this->mongo_db->get('mails');
			$data = (isset($db[0]) && !empty($db[0])) ? $db[0] : FALSE; 
			$data['attachments'] = $this->getAttachments($data['id']);
			
			return $data;
		}
		public function getMails($options = array()){

			if(!empty($options)) extract($options);
			if(isset($from) && !empty($from)) $this->mongo_db->like('from', $from);
			if(isset($to) && !empty($to)) $this->mongo_db->like('to',$to);
			if(isset($subject) && !empty($subject)) 	$this->mongo_db->like('subject', $subject);
			
			if(isset($date_from) && !empty($date_from)) $this->mongo_db->where_between('date',(int) strtotime($date_from . ':00'),(int) strtotime($date_to . ':59'));
			$this->mongo_db->order_by(array('date' => 'DESC'));
			$data = $this->mongo_db->get('mails');

			return $data;
		
		}
		
		public function getAttachments($msg_id){
			$msg_id = rtrim($msg_id,'>');
			$msg_id= ltrim($msg_id,'<');
			$data = array();
			$list = glob("/var/www/vhosts/barcoding.local/httpdocs/beta/assets/attachments/" . $msg_id . "/*.*");
			if(!empty($list)){
				foreach ($list as $filename)
				{
					$x = array(
						'url' => base_url() . "/assets/attachments/" . rawurlencode($msg_id) . "/" . basename($filename),
						'name' => basename($filename),
						'path' => $filename
					);
					array_push($data,$x);
				}
			}
			
			return $data;
			
		}
		

}