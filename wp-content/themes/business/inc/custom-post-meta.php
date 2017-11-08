<?php

/**
 * Create the meta box section, title and assign a callback function
 */
function business_project_meta_box( $post_type ) {
    add_meta_box(
                'product_meta_box',
                __( 'Project Details','business' ),
                'business_project_meta_box_html',
                'portfolio'
            );
}
add_action( 'add_meta_boxes', 'business_project_meta_box' );

/**
 * Show our Project Details meta section
 */
function business_project_meta_box_html( $fields=null ) {
    global $post; ?>
        <table>
            <tr>
                <td><label><?php _e( 'Year','business' ); ?></label></td>
                <td><input type="text" name="_business_portfolio_year" class="regular-text" id="_business_portfolio_year" value="<?php echo esc_attr( get_post_meta( $post->ID, '_business_portfolio_year', true ) ); ?>" /></p></td>
            </tr>
            <tr>
                <td><label><?php _e( 'Client','business' ); ?></label></td>
                <td><input type="text" name="_business_portfolio_client" class="regular-text" id="_business_portfolio_client" value="<?php echo esc_attr( get_post_meta( $post->ID, '_business_portfolio_client', true ) ); ?>" /></p></td>
            </tr>
            <tr>
                <td><label><?php _e( 'Technology','business' ); ?></label></td>
                <td><input type="text" name="_business_portfolio_technology" class="regular-text" id="_business_portfolio_technology" value="<?php echo esc_attr( get_post_meta( $post->ID, '_business_portfolio_technology', true ) ); ?>" /></p></td>
            </tr>
            <tr>
                <td><label><?php _e( 'URL','business' ); ?></label></td>
                <td><input type="text" name="_business_portfolio_url" class="regular-text" id="_business_portfolio_url" value="<?php echo esc_attr( get_post_meta( $post->ID, '_business_portfolio_url', true ) ); ?>" /></p></td>
            </tr>
        </table>
    <?php
}

/**
 * Save meta fields when post is updated
 */
function business_save_portfolio_custom_meta( $post_id ) {

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
        return $post_id;
    }

    $fields = array(
        // Portfolio posts meta
        '_business_portfolio_year',
        '_business_portfolio_client',
        '_business_portfolio_technology',
        '_business_portfolio_url',

        // Team posts meta
        '_business_team_position',
        '_business_team_facebook',
        '_business_team_twitter',
        '_business_team_github',
        );

    foreach( $fields as $field ){
        if ( isset( $_POST[ $field ] ) ){
            // For URLs we esc_url them, other wise we use esc_html
            if ( $field == '_business_portfolio_url' ){
                update_post_meta( $post_id, '_business_portfolio_url', esc_url( $_POST['_business_portfolio_url'] ) );
            } else {
                update_post_meta( $post_id, $field, esc_html( $_POST[ $field ] ) );
            }
        }
    }
}
add_action( 'save_post', 'business_save_portfolio_custom_meta' );

function business_team_meta_box( $post_type ) {
    add_meta_box(
                'team_meta_box',
                __( 'Team Details','business' ),
                'business_team_meta_box_html',
                'post'
            );
}
add_action( 'add_meta_boxes', 'business_team_meta_box' );

/**
 * Show our Project Details meta section
 */
function business_team_meta_box_html( $fields=null ) {
    global $post; ?>
        <table>
            <tr>
                <td><label><?php _e( 'Position','business' ); ?></label></td>
                <td><input type="text" name="_business_team_position" class="regular-text" id="_business_team_position" value="<?php echo esc_attr( get_post_meta( $post->ID, '_business_team_position', true ) ); ?>" /></p></td>
            </tr>
            <tr>
                <td><label><?php _e( 'Facebook','business' ); ?></label></td>
                <td><input type="text" name="_business_team_facebook" class="regular-text" id="_business_team_facebook" value="<?php echo esc_attr( get_post_meta( $post->ID, '_business_team_facebook', true ) ); ?>" /></p></td>
            </tr>
            <tr>
                <td><label><?php _e( 'Twitter','business' ); ?></label></td>
                <td><input type="text" name="_business_team_twitter" class="regular-text" id="_business_team_twitter" value="<?php echo esc_attr( get_post_meta( $post->ID, '_business_team_twitter', true ) ); ?>" /></p></td>
            </tr>
            <tr>
                <td><label><?php _e( 'GitHub','business' ); ?></label></td>
                <td><input type="text" name="_business_team_github" class="regular-text" id="_business_team_github" value="<?php echo esc_attr( get_post_meta( $post->ID, '_business_team_github', true ) ); ?>" /></p></td>
            </tr>
        </table>
    <?php
}