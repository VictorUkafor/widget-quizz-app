<?php defined('ALTUMCODE') || die() ?>


<?php ob_start() ?>
<div role="dialog" class="altumcode-wrapper altumcode-wrapper-<?= $notification->settings->border_radius ?> <?= $notification->settings->shadow ? 'altumcode-wrapper-shadow' : null ?> <?= ($notification->settings->direction ?? 'ltr') == 'rtl' ? 'altumcode-rtl' : null ?> altumcode-social-share-wrapper" style='font-family: <?= $notification->settings->font ?? 'inherit' ?>!important;background-color: <?= $notification->settings->background_color ?>;border-width: <?= $notification->settings->border_width ?>px;border-color: <?= $notification->settings->border_color ?>;<?= $notification->settings->background_pattern_svg ? 'background-image: url("' . $notification->settings->background_pattern_svg . '")' : null ?>;'>
    <div class="altumcode-social-share-content">
        <div class="altumcode-social-share-header">
            <p class="altumcode-social-share-title" style="color: <?= $notification->settings->title_color ?>"><?= $notification->settings->title ?></p>

            <button class="altumcode-close" style="color: <?= $notification->settings->close_button_color ?>;">×</button>
        </div>

        <div class="altumcode-social-share-buttons">

            <?php if($notification->settings->share_facebook): ?>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($notification->settings->share_url) ?>&amp;src=sdkpreparse" target="_blank" class="altumcode-social-share-button altumcode-social-share-button-facebook">Facebook</a>
            <?php endif ?>

            <?php if($notification->settings->share_twitter): ?>
                <a href="https://twitter.com/intent/tweet?url=<?= urlencode($notification->settings->share_url) ?>" target="_blank" class="altumcode-social-share-button altumcode-social-share-button-twitter">Twitter</a>
            <?php endif ?>

            <?php if($notification->settings->share_linkedin): ?>
                <a href="https://www.linkedin.com/sharing/share-offsite/?mini=true&url=<?= urlencode($notification->settings->share_url) ?>" target="_blank" class="altumcode-social-share-button altumcode-social-share-button-linkedin">Linkedin</a>
            <?php endif ?>

        </div>

        <p class="altumcode-social-share-description" style="color: <?= $notification->settings->description_color ?>"><?= $notification->settings->description ?></p>
    </div>

</div>
<?php $html = ob_get_clean(); ?>


<?php ob_start() ?>
new AltumCodeManager({
    content: <?= json_encode($html) ?>,
    display_mobile: <?= json_encode($notification->settings->display_mobile) ?>,
    display_desktop: <?= json_encode($notification->settings->display_desktop) ?>,
    display_trigger: <?= json_encode($notification->settings->display_trigger) ?>,
    display_trigger_value: <?= json_encode($notification->settings->display_trigger_value) ?>,
    duration: <?= $notification->settings->display_duration === -1 ? -1 : $notification->settings->display_duration * 1000 ?>,
    url: '',
    close: <?= json_encode($notification->settings->display_close_button) ?>,
    display_frequency: <?= json_encode($notification->settings->display_frequency) ?>,
    position: <?= json_encode($notification->settings->display_position) ?>,
    trigger_all_pages: <?= json_encode($notification->settings->trigger_all_pages) ?>,
    triggers: <?= json_encode($notification->settings->triggers) ?>,
    on_animation: <?= json_encode($notification->settings->on_animation) ?>,
    off_animation: <?= json_encode($notification->settings->off_animation) ?>,

    notification_id: <?= $notification->notification_id ?>
}).initiate({
    displayed: main_element => {

        /* On click event to the button */
        main_element.querySelector('.altumcode-social-share-button').addEventListener('click', event => {

            let notification_id = main_element.getAttribute('data-notification-id');

            send_tracking_data({
                notification_id: notification_id,
                type: 'notification',
                subtype: 'click'
            });

        });

    }
});
<?php $javascript = ob_get_clean(); ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
