var maplib = {
    map : false,
    current_center : false,

    init : function() {
        maplib.current_center = maplib.latlng(20, -10);

        var map_config = {
            center: maplib.current_center,
            zoom: 2,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            draggable: false,
            keyboardShortcuts: false,
            scrollwheel: false,
            mapTypeControl: false,
            panControl: false,
            streetViewControl: false
        };

        maplib.map = new google.maps.Map(document.getElementById("map-canvas"), map_config);
        google.maps.event.addDomListener(window, 'resize', maplib.recenter_map);

        if (navigator.geolocation) {
            maplib.get_user_location();
        }
    },

    recenter_map : function() {
        maplib.map.panTo(maplib.current_center);
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
                var user = maplib.current_center = maplib.latlng(position.coords.latitude, position.coords.longitude);

                maplib.map.panTo(user);
                maplib.map.setZoom(13);

                maplib.add_marker(user);
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
            map : maplib.map,
            animation: google.maps.Animation.DROP,
            position: latlng
        };

        return new google.maps.Marker(options);
    }
};

google.maps.event.addDomListener(window, 'load', maplib.init);