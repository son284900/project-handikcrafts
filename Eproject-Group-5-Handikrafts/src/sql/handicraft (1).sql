-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2019 at 10:49 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0
create database handicraft;
use handicraft;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `handicraft`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `AdminName` char(100) NOT NULL,
  `Password` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `AdminName`, `Password`) VALUES
(1, 'long2204', 'long2204');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CatID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CatID`, `Name`) VALUES
(1, 'Iron Handicraft'),
(2, 'Glass Handicraft'),
(3, 'Brass Handicraft'),
(4, 'Wood Handicraft'),
(5, 'Aluminium Handicraft'),
(6, 'Handicraft Decorative'),
(7, 'Tableware'),
(8, 'Home Decor'),
(9, 'Candle Accessories'),
(10, 'Other Product');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `ContactID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(260) DEFAULT NULL,
  `Question` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`ContactID`, `Name`, `Email`, `Question`) VALUES
(3, 'long', 'lelong2242k@gmail.com', 'long');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CusID` int(11) NOT NULL,
  `UserName` char(250) NOT NULL,
  `Password` char(64) NOT NULL,
  `Name` varchar(250) NOT NULL,
  `Age` int(11) NOT NULL,
  `Gender` char(6) NOT NULL,
  `Address` varchar(250) NOT NULL,
  `Phone` char(10) NOT NULL,
  `Email` char(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CusID`, `UserName`, `Password`, `Name`, `Age`, `Gender`, `Address`, `Phone`, `Email`) VALUES
(1, 'long2204', 'long2204', 'LÃª ThÃ nh Long', 19, 'Male', 'ThÃ¡i BÃ¬nh', '0123456789', 'lelong2242k@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `FAQsID` int(11) NOT NULL,
  `Question` varchar(1000) NOT NULL,
  `Answer` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`FAQsID`, `Question`, `Answer`) VALUES
(1, 'Are you a trading company or manufacturer?', 'We manufacture all our goods. We work closely with rural village areas and small family workshops in order to develop and maintain the highest quality handmade products in Thailand.'),
(3, '<b>Move website/account to another server</b> ', 'If you migrate one or more websites/accounts to another server then some changes might be needed in builder for a successful migration.                                     There can be some cases when actions might be required.<b>Note</b>. Use these recommendations only if domains of websites are not changed.                                     <p><b>1. Website/account is moved from one server to another where both servers use the same builder brands</b>. In this case no actions are required.</p>                                     <p><b>2. Website/account is moved from one server to another and servers use different builder brands.</b></p>                                     <p>n this case action is required before website migration. Note that it                                          does not depend on who belongs server where website is about to be                                           migrated - whether it belongs to you or to another hosting company.                                           You will need to migrate website                                          from old builder (used on old server) to new builder (used on new server): </p>                                     <p>1) Open builder for migrating website on old Hosting Panel. Hover on Publish icon and press \"Backup/Restore\" item; </p>                                     <p>2) Migrate website/account; </p>                                     <p>3) Open builder for migrated website on new Hosting Panel. Select Backup/Restore, restore it; </p>                                     <p>4) Publish the website.</p>                                     <p><b>Note </b> that server where website was migrated also must be licensed on Site.pro (must have license with new server IP).</p>                                     <p><b>Mass website/account migration</b></p>                                     <p>If you want to migrate many websites from one server to another at once and servers use different build'),
(4, '                                <b>Website builder asks to choose new template instead of showing your client website </b> ', '<p>1. Client accidentally pressed \"Reset\" or \"Change template\" button. Check if your client has manual or automatic                                          (available for enterprise) backup enabled; </p>                                     <p>2. Client closed website builder without pressing \"Save draft\" after creating a website;</p>'),
(5, '<b>Website in builder looks different than website in a browser after publish  </b> ', ' <p>1. Make sure you are viewing the same site version (Wide, Desktop, Tablet, Phone) both in builder and on published website;  </p>                                     <p>2. Clear Internet browser cache.</p>                                         ');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `ID` int(11) NOT NULL,
  `OrderID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `CusID` int(11) DEFAULT NULL,
  `OrderDate` date NOT NULL,
  `Shipdate` date NOT NULL,
  `Price` float DEFAULT NULL,
  `Status` varchar(500) DEFAULT NULL,
  `ShipperID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `CatID` int(11) DEFAULT NULL,
  `Image` blob NOT NULL,
  `Price` float NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Information` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `Name`, `CatID`, `Image`, `Price`, `Quantity`, `Information`) VALUES
(28, 'Flower vase', 5, 0x75706c6f6164696d6167652f416c756d696e69756d2048616e6469637261667473312e4a5047, 2, 100, '<h4>Material: Aluminum</h4> <h4>Height: 30cm</h4> <h4>Origin: INDIA</h4>'),
(29, 'Aluminum disc set 10', 5, 0x75706c6f6164696d6167652f416c756d696e69756d2048616e6469637261667473322e6a7067, 4, 100, '<h4>Material: Aluminum</h4> <h4>Origin: INDIA</h4>'),
(30, 'Aluminum candlesticks', 5, 0x75706c6f6164696d6167652f416c756d696e69756d2048616e6469637261667473332e6a7067, 1, 200, '<h4>Material: Aluminum</h4> <h4>Height: 35cm</h4> <h4>Origin: INDIA</h4>'),
(31, 'Aluminum candlesticks', 5, 0x75706c6f6164696d6167652f416c756d696e69756d2048616e6469637261667473342e6a7067, 5, 200, '<h4>Material: Aluminum</h4> <h4>Height: 50cm</h4> <h4>Origin: INDIA</h4>'),
(32, 'Leaf shaped plate', 5, 0x75706c6f6164696d6167652f416c756d696e69756d2048616e6469637261667473352e6a7067, 0.7, 300, '<h4>Material: Aluminum</h4> <h4>Size: 20x6cm</h4> <h4>Origin: INDIA</h4>'),
(33, 'swan decoration disc', 5, 0x75706c6f6164696d6167652f416c756d696e69756d2048616e6469637261667473362e6a7067, 2, 300, '<h4>Material: Aluminum</h4> <h4>Origin: INDIA</h4>'),
(34, 'vase double', 5, 0x75706c6f6164696d6167652f416c756d696e69756d2048616e6469637261667473372e6a7067, 5, 200, '<h4>Material: Aluminum</h4> <h4>Height: 30cm,40cm</h4> <h4>Origin: INDIA</h4>'),
(35, 'set 10 wineglasses', 5, 0x75706c6f6164696d6167652f416c756d696e69756d2048616e6469637261667473382e6a7067, 1, 300, '<h4>Material: Aluminum</h4> <h4>Height: 4cm</h4> <h4>Origin: INDIA</h4>'),
(36, 'Double statue', 5, 0x75706c6f6164696d6167652f416c756d696e69756d2048616e6469637261667473392e6a7067, 1, 500, '<h4>Material: Aluminum</h4> <h4>Height: 10cm</h4> <h4>Origin: INDIA</h4>'),
(37, 'vase ', 3, 0x75706c6f6164696d6167652f42726173732048616e6469637261667473312e6a7067, 2, 100, '<h4>Material: Brass</h4> <h4>Height: 43cm</h4> <h4>Origin: INDIA</h4>'),
(38, 'vase ', 3, 0x75706c6f6164696d6167652f42726173732048616e6469637261667473322e6a7067, 2.3, 100, '<h4>Material: Brass</h4> <h4>Height: 45cm</h4> <h4>Origin: INDIA</h4>'),
(39, 'decoration', 3, 0x75706c6f6164696d6167652f42726173732048616e6469637261667473332e6a706567, 1.4, 100, '<h4>Material: Brass</h4> <h4>Size: 30*30cm</h4> <h4>Origin: INDIA</h4>'),
(40, 'Candlestick Brass', 3, 0x75706c6f6164696d6167652f42726173732048616e6469637261667473342e6a7067, 2, 100, '<h4>Material: Brass</h4> <h4>Height: 30cm</h4> <h4>Origin: INDIA</h4>'),
(41, 'Championship cup', 3, 0x75706c6f6164696d6167652f42726173732048616e6469637261667473352e6a7067, 5, 200, '<h4>Material: Brass</h4> <h4>Height: 50cm</h4> <h4>Origin: INDIA</h4>'),
(42, 'cups brass', 3, 0x75706c6f6164696d6167652f42726173732048616e6469637261667473362e6a7067, 6, 400, '<h4>Material: Brass</h4><h4>Origin: INDIA</h4>'),
(43, 'Jar ', 3, 0x75706c6f6164696d6167652f42726173732048616e6469637261667473382e6a7067, 4, 500, '<h4>Material: Brass</h4> <h4>Height: 60cm, 80cm</h4> <h4>Origin: INDIA</h4>'),
(44, 'tea pots', 3, 0x75706c6f6164696d6167652f42726173732048616e6469637261667473372e6a7067, 4, 200, '<h4>Material: Brass</h4><h4>Origin: INDIA</h4>'),
(46, 'Candlesticks', 9, 0x75706c6f6164696d6167652f43616e646c65204163636573736f72696573312e6a7067, 0.6, 115, 'Candlesticks to the altar'),
(47, 'vase  glass', 2, 0x75706c6f6164696d6167652f476c6173732048616e6469637261667473342e6a7067, 2, 100, '<h4>Material: Glass</h4> <h4>Height: 40cm</h4> <h4>Origin: INDIA</h4>'),
(48, 'Set 6 cup tea', 2, 0x75706c6f6164696d6167652f476c6173732048616e6469637261667473392e6a7067, 5, 500, '<h4>Material: Glass</h4> <h4>Height: 12cm</h4> <h4>Origin: INDIA</h4>'),
(49, 'Decorative on table', 2, 0x75706c6f6164696d6167652f476c6173732048616e6469637261667473312e6a7067, 3, 200, '<h4>Material: Glass</h4> <h4>Height: 40cm</h4> <h4>Origin: INDIA</h4>'),
(50, 'decorative clock', 6, 0x75706c6f6164696d6167652f48616e64696372616674204465636f726174697665382e6a7067, 3, 100, 'home decor clock'),
(51, 'Nice bike decoration', 1, 0x75706c6f6164696d6167652f49726f6e2048616e6469637261667473352e6a7067, 5, 100, '<h4>Material: Aluminum</h4> <h4>Height: 28cm</h4> <h4>Origin: INDIA</h4>'),
(52, 'Nice car decoration', 1, 0x75706c6f6164696d6167652f49726f6e2048616e6469637261667473322e6a7067, 26, 500, '<h4>Material: Iron</h4>  <h4>Origin: INDIA</h4>'),
(53, 'Tableware', 7, 0x75706c6f6164696d6167652f5461626c657761726573362e6a7067, 8, 300, '<h4>Material: Glass</h4> <h4>Origin: INDIA</h4>'),
(54, 'chair', 4, 0x75706c6f6164696d6167652f576f6f642048616e6469637261667473372e6a7067, 5, 1000, '<h4>Material: Wood</h4> <h4>Height: 1,3m</h4> <h4>Origin: INDIA</h4>');

-- --------------------------------------------------------

--
-- Table structure for table `shipper`
--

CREATE TABLE `shipper` (
  `ShipperID` int(11) NOT NULL,
  `CompanyName` varchar(100) NOT NULL,
  `Phone` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipper`
--

INSERT INTO `shipper` (`ShipperID`, `CompanyName`, `Phone`) VALUES
(1, 'Viettel Post', '0123456789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CatID`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`ContactID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CusID`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`FAQsID`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ProductID` (`ProductID`),
  ADD KEY `OrderID` (`OrderID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `CusID` (`CusID`),
  ADD KEY `ShipperID` (`ShipperID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `CatID` (`CatID`);

--
-- Indexes for table `shipper`
--
ALTER TABLE `shipper`
  ADD PRIMARY KEY (`ShipperID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `ContactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `FAQsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orderdetail`
--
ALTER TABLE `orderdetail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `shipper`
--
ALTER TABLE `shipper`
  MODIFY `ShipperID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`),
  ADD CONSTRAINT `orderdetail_ibfk_2` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`CusID`) REFERENCES `customer` (`CusID`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`ShipperID`) REFERENCES `shipper` (`ShipperID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`CatID`) REFERENCES `categories` (`CatID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
