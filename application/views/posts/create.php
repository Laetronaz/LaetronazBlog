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
    <label>Sub Category</label>
    <select name="subcategory_id" class="form-control form-control-sm">
      <?php foreach($subcategories as $subcategory): ?>
        <option value="<?php echo $subcategory['id']; ?>"><?php echo $subcategory['name']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label>Upload Image</label><br>
    <input type="file" name="userfile" size="20">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>
<script>CKEDITOR.replace('editor1');</script>