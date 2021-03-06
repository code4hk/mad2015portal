<?php

/**
 * BuddyPress Settings Template Functions
 *
 * @package BuddyPress
 * @subpackage SettingsTemplate
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Output the settings component slug
 *
 * @package BuddyPress
 * @subpackage SettingsTemplate
 * @since BuddyPress (1.5)
 *
 * @uses bp_get_settings_slug()
 */
function bp_settings_slug() {
	echo bp_get_settings_slug();
}
	/**
	 * Return the settings component slug
	 *
	 * @package BuddyPress
	 * @subpackage SettingsTemplate
	 * @since BuddyPress (1.5)
	 */
	function bp_get_settings_slug() {
		return apply_filters( 'bp_get_settings_slug', buddypress()->settings->slug );
	}

/**
 * Output the settings component root slug
 *
 * @package BuddyPress
 * @subpackage SettingsTemplate
 * @since BuddyPress (1.5)
 *
 * @uses bp_get_settings_root_slug()
 */
function bp_settings_root_slug() {
	echo bp_get_settings_root_slug();
}
	/**
	 * Return the settings component root slug
	 *
	 * @package BuddyPress
	 * @subpackage SettingsTemplate
	 * @since BuddyPress (1.5)
	 */
	function bp_get_settings_root_slug() {
		return apply_filters( 'bp_get_settings_root_slug', buddypress()->settings->root_slug );
	}

/**
 * Add the 'pending email change' message to the settings page.
 *
 * @since BuddyPress (2.1.0)
 */
function bp_settings_pending_email_notice() {
	$pending_email = bp_get_user_meta( bp_displayed_user_id(), 'pending_email_change', true );

	if ( empty( $pending_email['newemail'] ) ) {
		return;
	}

	if ( bp_get_displayed_user_email() == $pending_email['newemail'] ) {
		return;
	}

	?>

	<div id="message" class="bp-template-notice error">
		<p><?php printf( __( 'There is a pending change of your email address to <code>%1$s</code>.<br />Check your email (<code>%2$s</code>) for the verification link. <a href="%3$s">Cancel</a>', 'buddypress' ), $pending_email['newemail'], bp_get_displayed_user_email(), esc_url( bp_displayed_user_domain() . bp_get_settings_slug() . '/?dismiss_email_change=1' ) ) ?></p>
	</div>

	<?php
}
add_action( 'bp_before_member_settings_template', 'bp_settings_pending_email_notice' );
