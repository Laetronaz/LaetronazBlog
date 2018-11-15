
<?php echo validation_errors(); ?>


<?php echo form_open('users/register'); ?>
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <h1 class="text-center"><?= $title; ?></h1>
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Name">
            </div>
            <div class="form-group">
                <label>Zipcode</label>
                <input type="text" class="form-control" name="zipcode" placeholder="Zipcode">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label>User Type</label>
                <select class="form-control form-control-sm" name="usertype">
                    <?php foreach($types as $type) : ?>
                        <option value="<?php echo $type['id']?>"><?php echo $type['name'];?></option>
                    <?php endforeach;?>
                </select>
            </div>


            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="password2" placeholder="Confirm Password">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
    </div>
<?php echo form_close(); ?>
<script>

    var nav_item = document.getElementById('nav_item');
    var nav_link = document.getElementById('nav_link');
    var dropdown_menu = document.getElementById('dropdown_menu'); 
    function dropdown(){      
        if(nav_item.className == "nav-item dropdown"){
            nav_item.className = "nav-item dropdown show" ;
        }
        else{
            nav_item.className = "nav-item dropdown";
        }
     
        if(dropdown_menu.className == "dropdown-menu"){
            dropdown_menu.className = "dropdown-menu show";
        }
        else{
            dropdown_menu.className = "dropdown-menu";
        }
    }

    function dropdownSelected(dropdown_item){
        nav_link.innerHTML = dropdown_item.innerHTML;
        dropdown();
    }
</script>