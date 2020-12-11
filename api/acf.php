<?php

	
if( function_exists('acf_add_options_page') ) {
  
	acf_add_options_page(array(
	  'page_title' 	=> 'Rekord App Settings',
	  'menu_title'	=> 'Rekord App',
	  'menu_slug' 	=> 'rekord-app',
	  'capability'	=> 'edit_posts',
	//  'parent_slug'	=> 'edit.php?post_type=podcast',
	  'redirect'		=> false
	));
  }
  if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array(
		'key' => 'group_5f64bff58c3d2',
		'title' => 'Rekord App',
		'fields' => array(

		

			////////////
			array(
				'key' => 'field_brand5f64ef6a615ed',
				'label' => 'Explore Screen',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'left',
				'endpoint' => 0,
			),
			array(
				'key' => 'field_brand5f64c23da4525',
				'label' => 'Explore Screen Settings',
				'name' => 'r_explore_screen',
				'type' => 'repeater',
				'instructions' => 'Add explore screen sections',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => '',
				'min' => 0,
				'max' => 0,
				'layout' => 'block',
				'button_label' => '',
				'sub_fields' => array(
					array(
						'key' => 'field_brand5f64c388a4526',
						'label' => 'Title',
						'name' => 'r_title',
						'type' => 'text',
						'instructions' => 'Add section title',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
					),
			

					//Start post & cat

					
					array(
						'key' => 'field_brand5f93049f2afc4',
						'label' => 'Select Post Type',
						'name' => 'r_post_type',
						'type' => 'select',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'album' => 'Album',
							'track' => 'Track',
							'artist' => 'Artist',
						),
						'default_value' => array(
						),
						'allow_null' => 0,
						'multiple' => 0,
						'ui' => 0,
						'return_format' => 'value',
						'ajax' => 0,
						'placeholder' => '',
					),
					array(
						'key' => 'field_brand5f9303d98da73',
						'label' => 'Select Album Category',
						'name' => 'r_category',
						'type' => 'taxonomy',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_brand5f93049f2afc4',
									'operator' => '==',
									'value' => 'album',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'taxonomy' => 'album-categories',
						'field_brandtype' => 'select',
						'allow_null' => 0,
						'add_term' => 0,
						'save_terms' => 0,
						'load_terms' => 0,
						'return_format' => 'object',
						'multiple' => 0,
					),
					array(
						'key' => 'field_brand5f9305792afc6',
						'label' => 'Select Artist Category',
						'name' => 'r_category',
						'type' => 'taxonomy',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_brand5f93049f2afc4',
									'operator' => '==',
									'value' => 'artist',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'taxonomy' => 'artist-categories',
						'field_brandtype' => 'select',
						'allow_null' => 0,
						'add_term' => 0,
						'save_terms' => 0,
						'load_terms' => 0,
						'return_format' => 'object',
						'multiple' => 0,
					),
					array(
						'key' => 'field_brand5f93059d2afc7',
						'label' => 'Select Track Category',
						'name' => 'r_category',
						'type' => 'taxonomy',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => array(
							array(
								array(
									'field' => 'field_brand5f93049f2afc4',
									'operator' => '==',
									'value' => 'track',
								),
							),
						),
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'taxonomy' => 'track-categories',
						'field_brandtype' => 'select',
						'allow_null' => 0,
						'add_term' => 0,
						'save_terms' => 0,
						'load_terms' => 0,
						'return_format' => 'object',
						'multiple' => 0,
					),
				
					//



					array(
						'key' => 'field_brand5f64c657d50c8',
						'label' => 'Number of Post',
						'name' => 'r_number_of_post',
						'type' => 'number',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => 5,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'min' => '',
						'max' => '',
						'step' => '',
					),
				
					// array(
					// 	'key' => 'field_brand5f64f29f18f7f',
					// 	'label' => 'Style',
					// 	'name' => 'r_style',
					// 	'type' => 'radio',
					// 	'instructions' => '',
					// 	'required' => 0,
					// 	'conditional_logic' => 0,
					// 	'wrapper' => array(
					// 		'width' => '',
					// 		'class' => '',
					// 		'id' => '',
					// 	),
					// 	'choices' => array(
					// 		'style1' => 'Style 1',
					// 		'style2' => 'Style 2',
					// 	),
					// 	'allow_null' => 0,
					// 	'other_choice' => 0,
					// 	'default_value' => '',
					// 	'layout' => 'vertical',
					// 	'return_format' => 'value',
					// 	'save_other_choice' => 0,
					// ),
				),
			),


			array(
				'key' => 'field_brand5f64ef6a615ex1cZ',
				'label' =>'Albums Screen',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'left',
				'endpoint' => 0,
			),
			array(
				'key' => 'field_brand5f64c657d50c82',
				'label' => 'Number of Post',
				'name' => 'r_album_post_per_page',
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 5,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),

			
			array(
				'key' => 'field_brand5f64ef6a615ex2dZ',
				'label' =>'Artists Screen',
				'name' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'left',
				'endpoint' => 0,
			),
			array(
				'key' => 'field_brand5f64c657d50c81',
				'label' => 'Number of Post',
				'name' => 'r_artist_post_per_page',
				'type' => 'number',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 5,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => '',
				'max' => '',
				'step' => '',
			),
		
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'rekord-app',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));
	
    endif;