<?php
/**
 * Template Name: Brand App
 * Template Post Type: post, page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0
 */

wp_head();



// function get_all_widgets_data($sidebar_id=null){
//     $result = [];
//     $sidebars_widgets = get_option('sidebars_widgets');

//     if(is_array($sidebars_widgets)){

//         foreach ($sidebars_widgets as $key => $value) {

//             if(is_array($value)){
//                 foreach ($value as $widget_id) {
//                     $pieces = explode('-', $widget_id);
//                     $multi_number = array_pop($pieces);
//                     $id_base = implode('-', $pieces);
//                     $widget_data = get_option('widget_' . $id_base);
                    
//                     // Remove inactive widgets 
//                     if($key != 'wp_inactive_widgets' ) {
//                         unset($widget_data['_multiwidget']);
//                         $result[$key] = $widget_data;
//                     }
//                 }
//             }
//         }
//     }
//     if($sidebar_id){
//         return isset($result[$sidebar_id]) ? $result[$sidebar_id] : [] ;
//     }
//     return $result;
// }+



// $sidebars_widgets = wp_get_sidebars_widgets();
// $widgets = $sidebars_widgets['sidebar-1'];

// foreach( $widgets as $widget){
// //  $w0  =  get_option( $widgets[0]);

// $arr = explode("-",$widget);

// $name = $arr[0];
// $widget_id = $arr[1];
// // var_dump('widget_' . $name);
// //$widget_instances = get_option('widget_' . $name);
//  var_dump( $widget );

// if($name == 'brandslider_widget'){
//   var_dump(get_field('slides', 'widget_' .$widget));
// }

// if($name == 'widget_brand_categoriescarousel_widget'){
//   var_dump(get_field('categories', 'widget_' .$widget));
// }


// }


?>
<script>
document.addEventListener('prechange', function(event) {
  document.querySelector('ons-toolbar .center')
    .innerHTML = event.tabItem.getAttribute('label');
});
</script>
<style>
.mokup {
	display: flex;
	flex: 1;
  background: #191e24;
	justify-content: center;
	align-items: center;
  flex-direction: row-reverse;
  
  height: 100vh;

}

</style>


<div class="mokup">
<div class="marvel-device note8 shadow-lg rounded-lg">


    <div class="screen">

      <ons-page>
      <ons-tabbar swipeable position="auto">
        <ons-tab page="tab1.html" icon="md-home" active>
        </ons-tab>
        <ons-tab page="tab2.html" icon="md-search">
        </ons-tab>
        <ons-tab page="tab3.html" icon="md-settings">
        </ons-tab>
        <!-- <ons-tab page="tab3.html" icon="md-favorite">
        </ons-tab>
        <ons-tab page="tab4.html" icon="md-settings">
        </ons-tab> -->
    </ons-tabbar>
    </ons-page>

    <template id="tab1.html">
      <ons-page id="Tab1">
      <!-- <ons-toolbar>
        <div class="left">
          <ons-toolbar-button icon="md-face"></ons-toolbar-button>
        </div>

        <div class="center">Title</div>

        <div class="right">
          <ons-toolbar-button>-</ons-toolbar-button>
          <ons-toolbar-button>+</ons-toolbar-button>
        </div>
      </ons-toolbar> -->
      <!-- This example requires Tailwind CSS v2.0+ -->

      <div class="cta filter">
      <ons-toolbar>
    <div class="center">Dropdown example</div>
    <div class="right">
    <ons-select id="choose-sel" onchange="editSelects(event)">
    <option value="all" data-filter="all">All</option>
    <?php foreach($cats as $cat): ?>
    <option value="<?php echo $cat->term_id; ?>" data-filter="brand-section-<?php echo $cat->term_id; ?>"><?php echo $cat->name; ?></option>
    <?php endforeach; ?>

  </ons-select>
    </div>
  </ons-toolbar>


 

        <div class="boxes">

      <?php  dynamic_sidebar('home_screen'); ?>
      </div>

      </div>
      </ons-page>
    </template>

    <template id="tab2.html">
      <ons-page id="Tab2">
      <?php  dynamic_sidebar('search_screen'); ?>
      </ons-page>
    </template>


    <template id="tab3.html">
      <ons-page id="Tab3">

      <div class=" ">
  <div class="   w-96 h-screen  ">
    <div class="  p-2">
      <div class="py-5 px-1">

        <div class=" max-w-md mx-auto pb-6 h-11 flex m-3 space-x-5">
        <div class="pt-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8    text-gray-500" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
        </div>

          <div class="text-gray-500 text-md">
            Sign in | create account  </div>
        </div>
        <div class=" max-w-md mx-auto pb-6 h-11 flex m-3 space-x-5">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8    text-gray-500" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
          </svg>

          <div class="text-gray-500 text-md">
            Notification
          </div>
        </div>
        <div class=" max-w-md mx-auto pb-6 h-11  flex m-3 space-x-5">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8  text-gray-500" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
          </svg>

          <div class="text-gray-500  text-md">
            Stores
          </div>
        </div>
        <div class=" max-w-md mx-auto pb-6 h-11 flex m-3 space-x-5">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8  text-gray-500" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
          </svg>

          <div class="text-gray-500 text-md">
            My orders </div>
        </div>
        <div class="  max-w-md mx-auto pb-6 h-11 flex m-3 space-x-5">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8  text-gray-500" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
          </svg>

          <div class="text-gray-500 text-md">
            Country and language
          </div>
        </div>
        <div class="-between">
          <div class="  max-w-md mx-auto pb-6 h-11 flex m-3 space-x-5">
            <svg xmlns="hjustifyttp://www.w3.org/2000/svg" class="h-8 w-8  text-gray-500" fill="none"
              viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
            </svg>

            <div class="text-gray-500 text-md">
              Dark mode
            </div>
            <div class=" absolute right-4">

              <!-- Toggle Button -->
              <label for="toogleA" class="flex items-center cursor-pointer">
                <!-- toggle -->
                <div class="relative">
                  <!-- input -->
                  <input id="toogleA" type="checkbox" class="hidden" />
                  <!-- line -->
                  <div class="toggle__line w-10 h-4 mt-1 bg-gray-400 rounded-full shadow-inner"></div>
                  <!-- dot -->
                  <div class="toggle__dot absolute w-8 h-8   bg-white rounded-full shadow inset-y-0 left-0"></div>
                </div>
                <!-- label -->

              </label>

            </div>





          </div>
        </div>

        <div class=" max-w-md mx-auto pb-6 h-11 flex m-3 space-x-5">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8  text-gray-500" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>

          <div class="text-gray-500 text-md">
            Help
          </div>
        </div>
     
        <?php  dynamic_sidebar('settings_screen'); ?>

        <div class=" max-w-md mx-auto pb-6 h-11 flex m-3 space-x-5">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8  text-gray-500" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>

          <div class="text-gray-500 text-md">
            Terms & conditions
          </div>
        </div>


      </div>
    </div>
  </div>

</div>




      

      </ons-page>
    </template>

    </div>
    
</div>
</div>

<?php







wp_footer();
