	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Employee edit</h4>
	</div>
	
	<div class="modal-body">
	<form action="<?= $employeeControllerPost ?>" method="POST"  class="form form-horizontal">
	<div class="tabbable-line boxless">
						<ul class="nav nav-tabs">
							<li class="active">
								<a href="#basic" data-toggle="tab">
								Basic </a>
							</li>
							<li>
								<a href="#permission" data-toggle="tab">
								Permission </a>
							</li>
							<li>
								<a href="#special" data-toggle="tab">
								Special Permission </a>
							</li>								
						</ul>
		</div>
		<div class="form-body">		
		<div class="tab-content">

			<div class="tab-pane active" id="basic">
				<div class="form-group form-md-line-input">
						<label class="col-md-2 control-label" for="form_control_1">Firstname</label>
						<div class="col-md-10">
						<input type="text" class="form-control" id="form_control_1" name="firstname" value="<?= $employee->firstname ?>" placeholder="Enter firstname">
						<div class="form-control-focus">
						</div>
					</div>
				</div>
				<div class="form-group form-md-line-input">
						<label class="col-md-2 control-label" for="form_control_1">Lastname</label>
						<div class="col-md-10">
						<input type="text" class="form-control" name="lastname" value="<?= $employee->lastname ?>" id="form_control_1" value="" placeholder="Enter lastname">
						<div class="form-control-focus">
						</div>
					</div>
				</div>	
				<div class="form-group form-md-line-input">
						<label class="col-md-2 control-label" for="form_control_1">Email</label>
						<div class="col-md-10">
						<input type="text" class="form-control" name="email" value="<?= $employee->email ?>" id="form_control_1" value="" placeholder="Enter email">
						<div class="form-control-focus">
						</div>
					</div>
				</div>					
			</div>
			<div class="tab-pane" id="permission">
				<div class="form-group form-md-line-input">
						<label class="col-md-2 control-label" for="form_control_1">Password</label>
						<div class="col-md-10">
						<input type="password" class="form-control" name="password" value="" id="form_control_1" placeholder="Enter new password">
						<div class="form-control-focus">
						</div>
					</div>
				</div>				
				<div class="form-group form-md-line-input">
						<label class="col-md-2 control-label" for="form_control_1">Token</label>
						<div class="col-md-10">
						<input type="text" class="form-control" name="token" value="<?= $employee->token ?>" id="form_control_1" value="" placeholder="User token">
						<div class="form-control-focus">
						</div>
					</div>
				</div>	
				<div class="form-group form-md-line-input">
						<label class="col-md-2 control-label">Groups</label>
						<div class="col-md-10">
							<select id="s_groups" name="groups[]" class="form-control select2" multiple>
								<?php foreach($groups as $group): $selected = (if_exists($employee->groups, 'id', $group->id)) ? 'selected' : false ?>
										<option value="<?= $group->id?>" <?= $selected ?>><?= $group->name ?></option>
								<?php endforeach ?>
					
							</select>
						</div>
				</div>				
			</div>
			<div class="tab-pane" id="special">
				<?php
	
				$sorted_special = array();
				foreach($special_codes_emp as $codeEmp){
					$sorted_special[$codeEmp->spec_id] = $codeEmp->command;
				}
				?>
				<?php $c = 0; $total = count($special_codes); foreach($special_codes as $code): $c++ ?>
					<?php
						foreach($special_codes_emp as $codeEmp){
							$checked = ($codeEmp->spec_id == $code->id && $codeEmp->status == 1) ? true : false;
							$command = ($checked) ? $codeEmp->command : false;
							if($checked) break;
						}

					?>
					<?php if($c == 1): ?>
						<div class="row">
					<?php endif ?>
				<div class="col-md-6">
				<div class="form-group form-md-line-input">
						<div class="row">
						<label class="col-md-3 control-label"><?= $code->name ?></label>
						<div class="col-md-2">
						<input type="checkbox" <?= (isset($checked) && ($checked)) ? 'checked' : '' ?> class="make-switch" data-size="small">
						</div>
												
							<div <?= (isset($checked) && ($checked)) ? '' : 'style="display:none"' ?> class="generate">
							<div class="col-md-5">
										<div class="input-group">
											<span class="input-group-addon">
											<i class="fa fa-key"></i>
											</span>
											<input type="text" name="permission[<?= $code->id?>][command]" value="<?= (isset($sorted_special[$code->id])) ? $sorted_special[$code->id] : false ?>" class="sp_form form-control"/>
											<input class="hidden" type="hidden" name="permission[<?= $code->id?>][status]" value="<?= (isset($checked) && !$checked) ? 0 : 1 ?>">
										</div>
							</div>
							<div class="col-md-2">
							<a href="javascript:;" class="generate_sp btn btn-icon-only blue">
															<i class="fa fa-refresh"></i>
															</a>
							</div>
						</div>
						</div>

				</div>			
				</div>
					<?php if($c == 2 || $c == $total): $c = 0;?>
						</div>
					<?php endif ?>
				<?php endforeach ?>
			

	
					
			</div>
		</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
		<button type="submit" class="btn blue">Save changes</button>
		</form>
	</div>