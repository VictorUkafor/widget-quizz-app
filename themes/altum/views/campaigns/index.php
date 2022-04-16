<?php defined('ALTUMCODE') || die() ?>

<style>
body{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif
}
h3{
    font-size: 27px;
    font-weight: 600;
}
p{
    font-size: 14px;
    margin-bottom: 0;
}
a{
    text-decoration: none;
}
button{
    border: none;
    padding: 10px;
    font-size: 13px;
}
button > a{
    color: white;
}
.home{
    overflow-x: hidden;
    margin-left: 0px;
}
.mobile-tag{
    display: none;
}
.mobile-tag .ham{
    width: 30px;
}
.mobile-tag .logo-mobile{
    width: 80px;
}
.main-wrapper{
    display: flex;
    background: #F9F9F9;
    min-height: 100vh;
}
.dashboard-tags{
    width: 22%;
    background: #F6F4FF;
    border-top-right-radius: 30px;
}

.google_translate:hover{
    cursor: pointer!important;
}

.dashboard_tags{
    display: none;
}
.header{
    display: none;
}
.dashboard-tags img.logo{
    width: 100px;
    margin-left: 20px;
    margin-top: 30px;
    margin-bottom: 50px;
}
.tags{
    display: flex;
    flex-direction: column;
    margin-bottom: 7rem;
}

.tags a{
    text-decoration: none;
}

.dashboard_tags .tags-item{
    margin: 10px auto;
}
.dashboard-tags .controls > div{
    padding: 0 1rem;
    padding-right: 2rem;
}

.tags a{
    color: black;
}
.tag-item{
    display: flex;
    align-items: center;
    padding-left: 20px;
    margin-bottom: 10px;
    padding-top: 0.5rem!important;
    padding-bottom: 0.5rem!important;
    width: 170px;
}

.tag-item:hover p{
    text-decoration: none;
}

.tag-item:hover, .current{
    background: #5D5FEF;
    color: white;
    border-bottom-right-radius: 10px;
    border-top-right-radius: 10px;
}
.tag-item span, .tag-item img{
    margin-right: 10px;
    width: 20px;
}
.main-wrapper .controls{
    /* position: absolute;
    bottom: 40px;
    left: 10px; */
}
.controls > div{
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}
.controls > div img{
    width: 15px;
}
.controls > div p{
    margin-left: 10px;
    margin-right: 10px;
}
.controls .user{
    position: relative;
}

.controls a{
    text-decoration: none;
    color: #000;
}

.user .toggler_wrapper{
    position: absolute;
    /* bottom: -70px;
    right: 20px; */
    margin-top: 8rem;
    /* width: 80%; */
    background-color: white;
    border-radius: 5px;
    cursor: pointer;  
    /* display: none;  */
}

.user .toggler_wrapper .edit_user{
    border-radius: 5px;
}


/* .user:hover .toggler_wrapper{
    display: block; 
} */

.edit-user p{
    font-size: 12px;
}
.user .user-detail a, .user .logout a{
    display: flex;
    align-items: center;
    padding: 5px 10px;
}
.user-detail a{
    background: #5D5FEF;
    color: white;
    text-decoration: none;
} 

.custom-control-input:checked~.custom-control-label::before {
    border-color: #5D5FEF!important;
    background-color: #5D5FEF!important;
}

.table-custom thead th {
    background: #F6F4FF!important;
}

</style>

<div class="main-wrapper">
    <div class="dashboard-tags" style="width: 22%;background: #F6F4FF;
    border-top-right-radius: 30px;height:100%;">

        <a href="/projects">
            <img class="logo" src="<?= ASSETS_FULL_URL . 'images/logo2.svg' ?>" alt="quizz logo">
        </a>

        <div class="tags">                
               <a href="http://quizz-app.test/analytics">
                    <div class="tag-item">
                        <span><i class="fas fa-chart-bar"></i></span>
                        <p>Analytics</p>
                    </div>
                </a>
               <a href="http://quizz-app.test/projects">
                    <div class="tag-item">
                        <span><i class="fas fa-th"></i></span>
                        <p>Projects</p>
                    </div>
                </a>
                <a href="http://product.quizz-app.test">
                    <div class="tag-item current">
                        <span><i class="fas fa-sliders-h"></i></span>
                        <p>Widget</p>
                    </div>
                </a>
                <a href="http://quizz-app.test/team">
                    <div class="tag-item">
                        <span><i class="fas fa-users"></i></span>
                        <p>Team</p>
                    </div>
                </a>
                <a href="http://quizz-app.test/reseller">
                    <div class="tag-item">
                        <span><i class="fas fa-money-check-alt"></i></span>
                        <p>Reseller</p>
                    </div>
                </a>
                <a href="http://quizz-app.test/integrations">
                    <div class="tag-item">
                        <span><i class="fas fa-sliders-h"></i></span>
                        <p>Integration</p>
                    </div>
                </a>
                <a href="http://quizz-app.test/support">
                    <div class="tag-item">
                        <span><i class="fas fa-comment"></i></span>
                        <p>Support</p>
                    </div>
                </a>
        </div>

        <div class="controls">

            <div id="google_translate_element" class="google_translate"
            style="border:none;background-color:none;">
                <img src="<?= ASSETS_FULL_URL . 'images/flag.svg' ?>" alt="" 
                style="margin-top: -1rem;margin-right:0.5rem;">
            </div>

            <a href="http://quizz-app.test/profile" class="tag-item">
                <img src="<?= ASSETS_FULL_URL . 'images/01.png' ?>" 
                style="vertical-align: text-top;" alt="user-photo">
                <div style="display:flex;cursor:pointer;"> 
                    <p style="color: #000">My Profile</p>
                </div>
            </a>           
            <a href="/logout" class="tag-item"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt fg-lg"></i>
                <p style="padding-left:1rem">Log Out</p>
            </a>
            <form id="logout-form" action="/logout" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        
    </div>

    <section class="container pt-5">

        <div class="d-flex justify-content-between">
                <h1 class="h2"></h1>

                <div class="col-auto p-0 d-flex">
                    <div>
                        <?php if($this->user->plan_settings->campaigns_limit != -1 && $data->campaigns_total >= $this->user->plan_settings->campaigns_limit): ?>
                            <button type="button" data-toggle="tooltip" title="<?= l('global.info_message.plan_feature_limit') ?>" class="btn btn-primary disabled">
                                <i class="fa fa-fw fa-sm fa-plus"></i> <?= l('campaigns.create') ?>
                            </button>
                        <?php else: ?>
                            <button type="button" data-toggle="modal" 
                            style="background-color: #5D5FEF!important;border-color: #5D5FEF!important;"
                            data-target="#create_campaign_modal" class="btn btn-primary"><i class="fa fa-fw fa-sm fa-plus"></i> <?= l('campaigns.create') ?></button>
                        <?php endif ?>
                    </div>

                    <div class="ml-3">
                        <div class="dropdown">
                            <button type="button" class="btn <?= count($data->filters->get) ? 'btn-outline-primary' : 'btn-outline-secondary' ?> filters-button dropdown-toggle-simple" data-toggle="dropdown" data-boundary="viewport"><i class="fa fa-fw fa-sm fa-filter"></i></button>

                            <div class="dropdown-menu dropdown-menu-right filters-dropdown">
                                <div class="dropdown-header d-flex justify-content-between">
                                    <span class="h6 m-0"><?= l('global.filters.header') ?></span>

                                    <?php if(count($data->filters->get)): ?>
                                        <a href="<?= url('campaigns') ?>" class="text-muted"><?= l('global.filters.reset') ?></a>
                                    <?php endif ?>
                                </div>

                                <div class="dropdown-divider"></div>

                                <form action="" method="get" role="form">
                                    <div class="form-group px-4">
                                        <label for="filters_search" class="small"><?= l('global.filters.search') ?></label>
                                        <input type="search" name="search" id="filters_search" class="form-control form-control-sm" value="<?= $data->filters->search ?>" />
                                    </div>

                                    <div class="form-group px-4">
                                        <label for="filters_search_by" class="small"><?= l('global.filters.search_by') ?></label>
                                        <select name="search_by" id="filters_search_by" class="form-control form-control-sm">
                                            <option value="name" <?= $data->filters->search_by == 'name' ? 'selected="selected"' : null ?>><?= l('campaigns.input.name') ?></option>
                                            <option value="domain" <?= $data->filters->search_by == 'domain' ? 'selected="selected"' : null ?>><?= l('campaigns.input.domain') ?></option>
                                        </select>
                                    </div>

                                    <div class="form-group px-4">
                                        <label for="filters_is_enabled" class="small"><?= l('global.filters.status') ?></label>
                                        <select name="is_enabled" id="filters_is_enabled" class="form-control form-control-sm">
                                            <option value=""><?= l('global.filters.all') ?></option>
                                            <option value="1" <?= isset($data->filters->filters['is_enabled']) && $data->filters->filters['is_enabled'] == '1' ? 'selected="selected"' : null ?>><?= l('global.active') ?></option>
                                            <option value="0" <?= isset($data->filters->filters['is_enabled']) && $data->filters->filters['is_enabled'] == '0' ? 'selected="selected"' : null ?>><?= l('global.disabled') ?></option>
                                        </select>
                                    </div>

                                    <div class="form-group px-4">
                                        <label for="filters_order_by" class="small"><?= l('global.filters.order_by') ?></label>
                                        <select name="order_by" id="filters_order_by" class="form-control form-control-sm">
                                            <option value="datetime" <?= $data->filters->order_by == 'datetime' ? 'selected="selected"' : null ?>><?= l('global.filters.order_by_datetime') ?></option>
                                            <option value="name" <?= $data->filters->order_by == 'name' ? 'selected="selected"' : null ?>><?= l('campaigns.input.name') ?></option>
                                        </select>
                                    </div>

                                    <div class="form-group px-4">
                                        <label for="filters_order_type" class="small"><?= l('global.filters.order_type') ?></label>
                                        <select name="order_type" id="filters_order_type" class="form-control form-control-sm">
                                            <option value="ASC" <?= $data->filters->order_type == 'ASC' ? 'selected="selected"' : null ?>><?= l('global.filters.order_type_asc') ?></option>
                                            <option value="DESC" <?= $data->filters->order_type == 'DESC' ? 'selected="selected"' : null ?>><?= l('global.filters.order_type_desc') ?></option>
                                        </select>
                                    </div>

                                    <div class="form-group px-4">
                                        <label for="filters_results_per_page" class="small"><?= l('global.filters.results_per_page') ?></label>
                                        <select name="results_per_page" id="filters_results_per_page" class="form-control form-control-sm">
                                            <?php foreach($data->filters->allowed_results_per_page as $key): ?>
                                                <option value="<?= $key ?>" <?= $data->filters->results_per_page == $key ? 'selected="selected"' : null ?>><?= $key ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>

                                    <div class="form-group px-4 mt-4">
                                        <button type="submit" name="submit" class="btn btn-sm btn-primary btn-block"><?= l('global.submit') ?></button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?= \Altum\Alerts::output_alerts() ?>

        <?php if(count($data->campaigns)): ?>
            <div class="table-responsive table-custom-container mt-3">
                <table class="table table-custom">
                    <thead>
                    <tr>
                        <th><?= l('campaigns.table.campaign') ?></th>
                        <th class="d-none d-md-table-cell"><?= l('campaigns.table.datetime') ?></th>
                        <th><?= l('campaigns.table.is_enabled') ?></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach($data->campaigns as $row): ?>
                        <?php
                        $row->branding = json_decode($row->branding);

                        $icon = new \Jdenticon\Identicon([
                            'value' => $row->domain,
                            'size' => 50,
                            'style' => [
                                'hues' => [235],
                                'backgroundColor' => '#86444400',
                                'colorLightness' => [0.41, 0.80],
                                'grayscaleLightness' => [0.30, 0.70],
                                'colorSaturation' => 0.85,
                                'grayscaleSaturation' => 0.40,
                            ]
                        ]);
                        $row->icon = $icon->getImageDataUri();

                        ?>
                        <tr>
                            <td class="text-nowrap">
                                <div class="d-flex">
                                    <img src="<?= $row->icon ?>" class="campaign-avatar rounded-circle mr-3" alt="" />

                                    <div class="d-flex flex-column" 
                                    >
                                        <a style="color: #5D5FEF!important;" href="<?= url('campaign/' . $row->campaign_id) ?>"><?= $row->name ?></a>

                                        <span class="text-muted">
                                            <?= $row->domain ?>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-nowrap d-none d-md-table-cell"><span class="text-muted" data-toggle="tooltip" title="<?= \Altum\Date::get($row->datetime) ?>"><?= \Altum\Date::get($row->datetime, 2) ?></span></td>
                            <td class="text-nowrap">
                                <div class="d-flex">
                                    <div class="custom-control custom-switch" data-toggle="tooltip" title="<?= l('campaigns.table.is_enabled_tooltip') ?>">
                                        <input
                                                type="checkbox"
                                                class="custom-control-input"
                                                id="campaign_is_enabled_<?= $row->campaign_id ?>"
                                                data-row-id="<?= $row->campaign_id ?>"
                                                onchange="ajax_call_helper(event, 'campaigns-ajax', 'is_enabled_toggle')"
                                            <?= $row->is_enabled ? 'checked="checked"' : null ?>
                                        >
                                        <label class="custom-control-label clickable" for="campaign_is_enabled_<?= $row->campaign_id ?>"></label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <div class="dropdown">
                                    <button type="button" class="btn btn-link text-secondary dropdown-toggle dropdown-toggle-simple" data-toggle="dropdown" data-boundary="viewport">
                                        <i class="fa fa-fw fa-ellipsis-v"></i>
                                    </button>

                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="<?= url('campaign/' . $row->campaign_id) ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-server mr-2"></i> <?= l('global.view') ?></a>
                                        <a href="<?= url('campaign/' . $row->campaign_id . '/statistics') ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-chart-bar mr-2"></i> <?= l('campaign.statistics.link') ?></a>
                                        <a href="#" data-toggle="modal" data-target="#update_campaign" data-campaign-id="<?= $row->campaign_id ?>" data-name="<?= $row->name ?>" data-domain="<?= $row->domain ?>" data-include-subdomains="<?= (bool) $row->include_subdomains ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-pencil-alt mr-2"></i> <?= l('global.edit') ?></a>

                                        <a
                                            href="#"
                                            data-toggle="modal"
                                            data-target="#campaign_pixel_key"
                                            data-pixel-key="<?= $row->pixel_key ?>"
                                            data-campaign-id="<?= $row->campaign_id ?>"
                                            class="dropdown-item"
                                        ><i class="fa fa-fw fa-sm fa-code mr-2"></i> <?= l('campaign.pixel_key') ?></a>

                                        <?php if($this->user->plan_settings->custom_branding): ?>
                                            <a href="#" data-toggle="modal" data-target="#custom_branding_campaign" data-campaign-id="<?= $row->campaign_id ?>" data-branding-name="<?= $row->branding->name ?? '' ?>" data-branding-url="<?= $row->branding->url ?? '' ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-random mr-2"></i> <?= l('campaign.custom_branding') ?></a>
                                        <?php endif ?>
                                        <a href="#" data-toggle="modal" data-target="#campaign_duplicate_modal" data-campaign-id="<?= $row->campaign_id ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-copy mr-2"></i> <?= l('global.duplicate') ?></a>

                                        <a href="#" data-toggle="modal" data-target="#campaign_delete_modal" data-campaign-id="<?= $row->campaign_id ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-trash-alt mr-2"></i> <?= l('global.delete') ?></a>
                                    </div>
                                </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>

                    </tbody>
                </table>
            </div>

            <div class="mt-3"><?= $data->pagination ?></div>

        <?php else: ?>

            <div class="d-flex flex-column align-items-center justify-content-center py-3">
                <img src="<?= ASSETS_FULL_URL . 'images/no_rows.svg' ?>" class="col-10 col-md-7 col-lg-4 mb-3" alt="<?= l('global.no_data') ?>" />
                <h2 class="h4 text-muted"><?= l('global.no_data') ?></h2>
                <p class="text-muted"><?= l('campaigns.no_data') ?></a></p>
            </div>

        <?php endif ?>

    </section>
</div>


<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/campaign/create_campaign_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/campaign/campaign_delete_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/campaign/campaign_pixel_key_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/partials/duplicate_modal.php', ['modal_id' => 'campaign_duplicate_modal', 'resource_id' => 'campaign_id', 'endpoint' => 'campaign/duplicate']), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/campaign/update_campaign_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/campaign/custom_branding_campaign_modal.php'), 'modals'); ?>
