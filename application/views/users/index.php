
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
                <td class="text-center" scope="col">
                    <a class="btn btn-primary btn-block" href="<?php echo base_url(); ?>users/edit/<?php echo $user['id'];?>">
                        <i class="fas fa-edit"></i>
                    </a>    
                </td>
                <td class="text-center" scope="col">
                       <?php if($user['user_state'] == 3) : ?>          
                            <a href="<?php echo base_url(); ?>users/toggle/<?php echo $user['id']?>" class="btn btn-danger btn-block">
                                <i class="fas fa-toggle-on"></i>
                            </a>             

                        <?php elseif($user['user_state'] == 4) : ?>
                            <a href="<?php echo base_url(); ?>users/toggle/<?php echo $user['id']?>" class="btn btn-danger btn-block">
                                <i class="fas fa-toggle-off" ></i>
                            </a>
                        <?php endif; ?>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table> 
<ul class="list-group">