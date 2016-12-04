<?php
// Logo to the left with menu beside

global $cg_options, $cg_dark_mobile_logo;
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

$cg_topbar = '';

if ( isset( $cg_options['cg_topbar'] ) ) {
	$cg_topbar = $cg_options['cg_topbar'];
}

$cg_shop_announcements = '';

if ( isset( $cg_options['cg_shop_announcements'] ) ) {
	$cg_shop_announcements = $cg_options['cg_shop_announcements'];
}

$cg_logo_position = '';

if ( isset( $cg_options['cg_logo_position'] ) ) {
	$cg_logo_position = $cg_options['cg_logo_position'];
}

$cg_logo_height = '';

if ( isset( $cg_options['cg_logo_height'] ) ) {
	$cg_logo_position = $cg_options['cg_logo_height'];
}

$cg_sticky_logo_height = '';

if ( isset( $cg_options['cg_sticky_logo_height'] ) ) {
	$cg_logo_position = $cg_options['cg_sticky_logo_height'];
}
?>

<!-- Only load if the OffCanvas Menu is Enabled -->

<?php if ( $cg_display_offcanvas == '1' ) { ?>
	<div class="overlay-after"></div>
<?php } ?>
<div class="cg-offcanvas-menu">
	<div class="menu-wrap">
		<nav class="menu">
			<div class="icon-list">
				<?php if ( has_nav_menu( 'offcanvas' ) ) { ?>
					<?php
					wp_nav_menu( array(
						'theme_location'	 => 'offcanvas',
						'before'			 => '',
						'after'				 => '',
						'link_before'		 => '',
						'link_after'		 => '',
						'depth'				 => 1,
						'container'			 => 'div',
						'container_class'	 => 'cg-offcanvas-menu',
						'fallback_cb'		 => false )
					);
					?>
				<?php } else { ?>
					<p class="setup-message"><?php echo esc_html__( 'You can set your OffCanvas Menu in Appearance -> Menus', 'storesy' ); ?></p>
				<?php } ?>
			</div>
		</nav>
		<button class="close-button" id="close-button"><?php echo esc_html__( 'Close Menu', 'storesy' ); ?></button>
	</div>
</div>
<!-- End OffCanvas Menu -->

<!-- Load Top Bar -->
<?php if ( $cg_topbar == '1' ) { ?>
	<div class="cg-announcements">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-6 top-bar-left">
					<?php if ( $cg_shop_announcements == '1' ) { ?>
						<ul class="cg-show-announcements">
							<?php cg_get_announcements(); ?>
						</ul>
					<?php } else { ?>
						<?php if ( is_active_sidebar( 'top-bar-left' ) ) : ?>
							<?php dynamic_sidebar( 'top-bar-left' ); ?>
						<?php endif; ?>
					<?php } ?>
				</div>
				<div class="col-md-6 col-lg-6 top-bar-right">
					<?php if ( is_active_sidebar( 'top-bar-right' ) ) : ?>
						<?php dynamic_sidebar( 'top-bar-right' ); ?>
					<?php endif; ?>
				</div>		
			</div>
		</div>
	</div>
<?php } ?>	
<!--/ End Top Bar -->

<!-- Only load if Mobile Search Widget Area is Enabled -->
<?php if ( is_active_sidebar( 'mobile-search' ) ) : ?>

	<script>
	    ( function ( $ ) {
	        "use strict";

	        $( document ).ready( function () {
	            $( ".activate-mobile-search" ).click( function () {
	                $( ".mobile-search-reveal" ).slideToggle( "fast" );
	            } );
	        } );

	    }( jQuery ) );
	</script>

	<div class="mobile-search-reveal">
		<div class="activate-mobile-search close"><i class="fa fa-times"></i></div>
		<?php dynamic_sidebar( 'mobile-search' ); ?>
	</div>
<?php endif; ?>
<!--/ End Mobile Search -->


<!-- If Sticky is enabled -->
<?php if ( $cg_sticky_menu == '1' ) { ?>

	<script>
	    ( function ( $ ) {
	        "use strict";

	        $( document ).ready( function () {
	            $( '.cg-transparent-header' ).scrollFix();
	        } );

	    }( jQuery ) );
	</script>

<?php } ?>	
<!--/ End Sticky -->

<div class="cg-header-wrap">
	<div class="cg-transparent-header">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12">

					<?php if ( $cg_responsive_status !== 'disabled' ) { ?>

						<div id="load-mobile-menu"></div>
					<?php } ?>

					<?php if ( is_active_sidebar( 'mobile-search' ) ) : ?>
						<div class="icon mobile-search-icon cg-icon-magnifier-1 activate-mobile-search"></div>
					<?php endif; ?>

					<!-- start cg-primary-menu - menu-beside1 -->
					<div class="midnav">

						<?php
						$cg_main_logo	 = '';
						$cg_sticky_logo	 = '';

						$cg_main_logo	 = cg_get_logo( 'main' );
						$cg_sticky_logo	 = cg_get_logo( 'sticky' );
						?>
						<?php if ( $cg_main_logo ) { ?>
							<div class="leftnav logo image">
								<?php if ( is_array( $cg_main_logo ) ) { ?>
									<a class="cg-main-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $cg_main_logo[0] ); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
									<a class="cg-dark-mobile-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $cg_main_logo[1] ); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
								<?php } else { ?>
									<a class="cg-main-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $cg_main_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
								<?php } ?>
								<?php if ( $cg_sticky_logo ) { ?>
									<a class="cg-sticky-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo esc_url( $cg_sticky_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
								<?php } ?>
							</div>
						<?php } else { ?>
							<div class="leftnav">
								<a class="logo-text" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
							</div>
						<?php } ?>

						<div class="cg-primary-menu cg-wp-menu-wrapper">
							<?php if ( has_nav_menu( 'primary' ) ) { ?>
								<?php
								wp_nav_menu( array(
									'theme_location'	 => 'primary',
									'before'			 => '',
									'after'				 => '',
									'link_before'		 => '',
									'link_after'		 => '',
									'depth'				 => 4,
									'container'			 => 'div',
									'container_class'	 => 'cg-main-menu',
									'fallback_cb'		 => false,
									'walker'			 => new cg_primary_menu() )
								);
								?>
							<?php } else { ?>
								<p class="setup-message"><?php echo esc_html__( 'You can set your main menu in Appearance -> Menus', 'storesy' ); ?></p>
							<?php } ?>
						</div><!--/cg-primary-nav --> 
					</div><!-- end midnav -->

					<div class="rightnav">
						<div class="cg-extras">


							<?php if ( $cg_display_cart == '1' ) { ?>
								<?php if ( $cg_catalog == 'disabled' ) { ?>
									<div class="extra">
										<div class="cg-header-cart">
											<div class="cart-wrap">
												<?php if ( class_exists( 'WooCommerce' ) ) { ?>
													<?php echo cg_woocommerce_cart_dropdown(); ?>
												<?php }
												?>
											</div>
										</div>
									</div>
									<?php } ?>
								<?php } ?> 

							<?php if ( $cg_display_search == '1' ) { ?>
								<div class="extra"><button class="search-button cg-icon-magnifier-1" id="trigger-search-overlay" type="button"></button></div>
							<?php } ?> 

							<?php if ( $cg_display_offcanvas == '1' ) { ?>
								<div class="extra">
									<div class="offcanvas-button-wrap">
										<button id="open-button" class="menu-button"></button>
										<span class="burger">
											<span></span>
											<span></span>
											<span></span>
										</span>
									</div><!--/offcanvas-button-wrap -->
								</div>             
							<?php } ?> 
						</div><!--/cg-extras -->
					</div><!--/rightnav -->
				</div><!--/container -->
			</div>
		</div>
	</div><!--/cg-transparent-header -->					
</div>

<?php if ( $cg_display_search == '1' ) { ?>
	<div class="search-overlay cg-overlay">
			<button type="button" class="overlay-close"><?php echo esc_html__( 'Close', 'storesy' ); ?></button>
		<nav>
			<ul>
				<li><?php echo cg_product_search(); ?></li>
			</ul>
		</nav>
	</div><!--/search-overlay -->
<?php } ?> 

<div class="page-container">