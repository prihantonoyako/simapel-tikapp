<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('dashboard-content') ?>
<div class="section">
	<div class="row">
		<div class="col s12 m12 l6">
			<div class="card-panel">
				<form method="POST" action="<?= $url_action ?>">
					<div class="row">
						<?= csrf_field() ?>
						<h6>CUSTOMER INFORMATION</h6>
						<div class="divider"></div>
						<div class="row">
							<div class="input-field col s6 m6 l6">
								<input name="first_name" id="first_name" value="<?= $customer->first_name ?>" type="text">
								<label for="first_name">First Name</label>
							</div>
							<div class="input-field col s6 m6 l6">
								<input name="last_name" id="last_name" value="<?= $customer->last_name ?>" type="text">
								<label for="last_name">Last Name</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input name="email" id="email" value="<?= $customer->email ?>" type="text">
								<label for="email">Email</label>
							</div>
						</div>
						<div class="row">
							<?php if (intval($customer->active) == 1) : ?>
								<div class="switch">
									Active : <label>Off<input type="checkbox" name="active" checked><span class="lever"></span> On</label>
								</div>
							<?php else : ?>
								<div class="switch">
									Active : <label>Off<input type="checkbox" name="active"><span class="lever"></span> On</label>
								</div>
							<?php endif; ?>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<a href="<?= $url_back ?>" class="btn left"><i class="mdi-navigation-arrow-back"></i>BACK</a>
								<button class="btn right" type="submit" name="action">SUBMIT<i class="mdi-content-send right"></i></button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<?php if (!(is_null(session()->getFlashdata('errors')) && is_null(session()->getFlashdata('conflict')))) : ?>
			<div class="col s12 m12 l6">
				<div class="card-panel">
					<h4 class="header2">ERROR</h4>
					<div class="row">
						<?php if (!empty($errors)) : ?>
							<?php foreach ($errors as $field => $error) : ?>
								<div id="card-alert" class="card light-blue col s12 grid-example">
									<div class="card-content white-text">
										<span class="flow-text">
											<p><?= $error ?></p>
										</span>
									</div>
								</div>
							<?php endforeach ?>
						<?php endif ?>
					</div>
					<div class="divider"></div>
					<h4 class="header2">Message</h4>
					<div class="row">
						<?php if (!empty($conflict)) : ?>
							<div id="card-alert" class="card light-blue col s12 grid-example">
								<div class="card-content white-text">
									<span class="flow-text">
										<p><?= $conflict ?></p>
									</span>
								</div>
							</div>
						<?php endif ?>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
<?= $this->endSection() ?>