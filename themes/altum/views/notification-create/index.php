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

        <header class="header">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="custom-breadcrumbs small">
                        <li>
                            <a href="<?= url('dashboard') ?>"><?= l('dashboard.breadcrumb') ?></a><i class="fa fa-fw fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="<?= url('campaign/' . $data->campaign->campaign_id) ?>"><?= l('campaign.breadcrumb') ?></a><i class="fa fa-fw fa-angle-right"></i>
                        </li>
                        <li class="active" aria-current="page"><?= l('notification_create.breadcrumb') ?></li>
                    </ol>
                </nav>

                <h1 class="h2 mr-3"><?= l('notification_create.header') ?></h1>

                <div class="d-flex align-items-center text-muted mr-3">
                    <img src="https://external-content.duckduckgo.com/ip3/<?= $data->campaign->domain ?>.ico" class="img-fluid icon-favicon mr-1" />
                    <?= $data->campaign->domain ?>
                </div>
            </div>
        </header>

        <section class="container">

            <?= \Altum\Alerts::output_alerts() ?>

            <div class="my-5 mb-lg-0 d-flex flex-column flex-md-row justify-content-center align-items-center">
                <div id="notification_preview"></div>
            </div>

            <form name="create_notification" method="post" role="form">
                <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" required="required" />
                <input type="hidden" name="campaign_id" value="<?= $data->campaign->campaign_id ?>" />

                <div class="mt-5 row d-flex align-items-stretch">
                    <?php foreach($data->notifications as $notification_type => $notification_config): ?>

                        <?php

                        /* Check for permission of usage of the notification */
                        if(!$this->user->plan_settings->enabled_notifications->{$notification_type}) {
                            continue;
                        }

                        ?>

                        <?php $notification = \Altum\Notification::get($notification_type) ?>

                        <label class="col-12 col-md-6 col-lg-4 mb-3 mb-md-4 custom-radio-box mb-3">

                            <input type="radio" name="type" value="<?= $notification_type ?>" class="custom-control-input" required="required">

                            <div class="card zoomer h-100">
                                <div class="card-body">
                                    <div class="mb-3 text-center">
                                        <span class="custom-radio-box-main-icon"><i class="<?= l('notification.' . mb_strtolower($notification_type) . '.icon') ?>"></i></span>
                                    </div>

                                    <div class="card-title font-weight-bold text-center"><?= l('notification.' . mb_strtolower($notification_type) . '.name') ?></div>

                                    <p class="text-muted text-center"><?= l('notification.' . mb_strtolower($notification_type) . '.description') ?></p>
                                </div>
                            </div>

                            <div class="preview" style="display: none">
                                <?= preg_replace(['/<form/', '/<\/form>/', '/required=\"required\"/'], ['<div', '</div>', ''], $notification->html) ?>
                            </div>

                        </label>

                        <?php if($notification_type == 'ENGAGEMENT_LINKS'): ?>
                            <?php ob_start() ?>
                            <script>
                                $('.altumcode-engagement-links-wrapper .altumcode-engagement-links-hidden').removeClass('altumcode-engagement-links-hidden').addClass('altumcode-engagement-links-shown');
                            </script>
                            <?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
                        <?php endif ?>

                    <?php endforeach ?>
                </div>

                <div class="mt-4">
                    <button type="submit" name="submit" class="btn btn-block btn-lg btn-primary"><?= l('global.create') ?></button>
                </div>
            </form>
        </section>
    </div>
</div>

<?php ob_start() ?>
<link href="<?= ASSETS_FULL_URL . 'css/pixel.css' ?>" rel="stylesheet" media="screen,print">
<?php \Altum\Event::add_content(ob_get_clean(), 'head') ?>

<?php ob_start() ?>
<script>
    /* Preview handler */
    $('input[name="type"]').on('change', event => {

        let preview_html = $(event.currentTarget).closest('label').find('.preview').html();
        let type = $(event.currentTarget).val();

        $('#notification_preview').hide().html(preview_html).fadeIn();

        if(type.includes('_BAR')) {
            $('#notification_preview').removeClass().addClass('notification-create-preview-bar');
        } else {
            $('#notification_preview').removeClass().addClass('notification-create-preview-normal');
        }
    });

    /* Select a default option */
    $('input[name="type"]:first').attr('checked', true).trigger('change');
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
