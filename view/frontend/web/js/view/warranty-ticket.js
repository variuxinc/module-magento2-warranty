
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
    ], function($, ko, Component, Api, Confirmation, modal, helper, messageList) {
        'use strict';

        const WarrantyTicketFormSelector = "#warranty-ticket-form";
        const AddMaterialPopupSelector = "#add-material-popup";
        const AddLaborPopupSelector = "#add-labor-popup";
        const AddFreightPopupSelector = "#add-freight-popup";
        const AddFeePopupSelector = "#add-fee-popup";
        const DocumentsPopupSelector = "#warranty-documents-popup";
        const AddDocumentsPopupSelector = "#add-document-popup";

        return Component.extend({
            defaults: {
                template: 'Variux_Warranty/warranty-ticket',
                materialForm: 'Variux_Warranty/popup/material-form',
                laborForm: 'Variux_Warranty/popup/labor-form',
                freightForm: 'Variux_Warranty/popup/freight-form',
                feeForm: 'Variux_Warranty/popup/fee-form',
                transactionList: 'Variux_Warranty/transaction-list',
                documentsPopup: 'Variux_Warranty/popup/documents'
            },

            warranty: ko.observable({}),
            ticket: ko.observable({}),
            transactions: ko.observableArray([]),

            ticketNumber: ko.observable(),
            currentTransaction: ko.observable(),

            initialize: function (config) {
                this._super();
                if (window.WarrantyModule) {
                    if (window.WarrantyModule.warranty) {
                        this.warranty(helper.convertToObserver(window.WarrantyModule.warranty));
                    }

                    if (window.WarrantyModule.ticket) {
                        this.ticket(helper.convertToObserver(window.WarrantyModule.ticket));
                        if (window.WarrantyModule.ticket.ticket_number) {
                            this.ticketNumber(window.WarrantyModule.ticket.ticket_number);
                        }
                    }

                    if (window.WarrantyModule.transactions) {
                        this.transactions(helper.convertToObserverList(window.WarrantyModule.transactions));
                    }

                    var self = this;
                    this.ticketNumber.subscribe(function (value) {
                        self.ticket().ticket_number = ko.observable(value);
                    });
                }
            },

            backWarranties: function () {
                if (window.WarrantyModule.url.backUrl) {
                    window.location.href = window.WarrantyModule.url.backUrl;
                }
            },

            submitClaim: function () {
                var self = this;
                var isValid = $(WarrantyTicketFormSelector).validation() && $(WarrantyTicketFormSelector).validation("isValid");
                if (isValid) {
                    var saveUrl = window.WarrantyModule.url.saveTicketUrl;
                    Api.post(saveUrl,
                        {
                            ticket: helper.convertToStandardData(this.ticket()),
                            transactions: helper.convertToStandardData(this.transactions())
                        }, function (res) {
                            var res = JSON.parse(res);
                            if (res.error) {
                                if (res.msg) {
                                    messageList.addErrorMessage({
                                        message: res.msg
                                    });
                                }
                                return;
                            }
                            self.ticket(helper.convertToObserver(res.ticket));
                            self.transactions(helper.convertToObserverList(res.transactions));

                            if (res.url) {
                                history.pushState(null, '', res.url);
                            }

                            if (res.msg) {
                                messageList.addSuccessMessage({
                                    message: res.msg
                                });
                            }
                        });
                }
            },

            addTransaction: function (transaction, type) {
                transaction.type = ko.observable(type);
                transaction.type_label = ko.observable(window.WarrantyModule.transactionLabel[type]);
                transaction.documents = ko.observableArray([]);
                this.currentTransaction(transaction);
                this.transactions.unshift(transaction);
            },

            modifyTransaction: function (formData) {
                var transaction = this.currentTransaction();
                formData.forEach(function (item) {
                    transaction[item.name](item.value);
                });
                // this.currentTransaction(false);
            },

            editTransaction: function (transaction) {
                this.currentTransaction(transaction);
                switch (transaction.type()) {
                    case window.WarrantyModule.transactionType.MATERIAL:
                        this.openMaterialPopup();
                        break;
                    case window.WarrantyModule.transactionType.LABOR:
                        this.openLaborPopup();
                        break;
                    case window.WarrantyModule.transactionType.FREIGHT:
                        this.openFreightPopup();
                        break;
                    case window.WarrantyModule.transactionType.IMPORT_FEE:
                        this.openFeePopup();
                        break;
                }
            },

            removeTransaction: function (trans) {
                var self = this;
                Confirmation({
                    title: $.mage.__('Warning'),
                    content: $.mage.__("Do you sure remove this part?"),
                    actions: {
                        confirm: function () {
                            self.transactions.remove(trans);

                            if (trans.transaction_id && trans.transaction_id()) {
                                // remove on server
                            }
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

            canUploadDocument: function (type) {
                if (
                    type == window.WarrantyModule.transactionType.FREIGHT ||
                    type == window.WarrantyModule.transactionType.IMPORT_FEE
                ) {
                    return true;
                }
                return false;
            },

            openDocuments: function (transaction) {
                this.openDocumentsPopup(transaction);
            },

            // Material
            materialItemSelect: function (item, $input, event) {
                $input.val(item.sku).trigger("change");
                $input.closest("form").find("input[name='description']").val(item.name).trigger("change");
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
                        click: function () {
                            var $form = $elm.find("form");
                            var isValid = $form.validation() && $form.validation("isValid");
                            if (!isValid) {
                                return;
                            }
                            if (self.currentTransaction()) {
                                self.modifyTransaction($form.serializeArray());
                            } else {
                                var data = helper.convertFormDataToObserver($form.serializeArray());
                                self.addTransaction(data, window.WarrantyModule.transactionType.MATERIAL);
                            }
                            this.closeModal();
                        }
                    },{
                        text: $.mage.__('Submit and Add another'),
                        class: 'action primary',
                        click: function () {
                            var $form = $elm.find("form");
                            var isValid = $form.validation() && $form.validation("isValid");
                            if (!isValid) {
                                return;
                            }
                            if (self.currentTransaction()) {
                                self.modifyTransaction($form.serializeArray());
                            } else {
                                var data = helper.convertFormDataToObserver($form.serializeArray());
                                self.addTransaction(data, window.WarrantyModule.transactionType.MATERIAL);
                            }
                            self.currentTransaction(false);
                        }
                    }],
                    outerClickHandler: function (event) {

                    },
                    closed: function () {
                        self.currentTransaction(false);
                    }
                };
                var popup = modal(options, $elm);
                $elm.modal('openModal');
            },
            // Material


            // Labor
            openLaborPopup: function () {
                var self = this;
                var $elm = $(AddLaborPopupSelector);
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
                        click: function () {
                            var $form = $elm.find("form");
                            var isValid = $form.validation() && $form.validation("isValid");
                            if (!isValid) {
                                return;
                            }
                            if (self.currentTransaction()) {
                                self.modifyTransaction($form.serializeArray());
                            } else {
                                var data = helper.convertFormDataToObserver($form.serializeArray());
                                self.addTransaction(data, window.WarrantyModule.transactionType.LABOR);
                            }
                            this.closeModal();
                        }
                    },{
                        text: $.mage.__('Submit and Add another'),
                        class: 'action primary',
                        click: function () {
                            var $form = $elm.find("form");
                            var isValid = $form.validation() && $form.validation("isValid");
                            if (!isValid) {
                                return;
                            }
                            if (self.currentTransaction()) {
                                self.modifyTransaction($form.serializeArray());
                            } else {
                                var data = helper.convertFormDataToObserver($form.serializeArray());
                                self.addTransaction(data, window.WarrantyModule.transactionType.LABOR);
                            }
                            self.currentTransaction(false);
                        }
                    }],
                    outerClickHandler: function (event) {

                    },
                    closed: function () {
                        self.currentTransaction(false);
                    }
                };
                var popup = modal(options, $elm);
                $elm.modal('openModal');
            },
            // Labor


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
                return $.mage.__("Invoice Number or Sales Order number is required on linked Ticket [%1] to add Freight to SRO [%2].")
                    .replace("%1", this.warranty().warranty_id())
                    .replace("%2", this.ticket().ticket_number ? this.ticket().ticket_number() : '');
            },

            openFreightPopup: function () {
                var self = this;
                var $elm = $(AddFreightPopupSelector);
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
                        click: function () {
                            if (self.isMissSales()) {
                                return;
                            }

                            var $form = $elm.find("form");
                            var isValid = $form.validation() && $form.validation("isValid");
                            if (!isValid) {
                                return;
                            }
                            if (self.currentTransaction()) {
                                self.modifyTransaction($form.serializeArray());
                            } else {
                                var data = helper.convertFormDataToObserver($form.serializeArray());
                                self.addTransaction(data, window.WarrantyModule.transactionType.FREIGHT);
                            }
                            this.closeModal();
                        }
                    },{
                        text: $.mage.__('Submit and Add another'),
                        class: 'action primary',
                        click: function () {
                            if (self.isMissSales()) {
                                return;
                            }

                            var $form = $elm.find("form");
                            var isValid = $form.validation() && $form.validation("isValid");
                            if (!isValid) {
                                return;
                            }
                            if (self.currentTransaction()) {
                                self.modifyTransaction($form.serializeArray());
                            } else {
                                var data = helper.convertFormDataToObserver($form.serializeArray());
                                self.addTransaction(data, window.WarrantyModule.transactionType.FREIGHT);
                            }
                            self.currentTransaction(false);
                        }
                    }],
                    outerClickHandler: function (event) {

                    },
                    closed: function () {
                        self.currentTransaction(false);
                    }
                };
                var popup = modal(options, $elm);
                $elm.modal('openModal');
            },
            // Freight

            // Import Fee
            openFeePopup: function () {
                var self = this;
                var $elm = $(AddFeePopupSelector);
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
                        click: function () {
                            var $form = $elm.find("form");
                            var isValid = $form.validation() && $form.validation("isValid");
                            if (!isValid) {
                                return;
                            }
                            if (self.currentTransaction()) {
                                self.modifyTransaction($form.serializeArray());
                            } else {
                                var data = helper.convertFormDataToObserver($form.serializeArray());
                                self.addTransaction(data, window.WarrantyModule.transactionType.IMPORT_FEE);
                            }
                            this.closeModal();
                        }
                    },{
                        text: $.mage.__('Submit and Add another'),
                        class: 'action primary',
                        click: function () {
                            var $form = $elm.find("form");
                            var isValid = $form.validation() && $form.validation("isValid");
                            if (!isValid) {
                                return;
                            }
                            if (self.currentTransaction()) {
                                self.modifyTransaction($form.serializeArray());
                            } else {
                                var data = helper.convertFormDataToObserver($form.serializeArray());
                                self.addTransaction(data, window.WarrantyModule.transactionType.IMPORT_FEE);
                            }
                            self.currentTransaction(false);
                        }
                    }],
                    outerClickHandler: function (event) {

                    },
                    closed: function () {
                        self.currentTransaction(false);
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
                var documentFile = {};
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
                            var $form = $elm.find("form");
                            var isValid = $form.validation() && $form.validation("isValid");
                            if (!isValid) {
                                return;
                            }

                            var data = helper.convertFormDataToObserver($form.serializeArray());
                            data.file = ko.observable(documentFile);
                            self.currentTransaction().documents.push(data);
                            this.closeModal();
                        }
                    }],
                    outerClickHandler: function (event) {

                    },
                    closed: function () {

                    }
                };
                var popup = modal(options, $elm);
                $elm.find("form input").val("").trigger("change");
                $elm.find("form input[name='document[file]']").on("change", function (event) {
                    var file = event.currentTarget.files[0];
                    if (file) {
                        documentFile.name = file.name;
                        documentFile.size = file.size;
                        documentFile.type = file.type;
                        new Promise((resolve, reject) => {
                            const reader = new FileReader();
                            reader.readAsDataURL(file);
                            reader.onload = function () {
                                return resolve(
                                    documentFile.content = reader.result
                                );
                            };
                            reader.onerror = error => reject(error);
                        });
                    }
                });
                $elm.modal('openModal');
            },

            openDocumentsPopup: function (transaction) {
                this.currentTransaction(transaction);
                var self = this;
                var $elm = $(DocumentsPopupSelector);
                var options = {
                    type: 'popup',
                    responsive: true,
                    innerScroll: true,
                    title: $.mage.__('Document for Warranty Ticket Detail %1').replace("%1", this.ticket().ticket_number()),
                    modalClass: 'warranty-container warranty-modal documents-modal',
                    closeText: "",
                    buttons: [{
                        text: $.mage.__('Done'),
                        class: 'action primary',
                        click: function () {
                            this.closeModal();
                        }
                    }],
                    outerClickHandler: function (event) {

                    },
                    closed: function () {
                        self.currentTransaction(false);
                    }
                };
                var popup = modal(options, $elm);
                $elm.modal('openModal');
            },
            // Document

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
