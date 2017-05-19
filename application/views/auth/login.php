<h1><?php echo lang('login_heading');?></h1>
<p><?php echo lang('login_subheading');?></p>
<?php
require_once(__DIR__.'/../basic.php');?>
<div>
  <?php require_once(__DIR__ .'/../devices/nav.php');?>
</div>
<div id="container">
  <div class="pad_15 login">
<div id="infoMessage"><?php echo $message;?></div>
    <div style="margin-left:1em;">
<?php echo form_open("auth/login");?>

  <p>
    <?php echo lang('login_identity_label', 'identity');?>
    <?php echo form_input($identity);?>
  </p>

  <p>
    <?php echo lang('login_password_label', 'password');?>
    <?php echo form_input($password);?>
  </p>

  <p>
    <?php echo lang('login_remember_label', 'remember');?>
    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
  </p>


  <p><?php echo form_submit('submit', lang('login_submit_btn'));?></p>

<?php echo form_close();?>

<p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
  </div>
  </div>
</div>