<?php
defined( 'ABSPATH' ) || exit;

/**
 * Custom template tags for this theme.
 */
class Brook_Templates {

	public static function pre_loader() {
		if ( Brook::setting( 'pre_loader_enable' ) !== '1' ) {
			return;
		}

		$style = Brook::setting( 'pre_loader_style' );

		if ( $style === 'random' ) {
			$style = array_rand( Brook_Helper::$preloader_style );
		}
		?>

		<div id="page-preloader" class="page-loading clearfix">
			<div class="page-load-inner">
				<div class="preloader-wrap">
					<div class="wrap-2">
						<?php get_template_part( 'components/preloader/style', $style ); ?>
					</div>
				</div>
			</div>
		</div>

		<?php
	}

	public static function top_bar() {
		$type = Brook_Global::instance()->get_top_bar_type();

		if ( $type !== 'none' ) {
			get_template_part( 'components/top-bars/top-bar', $type );
		}
	}

	public static function top_bar_button( $type = '01' ) {
		$button_text        = Brook::setting( "top_bar_style_{$type}_button_text" );
		$button_link        = Brook::setting( "top_bar_style_{$type}_button_link" );
		$button_link_target = Brook::setting( "top_bar_style_{$type}_button_link_target" );
		$button_classes     = 'top-bar-button';
		?>
		<?php if ( $button_link !== '' && $button_text !== '' ) : ?>
			<a class="<?php echo esc_attr( $button_classes ); ?>"
			   href="<?php echo esc_url( $button_link ); ?>"
				<?php if ( $button_link_target === '1' ) : ?>
					target="_blank"
				<?php endif; ?>
			>
				<?php echo esc_html( $button_text ); ?>
			</a>
		<?php endif;
	}

	public static function top_bar_info() {
		$type = Brook_Global::instance()->get_top_bar_type();
		$info = Brook::setting( "top_bar_style_{$type}_info" );

		if ( ! empty( $info ) ) {
			?>
			<ul class="top-bar-info">
				<?php
				foreach ( $info as $item ) {
					$url  = isset( $item['url'] ) ? $item['url'] : '';
					$icon = isset( $item['icon_class'] ) ? $item['icon_class'] : '';
					$text = isset( $item['text'] ) ? $item['text'] : '';
					?>
					<li class="info-item">
						<?php if ( $url !== '' ) : ?>
						<a href="<?php echo esc_url( $url ); ?>" class="info-link">
							<?php endif; ?>

							<?php if ( $icon !== '' ) : ?>
								<i class="info-icon <?php echo esc_attr( $icon ); ?>"></i>
							<?php endif; ?>

							<?php echo '<span class="info-text">' . $text . '</span>'; ?>

							<?php if ( $url !== '' ) : ?>
						</a>
					<?php endif; ?>
					</li>
				<?php } ?>
			</ul>
			<?php
		}
	}

	public static function top_bar_social_networks() {
		$type   = Brook_Global::instance()->get_top_bar_type();
		$enable = Brook::setting( "top_bar_style_{$type}_social_networks_enable" );

		if ( $enable !== '1' ) {
			return;
		}
		?>
		<div class="top-bar-social-network">
			<?php Brook_Templates::social_icons( array(
				'display'        => 'icon',
				'tooltip_enable' => false,
			) ); ?>
		</div>
		<?php
	}

	public static function header() {
		$type = Brook_Global::instance()->get_header_type();

		if ( $type === 'none' ) {
			return;
		}

		get_template_part( 'components/headers/header', $type );
	}

	public static function header_info_slider( $args = array() ) {
		$header_type = Brook_Global::instance()->get_header_type();

		$info = Brook::setting( "header_style_{$header_type}_info" );
		if ( empty( $info ) ) {
			return;
		}

		$defaults = array(
			'lg_items' => 3,
			'gutter'   => 30,
		);
		$args     = wp_parse_args( $args, $defaults );
		?>
		<div class="header-info">
			<div class="tm-swiper"
			     data-lg-items="<?php echo esc_attr( $args['lg_items'] ); ?>"
			     data-md-items="2"
			     data-sm-items="1"
			     data-lg-gutter="<?php echo esc_attr( $args['gutter'] ); ?>"
			     data-loop="1"
			     data-autoplay="4000"
			>
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<?php foreach ( $info as $item ) { ?>
							<div class="swiper-slide">
								<div class="info-item">
									<?php if ( isset( $item['icon_class'] ) && $item['icon_class'] !== '' ) : ?>
										<div class="info-icon">
											<span class="<?php echo esc_attr( $item['icon_class'] ); ?>"></span>
										</div>
									<?php endif; ?>

									<div class="info-content">
										<?php if ( isset( $item['title'] ) && $item['title'] !== '' ) : ?>
											<?php echo '<h6 class="info-title">' . $item['title'] . '</h6>'; ?>
										<?php endif; ?>

										<?php if ( isset( $item['sub_title'] ) && $item['sub_title'] !== '' ) : ?>
											<?php echo '<div class="info-sub-title">' . $item['sub_title'] . '</div>'; ?>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	public static function header_search_button() {
		$header_type = Brook_Global::instance()->get_header_type();

		$enabled = Brook::setting( "header_style_{$header_type}_search_enable" );

		if ( '1' === $enabled ) {
			?>
			<div class="popup-search-wrap">
				<a href="javascript:void(0)" id="btn-open-popup-search" class="btn-open-popup-search"><i
						class="fa fa-search"></i></a>
			</div>
			<?php
		}
	}

	public static function header_search_form() {
		$header_type = Brook_Global::instance()->get_header_type();

		$enabled = Brook::setting( "header_style_{$header_type}_search_enable" );

		if ( '1' === $enabled ) {
			?>
			<div class="popup-search-wrap">
				<?php get_search_form(); ?>
			</div>
			<?php
		}
	}

	public static function header_button( $args = array() ) {
		$header_type = Brook_Global::instance()->get_header_type();

		$button_text        = Brook::setting( "header_style_{$header_type}_button_text" );
		$button_link        = Brook::setting( "header_style_{$header_type}_button_link" );
		$button_class       = Brook::setting( "header_style_{$header_type}_button_class" );
		$button_link_target = Brook::setting( "header_style_{$header_type}_button_link_target" );
		$button_classes     = 'tm-button';

		$icon_class = Brook::setting( "header_style_{$header_type}_button_icon" );
		$icon_align = 'right';

		if ( $icon_class !== '' ) {
			$button_classes .= ' has-icon icon-right';
		}

		$defaults = array(
			'extra_class'          => '',
			'style'                => '',
			'except_sticky_button' => false,
		);

		$args = wp_parse_args( $args, $defaults );

		if ( $args['extra_class'] !== '' ) {
			$button_classes .= " {$args['extra_class']}";
		}

		if ( $button_class !== '' ) {
			$button_classes .= " {$button_class}";
		}

		if ( $args['style'] !== '' ) {
			$button_classes .= " style-{$args['style']}";
		} else {
			$button_classes .= ' style-flat';
		}

		$header_button_classes = $button_classes . ' tm-button-nm header-on-top-button';
		$sticky_button_classes = $button_classes . ' tm-button-sm header-sticky-button';
		?>
		<?php if ( $button_link !== '' && $button_text !== '' ) : ?>
			<div class="header-button">
				<a class="<?php echo esc_attr( $header_button_classes ); ?>"
				   href="<?php echo esc_url( $button_link ); ?>"
					<?php if ( $button_link_target === '1' ) : ?>
						target="_blank"
					<?php endif; ?>
				>

					<?php if ( $args['style'] === 'border-animate' ) : ?>
						<div class="border-animate">
							<div class="top"></div>
							<div class="right"></div>
							<div class="bottom"></div>
							<div class="left"></div>
						</div>
					<?php endif; ?>

					<?php if ( $args['style'] === 'text-arrow' ) : ?>
						<div class="the-arrow -left">
							<span class="shaft"></span>
						</div>
					<?php endif; ?>

					<span class="button-text" data-text="<?php echo esc_attr( $button_text ); ?>">
						<?php echo esc_html( $button_text ); ?>
					</span>

					<?php if ( $icon_class !== '' && $icon_align === 'right' ) { ?>
						<span class="button-icon">
							<i class="<?php echo esc_attr( $icon_class ); ?>"></i>
						</span>
					<?php } ?>

					<?php if ( $args['style'] === 'text-arrow' ) : ?>
						<div class="the-arrow -right">
							<span class="shaft"></span>
						</div>
					<?php endif; ?>
				</a>
				<?php if ( false === $args['except_sticky_button'] ) : ?>
					<a class="<?php echo esc_attr( $sticky_button_classes ); ?>"
					   href="<?php echo esc_url( $button_link ); ?>"
						<?php if ( $button_link_target === '1' ) : ?>
							target="_blank"
						<?php endif; ?>
					>

						<?php if ( $args['style'] === 'border-animate' ) : ?>
							<div class="border-animate">
								<div class="top"></div>
								<div class="right"></div>
								<div class="bottom"></div>
								<div class="left"></div>
							</div>
						<?php endif; ?>

						<?php if ( $args['style'] === 'text-arrow' ) : ?>
							<div class="the-arrow -left">
								<span class="shaft"></span>
							</div>
						<?php endif; ?>

						<span class="button-text" data-text="<?php echo esc_attr( $button_text ); ?>">
						<?php echo esc_html( $button_text ); ?>
					</span>

						<?php if ( $icon_class !== '' && $icon_align === 'right' ) { ?>
							<span class="button-icon">
							<i class="<?php echo esc_attr( $icon_class ); ?>"></i>
						</span>
						<?php } ?>

						<?php if ( $args['style'] === 'text-arrow' ) : ?>
							<div class="the-arrow -right">
								<span class="shaft"></span>
							</div>
						<?php endif; ?>
					</a>
				<?php endif; ?>
			</div>
		<?php endif;
	}

	public static function header_open_mobile_menu_button() {
		?>
		<div id="page-open-mobile-menu" class="page-open-mobile-menu">
			<div class="inner">
				<div class="icon"><i></i></div>
			</div>
		</div>
		<?php
	}

	public static function header_open_canvas_menu_button( $args = array() ) {
		$defaults = array(
			'class' => '',
			'style' => '01',
		);
		$args     = wp_parse_args( $args, $defaults );

		$classes = "page-open-main-menu style-{$args['style']}";

		if ( $args['class'] !== '' ) {
			$classes .= " {$args['class']}";
		}

		?>
		<div id="page-open-main-menu" class="<?php echo esc_attr( $classes ); ?>">
			<?php
			$menu_title = Brook::setting( 'navigation_minimal_01_menu_title' );

			if ( $menu_title !== '' ) {
				?>
				<h6 class="page-open-main-menu-title"><?php echo esc_html( $menu_title ); ?></h6>
				<?php
			}
			?>
			<div><i></i></div>
		</div>
		<?php
	}

	public static function header_social_networks( $args = array() ) {
		$header_type = Brook_Global::instance()->get_header_type();

		$social_enable = Brook::setting( "header_style_{$header_type}_social_networks_enable" );
		?>
		<?php if ( $social_enable === '1' ) : ?>
			<div class="header-social-networks">
				<div class="inner">
					<?php

					$defaults = array(
						'tooltip_position' => 'top',
					);

					$args = wp_parse_args( $args, $defaults );

					self::social_icons( $args );
					?>
				</div>
			</div>
		<?php endif; ?>
		<?php
	}

	public static function header_widgets() {
		$header_type = Brook_Global::instance()->get_header_type();

		$enabled = Brook::setting( "header_style_{$header_type}_widgets_enable" );
		if ( '1' === $enabled ) {
			?>
			<div class="header-widgets">
				<?php Brook_Templates::generated_sidebar( 'header_widgets' ); ?>
			</div>
			<?php
		}
	}

	public static function header_text() {
		$type = Brook_Global::instance()->get_header_type();

		$text = Brook::setting( "header_style_{$type}_text" );
		?>
		<?php if ( $text !== '' ) : ?>
			<div class="header-text">
				<?php echo wp_kses( $text, 'brook-default' ); ?>
			</div>
		<?php endif; ?>
		<?php
	}


	public static function header_language_switcher() {
		$header_type = Brook_Global::instance()->get_header_type();
		$enabled     = Brook::setting( "header_style_{$header_type}_language_switcher_enable" );

		if ( $enabled !== '1' ) {
			return;
		}
		?>
		<div id="switcher-language-wrapper" class="switcher-language-wrapper">
			<?php
			// WPML plugin.
			if ( defined( 'ICL_SITEPRESS_VERSION' ) ) :

				do_action( 'wpml_add_language_selector' );

			// Polylang plugin.
			elseif ( function_exists( 'pll_the_languages' ) ):

				$pll_args = array(
					'dropdown' => 1,
				);

				$pll_args = apply_filters( 'brook_pll_languages_args', $pll_args );

				pll_the_languages( $pll_args );

			endif;
			?>
		</div>
		<?php
	}

	public static function slider( $template_position ) {
		$slider          = Brook_Global::instance()->get_slider_alias();
		$slider_position = Brook_Global::instance()->get_slider_position();

		if ( ! function_exists( 'rev_slider_shortcode' ) || $slider === '' || $slider_position !== $template_position ) {
			return;
		}

		?>
		<div id="page-slider" class="page-slider">
			<?php echo do_shortcode( '[rev_slider ' . $slider . ']' ); ?>
		</div>
		<?php
	}

	public static function title_bar() {
		$type = Brook_Global::instance()->get_title_bar_type();

		if ( $type === 'none' ) {
			return;
		}

		get_template_part( 'components/title-bars/title-bar', $type );
	}

	public static function get_title_bar_title() {
		$title = Brook_Helper::get_post_meta( 'page_title_bar_custom_heading', '' );

		if ( $title === '' ) {
			if ( is_category() || is_tax() ) {
				$title = Brook::setting( 'title_bar_archive_category_title' ) . single_cat_title( '', false );
			} elseif ( is_home() ) {
				$title = Brook::setting( 'title_bar_home_title' ) . single_tag_title( '', false );
			} elseif ( is_tag() ) {
				$title = Brook::setting( 'title_bar_archive_tag_title' ) . single_tag_title( '', false );
			} elseif ( is_author() ) {
				$title = Brook::setting( 'title_bar_archive_author_title' ) . '<span class="vcard">' . get_the_author() . '</span>';
			} elseif ( is_year() ) {
				$title = Brook::setting( 'title_bar_archive_year_title' ) . get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'brook' ) );
			} elseif ( is_month() ) {
				$title = Brook::setting( 'title_bar_archive_month_title' ) . get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'brook' ) );
			} elseif ( is_day() ) {
				$title = Brook::setting( 'title_bar_archive_day_title' ) . get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'brook' ) );
			} elseif ( is_post_type_archive() ) {
				if ( function_exists( 'is_shop' ) && is_shop() ) {
					$title = esc_html__( 'Shop', 'brook' );
				} else {
					$title = sprintf( esc_html__( 'Archives: %s', 'brook' ), post_type_archive_title( '', false ) );
				}
			} elseif ( is_search() ) {
				$title = Brook::setting( 'title_bar_search_title' ) . '"' . get_search_query() . '"';
			} elseif ( is_singular( 'post' ) ) {
				$title = Brook::setting( 'title_bar_single_blog_title' );
				if ( $title === '' ) {
					$title = get_the_title();
				}
			} elseif ( is_singular( 'portfolio' ) ) {
				$title = Brook::setting( 'title_bar_single_portfolio_title' );
				if ( $title === '' ) {
					$title = get_the_title();
				}
			} elseif ( is_singular( 'product' ) ) {
				$title = Brook::setting( 'title_bar_single_product_title' );
				if ( $title === '' ) {
					$title = get_the_title();
				}
			} else {
				$title = get_the_title();
			}
		}

		?>
		<div class="page-title-bar-heading">
			<h1 class="heading">
				<?php echo wp_kses( $title, array(
					'span' => array(
						'class' => array(),
					),
				) ); ?>
			</h1>
		</div>
		<?php
	}

	public static function paging_nav( $query = false ) {
		global $wp_query, $wp_rewrite;
		if ( $query === false ) {
			$query = $wp_query;
		}

		// Don't print empty markup if there's only one page.
		if ( $query->max_num_pages < 2 ) {
			return;
		}

		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}

		$page_num_link = html_entity_decode( get_pagenum_link() );
		$query_args    = array();
		$url_parts     = explode( '?', $page_num_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$page_num_link = esc_url( remove_query_arg( array_keys( $query_args ), $page_num_link ) );
		$page_num_link = trailingslashit( $page_num_link ) . '%_%';

		$format = '';
		if ( $wp_rewrite->using_index_permalinks() && ! strpos( $page_num_link, 'index.php' ) ) {
			$format = 'index.php/';
		}
		if ( $wp_rewrite->using_permalinks() ) {
			$format .= user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' );
		} else {
			$format .= '?paged=%#%';
		}

		// Set up paginated links.

		$args  = array(
			'base'      => $page_num_link,
			'format'    => $format,
			'total'     => $query->max_num_pages,
			'current'   => max( 1, $paged ),
			'mid_size'  => 1,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => '<i class="fa fa-angle-left"></i>',
			'next_text' => '<i class="fa fa-angle-right"></i>',
			'type'      => 'array',
		);
		$pages = paginate_links( $args );

		if ( is_array( $pages ) ) {
			echo '<ul class="page-pagination">';
			foreach ( $pages as $page ) {
				printf( '<li>%s</li>', $page );
			}
			echo '</ul>';
		}
	}

	public static function page_links() {
		wp_link_pages( array(
			'before'           => '<div class="page-links">',
			'after'            => '</div>',
			'link_before'      => '<span>',
			'link_after'       => '</span>',
			'nextpagelink'     => esc_html__( 'Next', 'brook' ),
			'previouspagelink' => esc_html__( 'Prev', 'brook' ),
		) );
	}

	public static function post_nav_links() {
		$args = array(
			'prev_text'          => '%title',
			'next_text'          => '%title',
			'in_same_term'       => false,
			'excluded_terms'     => '',
			'taxonomy'           => 'category',
			'screen_reader_text' => esc_html__( 'Post navigation', 'brook' ),
		);

		$previous = get_previous_post_link( '%link', $args['prev_text'], $args['in_same_term'], $args['excluded_terms'], $args['taxonomy'] );
		$previous = str_replace( 'rel="prev">', 'rel="prev">' . '<div><span class="fa fa-arrow-left"></span>' . esc_html__( 'Prev', 'brook' ) . '</div>', $previous );

		$next = get_next_post_link( '%link', $args['next_text'], $args['in_same_term'], $args['excluded_terms'], $args['taxonomy'] );
		$next = str_replace( 'rel="next">', 'rel="next">' . '<div>' . esc_html__( 'Next', 'brook' ) . '<span class="fa fa-arrow-right"></span></div>', $next );

		// Only add markup if there's somewhere to navigate to.
		if ( $previous || $next ) { ?>

			<nav class="navigation post-navigation" role="navigation">
				<?php echo '<h2 class="screen-reader-text">' . $args['screen_reader_text'] . '</h2>'; ?>

				<div class="nav-links">
					<?php echo '<div class="previous nav-item">' . $previous . '</div>'; ?>

					<?php echo '<div class="next nav-item">' . $next . '</div>'; ?>
				</div>
			</nav>
			<?php
		}
	}

	public static function post_nav_next_link() {
		next_post_link(
			'%link',
			'<div class="nav-desc">' . esc_html__( 'Next', 'brook' ) . '</div>
			<div class="nav-post-title">%title</div>
			<span class="nav-icon fa fa-arrow-right"></span>'
		);
	}

	public static function comment_navigation( $args = array() ) {
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
			$defaults = array(
				'container_id'    => '',
				'container_class' => 'navigation comment-navigation',
			);
			$args     = wp_parse_args( $args, $defaults );
			?>
			<nav id="<?php echo esc_attr( $args['container_id'] ); ?>"
			     class="<?php echo esc_attr( $args['container_class'] ); ?>">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'brook' ); ?></h2>

				<div class="comment-nav-links">
					<?php paginate_comments_links( array(
						'prev_text' => esc_html__( 'Prev', 'brook' ),
						'next_text' => esc_html__( 'Next', 'brook' ),
						'type'      => 'list',
					) ); ?>
				</div>
			</nav>
			<?php
		}
		?>
		<?php
	}

	public static function comment_template( $comment, $args, $depth ) {

		$GLOBALS['comment'] = $comment;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
			</div>
			<div class="comment-content">
				<div class="comment-header">
					<?php
					printf( '<h6 class="fn">%s</h6>', get_comment_author_link() );
					?>
				</div>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-messages"><?php esc_html_e( 'Your comment is awaiting moderation.', 'brook' ) ?></em>
					<br/>
				<?php endif; ?>
				<div class="comment-text"><?php comment_text(); ?></div>
				<div class="comment-footer">
					<div class="comment-datetime">
						<?php echo get_comment_date() . ' ' . esc_html__( 'at', 'brook' ) . ' ' . get_comment_time(); ?>
					</div>

					<div class="comment-actions">
						<?php comment_reply_link( array_merge( $args, array(
							'depth'      => $depth,
							'max_depth'  => $args['max_depth'],
							'reply_text' => esc_html__( 'Reply', 'brook' ),
						) ) ); ?>
						<?php edit_comment_link( '' . esc_html__( 'Edit', 'brook' ) ); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	public static function comment_form() {
		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$aria_req  = '';
		if ( $req ) {
			$aria_req = " aria-required='true'";
		}

		$fields = array(
			'author' => '<div class="row"><div class="col-sm-12 comment-form-author"><input id="author" placeholder="' . esc_attr__( 'Your Name *', 'brook' ) . '" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" ' . $aria_req . '/></div>',
			'email'  => '<div class="col-sm-12 comment-form-email"><input id="email" placeholder="' . esc_attr__( 'Your Email *', 'brook' ) . '" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" ' . $aria_req . '/></div>',
			'url'    => '<div class="col-sm-12 comment-form-url"><input id="url" placeholder="' . esc_attr__( 'Website', 'brook' ) . '" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" ' . $aria_req . '/></div></div>',
		);

		$comment_field = '<div class="row"><div class="col-md-12 comment-form-comment"><textarea id="comment" placeholder="' . esc_attr__( 'Your Comment', 'brook' ) . '" name="comment" aria-required="true"></textarea></div></div>';

		$comments_args = array(
			'label_submit'        => esc_html__( 'Post Comment', 'brook' ),
			'title_reply'         => esc_html__( 'Leave A Comment', 'brook' ),
			'comment_notes_after' => '',
			'fields'              => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'       => $comment_field,
		);
		comment_form( $comments_args );
	}

	public static function post_author() {
		?>
		<div class="entry-author">
			<div class="author-info">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'email' ), '108' ); ?>
				</div>
				<div class="author-description">
					<h5 class="author-name"><?php the_author(); ?></h5>

					<div class="author-biographical-info">
						<?php the_author_meta( 'description' ); ?>
					</div>

					<?php
					$email_address = get_the_author_meta( 'email_address' );
					$facebook      = get_the_author_meta( 'facebook' );
					$twitter       = get_the_author_meta( 'twitter' );
					$instagram     = get_the_author_meta( 'instagram' );
					$linkedin      = get_the_author_meta( 'linkedin' );
					$pinterest     = get_the_author_meta( 'pinterest' );

					$link_classes = 'hint--bounce hint--top hint--primary';
					?>
					<?php if ( $facebook || $twitter || $instagram || $linkedin || $email_address ) : ?>
						<div class="author-social-networks">
							<?php if ( $facebook ) : ?>
								<a class="<?php echo esc_attr( $link_classes ); ?>"
								   aria-label="<?php esc_attr_e( 'Facebook', 'brook' ); ?>"
								   href="<?php echo esc_url( $facebook ); ?>" target="_blank">
									<i class="fab fa-facebook-square"></i>
								</a>
							<?php endif; ?>

							<?php if ( $twitter ) : ?>
								<a class="<?php echo esc_attr( $link_classes ); ?>"
								   aria-label="<?php esc_attr_e( 'Twitter', 'brook' ); ?>"
								   href="<?php echo esc_url( $twitter ); ?>" target="_blank">
									<i class="fab fa-twitter"></i>
								</a>
							<?php endif; ?>

							<?php if ( $instagram ) : ?>
								<a class="<?php echo esc_attr( $link_classes ); ?>"
								   aria-label="<?php esc_attr_e( 'Instagram', 'brook' ); ?>"
								   href="<?php echo esc_url( $instagram ); ?>" target="_blank">
									<i class="fab fa-instagram"></i>
								</a>
							<?php endif; ?>

							<?php if ( $linkedin ) : ?>
								<a class="<?php echo esc_attr( $link_classes ); ?>"
								   aria-label="<?php esc_attr_e( 'Linkedin', 'brook' ) ?>"
								   href="<?php echo esc_url( $linkedin ); ?>" target="_blank">
									<i class="fab fa-linkedin"></i>
								</a>
							<?php endif; ?>

							<?php if ( $pinterest ) : ?>
								<a class="<?php echo esc_attr( $link_classes ); ?>"
								   aria-label="<?php esc_attr_e( 'Pinterest', 'brook' ); ?>"
								   href="<?php echo esc_url( $pinterest ); ?>" target="_blank">
									<i class="fab fa-pinterest"></i>
								</a>
							<?php endif; ?>

							<?php if ( $email_address ) : ?>
								<a class="<?php echo esc_attr( $link_classes ); ?>"
								   aria-label="<?php esc_attr_e( 'Email', 'brook' ); ?>"
								   href="mailto:<?php echo esc_url( $email_address ); ?>" target="_blank">
									<i class="fa fa-envelope"></i>
								</a>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
	}

	public static function post_sharing( $args = array() ) {
		$social_sharing = Brook::setting( 'social_sharing_item_enable' );
		if ( ! empty( $social_sharing ) ) {
			?>
			<div class="single-post-share">
				<h6 class="post-share-heading">
					<?php esc_html_e( 'Share:', 'brook' ); ?>
				</h6>
				<div class="post-share-list">
					<?php self::get_sharing_list( $args ); ?>
				</div>
			</div>
			<?php
		}
	}

	public static function post_sharing_modern( $args = array() ) {
		$args['tooltip_position'] = 'left';

		$social_sharing = Brook::setting( 'social_sharing_item_enable' );
		if ( ! empty( $social_sharing ) ) {
			?>
			<div class="singe-post-share">
				<div class="post-share-list">
					<?php self::get_sharing_list( $args ); ?>
				</div>
			</div>
			<?php
		}
	}

	public static function portfolio_sharing( $args = array() ) {
		$social_sharing = Brook::setting( 'social_sharing_item_enable' );
		if ( ! empty( $social_sharing ) && Brook::setting( 'single_portfolio_share_enable' ) === '1' ) {
			?>
			<div class="portfolio-share">
				<h6 class="portfolio-share-title"><?php esc_html_e( 'Share', 'brook' ); ?></h6>
				<div class="portfolio-sharing-list"><?php self::get_sharing_list( $args ); ?></div>
			</div>
			<?php
		}
	}

	public static function portfolio_view_project_button( $portfolio_url ) {
		if ( $portfolio_url !== '' ) : ?>
			<div class="portfolio-link">
				<a class="tm-button-view-project tm-button style-flat tm-button-primary"
				   href="<?php echo esc_url( $portfolio_url ); ?>">
					<span class="btn-text"><?php esc_html_e( 'Visit Site', 'brook' ); ?></span>
				</a>
			</div>
		<?php endif;
	}

	public static function portfolio_details() {
		$portfolio_client = Brook_Helper::get_post_meta( 'portfolio_client', '' );
		$portfolio_date   = Brook_Helper::get_post_meta( 'portfolio_date', '' );
		$portfolio_awards = Brook_Helper::get_post_meta( 'portfolio_awards', '' );

		$cats_enable = Brook::setting( 'single_portfolio_categories_enable' );
		$tags_enable = Brook::setting( 'single_portfolio_tags_enable' );
		?>
		<div class="portfolio-details-list">
			<?php if ( $portfolio_date !== '' ) : ?>
				<div>
					<label><?php esc_html_e( 'Date', 'brook' ); ?></label>
					<span><?php echo esc_html( $portfolio_date ); ?></span>
				</div>
			<?php endif; ?>

			<?php if ( $portfolio_client !== '' ) : ?>
				<div>
					<label><?php esc_html_e( 'Client', 'brook' ); ?></label>
					<span><?php echo esc_html( $portfolio_client ); ?></span>
				</div>
			<?php endif; ?>

			<?php if ( $cats_enable === '1' && Brook_Portfolio::has_category() ) : ?>
				<div>
					<label><?php esc_html_e( 'Categories', 'brook' ); ?></label>

					<?php echo get_the_term_list( get_the_ID(), 'portfolio_category', '<ul class="portfolio-categories"><li>', '</li><li>', '</li></ul>' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( $portfolio_awards !== '' ) : ?>
				<div>
					<label><?php esc_html_e( 'Awards', 'brook' ); ?></label>

					<?php echo '<span>' . $portfolio_awards . '</span>'; ?>
				</div>
			<?php endif; ?>

			<?php if ( $tags_enable === '1' && Brook_Portfolio::has_tag() ) : ?>
				<div>
					<label><?php esc_html_e( 'Tags', 'brook' ); ?></label>
					<?php echo get_the_term_list( get_the_ID(), 'portfolio_tags', '<ul class="portfolio-tags"><li>', '</li><li>', '</li></ul>' ); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}

	public static function product_sharing( $args = array() ) {
		$social_sharing = Brook::setting( 'social_sharing_item_enable' );
		if ( ! empty( $social_sharing ) ) {
			?>
			<div class="product-share">
				<div class="product-sharing-list"><?php self::get_sharing_list( $args ); ?></div>
			</div>
			<?php
		}
	}

	public static function get_sharing_list( $args = array() ) {
		$defaults       = array(
			'target'           => '_blank',
			'tooltip_enable'   => true,
			'tooltip_skin'     => 'primary',
			'tooltip_position' => 'top',
		);
		$args           = wp_parse_args( $args, $defaults );
		$social_sharing = Brook::setting( 'social_sharing_item_enable' );

		$share_type = Brook::setting( 'social_sharing_type' );

		if ( $share_type === 'addtoany' && function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) {
			ADDTOANY_SHARE_SAVE_KIT();
		} elseif ( $share_type === 'standard' && ! empty( $social_sharing ) ) {
			$social_sharing_order = Brook::setting( 'social_sharing_order' );

			$link_classes = '';

			if ( $args['tooltip_enable'] === true ) {
				$link_classes .= "hint--bounce hint--{$args['tooltip_position']} hint--{$args['tooltip_skin']}";
			}

			foreach ( $social_sharing_order as $social ) {
				if ( in_array( $social, $social_sharing, true ) ) {
					if ( $social === 'facebook' ) {
						if ( ! wp_is_mobile() ) {
							$facebook_url = 'https://www.facebook.com/sharer.php?m2w&s=100&p&#91;url&#93;=' . rawurlencode( get_permalink() ) . '&p&#91;images&#93;&#91;0&#93;=' . wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ) . '&p&#91;title&#93;=' . rawurlencode( get_the_title() );
						} else {
							$facebook_url = 'https://m.facebook.com/sharer.php?u=' . rawurlencode( get_permalink() );
						}
						?>
						<a class="<?php echo esc_attr( $link_classes . ' facebook' ); ?>"
						   target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php esc_attr_e( 'Facebook', 'brook' ); ?>"
						   href="<?php echo esc_url( $facebook_url ); ?>">
							<i class="fab fa-facebook-square"></i>
						</a>
						<?php
					} elseif ( $social === 'twitter' ) {
						?>
						<a class="<?php echo esc_attr( $link_classes . ' twitter' ); ?>"
						   target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php esc_attr_e( 'Twitter', 'brook' ); ?>"
						   href="https://twitter.com/share?text=<?php echo rawurlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ); ?>&url=<?php echo rawurlencode( get_permalink() ); ?>">
							<i class="fab fa-twitter"></i>
						</a>
						<?php
					} elseif ( $social === 'tumblr' ) {
						?>
						<a class="<?php echo esc_attr( $link_classes . ' tumblr' ); ?>"
						   target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php esc_attr_e( 'Tumblr', 'brook' ); ?>"
						   href="https://www.tumblr.com/share/link?url=<?php echo rawurlencode( get_permalink() ); ?>&amp;name=<?php echo rawurlencode( get_the_title() ); ?>">
							<i class="fab fa-tumblr-square"></i>
						</a>
						<?php

					} elseif ( $social === 'linkedin' ) {
						?>
						<a class="<?php echo esc_attr( $link_classes . ' linkedin' ); ?>"
						   target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php esc_attr_e( 'Linkedin', 'brook' ); ?>"
						   href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo rawurlencode( get_permalink() ); ?>&amp;title=<?php echo rawurlencode( get_the_title() ); ?>">
							<i class="fab fa-linkedin"></i>
						</a>
						<?php
					} elseif ( $social === 'email' ) {
						?>
						<a class="<?php echo esc_attr( $link_classes . ' email' ); ?>"
						   target="<?php echo esc_attr( $args['target'] ); ?>"
						   aria-label="<?php esc_attr_e( 'Email', 'brook' ); ?>"
						   href="mailto:?subject=<?php echo rawurlencode( get_the_title() ); ?>&amp;body=<?php echo rawurlencode( get_permalink() ); ?>">
							<i class="fa fa-envelope"></i>
						</a>
						<?php
					}
				}
			}
		}
	}

	public static function social_icons( $args = array() ) {
		$defaults    = array(
			'link_classes'     => '',
			'display'          => 'icon',
			'tooltip_enable'   => true,
			'tooltip_position' => 'top',
			'tooltip_skin'     => '',
		);
		$args        = wp_parse_args( $args, $defaults );
		$social_link = Brook::setting( 'social_link' );

		if ( ! empty( $social_link ) ) {
			$social_link_target = Brook::setting( 'social_link_target' );

			$args['link_classes'] .= ' social-link';
			if ( $args['tooltip_enable'] ) {
				$args['link_classes'] .= ' hint--bounce';
				$args['link_classes'] .= " hint--{$args['tooltip_position']}";

				if ( $args['tooltip_skin'] !== '' ) {
					$args['link_classes'] .= " hint--{$args['tooltip_skin']}";
				}
			}

			foreach ( $social_link as $key => $row_values ) {
				?>
				<a class="<?php echo esc_attr( $args['link_classes'] ); ?>"
					<?php if ( $args['tooltip_enable'] ) : ?>
						aria-label="<?php echo esc_attr( $row_values['tooltip'] ); ?>"
					<?php endif; ?>
                   href="<?php echo esc_url( $row_values['link_url'] ); ?>"
                   data-hover="<?php echo esc_attr( $row_values['tooltip'] ); ?>"
					<?php if ( $social_link_target === '1' ) : ?>
						target="_blank"
					<?php endif; ?>
				>
					<?php if ( in_array( $args['display'], array( 'icon', 'icon_text' ), true ) ) : ?>
						<i class="social-icon <?php echo esc_attr( $row_values['icon_class'] ); ?>"></i>
					<?php endif; ?>
					<?php if ( in_array( $args['display'], array( 'text', 'icon_text' ), true ) ) : ?>
						<span class="social-text"><?php echo esc_html( $row_values['tooltip'] ); ?></span>
					<?php endif; ?>
				</a>
				<?php
			}
		}
	}

	public static function string_limit_words( $string, $word_limit ) {
		$words = explode( ' ', $string, $word_limit + 1 );
		if ( count( $words ) > $word_limit ) {
			array_pop( $words );
		}

		return implode( ' ', $words );
	}

	public static function string_limit_characters( $string, $limit ) {
		$string = substr( $string, 0, $limit );
		$string = substr( $string, 0, strripos( $string, " " ) );

		return $string;
	}

	public static function excerpt( $args = array() ) {
		$defaults = array(
			'limit' => 55,
			'after' => '&hellip;',
			'type'  => 'word',
		);
		$args     = wp_parse_args( $args, $defaults );

		$excerpt = '';

		if ( $args['type'] === 'word' ) {
			$excerpt = self::string_limit_words( get_the_excerpt(), $args['limit'] );
		} elseif ( $args['type'] === 'character' ) {
			$excerpt = self::string_limit_characters( get_the_excerpt(), $args['limit'] );
		}
		if ( $excerpt !== '' && $excerpt !== '&nbsp;' ) {
			printf( '<p>%s %s</p>', $excerpt, $args['after'] );
		}
	}

	public static function render_sidebar( $template_position = 'left' ) {
		$sidebar1         = Brook_Global::instance()->get_sidebar_1();
		$sidebar2         = Brook_Global::instance()->get_sidebar_2();
		$sidebar_position = Brook_Global::instance()->get_sidebar_position();

		if ( $sidebar1 !== 'none' ) {
			$classes = 'page-sidebar';
			$classes .= ' page-sidebar-' . $template_position;
			if ( $template_position === 'left' ) {
				if ( $sidebar_position === 'left' && $sidebar1 !== 'none' ) {
					self::get_sidebar( $classes, $sidebar1, true );
				}
				if ( $sidebar_position === 'right' && $sidebar1 !== 'none' && $sidebar2 !== 'none' ) {
					self::get_sidebar( $classes, $sidebar2 );
				}
			} elseif ( $template_position === 'right' ) {
				if ( $sidebar_position === 'right' && $sidebar1 !== 'none' ) {
					self::get_sidebar( $classes, $sidebar1, true );
				}
				if ( $sidebar_position === 'left' && $sidebar1 !== 'none' && $sidebar2 !== 'none' ) {
					self::get_sidebar( $classes, $sidebar2 );
				}
			}
		}
	}

	public static function get_sidebar( $classes, $name, $first_sidebar = false ) {
		$special_sidebar = Brook_Global::instance()->get_sidebar_special();
		?>
		<div class="<?php echo esc_attr( $classes ); ?>">
			<div class="page-sidebar-inner" itemscope="itemscope">
				<div class="page-sidebar-content">
					<?php dynamic_sidebar( $name ); ?>
				</div>

				<?php if ( $first_sidebar === true && $special_sidebar !== 'none' && is_active_sidebar( $special_sidebar ) ) : ?>
					<div class="page-sidebar-special">
						<?php dynamic_sidebar( $special_sidebar ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	/**
	 * @param $name
	 * Name of dynamic sidebar
	 * Check sidebar is active then dynamic it.
	 */
	public static function generated_sidebar( $name ) {
		if ( is_active_sidebar( $name ) ) {
			dynamic_sidebar( $name );
		}
	}

	public static function image_placeholder( $width, $height ) {
		echo '<img src="https://via.placeholder.com/' . $width . 'x' . $height . '?text=' . esc_attr__( 'No+Image', 'brook' ) . '" alt="' . esc_attr__( 'Thumbnail', 'brook' ) . '"/>';
	}

	public static function grid_filters( $post_type, $filter_enable, $filter_align, $filter_counter, $filter_wrap = '0', $total = 0, $list = '' ) {
		if ( $filter_enable != 1 ) {
			return;
		}

		$filter_classes = array( 'tm-filter-button-group', $filter_align );
		if ( $filter_counter == 1 ) {
			$filter_classes[] = 'show-filter-counter';
		}
		?>

		<div class="<?php echo implode( ' ', $filter_classes ); ?>"
			<?php
			if ( $filter_counter == 1 ) {
				echo 'data-filter-counter="true"';
			}
			?>
		>
			<?php if ( $filter_wrap == '1' ) { ?>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php } ?>

						<div class="tm-filter-button-group-inner">
							<a href="javascript:void(0);" class="btn-filter current"
							   data-filter="*" data-filter-count="<?php echo esc_attr( $total ); ?>">
								<span class="filter-text"><?php esc_html_e( 'All', 'brook' ); ?></span>
							</a>
							<?php


							if ( $list === '' ) {
								switch ( $post_type ) {
									case 'portfolio' :
										$_categories = get_terms( array(
											'taxonomy'   => 'portfolio_category',
											'hide_empty' => true,
										) );
										$_catPrefix  = 'portfolio_category';
										break;
									case 'product' :
										$_categories = get_terms( array(
											'taxonomy'   => 'product_cat',
											'hide_empty' => true,
										) );

										$_catPrefix = 'product_cat';
										break;
									default :
										$_categories = get_terms( array(
											'taxonomy'   => 'category',
											'hide_empty' => true,
										) );

										$_catPrefix = 'category';
										break;
								}

								foreach ( $_categories as $term ) {
									printf( '<a href="javascript:void(0);" class="btn-filter" data-filter="%s" data-ajax-filter="%s" data-filter-count="%s"><span class="filter-text">%s</span></a>', esc_attr( ".{$_catPrefix}-{$term->slug}" ), esc_attr( "{$_catPrefix}:{$term->slug}" ), $term->count, $term->name );
								}
							} else {
								$list = explode( ', ', $list );
								foreach ( $list as $item ) {
									$value = explode( ':', $item );

									$term = get_term_by( 'slug', $value[1], $value[0] );

									if ( $term === false ) {
										continue;
									}

									printf(
										'<a href="javascript:void(0);" class="btn-filter" data-filter=".%1$s-%2$s" data-ajax-filter="%1$s:%2$s" data-filter-count="%3$s"><span class="filter-text">%4$s</span></a>',
										$value[0],
										$value[1],
										$term->count,
										$term->name
									);
								}
							}
							?>
						</div>

						<?php if ( $filter_wrap == '1' ) { ?>
					</div>
				</div>
			</div>
		<?php } ?>

		</div>
		<?php
	}

	public static function grid_pagination( $brook_query, $number, $pagination, $pagination_align, $pagination_button_text ) {
		if ( $pagination !== '' && $brook_query->found_posts > $number ) { ?>
			<div class="tm-grid-pagination">
				<div class="pagination-wrapper" style="text-align:<?php echo esc_attr( $pagination_align ); ?>">

					<?php if ( $pagination === 'loadmore_alt' || $pagination === 'loadmore' || $pagination === 'infinite' ) { ?>
						<div class="inner">
							<div class="tm-grid-loader">
								<?php get_template_part( 'components/preloader/style', 'circle' ); ?>
							</div>
						</div>

						<div class="inner">
							<?php if ( $pagination === 'loadmore' ) { ?>
								<a href="#" class="tm-grid-loadmore-btn heading-color">
									<span class="button-text"><?php echo esc_html( $pagination_button_text ); ?></span>
									<span class="button-icon primary-color fa fa-redo"></span>
								</a>
							<?php } ?>
						</div>
					<?php } elseif ( $pagination === 'pagination' ) { ?>
						<?php Brook_Templates::paging_nav( $brook_query ); ?>
					<?php } ?>

				</div>
			</div>
			<div class="tm-grid-messages" style="display: none;">
				<?php esc_html_e( 'All items displayed.', 'brook' ); ?>
			</div>
			<?php
		}
	}

	/**
	 * Echo rating html template.
	 *
	 * @param int $rating
	 */
	public static function get_rating_template( $rating = 5 ) {
		$full_stars = intval( $rating );
		$template   = '';

		$template .= str_repeat( '<span class="fa fa-star"></span>', $full_stars );

		$half_star = floatval( $rating ) - $full_stars;

		if ( $half_star != 0 ) {
			$template .= '<span class="fa fa-star-half-alt"></span>';
		}

		$empty_stars = intval( 5 - $rating );
		$template    .= str_repeat( '<span class="far fa-star"></span>', $empty_stars );

		echo '' . $template;
	}

	public static function get_team_member_social_networks_template( $social_networks, $tooltip_enable, $tooltip_position, $tooltip_skin ) {
		$social_networks = (array) vc_param_group_parse_atts( $social_networks );
		if ( count( $social_networks ) <= 0 ) {
			return;
		}

		$hint_classes = '';

		if ( $tooltip_enable === '1' ) {
			$hint_classes .= " hint--bounce hint--{$tooltip_position}";

			if ( $tooltip_skin !== '' ) {
				$hint_classes .= " hint--{$tooltip_skin}";
			}
		}
		?>

		<div class="social-networks">
			<div class="inner">
				<?php
				foreach ( $social_networks as $data ) {
					$link = isset( $data['link'] ) ? $data['link'] : '';

					if ( $link === '' ) {
						continue;
					}

					$icon_classes = '';
					if ( isset( $data['icon_type'] ) && isset( $data["icon_{$data['icon_type']}"] ) && $data["icon_{$data['icon_type']}"] !== '' ) {

						$icon_classes .= esc_attr( $data["icon_{$data['icon_type']}"] );

						vc_icon_element_fonts_enqueue( $data['icon_type'] );
					}

					$title = isset( $data['title'] ) ? $data['title'] : '';

					$social_network_class = '';

					if ( $title !== '' ) {
						$social_network_class .= $hint_classes;
					}
					?>
					<a target="_blank" href="<?php echo esc_url( $data['link'] ); ?>"

						<?php if ( $social_network_class !== '' ) : ?>
							class="<?php echo esc_attr( $social_network_class ); ?>"
						<?php endif;
						?>

						<?php if ( $title !== '' ): ?>
                       aria-label="<?php echo esc_attr( $title ); ?>">
						<?php endif; ?>

						<i class="<?php echo esc_attr( $icon_classes ); ?>"></i>
					</a>
				<?php } ?>
			</div>
		</div>
		<?php
	}
}
