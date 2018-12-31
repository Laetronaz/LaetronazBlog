<html>
<head>
    <title>Laetronaz Blog</title>
    <!-- STYLES -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">   
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oxygen" >
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
    <link rel="sylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
    <link rel="sylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

    <!-- LOCAL STYLES -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/defaultFont.css" >
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tagsinput.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/loginForm.css">

    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.11.1/full/ckeditor.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    

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
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Search Filter
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a href="<?php echo base_url().CATEGORIES_FILTER_ROUTE ?>" class="list-group-item list-group-item-action border-white">
            <span class="menu-collapsed">Search by Categories</span>
          </a>  
          <a href="<?php echo base_url().TAGS_FILTER_ROUTE ?>" class="list-group-item list-group-item-action border-white">
            <span class="menu-collapsed">Search by Tags</span>
          </a>
          <a href="<?php echo base_url().USERS_FILTER_ROUTE ?>" class="list-group-item list-group-item-action border-white">
            <span class="menu-collapsed">Search By Authors</span>
          </a>
        </div>
      </li>
    <li class="nav-item">
    <?php echo form_open(SEARCH_ROUTE,array("class" => "form-inline my-2 my-lg-0"));?>
      <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search" required>
      <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>
    </li>
    <?php if(!$this->session->userdata('logged_in')) : ?>
        <li class="nav-item center">
            <a class="nav-link" href="<?php echo base_url(); ?>users/login">Login</a>
        </li>
      <?php endif; ?>
      <?php if($this->session->userdata('logged_in')) : ?>
        <li class="nav-item center">
            <a class="nav-link" href="<?php echo base_url(); ?>users/logout">Logout</a>
        </li>
      <?php endif; ?>  
    </ul>
  </div>
</nav>
<div class="container-fluid">
  <div class="row">
    <?php if($this->session->userdata('rights')) : ?>
      <div class="col-md-2">
            <!-- A vertical navbar -->
            <nav class="navbar bg-light remove-border">
              <!-- Links -->
              <a class="navbar-brand admin-menu" href="#">Menu</a>
              <ul class="navbar-nav">
              <?php if(array_search('admin',array_column($this->session->userdata('rights'),'name')) !== FALSE || array_search('manage roles',array_column($this->session->userdata('rights'),'name')) !== FALSE): ?>
                <li class="nav-item">
                    <a class="nav-link" href="#rolessubmenu" data-toggle="collapse" data-target="#rolessubmenu">Roles Management</a>
                    <div id="rolessubmenu" class="sidebar-submenu collapse">         
                      <a href="<?php echo base_url().ROLES_INDEX_ROUTE ?>" class="list-group-item list-group-item-action border-white">
                          <span class="menu-collapsed">Manage Roles</span>
                      </a>
                    </div>
                  </li>
                <?php endif ?>
                <?php if(array_search('admin',array_column($this->session->userdata('rights'),'name')) !== FALSE || array_search('manage users',array_column($this->session->userdata('rights'),'name')) !== FALSE): ?>
                  <li class="nav-item">
                    <a class="nav-link" href="#usersubmenu" data-toggle="collapse" data-target="#usersubmenu">Manage Users</a>
                    <div id="usersubmenu" class="sidebar-submenu collapse" >
                      <a href="<?php echo base_url(); ?>users/register" class="list-group-item list-group-item-action border border-white">
                          <span class="menu-collapsed">Register User</span>
                      </a>
                      <a href="<?php echo base_url();?>users/" class="list-group-item list-group-item-action border border-white">
                          <span class="menu-collapsed">Manage Users</span>
                      </a>
                    </div>
                  </li>
                  <?php endif ?>
                  <?php if(array_search('admin',array_column($this->session->userdata('rights'),'name')) !== FALSE || array_search('manage categories',array_column($this->session->userdata('rights'),'name')) !== FALSE): ?>
                    <li class="nav-item">
                      <a class="nav-link" href="#categorysubmenu" data-toggle="collapse" data-target="#categorysubmenu">Manage Categories</a>
                      <div id="categorysubmenu" class="sidebar-submenu collapse">
                        <a href="<?php echo base_url(); ?>categories/create" class="list-group-item list-group-item-action border border-white">
                            <span class="menu-collapsed">Create Category</span>
                        </a>
                        <a href="<?php echo base_url().CATEGORIES_INDEX_PATH; ?>" class="list-group-item list-group-item-action border border-white">
                            <span class="menu-collapsed">Manage Categories</span>
                        </a>
                      </div>
                    </li> 
                  <?php endif ?>    
                  <?php if(!(array_search('admin',array_column($this->session->userdata('rights'),'name')) === FALSE && array_search('manage own posts',array_column($this->session->userdata('rights'),'name')) === FALSE && array_search('manage all posts',array_column($this->session->userdata('rights'),'name')) === FALSE)): ?>
                    <li class="nav-item">     
                      <?php if(!(array_search('admin',array_column($this->session->userdata('rights'),'name')) === FALSE && array_search('manage own posts',array_column($this->session->userdata('rights'),'name')) === FALSE && array_search('manage all posts',array_column($this->session->userdata('rights'),'name')) === FALSE)): ?>            
                        <a class="nav-link" href="#postssubmenu" data-toggle="collapse" data-target="#postssubmenu">Manage Posts</a>
                        <div id="postssubmenu" class="sidebar-submenu collapse">
                          <a href="<?php echo base_url(); ?>posts/create" class="list-group-item list-group-item-action border-white">
                              <span class="menu-collapsed">Create Post</span>
                          </a>
                          <a href="<?php echo base_url(); ?>posts/me" class="list-group-item list-group-item-action border-white">
                              <span class="menu-collapsed">Manage My Posts</span>
                          </a>          
                        </a>    
                        <?php endif ?>
                        <?php if(!(array_search('admin',array_column($this->session->userdata('rights'),'name')) === FALSE && array_search('manage all posts',array_column($this->session->userdata('rights'),'name')) === FALSE)): ?>                   
                        <a href="<?php echo base_url().POSTS_ALLINDEX_PATH ?>" class="list-group-item list-group-item-action border-white">
                            <span class="menu-collapsed">Manage All Posts</span>
                        </a>
                      </div>
                      <?php endif ?>
                    </li>
                  <?php endif ?>
                  <?php if(!(array_search('admin',array_column($this->session->userdata('rights'),'name')) === FALSE && array_search('consult logs',array_column($this->session->userdata('rights'),'name')) === FALSE)): ?>
                    <li class="nav-item">
                      <a class="nav-link" href="#logssubmenu" data-toggle="collapse" data-target="#logssubmenu">Consult Logs</a>
                      <div id="logssubmenu" class="sidebar-submenu collapse" >
                        <a href="<?php echo base_url().LOGS_INDEX_ROUTE?>" class="list-group-item list-group-item-action border border-white">
                            <span class="menu-collapsed">Application Logs</span>
                        </a>
                        <a href="<?php echo base_url().LOGS_INDEX_USERS_PATH?>" class="list-group-item list-group-item-action border border-white">
                            <span class="menu-collapsed">Users Logs</span>
                        </a>
                        <a href="<?php echo base_url().LOGS_INDEX_ROLES_PATH?>" class="list-group-item list-group-item-action border border-white">
                            <span class="menu-collapsed">Roles Logs</span>
                        </a>
                        <a href="<?php echo base_url().LOGS_INDEX_POSTS_PATH?>" class="list-group-item list-group-item-action border border-white">
                            <span class="menu-collapsed">Posts Logs</span>
                        </a>
                        <a href="<?php echo base_url().LOGS_INDEX_CATEGORIES_PATH?>" class="list-group-item list-group-item-action border border-white">
                            <span class="menu-collapsed">Categories Logs</span>
                        </a>
                        <a href="<?php echo base_url().LOGS_INDEX_TAGS_PATH?>" class="list-group-item list-group-item-action border border-white">
                            <span class="menu-collapsed">Tags Logs</span>
                        </a>
                      </div>
                    </li>
                  <?php endif ?>
              </ul>
            </nav>
        </div>
    <?php endif; ?>
    <?php echo ($this->session->userdata('rights') ? "<div class='col-md-10'>" : "<div class='col-md-12'>"); ?>
        <div class="container">
          <?php foreach ($this->session->get_flash_keys() as $flashkey) : ?>
              <!--Flash messages -->
              <p class="alert <?php echo $this->session->flashdata($flashkey)['type']?>"><?php echo $this->session->flashdata($flashkey)['value']?></p>
            <?php endforeach; ?>