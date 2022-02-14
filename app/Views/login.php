<?= $this->extend('Layouts/auth') ?>
<?= $this->section('content') ?>
<div id="login-page" class="row">
		<div class="col s12 z-depth-4 card-panel">
			<form class="login-form" method="POST" action="<?= current_url() ?>">
			<?= csrf_field() ?>
				
				<?php if(!is_null(session()->getFlashdata('errors'))): ?>
				<div class="row">
					<?php foreach(session()->getFlashdata('errors') as $field=>$error): ?>
					<div class="col s12 m12 l12">
					<div id="card-alert" class="card red">
                      <div class="card-content white-text">
                        <p><?= $field ." : ". $error ?></p>
                      </div>
                    </div>
					</div>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
				<div class="row">
					<div class="input-field col s12 center">
						<img src="<?= base_url('images/brand-logo.png') ?>" alt="" class="circle responsive-img valign profile-image-login">
						<p class="center login-form-text">SIMAPEL-TIKAPP Premier Suite</p>
					</div>
				</div>
				<div class="row margin">
					<div class="input-field col s12">
						<i class="mdi-social-person-outline prefix"></i>
						<input id="username" name="username" type="text">
						<label for="username" class="center-align">Username</label>
					</div>
				</div>
				<div class="row margin">
					<div class="input-field col s12">
						<i class="mdi-action-lock-outline prefix"></i>
						<input id="password" name="password" type="password" autocomplete="on">
						<label for="password">Password</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12 m12 l12  login-text">
						<input type="checkbox" name="remember-me" id="remember-me">
						<label for="remember-me">Remember me</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<button type="submit" class="btn col s12">Login</button>
					</div>
				</div>
			</form>
		</div>
</div>
<?= $this->endSection() ?>