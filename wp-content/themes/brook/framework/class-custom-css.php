<?php
defined( 'ABSPATH' ) || exit;

/**
 * Enqueue custom styles.
 */
if ( ! class_exists( 'Brook_Custom_Css' ) ) {
	class Brook_Custom_Css {

		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'extra_css' ) );
		}

		/**
		 * Responsive styles.
		 *
		 * @access public
		 */
		public function extra_css() {
			$body_typo     = Brook::setting( 'typography_body' );
			$_primary_font = $body_typo['font-family'];
			$_primary_font = trim( $_primary_font, ' ,' );

			$extra_style = "
				.primary-font, input, select, textarea{ font-family: $_primary_font }
				.primary-font-important { font-family: $_primary_font !important }
			";

			$button_style = Brook::setting( 'button_style' );
			if ( $button_style === 'gradient' ) {
				$button_gradient_color = Brook::setting( 'button_gradient_color' );

				$button_tmp = "
					border-color: transparent;
					color: {$button_gradient_color['text_color']};
					background-image: linear-gradient(to right, {$button_gradient_color['color_1']} 0%, {$button_gradient_color['color_2']} 50%, {$button_gradient_color['color_1']} 100%);
					background-size: 200% auto;
					background-position: left center;
				";

				$button_selector       = Brook_Helper::get_button_css_selector();
				$button_hover_selector = Brook_Helper::get_button_hover_css_selector();

				$extra_style .= " $button_selector { $button_tmp }";
				$extra_style .= " $button_hover_selector { background-position: right center; }";
			}

			$custom_logo_width        = Brook_Helper::get_post_meta( 'custom_logo_width', '' );
			$custom_sticky_logo_width = Brook_Helper::get_post_meta( 'custom_sticky_logo_width', '' );

			if ( $custom_logo_width !== '' ) {
				$extra_style .= ".branding__logo img { 
                    width: {$custom_logo_width} !important; 
                }";
			}

			if ( $custom_sticky_logo_width !== '' ) {
				$extra_style .= ".headroom--not-top .branding__logo .sticky-logo { 
                    width: {$custom_sticky_logo_width} !important; 
                }";
			}

			$site_width = Brook_Helper::get_post_meta( 'site_width', '' );
			if ( $site_width === '' ) {
				$site_width = Brook::setting( 'site_width' );
			}

			if ( $site_width !== '' ) {
				$extra_style .= "
				.boxed
				{
	                max-width: $site_width;
	            }";
			}

			$tmp = '';

			$site_background_color = Brook_Helper::get_post_meta( 'site_background_color', '' );
			if ( $site_background_color !== '' ) {
				$tmp .= "background-color: $site_background_color !important;";
			}

			$site_background_image = Brook_Helper::get_post_meta( 'site_background_image', '' );
			if ( $site_background_image !== '' ) {
				$site_background_repeat = Brook_Helper::get_post_meta( 'site_background_repeat', '' );
				$tmp                    .= "background-image: url( $site_background_image ) !important; background-repeat: $site_background_repeat !important;";
			}

			$site_background_position = Brook_Helper::get_post_meta( 'site_background_position', '' );
			if ( $site_background_position !== '' ) {
				$tmp .= "background-position: $site_background_position !important;";
			}

			$site_background_size = Brook_Helper::get_post_meta( 'site_background_size', '' );
			if ( $site_background_size !== '' ) {
				$tmp .= "background-size: $site_background_size !important;";
			}

			$site_background_attachment = Brook_Helper::get_post_meta( 'site_background_attachment', '' );
			if ( $site_background_attachment !== '' ) {
				$tmp .= "background-attachment: $site_background_attachment !important;";
			}

			if ( $tmp !== '' ) {
				$extra_style .= "body { $tmp; }";
			}

			$tmp = '';

			$content_background_color = Brook_Helper::get_post_meta( 'content_background_color', '' );
			if ( $content_background_color !== '' ) {
				$tmp .= "background-color: $content_background_color !important;";
			}

			$content_background_image = Brook_Helper::get_post_meta( 'content_background_image', '' );
			if ( $content_background_image !== '' ) {
				$content_background_repeat = Brook_Helper::get_post_meta( 'content_background_repeat', '' );
				$tmp                       .= "background-image: url( $content_background_image ) !important; background-repeat: $content_background_repeat !important;";
			}

			$content_background_position = Brook_Helper::get_post_meta( 'content_background_position', '' );
			if ( $content_background_position !== '' ) {
				$tmp .= "background-position: $content_background_position !important;";
			}

			if ( $tmp !== '' ) {
				$extra_style .= ".site { $tmp; }";
			}

			$tmp = '';

			$content_padding = Brook_Helper::get_post_meta( 'content_padding' );

			if ( $content_padding === '0' ) {
				$tmp .= 'padding-top: 0 !important;';
				$tmp .= 'padding-bottom: 0 !important;';
			} elseif ( $content_padding === 'top' ) {
				$tmp .= 'padding-top: 0 !important;';
			} elseif ( $content_padding === 'bottom' ) {
				$tmp .= 'padding-bottom: 0 !important;';
			}

			if ( $tmp !== '' ) {
				$extra_style .= ".page-content { $tmp; }";
			}

			$extra_style .= $this->primary_color_css();
			$extra_style .= $this->secondary_color_css();
			$extra_style .= $this->header_css();
			$extra_style .= $this->sidebar_css();
			$extra_style .= $this->title_bar_css();
			$extra_style .= $this->light_gallery_css();

			$extra_style = Brook_Minify::css( $extra_style );

			wp_add_inline_style( 'brook-style', html_entity_decode( $extra_style, ENT_QUOTES ) );
		}

		function header_css() {
			$header_type = Brook_Global::instance()->get_header_type();
			$css         = '';

			$nav_bg_type = Brook::setting( "header_style_{$header_type}_navigation_background_type" );

			if ( $nav_bg_type === 'gradient' ) {

				$gradient = Brook::setting( "header_style_{$header_type}_navigation_background_gradient" );
				$_color_1 = $gradient['from'];
				$_color_2 = $gradient['to'];

				$css .= "
				.header-$header_type .header-below {
					background: {$_color_1};
                    background: -webkit-linear-gradient(-136deg, {$_color_2} 0%, {$_color_1} 100%);
                    background: linear-gradient(-136deg, {$_color_2} 0%, {$_color_1} 100%);
				}";
			}

			return $css;
		}

		function sidebar_css() {
			$css = '';

			$page_sidebar1  = Brook_Global::instance()->get_sidebar_1();
			$page_sidebar2  = Brook_Global::instance()->get_sidebar_2();
			$sidebar_status = Brook_Global::instance()->get_sidebar_status();

			if ( 'none' !== $page_sidebar1 ) {

				if ( $sidebar_status === 'both' ) {
					$sidebars_breakpoint = Brook::setting( 'both_sidebar_breakpoint' );
				} else {
					$sidebars_breakpoint = Brook::setting( 'one_sidebar_breakpoint' );
				}

				$sidebars_below = Brook::setting( 'sidebars_below_content_mobile' );

				if ( 'none' !== $page_sidebar2 ) {
					$sidebar_width  = Brook::setting( 'dual_sidebar_width' );
					$sidebar_offset = Brook::setting( 'dual_sidebar_offset' );
					$content_width  = 100 - $sidebar_width * 2;
				} else {
					$sidebar_width  = Brook::setting( 'single_sidebar_width' );
					$sidebar_offset = Brook::setting( 'single_sidebar_offset' );
					$content_width  = 100 - $sidebar_width;
				}

				$css .= "
				@media (min-width: {$sidebars_breakpoint}px) {
					.page-sidebar {
						flex: 0 0 $sidebar_width%;
						max-width: $sidebar_width%;
					}
					.page-main-content {
						flex: 0 0 $content_width%;
						max-width: $content_width%;
					}
				}
				@media (min-width: 1200px) {
					.page-sidebar-left .page-sidebar-inner {
						padding-right: $sidebar_offset;
					}
					.page-sidebar-right .page-sidebar-inner {
						padding-left: $sidebar_offset;
					}
				}";

				$_max_width_breakpoint = $sidebars_breakpoint - 1;

				if ( $sidebars_below === '1' ) {
					$css .= "
					@media (max-width: {$_max_width_breakpoint}px) {
						.page-sidebar {
							margin-top: 100px;
						}
					
						.page-main-content {
							-webkit-order: -1;
							-moz-order: -1;
							order: -1;
						}
					}";
				}
			}

			return $css;
		}

		function title_bar_css() {
			$css = $title_bar_tmp = $overlay_tmp = '';

			$bg_color   = Brook_Helper::get_post_meta( 'page_title_bar_background_color', '' );
			$bg_image   = Brook_Helper::get_post_meta( 'page_title_bar_background', '' );
			$bg_overlay = Brook_Helper::get_post_meta( 'page_title_bar_background_overlay', '' );

			if ( $bg_color !== '' ) {
				$title_bar_tmp .= "background-color: {$bg_color}!important;";
			}

			if ( $bg_image !== '' ) {
				$title_bar_tmp .= "background-image: url({$bg_image})!important;";
			}

			if ( $bg_overlay !== '' ) {
				$overlay_tmp .= "background-color: {$bg_overlay}!important;";
			}

			if ( $title_bar_tmp !== '' ) {
				$css .= ".page-title-bar-inner{ {$title_bar_tmp} }";
			}

			if ( $overlay_tmp !== '' ) {
				$css .= ".page-title-bar-overlay{ {$overlay_tmp} }";
			}

			return $css;
		}

		function primary_color_css() {
			$color     = Brook::setting( 'primary_color' );
			$secondary = Brook::setting( 'secondary_color' );
			$alpha0    = Brook_Color::hex2rgba( $color, '0' );
			$alpha80   = Brook_Color::hex2rgba( $color, '0.8' );
			$alpha70   = Brook_Color::hex2rgba( $color, '0.7' );
			$alpha18   = Brook_Color::hex2rgba( $color, '0.18' );
			$alpha10   = Brook_Color::hex2rgba( $color, '0.1' );

			// Color.
			$css = "
				::-moz-selection { color: #fff; background-color: $color }
				::selection { color: #fff; background-color: $color }
                mark,
                blockquote:before,
                .growl-close:hover,
                .primary-color,
                .tm-accordion.style-01 .active .accordion-title,
                .tm-accordion.style-01 .accordion-title-wrapper:hover .accordion-title,
				.tm-accordion.style-02 .accordion-title:hover,
                .tm-button.style-solid.tm-button-primary,
				.tm-button.style-text.tm-button-primary:hover,
				.tm-button.style-text.tm-button-primary .button-icon,
				.tm-button.style-text-long-arrow.tm-button-primary,
				.tm-button.style-text-long-arrow .button-arrow,
				.tm-box-icon .tm-box-icon__btn .button-icon,
				.tm-box-icon .tm-box-icon__btn:hover,
				.tm-box-icon .icon,
				.tm-counter.style-01 .icon,
				.tm-counter.style-02 .icon,
				.tm-counter.style-03 .icon,
				.tm-counter.style-03 .number-wrap,
				.tm-counter.style-05 .icon,
				.tm-circle-progress-chart .chart-icon,
				.chart-legends li:hover,
				.tm-drop-cap.style-02 .drop-cap,
				.tm-product-banner-slider .tm-product-banner-btn,
				.tm-countdown.style-03 .second .number,
				.typed-text mark,
				.typed-text .typed-cursor,
				.typed-text-02 .typed-cursor,
				.tm-twitter.style-slider-quote .tweet-info:before,
				.tm-twitter.style-slider-quote .tweet-text a,
				.tm-twitter .tweet:before,
				.tm-info-boxes .box-icon,
				.tm-info-boxes .tm-button .button-icon,
				.tm-problem-solution .ps-label,
				.tm-instagram .instagram-user-name,
				.tm-mailchimp-form.style-01 .form-submit,
				.tm-mailchimp-form.style-02 .form-submit,
				.tm-grid-wrapper.filter-counter-style-01 .btn-filter.current,
				.tm-grid-wrapper.filter-counter-style-01 .btn-filter:hover,
				.tm-blog .post-title a:hover,
				.tm-blog .post-categories a:hover,
				.tm-blog.style-list .sticky .post-title,
				.tm-blog.style-grid-minimal .post-quote .post-quote-name,
				.tm-blog.style-grid-classic .post-quote-icon,
				.tm-blog.style-grid-classic-03 .post-categories,
				.tm-blog.style-grid-metro .format-quote .post-content:before,
				.tm-blog.style-grid-sticky .format-quote .post-content:before,
				.tm-heading.highlight mark,
				.tm-heading.modern-02 .heading,
				.tm-heading.modern-04 .heading,
				.tm-heading.link-style-02 .heading a,
				.tm-popup-video.style-poster-04 .video-play,
				.tm-product.style-grid .woosw-btn.woosw-added,
				.tm-product.style-grid .woosc-btn.woosc-btn-added,
				.tm-pricing .feature-icon,
				.tm-pricing-rotate-box .tm-pricing-list li:before,
				.tm-pricing-table .title,
				.tm-portfolio.style-carousel-auto-wide .post-categories,
				.tm-portfolio.style-carousel-auto-wide .post-read-more a:hover,
				.tm-portfolio.style-carousel-auto-wide .post-read-more .button-icon,
				.tm-portfolio.style-metro-with-caption .post-wrapper:hover .post-title,
				.tm-portfolio-featured.style-01 .post-title a:hover,
				.tm-case-study-slider .sub-title,
				.tm-restaurant-carousel.style-01 .item-price,
				.tm-restaurant-menu.style-2 .menu-price,
				.tm-icon.style-01 .icon,
				.tm-list .marker,
				.tm-list .link:hover,
				.tm-list.style-modern-icon .marker,
				.tm-timeline.style-01 .year,
				.tm-testimonial.style-grid .testimonial-quote-icon,
				.tm-testimonial.style-carousel .testimonial-quote-icon,
				.tm-testimonial.style-carousel-02 .testimonial-quote-icon,
				.tm-testimonial.style-carousel-04 .testimonial-quote-icon,
				.tm-testimonial.style-carousel-free-mode .testimonial-quote-icon,
				.tm-testimonial.style-simple-slider .testimonial-quote-icon,
				.tm-team-member.style-05 .position,
				.tm-mailchimp-form-popup .subscribe-open-popup-link, .mailchimp-form-popup-close:hover,			
				.tm-mailchimp-form-box.style-01 .form-submit,
				.tm-social-networks .link:hover,
				.tm-social-networks.style-large-icons .link:hover,
				.tm-swiper .swiper-nav-button:hover,
				.tm-slider a:hover .heading, 
				.woosw-area .woosw-inner .woosw-content .woosw-content-top .woosw-close:hover,
				.woosw-area .woosw-inner .woosw-content .woosw-content-bot .woosw-content-bot-inner .woosw-page a:hover,
				.woosw-continue:hover,
				.skin-primary .wpcf7-text.wpcf7-text, .skin-primary .wpcf7-textarea,
				.tm-menu .menu-price,
				.page-content .tm-custom-menu.style-1 .menu a:hover,
				.post-share a:hover,
				.post-share-toggle,
				.tagcloud a:hover,
				.single-post .post-meta .meta-icon,
				.single-post .post-meta .sl-icon,
				.single-post .post-categories a:hover,
				.single-post .entry-footer .post-share a:hover,
				.single-portfolio .portfolio-share a:hover,
				.tm-posts-widget .post-date:before,
				.page-sidebar .widget_pages .current-menu-item > a,
				.page-sidebar .widget_nav_menu .current-menu-item > a,
				.page-sidebar .insight-core-bmw .current-menu-item > a,
				.widget_recent_entries .post-date:before,
				.widget_search .search-submit,
				.widget_product_search .search-submit,
				body.search .page-main-content .search-form .search-submit,
				.page-sidebar-fixed .widget a:hover,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-brook-01 .vc_tta-tab.vc_active > a,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-brook-01 .vc_active .vc_tta-panel-heading,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-brook-02 .vc_tta-tab:hover,
				.page-template-portfolio-fullscreen-type-hover-03 .page-social-networks a:hover
				{ 
					color: {$color} 
				}";

			// Color Important.
			$css .= "
                .primary-color-important,
				.primary-color-hover-important:hover
				 {
                      color: {$color}!important;
				 }";

			// Background Color.
			$css .= "
                .primary-background-color,
                .hint--primary:after,
                .page-scroll-up,
                .widget_calendar #today,
                .top-bar-01 .top-bar-button,
                .desktop-menu .header-09 .header-special-button,
				.tm-accordion.style-02 .active .accordion-title,
				.tm-maps.overlay-style-01 .animated-dot .middle-dot,
				.tm-maps.overlay-style-01 .animated-dot div[class*='signal'],
				.tm-gallery .overlay,
				.tm-grid-wrapper.filter-counter-style-01 .filter-counter,
				.tm-blog.style-list .post-quote,
				.tm-blog.style-grid-sticky .post-wrapper,
				.tm-blog.style-grid-sticky .post-video .icon,
				.tm-blog.style-grid-classic .post-info:before,
				.tm-blog.style-grid-modern .post-read-more,
				.tm-blog.style-grid-modern .post-feature:after,
				.tm-button.tm-button-primary.style-solid:hover,
				.tm-icon.style-02 .icon,
				.tm-countdown.style-02 .number,
				.tm-contact-form-7.style-03 .wpcf7-form-control-wrap:after,
				.tm-gradation .dot,
				.tm-heading.below-separator .separator:after,
				.tm-heading.thick-separator .separator:after,
				.tm-heading.top-separator .separator:after,
				.tm-portfolio.style-carousel-auto-wide .post-title:before,
				.tm-mailchimp-form.style-01 .form-submit:hover,
				.tm-mailchimp-form.style-02 .form-submit:hover,
				.tm-separator.style-modern-dots .dot,
				.tm-team-member.style-01 .overlay,
				.tm-team-member.style-02 .overlay,
				.tm-team-member.style-03 .overlay,
				.tm-timeline.style-01 .dot:before,
				.tm-timeline.style-01 .dot:after,
				.tm-timeline.style-02 .dot:before,
				.tm-testimonial.style-grid .testimonial-item:hover,
				.tm-testimonial.style-grid-02 .testimonial-item:hover,
				.tm-testimonial.style-carousel .testimonial-item:hover,
				.tm-testimonial.style-carousel-02 .testimonial-item:hover,
				.tm-testimonial.style-carousel-03 .swiper-slide-active .testimonial-item,
				.tm-testimonial.style-carousel-free-mode .testimonial-item:hover,
				.tm-text-box.style-03,
				.tm-rotate-box .box,
				.tm-attribute-list.style-02 .item:before,
				.tm-slider-button.style-01 .slider-btn:hover,
				.tm-social-networks.style-flat-rounded-icon .item:hover .link,
				.tm-social-networks.style-solid-rounded-icon .item:hover .link,
				.tm-button.style-flat.tm-button-primary,
				.tm-button.style-flat-rounded.tm-button-primary,
				.tm-button.style-border-icon.tm-button-primary,
				.tm-pricing-table .tm-pricing-feature-mark,
				.tm-pricing-table .tm-button.tm-button-primary.tm-pricing-button:hover,
				.vc_progress_bar .vc_general.vc_single_bar .vc_bar,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-brook-01 .vc_tta-tab.vc_active:after,
				.wpb-js-composer .vc_tta-style-brook-02 .vc_tta-tab.vc_active,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-brook-02 .vc_active .vc_tta-panel-heading,
				.tm-popup-video .video-play,
				.tm-pricing.style-01 .tm-pricing-feature-mark,
				.tm-pricing .tm-pricing-button:hover,
				.tm-mailchimp-form-box.style-01,
				.tm-services-list.style-02 .service-image .blend-bg,    
				.tm-swiper .swiper-pagination-progressbar .swiper-pagination-progressbar-fill,
				.tm-swiper.pagination-style-07 .progressbar .filled,
				.tm-swiper.pagination-style-02 .swiper-pagination-bullet:hover:before,
				.tm-swiper.pagination-style-02 .swiper-pagination-bullet.swiper-pagination-bullet-active:before,
				.tm-swiper.pagination-style-04 .swiper-pagination-bullet:hover:before,
				.tm-swiper.pagination-style-04 .swiper-pagination-bullet.swiper-pagination-bullet-active:before,
				.tm-swiper.nav-style-05 .swiper-nav-button:hover,   
				.single-post.single-blog-style-modern .post-share-list a:hover,
				.single-post article.post .post-quote,
				.nav-links a:hover,
				.portfolio-details-gallery .portfolio-overlay,
				.widget_search .search-submit:hover,
				.widget_product_search .search-submit:hover,
				body.search .page-main-content .search-form .search-submit:hover,
				.tm-search-form .category-list a:hover,
				.select2-container--default .select2-results__option--highlighted[aria-selected],
				.page-links > span, .page-links > a:hover, .page-links > a:focus,
				.comment-nav-links li .current,
				.comment-nav-links li a:hover,
				.comment-nav-links li a:focus,
				.page-pagination li .current,
				.page-pagination li a:hover,
				.page-pagination li a:focus
				{
					background-color: {$color};
				}";

			$css .= "
                .primary-background-color-important,
				.primary-background-color-hover-important:hover,
				.lg-progress-bar .lg-progress
				{
					background-color: {$color}!important;
				}";

			$css .= "
                .btn-view-full-map
				{
					background-color: {$alpha70};
				}";

			// Border.
			$css .= "
				.primary-border-color,
				.widget_search .search-field:focus,
				.widget_product_search .search-field:focus,
                .popup-search-wrap .search-form .search-field:focus,
                .widget .mc4wp-form input[type=email]:focus,
                .tm-accordion.style-01 .active .accordion-title,
				.tm-button.style-flat.tm-button-primary,
				.tm-button.style-flat-rounded.tm-button-primary,
				.tm-button.style-solid.tm-button-primary,
				.tm-button.style-border-icon.tm-button-primary,
				.tm-box-icon.style-01:hover .content-wrap:before,
				.tm-counter.style-02:hover,
				.tm-timeline.style-01 .year,
				.tm-testimonial.style-simple-slider .testimonial-quote-icon,
				.tm-slider-button.style-01 .slider-btn:hover,
				.widget_pages .current-menu-item, .widget_nav_menu .current-menu-item, .insight-core-bmw .current-menu-item,
				.post-share-toggle:hover,
				.tm-contact-form-7.style-05 input[type='text']:focus,
				.tm-contact-form-7.style-05 input[type='email']:focus,
				.tm-contact-form-7.style-05 input[type='tel']:focus,
				.tm-contact-form-7.style-05 input[type='date']:focus,
				.tm-contact-form-7.style-05 select:focus,
				.tm-contact-form-7.style-05 textarea:focus,
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-brook-02 .vc_tta-tab.vc_active
				{
					border-color: {$color};
				}";

			$css .= ".tm-team-member.style-02:hover .photo 
			{
				border-color: $alpha10;
			}";

			// Border Important.
			$css .= "
                .primary-border-color-important,
				.primary-border-color-hover-important:hover,
				.lg-outer .lg-thumb-item.active, .lg-outer .lg-thumb-item:hover,
				#fp-nav ul li a.active span, .fp-slidesNav ul li a.active span
				{
					border-color: {$color}!important;
				}";

			// Border Top.
			$css .= "
                .tm-grid-wrapper.filter-counter-style-01 .filter-counter:before,
                .hint--primary.hint--top-left:before,
                .hint--primary.hint--top-right:before,
                .hint--primary.hint--top:before 
                {
					border-top-color: {$color};
				}";

			// Border Right.
			$css .= "
                .hint--primary.hint--right:before
                {
					border-right-color: {$color};
				}";

			// Border Bottom.
			$css .= "
                .hint--primary.hint--bottom-left:before,
                .hint--primary.hint--bottom-right:before,
                .hint--primary.hint--bottom:before
                {
					border-bottom-color: {$color};
				}";

			// Border Left.
			$css .= "
                blockquote,
                .hint--primary.hint--left:before
                {
                    border-left-color: {$color};
                }";

			$css .= "
				.wpb-js-composer .vc_tta.vc_general.vc_tta-style-brook-01 .vc_tta-tab.vc_active:after 
				{
					box-shadow: 0 0 0 8px $alpha18, 0 0 0 18px $alpha18;
				}";

			$css .= ".testimonial-info svg *
			{
				fill: {$color}; 
			}";

			$css .= ".tm-heading.float-shadow .separator:after
			{
				background-image: linear-gradient(to right, {$alpha0} 0%, {$alpha80} 50%, {$alpha0} 100%);
			}";

			$css .= "
			.tm-pricing-rotate-box .title
			 {
				background-color: $color;
					background-image: linear-gradient(-129deg, {$color} 0%, {$secondary} 100%);
			}";

			$css .= "
			.tm-button.style-flat-gradient
			 {
				background-color: $color;
				background-image: linear-gradient(to right, {$color} 0%, {$secondary} 50%, {$color} 100%);
			}";

			$css .= "
			.tm-button.style-icon-rounded-gradient:hover
			 {
				background-color: $color;
				background-image: linear-gradient(to right, {$color} 0%, {$secondary} 100%);
			}";

			$css .= "
			.tm-blog.style-grid-classic-02 .post-info:before,
			.tm-blog.style-grid-classic-02 .tm-popup-video .video-play,
			.tm-popup-video.style-button-06 .video-play:before,
			.tm-popup-video.style-button-06 .video-play:after,
			.tm-counter.style-04 .icon i,
			.tm-heading.highlight-02 mark,
			.tm-testimonial-pagination .thumb-wrap
			{
				background-color: $color;
				background-image: linear-gradient(-133deg, {$secondary} 0%, {$color} 100%);
			}";

			if ( Brook_Helper::active_woocommerce() ) {
				$css .= "
				.woocommerce .cart.shop_table td.product-subtotal,
				.cart-collaterals .order-total .amount,
				.product-sharing-list a:hover,
				.woocommerce .cart_list.product_list_widget a:hover,
				.woocommerce .cart.shop_table td.product-name a:hover,
				.woocommerce ul.product_list_widget li .product-title:hover,
				.woocommerce.single-product div.product .product-meta a:hover,
                .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
                .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
				.price > .amount,
				.woocommerce div.product p.price,
				.woocommerce div.product span.price
				{
					color: {$color}
				}";

				$css .= "
				.woocommerce-MyAccount-navigation .is-active a,
				.woocommerce-MyAccount-navigation a:hover,
                .tm-product.style-grid .woocommerce_loop_add_to_cart_wrap a:hover,
                .tm-product.style-grid .woosc-btn:hover,
                .tm-product.style-grid .woosw-btn:hover,
                .single-product .woosw-btn:hover,
                .single-product .woosc-btn:hover,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-handle
				{ 
					background-color: {$color}; 
				}";

				$css .= "
				 .woocommerce nav.woocommerce-pagination ul li span.current,
				 .woocommerce nav.woocommerce-pagination ul a:hover
				 {
					background-color: {$color} !important;
				 }";

				$css .= "
				.single-product .woosw-btn:hover,
				.single-product .woosc-btn:hover,
				body.woocommerce-cart table.cart td.actions .coupon .input-text:focus,
				.woocommerce div.quantity .qty:focus,
				.woocommerce .quantity button:hover:before
				{
					border-color: {$color};
				}";

				$css .= "
                .mini-cart .widget_shopping_cart_content,
				.woocommerce.single-product div.product .woocommerce-tabs ul.tabs li.active,
				.woocommerce .select2-container .select2-choice {
					border-bottom-color: {$color};
				}";
			}

			return $css;
		}

		function secondary_color_css() {
			$color = Brook::setting( 'secondary_color' );

			// Color.
			$css = "
				.secondary-color,
				.tm-button.tm-button-secondary.style-solid,
				.tm-button.tm-button-secondary.style-text,
				.tm-button.tm-button-secondary.style-text:hover .button-icon,
				.tm-heading.highlight-secondary-color mark,
				.tm-twitter.style-slider-quote .tweet-text a:hover,
				.related-portfolio-item .post-overlay-categories,
				.single-post .post-link a,
				.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-title>a,
				.comment-list .comment-datetime:before
				{
					color: {$color} 
				}";

			// Color Important.
			$css .= "
				.secondary-color-important,
				.secondary-color-hover-important:hover
				{
					color: {$color}!important;
				}";

			// Background Color.
			$css .= "
				.secondary-background-color,
				.hint--secondary:after,
				.tm-button.tm-button-secondary.style-solid:hover,
				.tm-button.style-flat.tm-button-secondary,
				.tm-button.style-flat-rounded.tm-button-secondary,
				.tm-timeline.style-01 .content-header,
				.top-bar-01 .top-bar-button:hover,
				.tm-search-form .search-submit:hover,
				.vc_tta-color-secondary.vc_tta-style-classic .vc_tta-tab>a,
				.vc_tta-color-secondary.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-tabs.vc_tta-color-secondary.vc_tta-style-modern .vc_tta-tab > a,
				.vc_tta-color-secondary.vc_tta-style-modern .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-color-secondary.vc_tta-style-flat .vc_tta-panel .vc_tta-panel-body,
				.vc_tta-color-secondary.vc_tta-style-flat .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-color-secondary.vc_tta-style-flat .vc_tta-tab>a,
				.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading:focus,
				.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-panel:not(.vc_active) .vc_tta-panel-heading:hover,
				.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-tab:not(.vc_active) >a:focus,
				.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-tab:not(.vc_active) >a:hover
				{
					background-color: {$color};
				}";

			$css .= "
				.secondary-background-color-important,
				.secondary-background-color-hover-important:hover,
				.mejs-controls .mejs-time-rail .mejs-time-current
				{
					background-color: {$color}!important;
				}";

			$css .= "
				.secondary-border-color,
                .tm-button.tm-button-secondary.style-solid,
				.vc_tta-color-secondary.vc_tta-style-classic .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-heading,
				.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-controls-icon::after,
				.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-controls-icon::before,
				.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-body,
				.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-body::after,
				.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-panel .vc_tta-panel-body::before,
				.vc_tta-tabs.vc_tta-color-secondary.vc_tta-style-outline .vc_tta-tab > a
				{
					border-color: {$color};
				}";


			$css .= ".secondary-border-color-important,
				.secondary-border-color-hover-important:hover,
				.tm-button.style-flat.tm-button-secondary,
				.tm-button.style-flat-rounded.tm-button-secondary
				{
					border-color: {$color}!important;
				}";

			// Border Top.
			$css .= "
                .hint--secondary.hint--top-left:before,
                .hint--secondary.hint--top-right:before,
                .hint--secondary.hint--top:before 
                {
					border-top-color: {$color};
				}";

			// Border Right.
			$css .= "
                .hint--secondary.hint--right:before
                {
					border-right-color: {$color};
				}";

			// Border Bottom.
			$css .= "
                .hint--secondary.hint--bottom-left:before,
                .hint--secondary.hint--bottom-right:before,
                .hint--secondary.hint--bottom:before
                {
					border-bottom-color: {$color};
				}";

			// Border Left.
			$css .= "
                .hint--secondary.hint--left:before
                {
                    border-left-color: {$color};
                }";

			if ( Brook_Helper::active_woocommerce() ) {
				$css .= "
				.tm-product-search-form .search-submit:hover,
				.woocommerce .cats .product-category:hover .cat-text,
				.woocommerce .products div.product .product-overlay
				{ 
					background-color: {$color}; 
				}";

				$css .= "
				.woocommerce.single-product div.product .images .thumbnails .item img:hover
				{
					border-color: {$color};
				}";
			}

			return $css;
		}

		function light_gallery_css() {
			$css                    = '';
			$primary_color          = Brook::setting( 'primary_color' );
			$secondary_color        = Brook::setting( 'secondary_color' );
			$cutom_background_color = Brook::setting( 'light_gallery_custom_background' );
			$background             = Brook::setting( 'light_gallery_background' );

			$tmp = '';

			if ( $background === 'primary' ) {
				$tmp .= "background-color: {$primary_color} !important;";
			} elseif ( $background === 'secondary' ) {
				$tmp .= "background-color: {$secondary_color} !important;";
			} else {
				$tmp .= "background-color: {$cutom_background_color} !important;";
			}

			$css .= ".lg-backdrop { $tmp }";

			return $css;
		}

		function get_typo_css( $typography ) {
			$css = '';

			if ( ! empty( $typography ) ) {
				foreach ( $typography as $attr => $value ) {
					if ( $attr === 'subsets' ) {
						continue;
					}
					if ( $attr === 'font-family' ) {
						$css .= "{$attr}: \"{$value}\", Helvetica, Arial, sans-serif;";
					} elseif ( $attr === 'variant' ) {
						$css .= "font-weight: {$value};";
					} else {
						$css .= "{$attr}: {$value};";
					}
				}
			}

			return $css;
		}
	}

	new Brook_Custom_Css();
}
