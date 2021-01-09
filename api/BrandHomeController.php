<?php
class BrandHomeController{


    public function get(){
       
            $data = [];

            $sd = [];
            $i = 0;


            $sections =  get_field('home_screen_sections', 'option');

            foreach($sections as $section){
                $sd[$i]['title'] = $section['title'];

                if(!empty( $section['image'])){
                 $sd[$i]['image'] = $section['image'];
                }
                $sd[$i]['type'] =$section['type'];
              
                $sd[$i]['filter'] =$section['filter'] ? $section['filter'] : null;
               
                $sd[$i]['categories'] = $this->getCategories($section);

             
             


                if($section['type'] == 'product' ){
                    $sd[$i]['products'] = $this->getPosts($section);

                }


                $i++;
        
            }


            $data['categories'] =  get_field('filter_categories', 'option');;
            $data['sections'] = $sd;


            return  $data;
    }



    public function getCategories($section){
      $categories  = $section['categories'];
      foreach ($categories as $key => $cat ) {
      // get the thumbnail id using the queried category term_id
        $thumbnail_id = get_term_meta( $cat->id, 'thumbnail_id', true ); 

        var_dump( $cat->id);
        var_dump($key);
        // // get the image URL
        // $image = wp_get_attachment_url( $thumbnail_id ); 

        // $categories[$key]['thumbnail'] = $image;
    }

    return $categories;
  }
    



    public function getPosts($section){
        

     
        $args = array(
            'posts_per_page'  => $section['posts_per_page'],
            //'offset'          => $postOffset,
        );

        
        if(!empty($section['category'])) {
         $args['category'] =   $section['category']->slug;
        }

     

        
        /** 
         * Add Terms
         * 
        */
        // $terms =  $section['category'];
        // if(!empty($terms)){
        //     $data[$i]['terms']  = $terms->slug;
        //     $args['tax_query'] = array(
        //         array(
        //             'taxonomy' => $postType.'-categories',
        //             'field'    => 'slug',
        //             'terms'    => $terms,
        //         ),
        //     );
        // }



        //$posts = get_posts($args);
    
        $products_query = wc_get_products($args);
        $products = array();
        foreach ( $products_query as $product ) {

                
        //    $products[]  = wc_get_product($product->id)->get_data();
        $products[] = $this->brand_add_custom_data_to_product($product,$product);



                 


      
            
        }

        return $products;

    }
    function brand_add_custom_data_to_product( $response, $product) {

        $data = $response->get_data();  
      
        
        $data['currency'] = get_woocommerce_currency_symbol();
      
          /**
           * Add Colors
           */
        if(taxonomy_exists( 'pa_color' )){
      
          $terms = get_terms( 'pa_color' );
          $colors=[];
          foreach($terms as $term){
            $colors[] = get_term_meta( $term->term_id,'color', true );
          }
        
        }
      
          /**
           * Add Patterns
           */
        
         
        if(taxonomy_exists( 'pa_pattern' )){
          $terms = get_terms( 'pa_pattern' );
          $patterns=[];
          foreach($terms as $term){
            $patterns[] =wp_get_attachment_url( get_term_meta( $term->term_id,'image', true ));
          }
        }
    


       $attrs= [];
          foreach($product->get_attributes() as $key => $attr){     
            $attrs[]  = $attr->get_data();
        }
        $data['attributes'] =$attrs;

        
        foreach($data['attributes'] as $key => $attr){
            foreach($data['attributes'][$key]['options'] as $k => $option){
              if($attr['name'] === 'Color'){
                  $data['attributes'][$key]['options'][$k] = ['option'=>$option , 'value'=> $colors[$k],'disable'=>false];
              }elseif($attr['name'] === 'Pattern'){
                  // $data['attributes'][$key]['name'] = 'Color';
                  // $data['attributes'][$key]['type'] = 'pattern';	
                  $data['attributes'][$key]['options'][$k] = ['option'=>$option , 'value'=> $patterns[$k],'disable'=>false];	
              }else{
                  $data['attributes'][$key]['options'][$k] = ['option'=>$option , 'value'=> $option,'disable'=>false];
              } 
            }
      
          }


     
          if( $product->is_type( 'variable' ) ) {
               $variations = $product->get_available_variations();
                 $variations_id = wp_list_pluck( $variations, 'variation_id' );
                $data['variations'] = $variations_id;
          }
 
        
       //	$response =  custom_change_product_response($response)
        if(!empty( $data['variations'])){
          $variations = $data['variations'];
          $variations_res = array();
          $variations_array = array();
          if (!empty($variations) && is_array($variations)) {
            foreach ($variations as $variation) {
              $variation_id = $variation;
              $variation = new WC_Product_Variation($variation_id);

              

              $variations_res['id'] = $variation_id;
              $variations_res['on_sale'] = $variation->is_on_sale();
              $variations_res['regular_price'] =  (string) $variation->get_regular_price();
              $variations_res['sale_price'] = $variation->get_sale_price();
              $variations_res['sku'] = $variation->get_sku();
              $variations_res['quantity'] = $variation->get_stock_quantity();
              if ($variations_res['quantity'] == null) {
                $variations_res['quantity'] = '';
              }
              $variations_res['stock'] = $variation->get_stock_quantity();
      
              $attributes = array();
              // variation attributes
              foreach ( $variation->get_variation_attributes() as $attribute_name => $attribute ) {
                // taxonomy-based attributes are prefixed with `pa_`, otherwise simply `attribute_`
                $attributes[] = array(
                  'name'   => wc_attribute_label( str_replace( 'attribute_', '', $attribute_name ), $variation ),
                  'slug'   => str_replace( 'attribute_', '', wc_attribute_taxonomy_slug( $attribute_name ) ),
                  'option' => $attribute,
                );
      
                $variations_res['variation_attributes'][strtolower( wc_attribute_label( str_replace( 'attribute_', '', $attribute_name ), $variation ))] =  $attribute;
              }
      
              $variations_res['attributes'] = $attributes;
              $variations_array[] = $variations_res;
            }
          }
          $data['variations'] = $variations_array;
        }



        $data['images'] =woo_get_images($product);
        return  $data;
      }
        
}


