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

.btn-primary {
    background-color:  #5D5FEF!important;
    border-color:  #5D5FEF!important;
}

</style>

<div class="main-wrapper">
    <div class="dashboard-tags" style="width: 22%;background: #F6F4FF;
    border-top-right-radius: 30px;height:100%;">

        <a href="/projects">
            <img class="logo" src="<?= ASSETS_FULL_URL . 'images/logo2.svg' ?>" alt="quizz logo">
        </a>

        <div class="tags">                
               <a href="/analytics">
                    <div class="tag-item">
                        <span><i class="fas fa-chart-bar"></i></span>
                        <p>Analytics</p>
                    </div>
                </a>
               <a href="/projects">
                    <div class="tag-item">
                        <span><i class="fas fa-th"></i></span>
                        <p>Projects</p>
                    </div>
                </a>
                <a href="/team">
                    <div class="tag-item">
                        <span><i class="fas fa-users"></i></span>
                        <p>Team</p>
                    </div>
                </a>
                <a href="/reseller">
                    <div class="tag-item">
                        <span><i class="fas fa-money-check-alt"></i></span>
                        <p>Reseller</p>
                    </div>
                </a>
                <a href="/integrations">
                    <div class="tag-item">
                        <span><i class="fas fa-sliders-h"></i></span>
                        <p>Integration</p>
                    </div>
                </a>
                <a href="/support">
                    <div class="tag-item">
                        <span><i class="fas fa-comment"></i></span>
                        <p>Support</p>
                    </div>
                </a>
        </div>

        <div class="controls">

            <div id="google_translate_element" class="google_translate"
            style="border:none;background-color:none;">
                <img src="<?= ASSETS_FULL_URL . 'images/flag.svg' ?>" alt="" style="margin-top: -1rem;margin-right:0.5rem;">
            </div>

            <a href="/profile" class="tag-item">
                <img src="<?= ASSETS_FULL_URL . 'images/01.png' ?>" style="vertical-align: text-top;" alt="user-photo">
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

    <div style="width: 100%;">
        <header class="header pb-0">
            <div class="container">

                <nav aria-label="breadcrumb">
                    <ol class="custom-breadcrumbs small">
                        <li>
                            <a href="<?= url('campaigns') ?>"><?= l('campaigns.breadcrumb') ?></a>
                            <i class="fa fa-fw fa-angle-right"></i>
                        </li>
                        <li class="active" aria-current="page"><?= l('campaign.breadcrumb') ?></li>
                    </ol>
                </nav>

                <?php

                $icon = new \Jdenticon\Identicon([
                    'value' => $data->campaign->domain,
                    'size' => 100,
                    'style' => [
                        'hues' => [235],
                        'backgroundColor' => '#86444400',
                        'colorLightness' => [0.41, 0.80],
                        'grayscaleLightness' => [0.30, 0.70],
                        'colorSaturation' => 0.85,
                        'grayscaleSaturation' => 0.40,
                    ]
                ]);
                $data->campaign->icon = $icon->getImageDataUri();

                ?>

                <div class="row">
                    <!-- <div class="col-auto">
                        <img src="<?= $data->campaign->icon ?>" class="campaign-big-avatar rounded-circle" alt="" />
                    </div> -->

                    <div class="col text-truncate">
                        <!-- <h1 class="h2 text-truncate"><span class="underline"><?= $data->campaign->name ?></span></h1> -->

                        <div class="d-flex align-items-center text-muted">
                            <img src="https://external-content.duckduckgo.com/ip3/<?= $data->campaign->domain ?>.ico" class="img-fluid icon-favicon mr-1" />
                            <div class="d-inline-block text-truncate"><?= $data->campaign->domain ?></div>
                        </div>
                    </div>

                    <div class="col-auto">
                        <div class="d-flex align-items-center">
                            <div class="custom-control custom-switch mr-3" data-toggle="tooltip" title="<?= l('campaigns.table.is_enabled_tooltip') ?>">
                                <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        id="campaign_is_enabled_<?= $data->campaign->campaign_id ?>"
                                        data-row-id="<?= $data->campaign->campaign_id ?>"
                                        onchange="ajax_call_helper(event, 'campaigns-ajax', 'is_enabled_toggle')"
                                    <?= $data->campaign->is_enabled ? 'checked="checked"' : null ?>
                                >
                                <label class="custom-control-label clickable" for="campaign_is_enabled_<?= $data->campaign->campaign_id ?>"></label>
                            </div>

                            <div class="dropdown">
                                <button type="button" class="btn btn-link text-secondary dropdown-toggle dropdown-toggle-simple" data-toggle="dropdown" data-boundary="viewport">
                                    <i class="fa fa-fw fa-ellipsis-v"></i>
                                </button>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a style="color: #5D5FEF!important;"
                                    href="<?= url('campaign/' . $data->campaign->campaign_id) ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-server mr-2"></i> <?= l('global.view') ?></a>
                                    <a href="<?= url('campaign/' . $data->campaign->campaign_id . '/statistics') ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-chart-bar mr-2"></i> <?= l('campaign.statistics.link') ?></a>

                                    <a href="#" data-toggle="modal" data-target="#update_campaign" data-campaign-id="<?= $data->campaign->campaign_id ?>" data-name="<?= $data->campaign->name ?>" data-domain="<?= $data->campaign->domain ?>" data-include-subdomains="<?= (bool) $data->campaign->include_subdomains ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-pencil-alt mr-2"></i> <?= l('global.edit') ?></a>

                                    <a
                                        href="#"
                                        data-toggle="modal"
                                        data-target="#campaign_pixel_key"
                                        data-pixel-key="<?= $data->campaign->pixel_key ?>"
                                        class="dropdown-item"
                                    ><i class="fa fa-fw fa-sm fa-code mr-2"></i> <?= l('campaign.pixel_key') ?></a>

                                    <?php if($this->user->plan_settings->custom_branding): ?>
                                        <a href="#" data-toggle="modal" data-target="#custom_branding_campaign" data-campaign-id="<?= $data->campaign->campaign_id ?>" data-branding-name="<?= $data->campaign->branding->name ?? '' ?>" data-branding-url="<?= $data->campaign->branding->url ?? '' ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-random mr-2"></i> <?= l('campaign.custom_branding') ?></a>
                                    <?php endif ?>
                                    <a href="#" data-toggle="modal" data-target="#campaign_duplicate_modal" data-campaign-id="<?= $data->campaign->campaign_id ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-copy mr-2"></i> <?= l('global.duplicate') ?></a>

                                    <a href="#" data-toggle="modal" data-target="#campaign_delete_modal" data-campaign-id="<?= $data->campaign->campaign_id ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-trash-alt mr-2"></i> <?= l('global.delete') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <ul class="mt-5 nav nav-custom">
                    <li class="nav-item">
                        <a href="<?= url('campaign/' . $data->campaign->campaign_id) ?>" class="nav-link <?= $data->method == 'settings' ? 'active' : null ?>">
                            <i class="fa fa-fw fa-sm fa-bell mr-1"></i> <?= l('campaign.notifications.link') ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="<?= url('campaign/' . $data->campaign->campaign_id . '/statistics') ?>" class="nav-link <?= $data->method == 'statistics' ? 'active' : null ?>">
                            <i class="fa fa-fw fa-sm fa-chart-bar mr-1"></i> <?= l('campaign.statistics.link') ?>
                        </a>
                    </li>
                </ul>
            </div>
        </header>

        <section class="container">
            <?= \Altum\Alerts::output_alerts() ?>

            <?= $this->views['method'] ?>
        </section>
    </div>
</div>

<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/campaign/campaign_delete_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/campaign/campaign_pixel_key_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/campaign/update_campaign_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/campaign/custom_branding_campaign_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/notification/notification_delete_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/partials/duplicate_modal.php', ['modal_id' => 'notification_duplicate_modal', 'resource_id' => 'notification_id', 'endpoint' => 'notification/duplicate']), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/partials/duplicate_modal.php', ['modal_id' => 'campaign_duplicate_modal', 'resource_id' => 'campaign_id', 'endpoint' => 'campaign/duplicate']), 'modals'); ?>


<?php ob_start() ?>
<script>
    <?php if(isset($_GET['pixel_key_modal'])): ?>
    /* Open the pixel key modal */
    $('[data-pixel-key]').trigger('click');
    <?php endif ?>
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
