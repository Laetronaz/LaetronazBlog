<h2 class="text-center"><?= $title ;?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('categories/create'); ?>
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter name">
        <label>Upload Category Icon</label>
        <input class="form-control" type="file" name="userfile" size="20">
        <label>Icon Preview</label>
        <div>
            <img id="preview" src="<?php echo base_url(); ?>\assets\images\categories\yourImage.png" alt="your image" height="150" width="150" />
        </div>
        
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
<!-- Image Preview File -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/ImageViewer.js"></script>