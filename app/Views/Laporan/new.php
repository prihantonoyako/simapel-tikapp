<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('dashboard-content') ?>
<div id="basic-form" class="section">
	<div class="row">
		<div class="col s12 m12 l6">
			<div class="card-panel">
				<div class="row">
					<form class="col s12" method="POST" action="<?= $url_action ?>">
					<?= csrf_field() ?>
						<div class="row">
							<div class="input-field col s12">
								<input name="category" type="text" id="category" list="categories">
								<label for="category">Category</label>
								<datalist id="categories">
									<?php foreach($categories as $item): ?>
										<option value="<?= $item->id ?>"><?= $item->name ?>
									<?php endforeach; ?>
								</datalist>
							</div>
							<div class="input-field col s12">
								<input name="name" type="text" id="name">
								<label for="name">Name</label>
							</div>
							<div class="input-field col s12">
								<input name="ammount" type="number" min="0" step="0.01" id="ammount">
								<label for="ammount">Ammount</label>
							</div>
							<div class="input-field col s12">
								<input type="date" class="datepicker" name="date" id="date">
								<label for="date">Date</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<a href="<?= $url_back ?>" class="btn cyan left"><i class="mdi-navigation-arrow-back"></i>BACK</a>
								<button class="btn cyan right" type="submit" name="action">SUBMIT<i class="mdi-content-send right"></i></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php if (!(is_null(session()->getFlashdata('errors')) && is_null(session()->getFlashdata('conflict')))) : ?>
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
						<?php if (!empty(session()->getFlashdata('conflict'))) : ?>
							<div id="card-alert" class="card light-blue col s12 grid-example">
								<div class="card-content white-text">
									<span class="flow-text">
										<p><?= $session()->getFlashdata('conflict') ?></p>
									</span>
								</div>
							</div>
						<?php endif ?>
					</div>
				</div>
			</div>
			<?php endif; ?>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript">
$(document).ready(function() {
	$('#check-icon-availability').click(function() {
		let newIcon = $('#icon').val();
		let oldIcon = $('#icon-preview').attr('class');
		$('#icon-preview').removeClass(oldIcon).addClass(newIcon);
	});
});
// </script>
<?= $this->endSection() ?>