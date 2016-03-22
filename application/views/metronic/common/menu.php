			<ul class="page-sidebar-menu page-sidebar-menu-light" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
				<li style="margin-bottom:15px" class="sidebar-search-wrapper">
				</li>
				<?php $c = 0 ; foreach($menus as $menu): $c++?>	
				<?php
				$start = ($c == 1) ? 'start ' : '';
				$active = ($menu->controller == $currentController) ? 'active ' : '';
				$href = ($menu->is_page) ? base_url() . "" . $menu->controller : 'javascript:;';
				?>
					<li class="<?= $start . $active ?>">
						<a href="<?= $href ?>">
						<i class="<?= (!empty($menu->icon)) ? $menu->icon : 'icon-docs' ?>"></i>
						<span class="title"><?= $menu->name ?></span>
						<?Php if($menu->submenu): ?> <span class="arrow "></span>
						<?Php endif ?>
						</a>
						<?php if($menu->submenu): ?>
							<ul class="sub-menu">
								<?php foreach($menu->submenu as $submenu): ?>
									<?php
									$active = ($submenu->controller == $currentController) ? 'active ' : '';
									$href = ($submenu->is_page) ? base_url() . "" . $submenu->controller : 'javascript:;';
									?>
									<li class="<?= $start . $active ?>">
									<a href="<?= $href ?>">
									<i class="<?= (!empty($submenu->icon)) ? $submenu->icon : 'icon-docs' ?>"></i>
									<span class="title"><?= $submenu->name ?></span>
									</a>
								<?php endforeach ?>
							</ul>
						<?php endif ?>
					</li>			
				<?php endforeach ?>

			</ul>