<?php
/**
 * Plugin Name: Rekord API
 * Plugin URI: 
 * Description: API for Rekord WordPress Theme
 * Version: 1.3
 * Author: xvelopers
 * Author URI: http://xvelopers.com
 */
include ( __DIR__ . '/acf.php');
// include ( __DIR__ . '/helpers.php');

// include ( __DIR__ . '/RekordArtistsController.php');
// include ( __DIR__ . '/RekordTracksController.php');
// include ( __DIR__ . '/RekordAlbumsController.php');

	include ( __DIR__ . '/RekordExploreController.php');
// include ( __DIR__ . '/RekordUserController.php');

function rekord_api_get_home($post_type){
    $response = new RekordExploreController();
    return  $response->get();
}


// function rekord_api_get_albums() {
    
//     $albums = new RekordAlbumsController();
// 	$posts = rekord_api_get_posts('album');
// 	$data =  $albums->data($posts);
// 	return [
// 		'data' => $data,
// 		'status' => 200
// 	];
// }

// function rekord_api_get_tracks() {
//     $tracks = new RekordTracksController();
// 	$posts = rekord_api_get_posts('track');
// 	$data =  $tracks->data($posts);
// 	return [
// 		'data' => $data,
// 		'status' => 200
// 	];
// }

// function rekord_api_get_artists() {
//     $artists = new RekordArtistsController();
// 	$posts = rekord_api_get_posts('artist');
// 	$data =  $artists->data($posts);
// 	return [
// 		'data' => $data,
// 		'status' => 200
// 	];
// }





// function rekord_api_get_taxonomy(){
// 	$type = !empty($_GET['type']) ? $_GET['type'] : '';
// 	$terms = get_terms($type); 

// 	return $terms;
// }



// function wl_post( $slug ) {
// 	$args = [
// 		'name' => $slug['slug'],
// 		'post_type' => 'post'
// 	];

// 	$post = get_posts($args);


// 	$data['id'] = $post[0]->ID;
// 	$data['title'] = $post[0]->post_title;
// 	$data['content'] = $post[0]->post_content;
// 	$data['slug'] = $post[0]->post_name;
// 	$data['media']['thumbnail'] = get_the_post_thumbnail_url($post[0]->ID, 'thumbnail');
// 	$data['media']['medium'] = get_the_post_thumbnail_url($post[0]->ID, 'medium');
// 	$data['media']['large'] = get_the_post_thumbnail_url($post[0]->ID, 'large');

// 	return $data;
// }

// function addToFav(){

	

// 	$post_id = 1750;
// 	$favorite = new \Favorites\Entities\Favorite\Favorite();

	
// 	global $current_user;

// 		$_POST['logged_in'] = $current_user->ID;

// 		add_action('favorites_before_favorite', $post_id, 'active', get_current_blog_id() ,$current_user);
		
// 	// Trigger an update with the desired `post_id`
// 	$favorite->update( $post_id, 'active', get_current_blog_id() );
// }

// add_action('rest_api_init', function() {

	
	$routes = ['home','posts','taxonomy'];
	foreach($routes as $route){
		register_rest_route('wl/v1', $route, [
			'methods' => 'GET',
			'callback' => 'brand_api_get_'.$route,
		]);
	}


// 	register_rest_route( 'wl/v1', 'fav', array(
// 		'methods' => 'GET',
// 		'callback' => 'addToFav',
// 	) );


// 	register_rest_route( 'wl/v1', 'posts/(?P<slug>[a-zA-Z0-9-]+)', array(
// 		'methods' => 'GET',
// 		'callback' => 'wl_post',
// 	) );


// 	register_rest_route( 'wl/v1', 'user/update', array(
// 		'methods' => 'POST',
// 		'callback' => function (){
// 			return get_currentuserinfo();
// 			$userController = new RekordUserController();
// 			return $userController->update($_REQUEST);
// 		},
// 		// 'permission_callback' => function($request){	  
// 		// 	return is_user_logged_in();
// 		//   }
		
// 	) );

// }, 100, 2);


//  // $response = new WP_REST_Response($data, 200);
//  add_action( 'simple_jwt_login_login_hook', function($user){

// 	return $user;

// }, 10, 2);


// add_action( 'simple_jwt_login_jwt_payload_auth', function($user){

// 	$userController = new RekordUserController();
// 	global $current_user;
	
// 	$payload['user'] =	$userController->get($payload['id']);
	
// 	return $payload;

// }, 10, 2);


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




// add this code to a custom plugin
// add_filter( 'prepare_object_for_response', 'wc_app_add_custom_data_to_product', 10, 3 );

// // filter the product response here
// function wc_app_add_custom_data_to_product( $response, $post, $request ) {
//   // in this case we want to display the short description, so we copy it over to the description, which shows up in the app
//   $response->data['description'] = 'testing.....';
//   return $response;

// }


// $wc_rest_api->get('products', array('category' => '1234', 'fields_in_response' => array(
//     'id',
//     'images',
//     'slug'
// ) ) );
// add this code to a custom plugin
// add_filter( 'woocommerce_rest_prepare_product', 'wc_app_add_custom_data_to_product', 10, 3 );

// // filter the product response here
// function wc_app_add_custom_data_to_product( $response, $post, $request ) {
// 	var_dump('xxxxxx');
//   // in this case we want to display the short description, so we copy it over to the description, which shows up in the app
//   $response->data['aaaaaaa'] ='aaaaaaa';
//   $response->data['description'] = $response->data['short_description'];
//   return 'xxxx';

//}

// add_filter('woocommerce_rest_prepare_product_object', 'at_wc_rest_api_adjust_response_data', 10, 3);

// function at_wc_rest_api_adjust_response_data( $response, $object, $request ) {

// 	return  'xxxxxx';

//     $params = $request->get_params();
//     if ( ! $params['fields_in_response'] ) {
//         return $response;
//     }

//     $data = $response->get_data();  
//     $cropped_data = array();

//     foreach ( $params['fields_in_response'] as $field ) {
//         $cropped_data[ $field ] = $data[ $field ];
//     }   

//     $response->set_data( $cropped_data );   

//     return $response;

// }





// add this code to a custom plugin
add_filter( 'woocommerce_rest_prepare_product_object', 'wc_app_add_custom_data_to_product', 10, 3 );

// filter the product response here
function wc_app_add_custom_data_to_product( $response, $post, $request ) {


	$data = $response->get_data();  

	/**
	 * Add Colors
	 */
	$terms = get_terms( 'pa_color' );
	$colors=[];
	foreach($terms as $term){
		$colors[] = get_term_meta( $term->term_id,'color', true );
	}

	/**
	 * Add Patterns
	 */
	$terms = get_terms( 'pa_pattern' );
	$patterns=[];
	foreach($terms as $term){
		$patterns[] =wp_get_attachment_url( get_term_meta( $term->term_id,'image', true ));
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


  
  $response->set_data($data );   
  return $response;

}



function custom_change_product_response($response) {
    $variations = $response->data['variations'];
    $variations_res = array();
    $variations_array = array();
    if (!empty($variations) && is_array($variations)) {
        foreach ($variations as $variation) {
            $variation_id = $variation;
            $variation = new WC_Product_Variation($variation_id);
            $variations_res['id'] = $variation_id;
            $variations_res['on_sale'] = $variation->is_on_sale();
            $variations_res['regular_price'] = (float)$variation->get_regular_price();
            $variations_res['sale_price'] = (float)$variation->get_sale_price();
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
            }

            $variations_res['attributes'] = $attributes;
            $variations_array[] = $variations_res;
        }
    }
    $response->data['product_variations'] = $variations_array;

    return $response;
}