 <?php
 
 	// Loop Page
	$nxr_options = get_option( 'redux_options' );
	$detect = new Mobile_Detect;

	// Get metaboxes values from database
	$nxr_page_bgcolor			=	get_post_meta( get_the_ID(), '_nxr_page_bgcolor', true );
	$nxr_page_top_padding		=	get_post_meta( get_the_ID(), '_nxr_page_top_padding', true );
	$nxr_page_btm_padding		=	get_post_meta( get_the_ID(), '_nxr_page_btm_padding', true );
	$nxr_page_color_scheme		=	get_post_meta( get_the_ID(), '_nxr_page_color_scheme', true );
	$nxr_page_height			=	get_post_meta( get_the_ID(), '_nxr_page_height', true );
	
	$page_offset			= ( isset($nxr_options['page_top_offset']['height']) && ( !$detect->isMobile() ) ? $nxr_options['page_top_offset']['height'] : '0');
	
	
	// Does this page have a featured image to be used as row background with paralax?!
 	$src = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), array( 5600,1000 ), false, '' );

 	if( !empty($src[0]) ) {
		$parallaxImageUrl =	" background-image:url('".$src[0]."'); ";
		$parallaxClass		=	' parallax ';
		$backgroundColor	=	'';
	} elseif( !empty($nxr_page_bgcolor) ) {
		$parallaxImageUrl =	'';
		$parallaxClass		=	' ';
		$backgroundColor	=	' background-color:'.$nxr_page_bgcolor.'!important; ';
	}else {
		$parallaxImageUrl =	'';
		$parallaxClass		=	'';
		$backgroundColor	=	'';
	}
 ?>
<div id="<?php echo esc_html($post->post_name);?>"></div>
 <div class="pagesection row <?php echo esc_attr($parallaxClass);?> <?php echo esc_attr($nxr_page_color_scheme);?>"  style=" <?php echo esc_attr($parallaxImageUrl);?> <?php echo esc_attr($backgroundColor);?> <?php echo ( !empty($nxr_page_height) ? ' height:'.esc_attr($nxr_page_height).'px!important; ' : '');?> <?php echo ( !empty($nxr_page_top_padding) ? ' padding-top:'.esc_attr($nxr_page_top_padding).'px!important;' : '' );?> <?php echo ( !empty($nxr_page_btm_padding) ? ' padding-bottom:'.esc_attr($nxr_page_btm_padding).'px!important;' : '' );?> ">
  <div class="col-md-12" <?php echo ( isset($page_offset) && $page_offset	!= 0 && $nxr_options['header_floating'] == '6' ? 'style="margin-top:'.$page_offset	.';"' : '');?> >
    <div class="container">
      <div class="slideContent gu12">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</div>