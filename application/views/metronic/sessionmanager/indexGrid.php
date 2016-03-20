	<style>
.modal.fade.in {
    top: 1% !important;
	margin-top:10px !important;
}
div.gridbox_dhx_web.gridbox .xhdr {
	border-bottom: none !important;
}
.input-icon.right > i {
    right: 29px !important;
    float: right !important;
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
			
			<div class="page-toolbar">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
						Actions <i class="fa fa-angle-down"></i>
						</button>
						<ul class="dropdown-menu pull-right" role="menu">
							<li>
								<a onclick="myGrid.toPDF('http://dhtmlxgrid.appspot.com/export/pdf');">Export to PDF</a>
							</li>
							<li>
								<a onclick="myGrid.toExcel('http://dhtmlxgrid.appspot.com/export/excel');">Export to Excel</a>
							</li>

						</ul>
					</div>
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- Begin: life time stats -->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-shopping-cart"></i>List sessions
							</div>
						</div>
						<div class="portlet-body">
						<div id="ajax-modal" class="modal fade container modal-scroll" data-replace="true" tabindex="-1"> </div>
						      <div class="well">

        <div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label" for="input-name">Employee Name</label>
             <div class="input-group">
			 <span class="input-group-addon">
               <i class="fa fa-user"></i>
               </span>
					<input type="hidden" id="emp_id">
					<input type="text" id="typeahead_example_3" name="typeahead_example_3" class="form-control" />
				</div>
			</div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label" for="input-barcode">Barcode</label>
              <input type="text" id="typeahead_example_4" name="filter_barcode" value="" placeholder="Barcode" id="input-barcode" class="form-control" />
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label" for="input-session_type">Session Type</label>
              <select name="filter_session_type" id="input-session_type" class="form-control" onchange="$('#button-filter').trigger('click');">
                <option value="">-- all --</option>
				<?php foreach($types as $type): ?>
				<option value="<?= $type->id ?>"><?= $type->name ?></option>
				<?php endforeach ?>
                </select>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label" for="input-status">Status</label>
              <select name="filter_status" id="input-status" class="form-control" onchange="$('#button-filter').trigger('click');">
                <option value="">-- all --</option>
                                <option value="0">Ongoing</option>
                                                <option value="1">Finished</option>
                              </select>
            </div>
          </div>
        </div>
		<div class="row">
			<div class="col-sm-3">
			                                            <div class="form-group">
                                                <label class="control-label ">Date Range</label>
                                           
                                                    <div class="input-group input-large date-picker input-daterange" data-date="" data-date-format="yyyy-mm-dd">
                                                        <input type="text" class="form-control" value="<?= date('Y-m-d') ?>" name="from">
                                                        <span class="input-group-addon"> to </span>
                                                        <input type="text" class="form-control" value="<?= date('Y-m-d') ?>" name="to"> </div>
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
		
		function applyFilter(){
			
			var emp_id = ($("#typeahead_example_3").val().length === 0) ? '' : encodeURIComponent($("#emp_id").val());
			var barcode = ($("input[name='filter_barcode']").val().length === 0) ? '' : encodeURIComponent($("input[name='filter_barcode']").val());
			var type = ($("select[name='filter_session_type']").val().length === 0) ? '' : encodeURIComponent($("select[name='filter_session_type']").val());
			var status = ($("select[name='filter_status']").val().length === 0) ? '' : encodeURIComponent($("select[name='filter_status']").val());

			
			var date_from = ($("input[name='from']").val().length === 0) ? '' : encodeURIComponent($("input[name='from']").val());

			var date_to = ($("input[name='to']").val().length === 0) ? '' : encodeURIComponent($("input[name='to']").val());

			
			myGrid.clearAll();
			myGrid.load("http://10.1.2.24/beta/back/sessionmanager/getDhtmlx/?emp_id=" + emp_id + "&barcode=" + barcode + '&type=' + type + '&status=' + status + "&date_from=" + date_from + "&date_to=" + date_to, callback,'json');
			
			
			
		}
		
		
		$("#filter").click(function(e){
			applyFilter();
			
		});
		function callback(){
		Metronic.init();
	      $('.delete').on('confirmed.bs.confirmation', function () {
            console.log('deleteing..');
        });

        $('.delete').on('canceled.bs.confirmation', function () {
           $(this).confirmation('hide');
        });
				     $.fn.modal.defaults.spinner = $.fn.modalmanager.defaults.spinner = 
              '<div class="loading-spinner" style="width: 200px; margin-left: -100px;">' +
                '<div class="progress progress-striped active">' +
                  '<div class="progress-bar" style="width: 100%;"></div>' +
                '</div>' +
              '</div>';
				   var $modal = $('#ajax-modal');
				  
				  $modal.on('hidden.bs.modal', function () {
						
				  });
				$('.edit').on('click', function(){
					  var url = $(this).attr('data-url');
					  // create the backdrop and wait for next modal to be triggered
					  $('body').modalmanager('loading');
					  setTimeout(function(){
						  $modal.load(url, '', function(){
						  $modal.modal();
						  
				
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation
						});
					  }, 2000);
					});
		}

	
		myGrid = new dhtmlXGridObject('gridbox');
		myGrid.setImagePath("http://10.1.2.24/beta/assets/metronic/codebase/imgs/dhxgrid_web/");
		myGrid.setHeader("Session ID,Date Start, Time start,Time stop, Time spent, Employee,Barcode,Info,Type,Actions");
		//myGrid.attachHeader(',#text_filter,#text_filter,,,#text_filter,#text_filter')
		myGrid.setColTypes('ro,dhxCalendar,ro,ro,ro,ro,ro,ro,ro,ro');
		myGrid.setDateFormat("%Y-%m-%d");
		myGrid.setPagingWTMode(true,true,true,[30,60,90,120]);
		myGrid.enablePaging(true,30,3,"recinfoArea", true);
		myGrid.setPagingSkin("toolbar","dhx_web"); 
		myGrid.init();
		myGrid.attachEvent('onPaging', function(){
			callback();
		});
		myGrid.enableHeaderMenu();
		//myGrid.load("http://10.1.2.24/beta/back/sessionmanager/getDhtmlx", 'json');
		applyFilter();
		var dp = new dataProcessor("http://10.1.2.24/beta/back/sessionmanager/ajaxProcessor");
		dp.init(myGrid);
		
		var a = new Bloodhound({
                datumTokenizer: function(e) {
                    return e.tokens
                },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: "http://10.1.2.24/beta/back/autocomplete/employee/%QUERY/"
        });
		 
		a.initialize();
		var b = new Bloodhound({
                datumTokenizer: function(e) {
                    return e.tokens
                },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: "http://10.1.2.24/beta/back/autocomplete/barcode/%QUERY/"
        });
		 
		b.initialize();		
		
		$("#typeahead_example_3").typeahead(null, {
                name: "datypeahead_example_3",
                displayKey: "value",
                source: a.ttAdapter(),
                hint: !1,
                templates: {
                    suggestion: Handlebars.compile([
                        '<div class="media">',
                        '<div class="pull-left">',
                        '<div class="media-object">',
                        '<img src="{{img}}" width="50" height="50"/>',
                        "</div>", "</div>",
                        '<div class="media-body">',
                        '<h4 class="media-heading">{{value}}</h4>',
                        "", "</div>",
                        "</div>"
                    ].join(""))
                }
            }).bind('typeahead:selected', function(obj, selected, name) {
				$("#emp_id").val(selected.employee_id);
			});
			
			$("#typeahead_example_4").typeahead(null, {
                name: "datypeahead_example_4",
                displayKey: "value",
                source: b.ttAdapter(),
                hint: !1
            })
			
			$("input[name='from']").change(function(){
				$("input[name='to']").val($(this).val());
			});
	
});
</script>