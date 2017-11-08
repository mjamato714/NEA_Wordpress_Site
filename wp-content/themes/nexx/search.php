<?php
/**
 * Nexx Theme: Blog page, search results page
 * @package WordPress
 * @subpackage Nexx Theme
 * @since 1.0
 */

	get_header();

 	$nxr_options = get_option( 'redux_options' );
 ?>


<div class="row blog blogPosts <?php echo (isset($nxr_options['blog_color_scheme']) ? esc_attr($nxr_options['blog_color_scheme']) : '');?>">
  <div class="container"> 
    <!-- posts -->
    <div class="vc_col-md-9 vc_col-sm-12 vc_col-xs-12">
      <h1 class="titleSep marginBottom10">
        <?php esc_html_e('You\'ve searched for: ', 'nexx'); ?>
        <?php echo get_search_query(); ?>
        <?php esc_html( get_search_query() ); ?>
      </h1>
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <div class="post">
        <?php 
				if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				  the_post_thumbnail('full', array('class' => 'img-responsive'));
				} 
			?>
        <!-- Display the Title as a link to the Post's permalink. -->
        <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php esc_html_e('Permanent Link to', 'nexx');?> <?php the_title_attribute(); ?>">
          <?php the_title(); ?>
          </a></h3>
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
      
      <?php else: ?>
      <p>
        <?php esc_html_e('Sorry, no posts matched your criteria.', 'nexx'); ?>
      </p>
      
      <h3 class="marginBottom10 marginTop30">
        <?php esc_html_e('Some recent posts you might be interested in: ', 'nexx'); ?>
      </h3>
      
      <?php $args = array(
			'type'            => 'postbypost',
			'limit'           => '10',
			'format'          => 'custom', 
			'before'          => '<p>',
			'after'           => '</p>',
			'show_post_count' => false,
			'echo'            => 1,
			'order'           => 'DESC'
		);
		wp_get_archives( $args ); 		
	?>
      
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