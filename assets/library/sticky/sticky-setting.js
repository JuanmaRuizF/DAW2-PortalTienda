/*
 * Settings of the sticky menu
 */

jQuery(document).ready(function($){
    if ($(window).width() > 768) {
        var wpAdminBar = $('#wpadminbar');
        if ( wpAdminBar.length ) {
          $("#stickyNav").sticky({topSpacing:wpAdminBar.height()});
        } else {
          $("#stickyNav").sticky({topSpacing:0});
        }
    }
});