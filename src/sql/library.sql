-- Database: library

-- Adds in users table
CREATE TABLE `library`.`users` ( 
`id` INT NOT NULL AUTO_INCREMENT, 
`username` VARCHAR(50) NOT NULL, 
`password` TEXT NOT NULL, 
`created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP, 
PRIMARY KEY (`id`)
) ENGINE = InnoDB;

CREATE TABLE `library`.`librarians` ( 
`id` INT NOT NULL AUTO_INCREMENT , 
`username` VARCHAR(30) NOT NULL , 
`password` VARCHAR(30) NOT NULL , 
PRIMARY KEY (`id`)
) ENGINE = InnoDB;

-- Adds in books table
CREATE TABLE `library`.`books` (
`book_id` int(11) PRIMARY KEY AUTO_INCREMENT,
`book_name` varchar(50),
`release_year` smallint(4),
`book_genre` varchar(50),
`age_group` varchar(50),
`author_id` int(11)
) ENGINE = InnoDB;

-- Adds in authors table
CREATE TABLE `library`.`authors` (
`author_name` varchar(50),
`author_age` varchar(10),
`author_genre` varchar(50),
`author_id` int(11) PRIMARY KEY AUTO_INCREMENT
) ENGINE = InnoDB;

-- Links books and authors tables via foreign key
ALTER TABLE `books` ADD FOREIGN KEY (`author_id`) REFERENCES `authors`(`author_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- Adds record into librarians table
INSERT INTO `librarians` (`id`, `username`, `password`) VALUES (NULL, 'librarian', 'librarian123');

-- Adds records into authors table
INSERT INTO `authors` (`author_name`, `author_age`, `author_genre`, `author_id`) VALUES ('Vikram Seth', '68', 'Poet', NULL), ('Abul-Fazl ibn Mubarak', 'deceased', 'Biographer', NULL), ('Phillip Zimbardo', '87', 'Psychologist', NULL), ('Jane Austin', 'deceased', 'Novelist', NULL), ('J.M Coetzee', '81', 'Novelist', NULL);

-- Adds records into books table
INSERT INTO `books` (`book_id`, `book_name`, `release_year`, `book_genre`, `age_group`, `author_id`) VALUES 
(NULL, 'The Tale Of Melon City', '1981', 'Poetry', '16', '1'), 
(NULL, 'The Humble Administrators Garden', '1985', 'Poetry', '18', '1'),
(NULL, 'All You Who sleep Tonight', '1990', 'Poetry', '18', '1'),
(NULL, 'Akbarnama', '2011', 'Biography', '18', '2'),
(NULL, 'The Cognitive Control of Motivation', '1969', 'Psychology', '18', '3'),
(NULL, 'Stanford prison experiment', '1972', 'Psychology', '18', '3'),
(NULL, 'Influencing Attitudes and Changing Behaviour', '1969', 'Psychology', '18', '3'),
(NULL, 'Sence and Sensibility', '1811', 'Novel', '12', '4'),
(NULL, 'Pride and Prejudice', '1813', 'Novel', '14', '4'),
(NULL, 'Mansfield Park', '1814', 'Novel', '20-99', '4'),
(NULL, 'Emma', '1815', 'Novel', '2-10', '4'),
(NULL, 'Nothanger Abbey', '1818', 'Novel', '11-19', '4'),
(NULL, 'Persuasion', '1818', 'Novel', '20-99', '4'),
(NULL, 'Lady Susan', '1871', 'Novel', '20-99', '4'),
(NULL, 'The Childhood of Jesus', '2013', 'Novel', '12-15', '5'),
(NULL, 'The Schooldays of Jesus', '2016', 'Novel', '8-10', '5'),
(NULL, 'The Death of Jesus', '2019', 'Novel', '12-17', '5');