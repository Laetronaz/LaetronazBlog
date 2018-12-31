
<h1><?= $title; ?>
    <a class="float-right" href="<?php echo base_url().POSTS_CREATE_PATH?>">
        <i class="fas fa-plus-circle fa-2x link-color-new"></i>
    </a>
</h1>

<table class="table table-hover">
    <thead>
        <tr>
            <th></th>
            <th class="text-center" scope="col">Icon</th>
            <th class="text-center" scope="col">Title</th>
            <th class="text-center" scope="col">Category</th>
            <th class="text-center" scope="col">Created at</th>
            <th class="text-center" scope="col">Edit</th>
            <th class="text-center" scope="col">Toogle</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($posts as $post) : ?> 
            <tr class="table-secondary">
                <td class="text-center align-middle" scope="row"><i class="fas fa-circle <?php echo $post['style']?>" ></i></td>
                <td class="text-center align-middle" scope="row"><img class ="thumbnail" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image'];?>" height="50" width="50"></td>
                <td class="text-center align-middle" ><a href="<?php echo base_url() ?>posts/<?php echo $post['slug']?>"><?php echo $post['title']?></a></td>
                <td class="text-center align-middle"><?php echo $categories[array_search($post['category_id'],array_column($categories,'id'))]['name'];?></td> 
                <td class="text-center align-middle"><?php echo date("Y-m-d G:i",strtotime($post['created_at']));?></td>
                <td class="text-center align-middle" scope="col">
                    <a class="btn btn-primary btn-block" href="<?php echo site_url(); ?>posts/edit/<?php echo $post['slug']?>">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
                <td class="text-center align-middle" scope="col">
                    <?php if($post['state'] == TRUE) : ?>
                        <a class="btn btn-danger btn-block" href="<?php echo site_url(); ?>posts/toggle/<?php echo $post['id']?>">
                            <i class="fas fa-toggle-off" ></i>
                        </a>
                    <?php else : ?>
                        <a class="btn btn-success btn-block" href="<?php echo site_url(); ?>posts/toggle/<?php echo $post['id']?>">
                            <i class="fas fa-toggle-off" ></i>
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table> 
<ul class="list-group">