<h1 class="top-buffer"><?php echo $title ?></h1>
<?php $attributes = array("class" => "anchor-padding") ?>

    <div class="row top-buffer">
        <?php foreach($users as $letter =>$users_list) :?>
            <?php if(!empty($users_list)) : ?>
                <?php echo anchor('tags/#'.$letter,$letter, $attributes); ?>
            <?php else : ?>
                <label class="anchor-padding"><?php echo $letter ?></label>
            <?php endif; ?>  
        <?php endforeach; ?>
    </div>

    <?php foreach($users as $letter =>$users_list) :?>        
        <?php if(!empty($users_list)) : ?>
            <div class="row top-buffer">
                <h3 id="<?php echo $letter?>"><?php echo $letter . "\n"; ?></h3>
            </div>
            <div class="row">
                <div class="col">
                    <div class="list-group">
                        <?php foreach($users_list as $user) :?>
                                <a href="<?php echo base_url().USERS_POSTS_PATH.$user['id']?>" class="list-group-item list-group-item-action">
                                    <?php echo trim($user['username']); ?>
                                </a>  
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
