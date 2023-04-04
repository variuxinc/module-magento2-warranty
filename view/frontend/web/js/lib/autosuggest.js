define([
    'jquery',
    'ko',
    'underscore',
    'mage/translate'
], function ($, ko, _, $t) {

    var Autosuggest = function (input, itemClickCallback = false) {
        this.$input = $(input);
        this.isVisible = false;
        this.isShowAll = true;
        this.loading = false;
        this.config = [];
        this.result = false;
        this.defaults = {
            minSearchLength: 2,
            resultContainerSelector: '#result_suggest_container',
            loadingSelector:'#searchautosuggestLoading',
            wrapperSelector: '.searchautosuggest__wrapper',
            placeholderSelector: '.searchautosuggest__autosuggest',
            itemClickCallback: itemClickCallback
        };
    };

    Autosuggest.prototype = {
        init: function (config) {
            this.config = _.defaults(config, this.defaults);

            this.doSearch = _.debounce(this._doSearch, this.config.delay);

            this.$input.after($(this.config.loadingSelector).html());

            this.placeholderSelector = this.config.placeholderSelector;

            this.wrapperSelector = this.config.wrapperSelector;

            this.xhr = null;

            this.$input.on("click focus", function () {
                this.clickHandler()
            }.bind(this));

            this.$input.on("input", function () {
                this.inputHandler()
            }.bind(this));

            $(document).click(function (event) {
                if ($(event.target)[0] != this.$input[0] && !$(event.target).closest(this.$placeholder()).length) {
                    this.$placeholder().removeClass('_active');
                    $(event.target).closest('form').find('.active').removeClass('active');
                }

                if ($(event.target).hasClass("searchautosuggest__close")) {
                    this.$placeholder().removeClass('_active');
                }
            }.bind(this));
        },

        clickHandler: function () {
            if (this.result) {
                this.$input.addClass('searchautosuggest__active');
                this.$placeholder().addClass('_active');
                this.ensurePosition();

                setInterval(function () {
                    this.ensurePosition();
                }.bind(this), 10);
            } else {
                this.result = this.search();
            }
        },

        inputHandler: function () {
            this.result = this.search();

            setTimeout(function () {
                if (this.result) {
                    this.$placeholder().addClass('_active');
                    this.ensurePosition();
                } else {
                    this.$placeholder().removeClass('_active');
                }
            }.bind(this), 200);

            this.ensurePosition();
        },

        $placeholder: function () {
            return $(this.$input.next(this.placeholderSelector));
        },

        $wrapper: function () {
            return $(this.$input.next(this.placeholderSelector).find(this.wrapperSelector));
        },

        $spinner: function () {
            return this.$placeholder().find(".searchautosuggest__spinner");
        },

        search: function () {
            this.ensurePosition();

            this.$input.off("keydown");
            this.$input.off("blur");

            if (this.xhr != null) {
                this.xhr.abort();
                this.xhr = null;
            }

            if (this.config.findAll || this.$input.val().length >= this.config.minSearchLength) {
                this.doSearch(this.$input.val());
            } else {
                this.doDefault();
            }

            return true;
        },

        _doSearch: function (query) {
            this.isVisible = true;

            this.$spinner().show();

            this.xhr = $.ajax({
                url:      this.config.url,
                dataType: 'json',
                type:     'GET',
                data:     {
                    q:   query,
                    store_id: this.config.storeId
                },
                success:  function (data) {
                    this.processApplyBinding(data);
                    this.$spinner().hide();
                }.bind(this)
            });
        },

        viewModel: function (data) {
            var model = {
                onMouseOver: function (item, event) {
                    $(event.currentTarget).addClass('_active');
                }.bind(this),

                onMouseOut: function (item, event) {
                    $(event.currentTarget).removeClass('_active');
                }.bind(this),

                onClick: function (item, event) {
                    if (event.button === 0) {
                        event.preventDefault();

                        if (this.config.itemClickCallback) {
                            this.config.itemClickCallback(item, this.$input, event);
                        } else {
                            this.$input.val(item).trigger("change");
                        }
                        this.$placeholder().removeClass('_active');
                    }
                }.bind(this)
            };

            model.isVisible = this.isVisible;
            model.loading = this.loading;
            model.result = data;
            model.result.isShowAll = this.isShowAll;
            model.form_key = $.cookie('form_key');

            return model;
        },

        enter: function (item) {
            if (item.url) {
                window.location.href = item.url;
            } else {
                this.pasteToSearchString(item.query);
            }
        },

        pasteToSearchString: function (searchTerm) {
            this.$input.val(searchTerm);
            this.search();
        },

        doDefault: function () {
            this.isVisible = true;
            this.$spinner().hide();
            this.processApplyBinding(this._showDefaultData([]));

            return false;
        },

        processApplyBinding: function (data) {
            if (this.$wrapper().length > 0) {
                if (!!ko.dataFor(this.$wrapper())) {
                    ko.cleanNode(this.$wrapper());
                }
            }

            this.$wrapper().remove();

            var wrapper = $(this.config.resultContainerSelector).html();

            this.$placeholder().append(wrapper);

            ko.applyBindings(this.viewModel(data), this.$wrapper()[0]);

            this.ensurePosition();
        },

        _showDefaultData: function (data) {
            var queries = data;
            var items = [];
            var result;

            _.each(queries, function (query, idx) {
                items.push(query);
            }, this);

            result = {
                totalItems: items.length,
                noResults:  items.length === 0,
                query:      this.$input.val(),
                items:    items,
                is_default: true
            };

            return result;
        },

        ensurePosition: function () {
            var position = this.$input.position();
            if (this.$placeholder().is(":visible")) {
                var width = this.$placeholder().outerWidth();
                var left = position.left + parseInt(this.$input.css('marginLeft'), 10) + this.$input.outerWidth() - width;
                var top = position.top + parseInt(this.$input.css('marginTop'), 10);

                $(this.placeholderSelector)
                    .css('top', this.$input.outerHeight() - 1 + top)
                    .css('left', left)
                    .css('width', this.$input.outerWidth());
            }

        }
    };

    return Autosuggest;
});
