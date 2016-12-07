<?php

// CommerceGurus Custom CSS
$root = dirname( dirname( dirname( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) ) ) );
if ( file_exists( $root . '/wp-load.php' ) ) {
	require_once( $root . '/wp-load.php' );
	require_once( $root . '/wp-config.php' );
}

function cg_custom_css() {
	global $cg_options;
	?>

	<style type="text/css">

		<?php
		$cg_logo_height							 = '';
		$cg_sticky_logo_height					 = '';
		$cg_padding_above_logo					 = '';
		$cg_padding_below_sticky_logo			 = '';
		$cg_padding_above_sticky_logo			 = '';
		$cg_padding_below_logo					 = '';
		$cg_bg_color							 = '';
		$cg_pagewrapper_color					 = '';
		$cg_bg_img								 = '';
		$cg_bg_img_attach						 = '';
		$cg_bg_pattern_img						 = '';
		$cg_bg_img_repeat						 = '';
		$cg_bg_pattern_img_repeat				 = '';
		$cg_page_wrapper_color					 = '';
		$cg_skin_color							 = '';
		$cg_custom_css							 = '';
		$cg_primary_menu_img_css				 = '';
		$cg_primary_menu_img_height				 = '';
		$cg_product_loop_cart_button_color		 = '';
		$cg_product_loop_cart_button_text_color	 = '';
		$cg_woo_sale_label_bg_color				 = '';
		$cg_announcements_bg					 = '';
		$cg_announcements_text					 = '';
		$cg_topbar_bgcolor						 = '';
		$cg_topbar_txtcolor						 = '';
		$cg_footer_bg_img						 = '';
		$cg_product_cat_intro_bg_color			 = '';
		$cg_product_cat_intro_txt_color			 = '';

		if ( isset( $cg_options['cg_product_loop_cart_button_color'] ) ) {
			$cg_product_loop_cart_button_color = $cg_options['cg_product_loop_cart_button_color'];
		}

		if ( isset( $cg_options['cg_product_loop_cart_button_text_color'] ) ) {
			$cg_product_loop_cart_button_text_color = $cg_options['cg_product_loop_cart_button_text_color'];
		}

		if ( isset( $cg_options['cg_background']['background-color'] ) ) {
			$cg_bg_color = $cg_options['cg_background']['background-color'];
		}

		if ( isset( $cg_options['cg_background']['background-image'] ) ) {
			$cg_bg_img = $cg_options['cg_background']['background-image'];
		}

		if ( isset( $cg_options['cg_pattern_background']['background-image'] ) ) {
			$cg_bg_pattern_img = $cg_options['cg_pattern_background']['background-image'];
		}

		if ( isset( $cg_options['cg_background']['background-repeat'] ) ) {
			$cg_bg_img_repeat = $cg_options['cg_background']['background-repeat'];
		}

		if ( isset( $cg_options['cg_pattern_background']['background-repeat'] ) ) {
			$cg_bg_pattern_img_repeat = $cg_options['cg_pattern_background']['background-repeat'];
		}

		if ( isset( $cg_options['cg_page_wrapper_color'] ) ) {
			$cg_page_wrapper_color = $cg_options['cg_page_wrapper_color'];
		}

		if ( isset( $cg_options['cg_primary_menu_img_height'] ) ) {
			$cg_primary_menu_img_height = $cg_options['cg_primary_menu_img_height'];
		}

		if ( isset( $cg_options['cg_woo_sale_label_bg_color'] ) ) {
			$cg_woo_sale_label_bg_color = $cg_options['cg_woo_sale_label_bg_color'];
		}

		if ( isset( $cg_options['cg_logo_height'] ) ) {
			$cg_logo_height = $cg_options['cg_logo_height'];
		}

		if ( isset( $cg_options['cg_padding_above_logo'] ) ) {
			$cg_padding_above_logo = $cg_options['cg_padding_above_logo'];
		}

		if ( isset( $cg_options['cg_padding_below_logo'] ) ) {
			$cg_padding_below_logo = $cg_options['cg_padding_below_logo'];
		}

		if ( isset( $cg_options['cg_sticky_logo_height'] ) ) {
			$cg_sticky_logo_height = $cg_options['cg_sticky_logo_height'];
		}

		if ( isset( $cg_options['cg_padding_above_sticky_logo'] ) ) {
			$cg_padding_above_sticky_logo = $cg_options['cg_padding_above_sticky_logo'];
		}

		if ( isset( $cg_options['cg_padding_below_sticky_logo'] ) ) {
			$cg_padding_below_sticky_logo = $cg_options['cg_padding_below_sticky_logo'];
		}

		if ( isset( $cg_options['cg_padding_below_logo'] ) ) {
			$cg_padding_below_logo = $cg_options['cg_padding_below_logo'];
		}

		if ( isset( $cg_options['cg_announcements_bg'] ) ) {
			$cg_announcements_bg = $cg_options['cg_announcements_bg'];
		}

		if ( isset( $cg_options['cg_announcements_text'] ) ) {
			$cg_announcements_text = $cg_options['cg_announcements_text'];
		}

		if ( isset( $cg_options['cg_topbar_bgcolor'] ) ) {
			$cg_topbar_bgcolor = $cg_options['cg_topbar_bgcolor'];
		}

		if ( isset( $cg_options['cg_topbar_bgcolor'] ) ) {
			$cg_topbar_txtcolor = $cg_options['cg_topbar_txtcolor'];
		}

		if ( isset( $cg_options['cg_footer_bg_img']['url'] ) ) {
			$cg_footer_bg_img = $cg_options['cg_footer_bg_img']['url'];
		}

		if ( isset( $cg_options['cg_product_cat_intro_bg_color'] ) ) {
			$cg_product_cat_intro_bg_color = $cg_options['cg_product_cat_intro_bg_color'];
		}

		if ( isset( $cg_options['cg_product_cat_intro_txt_color'] ) ) {
			$cg_product_cat_intro_txt_color = $cg_options['cg_product_cat_intro_txt_color'];
		}

		$cg_skin_color			 = $cg_options['cg_skin_color'];
		$cg_primary_color		 = $cg_options['cg_primary_color'];
		$cg_active_link_color	 = $cg_options['cg_active_link_color'];
		$cg_link_hover_color	 = $cg_options['cg_link_hover_color'];

		if ( !empty( $_SESSION['cg_skin_color'] ) ) {
			$cg_skin_color = $_SESSION['cg_skin_color'];
		}

		if ( isset( $cg_skin_color ) ) {
			if ( $cg_skin_color !== 'none' ) {
				$cg_primary_color		 = $cg_skin_color;
				$cg_active_link_color	 = $cg_skin_color;
				$cg_link_hover_color	 = $cg_skin_color;
			}
		}

		$cg_below_body_bg			 = $cg_options['cg_below_body_bg'];
		$cg_below_body_text			 = $cg_options['cg_below_body_text'];
		$cg_first_footer_bg			 = $cg_options['cg_first_footer_bg'];
		$cg_second_footer_bg		 = $cg_options['cg_second_footer_bg'];
		$cg_last_footer_bg			 = $cg_options['cg_last_footer_bg'];
		$cg_first_footer_text		 = $cg_options['cg_first_footer_text'];
		$cg_second_footer_text		 = $cg_options['cg_second_footer_text'];
		$cg_last_footer_text		 = $cg_options['cg_last_footer_text'];
		$cg_header_bg_color			 = $cg_options['cg_header_bg_color'];
		$cg_header_text_color		 = $cg_options['cg_header_text_color'];
		$cg_mobile_header_bg_color	 = $cg_options['cg_mobile_header_bg_color'];

		$cg_header_fixed_bg_color	 = $cg_options['cg_header_fixed_bg_color'];
		$cg_header_fixed_text_color	 = $cg_options['cg_header_fixed_text_color'];

		if ( isset( $cg_options['cg_custom_css'] ) ) {
			$cg_custom_css = $cg_options['cg_custom_css'];
		}

		$cg_level2_font_color = $cg_options['cg_level2_font']['color'];

		$header_top_padding_height			 = ( ( $cg_logo_height ) + ( $cg_padding_above_logo ) );
		$sticky_header_top_padding_height	 = ( ( $cg_sticky_logo_height ) + ( $cg_padding_above_sticky_logo ) );
		$header_total_height				 = ( ( $cg_logo_height ) + ( $cg_padding_above_logo ) + ( $cg_padding_below_logo ) );
		$sticky_header_total_height			 = ( ( $cg_sticky_logo_height ) + ( $cg_padding_above_sticky_logo ) + ( $cg_padding_below_sticky_logo ) );


		if ( $cg_announcements_bg ) {
			?>

			.cg-announcements 
			{
				background-color: <?php echo esc_attr( $cg_announcements_bg ); ?>;
			}

			<?php
		}

		if ( $cg_announcements_text ) {
			?>

			.cg-announcements,
			.cg-announcements a,
			.cg-announcements a:hover

			{
				color: <?php echo esc_attr( $cg_announcements_text ); ?>;
			}

			<?php
		}

		if ( $cg_topbar_bgcolor ) {
			?>

			.cg-shopping-toolbar 
			{
				background-color: <?php echo esc_attr( $cg_topbar_bgcolor ); ?>;
			}

			<?php
		}

		if ( $cg_topbar_txtcolor ) {
			?>

			.cg-shopping-toolbar .wpml .widget_text,
			.cg-shopping-toolbar a.divider,
			.cg-shopping-toolbar a,
			.cg-shopping-toolbar
			{            
				color: <?php echo esc_attr( $cg_topbar_txtcolor ); ?>;
			}

			<?php
		}

		if ( $cg_level2_font_color ) {
			?>

			.cg-header-fixed .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li > a:hover, 
			.cg-primary-menu .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li > a:hover 
			{
				color: <?php echo esc_attr( $cg_level2_font_color ); ?>;
			}
		<?php } ?>

		<?php if ( $cg_bg_color ) {
			?>
			body {
				background-color: <?php echo esc_attr( $cg_bg_color ); ?>; 
			}

		<?php } ?>

		<?php if ( $cg_bg_img ) { ?>
			body {
				background-image: url('<?php echo esc_url( $cg_bg_img ); ?>'); 
				background-position: 0px 0px;
				background-attachment: fixed;
				background-size: cover;
			}
		<?php } ?>

		<?php if ( $cg_bg_img_repeat ) { ?>
			body {
				background-repeat: <?php echo esc_attr( $cg_bg_img_repeat ); ?>; 
			}
		<?php } ?>

		<?php if ( $cg_bg_pattern_img ) { ?>
			body {
				background-image: url('<?php echo esc_url( $cg_bg_pattern_img ); ?>'); 
				background-position: 0px 0px;
			}
		<?php } ?>

		<?php if ( $cg_bg_pattern_img_repeat ) { ?>
			body {
				background-repeat: <?php echo esc_attr( $cg_bg_pattern_img_repeat ); ?>; 
			}
		<?php } ?>

		<?php if ( $cg_footer_bg_img ) { ?>
			.footer-background {
				background-image: url('<?php echo esc_url( $cg_footer_bg_img ); ?>'); 
			}
		<?php } ?>

		<?php if ( $cg_page_wrapper_color ) { ?>
			#main-wrapper {
				background-color: <?php echo esc_attr( $cg_page_wrapper_color ); ?>; 
			}
		<?php } ?>

		<?php if ( $cg_woo_sale_label_bg_color ) { ?>
			.onsale-wrap {
				background-color: <?php echo esc_attr( $cg_woo_sale_label_bg_color ); ?>; 
			}
			.onsale-wrap:before,
			.onsale-wrap .onsale-inner:after {
				border-left-color: <?php echo esc_attr( $cg_woo_sale_label_bg_color ); ?>; 
			}
		<?php } ?>

		<?php if ( $cg_primary_color ) { ?>

			#top,
			.new.menu-item a:after, 
			.bttn:before, .cg-product-cta .button:before, 
			.slider .cg-product-cta .button:before, 
			.widget_shopping_cart_content p.buttons a.button:before,
			.faqs-reviews .accordionButton .icon-plus:before, 
			body.woocommerce .widget_layered_nav ul.yith-wcan-label li a:hover, 
			body.woocommerce-page .widget_layered_nav ul.yith-wcan-label li a:hover, 
			body.woocommerce-page .widget_layered_nav ul.yith-wcan-label li.chosen a,
			.content-area ul.bullets li:before,
			.container .mejs-controls .mejs-time-rail .mejs-time-current,
			.wpb_toggle:before, h4.wpb_toggle:before,
			#filters button.is-checked,
			.tipr_content,
			.navbar-toggle .icon-bar,
			.woocommerce-page .container input.button,
			.woocommerce-page .container button.button,
			body.page .woocommerce .summary .button,
			.woocommerce-page .container p.cart a.button,
			#calendar_wrap caption,
			.woocommerce-page .container #yith-wcwl-form a.button,
			.subfooter #mc_signup_submit,
			.cg-quickview-product-pop .single-product-details .button,
			.widget_price_filter .ui-slider .ui-slider-handle,
			.container .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header.ui-accordion-header-active,
			.page-numbers li span.current,
			.page-numbers li a:hover,
			.product-category-description,
			.cg-cart-count,
			.woocommerce-page .container input.button,
			.owl-theme .owl-controls .owl-page.active span, 
			.owl-theme .owl-controls.clickable .owl-page:hover span,
			.woocommerce-page .container .cart-collaterals a.button,
			.nav-slit h3,
			.cg-folio-thumb,
			.cg-folio-button,
			.cg-extra-product-options li a:after,
			.woocommerce-page .container .price_slider_amount .button:after,
			body.woocommerce-checkout .woocommerce-info a.showlogin:after, 
			body.woocommerce-checkout .woocommerce-info a.showcoupon:after,
			.post-tags a:hover, 
			.tagcloud a:hover,
			.woocommerce-message a:hover:after,
			.widget_shopping_cart_content p.buttons a.button.checkout,
			.woocommerce .container div.product form.cart .button,
			body.single-post.has-featured-image .header-wrapper .entry-meta time,
			#respond input#submit:hover,
			.content-area footer.entry-meta a:after,
			body .flex-direction-nav a,
			.cat-pic .cat-title,
			li.hot:after,
			body.single-post .content-area footer.entry-meta a:after,
			.content-area .medium-blog footer.entry-meta a:after,
			.cg-primary-menu .menu > li .cg-submenu-ddown .container > ul > li a:hover:after,
			.container #mc_signup_submit,
			.content-area article a.more-link,
			.cg-overlay-feature .cg-copy span.subtitle strong,
			.cg-overlay-slideup:hover .cg-copy,
			.woocommerce input.button,
			.container .mc4wp-form input[type="submit"],
			.wpcf7 input.wpcf7-submit,
			.prev-product:hover:before, 
			.next-product:hover:before,
			.search-overlay

			{
				background-color: <?php echo esc_attr( $cg_primary_color ); ?>; 
			}

			.page-numbers li span.current,
			ul.tiny-cart li ul.cart_list li.buttons .button.checkout,
			.page-numbers li a:hover, 
			.page-numbers li span.current,
			.page-numbers li span.current:hover,
			.page-numbers li a:hover,
			.vc_read_more,
			body .wpb_teaser_grid .categories_filter li a:hover, 
			.owl-theme .owl-controls .owl-page.active span, 
			.owl-theme .owl-controls.clickable .owl-page:hover span,
			.woocommerce-page .container .cart-collaterals a.button,
			.container .wpb_content_element .wpb_tabs_nav li.ui-tabs-active a,
			.order-wrap,
			.woocommerce .container #respond input#submit,
			.cg-product-cta .button:hover,
			.slider .cg-product-cta .button:hover,
			.widget_shopping_cart_content p.buttons a.button.checkout,
			.woocommerce-message,
			#respond input#submit,
			.up-sells-bottom h2 span,
			.content-area .up-sells-bottom h2 span,
			.related h2 span,
			.content-area .related h2 span,
			.cross-sells h2 span,
			.woocommerce-page .content-area form .coupon h3 span,
			body .vc_tta.vc_general.vc_tta-color-white .vc_tta-tab.vc_active span,
			body.error404 .content-area a.btn,
			body .flexslider

			{
				border-color: <?php echo esc_attr( $cg_primary_color ); ?>;
			}

			.tagcloud a:hover:before,
			.post-tags a:hover:before,
			.cat-links a:hover:before,
			.tags-links a:hover:before {
				border-right-color: <?php echo esc_attr( $cg_primary_color ); ?>;
			}

			.container .wpb_content_element .wpb_tabs_nav li.ui-tabs-active a:before,
			.widget_price_filter .ui-slider .ui-slider-handle:after {
				border-top-color: <?php echo esc_attr( $cg_primary_color ); ?>;
			}

			a,
			.cg-features i,
			.cg-features h2,
			.toggle-active i.fa,
			.cg-menu-beside .cg-cart-count,
			.widget_layered_nav ul.yith-wcan-list li a:before,
			.widget_layered_nav ul.yith-wcan-list li.chosen a:before,
			.widget_layered_nav ul.yith-wcan-list li.chosen a,
			blockquote:before,
			blockquote:after,
			article.format-link .entry-content p:before,
			.container .ui-state-default a, 
			.container .ui-state-default a:link, 
			.container .ui-state-default a:visited,
			.logo a,
			.container .cg-product-cta a.button.added:after,
			.woocommerce-breadcrumb a,
			#cg-articles h3 a,
			.cg-wp-menu-wrapper .menu li:hover > a,
			.cg-recent-folio-title a, 
			.woocommerce-message,
			.content-area h2.cg-recent-folio-title a,
			.cg-product-info .yith-wcwl-add-to-wishlist a:hover:before,
			.cg-product-wrap .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse.show a:before,
			.content-area .woocommerce-MyAccount-navigation ul li a:hover,
			.content-area .woocommerce-MyAccount-navigation ul li.is-active a,
			.widget_rss ul li a,
			.lightwrapper .widget_rss ul li a,
			.woocommerce-tabs .tabs li a:hover,
			.content-area .checkout-confirmed-payment p,
			.icon.cg-icon-bag-shopping-2, 
			.icon.cg-icon-basket-1, 
			.icon.cg-icon-shopping-1,
			#top-menu-wrap li a:hover,
			.cg-product-info .amount,
			.cg-product-info .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a:before, 
			.cg-product-info .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a:hover:before,
			.widget ul.product-categories ul.children li a:before,
			.widget_pages ul ul.children li a:before,
			.container .wpb_content_element .wpb_tabs_nav li.ui-tabs-active a,
			.container .wpb_tabs .wpb_tabs_nav li a:hover,
			ul#recentcomments li a,
			.widget a:hover,
			.cg-product-cta a.button.added,
			ul.tiny-cart li ul.cart_list li.cart_list_product a:hover,
			.woocommerce-tabs .tabs li.active a,
			.summary .price ins .amount,
			#respond input#submit,
			.blog-pagination ul li.active a,
			button.mfp-close:hover,
			body .vc_custom_heading a:hover,
			.woocommerce-account .content-area #customer_login h2,
			body.error404 .content-area a.btn,
			.no-grid .vc_custom_heading a:hover,
			.cg-primary-menu .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li > a:hover,
			.container .wpb_tour.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav li.ui-state-active a,
			.cg-header-fixed .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li .cg-submenu ul li.title a:hover,
			.cg-primary-menu .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li .cg-submenu ul li.title a:hover 

			{
				color: <?php echo esc_attr( $cg_primary_color ); ?>;
			}

			.owl-theme .owl-controls .owl-buttons div:hover,
			article.format-link .entry-content p:hover,
			.container .ui-state-hover,
			#filters button.is-checked,
			#filters button.is-checked:hover,
			.container form.cart .button:hover, 
			.woocommerce-page .container p.cart a.button:hover,
			.map_inner,
			.woocommerce-page .container .cart-collaterals input.checkout-button, 
			.woocommerce .checkout-button,
			h4.widget-title span,
			.wpb_teaser_grid .categories_filter li.active a,
			.cg-header-fixed .menu > li .cg-submenu-ddown, 
			body .wpb_teaser_grid .categories_filter li.active a,
			.cg-wp-menu-wrapper .menu li a:hover,
			.cg-primary-menu-beside .cg-wp-menu-wrapper .menu li:hover a,
			.cg-header-fixed .cg-wp-menu-wrapper .menu li:hover a,
			.container .cg-product-cta a.button.added,
			h4.widget-title span,
			.container .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header.ui-accordion-header-active

			{
				border-color: <?php echo esc_attr( $cg_primary_color ); ?>;
			}


			ul.tabNavigation li a.active,
			.wpb_teaser_grid .categories_filter li.active a,
			ul.tiny-cart li ul.cart_list li.buttons .button.checkout

			{
				background: <?php echo esc_attr( $cg_primary_color ); ?>;

			}

			.tipr_point_top:after,
			.woocommerce .woocommerce-tabs ul.tabs li.active a:after {
				border-top-color: <?php echo esc_attr( $cg_primary_color ); ?>;
			}

			.tipr_point_bottom:after,
			.content-area a:hover
			{
				border-bottom-color: <?php echo esc_attr( $cg_primary_color ); ?>;
			}

		<?php } ?>

		<?php if ( $cg_active_link_color ) { ?>

			a,
			.logo a,
			.navbar ul li.current-menu-item a, 
			.navbar ul li.current-menu-ancestor a, 
			#cg-articles h3 a,
			.widget-area .widget.widget_rss ul li a,
			.widget-area .widget #recentcomments li a,
			.current_page_ancestor,
			.current-menu-item,
			.woocommerce-message a,
			.content-area table.my_account_orders td.order-actions a,
			body.blog.has-featured-image .header-wrapper p.sub-title a,
			body.woocommerce-checkout .woocommerce-info a:hover,
			body.woocommerce-checkout .woocommerce-info a.showlogin:hover

			{
				color: <?php echo esc_attr( $cg_active_link_color ); ?>; 
			}


		<?php } ?>

		<?php if ( $cg_link_hover_color ) { ?>
			a:hover,
			a:focus,
			.content-area table a:hover,
			.cg-blog-date .comments-link a:hover,
			.widget ul.product-categories li a:hover,
			.widget ul.product-categories ul.children li a:hover,
			#top .dropdown-menu li a:hover, 
			ul.navbar-nav li .nav-dropdown li a:hover,
			.navbar ul li.current-menu-item a:hover, 
			.navbar ul li.current-menu-ancestor a:hover,
			.owl-theme .owl-controls .owl-buttons div:hover,
			.woocommerce ul.product_list_widget li a:hover,
			.content-area a.reset_variations:hover,
			.content-area a.post-edit-link:hover:before,
			.cg-wp-menu-wrapper .menu li a:hover,
			body.woocommerce-checkout .woocommerce-info a.showcoupon:hover,
			.cg-header-fixed .menu > li .cg-submenu-ddown .container > ul > li a:hover, 
			body .cg-primary-menu .menu > li .cg-submenu-ddown .container > ul > li a:hover, 
			.cg-submenu-ddown .container > ul > li > a:hover,
			.cg-header-fixed .menu > li .cg-submenu-ddown .container > ul > li a:hover,
			.cg-primary-menu .menu > li .cg-submenu-ddown .container > ul > li a:hover,
			.woocommerce-page .container .cart-collaterals a.shipping-calculator-button:hover,
			.blog-pagination ul li a:hover,
			.content-area .authordescription p a:hover,
			.content-area .medium-blog footer.entry-meta a:hover,
			.widget.popular-posts ul li a.wpp-post-title:hover,
			body .content-area article h2 a:hover,
			body .vc_custom_heading a:hover

			{
				color: <?php echo esc_attr( $cg_link_hover_color ); ?>; 
			}

			.dropdown-menu > li > a:hover {
				background-color: <?php echo esc_attr( $cg_link_hover_color ); ?>; 
			}

			.cg-size-guide a:hover,
			a.reset_variations:hover {
				border-color: <?php echo esc_attr( $cg_link_hover_color ); ?>; 
			}
		<?php } ?>

		<?php if ( $cg_header_text_color ) { ?>

			@media only screen and (min-width: 1100px) { 
				.cg-transparent-header .cg-primary-menu .menu > li > a,
				.cg-transparent-header .rightnav .cart_subtotal,
				.cg-transparent-header .search-button,
				.cg-primary-menu.cg-primary-menu-below-wrapper .menu > li > a,
				.cg-menu-below .rightnav .cart_subtotal,
				.cg-menu-below .search-button,
				.cg-menu-below .leftnav a {
					color: <?php echo esc_attr( $cg_header_text_color ); ?>;
				}

				.cg-transparent-header .burger span,
				.cg-menu-below .burger span {
					background: <?php echo esc_attr( $cg_header_text_color ); ?>;
				}

				.cg-transparent-header .leftnav a {
					color: <?php echo esc_attr( $cg_header_text_color ); ?>;
					border-color: <?php echo esc_attr( $cg_header_text_color ); ?>;
				}
			}
		<?php } ?>

		/* Sticky Header Text */

		<?php if ( $cg_header_fixed_text_color ) { ?>

			.cg-transparent-header.scroller .cg-primary-menu .menu > li > a,
			.cg-transparent-header.scroller .rightnav .cart_subtotal,
			.cg-transparent-header.scroller .search-button,
			body.transparent-light .cg-transparent-header.scroller .cg-primary-menu .menu > li > a, 
			body.transparent-light .cg-transparent-header.scroller .rightnav .cart_subtotal, 
			body.transparent-light .cg-transparent-header.scroller .search-button,
			body.transparent-dark .cg-transparent-header.scroller .cg-primary-menu .menu > li > a,
			body.transparent-dark .cg-transparent-header.scroller .rightnav .cart_subtotal,
			body.transparent-dark .cg-transparent-header.scroller .search-button,
			.cg-header-fixed-wrapper .cg-primary-menu .menu > li > a,
			.cg-header-fixed-wrapper .rightnav .cart_subtotal {
				color: <?php echo esc_attr( $cg_header_fixed_text_color ); ?>;
			}


			.cg-transparent-header.scroller .burger span,
			body.transparent-light .cg-transparent-header.scroller .burger span,
			body.transparent-dark .cg-transparent-header.scroller .burger span {
				background: <?php echo esc_attr( $cg_header_fixed_text_color ); ?>;
			}

			.cg-transparent-header.scroller .leftnav a,
			.cg-header-fixed .leftnav a {
				color: <?php echo esc_attr( $cg_header_fixed_text_color ); ?>;
				border-color: <?php echo esc_attr( $cg_header_fixed_text_color ); ?>;
			}



		<?php } ?>

		<?php if ( $cg_mobile_header_bg_color ) { ?>

			@media only screen and (max-width: 1100px) { 
				body .cg-header-wrap .cg-transparent-header,
				body.transparent-light .cg-header-wrap .cg-transparent-header,
				body.transparent-dark .cg-header-wrap .cg-transparent-header,
				body .cg-menu-below,
				.scroller, 
				body.transparent-light .cg-header-wrap .scroller, 
				body.transparent-dark .cg-header-wrap .scroller {
					background: <?php echo esc_attr( $cg_mobile_header_bg_color ); ?>; 
				}
			}

		<?php } ?>

		/* Standard Logo */
		<?php if ( $cg_logo_height ) { ?>

			@media only screen and (min-width: 1100px) {
				.cg-transparent-header,
				.cg-menu-below {
					height: <?php echo esc_attr( $cg_logo_height ); ?>px;
				}

				.leftnav .cg-main-logo img {
					height: <?php echo esc_attr( $cg_logo_height ); ?>px;
					width: auto;
				}

				.cg-extras {
					line-height: <?php echo esc_attr( $cg_logo_height ); ?>px;
				}


				.cg-transparent-header .cg-primary-menu .menu > li > a, 
				ul.tiny-cart li a.cart_dropdown_link,
				.rightnav {
					line-height: <?php echo esc_attr( $cg_logo_height ); ?>px;
				}

				.cg-menu-below,
				.cg-menu-below .ul.tiny-cart,
				.cg-logo-center .search-button,
				.cg-menu-below .leftnav a { 
					line-height: <?php echo esc_attr( $header_total_height ); ?>px;
				}

				.cg-menu-below .ul.tiny-cart,
				.cg-menu-below .cg-extras {
					height: <?php echo esc_attr( $header_total_height ); ?>px;
					line-height: <?php echo esc_attr( $header_total_height ); ?>px;
				}


			}

		<?php } ?>

		/* Sticky Logo */
		<?php if ( $cg_sticky_logo_height ) { ?>

			@media only screen and (min-width: 1100px) {
				.cg-transparent-header.scroller,
				.cg-header-fixed,
				.cg-header-fixed-wrapper.cg-is-fixed .logo {
					height: <?php echo esc_attr( $sticky_header_total_height ); ?>px;
				}

				.cg-header-fixed .helper {
					height: <?php echo esc_attr( $sticky_header_total_height ); ?>px;
					line-height: <?php echo esc_attr( $sticky_header_total_height ); ?>px;
				}

				.scroller .leftnav .cg-sticky-logo img,
				.cg-header-fixed .leftnav img {
					height: <?php echo esc_attr( $cg_sticky_logo_height ); ?>px;
					width: auto;
				}

				.scroller .cg-extras {
					line-height: <?php echo esc_attr( $cg_sticky_logo_height ); ?>px;
				}

				.scroller.cg-transparent-header .midnav li,
				.scroller.rightnav {
					line-height: <?php echo esc_attr( $cg_sticky_logo_height ); ?>px;
				}

				.cg-header-fixed-wrapper .cg-primary-menu .menu > li > a {
					line-height: <?php echo esc_attr( $sticky_header_total_height ); ?>px;
				}

				.cg-header-fixed ul.tiny-cart {
					line-height: <?php echo esc_attr( $sticky_header_total_height ); ?>px;
				}


			}

		<?php } ?>


		/* Standard Top Padding */
		<?php if ( $cg_padding_above_logo ) { ?>

			@media only screen and (min-width: 1100px) {
				.cg-transparent-header {
					height: <?php echo esc_attr( $header_top_padding_height ); ?>px;
					padding-top: <?php echo esc_attr( $cg_padding_above_logo ); ?>px;
				}

			}

		<?php } ?>

		/* Sticky Top Padding */
		<?php if ( $cg_padding_above_sticky_logo ) { ?>

			@media only screen and (min-width: 1100px) {
				.cg-transparent-header.scroller {
					height: <?php echo esc_attr( $sticky_header_top_padding_height ); ?>px;
					padding-top: <?php echo esc_attr( $cg_padding_above_sticky_logo ); ?>px;
				}
			}

		<?php } ?>

		/* Standard Bottom Padding */
		<?php if ( $cg_padding_below_logo ) { ?>

			@media only screen and (min-width: 1100px) {
				.cg-transparent-header,
				.cg-menu-below {
					height: <?php echo esc_attr( $header_total_height ); ?>px;
				}

				.cg-transparent-header .cg-primary-menu .menu > li > a {
					padding-bottom: <?php echo esc_attr( $cg_padding_below_logo ); ?>px;
				}
			}

		<?php } ?>

		/* Sticky Bottom Padding */
		<?php if ( $cg_padding_below_sticky_logo ) { ?>

			@media only screen and (min-width: 1100px) {
				.cg-transparent-header.scroller {
					height: <?php echo esc_attr( $sticky_header_total_height ); ?>px;
				}

				.cg-transparent-header.scroller .cg-primary-menu .menu > li > a {
					padding-bottom: <?php echo esc_attr( $cg_padding_below_sticky_logo ); ?>px;
				}
			}

		<?php } ?>


		<?php if ( $cg_below_body_bg ) { ?>
			.below-body-widget-area

			{
				background-color: <?php echo esc_attr( $cg_below_body_bg ); ?>; 
			}

		<?php } ?>

		<?php if ( $cg_below_body_text ) { ?>
			.below-body-widget-area

			{
				color: <?php echo esc_attr( $cg_below_body_text ); ?>; 
			}

		<?php } ?>

		<?php if ( $cg_first_footer_bg ) { ?>
			.lightwrapper 

			{
				background-color: <?php echo esc_attr( $cg_first_footer_bg ); ?>; 
			}

		<?php } ?>

		<?php if ( $cg_second_footer_bg ) { ?>
			.subfooter 

			{
				background-color: <?php echo esc_attr( $cg_second_footer_bg ); ?>; 
			}

		<?php } ?>

		<?php if ( $cg_last_footer_bg ) { ?>
			.footer 

			{
				background-color: <?php echo esc_attr( $cg_last_footer_bg ); ?>; 
			}

		<?php } ?>

		<?php if ( $cg_first_footer_text ) { ?>
			.lightwrapper h4, .lightwrapper ul li a,  

			{
				color: <?php echo esc_attr( $cg_first_footer_text ); ?>; 
			}

		<?php } ?>

		<?php if ( $cg_second_footer_text ) { ?>

			.subfooter #mc_subheader,
			body .subfooter h4,
			.subfooter .widget_recent_entries ul li a,
			.subfooter ul.product_list_widget li a,
			.subfooter #mc_signup_submit,
			.subfooter a,
			.bottom-footer-left a,
			.subfooter .textwidget, 
			.subfooter #mc_subheader,
			.subfooter ul.simple-links li a,
			.subfooter h4.widget-title span

			{
				color: <?php echo esc_attr( $cg_second_footer_text ); ?>; 
			}

		<?php } ?>

		<?php if ( $cg_last_footer_text ) { ?>
			.footer p,
			.footer p a,
			.bottom-footer-right a

			{
				color: <?php echo esc_attr( $cg_last_footer_text ); ?>; 
			}

		<?php } ?>

		<?php if ( $cg_product_loop_cart_button_color ) { ?>
			.cg-product-cta .add_to_cart_button, 
			.cg-product-cta .product_type_external,
			.cg-product-cta .product_type_grouped

			{
				background: <?php echo esc_attr( $cg_product_loop_cart_button_color ); ?>; 
				z-index: 1;
			}

		<?php } ?>

		<?php if ( $cg_product_loop_cart_button_text_color ) { ?>
			.cg-product-cta .add_to_cart_button,
			.cg-product-cta .button,
			.cg-product-cta .product_type_external,
			.cg-product-cta .product_type_grouped,
			.slider .cg-product-cta .button

			{
				color: <?php echo esc_attr( $cg_product_loop_cart_button_text_color ); ?>; 
				border-color: <?php echo esc_attr( $cg_product_loop_cart_button_text_color ); ?>;
			}

		<?php } ?>


		<?php if ( $cg_primary_menu_img_height ) { ?>
			.menu-full-width .cg-menu-title-wrap
			{
				line-height: <?php echo esc_attr( $cg_primary_menu_img_height ); ?>px;
			}

			.menu-full-width .cg-menu-img {
				height: <?php echo esc_attr( $cg_primary_menu_img_height ); ?>px; 
			}

		<?php } ?>

		<?php
		if ( $cg_custom_css ) {
			echo esc_attr( $cg_custom_css );
		}
		?>

	</style>

	<?php
}

function cg_hex2rgb( $hex ) {
	$hex = str_replace( "#", "", $hex );

	if ( strlen( $hex ) == 3 ) {
		$r	 = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
		$g	 = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
		$b	 = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
	} else {
		$r	 = hexdec( substr( $hex, 0, 2 ) );
		$g	 = hexdec( substr( $hex, 2, 2 ) );
		$b	 = hexdec( substr( $hex, 4, 2 ) );
	}
	$rgb = array( $r, $g, $b );
	return implode( ",", $rgb ); // returns the rgb values separated by commas
	//return $rgb; // returns an array with the rgb values
}

add_action( 'wp_head', 'cg_custom_css', 100 );
