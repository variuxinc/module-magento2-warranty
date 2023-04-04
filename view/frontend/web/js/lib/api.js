
define(
    [
        'ko',
        'jquery'
    ],
    function (ko, $) {
        "use strict";

        var Api = {
            initialize: function () {
                var self = this;
                return self;
            },

            post: function (url, param, callFunction, type) {
                $('body').trigger('processStart');
                return $.post(url, param, callFunction, type)
                    .always(function(){
                        $('body').trigger('processStop');
                    });
            },
            get: function (url, callFunction, type) {
                $('body').trigger('processStart');
                return $.get(url, callFunction)
                    .always(function(){
                        $('body').trigger('processStop');
                    });
            },
            callApi: function (url, param, method, callFunction, type) {
                $('body').trigger('processStart');
                return $.ajax({
                    url: url,
                    type: method,
                    contentType:"application/json; charset=utf-8",
                    dataType: type,
                    data: JSON.stringify(param),
                    success: callFunction
                }).always(function(){
                    $('body').trigger('processStop');
                });
            }
        };
        return Api.initialize();
    }
);
