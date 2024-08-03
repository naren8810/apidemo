-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2024 at 12:47 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `innovins_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `created_at`) VALUES
(1, 'testtt', 'testtt', 12312.00, '2024-08-03 22:05:00'),
(3, 'test', 'test', 123.00, '2024-08-03 22:16:33'),
(4, 'testname', 'testdesc', 123.00, '2024-08-03 22:20:25'),
(5, 'testname', 'testdesc', 123.00, '2024-08-03 22:22:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'test1updated', 'admin@gmail.com', '$2y$10$5Bbah9oiZnt5yLcCZhZ5iuuUfVI5XoQy8BMz2d1RVlN6oQ4IS5g0C', '2024-08-03 11:12:16'),
(2, 'test2', 'admin2@gmail.com', '$2y$10$7ExUPWW9nmFgxpIYoneYbO38FRcPPj2TbKdaMisXFgE5bVuaPWN76', '2024-08-03 11:12:29'),
(3, 'test3', 'admin3@gmail.com', '$2y$10$vq.VBWb/Ml1xNdGCGhwvTeEcqfLNHh47Zh70j1UBMAWsZ7p43Tsdu', '2024-08-03 11:19:47'),
(4, 'test4', 'admin4@gmail.com', '$2y$10$fTZ19mJtovAX1gVDjBkWdeOlK1JYYXDKTBgY4jPgK30rlpU98Wdu.', '2024-08-03 11:20:45'),
(5, 'test5', 'admin5@gmail.com', '$2y$10$gW2CuTftTmyUlQ3h6jaJSe3IfY2SHjvRMbqySEdr7NGp97TwQL.Lm', '2024-08-03 11:12:16'),
(6, 'test6', 'admin6@gmail.com', '$2y$10$7ExUPWW9nmFgxpIYoneYbO38FRcPPj2TbKdaMisXFgE5bVuaPWN76', '2024-08-03 11:12:29'),
(7, 'test7', 'admin7@gmail.com', '$2y$10$vq.VBWb/Ml1xNdGCGhwvTeEcqfLNHh47Zh70j1UBMAWsZ7p43Tsdu', '2024-08-03 11:19:47'),
(8, 'test8', 'admin8@gmail.com', '$2y$10$fTZ19mJtovAX1gVDjBkWdeOlK1JYYXDKTBgY4jPgK30rlpU98Wdu.', '2024-08-03 11:20:45'),
(9, 'test9', 'admin9@gmail.com', '$2y$10$fTZ19mJtovAX1gVDjBkWdeOlK1JYYXDKTBgY4jPgK30rlpU98Wdu.', '2024-08-03 11:20:45'),
(10, 'test10', 'admin10@gmail.com', '$2y$10$gW2CuTftTmyUlQ3h6jaJSe3IfY2SHjvRMbqySEdr7NGp97TwQL.Lm', '2024-08-03 11:12:16'),
(11, 'test11', 'admin11@gmail.com', '$2y$10$7ExUPWW9nmFgxpIYoneYbO38FRcPPj2TbKdaMisXFgE5bVuaPWN76', '2024-08-03 11:12:29'),
(12, 'test12', 'admin12@gmail.com', '$2y$10$vq.VBWb/Ml1xNdGCGhwvTeEcqfLNHh47Zh70j1UBMAWsZ7p43Tsdu', '2024-08-03 11:19:47'),
(14, 'test12', 'admin13@gmail.com', '$2y$10$fTZ19mJtovAX1gVDjBkWdeOlK1JYYXDKTBgY4jPgK30rlpU98Wdu.', '2024-08-03 11:20:45'),
(15, 'test14', 'admin14@gmail.com', '$2y$10$fTZ19mJtovAX1gVDjBkWdeOlK1JYYXDKTBgY4jPgK30rlpU98Wdu.', '2024-08-03 11:20:45'),
(16, 'test15', 'admin15@gmail.com', '$2y$10$gW2CuTftTmyUlQ3h6jaJSe3IfY2SHjvRMbqySEdr7NGp97TwQL.Lm', '2024-08-03 11:12:16'),
(17, 'test16', 'admin16@gmail.com', '$2y$10$7ExUPWW9nmFgxpIYoneYbO38FRcPPj2TbKdaMisXFgE5bVuaPWN76', '2024-08-03 11:12:29'),
(19, 'testt', 'admin19@gmail.com', '$2y$10$6XfRYkQ9Y6S1r6N8/JXVUOuP7gyWnn6ND3R3TVYc/NujerbfENXY.', '2024-08-03 15:58:17'),
(20, 'asdad', 'admiasdan@gmail.com', '$2y$10$U5en.f3koXHky8xBeLJJOOa4fEEi8Tcn0h.zEQwVk.yNdFS8Trkdi', '2024-08-03 15:59:25'),
(21, 'test', 'admintest@gmail.com', '$2y$10$2RTOnU7xc4K0tQilN7R5FutIVZ0ujb1SGPmBMLVRCmifoFUkdAXbu', '2024-08-03 18:09:44'),
(22, 'asdad', 'adadasmin@gmail.com', '$2y$10$DvmqXmPz5BA0ef12uU5bNOYVPhJy4t8L.W6FG/Fy0WS7vNRhK2H5y', '2024-08-03 18:12:34'),
(23, 'asdasd', 'adasdmin@gmail.com', '$2y$10$cM2ylXfHpRWsR6vZ2l/IOeGBkLH0gttWgZxQnIXvL2VvJTZNI1JsW', '2024-08-03 18:13:36'),
(24, 'sdsdf', 'adsdfmin@gmail.com', '$2y$10$1UTNYQdMFkd2YOfGa6WBc.WUEpzk34/1itejHiBN016N5s0BBfOmi', '2024-08-03 18:14:50'),
(25, 'sdfsf', 'admsfin@gmail.com', '$2y$10$4gCNauQnEHF8mSvfnGKpye89dbBBcuI7dNW0REX1a6CAEpFpYFYcG', '2024-08-03 18:15:23'),
(26, 'asdad', 'adasadadmin@gmail.com', '$2y$10$IFpU9gYSoBpKCFiMVl9GvetpsD.VkIwYQfgQ7M8z5bYdbAmnrnfHS', '2024-08-03 18:16:12'),
(27, 'asdasd', 'adasdadsmin@gmail.com', '$2y$10$7Dh2qi5wbC3p1HIoc7nBDuFTJ9eIWpcmBqtvY4ZVj5rwIp6SU3MN.', '2024-08-03 18:16:55'),
(28, 'asdasd', 'aasdasddmin@gmail.com', '$2y$10$S/T3OoFx2t/2KSfQmGQrvOGFpX6jlVOv2URtoxQUN6LOuqg.f2RE6', '2024-08-03 18:18:04'),
(29, 'asdasd', 'admiasdadsn@gmail.com', '$2y$10$SaeW1J2GMWDLikMekaGsOeyMnAmc0stDHyQ2jGH21ZPmZpHObeF6.', '2024-08-03 18:19:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
