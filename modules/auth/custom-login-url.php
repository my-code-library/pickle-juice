<?php
if (!defined('ABSPATH')) exit;

if (defined('PJ_CUSTOM_LOGIN_LOADED')) return;
define('PJ_CUSTOM_LOGIN_LOADED', true);

/**
 * --------------------------------------------------
 * Custom Login URL Module
 * --------------------------------------------------
 *
 * Allows replacing wp-login.php with a custom slug.
 * Prevents redirect loops.
 * Ensures magic links, password resets, and core
 * auth actions still work.
 *
 */

add_action('login_init', function() {

    $slug = trim(get_option('pj_custom_login_slug', ''), '/');
    if (!$slug) return;

    $request_uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

    // If user is already on the custom login URL, allow
    if ($request_uri === $slug) {
        return;
    }

    // Allow magic links
    if (isset($_GET['pj_magic'])) {
        return;
    }

    // Allow password reset
    if (isset($_GET['action']) && in_array($_GET['action'], ['rp', 'resetpass'], true)) {
        return;
    }

    // Allow login POST
    if (!empty($_POST['log']) || !empty($_POST['pj_magic_request'])) {
        return;
    }

    // Otherwise redirect to custom login URL
    wp_redirect(home_url("/{$slug}/"));
    exit;
});

