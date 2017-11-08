<?php
/**
 * Nexx Theme footer file
 * @package WordPress
 * @subpackage Nexx Theme
 * @since 1.0
 * TO BE INCLUDED IN ALL OTHER PAGES
 */

 $nxr_options = get_option( 'redux_options' );
 $allowed_html_array = array(
    'a' => array(
        'href' => array(),
        'title' => array()
    ),
    'br' => array(),
    'em' => array(),
    'strong' => array(),
);

$nxr_megafooterID		=	esc_attr( get_post_meta( get_the_ID(), '_nxr_megafooterID', true ) );	// nxr_megafooter unique ID for this page

if( class_exists('NXR_MEGAFOOTER') && !empty($nxr_megafooterID) && is_numeric($nxr_megafooterID) ){
	// MEGA FOOTER SET TO AN EXISTING MEGAFOOTER
	$nxr_megafooter				=	get_post( $nxr_megafooterID, ARRAY_A );
	$nxr_page_color_scheme		=	get_post_meta( $nxr_megafooterID, '_nxr_page_color_scheme', true );
	wp_reset_postdata();
	
	echo '<div class="container ' . esc_attr( $nxr_page_color_scheme ) . ' nxr_megafooter">';
	echo do_shortcode( $nxr_megafooter['post_content'] );
	echo '</div>';
}
elseif( class_exists('NXR_MEGAFOOTER') && empty($nxr_megafooterID) && isset($nxr_options['nxr_megafooter_select']) && !empty($nxr_options['nxr_megafooter_select']) ){
	// MEGA FOOTER SET TO DEFAULT MEGAFOOTER
	$nxr_megafooter				=	get_post( $nxr_options['nxr_megafooter_select'], ARRAY_A );
	$nxr_page_color_scheme		=	esc_attr( get_post_meta( $nxr_options['nxr_megafooter_select'], '_nxr_page_color_scheme', true ) );
	wp_reset_postdata();
	echo '<div class="container nxr_megafooter ' . esc_attr($nxr_page_color_scheme) . '">';
	echo do_shortcode($nxr_megafooter['post_content']);
	echo '</div>';
}
elseif( class_exists('NXR_MEGAFOOTER') && $nxr_megafooterID == "minimal_footer" ){ ?>
	<div class="clearfix"></div>
      <div class="row bka_footer <?php echo esc_attr( $nxr_options['footer_color_scheme'] );?> " style=" <?php echo( !empty($nxr_options['footer-bgcolor']) ? ' background-color:' . esc_attr( $nxr_options['footer-bgcolor'] ) . ';' : '');?>">
        <div class="container">
            <div class="vc_col-md-12 centeredText">
                <?php echo ( !empty($nxr_options['footer-copyright']) ? wp_kses( $nxr_options['footer-copyright'], $allowed_html_array ) : esc_html__('Set your Copyright Text into Theme Options', 'nexx') );?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php
}
elseif( class_exists('NXR_MEGAFOOTER') && $nxr_megafooterID == "no_footer" ){
	// NO FOOTER DISPLAYED
}
else{
	?>
    <div class="clearfix"></div>
       <div class="row bka_footer <?php echo esc_attr( $nxr_options['footer_color_scheme'] );?> " style=" <?php echo( !empty($nxr_options['footer-bgcolor']) ? ' background-color:' . esc_attr( $nxr_options['footer-bgcolor'] ) . ';' : '');?>">
        <div class="container">
            <div class="vc_col-md-12 centeredText">
                <?php echo ( !empty($nxr_options['footer-copyright']) ? wp_kses( $nxr_options['footer-copyright'], $allowed_html_array ) : esc_html__('Set your Copyright Text into Theme Options', 'nexx') );?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php
}
?>

<div id="nxr_left"></div>
<div id="nxr_right"></div>
<div id="nxr_top"></div>
<div id="nxr_bottom"></div>


<?php 
	/*
	*	Custom hook
	*/
	nexx_before_footer_open(); 
?>


</div> <!--Website Boxed END-->

	<?php wp_footer();?>
    
 </body>
</html>