<h2><?= $title ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open_multipart('posts/create'); ?> 
  <div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" name ="title" placeholder="Add Title">
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlSelect1">Body</label>
    <textarea id="editor1" class="form-control" name="body" placeholder="Add body"></textarea>
  </div>
  
  <div class = "form-group">
    <label>Category</label>
    <select name="category_id" class="form-control form-control-sm">
      <?php foreach($categories as $category): ?>
        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label for="tagsinput">Tags</label>
    <input class="form-control" name="tagsinput" type="text" data-role="tagsinput" value="">
  <button type="submit" class="btn btn-default">Submit</button>
</form>
<script>CKEDITOR.replace('editor1');</script>
<!-- Image Preview File -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/javascript/ImageViewer.js"></script>