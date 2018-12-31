<h1><?= $title; ?></h1>
<div class="form-group">
    <label>Username</label>
    <p><?php echo $user['username']?></p>
</div>
<div class="form-group">
    <label>First Name</label>
    <p><?php echo $user['first_name']?></p>
</div>
<div class="form-group">
    <label>Last Name</label>
    <p><?php echo $user['last_name']?></p>
</div>
<div class="form-group">
    <label>Email</label>
    <p><?php echo $user['email']?></p>
</div>
<div class="form-group">
    <label>User Rank</label>   
    <?php foreach($types as $type) : ?>
        <?php if($type['id'] == $user['role']) : ?>
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

<?php if(!(array_search('admin',array_column($this->session->userdata('rights'),'name')) === FALSE && array_search('consult logs',array_column($this->session->userdata('rights'),'name')) === FALSE)): ?>
<h2>USER LOGS</h2>
<table id="logs" class="table table-striped table-bordered table-sm logs" style="width:100%">
    <thead>
        <tr>
            <th>Date</th>
            <th>User ID</th>
            <th>Code</th>
            <th>Message</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!$logs === FALSE) : ?>
            <?php foreach($logs as $log) : ?>
                <tr>
                    <td>
                        <?php echo $log->date_time?>
                    </td>
                    <td>
                        <?php echo $log->user_id ?>
                    </td>
                    <td>
                        <?php echo $log->code ?>
                    </td>
                    <td>
                    <?php echo $log->message ?>
                    </td>
            </tr>
            <?php endforeach; ?>
        <?php endif ?>
    </tbody>
</table>
<?php endif?>

<script src="<?php echo base_url()?>assets/javascript/logs.js"></script>