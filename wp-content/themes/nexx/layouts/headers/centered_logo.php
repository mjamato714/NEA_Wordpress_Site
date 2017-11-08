<?php
 $nxr_options = get_option( 'redux_options' );
?>
 
  <nav class="navbar navbar-default">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle zIndex1000" data-toggle="collapse" data-target="#navbar-collapse-1">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
    </div>
    <a class="navbar-brand navBarBrandPosition" href="<?php echo esc_url( home_url( '/' ) );?>"><?php echo ( !empty($nxr_options['logo']['url']) 
		? '<span class="helper"></span><img src="'.$nxr_options['logo']['url'].'" width="'.$nxr_options['logo']['width'].'" height="'.$nxr_options['logo']['height'].'" alt="'.get_bloginfo('name').'" class="logo" />' 
		: '<span class="helper"></span><img src="'.esc_url( get_template_directory_uri() ).'/nexarthemes/images/logo.png"  alt="Initial Logo" class="logo" />' 
		);?>
    </a>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-collapse-1">
     
      <?php
				// LEFT MENU
				$defaults = array(
					'theme_location'  => 'left-menu',
					'menu'            => 'header-menu',
					'container'       => false,
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'nav navbar-nav navbar-left',
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => '', //nexx_menu_fallback OR 'nxr_navwalker::fallback'
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="mainNavUlLeft" class="%2$s">%3$s</ul>',
					'depth'           => 4,
					'walker'          => new nxr_navwalker()
				);
				wp_nav_menu( $defaults );
		?>
        
	<?php 
    /*
    * Display OR Hide the minicart, depending on woocommerce support enabled or not in Theme Options
    */
    if( class_exists( 'WooCommerce' ) && !empty($nxr_options['woo_support']) && $nxr_options['woo_support'] == 1 ) :
    ?>
    <!-- woocommerce minicart -->
    <div class="nxr_woo_minicart sage-cart-icon">
    <div class="woo_bubble"><a class="nxr_woo_minicart_content" href="<?php global $woocommerce; echo esc_url($woocommerce->cart->get_cart_url()); ?>" title="<?php esc_html_e('View your shopping cart', 'nexx'); ?>"><?php echo sprintf(_n('%d', '%d', $woocommerce->cart->cart_contents_count, 'nexx'), $woocommerce->cart->cart_contents_count);?></a><?php echo ( class_exists('NXR_QCV') ? do_shortcode( '[nxr_quick_cart]' ) : '' );?></div>
    </div>
    <!-- end woocommerce minicart -->
    <?php
    endif;
    ?>

      <?php
				// RIGHT MENU
				$defaults = array(
					'theme_location'  => 'right-menu',
					'menu'            => 'header-menu',
					'container'       => false,
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'nav navbar-nav navbar-right',
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => '', //nexx_menu_fallback OR 'nxr_navwalker::fallback'
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="mainNavUlRight" class="%2$s">%3$s</ul>',
					'depth'           => 4,
					'walker'          => new nxr_navwalker()
				);
				wp_nav_menu( $defaults );
		?>
        
        
    </div><!-- /.navbar-collapse -->
</nav>


