<?php
/**
 * Template Name: Coming Soon 01
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Brook
 * @since   1.0
 */

get_header( 'blank' );

$logo             = Brook::setting( 'coming_soon_01_logo' );
$title            = Brook::setting( 'coming_soon_01_title' );
$text             = Brook::setting( 'coming_soon_01_text' );
$countdown        = Brook::setting( 'coming_soon_01_countdown' );
$mailchimp_enable = Brook::setting( 'coming_soon_01_mailchimp_enable' );
$social_enable    = Brook::setting( 'coming_soon_01_social_networks_enable' );
?>

<div class="container-fluid">
	<div class="row full-height">
		<div class="col-lg-6 coming-soon-bg">
		</div>
		<div class="col-lg-6">

			<div class="maintenance-page" id="maintenance-wrap">
				<div class="cs-content-wrapper">

					<?php if ( $logo ) : ?>
						<img src="<?php echo esc_attr( $logo ); ?>"
						     alt="<?php esc_attr_e( 'Maintenance Logo', 'brook' ); ?>" class="cs-logo"/>
					<?php endif; ?>

					<?php if ( $title !== '' ) : ?>
						<?php echo '<h2 class="cs-title">' . $title . '</h2>'; ?>
					<?php endif; ?>

					<?php if ( $countdown !== '' ) : ?>
						<?php echo do_shortcode( '[tm_countdown datetime="' . $countdown . '"]' ) ?>
					<?php endif; ?>

					<?php if ( $mailchimp_enable === '1' && function_exists( 'mc4wp_show_form' ) ) : ?>
						<div class="cs-form">
							<?php echo do_shortcode( '[tm_mailchimp_form style="02"]' ); ?>

							<div class="cs-mailchimp-title">
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

		</div>
	</div>
</div>
<?php get_footer( 'blank' ); ?>
