-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Сен 10 2020 г., 18:27
-- Версия сервера: 5.6.37
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `api_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(55) NOT NULL,
  `source_id` int(1) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `phone`, `email`, `source_id`, `date`) VALUES
(1, 'Анна', '9865464565', 'test@mail.ru', 1, '2020-09-09'),
(2, 'Петр', '9832131265', 'petr@ya.ru', 2, '2020-09-09'),
(3, 'Влад', '9865212566', 'vlad@rambler.ru', 2, '2020-09-09'),
(6, 'Игорь', '9991264564', 'igor@yahoo.com', 2, '2020-09-08'),
(8, 'Миша', '9854645626', 'misha@yandex.ru', 1, '2020-09-08'),
(9, 'Иван', '9251234123', 'mail2@gmail.com', 1, '2020-09-09'),
(10, 'Анна', '9251234453', 'mail1@gmail.com', 1, '2020-09-09'),
(11, 'Соня', '9001232222', 'mail4@gmail.com', 2, '2020-09-09'),
(12, 'Даниил', '9001234443', 'mail5@gmail.com', 2, '2020-09-09');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
