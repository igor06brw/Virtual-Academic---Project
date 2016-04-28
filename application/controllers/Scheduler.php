<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scheduler extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        if(!$this->User_model->isLogged()) redirect('main');
    }
    public function generateRandomData(){
        // generate random data to tests....
        for($intx = 0; $intx <= 100; $intx++) {
            $this->db->select('id');
            $this->db->order_by('rand()');
            $this->db->limit(1);
            $query = $this->db->get('subjects')->row();
            $subject_id = $query->id;

            $this->db->select('user_id');
            $this->db->where('user_group_id',$this->config->item('teacher_group'));
            $this->db->order_by('rand()');
            $this->db->limit(1);
            $query = $this->db->get('users')->row();
            $teacher_id = $query->user_id;

            $this->db->select('id');
            $this->db->order_by('rand()');
            $this->db->limit(1);
            $query = $this->db->get('activities_types')->row();
            $type_id = $query->id;

            $this->db->select('id');
            $this->db->order_by('rand()');
            $this->db->limit(1);
            $query = $this->db->get('locations')->row();
            $location_id = $query->id;

            $group_id = 1;

            $int = mt_rand(1262055681, 1462461742);
            $minutes = array('30','60','90','180');

            $date_start = date("Y-m-d H:i:s", $int);
            $date_stop  = date("Y-m-d H:i:s", strtotime('+' . $minutes[array_rand($minutes)] . ' minutes', $int));

            $data = array(
                'subject_id' => $subject_id,
                'teacher_id' => $teacher_id,
                'subject_type' => $type_id,
                'location_id' => $location_id,
                'group_id' => $group_id,
                'date_start' => $date_start,
                'date_stop' => $date_stop,
                'status' => 1
            );
            $this->db->insert('activities',$data);

        }
    }
    public function getDataWrapper(){
        $params = array(
            'database' => $this->db->database,
            'username' => $this->db->username,
            'password' => $this->db->password,
            'host' => $this->db->hostname
        );
        $this->load->library('KendoWrapper/DataSourceResult', $params, 'data_source');

        $request = json_decode(file_get_contents('php://input'));

        header('Content-Type: application/json');
        echo json_encode($this->data_source->read('scheduler', array('date_start','date_stop','subject_name','subject_type_label','teacher_label','location_label','subject_type','group_label'), $request));

        exit;
    }
    public function index(){
        $this->load->library('KendoWrapper/Kendo/KendoWrappers');
        $data['currentController'] = 'scheduler';
        $data['pageTitle'] = 'Plan zajęć';
        $data['smallTitle'] = '';
        $data['packages'] = $this->plugins->get(array('Kendo'));

        $transport = new \Kendo\Data\DataSourceTransport();
        $read = new \Kendo\Data\DataSourceTransportRead();
        $read->url(base_url() . "scheduler/getDataWrapper")
            ->contentType('application/json')
            ->type('POST');
        $transport->read($read)
            ->parameterMap('
                  function (data, operation) {

                     return kendo.stringify(data);
                  }
          ');
        $model = new \Kendo\Data\DataSourceSchemaModel();

        $subjectNameField = new \Kendo\Data\DataSourceSchemaModelField('subject_name');
        $subjectNameField->type('string');

        $subjectTypeLabelField = new \Kendo\Data\DataSourceSchemaModelField('subject_type_label');
        $subjectTypeLabelField->type('string');

        $teacherLabelField = new \Kendo\Data\DataSourceSchemaModelField('teacher_label');
        $teacherLabelField->type('string');

        $groupLabelField = new \Kendo\Data\DataSourceSchemaModelField('group_label');
        $groupLabelField->type('string');

        $locationLabelField = new \Kendo\Data\DataSourceSchemaModelField('location_label');
        $locationLabelField->type('string');

        $dateStartField = new \Kendo\Data\DataSourceSchemaModelField('date_start');
        $dateStartField->type('date');

        $dateStopField = new \Kendo\Data\DataSourceSchemaModelField('date_stop');
        $dateStopField->type('date');

        $filterableTransport = new \Kendo\Data\DataSourceTransport();
        $filterableRead = new \Kendo\Data\DataSourceTransportRead();
        $filterableRead->url(base_url() . "users/getTeachers")
            ->type('POST');
        $filterableTransport->read($filterableRead);
        $filterableDataSource = new \Kendo\Data\DataSource();
        $filterableDataSource->transport($filterableTransport);
        $columnFilterableTeacher = new \Kendo\UI\GridColumnFilterable();
        $columnFilterableTeacher->multi(true)
            ->dataSource($filterableDataSource);


        $filterableTransport2 = new \Kendo\Data\DataSourceTransport();
        $filterableRead2 = new \Kendo\Data\DataSourceTransportRead();
        $filterableRead2->url(base_url() . "subjects/getSubjects")
            ->type('POST');
        $filterableTransport2->read($filterableRead2);
        $filterableDataSource2 = new \Kendo\Data\DataSource();
        $filterableDataSource2->transport($filterableTransport2);
        $columnFilterableSubject = new \Kendo\UI\GridColumnFilterable();
        $columnFilterableSubject->multi(true)
            ->dataSource($filterableDataSource2);

        $filterableTransport3 = new \Kendo\Data\DataSourceTransport();
        $filterableRead3 = new \Kendo\Data\DataSourceTransportRead();
        $filterableRead3->url(base_url() . "subjects/getTypes")
            ->type('POST');
        $filterableTransport3->read($filterableRead3);
        $filterableDataSource3 = new \Kendo\Data\DataSource();
        $filterableDataSource3->transport($filterableTransport3);
        $columnFilterableSubjectType = new \Kendo\UI\GridColumnFilterable();
        $columnFilterableSubjectType->multi(true)
            ->dataSource($filterableDataSource3);

        $model->addField($subjectNameField)
            ->addField($subjectTypeLabelField)
            ->addField($locationLabelField)
            ->addField($dateStartField)
            ->addField($dateStopField)
            ->addField($groupLabelField)
            ->addField($teacherLabelField);

        $sort = new \Kendo\Data\DataSourceSortItem();
        $sort->field('date_start')->dir('desc');


        $schema = new \Kendo\Data\DataSourceSchema();
        $schema->parse(new \Kendo\JavaScriptFunction('function (d) {
        $.each(d.data, function (idx, elem) {
            elem.date_start = kendo.parseDate(elem.date_start + "Z", "yyyy-MM-dd HH:mm:ss","en-GB");
            elem.date_stop = kendo.parseDate(elem.date_stop + "Z", "yyyy-MM-dd HH:mm:ss","en-GB");
        });
        return d;
    }'));
        $schema->data('data')
            ->model($model)
            ->total('total');

        $dataSource = new \Kendo\Data\DataSource();

        $dataSource->transport($transport)
            ->pageSize(20)
            ->schema($schema)
            ->serverSorting(true)
            ->serverFiltering(true)
            ->addSortItem($sort)
            ->serverPaging(true);

        $grid = new \Kendo\UI\Grid('grid');

        $subjectColumn = new \Kendo\UI\GridColumn();
        $subjectColumn->field('subject_name')
            ->filterable($columnFilterableSubject)
            ->title('Przedmiot');

        $teacherColumn = new \Kendo\UI\GridColumn();
        $teacherColumn->field('teacher_label')
            ->filterable($columnFilterableTeacher)
            ->title('Prowadzący');

        $subjectTypeColumn = new \Kendo\UI\GridColumn();
        $subjectTypeColumn->field('subject_type_label')
            ->filterable($columnFilterableSubjectType)
            ->width(110)
            ->title('Typ');

        $groupColumn = new \Kendo\UI\GridColumn();
        $groupColumn->field('group_label')
            ->filterable(false)
            ->title('Grupa');

        $locationColumn = new \Kendo\UI\GridColumn();
        $locationColumn->field('location_label')
            ->filterable(false)
            ->width(70)
            ->title('Lokalizacja');

        $dateStart = new \Kendo\UI\GridColumn();
        $dateStart->field('date_start')
            ->title('Start')
            ->filterable(new \Kendo\JavaScriptFunction('
                            { ui: function (element) {
                                                        element.kendoDateTimePicker({
                                                            format: "dd/MM/yyyy HH:mm"
                                                        });
                                                    }
                            }
            '))
            ->template("#= kendo.toString(date_start, 'dd/MM/yyyy HH:mm') #")
            ->format('{0:dd/MM/yyyy HH:mm}');

        $dateStop = new \Kendo\UI\GridColumn();
        $dateStop->field('date_stop')
            ->title('Koniec')
            ->filterable(new \Kendo\JavaScriptFunction('
                            { ui: function (element) {
                                                        element.kendoDateTimePicker({
                                                            format: "dd/MM/yyyy HH:mm"
                                                        });
                                                    }
                            }
            '))
            ->template("#= kendo.toString(date_stop, 'dd/MM/yyyy HH:mm') #")
            ->format('{0:dd/MM/yyyy HH:mm}');

        $grid->addColumn($subjectColumn,$subjectTypeColumn,$teacherColumn,$dateStart,$dateStop,$locationColumn)
            ->selectable('cell multiple')
            ->pageable(true)
            ->sortable(true)
            ->filterable(true)
            ->dataSource($dataSource);

        $data['grid'] = $grid;


        if($this->User_model->ifAdmin())  $this->load->template('scheduler/admin/index' ,$data);
        if($this->User_model->ifStudent())  $this->load->template('scheduler/student/index' ,$data);
        if($this->User_model->ifWorker())  $this->load->template('scheduler/worker/index' ,$data);
        if($this->User_model->ifTeacher())  $this->load->template('scheduler/teacher/index' ,$data);

    }


}
