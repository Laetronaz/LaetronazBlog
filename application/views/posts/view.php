<img class="thumbnail" src="<?php echo site_url().POSTS_IMAGES_FOLDER.$post['post_image'];?>" width="100%" height="379">
<div class="row">   
    <h1>
        <?php echo $post['title']; ?>
    </h1>
    <?php if($this->session->userdata('user_id') == $post['user_id']) : ?>
        <a class="float-left align-middle" href="<?php echo base_url().POSTS_EDIT_PATH.$post['slug']?>">
                <i class="fas fa-edit fa-2x"></i>
        </a>
    <?php endif ?>
</div>
<div class = "row post-date">
    Posted on: <?php echo date("Y-m-d G:i",strtotime($post['created_at'])); ?>
</div>
<div class= "row top-buffer">
    <?php echo $post['body']; ?>
</div>
<div class= "row">
    <h3>Post Tags:</h3>
</div>
<div class = "row">
    <?php foreach($tags as $tag) :?>
        <?php if(!empty($tag['title'])) : ?>
            <a href="<?php echo base_url()?>/tag/<?php echo $tag['id']?>" class="badge badge-pill badge-info badge-padding">
                <?php echo $tag['title']?>
            </a>
        <?php endif ?>
    <?php endforeach; ?> 
</div>
<div id="disqus_thread"></div>
<script src="<?php echo base_url().JAVASCRIPT_FOLDER.JS_DISQUS?>"></script>
<script>
    var disqus_config = function () {
        this.page.url = "<?php echo current_url(); ?>"; // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = "<?php echo $post['slug']; ?>"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>