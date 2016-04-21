<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scheduler extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        if(!$this->User_model->isLogged()) redirect('main');
    }

   
    public function index(){
        $data['currentController'] = 'scheduler';
        $data['pageTitle'] = 'Plan zajęć';
        $data['smallTitle'] = '';
        $data['packages'] = $this->plugins->get(array('Pulsate','FormStuff','dhtmlXPro','Typehead'));

        // dashboard must have 3 access level
        /*
            -> Administrator
            -> Student
            -> Wykładowca
            -> Pracownik


        */

        if($this->User_model->ifAdmin())  $this->load->template('scheduler/admin/index' ,$data);
        if($this->User_model->ifStudent())  $this->load->template('scheduler/student/index' ,$data);
        if($this->User_model->ifWorker())  $this->load->template('scheduler/worker/index' ,$data);
        if($this->User_model->ifTeacher())  $this->load->template('scheduler/teacher/index' ,$data);

    }


}
