<?= $this->extend('Layouts/dashboard') ?>
<?= $this->section('dashboard-content') ?>
<div id="basic-form" class="section">
	<div class="row">
		<div class="col s12 m12 l12">
			<div class="card-panel">
				<div class="row">
					<form class="col s12" method="POST" action="<?= $url_action ?>">
						<?= csrf_field() ?>
						<div class="row">
							<div class="input-field col s3">
								<input id="name" name="name" value="<?= $bts->name ?>" type="text">
								<label for="name">Name</label>
							</div>
							<div class="input-field col s3">
								<input id="password" name="password" value="<?= $bts->password ?>" list="passwords" type="text">
								<label for="name">Password</label>
								<datalist id="passwords">
									<?php foreach($passwords as $password): ?>
									<option value="<?= $password->id ?>"><?= $password->name ?>
									<?php endforeach; ?>
								</datalist>
							</div>
							<div class="input-field col s12 m6 l3">
								<input id="ip_address" name="ip_address" value="<?= $device->ip_address ?>" type="text">
								<label for="ip_address">IP Address</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6 l3">
								<input id="province_conn" name="province_conn" value="<?= old('province_conn') ?>" list="provinces" type="text">
								<label for="province_conn">Root's Province</label>
							</div>
							<div class="input-field col s12 m6 l3">
								<input id="city_conn" name="city_conn" value="<?= old('city_conn') ?>" list="cities" type="text">
								<label for="city_conn">Root's City</label>
							</div>
							<div class="input-field col s12 m6 l3">
								<input id="root" name="root" value="<?= $bts->root ?>" list="roots" type="text">
								<label for="root">Root</label>
								<datalist id="roots">
									<?php foreach ($baseTransceiverStations as $item) : ?>
										<option value="<?= $item->id ?>"><?= $item->name ?></option>
									<?php endforeach; ?>
								</datalist>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6 l3">
								<input id="band" name="band" value="<?= $bts->band ?>" list="bands" type="text">
								<label for="band">Band</label>
								<datalist id="bands">
									<?php foreach ($band as $item) : ?>
										<option value="<?= $item ?>"></option>
									<?php endforeach; ?>
								</datalist>
							</div>
							<div class="input-field col s12 m6 l3">
								<input id="wireless_protocol" name="wireless_protocol" value="<?= $bts->wireless_protocol ?>" list="wireless_protocols" type="text">
								<label for="wireless_protocol">Wireless Protocol</label>
								<datalist id="wireless_protocols">
									<?php foreach ($protocol as $item) : ?>
										<option value="<?= $item ?>"></option>
									<?php endforeach; ?>
								</datalist>
							</div>
							<div class="input-field col s12 m6 l3">
								<input id="channel_width" name="channel_width" value="<?= $bts->channel_width ?>" type="text" list="channels_width">
								<label for="channel_width">Channel Width</label>
								<datalist id="channels_width"></datalist>
							</div>
							<div class="input-field col s12 m6 l3">
								<input id="frequency" name="frequency" value="<?= $bts->frequency ?>" type="text" list="frequencies">
								<label for="frequency">Frequency</label>
								<datalist id="frequencies"></datalist>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m6 l3">
								<input id="province" name="province" value="<?= old('province') ?>" list="provinces" type="text">
								<label for="province">Province</label>
								<datalist id="provinces">
									<?php foreach($provinces as $province): ?>
										<option value="<?= $province->id ?>"><?= $province->name ?>
									<?php endforeach; ?>
								</datalist>
							</div>
							<div class="input-field col s12 m6 l3">
								<input id="city" name="city" value="<?= old('city') ?>" list="cities" type="text">
								<label for="city">City</label>
								<datalist id="cities">
									<?php foreach($cities as $city): ?>
										<option value="<?= $city->id ?>"><?= $city->name ?>
									<?php endforeach; ?>
								</datalist>
							</div>
							<div class="input-field col s12 m6 l3">
								<input id="district" name="district" value="<?= old('district') ?>" list="districts" type="text">
								<label for="district">District</label>
								<datalist id="districts">
									<?php foreach($districts as $district): ?>
										<option value="<?= $district->id ?>"><?= $district->name ?>
									<?php endforeach; ?>
								</datalist>
							</div>
							<div class="input-field col s12 m6 l3">
								<input id="subdistrict" name="subdistrict" value="<?= old('subdistrict') ?>" list="subdistricts" type="text">
								<label for="subdistrict">Subdistrict</label> 
								<datalist id="subdistricts">
									<?php foreach($subdistricts as $subdistrict): ?>
										<option value="<?= $subdistrict->id ?>"><?= $subdistrict->name ?>
									<?php endforeach; ?>
								</datalist>
							</div>
						</div>
						<div class="row">
						<div class="input-field col s12 m6 l3">
								<input id="location" name="location" value="<?= $bts->location ?>" list="locations" type="text">
								<label for="locations">Location</label>
								<datalist id="locations">
									<?php foreach($locations as $item): ?>
										<option value="<?= $item->id ?>"><?= $item->name ?>
									<?php endforeach; ?>
								</datalist>
							</div>	
						<?php if (intval($bts->active) === 1) : ?>
							<div class="switch col s12 m6 l3">
								Active : <label>Off<input type="checkbox" name="active" checked><span class="lever"></span> On</label>
							</div>
							<?php else : ?>
							<div class="switch col s12 m6 l3">
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
	$.ajax({
		url: '<?= esc($ajax_wireless_channel, 'js') ?>',
		type: 'GET',
		headers: {
			'X-Requested-With': 'XMLHttpRequest'
		},
		data: {
			'<?= csrf_token() ?>': '<?= csrf_hash() ?>',
			band: $('#band').val()
		},
		contentType: 'application/x-www-form-urlencoded;charset-UTF-8',
		dataType: 'json',
		success: function(data, textStatus, jqXHR) {
			data.forEach(function(currentValue, index, arr) {
				$('#channels_width').append($('<option>', {
					value: currentValue
				}));
			});
		},
		error: function(jqXHR, textStatus, errorThrown) {}
	});
	$.ajax({
		url: '<?= esc($ajax_wireless_frequency, 'js') ?>',
		type: 'GET',
		headers: {
			'X-Requested-With': 'XMLHttpRequest'
		},
		data: {
			'<?= csrf_token() ?>': '<?= csrf_hash() ?>',
			band: $('#band').val(),
			channel_width: $('#channel_width').val()
		},
		contentType: 'application/x-www-form-urlencoded;charset-UTF-8',
		dataType: 'json',
		success: function(data, textStatus, jqXHR) {
			data.forEach(function(currentValue, index, arr) {
				$('#frequencies').append($('<option>', {
					value: currentValue
				}));
			});
		},
		error: function(jqXHR, textStatus, errorThrown) {}
	});
	$("#band").on("input", function() {
		let bandName = $(this).val();

		if ($('#bands option').filter(function() {
				return $(this).val().toUpperCase() === bandName.toUpperCase();
			}).length) {
			$('#channels_width').find('option').remove();
			$.ajax({
				url: '<?= esc($ajax_wireless_channel, 'js') ?>',
				type: 'GET',
				headers: {
					'X-Requested-With': 'XMLHttpRequest'
				},
				data: {
					'<?= csrf_token() ?>': '<?= csrf_hash() ?>',
					band: $('#band').val()
				},
				contentType: 'application/x-www-form-urlencoded;charset-UTF-8',
				dataType: 'json',
				success: function(data, textStatus, jqXHR) {
					data.forEach(function(currentValue, index, arr) {
						$('#channels_width').append($('<option>', {
							value: currentValue
						}));
					});
				},
				error: function(jqXHR, textStatus, errorThrown) {}
			});
		}
	});
	$("#channel_width").on("input", function() {
		let channelName = $(this).val();

		if ($('#channels_width option').filter(function() {
				return $(this).val().toUpperCase() === channelName.toUpperCase();
			}).length) {
			$('#frequencies').find('option').remove();
			$.ajax({
				url: '<?= esc($ajax_wireless_frequency, 'js') ?>',
				type: 'GET',
				headers: {
					'X-Requested-With': 'XMLHttpRequest'
				},
				data: {
					'<?= csrf_token() ?>': '<?= csrf_hash() ?>',
					band: $('#band').val(),
					channel_width: $('#channel_width').val()
				},
				contentType: 'application/x-www-form-urlencoded;charset-UTF-8',
				dataType: 'json',
				success: function(data, textStatus, jqXHR) {
					data.forEach(function(currentValue, index, arr) {
						$('#frequencies').append($('<option>', {
							value: currentValue
						}));
					});
				},
				error: function(jqXHR, textStatus, errorThrown) {}
			});
		}
	});
</script>
<?= $this->endSection() ?>