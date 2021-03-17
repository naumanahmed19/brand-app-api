jQuery(document).ready(function ($) {
    "use strict";


    $(".control-subsection").on('click', function(event){
     
    let str = $(this).attr("id");
    
    var screen = str.split("accordion-section-sidebar-widgets-brand-")[1];

    localStorage.setItem('active_screen', screen);

    let index =  activeScreenIndex(screen);
        
    document.querySelector('iframe').contentWindow.document.body.querySelector('ons-tabbar').setActiveTab(index)

    });


    function activeScreenIndex(screen){

        let index = 0;

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
        return index;
    }

    function activeScreen(index){
        document.querySelector('iframe').contentWindow.document.body.querySelector('ons-tabbar').setActiveTab(index)
    }



    //on init

    $(window).load(function() {
        let screen = localStorage.getItem('active_screen'); 
        console.log(screen);
        let index = activeScreenIndex(screen);
        console.log(index);
        activeScreen(index);
   });



});
