<h2 class="text-center"><?= $title ;?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('categories/update'); ?>
    <input type="hidden" name="id" value= "<?php echo $category['id']; ?>">
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter name" value="<?php echo $category['name']; ?>">
        <label>Upload Category Icon</label>
        <input class="form-control" type="file" name="userfile" size="20" value="<?php echo $category['category_icon']; ?>">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>