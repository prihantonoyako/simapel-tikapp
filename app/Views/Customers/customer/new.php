<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<div id="basic-form" class="section">
	<form class="col s12" method="POST" action="<?= $url_action ?>">
		<?= csrf_field() ?>
		<div class="row">
			<div class="col s12 m12 l6">
				<div class="card-panel">
					<div class="row">
						<h6>Basic Information</h6>
						<div class="divider"></div>
						<div class="input-field col s12 m6 l6">
							<input name="first_name" type="text">
							<label for="first_name">First Name</label>
						</div>
						<div class="input-field col s12 m6 l6">
							<input name="last_name" type="text">
							<label for="last_name">Last Name</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12 m9 l6">
							<input name="email" type="email">
							<label for="email">Email Address</label>
						</div>
						<div class="input-field col s12 m3 l6">
							<input type="checkbox" id="active" name="active">
							<label for="active">Active</label>
						</div>
					</div>
					<div class="row">
						<h6>Billing Address</h6>
						<div class="divider"></div>
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
						<div class="input-field col s9 m9 l12" id="location-input-field">
							<input name="location_name" id="location_name" type="text" value="<?= old('location_name') ?>">
							<label for="location_name">Location Name</label>
							<datalist id="location_name"></datalist>
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