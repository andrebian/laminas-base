<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => false,
    ],
    'session' => [
        'lifetime' => 3600 * 8, // Duração de 8h
    ],
    'db' => [
        'user' => '',
        'password' => '',
        'dsn' => ''
    ]
];
