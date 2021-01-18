<?php
class BrandHomeController{


    public function get(){
       
            $data = [];

            $sd = [];
            $i = 0;


            $sections =  get_field('home_screen_sections', 'option');

            foreach($sections as $section){
                $sd[$i]['title'] = $section['title'];

             
                $sd[$i]['type'] =$section['type'];
              
                $sd[$i]['filter'] =$section['filter'] ? $section['filter'] : null;
           
            

                if($section['type'] == 'product' ){
                    $ctrl = new BrandProductController();
                    $args = array(
                      'posts_per_page'  => $section['posts_per_page'],
                      //'offset'          => $postOffset,
                  );
                  if(!empty($section['category'])) {
                   $args['category'] =   $section['category']->slug;
                  }
              
                    $sd[$i]['products'] = $ctrl->getPosts($section);
                }

                if($section['type'] == 'slider' ){
                  $sd[$i]['slides'] = $this->getSlides($section['slides']);
                }else{

                if(!empty( $section['image'])){
                              $sd[$i]['image'] = $section['image'];
                              }

                //do not add categoires in slider section    
                    
                $sd[$i]['categories'] = $this->getCategories($section['categories']);

             
                }


                $i++;
        
            }


            $data['categories'] =  get_field('filter_categories', 'option');
            $data['sections'] =  $this->getWidgets();
            // $data['sections'] = $sd;


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



    
    // function brand_add_custom_data_to_product( $response, $product) {

    //     $data = $response->get_data();  
      
        
    //     $data['currency'] = get_woocommerce_currency_symbol();
      
    //       /**
    //        * Add Colors
    //        */
    //     if(taxonomy_exists( 'pa_color' )){
      
    //       $terms = get_terms( 'pa_color' );
    //       $colors=[];
    //       foreach($terms as $term){
    //         $colors[] = get_term_meta( $term->term_id,'color', true );
    //       }
        
    //     }
      
    //       /**
    //        * Add Patterns
    //        */
        
         
    //     if(taxonomy_exists( 'pa_pattern' )){
    //       $terms = get_terms( 'pa_pattern' );
    //       $patterns=[];
    //       foreach($terms as $term){
    //         $patterns[] =wp_get_attachment_url( get_term_meta( $term->term_id,'image', true ));
    //       }
    //     }
    


    //    $attrs= [];
    //       foreach($product->get_attributes() as $key => $attr){     
    //         $attrs[]  = $attr->get_data();
    //     }
    //     $data['attributes'] =$attrs;

        
    //     foreach($data['attributes'] as $key => $attr){
    //         foreach($data['attributes'][$key]['options'] as $k => $option){
    //           if($attr['name'] === 'Color'){
    //               $data['attributes'][$key]['options'][$k] = ['option'=>$option , 'value'=> $colors[$k],'disable'=>false];
    //           }elseif($attr['name'] === 'Pattern'){
    //               // $data['attributes'][$key]['name'] = 'Color';
    //               // $data['attributes'][$key]['type'] = 'pattern';	
    //               $data['attributes'][$key]['options'][$k] = ['option'=>$option , 'value'=> $patterns[$k],'disable'=>false];	
    //           }else{
    //               $data['attributes'][$key]['options'][$k] = ['option'=>$option , 'value'=> $option,'disable'=>false];
    //           } 
    //         }
      
    //       }


     
    //       if( $product->is_type( 'variable' ) ) {
    //            $variations = $product->get_available_variations();
    //              $variations_id = wp_list_pluck( $variations, 'variation_id' );
    //             $data['variations'] = $variations_id;
    //       }
 
        
    //    //	$response =  custom_change_product_response($response)
    //     if(!empty( $data['variations'])){
    //       $variations = $data['variations'];
    //       $variations_res = array();
    //       $variations_array = array();
    //       if (!empty($variations) && is_array($variations)) {
    //         foreach ($variations as $variation) {
    //           $variation_id = $variation;
    //           $variation = new WC_Product_Variation($variation_id);

              

    //           $variations_res['id'] = $variation_id;
    //           $variations_res['on_sale'] = $variation->is_on_sale();
    //           $variations_res['regular_price'] =  (string) $variation->get_regular_price();
    //           $variations_res['sale_price'] = $variation->get_sale_price();
    //           $variations_res['sku'] = $variation->get_sku();
    //           $variations_res['quantity'] = $variation->get_stock_quantity();
    //           if ($variations_res['quantity'] == null) {
    //             $variations_res['quantity'] = '';
    //           }
    //           $variations_res['stock'] = $variation->get_stock_quantity();
      
    //           $attributes = array();
    //           // variation attributes
    //           foreach ( $variation->get_variation_attributes() as $attribute_name => $attribute ) {
    //             // taxonomy-based attributes are prefixed with `pa_`, otherwise simply `attribute_`
    //             $attributes[] = array(
    //               'name'   => wc_attribute_label( str_replace( 'attribute_', '', $attribute_name ), $variation ),
    //               'slug'   => str_replace( 'attribute_', '', wc_attribute_taxonomy_slug( $attribute_name ) ),
    //               'option' => $attribute,
    //             );
      
    //             $variations_res['variation_attributes'][strtolower( wc_attribute_label( str_replace( 'attribute_', '', $attribute_name ), $variation ))] =  $attribute;
    //           }
      
    //           $variations_res['attributes'] = $attributes;
    //           $variations_array[] = $variations_res;
    //         }
    //       }
    //       $data['variations'] = $variations_array;
    //     }



    //     $data['images'] =woo_get_images($product);
    //     return  $data;
    //   }



      

//TODO
//Add template to plugin
//add sidebar locations



function getWidgets(){
  $sidebars_widgets = wp_get_sidebars_widgets();
  $widgets = $sidebars_widgets['brand-home-screen'];

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



    
   
 

    
    
    $i++;
    }

   return $sections;

}
        
}


