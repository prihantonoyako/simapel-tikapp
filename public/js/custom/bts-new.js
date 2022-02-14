// Create the script tag, set the appropriate attributes
var script = document.createElement('script');
script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCbWY4v-hzv37XTOiO48Bx_e-t5PMSR764&callback=initMap';
script.async = true;

// Attach your callback function to the `window` object
window.initMap = function() {
    const myLatlng = { lat: -7.574, lng: 110.829 };
    //surakarta: "lat": -7.574425041805952, "lng": 110.82976867829446
    const map = new google.maps.Map(document.getElementById("new-location-map"), {
      zoom: 8,
      center: myLatlng,
      scrollwheel: false,
    });
    // Create the initial InfoWindow.
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
};

// Append the 'script' element to 'head'
document.head.appendChild(script);
