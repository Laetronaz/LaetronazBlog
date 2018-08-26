<h2><?= $title; ?></h2>
<ul class="list-group">
<?php foreach($categories as $category) : ?>
    <li class="list-group-item">
        <?php if($this->session->userdata('user_id') == $category['user_id'] || $this->session->userdata('user_type') == 'Admin') : ?>
            <form class="form-inline" action="categories/delete/<?php echo $category['id']; ?>" method="POST">
                <div class="form-group col-sm-8 ">
                    <a href="<?php echo site_url('/categories/posts/'.$category['id']); ?>"><?php echo $category['name'];?></a>
                </div>
                <div class="form-group col-sm-2 ">
                    <input type="submit" class="btn btn-danger btn-block" value="Delete">
                </div>
            </form>
        <?php else : ?>
            <div class="form-group col-sm-8 ">
                <a href="<?php echo site_url('/categories/posts/'.$category['id']); ?>"><?php echo $category['name'];?></a>
            </div>
        <?php endif; ?>
    </li>
<?php endforeach; ?>
</ul>
