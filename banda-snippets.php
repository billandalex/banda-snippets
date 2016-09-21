<?php
/*
Plugin Name: Banda Snippets
Description: Create and display reusable code snippets
Version:     0.0.1
Author:      Banda
Author URI:  http://example.com
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );



// Register Custom Post Type
function banda_snippets() {

    $labels = array(
        'name'                  => _x( 'Snippets', 'Post Type General Name', 'banda_snippets' ),
        'singular_name'         => _x( 'Snippet', 'Post Type Singular Name', 'banda_snippets' ),
        'menu_name'             => __( 'Snippets', 'banda_snippets' ),
        'name_admin_bar'        => __( 'Snippets', 'banda_snippets' ),
        'archives'              => __( 'Snippet Archives', 'banda_snippets' ),
        'parent_item_colon'     => __( 'Parent Snippet:', 'banda_snippets' ),
        'all_items'             => __( 'All Snippets', 'banda_snippets' ),
        'add_new_item'          => __( 'Add New Snippets', 'banda_snippets' ),
        'add_new'               => __( 'Add New', 'banda_snippets' ),
        'new_item'              => __( 'New Item', 'banda_snippets' ),
        'edit_item'             => __( 'Edit Item', 'banda_snippets' ),
        'update_item'           => __( 'Update Item', 'banda_snippets' ),
        'view_item'             => __( 'View Item', 'banda_snippets' ),
        'search_items'          => __( 'Search Item', 'banda_snippets' ),
        'not_found'             => __( 'Not found', 'banda_snippets' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'banda_snippets' ),
        'featured_image'        => __( 'Featured Image', 'banda_snippets' ),
        'set_featured_image'    => __( 'Set featured image', 'banda_snippets' ),
        'remove_featured_image' => __( 'Remove featured image', 'banda_snippets' ),
        'use_featured_image'    => __( 'Use as featured image', 'banda_snippets' ),
        'insert_into_item'      => __( 'Insert into item', 'banda_snippets' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'banda_snippets' ),
        'items_list'            => __( 'Items list', 'banda_snippets' ),
        'items_list_navigation' => __( 'Items list navigation', 'banda_snippets' ),
        'filter_items_list'     => __( 'Filter items list', 'banda_snippets' ),
    );
    $args = array(
        'label'                 => __( 'Snippet', 'banda_snippets' ),
        'description'           => __( 'Snippets', 'banda_snippets' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
        'taxonomies'            => array( 'state', 'category' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-portfolio',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'banda_snippets', $args );

}
add_action( 'init', 'banda_snippets', 0 );
//add post-formats to post_type 'news'
add_post_type_support( 'banda_snippets', 'post-formats' );



// Add logic for github gists
include dirname( __FILE__ ) .'functions/banda-snippets-gists.php';




// Add custom page template from plugin dir
add_filter('page_template', 'banda_snippet_page_template');

function banda_snippet_page_template($page_template) {

    /* Checks for single template by post type */
    if (is_page('snippets')){
        $page_template = dirname( __FILE__ ) . '/page-snippets.php';
    }
    return $page_template;
}
