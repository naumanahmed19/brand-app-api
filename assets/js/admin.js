
jQuery(document).ready(function ($) {
    "use strict";



$(".control-subsection").on('click', function(event){
    console.log(  document.querySelector('ons-tabbar'));
    
    //(... rest of your JS code)

    document.querySelectorAll('iframe').forEach( item =>
        console.log(item.contentWindow.document.body),
        item.contentWindow.document.body.querySelector('ons-tabbar').setActiveTab(2)
    );
});

});

 