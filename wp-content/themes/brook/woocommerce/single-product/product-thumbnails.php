<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see           https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       3.5.1
 */

defined( 'ABSPATH' ) || exit;

global $post, $product;

$open_gallery = apply_filters( 'woocommerce_single_product_open_gallery', true );

$feature_style = Brook::setting( 'single_product_feature_style' );

$attachment_ids = $product->get_gallery_image_ids();

if ( $attachment_ids ) {
	if ( $feature_style === 'slider' ) {

		foreach ( $attachment_ids as $attachment_id ) {
			$classes     = array( 'zoom' );
			$image_class = implode( ' ', $classes );
			$props       = wc_get_product_attachment_props( $attachment_id, $post );

			if ( ! $props['url'] ) {
				continue;
			}

			$sub_html = '';

			if ( $props['title'] !== '' ) {
				$sub_html .= "<h4>{$props['title']}</h4>";
			}

			if ( $props['caption'] !== '' ) {
				$sub_html .= "<p>{$props['caption']}</p>";
			}

			$image = Brook_Image::get_attachment_by_id( array(
				'id'   => $attachment_id,
				'size' => 'custom',
				'width' => 845,
				'height' => 9999,
				'crop' => false
			) );

			$thumb = Brook_Image::get_attachment_url_by_id( array(
				'id'   => $attachment_id,
				'size' => '210x210',
			) );

			$_link = $props['url'];

			if ( $open_gallery === false ) {
				$_link = get_the_permalink();
			}

			echo sprintf( '<li data-thumb="%s" data-src="%s">%s</li>', esc_attr( $thumb ), esc_attr( $_link ), $image );
		}
	} else {
		foreach ( $attachment_ids as $attachment_id ) {
			$classes     = array( 'zoom' );
			$image_class = implode( ' ', $classes );
			$props       = wc_get_product_attachment_props( $attachment_id, $post );

			if ( ! $props['url'] ) {
				continue;
			}

			$sub_html = '';

			if ( $props['title'] !== '' ) {
				$sub_html .= "<h4>{$props['title']}</h4>";
			}

			if ( $props['caption'] !== '' ) {
				$sub_html .= "<p>{$props['caption']}</p>";
			}

			$image = Brook_Image::get_attachment_by_id( array(
				'id'     => $attachment_id,
				'size'   => 'custom',
				'width'  => 845,
				'height' => 9999,
				'crop'   => false,
			) );

			$_link = $props['url'];

			if ( $open_gallery === false ) {
				$_link = get_the_permalink();
			}

			echo sprintf( '<a href="%s" class="%s" data-sub-html="%s">%s</a>', esc_url( $_link ), esc_attr( $image_class ), $sub_html, $image );
		}
	}
}
