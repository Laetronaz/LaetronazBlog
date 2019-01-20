<?php echo validation_errors(); ?>

<div class="login-form">
    <div class="main-div">
        <div class="panel">
            <h1>Admin Login</h1>
            <p>Please enter your username and password</p>
            </div>
                <?php echo form_open(USERS_LOGIN_PATH); ?>
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" id="inputEmail" placeholder="Username" value = "<?php echo set_value("username")?>" autofocus >
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" value= "<?php echo set_value("password") ?>" autofocus>
                    </div>
                    <div class="forgot">
                        <a href="<?php echo base_url().EMAIL_PASSWORD_RESET_PATH ?>">Forgot password?</a>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
