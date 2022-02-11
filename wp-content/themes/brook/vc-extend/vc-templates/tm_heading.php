<?php
defined( 'ABSPATH' ) || exit;

$style = $el_class = $animation = $align = $custom_text_color = $custom_google_font = $link = '';
$icon  = $icon_class = '';
extract( $this->getAttributes( $atts ) );

$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$css_id = uniqid( 'tm-heading-' );
$this->get_inline_css( "#$css_id" );
Brook_VC::get_shortcode_custom_css( "#$css_id", $atts );
extract( $atts );

extract( $this->getStyles( $el_class, $css, $google_fonts_data, $atts ) );

$css_class .= " $style $align";

if ( in_array( $style, array( 'typed-text', 'typed-text-02' ), true ) ) {
	wp_enqueue_script( 'typed' );
}

if ( in_array( $style, array( 'link-style-01', 'link-style-02' ), true ) ) {
	$css_class .= ' group-link-style-01';
}

if ( isset( ${"icon_" . $icon_type} ) ) {
	$icon_class = esc_attr( ${"icon_" . $icon_type} );
}

if ( $icon_class !== '' ) {
	$icon = '<span class="icon ' . $icon_class . '"></span>';
}

if ( $animation === '' ) {
	$animation = Brook::setting( 'shortcode_heading_css_animation' );
}

$css_class .= Brook_Helper::get_animation_classes( $animation );
?>

<div class="<?php echo esc_attr( trim( $css_class ) ); ?>" id="<?php echo esc_attr( $css_id ); ?>">
	<?php
	$_style = '';

	if ( $custom_google_font === '1' ) {
		$settings = get_option( 'wpb_js_google_fonts_subsets' );
		if ( is_array( $settings ) && ! empty( $settings ) ) {
			$subsets = '&subset=' . implode( ',', $settings );
		} else {
			$subsets = '';
		}

		if ( isset( $google_fonts_data['values']['font_family'] ) ) {
			wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
		}

		if ( ! empty( $styles ) ) {
			$_style .= implode( ';', $styles );
		}
	}

	if ( $link !== '' ) {
		$text = '<a href="' . esc_url( $link ) . '">' . $text . '</a>';
	}

	$html_before = '';
	$html_after  = '';

	if ( in_array( $style, array( 'modern-image' ) ) ) {
		if ( $image !== '' ) {
			$image_template = wp_get_attachment_image( $image, 'full' );
			$html_before    .= '<div class="image">' . $image_template . '</div>';
		}
	}

	if ( in_array( $style, array( 'below-separator', 'below-wavy-separator', 'float-shadow' ) ) ) {
		$html_after .= '<div class="separator"></div>';
	}

	printf( '%s<%s class="heading" style="%s">%s%s</%s>%s', $html_before, $tag, esc_attr( $_style ), $icon, $text, $tag, $html_after );
	?>
</div>

<?php if ( in_array( $style, array( 'typed-text', 'typed-text-02' ), true ) ): ?>
	<?php
	$typed_list = (array) vc_param_group_parse_atts( $typed_list );
	$arr        = array();
	if ( count( $typed_list ) > 0 ) {
		foreach ( $typed_list as $item ) {
			if ( isset( $item['text'] ) && $item['text'] !== '' ) {
				$arr[] = $item['text'];
			}
		}
	}
	?>
	<script>
		jQuery( 'document' ).ready( function( $ ) {
			var id = '<?php echo "#{$css_id}"; ?>';
			var string = '<?php echo json_encode( $arr ); ?>';
			string = JSON.parse( string );
			var text = $( id + ' mark' )
				.text();
			if ( text !== '' ) {
				string.unshift( text );
			}
			Typed.new( id + ' mark', {
				strings: string,
				loop: true,
				typeSpeed: 50,
				backDelay: 1500
			} );
		} );
	</script>
<?php endif; ?>
