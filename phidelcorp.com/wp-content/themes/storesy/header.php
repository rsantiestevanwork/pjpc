<?php
/**
 * The theme header
 *
 * */
global $cg_options;
$cg_protocol = ( is_ssl() ) ? "https:" : "http:";

$cg_responsive_status = '';

if ( isset( $cg_options['cg_responsive'] ) ) {
	$cg_responsive_status = $cg_options['cg_responsive'];
}

$cg_logo = '';

$cg_favicon = '';

if ( isset( $cg_options['cg_favicon']['url'] ) ) {
	$cg_options['cg_favicon']['url'] = $cg_protocol . str_replace( array( 'http:', 'https:' ), '', $cg_options['cg_favicon']['url'] );
	$cg_favicon						 = $cg_options['cg_favicon']['url'];
}

$cg_retina_favicon = '';

if ( isset( $cg_options['cg_retina_favicon']['url'] ) ) {
	$cg_options['cg_retina_favicon']['url']	 = $cg_protocol . str_replace( array( 'http:', 'https:' ), '', $cg_options['cg_retina_favicon']['url'] );
	$cg_retina_favicon						 = $cg_options['cg_retina_favicon']['url'];
}

$cg_topbar_display = '';

if ( isset( $cg_options['cg_topbar_display'] ) ) {
	$cg_topbar_display = $cg_options['cg_topbar_display'];
}

$cg_topbar_message = '';

if ( isset( $cg_options['cg_topbar_message'] ) ) {
	$cg_topbar_message = $cg_options['cg_topbar_message'];
}

$cg_display_cart = '';

if ( isset( $cg_options['cg_show_cart'] ) ) {
	$cg_display_cart = $cg_options['cg_show_cart'];
}

$cg_display_search = '';

if ( isset( $cg_options['cg_show_search'] ) ) {
	$cg_display_search = $cg_options['cg_show_search'];
}

$cg_display_offcanvas = '';

if ( isset( $cg_options['cg_show_offcanvas'] ) ) {
	$cg_display_offcanvas = $cg_options['cg_show_offcanvas'];
}

$cg_catalog = '';

if ( isset( $cg_options['cg_catalog_mode'] ) ) {
	$cg_catalog = $cg_options['cg_catalog_mode'];
}

$cg_primary_menu_layout = '';

if ( isset( $cg_options['cg_primary_menu_layout'] ) ) {
	$cg_primary_menu_layout = $cg_options['cg_primary_menu_layout'];
}

$cg_sticky_menu = '';

if ( isset( $cg_options['cg_sticky_menu'] ) ) {
	$cg_sticky_menu = $cg_options['cg_sticky_menu'];
}

if ( !empty( $_SESSION['cg_header_top'] ) ) {
	$cg_topbar_display = $_SESSION['cg_header_top'];
}

$cg_shop_announcements = '';

if ( isset( $cg_options['cg_shop_announcements'] ) ) {
	$cg_shop_announcements = $cg_options['cg_shop_announcements'];
}

$cg_logo_position = '';

if ( isset( $cg_options['cg_logo_position'] ) ) {
	$cg_logo_position = $cg_options['cg_logo_position'];
}

if ( isset( $_GET['logo_position'] ) ) {
	$cg_logo_position = $_GET['logo_position'];
}
?>
<!DOCTYPE html>
<!--[if IE 9 ]><html class="no-js ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
		<?php
		if ( $cg_responsive_status == 'enabled' ) {
			?>
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php } ?>
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">        
        <link rel="shortcut icon" href="<?php
		if ( $cg_favicon ) {
			echo esc_url( $cg_favicon );
		} else {
			?><?php echo get_template_directory_uri(); ?>/favicon.png<?php } ?>"/>

        <link rel="apple-touch-icon-precomposed" href="<?php
		if ( $cg_retina_favicon ) {
			echo esc_url( $cg_retina_favicon );
		} else {
			?><?php echo get_template_directory_uri(); ?>/apple-touch-icon-precomposed.png<?php } ?>"/>
       <!--[if lte IE 9]><script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.js"></script><![endif]-->
		<?php wp_head(); ?>
    </head>
    <body id="skrollr-body" <?php body_class(); ?>>
		<div id="main-wrapper" class="content-wrap">

			<?php if ( $cg_logo_position == 'left' ) { ?>
				<?php get_template_part( 'partials/header', 'left' ); ?>

			<?php } else if ( $cg_logo_position == 'beside' ) { ?>
				<?php get_template_part( 'partials/header', 'logoandmenubeside' ); ?>

			<?php } else if ( $cg_logo_position == 'center-logo-center-menu' ) { ?>
				<?php get_template_part( 'partials/header', 'centerlogocentermenu' ); ?>

			<?php } else if ( $cg_logo_position == 'right' ) { ?>
				<?php get_template_part( 'partials/header', 'right' ); ?>

			<?php } else { ?>
				<?php get_template_part( 'partials/header', 'logoandmenubeside' ); ?>
			<?php } ?>


			<?php
			if ( $cg_responsive_status !== 'disabled' ) {
				?>
				<div id="mobile-menu">
					<a id="skip" href="#cg-page-wrap" class="hidden" title="<?php esc_attr_e( 'Skip to content', 'storesy' ); ?>"><?php esc_html_e( 'Skip to content', 'storesy' ); ?></a> 
					<?php
					if ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'mobile' ) ) {
						wp_nav_menu( array( 'theme_location' => 'mobile', 'container' => 'ul', 'menu_id' => 'mobile-cg-mobile-menu', 'menu_class' => 'mobile-menu-wrap', 'walker' => new cg_mobile_menu() ) );
					} elseif ( function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary' ) ) {
						wp_nav_menu( array( 'theme_location' => 'primary', 'container' => 'ul', 'menu_id' => 'mobile-cg-primary-menu', 'menu_class' => 'mobile-menu-wrap', 'walker' => new cg_mobile_menu() ) );
					}
					?>
				</div><!--/mobile-menu -->
			<?php } ?>

			<div id="cg-page-wrap" class="hfeed site">
				<?php do_action( 'before' ); ?>
				<?php if ( is_wc_active() ) { ?> 
					<?php if ( function_exists( 'wc_print_notices' ) ) { ?>
						<?php
						$cg_wc_notices = WC()->session->get( 'wc_notices', array() );
						if ( !empty( $cg_wc_notices ) ) {
							?>
							<div class="cg-wc-messages">
								<div class="container">
									<div class="row">
										<div class="col-lg-12">
											<?php wc_print_notices(); ?>
										</div>
									</div>
								</div>
							</div>
							<?php
						}
					}
					?>
				<?php } ?>