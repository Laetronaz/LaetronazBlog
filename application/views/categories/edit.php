<h1><?= $title ;?></h1>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('categories/edit/'.$category['id']); ?>
    <input type="hidden" name="id" value= "<?php echo $category['id']; ?>">
    <div class="form-group">
        <label>Icon</label><br>
        <img src="<?php echo base_url(); ?>\assets\images\categories\<?php echo $category['category_icon']; ?>" height="200" width="200">
    </div>
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter name" value="<?php echo set_value("name",$category['name']); ?>">
    </div>
    <div class="form-group">
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="button" data-toggle="modal" data-target="#ImageUpdate" class="btn btn-info">Change Icon</button>
    </div>
</form>
    
     <!-- Modal -->
    <div class="modal fade" id="ImageUpdate" role="dialog">
        <div class="modal-dialog">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Category Icon</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Image Preview</label><br>
                    <img id="preview" src="<?php echo base_url(); ?>\assets\images\categories\<?php echo $category['category_icon']; ?>" height="200" width="200" />
                </div>
                <?php echo form_open_multipart('categories/update_image'); ?>
                    <input type="hidden" name="id" value= "<?php echo $category['id']; ?>">
                    <div class="form-group">
                        <label>Change Category Icon</label>
                        <input class="form-control" type="file" name="userfile" accept="image/*" size="20"> 
                    </div>
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update Category</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
        
        </div>
    </div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/ImageViewer.js"></script>