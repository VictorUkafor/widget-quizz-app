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
    height: 100%;
    justify-content: space-between;
}
.dashboard-tags{
    width: 22%;
    background: #F6F4FF;
    border-top-right-radius: 30px;
    height: 64rem;
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

.btn-primary{
    background: #5D5FEF!important;
}

</style>

<div class="main-wrapper">
    <div class="dashboard-tags">

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

    <div style="width: 75%;height:100%; padding-top:2rem;padding-bottom:2rem;">

        <header class="header pb-0">
            <div class="container">

                <nav aria-label="breadcrumb">
                    <ol class="custom-breadcrumbs small">
                        <li>
                            <a href="<?= url('campaigns') ?>"><?= l('campaigns.breadcrumb') ?></a><i class="fa fa-fw fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="<?= url('campaign/' . $data->notification->campaign_id) ?>"><?= l('campaign.breadcrumb') ?></a><i class="fa fa-fw fa-angle-right"></i>
                        </li>
                        <li class="active" aria-current="page"><?= l('notification.breadcrumb') ?></li>
                    </ol>
                </nav>

                <div class="row">
                    <div class="col text-truncate">
                        <h1 class="h2 text-truncate"><span class="underline"><?= $data->notification->name ?></span></h1>

                        <div class="row">
                            <div class="col-auto text-truncate">
                                <div class="d-flex align-items-center text-muted">
                                    <img src="https://external-content.duckduckgo.com/ip3/<?= $data->campaign->domain ?>.ico" class="img-fluid icon-favicon mr-1" />
                                    <div class="d-inline-block text-truncate"><?= $data->campaign->domain ?></div>
                                </div>
                            </div>

                            <div class="col">
                                <span class="text-muted">
                                    <i class="<?= l('notification.' . mb_strtolower($data->notification->type) . '.icon') ?> fa-sm mr-1"></i> <?= l('notification.' . mb_strtolower($data->notification->type) . '.name') ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-auto">
                        <div class="d-flex align-items-center">
                            <div class="custom-control custom-switch mr-3" data-toggle="tooltip" title="<?= l('notifications.table.is_enabled_tooltip') ?>">
                                <input
                                        type="checkbox"
                                        class="custom-control-input"
                                        id="campaign_is_enabled_<?= $data->notification->notification_id ?>"
                                        data-row-id="<?= $data->notification->notification_id ?>"
                                        onchange="ajax_call_helper(event, 'notifications-ajax', 'is_enabled_toggle')"
                                    <?= $data->notification->is_enabled ? 'checked="checked"' : null ?>
                                >
                                <label class="custom-control-label clickable" for="campaign_is_enabled_<?= $data->notification->notification_id ?>"></label>
                            </div>

                            <div class="dropdown">
                                <button type="button" class="btn btn-link text-secondary dropdown-toggle dropdown-toggle-simple" data-toggle="dropdown" data-boundary="viewport">
                                    <i class="fa fa-fw fa-ellipsis-v"></i>
                                </button>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="<?= url('notification/' . $data->notification->notification_id) ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-pencil-alt mr-2"></i> <?= l('global.edit') ?></a>
                                    <a href="<?= url('notification/' . $data->notification->notification_id . '/statistics') ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-chart-bar mr-2"></i> <?= l('notification.statistics.link') ?></a>
                                    <a href="#" data-toggle="modal" data-target="#notification_duplicate_modal" data-notification-id="<?= $data->notification->notification_id ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-copy mr-2"></i> <?= l('global.duplicate') ?></a>
                                    <a href="#" data-toggle="modal" data-target="#notification_delete_modal" data-notification-id="<?= $data->notification->notification_id ?>" class="dropdown-item"><i class="fa fa-fw fa-sm fa-trash-alt mr-2"></i> <?= l('global.delete') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?= $this->views['method_menu'] ?>
            </div>
        </header>

        <section class="container">

            <?= \Altum\Alerts::output_alerts() ?>

            <?= $this->views['method'] ?>

        </section>
    </div>
</div>

<?php ob_start() ?>
<link href="<?= ASSETS_FULL_URL . 'css/pickr.min.css' ?>" rel="stylesheet" media="screen">
<link href="<?= ASSETS_FULL_URL . 'css/daterangepicker.min.css' ?>" rel="stylesheet" media="screen,print">
<link href="<?= ASSETS_FULL_URL . 'css/pixel.css' ?>" rel="stylesheet" media="screen,print">
<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>

<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/notification/notification_delete_modal.php'), 'modals'); ?>
<?php \Altum\Event::add_content(include_view(THEME_PATH . 'views/partials/duplicate_modal.php', ['modal_id' => 'notification_duplicate_modal', 'resource_id' => 'notification_id', 'endpoint' => 'notification/duplicate']), 'modals'); ?>
