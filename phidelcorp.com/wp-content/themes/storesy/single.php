<?php
/**
 * The Template for displaying all single posts.
 *
 * @package commercegurus
 */
global $cg_options;
$cg_blog_sidebar = '';
if ( isset( $cg_options['cg_blog_sidebar'] ) ) {
	$cg_blog_sidebar = $cg_options['cg_blog_sidebar'];
}

get_header();
?>

<div class="container">
    <div class="content">
        <div class="row">
			<?php if ( ( $cg_blog_sidebar == 'default' ) || ( $cg_blog_sidebar == '' ) ) { ?>
				<div class="col-lg-8 col-md-8 col-md-push-4 col-lg-push-4">
					<div id="primary" class="content-area">
						<main id="main" class="site-main" role="main">
							<?php cg_get_page_title(); ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'content', 'single' ); ?>
								<?php cg_content_nav( 'nav-below' ); ?>

								<?php echo cg_get_author_box(); ?>

								<?php
								// If comments are open or we have at least one comment, load up the comment template
								if ( comments_open() || '0' != get_comments_number() )
									comments_template();
								?>
							<?php endwhile; // end of the loop.  ?>
						</main><!-- #main -->
					</div><!-- #primary -->
				</div>
				<div class="col-lg-4 col-md-4 col-md-pull-8 col-lg-pull-8 blog-left-sidebar">
					<?php get_sidebar(); ?>
				</div>
			<?php } else if ( $cg_blog_sidebar == 'right' ) { ?>
				<div class="col-lg-8 col-md-8">
					<div id="primary" class="content-area">
						<main id="main" class="site-main" role="main">
							<?php cg_get_page_title(); ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'content', 'single' ); ?>
								<?php cg_content_nav( 'nav-below' ); ?>

								<?php echo cg_get_author_box(); ?>

								<?php
								// If comments are open or we have at least one comment, load up the comment template
								if ( comments_open() || '0' != get_comments_number() )
									comments_template();
								?>
							<?php endwhile; // end of the loop.  ?>
						</main><!-- #main -->
					</div><!-- #primary -->
				</div>
				<div class="col-lg-4 col-md-4 blog-right-sidebar">
					<?php get_sidebar(); ?>
				</div>
			<?php } else if ( $cg_blog_sidebar == 'none' ) { ?>
				<div class="col-lg-12 col-md-12">
					<div id="primary" class="content-area">
						<main id="main" class="site-main" role="main">
							<?php cg_get_page_title(); ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php get_template_part( 'content', 'single' ); ?>
								<?php cg_content_nav( 'nav-below' ); ?>
								<?php echo cg_get_author_box(); ?>

								<?php
								// If comments are open or we have at least one comment, load up the comment template
								if ( comments_open() || '0' != get_comments_number() )
									comments_template();
								?>
							<?php endwhile; // end of the loop.  ?>
						</main><!-- #main -->
					</div><!-- #primary -->
				</div>
			<?php } ?>
        </div><!--/row -->
    </div><!--/content -->
</div><!--/container -->

<?php get_footer(); ?>