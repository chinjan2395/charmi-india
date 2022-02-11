<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

global $post, $product;

$open_gallery = apply_filters( 'woocommerce_single_product_open_gallery', true );

$feature_style = Brook::setting( 'single_product_feature_style' );
$classes       = "feature-style-$feature_style";
?>
<div class="<?php echo esc_attr( $classes ); ?>">
	<?php if ( $feature_style === 'slider' ) { ?>

		<ul id="woo-single-gallery">

			<?php if ( has_post_thumbnail() ) { ?>

				<?php
				$thumbnail_id = get_post_thumbnail_id();
				$props        = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
				$sub_html     = '';

				if ( $props['title'] !== '' ) {
					$sub_html .= "<h4>{$props['title']}</h4>";
				}

				if ( $props['caption'] !== '' ) {
					$sub_html .= "<p>{$props['caption']}</p>";
				}

				$shop_single = get_option( 'woocommerce_single_image_width' );

				$image = Brook_Image::get_attachment_by_id( array(
					'id'     => $thumbnail_id,
					'size'   => 'custom',
					'width'  => $shop_single,
					'height' => 9999,
					'crop'   => false,
				) );

				$thumb = Brook_Image::get_attachment_url_by_id( array(
					'id'   => $thumbnail_id,
					'size' => '210x210',
				) );

				$_link = $props['url'];

				if ( $open_gallery === false ) {
					$_link = get_the_permalink();
				}

				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li data-thumb="%s" data-src="%s" class="woocommerce-main-image">%s</li>', esc_attr( $thumb ), esc_attr( $_link ), $image ), $post->ID );

			} else {
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_attr__( 'Placeholder', 'brook' ) ), $post->ID );
			}
			?>

			<?php do_action( 'woocommerce_product_thumbnails' ); ?>

		</ul>

	<?php } else { ?>
		<?php if ( has_post_thumbnail() ) { ?>

			<?php
			$thumbnail_id = get_post_thumbnail_id();
			$props        = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
			$sub_html     = '';

			if ( $props['title'] !== '' ) {
				$sub_html .= "<h4>{$props['title']}</h4>";
			}

			if ( $props['caption'] !== '' ) {
				$sub_html .= "<p>{$props['caption']}</p>";
			}

			$shop_single = get_option( 'woocommerce_single_image_width' );

			$image = Brook_Image::get_attachment_by_id( array(
				'id'     => $thumbnail_id,
				'size'   => 'custom',
				'width'  => $shop_single,
				'height' => 9999,
				'crop'   => false,
			) );

			$_link = $props['url'];

			if ( $open_gallery === false ) {
				$_link = get_the_permalink();
			}

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" data-sub-html="%s">%s</a>', esc_url( $_link ), $sub_html, $image ), $post->ID );

		} else {
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_attr__( 'Placeholder', 'brook' ) ), $post->ID );
		}
		?>

		<?php do_action( 'woocommerce_product_thumbnails' ); ?>

	<?php } ?>
</div>
