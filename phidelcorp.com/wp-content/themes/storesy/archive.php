<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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
<?php if ( have_posts() ) : ?>

	<?php
	if ( function_exists( 'yoast_breadcrumb' ) && (!is_front_page() ) ) {
		yoast_breadcrumb( '<div class="container breadcrumbs"><div class="row"><div class="col-lg-12 col-md-12"><p class="sub-title">', '</p></div></div></div>' );
	}
	?>

	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="cg-page-title">
					<?php
					if ( is_category() ) :
						single_cat_title();

					elseif ( is_tag() ) :
						single_tag_title();

					elseif ( is_author() ) :
						/* Queue the first post, that way we know
						 * what author we're dealing with (if that is the case).
						 */
						the_post();
						printf( __( 'Author: %s', 'storesy' ), '<span class="vcard">' . get_the_author() . '</span>' );
						/* Since we called the_post() above, we need to
						 * rewind the loop back to the beginning that way
						 * we can run the loop properly, in full.
						 */
						rewind_posts();

					elseif ( is_day() ) :
						printf( __( 'Day: %s', 'storesy' ), '<span>' . get_the_date() . '</span>' );

					elseif ( is_month() ) :
						printf( __( 'Month: %s', 'storesy' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

					elseif ( is_year() ) :
						printf( __( 'Year: %s', 'storesy' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

					elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
						esc_html_e( 'Asides', 'storesy' );

					elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
						esc_html_e( 'Images', 'storesy' );

					elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
						esc_html_e( 'Videos', 'storesy' );

					elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
						esc_html_e( 'Quotes', 'storesy' );

					elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
						esc_html_e( 'Links', 'storesy' );

					else :
						esc_html_e( 'Archives', 'storesy' );

					endif;
					?>                            
				</h1>
			</div>
		</div>
	</div>

<?php endif; ?>

<div class="container">
    <div class="content">
        <div class="row">
<?php if ( ( $cg_blog_sidebar == 'default' ) || ( $cg_blog_sidebar == '' ) ) { ?>

				<div class="col-lg-8 col-md-9 col-sm-12 col-md-push-4 col-lg-push-4">
					<section id="primary" class="content-area">
						<main id="main" class="site-main" role="main">
								<?php if ( have_posts() ) : ?>
								<div>
									<?php /* Start the Loop */ ?>
									<?php while ( have_posts() ) : the_post(); ?>
										<?php
										/* Include the Post-Format-specific template for the content.
										 * If you want to override this in a child theme, then include a file
										 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
										 */
										get_template_part( 'content', get_post_format() );
										?>
									<?php endwhile; ?>
									<?php cg_content_nav( 'nav-below' ); ?>
								<?php else : ?>
									<?php get_template_part( 'no-results', 'archive' ); ?>
	<?php endif; ?>
							</div>
						</main><!-- #main -->
					</section><!-- #primary -->
				</div><!--/9 -->
				<div class="col-lg-4 col-md-4 col-sm-12 col-md-pull-8 col-lg-pull-8 blog-sidebar-left">
	<?php get_sidebar(); ?>
				</div>

<?php } else if ( $cg_blog_sidebar == 'right' ) { ?>

				<div class="col-lg-8 col-md-8 col-sm-12">
					<section id="primary" class="content-area">
						<main id="main" class="site-main" role="main">
								<?php if ( have_posts() ) : ?>
								<div>
									<?php /* Start the Loop */ ?>
									<?php while ( have_posts() ) : the_post(); ?>
										<?php
										/* Include the Post-Format-specific template for the content.
										 * If you want to override this in a child theme, then include a file
										 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
										 */
										get_template_part( 'content', get_post_format() );
										?>
									<?php endwhile; ?>
									<?php cg_content_nav( 'nav-below' ); ?>
								<?php else : ?>
									<?php get_template_part( 'no-results', 'archive' ); ?>
	<?php endif; ?>
							</div>
						</main><!-- #main -->
					</section><!-- #primary -->
				</div><!--/9 -->
				<div class="col-lg-4 col-md-4 col-sm-12 blog-sidebar-right">
	<?php get_sidebar(); ?>
				</div>

<?php } else if ( $cg_blog_sidebar == 'none' ) { ?>
				<div class="col-lg-12 col-md-12 col-sm-12">
					<section id="primary" class="content-area">
						<main id="main" class="site-main" role="main">
								<?php if ( have_posts() ) : ?>
								<div>
									<?php /* Start the Loop */ ?>
									<?php while ( have_posts() ) : the_post(); ?>
										<?php
										/* Include the Post-Format-specific template for the content.
										 * If you want to override this in a child theme, then include a file
										 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
										 */
										get_template_part( 'content', get_post_format() );
										?>
									<?php endwhile; ?>
									<?php cg_content_nav( 'nav-below' ); ?>
								<?php else : ?>
									<?php get_template_part( 'no-results', 'archive' ); ?>
	<?php endif; ?>
							</div>
						</main><!-- #main -->
					</section><!-- #primary -->
				</div><!--/12 -->
<?php } ?>
        </div><!--/row -->
    </div><!--/content -->
</div><!--/container -->

<?php get_footer(); ?>