/**
 * This Javascript code is responsible for the "TEST BUTTON".
 */

jQuery(document).ready(function() {
    jQuery("#test-button").click(function() {
        var captureUrl = jQuery("#capture-url").val();
        var testButton = jQuery("#test-button");
        jQuery(testButton).removeClass('btn-default').addClass('btn-warning');
        jQuery(testButton).text("Testing...");

        jQuery.post(
            captureUrl,
            {
                "luckyNumber": 42,
                "message": "If you're reading this, requests are captured correctly.",
                "lorem_ipsum": "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
            },

            function() {
                jQuery(testButton).text("OK");
                testButton.removeClass('btn-warning').addClass('btn-success');
                window.location = "/?page=index&test_run";

            }

        ).fail(function() {
            jQuery(testButton).text("Error!");
            testButton.removeClass('btn-warning').addClass('btn-danger');

        });

    });

    // Give some feedback on clicking the Refresh button.
    jQuery("#refresh-button").click(function() {
        var refreshButton = jQuery("#refresh-button");
        jQuery(refreshButton).removeClass('btn-default').addClass('btn-info');
        jQuery(refreshButton).text("Refreshing...");
    });

});
