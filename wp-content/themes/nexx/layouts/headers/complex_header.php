
<!-- complex header -->

<?php
 $nxr_options = get_option( 'redux_options' );
?>

<div id="nxr_top_navbar_container" class="nxr_complex_header nxr_navbar <?php echo ( !is_front_page() ? '' : ( $nxr_options['header_floating'] == 2 ? 'hidden' : '') ); ?>">
	<?php echo ( isset($nxr_options['menu_bar_width']) && $nxr_options['menu_bar_width'] == 'menu_contained' ? ' <div class="container"> ' : '');?>
    
    <div class="nxr_identity">
    	<a href="<?php echo esc_url( home_url( '/' ) );?>" title="<?php echo get_bloginfo('name');?>"><?php echo ( !empty($nxr_options['logo']['url']) 
		? '<img src="'.$nxr_options['logo']['url'].'" width="'.$nxr_options['logo']['width'].'" height="'.$nxr_options['logo']['height'].'" alt="'.get_bloginfo('name').'" class="logo" />' 
		: '<img src="'.esc_url( get_template_directory_uri() ).'/nexarthemes/images/logo.png"  alt="'.get_bloginfo('name').'" class="logo" />' 
		);?></a>
    </div>
    
    <div id="nxr_top_navbar_extras" class="">
    	<?php if( isset($nxr_options['enable_full_screen_search']) && $nxr_options['enable_full_screen_search'] == '1') : ?>
    	<a class="fssearch mobileFsSearch" href="#"><i class="icon fa fa-search"></i></a>
        <?php endif;?>
        <?php 
			/*
			* Display OR Hide the minicart, depending on woocommerce support enabled or not in Theme Options
			*/
			if( class_exists( 'WooCommerce' ) && !empty($nxr_options['woo_support']) && $nxr_options['woo_support'] == 1 ) : 
			global $woocommerce; 
		?>
        <a class="nxr_minicart" href="<?php global $woocommerce; echo esc_url($woocommerce->cart->get_cart_url()); ?>"><i class="icon sage-cart-icon"></i></a>
        <?php
			   endif;
		  ?> 
        <a class="cd-primary-nav-trigger" href="#0"><i class="icon fa fa-bars"></i></a>  
    </div>
    
	<?php
        $defaults = array(
            'theme_location'  => 'header-menu',
            'menu'            => 'header-menu',
            'container'       => 'div',
            'container_class' => 'main_navbar_container',
            'container_id'    => 'main_navbar_container',
            'menu_class'      => 'main_navbar',
            'menu_id'         => '',
            'echo'            => true,
            'fallback_cb'     => '', //nexx_menu_fallback OR 'nxr_navwalker::fallback'
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul id="main_navbar" class="%2$s">%3$s</ul>',
            'depth'           => 4,
            'walker'          => new nxr_navwalker()
        );
        wp_nav_menu( $defaults );
		
       	$mobile = array(
            'theme_location'  => 'header-menu',
            'menu'            => 'header-menu',
            'container'       => 'nav',
            'container_class' => '',
            'container_id'    => '',
            'menu_class'      => 'cd-primary-nav',
            'menu_id'         => '',
            'echo'            => true,
            'fallback_cb'     => '',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul id="mainNavUl" class="%2$s"> %3$s</ul>',
            'depth'           => 4,
            'walker'          => new nxr_mobile_navwalker()
        );
		wp_nav_menu( $mobile );
    ?>
    
    <?php echo ( isset($nxr_options['menu_bar_width']) && $nxr_options['menu_bar_width'] == 'menu_contained' ? ' </div> <!--.container--> ' : '');?>
</div> <!-- #nxr_top_navbar_container -->


<!-- Fixed menu -->
<div class="fixed_menu " id="nxr_fixed_menu">
    <div class="fixed_menu_top_bar">
        <div class="container">
            <div class="fixed_menu_top_bar_left_side"><?php echo ( isset($nxr_options['top_bar_left_column']) && !empty($nxr_options['top_bar_left_column']) ? $nxr_options['top_bar_left_column'] : '');?></div>
            <div class="fixed_menu_top_bar_right_side">
                <?php
                    if(isset($nxr_options['opt-social-profiles'])) {
                        $icon_size = ( isset($nxr_options['top_bar_social_icon_size']['height']) && !empty($nxr_options['top_bar_social_icon_size']['height']) ? $nxr_options['top_bar_social_icon_size']['height'] : '16px');
                        foreach ($nxr_options['opt-social-profiles'] as $idx => $arr) {
                            if ($arr['enabled']) {
                                $id     = $arr['id'];
                                $url    = $arr['url'];
                                $color  = $arr['color'];
                            
                                echo ' <a href="' . $url . '" target="_blank"><i class="icon fa ' . $arr['icon'] . '" style="font-size:'.$icon_size.'; line-height:'.$icon_size.';"></i></a> ';
                            }
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    
    <div class="fixed_menu_middle_bar">
        <div class="container">
             <div class="nxr_identity fixed_menu_logo">
                <a href="<?php echo esc_url( home_url( '/' ) );?>" title="<?php echo get_bloginfo('name');?>"><?php echo ( !empty($nxr_options['logo']['url']) 
                ? '<img src="'.$nxr_options['logo']['url'].'" width="'.$nxr_options['logo']['width'].'" height="'.$nxr_options['logo']['height'].'" alt="'.get_bloginfo('name').'" class="logo" />' 
                : '<img src="'.esc_url( get_template_directory_uri() ).'/nexarthemes/images/logo.png"  alt="'.get_bloginfo('name').'" class="logo" />' 
                );?></a>
            </div>
            
         <div class="fixed_menu_middle_bar_right_side"><span class="helper"></span><?php echo ( isset($nxr_options['middle_bar_third_column']) && !empty($nxr_options['middle_bar_third_column']) ? $nxr_options['middle_bar_third_column'] : '');?></div>
         <div class="fixed_menu_middle_bar_middle_side"><span class="helper"></span><?php echo ( isset($nxr_options['middle_bar_second_column']) && !empty($nxr_options['middle_bar_second_column']) ? $nxr_options['middle_bar_second_column'] : '');?></div>
         <div class="fixed_menu_middle_bar_left_side"><span class="helper"></span><?php echo ( isset($nxr_options['middle_bar_first_column']) && !empty($nxr_options['middle_bar_first_column']) ? $nxr_options['middle_bar_first_column'] : '');?></div>                 
       </div>
    </div>
    
    <div class="container">
        <div class="fixed_menu_bottom_bar">
            <?php
                $defaults = array(
                    'theme_location'  => 'header-menu',
                    'menu'            => 'header-menu',
                    'container'       => 'div',
                    'container_class' => 'fixed_navbar_container',
                    'container_id'    => 'fixed_navbar_container',
                    'menu_class'      => 'fixed_navbar',
                    'menu_id'         => '',
                    'echo'            => true,
                    'fallback_cb'     => '', //nexx_menu_fallback OR 'nxr_navwalker::fallback'
                    'before'          => '',
                    'after'           => '',
                    'link_before'     => '',
                    'link_after'      => '',
                    'items_wrap'      => '<ul id="fixed_navbar" class="%2$s">%3$s</ul>',
                    'depth'           => 4,
                    'walker'          => new nxr_navwalker()
                );
                wp_nav_menu( $defaults );
            ?>
            
            <div class="btm_bar_right_side">
                <?php 
/*
* Display OR Hide the minicart, depending on woocommerce support enabled or not in Theme Options
*/
    if( class_exists( 'WooCommerce' ) && !empty($nxr_options['woo_support']) && $nxr_options['woo_support'] == 1 ) :
?>
<!-- woocommerce minicart -->
<div class="nxr_woo_minicart sage-cart-icon <?php echo esc_attr($hideonmobile);?>"><span class="helper"></span>
<div class="woo_bubble"><a class="nxr_woo_minicart_content" href="<?php global $woocommerce; echo esc_url($woocommerce->cart->get_cart_url()); ?>" title="<?php esc_html_e('View your shopping cart', 'nexx'); ?>"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'nexx'), $woocommerce->cart->cart_contents_count);?></a><?php echo ( class_exists('NXR_QCV') ? do_shortcode( '[nxr_quick_cart]' ) : '' );?></div>
</div>
<!-- end woocommerce minicart -->
<?php
   endif;
?>
            </div>
            
            
        </div>
    </div>
</div>
<!-- / Fixed menu -->