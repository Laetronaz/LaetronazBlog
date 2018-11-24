SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Table structure for table `user_type`
--

CREATE TABLE users_type (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `users`
--

CREATE TABLE users (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_type` int(11) NOT NULL,
  `active` boolean NOT NULL DEFAULT TRUE,
  PRIMARY KEY (`id`),
  CONSTRAINT FK_UserType FOREIGN KEY (user_type)
  REFERENCES users_type(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `users`
--
CREATE TABLE email_verification ( 
  `token` VARCHAR(255) NOT NULL , 
  `creation_time` TIMESTAMP NOT NULL , 
  `expiration_time` TIMESTAMP NOT NULL , 
  `user_id` INT NOT NULL,
  PRIMARY KEY(`token`), 
  CONSTRAINT FK_UserVerify FOREIGN KEY (user_id)
  REFERENCES users(`id`)
) ENGINE = InnoDB;

--
-- Table structure for table `users`
--
CREATE TABLE password_reset ( 
  `token` VARCHAR(255) NOT NULL , 
  `creation_time` TIMESTAMP NOT NULL , 
  `expiration_time` TIMESTAMP NOT NULL , 
  `user_id` INT NOT NULL,
  PRIMARY KEY(`token`), 
  CONSTRAINT FK_UserPassReset FOREIGN KEY (user_id)
  REFERENCES users(`id`)
) ENGINE = InnoDB;


--
-- Table structure for table `categories`
--

CREATE TABLE categories (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_icon` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` boolean NOT NULL DEFAULT TRUE,
  PRIMARY KEY (`id`),
  CONSTRAINT FK_CategoryUser FOREIGN KEY (user_id)
  REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `posts`
--

CREATE TABLE posts (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` boolean NOT NULL DEFAULT TRUE,
  PRIMARY KEY (`id`),
  CONSTRAINT FK_PostCategory FOREIGN KEY (category_id)
  REFERENCES categories(id),
  CONSTRAINT FK_PostUser FOREIGN KEY (user_id)
  REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `tags`
--
CREATE TABLE `tags` ( 
  `id` INT(11) NOT NULL AUTO_INCREMENT , 
  `title` VARCHAR(255) NOT NULL UNIQUE, PRIMARY KEY (`id`),
  CONSTRAINT UC_Title UNIQUE(`title`)
) ENGINE = InnoDB;

--
-- Table structure for table `tagpost`
--
CREATE TABLE `tagpost` ( 
  `post_id` INT(11) NOT NULL , 
  `tag_id` INT(11) NOT NULL,
  PRIMARY KEY(post_id, tag_id),
  CONSTRAINT FK_PostIDTag FOREIGN KEY(post_id)
  REFERENCES posts(id),
  CONSTRAINT FKTagsIDTag FOREIGN KEY (tag_id)
  REFERENCES tags(id) 
) ENGINE = InnoDB;

--
-- Table structure for table `messages`
--

CREATE TABLE messages (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO users_type ( `id`, `name`) VALUES
(1, 'Admin'),
(2, 'Moderator'),
(3, 'Writer');
COMMIT;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `zipcode`, `email`, `username`, `password`, `register_date`, `user_type`) VALUES
(1, 'Michel Pelland', 'H4E 2Y3', 'michel.pelland12@gmail.com', 'Laetronaz', '$2y$10$zeJUWUzGm2Px2hIFJd880ebfiXjXFc9Gyy2ElRRTu.FA/k5Qpxr3O', '2018-08-09 20:09:41', 1);
COMMIT;

--
-- Dumping data for table `messages`
--
INSERT INTO `messages` (`name`, `type`, `value`) VALUES
('category_updated', 'alert-success', 'Your category has been updated.'),
('category_disabled', 'alert-success', 'Your category has been disabled'),
('category_enabled', 'alert-success', 'Your category has been enabled.'),
('category_created', 'alert-success', 'Your category has been created.'),
('post_created', 'alert-success', 'Your post has been created.'),
('post_disabled', 'alert-success', 'Your post has been disabled.'),
('post_enabled', 'alert-success', 'Your post has been enabled.'),
('post_updated', 'alert-success', 'Your post has been updated.'),
('user_registered', 'alert-success', 'You are now registered and can log in.'),
('user_loggedin', 'alert-success', 'You are now logged in.'),
('user_loggedout', 'alert-success', 'You are now logged out'),
('user_enabled', 'alert-success', 'The user have been enabled'),
('user_disabled', 'alert-success', 'The user have been disabled'),
('user_updated', 'alert-success', 'The user profile have been updated'),
('password_reset', 'alert-success', "Your password reset request has been received. You'll receive a email shortly."),
('password_changed_success', 'alert-success', 'The password has been changed successfuly'),
('unautorized_access', 'alert-danger', 'Only admininstrators have access to this page'),
('login_failed', 'alert-danger', 'You have entered an invalid username or password'),
('password_change_failed', 'alert-danger', 'The current password is invalid.'),
('password_same', 'alert-danger', 'The password could not be changed, please use a new password.'),
('inexisting_user', 'alert-danger', 'No account was found for the email you entered.');
COMMIT;