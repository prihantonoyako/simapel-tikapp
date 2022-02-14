<script type="text/javascript" src="<?= base_url('js/custom/add-location.js') ?>"></script>
$(function () {
    // Google Maps  
    $('#new-location-map').addClass('loading');
    var latlng = new google.maps.LatLng(-7.574, 110.829); // Set your Lat. Log. New York
    var settings = {
        zoom: 10,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false,
        scrollwheel: false,
        draggable: true,
        styles: [{ "featureType": "landscape.natural", "elementType": "geometry.fill", "stylers": [{ "visibility": "on" }, { "color": "#e0efef" }] }, { "featureType": "poi", "elementType": "geometry.fill", "stylers": [{ "visibility": "on" }, { "hue": "#1900ff" }, { "color": "#c0e8e8" }] }, { "featureType": "road", "elementType": "geometry", "stylers": [{ "lightness": 100 }, { "visibility": "simplified" }] }, { "featureType": "road", "elementType": "labels", "stylers": [{ "visibility": "off" }] }, { "featureType": "transit.line", "elementType": "geometry", "stylers": [{ "visibility": "on" }, { "lightness": 700 }] }, { "featureType": "water", "elementType": "all", "stylers": [{ "color": "#7dcdcd" }] }],
        mapTypeControlOptions: { style: google.maps.MapTypeControlStyle.DROPDOWN_MENU },
        navigationControl: false,
        navigationControlOptions: { style: google.maps.NavigationControlStyle.SMALL },
    };
    var map = new google.maps.Map(document.getElementById("new-location-map"), settings);

    google.maps.event.addDomListener(window, "resize", function () {
        var center = map.getCenter();
        google.maps.event.trigger(map, "resize");
        map.setCenter(center);
        $('#new-location-map').removeClass('loading');
    });

    // Create the initial InfoWindow.
    let infoWindow = new google.maps.InfoWindow({
        content: "Click the map to get Lat/Lng!",
        position: latlng,
    });
    infoWindow.open(map);
    // Configure the click listener.
    map.addListener("click", (mapsMouseEvent) => {
        // Close the current InfoWindow.
        infoWindow.close();
        // Create a new InfoWindow.
		new google.maps.Marker({
			position: mapsMouseEvent.latLng,
			draggable:true,
			map,
			title: "Drop here!",
		});
        document.getElementById("latitude").value = mapsMouseEvent.latLng.lat();
        document.getElementById("longitude").value = mapsMouseEvent.latLng.lng();
    });
});
