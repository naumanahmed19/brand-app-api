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
      <?php  dynamic_sidebar('home_screen'); ?>
      </ons-page>
    </template>

    <template id="tab2.html">
      <ons-page id="Tab2">
      <?php  dynamic_sidebar('search_screen'); ?>
      </ons-page>
    </template>


    <template id="tab3.html">
      <ons-page id="Tab3">
      <?php  dynamic_sidebar('settings_screen'); ?>
      </ons-page>
    </template>

    </div>
    
</div>
</div>

<?php







wp_footer();
