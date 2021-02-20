
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



    function editSelects(event) {
        document.getElementById('choose-sel').removeAttribute('modifier');
        if (event.target.value == 'material' || event.target.value == 'underbar') {
          document.getElementById('choose-sel').setAttribute('modifier', event.target.value);
        }
      }
      function addOption(event) {
        const option = document.createElement('option');
        var text = document.getElementById('optionLabel').value;
        option.innerText = text;
        text = '';
        document.getElementById('dynamic-sel').appendChild(option);
      }


jQuery(document).ready(function ($) {
    "use strict";

    filter();
    lightSlider();
$(".control-subsection").on('click', function(event){
    console.log(event);
    //(... rest of your JS code)
});
//light slider
   

function lightSlider(){
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

    
}


function filter(){
    console.log('www');
    var $filters = $('#choose-sel'),
    $boxes = $('.boxes [data-cat]');

  $filters.on('change', function(e) {
      console.log('clciked');
    e.preventDefault();
    var $this = $(this);
    
    // $filters.removeClass('active');
    // $this.addClass('active');

    var $filterColor = $this.attr('data-filter');
    
    if ($filterColor == 'all') {
      $boxes.removeClass('is-animated')
        .fadeOut().promise().done(function() {
          $boxes.addClass('is-animated').fadeIn();
        });
    } else {
      $boxes.removeClass('is-animated')
        .fadeOut().promise().done(function() {
          $boxes.filter(function(i,el){ 
              return el.dataset.cat.split(',').indexOf($filterColor)!==-1;
          })
            .addClass('is-animated').fadeIn();
        });
    }
  });
}



$("ul.dropdown").on("click", ".init", function() {
    $(this).closest("ul").children('li:not(.init)').toggle();
});

var allOptions = $("ul.dropdown").children('li:not(.init)');
$("ul.dropdown").on("click", "li:not(.init)", function() {
    allOptions.removeClass('selected');
    $(this).addClass('selected');
    $("ul.dropdown").children('.init').html($(this).html());
    allOptions.toggle();
});



});

 