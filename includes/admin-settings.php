<?php
// Register settings
add_action('admin_init', function() {

    register_setting('pj_settings_group', 'pj_turnstile_site_key');
    register_setting('pj_settings_group', 'pj_turnstile_secret_key');

    add_settings_section(
        'pj_turnstile_section',
        'Cloudflare Turnstile',
        function() {
            echo '<p>Enter your Cloudflare Turnstile keys for login and registration protection.</p>';
        },
        'pj-settings'
    );

    add_settings_field(
        'pj_turnstile_site_key',
        'Turnstile Site Key',
        function() {
            $value = esc_attr(get_option('pj_turnstile_site_key', ''));
            echo '<input type="text" name="pj_turnstile_site_key" value="' . $value . '" class="regular-text">';
        },
        'pj-settings',
        'pj_turnstile_section'
    );

    add_settings_field(
        'pj_turnstile_secret_key',
        'Turnstile Secret Key',
        function() {
            $value = esc_attr(get_option('pj_turnstile_secret_key', ''));
            echo '<input type="text" name="pj_turnstile_secret_key" value="' . $value . '" class="regular-text">';
        },
        'pj-settings',
        'pj_turnstile_section'
    );
});

