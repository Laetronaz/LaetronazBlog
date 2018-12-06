SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS users_type (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `user_state`
--

CREATE TABLE IF NOT EXISTS users_state (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;


--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS users (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_type` int(11) NOT NULL,
  `user_state` INT(11) NOT NULL DEFAULT 1,
  `connection_attempts` INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  CONSTRAINT FK_UserType FOREIGN KEY (user_type)
  REFERENCES users_type(`id`),
  CONSTRAINT FK_UserState FOREIGN KEY (user_state)
  REFERENCES users_state(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS users_lockout (
    `user_id` INT(11) NOT NULL, 
    `creation_time` TIMESTAMP NOT NULL,
    `expiration_time` TIMESTAMP NOT NULL ,
    PRIMARY KEY(user_id, creation_time),
    CONSTRAINT FK_UserLockedOut FOREIGN KEY(user_id)
    REFERENCES users(`id`)
) ENGINE = InnoDB;
--
-- Table structure for table `users`
--
CREATE TABLE IF NOT EXISTS email_verification ( 
  `token` VARCHAR(255) NOT NULL , 
  `creation_time` TIMESTAMP NOT NULL , 
  `expiration_time` TIMESTAMP NOT NULL , 
  `user_id` INT(11) NOT NULL,
  `used` BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY(`token`), 
  CONSTRAINT FK_UserVerify FOREIGN KEY (user_id)
  REFERENCES users(`id`)
) ENGINE = InnoDB;

--
-- Table structure for table `users`
--
CREATE TABLE IF NOT EXISTS password_reset ( 
  `token` VARCHAR(255) NOT NULL , 
  `creation_time` TIMESTAMP NOT NULL , 
  `expiration_time` TIMESTAMP NOT NULL , 
  `user_id` INT NOT NULL,
  `used` BOOLEAN NOT NULL DEFAULT FALSE,
  PRIMARY KEY(`token`), 
  CONSTRAINT FK_UserPassReset FOREIGN KEY (user_id)
  REFERENCES users(`id`)
) ENGINE = InnoDB;


--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS categories (
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

CREATE TABLE IF NOT EXISTS posts (
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
CREATE TABLE IF NOT EXISTS `tags` ( 
  `id` INT(11) NOT NULL AUTO_INCREMENT , 
  `title` VARCHAR(255) NOT NULL UNIQUE, PRIMARY KEY (`id`),
  CONSTRAINT UC_Title UNIQUE(`title`)
) ENGINE = InnoDB;

--
-- Table structure for table `tagpost`
--
CREATE TABLE IF NOT EXISTS `tagpost` ( 
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

CREATE TABLE IF NOT EXISTS messages (
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
-- Dumping data for table `user_state`
--
INSERT INTO users_state ( `id`, `name`) VALUES
(1, 'Waiting Authorization'),
(2, 'Locked out'),
(3, 'Active'),
(4, 'Inactive');
COMMIT;


--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `zipcode`, `email`, `username`, `password`, `register_date`, `user_type`, `user_state`) VALUES
(1, 'Michel Pelland', 'H4E 2Y3', 'michel.pelland12@gmail.com', 'Laetronaz', '$2y$10$zeJUWUzGm2Px2hIFJd880ebfiXjXFc9Gyy2ElRRTu.FA/k5Qpxr3O', '2018-08-09 20:09:41', 1, 3);
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
('user_registered', 'alert-success', 'You are now registered, please check your mails, to finish creating your account.'),
('user_loggedin', 'alert-success', 'You are now logged in.'),
('user_loggedout', 'alert-success', 'You are now logged out'),
('user_enabled', 'alert-success', 'The user have been enabled'),
('user_disabled', 'alert-success', 'The user have been disabled'),
('user_updated', 'alert-success', 'The user profile have been updated'),
('password_reset', 'alert-success', "Your password reset request has been received. You'll receive a email shortly."),
('password_changed_success', 'alert-success', 'The password has been changed successfuly'),
('password_reset_resent', 'alert-success', 'The reset password link was resent, check your emails.'),
('email_verified', 'alert-success', 'Your email have been successfully verified. You can now log in.'),
('password_expired', 'alert-info', 'The password reset link you used is expired, if you still want to reset your password, use the following link: '),
('invalid_password_token', 'alert-info', 'The password reset link you just used is invalid, if this link was sent to you by email, please contact an administrator by answering to the email.'),
('resend_password', 'alert-info', 'You already asked for a password reset please check your email.'),
('user_waiting', 'alert-info', 'You need to confirm your email to login. Click this link to resend the password'),
('confirmation_expired', 'alert-info', 'The confirmation link you just used is expired to have a new confirmation link, click the following link: '),
('invalid_verification_token', 'alert-info', 'The email verification link you just used is invalid, if this link was sent to you by email, please contact an administrator by answering to the email.'),
('user_inactive', 'alert-info', 'This account have been disabled by the administration, if you want to re-enable this account,if you are the legemit user of this account please contact the administration.'),
('unautorized_access', 'alert-danger', 'Only admininstrators have access to this page'),
('login_failed', 'alert-danger', 'You have entered an invalid username or password'),
('password_change_failed', 'alert-danger', 'The current password is invalid.'),
('password_same', 'alert-danger', 'The password could not be changed, please use a new password.'),
('inexisting_user', 'alert-danger', 'No account was found for the email you entered.'),
('user_lockedout', 'alert-danger', 'You have tried to access this account too many time in a short while, please wait 15 minutes and try again.'),
('image_update_failed', 'alert-danger', 'Failed to update the image, please make sure to fill the required field.');
COMMIT;


--
-- Setup timed event
--


SET GLOBAL event_scheduler = ON;

CREATE EVENT IF NOT EXISTS reset_lockout
ON SCHEDULE EVERY 5 MINUTE STARTS '2018-01-01 00:00:00' 
DO 
  UPDATE users
  SET user_state = 3, connection_attempts = 0
  WHERE user_state = 2 AND id IN(
    SELECT DISTINCT user_id
    FROM users_lockout
    WHERE CURRENT_TIMESTAMP() NOT BETWEEN creation_time AND expiration_time
  );