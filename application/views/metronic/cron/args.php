<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title"><?= $cron->name ?></h4>
</div>
<div class="modal-body">
<div class="alert alert-info">
                                        <strong>Info!</strong>  Here you can run this job with custom args. </div>

<form id="custom_args">
	<div class="row">
	<div class="col-sm-12 col-md-12 col-lg-12">
	<?php foreach($cron->args as $arg): ?>
		<div class="form-group">
			<label><?= $arg->label ?></label>
			<input type="<?= $arg->type ?>" name="<?= $arg->name?>" value="" class="<?= $arg->class ?> form-control">
		</div>
	<?php endforeach ?>
	</div>
</form>
</div>
<div class="modal-footer">
    <button type="button" class="btn default" data-dismiss="modal">Close</button>
    <button data-controller="<?= base_url() . "back/cron/runCron/" .$cron->id . "/" ?>" type="button" id="run" class="btn blue">Run!</button>
	</form>
</div>

<script>
$(document).ready(function(){
	$("#run").click(function(e){
		e.preventDefault();
		var controller = $(this).attr('data-controller');
		
		$.ajax({
			url: controller,
			method: 'POST',
			data:$("#custom_args").serialize(),
			success: function(data){
				 $('#ajax-modal').modal('hide');
				 location.reload();
			}
		});
	});
	
	$(".date_class").datepicker();
});
</script>
