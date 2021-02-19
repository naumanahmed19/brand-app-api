
    //
    var myRadios = document.getElementsByName('tabs1');
    var setCheck;
    var x = 0;
    for(x = 0; x < myRadios.length; x++){
        myRadios[x].onclick = function(){
            if(setCheck != this){
                 setCheck = this;
            }else{
                this.checked = false;
                setCheck = null;
        }
        };
    }



jQuery(document).ready(function ($) {
    "use strict";



$(".control-subsection").on('click', function(event){
    console.log(event);
    //(... rest of your JS code)
});
//light slider
    var light = $(".lightSlider");
    light.each(function () {
        var $this = $(this);
        $this.lightSlider({
            verticalHeight: $this.data('vertical-height'),
            autoWidth: $this.data('auto-width'),
            slideWidth: $this.data('slide-width'),
            centerSlide: $this.data('center-slide'),
            gallery: $this.data('gallery'),
            thumbItem: $this.data('thumbs'),
            thumbMargin: $this.data('margin'),
            item: $this.data('item'),
            loop: $this.data('loop'),
            mode: $this.data('mode'),
            //adaptiveHeight: true,
            speed: $this.data('speed'),
            auto: $this.data('auto'),
            pause: $this.data('pause'),
            pauseOnHover: $this.data('pause-on-hover'),
            pager: $this.data('pager'),
            slideMargin: $this.data('slide-margin'),
            vThumbWidth: 80,
            currentPagerPosition: $this.data('position'),
            controls: $this.data('controls'),
            prevHtml: '<span class="icon icon-angle-left"></span>',
            nextHtml: '<span class="icon icon-angle-right"></span>',
            responsive: [

                {
                    breakpoint: 1024,
                    settings: {
                        item: $this.data('item-lg'),
                        slideMove: 1,
                        slideMargin: 6,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        item: $this.data('item-md'),
                        slideMove: 1,
                        slideMargin: 6,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        item: $this.data('item-sm'),
                        slideMove: 1
                    }
                }
            ],
            onSliderLoad: function (el) {
                if ($this.data('start')) {
                    $this.goToSlide($this.data('start'));
                }
                $this.addClass('showSlider');


                el.find('.lslide .animated').addClass("go");
            },

            onBeforeNextSlide: function (el) {
                el.find('.lslide .animated').removeClass("go");
            },
            onAfterSlide: function (el) {
                el.find('.lslide .animated').addClass("go");
            },
        });

        // $('.lSAction > .lSPrev').click(function () {
        //     $this.goToPrevSlide();
        // });
        // $('.lSAction > .lSNext').click(function () {
        //     $this.goToNextSlide();
        // });
    });

    


    filterSelection("all")
    function filterSelection(c) {
      var x, i;
      x = document.getElementsByClassName("filterDiv");
      if (c == "all") c = "";
      for (i = 0; i < x.length; i++) {
        w3RemoveClass(x[i], "show");
        if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
      }
    }
    
    function w3AddClass(element, name) {
      var i, arr1, arr2;
      arr1 = element.className.split(" ");
      arr2 = name.split(" ");
      for (i = 0; i < arr2.length; i++) {
        if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
      }
    }
    
    function w3RemoveClass(element, name) {
      var i, arr1, arr2;
      arr1 = element.className.split(" ");
      arr2 = name.split(" ");
      for (i = 0; i < arr2.length; i++) {
        while (arr1.indexOf(arr2[i]) > -1) {
          arr1.splice(arr1.indexOf(arr2[i]), 1);     
        }
      }
      element.className = arr1.join(" ");
    }
    
    // Add active class to the current button (highlight it)
    var btnContainer = document.getElementById("myBtnContainer");
    var btns = btnContainer.getElementsByClassName("btn");
    for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener("click", function(){
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
      });
    }



});

 