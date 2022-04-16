<?php
define('ROOT', realpath(__DIR__ . '/..') . '/');
require_once ROOT . 'vendor/autoload.php';
require_once ROOT . 'app/includes/product.php';

function get_ip() {
    if(array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {

        if(strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')) {
            $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

            return trim(reset($ips));
        } else {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

    } else if (array_key_exists('REMOTE_ADDR', $_SERVER)) {
        return $_SERVER['REMOTE_ADDR'];
    } else if (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    return '';
}

$altumcode_api = 'https://api.altumcode.com/validate';

/* Make sure the product wasn't already installed */
if(file_exists(ROOT . 'install/installed')) {
    die();
}

/* Make sure all the required fields are present */
$required_fields = ['license_key', 'database_host', 'database_name', 'database_username', 'database_password', 'installation_url'];

foreach($required_fields as $field) {
    if(!isset($_POST[$field])) {
        die(json_encode([
            'status' => 'error',
            'message' => 'One of the required fields are missing.'
        ]));
    }
}

/* Make sure the database details are correct */
$database = @new mysqli(
    $_POST['database_host'],
    $_POST['database_username'],
    $_POST['database_password'],
    $_POST['database_name']
);

if($database->connect_error) {
    die(json_encode([
        'status' => 'error',
        'message' => 'The database connection has failed!'
    ]));
}

/* Make sure the license is correct */
$response = Unirest\Request::post($altumcode_api, [], [
    'license'           => $_POST['license_key'],
    'url'               => $_POST['installation_url'],
    'product_key'       => PRODUCT_KEY,
    'product_name'      => PRODUCT_NAME,
    'product_version'   => '16.0.0',
    'client_email'      => $_POST['newsletter_email'],
    'client_name'       => $_POST['newsletter_name'],
    'server_ip'         => $_SERVER['SERVER_ADDR'],
    'client_ip'         => get_ip(),
]);

if($response->body->status == 'error') {
    die(json_encode([
        'status' => 'error',
        'message' => $response->body->message
    ]));
}

/* Success check */
if($response->body->status == 'success') {

    /* Prepare the config file content */
    $config_content =
        <<<ALTUM
<?php

/* Configuration of the site */
define('DATABASE_SERVER',   '{$_POST['database_host']}');
define('DATABASE_USERNAME', '{$_POST['database_username']}');
define('DATABASE_PASSWORD', '{$_POST['database_password']}');
define('DATABASE_NAME',     '{$_POST['database_name']}');
define('SITE_URL',          '{$_POST['installation_url']}');

ALTUM;

    /* Write the new config file */
    file_put_contents(ROOT . 'config.php', $config_content);

    /* Run SQL */
    $dump_content = file_get_contents(ROOT . 'install/dump.sql');

    $dump = explode('-- SEPARATOR --', $dump_content);

    foreach($dump as $query) {
        $database->query($query);

        if($database->error) {
            die(json_encode([
                'status' => 'error',
                'message' => 'Error when running the database queries: ' . $database->error
            ]));
        }
    }

    /* Run external SQL if needed */
    if(!empty($response->body->sql)) {
        $dump = explode('-- SEPARATOR --', $response->body->sql);

        foreach($dump as $query) {
            $database->query($query);

            if($database->error) {
                die(json_encode([
                    'status' => 'error',
                    'message' => 'Error when running the database queries: ' . $database->error
                ]));
            }
        }
    }

    /* Create the installed file */
    file_put_contents(ROOT . 'install/installed', '');

    die(json_encode([
        'status' => 'success',
        'message' => ''
    ]));
}
