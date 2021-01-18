<?php
class BrandCategoriesController{


    public function get(){
        $data = [];
        $data['sections'] =  $this->getWidgets();

        return   $this->getWidgets();
    }


    

public function getWidgets(){
    $sidebars_widgets = wp_get_sidebars_widgets();
    $widgets = $sidebars_widgets['brand-search-screen'];
  
    $sections = [];
   
    foreach( $widgets as $key => $widget){
      $arr = explode("-",$widget);
      
      $name = $arr[0];
      $widget_id = $arr[1];
  

      if($name == 'brandcategorylist_widget'){
        $sections[$key]['type']= 'categorylist';
        $sections[$key]['categories']  = $this->getCategories($widget);
      }

      }
  
     return $sections;
  
  }

  public function getCategories($widget){
    $ctrl = new BrandHomeController();
    $items = get_field('category_list', 'widget_' .$widget);
   
    $data = [];
    foreach ($items as $key => $item ) {
      $data[$key]['title']  = $item['title'];
      $data[$key]['categories']  = $ctrl->getCategories($item['categories']);
    }

    return $data;
  }
    
        
}


