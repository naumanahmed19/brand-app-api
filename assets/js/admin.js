
jQuery(document).ready(function ($) {
    "use strict";



$(".control-subsection").on('click', function(event){
    console.log(event);
    document.querySelector('ons-tabbar').setActiveTab(2);
    //(... rest of your JS code)
});

});

 