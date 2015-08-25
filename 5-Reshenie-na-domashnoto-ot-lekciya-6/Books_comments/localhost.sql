-- phpMyAdmin SQL Dump
-- version 3.3.9.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Време на генериране: 
-- Версия на сървъра: 5.5.9
-- Версия на PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- БД: `books_comments`
--
CREATE DATABASE `books_comments` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `books_comments`;

-- --------------------------------------------------------

--
-- Структура на таблица `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(250) NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Дъмп (схема) на данните в таблицата `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`) VALUES
(18, 'avtor3'),
(17, 'avtor2'),
(16, 'avtor1');

-- --------------------------------------------------------

--
-- Структура на таблица `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_title` varchar(250) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Дъмп (схема) на данните в таблицата `books`
--

INSERT INTO `books` (`book_id`, `book_title`) VALUES
(42, 'kniga3'),
(41, 'kniga2'),
(40, 'kniga1');

-- --------------------------------------------------------

--
-- Структура на таблица `books_authors`
--

CREATE TABLE IF NOT EXISTS `books_authors` (
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  KEY `book_id` (`book_id`),
  KEY `author_id` (`author_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дъмп (схема) на данните в таблицата `books_authors`
--

INSERT INTO `books_authors` (`book_id`, `author_id`) VALUES
(42, 16),
(42, 17),
(41, 16),
(40, 16),
(40, 17),
(40, 18);

-- --------------------------------------------------------

--
-- Структура на таблица `books_comments`
--

CREATE TABLE IF NOT EXISTS `books_comments` (
  `book_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дъмп (схема) на данните в таблицата `books_comments`
--

INSERT INTO `books_comments` (`book_id`, `comment_id`) VALUES
(42, 44),
(40, 43),
(41, 42),
(40, 41),
(40, 40);

-- --------------------------------------------------------

--
-- Структура на таблица `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_date` datetime NOT NULL,
  `comment_txt` varchar(250) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Дъмп (схема) на данните в таблицата `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_date`, `comment_txt`) VALUES
(44, '2013-10-24 23:18:14', 'super'),
(43, '2013-10-24 23:18:06', 'iha'),
(42, '2013-10-24 23:18:00', 'qkoo'),
(41, '2013-10-24 23:16:59', 'super'),
(40, '2013-10-24 23:16:54', 'komentar4e');

-- --------------------------------------------------------

--
-- Структура на таблица `comments_users`
--

CREATE TABLE IF NOT EXISTS `comments_users` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дъмп (схема) на данните в таблицата `comments_users`
--

INSERT INTO `comments_users` (`comment_id`, `user_id`) VALUES
(44, 14),
(43, 14),
(42, 14),
(41, 13),
(40, 13);

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `user_pass` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дъмп (схема) на данните в таблицата `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`) VALUES
(14, 'user', 'user'),
(13, 'proba', 'proba');
