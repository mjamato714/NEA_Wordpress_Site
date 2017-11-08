 <?php
/**
 * Nexx Theme: Shop sidebar
 * @package WordPress
 * @subpackage Nexx Theme
 * @since 1.0
 * TO BE INCLUDED ON SHOP PAGES
 */
 ?>


<?php 
if ( is_active_sidebar( 'shop-widgets' ) ) : ?>
<div class="vc_col-md-3 vc_col-sm-12 vc_col-xs-12 floatedLeft">
	<?php dynamic_sidebar('shop-widgets'); ?>
</div>
<?php endif;?>