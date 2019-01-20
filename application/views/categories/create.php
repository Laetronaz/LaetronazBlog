<h1><?= $title ;?></h1>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart(CATEGORIES_CREATE_PATH); ?>
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter name" value="<?php echo set_value("name")?>">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>