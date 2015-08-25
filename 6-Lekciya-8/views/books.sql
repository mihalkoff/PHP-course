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
-- БД: `books`
--
CREATE DATABASE `books` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `books`;

-- --------------------------------------------------------

--
-- Структура на таблица `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(250) NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Дъмп (схема) на данните в таблицата `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`) VALUES
(1, 'Автор1'),
(2, 'Автор2'),
(3, 'Автор3'),
(4, '$authorName'),
(5, '$authorName'),
(6, 'aaaaaaaaaaaaaaaaa'),
(7, 'qqqqqqqqqq'),
(8, 'wwwwwwwwww'),
(9, 'aaaaaaaaaaa'),
(10, 'zzzzzzzzzzzzzzzzz'),
(11, 'qqqqqqqq'),
(12, 'zzzzzzzzzzzzz'),
(13, 'rrrrrrrrrrrrrrrrrr'),
(14, 'rrrrr'),
(15, 'rrrrr'),
(16, 'proba1'),
(17, 'avtor100'),
(18, 'ssssssssssss'),
(19, '35364565'),
(20, 'sssssssssssssss'),
(21, 'www'),
(22, 'proba1'),
(23, '111'),
(24, '1111'),
(25, 'avtorproba');

-- --------------------------------------------------------

--
-- Структура на таблица `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_title` varchar(250) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Дъмп (схема) на данните в таблицата `books`
--

INSERT INTO `books` (`book_id`, `book_title`) VALUES
(1, 'Книга1'),
(2, 'Книга2'),
(3, 'Книга3'),
(4, 'book1'),
(5, 'book1'),
(6, 'book2'),
(7, 'book5'),
(8, 'blabla'),
(9, 'kkkkk'),
(10, 'bbbbbbbbbbb'),
(11, 'kniga1'),
(12, 'boook'),
(13, 'book1'),
(14, 'bobo'),
(15, 'fffff'),
(16, '11'),
(17, 'kniga1'),
(18, 'book1'),
(19, 'knigaproba');

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
(1, 1),
(1, 2),
(1, 3),
(6, 0),
(6, 0),
(7, 0),
(7, 0),
(7, 0),
(7, 0),
(8, 1),
(8, 2),
(8, 3),
(9, 12),
(10, 12),
(11, 16),
(12, 1),
(12, 2),
(12, 16),
(15, 16),
(15, 17),
(15, 18),
(16, 4),
(17, 1),
(17, 2),
(19, 1),
(19, 2),
(19, 3);
