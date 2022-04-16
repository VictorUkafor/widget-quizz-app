<?php
/*
 * @copyright Copyright (c) 2021 AltumCode (https://altumcode.com/)
 *
 * This software is exclusively sold through https://altumcode.com/ by the AltumCode author.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://altumcode.com/.
 */

namespace Altum\Controllers;

use Altum\Alerts;
use Altum\Database\Database;
use Altum\Logger;

class ActivateUser extends Controller {

    public function index() {

        $md5email = isset($_GET['email']) ? $_GET['email'] : null;
        $email_activation_code = isset($_GET['email_activation_code']) ? $_GET['email_activation_code'] : null;
        $type = isset($_GET['type']) && in_array($_GET['type'], ['user_activation', 'user_pending_email']) ? $_GET['type'] : 'user_activation';

        $redirect = 'dashboard';
        if(isset($_GET['redirect']) && $redirect = $_GET['redirect']) {
            $redirect = Database::clean_string($redirect);
        }

        if(!$md5email || !$email_activation_code) redirect();

        /* Check if the activation code is correct */
        switch($type) {
            case 'user_activation':

                if(!$user = db()->where('email_activation_code', $email_activation_code)->getOne('users', ['id', 'email', 'name', 'password'])) {
                    redirect();
                }

                if(md5($user->email) != $md5email) {
                    redirect();
                }

                $last_user_agent = Database::clean_string($_SERVER['HTTP_USER_AGENT']);

                /* Activate the account and reset the email_activation_code */
                db()->where('id', $user->id)->update('users', [
                    'status' => 1,
                    'email_activation_code' => null,
                    'last_user_agent' => $last_user_agent,
                    'total_logins' => db()->inc()
                ]);

                /* Send webhook notification if needed */
                if(settings()->webhooks->user_new) {

                    \Unirest\Request::post(settings()->webhooks->user_new, [], [
                        'id' => $user->id,
                        'email' => $user->email,
                        'name' => $user->name
                    ]);

                }

                Logger::users($user->id, 'activate.success');

                /* Login and set a successful message */
                $_SESSION['id'] = $user->id;
                $_SESSION['user_password_hash'] = md5($user->password);

                /* Set a nice success message */
                Alerts::add_success(l('activate_user.user_activation'));

                Logger::users($user->id, 'login.success');

                /* Clear the cache */
                \Altum\Cache::$adapter->deleteItemsByTag('id=' . $user->id);

                redirect($redirect);

                break;

            case 'user_pending_email':

                if(!$user = db()->where('email_activation_code', $email_activation_code)->getOne('users', ['id', 'pending_email'])) {
                    redirect();
                }

                if(md5($user->pending_email) != $md5email) {
                    redirect();
                }

                /* Confirm the new email address and reset the email_activation_code */
                db()->where('id', $user->id)->update('users', [
                    'email' => $user->pending_email,
                    'pending_email' => null,
                    'email_activation_code' => null,
                ]);

                Logger::users($user->id, 'email_change.success');

                /* Set a nice success message */
                Alerts::add_success(l('activate_user.user_pending_email'));

                /* Clear the cache */
                \Altum\Cache::$adapter->deleteItemsByTag('id=' . $user->id);

                redirect('account');

                break;
        }

    }

}
