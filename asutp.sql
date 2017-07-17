-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июл 17 2017 г., 15:07
-- Версия сервера: 5.7.18-log
-- Версия PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `asutp`
--

-- --------------------------------------------------------

--
-- Структура таблицы `locations`
--

CREATE TABLE `locations` (
  `id_loc` int(2) NOT NULL,
  `id_shop` int(2) NOT NULL,
  `location` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `locations`
--

INSERT INTO `locations` (`id_loc`, `id_shop`, `location`) VALUES
(1001, 10, 'Прочее'),
(1201, 12, '4 пролет'),
(1202, 12, '16 пролет'),
(1203, 12, '15 пролет'),
(1204, 12, '13 пролет'),
(1301, 13, 'Земледелка'),
(1302, 13, 'АФЛ'),
(1401, 14, 'Термопечи'),
(1402, 14, '5 пролет'),
(1403, 14, '6 пролет');

-- --------------------------------------------------------

--
-- Структура таблицы `records`
--

CREATE TABLE `records` (
  `id_rec` int(255) NOT NULL,
  `time` varchar(10) NOT NULL,
  `shift` int(2) NOT NULL,
  `id_loc` int(2) NOT NULL,
  `id_status` int(2) NOT NULL DEFAULT '1',
  `description` varchar(255) NOT NULL,
  `solution` varchar(255) NOT NULL,
  `notice` varchar(255) NOT NULL,
  `alert` int(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `records`
--

INSERT INTO `records` (`id_rec`, `time`, `shift`, `id_loc`, `id_status`, `description`, `solution`, `notice`, `alert`) VALUES
(1, '2017-01-02', 3, 1302, 3, 'Датчик позиции кантователя 1', 'Переделали крепление', '', 0),
(2, '2016-12-26', 3, 1301, 2, 'Замок охладителя', 'квитировали', '', 1),
(3, '2016-12-26', 3, 1302, 1, 'Упала паллета', 'посмотрели', '', 0),
(4, '2017-01-09', 4, 1401, 2, 'ololo', 'hmmm', 'okay', 1),
(13, '2017-01-13', 1, 1001, 1, 'оашеалгнмлим', 'рпалдпдлпдрплнгпд лпдгшпдгшп', '', 0),
(16, '2017-01-13', 1, 1001, 1, 'hhgckgjvhjv', 'jbljk', '', 0),
(19, '2017-01-13', 1, 1001, 1, '132', 'kbh', '', 0),
(37, '2017-01-13', 1, 1001, 1, '516', 'kbkjcjfhm', '', 0),
(40, '2017-01-13', 1, 1001, 1, '1', '1', '', 0),
(41, '2017-01-13', 1, 1001, 1, '2', '2', '', 0),
(42, '2017-02-06', 2, 1301, 2, 'sdfuhsdfuphsa', 'fwfef', '', 0),
(43, '2017-02-08', 1, 1302, 3, 'цуафывав', 'уа', '', 1),
(44, '2017-02-08', 1, 1001, 1, '12', 'фыафыа', '', 0),
(45, '2017-02-08', 1, 1204, 1, 'dwsfasd', 'evqwreve', '', 0),
(46, '2017-02-08', 1, 1001, 1, 'asd', 'asd', '', 0),
(47, '2017-02-10', 1, 1401, 2, 'цавымфыва', '23куцайцвыафуц', '', 0),
(48, '2017-02-10', 1, 1204, 1, 'фsd', 'rwbebwrtgwegergcwege', '', 0),
(49, '2017-02-26', 4, 1402, 2, 'Это поисание', 'Это решение', 'Это замечания', 1),
(83, '2017-02-28', 3, 1201, 1, 'sf', 'sdfweg3', '', 0),
(85, '2017-02-27', 2, 1401, 2, 'описание', 'решенька', 'замечаний нет. или есть?', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `shops`
--

CREATE TABLE `shops` (
  `id_shop` int(2) NOT NULL,
  `shop` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shops`
--

INSERT INTO `shops` (`id_shop`, `shop`) VALUES
(10, 'Прочее'),
(11, 'ЛЦ-1'),
(12, 'ЛЦ-2'),
(13, 'ЛЦ-3'),
(14, 'ТОЦ'),
(15, 'АТЦ'),
(16, 'ИМЦ'),
(17, 'Копровой цех'),
(18, 'РЦ'),
(19, 'Мартен');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id_status` int(2) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id_status`, `status`) VALUES
(1, 'заявка открыта'),
(2, 'заявка закрыта'),
(3, 'без заявки');

-- --------------------------------------------------------

--
-- Структура таблицы `test`
--

CREATE TABLE `test` (
  `first` varchar(20) NOT NULL,
  `second` varchar(20) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id_loc`),
  ADD KEY `FK_locations_id_shop` (`id_shop`);

--
-- Индексы таблицы `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id_rec`),
  ADD KEY `FK_records_id_status` (`id_status`),
  ADD KEY `FK_records_id_loc` (`id_loc`);

--
-- Индексы таблицы `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id_shop`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- Индексы таблицы `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `records`
--
ALTER TABLE `records`
  MODIFY `id_rec` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT для таблицы `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `FK_locations_id_shop` FOREIGN KEY (`id_shop`) REFERENCES `shops` (`id_shop`);

--
-- Ограничения внешнего ключа таблицы `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `FK_records_id_loc` FOREIGN KEY (`id_loc`) REFERENCES `locations` (`id_loc`),
  ADD CONSTRAINT `FK_records_id_status` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
