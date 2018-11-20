<img src="<?php echo base_url(); ?>\assets\images\posts\<?php echo $post['post_image']; ?>" height="379" width="100%">
<br><br>
<h2><?= $title ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('posts/update'); ?> 
    <input type="hidden" name="id" value= "<?php echo $post['id']; ?>">
  <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name ="title" placeholder="Add Title" Value="<?php echo $post['title']; ?>">
  </div>
  <div class="form-group">
    <label for="body">Body</label>
    <textarea id="editor1" class="form-control" name="body" placeholder="Add body"><?php echo $post['body']; ?></textarea>
  </div>
  <div class = "form-group">
    <label>Category</label>
    <select name="category_id" class="form-control form-control-sm">
      <?php foreach($categories as $category): ?>
        <option <?php if ($post['category_id'] == $category['id']){ echo "selected"; }?> value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label for="tagsinput">Tags</label>
    <input class="form-control" name="tagsinput" type="text" data-role="tagsinput" value="
      <?php foreach($post_tags as $tag) : ?>
        <?php echo $tag['title'].','?>
      <?php endforeach ?>
    ">
  </div>
  <button type="submit" class="btn btn-primary">Update Post</button>
  <button type="button" data-toggle="modal" data-target="#ImageUpdate" class="btn btn-info">Change Thumbnail</button>
</form>


 <!-- Modal -->
 <div class="modal fade" id="ImageUpdate" role="dialog">
        <div class="modal-dialog">  
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Post Thumbnail</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                  <label>Thumbnail Preview</label><br>
                  <img id="preview" src="<?php echo base_url(); ?>\assets\images\posts\<?php echo $post['post_image']; ?>" height="200" width="200" />
              </div>
              <?php echo form_open_multipart('posts/update_image'); ?>
                  <input type="hidden" name="id" value= "<?php echo $post['id']; ?>">
                  <div class="form-group">
                      <label>Change Thumbnail</label>
                      <input class="form-control" type="file" name="userfile" accept="image/*" size="20"> 
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </form>
            </div>
        </div>  
    </div>
  </div>
<script>CKEDITOR.replace('editor1');</script>
<!-- Image Preview File -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/ImageViewer.js"></script>
