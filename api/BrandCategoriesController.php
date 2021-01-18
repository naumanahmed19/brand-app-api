<?php
class BrandCategoriesController{


    public function get(){
        $data = [];
        $data['sections'] =  $this->getWidgets();

        return  $data;
    }


    

public function getWidgets(){
    $sidebars_widgets = wp_get_sidebars_widgets();
    $widgets = $sidebars_widgets['brand-search-screen'];
  
    $sections = [];
    $i = 0;
    // foreach( $widgets as $key => $widget){
    //   $arr = explode("-",$widget);
      
    //   $name = $arr[0];
    //   $widget_id = $arr[1];
  

    //   if($name == 'brandcategorylist_widget'){
    //     $sections[$i]['type']='categorylist';
    //     $sections[$i]['filter']=null;
    //     $items = get_field('category_list', 'widget_' .$widget);
    //     //$sections[$i]['title'] = get_field('title', 'widget_' .$widget) ;
    //     $ctrl = new BrandHomeController();
   
    //     $allSlides = [];
    //     foreach ($items as $key => $item ) {
    //       $allSlides[$key]['title']  = $item['title'];
    //       $allSlides[$key]['categories']  = $ctrl->getCategories($item['categories']);
    //     }

    //     $sections[$i]['categories'] =  $allSlides;
    //   }

    //   $i++;
    //   }
  
     return $sections;
  
  }
    
        
}


