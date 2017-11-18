-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2017 at 04:20 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mypro`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `b_status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `b_status`) VALUES
(1, 'Samsung', '1'),
(2, 'HP', '1'),
(3, 'Lenovo', '1'),
(4, 'LG', '1'),
(5, 'Adobe', '1'),
(6, 'Microsoft', '1');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `parent_cat` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `c_status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `parent_cat`, `cat_name`, `c_status`) VALUES
(1, 0, 'Electronics', '1'),
(2, 0, 'Softwares', '1'),
(3, 0, 'Gadgets', '1'),
(4, 1, 'Mobile Phone', '1'),
(5, 2, 'Editing Sofware', '1'),
(6, 2, 'Anti Voirus', '1'),
(7, 1, 'Laptop', '1');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_no` int(11) NOT NULL,
  `cust_name` varchar(255) NOT NULL,
  `order_date` date NOT NULL,
  `sub_total` double NOT NULL,
  `gst_tax` int(11) NOT NULL,
  `discount` double NOT NULL,
  `net_total` double NOT NULL,
  `paid_amt` double NOT NULL,
  `due` double NOT NULL,
  `payment_method` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_no`, `cust_name`, `order_date`, `sub_total`, `gst_tax`, `discount`, `net_total`, `paid_amt`, `due`, `payment_method`) VALUES
(11, 'Rizwan Khan', '2017-10-27', 170000, 30600, 5000, 195600, 195600, 0, 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `inv_id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` double NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`inv_id`, `invoice_no`, `product_name`, `product_price`, `qty`) VALUES
(1, 11, '3', 40000, 1),
(2, 11, '4', 45000, 2),
(3, 11, '6', 10000, 4);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pro_id` int(11) NOT NULL,
  `pro_name` varchar(255) NOT NULL,
  `pro_brand` int(11) NOT NULL,
  `pro_category` int(11) NOT NULL,
  `pro_price` double NOT NULL,
  `pro_qty` int(11) NOT NULL,
  `added_date` date NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pro_id`, `pro_name`, `pro_brand`, `pro_category`, `pro_price`, `pro_qty`, `added_date`, `status`) VALUES
(1, 'Samsung Galaxy s8 plus', 1, 4, 68000, 5, '2017-10-27', '0'),
(2, 'Samsung J7', 1, 4, 12000, 10, '2017-10-27', '0'),
(3, 'HP Notebook', 2, 7, 40000, 10, '2017-10-27', '0'),
(4, 'Lenovo Laptop', 3, 7, 45000, 5, '2017-10-27', '0'),
(5, 'Photoshop CS 7', 5, 2, 2000, 10, '2017-10-27', '0'),
(6, 'Samsung Galaxy', 1, 1, 10000, 10, '2017-10-27', '0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` text NOT NULL,
  `register_date` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `usertype`, `register_date`, `last_login`, `notes`) VALUES
(1, 'Rizwan Khan', 'rizwan@gmail.com', '$2y$08$dNTMXu7Yzs2szb078BFIkOL/rbVcQqXctdiYNKo6KDCqBH.6CII3e', '1', '2017-10-14 08:10:26', '2017-10-27 03:10:33', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`),
  ADD UNIQUE KEY `brand_name` (`brand_name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `cat_name` (`cat_name`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_no`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`inv_id`),
  ADD KEY `fk_invoice_no` (`invoice_no`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pro_id`),
  ADD UNIQUE KEY `pro_name` (`pro_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `fk_invoice_no` FOREIGN KEY (`invoice_no`) REFERENCES `invoice` (`invoice_no`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
