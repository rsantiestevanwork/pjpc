<?php
/**
 * @package commercegurus
 */
global $cg_options;
$cg_blog_images		 = '';
$cg_ismedium		 = '';
$cg_hasthumb		 = '';
$cg_isdefaultblog	 = '';

if ( isset( $cg_options['cg_blog_images'] ) ) {
	$cg_blog_images = $cg_options['cg_blog_images'];

	if ( isset( $_GET['blogimages'] ) ) {
		$cg_blog_images = $_GET['blogimages'];
	}

	if ( $cg_blog_images == 'left' ) {
		$cg_ismedium = 'blog-style medium-blog medium-blog-left';
	}
	if ( $cg_blog_images == 'right' ) {
		$cg_ismedium = 'blog-style medium-blog medium-blog-right';
	} else {
		$cg_isdefaultblog = ' default-blog';
	}
} else {
	$cg_isdefaultblog = ' default-blog';
}

if ( !has_post_thumbnail() ) {
	$cg_hasthumb = ' cg-has-no-thumb';
}
?>

<div class="row animate <?php echo esc_attr( $cg_ismedium ) . esc_attr( $cg_hasthumb ) . esc_attr( $cg_isdefaultblog ); ?>">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="cg-blog-article">

			<?php
			if ( has_post_thumbnail() ) {
				if ( $cg_blog_images == 'left' ) {
					// left blog 
					?>
					<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="image">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
								<?php the_post_thumbnail(); ?>
							</a>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6">
						<header class="entry-header">

							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>   

							<?php if ( 'post' == get_post_type() ) : ?>
								<div class="blog-meta">
									<span><?php the_time( 'F j, Y' ) ?></span> <span class="comments"><?php comments_number(); ?> </span>
								</div>
							<?php endif; ?>

						</header><!-- .entry-header -->
						<!-- Displays the excerpt unless the post type is a Link or a Quote -->
						<div class="entry-content">
							<?php if ( has_post_format( 'link' ) ) : ?>
								<?php the_content(); ?>
							<?php elseif ( has_post_format( 'quote' ) ) : ?>
								<?php the_content(); ?>
							<?php else : ?>
								<?php the_excerpt( __( 'Read more', 'storesy' ) ); ?>
							<?php endif; ?>
						</div><!-- .entry-content -->

					</div>
					<?php
				} else if ( $cg_blog_images == 'right' ) {
					// right blog 
					?>
					<div class="col-lg-6 col-md-6 col-sm-6">
						<header class="entry-header">

							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>   
							<?php if ( 'post' == get_post_type() ) : ?>
								<div class="blog-meta">
									<span><?php the_time( 'F j, Y' ) ?></span> <span class="comments"><?php comments_number(); ?> </span>
								</div>
							<?php endif; ?>

						</header><!-- .entry-header -->
						<!-- Displays the excerpt unless the post type is a Link or a Quote -->
						<div class="entry-content">
							<?php if ( has_post_format( 'link' ) ) : ?>
								<?php the_content(); ?>
							<?php elseif ( has_post_format( 'quote' ) ) : ?>
								<?php the_content(); ?>
							<?php else : ?>
								<?php the_excerpt( __( 'Read more', 'storesy' ) ); ?>
							<?php endif; ?>
						</div><!-- .entry-content -->

					</div>
					<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="image">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
								<?php the_post_thumbnail(); ?>
							</a>
						</div>
					</div>
					<?php
				} else {
					// default blog with images 
					?>



					<div class="image">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
							<?php the_post_thumbnail(); ?>
						</a>  
					</div>

					<header class="entry-header">
						<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>   
						<div class="blog-meta">
							<?php cg_get_author_name(); ?>
							<span><?php the_time( 'F j, Y' ) ?></span> <span class="comments"><?php comments_number(); ?> </span>
						</div>
					</header><!-- .entry-header -->
					<?php if ( is_search() ) { // Only display Excerpts for Search   ?>
						<div class="entry-summary">
							<?php the_excerpt(); ?>
						</div><!-- .entry-summary -->
					<?php } else { ?>
						<div class="entry-content">
							<?php
							the_content( __( 'Read more', 'storesy' ) );
							wp_link_pages( array(
								'before'		 => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'storesy' ) . '</span>',
								'after'			 => '</div>',
								'link_before'	 => '<span>',
								'link_after'	 => '</span>',
							) );
							?>
						</div><!-- .entry-content -->
					<?php } ?>
					<footer class="entry-meta">
						<?php if ( 'post' == get_post_type() ) { // Hide category and tag text for pages on Search ?>
							<?php
							/* translators: used between list items, there is a space after the comma */
							$categories_list = get_the_category_list( __( ', ', 'storesy' ) );
							if ( $categories_list && cg_categorized_blog() ) {
								?>
								<span class="categories">
									<?php printf( __( '%1$s', 'storesy' ), $categories_list ); ?>
								</span>
							<?php } // End if categories ?>

							<?php
							/* translators: used between list items, there is a space after the comma */
							$tags_list = get_the_tag_list( '', __( ', ', 'storesy' ) );
							if ( $tags_list ) {
								?>
								<span class="tags">
									<?php printf( __( '%1$s', 'storesy' ), $tags_list ); ?>
								</span>
							<?php } // End if $tags_list ?>
						<?php } // End if 'post' == get_post_type()   ?>



					</footer><!-- .entry-meta --> 
					<?php
				}
				// close has_post_thumbnail, output for all other posts
			} else {
				// no thumbnail contents 
				?>


				<header class="entry-header">

					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>   

				</header><!-- .entry-header -->
				<?php if ( is_search() ) { // Only display Excerpts for Search  ?>
					<div class="entry-summary">
						<?php the_excerpt(); ?>
					</div><!-- .entry-summary -->
				<?php } else { ?>
					<div class="entry-content">
						<?php
						the_content( __( 'Read more', 'storesy' ) );
						wp_link_pages( array(
							'before'		 => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'storesy' ) . '</span>',
							'after'			 => '</div>',
							'link_before'	 => '<span>',
							'link_after'	 => '</span>',
						) );
						?>
					</div><!-- .entry-content -->
				<?php } ?>
				<footer class="entry-meta">
					<?php if ( 'post' == get_post_type() ) { // Hide category and tag text for pages on Search ?>
						<?php
						/* translators: used between list items, there is a space after the comma */
						$categories_list = get_the_category_list( __( ', ', 'storesy' ) );
						if ( $categories_list && cg_categorized_blog() ) {
							?>
							<span class="cat-links">
								<?php printf( __( '%1$s', 'storesy' ), $categories_list ); ?>
							</span>
						<?php } // End if categories ?>

						<?php
						/* translators: used between list items, there is a space after the comma */
						$tags_list = get_the_tag_list( '', __( ', ', 'storesy' ) );
						if ( $tags_list ) {
							?>
							<span class="tags-links">
								<?php printf( __( '%1$s', 'storesy' ), $tags_list ); ?>
							</span>
						<?php } // End if $tags_list  ?>
					<?php } // End if 'post' == get_post_type()  ?>


				</footer><!-- .entry-meta -->   
				<?php
			}
			?>
		</div><!--/cg-blog-article -->
    </article><!-- #post-## -->
</div>