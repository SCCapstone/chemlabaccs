<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<?php echo form_open('users/authenticate', array('class' => 'navbar-form navbar-right')); ?>
<div class="form-group">
    <?php
    echo form_input(array(
        'name' => 'user_name',
        'id' => 'user_name',
        'class' => 'form-control',
        'placeholder' => 'Username'
    ));
    ?>
</div>
<div class="form-group">
    <?php
    echo form_password(array(
        'name' => 'password',
        'id' => 'password',
        'class' => 'form-control',
        'placeholder' => 'Password'
    ));
    ?>
</div>
<?php
echo form_submit(array(
    'name' => 'sign-in',
    'id' => 'sign-in',
    'class' => 'btn btn-success',
    'value' => 'Sign in'
));
?>
<?php echo form_close(); ?>