-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Фев 27 2024 г., 10:32
-- Версия сервера: 8.0.30
-- Версия PHP: 8.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `oferta`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `login`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `Events`
--

CREATE TABLE `Events` (
  `event_id` int NOT NULL,
  `event_title` varchar(255) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `event_description` text,
  `event_media_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Events`
--

INSERT INTO `Events` (`event_id`, `event_title`, `event_date`, `event_description`, `event_media_url`) VALUES
(2, 'Семинар по энергосбережению', '2024-02-10', 'Приглашаем всех желающих на семинар по энергосбережению, который состоится в нашем офисе.', 'img/events/event2.jpg'),
(3, 'День открытых дверей', '2024-02-20', 'Приходите на День открытых дверей и узнайте больше о наших услугах и предложениях.', ''),
(4, 'Вебинар по безопасности газа', '2024-01-15', 'Зарегистрируйтесь на наш вебинар и узнайте о важности соблюдения правил безопасности при использовании газа.', 'img/events/event3.jpg'),
(5, 'Конференция \"Газ и экология\"', '2024-02-15', 'Приглашаем вас принять участие в нашей конференции, посвященной вопросам взаимосвязи газа и экологии.', 'img/events/event4.jpg'),
(6, 'Выборы президента', '2024-03-15', 'Приглашаем всех на президентские выборы!', 'img/events/event.jpg'),
(13, 'НОВАЯ НОВОСТЬ', '2024-02-27', 'НОВАЯ НОВОСТЬ', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `Gas_Equipment`
--

CREATE TABLE `Gas_Equipment` (
  `equipment_id` int NOT NULL,
  `owner_id` int NOT NULL,
  `equipment_type` varchar(100) NOT NULL,
  `installation_date` date NOT NULL,
  `last_maintenance_date` date DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Gas_Equipment`
--

INSERT INTO `Gas_Equipment` (`equipment_id`, `owner_id`, `equipment_type`, `installation_date`, `last_maintenance_date`, `status`) VALUES
(21, 29, 'Газовыйстояк', '1971-01-01', '1980-01-01', 'ему плохо :(');

-- --------------------------------------------------------

--
-- Структура таблицы `Ownership_Documents`
--

CREATE TABLE `Ownership_Documents` (
  `ownership_doc_id` int NOT NULL,
  `owner_id` int NOT NULL,
  `document_type` varchar(100) NOT NULL,
  `document_number` varchar(50) NOT NULL,
  `date_of_issue` date NOT NULL,
  `issued_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Ownership_Documents`
--

INSERT INTO `Ownership_Documents` (`ownership_doc_id`, `owner_id`, `document_type`, `document_number`, `date_of_issue`, `issued_by`) VALUES
(21, 29, 'Завещание от бабки', '123456789', '2023-08-16', 'Районный прокурор');

-- --------------------------------------------------------

--
-- Структура таблицы `Passports`
--

CREATE TABLE `Passports` (
  `passport_id` int NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `passport_number` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `issuing_authority` varchar(255) NOT NULL,
  `date_of_issue` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `Passports`
--

INSERT INTO `Passports` (`passport_id`, `full_name`, `date_of_birth`, `passport_number`, `address`, `issuing_authority`, `date_of_issue`) VALUES
(29, 'Иванов Иван Иванович', '2001-01-01', '5678254659', 'ул. Пушкина, дом Колотушкина, город Москва', 'Районный прокурор', '2024-02-22');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Events`
--
ALTER TABLE `Events`
  ADD PRIMARY KEY (`event_id`);

--
-- Индексы таблицы `Gas_Equipment`
--
ALTER TABLE `Gas_Equipment`
  ADD PRIMARY KEY (`equipment_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Индексы таблицы `Ownership_Documents`
--
ALTER TABLE `Ownership_Documents`
  ADD PRIMARY KEY (`ownership_doc_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Индексы таблицы `Passports`
--
ALTER TABLE `Passports`
  ADD PRIMARY KEY (`passport_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `Events`
--
ALTER TABLE `Events`
  MODIFY `event_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `Gas_Equipment`
--
ALTER TABLE `Gas_Equipment`
  MODIFY `equipment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `Ownership_Documents`
--
ALTER TABLE `Ownership_Documents`
  MODIFY `ownership_doc_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `Passports`
--
ALTER TABLE `Passports`
  MODIFY `passport_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Gas_Equipment`
--
ALTER TABLE `Gas_Equipment`
  ADD CONSTRAINT `gas_equipment_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `Passports` (`passport_id`);

--
-- Ограничения внешнего ключа таблицы `Ownership_Documents`
--
ALTER TABLE `Ownership_Documents`
  ADD CONSTRAINT `ownership_documents_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `Passports` (`passport_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
