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
								<input id="title" name="title" value="<?= $transaction_history->title ?>" type="text">
								<label for="title">Title</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m12 l2">
								<?php if(intval($transaction_history->is_income) === 1): ?>
									<input id="is_income" name="is_income" type="checkbox" checked>
								<?php else : ?>
									<input id="is_income" name="is_income" type="checkbox">
								<?php endif; ?>
								<input id="is_income" name="is_income" type="checkbox">
								<label for="is_income">Income</label>
							</div>
							<div class="input-field col s12 m12 l6">
								<input id="category" name="category" value="<?=  $transaction_history->category ?>" list="categories" type="text">
								<label for="category">Category</label>
								<datalist id="categories">
									<?php foreach($categories as $category): ?>
										<option value="<?= $category->id ?>"><?= $category->name ?>
									<?php endforeach; ?>
								</datalist>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m12 l12">
								<input id="ammount" name="ammount" value="<?= $transaction_history->ammount ?>" type="number" min="0">
								<label for="ammount">Ammount</label>
							</div>
							<div class="input-field col s12 m12 l12">
								<input id="date" class="datepicker" name="date" value="<?= $transaction_history->date ?>" type="date">
								<label for="date">Date</label>
							</div>
							<div class="input-field col s12 m12 l12">
								<textarea id="description" name="description" class="materialize-textarea"><?= $transaction_history->description ?></textarea>
								<label for="description">Description</label>
							</div>
						</div>
						<div class="row">
							<div class="col s12">
								<br>
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

<?= $this->section('scripts') ?>
<script type="text/javascript">
	$("#is_income").change(function() {
		$('#categories').find('option').remove();
		let is_income = 0;
		if ($(this).prop('checked')) {
			is_income = 1;
		} else {
			is_income = 0;
		}
		$.ajax({
			url: '<?= esc($ajax_transaction_categories, 'js') ?>',
			async: true,
			type: 'GET',
			headers: {
				'X-Requested-With': 'XMLHttpRequest'
			},
			data: {
				'<?= csrf_token() ?>': '<?= csrf_hash() ?>',
				is_income: is_income
			},
			dataType: 'json',
			contentType: 'application/x-www-form-urlencoded;charset-UTF-8',
			success: function(data, textStatus, jqXHR) {
				data.forEach(function(currentValue, index, arr) {
					$('#categories').append($('<option>', {
						value: currentValue.id,
						text: currentValue.name
					}));
				});
			},
			error: function(jqXHR, textStatus, errorThrown) {}
		});
	});
</script>
<?= $this->endSection() ?>