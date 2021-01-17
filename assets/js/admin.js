
jQuery(document).ready(function ($) {
    "use strict";



$(".control-subsection").on('click', function(event){
    document.querySelector('iframe').contentWindow.document.body.querySelector('ons-tabbar').setActiveTab(1)

});

 