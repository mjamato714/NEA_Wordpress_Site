<?php
/**
 * The template for displaying search forms in business
 *
 * @package business
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label>
        <span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'business' ); ?></span>
        <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'business' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
    </label>
    <input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'business' ); ?>">
</form>
