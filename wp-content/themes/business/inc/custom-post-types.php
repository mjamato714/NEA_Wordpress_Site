<?php

/**
 * Register new custom post types
 * @package Business
 * @since Business 1.0
 */

/*-----------------------------------------------------------------------------------*/
/* Register new post type */
/*-----------------------------------------------------------------------------------*/

add_action( 'init', 'business_ps_portfolio_create_type' );

function business_ps_portfolio_create_type() {


    register_post_type( 'portfolio',
        array(
            'labels' => array(
                'name'                      => __( 'Portfolios','business' ),
                'singular_name'             => __( 'Portfolio','business' ),
                'add_new'                   => __( 'Add New', 'business' ),
                'add_new_item'              => __( 'Add Portfolio', 'business' ),
                'new_item'                  => __( 'Add Portfolio', 'business' ),
                'view_item'                 => __( 'View Portfolio', 'business' ),
                'search_items'              => __( 'Search Portfolios', 'business' ),
                'edit_item'                 => __( 'Edit Portfolio', 'business' ),
                'all_items'                 => __( 'All Portfolios', 'business' ),
                'not_found'                 => __( 'No Portfolio found', 'business' ),
                'not_found_in_trash'        => __( 'No Portfolio found in Trash', 'business' )
            ),
            'taxonomies'    => array( 'pcategory', 'ptag' ),
            'public' => true,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => array( 'slug' => 'portfolio', 'with_front' => false ),
            'query_var' => true,
            'supports' => array( 'title','revisions','thumbnail','author','editor' ),
            'menu_position' => 5,
            'menu_icon' => 'dashicons-portfolio',
            'has_archive' => true
        )
    );
}