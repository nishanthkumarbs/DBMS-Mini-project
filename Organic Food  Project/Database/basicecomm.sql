-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2024 at 08:49 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: basicecomm
--

-- --------------------------------------------------------

--
-- Table structure for table admin
--

CREATE TABLE admin (
  id int(11) NOT NULL,
  username varchar(30) NOT NULL,
  password text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table admin
--

INSERT INTO admin (id, username, password) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table cart
--

CREATE TABLE cart (
  id int(11) NOT NULL,
  username varchar(50) NOT NULL,
  product_id int(11) DEFAULT NULL,
  quantity int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table cart
--

INSERT INTO cart (id, username, product_id, quantity) VALUES
(1, 'Nishanth', 3, 1),
(2, 'Manoj', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table products
--

CREATE TABLE products (
  id int(11) NOT NULL,
  name text NOT NULL,
  price int(11) NOT NULL,
  img varchar(255) NOT NULL,
  info varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table products
--

INSERT INTO products (id, name, price, img, info) VALUES
(1, 'Carrot', 20, 'uploads/Carrot.jpg', 'Orange root vegetable'),
(2, 'Tomato', 40, 'uploads/Tomato.jpg', 'The tomato is globular or ovoid'),
(3, 'Apple', 100, 'uploads/download.jpeg', 'The apple is one of the pome (fleshy) fruits'),
(4, 'Mango', 60, 'uploads/Mango.jpg', ' An edible stone fruit produced by the tropical tree Mangifera indica'),
(5, 'Badam', 80, 'uploads/Badam.jpg', 'off-white in color, covered by a thin brownish skin'),
(6, 'Peanuts', 70, 'uploads/peanut.jpg', 'An annual leguminous herb native to South America');

-- --------------------------------------------------------

--
-- Table structure for table users
--

CREATE TABLE users (
  id int(11) NOT NULL,
  name text NOT NULL,
  email varchar(30) NOT NULL,
  password text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table users
--

INSERT INTO users (id, name, email, password) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$BsGkYA/T4WbeF1Qh5/smye9sk9n0P/XUz7UpyN/6OFxj4EB51vNP6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table admin
--
ALTER TABLE admin
  ADD PRIMARY KEY (id);

--
-- Indexes for table cart
--
ALTER TABLE cart
  ADD PRIMARY KEY (id);

--
-- Indexes for table products
--
ALTER TABLE products
  ADD PRIMARY KEY (id);

--
-- Indexes for table users
--
ALTER TABLE users
  ADD PRIMARY KEY (id),
  ADD UNIQUE KEY email (email);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table admin
--
ALTER TABLE admin
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table cart
--
ALTER TABLE cart
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table products
--
ALTER TABLE products
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table users
--
ALTER TABLE users
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;