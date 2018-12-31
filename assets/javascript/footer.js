$(document).ready(function() {
    var $title = $("h1").text().trim();
    switch($title){
        case'Manage Roles':
            $('#rolessubmenu').toggle();
            break;
        case 'Register User':
        case 'Manage Users':
            $('#usersubmenu').toggle();
            break;
        case 'Manage Categories':
        case 'Create Category':
            $('#categorysubmenu').toggle();
            break;
        case 'Create Post':
        case 'Manage My Posts':
        case 'Manage All Posts':
            $('#postssubmenu').toggle();
            break;
        case 'Application Logs':
        case 'Users Logs':
        case 'Roles Logs':
        case 'Posts Logs':
        case 'Categories Logs':
        case 'Tags Logs':
            $('#logssubmenu').toggle();
            break;
    }
    //contains words.
    
    if($title.indexOf('Edit User:') >= 0){
        $('#usersubmenu').toggle();
    }
    else if($title.indexOf('Edit Category:') >= 0){
        $('#categorysubmenu').toggle();
    }
    else if($title.indexOf('Edit Post:') >= 0){
        $('#postssubmenu').toggle();
    }
});