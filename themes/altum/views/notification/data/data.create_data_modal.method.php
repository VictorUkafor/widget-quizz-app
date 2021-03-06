<?php defined('ALTUMCODE') || die() ?>

<div class="modal fade" id="create_notification_data" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title"><?= l('notification.create_data_modal.header') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <form name="create_notification_data" method="post" role="form">
                    <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" required="required" />
                    <input type="hidden" name="request_type" value="create" />
                    <input type="hidden" name="notification_id" value="<?= $data->notification->notification_id ?>" />

                    <div class="notification-container"></div>

                    <div id="keys_values">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label><i class="fa fa-fw fa-sm fa-key text-muted mr-1"></i> <?= l('notification.create_data_modal.input.key') ?></label>
                                    <input type="text" class="form-control" name="key[]" placeholder="<?= l('notification.create_data_modal.input.key_placeholder') ?>" required="required" />
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label><i class="fa fa-fw fa-sm fa-server text-muted mr-1"></i> <?= l('notification.create_data_modal.input.value') ?></label>
                                    <input type="text" class="form-control" name="value[]" placeholder="<?= l('notification.create_data_modal.input.value_placeholder') ?>" required="required" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="button" id="create_key_value" class="btn btn-outline-success btn-sm"><i class="fa fa-fw fa-plus-circle"></i> <?= l('notification.create_data_modal.create_key_value') ?></button>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" name="submit" class="btn btn-block btn-primary"><?= l('global.submit') ?></button>
                    </div>
                </form>
            </div>

            <div id="key_value_sample" style="display: none;">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label><i class="fa fa-fw fa-sm fa-key text-muted mr-1"></i> <?= l('notification.create_data_modal.input.key') ?></label>
                            <input type="text" class="form-control" name="key[]" />
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label><i class="fa fa-fw fa-sm fa-server text-muted mr-1"></i> <?= l('notification.create_data_modal.input.value') ?></label>
                            <input type="text" class="form-control" name="value[]" />
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php ob_start() ?>
<script>
    /* Add new trigger rule handler */
    $('#create_key_value').on('click', () => {

        let key_value_sample = $('#key_value_sample').html();

        $('#keys_values').append(key_value_sample);
    });

    $('form[name="create_notification_data"]').on('submit', event => {

        $.ajax({
            type: 'POST',
            url: 'notification-data-ajax',
            data: $(event.currentTarget).serialize(),
            success: (data) => {
                let notification_container = event.currentTarget.querySelector('.notification-container');
                notification_container.innerHTML = '';

                if (data.status == 'error') {
                    display_notifications(data.message, 'error', notification_container);
                }

                else if(data.status == 'success') {
                    display_notifications(data.message, 'success', notification_container);

                    setTimeout(() => {
                        /* Remove the notification */
                        notification_container.innerHTML = '';

                        /* Hide modal */
                        $('#create_notification_data').modal('hide');

                        /* Clear input values */
                        $('form[name="create_notification_data"] input').val('');

                        /* Redirect */
                        redirect(`<?= url('notification/' . $data->notification->notification_id . '/data') ?>`, true);
                    }, 1000);
                }
            },
            dataType: 'json'
        });

        event.preventDefault();
    })
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
