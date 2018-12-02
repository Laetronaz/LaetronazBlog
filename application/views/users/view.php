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
    <label>User Rank</label>   
    <?php foreach($types as $type) : ?>
        <?php if($type['id'] == $user['user_type']) : ?>
            <p><?php echo $type['name']?></p>
        <?php endif ?>
    <?php endforeach;?>   
</div>
<div class="form-group">
    <label>Register date</label>
    <p><?php echo date("Y-m-d",strtotime($user['register_date']));?></p>
</div>
<div class="form-group">
    <label>Current state</label>
    <p><i class="fas fa-circle <?php echo $user['style']; ?>" ></i> <?php echo $user['state_name'];?> </p>
</div>

<hr>
<a class="btn btn-primary float-left" href="<?php echo base_url(); ?>users/edit/<?php echo $user['id']; ?>">Edit</a>