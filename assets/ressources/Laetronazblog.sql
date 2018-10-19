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
  PRIMARY KEY (`id`),
  CONSTRAINT FK_UserType FOREIGN KEY (user_type)
  REFERENCES users_type(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `categories`
--

CREATE TABLE categories (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_icon` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` boolean NOT NULL DEFAULT 'TRUE',
  PRIMARY KEY (`id`),
  CONSTRAINT FK_SubCategoryUser FOREIGN KEY (user_id)
  REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `Subcategories`
--

CREATE TABLE subcategories (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subcategory_icon` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` boolean NOT NULL DEFAULT 'TRUE',
  PRIMARY KEY (`id`),
  CONSTRAINT FK_CategoryUser FOREIGN KEY (user_id)
  REFERENCES users(id),
  CONSTRAINT FK_SubCategoryCategory FOREIGN KEY (category_id)
  REFERENCES categories(id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Table structure for table `posts`
--

CREATE TABLE posts (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11),
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` boolean NOT NULL DEFAULT 'TRUE',
  PRIMARY KEY (`id`),
  CONSTRAINT FK_PostCategory FOREIGN KEY (category_id)
  REFERENCES categories(id),
  CONSTRAINT FK_PostUser FOREIGN KEY (user_id)
  REFERENCES users(id)
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