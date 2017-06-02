<?php

// get date picker depencies
CMB2_JS::add_dependencies( array( 'jquery-ui-core', 'jquery-ui-datepicker' ) );
?>

<style>
	#ui-datepicker-div { z-index: 99999 !important; }
	#wpbody-content { overflow: hidden !important; }
	.cmb_id_announcement_image td .cmb_upload_button { height: 32px !important; }
	#announcement_date { width: auto !important; }
</style>

<?php
if ( $meta && isset( $meta ) ) {
	$value = ( '' !== $meta ) ? apply_filters( 'timeline_express_admin_render_date_format', date( get_option( 'date_format' ), $meta ), $meta ) : $field->args['default'];
	echo '<input class="cmb2-text-small cmb2-datepicker" type="text" name="' . esc_attr( $field->args['id'] ) . '" id="' . esc_attr( $field->args['id'] ) . '" value="' . esc_attr( $value ) . '" />';
} else {
	echo '<input class="cmb2-text-small cmb2-datepicker" type="text" name="' . esc_attr( $field->args['id'] ) . '" id="' .  esc_attr( $field->args['id'] ) . '" value="' . esc_attr( apply_filters( 'timeline_express_admin_render_date_format', date( get_option( 'date_format' ) ), false ) ) .'" />';
}
echo '<p class="cmb2-metabox-description">' . esc_attr( $field->args['desc'] ) . '</p>';
