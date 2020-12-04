<?php
namespace App\Config;

class Config {
    // Database settings
    public function db() {
        return [
            'driver' => 'mysql',
            'host' => '127.0.0.1',
            'database' => 'hospital',
            'username' => 'root',
            'password' => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'unix_socket' => '/tmp/mysql.sock',
            'strict'    => true,
        ];
    }
    // Slim settings
    public function slim() {
        return [
            'settings' => [
                'determineRouteBeforeAppMiddleware' => false,
                'displayErrorDetails' => true,
                'db' => self::db()
            ],
        ];
    }
    // Auth settings
    public function auth() {
        return [
            'secret' => 'ahisyamsecrett',
            'expires' => 360, // in minutes
            'hash' => PASSWORD_DEFAULT,
            'jwt' => 'HS256',
            'secure' => false
        ];
    }
}
