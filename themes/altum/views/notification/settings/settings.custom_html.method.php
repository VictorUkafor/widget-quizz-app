<?php
defined('ALTUMCODE') || die();

/* Create the content for each tab */
$html = [];

/* Extra Javascript needed */
$javascript = '';
?>

<?php /* Basic Tab */ ?>
<?php ob_start() ?>
    <div class="form-group">
        <label for="settings_name"><?= l('notification.settings.name') ?></label>
        <input type="text" id="settings_name" name="name" class="form-control" value="<?= $data->notification->name ?>" maxlength="256" required="required" />
    </div>

    <div class="form-group">
        <label for="settings_html"><?= l('notification.settings.html') ?></label>
        <textarea id="settings_html" name="html" class="form-control" maxlength="8192" required="required"><?= $data->notification->settings->html ?></textarea>
        <small class="form-text text-muted"><?= l('notification.settings.html_help') ?></small>
    </div>
<?php $html['basic'] = ob_get_clean() ?>

<?php /* Default Display Tab */ ?>
<?php ob_start() ?>
<div class="form-group">
    <label for="settings_display_duration"><?= l('notification.settings.display_duration') ?></label>
    <input type="number" min="-1" id="settings_display_duration" name="display_duration" class="form-control" value="<?= $data->notification->settings->display_duration ?>" required="required" />
    <small class="form-text text-muted"><?= l('notification.settings.display_duration_help') ?></small>
</div>

<div class="form-group">
    <label for="settings_display_position"><?= l('notification.settings.display_position') ?></label>
    <select class="form-control" name="display_position">
        <option value="top_left" <?= $data->notification->settings->display_position == 'top_left' ? 'selected="selected"' : null ?>><?= l('notification.settings.display_position_top_left') ?></option>
        <option value="top_center" <?= $data->notification->settings->display_position == 'top_center' ? 'selected="selected"' : null ?>><?= l('notification.settings.display_position_top_center') ?></option>
        <option value="top_right" <?= $data->notification->settings->display_position == 'top_right' ? 'selected="selected"' : null ?>><?= l('notification.settings.display_position_top_right') ?></option>
        <option value="middle_left" <?= $data->notification->settings->display_position == 'middle_left' ? 'selected="selected"' : null ?>><?= l('notification.settings.display_position_middle_left') ?></option>
        <option value="middle_center" <?= $data->notification->settings->display_position == 'middle_center' ? 'selected="selected"' : null ?>><?= l('notification.settings.display_position_middle_center') ?></option>
        <option value="middle_right" <?= $data->notification->settings->display_position == 'middle_right' ? 'selected="selected"' : null ?>><?= l('notification.settings.display_position_middle_right') ?></option>
        <option value="bottom_left" <?= $data->notification->settings->display_position == 'bottom_left' ? 'selected="selected"' : null ?>><?= l('notification.settings.display_position_bottom_left') ?></option>
        <option value="bottom_center" <?= $data->notification->settings->display_position == 'bottom_center' ? 'selected="selected"' : null ?>><?= l('notification.settings.display_position_bottom_center') ?></option>
        <option value="bottom_right" <?= $data->notification->settings->display_position == 'bottom_right' ? 'selected="selected"' : null ?>><?= l('notification.settings.display_position_bottom_right') ?></option>
    </select>
    <small class="form-text text-muted"><?= l('notification.settings.display_position_help') ?></small>
</div>

<div class="custom-control custom-switch mr-3 mb-3 <?= !$this->user->plan_settings->removable_branding ? 'container-disabled': null ?>">
    <input
            type="checkbox"
            class="custom-control-input"
            id="display_branding"
            name="display_branding"
        <?= $data->notification->settings->display_branding ? 'checked="checked"' : null ?>
    >
    <label class="custom-control-label clickable" for="display_branding"><?= l('notification.settings.display_branding') ?></label>
</div>
<?php $html['display'] = ob_get_clean() ?>

<?php /* Customize Tab */ ?>
<?php ob_start() ?>
    <div class="form-group">
        <label for="settings_background_color"><?= l('notification.settings.background_color') ?></label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div id="settings_background_color_pickr"></div>
            </div>
            <input type="text" id="settings_background_color" name="background_color" class="form-control border-left-0" value="<?= $data->notification->settings->background_color ?>" required="required" />
        </div>
    </div>

    <div class="form-group">
        <label for="settings_background_pattern"><?= l('notification.settings.background_pattern') ?></label>
        <select class="form-control" id="settings_background_pattern" name="background_pattern">
            <option value="" <?= $data->notification->settings->background_pattern == '' ? 'selected="selected"' : null ?>><?= l('notification.settings.background_pattern_none') ?></option>

            <?php $background_patterns = (require_once APP_PATH . 'includes/notifications_background_patterns.php')(); ?>

            <?php foreach($background_patterns as $key => $value): ?>
                <option value="<?= $key ?>" <?= $data->notification->settings->background_pattern == $key ? 'selected="selected"' : null ?> data-value="<?= $value ?>"><?= l('notification.settings.background_pattern_' . $key) ?></option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="form-group">
        <label for="settings_close_button_color"><?= l('notification.settings.close_button_color') ?></label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div id="settings_close_button_color_pickr"></div>
            </div>
            <input type="text" id="settings_close_button_color" name="close_button_color" class="form-control border-left-0" value="<?= $data->notification->settings->close_button_color ?>" required="required" />
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label for="settings_border_radius"><?= l('notification.settings.border_radius') ?></label>
                <select class="form-control" name="border_radius">
                    <option value="straight" <?= $data->notification->settings->border_radius == 'straight' ? 'selected="selected"' : null ?>><?= l('notification.settings.border_radius_straight') ?></option>
                    <option value="rounded" <?= $data->notification->settings->border_radius == 'rounded' ? 'selected="selected"' : null ?>><?= l('notification.settings.border_radius_rounded') ?></option>
                    <option value="round" <?= $data->notification->settings->border_radius == 'round' ? 'selected="selected"' : null ?>><?= l('notification.settings.border_radius_round') ?></option>
                </select>
                <small class="form-text text-muted"><?= l('notification.settings.border_radius_help') ?></small>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="form-group">
                <label for="settings_border_width"><?= l('notification.settings.border_width') ?></label>
                <input type="number" min="0" max="5" id="settings_border_width" name="border_width" class="form-control" value="<?= $data->notification->settings->border_width ?>" />
                <small class="form-text text-muted"><?= l('notification.settings.border_width_help') ?></small>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="form-group">
                <label for="settings_border_color"><?= l('notification.settings.border_color') ?></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div id="settings_border_color_pickr"></div>
                    </div>
                    <input type="text" id="settings_border_color" name="border_color" class="form-control border-left-0" value="<?= $data->notification->settings->border_color ?>" required="required" />
                </div>
            </div>
        </div>
    </div>

    <div class="custom-control custom-switch mr-3 mb-3">
        <input
            type="checkbox"
            class="custom-control-input"
            id="settings_shadow"
            name="shadow"
            <?= $data->notification->settings->shadow ? 'checked="checked"' : null ?>
        >

        <label class="custom-control-label clickable" for="settings_shadow"><?= l('notification.settings.shadow') ?></label>

        <div>
            <small class="form-text text-muted"><?= l('notification.settings.shadow_help') ?></small>
        </div>
    </div>
<?php $html['customize'] = ob_get_clean() ?>


<?php ob_start() ?>
<script>
    /* Notification Preview Handlers */
    $('#settings_html').on('change paste keyup', event => {
        $('#notification_preview .altumcode-custom-html-html').html($(event.currentTarget).val());
    });

    /* Background Color Handler */
    let settings_background_color_pickr = Pickr.create({
        el: '#settings_background_color_pickr',
        default: $('#settings_background_color').val(),
        ...pickr_options
    });

    settings_background_color_pickr.on('change', hsva => {
        $('#settings_background_color').val(hsva.toHEXA().toString());

        /* Notification Preview Handler */
        $('#notification_preview .altumcode-wrapper').css('background-color', hsva.toHEXA().toString());
    });

    /* Background Pattern Handler */
    $('#settings_background_pattern').on('change paste keyup', event => {
        let value = $(event.currentTarget).find(':selected').data('value');

        if(value) {
            $('#notification_preview .altumcode-wrapper').css('background-image', `url(${value})`);
        } else {
            $('#notification_preview .altumcode-wrapper').css('background-image', '');
        }
    });

    /* Close Button Color Handler */
    let settings_close_button_color_pickr = Pickr.create({
        el: '#settings_close_button_color_pickr',
        default: $('#settings_close_button_color').val(),
        ...pickr_options
    });

    settings_close_button_color_pickr.on('change', hsva => {
        $('#settings_close_button_color').val(hsva.toHEXA().toString());

        /* Notification Preview Handler */
        $('#notification_preview .altumcode-close').css('color', hsva.toHEXA().toString());
    });
</script>
<?php $javascript = ob_get_clean() ?>

<?php return (object) ['html' => $html, 'javascript' => $javascript] ?>
