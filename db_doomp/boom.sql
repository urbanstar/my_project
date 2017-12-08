-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Дек 08 2017 г., 21:38
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `boom`
--

-- --------------------------------------------------------

--
-- Структура таблицы `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_article` varchar(50) NOT NULL,
  `text_article` text NOT NULL,
  `date_create` date NOT NULL,
  `date_update` date NOT NULL,
  `id_author` int(11) NOT NULL,
  `id_photo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_author` (`id_author`,`id_photo`),
  KEY `id_photo` (`id_photo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `article`
--

INSERT INTO `article` (`id`, `name_article`, `text_article`, `date_create`, `date_update`, `id_author`, `id_photo`) VALUES
(1, 'Sonet_91', '         She walks in beauty, like the night\r\nOf cloudless climes and starry skies;\r\nAnd all that''s best of dark and bright\r\nMeet in her aspect and her eyes:\r\nThus mellow''d to that tender light\r\nWhich heaven to gaudy day denies.\r\nOne shade the more, one ray the less,\r\nHad half impair''d the nameless grace\r\nWhich waves in every raven tress,\r\nOr softly lightens o''er her face;\r\nWhere thoughts serenely sweet express\r\nHow pure, how dear their dwelling-place.\r\nAnd on that cheek, and o''er that brow,\r\nSo soft, so calm, yet eloquent,\r\nThe smiles that win. the tints that glow,\r\nBut tell of days in goodness spent,\r\nA mind at peace with all below,\r\nA heart whose love is innocent!', '0000-00-00', '2017-11-16', 4, 1),
(2, 'Sonnet_19', ' Shall I compare thee to a summer''s day?\r\nThou art more lovely and more temperate:\r\nRough winds do shake the darling buds of May,\r\nAnd summer''s lease hath all too short a date:\r\nSometime too hot the eye of heaven shines,\r\nAnd often is his gold complexion dimm''d,\r\nAnd every fair from fair sometime declines,\r\nBy chance or natures changing course untrimm''d:\r\nBut thy eternal summer shall not fade,\r\nNor lose possession of that fair thou owest,\r\nNor shall death brag thou wandrest in his shade,\r\nWhen in eternal lines to time thou growest,\r\nSo long as men can breathe or eyes can see\r\nSo long lives this, and this gives life to thee.', '0000-00-00', '2017-11-17', 1, 1),
(3, 'HAPPY!', 'I’m happy you’re my teacher.\r\nThanks for all you do.\r\nYou make learning easy.\r\nYour lessons are fun, too!', '2017-11-07', '2017-11-16', 1, 1),
(19, 'London', 'In every cry of every Man,\r\nIn every Infants cry of fear,\r\nIn every voice: in every ban,\r\nThe mind-forg''d manacles I hear.', '2017-11-17', '2017-11-17', 10, 1),
(20, 'The Tyger1', '    Tyger Tyger, burning bright,\r\nIn the forests of the night;\r\nWhat immortal hand or eye,\r\nCould frame thy fearful symmetry\r\nIn what distant deeps or skies.\r\nBurnt the fire of thine eyes!\r\nOn what wings dare he aspire?\r\nWhat the hand, dare sieze the fire!\r\nAnd what shoulder, & what art.\r\nCould twist the sinews of thy heart?\r\nAnd when thy heart began to beat,\r\nWhat dread hand! & what dread feet!', '2017-11-17', '2017-11-17', 11, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_autor` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `name_autor`) VALUES
(1, 'William_Shakespeare'),
(2, 'Петров'),
(3, 'Сидоров'),
(4, 'Lord_Byron'),
(5, 'Petrov'),
(6, 'Ivanov'),
(7, 'I'),
(8, 'Urban'),
(9, 'William Blake'),
(10, 'William_Blake'),
(11, 'William');

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `photos`
--

INSERT INTO `photos` (`id`, `path`) VALUES
(1, 'path'),
(2, '');

-- --------------------------------------------------------

--
-- Структура таблицы `privilege`
--

CREATE TABLE IF NOT EXISTS `privilege` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `privilege`
--

INSERT INTO `privilege` (`id`, `name`, `description`) VALUES
(1, 'all_write', 'write all'),
(2, 'all_read', 'read all'),
(3, 'only_read', 'read only');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'admin', 'administator saita'),
(2, 'user', 'nikto'),
(3, 'editor', 'editor article');

-- --------------------------------------------------------

--
-- Структура таблицы `roles2privilege`
--

CREATE TABLE IF NOT EXISTS `roles2privilege` (
  `roler_id` int(11) NOT NULL,
  `privilege_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `test`
--

INSERT INTO `test` (`id`, `text`) VALUES
(1, 2),
(2, 3),
(3, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_data_id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `roles_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `user_data_id`, `login`, `password`, `roles_id`) VALUES
(1, 1, 'ivanov', 'pass', 1),
(2, 2, 'petrov', 'pass', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `users_data`
--

CREATE TABLE IF NOT EXISTS `users_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `adres` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
