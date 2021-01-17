
jQuery(document).ready(function ($) {
    "use strict";



$(".control-subsection").on('click', function(event){
        console.log('click')
        
    document.querySelector('iframe').contentWindow.document.body.querySelector('ons-tabbar').setActiveTab(1)

});

 