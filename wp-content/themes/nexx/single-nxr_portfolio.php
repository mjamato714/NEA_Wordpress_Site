<?php
/**
 * Nexx Theme: Blog page, single post display
 * @package WordPress
 * @subpackage Nexx Theme
 * @since 1.0
 */

	get_header();

	$nxr_options = get_option( 'redux_options' );
	
	// Get metaboxes values from database
	$nxr_page_bgcolor			=	get_post_meta( get_the_ID(), '_nxr_page_bgcolor', true );
	$nxr_page_top_padding		=	get_post_meta( get_the_ID(), '_nxr_page_top_padding', true );
	$nxr_page_btm_padding		=	get_post_meta( get_the_ID(), '_nxr_page_btm_padding', true );
	$nxr_page_color_scheme		=	get_post_meta( get_the_ID(), '_nxr_page_color_scheme', true );
	$nxr_page_height			=	get_post_meta( get_the_ID(), '_nxr_page_height', true );
	$disable_page_title			=	get_post_meta( get_the_ID(), '_nxr_page_title', true );
	$nxr_page_title_color		=	get_post_meta( get_the_ID(), '_nxr_page_title_color', true );

	$page_title_color			=	( !empty($nxr_page_title_color) ? ' style="color: ' . esc_attr($nxr_page_title_color) . '; "' : ( isset($nxr_options['page_title_h1']['color']) && !empty($nxr_options['page_title_h1']['color']) ? '' : ' style="color: #000; "' ) );
	
	// Does this page have a featured image to be used as row background with paralax?!
 	$src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), array( 5600,1000 ), false, '' );

 	if( !empty($src[0]) ) {
		$parallaxImageUrl 	=	" background-image:url('" . esc_url($src[0]) . "'); ";
		$backgroundColor	=	'';
	} elseif( !empty($nxr_page_bgcolor) ) {
		$parallaxImageUrl 	=	'';
		$backgroundColor	=	' background-color:' . esc_attr($nxr_page_bgcolor) . '!important; ';
	} else {
		$parallaxImageUrl 	=	'';
		$backgroundColor	=	' ';
	}
	
	$page_title_top_padding = ( isset($nxr_options['page_title_padding']['padding-top']) ? esc_attr($nxr_options['page_title_padding']['padding-top']) : '0');
	$page_title_btm_padding = ( isset($nxr_options['page_title_padding']['padding-bottom']) ? esc_attr($nxr_options['page_title_padding']['padding-bottom']) : '0');
	$page_title_lft_padding = ( isset($nxr_options['page_title_padding']['padding-left']) ? esc_attr($nxr_options['page_title_padding']['padding-left']) : '0');
	$page_title_rgt_padding = ( isset($nxr_options['page_title_padding']['padding-right']) ? esc_attr($nxr_options['page_title_padding']['padding-right']) : '0');
	$page_offset			= ( isset($nxr_options['page_top_offset']['height']) ? esc_attr($nxr_options['page_top_offset']['height']) : '0');
	
	$nxr_page_title			=	get_the_title();
	
 ?>

<div id="<?php echo esc_html($post->post_name);?>" class="row standAlonePage <?php echo esc_attr($nxr_page_color_scheme);?>" style=" <?php echo esc_attr($backgroundColor);?> <?php echo ( isset($page_offset) && $page_offset	!= 0 ? ' margin-top:'.$page_offset	.';' : '');?>">

		  <?php if( empty($disable_page_title) ): ?>
            <div class="page_title_container" style=" <?php echo esc_attr($parallaxImageUrl);?> padding: <?php echo esc_attr($page_title_top_padding);?> <?php echo esc_attr($page_title_rgt_padding);?> <?php echo esc_attr($page_title_btm_padding);?> <?php echo esc_attr($page_title_lft_padding);?>; ">
                <div class="container">
                    <h1 class="" <?php echo esc_attr($page_title_color);?> ><?php the_title(); ?></h1>
                </div>
            </div>
          <?php endif;?>
      
  <div class="container" style=" <?php echo ( !empty($nxr_page_top_padding) ? ' padding-top:'.esc_attr($nxr_page_top_padding).'px!important;' : '' ); echo ( !empty($nxr_page_btm_padding) ? ' padding-bottom:'.esc_attr($nxr_page_btm_padding).'px!important;' : '' );?> "> 
    <!-- posts -->
    <div class="vc_col-sm-12">
  
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <div <?php post_class('post'); ?>>

        <!-- Display the Post's content in a div box. -->
        <div class="portfolio_entry">
          <?php the_content(); ?>
        </div>

        <div class="clear"></div>

        
      </div>
      <!-- closes the first div box --> 
      
      <?php endwhile; else: ?>
      <p>
        <?php esc_html_e('Sorry, no posts matched your criteria.', 'nexx'); ?>
      </p>
      <?php endif; ?>
    </div>
    <!-- / posts --> 
    

  </div>
</div>
<?php 
 	get_footer();
 ?>