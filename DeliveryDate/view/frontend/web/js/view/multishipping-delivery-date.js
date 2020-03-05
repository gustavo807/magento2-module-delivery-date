define([
    'jquery',
    'ko',
    'Magento_Ui/js/form/element/abstract'
], function ($, ko, Component) {
    'use strict';


    return Component.extend({
        initialize: function () {
            this._super();

            ko.bindingHandlers.datepicker = {
                init: function (element, valueAccessor, allBindingsAccessor) {
                    var $el = $(element);

                    var parentId = $el.parent().attr("id");
                    var settings = window.delivery_date[parentId];
                    var config = settings.settings.shipping.delivery_date;

                    var prevValue = settings.preValue;
                    var defaultValue = config.default_delivery_date;
                    var disabled = config.disabled;
                    var noday = config.noday;
                    var format = config.format;

                    if(!format) {
                        format = 'yy-mm-dd';
                    }

                    var disabledDay = disabled.split(",").map(function(item) {
                        return parseInt(item, 10);
                    });


                    //initialize datepicker
                    if(noday) {
                        var options = {
                            minDate: 0,
                            dateFormat:format,
                        };
                    } else {
                        var options = {
                            minDate: 0,
                            dateFormat:format,
                            beforeShowDay: function(date) {
                                var day = date.getDay();
                                if(disabledDay.indexOf(day) > -1) {
                                    return [false];
                                } else {
                                    return [true];
                                }
                            }
                        };
                    }

                    $el.datepicker(options);


                    if(prevValue){
                        $el.datepicker("setDate", prevValue);
                    } else if(defaultValue) {
                        $el.datepicker("setDate", defaultValue);
                    }

                    var writable = valueAccessor();
                    if (!ko.isObservable(writable)) {
                        var propWriters = allBindingsAccessor()._ko_property_writers;
                        if (propWriters && propWriters.datepicker) {
                            writable = propWriters.datepicker;
                        } else {
                            return;
                        }
                    }
                    writable($(element).datepicker("getDate"));
                },
                update: function (element, valueAccessor) {
                    var widget = $(element).data("DatePicker");
                    //when the view model is updated, update the widget
                    if (widget) {
                        var date = ko.utils.unwrapObservable(valueAccessor());
                        widget.date(date);
                    }
                }
            };

            return this;
        },
        getInputName: function () {
            return "delivery_date[" + this.entityId + "]";
        },
        getEntityId: function () {
            return this.entityId;
        }
    });
});