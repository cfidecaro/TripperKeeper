var map = {
    map : false,
    current_center : false,
    geocoder : false,
    user_location : false,

    init : function() {
        map.current_center = map.latlng(20, -10);

        var map_config = {
            center: map.current_center,
            zoom: 2,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
//            draggable: false,
//            keyboardShortcuts: false,
//            scrollwheel: false,
            mapTypeControl: false,
            panControl: false,
            streetViewControl: false
        };

        map.map = new google.maps.Map(document.getElementById("map-canvas"), map_config);
        google.maps.event.addDomListener(window, 'resize', map.recenter_map);

        if (navigator.geolocation) {
            map.get_user_location();
        }

        map.geocoder = new google.maps.Geocoder();
    },

    recenter_map : function() {
        map.map.panTo(map.current_center);
    },

    get_user_location : function() {
        var timeoutVal = 10 * 1000 * 1000,
            options = {
                enableHighAccuracy: true,
                timeout: timeoutVal,
                maximumAge: 0
            };

        navigator.geolocation.getCurrentPosition(
            function(position) {
                map.user_location = map.current_center = map.latlng(position.coords.latitude, position.coords.longitude);

                map.add_marker(map.user_location);

                map.map.setCenter(map.user_location);
                map.map.setZoom(12);
            },
            function(error) {
                var errors = {
                    1: 'Permission denied',
                    2: 'Position unavailable',
                    3: 'Request timeout'
                };

                alert("Error: " + errors[error.code]);
            },
            options
        );
    },

    latlng : function(lat, lng) {
        return new google.maps.LatLng(lat, lng);
    },

    add_marker : function(latlng) {
        var options = {
            map : map.map,
            animation: google.maps.Animation.DROP,
            position: latlng
        };

        return new google.maps.Marker(options);
    },

    geocode : function(address, callback) {
        var results,
            geocode_config = {
                'address' : address,
                'bounds'  : map.map.getBounds()
            };

        map.geocoder.geocode(geocode_config, function(locations, status) {
            results = {
                locations : locations,
                status    : status,
                success   : !!(status == google.maps.GeocoderStatus.OK)
            };

            console.log(results);
            callback(results);
        });
    },

    adjust_bounds : function(stops) {
        var bounds = new google.maps.LatLngBounds();

        for (var i = 0, count = stops.length; i < count; i++) {
            bounds.extend(stops[i].geometry.location);
        }

        map.map.fitBounds(bounds);
    }
};

google.maps.event.addDomListener(window, 'load', map.init);