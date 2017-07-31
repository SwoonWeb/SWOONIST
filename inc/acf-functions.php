<?php

/**
 * ACF Options Page
 */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title' 	=> 'Theme Options',
		'menu_slug' 	=> 'theme-options',
		'capability' 	=> 'edit_posts',
		'icon_url' 		=> 'dashicons-hammer',
		'redirect' 		=> false
	));
}

// function my_acf_init() {
// 	// https://developers.google.com/maps/documentation/javascript/get-api-key
//   acf_update_setting('google_api_key', 'AIzaSyBiDK98hDgbGYKAXant_mGAbtfLW7_wRtY');
// }
// add_action('acf/init', 'my_acf_init');

/**
 * ACF Default Fields
 */
if( function_exists('acf_add_local_field_group') ):

	acf_add_local_field_group(array (
		'key' => 'group_55b4f5e47478a',
		'title' => 'Global Options',
		'fields' => array (
			array (
				'key' => 'field_55e856c7aa718',
				'label' => 'Social Media',
				'name' => 'social_media',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'min' => '',
				'max' => '',
				'layout' => 'table',
				'button_label' => 'Add Social Media',
				'collapsed' => '',
				'sub_fields' => array (
					array (
						'key' => 'field_55e856d5aa719',
						'label' => 'URL',
						'name' => 'url',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
						'readonly' => 0,
						'disabled' => 0,
					),
					array (
						'key' => 'field_55e856dfaa71a',
						'label' => 'Icon Class',
						'name' => 'icon_class',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array (
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'maxlength' => '',
						'readonly' => 0,
						'disabled' => 0,
					),
				),
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'theme-options',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));

endif;