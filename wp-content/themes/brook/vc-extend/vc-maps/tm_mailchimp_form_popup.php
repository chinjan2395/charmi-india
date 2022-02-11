<?php

class WPBakeryShortCode_TM_Mailchimp_Form_Popup extends WPBakeryShortCode {

	function __construct( $settings ) {
		parent::__construct( $settings );

		global $post;
		if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'tm_mailchimp_form_popup' ) ) {
			add_action( 'wp_footer', array( $this, 'mailchimp_form_popup_template' ) );
		}
	}

	function mailchimp_form_popup_template() {
		$form_id = '';

		if ( function_exists( 'mc4wp_get_forms' ) ) {
			$mc_forms = mc4wp_get_forms();
			if ( count( $mc_forms ) > 0 ) {
				$form_id = $mc_forms[0]->ID;
			}
		}

		if ( $form_id === '' ) {
			return;
		}
		?>
		<div class="mailchimp-form-popup">
			<div class="inner">
				<div id="mailchimp-form-popup-close" class="mailchimp-form-popup-close">
					<span class="fal fa-times"></span>
				</div>
				<div class="form-subscribe">
					<?php mc4wp_show_form( $form_id ); ?>
				</div>
			</div>
		</div>
		<?php
	}
}

vc_map( array(
	'name'                      => esc_html__( 'Mailchimp Form Popup', 'brook' ),
	'base'                      => 'tm_mailchimp_form_popup',
	'category'                  => BROOK_VC_SHORTCODE_CATEGORY,
	'icon'                      => 'insight-i insight-i-mailchimp-form',
	'allowed_container_element' => 'vc_row',
	'params'                    => array(
		array(
			'heading'     => esc_html__( 'Style', 'brook' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( '01', 'brook' ) => '01',
			),
			'std'         => '01',
		),
		array(
			'heading'    => esc_html__( 'Heading', 'brook' ),
			'type'       => 'textfield',
			'param_name' => 'heading',
			'std'        => esc_html__( 'Subscribe', 'brook' ),
		),
		array(
			'heading'     => esc_html__( 'Form Id', 'brook' ),
			'description' => esc_html__( 'Input the id of form. Leave blank to show default form.', 'brook' ),
			'type'        => 'textfield',
			'param_name'  => 'form_id',
		),
		Brook_VC::extra_class_field(),
	),
) );
