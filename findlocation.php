<?php
        $username = $_POST['user_name'];
        $con = mysqli_connect("localhost","root","root","mydba");
        // Check connection
        if (mysqli_connect_errno())
          {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }
        $result = mysqli_query($con,"SELECT * FROM `userdetail` WHERE username = '".$username."'");      
        $row = mysqli_fetch_assoc($result);
        mysqli_close($con); // Connection Closed
?>

<html>
    <head>
        <style type="text/css">
            div#map {
                position: relative;
            }

            div#crosshair {
                position: absolute;
                top: 192px;
                height: 19px;
                width: 19px;
                left: 50%;
                margin-left: -8px;
                display: block;
                background: url(crosshair.gif);
                background-position: center center;
                background-repeat: no-repeat;
            }
        </style>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript">
            var map;
            var geocoder;
            var centerChangedLast;
            var reverseGeocodedLast;
            var currentReverseGeocodeResponse;

            function initialize() {
                var lat = '<?php echo $row[latitude] ;?>';
                var lng = '<?php echo $row[longitude] ;?>';
                var latlng = new google.maps.LatLng(lat,lng);
                var myOptions = {
                    zoom: 10,
                    center: latlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                geocoder = new google.maps.Geocoder();

                var marker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    title: "Test for Location"
                });

            }

        </script>
    </head>
   
    <body onload="initialize()">
        <div id="map" style="width:600px; height:400px">
            <div id="map_canvas" style="width:100%; height:200px"></div>
            <div id="crosshair"></div>
        </div>


    </body>
</html>


