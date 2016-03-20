<?php if(isset($crons) && !empty($crons)): $all = count($crons);?>
<?php $c = 0; $c2 = 0; foreach($crons as $cron): $c++; $c2++ ?>
<?php if($c == 1): ?>
<div class="row">
<?php endif ?>


						<div class="col-sm-3">
							<!-- Begin: life time stats -->
							<div class="cron_job portlet light">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-eye"></i> <?= $cron->name ?>
									</div>
									<div style="margin-top:10px" class="status">
									 <?php if($cron->status == 2): ?>
										<span class="pull-right badge badge-warning"> RUNNING </span>
									<?php endif ?>
									 <?php if($cron->status == 1): ?>
										<span class="pull-right badge badge-info"> IDLE </span>
									<?php endif ?>									
									</div>
								</div>
								<div class="portlet-body">
									<div class="desc">
										<p><?= $cron->description ?></p>
										<hr>
										<div class="date">Ostatnio uruchomienio <?= $cron->date_start ?>.</div>
										<div class="date">Nastepne uruchomienie <?= ($cron->next) ? date('Y-m-d H:i:s', $cron->next) : '----' ?>.</div>
									</div>
									<div class="options">
										<hr>
										 <?php if($cron->status == 2): ?>
											<a href="javascript:;" class="btn btn-icon-only default" disabled><i class="fa fa-play"></i></a>
											<?php if($cron->args): ?> <a href="javascript:;" class="btn btn-primary btn-icon-only default" disabled><i class="fa fa-play"></i></a> <?php endif ?>
											<a href="<?= $cron->kill ?>" class="btn btn-icon-only default"><i class="fa fa-stop"></i></a>
										 <?php endif ?>
										 <?php if($cron->status == 1): ?>
											<a href="<?= $cron->run ?>" class="btn btn-icon-only default"><i class="fa fa-play"></i></a>
											<?php if($cron->args): ?> <a href="javascript:;" data-cron-id="<?= $cron->id ?>" class="run_with_args btn btn-primary btn-icon-only"><i class="fa fa-play"></i></a> <?php endif ?>
											<a href="javascript:;" class="btn btn-icon-only default" disabled><i class="fa fa-stop"></i></a>
										 <?php endif ?>										 
										<a data-id="<?= $cron->id ?>" href="javascript:;" class="pull-right btn btn-icon-only default cron_settings"><i class="fa fa-cogs"></i></a>

									</div>
								</div>
							</div>
						</div>
						
				
						<!-- End: life time stats -->
<?php if($c == 4 || $c2 == $all): $c = 0;?>
</div>
<?php endif ?>
<?php endforeach ?>
<?php endif ?>