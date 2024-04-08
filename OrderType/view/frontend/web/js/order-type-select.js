define([
    'jquery',
    'mage/url',
], function ($, url) {
    'use strict';

    return function (config, element) {
        $(element).on('change', function () {
            var selectedValue = $(this).val();
            let payload = {
                quote_id: window.checkoutConfig.quoteData.entity_id,
                order_type: selectedValue
            };
            $.post(
                url.build('ordertype/ajax/set'),
                payload
            ).done()
        });
    };
});
