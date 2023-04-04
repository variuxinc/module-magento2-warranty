define(
    [
        'jquery',
        'ko',
        'uiComponent',
        'Variux_Warranty/js/lib/api',
        'Magento_Ui/js/modal/confirm',
        'Magento_Ui/js/modal/modal',
        'Variux_Warranty/js/view/helper',
        'Magento_Ui/js/model/messageList',
        'mage/translate',
        'mage/calendar',
        'Variux_Warranty/js/lib/ko-autosuggest',
        'mage/validation'
    ], function ($, ko, Component, Api, Confirmation, modal, helper, messageList) {
        'use strict';

        return Component.extend({
            serialNoSelect: function (item, $input, event) {
                $input.val(item.sku).trigger("change");
                $input.closest("form").find("input[name='description']").val(item.name).trigger("change");
                $input.closest("form").find("select[name='um']").val(item.uom).trigger("change");
            },
            defaults: {
                template: 'Variux_Warranty/warranty-transfer'
            },
            initialize: function (config) {
                this._super();
            },
        })
    });
