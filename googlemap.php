<!DOCTYPE html>
<html>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
        <script type="text/javascript">
        function initialize() {
              var address = (document.getElementById('my-address'));
              var autocomplete = new google.maps.places.Autocomplete(address);
              autocomplete.setTypes(['geocode']);
              google.maps.event.addListener(autocomplete, 'place_changed', function() {
                  var place = autocomplete.getPlace();
                  if (!place.geometry) {
                      return;
                  }

              var address = '';
              if (place.address_components) {
                  address = [
                      (place.address_components[0] && place.address_components[0].short_name || ''),
                      (place.address_components[1] && place.address_components[1].short_name || ''),
                      (place.address_components[2] && place.address_components[2].short_name || '')
                      ].join(' ');
              }
            });
        }
        function getAddress() {
            geocoder = new google.maps.Geocoder();
            var username = document.getElementById("user-name").value;
            var address = document.getElementById("my-address").value;
            geocoder.geocode( { 'address': address}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                  var latitude = results[0].geometry.location.lat();
                  var longitude = results[0].geometry.location.lng();
                  var dataString = 'username=' + username + '&address=' + address + '&latitude=' + latitude + '&longitude=' + longitude;
                  // AJAX code to submit form.
                  jQuery.ajax({
                    type: "POST",
                    url: "googlemap/ajaxjs.php",
                    data: dataString,
                    dataType: "text",
                    cache: false,
                    success: function() {
                      alert('Your Details are saved successfully');
                    } 
                  });
              } 
              else {
                alert("Geocode was not successful for the following reason: " + status);
              }
            });
        }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    </head>
    <body>      
        <input type="text" id="user-name" placeholder="username">
        <input type="text" id="my-address">
        <button id="getCords" onClick="getAddress();">Save Details</button>
    </body>
</html>

<?php

$username = $_POST['username'];
$address = $_POST['address'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

$con = mysqli_connect("localhost","root","root","mydba");
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  } else {
    mysqli_query($con,"INSERT INTO `userdetail`(username,address,latitude,longitude) VALUES ('".$username."', '".$address."' , '".$latitude."' , '".$longitude."')");
  }

mysqli_close($con); // Connection Closed
?>
