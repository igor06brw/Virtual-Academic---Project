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
				<div id="ajax-modal" class="modal fade container modal-scroll" data-replace="true" tabindex="-1"> </div>
			<div class="row">
				<div class="col-md-12">
				

					<div id="returnAjax"></div>
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
		var $modal = $('#ajax-modal');
		function refreshList(){
			$.ajax({
				url: 'http://10.1.2.24/beta/back/cron/getList',
				method: 'GET',
				beforeSend: function(){
					
				},
				success:function(data){
					$("#returnAjax").html(data);
					App.init(); 
					$(".cron_settings").click(function(e){
						e.preventDefault();
						var id = $(this).attr('data-id');
						var url = 'http://10.1.2.24/beta/back/cron/getSettings/' + id + '/';
						$modal.load(url, '', function(){
						  $modal.modal();
						  $(".multi-select").multiSelect();
						});

					});
					$(".run_with_args").click(function(e){
						e.preventDefault();
						var cron_id = $(this).attr('data-cron-id');
						var url = 'http://10.1.2.24/beta/back/cron/getArgs/' + cron_id + '/';
						$modal.load(url, '', function(){
						  $modal.modal();
						});
					});
					
					
				}
			});
		}
		refreshList();
		var myVar = setInterval(refreshList, 3000);
	});
</script>
