<div class="row">
    <h1><?php echo $title?></h1>
</div>
<?php if(!empty($posts)) : ?>
    <div class="row top-buffer">
        <h2>Posts found: </h2>
    </div>
    <?php foreach($posts as $post) : ?>
        <h3><?php echo $post['title']; ?></h3>
        <div class="row ">
            <div class="col-md-3">
                <img class ="thumbnail" src="<?php echo site_url().POSTS_IMAGES_FOLDER.$post['post_image'];?>" height="200" width="200">
            </div>
            <div class="col-md-9">
                <small class="post-date">Posted on: <?php echo $post['created_at']; ?> in <strong><?php echo $post['title']; ?></strong> </small><br>
                <small><?php echo word_limiter($post['body'], 60); ?></small>
                <br><br>
                <p><a class="btn btn-default" href="<?php echo site_url(); ?>posts/<?php echo $post['slug']?>">Read More</a></p>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif;?>

<?php if(!empty($categories)) : ?>
    <div class="row top-buffer">
        <h2>Categories Found: </h2>
    </div>
    <div class="row">
        <div class="col">
            <div class="list-group">
                <?php foreach($categories as $category) :?>
                        <a href="<?php echo base_url().CATEGORIES_POSTS_PATH.$category['id']?>" class="list-group-item list-group-item-action">
                            <?php echo trim($category['name']); ?>
                        </a>  
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
<?php endif;?>

<?php if(!empty($tags)) : ?>
    <div class="row top-buffer">
        <h2>Tags Found: </h2>
    </div>
    <div class="row">
        <?php foreach($tags as $tag) :?>
            <a href="<?php echo base_url().TAGS_POSTS_PATH.$tag['id']?>" class="badge badge-pill badge-info badge-padding"><?php echo $tag['title'] ?></a>
        <?php endforeach; ?>
    </div>
<?php endif;?>

<?php if(!empty($users)) : ?>
    <div class="row top-buffer">
        <h2>Users Found:  </h2>
    </div>
    <div class="row">
        <div class="col">
            <div class="list-group">
                <?php foreach($users as $user) :?>
                        <a href="<?php echo base_url().USERS_POSTS_PATH.$user['id']?>" class="list-group-item list-group-item-action">
                            <?php echo trim($user['username']); ?>
                        </a>  
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif;?>

<?php if(empty($posts) && empty($categories) && empty($tags) && empty($users)) :?>
    <h2>No result where found for the keyword entered.</h2>
<?php endif;?>