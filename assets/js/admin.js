jQuery(document).ready(function ($) {
    "use strict";

    
    // let index =  localStorage.getItem('active_screen');
    // document.querySelector('iframe').contentWindow.document.body.querySelector('ons-tabbar').setActiveTab(index)


    $(".control-subsection").on('click', function(event){
        let index = 0;
        let id = $(this).attr("id");

        localStorage.setItem('active_screen', id);

        var str = "accordion-section-sidebar-widgets-brand-home_screen";
        var screen = str.split("accordion-section-sidebar-widgets-brand-")[1];
    
        
    // switch (id) {
    //     case 'accordion-section-sidebar-widgets-brand-home_screen':
    //         index = 0;
    //         break;
    //     case 'accordion-section-sidebar-widgets-brand-search_screen':
    //         index = 1;
    //         break;
    //     case 'accordion-section-sidebar-widgets-brand-favourites_screen':
    //         index = 2;
    //         break;
    //     case 'accordion-section-sidebar-widgets-brand-settings_screen':
    //         index = 3;
    //         break;
    //     default:
    //         break;
    // }
        
    ///document.querySelector('iframe').contentWindow.document.body.querySelector('ons-tabbar').setActiveTab(index)

    document.querySelector('iframe').contentWindow.document.body.querySelector(screen).style.display = "block";


    });
});
