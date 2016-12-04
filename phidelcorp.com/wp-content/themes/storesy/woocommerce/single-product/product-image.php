<?php
/**
 * Single Product Image
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.3
 */
if ( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

global $post, $woocommerce, $product;

global $cg_options;
$cg_owl_thumbs = '';

if ( isset( $cg_options['cg_owl_thumbs'] ) ) {
    $cg_owl_thumbs = $cg_options['cg_owl_thumbs'];
}

if ( $cg_owl_thumbs == 'no' ) {

?>

<div class="images">

    <?php
        if ( has_post_thumbnail() ) {

            $image_title    = esc_attr( get_the_title( get_post_thumbnail_id() ) );
            $image_caption  = get_post( get_post_thumbnail_id() )->post_excerpt;
            $image_link     = wp_get_attachment_url( get_post_thumbnail_id() );
            $image          = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
                'title' => $image_title,
                'alt'   => $image_title
                ) );

            $attachment_count = count( $product->get_gallery_attachment_ids() );

            if ( $attachment_count > 0 ) {
                $gallery = '[product-gallery]';
            } else {
                $gallery = '';
            }

            echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_caption, $image ), $post->ID );

        } else {

            echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

        }
    ?>

    <?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>

<?php

} else {

$cg_attach_ids = $product->get_gallery_attachment_ids();

global $wp_locale;
$rtl = '';
$rtl = ( isset( $wp_locale ) && ('rtl' == $wp_locale->text_direction ) );
?>

<div class="images cg-prod-gallery">

    <script type="text/javascript">

        jQuery( document ).ready( function ( $ ) {
            var sync1 = $( "#sync1" );
            var sync2 = $( "#sync2" );

            sync1.owlCarousel( {
                singleItem: true,
                slideSpeed: 200,
                navigation: true,
                navigationText: [
                    "<i class='fa fa-angle-left'></i>",
                    "<i class='fa fa-angle-right'></i>"
                ],
                pagination: true,
                afterAction: syncPosition,
                responsiveRefreshRate: 200,
            } );

            sync2.owlCarousel( {
<?php
if ( $rtl ) {
    echo 'rtl : true,';
}
?>
                items: 4,
                itemsDesktop: false,
                itemsDesktopSmall: false,
                itemsTablet: [ 479, 3 ],
                itemsMobile: [ 320, 2 ],
                pagination: false,
                responsiveRefreshRate: 100,
                touchDrag:  false,
                afterInit: function ( el ) {
                    el.find( ".owl-item" ).eq( 0 ).addClass( "synced" );
                }
            } );

            function syncPosition( el ) {
                var current = this.currentItem;
                $( "#sync2" )
                    .find( ".owl-item" )
                    .removeClass( "synced" )
                    .eq( current )
                    .addClass( "synced" )
                if ( $( "#sync2" ).data( "owlCarousel" ) !== undefined ) {
                    center( current )
                }
            }

            $( "#sync2" ).on( "click", ".owl-item", function ( e ) {
                e.preventDefault();
                var number = $( this ).data( "owlItem" );
                sync1.trigger( "owl.goTo", number );
            } );

            $( ".variations" ).on( 'change', 'select', function ( e ) {
                sync1.trigger( "owl.goTo", 0 );
            } );

            function center( number ) {
                var sync2visible = sync2.data(
                    "owlCarousel" ).owl.visibleItems;
                var num = number;
                var found = false;
                for ( var i in sync2visible ) {
                    if ( num === sync2visible[i] ) {
                        var found = true;
                    }
                }

                if ( found === false ) {
                    if ( num > sync2visible[sync2visible.length - 1] ) {
                        sync2.trigger( "owl.goTo",
                            num - sync2visible.length + 2 )
                    } else {
                        if ( num - 1 === -1 ) {
                            num = 0;
                        }
                        sync2.trigger( "owl.goTo", num );
                    }
                } else if ( num === sync2visible[sync2visible.length - 1] ) {
                    sync2.trigger( "owl.goTo", sync2visible[1] )
                } else if ( num === sync2visible[0] ) {
                    sync2.trigger( "owl.goTo", num - 1 )
                }
            }

        } );

    </script>

    <div id="sync1" class="cg-prod-lvl1">

        <?php if ( has_post_thumbnail() ) : ?>

            <?php
            $cg_attach_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), false, '' );

            $cg_attach_count = count( get_children( array( 'post_parent' => $post->ID, 'post_mime_type' => 'image', 'post_type' => 'attachment' ) ) );
            ?>

            <div class="item cg-product-gallery-img">
                <a class="zoom" href="<?php echo esc_url( $cg_attach_src[0] ) ?>"><span itemprop="image"><?php echo get_the_post_thumbnail( $post->ID, 'shop_single' ) ?></span>
                </a>
            </div>

        <?php endif; ?> 

        <?php
        if ( $cg_attach_ids ) {

            $capthumbsinc    = 0;
            $columns         = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

            foreach ( $cg_attach_ids as $cg_attach_id ) {

                $classes = array( 'zoom' );

                if ( $capthumbsinc == 0 || $capthumbsinc % $columns == 0 )
                    $classes[] = 'first';

                if ( ( $capthumbsinc + 1 ) % $columns == 0 )
                    $classes[] = 'last';

                $cg_image_uri = wp_get_attachment_url( $cg_attach_id );

                if ( !$cg_image_uri )
                    continue;

                $cg_image        = wp_get_attachment_image( $cg_attach_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ) );
                $cg_image_class  = esc_attr( implode( ' ', $classes ) );
                $cg_image_title  = esc_attr( get_the_title( $cg_attach_id ) );

                printf( '<div class="item cg-product-gallery-img"><a href="%s"><span>%s</span></a></div>', wp_get_attachment_url( $cg_attach_id ), wp_get_attachment_image( $cg_attach_id, 'shop_single' ) );

                $capthumbsinc++;
            }
        }
        ?>

    </div>

    <?php
    if ( $cg_attach_ids ) {
        ?>

        <div class="cg-prod-gallery-thumbs">   
            <div id="sync2" class="cg-prod-lvl2">

                <?php if ( has_post_thumbnail() ) { ?>
                    <div class="cg-prod-gallery-thumb">
                        <div itemprop="image"><?php echo get_the_post_thumbnail( $post->ID, 'shop_single' ) ?>
                        </div>
                    </div>
                <?php } ?>

                <?php
                $capthumbsinc    = 0;
                $columns         = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

                foreach ( $cg_attach_ids as $cg_attach_id ) {

                    $classes = array( 'zoom' );

                    if ( $capthumbsinc == 0 || $capthumbsinc % $columns == 0 )
                        $classes[] = 'first';

                    if ( ( $capthumbsinc + 1 ) % $columns == 0 )
                        $classes[] = 'last';

                    $cg_image_link = wp_get_attachment_url( $cg_attach_id );

                    if ( !$cg_image_link )
                        continue;

                    $cg_image = wp_get_attachment_image( $cg_attach_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ) );

                    echo '<div class="cg-prod-gallery-thumb">' . $cg_image . '</div>';

                    $capthumbsinc++;
                }

                if ( $capthumbsinc < 4 ) {
                    for ( $i = 1; $i < (4 - $capthumbsinc); $i++ ) {
                        ?>
                        <div class="cg-prod-gallery-thumb"></div>
                        <?php
                    }
                }
                ?>

            </div>
        </div>

    <?php } ?>
</div>

<?php 
}
