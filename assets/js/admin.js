
jQuery(document).ready(function ($) {
    "use strict";



$(".control-subsection").on('click', function(event){
    var index = 0;
    var id = $(this).attr("id");

    console.log(id);

  switch (id) {
    case 'sub-accordion-section-sidebar-widgets-home_screen':
        index = 0;
        break;
    case 'accordion-section-sidebar-widgets-brand-search-screen':
        index = 1;
        break;
    case 'accordion-section-sidebar-widgets-brand-favourites-screen':
        index = 2;
        break;
    case 'accordion-section-sidebar-widgets-brand-settings-screen':
        index = 3;
        break;
    default:
        break;
  }
       
 document.querySelector('iframe').contentWindow.document.body.querySelector('ons-tabbar').setActiveTab(index)

});
});
