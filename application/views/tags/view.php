<h1>Name: <?php echo $title ?></h1>
<h2 class="top-buffer">Used in <?php echo $uses ?> posts</h2>
<h2 class="top-buffer">Posts marked with this tag:</h2>
<div class="container">
    <?php foreach($posts as $post) : ?>
        <?php if($post['active'] == 1) :?>
        <div class="row">
            <div class="col-md-3">
                <img class ="thumbnail" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image'];?>" height="200" width="200">
            </div>
            <div class="col-md-9">
                <small class="post-date">Posted on: <?php echo $post['created_at']; ?> in <strong><?php echo $post['title']; ?></strong> </small><br>
                <small><?php echo word_limiter($post['body'], 60); ?></small>
                <br><br>
                <p><a class="btn btn-default" href="<?php echo site_url(); ?>posts/<?php echo $post['slug']?>">Read More</a></p>
            </div>
        </div>
        <?php endif;?>
    <?php endforeach;?>
</div>

    