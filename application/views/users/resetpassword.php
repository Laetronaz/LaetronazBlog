<div class="passreset-form">
    <div class="main-div">
        <div class="panel">
            <h2>Password Recovery</h2>
            <p>Please enter your new password</p>
            </div>
                <?php echo form_open("users/change-password/$user_id"); ?>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Enter Password" required autofocus>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Verify Password" required autofocus>
                    </div>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>