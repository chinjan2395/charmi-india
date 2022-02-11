<?php
/**
 * Template Name: Maintenance
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Brook
 * @since   1.0
 */

get_header( 'blank' );

$title            = Brook::setting( 'maintenance_title' );
$text             = Brook::setting( 'maintenance_text' );
$mailchimp_enable = Brook::setting( 'maintenance_mailchimp_enable' );
$social_enable    = Brook::setting( 'maintenance_social_networks_enable' );
?>
	<div id="maintenance-wrap" class="maintenance-page">

		<div class="container">
			<div class="row row-xs-center full-height">
				<div class="col-md-8">
					<div class="cs-content-wrapper">
						<?php if ( $title !== '' ) : ?>
							<?php echo '<h2 class="maintenance-title">' . $title . '</h2>'; ?>
						<?php endif; ?>

						<?php if ( $text !== '' ) : ?>
							<?php echo '<div class="maintenance-text">' . html_entity_decode( $text ) . '</div>'; ?>
						<?php endif; ?>

						<?php if ( $mailchimp_enable === '1' && function_exists( 'mc4wp_show_form' ) ) : ?>
							<div class="maintenance-form">
								<?php echo do_shortcode( '[tm_mailchimp_form style="02"]' ); ?>

								<div class="maintenance-mailchimp-form-desc">
									<?php esc_html_e( 'You can subscribe us to get noticed when our website is ready. ', 'brook' ); ?>
								</div>
							</div>
						<?php endif; ?>

						<?php if ( $social_enable === '1' ) : ?>
							<div class="maintenance-social-networks">
								<div class="inner">
									<?php Brook_Templates::social_icons( array(
										'display'        => 'text',
										'tooltip_enable' => false,
									) ); ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</div>
<?php get_footer( 'blank' );
