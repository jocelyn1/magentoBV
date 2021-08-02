define(['jquery'], function($) {
    'use strict';

    return function() {
        $.validator.addMethod(
            'validate-jkelle-phone',
            function(value, element, regex ) {
                var thisRegex = new RegExp(regex);

                return thisRegex.test(value);
            },
            $.mage.__('Please enter phone number correct')
        )
    }
});
