</div><!--/page-container -->

<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package commercegurus
 */
global $cg_options;
$cg_below_body_widget	 = '';
$cg_below_body_widget	 = $cg_options['cg_below_body_widget'];
$cg_footer_message		 = '';
$cg_footer_message		 = $cg_options['cg_footer_message'];
$cg_footer_social		 = '';
$cg_footer_social		 = $cg_options['cg_footer_social'];
$cg_footer_top_active	 = '';
$cg_footer_top_active	 = $cg_options['cg_footer_top_active'];
$cg_footer_bottom_active = '';
$cg_footer_bottom_active = $cg_options['cg_footer_bottom_active'];
$cg_back_to_top			 = '';
$cg_back_to_top			 = $cg_options['cg_back_to_top'];

if ( $cg_below_body_widget == 'yes' ) {
	?>
	<section class="below-body-widget-area">
		<div class="container">
			<div class="row">
				<div class="row-same-height row-full-height">
					<?php if ( is_active_sidebar( 'below-body' ) ) { ?>
						<?php dynamic_sidebar( 'below-body' ); ?>  
					<?php } ?>
				</div>
			</div>
		</div>
	</section>
<?php } ?>

<footer class="footercontainer"> 
	<div class="footer-background"></div>
	<?php if ( $cg_footer_top_active == 'yes' ) { ?>
		<?php if ( is_active_sidebar( 'first-footer' ) ) : ?>
			<div class="lightwrapper">
				<div class="container">
					<div class="row">
						<?php dynamic_sidebar( 'first-footer' ); ?>   
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /.lightwrapper -->
		<?php endif; ?>
	<?php } ?>

	<?php if ( $cg_footer_bottom_active == 'yes' ) { ?>
		<?php if ( is_active_sidebar( 'second-footer' ) ) : ?>
			<div class="subfooter">
				<div class="container">
					<div class="row">
						<?php dynamic_sidebar( 'second-footer' ); ?>            
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- /.subfooter -->
		<?php endif; ?>
	<?php } ?>

</footer>
</div><!--/wrapper-->

</div><!-- close #cg-page-wrap -->


<div class="footer">
	<div class="container">
		<div class="row">
			<div class="bottom-footer-left col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<?php
				if ( $cg_footer_message ) {
					$args = array(
						//formatting
						'strong' => array(),
						'em'	 => array(),
						'b'		 => array(),
						'i'		 => array(
							'class' => array()
						),
						'p'		 => array(),
						//links
						'a'		 => array(
							'href' => array()
						)
					);
					echo '<div class="footer-copyright"><p>';
					echo wp_kses( $cg_footer_message, $args );
					echo '</p></div>';
				}
				?>
			</div>
			<div class="bottom-footer-right col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<?php
				if ( $cg_footer_social ) {
					$args = array(
						//formatting
						'strong' => array(),
						'em'	 => array(),
						'b'		 => array(),
						'i'		 => array(
							'class' => array()
						),
						'p'		 => array(),
						//links
						'a'		 => array(
							'href' => array()
						)
					);
					echo '<div class="footer-social">';
					echo wp_kses( $cg_footer_social, $args );
					echo '</div>';
				}
				?>
			</div>

		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /.footer -->

<?php if ( $cg_back_to_top == 'yes' ) { ?>
	<a href="#0" class="cd-top">Top</a>
<?php } ?>
<?php
global $cg_live_preview;
if ( isset( $cg_live_preview ) )
	include("live-preview.php")
	?>
<?php wp_footer(); ?>
</body>
</html>