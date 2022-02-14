// Create the script tag, set the appropriate attributes
var script = document.createElement('script');

script.async = true;

// Attach your callback function to the `window` object
window.initMap = function() {
    const myLatlng = { lat: -7.574, lng: 110.829 };
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 4,
      center: myLatlng,
    });
    new google.maps.Marker({
      position: myLatLng,
      map,
      title: "Hello World!",
    });
};

// Append the 'script' element to 'head'
document.head.appendChild(script);
