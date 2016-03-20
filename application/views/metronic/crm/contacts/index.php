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
								<i class="fa fa-shopping-cart"></i>List of contacts
							</div>
						</div>
						<div class="portlet-body">
						<div id="ajax-modal" class="modal fade container modal-scroll" data-replace="true" tabindex="-1"> </div>
						      <div class="well">

        <div class="row">

        </div>
		<div class="row">
          <div class="col-sm-3">
            <div class="form-group">
              <label class="control-label" for="input-name">Contact</label>
             <div class="input-group">
			 <span class="input-group-addon">
               <i class="fa fa-user"></i>
               </span>
					<input type="hidden" id="contact_id">
					<input type="text" id="typeahead_example_3" name="typeahead_example_3" class="form-control" />
				</div>
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

		}
		
		function applyFilter(){
			
		
			var contact_id = ($("#typeahead_example_3").val().length === 0) ? '' : encodeURIComponent($("#contact_id").val());
			
			myGrid.clearAll();
			myGrid.load("http://10.1.2.24/beta/back/crm/contacts_dhtmlxGet?contact_id=" + contact_id, callback,'json');
			
			
			
		}
		
		
		$("#filter").click(function(e){
			applyFilter();
			
		});
		
	
		myGrid = new dhtmlXGridObject('gridbox');
		myGrid.setImagePath("http://10.1.2.24/beta/assets/metronic/codebase/imgs/dhxgrid_web/");
		myGrid.setHeader("Name,Mobile,Email,Departament,Company");
		//myGrid.attachHeader(',#text_filter,#text_filter,,,#text_filter,#text_filter')
		myGrid.setColTypes('ro,ro,ro,ro,ro,ro,ro,ro');
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
	
		var b = new Bloodhound({
                datumTokenizer: function(e) {
                    return e.tokens
                },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: "http://10.1.2.24/beta/back/autocomplete/contacts/%QUERY/"
        });
		 
		b.initialize();	
			$("#typeahead_example_3").typeahead(null, {
                name: "datypeahead_example_4",
                displayKey: "fullName",
                source: b.ttAdapter(),
                hint: !1
            }).bind('typeahead:selected', function(obj, selected, name) {
				$("#contact_id").val(selected.id);
			});	
	
});
</script>