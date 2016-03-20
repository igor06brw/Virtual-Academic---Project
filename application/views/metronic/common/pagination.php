							<div>						
								<ul class="pagination">
										<li>
											<a href="<?=  $prevURL ?>">
											<i class="fa fa-angle-left"></i>
											</a>
										</li>
										<?php for($int = 1; $int <= $pages; $int++): ?>
										<?php
										$href = ($int == $currentPage) ? 'javascript:;' : $controllerURL . $int . "/";
										$active =  ($int == $currentPage) ? 'active': '';
										?>
										<li class="<?= $active ?>">
											<a href="<?= $href ?>">
											<?= $int ?> </a>
										</li>
										<?php endfor ?>
										<li>
											<a href="<?=  $nextURL ?>">
											<i class="fa fa-angle-right"></i>
											</a>
										</li>
									</ul>
								</div>