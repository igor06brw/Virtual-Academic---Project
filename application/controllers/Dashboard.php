<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
			$this->load->model('User_model');
			if(!$this->User_model->isLogged()) redirect('main');
        }


        public function index(){
                $data['currentController'] = 'dashboard';
                $data['pageTitle'] = 'Panel';
                $data['smallTitle'] = '';
                $data['packages'] = $this->plugins->get(array('Pulsate','FormStuff','dhtmlXPro','Typehead'));

                // dashboard must have 3 access level
                /*
                    -> Administrator
                    -> Student
                    -> Wykładowca
                    -> Pracownik
                */

                if($this->User_model->ifAdmin())  $this->load->template('dashboard/admin/index' ,$data);
                if($this->User_model->ifStudent())  $this->load->template('dashboard/student/index' ,$data);
                if($this->User_model->ifWorker())  $this->load->template('dashboard/worker/index' ,$data);
                if($this->User_model->ifTeacher())  $this->load->template('dashboard/teacher/index' ,$data);

        }


}
