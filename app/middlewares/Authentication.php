<?php
/*
 * @copyright Copyright (c) 2021 AltumCode (https://altumcode.com/)
 *
 * This software is exclusively sold through https://altumcode.com/ by the AltumCode author.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://altumcode.com/.
 */

namespace Altum\Middlewares;

use Altum\Database\Database;
use Altum\Models\User;

class Authentication extends Middleware {

    public static $is_logged_in = null;
    public static $id = null;
    public static $user = null;

    public static function check() {

        /* Verify if the current route allows use to do the check */
        if(\Altum\Routing\Router::$controller_settings['no_authentication_check']) {
            return false;
        }

        /* Already logged in from previous checks */
        if(self::$is_logged_in) {
            return self::$id;
        }

        /* Check the cookies first */
        if(
            isset($_COOKIE['id'])
            && isset($_COOKIE['token_code'])
            && mb_strlen($_COOKIE['token_code']) > 0
            && $user = (new User())->get_user_by_user_id_and_token_code($_COOKIE['id'], $_COOKIE['token_code'])
        ) {
            if(isset($_COOKIE['user_password_hash']) && $_COOKIE['user_password_hash'] == md5($user->password)) {
                self::$is_logged_in = true;
                self::$id = $user->id;

                self::$user = $user;

                return true;
            }
        }

        /* Check the Session */
        if(
            isset($_SESSION['id'])
            && !empty($_SESSION['id'])
            && $user = (new User())->get_user_by_user_id($_SESSION['id'])
        ) {
            if(isset($_SESSION['user_password_hash']) && $_SESSION['user_password_hash'] == md5($user->password)) {
                self::$is_logged_in = true;
                self::$id = $user->id;

                self::$user = $user;

                return true;
            }
        }

        return false;
    }


    public static function is_admin() {

        if(!self::check()) {
            return false;
        }

        return self::$user->type > 0;
    }


    public static function guard($permission = 'user') {

        switch ($permission) {
            case 'guest':

                if(self::check()) {
                    redirect(isset($_GET['redirect']) ? $_GET['redirect'] : 'dashboard');
                }

                break;

            case 'user':

                if(!self::check() || (self::check() && self::$user->status != 1)) {
                    redirect();
                }

                break;

            case 'admin':

                if(!self::check() || (self::check() && (self::$user->status != 1 || self::$user->type != '1'))) {
                    redirect();
                }

                break;
        }

    }


    public static function logout($page = '') {

        if(self::check()) {
            db()->where('id', self::$id)->update('users', ['token_code' => '']);

            /* Clear the cache */
            \Altum\Cache::$adapter->deleteItemsByTag('id=' . self::$id);
        }

        session_destroy();
        setcookie('id', '', time()-30, COOKIE_PATH);
        setcookie('token_code', '', time()-30, COOKIE_PATH);
        setcookie('user_password_hash', '', time()-30, COOKIE_PATH);

        if($page !== false) {
            redirect($page);
        }
    }
}
