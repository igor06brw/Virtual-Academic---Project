<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Plugins {
	
	public $CI;
	public $packages;

	public function __construct(){
		$this->CI =& get_instance();
		$this->packages = array(
			'Pulsate' => array(
				'css' => array(),
				'js' => array(
					assets_url() . '/metronic/global/plugins/jquery.pulsate.min.js'
				)
			),
			'FormStuff' => array(
				'css' => array(
					assets_url() . '/metronic/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css',
					assets_url() . '/metronic/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css',
					assets_url() . '/metronic/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
					assets_url() . '/metronic/global/plugins/jquery-multi-select/css/multi-select.css',					
					assets_url() . '/metronic/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
					assets_url() . '/metronic/global/plugins/clockface/css/clockface.css',
					assets_url() . '/metronic/global/plugins/bootstrap-touchspin/bootstrap.touchspin.css',
					assets_url() . '/metronic/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
					assets_url() . '/metronic/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css'
				),
				'js' => array(	
					assets_url() . '/metronic/global/plugins/bootstrap-daterangepicker/moment.min.js',
					assets_url() . '/metronic//global/plugins/bootstrap-daterangepicker/daterangepicker.js',
					assets_url() . '/metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
					assets_url() . '/metronic/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
					assets_url() . '/metronic/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
					assets_url() . '/metronic/global/plugins/clockface/js/clockface.js',		
					assets_url() . '/metronic/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js',
					assets_url() . '/metronic/global/plugins/jquery-validation/js/jquery.validate.min.js',
					assets_url() . '/metronic/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js',
					assets_url() . '/metronic/global/plugins/jquery-multi-select/js/jquery.multi-select.js',
					assets_url() . '/metronic/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
					assets_url() . '/metronic/global/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js'
					
					
				)
			),
			'FlipClock' => array(
				'css' => array(
					assets_url() . '/default/flipclock/css/flipclock.css',
				),
				'js' 	=> array(
					assets_url() . '/default/flipclock/js/flipclock.min.js'
				)
			),		
			'Typehead' => array(
				'css' => array(
					assets_url() . '/metronic/global/plugins/typeahead/typeahead.css'
				),
				'js' => array(
					assets_url() . '/metronic/global/plugins/typeahead/handlebars.min.js',
					assets_url() . '/metronic/global/plugins/typeahead/typeahead.bundle.min.js'

				)
			),
			'Modals' => array(
				'css' => array(
				   assets_url() . '/metronic/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css',
				   assets_url() . '/metronic/global/plugins/bootstrap-modal/css/bootstrap-modal.css'
				),
				'js' => array(			
					assets_url() . '/metronic//global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js',
					assets_url() . '/metronic/global/plugins/bootstrap-modal/js/bootstrap-modal.js',
					assets_url() . '/metronic/admin/pages/scripts/ui-extended-modals.min.js'
				)
			),
			'dhtmlXPro' => array(
				'js' => array(assets_url() . '/metronic/codebase/dhtmlx.js'),
				'css' => array(assets_url() . '/metronic/codebase/dhtmlx.css')
			),
			'FileUpload' => array(
				'css' => array(
					assets_url() . '/global/plugins/file-upload/css/jquery.fileupload.css',
					assets_url() . '/global/plugins/file-upload/css/jquery.fileupload-ui.css'
				),
				'js' 	=> array(
					'//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js',
					'//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js',
					'//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js',
					assets_url() . '/global/plugins/file-upload/js/jquery.fileupload.js',
					assets_url() . '/global/plugins/file-upload/js/jquery.fileupload-process.js',
					assets_url() . '/global/plugins/file-upload/js/jquery.fileupload-image.js',
					assets_url() . '/global/plugins/file-upload/js/jquery.fileupload-audio.js',
					assets_url() . '/global/plugins/file-upload/js/jquery.fileupload-video.js',
					assets_url() . '/global/plugins/file-upload/js/jquery.fileupload-validate.js',
					assets_url() . '/global/plugins/file-upload/js/jquery.fileupload-ui.js'
				)
			),
			'Tags' => array(
				'css' => array(
					assets_url() . '/global/plugins/jquery-tags-input/jquery.tagsinput.css'
				),
				'js' 	=> array(
					assets_url() . '/global/plugins/jquery-tags-input/jquery.tagsinput.min.js',
					assets_url() . '/global/scripts/tags.js'
				)
			),		

			
			'DataTables' => array(
				'css' => array(
					assets_url() . 'metronic/global/plugins/select2/select2.css',
					assets_url() . 'metronic/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css',
					assets_url() . 'metronic/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css'
				),
				'js' => array(
					assets_url() . 'metronic/global/scripts/datatable.js',
					assets_url() . 'metronic/global/plugins/datatables/media/js/jquery.dataTables.min.js',
					assets_url() . 'metronic/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js',
					assets_url() . 'metronic/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js'
				)
			),
			'Charts' => array(
				'css' => array(
				),
				'js' => array(
					assets_url() . '/global/plugins/flot/jquery.flot.min.js',
					assets_url() . '/global/plugins/flot/jquery.flot.resize.min.js',
					assets_url() . '/global/plugins/flot/jquery.flot.pie.min.js',
					assets_url() . '/global/plugins/flot/jquery.flot.stack.min.js',
					assets_url() . '/global/plugins/flot/jquery.flot.crosshair.min.js',
					assets_url() . '/global/plugins/flot/jquery.flot.categories.min.js',
					assets_url() . '/admin/pages/scripts/charts-flotcharts.js'
				)
			),
			'SummerNote' => array(
				'css' => array(
					assets_url() . 'metronic/global/plugins/bootstrap-summernote/summernote.css'
				),
				'js' => array(
					assets_url() . 'metronic/global/plugins/bootstrap-summernote/summernote.min.js'
				)
			),	
			'Toastr' => array(
				'css' => array(
					assets_url() . 'metronic/global/plugins/bootstrap-toastr/toastr.min.css'
				),
				'js' => array(
					assets_url() . 'metronic/global/plugins/bootstrap-toastr/toastr.min.js'
				)
			),
			'SessionManager' => array(
				'css' => array(
				),
				'js' => array(
					assets_url() . 'metronic/admin/custom/session.js'
				)
			)			
		);
	}
	
	public function get($packages = array()){
		$rData = array();
		if(!empty($packages)){
			foreach($packages as $package_name){
				if(isset($this->packages[$package_name])){
					$data['css'] = $this->packages[$package_name]['css'];
					$data['js'] = $this->packages[$package_name]['js'];
					array_push($rData,$data);
				}
			}
		}
		return (empty($rData)) ? false : $rData;
	}	

	
}