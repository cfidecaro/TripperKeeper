var ajax = {
    post : function(url, data, success, fail) {
        ajax.go(url, data, success, fail, 'POST');
    },

    get : function(url, data, success, fail) {
        ajax.go(url, data, success, fail, 'GET');
    },

    go : function(url, data, success, fail, type) {
        if (typeof fail =='undefined') {
            fail = function() {
                console.log("Error loading: ", url);
            }
        }

        if (typeof data =='undefined') {
            data = null;
        }

        var options = {
            url : url,
            type : type,
            data : data,
            dataType : 'json',
            success : success,
            error : fail
        };

        $.ajax(options);
    }
};