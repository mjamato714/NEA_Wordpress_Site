<?php
/**
 * The template used for displaying portfolio content in single.php
 *
 * @package business
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header full-width">
        <h1 class="entry-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->

    <div class="column two-thirds">
        <div class="entry-content">
            <?php echo apply_filters( 'the_content', preg_replace( '/\[gallery [^\]]+\]/', '',  get_the_content() ) ); ?>
        </div><!-- .entry-content -->
        <?php edit_post_link( __( 'Edit', 'business' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
    </div>

    <aside class="column one-third end entry-meta">
        <h2 class="entry-subtitle"><?php _e( 'Project Details', 'business' ); ?></h2>
        <ul>
            <?php
            $client = get_post_meta( $post->ID, '_business_portfolio_client', true );
            if ( $client ) : ?>
                <li class="client"><em><?php _e( 'Client','business' ); ?>:</em> <?php echo $client; ?></li>
            <?php endif; ?>

            <?php
            $year = get_post_meta( $post->ID, '_business_portfolio_year', true );
            if ( $year ) : ?>
                <li class="year"><em><?php _e( 'Year', 'business' ); ?>:</em> <?php echo $year; ?>
            <?php endif; ?>

            <?php $categories_list = get_the_category_list( __( ', ', 'business' ) );
            if ( $categories_list && business_categorized_blog() ) : ?>
                <li class="categories"><em><?php _e( 'Categories','business' ); ?>:</em> <?php echo $categories_list; ?></li>
            <?php endif; ?>

            <?php
            $tech = get_post_meta( $post->ID, '_business_portfolio_technology', true );
            if ( $tech ) : ?>
                <li class="technology"><em><?php _e( 'Technology', 'business' ); ?>:</em> <?php echo $tech; ?>
            <?php endif; ?>

            <?php
            $url = get_post_meta( $post->ID, '_business_portfolio_url', true );
            if ( $url ) : ?>
                <li class="url"><em><?php _e( 'URl', 'business' ); ?>:</em> <?php echo $url; ?>
            <?php endif; ?>
        </ul>
    </aside>

</article><!-- #post-## -->
