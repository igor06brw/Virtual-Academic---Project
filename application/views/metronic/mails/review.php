<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Mail review</h4>
</div>
<div class="modal-body">
<input type="hidden" id="c_id" value="<?= $mail['_id'] ?>">
<div class="form-group">
              <label class="control-label" for="input-name"><strong>From</strong></label>
             <div class="input-group">
			 <span class="input-group-addon">
               <i class="fa fa-user"></i>
               </span>
					<input type="text" value="<?= $mail['from'] ?>" class="form-control" disabled>
				</div>
			</div>
			<div class="form-group">
              <label class="control-label" for="input-name"><strong>To</strong></label>
             <div class="input-group">
			 <span class="input-group-addon">
               <i class="fa fa-user"></i>
               </span>
					<input type="text" value="<?= $mail['to'] ?>" class="form-control" disabled>
				</div>
			</div>

<div id="s" class="mail_box">
	
	<?= nl2br($mail['message']) ?>
</div>
<?php if(!empty($mail['attachments'])): ?>
<hr>
<h4>Attachments</h4>
<ul>
	<?php foreach($mail['attachments'] as $attachment): ?>
		<li><a target="_blank" href="<?= $attachment['url'] ?>"><?= $attachment['name'] ?></a></li>
	<?php endforeach ?>
</ul>
<?php endif ?>

</div>
<div class="modal-footer">
    <button type="button" class="btn default" data-dismiss="modal">Close</button>
	</form>
</div>

<script>
	$(document).ready(function(){
		$("#s").summernote();
	});
</script>


