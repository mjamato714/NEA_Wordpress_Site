<?php
/**
 * The template used for displaying team content in page-team.php
 *
 * @package business
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <h1 class="entry-title"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php the_content(); ?>
        <?php edit_post_link( __( 'Edit', 'business' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
    </div><!-- .entry-content -->
</article><!-- #post-## -->
