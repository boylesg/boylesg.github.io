-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 23, 2023 at 10:27 PM
-- Server version: 8.0.35-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `find_a_tradie`
--

-- --------------------------------------------------------

--
-- Table structure for table `trades`
--

CREATE TABLE `trades` 
(
  `id` int NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` varchar(256) NOT NULL
);

--
-- Dumping data for table `trades`
--

INSERT INTO `trades` (`id`, `name`, `description`) VALUES
(1, 'Appliance Repair', 'Repair services for household appliances.'),
(2, 'Asphalt and Paving', 'Asphalt and pavement installation and repair.'),
(3, 'Bricklaying', 'Bricklaying for structures.'),
(4, 'Cabinetry', 'Cabinet making and installation.'),
(5, 'Carpentry', 'General carpentry and woodworking.'),
(6, 'Computer Technician', 'Computer and network installation, repair, troubleshooting and upgrade.'),
(7, 'Concreting', 'Concrete pouring and finishing.'),
(8, 'Construction', 'General contractors, builders and construction companies.'),
(9, 'Demolition', 'Demolition services for structure removal..'),
(10, 'Doors and Windows', 'Installation and repair of doors and windows..'),
(11, 'Drywall and Plastering', 'Drywall installation and plaster work.'),
(12, 'Electrical', 'Wiring, electrical installations and repairs.'),
(13, 'Elevator Installation and Repair', 'Elevator installation and maintenance.'),
(14, 'Excavation and earth moving', 'Operation of excavators and dump trucks.'),
(15, 'Fencing (domestic)', 'Construction of paling, picket and Colorbond fences.'),
(16, 'Fencing (commercial)', 'Construction of commercial paling and cyclone wire fences.'),
(17, 'Fencing (rural);', 'Construction of fences on rural properties.'),
(18, 'Fireplace and Chimney', 'Installation and maintnence of fireplaces and chimneys.'),
(19, 'Flooring', 'Installation and repair of various flooring types.'),
(20, 'Framing', 'Structural framing for buildings.'),
(21, 'Gardening and Mowing', 'Garden maintenance and lawn mowing.'),
(22, 'Glass and Glazing', 'Glass installation and repair services.'),
(23, 'Gutters and Downspouts', 'Gutter and downspout installation and maintenance.'),
(24, 'Handyman', 'Installation of shelves, doors, small painting jobs, plasterboard repairs and furniture assembly etc.'),
(25, 'Home Inspection', 'Home inspection services for buyers and sellers.'),
(26, 'HVAC (Heating, Ventilation, and Air Conditioning)', 'Ventilation and Air Conditioning);, Heating and cooling systems installation and maintenance.'),
(27, 'Insulation', 'Installation and maintenance of insulation.'),
(28, 'Interior Design', 'Interior design and decor services.'),
(29, 'Land Management', 'Weed spraying, planting, slashing and woody weed removal etc.'),
(30, 'Landscaping', 'Creation of gardens where a building license is not required.'),
(31, 'Landscape construction', 'Creation of gardens with structures requiring a building license.'),
(32, 'Locksmith', 'Locksmith services for security needs.'),
(33, 'Masonry', 'Bricklaying, stonework and concrete work.'),
(34, 'Painting', 'Interior and exterior painting services.'),
(35, 'Paving', 'Install or repair outdoor paving.'),
(36, 'Pest Control', 'Pest control services for homes and businesses.'),
(37, 'Pet Grooming', 'Pet fur trimming, bathing and nail clipping etc.'),
(38, 'Plumbing', 'Plumbing services including installation and repairs.'),
(39, 'Pool and Spa Maintenance', 'Pool and spa installation and maintenance.'),
(40, 'Renovation and Remodeling', 'Home renovation and remodeling services.'),
(41, 'Roofing', 'Roofing installations and repairs.'),
(42, 'Scaffolding', 'Scaffolding rental and setup services.'),
(43, 'Security Systems', 'Installation and maintenance of security systems.'),
(44, 'Septic Systems', 'Installation and maintenance of septic systems.'),
(45, 'Siding', 'Siding installation and repair services.'),
(46, 'Solar Panel Installation', 'Solar panel installation and maintenance.'),
(47, 'Surveying', 'Land surveyors and mapping services.'),
(48, 'Tiling', 'Ceramic, porcelain and other tile installations.'),
(49, 'Welding', 'Welding for metalwork and repairs.'),
(50, 'Window Installation and Repair', 'Window installation and repair services.'),
(51, 'Window Cleaning', 'Domestic and commercial window cleaning.'),
(52, 'Landscaping - Australian native', 'Specialising in creation of landscapes using Australian native flora.'),
(53, 'Lawn managment', 'Establishment and maintence of lawns (instant turf and seed sown).'),
(54, 'Lawn management (Australian native)', 'Establishment and maintence of lawns using Australian native grass species (\'Griffin\' irolaena stipoides, \'Oxley\' Austrodanthonia geniculata & \'Bass\' Bothtiochloa macra)'),
(55, 'Towing (light)', 'Towing of regular passenger vehicles.'),
(56, 'Towing (heavy)', 'Towing of heavy vehicles likes trucks and busses.'),
(57, 'Mechanic (petrol)', 'Trouble shooting and repair of petrol vehicles.'),
(58, 'Mechanic (deisel)', 'Trouble shooting and reapair of deisel vehicles.'),
(59, 'Customer', 'A customer exclusively looking for tradies');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trades`
--
ALTER TABLE `trades`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trades`
--
ALTER TABLE `trades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

/*****************************************************************************************************************************************************/
/*****************************************************************************************************************************************************/
/*****************************************************************************************************************************************************/
/*****************************************************************************************************************************************************/

-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2023 at 09:57 PM
-- Server version: 8.0.35-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `find_a_tradie`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int UNSIGNED NOT NULL,
  `trade_id` int NOT NULL,
  `business_name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `first_name` varchar(64) NOT NULL,
  `surname` varchar(64) NOT NULL,
  `profile_filename` varchar(32) DEFAULT NULL,
  `logo_filename` varchar(32) DEFAULT NULL,
  `abn` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `structure` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `license` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `minimum_charge` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `minimum_budget` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `maximum_size` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `maximum_distance` int(10) UNSIGNED ZEROFILL DEFAULT NULL,
  `unit` varchar(64) DEFAULT NULL,
  `street` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `suburb` varchar(64) NOT NULL,
  `state` varchar(3) NOT NULL,
  `postcode` varchar(4) NOT NULL,
  `phone` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(256) NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `date_joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `trade_id`, `business_name`, `first_name`, `surname`, `profile_filename`, `abn`, `structure`, `license`, `description`, `minimum_charge`, `minimum_budget`, `maximum_size`, `maximum_distance`, `logo_filename`, `unit`, `street`, `suburb`, `state`, `postcode`, `phone`, `mobile`, `email`, `username`, `password`, `expiry_date`, `date_joined`) VALUES
(1, 52, 'Greg\'s Native Landscapes', 'Greg', 'Boyles', NULL, '51 824 753 556', 'Sole trader', 'Electrical license\r\nClass A\r\nNumber: 8743895324', 'Ecological weed control\r\nLow maintenance\r\nDrought tolerant\r\nIrrigation systems\r\nSmall retaining walls\r\nSmall tree removal\r\nGeneral pruning\r\nBush tucker gardens\r\nSmall ornamental billabongs\r\nNative lawns', 0000000120, 0000005000, 'Up to 50', 0000000100, 'Logo.jpg', 'Unit 3, building 6(Cooper)', '56 Derby Drive', 'EPPING', 'VIC', '3076', '94013696', '0455328886', 'gregplants@bigpond.com', 'gregaryb', '{"ct":"L1JVkdLcO3Bggg5MMJAEGw==","iv":"989fd9bc8ff182cf540ef36e72ab4b48","s":"365e6c6cafdee541"}', '2024-11-08', '2023-11-07 11:25:49'),
(11, 59, NULL, 'Albus', 'Dumbledore', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38 Harris Street', 'Terip Terip', 'VIC', '3179', '94012348', '0414567980', 'albus.dumbledore@gmail.com', 'dumbledorea', '{"ct":"L1JVkdLcO3Bggg5MMJAEGw==","iv":"989fd9bc8ff182cf540ef36e72ab4b48","s":"365e6c6cafdee541"}', NULL, '2023-11-20 06:20:23'),
(12, 59, NULL, 'Ronald', 'Weasley', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11 Boughtman Street', 'Notting Hill', 'VIC', '3168', '94012846', '0414284527', 'ronald.weasley@gmail.com', 'weasleyr', '{"ct":"L1JVkdLcO3Bggg5MMJAEGw==","iv":"989fd9bc8ff182cf540ef36e72ab4b48","s":"365e6c6cafdee541"}', NULL, '2023-11-20 06:22:07'),
(15, 59, NULL, 'Fred', 'Weasley', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '45 Watson Street', 'Runnymede', 'VIC', '3559', '94013049', '0455482983', 'fred.weasley@gmail.com', 'weasleyf', '{"ct":"L1JVkdLcO3Bggg5MMJAEGw==","iv":"989fd9bc8ff182cf540ef36e72ab4b48","s":"365e6c6cafdee541"}', NULL, '2023-11-20 06:26:13'),
(16, 59, NULL, 'George', 'Weasley', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '45 Watson Street', 'Runnymede', 'VIC', '3559', '94556737', '0455678351', 'george.weasley@gmail.com', 'weasleyg', '{"ct":"L1JVkdLcO3Bggg5MMJAEGw==","iv":"989fd9bc8ff182cf540ef36e72ab4b48","s":"365e6c6cafdee541"}', NULL, '2023-11-20 06:31:25'),
(17, 59, NULL, 'Harry', 'Potter', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '60 Yarra Street', 'Rocklyn', 'VIC', '3364', '53501756', '0455678293', 'harry.potter@gmail.com', 'potterh', '{"ct":"L1JVkdLcO3Bggg5MMJAEGw==","iv":"989fd9bc8ff182cf540ef36e72ab4b48","s":"365e6c6cafdee541"}', NULL, '2023-11-20 07:09:57'),
(22, 59, NULL, 'Hermione', 'Granger', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '86 Shaw Drive', 'VIC', '3465', '53666640', '0419349268', 'hermione.granger@gmail.com', 'grangerh', '{"ct":"L1JVkdLcO3Bggg5MMJAEGw==","iv":"989fd9bc8ff182cf540ef36e72ab4b48","s":"365e6c6cafdee541"}', NULL, '2023-11-20 07:15:35'),
(23, 59, NULL, 'Draco', 'Malfoy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '31 Larissa Court', 'Colignan', 'VIC', '3464', '53857486', '0419285723', '', 'draco.malfoy.gmail.com', '{"ct":"L1JVkdLcO3Bggg5MMJAEGw==","iv":"989fd9bc8ff182cf540ef36e72ab4b48","s":"365e6c6cafdee541"}', NULL, '2023-11-20 07:15:35'),
(24, 59, NULL, 'Severus', 'Snape', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '85 McLachlan Street', 'Remlaw', 'VIC', '3401', '53393767', '0456674890', 'severus.snape@gmail.com', 'snapes', '{"ct":"L1JVkdLcO3Bggg5MMJAEGw==","iv":"989fd9bc8ff182cf540ef36e72ab4b48","s":"365e6c6cafdee541"}', NULL, '2023-11-20 07:19:19'),
(25, 59, NULL, 'Seamus', 'Finigan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5 Fitzroy Street', 'Golden Point', 'VIC', '3350', '53269950', '0456474990', 'seamus.finigan@gmail.com', 'finigans', '{"ct":"L1JVkdLcO3Bggg5MMJAEGw==","iv":"989fd9bc8ff182cf540ef36e72ab4b48","s":"365e6c6cafdee541"}', NULL, '2023-11-20 07:20:09'),
(26, 59, NULL, 'Rubeus', 'Hagrid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '18 Sullivan Court', 'Curyo', 'VIC', '3483', '53581632', '0420346783', 'hagridr@gmail.com', 'hagridr', '{"ct":"L1JVkdLcO3Bggg5MMJAEGw==","iv":"989fd9bc8ff182cf540ef36e72ab4b48","s":"365e6c6cafdee541"}', NULL, '2023-11-20 08:10:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `business_name` (`business_name`),
  ADD KEY `surname` (`surname`),
  ADD KEY `abn` (`abn`),
  ADD KEY `structure` (`structure`),
  ADD KEY `suburb` (`suburb`),
  ADD KEY `state` (`state`),
  ADD KEY `postcode` (`postcode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

/*****************************************************************************************************************************************************/
/*****************************************************************************************************************************************************/
/*****************************************************************************************************************************************************/
/*****************************************************************************************************************************************************/

-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 23, 2023 at 10:31 PM
-- Server version: 8.0.35-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `find_a_tradie`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_trades`
--

CREATE TABLE `additional_trades` (
  `id` int UNSIGNED NOT NULL,
  `member_id` int NOT NULL,
  `trade_id` int NOT NULL
);

--
-- Dumping data for table `additional_trades`
--

INSERT INTO `additional_trades` (`id`, `member_id`, `trade_id`) VALUES
(48, 1, 21),
(49, 1, 24),
(50, 1, 29),
(51, 1, 31),
(52, 1, 30),
(53, 1, 52),
(54, 1, 54),
(55, 1, 35);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_trades`
--
ALTER TABLE `additional_trades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `trade_id` (`trade_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_trades`
--
ALTER TABLE `additional_trades`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

 	
/*****************************************************************************************************************************************************/
/*****************************************************************************************************************************************************/
/*****************************************************************************************************************************************************/
/*****************************************************************************************************************************************************/

-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2023 at 05:05 PM
-- Server version: 8.0.35-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `find_a_tradie`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int UNSIGNED NOT NULL,
  `recipient_id` int UNSIGNED NOT NULL,
  `provider_id` int DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `positive` tinyint(1) NOT NULL,
  `description` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `recipient_id`, `provider_id`, `name`, `positive`, `description`, `date_added`, `date_modified`) VALUES
(5, 1, 11, NULL, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec condimentum ut purus ac efficitur.', '2023-11-19 13:00:00', '2023-11-20 08:17:03'),
(6, 1, 12, NULL, 1, 'Vivamus quis sapien volutpat, vehicula sem vitae, venenatis leo. Aenean eget semper lectus. Suspendisse id tellus finibus, vulputate lorem facilisis, ultricies quam.', '2023-11-19 13:00:00', '2023-11-20 08:18:01'),
(7, 1, 25, NULL, 0, 'Aenean vitae justo vel mauris porttitor pellentesque condimentum vitae arcu.', '2023-11-19 13:00:00', '2023-11-20 08:18:56'),
(8, 1, 26, NULL, 1, 'Suspendisse potenti. Vestibulum aliquam turpis eu sem euismod accumsan non quis risus. Donec posuere turpis risus, at vulputate ante mollis ac.', '2023-11-19 13:00:00', '2023-11-20 08:21:34'),
(11, 1, 15, NULL, 0, 'Cras gravida lorem mi, non vulputate neque lacinia quis.', '2023-11-19 13:00:00', '2023-11-20 08:24:29'),
(12, 1, 17, NULL, 1, 'Aenean nisl dui, suscipit id velit non, convallis ornare dui. Etiam consectetur imperdiet neque in maximus.', '2023-11-19 13:00:00', '2023-11-20 08:26:06'),
(13, 1, 22, NULL, 1, 'Proin vehicula nisi ut elit volutpat ornare.', '2023-11-19 13:00:00', '2023-11-20 08:27:38'),
(14, 1, 23, NULL, 0, 'Nulla iaculis dolor sit amet nunc fringilla, eget tristique augue ultricies.', '2023-11-19 13:00:00', '2023-11-20 08:27:38'),
(15, 11, 1, NULL, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua XXXXX.', '2023-11-19 13:00:00', '2023-11-20 10:31:35'),
(16, 12, 1, NULL, 0, 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2023-11-19 13:00:00', '2023-11-20 10:32:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`recipient_id`),
  ADD KEY `tradie_id` (`provider_id`),
  ADD KEY `date_added` (`date_added`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

/*****************************************************************************************************************************************************/
/*****************************************************************************************************************************************************/
/*****************************************************************************************************************************************************/
/*****************************************************************************************************************************************************/

-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 23, 2023 at 10:32 PM
-- Server version: 8.0.35-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 07, 2023 at 06:47 PM
-- Server version: 8.0.35-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `find_a_tradie`
--

-- --------------------------------------------------------

--
-- Table structure for table `advert_spaces`
--

CREATE TABLE `advert_spaces` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `space_code` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `space_description` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cost_per_month` int unsigned NOT NULL DEFAULT '10',
  `app_or_web` varchar(8) NOT NULL DEFAULT 'web',
  PRIMARY KEY (`id`),
  KEY `advert_space_name` (`space_code`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `advert_spaces`
--

INSERT INTO `advert_spaces` (`id`, `space_code`, `space_description`, `cost_per_month`, `app_or_web`) VALUES
(1, 'index1', 'Index page, beside search form', 20, 'web'),
(2, 'login1', 'Login page, beside login form', 10, 'web'),
(3, 'login2', 'Below the login form', 20, 'web'),
(4, 'index2', 'Top of home page', 10, 'web'),
(5, 'account1', 'Top of account page', 50, 'web'),
(6, 'account2', 'Second from top of account page', 50, 'web'),
(19, 'about1', 'Top of about page', 5, 'web'),
(20, 'about', 'Second from top of about page', 10, 'web'),
(21, 'faq1', 'Top of FAQ page', 10, 'web'),
(22, 'faq2', 'Second from top of FAQ page', 10, 'web'),
(23, 'benefit1', 'Top of benefit page', 10, 'web', 'web'),
(24, 'benefit2', 'Second from top of benefit page', 10, 'web'),
(25, 'contact1', 'Top of comtact page', 10, 'web'),
(26, 'contact2', 'Second from top of contact page', 10, 'web'),
(27, 'contact3', 'Second from bottom of contact page', 10, 'web'),
(28, 'contact4', 'Bottom of contact page', 10, 'web');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advert_spaces`
--
ALTER TABLE `advert_spaces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advert_space_name` (`space_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advert_spaces`
--
ALTER TABLE `advert_spaces`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

/*****************************************************************************************************************************************************/
/*****************************************************************************************************************************************************/
/*****************************************************************************************************************************************************/
/*****************************************************************************************************************************************************/

-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 23, 2023 at 10:33 PM
-- Server version: 8.0.35-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `find_a_tradie`
--

-- --------------------------------------------------------

--
-- Table structure for table `adverts`
--

CREATE TABLE `adverts` (
  `id` int UNSIGNED NOT NULL,
  `member_id` int NOT NULL,
  `space_id` int UNSIGNED NOT NULL,
  `text` varchar(600) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image_name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `expiry_date` date NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `clicks` int NOT NULL DEFAULT '0'
);

--
-- Dumping data for table `adverts`
--

INSERT INTO `adverts` (`id`, `member_id`, `space_id`, `text`, `image_name`, `expiry_date`, `date_added`) VALUES
(17, 1, 2, 'Greg\'s Native Landscapes', 'Logo.jpg', '2023-12-31', '2023-11-18 09:18:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adverts`
--
ALTER TABLE `adverts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `space` (`space_id`),
  ADD KEY `member_id` (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adverts`
--
ALTER TABLE `adverts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

/*****************************************************************************************************************************************************/
/*****************************************************************************************************************************************************/
/*****************************************************************************************************************************************************/
/*****************************************************************************************************************************************************/

-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 24, 2023 at 12:15 AM
-- Server version: 8.0.35-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `find_a_tradie`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int UNSIGNED NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `member_id` int UNSIGNED NOT NULL,
  `accepted_by_member_id` int UNSIGNED DEFAULT NULL,
  `trade_id` int UNSIGNED NOT NULL,
  `description` varchar(512) NOT NULL,
  `maximum_budget` int NOT NULL,
  `size` varchar(16) NOT NULL,
  `urgent` tinyint(1) NOT NULL DEFAULT '0',
  `completed` tinyint(1) NOT NULL DEFAULT '0'
);

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `date_added`, `member_id`, `accepted_by_member_id`, `trade_id`, `description`, `maximum_budget`, `size`, `urgent`, `completed`) VALUES
(1, '2023-11-22 09:39:24', 11, 0, 52, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 6000, 'Up to 50', 1, 0),
(2, '2023-11-22 09:39:24', 12, 0, 52, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.', 5001, 'Up to 50', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `date_added` (`date_added`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `trade_id` (`trade_id`),
  ADD KEY `completed` (`completed`),
  ADD KEY `accepted_by_member_id` (`accepted_by_member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


/*****************************************************************************************************************************************************/
/*****************************************************************************************************************************************************/
/*****************************************************************************************************************************************************/
/*****************************************************************************************************************************************************/

CREATE TABLE `config` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int DEFAULT NULL,
  `advert_id` int DEFAULT NULL,
  `purpose` varchar(24) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `member_id_UNIQUE` (`member_id`),
  UNIQUE KEY `advert_id_UNIQUE` (`advert_id`),
  UNIQUE KEY `purpose_UNIQUE` (`purpose`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `config` (`member_id`, `advert_id`, `purpose`) VALUES (1, 2, 'XXXX');
