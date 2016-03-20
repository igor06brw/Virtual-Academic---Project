<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Settings</h4>
</div>
<div class="modal-body">
<div class="tabbable-line">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a href="#scheduler" data-toggle="tab"> Scheduler </a>
                                        </li>
                                        <li>
                                            <a href="#rest" data-toggle="tab"> Rest </a>
                                        </li>
                                    </ul>
<form id="form">
<div class="tab-content">
<div class="tab-pane fade active in" id="scheduler">
<hr>
<div class="row">
	<div class="col-sm-6">
		<div class="form-group">
		<label>Minute</label>
		<select name="minutes[]" style="height:350px" class="multi-select" multiple="multiple">
				<option value="*"  <?= ($cron->minutes[0] == '*') ? 'selected' : ''?>>Every</option>
				<?php for($int = 0; $int <  60; $int++):  $selected = ($cron->minutes[0] != '*' && in_array($int, $cron->minutes)) ? 'selected' : '' ?>
					<option value="<?= $int?>" <?= $selected ?>><?= $int ?></option>
				<?php endfor ?>
				</select>
		</div>
	</div>
<div class="col-sm-6">
		<div class="form-group">
		<label>Hour</label>
<select name="hours[]" style="height:350px" class="multi-select" multiple="multiple">
				<option value="*" <?= ($cron->hours[0] == '*') ? 'selected' : ''?>>Every</option>
				<?php for($int = 0; $int <  24; $int++):  $selected = ($cron->hours[0] != '*' && in_array($int, $cron->hours)) ? 'selected' : '' ?>
					<option value="<?= $int?>" <?= $selected ?>><?= $int ?></option>
				<?php endfor ?>
				</select>
		</div>
	</div>	
</div>	
<div class="row">
	<div class="col-sm-6">
				<div class="form-group">
		<label>Day of month</label>
<select name="day[]" style="height:350px" class="multi-select" multiple="multiple">
			<option value="*" <?= ($cron->day[0] == '*') ? 'selected' : ''?>>Every</option>
				<?php for($int = 0; $int <  32; $int++):  $selected = ($cron->day[0] != '*' && in_array($int, $cron->day)) ? 'selected' : '' ?>
					<option value="<?= $int?>" <?= $selected ?>><?= $int ?></option>
				<?php endfor ?>
				</select>
				</select>
		</div>
	</div>
	<div class="col-sm-6">
				<div class="form-group">
		<label>Month</label>
<select name="months[]" style="height:350px" class="multi-select" multiple="multiple">
				<option value="*" <?= ($cron->months[0] == '*') ? 'selected' : ''?>>Every</option>
				<?php for($int = 1; $int <  13; $int++):  $selected = ($cron->months[0] != '*' && in_array($int, $cron->months)) ? 'selected' : '' ?>
					<option value="<?= $int?>" <?= $selected ?>><?= $int ?></option>
				<?php endfor ?>
				</select>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-6">
				<div class="form-group">
		<label>Day of week</label>
<select name="dayweek[]" style="height:350px" class="multi-select" multiple="multiple">
				<option value="*" <?= ($cron->dayweek[0] == '*') ? 'selected' : ''?>>Every</option>
				<option value="1" <?= ($cron->dayweek[0] != '*' && in_array('1', $cron->dayweek)) ? 'selected' : ''?>>Monday</option>
				<option value="2" <?= ($cron->dayweek[0] != '*' && in_array('2', $cron->dayweek)) ?'selected' : ''?>>Tuesday</option>
				<option value="3" <?= ($cron->dayweek[0] != '*' && in_array('3', $cron->dayweek)) ?'selected' : ''?>>Wednesday</option>
				<option value="4" <?= ($cron->dayweek[0] != '*' && in_array('4', $cron->dayweek)) ?'selected' : ''?>>Thursday</option>
				<option value="5" <?= ($cron->dayweek[0] != '*' && in_array('5', $cron->dayweek)) ?'selected' : ''?>>Friday</option>
				<option value="6" <?= ($cron->dayweek[0] != '*' && in_array('6', $cron->dayweek)) ?'selected' : ''?>>Saturday</option>
				<option value="0" <?= ($cron->dayweek[0] != '*' && in_array('0', $cron->dayweek)) ?'selected' : ''?>>Sunday</option>
				</select>
		</div>
	</div>
	<div class="col-sm-6">
	</div>
</div>
<!--

!-->
<!--
<div class="col-sm-3">
	<div class="form-group">
		<label>Day of week: </label>
		<select name="dayweek[]" style="height:350px"  class="form-control" multiple="">
				<option value="*">Every</option>
				<option value="1">Monday</option>
				<option value="2">Tuesday</option>
				<option value="3">Wednesday</option>
				<option value="4">Thursday</option>
				<option value="5">Friday</option>
				<option value="6">Saturday</option>
				<option value="0">Sunday</option>
				</select>
	</div>
</div>
-->
</div>
<div class="tab-pane fade" id="rest">
<hr>

<div class="form-horizontal">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Send mail log</label>
                                                            <div class="col-md-4">
                                                               <input id="send_mail" name="send_mail" type="checkbox" <?= ($cron->send_mail) ? 'checked' : '' ?> class="make-switch" data-size="small">
                                                              
                                                            </div>
                                                        </div>
                                                        <div id="send_form" <?php if(!$cron->send_mail): ?> style="display:none" <?php endif ?> class="form-group">
                                                            <label class="col-md-3 control-label">Send to:</label>
                                                            <div class="col-md-4">
                                                               <input id="send_to" name="send_to" type="text" value="<?= $cron->mails ?>" data-role="tagsinput">
                                                              
                                                            </div>
                                                        </div>


                                                    </div>
     
                                                </div>
	
</div>
</div>
</div>

</div>
<div class="modal-footer">
    <button type="button" class="btn default" data-dismiss="modal">Close</button>
    <button type="button" data-controller="<?= base_url() . "back/cron/updateCron/" .$cron->id . "/" ?>" id="update_cron" class="btn blue">Save changes</button>
	</form>
</div>

<script>
$(document).ready(function(){
	
	if($('#send_mail').is(":checked")){
		$("#send_form").show();
	}
	
	
	$('#send_mail').on('switchChange.bootstrapSwitch', function(event, state) {
	  if(state) {
		  $("#send_form").show();
	  } else {
		  $("#send_form").hide();
	  }
	});
	
	
	
	
	$("#send_to").tagsinput();
	$("#update_cron").click(function(e){
		e.preventDefault();
		var controller = $(this).attr('data-controller');
		
		$.ajax({
			url: controller,
			method: 'POST',
			data:$("#form").serialize(),
			success: function(data){
					 $('#ajax-modal').modal('hide');
			}
		});
	});
});
</script>
