<?php
/**
 * Define the Tabs appearing on the Theme Options page
 * Tabs contains sections
 * Options are assigned to both Tabs and Sections
 * See README.md for a full list of option types
 */

$general_settings_tab = array(
    "name" => "general_tab",
    "title" => __( "General", "business" ),
    "sections" => array(
        "general_section_1" => array(
            "name" => "general_section_1",
            "title" => __( "General", "business" ),
            "description" => ""
        )
    )
);

gpp_register_theme_option_tab( $general_settings_tab );

$colors_tab = array(
    "name" => "colors_tab",
    "title" => __( "Colors", "business" ),
    "sections" => array(
        "colors_section_1" => array(
            "name" => "colors_section_1",
            "title" => __( "Colors", "business" ),
            "description" => ""
        )
    )
);

gpp_register_theme_option_tab( $colors_tab );

$slideshow_tab = array(
    "name" => "slideshow_tab",
    "title" => __( "Slideshow", "business" ),
    "sections" => array(
       "slideshow_section_1" => array(
                "name" => "slideshow_section_1",
                "title" => __( "Slideshow", "business" ),
                "description" => ""
            )
    )
);

gpp_register_theme_option_tab( $slideshow_tab );

// Default order of the sections in the particular tab
$block_order = explode( ',', '1,2,3,4,5,6' );
$block_array = array(

    1 => array(
        'order' => '1',
        'title' => __( 'Callout','business' ),
        'icon' => 'text'
        ),
    2 => array(
        'order' => '2',
        'title' => __( 'Featured','business' ),
        'icon' => 'gridh'
        ),
    3 => array(
        'order' => '3',
        'title' => __( 'Staggered','business' ),
        'icon' => 'staggered'
        ),
    4 => array(
        'order' => '4',
        'title' => __( 'Portfolio','business' ),
        'icon' => 'slides'
        ),
    5 => array(
        'order' => '5',
        'title' => __( 'Team','business' ),
        'icon' => 'gridh'
        ),
    6 => array(
        'order' => '6',
        'title' => __( 'Clients','business' ),
        'icon' => 'gridh'
        )
    );

// Get the order from the database
$theme_options = get_option( gpp_get_current_theme_id() . "_options" );
if ( ! empty( $theme_options['section_order'] ) ) {
    $block_order =  explode( ",", $theme_options['section_order'] );
}

/**
 * Home page tab
 */
 $section_array = array(
            "homepage_section_0" => array(
                "name" => "homepage_section_0",
                "title" => __( "Sortable Sections", "gpp" ),
                "description" => ""
            )
        );

// Arrange the sections according to saved order
foreach ( $block_order as $value ) {
    $section_array[ "homepage_section_" . ( $value ) ] = array(
        "name" => "homepage_section_" . ( $block_array[$value]['order'] ),
        "title" => $block_array[$value]['title'],
        "description" => "",
        "icon" => $block_array[$value]['icon']
    );
}


$homepage_tab = array(
    "name" => "homepage_tab",
    "title" => __( "Homepage", "business" ),
    "sections" => $section_array
);

gpp_register_theme_option_tab( $homepage_tab );

/**
 * The following example shows you how to register theme options and assign them to tabs and sections:
 */
$options = array(

    'logo' => array(
        "tab" => "general_tab",
        "name" => "logo",
        "title" => __( "Logo", "gpp" ),
        "description" => __( "Use a transparent png or jpg image", "gpp" ),
        "section" => "general_section_1",
        "since" => "1.0",
        "id" => "general_section_1",
        "type" => "image",
        "default" => ""
    ),

    'favicon' => array(
        "tab" => "general_tab",
        "name" => "favicon",
        "title" => __( "Favicon", "business" ),
        "description" => __( "Use a transparent png or ico image", "business" ),
        "section" => "general_section_1",
        "since" => "1.0",
        "id" => "general_section_1",
        "type" => "image",
        "default" => ""
    ),
    'font' => array(
        "tab" => "general_tab",
        "name" => "font",
        "title" => __( "Headline Font", "business" ),
        "description" => __( '<a href="' . get_option( 'siteurl') . '/wp-admin/admin-ajax.php?action=fonts&font=header&height=600&width=640" class="thickbox">Preview and choose a font</a>', "business" ),
        "section" => "general_section_1",
        "since" => "1.0",
        "id" => "general_section_1",
        "type" => "select",
        "default" => "Montserrat",
        "valid_options" => gpp_font_array()
    ),
    'font_alt' => array(
        "tab" => "general_tab",
        "name" => "font_alt",
        "title" => __( "Body Font", "business" ),
        "description" => __( '<a href="' . get_option( 'siteurl') . '/wp-admin/admin-ajax.php?action=fonts&font=body&height=600&width=640" class="thickbox">Preview and choose a font</a>', "business" ),
        "section" => "general_section_1",
        "since" => "1.0",
        "id" => "general_section_1",
        "type" => "select",
        "default" => "PT Serif Caption:400,400italic",
        "valid_options" => gpp_font_array()
    ),
    'blog_category' => array(
        "tab" => "general_tab",
        "name" => "blog_category",
        "title" => __( "Blog Category", "business" ),
        "description" => __( 'Select your blog category', "business" ),
        "section" => "general_section_1",
        "since" => "1.0",
        "id" => "general_section_1",
        "type" => "select",
        "default" => "",
        "valid_options" => gpp_get_taxonomy_list()
    ),
    "css" => array(
        "tab" => "colors_tab",
        "name" => "css",
        "title" => __( "Custom CSS", "business" ),
        "description" => __( "Add some custom CSS to your theme.", "business" ),
        "section" => "colors_section_1",
        "since" => "1.0",
        "id" => "colors_section_1",
        "type" => "textarea",
        "sanitize" => "html",
        "default" => ""
    ),
    "color" => array(
        "tab" => "colors_tab",
        "name" => "color",
        "title" => "Color",
        "description" => __( "Select a color palette", "business" ),
        "section" => "colors_section_1",
        "since" => "1.0",
        "id" => "colors_section_1",
        "type" => "select",
        "default" => "minimal",
        "valid_options" => array(
            "minimal" => array(
                "name" => "minimal",
                "title" => __( "Minimal", "business" )
            ),
            "fresh" => array(
                "name" => "fresh",
                "title" => __( "Fresh", "business" )
            )
        )
    ),
    "homepage_slideshow" => array(
        "tab" => "slideshow_tab",
        "name" => "homepage_slideshow",
        "title" => __( "Images", "business" ),
        "description" => __( "Select or create a gallery of images to use in the homepage slide show.", "business" ),
        "section" => "slideshow_section_1",
        "since" => "1.0",
        "id" => "slideshow_section_1",
        "type" => "gallery",
        "default" => ""
    ),
    'section_order' => array(
        "tab" => "homepage_tab",
        "name" => "section_order",
        "title" => "",
        "description" => __( 'Stores the order of the sections', "business" ),
        "section" => "homepage_section_0",
        "since" => "1.0",
        "id" => "homepage_section_0",
        "type" => "hidden",
        "default" => "1,2,3,4,5,6",
        "sanitize" => "html"
    ),
    'callout_text' => array(
        "tab" => "homepage_tab",
        "name" => "callout_text",
        "title" => __( "Callout Text", "business" ),
        "description" => __( 'Add text for your homepage callout', "business" ),
        "section" => "homepage_section_1",
        "since" => "1.0",
        "id" => "homepage_section_1",
        "type" => "textarea",
        "default" => "",
        "sanitize" => "html"
    ),
    'callout_link_text' => array(
        "tab" => "homepage_tab",
        "name" => "callout_link_text",
        "title" => __( "Button Text", "business" ),
        "description" => __( 'Add an optional button text for the callout', "business" ),
        "section" => "homepage_section_1",
        "since" => "1.0",
        "id" => "homepage_section_1",
        "type" => "text",
        "default" => "",
        "sanitize" => "html"
    ),
    'callout_link' => array(
        "tab" => "homepage_tab",
        "name" => "callout_link",
        "title" => __( "Button Link", "business" ),
        "description" => __( 'Add an optional button link for the callout', "business" ),
        "section" => "homepage_section_1",
        "since" => "1.0",
        "id" => "homepage_section_1",
        "type" => "text",
        "default" => "",
        "sanitize" => "html"
    ),
    'feature_category' => array(
        "tab" => "homepage_tab",
        "name" => "feature_category",
        "title" => __( "Featured", "business" ),
        "description" => __( 'Select your feature category', "business" ),
        "section" => "homepage_section_2",
        "since" => "1.0",
        "id" => "homepage_section_2",
        "type" => "select",
        "default" => "",
        "valid_options" => gpp_get_taxonomy_list( 'category', true )
    ),
    'list_category' => array(
        "tab" => "homepage_tab",
        "name" => "list_category",
        "title" => __( "Staggered List", "business" ),
        "description" => __( 'Select your list category', "business" ),
        "section" => "homepage_section_3",
        "since" => "1.0",
        "id" => "homepage_section_3",
        "type" => "select",
        "default" => "",
        "valid_options" => gpp_get_taxonomy_list( 'category', true )
    ),

    'team_category' => array(
        "tab" => "homepage_tab",
        "name" => "team_category",
        "title" => __( "Team", "business" ),
        "description" => __( 'Select your team category', "business" ),
        "section" => "homepage_section_5",
        "since" => "1.0",
        "id" => "homepage_section_5",
        "type" => "select",
        "default" => "",
        "valid_options" => gpp_get_taxonomy_list( 'category', true )
    ),
    'clients_category' => array(
        "tab" => "homepage_tab",
        "name" => "clients_category",
        "title" => __( "Clients", "business" ),
        "description" => __( 'Select your client category', "business" ),
        "section" => "homepage_section_6",
        "since" => "1.0",
        "id" => "homepage_section_6",
        "type" => "select",
        "default" => "",
        "valid_options" => gpp_get_taxonomy_list( 'category', true )
    )
);

gpp_register_theme_options( $options );
