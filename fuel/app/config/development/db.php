<?php
/**
 * The development database settings. These get merged with the global settings.
 */

return array(
    'default' => array(
        'type'           => 'pdo',
        'connection'  => array(
            'dsn' => 'mysql:host=localhost;dbname=fido',
            'username'       => 'rp-updator',
            'password'       => '********', // 設定したパスワード
            'persistent'     => false,
            'compress'       => false,
        ),
        'identifier'     => '`',
        'table_prefix'   => '',
        'charset'        => 'utf8',
        'enable_cache'   => true,
        'profiling'      => false,
        'readonly'       => 'fidodb-slave',
    ),

    'fidodb-slave' => array(
        'type'       => 'pdo',
        'connection' => array(
            'dsn'        => 'mysql:dbname=fido;host=localhost',
            'username'   => 'rp-selector',
            'password'   => '********',
            'persistent' => false,
            'compress'   => false,
        ),
        'identifier'     => '`',
        'table_prefix'   => '',
        'charset'        => 'utf8',
        'enable_cache'   => true,
        'profiling'      => false,
    ),
);