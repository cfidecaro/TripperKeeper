var post = {
    init : function() {
        $('#new-post-btn').bind('click', function() {
            $('#post-types').slideDown();

            return false;
        });

        $('#post-types').find('li').find('a').bind('click', function() {
            $('#post-types').slideUp();
        });
    }
};

$(function() {
    post.init();
});