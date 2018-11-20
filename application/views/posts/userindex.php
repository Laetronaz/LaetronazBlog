
<h2><?= $title; ?></h2>
<table class="table table-hover">
    <thead>
        <tr>
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
                <td class="text-center" scope="row"><img class ="thumbnail" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image'];?>" height="50" width="50"></td>
                <td class="text-center" ><a href="<?php echo base_url() ?>posts/<?php echo $post['slug']?>"><?php echo $post['title']?></a></td>
                    <td class="text-center"><?php echo $categories[array_search($post['category_id'],array_column($categories,'id'))]['name'];?></td> 
                    <td class="text-center"><?php echo $post['created_at'];?></td>
                    <?php echo form_open('/posts/edit/'.$post['slug']); ?>
                        <td class="text-center" scope="col">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </form>
                    <td class="text-center" scope="col">
                    <?php echo form_open('/posts/toggle/'.$post['id']); ?>
                        <?php if($post['active'] == TRUE) : ?>
                        <?php echo form_open('/posts/toggle/'.$post['id']); ?>
                                <button type="submit" class="btn btn-danger btn-block">
                                    <i class="fas fa-toggle-off" ></i>
                                </button>
                            </form>
                        <?php else : ?>
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