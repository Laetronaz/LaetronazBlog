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
    <label>Image Upload</label>
    <input class="form-control" type="file" name="userfile" size="20">
  </div>

  <div class="form-group">
        <label>Image Preview</label><br>
        <img id="preview" src="<?php echo base_url(); ?>\assets\images\posts\<?php echo $post['post_image']; ?>" alt="your image" height="200" width="200" />
    </div>
  
  <button type="submit" class="btn btn-default">Submit</button>
</form>
<script>CKEDITOR.replace('editor1');</script>
<!-- Image Preview File -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/ImageViewer.js"></script>