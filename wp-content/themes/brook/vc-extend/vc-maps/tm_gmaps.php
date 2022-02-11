<?php

class WPBakeryShortCode_TM_Gmaps extends WPBakeryShortCode {

	public function convertAttributesToNewMarker( $atts ) {
		if ( isset( $atts['markers'] ) && strlen( $atts['markers'] ) > 0 ) {
			$markers = vc_param_group_parse_atts( $atts['markers'] );

			if ( ! is_array( $markers ) ) {
				$temp         = explode( ',', $atts['markers'] );
				$paramMarkers = array();

				foreach ( $temp as $marker ) {
					$data = explode( '|', $marker );

					$newMarker            = array();
					$newMarker['address'] = isset( $data[0] ) ? $data[0] : '';
					$newMarker['icon']    = isset( $data[1] ) ? $data[1] : '';
					$newMarker['title']   = isset( $data[2] ) ? $data[2] : '';
					$newMarker['info']    = isset( $data[3] ) ? $data[3] : '';

					$paramMarkers[] = $newMarker;
				}

				$atts['markers'] = urlencode( json_encode( $paramMarkers ) );

			}

			return $atts;
		}
	}
}

vc_map( array(
	'name'     => esc_html__( 'Google Maps', 'brook' ),
	'base'     => 'tm_gmaps',
	'icon'     => 'insight-i insight-i-map',
	'category' => BROOK_VC_SHORTCODE_CATEGORY,
	'params'   => array(
		array(
			'heading'     => esc_html__( 'Height', 'brook' ),
			'description' => esc_html__( 'Enter map height (in pixels or %)', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'map_height',
			'value'       => '480',
		),
		array(
			'heading'     => esc_html__( 'Width', 'brook' ),
			'description' => esc_html__( 'Enter map width (in pixels or %)', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'map_width',
			'value'       => '100%',
		),
		array(
			'heading'    => esc_html__( 'Button', 'brook' ),
			'type'       => 'vc_link',
			'param_name' => 'button',
			'value'      => esc_html__( 'Button', 'brook' ),
		),
		array(
			'heading'     => esc_html__( 'Zoom Level', 'brook' ),
			'description' => esc_html__( 'Map zoom level', 'brook' ),
			'type'        => 'number',
			'param_name'  => 'zoom',
			'value'       => 16,
			'max'         => 17,
			'min'         => 0,
		),
		array(
			'type'       => 'checkbox',
			'param_name' => 'zoom_enable',
			'value'      => array(
				esc_html__( 'Enable mouse scroll wheel zoom', 'brook' ) => 'yes',
			),
		),
		array(
			'heading'     => esc_html__( 'Map Type', 'brook' ),
			'description' => esc_html__( 'Choose a map type', 'brook' ),
			'type'        => 'dropdown',
			'admin_label' => true,
			'param_name'  => 'map_type',
			'value'       => array(
				esc_html__( 'Roadmap', 'brook' )   => 'roadmap',
				esc_html__( 'Satellite', 'brook' ) => 'satellite',
				esc_html__( 'Hybrid', 'brook' )    => 'hybrid',
				esc_html__( 'Terrain', 'brook' )   => 'terrain',
			),
		),
		array(
			'heading'     => esc_html__( 'Map Style', 'brook' ),
			'description' => esc_html__( 'Choose a map style. This approach changes the style of the Roadmap types (base imagery in terrain and satellite views is not affected, but roads, labels, etc. respect styling rules)', 'brook' ),
			'type'        => 'image_radio',
			'admin_label' => true,
			'param_name'  => 'map_style',
			'value'       => array(
				'no_label_bright_colors'  => array(
					'url'   => BROOK_THEME_IMAGE_URI . '/maps/no-label-bright-colors.jpg',
					'title' => esc_attr__( 'No Label Bright Colors', 'brook' ),
				),
				'grayscale'               => array(
					'url'   => BROOK_THEME_IMAGE_URI . '/maps/greyscale.png',
					'title' => esc_attr__( 'Grayscale', 'brook' ),
				),
				'subtle_grayscale'        => array(
					'url'   => BROOK_THEME_IMAGE_URI . '/maps/subtle-grayscale.png',
					'title' => esc_attr__( 'Subtle Grayscale', 'brook' ),
				),
				'apple_paps_esque'        => array(
					'url'   => BROOK_THEME_IMAGE_URI . '/maps/apple-maps-esque.png',
					'title' => esc_attr__( 'Apple Maps-esque', 'brook' ),
				),
				'pale_dawn'               => array(
					'url'   => BROOK_THEME_IMAGE_URI . '/maps/pale-dawn.png',
					'title' => esc_attr__( 'Pale Dawn', 'brook' ),
				),
				'midnight_commander'      => array(
					'url'   => BROOK_THEME_IMAGE_URI . '/maps/midnight-commander.png',
					'title' => esc_attr__( 'Midnight Commander', 'brook' ),
				),
				'blue_water'              => array(
					'url'   => BROOK_THEME_IMAGE_URI . '/maps/blue-water.png',
					'title' => esc_attr__( 'Blue Water', 'brook' ),
				),
				'retro'                   => array(
					'url'   => BROOK_THEME_IMAGE_URI . '/maps/retro.png',
					'title' => esc_attr__( 'Retro', 'brook' ),
				),
				'paper'                   => array(
					'url'   => BROOK_THEME_IMAGE_URI . '/maps/paper.png',
					'title' => esc_attr__( 'Paper', 'brook' ),
				),
				'ultra_light_with_labels' => array(
					'url'   => BROOK_THEME_IMAGE_URI . '/maps/ultra-light-with-labels.png',
					'title' => esc_attr__( 'Ultra Light with Labels', 'brook' ),
				),
				'shades_of_grey'          => array(
					'url'   => BROOK_THEME_IMAGE_URI . '/maps/shades-of-grey.png',
					'title' => esc_attr__( 'Shades Of Grey', 'brook' ),
				),
				'easy_light'              => array(
					'url'   => BROOK_THEME_IMAGE_URI . '/maps/easy-light.jpg',
					'title' => esc_attr__( 'Ease Light', 'brook' ),
				),
			),
			'std'         => 'ultra_light_with_labels',
		),
		array(
			'heading'    => esc_html__( 'Overlay Style', 'brook' ),
			'type'       => 'dropdown',
			'param_name' => 'overlay_style',
			'value'      => array(
				esc_html__( 'Style 01', 'brook' ) => '01',
			),
			'std'        => '01',
		),
		array(
			'group'       => esc_html__( 'Markers', 'brook' ),
			'heading'     => esc_html__( 'Markers', 'brook' ),
			'description' => esc_html__( 'You can add multiple markers to the map', 'brook' ),
			'type'        => 'param_group',
			'param_name'  => 'markers',
			'value'       => urlencode( json_encode( array(
				array(
					'address' => '40.7590615,-73.969231',
				),
			) ) ),
			'params'      => array(
				array(
					'heading'     => esc_html__( 'Address or Coordinate', 'brook' ),
					'description' => sprintf( wp_kses( __( 'Enter address or coordinate. Find coordinates using the name and/or address of the place using <a href="%s" target="_blank">this simple tool here.</a>', 'brook' ), array(
						'a' => array(
							'href'   => array(),
							'target' => array(),
						),
					) ), esc_url( 'https://universimmedia.pagesperso-orange.fr/geo/loc.htm' ) ),
					'type'        => 'textfield',
					'param_name'  => 'address',
					'admin_label' => true,
				),
				array(
					'heading'    => esc_html__( 'Overlay Style', 'brook' ),
					'type'       => 'dropdown',
					'param_name' => 'overlay_style',
					'value'      => array(
						esc_html__( 'Signal', 'brook' )          => 'signal',
						esc_html__( 'Signal and Info', 'brook' ) => 'signal-info',
						esc_html__( 'Fixed Info', 'brook' )      => 'fixed-info',
					),
					'std'        => '01',
				),
				array(
					'heading'    => esc_html__( 'Marker Title', 'brook' ),
					'type'       => 'textfield',
					'param_name' => 'title',
				),
				array(
					'heading'     => esc_html__( 'Marker Information', 'brook' ),
					'description' => esc_html__( 'Content for info window', 'brook' ),
					'type'        => 'textarea',
					'param_name'  => 'info',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Google Maps API Key (optional)', 'brook' ),
			'description' => sprintf( wp_kses( __( 'Follow <a href="%s" target="_blank">this link</a> and click <strong>GET A KEY</strong> button. If you leave it empty, the API Key will be put in by default from our key.', 'brook' ), array(
				'a'      => array(
					'href'   => array(),
					'target' => array(),
				),
				'strong' => array(),
			) ), esc_url( 'https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key' ) ),
			'type'        => 'textfield',
			'param_name'  => 'api_key',
		),
	),
) );
