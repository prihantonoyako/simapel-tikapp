<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<div class="section">
	<div class="row">
		<div class="col s12 m12 l12">
			<div class="row">
				<div class="col s12">
					<ul class="tabs tab-demo-active z-depth-1">
						<li class="tab col s3"><a href="#identity">DEVICES IDENTITY</a></li>
						<li class="tab col s3"><a href="#detail">DEVICES CONFIGURATION</a></li>
					</ul>
				</div>
				<form method="POST" action="<?= $url_action ?>">
					<?= csrf_field() ?>
					<div class="col s12">
						<!-- BEGIN IDENTITY TAB -->
						<div id="identity" class="col s12 m12 l12">
							<div class="row">
								<div class="input-field col s12 m12 l4">
									<input id="name" name="name" type="text">
									<label for="name">Name</label>
								</div>
								<div class="input-field col s12 m12 l4">
									<input id="ip_address" name="ip_address" type="text">
									<label for="ip_address">IP Address</label>
								</div>
								<div class="input-field col s12 m12 l4">
									<input id='password' name="password" list="passwords" type="text">
									<label for="password">Password</label>
									<datalist id="passwords">
										<?php foreach ($passwords as $item) : ?>
											<option value="<?= $item->id ?>"><?= $item->name ?></option>
										<?php endforeach; ?>
									</datalist>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m12 l4">
									<input id="vendor" name="vendor" list="vendors" type="text">
									<label for="vendor">Vendor</label>
									<datalist id="vendors">
										<?php foreach ($vendors as $item) : ?>
											<option value="<?= $item->id ?>"><?= $item->name ?></option>
										<?php endforeach; ?>
									</datalist>
								</div>
								<div class="input-field col s12 m12 l4">
									<input id="item" name="item" list="items" type="text" disabled>
									<label for="item">Item</label>
									<datalist id="items"></datalist>
								</div>
								<div class="input-field col s12 m12 l4" id="get-data-from-origin-device" hidden>
									<a href="#" class="btn">Mikrotik API</a>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m12 l4">
									<input id="province" name="province" type="text" list="provinces">
									<label for="province">Province</label>
									<datalist id="provinces">
										<?php foreach ($provinces as $item) : ?>
											<option value="<?= $item->id ?>"><?= $item->name ?></option>
										<?php endforeach; ?>
									</datalist>
								</div>
								<div class="input-field col s12 m12 l4">
									<input id="city" name="city" type="text" list="cities" disabled>
									<label for="city">City</label>
									<datalist id="cities"></datalist>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m12 l4">
									<input id="district" name="district" type="text" list="districts" disabled>
									<label for="district">District</label>
									<datalist id="districts"></datalist>
								</div>
								<div class="input-field col s12 m12 l4">
									<input id="subdistrict" name="subdistrict" type="text" list="subdistricts" disabled>
									<label for="subdistrict">Subdistrict</label>
									<datalist id="subdistricts"></datalist>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m12 l4">
									<input id="location" name="location" type="text" list="locations" disabled>
									<label for="location">Location</label>
									<datalist id="locations"></datalist>
								</div>
								<div class="input-field col s12 m12 l2">
									<input id="active" name="active" type="checkbox">
									<label for="active">Active</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m12 l12">
									<a href="<?= $url_back ?>" class="btn left">BACK</a>
								</div>
							</div>
						</div>
					</div>
					<!-- END IDENTITY TAB -->
					<!-- BEGIN DETAIL TAB -->
					<div id="detail" class="col s12 m12 l12">
						<div class="row">
							<div class="input-field col s12 m12 l6">
								<input type="text" name="root" list="roots">
								<label for="root">Root</label>
								<datalist id="roots">
									<?php foreach ($baseTransceiverStations as $bts) : ?>
										<option value="<?= $bts->id ?>"><?= $bts->name ?></option>
									<?php endforeach; ?>
								</datalist>
							</div>
							<div class="input-field col s12 m12 l6">
								<input type="text" name="mode" id="mode" list="modes">
								<label for="mode">Mode</label>
								<datalist id="modes"></datalist>
							</div>
							<div class="input-field col s12 m12 l6">
								<input type="text" name="band" id="band" list="bands">
								<label for="band">Band</label>
								<datalist id="bands"></datalist>
							</div>
							<div class="input-field col s12 m12 l6">
								<input type="text" name="channel_width" id="channel_width" list="channels_width">
								<label for="channel_width">Channel Width</label>
								<datalist id="channels_width"></datalist>
							</div>
							<div class="input-field col s12 m12 l6">
								<input type="text" name="frequency" id="frequency" list="frequencies">
								<label for="frequency">Frequency</label>
								<datalist id="frequencies"></datalist>
							</div>
							<div class="input-field col s12 m12 l6">
								<input type="text" name="radio_name" id="radio_name">
								<label for="radio_name">Radio Name</label>
							</div>
							<div class="input-field col s12 m12 l6">
								<input type="text" name="ssid" id="ssid">
								<label for="ssid">SSID</label>
							</div>
							<div class="input-field col s12 m12 l6">
								<input type="text" name="wireless_protocol" id="wireless_protocol" list="wireless_protocols">
								<label for="wireless_protocol">Wireless Protocol</label>
								<datalist id="wireless_protocols"></datalist>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12 m12 l12">
								<button type="submit" class="btn right">SEND</button>
							</div>
						</div>
					</div>
					<!-- END DETAIL TAB -->
				</div>
			</form>
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
	$('#get-data-from-origin-device').on('click', function() {
		$.ajax({
			url: '<?= esc($ajax_get_origin_data, 'js') ?>',
			async: true,
			type: 'GET',
			headers: {
				'X-Requested-With': 'XMLHttpRequest'
			},
			data: {
				ip_address: $('#ip_address').val(),
				password: $('#password').val()
			},
			dataType: 'json',
			contentType: 'application/x-www-form-urlencoded;charset-UTF-8',
			success: function(data, textStatus, jqXHR) {
				$('#mode').val(data.mode);
				$('label[for="mode"]').addClass('active');
				$('#band').val(data.band);
				$('label[for="band"]').addClass('active');
				$('#channel_width').val(data.channel_width);
				$('label[for="channel_width"]').addClass('active');
				$('#frequency').val(data.frequency);
				$('label[for="frequency"]').addClass('active');
				$('#radio_name').val(data.radio_name);
				$('label[for="radio_name"]').addClass('active');
				$('#ssid').val(data.ssid);
				$('label[for="ssid"]').addClass('active');
				$('#wireless_protocol').val(data.wireless_protocol);
				$('label[for="wireless_protocol"]').addClass('active');
			}
		});
	});

	setInterval(function() {
		if ($('#vendor').length != 0 &&
			$('#vendor').val() == '<?= esc($vendor_mikrotik_id, 'js') ?>' &&
			$('#ip_address').length != 0 &&
			$('#password').length != 0
		) {
			$('#get-data-from-origin-device').removeAttr('hidden');
		}
	}, 3000);

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
				headers: {
					'X-Requested-With': 'XMLHttpRequest'
				},
				data: {
					'<?= csrf_token() ?>': '<?= csrf_hash() ?>',
					id: $('#province').val()
				},
				dataType: 'json',
				contentType: 'application/x-www-form-urlencoded;charset-UTF-8',
				success: function(data, textStatus, jqXHR) {
					data.forEach(function(currentValue, index, arr) {
						$('#cities').append($('<option>', {
							value: currentValue.id,
							text: currentValue.name
						}));
					});
					$('#city').removeAttr('disabled');
				},
				error: function(jqXHR, textStatus, errorThrown) {}
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
				headers: {
					'X-Requested-With': 'XMLHttpRequest'
				},
				data: {
					'<?= csrf_token() ?>': '<?= csrf_hash() ?>',
					id: $('#city').val(),
				},
				contentType: 'application/x-www-form-urlencoded;charset-UTF-8',
				dataType: 'json',
				success: function(data, textStatus, jqXHR) {
					data.forEach(function(currentValue, index, arr) {
						$('#districts').append($('<option>', {
							value: currentValue.id,
							text: currentValue.name
						}));
					});
					$('#district').removeAttr('disabled');
				},
				error: function(jqXHR, textStatus, errorThrown) {}
			});
		}
	});

	$("#district").on("input", function() {
		let districtName = $(this).val();

		if ($('#districts option').filter(function() {
				return $(this).val().toUpperCase() === districtName.toUpperCase();
			}).length) {
			$('#subdistricts').find('option').remove();
			$.ajax({
				url: '<?= esc($ajax_subdistrict, 'js') ?>',
				type: 'GET',
				headers: {
					'X-Requested-With': 'XMLHttpRequest'
				},
				data: {
					'<?= csrf_token() ?>': '<?= csrf_hash() ?>',
					id: $('#district').val()
				},
				contentType: 'application/x-www-form-urlencoded;charset-UTF-8',
				dataType: 'json',
				success: function(data, textStatus, jqXHR) {
					data.forEach(function(currentValue, index, arr) {
						$('#subdistricts').append($('<option>', {
							value: currentValue.id,
							text: currentValue.name
						}));
					});
					$('#subdistrict').removeAttr('disabled');
				},
				error: function(jqXHR, textStatus, errorThrown) {}
			});
		}
	});

	$("#subdistrict").on("input", function() {
		let subdistrictName = $(this).val();

		if ($('#subdistricts option').filter(function() {
				return $(this).val().toUpperCase() === subdistrictName.toUpperCase();
			}).length) {
			$('#locations').find('option').remove();
			$.ajax({
				url: '<?= esc($ajax_location, 'js') ?>',
				type: 'GET',
				headers: {
					'X-Requested-With': 'XMLHttpRequest'
				},
				data: {
					'<?= csrf_token() ?>': '<?= csrf_hash() ?>',
					id: $('#subdistrict').val(),
					type: '1'
				},
				contentType: 'application/x-www-form-urlencoded;charset-UTF-8',
				dataType: 'json',
				success: function(data, textStatus, jqXHR) {
					data.forEach(function(currentValue, index, arr) {
						$('#locations').append($('<option>', {
							value: currentValue.id,
							text: currentValue.name
						}));
					});
					$('#location').removeAttr('disabled');
				},
				error: function(jqXHR, textStatus, errorThrown) {}
			});
		}
	});

	$("#vendor").on("input", function() {
		let vendorInput = $(this).val();
		if ($('#vendors option').filter(function() {
				return $(this).val().toUpperCase() === vendorInput.toUpperCase();
			}).length) {
			$('#items').find('option').remove();
			$.ajax({
				url: '<?= esc($ajax_item, 'js') ?>',
				async: true,
				type: 'GET',
				headers: {
					'X-Requested-With': 'XMLHttpRequest'
				},
				data: {
					'<?= csrf_token() ?>': '<?= csrf_hash() ?>',
					vendor: $('#vendor').val(),
					is_bts: '1'
				},
				dataType: 'json',
				contentType: 'application/x-www-form-urlencoded;charset-UTF-8',
				success: function(data, textStatus, jqXHR) {
					data.forEach(function(currentValue, index, arr) {
						$('#items').append($('<option>', {
							value: currentValue.id,
							text: currentValue.name
						}));
					});
					$('#item').removeAttr('disabled');
				},
				error: function(jqXHR, textStatus, errorThrown) {}
			});
			$('#modes').find('option').remove();
			$.ajax({
				url: '<?= esc($ajax_wireless_mode, 'js') ?>',
				async: true,
				type: 'GET',
				headers: {
					'X-Requested-With': 'XMLHttpRequest'
				},
				data: {
					'<?= csrf_token() ?>': '<?= csrf_hash() ?>',
					vendor: $('#vendor').val()
				},
				dataType: 'json',
				contentType: 'application/x-www-form-urlencoded;charset-UTF-8',
				success: function(data, textStatus, jqXHR) {
					data.forEach(function(currentValue, index, arr) {
						$('#modes').append($('<option>', {
							value: currentValue
						}));
					});
					$('#mode').removeAttr('disabled');
				},
				error: function(jqXHR, textStatus, errorThrown) {}
			});

			$('#bands').find('option').remove();
			$.ajax({
				url: '<?= esc($ajax_wireless_band, 'js') ?>',
				async: true,
				type: 'GET',
				headers: {
					'X-Requested-With': 'XMLHttpRequest'
				},
				data: {
					'<?= csrf_token() ?>': '<?= csrf_hash() ?>'
				},
				dataType: 'json',
				contentType: 'application/x-www-form-urlencoded;charset-UTF-8',
				success: function(data, textStatus, jqXHR) {
					data.forEach(function(currentValue, index, arr) {
						$('#bands').append($('<option>', {
							value: currentValue
						}));
					});
					$('#band').removeAttr('disabled');
				}
			});
			$('#wireless-protocols').find('option').remove();
			$.ajax({
				url: '<?= esc($ajax_wireless_protocol, 'js') ?>',
				async: true,
				type: 'GET',
				headers: {
					'X-Requested-With': 'XMLHttpRequest'
				},
				data: {
					'<?= csrf_token() ?>': '<?= csrf_hash() ?>'
				},
				dataType: 'json',
				contentType: 'application/x-www-form-urlencoded;charset-UTF-8',
				success: function(data, textStatus, jqXHR) {
					data.forEach(function(currentValue, index, arr) {
						$('#wireless-protocols').append($('<option>', {
							value: currentValue
						}));
					});
					$('#wireless-protocol').removeAttr('disabled');
				}
			});
		}
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
					$('#channel_width').removeAttr('disabled');
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
					$('#frequency').removeAttr('disabled');
				},
				error: function(jqXHR, textStatus, errorThrown) {}
			});
		}
	});
</script>
<?= $this->endSection() ?>