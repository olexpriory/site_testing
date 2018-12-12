-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 12 2018 г., 09:37
-- Версия сервера: 10.1.37-MariaDB
-- Версия PHP: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testrow`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tests`
--

CREATE TABLE `tests` (
  `id_tets` int(11) NOT NULL,
  `testname` varchar(60) NOT NULL,
  `testputh` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tests`
--

INSERT INTO `tests` (`id_tets`, `testname`, `testputh`, `active`) VALUES
(5, 'mytest1', 'tests/mytest1.php', 1),
(6, 'mytest2', 'tests/mytest2.php', 1),
(7, 'mytest3', 'tests/mytest3.php', 1),
(8, 'mytest4', 'tests/mytest4.php', 1),
(9, 'вкн', 'tests/вкн.php', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `usersurname` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `userlastname` varchar(60) DEFAULT NULL,
  `userrung_id` int(11) DEFAULT NULL,
  `usergroup_id` int(11) DEFAULT NULL,
  `userege` date DEFAULT NULL,
  `userdatereg` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `usersurname`, `username`, `userlastname`, `userrung_id`, `usergroup_id`, `userege`, `userdatereg`) VALUES
(1, 'Троян', 'Ростислав', 'Сергійович', 1, 1, NULL, '2018-12-10 08:36:16'),
(2, 'Троян', 'Макс', 'Сергійович', 1, 1, NULL, '2018-12-10 09:49:00'),
(3, 'Троян', 'Макс', 'Сергійович', 1, 1, NULL, '2018-12-10 15:19:17');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id_tets`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tests`
--
ALTER TABLE `tests`
  MODIFY `id_tets` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
