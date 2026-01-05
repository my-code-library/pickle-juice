<?php
if (!defined('ABSPATH')) exit;

if (defined('PJ_PASSWORDLESS_TOGGLE_LOADED')) return;
define('PJ_PASSWORDLESS_TOGGLE_LOADED', true);

/**
 * --------------------------------------------------
 * Passwordless Mode (Hide Password + Disable Login Button)
 * --------------------------------------------------
 */

add_action('login_form', function() {

    if (get_option('pj_disable_password_login') !== '1') {
        return;
    }

    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {

        function removePasswordField() {
            const passField = document.getElementById("user_pass");
            if (passField) {
                const wrapper = passField.closest("p");
                if (wrapper) wrapper.remove();
            }
        }

        function removeLoginButton() {
            const loginBtn = document.getElementById("wp-submit");
            if (loginBtn) loginBtn.remove();
        }

        // Run immediately
        removePasswordField();
        removeLoginButton();

        // Watch for late‑loaded elements
        const observer = new MutationObserver(() => {
            removePasswordField();
            removeLoginButton();
        });

        observer.observe(document.body, { childList: true, subtree: true });
    });
    </script>';

    echo '<p style="margin-top:10px; font-weight:bold;">
        Password login is disabled. Use the magic link button below.
    </p>';
});



add_filter('authenticate', function($user, $username, $password) {

    if (get_option('pj_disable_password_login') !== '1') {
        return $user;
    }

    if (!empty($password)) {
        return new WP_Error(
            'password_disabled',
            __('Password login is disabled. Please use a magic link.')
        );
    }

    return $user;

}, 5, 3);


