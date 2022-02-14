<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('styles') ?>
<link href="<?= base_url('css/materialize/v3.1/plugins/dropify.css') ?>" type="text/css" rel="stylesheet" media="screen,projection">
<style type="text/css">
	.input-field div.error{
    position: relative;
    top: -1rem;
    left: 0rem;
    font-size: 0.8rem;
    color:#FF4081;
    -webkit-transform: translateY(0%);
    -ms-transform: translateY(0%);
    -o-transform: translateY(0%);
    transform: translateY(0%);
  }
  .input-field label.active{
      width:100%;
  }
</style>
<?= $this->endSection() ?>
<?= $this->section('dashboard-content') ?>
<div id="password-form-content" class="section">
	<div class="row">
		<div class="col s12 m12 l6">
			<div class="card-panel">
				<!--add .right-alert to show messages right side-->
				<div class="row">
					<form class="formValidate" id="formValidate" method="POST" action="<?= $url_action ?>" enctype='multipart/form-data'>
						<?= csrf_field() ?>
						<div class="row">
							<div class="input-field col s12">
								<label for="username">Username *</label>
								<input id="username" name="username" type="text" data-error=".errorUsername">
								<div class="errorUsername"></div>
							</div>
							<div class="input-field col s12">
								<label for="password">Password *</label>
								<input id="password" type="password" name="password" autocomplete="on" data-error=".errorPassword">
								<div class="errorPassword"></div>
							</div>
							<div class="input-field col s12">
								<label for="confirmationPassword">Confirm Password *</label>
								<input id="confirmationPassword" type="password" name="confirmationPassword" autocomplete="on" data-error=".errorConfirmationPassword">
								<div class="errorConfirmationPassword"></div>
							</div>
							<div class="input-field col s12">
								<label for="email">Email *</label>
								<input id="email" name="email" type="email" data-error=".errorEmail">
								<div class="errorEmail"></div>
							</div>
							<div class="col s12">
							<div class="switch">
								Active : <label>Off<input type="checkbox" name="active"><span class="lever"></span> On</label>
							</div>
						</div>
							<div class="col s12 m4 l3">
								<p>Profile</p>
							</div>
							<div class="col s12 m8 l9">
								<p>Maximum file upload size 2MB.</p>
								<input type="file" name="avatar" id="input-file-max-fs" class="dropify" data-max-file-size="2M">
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
		<?php if(!(is_null(session()->getFlashdata('errors'))&&
			is_null(session()->getFlashdata('conflict')))): ?>
		<div class="col s12 m12 l6">
			<div class="card-panel">
				<h4 class="header2">ERROR</h4>
				<div class="row">
				<?php if (! is_null(session()->getFlashdata('errors'))) : ?>
				<div class="col s12 m12 l12">
					<ul class="collapsible collapsible-accordion" data-collapsible="expandable">
						<?php foreach (session()->getFlashdata('errors') as $field => $error) : ?>
						<li>
							<div class="collapsible-header "><?= strtoupper($field) ?></div>
							<div class="collapsible-body"><p><?= $error ?></p></div>
						</li>
						<?php endforeach ?>
					</ul>
				</div>
				<?php endif ?>
				</div>
				<div class="divider"></div>
				<h4 class="header2">Message</h4>
				<div class="row">
					<?php if (! is_null(session()->getFlashdata('conflict'))) : ?>
					<div id="card-alert" class="card red s12 m12 l12">
						<div class="card-content white-text">
							<p><?= session()->getFlashdata('conflict') ?></p>
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
<?= $this->section('scripts') ?>
<script type="text/javascript" src="<?= base_url('js/materialize/v3.1/plugins/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('js/materialize/v3.1/plugins/additional-methods.min.js') ?>"></script>
<!-- dropify -->
<script type="text/javascript" src="<?= base_url('js/materialize/v3.1/plugins/dropify.min.js')?>"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('.dropify').dropify();
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
});
</script>
<?= $this->endSection() ?>