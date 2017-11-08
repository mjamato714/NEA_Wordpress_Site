<?php
/**
 * The template used for displaying the "clients callout" in home.php
 *
 * @package business
 */
?>
<?php
$category_id = get_cat_ID( gpp_get_options()->clients_category );

if ( $category_id  ) : ?>
    <?php
    $args = array(
        'posts_per_page' => 7,
        'category' => $category_id
        );
    $my_posts = get_posts( $args );
    if ( ! empty( $my_posts ) ) : ?>
        <section id="clients">
            <h2 class="section-title"><?php $cat = get_category( $category_id ); echo $cat->name; ?></h2>
            <div class="container">
                <?php foreach ( $my_posts as $post ) : setup_postdata( $post ); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <?php  if ( has_post_thumbnail() ) : ?>
                            <div class="entry-image">
                                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'business' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_post_thumbnail( 'business_client' ); ?></a>
                            </div>
                        <?php endif; ?>
                    </article><!-- #post-## -->

                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>
