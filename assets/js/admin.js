jQuery(document).ready(function ($) {
    "use strict";

    
    // let index =  localStorage.getItem('active_screen');
    // document.querySelector('iframe').contentWindow.document.body.querySelector('ons-tabbar').setActiveTab(index)


    $(".control-subsection").on('click', function(event){
        let index = 0;
        let str = $(this).attr("id");

        localStorage.setItem('active_screen', str);
        var screen = str.split("accordion-section-sidebar-widgets-brand-")[1];

        console.log(screen);
    
        
    switch (screen) {
        case 'home_screen':
            index = 0;
            console.log(index);
            break;
        case 'search_screen':
            index = 1;
            break;
        case 'favourites_screen':
            index = 2;
            break;
        case 'settings_screen':
            index = 3;
            break;
        default:
            break;
    }
        
    document.querySelector('iframe').contentWindow.document.body.querySelector('ons-tabbar').setActiveTab(index)

    //sdocument.querySelector('iframe').contentWindow.document.body.querySelector(screen).style.display = "block";


    });
});
