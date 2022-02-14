<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<div class="section">
	<div class="row">
		<div class="col s12 m12 l12">
			<div class="row">
				<div class="col s12 m12 l12">
					<div class="map-card">
						<div class="card">
							<div class="card-image waves-block waves-light">
								<div id="new-location-map"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col s12 m12 l12">
			<div class="card-panel">
				<div class="row">
					<form class="col s12" method="POST" action="<?= $url_action ?>">
					<?= csrf_field() ?>
						<div class="row">
							<div class="input-field col l4">
								<input id="province" name="province" value="<?= old('province') ?>" list="provinces" type="text">
								<label for="province">Province</label>
								<datalist id="provinces">
									<?php foreach ($provinces as $province) : ?>
										<option value="<?= $province->id ?>"><?= $province->name ?></option>
									<?php endforeach; ?>
								</datalist>
							</div>
							<div class="input-field col l4">
								<input id="city" name="city" value="<?= old('city') ?>" list="cities" type="text" disabled>
								<label for="city">City</label>
								<datalist id="cities"></datalist>
							</div>
							<div class="input-field col l4">
								<input id="district" name="district" value="<?= old('district') ?>" list="districts" type="text" disabled>
								<label for="district">District</label>
								<datalist id="districts"></datalist>
							</div>
						</div>
						<div class="row">
							<div class="input-field col l4">
								<input id="subdistrict" name="subdistrict" value="<?= old('subdistrict') ?>" list="subdistricts" type="text" disabled>
								<label for="subdistrict">Sub-District</label>
								<datalist id="subdistricts"></datalist>
							</div>
							<div class="input-field col s4">
								<input id="hamlet" name="hamlet" value="<?= old('hamlet') ?>" type="number">
								<label for="hamlet">Hamlet</label>
							</div>
							<div class="input-field col s4">
								<input id="neighborhood" name="neighborhood" value="<?= old('neighborhood') ?>" type="number">
								<label for="neighborhood">Neighborhood</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s4">
								<input id="street" name="street" value="<?= old('street') ?>" type="text">
								<label for="street">Street</label>
							</div>
							<div class="input-field col s4">
								<input id="latitude" name="latitude" value="<?= old('latitude') ?>" type="text">
								<label for="latitude" id="latitude-label">Latitude</label>
							</div>
							<div class="input-field col s4">
								<input id="longitude" name="longitude" value="<?= old('longitude') ?>" type="text">
								<label for="longitude" id="longitude-label">Longitude</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s12">
								<input id="name" name="name" type="text" value="<?= old('name') ?>">
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
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAZnaZBXLqNBRXjd-82km_NO7GUItyKek"></script>

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
				headers: {'X-Requested-With':'XMLHttpRequest'},
				data: {
					'<?= csrf_token() ?>':'<?= csrf_hash() ?>',
					id: $('#province').val()
				},
				dataType: 'json',
				contentType: 'application/x-www-form-urlencoded;charset-UTF-8',
				success: function(data) {
					data.forEach(function(currentValue,index,arr) {
						$('#cities').append($('<option>',{
							value: currentValue.id,
							text: currentValue.name
						}));
					});
					$('#city').removeAttr('disabled');
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
				headers: {'X-Requested-With':'XMLHttpRequest'},
				data: {
					'<?= csrf_token() ?>': '<?= csrf_hash() ?>',
					id: $('#city').val()
				},
				contentType: 'application/x-www-form-urlencoded;charset-UTF-8',
				dataType: 'json',
				success: function(data) {
					data.forEach(function(currentValue,index,arr) {
						$('#districts').append($('<option>',{
							value:currentValue.id,
							text:currentValue.name
						}));
					});
					$('#district').removeAttr('disabled');
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
				headers: {'X-Requested-With':'XMLHttpRequest'},
				data: {
					'<?= csrf_token() ?>': '<?= csrf_hash() ?>',
					id: $('#district').val()
				},
				contentType: 'application/x-www-form-urlendoded;charset-UTF-8',
				dataType: 'json',
				success: function(data) {
					data.forEach(function(currentValue,index,arr) {
						$('#subdistricts').append($('<option>',{
							value:currentValue.id,
							text:currentValue.name
						}));
					});
					$('#subdistrict').removeAttr('disabled');
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