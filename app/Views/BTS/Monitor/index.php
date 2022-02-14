<?= $this->extend('Layouts/dashboard') ?>

<?= $this->section('styles') ?>
<style>
#monitoring-link {
    width: 100%;
    height: 450px
}
</style>
<?= $this->endSection() ?>

<?= $this->section('dashboard-content') ?>
<div id="basic-form" class="section">
	<div class="row">
		<div class="col s12 m12 l12">
			<div class="map-card">
				<div class="card">
					<div class="card-image waves-block waves-light">
						<div id="monitoring-link" data-lat="40.747688" data-lng="-74.004142"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAZnaZBXLqNBRXjd-82km_NO7GUItyKek"></script>
<script type="text/javascript">
let map;

function initMap() {
	let mapProp = {
		center: new google.maps.LatLng(-7.579780084588589,110.77769994735718),
		zoom:14,
		// mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	
	map = new google.maps.Map(document.getElementById('monitoring-link'),mapProp);

	let linkStatus = <?= $linkStatus ?>;
	let strokeColor = "";
	linkStatus.forEach(function(currentValue,index,arr) {
		if(currentValue.running == '1'){
			strokeColor="#00FF00";
		} else{
			strokeColor="#FF0000";
		}
		
		let linkPath = new google.maps.Polyline({
			path: [
				new google.maps.LatLng(
					currentValue.bts1.latitude,
					currentValue.bts1.longitude
				),
				new google.maps.LatLng(
					currentValue.bts2.latitude,
					currentValue.bts2.longitude
				)
			],
			geodesic: false,
			strokeColor: strokeColor,
			strokeOpacity: 1.0,
			strokeWeight: 2,
		});
		linkPath.setMap(map);
	});

	let customerLink = <?= $customerLink ?>;
		customerLink.forEach(function(currentValue,index,arr) {
			new google.maps.Marker({
					position:new google.maps.LatLng(
						currentValue.customer.latitude,
						currentValue.customer.longitude
					),
					map,
					title:currentValue.customer.name,
					icon: "http://simapel-tikapp.test/icon/logo-customer.png"
			});
			if(currentValue.running == '1'){
				strokeColor="#00FF00";
			} else {
				strokeColor="#FF0000";
			}
			let linkPath = new google.maps.Polyline({
				path: [
					new google.maps.LatLng(
						currentValue.customer.latitude,
						currentValue.customer.longitude
					),
					new google.maps.LatLng(
						currentValue.bts.latitude,
						currentValue.bts.longitude
					)
				],
				geodesic: false,
				strokeColor: strokeColor,
				strokeOpacity: 1.0,
				strokeWeight: 2,
			});
			linkPath.setMap(map);
		});
  let allIndependentBts = <?= $allIndependentBts ?>;
  allIndependentBts.forEach(function(currentValue,index,arr) {
	new google.maps.Marker({
		position:new google.maps.LatLng(currentValue.latitude,currentValue.longitude),
		map,
		title:currentValue.name,
		icon: "http://simapel-tikapp.test/icon/logo-bts.png"
	});
  });
  let allDependentBts = <?= $allDependentBts ?>;
  allDependentBts.forEach(function(currentValue,index,arr) {
	new google.maps.Marker({
		position:new google.maps.LatLng(currentValue.latitude,currentValue.longitude),
		map,
		title:currentValue.name,
		icon: "http://simapel-tikapp.test/icon/logo-bts.png"
	});
  });
}

google.maps.event.addDomListener(window, 'load', initMap);
</script>

<?= $this->endSection() ?>