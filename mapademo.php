<!DOCTYPE html>

<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <title>Find Latitude and Longitude of Draggable Marker Google Maps API</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgaYby7k-uwnMsLF3Du3hfHtWpH789Xdo"></script>
    <script type="text/javascript">
        function initialize() {
            // Creating map object
            var map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: 12,
                center: new google.maps.LatLng(19.4326077, -99.13320799999997),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            // creates a draggable marker to the given coords
            var vMarker = new google.maps.Marker({
                position: new google.maps.LatLng(19.4326077, -99.13320799999997),
                draggable: true
            });

            // adds a listener to the marker
            // gets the coords when drag event ends
            // then updates the input with the new coords
            google.maps.event.addListener(vMarker, 'dragend', function (evt) {
                $("#txtLat").val(evt.latLng.lat().toFixed(6));
                $("#txtLng").val(evt.latLng.lng().toFixed(6));

                map.panTo(evt.latLng);
            });

            // centers the map on markers coords
            map.setCenter(vMarker.position);

            // adds the marker on the map
            vMarker.setMap(map);
        }
    </script>
</head>
<body onload="initialize();">
    <h2>
        Google Maps Draggable Marker Get Coordinates
    </h2>

    <label for="latitude">
        Latitude:
    </label>
    <input id="txtLat" type="text" style="color:red" value="19.4326077" />
    <label for="longitude">
        Longitude:
    </label>
    <input id="txtLng" type="text" style="color:red" value="-99.13320799999997" /><br />
    <br />
    <br />
    <div id="map_canvas" style="width: auto; height: 500px;">
    </div>

</body>
</html>