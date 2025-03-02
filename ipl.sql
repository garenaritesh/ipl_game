-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2025 at 08:10 PM
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
-- Database: `ipl`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin`, `password`) VALUES
(1, 'auctionbapp', 'auctionbapp2007');

-- --------------------------------------------------------

--
-- Table structure for table `auction_panel`
--

CREATE TABLE `auction_panel` (
  `ap_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `team_email` varchar(250) NOT NULL,
  `budget` varchar(300) NOT NULL DEFAULT '100',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(300) NOT NULL DEFAULT 'On'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `live_auction`
--

CREATE TABLE `live_auction` (
  `auction_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `player_name` varchar(300) NOT NULL,
  `player_pic` text NOT NULL,
  `player_cate` varchar(300) NOT NULL,
  `price` int(100) NOT NULL,
  `status` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `live_players`
--

CREATE TABLE `live_players` (
  `live_player_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `player_name` varchar(300) NOT NULL,
  `player_pic` text NOT NULL,
  `base_price` text NOT NULL,
  `category` text NOT NULL,
  `retain_team` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `live_players`
--

INSERT INTO `live_players` (`live_player_id`, `player_id`, `player_name`, `player_pic`, `base_price`, `category`, `retain_team`) VALUES
(1, 17, 'Virat Kohli', '2.avif', '2', 'Bat', 3),
(2, 18, 'Rohit Sharma', '6.avif', '2', 'Bat', 5),
(3, 20, 'Hardik Pandya', '54.avif', '2', 'AR', 5),
(4, 24, 'Ruturaj Gaikwad', '102.avif', '1', 'Bat', 4),
(5, 25, 'M.S Dhoni', '57.avif', '2', 'WK', 4),
(6, 26, 'Devon Conway', '601.avif', '1', 'WK', 4),
(7, 27, 'Rachin Ravindra', '724.avif', '1', 'AR', 4),
(8, 28, 'Rahul Tripathi', '188.avif', '2', 'WK', 4),
(9, 29, 'Ravichandran Ashwin', 'ravi.avif', '2', 'AR', 4),
(10, 30, 'Vijay Shankar', '61.avif', '2', 'AR', 4),
(11, 31, 'Sam Curran', '138.avif', '2', 'AR', 4),
(12, 32, 'Deepak hooda', '', '1', 'AR', 4),
(13, 33, 'Kamlesh Nagarkothi', '', '1', 'AR', 4),
(14, 34, 'Ravindra Jadeja', '46.avif', '2', 'AR', 4),
(15, 35, 'Shivam Dube', '211.avif', '2', 'AR', 4),
(16, 36, 'Khaleel Ahmed', '8.avif', '2', 'Bow', 4),
(17, 37, 'Noor Ahmed', '975.avif', '2', 'Bow', 4),
(18, 38, 'Mukesh Choudary', '970.avif', '1', 'Bow', 4),
(19, 39, 'Gurjapneet Shingh ', '', '1', 'Bow', 4),
(20, 40, 'Nathen Elis', '', '1', 'Bow', 4),
(21, 41, 'Shreyash Gopal ', '192.avif', '2', 'Bow', 4),
(22, 42, 'Mathesa Pathirana', '1014.avif', '2', 'Bow', 4),
(23, 43, 'K.L Rahul ', '1125_compress.avif', '2', 'WK', 10),
(24, 44, 'Harry Brook ', '', '1', 'Bat', 10),
(25, 45, 'Jake - Fraser Macgurk', '3115.avif', '2', 'Bat', 10),
(26, 46, 'Karun Nair', '', '2', 'Bat', 10),
(27, 47, 'Faf Du Plesis ', '94.avif', '2', 'Bat', 3),
(28, 48, 'Abhishek Porel ', '1580.avif', '2', 'Bat', 10),
(29, 49, 'Tristan Stubs ', '1017.avif', '2', 'AR', 10),
(30, 50, 'Shubman Gill ', '62.avif', '2', 'Bat', 7),
(31, 51, 'Jos Butler', '182.avif', '2', 'WK', 7),
(32, 52, 'Kumar Khusagra ', '', '1', 'WK', 7),
(33, 53, 'Anuj Rawat ', '534.avif', '1', 'WK', 7),
(34, 54, 'Sherfane Ratherford', '', '1', 'Bat', 7),
(35, 55, 'Glenn Phillips ', '635.avif', '2', 'Bat', 7),
(36, 56, 'Nishant Shindu ', '', '1', 'AR', 7),
(37, 57, 'Abhinav Manohar', '', '1', 'Bat', 7),
(38, 58, 'David Miller ', '128.avif', '2', 'Bat', 7),
(39, 59, 'Mahipal Lomror', '184.avif', '2', 'AR', 7),
(40, 61, 'Washington Sundar', '20.avif', '1', 'AR', 7),
(41, 62, 'Mohd. Arshad Khan', '', '1', 'AR', 7),
(42, 63, 'Sai Kishor', '544.avif', '2', 'AR', 7),
(43, 64, 'Jayant Yadhav ', '165.avif', '2', 'AR', 7),
(44, 65, 'Karim Janat ', '', '2', 'AR', 7),
(45, 66, 'Sai Sudarshan ', '976.avif', '2', 'AR', 7),
(46, 67, 'Sharukh Khan ', '', '1', 'AR', 7),
(47, 68, 'Kagiso Rabada', '116.avif', '2', 'Bow', 7),
(48, 69, 'Prasidh Krishna ', '', '2', 'Bow', 7),
(49, 70, 'Manav Suthar ', '2443.avif', '1', 'Bow', 7),
(50, 71, 'Geraldo Coetzee', '2535.avif', '1', 'Bow', 7),
(51, 72, 'Gurnoor Shingh Brar ', '', '1', 'Bow', 7),
(52, 73, 'Ishant Sharma ', '50.avif', '2', 'Bow', 7),
(53, 74, 'Kulwant Khejroliya ', '', '1', 'Bow', 7),
(54, 75, 'Rahul Tewatia ', '120.avif', '2', 'Bow', 7),
(55, 76, 'Rashid Khan ', '218.avif', '2', 'Bow', 7),
(56, 77, 'Rinku Shingh ', '152.avif', '2', 'Bat', 9),
(57, 78, 'Quinton De Kock', '170.avif', '2', 'WK', 9),
(58, 79, 'Rahmanullah Gurbaz ', '641.avif', '2', 'WK', 9),
(59, 80, 'Angkrish Raghuwanshi ', '787.avif', '2', 'Bat', 9),
(60, 81, 'Rovman Powell ', '329.avif', '2', 'Bat', 9),
(61, 82, 'Manish Pandey ', '16.avif', '2', 'Bat', 9),
(62, 83, 'Ajinkya Rahane ', '135.webp', '2', 'Bat', 9),
(63, 84, 'Venkatesh Iyer ', '584.avif', '2', 'AR', 9),
(64, 85, 'Anukul Roy ', '160.avif', '2', 'AR', 9),
(65, 86, 'Moen Ali ', '206.avif', '2', 'AR', 9),
(66, 87, 'Ramandeep Shingh ', '991.avif', '2', 'AR', 9),
(67, 88, 'Andre Russel ', '141.avif', '2', 'AR', 9),
(68, 89, 'Anrich Nortje ', '', '1', 'Bow', 9),
(69, 90, 'Vaibhav Arora', '583.avif', '1', 'Bow', 9),
(70, 91, 'Mayank Markende ', '87.avif', '2', 'Bow', 9),
(71, 92, 'Spence Johnsan ', '', '2', 'Bow', 9),
(72, 93, 'Umran Malik ', '637.avif', '2', 'Bow', 9),
(73, 94, 'Harshit Rana ', '1013.avif', '2', 'Bow', 9),
(74, 95, 'Sunil Narine ', '156.avif', '2', 'Bow', 9),
(75, 96, 'Varun Chakravarthy', '140.avif', '2', 'Bow', 9),
(76, 97, 'Rishab Pant ', '18.avif', '2', 'WK', 8),
(77, 98, 'Aiden Markram ', '287.avif', '2', 'AR', 8),
(78, 99, 'Aryan Juval ', '', '1', 'WK', 8),
(79, 100, 'Himmat Shingh ', '', '1', 'Bat', 8),
(80, 101, 'Matheve Breeatzke', '', '2', 'Bat', 8),
(81, 102, 'Nicholas Pooran', '136.avif', '2', 'WK', 8),
(82, 104, 'Mitchell Marsh', '40.avif', '2', 'AR', 8),
(83, 105, 'Abdul Shamad', '', '1', 'AR', 8),
(84, 106, 'Shahbaz Ahmed', '', '1', 'AR', 8),
(85, 107, 'Youraj Choudhary ', '', '1', 'AR', 8),
(86, 108, 'Arshin Kulkarni', '2788.avif', '1', 'AR', 8),
(87, 109, 'Ayush Badoni', '985.avif', '2', 'AR', 8),
(88, 110, 'Avesh Khan ', '109.avif', '1', 'Bow', 8),
(89, 111, 'Akash Deep ', '1007.avif', '1', 'Bow', 8),
(90, 112, 'M. Shiddarth ', '532.avif', '1', 'Bow', 8),
(91, 113, 'Digvesh Shingh', '', '1', 'Bow', 8),
(92, 114, 'Akash Shingh', '', '1', 'Bow', 8),
(93, 115, 'Shamar Josef', '', '1', 'Bow', 8),
(94, 116, 'Mayank Yadav', '987.avif', '1', 'Bow', 8),
(95, 117, 'Mohsin Khan ', '541.avif', '1', 'Bow', 8),
(96, 118, 'Ravi Bishnoi ', '520.avif', '2', 'Bow', 8),
(97, 119, 'Suryakumar Yadav', '174.avif', '2', 'Bat', 5),
(98, 120, 'Robin Nimz', '', '1', 'WK', 5),
(99, 121, 'Ryan ricketon ', '', '1', 'WK', 5),
(100, 122, 'Tilak Verma', '993.avif', '2', 'Bat', 5),
(101, 123, 'Naman Dhir ', '3107.avif', '2', 'AR', 5),
(102, 124, 'Will Jacks ', '1941.avif', '2', 'AR', 5),
(103, 125, 'Mitchell Santner ', '75.avif', '2', 'AR', 5),
(104, 126, 'Yugnush Puthar', '', '1', 'AR', 5),
(105, 127, 'Trent Boult ', '66.avif', '2', 'Bow', 5),
(106, 128, 'Karn Sharma', '98.avif', '2', 'Bow', 5),
(107, 129, 'Deepak Chahar ', '91.avif', '2', 'Bow', 5),
(108, 130, 'Ashwini Kumar ', '', '1', 'Bow', 5),
(109, 131, 'Reece Topley ', '574.avif', '2', 'Bow', 5),
(110, 132, 'Arjun Tendulkar ', '585.avif', '1', 'Bow', 5),
(111, 133, 'Jasprit Bumrah ', '9.avif', '2', 'Bow', 5),
(112, 134, 'Shreyash Iyer ', '12.avif', '2', 'Bat', 12),
(113, 135, 'Nehal Wadhera ', '', '1', 'Bat', 12),
(114, 136, 'Vishnu Vinod ', '', '1', 'WK', 12),
(115, 137, 'Josh Inglis ', '', '2', 'WK', 12),
(116, 138, 'Harnoor Parnu', '', '2', 'Bat', 12),
(117, 139, 'Pharbusimran Shingh ', '137.avif', '2', 'WK', 12),
(118, 140, 'Shashank Shing ', '191.avif', '2', 'Bat', 12),
(119, 141, 'Marcus Stoinis ', '23.avif', '2', 'AR', 12),
(120, 142, 'Glenn Maxwell', '28.avif', '2', 'AR', 12),
(121, 143, 'Harpreet Brar ', '130.avif', '1', 'AR', 12),
(122, 144, 'Marco jansen ', '586.avif', '2', 'AR', 12),
(123, 145, 'Mhusheer khan', '', '1', 'AR', 12),
(124, 146, 'Suryansh Sedge ', '', '1', 'AR', 12),
(125, 147, 'Arshdeep Shingh', '125.avif', '2', 'Bow', 12),
(126, 148, 'Yuzendra Chahal', '10.avif', '2', 'Bow', 12),
(127, 149, 'Vyashak Vijay kumar ', '', '1', 'Bow', 12),
(128, 150, 'Yash Thakur ', '1550.avif', '1', 'Bow', 12),
(129, 151, 'lockie ferguson', '69.avif', '2', 'Bow', 12),
(130, 152, 'Kuldeep Sen ', '', '1', 'Bow', 12),
(131, 153, 'Pravin Dubery ', '', '1', 'Bow', 12),
(132, 154, 'Sanju Samson ', '190.avif', '2', 'WK', 11),
(133, 155, 'Shubham Dubey ', '3112.avif', '1', 'Bat', 11),
(134, 156, 'Vaibhav Suryavanshi ', 'vaibhav.avif', '1', 'Bat', 11),
(135, 157, 'Kunal Rathore ', '1540.avif', '1', 'WK', 11),
(136, 158, 'Shimron Hetmayer', '210.avif', '2', 'Bat', 11),
(137, 159, 'Yashasvi Jaiswal ', '533.avif', '2', 'Bat', 11),
(138, 160, 'Dhruv Jurel ', '1004.avif', '2', 'WK', 11),
(139, 161, 'Riyan Parag ', '189.avif', '2', 'Bat', 11),
(140, 162, 'Nitish Rana ', '148.avif', '2', 'AR', 11),
(141, 163, 'Yudhvir Shingh', '', '1', 'AR', 11),
(142, 164, 'Jofra Archer ', '181.avif', '2', 'Bow', 11),
(143, 165, 'Ben Stokes', '177.avif', '2', 'AR', 0),
(144, 166, 'Maheesh Theekshana', '629.avif', '2', 'Bow', 11),
(145, 167, 'Wanindu Hasranga ', '377.avif', '2', 'Bow', 11),
(146, 168, 'Akash Madhwal', '1045.avif', '2', 'Bow', 11),
(147, 169, 'Tushar Deshpande', '539.avif', '2', 'Bow', 11),
(148, 170, 'Fazalhaq Farooqi', '', '1', 'Bow', 11),
(149, 171, 'Kwena Maphaka', '801.avif', '1', 'Bow', 11),
(150, 172, 'Ashok Sharma', '', '1', 'Bow', 11),
(151, 173, 'Sandeep Sharma', '220.avif', '2', 'Bow', 11),
(152, 174, 'Rajat Patidar ', '597.avif', '2', 'Bat', 3),
(153, 175, 'Phil Salt ', '1220.avif', '2', 'WK', 3),
(154, 176, 'Jitesh sharma', '1000.avif', '2', 'WK', 3),
(155, 177, 'Devdutt Padikal ', '200.avif', '1', 'Bat', 3),
(156, 178, 'Swatik Chikara', '', '1', 'Bat', 3),
(157, 179, 'Liam Livingstone ', '183.avif', '2', 'AR', 3),
(158, 180, 'Krunal Pandya ', '17.avif', '2', 'AR', 3),
(159, 181, 'Tim David ', '636.avif', '2', 'AR', 3),
(160, 182, 'Swapnil Shingh ', '1483.avif', '2', 'AR', 3),
(161, 183, 'Romorio Shepherd ', '371.avif', '1', 'AR', 3),
(162, 184, 'Jacob Bhethell', '', '1', 'AR', 3),
(163, 185, 'Josh Hazlewood', '857.webp', '2', 'Bow', 3),
(164, 186, 'Rashikh Dar ', '172.avif', '1', 'Bow', 3),
(165, 187, 'Suyash Sharma', '', '1', 'Bow', 3),
(166, 188, 'Bhuvneshwar Kumar ', '15.avif', '2', 'Bow', 3),
(167, 189, 'Nuwan Thushara ', '813.avif', '1', 'Bow', 3),
(168, 191, 'Lungi Ngidi', '3746.webp', '2', 'Bow', 3),
(169, 192, 'Abhinandan Shingh', '', '1', 'Bow', 3),
(170, 193, 'Mohit Rathe ', '', '1', 'Bow', 3),
(171, 194, 'Yash Dayal ', '978.avif', '2', 'Bow', 3),
(172, 195, 'Ishan Kishan ', '164.avif', '2', 'WK', 6),
(173, 196, 'Atharva Taide ', '', '1', 'Bat', 6),
(174, 197, 'Abhinav Manhor ', '', '1', 'Bat', 6),
(175, 198, 'Aniket Verma', '', '1', 'Bat', 6),
(176, 199, 'Sachin Baby', '', '1', 'Bat', 6),
(177, 200, 'Heinrich Klaasen', '202.avif', '2', 'WK', 6),
(178, 201, 'Travis Head ', '37.avif', '2', 'Bat', 6),
(179, 202, 'Harshal Pate;', '114.avif', '2', 'AR', 6),
(180, 203, 'Kamindu Mendos', '', '1', 'AR', 6),
(181, 204, 'Abhishek Sharma', '212.avif', '2', 'AR', 6),
(182, 205, 'Nitish Kumar Ready', '1944.avif', '2', 'AR', 6),
(183, 206, 'Mohammad Shami', '47.avif', '2', 'Bow', 6),
(184, 207, 'Rahul Chahar ', '171.avif', '2', 'Bow', 6),
(185, 208, 'Adam Zampa', '958.avif', '2', 'Bow', 6),
(186, 209, 'Simarjeet Shingh ', '', '1', 'Bow', 6),
(187, 210, 'Jaydev Unadkatt ', '180.avif', '2', 'Bow', 6),
(188, 211, 'Eshan Malinga ', '', '1', 'Bow', 6),
(189, 212, 'Pat Cummins ', '33.avif', '2', 'Bow', 6),
(190, 213, 'Sameer Rizvi', '1229.avif', '1', 'AR', 10),
(191, 214, 'Ashutosh Sharma', '', '1', 'AR', 10),
(192, 215, 'Darshan Nalkande ', '', '1', 'AR', 10),
(193, 216, 'Ajay Mandal ', '', '1', 'AR', 10),
(194, 217, 'Tripurna Vijay ', '', '1', 'Bow', 10),
(195, 218, 'Axar Patel ', '110.avif', '2', 'AR', 10),
(196, 219, 'Mitchell Starc', '31.avif', '2', 'Bow', 10),
(197, 220, 'T Natarajan ', '224.avif', '2', 'Bow', 10),
(198, 221, 'Mohit sharma', '100.avif', '2', 'Bow', 10),
(199, 222, 'Mohit Sharma', '1462.avif', '2', 'Bow', 10),
(200, 223, 'Kuldeep Yadav ', '14.avif', '2', 'Bow', 10),
(201, 224, 'Dushmantha Chameers', '', '1', 'Bow', 10);

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `player_id` int(11) NOT NULL,
  `player_name` varchar(300) NOT NULL,
  `player_pic` text NOT NULL,
  `base_price` varchar(300) NOT NULL,
  `category` varchar(300) NOT NULL,
  `retain_team` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`player_id`, `player_name`, `player_pic`, `base_price`, `category`, `retain_team`) VALUES
(17, 'Virat Kohli', '2.avif', '2', 'Bat', 3),
(18, 'Rohit Sharma', '6.avif', '2', 'Bat', 5),
(20, 'Hardik Pandya', '54.avif', '2', 'AR', 5),
(24, 'Ruturaj Gaikwad', '102.avif', '1', 'Bat', 4),
(25, 'M.S Dhoni', '57.avif', '2', 'WK', 4),
(26, 'Devon Conway', '601.avif', '1', 'WK', 4),
(27, 'Rachin Ravindra', '724.avif', '1', 'AR', 4),
(28, 'Rahul Tripathi', '188.avif', '2', 'WK', 4),
(29, 'Ravichandran Ashwin', 'ravi.avif', '2', 'AR', 4),
(30, 'Vijay Shankar', '61.avif', '2', 'AR', 4),
(31, 'Sam Curran', '138.avif', '2', 'AR', 4),
(32, 'Deepak hooda', '', '1', 'AR', 4),
(33, 'Kamlesh Nagarkothi', '', '1', 'AR', 4),
(34, 'Ravindra Jadeja', '46.avif', '2', 'AR', 4),
(35, 'Shivam Dube', '211.avif', '2', 'AR', 4),
(36, 'Khaleel Ahmed', '8.avif', '2', 'Bow', 4),
(37, 'Noor Ahmed', '975.avif', '2', 'Bow', 4),
(38, 'Mukesh Choudary', '970.avif', '1', 'Bow', 4),
(39, 'Gurjapneet Shingh ', '', '1', 'Bow', 4),
(40, 'Nathen Elis', '', '1', 'Bow', 4),
(41, 'Shreyash Gopal ', '192.avif', '2', 'Bow', 4),
(42, 'Mathesa Pathirana', '1014.avif', '2', 'Bow', 4),
(43, 'K.L Rahul ', '1125_compress.avif', '2', 'WK', 10),
(44, 'Harry Brook ', '', '1', 'Bat', 10),
(45, 'Jake - Fraser Macgurk', '3115.avif', '2', 'Bat', 10),
(46, 'Karun Nair', '', '2', 'Bat', 10),
(47, 'Faf Du Plesis ', '94.avif', '2', 'Bat', 3),
(48, 'Abhishek Porel ', '1580.avif', '2', 'Bat', 10),
(49, 'Tristan Stubs ', '1017.avif', '2', 'AR', 10),
(50, 'Shubman Gill ', '62.avif', '2', 'Bat', 7),
(51, 'Jos Butler', '182.avif', '2', 'WK', 7),
(52, 'Kumar Khusagra ', '', '1', 'WK', 7),
(53, 'Anuj Rawat ', '534.avif', '1', 'WK', 7),
(54, 'Sherfane Ratherford', '', '1', 'Bat', 7),
(55, 'Glenn Phillips ', '635.avif', '2', 'Bat', 7),
(56, 'Nishant Shindu ', '', '1', 'AR', 7),
(57, 'Abhinav Manohar', '', '1', 'Bat', 7),
(58, 'David Miller ', '128.avif', '2', 'Bat', 7),
(59, 'Mahipal Lomror', '184.avif', '2', 'AR', 7),
(61, 'Washington Sundar', '20.avif', '1', 'AR', 7),
(62, 'Mohd. Arshad Khan', '', '1', 'AR', 7),
(63, 'Sai Kishor', '544.avif', '2', 'AR', 7),
(64, 'Jayant Yadhav ', '165.avif', '2', 'AR', 7),
(65, 'Karim Janat ', '', '2', 'AR', 7),
(66, 'Sai Sudarshan ', '976.avif', '2', 'AR', 7),
(67, 'Sharukh Khan ', '', '1', 'AR', 7),
(68, 'Kagiso Rabada', '116.avif', '2', 'Bow', 7),
(69, 'Prasidh Krishna ', '', '2', 'Bow', 7),
(70, 'Manav Suthar ', '2443.avif', '1', 'Bow', 7),
(71, 'Geraldo Coetzee', '2535.avif', '1', 'Bow', 7),
(72, 'Gurnoor Shingh Brar ', '', '1', 'Bow', 7),
(73, 'Ishant Sharma ', '50.avif', '2', 'Bow', 7),
(74, 'Kulwant Khejroliya ', '', '1', 'Bow', 7),
(75, 'Rahul Tewatia ', '120.avif', '2', 'Bow', 7),
(76, 'Rashid Khan ', '218.avif', '2', 'Bow', 7),
(77, 'Rinku Shingh ', '152.avif', '2', 'Bat', 9),
(78, 'Quinton De Kock', '170.avif', '2', 'WK', 9),
(79, 'Rahmanullah Gurbaz ', '641.avif', '2', 'WK', 9),
(80, 'Angkrish Raghuwanshi ', '787.avif', '2', 'Bat', 9),
(81, 'Rovman Powell ', '329.avif', '2', 'Bat', 9),
(82, 'Manish Pandey ', '16.avif', '2', 'Bat', 9),
(83, 'Ajinkya Rahane ', '135.webp', '2', 'Bat', 9),
(84, 'Venkatesh Iyer ', '584.avif', '2', 'AR', 9),
(85, 'Anukul Roy ', '160.avif', '2', 'AR', 9),
(86, 'Moen Ali ', '206.avif', '2', 'AR', 9),
(87, 'Ramandeep Shingh ', '991.avif', '2', 'AR', 9),
(88, 'Andre Russel ', '141.avif', '2', 'AR', 9),
(89, 'Anrich Nortje ', '', '1', 'Bow', 9),
(90, 'Vaibhav Arora', '583.avif', '1', 'Bow', 9),
(91, 'Mayank Markende ', '87.avif', '2', 'Bow', 9),
(92, 'Spence Johnsan ', '', '2', 'Bow', 9),
(93, 'Umran Malik ', '637.avif', '2', 'Bow', 9),
(94, 'Harshit Rana ', '1013.avif', '2', 'Bow', 9),
(95, 'Sunil Narine ', '156.avif', '2', 'Bow', 9),
(96, 'Varun Chakravarthy', '140.avif', '2', 'Bow', 9),
(97, 'Rishab Pant ', '18.avif', '2', 'WK', 8),
(98, 'Aiden Markram ', '287.avif', '2', 'AR', 8),
(99, 'Aryan Juval ', '', '1', 'WK', 8),
(100, 'Himmat Shingh ', '', '1', 'Bat', 8),
(101, 'Matheve Breeatzke', '', '2', 'Bat', 8),
(102, 'Nicholas Pooran', '136.avif', '2', 'WK', 8),
(104, 'Mitchell Marsh', '40.avif', '2', 'AR', 8),
(105, 'Abdul Shamad', '', '1', 'AR', 8),
(106, 'Shahbaz Ahmed', '', '1', 'AR', 8),
(107, 'Youraj Choudhary ', '', '1', 'AR', 8),
(108, 'Arshin Kulkarni', '2788.avif', '1', 'AR', 8),
(109, 'Ayush Badoni', '985.avif', '2', 'AR', 8),
(110, 'Avesh Khan ', '109.avif', '1', 'Bow', 8),
(111, 'Akash Deep ', '1007.avif', '1', 'Bow', 8),
(112, 'M. Shiddarth ', '532.avif', '1', 'Bow', 8),
(113, 'Digvesh Shingh', '', '1', 'Bow', 8),
(114, 'Akash Shingh', '', '1', 'Bow', 8),
(115, 'Shamar Josef', '', '1', 'Bow', 8),
(116, 'Mayank Yadav', '987.avif', '1', 'Bow', 8),
(117, 'Mohsin Khan ', '541.avif', '1', 'Bow', 8),
(118, 'Ravi Bishnoi ', '520.avif', '2', 'Bow', 8),
(119, 'Suryakumar Yadav', '174.avif', '2', 'Bat', 5),
(120, 'Robin Nimz', '', '1', 'WK', 5),
(121, 'Ryan ricketon ', '', '1', 'WK', 5),
(122, 'Tilak Verma', '993.avif', '2', 'Bat', 5),
(123, 'Naman Dhir ', '3107.avif', '2', 'AR', 5),
(124, 'Will Jacks ', '1941.avif', '2', 'AR', 5),
(125, 'Mitchell Santner ', '75.avif', '2', 'AR', 5),
(126, 'Yugnush Puthar', '', '1', 'AR', 5),
(127, 'Trent Boult ', '66.avif', '2', 'Bow', 5),
(128, 'Karn Sharma', '98.avif', '2', 'Bow', 5),
(129, 'Deepak Chahar ', '91.avif', '2', 'Bow', 5),
(130, 'Ashwini Kumar ', '', '1', 'Bow', 5),
(131, 'Reece Topley ', '574.avif', '2', 'Bow', 5),
(132, 'Arjun Tendulkar ', '585.avif', '1', 'Bow', 5),
(133, 'Jasprit Bumrah ', '9.avif', '2', 'Bow', 5),
(134, 'Shreyash Iyer ', '12.avif', '2', 'Bat', 12),
(135, 'Nehal Wadhera ', '', '1', 'Bat', 12),
(136, 'Vishnu Vinod ', '', '1', 'WK', 12),
(137, 'Josh Inglis ', '', '2', 'WK', 12),
(138, 'Harnoor Parnu', '', '2', 'Bat', 12),
(139, 'Pharbusimran Shingh ', '137.avif', '2', 'WK', 12),
(140, 'Shashank Shing ', '191.avif', '2', 'Bat', 12),
(141, 'Marcus Stoinis ', '23.avif', '2', 'AR', 12),
(142, 'Glenn Maxwell', '28.avif', '2', 'AR', 12),
(143, 'Harpreet Brar ', '130.avif', '1', 'AR', 12),
(144, 'Marco jansen ', '586.avif', '2', 'AR', 12),
(145, 'Mhusheer khan', '', '1', 'AR', 12),
(146, 'Suryansh Sedge ', '', '1', 'AR', 12),
(147, 'Arshdeep Shingh', '125.avif', '2', 'Bow', 12),
(148, 'Yuzendra Chahal', '10.avif', '2', 'Bow', 12),
(149, 'Vyashak Vijay kumar ', '', '1', 'Bow', 12),
(150, 'Yash Thakur ', '1550.avif', '1', 'Bow', 12),
(151, 'lockie ferguson', '69.avif', '2', 'Bow', 12),
(152, 'Kuldeep Sen ', '', '1', 'Bow', 12),
(153, 'Pravin Dubery ', '', '1', 'Bow', 12),
(154, 'Sanju Samson ', '190.avif', '2', 'WK', 11),
(155, 'Shubham Dubey ', '3112.avif', '1', 'Bat', 11),
(156, 'Vaibhav Suryavanshi ', 'vaibhav.avif', '1', 'Bat', 11),
(157, 'Kunal Rathore ', '1540.avif', '1', 'WK', 11),
(158, 'Shimron Hetmayer', '210.avif', '2', 'Bat', 11),
(159, 'Yashasvi Jaiswal ', '533.avif', '2', 'Bat', 11),
(160, 'Dhruv Jurel ', '1004.avif', '2', 'WK', 11),
(161, 'Riyan Parag ', '189.avif', '2', 'Bat', 11),
(162, 'Nitish Rana ', '148.avif', '2', 'AR', 11),
(163, 'Yudhvir Shingh', '', '1', 'AR', 11),
(164, 'Jofra Archer ', '181.avif', '2', 'Bow', 11),
(165, 'Ben Stokes', '177.avif', '2', 'AR', 0),
(166, 'Maheesh Theekshana', '629.avif', '2', 'Bow', 11),
(167, 'Wanindu Hasranga ', '377.avif', '2', 'Bow', 11),
(168, 'Akash Madhwal', '1045.avif', '2', 'Bow', 11),
(169, 'Tushar Deshpande', '539.avif', '2', 'Bow', 11),
(170, 'Fazalhaq Farooqi', '', '1', 'Bow', 11),
(171, 'Kwena Maphaka', '801.avif', '1', 'Bow', 11),
(172, 'Ashok Sharma', '', '1', 'Bow', 11),
(173, 'Sandeep Sharma', '220.avif', '2', 'Bow', 11),
(174, 'Rajat Patidar ', '597.avif', '2', 'Bat', 3),
(175, 'Phil Salt ', '1220.avif', '2', 'WK', 3),
(176, 'Jitesh sharma', '1000.avif', '2', 'WK', 3),
(177, 'Devdutt Padikal ', '200.avif', '1', 'Bat', 3),
(178, 'Swatik Chikara', '', '1', 'Bat', 3),
(179, 'Liam Livingstone ', '183.avif', '2', 'AR', 3),
(180, 'Krunal Pandya ', '17.avif', '2', 'AR', 3),
(181, 'Tim David ', '636.avif', '2', 'AR', 3),
(182, 'Swapnil Shingh ', '1483.avif', '2', 'AR', 3),
(183, 'Romorio Shepherd ', '371.avif', '1', 'AR', 3),
(184, 'Jacob Bhethell', '', '1', 'AR', 3),
(185, 'Josh Hazlewood', '857.webp', '2', 'Bow', 3),
(186, 'Rashikh Dar ', '172.avif', '1', 'Bow', 3),
(187, 'Suyash Sharma', '', '1', 'Bow', 3),
(188, 'Bhuvneshwar Kumar ', '15.avif', '2', 'Bow', 3),
(189, 'Nuwan Thushara ', '813.avif', '1', 'Bow', 3),
(191, 'Lungi Ngidi', '3746.webp', '2', 'Bow', 3),
(192, 'Abhinandan Shingh', '', '1', 'Bow', 3),
(193, 'Mohit Rathe ', '', '1', 'Bow', 3),
(194, 'Yash Dayal ', '978.avif', '2', 'Bow', 3),
(195, 'Ishan Kishan ', '164.avif', '2', 'WK', 6),
(196, 'Atharva Taide ', '', '1', 'Bat', 6),
(197, 'Abhinav Manhor ', '', '1', 'Bat', 6),
(198, 'Aniket Verma', '', '1', 'Bat', 6),
(199, 'Sachin Baby', '', '1', 'Bat', 6),
(200, 'Heinrich Klaasen', '202.avif', '2', 'WK', 6),
(201, 'Travis Head ', '37.avif', '2', 'Bat', 6),
(202, 'Harshal Patel', '114.avif', '2', 'AR', 6),
(203, 'Kamindu Mendos', '', '1', 'AR', 6),
(204, 'Abhishek Sharma', '212.avif', '2', 'AR', 6),
(205, 'Nitish Kumar Ready', '1944.avif', '2', 'AR', 6),
(206, 'Mohammad Shami', '47.avif', '2', 'Bow', 6),
(207, 'Rahul Chahar ', '171.avif', '2', 'Bow', 6),
(208, 'Adam Zampa', '958.avif', '2', 'Bow', 6),
(209, 'Simarjeet Shingh ', '', '1', 'Bow', 6),
(210, 'Jaydev Unadkatt ', '180.avif', '2', 'Bow', 6),
(211, 'Eshan Malinga ', '', '1', 'Bow', 6),
(212, 'Pat Cummins ', '33.avif', '2', 'Bow', 6),
(213, 'Sameer Rizvi', '1229.avif', '1', 'AR', 10),
(214, 'Ashutosh Sharma', '', '1', 'AR', 10),
(215, 'Darshan Nalkande ', '', '1', 'AR', 10),
(216, 'Ajay Mandal ', '', '1', 'AR', 10),
(217, 'Tripurna Vijay ', '', '1', 'Bow', 10),
(218, 'Axar Patel ', '110.avif', '2', 'AR', 10),
(219, 'Mitchell Starc', '31.avif', '2', 'Bow', 10),
(220, 'T Natarajan ', '224.avif', '2', 'Bow', 10),
(221, 'Mohit sharma', '100.avif', '2', 'Bow', 10),
(222, 'Mohit Sharma', '1462.avif', '2', 'Bow', 10),
(223, 'Kuldeep Yadav ', '14.avif', '2', 'Bow', 10),
(224, 'Dushmantha Chameers', '', '1', 'Bow', 10);

-- --------------------------------------------------------

--
-- Table structure for table `selected_auction_player`
--

CREATE TABLE `selected_auction_player` (
  `sap_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `player_name` varchar(300) NOT NULL,
  `player_pic` text NOT NULL,
  `base_price` varchar(300) NOT NULL,
  `category` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `bid_amount` text NOT NULL,
  `bid_team_id` int(11) NOT NULL,
  `retain_team` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(300) NOT NULL,
  `team_email` varchar(300) NOT NULL,
  `team_pass` varchar(250) NOT NULL,
  `team_logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `team_email`, `team_pass`, `team_logo`) VALUES
(3, 'Royal Challenger Benglore', 'royalchallengerbenglore@gmail.com', 'Rcb@2016', 'RCBoutline.avif'),
(4, 'Chennai Super Kings', 'cskwinner@gmail.com', 'Csk@2023', 'CSKoutline.avif'),
(5, 'Mumbai Indians', 'mumbaiindians@gmail.com', 'Mumbai@2020', 'MIoutline.avif'),
(6, 'Sunrisers Haidrabad', 'sunrisers@gmail.com', 'SRh@2016', 'SRHoutline.avif'),
(7, 'Gujrat Titans', 'gt@gmail.com', 'Gujrat@1', 'GToutline.avif'),
(8, 'Lucknow super giant', 'lsg2022@gmail.com', 'Lsg@2022', 'LSGoutline.avif'),
(9, 'Kolkata Knigh Riders', 'kkr2014#@gmail.com', 'Kkr@2024', 'KKRoutline.avif'),
(10, 'Delhi Capitals', 'dc@gmail.com', 'DelhiCapitals@2099', 'DCoutline.avif'),
(11, 'Rajasthan Royals', 'rr2008@gmail.com', 'Rr@2008#', 'RRoutline.avif'),
(12, ' Punjab Kings', 'pbks@gmail.com', 'Pbks@2013#', 'PBKSoutline.avif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `auction_panel`
--
ALTER TABLE `auction_panel`
  ADD PRIMARY KEY (`ap_id`);

--
-- Indexes for table `live_auction`
--
ALTER TABLE `live_auction`
  ADD PRIMARY KEY (`auction_id`);

--
-- Indexes for table `live_players`
--
ALTER TABLE `live_players`
  ADD PRIMARY KEY (`live_player_id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`player_id`);

--
-- Indexes for table `selected_auction_player`
--
ALTER TABLE `selected_auction_player`
  ADD PRIMARY KEY (`sap_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `auction_panel`
--
ALTER TABLE `auction_panel`
  MODIFY `ap_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `live_auction`
--
ALTER TABLE `live_auction`
  MODIFY `auction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `live_players`
--
ALTER TABLE `live_players`
  MODIFY `live_player_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `player_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `selected_auction_player`
--
ALTER TABLE `selected_auction_player`
  MODIFY `sap_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
