<?php defined('ALTUMCODE') || die() ?>

<div class="modal fade" id="create_campaign_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    <?= l('create_campaign_modal.header') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form name="create_campaign" method="post" role="form">
                    <input type="hidden" name="token" value="<?= \Altum\Middlewares\Csrf::get() ?>" required="required" />
                    <input type="hidden" name="request_type" value="create" />

                    <div class="notification-container"></div>

                    <div class="form-group">
                        <label><i class="fa fa-fw fa-sm fa-signature text-muted mr-1"></i> <?= l('campaigns.input.name') ?></label>
                        <input type="text" class="form-control" name="name" required="required" />
                    </div>

                    <div class="form-group">
                        <label><i class="fa fa-fw fa-sm fa-network-wired text-muted mr-1"></i> <?= l('campaigns.input.domain') ?></label>
                        <input type="text" class="form-control" name="domain" placeholder="<?= l('campaigns.input.domain_placeholder') ?>" required="required" />
                        <small class="form-text text-muted"><?= l('campaigns.input.domain_help') ?></small>
                        <small class="form-text text-muted"><?= l('campaigns.input.domain_help2') ?></small>
                    </div>

                    <div class="custom-control custom-switch">
                        <input
                                type="checkbox"
                                class="custom-control-input"
                                name="include_subdomains"
                                id="include_subdomains"
                        >
                        <label class="custom-control-label clickable" for="include_subdomains"><?= l('campaigns.input.include_subdomains') ?></label>
                        <small class="form-text text-muted"><?= l('campaigns.input.include_subdomains_help') ?></small>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" name="submit" class="btn btn-block btn-primary"><?= l('global.create') ?></button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<?php ob_start() ?>
<script>
    $('form[name="create_campaign"]').on('submit', event => {

        $.ajax({
            type: 'POST',
            url: 'campaigns-ajax',
            data: $(event.currentTarget).serialize(),
            success: (data) => {
                let notification_container = event.currentTarget.querySelector('.notification-container');
                notification_container.innerHTML = '';

                if(data.status == 'error') {
                    display_notifications(data.message, 'error', notification_container);
                }

                else if(data.status == 'success') {
                    display_notifications(data.message, 'success', notification_container);

                    setTimeout(() => {
                        /* Hide modal */
                        $('#create_campaign_modal').modal('hide');

                        /* Clear input values */
                        $('form[name="create_campaign"] input').val('');

                        /* Redirect */
                        redirect(`campaign/${data.details.campaign_id}?pixel_key_modal`);
                    }, 1000);
                }
            },
            dataType: 'json'
        });

        event.preventDefault();
    })
</script>
<?php \Altum\Event::add_content(ob_get_clean(), 'javascript') ?>
