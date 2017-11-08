 <?php
/**
 * Nexx Theme: Archive page
 * @package WordPress
 * @subpackage Nexx Theme
 * @since 1.0
 */

	get_header();
 
 	$nxr_options = get_option( 'redux_options' );
 ?>

<div class="row blog blogPosts <?php echo (isset($nxr_options['blog_color_scheme']) ? esc_attr( $nxr_options['blog_color_scheme'] ) : '');?>">
  <div class="container"> 
    <!-- posts -->
    <div class="vc_col-md-9 vc_col-sm-12 vc_col-xs-12">
      <?php /* If this is a daily archive */ if ( is_day() ) { ?>
      <h1 class="titleSep"><?php esc_html_e( 'Daily Archives:', 'nexx' );?>
        <?php the_time( 'F jS, Y' ); ?>
      </h1>
      <?php /* If this is a monthly archive */ } elseif ( is_month() ) { ?>
      <h1 class="titleSep"><?php esc_html_e( 'Monthly Archives:', 'nexx' );?>
        <?php the_time( 'F, Y' ); ?>
      </h1>
      <?php /* If this is a yearly archive */ } elseif ( is_year() ) { ?>
      <h1 class="titleSep"><?php esc_html_e( 'Yearly Archives:', 'nexx' );?>
        <?php the_time( 'Y' ); ?>
      </h1>
      <?php } ?>
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <div class="post">
        <?php 
                    if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
                      the_post_thumbnail('full', array('class' => 'img-responsive'));
                    } 
                ?>
        <!-- Display the Title as a link to the Post's permalink. -->
        <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php esc_html_e('Permanent Link to', 'nexx');?> <?php the_title_attribute(); ?>">
          <?php the_title(); ?>
          </a></h1>
        <small><span class="highlight"><i class="icon blog-date"></i>
        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php esc_html_e('Permanent Link to', 'nexx');?> <?php the_title_attribute(); ?>"><?php the_time('F jS, Y') ?></a>
        </span> <span class="highlight"><i class="icon blog-user"></i><?php esc_html_e( 'Posted by', 'nexx' );?>
        <?php the_author_posts_link() ?>
        </span> <span class="highlight"><i class="icon blog-category"></i>
        <?php the_category(', '); ?>
        </span> <span class="highlight"><i class="icon blog-comments"></i>
        <?php
			$comments_number = get_comments_number();
			if ( 1 === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'nexx' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s thought on &ldquo;%2$s&rdquo;',
						'%1$s thoughts on &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'nexx'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
		?>
        </span></small> 
        <!-- Display the Post's content in a div box. -->
        <div class="entry">
          <?php if(has_excerpt()) : ?>
          <?php the_excerpt(); ?>
          <?php else : ?>
          <?php the_content(); ?>
          <?php endif;?>
        </div>
        <div class="entry-meta">
          <?php the_tags(); ?>
        </div>
      </div>
      <?php endwhile; ?>

      <?php
		$prev_link = get_previous_posts_link( esc_html__('&larr; Previous', 'nexx') );
		$next_link = get_next_posts_link( esc_html__('Next &rarr;', 'nexx') );
		if ($prev_link || $next_link) : ?>
		  <div class="navigation">
			<div class="alignleft">
			  <?php echo( !empty($prev_link) ? $prev_link : '' ); ?>
			</div>
			<div class="alignright">
			  <?php echo ( !empty($next_link) ? $next_link : ''); ?>
			</div>
		  </div>
		<?php endif;?>

      <?php else: ?>
      <p>
        <?php esc_html_e('Sorry, no posts matched your criteria.', 'nexx'); ?>
      </p>
      <?php endif; ?>
    </div>
    <!-- / posts --> 
    
    <!-- sidebar -->
    <div class="vc_col-md-3 vc_col-sm-12 vc_col-xs-12">
      <?php 
		get_sidebar();
	 ?>
    </div>
    <!-- / sidebar --> 
    <div class="clearfix"></div>
  </div>
</div>
<?php 
 	get_footer();
 ?>