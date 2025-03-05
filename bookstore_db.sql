-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 05 2025 г., 08:20
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bookstore_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `book_id` int(100) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `book_category` varchar(100) DEFAULT NULL,
  `book_author` varchar(100) DEFAULT NULL,
  `book_price` int(100) NOT NULL,
  `book_image` varchar(100) NOT NULL,
  `book_info` varchar(10000) NOT NULL,
  `discount` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `book_category`, `book_author`, `book_price`, `book_image`, `book_info`, `discount`) VALUES
(10, 'Гамлет', 'Роман', 'Уильям Шекспир', 100, 'hamlet.jpg', 'Действие пьесы происходит в Дании, и она рассказывает о принце Гамлете, который стремится отомстить своему дяде Клавдию.', 0),
(11, 'Ричард III', 'Исторический', 'Уильям Шекспир', 300, 'Richard.jpg', 'Ричард III (2 октября 1452 – 22 августа 1485) был королем Англии с 26 июня 1483 года до своей смерти в 1485 году. Он был последним королем династии Плантагенетов и ее младшей ветви — дома Йорков. Его поражение и смерть в битве при Босворте ознаменовали конец Средневековья в Англии.', 0),
(14, 'Шекспир', 'Биография', '', 700, 'shakebio.jpg', 'Уильям Шекспир (23 апреля 1564 – 23 апреля 1616) был английским драматургом, поэтом и актером. Он широко считается величайшим писателем на английском языке.', 0),
(15, 'Сияние', 'Роман', 'Стивен Кинг', 300, 'The_Shining.jpg', 'Действие романа \"Сияние\" происходит в Колорадо в 1970-х годах. Он рассказывает о семье Торрансов: муже Джеке, жене Венди и их пятилетнем сыне Дэнни.', 0),
(16, 'Мэн Стивена Кинга', 'Исторический', 'Стивен Кинг', 1600, 'maine.jpg', 'Большая часть западного Мэна напоминает роман Стивена Кинга. Густые темные леса и пруды в глуши. Дома столетней давности с гравийными подъездными дорожками и огромными цветочными садами, акры сельскохозяйственных угодий вдали от шоссе.', 0),
(17, 'Салемов удел', 'Исторический', 'Стивен Кинг', 550, 'salemlot.jpg', 'Бестселлер автора.', 0),
(18, 'Гора', 'Роман', 'Рабиндранат Тагор', 150, 'Gora_1910_novel.jpeg', 'Гора (бенгальский: গোরা) — это роман Рабиндраната Тагора, действие которого происходит в Калькутте (ныне Калькутта) в 1880-х годах во времена Британского Раджа.', 0),
(19, 'Религия человека', 'Религия', 'Рабиндранат Тагор', 230, 'religionman.jpg', 'Религия человека (1931) — это обширное и авторитетное изложение взглядов Рабиндраната Тагора.', 0),
(20, 'История моих экспериментов с истиной', 'Биография', '', 70, 'gandhiji.jpg', 'Автобиография Махатмы Ганди на языке гуджарати.', 0),
(21, 'Преступление и наказание', 'Роман', 'Федор Достоевский', 200, 'Crime-and-Punishment.jpg', 'Раскольников, бывший студент, живет в бедности и хаосе в Санкт-Петербурге. Он решает — через противоречивые теории, включая утилитарную мораль и веру в то, что исключительные люди имеют \"право на преступление\", — убить Алену Ивановну, старуху-ростовщицу.', 0),
(22, 'Идиот', 'Исторический', 'Федор Достоевский', 200, 'idiot.jpg', 'Роман \"Идиот\" рассказывает о молодом, наивном князе Мышкине, который возвращается в родную Россию, чтобы найти дальних родственников после нескольких лет, проведенных в швейцарском санатории. В поезде в Россию он знакомится и дружит с человеком сомнительного характера по имени Рогожин.', 0),
(23, 'Федор Достоевский: Биография', 'Биография', '', 1200, 'fyodor.jpg', 'Федор Достоевский, родившийся 11 ноября [по старому стилю 30 октября] 1821 года в Москве, был вторым ребенком доктора Михаила Достоевского и Марии Достоевской (урожденной Нечаевой). Он вырос в семейном доме на территории Мариинской больницы для бедных, которая находилась в бедном районе на окраине Москвы.', 0),
(24, 'Шримад Бхагавад Гита', 'Религия', '', 200, 'gita.jpg', 'Одна из лучших религиозных книг индуизма.', 0),
(25, 'Святая Библия', 'Религия', '', 330, 'the-holy-bible.jpg', 'Религиозная книга христиан.', 0),
(26, 'Чистый код', 'Программирование', '', 700, 'code.jpg', 'Отличная книга для программистов, написанная Робертом Мартином.', 0),
(27, 'Наука о данных с Python', 'Программирование', '', 170, 'python.jpg', 'Изучите науку о данных с Python простым способом.', 0),
(28, 'Веб-разработка', 'Программирование', '', 250, '174.jpg', 'Освойте HTML, CSS, JavaScript.', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `book_authors`
--

CREATE TABLE `book_authors` (
  `author_id` int(10) NOT NULL,
  `book_author_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `book_authors`
--

INSERT INTO `book_authors` (`author_id`, `book_author_name`) VALUES
(5, 'Стивен Кинг'),
(4, 'Уильям Шекспир'),
(6, 'Рабиндранат Тагор'),
(7, 'Федор Достоевский');

-- --------------------------------------------------------

--
-- Структура таблицы `book_category`
--

CREATE TABLE `book_category` (
  `book_cate_id` int(15) NOT NULL,
  `book_cate_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `book_category`
--

INSERT INTO `book_category` (`book_cate_id`, `book_cate_name`) VALUES
(19, 'Религия'),
(17, 'Исторический'),
(16, 'Программирование'),
(15, 'Биография'),
(14, 'Роман');

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `message_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`message_id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(14, 9, 'Александр', 'martynkovskij@gmail.com', '375298212135', 'ЙОООООООООООООУ КРУТОЙ САЙТИК');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `order_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_books` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_books`, `total_price`, `placed_on`, `payment_status`) VALUES
(17, 9, 'Александр', '213412321312', 'martynkovskij@gmail.com', 'кредитная карта', 'квартира № 20, Курчатова, Гродно, Белаусь - 213123', ', Ричард III (10) ', 3000, '03-Mar-2025', 'completed'),
(18, 9, 'Александр', '9', 'martynkovskij@gmail.com', 'наложенный платеж', 'квартира № 22, Курчатова, Гродно, Белаусь - 412421', ', Идиот (1) , Гора (1) ', 350, '04-Mar-2025', 'completed');

-- --------------------------------------------------------

--
-- Структура таблицы `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `cart_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `book_name` varchar(100) NOT NULL,
  `book_price` int(100) NOT NULL,
  `book_quantity` int(100) NOT NULL,
  `book_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `shopping_cart`
--

INSERT INTO `shopping_cart` (`cart_id`, `user_id`, `book_name`, `book_price`, `book_quantity`, `book_image`) VALUES
(1, 1, 'Гамлет', 100, 1, 'hamlet.jpg'),
(6, 1, 'Религия человека', 230, 1, 'religionman.jpg'),
(8, 1, 'Преступление и наказание', 200, 1, 'Crime-and-Punishment.jpg'),
(11, 1, 'Чистый код', 700, 1, 'code.jpg'),
(13, 1, 'Шримад Бхагавад Гита', 200, 1, 'gita.jpg'),
(15, 1, 'Веб-разработка', 250, 1, '174.jpg'),
(21, 0, 'Гамлет', 100, 1, 'hamlet.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(2, 'админ', 'admin1234@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(9, 'Александр', 'martynkovskij@gmail.com', '47951a40efc0d2f7da8ff1ecbfde80f4', 'user'),
(10, 'Martynkovskij', 'Martynkovskij@mail.ru', '47951a40efc0d2f7da8ff1ecbfde80f4', 'user');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Индексы таблицы `book_authors`
--
ALTER TABLE `book_authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Индексы таблицы `book_category`
--
ALTER TABLE `book_category`
  ADD PRIMARY KEY (`book_cate_id`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Индексы таблицы `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`);

--
-- Индексы таблицы `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Индексы таблицы `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `book_authors`
--
ALTER TABLE `book_authors`
  MODIFY `author_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `book_category`
--
ALTER TABLE `book_category`
  MODIFY `book_cate_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `cart_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
