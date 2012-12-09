var post = {
    init : function() {
        $('#new-post-btn').bind('click', function() {
            $('#new-post').animate({left : 0}, 'fast');

            var panBy = (($(window).width()-$('#new-post').width())/2)-($(window).width()/2);
            map.map.panBy(panBy, 0);
            return false;
        });

        $('#post-add-media').bind('click', function() {
            $('#post-media').trigger('click');
        });

        $('#new-post').find('form').bind('submit', function() {
            if (map.user_location) {
                var location = JSON.stringify({lat:map.user_location.lat(), lng:map.user_location.lng()});
                $('#post-location').val(location);
            }

            post.save();
            return false;
        });
    },

    save : function() {
        ajax.submit('posts/add_post', $('#new-post-form'), function(response) {
            console.log(response);
        });
    }
};

$(function() {
    post.init();
});