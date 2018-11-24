<div class="passreset-form">
    <div class="main-div">
        <div class="panel">
            <h2>Password Recovery</h2>
            <p>Please enter your email address</p>
            </div>
                <?php echo form_open('users/request_password_reset'); ?>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required autofocus>
                    </div>
                    <button type="submit" class="btn btn-primary">Recover Password</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>