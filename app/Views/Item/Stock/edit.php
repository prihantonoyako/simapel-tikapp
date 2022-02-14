<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('dashboard-content') ?>
<div class="section">
	<div class="row">
		<div class="col s12 m12 l6">
			<div class="card-panel">
				<div class="row">
					<form class="col s12" method="POST" action="<?= $url_action ?>">
						<?= csrf_field() ?>
						<div class="row">
							<div class="input-field col s12">
								<input name="name" id="name" value="<?= $itemRecord->name ?>" type="text">
								<label for="name">Name</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s6">
								<input name="vendor" id="vendor" value="<?= $itemRecord->vendor ?>" type="text" list="vendors">
								<label for="vendor">Vendor</label>
								<datalist id="vendors">
									<?php foreach ($vendor as $item) : ?>
										<option value="<?= $item->id ?>"><?= $item->name ?></option>
									<?php endforeach; ?>
								</datalist>
							</div>
							<div class="input-field col s6">
								<?php if (intval($itemRecord->is_bts) === 1) : ?>
									<input type="checkbox" id="is_bts" name="is_bts" checked="checked">
								<?php else : ?>
									<input type="checkbox" id="is_bts" name="is_bts">
								<?php endif; ?>
								<label for="is_bts">BTS</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<label for="quantity">Quantity</label>
								<input name="quantity" id="quantity" min=0 value="<?= $itemRecord->quantity ?>" type="number">
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
	</div>
</div>
<?php if(!(is_null(session()->getFlashdata('errors'))&&is_null(session()->getFlashdata('conflict')))): ?>
<div class="section">
	<div class="row">
		<div class="col s12 m12 l6">
			<div class="card-panel">
				<?php if (! is_null(session()->getFlashdata('errors'))) : ?>
				<h4 class="header2">ERROR</h4>
				<div class="row">
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
				</div>
				<div class="divider"></div>
				<?php endif ?>
				<?php if (! is_null(session()->getFlashdata('conflict'))) : ?>
				<h4 class="header2">Message</h4>
				<div class="row">
					<div id="card-alert" class="card red s12 m12 l12">
						<div class="card-content white-text">
							<p><?= session()->getFlashdata('conflict') ?></p>
						</div>
					</div>
				</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>
<?php endif ?>
<?= $this->endSection() ?>