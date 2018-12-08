<img class="thumbnail" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image'];?>" width="100%" height="379">
<div class="row">
    <h2><?php echo $post['title']; ?></h2>
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
        <a href="<?php echo base_url()?>/tag/<?php echo $tag['id']?>" class="badge badge-pill badge-info badge-padding">
            <?php echo $tag['title']?>
        </a>
    <?php endforeach; ?> 
</div>
<div id="disqus_thread"></div>

<script>
    var disqus_config = function () {
        this.page.url = '<?php echo current_url(); ?>'; // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = '<?php echo $post['slug']; ?>'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
