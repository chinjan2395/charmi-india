<?php
defined( 'ABSPATH' ) || exit;

class Brook_Image {

	public static function get_attachment_info( $attachment_id ) {
		$attachment     = get_post( $attachment_id );
		$attachment_url = wp_get_attachment_url( $attachment_id );

		if ( $attachment === null ) {
			return false;
		}

		return array(
			'alt'         => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
			'caption'     => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'href'        => get_permalink( $attachment->ID ),
			'src'         => $attachment_url,
			'title'       => $attachment->post_title,
		);
	}

	public static function aq_resize( $args = array() ) {
		$defaults = array(
			'url'     => '',
			'width'   => null,
			'height'  => null,
			'crop'    => true,
			'single'  => true,
			'upscale' => false,
			'echo'    => false,
		);

		$args  = wp_parse_args( $args, $defaults );
		$image = aq_resize( $args['url'], $args['width'], $args['height'], $args['crop'], $args['single'], $args['upscale'] );

		if ( $image === false ) {
			$image = $args['url'];
		}

		return $image;
	}

	public static function get_lazy_load_image( $args = array() ) {
		$defaults = array(
			'url'         => '',
			'width'       => null,
			'height'      => null,
			'crop'        => true,
			'single'      => true,
			'upscale'     => false,
			'echo'        => false,
			'placeholder' => '',
			'src'         => '',
			'alt'         => '',
			'class'       => '',
			'full_size'   => false,
		);

		$args = wp_parse_args( $args, $defaults );

		if ( ! isset( $args['lazy'] ) ) {
			$lazy_load_enable = Brook::setting( 'lazy_image_enable' );

			if ( $lazy_load_enable ) {
				$args['lazy'] = true;
			} else {
				$args['lazy'] = false;
			}
		}

		$image      = false;
		$attributes = array();

		if ( $args['full_size'] === false ) {
			$image = aq_resize( $args['url'], $args['width'], $args['height'], $args['crop'], $args['single'], $args['upscale'] );
		}

		if ( $image === false ) {
			$image = $args['url'];
		}

		$output   = '';
		$_classes = $args['class'];

		if ( $args['lazy'] === true ) {
			if ( $args['full_size'] === false ) {
				$placeholder_w = round( $args['width'] / 10 );
				$placeholder_h = $args['height'];

				if ( $args['height'] !== 9999 ) {
					$placeholder_h = round( $args['height'] / 10 );
				}
			} else {
				$placeholder_w = 50;
				$placeholder_h = 9999;
				$args['crop']  = false;
			}

			$placeholder_image = aq_resize( $image, $placeholder_w, $placeholder_h, $args['crop'], $args['single'], $args['upscale'] );

			$attributes[] = 'src="' . $placeholder_image . '"';
			$attributes[] = 'data-src="' . $image . '"';

			if ( $args['width'] !== '' && $args['width'] !== null ) {
				$attributes[] = 'width="' . $args['width'] . '"';
			}

			if ( $args['height'] !== '' && $args['height'] !== null && $args['height'] !== 9999 ) {
				$attributes[] = 'height="' . $args['height'] . '"';
			}

			$_classes .= ' tm-lazy-load';
		} else {
			$attributes[] = 'src="' . $image . '"';
		}

		$attributes[] = 'alt="' . $args['alt'] . '"';

		if ( $_classes !== '' ) {
			$attributes[] = 'class="' . $_classes . '"';
		}

		$output .= '<img ' . implode( ' ', $attributes ) . ' />';

		if ( $args['echo'] === true ) {
			echo '' . $output;
		} else {
			return $output;
		}
	}

	public static function get_the_post_thumbnail( $args = array() ) {
		$url = self::get_the_post_thumbnail_url( $args );

		$attrs = array();

		if ( isset( $args['class'] ) && $args['class'] !== '' ) {
			$attrs[] = 'class="' . $args['class'] . '"';
		}

		$image = '<img src="' . esc_url( $url ) . '" alt="' . the_title_attribute( array( 'echo' => false ) ) . '" ' . implode( ' ', $attrs ) . ' />';

		if ( isset( $args['caption_enable'] ) && $args['caption_enable'] === true ) {
			$caption = get_the_post_thumbnail_caption();

			if ( $caption !== '' ) {
				$before = '<figure>';
				$after  = '<figcaption class="wp-caption-text gallery-caption">' . $caption . '</figcaption></figure>';

				$image = $before . $image . $after;
			}
		}

		return $image;
	}

	public static function the_post_thumbnail( $args = array() ) {
		$image = self::get_the_post_thumbnail( $args );

		echo "{$image}";
	}

	public static function get_the_post_thumbnail_url( $args = array() ) {
		$defaults = array(
			'size'   => 'full',
			'width'  => '',
			'height' => '',
			'crop'   => true,
		);

		$args = wp_parse_args( $args, $defaults );

		$url = get_the_post_thumbnail_url( null, 'full' );

		$url = self::get_image_cropped_url( $url, $args );

		return $url;
	}

	public static function the_post_thumbnail_url( $args = array() ) {
		$url = self::get_the_post_thumbnail_url( $args );

		echo esc_url( $url );
	}

	public static function get_attachment_by_id( $args = array() ) {
		$defaults = array(
			'id'     => '',
			'size'   => 'full',
			'width'  => '',
			'height' => '',
			'crop'   => true,
			'class'  => '',
		);

		$args = wp_parse_args( $args, $defaults );

		$image_full = self::get_attachment_info( $args['id'] );

		if ( $image_full === false ) {
			return false;
		}

		$url = $image_full['src'];
		$url = self::get_image_cropped_url( $url, $args );

		$alt = $image_full['alt'] !== '' ? $image_full['alt'] : $image_full['title'];

		$attrs = array();

		if ( isset( $args['class'] ) && $args['class'] !== '' ) {
			$attrs[] = 'class="' . $args['class'] . '"';
		}

		$image = '<img src="' . esc_url( $url ) . '" alt="' . $alt . '"' . implode( ' ', $attrs ) . ' />';

		if ( isset( $args['caption_enable'] ) && $args['caption_enable'] === true ) {
			$caption = wp_get_attachment_caption( $args['id'] );

			if ( $caption !== false && $caption !== '' ) {
				$before = '<figure>';
				$after  = '<figcaption class="wp-caption-text gallery-caption">' . $caption . '</figcaption></figure>';

				$image = $before . $image . $after;
			}
		}

		return $image;
	}

	public static function the_attachment_by_id( $args = array() ) {
		$attachment = self::get_attachment_by_id( $args );

		echo "{$attachment}";
	}

	public static function get_attachment_url_by_id( $args = array() ) {
		$id = $size = $width = $height = $crop = '';

		$defaults = array(
			'id'     => '',
			'size'   => 'full',
			'width'  => '',
			'height' => '',
			'crop'   => true,
		);

		$args = wp_parse_args( $args, $defaults );
		extract( $args );

		if ( $id === '' ) {
			return '';
		}

		$url = wp_get_attachment_image_url( $id, 'full' );

		$url = self::get_image_cropped_url( $url, $args );

		return $url;
	}

	public static function the_attachment_url_by_id( $args = array() ) {
		$url = self::get_attachment_url_by_id( $args );

		echo esc_url( $url );
	}

	public static function get_image_cropped_url( $url, $args = array() ) {
		extract( $args );

		if ( $url === false ) {
			return '';
		}

		if ( 'full' === $size || '' === $size ) {
			return $url;
		}

		if ( $size !== 'custom' ) {
			$_sizes = explode( 'x', $size );
			$width  = $_sizes[0];
			$height = $_sizes[1];
		}

		if ( $width !== '' && $height !== '' ) {
			$crop_url = aq_resize( $url, $width, $height, $crop );

			if ( $crop_url !== false ) {
				$url = $crop_url;
			}
		}

		return $url;
	}
}
