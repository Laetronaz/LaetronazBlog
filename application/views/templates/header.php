<html>
<head>
    <title>Laetronaz Blog</title>
    <!-- STYLES -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">   
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oxygen" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <!-- LOCAL STYLES -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/defaultFont.css" >
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tagsinput.css">
    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="http://cdn.ckeditor.com/4.10.0/standard/ckeditor.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- LOCAL SCRIPTS -->
    <script src="<?php echo base_url(); ?>assets/javascript/tagsinput.js"></script>
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
    </ul>

    <ul class="nav navbar-nav navbar-right">
    <?php if(!$this->session->userdata('logged_in')) : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>users/login">Login</a>
        </li>
      <?php endif; ?>
      <?php if($this->session->userdata('logged_in')) : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>users/logout">Logout</a>
        </li>
      <?php endif; ?>  
    </ul>
  </div>
  
</nav>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-2">
          <?php if($this->session->userdata('user_type') == 'Admin') : ?>
            <!-- A vertical navbar -->
            <nav class="navbar bg-light">
              <!-- Links -->
              <a class="navbar-brand" href="#">Administration Menu</a>
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="#usersubmenu" data-toggle="collapse" data-target="#usersubmenu">Manage Users</a>
                  <div id="usersubmenu" class="sidebar-submenu collapse" >
                    <a href="<?php echo base_url(); ?>users/register" class="list-group-item list-group-item-action border border-white">
                        <span class="menu-collapsed">Create New User</span>
                    </a>
                    <a href="<?php echo base_url();?>users/index" class="list-group-item list-group-item-action border border-white">
                        <span class="menu-collapsed">Users List</span>
                    </a>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#categorysubmenu" data-toggle="collapse" data-target="#categorysubmenu">Manage Categories</a>
                  <div id="categorysubmenu" class="sidebar-submenu collapse">
                    <a href="<?php echo base_url(); ?>categories/create" class="list-group-item list-group-item-action border border-white">
                        <span class="menu-collapsed">Create New Category</span>
                    </a>
                    <a href="<?php echo base_url(); ?>categories" class="list-group-item list-group-item-action border border-white">
                        <span class="menu-collapsed">List Categories</span>
                    </a>
                  </div>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#postssubmenu" data-toggle="collapse" data-target="#postssubmenu">Manage Posts</a>
                  <div id="postssubmenu" class="sidebar-submenu collapse">
                    <a href="<?php echo base_url(); ?>posts/userindex" class="list-group-item list-group-item-action border-white">
                        <span class="menu-collapsed">My Posts</span>
                    </a>          
                    <a href="<?php echo base_url(); ?>posts/create" class="list-group-item list-group-item-action border-white">
                        <span class="menu-collapsed">Create New Post</span>
                    </a>
                    <a href="<?php echo base_url(); ?>" class="list-group-item list-group-item-action border-white">
                        <span class="menu-collapsed">Posts List</span>
                    </a>
                  </div>
                </li>
              </ul>
            </nav>
          <?php endif; ?>
    </div>
    <div class="col-md-10">
        <div class="container">
          <?php foreach ($this->session->get_flash_keys() as $flashkey) : ?>
              <!--Flash messages -->
              <p class="alert <?php echo $this->session->flashdata($flashkey)['type']?>"><?php echo $this->session->flashdata($flashkey)['value']?></p>
            <?php endforeach; ?>