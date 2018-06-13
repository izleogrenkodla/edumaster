<!-- BEGIN FORGOT PASSWORD FORM -->
<?php echo $this->Form->create(
    'User' ,
    array('url' => array('controller' => 'Users' ,
        'action' => 'forgot_password'
    ), 'class' => 'forget-form'
    )
); ?>
    <h3>Forget Password ?</h3>
    <p>
        Enter your user id below to reset your password.
    </p>
<?php echo $this->Session->flash(); ?>
<?php echo $this->Session->flash('auth'); ?>
    <div class="form-group">
        <div class="input-icon">
            <i class="fa fa-envelope"></i>
            <?php echo $this->Form->input('its_id', array('type' => 'text',
            'label' => FALSE_VALUE,
            'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control placeholder-no-fix',
            'autocomplete' => 'off', 'placeholder' => 'User ID')); ?>
        </div>
    </div>

    <div class="form-actions">
        <button type="button" class="btn green" onclick="window.location.href='<?php echo Router::url(array
        ('controller' => 'Users', 'action' => 'login')) ?>'">
            <!--<i class="m-icon-swapleft"></i>--> Back </button>
        <button type="submit" class="btn green pull-right">
            Submit <!--<i class="m-icon-swapright m-icon-white"></i>-->
        </button>
    </div>
</form>
<!-- END FORGOT PASSWORD FORM -->
