<h2 class="text-center"><?= $title ;?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('subcategories/create'); ?>
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter name">
        
        <label>Upload Category Icon</label>
        <input class="form-control" type="file" name="userfile" size="20">
    </div>
    <div class="form-group">
    <label>Category</label>
        <select name="category_id" class="form-control" style="line-height: 15px">
            <?php foreach($categories as $category) :?>
                <option value="<?php echo $category['id']?>"><?php echo $category['name']?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
</form>