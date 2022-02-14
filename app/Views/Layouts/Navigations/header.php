<header id="header" class="page-topbar">
	<!-- start header nav-->
	<div class="navbar-fixed">
		<nav class="navbar-color">
			<div class="nav-wrapper">
				<ul class="left">
					<li>
						<h1 class="logo-wrapper"><a href="<?= site_url() ?>" class="brand-logo darken-1"><img src="<?= base_url('images/company-brand-white.png') ?>" alt="NODELABYR LOGO"></a> <span class="logo-text">SIMAPEL-TIKAPP</span></h1>
					</li>
				</ul>
				<div class="header-search-wrapper hide-on-med-and-down">
				<form action="<?= $searchRecord ?>">
					<i class="mdi-action-search"></i>
					<input type="search" name="q" class="header-search-input z-depth-2" placeholder="Search content ....">
				</form>                
				</div>
				<ul class="right hide-on-med-and-down">
					<li><a href="javascript:void(0);" class="waves-block translation-button" data-activates="translation-dropdown"><img src="<?= base_url('images/flag-icons/United-States.png') ?>" alt="USA"></a></li>
					<li><a href="javascript:void(0);" class="waves-block toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a></li>
					<li><a href="javascript:void(0);" class="waves-effect waves-block notification-button" data-activates="notifications-dropdown"><i class="mdi-social-notifications"><small class="notification-badge">5</small></i></a></li>
					<!-- <li><a href="#" data-activates="chat-out" class="waves-effect waves-block waves-light chat-collapse"><i class="mdi-communication-chat"></i></a>
					</li> -->
				</ul>
				<!-- translation-button -->
				<ul id="translation-dropdown" class="dropdown-content">
					<li>
						<a href="#!"><img src="<?= base_url('images/flag-icons/United-States.png') ?>" alt="English"> <span class="language-select">English</span></a>
					</li>
					<li>
						<a href="#!"><img src="<?= base_url('images/flag-icons/Indonesia.png') ?>" alt="Indonesia"> <span class="language-select">Indonesia</span></a>
					</li>

				</ul>
				<!-- notifications-dropdown -->
				<ul id="notifications-dropdown" class="dropdown-content">
					<li>
						<h5>NOTIFICATIONS <span class="new badge"><?= count($notifications) ?></span></h5>
					</li>
					<li class="divider"></li>
					<?php foreach($notifications as $item): ?>
					<li>
						<a href="<?= base_url('web/notification') ?>">
							<i class="<?= $item->icon ?>"></i>&nbsp;<?= $item->message ?>
						</a>
						<time class="media-meta" datetime="<?= $item->created_at ?>"><?= $item->created_at ?></time>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</nav>
	</div>
	<!-- end header nav-->
</header>