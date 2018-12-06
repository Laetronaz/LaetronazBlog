<h2><?= $title; ?></h2>
<?php echo validation_errors(); ?>

<?php echo form_open_multipart('users/edit/'.$user['id']); ?>
    <input type="hidden" name="id" value= "<?php echo $user['id']; ?>">
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name ="name" placeholder="Add Name" value="<?php echo set_value("name",$user['name']); ?>">
    </div>
    <div class="form-group">
        <label>Zipcode</label>
        <input type="text" class="form-control" name ="zipcode" placeholder="Add Zipcode" value="<?php echo set_value("zipcode",$user['zipcode']); ?>">
    </div>
    <div class="form-group">
        <label>User Rights</label>
        <select class="form-control form-control-sm" name="usertype">   
            <?php foreach($types as $type) : ?>
                <option value="<?php echo $type['id']?>"<?php echo set_select("usertype",$type['id'])?>>
                    <?php echo $type['name'];?>
                </option>
            <?php endforeach;?>   
        </select>
    </div>
    <hr>
    <button type="submit" class="btn btn-primary">Update Profile</button>
    <button type="button" data-toggle="modal" data-target="#PasswordChange" class="btn btn-info">Change Password</button>
</form>



<div class="modal fade" id="PasswordChange" role="dialog">
        <div class="modal-dialog">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Change PAssword</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <?php echo form_open_multipart('users/change-password'); ?>
                    <input type="hidden" name="id" value= "<?php echo $user['id']; ?>">
                    <?php if($this->session->userdata('user_id') != $user['id'] && $this->session->user_data['user_type'] == 'Admin') : ?>
                    <div class="form-group">
                        <label>Current Password</label><br>
                        <input type="password" class="form-control" name="old_password" placeholder="Current Password">
                    </div>
                    <?php endif ?>
                    <div class="form-group">
                        <label>New Password</label><br>
                        <input type="password" class="form-control" name="password" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <label>Confirm New Password</label>
                        <input type="password" class="form-control" name="password2" placeholder="Confirm New Password">
                    </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </form>
            </div>
        </div>  
    </div>
  </div>