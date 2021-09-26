-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2021 at 06:05 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffeeshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisements`
--

CREATE TABLE `advertisements` (
  `id` int(255) UNSIGNED NOT NULL,
  `img` varchar(500) NOT NULL,
  `name` varchar(255) NOT NULL,
  `headline` varchar(255) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `advertisements`
--

INSERT INTO `advertisements` (`id`, `img`, `name`, `headline`, `description`, `Date`) VALUES
(5, '61389516ed8c89.52412157.jpeg', 'Latte', 'Latte! A Coffee with Art', 'The term comes from the Italian caffellatte[3] or caffè latte, from caffè e latte, literally \"coffee and milk\"; in English orthography either or both words sometimes have an accent on the final e (a hyperforeignism or to indicate it is pronounced, not the more-common silent final e of English). In northern Europe and Scandinavia, the term café au lait has traditionally been used for the combination of espresso and milk. In France, café latte is from the original name of the drink (caffè latte); a combination of espresso and steamed milk equivalent to a \"latte\" is in French called grand crème and in German Milchkaffee or (in Austria) Wiener Melange.', '2021-09-08'),
(6, '6138956e75d475.71904520.jpg', 'Macchiato', 'Do you want the strongest Coffee but with a little flavor?', 'In Italian, the term \"macchiato\" translates as \"marked\" or \"stained\", meaning a stained or marked coffee. The macchiato is an espresso coffee drink, topped with a small amount of foamed or steamed milk to allow the taste of the espresso to still shine through. A macchiato is perfect for those who find espresso too harsh in flavour, but a cappuccino too weak.', '2021-09-08');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `Name`, `Description`, `image`, `price`) VALUES
(1, 'Americano', 'An Americano is an espresso-based drink designed to resemble coffee brewed in a drip filter, considered popular in the United States of America.', 'americano.jpg', 130),
(3, 'Espresso', 'coffee brewed by forcing hot water through finely ground darkly roasted coffee beans.', 'espresso.jpg', 120),
(5, 'Cappuccino', 'Espresso coffee topped with frothed hot milk or cream and often flavored with cinnamon.', 'cappuccino.jpg', 220),
(6, 'Mocha', 'Mocha is a high quality type of coffee made from a specific coffee bean. It\'s easily confused with the flavored drink also called a mocha, which combines coffee and chocolate.', 'mocha.jpg', 240),
(16, 'Latte', 'A latte is more correctly known as a \"Cafe Latte\", though most large-scale commercial chains will make a cafe latte by default when you ask for a latte. The exception to this will be true Italian or other European restaurants, where ordering a \"latte\" will literally get you just a glass of steamed milk.', '6138910de16c23.04854691.jpg', 230);

-- --------------------------------------------------------

--
-- Table structure for table `ordered_products`
--

CREATE TABLE `ordered_products` (
  `id` int(255) UNSIGNED NOT NULL,
  `order_uid` varchar(255) NOT NULL,
  `product_id` int(255) UNSIGNED NOT NULL,
  `quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pending order`
--

CREATE TABLE `pending order` (
  `id` int(255) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `products_uid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(255) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `product id` int(255) NOT NULL,
  `quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `name`, `address`, `number`, `date`, `product id`, `quantity`) VALUES
(11, 'Shahriar', 'Dhaka', '01620440107', '2021-09-07', 3, 3),
(12, 'Shahriar', 'Dhaka', '01620440107', '2021-09-07', 6, 2),
(13, 'Dondu', 'Uttara Graam', '01556546548', '2021-09-07', 6, 5),
(15, 'Nurusshafi', 'Mirpur', '01556546547', '2021-09-07', 1, 3),
(16, 'Nurusshafi', 'Mirpur', '01556546547', '2021-09-07', 3, 3),
(17, 'Nurusshafi', 'Mirpur', '01556546547', '2021-09-07', 5, 4),
(18, 'Nurusshafi', 'Mirpur', '01556546547', '2021-09-07', 6, 1),
(21, 'Tanisha', 'Goran', '01556546544', '2021-09-08', 16, 4),
(22, 'Montu Vai', 'Mohammadpur', '01556546543', '2021-09-08', 16, 2),
(23, 'Montu Vai', 'Mohammadpur', '01556546543', '2021-09-08', 6, 4),
(24, 'Iftekhar', 'Goran', '01556546559', '2021-09-08', 16, 3),
(25, 'Iftekhar', 'Goran', '01556546559', '2021-09-08', 1, 2),
(26, 'Iftekhar', 'Goran', '01556546559', '2021-09-08', 3, 2),
(27, 'Fahim', 'Bashabo', '01556546599', '2021-09-08', 6, 3),
(28, 'Nabil', 'Mohammadpur', '01556546569', '2021-09-08', 6, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisements`
--
ALTER TABLE `advertisements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordered_products`
--
ALTER TABLE `ordered_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_uid` (`order_uid`);

--
-- Indexes for table `pending order`
--
ALTER TABLE `pending order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_uid` (`products_uid`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_ibfk_1` (`product id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisements`
--
ALTER TABLE `advertisements`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ordered_products`
--
ALTER TABLE `ordered_products`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pending order`
--
ALTER TABLE `pending order`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ordered_products`
--
ALTER TABLE `ordered_products`
  ADD CONSTRAINT `ordered_products_ibfk_1` FOREIGN KEY (`order_uid`) REFERENCES `pending order` (`products_uid`) ON DELETE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`product id`) REFERENCES `menu` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
