<?php
require_once(__DIR__ . '/../basic.php'); ?>
<div>
    <?php require_once(__DIR__ .'/../devices/nav.php');?>
</div>
<div id="container">
    <div class="pad_15 login">
        <div id="infoMessage"><?php echo $message; ?></div>
        <h1><?php echo lang('forgot_password_heading'); ?></h1>

        <p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label); ?></p>

        <div id="infoMessage"><?php echo $message; ?></div>
        <div style="margin-left:1em;">
        <?php echo form_open("auth/forgot_password"); ?>

        <p>
            <label for="identity"><?php echo(($type == 'email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'),
                    $identity_label)); ?></label> <br/>
            <?php echo form_input($identity); ?>
        </p>

        <p><?php echo form_submit('submit', lang('forgot_password_submit_btn')); ?></p>

        <?php echo form_close(); ?>
    </div>
    </div>
</div>