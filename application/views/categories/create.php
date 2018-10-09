<h2 class="text-center"><?= $title ;?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('categories/create'); ?>
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter name">
        <label>Upload Category Icon</label>
        <input class="form-control" type="file" name="userfile" size="20">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>