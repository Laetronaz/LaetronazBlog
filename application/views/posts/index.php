<h2><?= $title ?></h2>
<?php foreach($posts as $post) : ?>
    <h3><?php echo $post['title']; ?></h3>
    <div class="row">
        <div class="col-md-3">
            <img class ="thumbnail" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image'];?>" height="200" width="200">
        </div>
        <div class="col-md-9">
            <small class="post-date">Posted on: <?php echo $post['created_at']; ?> in <strong><?php echo $post['name']; ?></strong> </small><br>
            <small><?php echo word_limiter($post['body'], 60); ?></small>
            <br><br>
            <p><a class="btn btn-default" href="<?php echo site_url('/posts/'.$post['slug']); ?>">Read More</a></p>
        </div>
    </div>
    
<?php endforeach; ?>
<div class = "row">
    <div class="offset-lg-5">
        <ul class="pagination">
            <?php echo $this->pagination->create_links(); ?>
        </ul>
    </div>
</div>