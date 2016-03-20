	<style>
	.input-large {
    width: 500px !important;
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
              <label class="control-label" for="input-barcode">Zdarzenie</label>
              <input type="text" name="filter_zdarzenie" value="" placeholder="search.." id="text" class="form-control" />
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label" for="input-status">Status</label>
              <select name="filter_status" id="input-status" class="form-control" onchange="$('#button-filter').trigger('click');">
                <option value="">-- all --</option>
                                <option value="0">Failed</option>
                                                <option value="1">Success</option>
                              </select>
            </div>
          </div>
	          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label" for="input-barcode">IP</label>
              <input type="text" name="filter_ip" value="" placeholder="search.." class="form-control" />
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
		
		}
		function applyFilter(){
		
			var emp_id = ($("#typeahead_example_3").val().length === 0) ? '' : encodeURIComponent($("#emp_id").val());
			var zdarzenie = ($("input[name='filter_zdarzenie']").val().length === 0) ? '' : encodeURIComponent($("input[name='filter_zdarzenie']").val());
			var status = ($("select[name='filter_status']").val().length === 0) ? '' : encodeURIComponent($("select[name='filter_status']").val());
			var date_from = ($("input[name='from']").val().length === 0) ? '' : encodeURIComponent($("input[name='from']").val());
			var date_to = ($("input[name='to']").val().length === 0) ? '' : encodeURIComponent($("input[name='to']").val());
			var ip = ($("input[name='filter_ip']").val().length === 0) ? '' : encodeURIComponent($("input[name='filter_ip']").val());
	
			myGrid.clearAll();
			myGrid.load("http://10.1.2.24/beta/back/logs/getLogs?emp_id=" + emp_id + "&zdarzenie=" + zdarzenie + '&status=' + status + "&date_from=" + date_from + "&date_to=" + date_to + "&ip=" + ip, callback,'json');		
		}
		

		
		myGrid = new dhtmlXGridObject('gridbox');
		myGrid.setImagePath("http://10.1.2.24/beta/assets/metronic/codebase/imgs/dhxgrid_web/");
		myGrid.setHeader("Employee,IP,Url,Type,Date,Time Execution,Status");
		//myGrid.attachHeader(',#text_filter,#text_filter,,,#text_filter,#text_filter')
		myGrid.setColTypes('ro,ro,ro,ro,ro,ro,ro,ro');
		myGrid.setDateFormat("%Y-%m-%d");
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
		var a = new Bloodhound({
                datumTokenizer: function(e) {
                    return e.tokens
                },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: "http://10.1.2.24/beta/back/autocomplete/employee/%QUERY/"
        });
		a.initialize();
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
			
		var b = new Bloodhound({
                datumTokenizer: function(e) {
                    return e.tokens
                },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: "http://10.1.2.24/beta/back/autocomplete/logs/%QUERY/"
        });
		 
		b.initialize();
		$("#text").typeahead(null, {
                name: "datypeahead_example_4",
                displayKey: "text",
                source: b.ttAdapter(),
                hint: !1
            })
	});
</script>