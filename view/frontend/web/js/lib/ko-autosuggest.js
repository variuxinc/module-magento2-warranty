
define(
    [
        'jquery',
        'ko',
        'Variux_Warranty/js/lib/autosuggest'
    ], function($, ko, Autosuggest) {
        "use strict";

        ko.bindingHandlers.autosuggest = {
            update: function (element, valueAccessor, allBindings) {
                var data = ko.unwrap(valueAccessor());
                new Autosuggest($(element), data.callback).init(data.config);
            }
        }

    });