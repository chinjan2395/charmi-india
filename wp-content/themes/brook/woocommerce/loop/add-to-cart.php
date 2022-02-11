<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
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
 * @version       3.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$tooltip_position = 'top';
$hint_classes     = '';

$tooltip_position = apply_filters( 'woocommerce_add_to_cart_tooltip_position', $tooltip_position );

if ( $tooltip_position !== 'none' ) {
	$hint_classes = "hint--rounded hint--bounce hint--{$tooltip_position}";
}
?>
<div class="product-action woocommerce_loop_add_to_cart_wrap <?php echo esc_attr( $hint_classes ); ?>"
	<?php if ( $tooltip_position !== 'none' ) : ?>
		aria-label="<?php echo esc_attr( $product->add_to_cart_text() ); ?>"
	<?php endif; ?>
>
	<?php
	echo apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>', esc_url( $product->add_to_cart_url() ), esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ), esc_attr( $product->get_id() ), esc_attr( $product->get_sku() ), esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ), esc_html( $product->add_to_cart_text() ) ), $product );
	?>
</div>
