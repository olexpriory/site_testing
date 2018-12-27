-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Дек 23 2018 г., 18:44
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
-- Структура таблицы `company`
--

CREATE TABLE `company` (
  `id_company` int(11) NOT NULL,
  `companynumber` int(10) NOT NULL,
  `companyname` varchar(60) DEFAULT NULL,
  `companynote` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `company`
--

INSERT INTO `company` (`id_company`, `companynumber`, `companyname`, `companynote`) VALUES
(1, 1, '', ''),
(2, 2, '', ''),
(3, 3, '', ''),
(4, 4, '', ''),
(5, 5, '', ''),
(6, 6, '', ''),
(7, 7, '', ''),
(8, 8, '', ''),
(9, 9, '', ''),
(10, 10, '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `platoon`
--

CREATE TABLE `platoon` (
  `id_platoon` int(5) NOT NULL,
  `platoonnumber` int(11) NOT NULL,
  `platoonname` varchar(60) DEFAULT NULL,
  `platoonnote` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `platoon`
--

INSERT INTO `platoon` (`id_platoon`, `platoonnumber`, `platoonname`, `platoonnote`) VALUES
(1, 1, '', ''),
(2, 2, '', ''),
(3, 3, '', ''),
(4, 4, '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id_question` int(11) NOT NULL,
  `questiontype` varchar(60) NOT NULL,
  `questiontext` text NOT NULL,
  `question_answ_count` tinyint(4) DEFAULT NULL,
  `questionanswer` text NOT NULL,
  `questionball` double NOT NULL,
  `questionimg` varchar(60) DEFAULT NULL,
  `question_impot` tinyint(4) DEFAULT NULL,
  `test_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id_question`, `questiontype`, `questiontext`, `question_answ_count`, `questionanswer`, `questionball`, `questionimg`, `question_impot`, `test_id`) VALUES
(4, 'only', '1', 2, '1\n2\n\n#\n1\n#\n', 1, NULL, 0, 21),
(5, 'some', '2', 4, '1\n2\n3\n4\n\n#\n1\n3\n#\n', 0.5, NULL, 0, 21),
(6, 'text', '3', 0, '\n#\n1\n#\n', 1, NULL, 0, 21);

-- --------------------------------------------------------

--
-- Структура таблицы `result_user_questions`
--

CREATE TABLE `result_user_questions` (
  `id_us_quest` int(11) NOT NULL,
  `result_id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `type_quest` varchar(60) NOT NULL,
  `answer` text NOT NULL,
  `answer_correct` text NOT NULL,
  `ball` double NOT NULL,
  `ball_your` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `result_user_questions`
--

INSERT INTO `result_user_questions` (`id_us_quest`, `result_id`, `question_id`, `type_quest`, `answer`, `answer_correct`, `ball`, `ball_your`) VALUES
(48, 12, 4, 'only', '1', '1', 1, 1),
(49, 12, 5, 'some', '1\n3\n', '1\n3', 0.5, 1),
(50, 12, 6, 'text', '1', '1', 1, 1),
(51, 13, 4, 'only', '1', '1', 1, 1),
(52, 13, 5, 'some', '1\n3\n', '1\n3', 0.5, 1),
(53, 13, 6, 'text', '1', '1', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `result_user_test`
--

CREATE TABLE `result_user_test` (
  `id_result` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `test_id` int(11) DEFAULT NULL,
  `balls_all` int(11) DEFAULT NULL,
  `balls` int(11) DEFAULT NULL,
  `procents` int(11) DEFAULT NULL,
  `mark` int(11) DEFAULT NULL,
  `dateteusing` date NOT NULL,
  `timeusing` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `result_user_test`
--

INSERT INTO `result_user_test` (`id_result`, `user_id`, `test_id`, `balls_all`, `balls`, `procents`, `mark`, `dateteusing`, `timeusing`) VALUES
(12, 16, 21, 3, 3, 100, 5, '2018-12-23', '19:32:21'),
(13, 16, 21, 3, 3, 100, 5, '2018-12-23', '19:34:47');

-- --------------------------------------------------------

--
-- Структура таблицы `specialty`
--

CREATE TABLE `specialty` (
  `id_specialty` int(11) NOT NULL,
  `specialtyname` varchar(60) NOT NULL,
  `specialtycode` varchar(60) DEFAULT NULL,
  `specialtynote` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `specialty`
--

INSERT INTO `specialty` (`id_specialty`, `specialtyname`, `specialtycode`, `specialtynote`) VALUES
(1, 'Радіо', NULL, NULL),
(2, 'ТС', NULL, NULL),
(3, 'ПОІ', NULL, NULL),
(4, 'ЗІКБ', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tests`
--

CREATE TABLE `tests` (
  `id_test` int(11) NOT NULL,
  `testname` varchar(60) NOT NULL,
  `testputh` varchar(100) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `count_quest` int(11) DEFAULT NULL,
  `sum_ball` int(11) DEFAULT NULL,
  `include_impot` int(11) DEFAULT NULL,
  `random` int(11) DEFAULT NULL,
  `show_result` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tests`
--

INSERT INTO `tests` (`id_test`, `testname`, `testputh`, `active`, `count_quest`, `sum_ball`, `include_impot`, `random`, `show_result`) VALUES
(21, 'Демонструючий', NULL, 1, 3, NULL, 0, 0, 1);

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
  `company_id` int(11) DEFAULT NULL,
  `platoon_id` int(11) DEFAULT NULL,
  `specialty_id` int(11) DEFAULT NULL,
  `userege` date DEFAULT NULL,
  `userdatereg` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `usersurname`, `username`, `userlastname`, `userrung_id`, `company_id`, `platoon_id`, `specialty_id`, `userege`, `userdatereg`) VALUES
(16, 'Иванов', 'Иван', 'Иванович', 1, 1, 1, 1, NULL, '2018-12-23 19:27:25');

-- --------------------------------------------------------

--
-- Структура таблицы `user_rung`
--

CREATE TABLE `user_rung` (
  `id_rung` int(11) NOT NULL,
  `rungname` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_rung`
--

INSERT INTO `user_rung` (`id_rung`, `rungname`) VALUES
(1, 'Солдат'),
(2, 'Старший солдат'),
(5, 'Молодший сержант'),
(6, 'Сержант'),
(7, 'Старший сержант');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id_company`);

--
-- Индексы таблицы `platoon`
--
ALTER TABLE `platoon`
  ADD PRIMARY KEY (`id_platoon`);

--
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id_question`),
  ADD KEY `questions_ibfk_1` (`test_id`);

--
-- Индексы таблицы `result_user_questions`
--
ALTER TABLE `result_user_questions`
  ADD PRIMARY KEY (`id_us_quest`),
  ADD KEY `result_id` (`result_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Индексы таблицы `result_user_test`
--
ALTER TABLE `result_user_test`
  ADD PRIMARY KEY (`id_result`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Индексы таблицы `specialty`
--
ALTER TABLE `specialty`
  ADD PRIMARY KEY (`id_specialty`);

--
-- Индексы таблицы `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id_test`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `userrung_id` (`userrung_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `platoon_id` (`platoon_id`),
  ADD KEY `specialty_id` (`specialty_id`);

--
-- Индексы таблицы `user_rung`
--
ALTER TABLE `user_rung`
  ADD PRIMARY KEY (`id_rung`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `company`
--
ALTER TABLE `company`
  MODIFY `id_company` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `platoon`
--
ALTER TABLE `platoon`
  MODIFY `id_platoon` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id_question` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `result_user_questions`
--
ALTER TABLE `result_user_questions`
  MODIFY `id_us_quest` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT для таблицы `result_user_test`
--
ALTER TABLE `result_user_test`
  MODIFY `id_result` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `specialty`
--
ALTER TABLE `specialty`
  MODIFY `id_specialty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `tests`
--
ALTER TABLE `tests`
  MODIFY `id_test` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `user_rung`
--
ALTER TABLE `user_rung`
  MODIFY `id_rung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id_test`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `result_user_questions`
--
ALTER TABLE `result_user_questions`
  ADD CONSTRAINT `result_user_questions_ibfk_1` FOREIGN KEY (`result_id`) REFERENCES `result_user_test` (`id_result`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `result_user_questions_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id_question`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `result_user_test`
--
ALTER TABLE `result_user_test`
  ADD CONSTRAINT `result_user_test_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `tests` (`id_test`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `result_user_test_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`userrung_id`) REFERENCES `user_rung` (`id_rung`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`id_company`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`platoon_id`) REFERENCES `platoon` (`id_platoon`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `users_ibfk_4` FOREIGN KEY (`specialty_id`) REFERENCES `specialty` (`id_specialty`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
