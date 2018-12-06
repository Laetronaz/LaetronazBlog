
<h2><?= $title; ?></h2>
<table class="table table-hover">
    <thead>
        <tr>
            <th></th>
            <th class="text-center" scope="col">Icon</th>
            <th class="text-center" scope="col">Category Name</th>
            <?php if($this->session->userdata('user_type') == 'Admin') : ?>
                <th class="text-center" scope="col">Created at</th>
                <th class="text-center" scope="col">Edit</th>
                <th class="text-center" scope="col">Toogle</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach($categories as $category) : ?>     
            <tr class="table-secondary">
                <td class="text-center" scope="row"><i class="fas fa-circle <?php echo $category['style']?>" ></i></td>
                <td class="text-center" scope="row"><img class ="thumbnail" src="<?php echo site_url(); ?>assets/images/categories/<?php echo $category['category_icon'];?>" height="50" width="50"></td>
                <td class="text-center" ><a href="<?php echo site_url('/categories/posts/'.$category['id']); ?>"><?php echo $category['name'];?></a></td>
                <?php if($this->session->userdata('user_id') == $category['user_id'] || $this->session->userdata('user_type') == 'Admin') : ?>
                    <td class="text-center"><?php echo date("Y-m-d",strtotime($category['created_at']));?></th>
                        <td class="text-center" scope="col">
                            <a class="btn btn-primary btn-block" href="categories/edit/<?php echo $category['id'];?>">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    <td class="text-center" scope="col">
                    <?php if($category['active'] == TRUE) : ?>
                        <a class="btn btn-danger btn-block" href="categories/delete/<?php echo $category['id']; ?>">
                            <i class="fas fa-toggle-off" ></i>
                        </a>
                    <?php else : ?>
                        <a class="btn btn-success btn-block" href="categories/delete/<?php echo $category['id']; ?>">
                            <i class="fas fa-toggle-off" ></i>
                        </a>
                    <?php endif; ?>
                    </td>
                <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table> 
<ul class="list-group">