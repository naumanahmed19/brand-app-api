<?php
class BrandHomeController{


    public function get(){
            $data = [];
            $data['categories'] =  get_field('filter_categories', 'option');
            $data['sections'] =  $this->getWidgets('brand-home-screen');
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





      

//TODO
//Add template to plugin
//add sidebar locations



function getWidgets($sidebar ){
  $sidebars_widgets = wp_get_sidebars_widgets();
  $widgets = $sidebars_widgets[$sidebar];

  $sections = [];
  $i = 0;
  foreach( $widgets as $key => $widget){
    $arr = explode("-",$widget);
    
    $name = $arr[0];
    $widget_id = $arr[1];
    // var_dump('widget_' . $name);
    //$widget_instances = get_option('widget_' . $name);

    

      //common fileds
      $filter = get_field('filter', 'widget_' .$widget);
      $sections[$i]['filter'] = !empty($filter) ? $filter : null;


    if($name == 'brandslider_widget'){
      $sections[$i]['type']='slider';
      $slides = get_field('slides', 'widget_' .$widget);
      $sections[$i]['slides'] = $this->getSlides($slides);
    }
    
    if($name == 'brand_categoriescarousel_widget'){
      $sections[$i]['type']='cc';
      $cats = get_field('categories', 'widget_' .$widget);
      $sections[$i]['categories'] = $this->getCategories($cats);
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

   return $sections;

}
        
}


