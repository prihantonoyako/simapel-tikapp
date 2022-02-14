<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('styles') ?>
<style type="text/css">
	.input-field div.error {
		position: relative;
		top: -1rem;
		left: 0rem;
		font-size: 0.8rem;
		color: #FF4081;
		-webkit-transform: translateY(0%);
		-ms-transform: translateY(0%);
		-o-transform: translateY(0%);
		transform: translateY(0%);
	}

	.input-field label.active {
		width: 100%;
	}
</style>
<?= $this->endSection() ?>
<?= $this->section('dashboard-content') ?>
<div id="password-form-content" class="section">
	<div class="row">
		<div class="col s12 m12 l12">
			<div class="card-panel">
				<div class="row">
					<form class="formValidate" id="formValidate" method="POST" action="<?= $url_action ?>">
						<?= csrf_field() ?>
						<div class="row">
							<div class="input-field col s12">
								<label for="name">Name *</label>
								<input id="name" name="name" type="text" data-error=".errorName">
								<div class="errorName"></div>
							</div>
							<div class="input-field col s12">
								<label for="username">Username *</label>
								<input id="username" name="username" type="text" data-error=".errorUsername">
								<div class="errorUsername"></div>
							</div>
							<div class="input-field col s12">
								<label for="password">Password *</label>
								<input id="password" type="password" name="password" data-error=".errorPassword">
								<div class="errorPassword"></div>
							</div>
							<div class="input-field col s12">
								<label for="confirmationPassword">Confirm Password *</label>
								<input id="confirmationPassword" type="password" name="confirmationPassword" data-error=".errorConfirmationPassword">
								<div class="errorConfirmationPassword"></div>
							</div>
							<div class="input-field col s12">
								<a href="<?= $url_back ?>" class="btn left"><i class="mdi-navigation-arrow-back"></i> Back</a>
								<button class="btn right submit" type="submit" name="action">Submit
									<i class="mdi-content-send right"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php if (!(is_null(session()->getFlashdata('errors')) &&
	is_null(session()->getFlashdata('conflict')))) : ?>
	<div class="section">
		<div class="row">
			<div class="col s12 m12 l6">
				<div class="row">
					<div class="card-panel">
						<h4 class="header2">ERROR</h4>
						<div class="row">
							<?php if (!empty($errors)) : ?>
								<?php foreach ($errors as $field => $error) : ?>
									<div id="card-image" class="card light-blue col s12 grid-example">
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
			</div>
		</div>
	</div>
<?php endif ?>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script type="text/javascript" src="<?= base_url('materialize/v3.1/js/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('materialize/v3.1/js/plugins/jquery-validation/additional-methods.min.js') ?>"></script>
<script type="text/javascript">
	$("#formValidate").validate({
		rules: {
			name: {
				required: true,
				maxlength: 255
			},
			username: {
				required: true,
				maxlength: 255
			},
			password: {
				required: true,
				maxlength: 255
			},
			confirmationPassword: {
				required: true,
				maxlength: 255,
				equalTo: "#password"
			}
		},
		//For custom messages
		messages: {
			username: {
				required: "Enter a username",
				maxlength: "Character too long"
			},
			password: {
				required: "Enter a password",
				maxlength: "Character too long"
			}
		},
		errorElement: 'div',
		errorPlacement: function(error, element) {
			var placement = $(element).data('error');
			if (placement) {
				$(placement).append(error)
			} else {
				error.insertAfter(element);
			}
		}
	});
</script>
<?= $this->endSection() ?>