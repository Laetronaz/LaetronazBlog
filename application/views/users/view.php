<h2><?= $title; ?></h2>
<div class="form-group">
    <label>Name</label>
    <p><?php echo $user['name']?></p>
</div>
<div class="form-group">
    <label>Zipcode</label>
    <p><?php echo $user['zipcode']?></p>
</div>
<div class="form-group">
    <label>Email</label>
    <p><?php echo $user['email']?></p>
</div>
<div class="form-group">
    <label>Username</label>
    <p><?php echo $user['username']?></p>
</div>
<div class="form-group">
    <label>Register date</label>
    <p><?php echo $user['register_date']?></p>
</div>
<div class="form-group">
    <label>Current state</label>
    <?php if($user['active'] == 1): ?>
        <p>Active</p>
    <?php else : ?>
        <p>Inactive</p>
    <?php endif;?>
</div>

<hr>
<a class="btn btn-primary float-left" href="<?php echo base_url(); ?>users/edit/<?php echo $user['id']; ?>">Edit</a>
<?php echo form_open('/users/toggle/'.$user['id']); ?>
	<input type="submit" value="Toggle User" class="btn btn-danger">
</form>