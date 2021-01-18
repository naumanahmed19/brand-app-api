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
        $data[$key]['title']  = $item['title'];
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
   
    $sections[$i]['title'] = get_field('title', 'widget_' .$widget);

    if($name == 'brandslider_widget'){
      $sections[$i]['type']='slider';
      $sections[$i]['filter']=null;
      $slides = get_field('slides', 'widget_' .$widget);
      $sections[$i]['slides'] = $this->getSlides($slides);
    }
    
    if($name == 'brand_categoriescarousel_widget'){
      $sections[$i]['type']='cc';
      $sections[$i]['filter']=null;
      $cats = get_field('categories', 'widget_' .$widget);
      $sections[$i]['categories'] = $this->getCategories($cats);
    }
    if($name == 'brand_bannerwithcategories_widget'){
      $sections[$i]['type']='bc';
      $sections[$i]['filter']=null;
      $cats = get_field('categories', 'widget_' .$widget);
      $image = get_field('image', 'widget_' .$widget);
      $sections[$i]['title'] = get_field('title', 'widget_' .$widget) ;
      $sections[$i]['image'] = $image ;
      $sections[$i]['categories'] = $this->getCategories($cats);
    }
    if($name == 'brand_productscarousel_widget'){
      $sections[$i]['type']='product';
      $sections[$i]['filter']=null;
      $sections[$i]['title'] = get_field('title', 'widget_' .$widget) ;
      $ctrl = new BrandProductController();
      $sections[$i]['products'] =  $ctrl->getProducts($widget);
    }
    if($name == 'brandcategorylist_widget'){
      $sections[$i]['type']= 'categorylist';
      $sections[$i]['categories']  = $this->getCategoriesRow($widget);
    }



    
   
 

    
    
    $i++;
    }

   return $sections;

}
        
}


