var ajax = {
    post : function(url, data, success, fail) {
        ajax.go(url, data, success, fail, 'POST');
    },

    get : function(url, data, success, fail) {
        ajax.go(url, data, success, fail, 'GET');
    },

    submit : function(url, form, success, fail) {
        var form_data = new FormData(form[0]);

        ajax.go(url, form_data, success, fail, 'POST', {contentType : false, processData : false});
    },

    go : function(url, data, success, fail, type, options) {
        if (typeof data =='undefined') {
            data = null;
        }

        if (typeof fail =='undefined') {
            fail = function() {
                console.log("Error loading: ", url);
            }
        }

        if (typeof options == 'undefined') {
            options = {};
        }

        var default_options = {
            url : url,
            type : type,
            data : data,
            dataType : 'json',
            success : success,
            error : fail
        };

        var merged_options = $.extend(true, {}, default_options, options);

        $.ajax(merged_options);
    }
};