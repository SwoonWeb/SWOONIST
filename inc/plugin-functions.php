<?php

/**
 * Filter Yoast Meta Priority
 */
function atg_filter_yoast_seo_metabox() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'atg_filter_yoast_seo_metabox' );

/**
 * Change GravityForms fields to work with Bootstrap and Select2 (optional)
 */
 add_filter( 'gform_field_content', function ( $field_content, $field ) {
  if ( $field->type == 'fileupload' ) {
		$field_content = str_replace("<div class='ginput_container ginput_container_fileupload'>", "<div class='ginput_container ginput_container_fileupload'><label class='file'>", $field_content);
  	$field_content = str_replace("<span id=", "<span data-file='Choose file...' class='file-custom'></span></label><span id=", $field_content);
  	return $field_content;
  } elseif ( $field->type == 'select' ) {
  	return str_replace("<select", "<select data-placeholder='".$field->placeholder."'", $field_content);
  } elseif ( $field->type == 'multiselect' ) {
  	// Using the Admin Lable since the placeholder is not available
  	return str_replace("<select", "<select data-placeholder='".$field->adminLabel."'", $field_content);
  }
  return $field_content;
}, 10, 2 );