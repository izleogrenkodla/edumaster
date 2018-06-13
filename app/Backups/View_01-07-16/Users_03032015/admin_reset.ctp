<!-- BEGIN FORGOT PASSWORD FORM -->
<?php echo $this->Form->create(
    'User' ,
    array('url' => array('controller' => 'Users' ,
        'action' => 'reset'
    ), 'class' => 'forget-form'
    )
); ?>
    <h3>Reset Password ?</h3>
<?php echo $this->Session->flash(); ?>
<?php echo $this->Session->flash('auth'); ?>

    <div class="form-group">
        <div class="input-icon">
            <i class="fa fa-envelope"></i>
            <?php echo $this->Form->input('password', array('type' => 'password',
            'label' => FALSE_VALUE,
            'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control placeholder-no-fix',
            'autocomplete' => 'off', 'placeholder' => 'Password')); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="input-icon">
            <i class="fa fa-envelope"></i>
            <?php echo $this->Form->input('confirm_password', array('type' => 'password',
            'label' => FALSE_VALUE,
            'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control placeholder-no-fix',
            'autocomplete' => 'off', 'placeholder' => 'Confirm Password')); ?>
        </div>
    </div>

    <div class="form-actions">
        <button type="button" class="btn" onclick="window.location.href='<?php echo Router::url(array
        ('controller' => 'Users', 'action' => 'login')) ?>'">
            <i class="m-icon-swapleft"></i> Back </button>
        <button type="submit" class="btn green pull-right">
            Submit <i class="m-icon-swapright m-icon-white"></i>
        </button>
    </div>
</form>
<!-- END FORGOT PASSWORD FORM -->
