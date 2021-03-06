<h1><?= $title; ?>
    <a class="float-right" href="<?php echo base_url().CATEGORIES_CREATE_PATH?>">
        <i class="fas fa-plus-circle fa-2x link-color-new"></i>
    </a>
</h1>
<table class="table table-hover">
    <thead>
        <tr>
            <th></th>
            <th class="text-center" scope="col">Icon</th>
            <th class="text-center" scope="col">Category Name</th>
            <th class="text-center" scope="col">Created at</th>
            <th class="text-center" scope="col">Edit</th>
            <th class="text-center" scope="col">Toogle</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($categories as $category) : ?>     
            <tr class="table-secondary">
                <td class="text-center align-middle" scope="row"><i class="fas fa-circle <?php echo $category['style']?>" ></i></td>
                <td class="text-center align-middle" scope="row"><img class ="thumbnail" src="<?php echo site_url().CATEGORIES_IMAGES_FOLDER.$category['category_icon'];?>" height="50" width="50"></td>
                <td class="text-center align-middle" ><a href="<?php echo site_url(CATEGORIES_POSTS_PATH.$category['id']); ?>"><?php echo $category['name'];?></a></td>
                <td class="text-center align-middle"><?php echo date("Y-m-d",strtotime($category['created_at']));?></td>
                    <td class="text-center align-middle" scope="col">
                        <a class="btn btn-primary btn-block" href="<?php echo CATEGORIES_EDIT_PATH.$category['id'];?>">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                <td class="text-center align-middle" scope="col">
                    <?php if($category['active'] == TRUE) : ?>
                        <a class="btn btn-danger btn-block" href="<?php echo CATEGORIES_TOGGLE_PATH.$category['id']; ?>">
                            <i class="fas fa-toggle-off" ></i>
                        </a>
                    <?php else : ?>
                        <a class="btn btn-success btn-block" href="<?php echo CATEGORIES_TOGGLE_PATH.$category['id']; ?>">
                            <i class="fas fa-toggle-off" ></i>
                        </a>
                    <?php endif; ?>
                </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table> 
<ul class="list-group">