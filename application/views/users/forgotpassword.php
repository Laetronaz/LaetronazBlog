<?php echo validation_errors(); ?>
<div class="passreset-form">
    <div class="main-div">
        <div class="panel">
            <h1>Password Recovery</h1>
            <p>Please enter your email address</p>
            </div>
                <?php echo form_open(EMAIL_PASSWORD_RESET_PATH); ?>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" value="<?php echo set_value('email')?>"autofocus>
                    </div>
                    <button type="submit" class="btn btn-primary">Recover Password</button>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>