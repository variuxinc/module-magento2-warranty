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
        'mage/validation',
        'domReady!'
    ], function ($, ko, Component, Api, Confirmation, modal, helper, messageList) {
        'use strict';

        const WarrantySroFormSelector = "#warranty-sro-form";
        const AddMaterialPopupSelector = "#add-material-popup";
        const AddLaborPopupSelector = "#add-labor-popup";
        const AddFreightPopupSelector = "#add-freight-popup";
        const AddFeePopupSelector = "#add-fee-popup";
        const DocumentsPopupSelector = "#warranty-documents-popup";
        const AddDocumentsPopupSelector = "#add-document-popup";

        const TYPE_FREIGHT = "freight";
        const TYPE_IMPORT_FEE = "import_fee";

        return Component.extend({
            defaults: {
                template: 'Variux_Warranty/warranty-sro',
                materialForm: 'Variux_Warranty/popup/material-form',
                laborForm: 'Variux_Warranty/popup/labor-form',
                freightForm: 'Variux_Warranty/popup/freight-form',
                feeForm: 'Variux_Warranty/popup/fee-form',
                documentsForm: 'Variux_Warranty/popup/documents',

                materialList: 'Variux_Warranty/material-list',
                laborList: 'Variux_Warranty/labor-list',
                miscList: 'Variux_Warranty/misc-list',
                documentList: 'Variux_Warranty/document-list'
            },

            warranty: ko.observable({}),
            sro: ko.observable({}),
            labors: ko.observableArray([]),
            materials: ko.observableArray([]),
            miscs: ko.observableArray([]),
            docs: ko.observableArray([]),

            miscFormData: ko.observable({
                item_id: ko.observable(""),
                sro_id: ko.observable(""),
                amount: ko.observable(""),
                misc_code: ko.observable(""),
                note: ko.observable(""),
                description: ko.observable(""),
                type: ko.observable(""),
            }),

            currentMisc: null,

            resetMiscForm: function () {
                this.miscFormData().item_id("");
                this.miscFormData().sro_id("");
                this.miscFormData().amount("");
                this.miscFormData().misc_code("");
                this.miscFormData().note("");
                this.miscFormData().description("");
                this.miscFormData().type("");
            },

            laborFormData: ko.observable({
                item_id: ko.observable(""),
                sro_id: ko.observable(""),
                work_code: ko.observable(""),
                hour_worked: ko.observable(""),
                note: ko.observable(""),
                description: ko.observable(""),
            }),

            currentLabor: null,

            resetLaborForm: function () {
                this.laborFormData().item_id("");
                this.laborFormData().sro_id("");
                this.laborFormData().work_code("");
                this.laborFormData().hour_worked("");
                this.laborFormData().note("");
                this.laborFormData().description("");
            },

            materialFormData: ko.observable({
                item_id: ko.observable(""),
                sro_id: ko.observable(""),
                item: ko.observable(""),
                um: ko.observable(""),
                qty_conv: ko.observable(""),
                note: ko.observable(""),
                description: ko.observable(""),
                price: ko.observable(""),
            }),

            currentMaterial: null,

            resetMaterialForm: function () {
                this.materialFormData().item_id("");
                this.materialFormData().item("");
                this.materialFormData().um("");
                this.materialFormData().qty_conv("");
                this.materialFormData().note("");
                this.materialFormData().description("");
                this.materialFormData().price("");
            },

            umOptions: ko.observableArray([]),

            sroNumber: ko.observable(),
            incNumber: ko.observable(),
            currentTransaction: ko.observable(),

            freightMiscCode: ko.observable("FRT"),
            importFeeMiscCode: ko.observable("IMP"),

            haveWarrantyTicketId: ko.observable(false),

            itemIsNPN: function () {
                return window.warranty_sro.materialFormData().item() === "NPN"
            },

            itemIsNPNBind: ko.observable(),

            workCodeIsMC: function () {
                return window.warranty_sro.laborFormData().work_code() === "MC"
            },

            workCodeIsMCBind: ko.observable(),

            initialize: function (config) {
                window.warranty_sro = this;
                this._super();
                if (window.WarrantyModule) {
                    if (window.WarrantyModule.warranty) {
                        this.warranty(helper.convertToObserver(window.WarrantyModule.warranty));
                    }
                    this.incNumber.subscribe(function (value) {
                        window.warranty_sro.sro().inc_num = ko.observable(value);
                        window.warranty_sro.haveWarrantyTicketId(true);
                    });
                    if (window.WarrantyModule.sro) {
                        this.sro(helper.convertToObserver(window.WarrantyModule.sro));
                        if (window.WarrantyModule.sro.sro_num) {
                            this.sroNumber(window.WarrantyModule.sro.sro_num);
                            this.incNumber(window.WarrantyModule.warranty.inc_num);
                        }
                    }

                    if (window.WarrantyModule.labors) {
                        this.labors(helper.convertToObserverList(window.WarrantyModule.labors));
                    }
                    if (window.WarrantyModule.materials) {
                        this.materials(helper.convertToObserverList(window.WarrantyModule.materials));
                    }
                    if (window.WarrantyModule.miscs) {
                        this.miscs(helper.convertToObserverList(window.WarrantyModule.miscs));
                    }
                    if (window.WarrantyModule.docs) {
                        this.docs(helper.convertToObserverList(window.WarrantyModule.docs));
                    }

                    if (window.WarrantyModule.dataConfig && window.WarrantyModule.dataConfig.options && window.WarrantyModule.dataConfig.options.um) {
                        this.umOptions(window.WarrantyModule.dataConfig.options.um);
                    }

                    this.sroNumber.subscribe(function (value) {
                        window.warranty_sro.sro().sro_num = ko.observable(value);
                    });
                    this.incNumber.subscribe(function (value) {
                        window.warranty_sro.sro().inc_num = ko.observable(value);
                        window.warranty_sro.haveWarrantyTicketId(true);
                    });
                    this.materialFormData().item.subscribe(function (value) {
                        window.warranty_sro.itemIsNPNBind(value === "NPN");
                    });
                    this.laborFormData().work_code.subscribe(function (value) {
                        window.warranty_sro.workCodeIsMCBind(value === "MC");
                    });
                        if (window.warranty_sro.incNumber() == null || window.warranty_sro.incNumber() === "" || window.warranty_sro.sroNumber() == null || window.warranty_sro.sroNumber() === "") {
                            let updateSroNum = setInterval(function () {
                                $.ajax({
                                    type: "POST",
                                    url: window.WarrantyModule.updateSroNumUrl,
                                    data: {warranty_id: window.WarrantyModule.warranty.warranty_id},
                                    cache: false,
                                    success: function (data) {
                                        data = JSON.parse(data)
                                        if (typeof data.inc_num != 'undefined' && data.inc_num != null) {
                                            window.warranty_sro.incNumber(data.inc_num);
                                        }
                                        if (typeof data.sro_num != 'undefined' && data.sro_num != null) {
                                            window.warranty_sro.sroNumber(data.sro_num);
                                        }
                                        if (window.warranty_sro.incNumber() != null && window.warranty_sro.incNumber() !== "" && window.warranty_sro.sroNumber() != null && window.warranty_sro.sroNumber() !== "") {
                                            clearInterval(updateSroNum);
                                        }
                                    }
                                });
                            }, 5000);
                        }
                }
            },

            // toast: function(message){
            //
            //     switch(message.type)
            //     {
            //         case 'success':
            //             if (window.WarrantyModule.dataConfig.toast.success.icon === 1) {
            //                 $.toast({
            //                     text: message.message,
            //                     showHideTransition: 'slide',
            //                     icon: 'success',
            //                     position: window.WarrantyModule.dataConfig.toast.success.position,
            //                     hideAfter: 20000,
            //                     bgColor: window.WarrantyModule.dataConfig.toast.success.background,
            //                     textColor: window.WarrantyModule.dataConfig.toast.success.font,
            //                     loader: false
            //                 });
            //             }else {
            //                 $.toast({
            //                     text: message.message,
            //                     showHideTransition: 'slide',
            //                     position: window.WarrantyModule.dataConfig.toast.success.position,
            //                     hideAfter: 20000,
            //                     bgColor: window.WarrantyModule.dataConfig.toast.success.background,
            //                     textColor: window.WarrantyModule.dataConfig.toast.success.font,
            //                     loader: false
            //                 });
            //             }
            //
            //             break;
            //         case 'error':
            //             if (window.WarrantyModule.dataConfig.toast.error.icon === 1) {
            //                 $.toast({
            //                     text: message.message,
            //                     showHideTransition: 'slide',
            //                     icon: 'error',
            //                     position: window.WarrantyModule.dataConfig.toast.error.position,
            //                     hideAfter: 20000,
            //                     bgColor: window.WarrantyModule.dataConfig.toast.error.background,
            //                     textColor: window.WarrantyModule.dataConfig.toast.error.font,
            //                     loader: false
            //                 });
            //             }else {
            //                 $.toast({
            //                     text: message.message,
            //                     showHideTransition: 'slide',
            //                     position: window.WarrantyModule.dataConfig.toast.error.position,
            //                     hideAfter: 20000,
            //                     bgColor: window.WarrantyModule.dataConfig.toast.error.background,
            //                     textColor: window.WarrantyModule.dataConfig.toast.error.font,
            //                     loader: false
            //                 });
            //             }
            //
            //             break;
            //         case 'warning':
            //             if (window.WarrantyModule.dataConfig.toast.warning.icon === 1) {
            //                 $.toast({
            //                     text: message.message,
            //                     showHideTransition: 'slide',
            //                     icon: 'warning',
            //                     position: window.WarrantyModule.dataConfig.toast.warning.position,
            //                     hideAfter: 20000,
            //                     bgColor: window.WarrantyModule.dataConfig.toast.warning.background,
            //                     textColor: window.WarrantyModule.dataConfig.toast.warning.font,
            //                     loader: false
            //                 });
            //             }else {
            //                 $.toast({
            //                     text: message.message,
            //                     showHideTransition: 'slide',
            //                     position: window.WarrantyModule.dataConfig.toast.warning.position,
            //                     hideAfter: 20000,
            //                     bgColor: window.WarrantyModule.dataConfig.toast.warning.background,
            //                     textColor: window.WarrantyModule.dataConfig.toast.warning.font,
            //                     loader: false
            //                 });
            //             }
            //
            //             break;
            //         case 'info':
            //             if (window.WarrantyModule.dataConfig.toast.info.icon === 1) {
            //                 $.toast({
            //                     text: message.message,
            //                     showHideTransition: 'slide',
            //                     icon: 'info',
            //                     position: window.WarrantyModule.dataConfig.toast.info.position,
            //                     hideAfter: 20000,
            //                     bgColor: window.WarrantyModule.dataConfig.toast.info.background,
            //                     textColor: window.WarrantyModule.dataConfig.toast.info.font,
            //                     loader: false
            //                 });
            //             }else {
            //                 $.toast({
            //                     text: message.message,
            //                     showHideTransition: 'slide',
            //                     position: window.WarrantyModule.dataConfig.toast.info.position,
            //                     hideAfter: 20000,
            //                     bgColor: window.WarrantyModule.dataConfig.toast.info.background,
            //                     textColor: window.WarrantyModule.dataConfig.toast.info.font,
            //                     loader: false
            //                 });
            //
            //             }
            //
            //             break;
            //         case 'notice':
            //             if (window.WarrantyModule.dataConfig.toast.warning.icon === 1) {
            //                 $.toast({
            //                     text: message.message,
            //                     showHideTransition: 'slide',
            //                     icon: 'warning',
            //                     position: window.WarrantyModule.dataConfig.toast.notice.position,
            //                     hideAfter: 20000,
            //                     bgColor: window.WarrantyModule.dataConfig.toast.notice.background,
            //                     textColor: window.WarrantyModule.dataConfig.toast.notice.font,
            //                     loader: false
            //                 });
            //             }else {
            //                 $.toast({
            //                     text: message.message,
            //                     showHideTransition: 'slide',
            //                     position: window.WarrantyModule.dataConfig.toast.notice.position,
            //                     hideAfter: 20000,
            //                     bgColor: window.WarrantyModule.dataConfig.toast.notice.background,
            //                     textColor: window.WarrantyModule.dataConfig.toast.notice.font,
            //                     loader: false
            //                 });
            //             }
            //
            //             break;
            //         default :
            //             if (window.WarrantyModule.dataConfig.toast.info.icon === 1) {
            //                 $.toast({
            //                     text: message.message,
            //                     showHideTransition: 'slide',
            //                     icon: 'info',
            //                     position: window.WarrantyModule.dataConfig.toast.info.position,
            //                     hideAfter: 20000,
            //                     bgColor: window.WarrantyModule.dataConfig.toast.info.background,
            //                     textColor: window.WarrantyModule.dataConfig.toast.info.font,
            //                     loader: false
            //                 })
            //             }else {
            //                 $.toast({
            //                     text: message.message,
            //                     showHideTransition: 'slide',
            //                     position: window.WarrantyModule.dataConfig.toast.info.position,
            //                     hideAfter: 20000,
            //                     bgColor: window.WarrantyModule.dataConfig.toast.info.background,
            //                     textColor: window.WarrantyModule.dataConfig.toast.info.font,
            //                     loader: false
            //                 })
            //             }
            //             break;
            //     }
            // },

            backWarranties: function () {
                if (window.WarrantyModule.url.backUrl) {
                    window.location.href = window.WarrantyModule.url.backUrl;
                }
            },

            submitClaim: function () {
                var self = this;
                var isValid = $(WarrantySroFormSelector).validation() && $(WarrantySroFormSelector).validation("isValid");
                if (isValid) {
                    Confirmation({
                        title: $.mage.__('Confirm'),
                        content: $.mage.__("Are you sure you want to submit this claim? You can no longer edit this claim once it's been submitted."),
                        actions: {
                            confirm: function () {
                                var submitUrl = window.WarrantyModule.url.submitClaimUrl;
                                Api.post(submitUrl, {warranty: self.warranty(), sro: self.sro()}, function (res) {
                                    var res = JSON.parse(res);
                                    if (res.error) {
                                        if (res.msg) {
                                            messageList.addErrorMessage({message: res.msg});
                                        }
                                        return;
                                    }
                                    if (res.msg) {
                                        messageList.addSuccessMessage({message: res.msg});
                                        self.warranty().status("NewCont")
                                    }
                                });
                            },
                            cancel: function () {
                                return;
                            },
                            always: function () {
                                return;
                            }
                        }
                    });
                }
            },

            formDataToTransaction: function (formData) {
                var transaction = this.currentTransaction();
                formData.forEach(function (item) {
                    transaction[item.name](item.value);
                });
            },

            canUploadDocument: function (type) {
                return type === TYPE_IMPORT_FEE;
            },

            openDocuments: function () {
                this.openDocumentsPopup();
            },

            // Material
            addMaterial: function (material) {
                this.materials.unshift(material);
            },

            editMaterial: function (material) {
                this.materialFormData().item_id(material.item_id());
                this.materialFormData().item(material.item());
                this.materialFormData().qty_conv(material.qty_conv());
                this.materialFormData().note(material.note());
                this.materialFormData().description(material.description());
                this.materialFormData().price(material.price().replace("$", ""));
                this.currentMaterial = material;
                this.openMaterialPopup();
            },

            removeMaterial: function (material) {
                var self = this;
                Confirmation({
                    title: $.mage.__('Warning'),
                    content: $.mage.__("Do you sure remove this part?"),
                    actions: {
                        confirm: function () {
                            var removeUrl = window.WarrantyModule.url.removeMaterialUrl;
                            Api.post(removeUrl, material, function (res) {
                                var res = JSON.parse(res);
                                if (res.error) {
                                    if (res.msg) {
                                        messageList.addErrorMessage({message: res.msg});
                                    }
                                    return;
                                }
                                self.materials.remove(material);
                                if (res.msg) {
                                    messageList.addSuccessMessage({message: res.msg});
                                }
                            });
                        },
                        cancel: function () {
                            return;
                        },
                        always: function () {
                            return;
                        }
                    }
                });
            },

            materialItemSelect: function (item, $input, event) {
                $input.val(item.sku).trigger("change");
                $input.closest("form").find("input[name='description']").val(item.name).trigger("change");
                $input.closest("form").find("input[name='price']").val(item.price).trigger("change");
            },

            openMaterialPopup: function () {
                var self = this;
                var $elm = $(AddMaterialPopupSelector);
                var options = {
                    type: 'popup',
                    responsive: true,
                    innerScroll: true,
                    title: $.mage.__('Material'),
                    modalClass: 'warranty-container warranty-modal add-material-modal',
                    closeText: "",
                    buttons: [{
                        text: $.mage.__('Submit'),
                        class: 'action primary',
                        click: async function () {
                            if (self.validateForm(AddMaterialPopupSelector)) {
                                await self.submitMaterialForm();
                                this.closeModal();
                            }
                        }
                    }, {
                        text: $.mage.__('Submit and Add another'),
                        class: 'action primary',
                        click: async function () {
                            if (self.validateForm(AddMaterialPopupSelector)) {
                                await self.submitMaterialForm();
                                self.resetMaterialForm();
                            }
                        }
                    }],
                    closed: function () {
                        self.resetMaterialForm();
                    }
                };
                var popup = modal(options, $elm);
                $elm.modal('openModal');
            },
            // Material


            // Labor
            addLabor: function (labor) {
                this.labors.unshift(labor);
            },

            editLabor: function (labor) {
                this.laborFormData().item_id(labor.item_id());
                this.laborFormData().sro_id(labor.sro_id());
                this.laborFormData().work_code(labor.work_code());
                this.laborFormData().hour_worked(labor.hour_worked());
                this.laborFormData().note(labor.note());
                this.laborFormData().description(labor.description());
                this.currentLabor = labor;
                this.openLaborPopup();
            },

            removeLabor: function (labor) {
                var self = this;
                Confirmation({
                    title: $.mage.__('Warning'),
                    content: $.mage.__("Do you sure remove this part?"),
                    actions: {
                        confirm: function () {
                            var removeUrl = window.WarrantyModule.url.removeLaborUrl;
                            Api.post(removeUrl, labor, function (res) {
                                var res = JSON.parse(res);
                                if (res.error) {
                                    if (res.msg) {
                                        messageList.addErrorMessage({message: res.msg});
                                    }
                                    return;
                                }
                                self.labors.remove(labor);
                                if (res.msg) {
                                    messageList.addSuccessMessage({message: res.msg});
                                }
                            });
                        },
                        cancel: function () {
                            return;
                        },
                        always: function () {
                            return;
                        }
                    }
                });
            },

            submitMiscForm: async function () {
                let item_id = this.miscFormData().item_id();
                let returnData = await this.submitForm(window.WarrantyModule.url.saveMiscUrl, this.miscFormData);
                console.log(returnData);
                if (returnData && !item_id) {
                    this.addMisc(helper.convertToObserver(returnData));
                } else {
                    this.currentMisc.item_id(returnData.item_id);
                    this.currentMisc.amount(returnData.amount);
                    this.currentMisc.misc_code(returnData.misc_code);
                    this.currentMisc.note(returnData.note);
                    this.currentMisc.description(returnData.description);
                    this.currentMisc.type(returnData.type);
                }
            },

            submitLaborForm: async function () {
                let item_id = this.laborFormData().item_id();
                let returnData = await this.submitForm(window.WarrantyModule.url.saveLaborUrl, this.laborFormData);
                if (returnData && !item_id) {
                    this.addLabor(helper.convertToObserver(returnData));
                } else {
                    this.currentLabor.item_id(returnData.item_id);
                    this.currentLabor.work_code(returnData.item_id);
                    this.currentLabor.hour_worked(returnData.item_id);
                    this.currentLabor.note(returnData.item_id);
                    this.currentLabor.description(returnData.item_id);
                    this.currentLabor.item_id(returnData.item_id);
                }
            },

            submitMaterialForm: async function () {
                let item_id = this.materialFormData().item_id();
                let returnData = await this.submitForm(window.WarrantyModule.url.saveMaterialUrl, this.materialFormData);
                if (returnData && !item_id) {
                    this.addMaterial(helper.convertToObserver(returnData));
                } else {
                    this.currentMaterial.item_id(returnData.item_id);
                    this.currentMaterial.item(returnData.item);
                    this.currentMaterial.um(returnData.um);
                    this.currentMaterial.qty_conv(returnData.qty_conv);
                    this.currentMaterial.note(returnData.note);
                    this.currentMaterial.description(returnData.description);
                    this.currentMaterial.price(returnData.price);
                }
            },

            validateForm: function (formSelector) {
                let $elm = $(formSelector);
                let self = this;
                let $form = $elm.find("form");
                let isValid = $form.validation() && $form.validation("isValid");
                return !!isValid;
            },

            submitForm: async function (saveUrl, formData) {
                let self = this;
                formData().sro_id(self.sro().sro_id());
                let res = await Api.post(saveUrl, formData());
                res = JSON.parse(res);
                if (res.error) {
                    if (res.msg) {
                        messageList.addErrorMessage({message: res.msg});
                    }
                    return false;
                }
                if (res.msg) {
                    messageList.addSuccessMessage({message: res.msg});
                }
                return res.data;
            },

            openLaborPopup: function () {
                var self = this;
                let $elm = $(AddLaborPopupSelector);
                var options = {
                    type: 'popup',
                    responsive: true,
                    innerScroll: true,
                    title: $.mage.__('Labor'),
                    modalClass: 'warranty-container warranty-modal add-labor-modal',
                    closeText: "",
                    buttons: [{
                        text: $.mage.__('Submit'),
                        class: 'action primary',
                        click: async function () {
                            if (self.validateForm(AddLaborPopupSelector)) {
                                await self.submitLaborForm();
                                this.closeModal();
                            }
                        }
                    }, {
                        text: $.mage.__('Submit and Add another'),
                        class: 'action primary',
                        click: async function () {
                            if (self.validateForm(AddLaborPopupSelector)) {
                                await self.submitLaborForm();
                                self.resetLaborForm();
                            }
                        }
                    }],
                    closed: function () {
                        self.resetLaborForm();
                    }
                };
                let popup = modal(options, $elm);
                $elm.modal('openModal');
            },
            // Labor

            // Misc
            addMisc: function (misc) {
                this.miscs.unshift(misc);
            },

            editMisc: function (misc) {
                this.miscFormData().item_id(misc.item_id());
                this.miscFormData().sro_id(misc.sro_id());
                this.miscFormData().amount(misc.amount());
                this.miscFormData().misc_code(misc.misc_code());
                this.miscFormData().note(misc.note());
                this.miscFormData().description(misc.description());
                this.miscFormData().type(misc.type());
                this.currentMisc = misc;
                if (misc.type() === TYPE_IMPORT_FEE) {
                    this.openFeePopup();
                }
                if (misc.type() === TYPE_FREIGHT) {
                    this.openFreightPopup();
                }
            },

            removeMisc: function (misc) {
                var self = this;
                Confirmation({
                    title: $.mage.__('Warning'),
                    content: $.mage.__("Do you sure remove this part?"),
                    actions: {
                        confirm: function () {
                            var removeUrl = window.WarrantyModule.url.removeMiscUrl;
                            Api.post(removeUrl, misc, function (res) {
                                var res = JSON.parse(res);
                                if (res.error) {
                                    if (res.msg) {
                                        messageList.addErrorMessage({type: "error", message: res.msg});
                                    }
                                    return;
                                }
                                self.miscs.remove(misc);
                                if (res.msg) {
                                    messageList.addSuccessMessage({message: res.msg});
                                }
                            });
                        },
                        cancel: function () {
                            return;
                        },
                        always: function () {
                            return;
                        }
                    }
                });
            },
            // Misc

            // Freight
            isMissSales: function () {
                if (
                    (this.warranty().invoice_number && this.warranty().invoice_number()) ||
                    (this.warranty().order_number && this.warranty().order_number())
                ) {
                    return false;
                }

                return true;
            },
            getFreightRequiredSaleMsg: function () {
                return $.mage.__("Invoice Number or Sales Order number is required on linked Sro [%1] to add Freight to SRO [%2].")
                    .replace("%1", this.warranty().warranty_id())
                    .replace("%2", this.sro().sro_num ? this.sro().sro_num() : '');
            },

            openFreightPopup: function () {
                var self = this;
                self.miscFormData().type(TYPE_FREIGHT);
                self.miscFormData().description("Freight");
                self.miscFormData().misc_code("FRT");
                var $elm = $(AddFreightPopupSelector);
                var modeEdit = !!self.currentTransaction();
                var options = {
                    type: 'popup',
                    responsive: true,
                    innerScroll: true,
                    title: $.mage.__('Freight'),
                    modalClass: 'warranty-container warranty-modal add-freight-modal',
                    closeText: "",
                    buttons: [{
                        text: $.mage.__('Submit'),
                        class: 'action primary',
                        click: async function () {
                            if (!self.isMissSales() && self.validateForm(AddFreightPopupSelector)) {
                                await self.submitMiscForm();
                                this.closeModal();
                            }
                        }
                    }, {
                        text: $.mage.__('Submit and Add another'),
                        class: 'action primary',
                        click: async function () {
                            if (!self.isMissSales() && self.validateForm(AddFreightPopupSelector)) {
                                await self.submitMiscForm();
                                self.resetMiscForm();
                                self.miscFormData().type(TYPE_FREIGHT);
                                self.miscFormData().description("Freight");
                                self.miscFormData().misc_code("FRT");
                            }
                        }
                    }],
                    closed: function () {
                        self.resetMiscForm()
                    }
                };
                var popup = modal(options, $elm);
                $elm.modal('openModal');
            },
            // Freight

            // Import Fee
            openFeePopup: function () {
                var self = this;
                self.miscFormData().type(TYPE_IMPORT_FEE);
                self.miscFormData().description("Import");
                self.miscFormData().misc_code("IMP");
                var $elm = $(AddFeePopupSelector);
                var modeEdit = !!self.currentTransaction();
                var options = {
                    type: 'popup',
                    responsive: true,
                    innerScroll: true,
                    title: $.mage.__('Import Fee'),
                    modalClass: 'warranty-container warranty-modal add-fee-modal',
                    closeText: "",
                    buttons: [{
                        text: $.mage.__('Submit'),
                        class: 'action primary',
                        click: async function () {
                            if (self.validateForm(AddFeePopupSelector)) {
                                await self.submitMiscForm();
                                this.closeModal();
                            }
                        }
                    }, {
                        text: $.mage.__('Submit and Add another'),
                        class: 'action primary',
                        click: async function () {
                            if (self.validateForm(AddFeePopupSelector)) {
                                await self.submitMiscForm();
                                self.resetMiscForm();
                                self.miscFormData().type(TYPE_IMPORT_FEE);
                                self.miscFormData().description("Import");
                                self.miscFormData().misc_code("IMP");
                            }
                        }
                    }],
                    closed: function () {
                        self.resetMiscForm()
                    }
                };
                var popup = modal(options, $elm);
                $elm.modal('openModal');
            },
            // Import Fee

            // Document
            openNewDocumentPopup: function () {
                var self = this;
                var $elm = $(AddDocumentsPopupSelector);
                var options = {
                    type: 'popup',
                    responsive: true,
                    innerScroll: true,
                    title: $.mage.__('Document upload'),
                    modalClass: 'warranty-container warranty-modal documents-modal',
                    closeText: "",
                    buttons: [{
                        text: $.mage.__('Add'),
                        class: 'action primary',
                        click: function () {
                            let $form = $elm.find("form");
                            let $inputFile = $form.find('input[name=file]');
                            let $maxSize = window.WarrantyModule.dataConfig.maxFileSize * 1048576; //Mb to Byte
                            var isValid = $form.validation() && $form.validation("isValid");
                            if($inputFile[0].files[0].size != undefined){
                                var fileSize = $inputFile[0].files[0].size;
                                if(fileSize > $maxSize){
                                    messageList.addErrorMessage({message: 'File size must be less than ' + window.WarrantyModule.dataConfig.maxFileSize + 'Mb.'});
                                    return;
                                }
                            }
                            if (!isValid) {
                                return;
                            }
                            var formData = new FormData($form[0]);
                            formData.append("sro_id", self.sro().sro_id());
                            var saveUrl = window.WarrantyModule.url.saveDocumentUrl;
                            var modal = this;
                            $.ajax({
                                url: saveUrl,
                                type: 'POST',
                                data: formData,
                                success: function (data) {
                                    let res = JSON.parse(data);
                                    if (res.error) {
                                        if (res.msg) {
                                            messageList.addErrorMessage({message: res.msg});
                                        }
                                    } else {
                                        messageList.addSuccessMessage({message: res.msg});
                                        self.docs.unshift(helper.convertToObserver(res.data));
                                        modal.closeModal();
                                    }
                                },
                                error: function () {
                                    messageList.addErrorMessage({message: "Cannot submit document, please contact administrator"});
                                },
                                cache: false,
                                contentType: false,
                                processData: false
                            });
                        }
                    }],
                    outerClickHandler: function (event) {

                    },
                    closed: function () {
                        $elm.find("form")[0].reset();
                    }
                };
                var popup = modal(options, $elm);
                $elm.find("form input").val("").trigger("change");
                $elm.modal('openModal');
            },

            workcodeSuggestSelect: function (item, $input, event) {
                $input.val(item.code).trigger("change");
                $input.closest("form").find("input[name='description']").val(item.description).trigger("change");
                $input.closest("form").find("input[name='hour_worked']").val(item.duration).trigger("change");
            },

            makeDatePicker: function (elm) {
                $(elm).find('input[data-type=date]').each(function () {
                    $(this).calendar({
                        changeMonth: true,
                        changeYear: true,
                        buttonText: $.mage.__("Select Date"),
                        showOn: "both",
                        autoComplete: false
                    });
                });
            }
        });
    });
