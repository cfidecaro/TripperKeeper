var trip = {
    init : function() {
        // Bind things
        $('#add-stop').live('keyup', function(e) {
            if (e.which == 13) {
                trip.geocode_stop();
            }
        });

        $('#add-stop-btn').live('click', function(e) {
            trip.geocode_stop();
        });
    },

    geocode_stop : function() {
        $('#add-stop-btn').button('loading');
        $('#add-stop').attr('disabled', 'disabled');

        map.geocode($('#add-stop').val(), trip.add_stop);
    },

    add_stop : function(results) {
        if (results.success) {
            var first_result = results.locations[0];

            marker = map.add_marker(first_result.geometry.location);
            $('#stops').append('<li>' + first_result.formatted_address + '</li>');
            $('#add-stop').removeAttr('disabled').val('');
            $('#add-stop-btn').button('reset');
        } else {
            $('#add-stop-msg').text("We couldn't find that address. Please try again Error: " + results.status);
        }
    }
};

trip.init();
