<?php

include ( __DIR__ . '/acf.php');


include ( __DIR__ . '/BrandProductController.php');
include ( __DIR__ . '/BrandHomeController.php');
include ( __DIR__ . '/BrandCategoriesController.php');
include ( __DIR__ . '/BrandFilterController.php');
include ( __DIR__ . '/BrandUserController.php');
include ( __DIR__ . '/BrandWooController.php');


require_once ABSPATH . '/wp-content/plugins/simple-jwt-login/src/modules/SimpleJWTLoginService.php';




function rekord_api_get_home($post_type){
    $response = new BrandHomeController();
    return  $response->get();
}
function rekord_api_get_categories($post_type){
    $response = new BrandCategoriesController();
    return  $response->get();
}
function rekord_api_get_filters($post_type){
    $response = new BrandFilterController();
    return  $response->get();
}

add_action('rest_api_init', function() {

	$routes = ['home','categories','filters'];
	foreach($routes as $route){
		register_rest_route('wc/v3', $route, [
			'methods' => 'GET',
			'callback' => 'rekord_api_get_'.$route,
		]);
	}

	
	register_rest_route( 'brand', 'user/update', array(
		'methods' => 'POST',
		'callback' => function ( $request ) use ( $route  ) {


      // var_dump($sm->getUserIdFromJWT('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2MDkzNDk2MTQsImV4cCI6MTYyNzM0OTYxNCwiZW1haWwiOiJuYXVtYW5haG1lZDE5QGdtYWlsLmNvbSIsImlkIjoxLCJzaXRlIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDAiLCJ1c2VybmFtZSI6ImFkbWluIiwidXNlciI6eyJpZCI6MSwiZW1haWwiOiJuYXVtYW5haG1lZDE5QGdtYWlsLmNvbSIsImZpcnN0TmFtZSI6Ik5hdWFtbiIsImxhc3ROYW1lIjoiQWhtYWQiLCJhdmF0YXIiOiJodHRwOlwvXC8yLmdyYXZhdGFyLmNvbVwvYXZhdGFyXC8_cz05NiZkPW1tJnI9ZyJ9fQ.srwf7hZSCkJPxn46AELRbLdXG-t40gQN0uo22MzZeO0'));

      

      global $current_user;
      return $current_user;
			$userController = new BrandUserController();
			return $userController->update($_REQUEST);
    },
   // 'permission_callback' => true
		// 'permission_callback' => function($request){	  
		// 	return is_user_logged_in();
		//   }
		
  ) );


  /**
   * 
   * Brand Route to caclculate price on backend 
   */    
  
  register_rest_route( 'brand/v1', 'calculate', array(
		'methods' => 'POST',
    'callback' => function ( $request ) use ( $route  ) {
			$woo = new BrandWooController();
			return $woo->calculate($request);
    }
	) );



}, 100, 2);


 // $response = new WP_REST_Response($data, 200);
 add_action( 'simple_jwt_login_login_hook', function($user){



	return $user;

}, 10, 2);


add_action( 'simple_jwt_login_jwt_payload_auth', function($payload, $request){

	$userController = new BrandUserController();
  global $current_user;
  $payload['user'] =	$userController->get($payload['id']);
	return $payload;

}, 10, 2);



/**
 * V3 does not basc account details
 * so we are modify rest query
 *
 */
add_filter( 'woocommerce_rest_payment_gateway_object_query', 'brand_rest_prepare_order_object', 10, 3 );
function brand_rest_prepare_order_object( $response, $object, $request ) {
  // Get the value
  $bacs_info = get_option( 'woocommerce_bacs_accounts');

  $response->data['bacs_info'] = $bacs_info;

  return $response;
}


/**
 * V3 does not support muliple attributes
 * so we are modify rest products query
 *
 */
add_action( 'woocommerce_rest_product_object_query', 'brand_rest_product_object_query' );
function brand_rest_product_object_query($args){ 
    $filters  =!empty($_REQUEST['filter'])? $_REQUEST['filter'] :null;
    if ( ! empty( $filters ) ) {
    foreach ( $filters as $filter_key => $filter_value ) {
      if ( $filter_key === 'min_price' || $filter_key === 'max_price' ) {
        continue;
      }

      $args['tax_query'][] = [
        'taxonomy' => $filter_key,
        'field'    => 'term_id',
        'terms'    => \explode( ',', $filter_value ),
      ];
    }
  }
  return $args;
}

/**
 * Woo Change Rest Porduct Repsponse 
 * and variations 
 * v3 does not support variations directly in product
 * 
 */
add_filter( 'woocommerce_rest_prepare_product_object', 'brand_add_custom_data_to_product', 10, 3 );
function brand_add_custom_data_to_product( $response, $post, $request ) {

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

    foreach($response->data['attributes'] as $key => $attr){

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
  return  $data;
}




add_filter( 'woocommerce_rest_prepare_shop_order_object', 'brand_add_custom_data_to_order', 10, 3 );
function brand_add_custom_data_to_order( $response, $post, $request ) {

  $data = $response->get_data();  
  

  $products = [];
  $ctrl = new BrandProductController();

  foreach (  $data['line_items'] as $item) {
    // Get the accessible array of product properties:
    $product = wc_get_product($item['product_id']);

    $ctrl  = new WC_REST_Settings_V2_Controller ();

    $response=$ctrl->prepare_item_for_response($product);
    $products[] = $ctrl->brand_add_custom_data_to_product($response,$product); 
  }

  $data['products'] =  $products;

  $bacs_info = get_option( 'woocommerce_bacs_accounts');

  $data['bacs_info'] = $bacs_info;

  return $data;

}
/**
 * Sets the extension and mime type for .webp files.
 *
 * @param array  $wp_check_filetype_and_ext File data array containing 'ext', 'type', and
 *                                          'proper_filename' keys.
 * @param string $file                      Full path to the file.
 * @param string $filename                  The name of the file (may differ from $file due to
 *                                          $file being in a tmp directory).
 * @param array  $mimes                     Key is the file extension with value as the mime type.
 */
add_filter( 'wp_check_filetype_and_ext', 'wpse_file_and_ext_webp', 10, 4 );
function wpse_file_and_ext_webp( $types, $file, $filename, $mimes ) {
    if ( false !== strpos( $filename, '.webp' ) ) {
        $types['ext'] = 'webp';
        $types['type'] = 'image/webp';
    }

    return $types;
}

/**
 * Adds webp filetype to allowed mimes
 * 
 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/upload_mimes
 * 
 * @param array $mimes Mime types keyed by the file extension regex corresponding to
 *                     those types. 'swf' and 'exe' removed from full list. 'htm|html' also
 *                     removed depending on '$user' capabilities.
 *
 * @return array
 */
add_filter( 'upload_mimes', 'wpse_mime_types_webp' );
function wpse_mime_types_webp( $mimes ) {
    $mimes['webp'] = 'image/webp';

  return $mimes;
}



function woo_get_images( $product ) {
  $images         = array();
  $attachment_ids = array();

  // Add featured image.
  if ( $product->get_image_id() ) {
    $attachment_ids[] = $product->get_image_id();
  }

  // Add gallery images.
  $attachment_ids = array_merge( $attachment_ids, $product->get_gallery_image_ids() );

  // Build image data.
  foreach ( $attachment_ids as $attachment_id ) {
    $attachment_post = get_post( $attachment_id );
    if ( is_null( $attachment_post ) ) {
      continue;
    }

    $attachment = wp_get_attachment_image_src( $attachment_id, 'full' );
    if ( ! is_array( $attachment ) ) {
      continue;
    }

    $images[] = array(
      'id'                => (int) $attachment_id,
      'date_created'      => wc_rest_prepare_date_response( $attachment_post->post_date, false ),
      'date_created_gmt'  => wc_rest_prepare_date_response( strtotime( $attachment_post->post_date_gmt ) ),
      'date_modified'     => wc_rest_prepare_date_response( $attachment_post->post_modified, false ),
      'date_modified_gmt' => wc_rest_prepare_date_response( strtotime( $attachment_post->post_modified_gmt ) ),
      'src'               => current( $attachment ),
      'name'              => get_the_title( $attachment_id ),
      'alt'               => get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ),
    );
  }

  return $images;
}