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
    // Optional — defaults to https://asifalivk7analytics.duckdns.org
    // 'umami_url' => 'https://your-umami-host.example',
];
