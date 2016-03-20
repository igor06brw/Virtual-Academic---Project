	<style>
	.input-large {
    width: 500px !important;
}
.date{
    font-style: italic;
    color: #c1cbd0;
}
.modal.fade.in {
    top: 1% !important;
	margin-top:10px !important;
}
.modal-body{
    height: 450px;
    overflow-y: auto;
}


	</style>
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
<h3 class="page-title">
			<?= $pageTitle ?> <small><?= (isset($smallTitle)) ? $smallTitle : '' ?></small>
			</h3>
			<div class="page-bar">
				<?= (isset($breadcrumbs)) ? $breadcrumbs : '' ?>
			
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- Begin: life time stats -->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-eye"></i> Logs
							</div>
						</div>
						<div class="portlet-body">
						<div id="ajax-modal" class="modal fade container modal-scroll" data-replace="true" tabindex="-1"> </div>
						      <div class="well">

        <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label" for="input-name">From</label>
             <div class="input-group">
			 <span class="input-group-addon">
               <i class="fa fa-user"></i>
               </span>
					<input type="text" name="from_m" class="form-control" />
				</div>
			</div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label" for="input-name">To</label>
             <div class="input-group">
			 <span class="input-group-addon">
               <i class="fa fa-user"></i>
               </span>
					<input type="text" name="to_m" class="form-control" />
				</div>
			</div>
          </div>
	          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label" for="input-barcode">Subject</label>
              <input type="text" name="subject" value="" placeholder="search.." class="form-control" />
            </div>
          </div>	  
        </div>
		<div class="row">
			<div class="col-sm-3">
			                                            <div class="form-group">
                                                <label class="control-label ">Date Range</label>
                                           
                                                    <div class="input-group input-large input-daterange">
                                                        <input type="text" class="date-picker form-control" value="<?= date('Y-m-d') . ' 00:00' ?>" name="from">
                                                        <span class="input-group-addon"> to </span>
                                                        <input type="text" class="date-picker form-control" value="<?= date('Y-m-d') . ' 23:59' ?>" name="to"> </div>
                                                    <!-- /input-group -->
                                               
                                            </div>
			</div>
			<div class="col-sm-3">
			</div>
			<div class="col-sm-3">
			</div>
			<div class="col-sm-3">
			<a id="filter" href="javascript:;" class="pull-right btn yellow"> Search
                                                                        <i class="fa fa-search"></i>
                                                                    </a>
			</div>
		</div>
	</div>
		<hr>
					<div id="gridbox" style="width:100%; height:900px; background-color:white;overflow:hidden"></div>

							
					<div id="recinfoArea"></div>
					</div>
					</div>
					<!-- End: life time stats -->
				</div>
			</div>
			<!-- END PAGE CONTENT-->


		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<script>
	$(document).ready(function(){
		function callback(){
			// tooltip stuff only
			Metronic.init();
			/*
			$(".pulsate").pulsate({
              
                });
			*/
			
			$(".forward").unbind().click(function(e){
				e.preventDefault();
				var controller = $(this).attr('data-controller');
				$.ajax({
					url : controller,
					dataType: 'json',
					success: function(data){
							toastr.options = {
							  "closeButton": false,
							  "debug": false,
							  "newestOnTop": false,
							  "progressBar": false,
							  "positionClass": "toast-top-right",
							  "preventDuplicates": false,
							  "onclick": null,
							  "showDuration": "300",
							  "hideDuration": "1000",
							  "timeOut": "5000",
							  "extendedTimeOut": "1000",
							  "showEasing": "swing",
							  "hideEasing": "linear",
							  "showMethod": "fadeIn",
							  "hideMethod": "fadeOut"
							};
						if(data.status){

							toastr["success"]("Mail was successfull send");					
						} else {
							toastr["error"]("Mail was not successfull send");
						}
					}
				});
			});
			
			$(".review").unbind().click(function(e){
				e.preventDefault();
				var url = $(this).attr('data-modal');
				     $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner = 
              '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
                '<div class="progress progress-striped active">' +
                  '<div class="progress-bar" style="width: 100%;"></div>' +
                '</div>' +
              '</div>';
				   var $modal = $('#ajax-modal');
					  $('body').modalmanager('loading');

						$modal.load(url, '', function(){
						  $modal.modal();
						});
						$modal.on('hidden.bs.modal', function () {
							var current_id = $("#c_id").val();
							$("span[data-id='" + current_id + "']").removeClass('bold');
						});
		
				
				});
		
		}
		function applyFilter(){
		
			var from = ($("input[name='from_m']").val().length === 0) ? '' : encodeURIComponent($("input[name='from_m']").val());
			var to = ($("input[name='to_m']").val().length === 0) ? '' : encodeURIComponent($("input[name='to_m']").val());
			var subject = ($("input[name='subject']").val().length === 0) ? '' : encodeURIComponent($("input[name='subject']").val());
			var date_from = ($("input[name='from']").val().length === 0) ? '' : encodeURIComponent($("input[name='from']").val());
			var date_to = ($("input[name='to']").val().length === 0) ? '' : encodeURIComponent($("input[name='to']").val());
	
			myGrid.clearAll();
			myGrid.load("http://10.1.2.24/beta/back/mailsScript/getMails?from=" + from + "&to=" + to + '&subject=' + subject + "&date_from=" + date_from + "&date_to=" + date_to, callback,'json');		
		}
		

		
		myGrid = new dhtmlXGridObject('gridbox');
		myGrid.setImagePath("http://10.1.2.24/beta/assets/metronic/codebase/imgs/dhxgrid_web/");
		myGrid.setHeader("From,To,Date,Subject,Action");
		//myGrid.attachHeader(',#text_filter,#text_filter,,,#text_filter,#text_filter')
		myGrid.setColTypes('ro,ro,dhxCalendar,ro,ro');
		myGrid.setColSorting("str,str,date,str");
		myGrid.setDateFormat("%Y-%m-%d %H:%i:%s");
		myGrid.setPagingWTMode(true,true,true,[30,60,90,120]);
		myGrid.enablePaging(true,30,3,"recinfoArea", true);
		myGrid.setPagingSkin("toolbar","dhx_web"); 
		myGrid.init();
		applyFilter();
		
		$("#filter").click(function(e){
			applyFilter();
			
		});
		
		myGrid.attachEvent('onPaging', function(){
			callback();
		});
		
		$('.date-picker').datetimepicker({
			format: "yyyy-mm-dd hh:ii",
		});


	});
</script>