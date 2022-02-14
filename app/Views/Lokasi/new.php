<?= $this->extend("Layouts/dashboard") ?>
<?= $this->section('content') ?>
<div class="row">
    <!-- begin of bts map -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">add_location</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Regular Map</h4>
                <div id="regularMap" class="map"></div>
            </div>
        </div>
    </div>
    <!-- end of bts map -->
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">map</i>
            </div>
            <div class="card-content">
                <h4 class="card-title">Tambah Lokasi</h4>
                <form method="POST" action="<?= $url ?>">
                    <div class="form-group label-floating">
                        <label class="control-label">Nama <small>(required)</small></label>
                        <input type="text" name="nama" required class="form-control">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Provinsi <small>(required)</small></label>
                        <select id="provinsi" name="provinsi" class="form-control">
                            <option disabled selected></option>
                            <?php foreach ($provinsi as $item) : ?>
                                <option value="<?= $item->id ?>"><?= $item->nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Kota <small>(required)</small></label>
                        <select id="kota" name="kota" required class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Latitude <small>(required)</small></label>
                        <input type="text" name="latitude" id="latitude" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Longitude <small>(required)</small></label>
                        <input type="text" name="longitude" id="longitude" required class="form-control">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Keterangan</label>
                        <textarea name="keterangan" rows="5" cols="51" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-fill btn-rose">Tambah</button>
                </form>
            </div>
        </div>
    </div>
    <!-- end of bts info -->
    
</div>
<?= $this->endsection() ?>

<?= $this->section('scripts') ?>
<script src="https://maps.googleapis.com/maps/api/js"></script>
<!-- <script src="<?= base_url('bts/bts-new.js') ?>"></script> -->
<script>
    // Regular Map
    var myLatlng = new google.maps.LatLng(-7.574, 110.829);
        var mapOptions = {
            zoom: 8,
            center: myLatlng,
            scrollwheel: false,
            draggable: true
        }

        var map = new google.maps.Map(document.getElementById("regularMap"), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            title:"Regular Map!"
        });
        let infoWindow = new google.maps.InfoWindow({
      content: "Click the map to get Lat/Lng!",
      position: myLatlng,
    });
    infoWindow.open(map);
    // Configure the click listener.
    map.addListener("click", (mapsMouseEvent) => {
      // Close the current InfoWindow.
      infoWindow.close();
      // Create a new InfoWindow.
      infoWindow = new google.maps.InfoWindow({
        position: mapsMouseEvent.latLng,
      });
      infoWindow.setContent(
        JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
      );
      infoWindow.open(map);
      console.log(mapsMouseEvent.latLng.lat());
      document.getElementById("latitude").value = mapsMouseEvent.latLng.lat();
      document.getElementById("longitude").value = mapsMouseEvent.latLng.lng();
    });

        // marker.setMap(map);
        </script>
<script>
    $("#provinsi").change(function() {
        var sel = document.getElementById('kota');
        if (sel != null) {
            for (i = sel.length - 1; i >= 0; i--) {
                sel.remove(i);
            }
        }
        let provinsi = $(this).val();
        let url = "<?= esc(base_url('api/get/kota'), 'js') ?>" + "/" + provinsi;
        $.ajax({
            url: url,
            type: "GET",
            data: {
                provinsi: provinsi,
            },
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(result) {
                result.forEach((result, i) => {
                    var element = document.createElement('option');
                    element.value = result.id;
                    element.textContent = result.nama;
                    $("#kota").append(element);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                swal({
                    title: "Oops!",
                    text: jqXHR.responseText,
                    icon: "error",
                    timer: 5000
                });
            }
        })
    });
</script>
<?= $this->endsection() ?>