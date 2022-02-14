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
								<input name="category" type="text" id="category" list="categories" value="<?= $transaction->category ?>">
								<label for="category">Category</label>
								<datalist id="categories">
									<?php foreach($categories as $item): ?>
										<option value="<?= $item->id ?>"><?= $item->name ?>
									<?php endforeach; ?>
								</datalist>
							</div>
							<div class="input-field col s12">
								<input name="name" type="text" id="name" value="<?= $transaction->name ?>">
								<label for="name">Name</label>
							</div>
							<div class="input-field col s12">
								<input name="ammount" type="number" min="0" step="0.01" id="ammount" value="<?= $transaction->ammount ?>">
								<label for="ammount">Ammount</label>
							</div>
							<div class="input-field col s12">
								<input type="date" class="datepicker" name="date" id="date">
								<label for="date">Date</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<a href="<?= $url_back ?>" class="btn left"><i class="mdi-navigation-arrow-back"></i>BACK</a>
								<button class="btn right" type="submit" name="action">SUBMIT<i class="mdi-content-send right"></i></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php if(!(is_null(session()->getFlashdata('errors'))&&is_null(session()->getFlashdata('conflict')))): ?>
		<div class="col s12 m12 l6">
			<div class="card-panel">
				<h4 class="header2">ERROR</h4>
				<div class="row">
				<?php if (! empty($errors)) : ?>
				<?php foreach ($errors as $field => $error) : ?>
				<div id="card-alert" class="card light-blue col s12 grid-example">
					<div class="card-content white-text">
						<span class="flow-text"><p><?= $error ?></p></span>
					</div>
				</div>
				<?php endforeach ?>
				<?php endif ?>
				</div>
				<div class="divider"></div>
				<h4 class="header2">Message</h4>
				<div class="row">
				<?php if (! empty($conflict)) : ?>
				<div id="card-alert" class="card light-blue col s12 grid-example">
					<div class="card-content white-text">
						<span class="flow-text"><p><?= $conflict ?></p></span>
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