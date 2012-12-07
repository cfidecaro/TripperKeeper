var trip = {
    stops : [],

    init : function() {
        // Bind things
        $('#trip-name').live('blur', function(e) {
            if ($(this).data('trip-id')) {
                trip.update();
            } else {
                trip.create();
            }
        });

        $('input.add-stop').live('keydown', function(e) {
            if (e.which == 13) {
                e.preventDefault();

                trip.geocode_stop();
                $(this).focus();
                return false;
            }
        });
    },

    create : function() {
        var trip_name_input = $('#trip-name'),
            name = trip_name_input.val();

        ajax.post('trips/create', {name : name}, function(response) {
            console.log(response);
            trip_name_input.addClass('ok').data('trip-id', response.id);
            $('input.add-stop').removeAttr('disabled').focus();
        });
    },

    update : function() {
        var trip_name_input = $('#trip-name'),
            name = trip_name_input.val();

        ajax.post('trips/update', {name : name, 'trip-id' : trip_name_input.data('trip-id')}, function(response) {
            trip_name_input.addClass('ok');
        });
    },

    geocode_stop : function() {
        var current_input = $('.add-stop.current'),
            control_group = current_input.parents('.control-group');

        control_group.removeClass('error').find('.help-block').remove();
        current_input.attr('disabled', 'disabled').addClass('searching');
        map.geocode(current_input.val(), trip.add_stop);
    },

    add_stop : function(results) {
        var current_input = $('.add-stop.current'),
            control_group = current_input.parents('.control-group');

        if (results.success) {
            var stop = results.locations[0];
            console.log(results);

            marker = map.add_marker(stop.geometry.location);
            trip.stops.push(stop);
            map.adjust_bounds(trip.stops);

            var trip_id   = $('#trip-name').data('trip-id'),
                current_n = parseInt(current_input.data('count')),
                next_n    = current_n + 1,
                new_input = $('<input>').attr({
                    'type'       : 'text',
                    'name'       : 'stops[]',
                    'data-count' : next_n,
                    'id'         : 'add-stop-' + next_n,
                    'class'      : 'add-stop current'
                });

            current_input
                .removeAttr('disabled')
                .removeClass('searching current')
                .addClass('ok');

            $('<div></div>', {class : 'control-group'}).append(new_input).insertAfter(control_group).find('#add-stop-' + next_n).focus();

            data = {
                address : stop.formatted_address,
                lat     : stop.geometry.location.lat(),
                lng     : stop.geometry.location.lng(),
                order   : current_n
            };

            ajax.post('trips/' + trip_id + '/add_stop', data, function(response) {
                console.log(response);
            });
        } else {
            control_group.addClass('error').append($('<p>').addClass('help-block').text("We couldn't find that address. Please try again Error: " + results.status));
            current_input.removeAttr('disabled').removeClass('searching');
        }
    }
};

trip.init();