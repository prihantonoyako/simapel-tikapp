<?= $this->extend("Layouts/dashboard") ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-icon" data-background-color="rose">
        <i class="material-icons">room</i>
      </div>
      <div class="card-content">
        <h4 class="card-title">Regular Map</h4>
        <div id="pemetaan" class="map"></div>
      </div>
    </div>
  </div>
</div>
<?= $this->endsection() ?>
<?= $this->section('scripts') ?>
<script>
  function initMap() {
    let myLatlng = new google.maps.LatLng(-7.574, 110.829);
    let mapOptions = {
      zoom: 12,
      center: myLatlng,
      scrollwheel: false,
      mapTypeId: "terrain"
    }
    let map = new google.maps.Map(document.getElementById("pemetaan"), mapOptions);

    // Lokasi perangkat WLAN
    let pusatBTS = <?= json_encode($btsPusat) ?>;
    let wdsBTS = <?= json_encode($btsWDS) ?>;
    let cpePelanggan = <?= json_encode($pelangganCPE) ?>;
    let locations = new Array();
    let temp;

    pusatBTS.forEach(obj => {
      let myLatLng = new google.maps.LatLng(obj.latitude, obj.longitude);
      temp = [obj.nama, obj.latitude, obj.longitude];
      locations.push(temp);
    });
    wdsBTS.forEach(obj => {
      let myLatLng = new google.maps.LatLng(obj.latitude, obj.longitude);
      temp = [obj.nama, obj.latitude, obj.longitude];
      locations.push(temp);
    });
    cpePelanggan.forEach(obj => {
      let myLatLng = new google.maps.LatLng(obj.latitude, obj.longitude);
      temp = [obj.nama, obj.latitude, obj.longitude];
      locations.push(temp);
    });

    let infowindow = new google.maps.InfoWindow();
    let marker;
    for (let i = 0; i < locations.length; i++) {
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }

    wdsBTS.forEach(obj => {
      let myLatLng = new google.maps.LatLng(obj.latitude, obj.longitude);
console.log(obj.latitude);
console.log(obj.longitude);
      // CPE and WDS
      const linkBTS = [{
          lat: parseFloat(obj.latitude),
          lng: parseFloat(obj.longitude)
        },
        {
          lat: parseFloat(obj.parent_latitude),
          lng: parseFloat(obj.paren_longitude)
        },
      ];

      //Draw UP or DOWN
      const linkState = new google.maps.Polyline({
        path: linkBTS,
        /* geodesic: true, */
        strokeColor: "#00FF00",
        /* strokeOpacity: 1.0, */
        strokeWeight: 2,
      });
      linkState.setMap(map);
    });
  }
</script>
<script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbWY4v-hzv37XTOiO48Bx_e-t5PMSR764&callback=initMap">
</script>
<?= $this->endsection() ?>