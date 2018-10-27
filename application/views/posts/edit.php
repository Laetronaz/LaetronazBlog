<h2><?= $title ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('posts/update'); ?> 
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
    <label>Sub Category</label>
    <select name="subcategory_id" class="form-control form-control-sm">
      <?php foreach($subcategories as $subcategory): ?>
        <option <?php if ($post['subcategory_id'] == $subcategory['id']){ echo "selected"; }?> value="<?php echo $subcategory['id']; ?>"><?php echo $subcategory['name']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>
  
  <button type="submit" class="btn btn-default">Submit</button>
</form>
<script>CKEDITOR.replace('editor1');</script>