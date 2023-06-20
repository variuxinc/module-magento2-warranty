define(
    [
        'jquery',
        'ko',
        'uiComponent',
        'Variux_Warranty/js/lib/autosuggest',
        'domReady!'
    ], function ($, ko, Component,autosuggest) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'Variux_Warranty/suggestion/engine'
            },
            initialize: function (config) {
                this._super();
                this.engineData = ko.observable(this.engineConfig);
                $("#warranty-submit-btn").show();
                var itemSuggest = new autosuggest($('input#engine'), function (item, $input, event) {
                    $input.val(item.serial_no).trigger("change");
                    var $form = $input.closest("form");
                    $form.find("input[name=description]").val(item.description).trigger("change");
                    $form.find("input[name=item_sku]").val(item.item).trigger("change");
                    $form.find("input[name=warranty_registered]").val(item.warranty_registered).trigger("change");
                    $form.find("input[name=consumer_name]").val(item.consumer_name).trigger("change");
                    $form.find("input[name=warranty_start_date]").val(item.warranty_start_date).trigger("change");
                    $form.find("input[name=warranty_end_date]").val(item.warranty_end_date).trigger("change");
                }).init(this.engineData);
            }
        })
    });
