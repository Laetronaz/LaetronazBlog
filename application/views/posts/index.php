<h2><?= $title ?></h2>
<?php foreach($posts as $post) : ?>
    <h3><?php echo $post['title']; ?></h3>
    <div class="row">
        <div class="col-md-3">
            <img class ="thumbnail" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image'];?>" height="250" width="250">
        </div>
        <div class="col-md-9">
            <small class="post-date">Posted on: <?php echo date('Y-m-d H:i:s', strtotime($post['created_at'])); ?> in <strong><?php echo $post['name']; ?></strong> </small></br>
            <?php echo word_limiter($post['body'], 60); ?>
            <br><br>
            <p><a class="btn btn-default" href="<?php echo site_url('/posts/'.$post['slug']); ?>">Read More</a></p>
        </div>
    </div>
    
<?php endforeach; ?>
<div class = "row">
    <div class="offset-md-6">
        <ul class="pagination">
            <?php echo $this->pagination->create_links(); ?>
        </ul>
    </div>
</div>