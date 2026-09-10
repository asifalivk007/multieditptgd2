<?php
/**
 * TEMPLATE — copy to umami_config.php and fill in real values.
 *
 *     cp umami_config.example.php umami_config.php
 *
 * umami_config.php is git-ignored and must NEVER be committed.
 * It is also blocked from web access by the root .htaccess.
 *
 * `website_id` is not sensitive (it is already public in header.php as
 * data-website-id); the username/password are.
 */
return [
    'username'   => 'CHANGE_ME',
    'password'   => 'CHANGE_ME',
    'website_id' => 'CHANGE_ME',
    // Optional — the Umami server to query. Defaults to the production host
    // configured in globe-data.php if omitted.
    // 'umami_url' => 'https://analytics.example.org',
];
