-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2026 at 08:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nomadforce`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `catid` int(100) NOT NULL,
  `catName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catid`, `catName`) VALUES
(1, 'Website'),
(2, 'Branding'),
(3, 'Graphic'),
(4, 'Art Direction');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `itemCategory` int(11) NOT NULL,
  `itemQty` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `image`, `price`, `itemCategory`, `itemQty`) VALUES
(1, 'Effortless', 'Tell your brand’s story with impact. Our branding videos capture your identity, values, and vision in a powerful visual narrative that connects with your audience. From concept to final edit, we craft cinematic content that strengthens your brand presence, builds trust, and leaves a lasting impression across all platforms.', 'https://placehold.co/350x120/000000/FFFFFF/png', 500, 1, 0),
(2, 'Maki', 'Make your website come alive with captivating videos that engage visitors and tell your story instantly. We create high-quality website videos that showcase your brand, products, or services in a clear and visually stunning way. Whether it’s a homepage intro, background video, or an about-us story, our videos are designed to enhance user experience and turn visitors into loyal customers.', 'https://placehold.co/350x120/000000/FFFFFF/png', 350, 2, 0),
(3, 'The gig economy', 'Show the power of flexibility and innovation with our Gig Economy videos. We create dynamic visuals that highlight freelance platforms, remote work opportunities, and the evolving future of independent professionals. Whether you’re promoting a new app, service, or concept, our videos bring energy and clarity to your message — connecting with the modern workforce that values freedom, skill, and opportunity.', 'https://placehold.co/350x120/000000/FFFFFF/png', 150, 3, 0),
(4, 'Health technology', 'Bring innovation and wellness together with our custom Health Technology videos. We craft engaging visual stories that highlight cutting-edge medical devices, healthcare apps, telemedicine solutions, and digital health innovations. Whether you want to explain complex tech concepts, promote a new product, or build trust with your audience, our videos blend creativity and clarity to make your message stand out in the fast-evolving world of health tech.', 'https://placehold.co/350x120/000000/FFFFFF/png', 400, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(100) NOT NULL,
  `transactionID` varchar(250) NOT NULL,
  `tCurrency` varchar(10) NOT NULL,
  `tAmount` decimal(5,0) NOT NULL,
  `tComplete` varchar(30) NOT NULL,
  `tItems` varchar(100) NOT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transactionID`, `tCurrency`, `tAmount`, `tComplete`, `tItems`, `date`) VALUES
(1, '4AG81152B29163906', 'USD', 950, 'Completed', 'Maki x1, The gig economy x4, ', '2025-10-30 00:00:00'),
(2, '2HA8408688788835D', 'USD', 300, 'Completed', 'The gig economy:2,', '2025-10-30 00:00:00'),
(3, '637780497S816881J', 'USD', 300, 'Completed', 'The gig economy:2,', '2025-11-04 00:00:00'),
(4, '2TE89380YJ9955947', 'USD', 150, 'Completed', 'The gig economy:1,', '2025-11-05 00:00:00'),
(6, '18V24562UU622500F', 'USD', 150, 'Completed', 'The gig economy:1,', '2025-11-06 00:00:00'),
(7, '9TX54357B6516782H', 'USD', 350, 'Completed', 'Maki:1,', '2025-11-06 00:00:00'),
(8, '7J997294BC1983828', 'USD', 700, 'Completed', 'Maki:2,', '2025-12-01 00:00:00'),
(9, '7J997294BC1983828', 'USD', 700, 'Completed', '', '2025-12-03 00:00:00'),
(10, '4W254286DK8587828', 'USD', 150, 'Completed', 'The gig economy:1,', '2025-12-30 00:00:00'),
(11, '8C892737DC634193J', 'USD', 500, 'Completed', 'Effortless:1,', '2026-01-03 20:24:45'),
(12, '95X88318AS373784A', 'USD', 150, 'Completed', 'The gig economy:1,', '2026-01-03 20:25:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `isadmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `firstname`, `lastname`, `nickname`, `phone`, `lastlogin`, `isadmin`) VALUES
(1, 'ss@gmail.com', '123123', 'salsabeel', 'thaher', 'SA', '079000000', '0000-00-00 00:00:00', 1),
(2, 'sa@gmail.com', '123123', 's', 't', 'SA', '079000000', '0000-00-00 00:00:00', 0),
(3, 'sat@gmail.com', '123123', 'ss', 'tt', 'sstt', '079000000', '0000-00-00 00:00:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `catid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`id`) REFERENCES `categories` (`catid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
