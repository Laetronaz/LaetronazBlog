<?php echo validation_errors(); ?>
<div class="passreset-form">
    <div class="main-div">
        <div class="panel">
            <h1>Password Recovery</h1>
            <p>Please enter your new password</p>
            </div>
                <?php echo form_open("users/resetpassword/".$token); ?>
                    <input type="hidden" name="user_id" value = "<?php echo $user_id?>">
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Enter Password" value="<?php echo set_value("password")?>" autofocus>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password2" class="form-control" placeholder="Verify Password" value="<?php echo set_value("password2")?>" autofocus>
                    </div>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>