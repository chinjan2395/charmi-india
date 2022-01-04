<?php
/**
 * Template part for displaying site info
 *
 * @package Bosa Store 1.0.0
 */

?>

<div class="site-info">
	<?php echo wp_kses_post( html_entity_decode( esc_html__( 'Copyright &copy; ' , 'bosa-store' ) ) );
		echo esc_html( date( 'Y' ) );
		printf( esc_html__( ' Charmi India Enterprise.', 'charmi-india-enterprise' ) );
	?>
	<!--<a href="<?php /*echo esc_url( __( '//bosathemes.com', 'bosa-store' ) ); */?>" target="_blank">
		<?php
/*			printf( esc_html__( 'Bosa Themes', 'bosa-store' ) );
		*/?>
	</a>-->
</div><!-- .site-info -->
