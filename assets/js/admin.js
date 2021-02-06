
jQuery(document).ready(function ($) {
    "use strict";



$(".control-subsection").on('click', function(event){
    var index = 0;
    var id = $(this).attr("id");

  switch (id) {
    case 'accordion-section-sidebar-widgets-brand-home_screen':
        index = 0;
        break;
    case 'accordion-section-sidebar-widgets-brand-search_screen':
        index = 1;
        break;
    case 'accordion-section-sidebar-widgets-brand-favourites_screen':
        index = 2;
        break;
    case 'accordion-section-sidebar-widgets-brand-settings_screen':
        index = 3;
        break;
    default:
        break;
  }
       
 document.querySelector('iframe').contentWindow.document.body.querySelector('ons-tabbar').setActiveTab(index)

});
});
