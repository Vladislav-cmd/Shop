-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Янв 22 2022 г., 11:38
-- Версия сервера: 10.4.11-MariaDB
-- Версия PHP: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ecommerce`
--

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `anons` varchar(250) NOT NULL,
  `text` text NOT NULL,
  `img` varchar(50) NOT NULL,
  `price` int(5) UNSIGNED NOT NULL,
  `category` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `anons`, `text`, `img`, `price`, `category`) VALUES
(1, 'Часы №2', 'Часы, которые нужны каждому', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. Excepteur sint occaecat cupidatat non proident.', 'watch2.jpg', 200, 'watches'),
(2, 'Часы №1', 'Часы, которые нужны каждому', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam. Excepteur sint occaecat cupidatat non proident.', 'watch1.jpg', 350, 'watches'),
(3, 'Кепка №1', 'Отличная чемпионская кепка', 'Отличная чемпионская кепка, которой достоин каждый', 'hat1.jpg', 100, 'hats'),
(5, 'Часы №3', 'Отличные мужские часы', 'Качество и точность этих часов превосходит все остальные модели', 'watch3.jpg', 370, 'watches'),
(6, 'Часы №4', 'Отличные мужские часы', 'Качество и точность этих часов превосходит все остальные модели', 'watch4.jpg', 233, 'watches'),
(7, 'Кепка №2', 'Отличный головной убор', 'Кепка, которая нужна каждому', 'hat2.jpg', 50, 'hats'),
(8, 'Кепка №3', 'Отличный головной убор', 'Кепка, которая нужна каждому', 'hat3.jpg', 222, 'hats'),
(9, 'Кепка №4', 'Неплохая кепка', 'Вам стоит купить эту кепку!', 'hat4.jpg', 321, 'hats'),
(10, 'Кроссовки №1', 'Отличные баскетбольные кроссовки', 'Отличные баскетбольные кроссовки, которые нужны каждому спортсмену', 'shoe1.jpg', 700, 'shoes'),
(11, 'Кроссовки №2', 'Отличные баскетбольные кроссовки', 'Отличные баскетбольные кроссовки, которые нужны каждому спортсмену', 'shoe2.jpg', 655, 'shoes'),
(12, 'Кроссовки №3', 'Неплохие педали', 'Покупайте их, пока скидка', 'shoe3.jpg', 222, 'shoes'),
(13, 'Кроссовки №4', 'Отличная обувь', 'Покупайте их, пока скидка', 'shoe4.jpg', 123, 'shoes'),
(14, 'Футболка №1', 'Отличная футболка только для вас', 'Покупай и будь в тренде', 'shirt1.jpg', 421, 'shirts'),
(15, 'Футболка №2', 'Отличная футболка, но уже не для вас', 'Покупай и будь в тренде', 'shirt2.jpg', 221, 'shirts'),
(16, 'Футболка №3', 'Неплохая футболка под ваш имидж', 'Покупка оправдает ваши ожидания', 'shirt3.jpg', 62, 'shirts'),
(17, 'Футболка №4', 'Плохая футболка под ваш имидж', 'Покупка не оправдает ваши ожидания', 'shirt4.jpg', 218, 'shirts'),
(18, 'Новый продукт', 'Super power very power super good item broooo', 'Super power very power super good item broooo', 'shoe1.jpg', 849, 'shoes');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(70) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `image` varchar(190) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `pass`, `image`) VALUES
(22, 'Пользователь', 'test@yandex.ru', '$2y$10$itsi.6E6fLVwM0gzeKQ0KOyCiyVO3pZ3cjoYCU2LSIO18LhaHl5FG', '1590845267_good_luck.jpg'),
(21, 'Владислав', 'jean41@yandex.ru', '$2y$10$vCm9bNbKsAtRinWOp6oVxeqks7iaDJaINHQmmSXGnC2gIFCozg1SC', '1590916538_BE24Fw2CXNw.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
