<div class="container">

        <h1>Geolocation Demo</h1>
      
        <form id="geocoding_form" class="form-horizontal">
          <div class="form-group">
            <div class="col-xs-12 col-md-6 col-md-offset-3">
              <button type="button" class="find-me btn btn-info btn-block">Find My Location</button>
            </div>
          </div>
        </form>
      
        <p class="no-browser-support">Sorry, the Geolocation API isn't supported in Your browser.</p>
        <p class="coordinates">Latitude: <b class="latitude">42</b> Longitude: <b class="longitude">32</b></p>
      
        <div class="map-overlay">
          <div id="map"></div>
        </div>
      
      </div>
      <script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>

      <script>
      var findMeButton = $('.find-me');

// Check if the browser has support for the Geolocation API
if (!navigator.geolocation) {

  findMeButton.addClass("disabled");
  $('.no-browser-support').addClass("visible");

} else {

  findMeButton.on('click', function(e) {

    e.preventDefault();

    navigator.geolocation.getCurrentPosition(function(position) {

      // Get the coordinates of the current possition.
      var lat = position.coords.latitude;
      var lng = position.coords.longitude;

      $('.latitude').text(lat.toFixed(3));
      $('.longitude').text(lng.toFixed(3));
      $('.coordinates').addClass('visible');

      // Create a new map and place a marker at the device location.
      var map = new GMaps({
        el: '#map',
        lat: lat,
        lng: lng
      });

      map.addMarker({
        lat: lat,
        lng: lng
      });

    });

  });

}</script>