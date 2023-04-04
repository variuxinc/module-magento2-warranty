
define([
    'ko',
    'jquery',
    'require',
    'Magento_Catalog/js/price-utils',
    'mage/translate'

], function (ko, $, require, priceUtils, Translate) {
    'use strict';
    var Helper = {
        initialize: function () {
            var self = this;

            return self;
        },
        __: function (string) {
            return Translate(string);
        },

        getView: function (viewName) {
            var view = this._convertModelPath(viewName);
            if(!window.WarrantyViews) {
                window.WarrantyViews = {};
            }
            if(!window.WarrantyViews[view]) {
                var viewClass = require('Variux_Warranty/js/view/'+viewName);
                window.WarrantyViews[view] = viewClass();
            }
            return window.WarrantyViews[view];
        },

        /**
         * convert model name to key
         *
         * @param string modelName
         * @returns string
         */
        _convertModelPath: function (modelName) {
            modelName = modelName.replace(/\//gi, '_');
            modelName = modelName.replace(/-/gi, '');
            modelName = modelName.replace(/\./gi, '');
            return modelName;
        },

        convertToObserverList: function (arr) {
            var self = this;
            var newList = [];
            $.each(arr, function (i, obj) {
                var newObj = {};
                Object.keys(obj).forEach(function (key) {
                    if (Array.isArray(obj[key])) {
                        newObj[key] = ko.observableArray(self.convertToObserverList(obj[key]));
                    } else {
                        newObj[key] = ko.observable(obj[key]);
                    }
                    // newObj[key] = ko.observable(obj[key]);
                });
                newList.push(newObj);
            });
            return newList;
        },

        convertFormDataToObserver: function (object) {
            var newObj = {};
            Object.keys(object).forEach(function (key) {
                newObj[object[key]['name']] = ko.observable(object[key]['value']);
            });
            return newObj;
        },

        convertToObserver: function (object) {
            var self = this;
            var newObj = {};
            Object.keys(object).forEach(function (key) {
                if (Array.isArray(object[key])) {
                    newObj[key] = ko.observableArray(self.convertToObserverList(object[key]));
                } else {
                    newObj[key] = ko.observable(object[key]);
                }
            });
            return newObj;
        },

        convertToStandardData: function (object) {
            var self = this;
            var newObj = {};
            if (Array.isArray(object)) {
                newObj = [];
                $.each(object, function (i, child) {
                    var newChild = self.convertToStandardData(child);
                    newObj.push(newChild);
                });
            } else {
                Object.keys(object).forEach(function (key) {
                    if (typeof object[key] == "function") {
                        if (Array.isArray(object[key]())) {
                            newObj[key] = self.convertToStandardData(object[key]());
                        } else {
                            newObj[key] = object[key]();
                        }
                    } else {
                        newObj[key] = object[key];
                    }
                });
            }
            return newObj;
        },

        addUrlParameter: function (sourceUrl, parameterName, parameterValue, replaceDuplicates) {
            if ((sourceUrl == null) || (sourceUrl.length == 0)) sourceUrl = document.location.href;
            var urlParts = sourceUrl.split("?");
            var newQueryString = "";
            if (urlParts.length > 1)
            {
                var parameters = urlParts[1].split("&");
                for (var i=0; (i < parameters.length); i++)
                {
                    var parameterParts = parameters[i].split("=");
                    if (!(replaceDuplicates && parameterParts[0] == parameterName))
                    {
                        if (newQueryString == "")
                            newQueryString = "?";
                        else
                            newQueryString += "&";
                        newQueryString += parameterParts[0] + "=" + parameterParts[1];
                    }
                }
            }
            if (newQueryString == "")
                newQueryString = "?";
            else
                newQueryString += "&";
            newQueryString += parameterName + "=" + parameterValue;

            return urlParts[0] + newQueryString;
        }
    };
    return Helper.initialize();
});
