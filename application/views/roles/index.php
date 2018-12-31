<?php echo validation_errors(); ?>
<h1>Manage Roles</h1>
<br>
<div class="row">
    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <?php foreach($roles as $role) :?>
                <a class="nav-link text-center <?php if($role['id'] ==1 ) echo 'active'?>" id="v-pills-home-tab" data-toggle="pill" href="#role-<?php echo $role['id']?>" role="tab" aria-controls="<?php echo $role['name']?>" <?php echo ($role['id'] == 1 ? "aria-selected='true'" : "aria-selected='false'")?>>
                    <?php echo $role['name']?>
                </a>
            <?php endforeach ?>
        <a class="nav-link text-center" id="v-pills-settings-tab" data-toggle="pill" href="#role-create" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fas fa-plus-circle"></i></a>
    </div>
    <div class="col">
        <div class="tab-content" id="v-pills-tabContent">
            <?php foreach($roles as $role) :?>
                <div id="role-<?php echo $role['id'] ?>" class="tab-pane fade <?php if($role['id']==1) echo " active show" ?>" role="tabpanel" aria-labelledby="<?php echo $role['name']?>">
                    <h3>Role: <?php echo $role['name'] ?> 
                    <?php if($role['id'] != 1) :?>
                        <a href="<?php echo base_url().ROLES_DELETE_PATH.$role['id'];?>"><i class="far fa-trash-alt"></i></a>
                    <?php endif;?>
                    </h3>
                    <?php echo form_open_multipart(ROLES_EDIT_PATH.$role['id']); ?>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name ="name" placeholder="Add Name" value="<?php echo $role['name']; ?>">
                        </div>
                        <h2>Rights</h2>
                        <?php foreach($rights as $right) :?>
                        <div class="form-check top-buffer">
                            <input class="form-check-input" type="checkbox" name="<?php echo $right['name']?>" value="<?php echo $right['id']; ?>"
                            <?php if(array_search($right['id'], array_column($role['rights'],'id')) !== FALSE): ?>
                                <?php echo 'checked' ?>
                            <?php endif; ?>
                            >
                            <label class="form-check-label" for="<?php echo $right['name']?>">
                                <?php echo $right['name']?>
                            </label>
                            <a href="#" data-toggle="popover" title="<?php echo $right['name']?>" data-content="<?php echo $right['description']?>"><i class="far fa-question-circle"></i></a>
                        </div>
                        <?php endforeach?>  
                        <button type="submit" class="btn btn-primary top-buffer"
                        <?php if($role['id'] == 1): ?>
                            <?php echo 'disabled' ?>
                        <?php endif; ?>
                        >Edit Role</button>  
                    </form> 
                </div>
            <?php endforeach; ?>
            <div id="role-create" class="tab-pane fade">
                <h3>Create New Role</h3>
                <?php echo form_open_multipart(ROLES_CREATE_ROUTE); ?>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name ="name" placeholder="Add Name" value="<?php echo set_value("name"); ?>">
                    </div>
                    <h2>Rights</h2>
                    <?php foreach($rights as $right) :?>
                    <div class="form-check top-buffer">
                        <input class="form-check-input" type="checkbox" name="<?php echo $right['name']?>" value="<?php echo $right['id']; ?>" <?php echo set_checkbox($right['name'], $right['id']); ?>>
                        <label class="form-check-label" for="<?php echo $right['name']?>">
                            <?php echo $right['name']?>
                        </label>
                    </div>
                    <?php endforeach?>  
                    <button type="submit" class="btn btn-primary top-buffer">Create Role</button>   
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url()?>assets/javascript/roles.js"></script>
