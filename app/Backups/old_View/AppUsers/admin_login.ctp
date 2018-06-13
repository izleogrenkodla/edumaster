<!-- BEGIN LOGIN FORM -->
    <?php echo $this->Form->create('User', array('class' => 'login-form')); ?>
    <h3 class="form-title">Login to your Admin account</h3>
<?php echo $this->Session->flash(); ?>
<?php //echo $this->Session->flash('auth'); ?>
    <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
			<span>
			Enter your user id and password. </span>
    </div>
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Username</label>
        <div class="input-icon">
            <i class="fa fa-user"></i>
            <?php echo $this->Form->input('user_id', array('type' => 'text', 'label' => FALSE_VALUE,
                'div' => FALSE_VALUE, 'placeholder' => 'User ID', 'class' => 'form-control placeholder-no-fix
                tooltips',
            'data-container' => 'body', 'data-placement' => 'right', 'data-html' => 'true',
            'data-original-title' => 'Enter User ID', 'autocomplete' => 'off')); ?>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <div class="input-icon">
            <i class="fa fa-lock"></i>
            <?php echo $this->Form->input('password', array('type' => 'password', 'label' => FALSE_VALUE,
                'div' => FALSE_VALUE, 'placeholder' => 'Password', 'class' => 'form-control placeholder-no-fix
                tooltips', 'data-container' => 'body', 'data-placement' => 'right', 'data-html' => 'true',
                'data-original-title' => 'Enter Password', 'autocomplete' => 'off')); ?>

        </div>
    </div>
    <div class="form-actions">
        <label class="checkbox">
            <input type="checkbox" name="remember" value="1"/> Remember me </label>
        <button type="submit" class="btn green pull-right">
            Login <i class="m-icon-swapright m-icon-white"></i>
        </button>
    </div>
<!--    <div class="login-options">
        <h4>Or login with</h4>
        <ul class="social-icons">
            <li>
                <a class="facebook" data-original-title="facebook" href="#">
                </a>
            </li>
            <li>
                <a class="twitter" data-original-title="Twitter" href="#">
                </a>
            </li>
            <li>
                <a class="googleplus" data-original-title="Goole Plus" href="#">
                </a>
            </li>
            <li>
                <a class="linkedin" data-original-title="Linkedin" href="#">
                </a>
            </li>
        </ul>
    </div>-->
    <div class="forget-password">
        <h4>Forgot your password ?</h4>
        <p>
            no worries, click <a href="<?php echo Router::url(array
        ('controller' => 'Users', 'action' => 'forgot_password')) ?>">
                here </a>
            to reset your password.
        </p>
    </div>
<!--    <div class="create-account">
        <p>
            Don't have an account yet ?&nbsp; <a href="javascript:;" id="register-btn">
                Create an account </a>
        </p>
    </div>-->
</form>
<!-- END LOGIN FORM -->
