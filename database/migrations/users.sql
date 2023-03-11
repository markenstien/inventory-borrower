DROP TABLE IF EXISTS users;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` enum('MALE','FEMALE') NOT NULL,
  `user_type` enum('admin','supervisor','staff') DEFAULT 'staff',
  `address` text DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 1,
  `created_at` timestamp DEFAULT now()
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8


alter table users 
  add column created_at timestamp DEFAULT now();

alter table users add column profile text;


alter table users 
  add column user_identification varchar(50) unique;

alter table users 
  add column user_key_code text unique;



  alter table users 
    add column user_code varchar(100);