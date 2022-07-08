CREATE TABLE `books` (
  `book_id` int(11) PRIMARY KEY AUTO_INCREMENT,
  `book_name` varchar(50),
  `release_year` smallint(4),
  `book_genre` varchar(50),
  `age_group` varchar(50),
  `author_id` int(11)
);

CREATE TABLE `authors` (
  `author_name` varchar(50),
  `author_age` varchar(10),
  `author_genre` varchar(50),
  `author_id` int(11) PRIMARY KEY AUTO_INCREMENT
);

ALTER TABLE `books` ADD FOREIGN KEY (`author_id`) REFERENCES `authors`(`author_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

INSERT INTO `authors` (`author_name`, `author_age`, `author_genre`, `author_id`) VALUES 
(`Vikram Seth`, `68`, `Poet`, NULL),
(`Abu'l-Fazl ibn Mubarak`, `deceased`, 'Biography', NULL),
(`Phillip Zimbardo`, `87`, `Psychologist`, NULL),
(`Jane Austin`, `deceased`, `Poet`, NULL),
(`J.M Coetzee`, `81`, `Novelist`, NULL);