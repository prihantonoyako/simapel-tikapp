<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<diV class="section">
	<div class="row">
		<div class="col s12">
			<ul class="tabs tab-demu-active z-depth-1">
				<li class="tab col s3"><a href="#customer_tab">Information</a></li>
				<li class="tab col s3"><a href="#connection_tab">Connection</a></li>
			</ul>
		</div>
		<form method="POST" action="<?= $url_action ?>">
			<?= csrf_field() ?>
			<div id="customer_tab" class="col s12">
				<div class="row">
					<div class="col s12 m12 l6">
						<div class="card-panel">
							<div class="row">
								<h6>Basic Information</h6>
								<div class="divider"></div>
								<input name="customerID" type="number" value="<?= $customer->id ?>" hidden>
								<div class="input-field col s12 m6 l6">
									<input id="first_name" name="first_name" type="text" value="<?= $customer->first_name ?>" disabled>
									<label for="first_name">First Name</label>
								</div>
								<div class="input-field col s12 m6 l6">
									<input id="last_name" name="last_name" value="<?= $customer->last_name ?>" type="text" disabled>
									<label for="last_name">Last Name</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m9 l6">
									<input id="email" name="email" value="<?= $customer->email ?>" type="email" disabled>
									<label for="email">Email Address</label>
								</div>
							</div>
							<div class="row">
								<h6>Subscription Address</h6>
								<div class="divider"></div>
								<div class="input-field col s12 m4 l4">
									<input type="checkbox" id="is_addr_eq_bill_addr" name="is_addr_eq_bill_addr">
									<label for="is_addr_eq_bill_addr">Same With Billing Address</label>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="input-field col s12 m6 l4">
									<input id="province" name="province" type="text" list="provinces" value="<?= old('province') ?>">
									<label for="province">Province</label>
									<datalist id="provinces">
										<?php foreach ($provinces as $province) : ?>
											<option value="<?= $province->id ?>"><?= $province->name ?></option>
										<?php endforeach; ?>
									</datalist>
								</div>
								<div class="input-field col s12 m6 l4">
									<input name="city" id="city" type="text" list="cities" value="<?= old('city') ?>" disabled>
									<label for="cities">City</label>
									<datalist id="cities"></datalist>
								</div>
								<div class="input-field col s12 m6 l4">
									<input name="district" id="district" type="text" list="districts" value="<?= old('district') ?>" disabled>
									<label for="district">District</label>
									<datalist id="districts"></datalist>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m6 l4">
									<input name="subdistrict" id="subdistrict" type="text" list="subdistricts" value="<?= old('subdistrict') ?>" disabled>
									<label for="subdistrict">Sub-District</label>
									<datalist id="subdistricts"></datalist>
								</div>
								<div class="input-field col s12 m6 l4">
									<input id="hamlet" name="hamlet" value="<?= old('hamlet') ?>" type="number">
									<label for="hamlet">Hamlet</label>
								</div>
								<div class="input-field col s12 m6 l4">
									<input id="neighborhood" name="neighborhood" value="<?= old('neighborhood') ?>" type="number">
									<label for="neighborhood">Neighborhood</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m6 l12">
									<input id="street" name="street" value="<?= old('street') ?>" type="text">
									<label for="street">Street</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12 m6 l6">
									<input id="latitude" name="latitude" value="<?= old('latitude') ?>" type="text">
									<label for="latitude" id="latitude-label">Latitude</label>
								</div>
								<div class="input-field col s12 m6 l6">
									<input id="longitude" name="longitude" value="<?= old('longitude') ?>" type="text">
									<label for="longitude" id="longitude-label">Longitude</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s9 m9 l9" id="location-input-field">
									<input name="location_name" id="location_name" type="text" value="<?= old('location_name') ?>">
									<label for="location_name">Location Name</label>
									<datalist id="location_name"></datalist>
								</div>
							</div>
							<h6>Subscription Info</h6>
							<div class="divider"></div>
							<div class="row">
								<div class="input-field col s12 m3 l3">
									<input id="internet_plan" name="internet_plan" value="<?= old('internet_plan') ?>" list="internet_plans" type="text">
									<label for="internet_plan">Internet Plan</label>
									<datalist id="internet_plans">
									<?php foreach($internet_plans as $internet_plan): ?>
										<option value="<?= $internet_plan->id ?>"><?= $internet_plan->name ?>
									<?php endforeach; ?>
									</datalist>
								</div>
								<div class="input-field col s12 m3 l3">
									<input type="checkbox" id="active" name="active">
									<label for="active">Active</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<a href="<?= $url_back ?>" class="btn left"><i class="mdi-navigation-arrow-back"></i>BACK</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col s12 m12 l6">
						<div class="map-card">
							<div class="card">
								<div class="card-image">
									<div id="new-location-map"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="connection_tab" class="col s12">
				<div class="row">
					<div class="col s12 m12 l12">
						<div class="card-panel">
							<div class="row">
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
									<input id="province_conn" name="province_conn" list="provinces_conn" type="text">
									<label for="province_conn">Province</label>
									<datalist id="provinces_conn">
										<?php foreach ($provinces as $province) : ?>
											<option value="<?= $province->id ?>"><?= $province->name ?></option>
										<?php endforeach; ?>
									</datalist>
								</div>
								<div class="input-field col s12 m12 l4">
									<input id="city_conn" name="city_conn" list="cities_conn" type="text">
									<label for="city_conn">City</label>
									<datalist id="cities_conn"></datalist>
								</div>
								<div class="input-field col s12 m12 l4">
									<input type="text" name="root" list="roots">
									<label for="root">Connection</label>
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
									<input type="text" name="radio_name" id="radio_name">
									<label for="radio_name">Radio Name</label>
								</div>
								<div class="input-field col s12">
									<button class="btn right" type="submit" name="action">SUBMIT<i class="mdi-content-send right"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<?php if (!(is_null(session()->getFlashdata('errors')) && is_null(session()->getFlashdata('conflict')))) : ?>
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
					<?php if (!empty(session()->getFlashdata('conflict'))) : ?>
						<div id="card-alert" class="card light-blue col s12 grid-example">
							<div class="card-content white-text">
								<span class="flow-text">
									<p><?= session()->getFlashdata('conflict') ?></p>
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
	$("#province_conn").on("input", function() {
		let provinceName = $(this).val();
		if ($('#provinces_conn option').filter(function() {
				return $(this).val().toUpperCase() === provinceName.toUpperCase();
			}).length) {
			$('#cities_conn').find('option').remove();
			$.ajax({
				url: '<?= esc($ajax_city, 'js') ?>',
				async: true,
				type: 'GET',
				headers: {
					'X-Requested-With': 'XMLHttpRequest'
				},
				data: {
					'<?= csrf_token() ?>': '<?= csrf_hash() ?>',
					id: $('#province_conn').val()
				},
				dataType: 'json',
				contentType: 'application/x-www-form-urlencoded;charset-UTF-8',
				success: function(data, textStatus, jqXHR) {
					data.forEach(function(currentValue, index, arr) {
						$('#cities_conn').append($('<option>', {
							value: currentValue.id,
							text: currentValue.name
						}));
					});
					$('#city_conn').removeAttr('disabled');
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
	$("#city_conn").on("input", function() {
		let cityName = $(this).val();

		if ($('#cities_conn option').filter(function() {
				return $(this).val().toUpperCase() === cityName.toUpperCase();
			}).length) {
			$('#root').find('option').remove();
			$.ajax({
				url: '<?= esc($ajax_nearest_BTS, 'js') ?>',
				type: 'GET',
				headers: {
					'X-Requested-With': 'XMLHttpRequest'
				},
				data: {
					'<?= csrf_token() ?>': '<?= csrf_hash() ?>',
					id: $('#city_conn').val(),
				},
				contentType: 'application/x-www-form-urlencoded;charset-UTF-8',
				dataType: 'json',
				success: function(data, textStatus, jqXHR) {
					data.forEach(function(currentValue, index, arr) {
						$('#roots').append($('<option>', {
							value: currentValue.id,
							text: currentValue.name
						}));
					});
					$('#root').removeAttr('disabled');
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
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAZnaZBXLqNBRXjd-82km_NO7GUItyKek"></script>
<script type="text/javascript">
	let map;
	let marker;
	let infowindow;

	function initialize() {
		var mapProp = {
			center: new google.maps.LatLng(-7.579781413974724, 110.7777039706707),
			zoom: 18,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		map = new google.maps.Map(document.getElementById("new-location-map"), mapProp);

		google.maps.event.addListener(map, 'click', function(event) {
			placeMarker(event.latLng);
			$('#latitude').val(event.latLng.lat());
			$('label[for="latitude"]').addClass('active');
			$('#longitude').val(event.latLng.lng());
			$('label[for="longitude"]').addClass('active');
		});
	}

	function placeMarker(location) {
		if (!marker || !marker.setPosition) {
			marker = new google.maps.Marker({
				position: location,
				map: map,
			});
		} else {
			marker.setPosition(location);
		}
	}

	google.maps.event.addDomListener(window, 'load', initialize);
</script>
<?= $this->endSection() ?>