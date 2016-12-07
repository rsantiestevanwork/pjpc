<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author   WooThemes
 * @package  WooCommerce/Templates
 * @version  2.0.0
 */
global $cg_options;
$taxonomy			 = '';
$term_id			 = '';
$cg_shop_cat_sidebar = '';

if ( isset( $cg_options['product_listing_sidebar'] ) ) {
	$cg_shop_cat_sidebar = $cg_options['product_listing_sidebar'];
}

if ( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

get_header( 'shop' );
?>

<?php
/**
 * woocommerce_before_main_content hook
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 */
do_action( 'woocommerce_before_main_content' );
?>

<?php
global $post;
global $wp_query;

$cat_desc	 = '';
$cat_id		 = '';

$cat_id		 = $wp_query->get_queried_object_id();
$cat_desc	 = term_description( $cat_id, 'product_cat' );
?>  

<?php
if ( isset( $_GET['shopsidebar'] ) ) {
	$cg_shop_cat_sidebar = $_GET['shopsidebar'];
}
echo cg_get_woo_cat_intro();
?>

<?php
if ( function_exists( 'yoast_breadcrumb' ) && (!is_front_page() ) ) {
	yoast_breadcrumb( '<div class="container breadcrumbs"><div class="row"><div class="col-lg-12 col-md-12"><p class="animate sub-title" data-animate="fadeInDown">', '</p></div></div></div>' );
}
?>

<div class="cg-shop-wrap">
	<div class="container">
		<div class="row cg-shop-archive">

			<?php
			if ( ( $cg_shop_cat_sidebar == 'left-sidebar' ) || ( $cg_shop_cat_sidebar == 'left' ) ) {
				?>
				<div class="product-listing-wrapper col-lg-9 col-lg-push-3">				

				<?php } elseif ( ( $cg_shop_cat_sidebar == 'right-sidebar' ) || ( $cg_shop_cat_sidebar == 'right' ) ) { ?>
					<div class="product-listing-wrapper col-lg-9">

					<?php } else { ?>
						<div class="product-listing-wrapper col-lg-12"> 

							<?php
						}
						?>

						<?php
						/**
						 * woocommerce_before_shop_loop hook
						 * overridden in woocommerce-config.php
						 */
						do_action( 'woocommerce_before_shop_loop' );
						?>

						<?php if ( have_posts() ) : ?>
							<?php woocommerce_product_loop_start(); ?>
							<?php woocommerce_product_subcategories(); ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<?php wc_get_template_part( 'content', 'product' ); ?>
							<?php endwhile; // end of the loop.  ?>
							<?php woocommerce_product_loop_end(); ?>

							<?php
							/**
							 * woocommerce_after_shop_loop hook
							 *
							 * @hooked woocommerce_pagination - 10
							 */
							do_action( 'woocommerce_after_shop_loop' );
							?>
						<?php elseif ( !woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
							<?php wc_get_template( 'loop/no-products-found.php' ); ?>
						<?php endif; ?>
					</div>

					<?php
					if ( isset( $_GET['shopsidebar'] ) ) {

						if ( $cg_shop_cat_sidebar == 'left' ) {
							?>
							<div class="col-lg-3 col-lg-pull-9 shop-sidebar-left">
							<?php } elseif ( $cg_shop_cat_sidebar == 'right' ) { ?>
								<div class="col-lg-3 shop-sidebar-right"> 
									<?php
								}
								if ( ( $cg_shop_cat_sidebar == 'left' ) || ( $cg_shop_cat_sidebar == 'right' ) ) {
									dynamic_sidebar( 'shop-sidebar' );
									?>
								</div>
								<?php
							}
						} else {
							?>

							<!-- close col-lg-9 -->
							<?php if ( $cg_options['product_listing_sidebar'] == 'left-sidebar' ) { ?>
								<div class="col-lg-3 col-lg-pull-9 shop-sidebar-left">
								<?php } else if ( $cg_options['product_listing_sidebar'] == 'right-sidebar' ) { ?>
									<div class="col-lg-3 shop-sidebar-right">
									<?php } ?>    

									<?php
									if ( $cg_options['product_listing_sidebar'] == 'left-sidebar' || $cg_options['product_listing_sidebar'] == 'right-sidebar' ) {
										/**
										 * woocommerce_sidebar hook
										 *
										 * @hooked woocommerce_get_sidebar - 10
										 */
										dynamic_sidebar( 'shop-sidebar' );
										?> 
									</div>
									<?php
								}
							}
							?>

							<?php
							/**
							 * woocommerce_after_main_content hook
							 *
							 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
							 */
							do_action( 'woocommerce_after_main_content' );
							?>
						</div>
						<!-- close row -->
					</div><!--close container -->
				</div><!--/wrap -->
				<?php get_footer( 'shop' ); ?>