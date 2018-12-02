
<h2><?= $title; ?></h2>
<table class="table table-hover">
    <thead>
        <tr>
            <th class="text-center" scope="col"></th>
            <th class="text-center" scope="col">Name</th>
            <th class="text-center" scope="col">Zipcode</th>
            <th class="text-center" scope="col">Email</th>
            <th class="text-center" scope="col">Username</th>
            <th class="text-center" scope="col">Register Date</th>
            <th class="text-center" scope="col">Edit User</th>
            <th class="text-center" scaope="col">Toggle User</th>
        </tr>
    </thead>
    <tbody>
        <tr class="table-secondary">;   
        <?php foreach($users as $user) : ?>   
            <tr class="table-secondary">
                <td class="text-center" scope="row"><i class="fas fa-circle <?php echo $user['style']?>" ></i></td>
                <td class="text-center" scope="row"><a href="<?php echo base_url() ?>users/view/<?php echo $user['id']?>"><?php echo $user['name']?></a></td>
                <td class="text-center" scope="row"><?php echo $user['zipcode']?></td>
                <td class="text-center" scope="row"><?php echo $user['email']?></td>
                <td class="text-center" scope="row"><?php echo $user['username']?></td>
                <td class="text-center"><?php echo date("Y-m-d",strtotime($user['register_date']));?></td>

                <form class="form-inline" action="<?php echo base_url(); ?>users/edit/<?php echo $user['id']; ?>" method="POST">
                    <td class="text-center" scope="col">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </form>
               
                <td class="text-center" scope="col">
                    <?php $attributes = array('class' => 'form-inline');?>
                    <?php echo form_open('users/toggle/'.$user['id'],$attributes); ?>
                        <?php if($user['user_state'] == 3) : ?>                       
                                <button type="submit" class="btn btn-danger btn-block">
                                    <i class="fas fa-toggle-off" ></i>
                                </button>
                            </form>
                        <?php elseif($user['user_state'] == 4) : ?>
                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="fas fa-toggle-on"></i>
                                </button>
                        <?php endif; ?>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table> 
<ul class="list-group">