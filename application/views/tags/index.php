<h1 class="top-buffer"><?php echo $title ?></h1>
<?php $attributes = array("class" => "anchor-padding") ?>

<div class="container">
    <div class="row top-buffer">
        <?php foreach($tags as $letter =>$tag_list) :?>
            <?php if(!empty($tag_list)) : ?>
                <?php echo anchor('tags/#'.$letter,$letter, $attributes); ?>
            <?php else : ?>
                <label class="anchor-padding"><?php echo $letter ?></label>
            <?php endif; ?>  
        <?php endforeach; ?>
    </div>

    <?php foreach($tags as $letter =>$tag_list) :?>        
        <?php if(!empty($tag_list)) : ?>
            <div class="row top-buffer">
                <h3 id="<?php echo $letter?>"><?php echo $letter . "\n"; ?></h3>
            </div>
            <div class="row">
                <?php foreach($tag_list as $tag) :?>
                    <a href="<?php echo base_url().'tag/'.$tag['id']?>" class="badge badge-pill badge-info badge-padding"><?php echo $tag['title'] ?></a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>