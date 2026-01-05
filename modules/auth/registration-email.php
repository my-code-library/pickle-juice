<?php
if (!defined('ABSPATH')) exit;

if (defined('PJ_REG_EMAIL_LOADED')) return;
define('PJ_REG_EMAIL_LOADED', true);

/**
 * --------------------------------------------------
 * Customize WordPress Registration Email
 * --------------------------------------------------
 */

add_filter('wp_new_user_notification_email', function($wp_new_user_notification_email, $user, $blogname) {

    $email = $user->user_email;

    // Generate password reset link
    $reset_key = get_password_reset_key($user);
    $reset_url = wp_login_url() . "?action=rp&key=$reset_key&login=" . rawurlencode($user->user_login);

    $wp_new_user_notification_email['subject'] = sprintf(__('Welcome to %s!'), $blogname);

    $wp_new_user_notification_email['message'] = sprintf(
        "Welcome to %s!\n\n".
        "Your account has been created.\n\n".
        "Your username is: %s\n\n".
        "To set your password, click the link below:\n%s\n\n".
        "If you didn't request this, you can ignore this email.\n",
        $blogname,
        $email,
        $reset_url
    );

    return $wp_new_user_notification_email;

}, 10, 3);
