<h2><?php echo $post['title']; ?></h2>
<small class="post-date">Posted on: <?php echo $post['created_at']; ?></small></br>
<img class="thumbnail" src="<?php echo site_url(); ?>assets/images/posts/<?php echo $post['post_image'];?>" width="250" height="250">
<div class="post-body">
    <?php echo $post['body']; ?>
</div>

<hr>
<a class="btn btn-default pull-left" href="edit/<?php echo $post['slug']; ?>">Edit</a>
<?php echo form_open('posts/delete/'.$post['id']); ?>
    <input type="submit" value="delete" class="btn btn-danger">
</form>
