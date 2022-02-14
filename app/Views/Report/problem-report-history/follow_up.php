<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<div id="basic-form" class="section">
	<form class="col s12" method="POST" action="<?= $url_action ?>">
		<?= csrf_field() ?>
		<div class="row">
			<div class="col s12 m12 l12">
				<div class="card-panel">
					<div class="row">
						<h6>Problem Report</h6>
						<div class="divider"></div>
						<div class="input-field col s12 m6 l4">
							<h6>Problem Ticket: <?= $problem->ticket ?></h6>
							<h6>Current PIC: <?= $current_pic->username . "/" . $current_pic->email ?></h6>
						</div>
						<input id="problem_report" name="problem_report" value="<?= $problem->id ?>" type="text" hidden>
					</div>
					<br>
					<div class="row">
						<h6>Log Information</h6>
						<div class="divider"></div>
						<div class="input-field col s12 m6 l4">
							<input id="title" name="title" value="<?= old('title') ?>" type="text">
							<label for="title">Title</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m6 l12">
							<textarea id="description" name="description" class="materialize-textarea"><?= old('description') ?></textarea>
                          <label for="description">Description</label>
					</div>
					</div>
					<div class="row">
						<h6>PIC</h6>
						<div class="divider"></div>
						<div class="input-field col s12 m6 l4">
							<input id="user" name="user" type="text" list="users" value="<?= old('user') ?>">
							<label for="user">User</label>
							<datalist id="users">
								<?php foreach ($users_available as $user) : ?>
									<option value="<?= $user->id ?>"><?= $user->username ?></option>
								<?php endforeach; ?>
							</datalist>
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
	</form>
</div>
<?php if (!(is_null(session()->getFlashdata('errors')) &&
	is_null(session()->getFlashdata('conflict')))) : ?>
	<div class="col s12 m12 l6">
		<div class="row">
			<div class="card-panel">
				<h4 class="header2">ERROR</h4>
				<div class="row">
					<?php if (!empty(session()->getFlashdata('errors'))) : ?>
						<?php foreach (session()->getFlashdata('errors') as $field => $error) : ?>
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
<?php endif ?>
</div>
<?= $this->endSection() ?>