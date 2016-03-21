	<style>
	.popover{
		max-width: 100%;
	}
	.portlet > .portlet-title > .actions {
    float: left !important;
}
.actions{
	margin-left: 13px;
}
.portlet.light > .portlet-title > .actions {
    padding: 1px 0 14px 0;
	
	
}
	</style>
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
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
				<!-- BEGIN PORTLET-->
                            
							<div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-bar-chart font-green"></i> Test
                                        <span class="caption-subject font-green bold uppercase"></span>
                                        <span class="caption-helper"></span>
                                    </div>
					
 

                                </div>
							<div class="portlet-body">
                              
							  
							  <p>Hello world - changes</p>

								<p>Changes from dev-BRANCHTEST</p>

								<p>Dev Branch</p>
                    
                            
                            </div>
							</div>
                            <!-- END PORTLET-->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->


