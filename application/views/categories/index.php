<h2 class="text-center"><?= $title; ?></h2>
<table class="table table-hover">
    <thead>
        <tr>
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
        <tr class="table-secondary">
        <?php foreach($categories as $category) : ?>
            <tr class="table-primary">
                <td class="text-center" scope="row"><img class ="thumbnail" src="<?php echo site_url(); ?>assets/images/categories/<?php echo $category['category_icon'];?>" height="50" width="50"></td>
                <td class="text-center" ><a href="<?php echo site_url('/categories/posts/'.$category['id']); ?>"><?php echo $category['name'];?></a></td>
                <?php if($this->session->userdata('user_id') == $category['user_id'] || $this->session->userdata('user_type') == 'Admin') : ?>
                    <td class="text-center"><?php echo $category['created_at'];?></th>
                    <form class="form-inline" action="categories/edit/<?php echo $category['id']; ?>" method="POST">
                        <td class="text-center" scope="col">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </form>
                    <td class="text-center" scope="col">
                    <?php if($category['active'] == TRUE) : ?>
                        <form class="form-inline" action="categories/delete/<?php echo $category['id']; ?>" method="POST">                        
                            <button type="submit" class="btn btn-danger btn-block">
                                <i class="fas fa-toggle-off" ></i>
                             </button>
                        </form>
                    <?php else : ?>
                        <form class="form-inline" action="categories/delete/<?php echo $category['id']; ?>" method="POST">
                            <button type="submit" class="btn btn-success btn-block">
                                <i class="fas fa-toggle-on"></i>
                            </button>
                        </form>
                    <?php endif; ?>
                    </td>
                <?php endif; ?>
        </tr>
        <?php foreach($subcategories as $subcategory) : ?>
            <?php if($subcategory['category_id'] == $category['id']) : ?>
            <tr class="table-secondary">
                <td class="text-center" scope="row"><img class ="thumbnail" src="<?php echo site_url(); ?>assets/images/subcategories/<?php echo $subcategory['subcategory_icon'];?>" height="50" width="50"></td>
                <td class="text-center" ><a href="<?php echo site_url('/subcategories/posts/'.$subcategory['id']); ?>"><?php echo $subcategory['name'];?></a></td>
                <?php if($this->session->userdata('user_id') == $category['user_id'] || $this->session->userdata('user_type') == 'Admin') : ?>
                    <td class="text-center"><?php echo $subcategory['created_at'];?></th>
                    <form class="form-inline" action="subcategories/edit/<?php echo $subcategory['id']; ?>" method="POST">
                        <td class="text-center" scope="col">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </form>
                        <td class="text-center" scope="col">
                            <?php if($subcategory['active'] == 1) : ?>
                                <form class="form-inline" action="subcategories/delete/<?php echo $subcategory['id']; ?>" method="POST">
                                    <button type="submit" class="btn btn-danger btn-block">
                                        <i class="fas fa-toggle-off" ></i>
                                    </button>
                                </form>
                            <?php else : ?>
                            <form class="form-inline" action="subcategories/delete/<?php echo $subcategory['id']; ?>" method="POST">
                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="fas fa-toggle-on"></i>
                                </button>
                            </form>
                            <?php endif; ?>
                        </td>
                    
                <?php endif; ?>
            </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php endforeach; ?>
    </tbody>
</table> 
<ul class="list-group">