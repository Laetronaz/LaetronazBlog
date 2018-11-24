<div class="login-form">
    <div class="main-div">
        <div class="panel">
            <h2>Admin Login</h2>
            <p>Please enter your username and password</p>
            </div>
                <?php echo form_open('users/login'); ?>
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" id="inputEmail" placeholder="Username" required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" required autofocus>
                    </div>
                    <div class="forgot">
                        <a href="<?php echo base_url(); ?>users/password-reset">Forgot password?</a>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>