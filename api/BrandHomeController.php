<?php
class BrandHomeController{


    public function get(){
            $data = [];
            $data['categories'] =  get_field('filter_categories', 'option');
            $data['sections'] =  $this->getWidgets('home_screen');
            $data['settings'] =  $this->getSettings('home_screen');
            return  $data;
    }



    /**
     * Get categories:
     * Issue: Acf taxonomy does not return product category image so we are mapping it here
     */
    public function getCategories($cats){
        $categories = [];
        foreach ($cats as $key => $cat ) {
          $thumbnail_id = get_term_meta( $cat->term_id, 'thumbnail_id', true ); 
          $cat_thumb_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
          $image = wp_get_attachment_url( $cat_thumb_id ); 
          $cat->image = $image ? $image : null;
          $categories[] = $cat;
        }

        

      return $categories;
    }
    
    public function getSlides($slides){
      $allSlides = [];
      foreach ($slides as $key => $slide ) {
        $allSlides[$key]['image']  = $slide['image'];
        $allSlides[$key]['category']  = $slide['category'];
      }

      return $allSlides;
    }

    public function getCategoriesRow($widget){
    
      $items = get_field('category_list', 'widget_' .$widget);
     
      $data = [];
      foreach ($items as $key => $item ) {
        $data[$key]['name']  = $item['title'];
        $data[$key]['categories']  = $this->getCategories($item['categories']);
      }
  
      return $data;
    }



    public function getSectionSettings($wId){
      $sectionSettings = [];
      $sectionSettings ['radius'] = get_field('radius', $wId);
      $sectionSettings ['padding'] = get_field('padding', $wId);
      $sectionSettings ['color'] = get_field('color', $wId);
      $sectionSettings ['margin'] = get_field('margin', $wId);
      return $sectionSettings;
    }
    




      

//TODO
//Add template to plugin
//add sidebar locations



function getWidgets($s ){
  $sidebars_widgets = wp_get_sidebars_widgets();
  $sidebars= ['home_screen','search_screen','settings_screen'];

  $sections = [];
  $i = 0;
  foreach( $sidebars as $key => $sidebar){

  $widgets = $sidebars_widgets[$sidebar];

 
  foreach( $widgets as $key => $widget){
    $arr = explode("-",$widget);
    
    $name = $arr[0];
    $widget_id = $arr[1];
    // var_dump('widget_' . $name);
    //$widget_instances = get_option('widget_' . $name);

      $wId = 'widget_' .$widget;

      //common fileds
      $filter = get_field('filter', 'widget_' .$widget);
      $sections[$i]['filter'] = !empty($filter) ? $filter : null;
      $sections[$i]['screen'] = $sidebar;
      $sections[$i]['settings'] = $this->getSectionSettings($wId);


    if($name == 'brandslider_widget'){
      $sections[$i]['type']='slider';
      $slides = get_field('slides', 'widget_' .$widget);
      $sections[$i]['slides'] = $this->getSlides($slides);
    }
    
    if($name == 'brand_categoriescarousel_widget'){
      $sections[$i]['type']='cc';
      $cats = get_field('categories', $wId);
      $sections[$i]['categories'] = $this->getCategories($cats);
      //extra item settings
      $sections[$i]['settings']['img_radius'] = intval(get_field('img_radius', $wId));
  
      
    }
    if($name == 'brand_bannerwithcategories_widget'){
      $sections[$i]['type']='bc';
      $cats = get_field('categories', 'widget_' .$widget);
      $image = get_field('image', 'widget_' .$widget);
      $sections[$i]['title'] = get_field('title', 'widget_' .$widget) ;
      $sections[$i]['image'] = $image ;
      $sections[$i]['categories'] = $this->getCategories($cats);
    }
    if($name == 'brand_productscarousel_widget'){
      $sections[$i]['type']='product';
      $sections[$i]['title'] = get_field('title', 'widget_' .$widget) ;
      $ctrl = new BrandProductController();
      $sections[$i]['products'] =  $ctrl->getProducts($widget);
      $sections[$i]['settings']['columns'] = intval(get_field('columns', $wId));
    }
    if($name == 'brandcategorylist_widget'){
      $sections[$i]['type']= 'categorylist';
      $sections[$i]['categories']  = $this->getCategoriesRow($widget);
    }
    if($name == 'widget_link_tile'){
      $sections[$i]['type']= $name ;
      $sections[$i]['icon'] = get_field('leading_icon', 'widget_' .$widget) ;
     
      $post =  get_field('page', 'widget_' .$widget) ;
      $sections[$i]['title'] = $post->post_title;
      $sections[$i]['content'] = $post->post_content ;
    }
    
    
    $i++;
    }
  }

   return $sections;

}

  public function getSettings($screen)
  {
    $settings = [];

   

    //general settings...
    $general = []; 
    $general['logo'] =  get_field('logo', 'option') ;
    $general['app_currency'] =  get_field('app_currency', 'option') ;
    $general['app_filter_min_price'] =  get_field('app_filter_min_price', 'option') ;
    $general['app_filter_max_price'] =  get_field('app_filter_max_price', 'option') ;
    $general['app_default_theme'] =  get_field('app_default_theme', 'option') ;
    $general['app_theme_switcher'] =  get_field('app_theme_switcher', 'option') ;
    
    $settings['general'] = $general;
    


    //home settings...
    $home = [];
    $home['app_home_logo'] =  get_field('app_home_logo', 'option') ;
    $home['app_home_search'] =  get_field('app_home_search', 'option') ;
 
    $settings['home'] = $home;


    return $settings;

  }
        
}


