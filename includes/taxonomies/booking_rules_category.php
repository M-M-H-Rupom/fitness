<?php
function register_package_my_taxes() {

	$labels = [
		"name" => esc_html__( "Packages", "gmf" ),
		"singular_name" => esc_html__( "Package", "gmf" ),
	];

	$args = [
		"label" => esc_html__( "Packages", "gmf" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'package', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"show_tagcloud" => false,
		"rest_base" => "package",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"rest_namespace" => "wp/v2",
		"show_in_quick_edit" => false,
		"sort" => false,
		"show_in_graphql" => false,
	];
	register_taxonomy( "package", [ "booking_rules" ], $args );
}
add_action( 'init', 'register_package_my_taxes' );