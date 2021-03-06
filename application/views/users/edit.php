<?php echo validation_errors(); ?>
<h1><?= $title.$user['username']; ?> 
    <button id="username-change" type="button" data-toggle="modal" data-target="#username-modal" class="btn btn-secondary">Change Username</button>
</h1>
<?php echo form_open_multipart(USERS_EDIT_PATH.$user['id']); ?>
    <input type="hidden" name="id" value= "<?php echo $user['id']; ?>">
    <div class="form-group">
        <label>First Name</label>
        <input type="text" class="form-control" name ="first-name" placeholder="First Name" value="<?php echo set_value("name",$user['first_name']); ?>">
    </div>
    <div class="form-group">
        <label>Last Name</label>
        <input type="text" class="form-control" name ="last-name" placeholder="Last Name" value="<?php echo set_value("name",$user['last_name']); ?>">
    </div>
    <div class="form-group">
        <label>Email</label><br>
        <input type="email" class="form-control" name ="email" placeholder="Email" value="<?php echo set_value("email",$user['email']); ?>" disabled>
        <button id= "email-change" type="button" data-toggle="modal" data-target="#email-modal" class="btn btn-secondary">Change Email</button>
    </div>
    <div class="form-group">
        <label>Password</label><br>
        <button id= "password-change" type="button" data-toggle="modal" data-target="#password-modal" class="btn btn-secondary">Change Password</button>
    </div>
    <div class="form-group">
        <label>User Rights</label>
        <select name="usertype" class="form-control form-control-sm">   
            <?php foreach($types as $type) : ?>
                <option <?php if ($user['role'] == $type['id']){ echo "selected"; }?> value="<?php echo $type['id']?>"<?php echo set_select("usertype",$type['id'])?>>
                    <?php echo $type['name'];?>
                </option>
            <?php endforeach;?>   
        </select>
    </div>
    <hr>
    <button type="submit" class="btn btn-primary">Update</button>
</form>

<!-- Modal -->
<div class="modal fade" id="username-modal" role="dialog">
    <div class="modal-dialog">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Change Username</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <?php echo form_open_multipart(USERS_UPDATE_USERNAME_PATH.$user['id']); ?>
                    <input type="hidden" name="id" value= "<?php echo $user['id']; ?>">
                    <div class="form-group">
                        <label>New Username</label><br>
                        <input type="text" class="form-control" name="new-username" placeholder="New Username">
                    </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Change Username</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
              </form>
            </div>
        </div>  
    </div>
</div>
<div class="modal fade" id="email-modal" role="dialog">
    <div class="modal-dialog">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Change Email</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <?php echo form_open_multipart(USERS_UPDATE_EMAIL_PATH.$user['id']); ?>
                    <input type="hidden" name="id" value= "<?php echo $user['id']; ?>">
                    <div class="form-group">
                        <label>New Email Address</label><br>
                        <input type="text" class="form-control" name="new-email" placeholder="New Email Address">
                    </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Change Email Address</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
              </form>
            </div>
        </div>  
    </div>
</div>
<div class="modal fade" id="password-modal" role="dialog">
    <div class="modal-dialog">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Change Password</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <?php echo form_open_multipart(USERS_UPDATE_PASSWORD_PATH.$user['id']); ?>
                    <input type="hidden" name="id" value= "<?php echo $user['id']; ?>">
                    <?php if($this->session->userdata('user_id') == $user['id']) : ?>
                        <div class="form-group">
                            <label>Current Password</label><br>
                            <input type="password" class="form-control" name="old_password" placeholder="Current Password" autocomplete="off"> 
                        </div>
                    <?php endif ?>
                    <div class="form-group">
                        <label>New Password</label><br>
                        <input type="password" class="form-control" name="new-password" placeholder="New Password" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" class="form-control" name="new-password2" placeholder="Confirm New Password" autocomplete="off">
                    </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
              </form>
            </div>
        </div>  
    </div>
</div>