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
                var latlng = new google.maps.LatLng(30.36156549999999,78.08253439999999);
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
                    title: "Hello World!"
                });

            }

        </script>
    </head>
   
    <!--<body onload="initialize()">-->
    <body>
       <form method="POST" action="findlocation.php">
          <input type="text" id="user_name" name="user_name" placeholder="User Name">
          <button id="getCords">Locate User</button>
        </form>
        <div id="map" style="width:600px; height:400px">
            <div id="map_canvas" style="width:100%; height:200px"></div>
            <div id="crosshair"></div>
        </div>


    </body>
</html>


 
