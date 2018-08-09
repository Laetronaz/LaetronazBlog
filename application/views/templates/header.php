<html>
<head>
    <title>Laetronaz Blog</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <script src="http://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?php echo base_url(); ?>">Laetronaz Blog</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url(); ?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>about">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>posts">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>categories">Categories</a>
      </li>
    </ul>

    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>
    <ul class="nav navbar-nav navbar-right">
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>users/register">Register</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>posts/create">Create Post</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>categories/create">Create Category</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container">
  <!-- Flash messages -->
  <?php if($this->session->flashdata('user_registered')) : ?>
    <?php echo '<p class ="alert alert-success">'.$this->session->flashdata('user_registered').'</p>' ?>
  <?php endif; ?>

  <?php if($this->session->flashdata('post_created')) : ?>
    <?php echo '<p class ="alert alert-success">'.$this->session->flashdata('post_created').'</p>' ?>
  <?php endif; ?>

  <?php if($this->session->flashdata('post_updated')) : ?>
    <?php echo '<p class ="alert alert-success">'.$this->session->flashdata('post_updated').'</p>' ?>
  <?php endif; ?>

  <?php if($this->session->flashdata('post_deleted')) : ?>
    <?php echo '<p class ="alert alert-success">'.$this->session->flashdata('post_deleted').'</p>' ?>
  <?php endif; ?>

  <?php if($this->session->flashdata('category_created')) : ?>
    <?php echo '<p class ="alert alert-success">'.$this->session->flashdata('category_created').'</p>' ?>
  <?php endif; ?>