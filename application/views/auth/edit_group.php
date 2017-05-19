<?php
require_once(__DIR__ . '/../basic.php'); ?>
<div>
    <?php require_once(__DIR__ .'/../devices/nav.php');?>
</div>
<div id="container">
    <div class="pad_15 login">
        <div id="infoMessage"><?php echo $message; ?></div>
        <h1><?php echo lang('edit_group_heading'); ?></h1>


        <p><?php echo lang('edit_group_subheading'); ?></p>

        <div id="infoMessage"><?php echo $message; ?></div>
        <div style="margin-left:1em;">
        <?php echo form_open(current_url()); ?>

        <p>
            <?php echo lang('edit_group_name_label', 'group_name'); ?> <br/>
            <?php echo form_input($group_name); ?>
        </p>

        <p>
            <?php echo lang('edit_group_desc_label', 'description'); ?> <br/>
            <?php echo form_input($group_description); ?>
        </p>

        <p><?php echo form_submit('submit', lang('edit_group_submit_btn')); ?></p>

        <?php echo form_close(); ?>
    </div>
    </div>
</div>
