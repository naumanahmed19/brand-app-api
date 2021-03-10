<?php

function brand_get_post_media($id){
    $media = [];
    $media['thumbnail'] = get_the_post_thumbnail_url($id, 'thumbnail');
    $media['medium'] = get_the_post_thumbnail_url($id, 'medium');
	$media['large'] = get_the_post_thumbnail_url($id, 'large');

	if(!empty( $cover = brand_get_field('cover',$id))){
		$media['cover'] = $cover['url']   ;
	}
    	
    return $media;
}

function brand_api_get($post_type, $postsPerPage = 10){



	if(!empty($number = brand_get_field("r_{$post_type}_post_per_page", 'option'))){
		$postsPerPage =$number;
	}

	$page = 1;
	$postOffset = 0;
	$postsPerPage = !empty($_GET['numberposts'] )? $_GET['numberposts'] :$postsPerPage;
	
	
	if(!empty($_GET['page'])){
		$page = $_GET['page'];
		$postOffset = $page * $postsPerPage;
	}

	$args = array(
		'posts_per_page'  => $postsPerPage,
		//'category_name'   => $btmetanm,
		//'offset'          => $postOffset,
		'post_type'       => $post_type,
		'paged' => $page,
	);


	if(!empty($_GET['q'])){
		$args['s'] =  esc_attr( $_GET['q']);
		//$args['posts_per_page'] = -1;
	}

	return  get_posts($args);
}

function isFavorited($id){
	global $current_user;
	 return in_array($id, get_user_favorites( $current_user->ID)) ;
}



