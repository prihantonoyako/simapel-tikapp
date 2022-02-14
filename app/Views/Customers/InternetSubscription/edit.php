<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('dashboard-content') ?>
<div class="section">
	<form class="col s12 m12 l12" method="POST" action="<?= $url_action ?>">
		<div class="row">
			<div class="col s12 m12 l6">
				<div class="card-panel">
					<div class="row">
						<?= csrf_field() ?>
						<h6>Internet Subscription</h6>
						<div class="divider"></div>
						<div class="row">
							<div class="input-field col s6 m6 l6">
								<input name="internet_plan" id="internet_plan" value="<?= $internet_plan->id ?>" list="internet_plans" type="text">
								<label for="internet_plan">First Name</label>
								<datalist id="internet_plans">
									<?php foreach($internet_plans as $item): ?>
										<option value="<?= $item->id ?>"><?= $item->name ?>
									<?php endforeach; ?>
								</datalist>
							</div>
							<div class="input-field col s6 m6 l6">
								<input name="root_bts" id="root_bts" value="<?= $bts->root ?>" list="rootsBts" type="text">
								<label for="root_bts">Connection</label>
								<datalist id="rootsBts">
								<?php foreach($rootsBts as $item): ?>
									<option value="<?= $item->id ?>"><?= $item->name ?>
								<?php endforeach; ?>
								</datalist>
							</div>
						</div>
						<h6>INTERNET INFORMATION</h6>
						<div class="divider"></div>
						<div class="row">
							<div class="input-field col s6 m6 l6">
								<input name="ip_address" id="ip_address" value="<?= $device->ip_address ?>" type="text">
								<label for="ip_address">IP Address</label>
							</div>
							<div class="input-field col s6 m6 l6">
								<input id="location" name="location" value="<?= $location->name ?>" type="text" disabled>
								<label for="location">Location</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<a href="<?= $url_back ?>" class="btn left"><i class="mdi-navigation-arrow-back"></i>BACK</a>
								<button class="btn right" type="submit" name="action">SUBMIT<i class="mdi-content-send right"></i></button>
							</div>
						</div>
					</div>
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
	</form>
</div>
<?= $this->endSection() ?>