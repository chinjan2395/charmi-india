<?php
defined( 'ABSPATH' ) || exit;

/**
 * Shortcode attributes
 *
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_speed_video
 * @var $content - shortcode content
 * Shortcode class
 * @var $this    WPBakeryShortCode_VC_Row
 */
$el_class                  = $height = $exclude_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = '';
$separator_type            = $separator_position = '';
$column_separator          = '';
$onepage_title             = $onepage_anchor = $onepage_skin = $onepage_logo_skin = '';
$disable_element           = '';
$output                    = $after_output = '';
$overlay_opacity           = 100;
$overlay_custom_background = $overlay_background = '';
$effect                    = $firefly_color = $firefly_min_size = $firefly_max_size = $firefly_total = '';
$constellation_star_color  = $constellation_line_color = '';
$scrolling_color           = '';
$atts                      = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
	'vc_row',
	'vc_row-outer',
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

if ( $column_separator !== '' ) {
	$css_classes[] = "vc_row-column-separator-$column_separator";
}

if ( $separator_type !== '' ) {
	$css_classes[] = 'vc_row-has-separator';
}

if ( $overlay_background !== '' ) {
	$css_classes[] = 'vc_container-has-overlay';
}

if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if ( vc_shortcode_custom_css_has_property( $css, array( 'border', 'background' ) ) || $video_bg || $parallax ) {
	$css_classes[] = 'vc_row-has-fill';
}

if ( ! empty( $atts['gap'] ) ) {
	$css_classes[] = 'vc_column-gap-' . $atts['gap'];
}

$wrapper_attributes = array();
// build attributes for wrapper.

if ( $background_attachment === 'marque' ) {
	$css_classes[] = 'background-marque';
	$css_classes[] = $marque_direction;

	if ( $marque_pause_on_hover === '1' ) {
		$wrapper_attributes[] = 'data-marque-pause-on-hover="true"';
	}
}

if ( $scrolling_color !== '' ) {
	$css_classes[]        = ' vc_container-scrolling';
	$wrapper_attributes[] = 'data-scrolling-background="' . $scrolling_color . '"';

	wp_enqueue_script( 'brook-scrolling-background' );
}

if ( $effect === 'firefly' ) {
	wp_enqueue_script( 'firefly' );

	$css_classes[] = 'tm-effect-firefly';

	if ( $firefly_color !== '' ) {
		$wrapper_attributes[] = 'data-firefly-color="' . $firefly_color . '"';
	}

	if ( $firefly_total !== '' ) {
		$wrapper_attributes[] = 'data-firefly-total="' . $firefly_total . '"';
	}

	if ( $firefly_min_size !== '' ) {
		$wrapper_attributes[] = 'data-firefly-min="' . $firefly_min_size . '"';
	}

	if ( $firefly_max_size !== '' ) {
		$wrapper_attributes[] = 'data-firefly-max="' . $firefly_max_size . '"';
	}
} elseif ( $effect === 'wavify' ) {
	wp_enqueue_script( 'wavify' );
} elseif ( $effect === 'constellation' ) {
	wp_enqueue_script( 'constellation' );
}

if ( $el_id === '' ) {
	$el_id = uniqid( 'tm-row-' );
}

Brook_VC::get_vc_row_css( '#' . $el_id, $atts );
$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';

$col_begin_wrapper = '';
$col_end_wrapper   = '';

$row_begin_wrap = '';
$row_end_wrap   = '';

if ( is_page_template( 'templates/one-page-scroll.php' ) ) {
	$section_attrs = array();

	$section_attrs[] = 'data-skin="' . $onepage_skin . '"';
	$section_attrs[] = 'data-logo-skin="' . $onepage_logo_skin . '"';
	$section_attrs[] = 'data-tooltip="' . $onepage_title . '"';

	if ( $onepage_anchor !== '' ) {
		$section_attrs[] = 'data-anchor="section-' . $onepage_anchor . '"';
	}

	$row_begin_wrap = '<div class="section vc-row-wrapper" ' . implode( ' ', $section_attrs ) . '><div class="container">';
	$row_end_wrap   = '</div></div>';
}

if ( ! empty( $full_width ) ) {
	$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ( 'stretch_row_content' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		$css_classes[]        = 'vc_row-no-padding';
	}
	$after_output .= '<div class="vc_row-full-width vc_clearfix"></div>';
}

if ( ! empty( $height ) ) {
	$css_classes[] = 'vc_row-o-full-height';

	if ( $height === 'full-calc' ) {
		$css_classes[] = 'calculated-height';
	}

	if ( $exclude_height !== '' ) {
		$wrapper_attributes[] = 'data-exclude-height="' . esc_attr( $exclude_height ) . '"';
	}

	if ( ! empty( $columns_placement ) ) {
		$flex_row      = true;
		$css_classes[] = 'vc_row-o-columns-' . $columns_placement;
		if ( 'stretch' === $columns_placement ) {
			$css_classes[] = 'vc_row-o-equal-height';
		}
	}
}

if ( ! empty( $equal_height ) ) {
	$flex_row      = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row      = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

$parallax_speed = $parallax_speed_bg;
if ( $has_video_bg ) {
	$parallax       = $video_bg_parallax;
	$parallax_speed = $parallax_speed_video;
	$parallax_image = $video_bg_url;
	$css_classes[]  = 'vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	$wrapper_attributes[] = 'data-vc-parallax="' . esc_attr( $parallax_speed ) . '"'; // parallax speed.
	$css_classes[]        = 'vc_general vc_parallax vc_parallax-' . $parallax;
	if ( false !== strpos( $parallax, 'fade' ) ) {
		$css_classes[]        = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif ( false !== strpos( $parallax, 'fixed' ) ) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
}

if ( ! empty( $parallax_image ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id  = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}
if ( ! $parallax && $has_video_bg ) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}
$css_class            = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';

if ( $overlay_background !== '' ) {
	$output .= '<div class="vc_container-overlay"></div>';
}

if ( $effect === 'firefly' ) {
	$output .= '<div class="firefly-wrapper"></div>';
}

if ( $effect === 'wavify' ) {
	$wavify_items = (array) vc_param_group_parse_atts( $wavify_items );

	if ( count( $wavify_items ) > 0 ) {


		$output .= '<div class="wavify-wrapper">';

		ob_start();

		foreach ( $wavify_items as $wavify_item ) {
			?>
			<svg width="100%" height="100%" version="1.1" xmlns="https://www.w3.org/2000/svg" class="wavify-item"
				<?php if ( isset( $wavify_item['height'] ) ) : ?>
					data-wavify-height="<?php echo esc_attr( $wavify_item['height'] ); ?>"
				<?php endif; ?>

				<?php if ( isset( $wavify_item['background'] ) ) : ?>
					data-wavify-background="<?php echo esc_attr( $wavify_item['background'] ); ?>"
				<?php endif; ?>

				<?php if ( isset( $wavify_item['amplitude'] ) ) : ?>
					data-wavify-amplitude="<?php echo esc_attr( $wavify_item['amplitude'] ); ?>"
				<?php endif; ?>

				<?php if ( isset( $wavify_item['bones'] ) ) : ?>
					data-wavify-bones="<?php echo esc_attr( $wavify_item['bones'] ); ?>"
				<?php endif; ?>
			>
				<title>Wave</title>
				<defs></defs>
				<path d=""/>
			</svg>
			<?php
		}

		$wavify_template = ob_get_clean();


		$output .= $wavify_template;

		$output .= '</div>';
	}
}

if ( $effect === 'constellation' ) {
	$constellation_atts[] = 'data-line-color="' . esc_attr( $constellation_line_color ) . '"';
	$constellation_atts[] = 'data-star-color="' . esc_attr( $constellation_star_color ) . '"';
	$output               .= '<div class="constellation-wrapper" ' . implode( ' ', $constellation_atts ) . '><canvas></div>';
}

$output .= $col_begin_wrapper;
$output .= wpb_js_remove_wpautop( $content );
$output .= $col_end_wrapper;

if ( $separator_type !== '' ) {
	$separator_classes = 'vc_row-separator';
	$separator_classes .= " $separator_type";
	$separator_classes .= " $separator_position";
	$output            .= '<div class="' . $separator_classes . '">' . Brook_VC::get_separator_svg( $separator_type ) . '</div>';
}

$output .= '</div>';
$output .= $after_output;

Brook_Helper::e( $row_begin_wrap );

echo '' . $output;

Brook_Helper::e( $row_end_wrap );
