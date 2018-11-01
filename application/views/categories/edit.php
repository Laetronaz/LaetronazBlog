<h2 class="text-center"><?= $title ;?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('categories/update'); ?>
    <input type="hidden" name="id" value= "<?php echo $category['id']; ?>">
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter name" value="<?php echo $category['name']; ?>">
        <label>Change Category Icon</label>
        <input class="form-control" type="file" name="userfile" size="20">
    </div>
    
    <div class="form-group">
        <label>Image Preview</label><br>
        <img id="preview" src="<?php echo base_url(); ?>\assets\images\categories\<?php echo $category['category_icon']; ?>" alt="your image" height="200" width="200" />
    </div>

    <div class="form-group">
    <button type="submit" class="btn btn-default">Submit</button>
    </div>
</form>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/ImageViewer.js"></script>