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
use Altum\Middlewares\Authentication;
use Altum\Middlewares\Csrf;
use Altum\Title;

class Campaign extends Controller {

    public function index() {

        Authentication::guard();

        $campaign_id = isset($this->params[0]) ? (int) $this->params[0] : null;
        $method = isset($this->params[1]) && in_array($this->params[1], ['settings', 'statistics']) ? $this->params[1] : 'settings';

        /* Make sure the campaign exists and is accessible to the user */
        if(!$campaign = db()->where('campaign_id', $campaign_id)->where('user_id', $this->user->id)->getOne('campaigns')) {
            redirect('campaigns');
        }

        /* Get the custom branding details */
        $campaign->branding = json_decode($campaign->branding);

        /* Handle code for different parts of the page */
        switch($method) {
            case 'settings':

                /* Prepare the filtering system */
                $filters = (new \Altum\Filters(['is_enabled', 'type'], ['name'], ['name', 'datetime']));
                $filters->set_default_order_by('notification_id', settings()->main->default_order_type);
                $filters->set_default_results_per_page(settings()->main->default_results_per_page);

                /* Prepare the paginator */
                $total_rows = database()->query("SELECT COUNT(*) AS `total` FROM `notifications` WHERE `campaign_id` = {$campaign->campaign_id} AND `user_id` = {$this->user->id} {$filters->get_sql_where()}")->fetch_object()->total ?? 0;

                $paginator = (new \Altum\Paginator($total_rows, $filters->get_results_per_page(), $_GET['page'] ?? 1, url('campaign/' . $campaign->campaign_id . '?' . $filters->get_get() . '&page=%d')));

                /* Get the notifications list for the user */
                $notifications = [];
                $notifications_result = database()->query("SELECT * FROM `notifications` WHERE `campaign_id` = {$campaign->campaign_id} AND `user_id` = {$this->user->id} {$filters->get_sql_where()} {$filters->get_sql_order_by()} {$paginator->get_sql_limit()}");
                while($row = $notifications_result->fetch_object()) $notifications[] = $row;

                /* Prepare the pagination view */
                $pagination = (new \Altum\Views\View('partials/pagination', (array) $this))->run(['paginator' => $paginator]);

                /* Prepare the method View */
                $data = [
                    'campaign'      => $campaign,
                    'notifications' => $notifications,
                    'notifications_total' => $total_rows,
                    'pagination'    => $pagination,
                    'filters' => $filters
                ];

                $view = new \Altum\Views\View('campaign/' . $method . '.method', (array) $this);

                $this->add_view_content('method', $view->run($data));

                break;

            case 'statistics':

                $datetime = \Altum\Date::get_start_end_dates_new();

                /* Query for the statistics of the notification */
                $logs = [];
                $logs_chart = [];
                $logs_total = [
                    'impression'        => 0,
                    'hover'             => 0,
                    'click'             => 0,
                    'form_submission'   => 0
                ];

                /* Logs for the charts */
                $logs_result = database()->query("
                    SELECT
                         `type`,
                         COUNT(`id`) AS `total`,
                         DATE_FORMAT(`datetime`, '{$datetime['query_date_format']}') AS `formatted_date`
                    FROM
                         `track_notifications`
                    WHERE
                        `campaign_id` = {$campaign->campaign_id}
                        AND (`datetime` BETWEEN '{$datetime['query_start_date']}' AND '{$datetime['query_end_date']}')
                    GROUP BY
                        `formatted_date`,
                        `type`
                    ORDER BY
                        `formatted_date`
                ");

                /* Generate the raw chart data and save logs for later usage */
                while($row = $logs_result->fetch_object()) {
                    $logs[] = $row;

                    $row->formatted_date = $datetime['process']($row->formatted_date);

                    /* Handle if the date key is not already set */
                    if(!array_key_exists($row->formatted_date, $logs_chart)) {
                        $logs_chart[$row->formatted_date] = [
                            'impression'        => 0,
                            'hover'             => 0,
                            'click'             => 0,
                            'form_submission'   => 0,
                        ];
                    }

                    $logs_chart[$row->formatted_date][$row->type] = $row->total;

                    /* Count totals */
                    if(in_array($row->type, ['impression', 'hover', 'click', 'form_submission'])) {
                        $logs_total[$row->type] += $row->total;
                    }
                }

                $logs_chart = get_chart_data($logs_chart);

                /* Prepare the method View */
                $data = [
                    'campaign'      => $campaign,
                    'logs'          => $logs,
                    'logs_chart'    => $logs_chart,
                    'logs_total'    => $logs_total,
                    'datetime'      => $datetime,
                ];

                $view = new \Altum\Views\View('campaign/' . $method . '.method', (array) $this);

                $this->add_view_content('method', $view->run($data));

                break;
        }

        /* Prepare the View */
        $data = [
            'campaign'      => $campaign,
            'method'        => $method
        ];

        $view = new \Altum\Views\View('campaign/index', (array) $this);

        $this->add_view_content('content', $view->run($data));

        /* Set a custom title */
        Title::set(sprintf(l('campaign.title'), $campaign->name));

    }

    public function duplicate() {
        Authentication::guard();

        /* Team checks */
        if(\Altum\Teams::is_delegated() && !\Altum\Teams::has_access('create')) {
            Alerts::add_info(l('global.info_message.team_no_access'));
            redirect('campaigns');
        }

        if(empty($_POST)) {
            redirect('campaigns');
        }

        $campaign_id = (int) Database::clean_string($_POST['campaign_id']);

        //ALTUMCODE.DEMO: if(DEMO) if($this->user->user_id == 1) Alerts::add_error('Please create an account on the demo to test out this function.');

        if(!Csrf::check()) {
            Alerts::add_error(l('global.error_message.invalid_csrf_token'));
            redirect('campaigns');
        }

        /* Get & make sure the campaign exists */
        if(!$campaign = db()->where('campaign_id', $campaign_id)->where('user_id', $this->user->id)->getOne('campaigns')) {
            redirect('campaigns');
        }

        if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

            /* Determine the default settings */
            $pixel_key = string_generate(32);
            while(db()->where('pixel_key', $pixel_key)->getValue('campaigns', 'pixel_key')) {
                $pixel_key = string_generate(32);
            }
            $name = $campaign->name . '-' . string_generate(3);

            /* Insert to database */
            $campaign_id = db()->insert('campaigns', [
                'user_id' => $this->user->id,
                'pixel_key' => $pixel_key,
                'name' => $name,
                'domain' => $campaign->domain,
                'include_subdomains' => $campaign->include_subdomains,
                'branding' => $campaign->branding,
                'is_enabled' => 0,
                'datetime' => \Altum\Date::$date,
            ]);

            /* Get all notifications of this campaign */
            $notifications = db()->where('campaign_id', $campaign->campaign_id)->get('notifications');

            /* Duplicate all of them */
            foreach($notifications as $notification) {
                $notification_key = md5($this->user->id . $notification->notification_id . $campaign_id . time());

                /* Insert to database */
               db()->insert('notifications', [
                    'user_id' => $this->user->id,
                    'campaign_id' => $campaign_id,
                    'name' => $notification->name,
                    'type' => $notification->type,
                    'settings' => $notification->settings,
                    'notification_key' => $notification_key,
                    'is_enabled' => 0,
                    'datetime' => \Altum\Date::$date,
                ]);
            }

            /* Set a nice success message */
            Alerts::add_success(sprintf(l('global.success_message.create1'), '<strong>' . filter_var($name, FILTER_SANITIZE_STRING) . '</strong>'));

            /* Redirect */
            redirect('campaign/' . $campaign_id);

        }

        redirect('campaigns');
    }

    public function delete() {
        Authentication::guard();

        /* Team checks */
        if(\Altum\Teams::is_delegated() && !\Altum\Teams::has_access('delete')) {
            Alerts::add_info(l('global.info_message.team_no_access'));
            redirect('campaigns');
        }

        if(empty($_POST)) {
            redirect('campaigns');
        }

        $campaign_id = (int) Database::clean_string($_POST['campaign_id']);

        //ALTUMCODE.DEMO: if(DEMO) if($this->user->user_id == 1) Alerts::add_error('Please create an account on the demo to test out this function.');

        if(!Csrf::check()) {
            Alerts::add_error(l('global.error_message.invalid_csrf_token'));
            redirect('campaigns');
        }

        if(!$campaign = db()->where('campaign_id', $campaign_id)->where('user_id', $this->user->id)->getOne('campaigns', ['campaign_id', 'name'])) {
            redirect('campaigns');
        }

        if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

            /* Delete from database */
            db()->where('campaign_id', $campaign_id)->where('user_id', $this->user->id)->delete('campaigns');

            /* Clear the cache */
            \Altum\Cache::$adapter->deleteItemsByTag('campaign_id=' . $campaign_id);

            /* Set a nice success message */
            Alerts::add_success(sprintf(l('global.success_message.delete1'), '<strong>' . $campaign->name . '</strong>'));

            redirect('campaigns');

        }

        redirect('campaigns');
    }
}
