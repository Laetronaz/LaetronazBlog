# LaetronazBlog
LaetronazBlog was an idea I had for a while now, it began as I wanted to write articles and the like on stuff I do, on stuff I saw and stuff I want to share. While could just have used a wordpress theme and the like. I prefered to made it from scratch myself, note because of trust issue but because I wanted to make a personal project for a while now. The project is bound to have bugs and errors, if you find any I invite you to post it on the Issue tab of the project.

## How to use this project for yourself
Please follow the following guide to use this project for yourself. You'll need to mainely replace some variables in the code for your personal ones.

### Database (MySQL and MariaDb Only)
Create a new schema on your mysql server, you can call it as you wish in my base it's *LaetronazBlog* but you call it simply *Blog*.

Once this is done go in the projects folder to *application/config/database* you will change the following lines for your own database datas:
1. 'hostname' => 'localhost',
2. 'username' => 'root',
3. 'password' => '',
4. 'database' => 'LaetronazBlog',

* hostname: you mysql database location
* username: your mysql database user
* password: your mysql database password
* database: the mysql database schema you want to use.

### SQL
One the schema is created you need to insert datas in the schama, but before doing that, we need to edit the admin you will use.

In the project folders go to *assets/sql/LaetronazBlog.sql* and find the following lines:
__INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `username`,`password`, `register_date`, `role`, `user_state`) VALUES__
__(1, 'First-Name', 'Last-Name', 'your-email', 'your-username', '$2y$10$dcwviYBqnM1jkpMKQtn5G.wVl.ap5kJa2iDjw0k1UjmBr.me3Cmyq', '2018-08-09 20:09:41', 1, 3);__
__COMMIT;__

You will need to change the following parameters:
1. First-Name: the first-name of the administrator
2. Last-Name: the last-name of the administrator
3. your-emial: the email-address of the administrator 
4. your-username: the username you want to give to your administrator

For the next step make sure your database user have the right to manage events as the SQL script will fail otherwise.

Run the following script on your database: *assets/LaetronazBlog.sql*

### Email Sender
Go in the project folder to *application/config/email.php* and add the email address and password of the email address you want to use to send emails.

__$sender_mail = '';//TODO: enter your email here__
__$sender_password = '';//TODO: enter your password here__

Depending on your mail service provider you may want to change those followings settings:
__'protocol' => 'smtp',__
__'smtp_host' => 'ssl://smtp.googlemail.com',__
__'smtp_port' => 465,__

### Base URL
Go in the project folder in *application/config/config.php* and change the following line to the url you want to use, to access your website.
__$config['base_url'] = 'http://localhost/Laetronaz/LaetronazBlog';__

### Finishing Touchs
You may want to go in the project folder in *application/views/template/header* and *application/views/template/footer* and modify it as you wish, be warned that if you change the titles of the side menu, the menu won't open at your current location without editing *assets/javascript/footer.js* 

## Github
Github of the project: https://github.com/Laetronaz/LaetronazBlog

## Project Status
As of 2019-01-01, this project is still on-going but at a much slower pace than before. You can still follow my progress and what's comming next on my Trello https://trello.com/b/E7Hu1XBw/laetronazblog .As of first of january 2019 the project is passing in a transition phase, as I will release version 1.0.0 in the coming weeks, I'll be working thoward version 2.0 which will drasticly change the layout of the application and remove bootstrap, the plan for this version is to integrate React and MaterialUI to the project but also 2 new features, creating a release calendar for the posts and creating photos albums.

## Credits
I started this project find Brad Traversy youtube channel "Traversy Media" https://www.youtube.com/channel/UC29ju8bIPH5as8OGnQzwJyA and followed his Code Igniter Blog App Tutorial, https://www.youtube.com/playlist?list=PLillGF-RfqbaP_71rOyChhjeK1swokUIS ,in which he maded the firsts versions of the application. I afterward built over it a lot. Thus, I now have a complete application which awnser to my personal needs. e  

## Ressources Used
Vaynes Debug Helper: https://github.com/yahyaerturan/codeigniter-developers-debug-helper
Image Upload Format: https://stackoverflow.com/questions/17865860/should-uploaded-files-be-renamed
Bootstrap Tag input: https://www.jqueryscript.net/form/Bootstrap-4-Tag-Input-Plugin-jQuery.html
Login Form: https://bootsnipp.com/snippets/featured/login-in-a-panel 
CK Editor: https://ckeditor.com/ckeditor-4/
CodeIgniter RAT: https://github.com/avenirer/CodeIgniter-Rat

## Licence 
This is a personal project I made to myself you are however free to do what you want to do with it as it's licenced with a MIT licence. Once you have a copy of this project, you may do what you want with it. Please take note however, that whatever modification you do to it may conflict with future version and I won't maintain non-official versions of this application.