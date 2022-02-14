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
							<div class="input-field col l6">
								<input id="province" name="province" type="text" list="provinces" value="<?= $locationProvince->name ?>">
								<label for="province">Province</label>
								<datalist id="provinces" style="display:none;">
									<?php foreach ($provinces as $province) : ?>
										<option value="<?= $province->name ?>"></option>
									<?php endforeach; ?>
								</datalist>
							</div>
							<div class="input-field col l6">
								<input name="city" id="city" type="text" list="cities" value="<?= $locationCity->name ?>">
								<label for="cities">City</label>
								<datalist id="cities" style="display:none;"></datalist>
							</div>
						</div>
						<div class="row">
							<div class="input-field col l6">
								<input name="district" id="district" type="text" list="districts" value="<?= $locationDistrict->name ?>">
								<label for="district">District</label>
								<datalist id="districts" style="display:none;"></datalist>
							</div>
							<div class="input-field col l6">
								<input name="subdistrict" id="subdistrict" type="text" list="subdistricts" value="<?= $locationSubdistrict->name ?>">
								<label for="subdistrict">Sub-District</label>
								<datalist id="subdistricts" style="display:none;"></datalist>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s6">
								<input name="hamlet" id="hamlet" type="number" value="<?= $locationInfo->hamlet ?>">
								<label for="hamlet">Hamlet</label>
							</div>
							<div class="input-field col s6">
								<input name="neighborhood" id="neighborhood" type="number" value="<?= $locationInfo->neighborhood ?>">
								<label for="neighborhood">Neighborhood</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input name="street" id="street" type="text" value="<?= $locationInfo->street ?>">
								<label for="street">Street</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s6">
								<input id="latitude" name="latitude" type="text" value="<?= $locationInfo->latitude ?>">
								<label for="latitude" id="latitude-label">Latitude</label>
							</div>
							<div class="input-field col s6">
								<input id="longitude" name="longitude" type="text" value="<?= $locationInfo->longitude ?>">
								<label for="longitude" id="longitude-label">Longitude</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input name="name" type="text" value="<?= $locationInfo->name ?>">
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
		<div class="col s12 m12 l6">
			<div class="row">
				<div class="col s12 m12 l12">
					<div class="map-card">
						<div class="card">
							<div class="card-image waves-effect waves-block waves-light">
								<div id="new-location-map"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php if (!(is_null(session()->getFlashdata('errors')) && is_null(session()->getFlashdata('conflict')))) : ?>
			<div class="row">
				<div class="card-panel">
					<h4 class="header2">ERROR</h4>
					<div class="row">
						<?php if (!empty($errors)) : ?>
							<?php foreach ($errors as $field => $error) : ?>
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
			<?php endif; ?>
		</div>
	</div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAZnaZBXLqNBRXjd-82km_NO7GUItyKek"></script>

<script type="text/javascript">
	$("#province").on("input", function() {
		let provinceName = $(this).val();
		if ($('#provinces option').filter(function() {
				return $(this).val().toUpperCase() === provinceName.toUpperCase();
			}).length) {
			let dataJSON = {
				'<?= csrf_token() ?>': '<?= csrf_hash() ?>',
				name: $('#province').val()
			};
			
			$.ajax({
				url: '<?= esc($ajax_city, 'js') ?>',
				type: 'GET',
				data: dataJSON,
				dataType: 'json',
				success: function(data) {
					data.forEach(function(city, index) {
						let optionElement = document.createElement('option');
						optionElement.value = city.name;
						document.getElementById('cities').appendChild(optionElement);
					});
					document.getElementById('city').removeAttribute('disabled');
				}
			});
		}
	});
	$("#city").on("input", function() {
		let cityName = $(this).val();

		if ($('#cities option').filter(function() {
				return $(this).val().toUpperCase() === cityName.toUpperCase();
			}).length) {
			let dataJSON = {
				'<?= csrf_token() ?>': '<?= csrf_hash() ?>',
				name: $('#city').val()
			};
			let districtDataList = document.getElementById('districts');
			while (districtDataList.firstChild) {
				districtDataList.removeChild(districtDataList.lastChild);
			}
			$.ajax({
				url: '<?= esc($ajax_district, 'js') ?>',
				type: 'GET',
				data: dataJSON,
				dataType: 'json',
				success: function(data) {
					data.forEach(function(district, index) {
						let optionElement = document.createElement('option');
						optionElement.value = district.name;
						document.getElementById('districts').appendChild(optionElement);
					});
					document.getElementById('district').removeAttribute('disabled');
				}
			});
		}
	});
	$("#district").on("input", function() {
		let districtName = $(this).val();

		if ($('#districts option').filter(function() {
				return $(this).val().toUpperCase() === districtName.toUpperCase();
			}).length) {
			let dataJSON = {
				'<?= csrf_token() ?>': '<?= csrf_hash() ?>',
				name: $('#district').val()
			};
			let subdistrictDataList = document.getElementById('subdistricts');
			while (subdistrictDataList.firstChild) {
				subdistrictDataList.removeChild(subdistrictDataList.lastChild);
			}
			$.ajax({
				url: '<?= esc($ajax_subdistrict, 'js') ?>',
				type: 'GET',
				data: dataJSON,
				dataType: 'json',
				success: function(data) {
					data.forEach(function(subdistrict, index) {
						let optionElement = document.createElement('option');
						optionElement.value = subdistrict.name;
						document.getElementById('subdistricts').appendChild(optionElement);
					});
					document.getElementById('subdistrict').removeAttribute('disabled');
				}
			});
		}
	});
</script>
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