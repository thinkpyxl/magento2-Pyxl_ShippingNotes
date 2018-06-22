/*global define*/
define([
    'knockout',
    'jquery',
    'mage/url',
    'Magento_Ui/js/form/form',
    'Magento_Customer/js/model/customer',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/url-builder',
    'Magento_Checkout/js/model/error-processor',
    'Magento_Checkout/js/model/cart/cache',
    'Pyxl_ShippingNotes/js/model/checkout/shipping-notes-form'
], function(ko, $, urlFormatter, Component, customer, quote, urlBuilder, errorProcessor, cartCache, formData) {
    'use strict';

    return Component.extend({
        shippingNotes: ko.observable(null),
        formData: formData.shippingNotesData,

        /**
         * Initialize component
         *
         * @returns {exports}
         */
        initialize: function () {
            var self = this;
            this._super();
            formData = this.source.get('shippingNotesForm');
            var formDataCached = cartCache.get('shipping-notes-form');
            if (formDataCached) {
                formData = this.source.set('shippingNotesForm', formDataCached);
            }

            this.shippingNotes.subscribe(function(change){
                self.formData(change);
            });

            return this;
        },

        /**
         * Trigger save method if form is change
         */
        onFormChange: function () {
            this.saveShippingNotes();
        },

        /**
         * Form submit handler
         */
        saveShippingNotes: function() {
            this.source.set('params.invalid', false);
            this.source.trigger('shippingNotesForm.data.validate');

            if (!this.source.get('params.invalid')) {
                var formData = this.source.get('shippingNotesForm');
                var quoteId = quote.getQuoteId();
                var isCustomer = customer.isLoggedIn();
                var url;

                if (isCustomer) {
                    url = urlBuilder.createUrl('/carts/mine/set-order-shipping-notes', {});
                } else {
                    url = urlBuilder.createUrl('/guest-carts/:cartId/set-order-shipping-notes', {cartId: quoteId});
                }

                var payload = {
                    cartId: quoteId,
                    shippingNotes: formData
                };
                var result = true;
                $.ajax({
                    url: urlFormatter.build(url),
                    data: JSON.stringify(payload),
                    global: false,
                    contentType: 'application/json',
                    type: 'PUT',
                    async: true
                }).done(
                    function (response) {
                        cartCache.set('shipping-notes-form', formData);
                        result = true;
                    }
                ).fail(
                    function (response) {
                        result = false;
                        errorProcessor.process(response);
                    }
                );

                return result;
            }
        }
    });
});

// /*global define*/
// define([
//     'Magento_Ui/js/form/form',
//     'Magento_Checkout/js/model/quote',
//     'Magento_Checkout/js/model/step-navigator'
// ], function(Component, quote, stepNavigator) {
//     'use strict';
//     return Component.extend({
//         initialize: function () {
//             this._super();
//
//             return this;
//         },
//
//         /**
//          * @return {Boolean}
//          */
//         isVisible: function () {
//             // return !quote.isVirtual() && stepNavigator.isProcessed('shipping');
//             return true;
//         },
//
//         /**
//          * Form submit handler
//          *
//          * This method can have any name.
//          */
//         onSubmit: function() {
//             this.source.set('params.invalid', false);
//             this.source.trigger('customCheckoutForm.data.validate');
//
//             if (!this.source.get('params.invalid')) {
//                 // data is retrieved from data provider by value of the customScope property
//                 var formData = this.source.get('shippingNotesForm');
//                 console.log(formData);
//             }
//         }
//     });
// });