<aside id="left-sidebar-nav">
	<ul id="slide-out" class="side-nav fixed leftside-navigation">
		<li class="user-details cyan darken-2">
			<div class="row">
				<div class="col col s4 m4 l4">
					<img src="<?= $avatar ?>" alt="" class="circle responsive-img valign profile-image">
				</div>
				<div class="col col s8 m8 l8">
					<ul id="profile-dropdown" class="dropdown-content">
						<li><a href="#"><i class="mdi-action-face-unlock"></i> Profile</a>
						</li>
						<li><a href="#"><i class="mdi-action-settings"></i> Settings</a>
						</li>
						<li class="divider"></li>
						<li><a href="<?= base_url('web/lock') ?>"><i class="mdi-action-lock-outline"></i> Lock</a>
						</li>
						<li><a href="<?= base_url('web/logout') ?>"><i class="mdi-action-exit-to-app"></i> Logout</a>
						</li>
					</ul>
					<a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?= $username ?><i class="mdi-navigation-arrow-drop-down right"></i></a>
					<p class="user-roal"><?= $active_role->name ?></p>
				</div>
			</div>
		</li>
		<li class="bold active"><a href="<?= base_url() ?>" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a>
		</li>
		<li class="no-padding">
			<ul class="collapsible collapsible-accordion">
				<li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-view-carousel"></i> Role</a>
					<div class="collapsible-body">
						<ul>
							<?php foreach ($role as $item) : ?>
								<li><a href="<?= base_url("web/dashboard/" . $item->url) ?>"><?= $item->name ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</li>
			</ul>
		</li>
		<li class="li-hover">
			<div class="divider"></div>
		</li>

		<li class="li-hover">
			<p class="ultra-small margin more-text">MENU</p>
		</li>
		<li class="no-padding">
			<ul class="collapsible collapsible-accordion">
				<?php foreach($group_menu as $item_group):	?>
				<li class="bold"><a class="collapsible-header waves-effect waves-cyan"><i class="<?= $item_group->icon ?>"></i>&nbsp;<?= $item_group->name ?></a>
					<div class="collapsible-body">
						<ul>
							<?php foreach ($menu as $item_menu) : ?>
                            <?php if ($item_group->id == $item_menu->id_group) : ?>
							<li><a href="<?= base_url('web' . "/" . $item_group->url . "/" . $item_menu->url_menu) ?>"><i class="<?= $item_menu->icon_menu ?>"></i><?= $item_menu->name_menu ?></a></li>
							<?php if(strlen($item_menu->name_menu)>11): ?>
								<br>
							<?php endif ?>
							<?php endif ?>
                            <?php endforeach; ?>
						</ul>
					</div>
				</li>
				<?php endforeach; ?>
			</ul>
		</li>
		<li class="bold"><a href="https://lounge.nodelabyr.my.id"><i class="mdi-communication-live-help"></i> Help</a></li>
	</ul>
	<a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
</aside>