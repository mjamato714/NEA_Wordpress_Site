<?php

/**
 * Register new custom taxonomies
 * @package Business
 * @since Business 1.0
 */

/*-----------------------------------------------------------------------------------*/
/* Register taxonomy for new post type */
/*-----------------------------------------------------------------------------------*/

add_action( 'init', 'business_ps_portfolio_taxonomy', 0 );

function business_ps_portfolio_taxonomy() {
    // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'Categories', 'taxonomy general name', 'business' ),
    'singular_name' => _x( 'Category', 'taxonomy singular name', 'business' ),
    'search_items' =>  __( 'Search Categories', 'business' ),
    'all_items' => __( 'All Categories', 'business' ),
    'parent_item' => __( 'Parent Category', 'business' ),
    'parent_item_colon' => __( 'Parent Category:', 'business' ),
    'edit_item' => __( 'Edit Category', 'business' ),
    'update_item' => __( 'Update Category', 'business' ),
    'add_new_item' => __( 'Add New Category', 'business' ),
    'new_item_name' => __( 'New Category Name', 'business' ),
    'menu_name' => __( 'Categories', 'business' )
  );
    register_taxonomy( 'pcategory','portfolio',array(
                'hierarchical' => true,
                'labels' => $labels,
                'query_var' => true,
                'rewrite' => array( 'slug' => 'pcategory' ),
                'show_admin_column' => true
    ) );
}

add_action( 'init', 'business_ps_portfolio_tags', 1 );

function business_ps_portfolio_tags() {
    register_taxonomy( 'ptag', 'portfolio', array(
                'hierarchical' => false,
                'update_count_callback' => '_update_post_term_count',
                'label' => __( 'Tags', 'business' ),
                'query_var' => true,
                'rewrite' => array( 'slug' => 'ptags' ),
                'show_admin_column' => true
    )) ;
}

/**
 * Flush your rewrite rules for custom post type and taxonomies added in theme
 * @package Business
 * @since Business 1.0
 */
function business_flush_rewrite_rules() {
    global $pagenow, $wp_rewrite;

    if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) )
        $wp_rewrite->flush_rules();
}
add_action( 'load-themes.php', 'business_flush_rewrite_rules' );