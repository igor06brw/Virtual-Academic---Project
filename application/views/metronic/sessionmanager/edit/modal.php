<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Session edit</h4>
</div>
<div class="modal-body">
														<div class="alert alert-danger display-hide">
													<button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
												<div class="alert alert-success display-hide">
													<button class="close" data-close="alert"></button> Your form validation is successful! </div>
			<div class="tabbable-custom ">
											<ul class="nav nav-tabs ">
												<li class="active">
													<a href="#tab_5_1" data-toggle="tab"> Form </a>
												</li>
											</ul>
											<div class="tab-content">
												<div class="tab-pane active" id="tab_5_1">
										<!-- BEGIN FORM-->
										<form action="#" id="form_sample_2">
									<input value="<?php if(isset($session))  echo $session->employee_id ?>" type="hidden" class="form-control" id="emp_id_form" name="employee_id" />
												<div class="form-body">
												<div class="form-group  margin-top-20">
													<label class="control-label">Session ID
														<span class="required"> * </span>
													</label>
												 
														<div class="input-icon right">
															<i class="fa form_icon"></i>
															<input value="<?php if(isset($session))  echo $session->session_id ?>" type="text" class="form-control"  name="session_id" disabled /> </div>                          
												</div>
												<div class="form-group">
													<label class="control-label">Employee
														<span class="required"> * </span>
													</label>
												   
														<div class="input-icon right">
															<i class="fa form_icon"></i>
															<input value="<?php if(isset($session))  echo $session->fullName ?>" type="text" class="form-control" id="employee_name" name="employee_name" />
														

															</div>
										 
												</div>
												<div class="form-group">
													<label class="control-label">Barcode
												
													</label>
												   
														<div class="input-icon right">
															<i class="fa form_icon"></i>
															<input value="<?php if(isset($session))  echo $session->barcode ?>" type="text" class="form-control" name="barcode" />
										 
												</div>												
											</div>
												<div class="form-group">
													<label class="control-label">Type
														<span class="required"> * </span>
													</label>
												   
														<div class="input-icon right">
															<i class="fa form_icon"></i>
															<select class="form-control" name="type" >
																<?php  foreach($types as $type): $selected = (isset($session) && $type->id == $session->type) ? 'selected' : '' ?>
																	<option value="<?= $type->id ?>" <?= $selected ?>><?= $type->name ?></option>
																<?php endforeach ?>
															</select>
										 
												</div>												
												
											</div>		
												<div class="row">
												<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">Date Start
													<span class="required"> * </span>
													</label>
												   
														<div class="input-icon right">
															<i class="fa form_icon"></i>
															
															<input value="<?php if(isset($session))   { echo date('Y-m-d', strtotime($session->date_start));  } ?>" type="text" data-date-format="yyyy-mm-dd"  class="date form-control" name="date_start" />
										 
												</div>						
												</div>
												</div>
												<div class="col-md-6">
												<div class="form-group">
													<label class="control-label"> Time
													<span class="required"> * </span>
													</label>
												   
														<div class="input-icon right">
															<i class="fa form_icon"></i>
															
															<input value="<?php if(isset($session))  echo date('H:m:s', strtotime($session->date_start)) ?>" type="text" class="time form-control" name="date_start_time" />
										 
												</div>						
												</div>												
												</div>
																								
											
												</div>
	<div class="row">
												<div class="col-md-6">
												<div class="form-group">
													<label class="control-label">Date Stop
													<span class="required"> * </span>
													</label>
												   
														<div class="input-icon right">
															<i class="fa form_icon"></i>
															
															<input value="<?php if(isset($session))   { echo date('Y-m-d', strtotime($session->date_stop));  } ?>" type="text" data-date-format="yyyy-mm-dd"  class="date form-control" name="date_stop" />
										 
												</div>						
												</div>
												</div>
												<div class="col-md-6">
												<div class="form-group">
													<label class="control-label"> Time
													<span class="required"> * </span>
													</label>
												   
														<div class="input-icon right">
															<i class="fa form_icon"></i>
															
															<input value="<?php if(isset($session))  echo date('H:m:s', strtotime($session->date_stop)) ?>" type="text" class="time form-control" name="date_stop_time" />
										 
												</div>						
												</div>												
												</div>
														</div>	
													<div class="form-group">
													<label class="control-label"> Finish Qty
								
													</label>
												   
														<div class="input-icon right">
															<i class="fa form_icon"></i>
															<input value="<?php if(isset($session)) echo $session->finish ?>" type="text" name="finish" class="qty form-control"  />
										 
												</div>						
												</div>																							
													<div class="form-group">
													<label class="control-label"> Status
													<span class="required"> * </span>
													</label>
												   
														<div class="input-icon right">
															<i class="fa form_icon"></i>
															<select  name="status" class="form-control" >
																<?php 
																	$ongoing = (isset($session) && $session->status == 0) ? 'selected' : '' ;
																	$finished = (isset($session) && $session->status == 1) ? 'selected' : '' ;
																?>
																<option value="0" <?= $ongoing ?>>Ongoing</option>
																<option value="1"<?= $finished ?>>Finished</option>
															</select>
										 
												</div>						
												</div>											
											
									
									   </form> 
												</div>
											</div>

						   
									  
										<!-- END FORM-->
			</div>

	</div>
<div class="modal-footer">
    <button type="button" class="btn default" data-dismiss="modal">Close</button>
    <button type="button" onclick="$('#form_sample_2').submit()" class="btn blue">Save changes</button>
	</form>
</div>

<script>
	$(document).ready(function(){
			var form2 = $('#form_sample_2');
            var error2 = $('.alert-danger');
            var success2 = $('.alert-success');
			function formSubmit(){
				$.ajax({
					url: '<?= base_url() . 'back/sessionmanager/edit/' . $session->session_id . '/' ?>',
					method: 'POST',
					data: form2.serialize(),
					complete: function(){
							$('#ajax-modal').modal('hide');
					}
				});
			}

            form2.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                rules: {
                    finish: {
						number:true
                    },
					employee_name:{
						required:true
					},
					barcode:{
						required:true
					},
					type:{
						required:true
					},
					date_start_time:{
						required: true
					},
					date_stop_time:{
						required: true
					},
					status:{
						required:true
					}
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success2.hide();
                    error2.show();
                    //Metronic.scrollTo(error2, -200);
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    var icon = $(element).closest('.input-icon').find('i');
					icon.removeClass('fa-check').addClass("fa-warning");  
                    icon.attr("data-original-title", error.text()).tooltip({'container': '.modal-body'});
					
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group   
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    
                },

                success: function (label, element) {
                    var icon = $(element).closest('.input-icon').find('i');
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    icon.removeClass("fa-warning").addClass("fa-check");
                },

                submitHandler: function (form) {
                    success2.show();
                    error2.hide();
                    formSubmit();
                }
            }); 
			
			
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
		
		$("#employee_name").typeahead(null, {
                name: "datypeahead_example_3",
                displayKey: "value",
                source: a.ttAdapter(),
				append: '.modal-body',
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
				$("#emp_id_form").val(selected.employee_id);
			});
			
		$("input[name='barcode']").typeahead(null, {
                name: "datypeahead_example_4",
                displayKey: "value",
                source: b.ttAdapter(),
                hint: !1
            })
			
			$('.date').datepicker({
			});
			$(".qty").TouchSpin({
            verticalbuttons: !0
        })
			$('.time').timepicker({
                autoclose: !0,
                showSeconds: !0,
                minuteStep: 1,
				secondStep: 1,
				showMeridian: !1
            })
	});
</script>