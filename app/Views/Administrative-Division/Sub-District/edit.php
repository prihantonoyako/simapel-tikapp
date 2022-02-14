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
								<input id="province" name="province" value="<?= $subdistrict->province ?>" type="text" list="provinces">
								<label for="province">Province</label>
								<datalist id="provinces" style="display:none;">
									<?php foreach ($provinces as $province) : ?>									
										<option value="<?= $province->id ?>"><?= $province->name ?></option>
									<?php endforeach; ?>
								</datalist>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input name="city" id="city" type="text" value="<?= $subdistrict->city ?>" list="cities">
								<label for="cities">City</label>
								<datalist id="cities">
									<?php foreach($cities as $city): ?>
										<option value="<?= $city->id ?>"><?= $city->name ?>
									<?php endforeach; ?>
								</datalist>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="district" name="district" type="text" value="<?= $subdistrict->district ?>" list="districts">
								<label for="district">District</label>
								<datalist id="districts">
									<?php foreach($districts as $district): ?>
										<option value="<?= $district->id ?>"><?= $district->name ?>
									<?php endforeach; ?>
								</datalist>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="name" name="name" type="text" value="<?= $subdistrict->name ?>">
								<label for="name">Name</label>
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

<?= $this->section('scripts') ?>
<script type="text/javascript">
$("#province").on("input", function() {
		let provinceName = $(this).val();
		if ($('#provinces option').filter(function() {
				return $(this).val().toUpperCase() === provinceName.toUpperCase();
			}).length) {
			$('#cities').find('option').remove();
			$.ajax({
				url: '<?= esc($ajax_city, 'js') ?>',
				async: true,
				type: 'GET',
				headers: {'X-Requested-With': 'XMLHttpRequest'},
				data: {
					'<?= csrf_token() ?>':'<?= csrf_hash() ?>',
					id: $('#province').val()
				},
				dataType: 'json',
				contentType: 'application/x-www-form-urlencoded;charset-UTF-8',
				success: function(data,textStatus,jqXHR) {
					data.forEach(function(currentValue,index,arr) {
						$('#cities').append($('<option>',{
							value: currentValue.id,
							text: currentValue.name
						}));
					});
					$('#city').removeAttr('disabled');
				},
				error: function(jqXHR,textStatus,errorThrown) {
				}
			});
		}
	});

	$("#city").on("input", function() {
		let cityName = $(this).val();
		if ($('#cities option').filter(function() {
				return $(this).val().toUpperCase() === cityName.toUpperCase();
			}).length) {
			$('#districts').find('option').remove();
			$.ajax({
				url: '<?= esc($ajax_district, 'js') ?>',
				type: 'GET',
				headers: {'X-Requested-With': 'XMLHttpRequest'},
				data: {
					'<?= csrf_token() ?>': '<?= csrf_hash() ?>',
					id: $('#city').val(),
				},
				contentType: 'application/x-www-form-urlencoded;charset-UTF-8',
				dataType: 'json',
				success: function(data,textStatus,jqXHR) 
				{
					data.forEach(function(currentValue,index,arr) {
						$('#districts').append($('<option>',{
							value:currentValue.id,
							text:currentValue.name
						}));
					});
					$('#district').removeAttr('disabled');
				},
				error: function(jqXHR,textStatus,errorThrown) 
				{
				}
			});
		}
	});
</script>
<?= $this->endSection() ?>