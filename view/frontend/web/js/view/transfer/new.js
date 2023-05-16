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
            defaults: {
                template: 'Variux_Warranty/transfer/new'
            },
            initialize: function (config) {
                this._super();
                const self = this;
                this.showProgressBar(false);
                this.progressBarValue(0);
                window.warrantyTransfer = this;
                if (window.InitData) {
                    this.formData(helper.convertToObserver(window.InitData.formData));
                }
            },
            showProgressBar : ko.observable(),
            progressBarValue : ko.observable(),
            submitWarrantyTransferForm: async function () {
                let self = this;
                let $form = $("form#warranty-transfer-form");
                let isValid = $form.validation() && $form.validation("isValid");
                if (isValid) {
                    $("button.claim-btn").attr("disabled", true);
                    var formData = new FormData($form[0]);
                    self.showProgressBar(true);
                    $.ajax({
                        xhr: function() {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function(evt) {
                                if (evt.lengthComputable) {
                                    var percentComplete = (evt.loaded / evt.total) * 100;
                                    self.progressBarValue(percentComplete.toFixed(2));
                                }
                            }, false);
                            return xhr;
                        },
                        url: "/warranty/transfer/save",
                        type: 'POST',
                        data: formData,
                        success: function (data) {
                            let res = JSON.parse(data);
                            if (res.error) {
                                if (res.msg) {
                                    messageList.addErrorMessage({message: res.msg});
                                    $("button.claim-btn").attr("disabled", false);
                                }
                            } else {
                                messageList.addSuccessMessage({message: res.msg});
                                setTimeout(function () {
                                    location.reload();
                                }, 5000);
                            }
                        },
                        error: function () {
                            messageList.addErrorMessage({message: "Cannot submit warranty transfer, please contact administrator"});
                            $("button.claim-btn").attr("disabled", false);
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                }
            },
            engineSelect: function (item, $input, event) {
                $input.val(item.serial_no).trigger("change");
                $input.closest("form").find("input#warr_start_date").val(item.warranty_start_date).trigger("change");
                $input.closest("form").find("input#warr_end_date").val(item.warranty_end_date).trigger("change");
                $input.closest("form").find("input#engine_model").val(item.item).trigger("change");
                $input.closest("form").find("input#cur_consumer").val(item.consumer_name).trigger("change");
                $input.closest("form").find("input#engine_desc").val(item.description).trigger("change");
                if(item.warranty_end_date !== "") {
                    let endDate = new Date(item.warranty_end_date);
                    let todayDate = new Date(); //Today Date
                    if (todayDate > endDate) {
                        messageList.addErrorMessage({message:'This warranty is expired.'});
                    }
                }
            },
            formData: ko.observable(),
            makeDatePicker: function (elm) {
                $(elm).find('input[data-type=date]').each(function () {
                    $(this).calendar({
                        changeMonth: true,
                        changeYear: true,
                        buttonText: $.mage.__("Select Date"),
                        showOn: "both",
                        autoComplete: false,
                        dateFormat: "yy-mm-dd",
                    });
                });
            },
            processFile: async function (file) {
                let documentFile = {};
                documentFile.name = file.name;
                documentFile.size = file.size;
                documentFile.type = file.type;
                await new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function () {
                        return resolve(
                            documentFile.content = reader.result
                        );
                    };
                    reader.onerror = error => reject(error);
                });
                return documentFile;
            }
        })
    });
