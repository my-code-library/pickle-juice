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

// Flush rewrite rules when slug changes
add_action('update_option_pj_custom_login_slug', function() {
    flush_rewrite_rules();
});

// Register rewrite rule
add_action('init', function() {
    $slug = trim(get_option('pj_custom_login_slug', ''), '/');
    if (!$slug) return;

    add_rewrite_rule("^{$slug}/?$", 'wp-login.php', 'top');
});

// Redirect logic
add_action('login_init', function() {

    $slug = trim(get_option('pj_custom_login_slug', ''), '/');
    if (!$slug) return;

    $request_uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

    if ($request_uri === $slug) return;
    if (isset($_GET['pj_magic'])) return;
    if (isset($_GET['action']) && in_array($_GET['action'], ['rp','resetpass'], true)) return;
    if (!empty($_POST['log']) || !empty($_POST['pj_magic_request'])) return;

    $requested_file = basename($request_uri);
    if ($requested_file !== 'wp-login.php') return;

    wp_redirect(home_url("/{$slug}/"));
    exit;
});
