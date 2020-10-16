-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 16 2020 г., 21:37
-- Версия сервера: 5.7.29
-- Версия PHP: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ziyaldinov`
--

-- --------------------------------------------------------

--
-- Структура таблицы `project`
--

CREATE TABLE `project` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Author` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `project`
--

INSERT INTO `project` (`ID`, `Name`, `Author`) VALUES
(5, 'Авто', 1),
(10, 'Авто', 2),
(1, 'Входящие', 1),
(6, 'Входящие', 2),
(4, 'Домашние дела', 1),
(9, 'Домашние дела', 2),
(3, 'Работа', 1),
(8, 'Работа', 2),
(2, 'Учеба', 1),
(7, 'Учеба', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
  `ID` int(10) UNSIGNED NOT NULL,
  `DateOfCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Completed` tinyint(1) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `File` varchar(255) DEFAULT NULL,
  `DateOfCompletion` date DEFAULT NULL,
  `Author` int(10) UNSIGNED NOT NULL,
  `Project` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`ID`, `DateOfCreation`, `Completed`, `Name`, `File`, `DateOfCompletion`, `Author`, `Project`) VALUES
(1, '1982-12-03 00:00:00', 0, 'Собеседование в IT компании', NULL, '2020-06-04', 1, 3),
(2, '1982-12-03 00:00:00', 0, 'Выполнить тестовое задание', NULL, '2019-12-25', 1, 3),
(3, '1982-12-03 00:00:00', 1, 'Сделать задание первого раздела', NULL, '2019-12-21', 1, 2),
(4, '1982-12-03 00:00:00', 0, 'Встреча с другом', NULL, '2019-12-22', 1, 1),
(5, '1982-12-03 00:00:00', 0, 'Купить корм для кота', NULL, NULL, 1, 4),
(6, '1982-12-03 00:00:00', 0, 'h1 здесь для проверки инъекции <h1>Заказать пиццу</h1>', NULL, NULL, 1, 4),
(7, '1982-12-03 00:00:00', 0, 'Собеседование в IT компании', NULL, '2020-06-04', 2, 8),
(8, '1982-12-03 00:00:00', 0, 'Выполнить тестовое задание', NULL, '2019-12-25', 2, 8),
(9, '1982-12-03 00:00:00', 1, 'Сделать задание первого раздела', NULL, '2019-12-21', 2, 7),
(10, '1982-12-03 00:00:00', 0, 'Встреча с другом', NULL, '2019-12-22', 2, 6),
(11, '1982-12-03 00:00:00', 0, 'Купить корм для кота', NULL, NULL, 2, 9),
(12, '1982-12-03 00:00:00', 1, 'Заказать суши', NULL, NULL, 2, 9),
(106, '2020-10-16 19:41:33', 0, 'Сделать WEB', NULL, '2020-10-18', 2, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `RegistrationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`ID`, `Email`, `Name`, `RegistrationDate`, `Password`) VALUES
(1, 'ladybag2000@gmail.com', 'Константин ', '2007-09-16 00:00:00', '$2y$10$mMHOocfDMF2nJFTVLh9see79d/.HOlv0zNiy0g0YvAirQ1k2QAveO'),
(2, 'Macs1996@gmail.com', 'Максим', '2007-09-16 00:00:00', '$2y$10$WDq3/DAvFOTsHqx33ym.s.QYbsgdLpHh3pfKkTnSGwDKdNmff0N5y');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Уникальное название и автор` (`Name`,`Author`) USING BTREE,
  ADD KEY `проект_ibfk_1` (`Author`);

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Author` (`Author`),
  ADD KEY `project` (`Project`);
ALTER TABLE `task` ADD FULLTEXT KEY `task_ft_search` (`Name`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `project`
--
ALTER TABLE `project`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `task`
--
ALTER TABLE `task`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`Author`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`Author`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`Project`) REFERENCES `project` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
