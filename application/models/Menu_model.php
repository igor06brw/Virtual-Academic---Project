<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
				$this->load->database('default');
        }

		public function haveAccesss($menu_id,$group_id){

			$query = $this->db->get_where('menu_permission', array('menu_id' => $menu_id, 'group_id' => $group_id),1)->result();
			return (!empty($query)) ? TRUE : FALSE;

		}
		public function getChild($menu_id){
			$query = $this->db->get_where('menu', array('parent_id' => $menu_id))->result();
			if(!empty($query)){
				foreach($query as $key => $value){
					/*
					$this->lang->load('back/' .$value->controller, FALSE);
					$lang_name = (!empty($this->lang->line($value->controller . '_main', FALSE))) ? $this->lang->line($value->controller . '_main', FALSE) : ucfirst($value->controller);
					$query[$key]->lang_name = $lang_name;
					$query[$key]->submenu = $this->getChild($value->id);
					*/
				}
			}
			return $query;
		}
		public function getMenu($user, $active_controller){
			$data['currentController'] = $active_controller;
			$menus = $this->db->order_by('sort', 'ASC')->get('menu')->result();
			if(!empty($menus)) {
				foreach($menus as $key => $value){
					if(!isset($user['fullData'])) continue;
					if(!$this->haveAccesss($value->id, $user['fullData']->user_group_id)) {
						unset($menus[$key]);
						continue;
					}
					if(!empty($value->parent_id)) { unset($menus[$key]); continue; }
					$menus[$key]->submenu = $this->getChild($value->id);
				}
			}
			$data['menus'] = $menus;
			return $this->load->view('metronic/common/menu', $data, TRUE);
		}
		
		public function getBreadcrumbs($active_controller,$pageTitle, $homeAdmin){
		ob_start(); ?>
					<ul class="page-breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?= $homeAdmin ?>">Home</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#"><?= $pageTitle ?></a>
						</li>

					</ul><?php
    return ob_get_clean();
		
		}
}