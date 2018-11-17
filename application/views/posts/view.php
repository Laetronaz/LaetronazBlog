<img class="thumbnail" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image'];?>" width="100%" height="379">
<h2><?php echo $post['title']; ?></h2>
<small class="post-date">Posted on: <?php echo $post['created_at']; ?></small></br>
<div class="post-body">
    <?php echo $post['body']; ?>
</div>

<?php if($this->session->userdata('user_id') == $post['user_id']) : ?>
    <hr>
	<a class="btn btn-default float-left" href="<?php echo base_url(); ?>posts/edit/<?php echo $post['slug']; ?>">Edit</a>
	<?php echo form_open('/posts/delete/'.$post['id']); ?>
		<input type="submit" value="Toggle Post" class="btn btn-danger">
	</form>
<?php endif; ?>
<div id="disqus_thread"></div>

<script>
    var disqus_config = function () {
        this.page.url = '<?php echo current_url(); ?>'; // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = '<?php echo $post['slug']; ?>'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://laetronazblog.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>