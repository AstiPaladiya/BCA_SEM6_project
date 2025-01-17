-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2023 at 12:36 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ghost_marketer`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_master`
--

CREATE TABLE `admin_master` (
  `admin_name` varchar(200) NOT NULL,
  `admin_email` varchar(200) NOT NULL,
  `admin_password` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_master`
--

INSERT INTO `admin_master` (`admin_name`, `admin_email`, `admin_password`, `created_at`, `updated_at`) VALUES
('Deep Ganatra', 'ganatradeep9@gmail.com', '$2y$10$Qu.Dko6lTTXkOCCgGg4KLuMKuEGGH4ZVrkLz2nIq.sdym1Y8J9pta', '2022-11-22 18:14:25', '2022-12-01 07:48:28'),
('Asti', 'paladiyaasti@gmail.com', '$2y$10$LFxwL40808jivd1SkxVsUeI3EnUDBb.yQsMLULLSBcxtQ.oXRXgo2', '2022-11-22 18:19:51', '2022-12-02 06:08:25');

-- --------------------------------------------------------

--
-- Table structure for table `assign_marketer`
--

CREATE TABLE `assign_marketer` (
  `id` int(11) NOT NULL,
  `marketer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `comission` varchar(500) DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
  `status` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assign_marketer`
--

INSERT INTO `assign_marketer` (`id`, `marketer_id`, `product_id`, `comission`, `link`, `status`, `created_at`, `updated_at`) VALUES
(3, 3, 7, '10', 'localhost:4000/ghost/view_single_product.php?product_id=7&marketer_id=$2y$10$OmJjXIKv/7NSQLPA9ZSsReHsb9Jw0HDFQQhkFpWt8wQMWypfi49Bq', 'Active', '2023-02-23 09:34:39', '2023-03-01 17:30:10'),
(5, 3, 6, '2', 'localhost:4000/ghost/view_single_product.php?product_id=6&marketer_id=$2y$10$bSwobd8dM2jxuK4XpvD9nelJ6M5M.Oo9kJFyFrQaFcSSxn0aCxCuq', 'Active', '2023-03-05 14:33:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(21, 9, 6, 3, '2023-03-22 13:05:35', '2023-03-22 13:06:05');

-- --------------------------------------------------------

--
-- Table structure for table `category_master`
--

CREATE TABLE `category_master` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `icon` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_master`
--

INSERT INTO `category_master` (`id`, `name`, `icon`, `created_at`, `updated_at`) VALUES
(10, 'Kitchen Appliances', 'logo.png', '2022-12-19 17:27:28', NULL),
(11, 'Home Appliances ', 'logo.png', '2022-12-19 17:27:51', NULL),
(12, 'Electronic Application ', 'logo.png', '2022-12-19 17:28:10', NULL),
(13, 'Entertainment', 'logo.png', '2022-12-19 17:28:28', NULL),
(14, 'Health and Fitness', 'logo.png', '2022-12-19 17:28:58', NULL),
(15, 'Book', 'logo.png', '2022-12-19 17:29:15', NULL),
(16, 'Furniture ', 'logo.png', '2022-12-19 17:29:31', NULL),
(17, 'Transport  Vehicles and Spareparts', 'logo.png', '2022-12-19 17:30:21', NULL),
(18, 'Job', 'logo.png', '2022-12-19 17:31:24', NULL),
(19, 'Services', 'logo.png', '2022-12-19 17:31:40', NULL),
(20, 'Sports Equipment ', 'logo.png', '2022-12-19 17:32:18', NULL),
(21, 'Hobbies', 'logo.png', '2022-12-19 17:32:33', NULL),
(24, 'Advertisement', 'logo.png', '2023-02-23 09:53:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chat_first`
--

CREATE TABLE `chat_first` (
  `id` int(11) NOT NULL,
  `user_first` int(11) DEFAULT NULL,
  `user_second` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat_first`
--

INSERT INTO `chat_first` (`id`, `user_first`, `user_second`, `product_id`, `created_at`, `updated_at`) VALUES
(3, 9, 6, 9, '2023-03-23 12:17:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chat_master`
--

CREATE TABLE `chat_master` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `sender_user_id` int(11) DEFAULT NULL,
  `receiver_user_id` int(11) DEFAULT NULL,
  `message` varchar(2000) DEFAULT NULL,
  `read_by_receiver` varchar(100) DEFAULT 'false',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat_master`
--

INSERT INTO `chat_master` (`id`, `product_id`, `sender_user_id`, `receiver_user_id`, `message`, `read_by_receiver`, `created_at`, `updated_at`) VALUES
(18, 9, 9, 6, 'SGVsbG8uIEkgYW0gaW50ZXJlc3RlZCBpbiBidXlpbmcgeW91ciBwcm9kdWN0LiBDYW4gd2UgdGFsayBhbmQgZGlzY3VzcyBzb21lIGRldGFpbHMgYWJvdXQgdGhlIHByb2R1Y3QgPw==', 'false', '2023-03-23 12:17:19', NULL),
(19, 9, 9, 6, 'SGlpZQ==', 'false', '2023-03-23 12:17:32', NULL),
(20, 9, 6, 9, 'SGlpZQ==', 'false', '2023-03-23 12:18:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city`, `state_id`) VALUES
(1, 'North and Middle Andaman', 32),
(2, 'South Andaman', 32),
(3, 'Nicobar', 32),
(4, 'Adilabad', 1),
(5, 'Anantapur', 1),
(6, 'Chittoor', 1),
(7, 'East Godavari', 1),
(8, 'Guntur', 1),
(9, 'Hyderabad', 1),
(10, 'Kadapa', 1),
(11, 'Karimnagar', 1),
(12, 'Khammam', 1),
(13, 'Krishna', 1),
(14, 'Kurnool', 1),
(15, 'Mahbubnagar', 1),
(16, 'Medak', 1),
(17, 'Nalgonda', 1),
(18, 'Nellore', 1),
(19, 'Nizamabad', 1),
(20, 'Prakasam', 1),
(21, 'Rangareddi', 1),
(22, 'Srikakulam', 1),
(23, 'Vishakhapatnam', 1),
(24, 'Vizianagaram', 1),
(25, 'Warangal', 1),
(26, 'West Godavari', 1),
(27, 'Anjaw', 3),
(28, 'Changlang', 3),
(29, 'East Kameng', 3),
(30, 'Lohit', 3),
(31, 'Lower Subansiri', 3),
(32, 'Papum Pare', 3),
(33, 'Tirap', 3),
(34, 'Dibang Valley', 3),
(35, 'Upper Subansiri', 3),
(36, 'West Kameng', 3),
(37, 'Barpeta', 2),
(38, 'Bongaigaon', 2),
(39, 'Cachar', 2),
(40, 'Darrang', 2),
(41, 'Dhemaji', 2),
(42, 'Dhubri', 2),
(43, 'Dibrugarh', 2),
(44, 'Goalpara', 2),
(45, 'Golaghat', 2),
(46, 'Hailakandi', 2),
(47, 'Jorhat', 2),
(48, 'Karbi Anglong', 2),
(49, 'Karimganj', 2),
(50, 'Kokrajhar', 2),
(51, 'Lakhimpur', 2),
(52, 'Marigaon', 2),
(53, 'Nagaon', 2),
(54, 'Nalbari', 2),
(55, 'North Cachar Hills', 2),
(56, 'Sibsagar', 2),
(57, 'Sonitpur', 2),
(58, 'Tinsukia', 2),
(59, 'Araria', 4),
(60, 'Aurangabad', 4),
(61, 'Banka', 4),
(62, 'Begusarai', 4),
(63, 'Bhagalpur', 4),
(64, 'Bhojpur', 4),
(65, 'Buxar', 4),
(66, 'Darbhanga', 4),
(67, 'Purba Champaran', 4),
(68, 'Gaya', 4),
(69, 'Gopalganj', 4),
(70, 'Jamui', 4),
(71, 'Jehanabad', 4),
(72, 'Khagaria', 4),
(73, 'Kishanganj', 4),
(74, 'Kaimur', 4),
(75, 'Katihar', 4),
(76, 'Lakhisarai', 4),
(77, 'Madhubani', 4),
(78, 'Munger', 4),
(79, 'Madhepura', 4),
(80, 'Muzaffarpur', 4),
(81, 'Nalanda', 4),
(82, 'Nawada', 4),
(83, 'Patna', 4),
(84, 'Purnia', 4),
(85, 'Rohtas', 4),
(86, 'Saharsa', 4),
(87, 'Samastipur', 4),
(88, 'Sheohar', 4),
(89, 'Sheikhpura', 4),
(90, 'Saran', 4),
(91, 'Sitamarhi', 4),
(92, 'Supaul', 4),
(93, 'Siwan', 4),
(94, 'Vaishali', 4),
(95, 'Pashchim Champaran', 4),
(96, 'Bastar', 36),
(97, 'Bilaspur', 36),
(98, 'Dantewada', 36),
(99, 'Dhamtari', 36),
(100, 'Durg', 36),
(101, 'Jashpur', 36),
(102, 'Janjgir-Champa', 36),
(103, 'Korba', 36),
(104, 'Koriya', 36),
(105, 'Kanker', 36),
(106, 'Kawardha', 36),
(107, 'Mahasamund', 36),
(108, 'Raigarh', 36),
(109, 'Rajnandgaon', 36),
(110, 'Raipur', 36),
(111, 'Surguja', 36),
(112, 'Diu', 29),
(113, 'Daman', 29),
(114, 'Central Delhi', 25),
(115, 'East Delhi', 25),
(116, 'New Delhi', 25),
(117, 'North Delhi', 25),
(118, 'North East Delhi', 25),
(119, 'North West Delhi', 25),
(120, 'South Delhi', 25),
(121, 'South West Delhi', 25),
(122, 'West Delhi', 25),
(123, 'North Goa', 26),
(124, 'South Goa', 26),
(125, 'Ahmedabad', 5),
(126, 'Amreli District', 5),
(127, 'Anand', 5),
(128, 'Banaskantha', 5),
(129, 'Bharuch', 5),
(130, 'Bhavnagar', 5),
(131, 'Dahod', 5),
(132, 'The Dangs', 5),
(133, 'Gandhinagar', 5),
(134, 'Jamnagar', 5),
(135, 'Junagadh', 5),
(136, 'Kutch', 5),
(137, 'Kheda', 5),
(138, 'Mehsana', 5),
(139, 'Narmada', 5),
(140, 'Navsari', 5),
(141, 'Patan', 5),
(142, 'Panchmahal', 5),
(143, 'Porbandar', 5),
(144, 'Rajkot', 5),
(145, 'Sabarkantha', 5),
(146, 'Surendranagar', 5),
(147, 'Surat', 5),
(148, 'Vadodara', 5),
(149, 'Valsad', 5),
(150, 'Ambala', 6),
(151, 'Bhiwani', 6),
(152, 'Faridabad', 6),
(153, 'Fatehabad', 6),
(154, 'Gurgaon', 6),
(155, 'Hissar', 6),
(156, 'Jhajjar', 6),
(157, 'Jind', 6),
(158, 'Karnal', 6),
(159, 'Kaithal', 6),
(160, 'Kurukshetra', 6),
(161, 'Mahendragarh', 6),
(162, 'Mewat', 6),
(163, 'Panchkula', 6),
(164, 'Panipat', 6),
(165, 'Rewari', 6),
(166, 'Rohtak', 6),
(167, 'Sirsa', 6),
(168, 'Sonepat', 6),
(169, 'Yamuna Nagar', 6),
(170, 'Palwal', 6),
(171, 'Bilaspur', 7),
(172, 'Chamba', 7),
(173, 'Hamirpur', 7),
(174, 'Kangra', 7),
(175, 'Kinnaur', 7),
(176, 'Kulu', 7),
(177, 'Lahaul and Spiti', 7),
(178, 'Mandi', 7),
(179, 'Shimla', 7),
(180, 'Sirmaur', 7),
(181, 'Solan', 7),
(182, 'Una', 7),
(183, 'Anantnag', 8),
(184, 'Badgam', 8),
(185, 'Bandipore', 8),
(186, 'Baramula', 8),
(187, 'Doda', 8),
(188, 'Jammu', 8),
(189, 'Kargil', 8),
(190, 'Kathua', 8),
(191, 'Kupwara', 8),
(192, 'Leh', 8),
(193, 'Poonch', 8),
(194, 'Pulwama', 8),
(195, 'Rajauri', 8),
(196, 'Srinagar', 8),
(197, 'Samba', 8),
(198, 'Udhampur', 8),
(199, 'Bokaro', 34),
(200, 'Chatra', 34),
(201, 'Deoghar', 34),
(202, 'Dhanbad', 34),
(203, 'Dumka', 34),
(204, 'Purba Singhbhum', 34),
(205, 'Garhwa', 34),
(206, 'Giridih', 34),
(207, 'Godda', 34),
(208, 'Gumla', 34),
(209, 'Hazaribagh', 34),
(210, 'Koderma', 34),
(211, 'Lohardaga', 34),
(212, 'Pakur', 34),
(213, 'Palamu', 34),
(214, 'Ranchi', 34),
(215, 'Sahibganj', 34),
(216, 'Seraikela and Kharsawan', 34),
(217, 'Pashchim Singhbhum', 34),
(218, 'Ramgarh', 34),
(219, 'Bidar', 9),
(220, 'Belgaum', 9),
(221, 'Bijapur', 9),
(222, 'Bagalkot', 9),
(223, 'Bellary', 9),
(224, 'Bangalore Rural District', 9),
(225, 'Bangalore Urban District', 9),
(226, 'Chamarajnagar', 9),
(227, 'Chikmagalur', 9),
(228, 'Chitradurga', 9),
(229, 'Davanagere', 9),
(230, 'Dharwad', 9),
(231, 'Dakshina Kannada', 9),
(232, 'Gadag', 9),
(233, 'Gulbarga', 9),
(234, 'Hassan', 9),
(235, 'Haveri District', 9),
(236, 'Kodagu', 9),
(237, 'Kolar', 9),
(238, 'Koppal', 9),
(239, 'Mandya', 9),
(240, 'Mysore', 9),
(241, 'Raichur', 9),
(242, 'Shimoga', 9),
(243, 'Tumkur', 9),
(244, 'Udupi', 9),
(245, 'Uttara Kannada', 9),
(246, 'Ramanagara', 9),
(247, 'Chikballapur', 9),
(248, 'Yadagiri', 9),
(249, 'Alappuzha', 10),
(250, 'Ernakulam', 10),
(251, 'Idukki', 10),
(252, 'Kollam', 10),
(253, 'Kannur', 10),
(254, 'Kasaragod', 10),
(255, 'Kottayam', 10),
(256, 'Kozhikode', 10),
(257, 'Malappuram', 10),
(258, 'Palakkad', 10),
(259, 'Pathanamthitta', 10),
(260, 'Thrissur', 10),
(261, 'Thiruvananthapuram', 10),
(262, 'Wayanad', 10),
(263, 'Alirajpur', 11),
(264, 'Anuppur', 11),
(265, 'Ashok Nagar', 11),
(266, 'Balaghat', 11),
(267, 'Barwani', 11),
(268, 'Betul', 11),
(269, 'Bhind', 11),
(270, 'Bhopal', 11),
(271, 'Burhanpur', 11),
(272, 'Chhatarpur', 11),
(273, 'Chhindwara', 11),
(274, 'Damoh', 11),
(275, 'Datia', 11),
(276, 'Dewas', 11),
(277, 'Dhar', 11),
(278, 'Dindori', 11),
(279, 'Guna', 11),
(280, 'Gwalior', 11),
(281, 'Harda', 11),
(282, 'Hoshangabad', 11),
(283, 'Indore', 11),
(284, 'Jabalpur', 11),
(285, 'Jhabua', 11),
(286, 'Katni', 11),
(287, 'Khandwa', 11),
(288, 'Khargone', 11),
(289, 'Mandla', 11),
(290, 'Mandsaur', 11),
(291, 'Morena', 11),
(292, 'Narsinghpur', 11),
(293, 'Neemuch', 11),
(294, 'Panna', 11),
(295, 'Rewa', 11),
(296, 'Rajgarh', 11),
(297, 'Ratlam', 11),
(298, 'Raisen', 11),
(299, 'Sagar', 11),
(300, 'Satna', 11),
(301, 'Sehore', 11),
(302, 'Seoni', 11),
(303, 'Shahdol', 11),
(304, 'Shajapur', 11),
(305, 'Sheopur', 11),
(306, 'Shivpuri', 11),
(307, 'Sidhi', 11),
(308, 'Singrauli', 11),
(309, 'Tikamgarh', 11),
(310, 'Ujjain', 11),
(311, 'Umaria', 11),
(312, 'Vidisha', 11),
(313, 'Ahmednagar', 12),
(314, 'Akola', 12),
(315, 'Amrawati', 12),
(316, 'Aurangabad', 12),
(317, 'Bhandara', 12),
(318, 'Beed', 12),
(319, 'Buldhana', 12),
(320, 'Chandrapur', 12),
(321, 'Dhule', 12),
(322, 'Gadchiroli', 12),
(323, 'Gondiya', 12),
(324, 'Hingoli', 12),
(325, 'Jalgaon', 12),
(326, 'Jalna', 12),
(327, 'Kolhapur', 12),
(328, 'Latur', 12),
(329, 'Mumbai City', 12),
(330, 'Mumbai suburban', 12),
(331, 'Nandurbar', 12),
(332, 'Nanded', 12),
(333, 'Nagpur', 12),
(334, 'Nashik', 12),
(335, 'Osmanabad', 12),
(336, 'Parbhani', 12),
(337, 'Pune', 12),
(338, 'Raigad', 12),
(339, 'Ratnagiri', 12),
(340, 'Sindhudurg', 12),
(341, 'Sangli', 12),
(342, 'Solapur', 12),
(343, 'Satara', 12),
(344, 'Thane', 12),
(345, 'Wardha', 12),
(346, 'Washim', 12),
(347, 'Yavatmal', 12),
(348, 'Bishnupur', 13),
(349, 'Churachandpur', 13),
(350, 'Chandel', 13),
(351, 'Imphal East', 13),
(352, 'Senapati', 13),
(353, 'Tamenglong', 13),
(354, 'Thoubal', 13),
(355, 'Ukhrul', 13),
(356, 'Imphal West', 13),
(357, 'East Garo Hills', 14),
(358, 'East Khasi Hills', 14),
(359, 'Jaintia Hills', 14),
(360, 'Ri-Bhoi', 14),
(361, 'South Garo Hills', 14),
(362, 'West Garo Hills', 14),
(363, 'West Khasi Hills', 14),
(364, 'Aizawl', 15),
(365, 'Champhai', 15),
(366, 'Kolasib', 15),
(367, 'Lawngtlai', 15),
(368, 'Lunglei', 15),
(369, 'Mamit', 15),
(370, 'Saiha', 15),
(371, 'Serchhip', 15),
(372, 'Dimapur', 16),
(373, 'Kohima', 16),
(374, 'Mokokchung', 16),
(375, 'Mon', 16),
(376, 'Phek', 16),
(377, 'Tuensang', 16),
(378, 'Wokha', 16),
(379, 'Zunheboto', 16),
(380, 'Angul', 17),
(381, 'Boudh', 17),
(382, 'Bhadrak', 17),
(383, 'Bolangir', 17),
(384, 'Bargarh', 17),
(385, 'Baleswar', 17),
(386, 'Cuttack', 17),
(387, 'Debagarh', 17),
(388, 'Dhenkanal', 17),
(389, 'Ganjam', 17),
(390, 'Gajapati', 17),
(391, 'Jharsuguda', 17),
(392, 'Jajapur', 17),
(393, 'Jagatsinghpur', 17),
(394, 'Khordha', 17),
(395, 'Kendujhar', 17),
(396, 'Kalahandi', 17),
(397, 'Kandhamal', 17),
(398, 'Koraput', 17),
(399, 'Kendrapara', 17),
(400, 'Malkangiri', 17),
(401, 'Mayurbhanj', 17),
(402, 'Nabarangpur', 17),
(403, 'Nuapada', 17),
(404, 'Nayagarh', 17),
(405, 'Puri', 17),
(406, 'Rayagada', 17),
(407, 'Sambalpur', 17),
(408, 'Subarnapur', 17),
(409, 'Sundargarh', 17),
(410, 'Karaikal', 27),
(411, 'Mahe', 27),
(412, 'Puducherry', 27),
(413, 'Yanam', 27),
(414, 'Amritsar', 18),
(415, 'Bathinda', 18),
(416, 'Firozpur', 18),
(417, 'Faridkot', 18),
(418, 'Fatehgarh Sahib', 18),
(419, 'Gurdaspur', 18),
(420, 'Hoshiarpur', 18),
(421, 'Jalandhar', 18),
(422, 'Kapurthala', 18),
(423, 'Ludhiana', 18),
(424, 'Mansa', 18),
(425, 'Moga', 18),
(426, 'Mukatsar', 18),
(427, 'Nawan Shehar', 18),
(428, 'Patiala', 18),
(429, 'Rupnagar', 18),
(430, 'Sangrur', 18),
(431, 'Ajmer', 19),
(432, 'Alwar', 19),
(433, 'Bikaner', 19),
(434, 'Barmer', 19),
(435, 'Banswara', 19),
(436, 'Bharatpur', 19),
(437, 'Baran', 19),
(438, 'Bundi', 19),
(439, 'Bhilwara', 19),
(440, 'Churu', 19),
(441, 'Chittorgarh', 19),
(442, 'Dausa', 19),
(443, 'Dholpur', 19),
(444, 'Dungapur', 19),
(445, 'Ganganagar', 19),
(446, 'Hanumangarh', 19),
(447, 'Juhnjhunun', 19),
(448, 'Jalore', 19),
(449, 'Jodhpur', 19),
(450, 'Jaipur', 19),
(451, 'Jaisalmer', 19),
(452, 'Jhalawar', 19),
(453, 'Karauli', 19),
(454, 'Kota', 19),
(455, 'Nagaur', 19),
(456, 'Pali', 19),
(457, 'Pratapgarh', 19),
(458, 'Rajsamand', 19),
(459, 'Sikar', 19),
(460, 'Sawai Madhopur', 19),
(461, 'Sirohi', 19),
(462, 'Tonk', 19),
(463, 'Udaipur', 19),
(464, 'East Sikkim', 20),
(465, 'North Sikkim', 20),
(466, 'South Sikkim', 20),
(467, 'West Sikkim', 20),
(468, 'Ariyalur', 21),
(469, 'Chennai', 21),
(470, 'Coimbatore', 21),
(471, 'Cuddalore', 21),
(472, 'Dharmapuri', 21),
(473, 'Dindigul', 21),
(474, 'Erode', 21),
(475, 'Kanchipuram', 21),
(476, 'Kanyakumari', 21),
(477, 'Karur', 21),
(478, 'Madurai', 21),
(479, 'Nagapattinam', 21),
(480, 'The Nilgiris', 21),
(481, 'Namakkal', 21),
(482, 'Perambalur', 21),
(483, 'Pudukkottai', 21),
(484, 'Ramanathapuram', 21),
(485, 'Salem', 21),
(486, 'Sivagangai', 21),
(487, 'Tiruppur', 21),
(488, 'Tiruchirappalli', 21),
(489, 'Theni', 21),
(490, 'Tirunelveli', 21),
(491, 'Thanjavur', 21),
(492, 'Thoothukudi', 21),
(493, 'Thiruvallur', 21),
(494, 'Thiruvarur', 21),
(495, 'Tiruvannamalai', 21),
(496, 'Vellore', 21),
(497, 'Villupuram', 21),
(498, 'Dhalai', 22),
(499, 'North Tripura', 22),
(500, 'South Tripura', 22),
(501, 'West Tripura', 22),
(502, 'Almora', 33),
(503, 'Bageshwar', 33),
(504, 'Chamoli', 33),
(505, 'Champawat', 33),
(506, 'Dehradun', 33),
(507, 'Haridwar', 33),
(508, 'Nainital', 33),
(509, 'Pauri Garhwal', 33),
(510, 'Pithoragharh', 33),
(511, 'Rudraprayag', 33),
(512, 'Tehri Garhwal', 33),
(513, 'Udham Singh Nagar', 33),
(514, 'Uttarkashi', 33),
(515, 'Agra', 23),
(516, 'Allahabad', 23),
(517, 'Aligarh', 23),
(518, 'Ambedkar Nagar', 23),
(519, 'Auraiya', 23),
(520, 'Azamgarh', 23),
(521, 'Barabanki', 23),
(522, 'Badaun', 23),
(523, 'Bagpat', 23),
(524, 'Bahraich', 23),
(525, 'Bijnor', 23),
(526, 'Ballia', 23),
(527, 'Banda', 23),
(528, 'Balrampur', 23),
(529, 'Bareilly', 23),
(530, 'Basti', 23),
(531, 'Bulandshahr', 23),
(532, 'Chandauli', 23),
(533, 'Chitrakoot', 23),
(534, 'Deoria', 23),
(535, 'Etah', 23),
(536, 'Kanshiram Nagar', 23),
(537, 'Etawah', 23),
(538, 'Firozabad', 23),
(539, 'Farrukhabad', 23),
(540, 'Fatehpur', 23),
(541, 'Faizabad', 23),
(542, 'Gautam Buddha Nagar', 23),
(543, 'Gonda', 23),
(544, 'Ghazipur', 23),
(545, 'Gorkakhpur', 23),
(546, 'Ghaziabad', 23),
(547, 'Hamirpur', 23),
(548, 'Hardoi', 23),
(549, 'Mahamaya Nagar', 23),
(550, 'Jhansi', 23),
(551, 'Jalaun', 23),
(552, 'Jyotiba Phule Nagar', 23),
(553, 'Jaunpur District', 23),
(554, 'Kanpur Dehat', 23),
(555, 'Kannauj', 23),
(556, 'Kanpur Nagar', 23),
(557, 'Kaushambi', 23),
(558, 'Kushinagar', 23),
(559, 'Lalitpur', 23),
(560, 'Lakhimpur Kheri', 23),
(561, 'Lucknow', 23),
(562, 'Mau', 23),
(563, 'Meerut', 23),
(564, 'Maharajganj', 23),
(565, 'Mahoba', 23),
(566, 'Mirzapur', 23),
(567, 'Moradabad', 23),
(568, 'Mainpuri', 23),
(569, 'Mathura', 23),
(570, 'Muzaffarnagar', 23),
(571, 'Pilibhit', 23),
(572, 'Pratapgarh', 23),
(573, 'Rampur', 23),
(574, 'Rae Bareli', 23),
(575, 'Saharanpur', 23),
(576, 'Sitapur', 23),
(577, 'Shahjahanpur', 23),
(578, 'Sant Kabir Nagar', 23),
(579, 'Siddharthnagar', 23),
(580, 'Sonbhadra', 23),
(581, 'Sant Ravidas Nagar', 23),
(582, 'Sultanpur', 23),
(583, 'Shravasti', 23),
(584, 'Unnao', 23),
(585, 'Varanasi', 23),
(586, 'Birbhum', 24),
(587, 'Bankura', 24),
(588, 'Bardhaman', 24),
(589, 'Darjeeling', 24),
(590, 'Dakshin Dinajpur', 24),
(591, 'Hooghly', 24),
(592, 'Howrah', 24),
(593, 'Jalpaiguri', 24),
(594, 'Cooch Behar', 24),
(595, 'Kolkata', 24),
(596, 'Malda', 24),
(597, 'Midnapore', 24),
(598, 'Murshidabad', 24),
(599, 'Nadia', 24),
(600, 'North 24 Parganas', 24),
(601, 'South 24 Parganas', 24),
(602, 'Purulia', 24),
(603, 'Uttar Dinajpur', 24);

-- --------------------------------------------------------

--
-- Table structure for table `complaint_product`
--

CREATE TABLE `complaint_product` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `complainer_user_id` int(11) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaint_product`
--

INSERT INTO `complaint_product` (`id`, `product_id`, `complainer_user_id`, `message`, `status`, `created_at`, `updated_at`) VALUES
(2, 6, 6, 'Not legal in india. Please ban it now.', 'Seen', '2023-03-12 10:37:13', '2023-03-17 05:03:40');

-- --------------------------------------------------------

--
-- Table structure for table `complaint_user`
--

CREATE TABLE `complaint_user` (
  `id` int(11) NOT NULL,
  `complainer_user_id` int(11) DEFAULT NULL,
  `complainee_user_id` int(11) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `complaint_user`
--

INSERT INTO `complaint_user` (`id`, `complainer_user_id`, `complainee_user_id`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 7, 'lengknlewnlm;wlemg;lg blkmn;le', 'Seen', '2023-03-12 10:38:11', '2023-03-17 05:06:06');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_email` varchar(200) DEFAULT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `phone_no` int(11) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `status` varchar(300) DEFAULT 'Unseen',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_email`, `name`, `phone_no`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'harshad14@gmail.com', NULL, NULL, 'Good website, but can improve it by using wallet option and also giving online money transfer facility.', 'Unseen', '2023-03-13 04:29:12', NULL),
(2, 'ganatradeep9@gmail.com', 'Deep Ganatra', 2147483647, 'dkjghkjhelfhliqwhilhflihqwligfligqliwegfliqweligfliqgelighliqewglifgliqwegfliglqiw', 'Unseen', '2023-03-17 04:41:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `listing_products`
--

CREATE TABLE `listing_products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `catagory_id` int(11) DEFAULT NULL,
  `product_name` varchar(300) DEFAULT NULL,
  `product_description` varchar(1000) DEFAULT NULL,
  `price` decimal(18,2) DEFAULT NULL,
  `img1` varchar(200) DEFAULT NULL,
  `img2` varchar(200) DEFAULT NULL,
  `img3` varchar(200) DEFAULT NULL,
  `img4` varchar(600) DEFAULT NULL,
  `sell_status` varchar(50) DEFAULT NULL,
  `product_status` varchar(100) DEFAULT NULL,
  `Block_By` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `listing_products`
--

INSERT INTO `listing_products` (`id`, `user_id`, `catagory_id`, `product_name`, `product_description`, `price`, `img1`, `img2`, `img3`, `img4`, `sell_status`, `product_status`, `Block_By`, `created_at`, `updated_at`) VALUES
(6, 7, 10, 'Dummy Data', 'Kai nathi bhai tu j aapi de', '100.00', 'SINGLE STEP SS304.jpeg', 'video_image.jpg', '', '', 'Unsold', 'Active', NULL, '2023-02-01 06:37:46', '2023-03-06 08:45:28'),
(7, 7, 15, 'Satya na Prayogo', 'Mahatma Gandhi Autobiography', '950.00', '91CQtPp5UWL.jpg', '', '', '', 'Unsold', 'Active', NULL, '2023-02-01 06:45:05', '2023-03-13 18:29:27'),
(8, 7, 13, 'Harsh', 'Gilinder', '150.00', 'footer.png', NULL, NULL, NULL, 'Unsold', 'Active', NULL, '2023-02-01 11:58:27', '2023-02-23 05:22:08'),
(9, 6, 16, 'Wooden Table', '100% Pure sandal wood used. Only 2 months used. Without any scratches.', '750.00', 'Admin_back.png', NULL, NULL, NULL, 'Unsold', 'Active', NULL, '2023-03-07 06:28:24', '2023-03-19 07:07:07'),
(10, 9, 13, 'PS5', 'Sony Playstation version 5. Only 2 months used. Also coming with full 8months waranty.', '30000.00', 'playstation-5-77d37a0.jpg', '', '', '', 'Unsold', 'Active', NULL, '2023-03-14 05:32:39', '2023-03-19 07:10:11');

-- --------------------------------------------------------

--
-- Table structure for table `marketer`
--

CREATE TABLE `marketer` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `marketer_name` varchar(300) DEFAULT NULL,
  `email` varchar(400) DEFAULT NULL,
  `password` varchar(1000) DEFAULT NULL,
  `status` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `marketer`
--

INSERT INTO `marketer` (`id`, `user_id`, `marketer_name`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(3, 7, 'Harsh Badkas', 'badkasharshkumar@gmail.com', '$2y$10$TUw1HVb49reO9jJR6T8ZGuqMkTyGGPEJlt8s3Y9HhXB3sBrecjuNe', 'Active', '2023-02-23 09:06:12', '2023-02-24 10:02:08');

-- --------------------------------------------------------

--
-- Table structure for table `order_tracking`
--

CREATE TABLE `order_tracking` (
  `id` int(11) NOT NULL,
  `sell_master_id` int(11) DEFAULT NULL,
  `status` varchar(500) DEFAULT NULL,
  `location` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_tracking`
--

INSERT INTO `order_tracking` (`id`, `sell_master_id`, `status`, `location`, `created_at`, `updated_at`) VALUES
(1, 1, 'Delivered', 'Buyer', '2023-02-03 08:51:30', '2023-02-07 10:59:54'),
(2, 2, 'Delivered', 'Buyer', '2023-02-03 08:51:30', '2023-02-03 17:18:14'),
(3, 3, 'Delivered', 'Buyer', '2023-02-23 07:58:59', NULL),
(4, 4, 'Delivered', 'Buyer', '2023-03-03 07:45:40', '2023-03-12 13:14:03'),
(5, 5, 'Delivered', 'Buyer', '2023-03-03 08:23:32', '2023-03-13 18:41:48'),
(10, 10, 'Delivered', 'Buyer', '2023-03-07 08:40:59', '2023-03-13 18:41:58'),
(11, 11, 'In Transit', 'Delhi', '2023-03-07 08:40:59', '2023-03-13 18:42:06'),
(12, 12, 'Packing', 'Buyer', '2023-03-07 09:54:36', NULL),
(13, 13, 'Packing', 'Buyer', '2023-03-07 11:02:41', NULL),
(14, 14, 'Packing', 'Buyer', '2023-03-09 05:04:20', NULL),
(15, 15, 'In Transit', 'Delhi', '2023-03-14 06:13:50', '2023-03-14 06:17:11'),
(16, 16, 'Packing', 'Buyer', '2023-03-17 05:43:47', NULL),
(17, 17, 'Packing', 'Buyer', '2023-03-18 05:38:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `return_order`
--

CREATE TABLE `return_order` (
  `id` int(11) NOT NULL,
  `sell_master_id` int(11) DEFAULT NULL,
  `order_problem` varchar(600) DEFAULT NULL,
  `return_img` varchar(500) DEFAULT NULL,
  `status` varchar(400) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `return_order`
--

INSERT INTO `return_order` (`id`, `sell_master_id`, `order_problem`, `return_img`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Not as expected', NULL, 'Completed', '2023-02-04 04:36:43', '2023-02-08 05:19:59'),
(2, 3, 'Price too high. Found cheaper on other site.', NULL, 'Completed', '2023-02-23 07:59:39', '2023-02-23 07:59:53'),
(4, 5, 'Other', 'Screenshot (5).png', 'Completed', '2023-03-13 18:44:01', '2023-03-13 18:45:38');

-- --------------------------------------------------------

--
-- Table structure for table `sold_master`
--

CREATE TABLE `sold_master` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `marketer_id` int(11) DEFAULT NULL,
  `marketer_commission` decimal(18,2) DEFAULT NULL,
  `buyer_user_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_amount` float DEFAULT NULL,
  `payment_mode` varchar(300) DEFAULT NULL,
  `selling_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sold_master`
--

INSERT INTO `sold_master` (`id`, `product_id`, `marketer_id`, `marketer_commission`, `buyer_user_id`, `quantity`, `total_amount`, `payment_mode`, `selling_date`, `created_at`, `updated_at`) VALUES
(1, 6, NULL, NULL, 6, 5, 600, 'Cash on Delivery', '2023-02-03', '2023-02-03 08:50:50', NULL),
(2, 7, 3, '95.00', 8, 1, 950, 'Razorpay', '2023-01-01', '2023-02-03 08:50:50', '2023-02-24 20:39:52'),
(3, 8, NULL, NULL, 8, 1, 150, 'Razorpay', '2023-02-23', '2023-02-23 07:58:34', NULL),
(4, 7, 3, '285.00', 9, 3, 2850, 'Cash on Delivery', '2023-03-03', '2023-03-03 07:45:40', NULL),
(5, 7, 3, '950.00', 6, 10, 9500, 'Cash on Delivery', '2023-03-03', '2023-03-03 08:23:32', NULL),
(10, 6, NULL, NULL, 6, 2, 200, 'Cash on Delivery', '2023-03-07', '2023-03-07 08:40:59', NULL),
(11, 7, NULL, NULL, 6, 1, 950, 'Cash on Delivery', '2023-03-07', '2023-03-07 08:40:59', NULL),
(12, 6, NULL, NULL, 6, 3, 300, 'Cash on Delivery', '2023-03-07', '2023-03-07 09:54:36', NULL),
(13, 6, NULL, NULL, 8, 1, 100, 'Cash on Delivery', '2023-03-07', '2023-03-07 11:02:41', NULL),
(14, 6, NULL, NULL, 8, 1, 100, 'Cash on Delivery', '2023-03-09', '2023-03-09 05:04:20', NULL),
(15, 7, NULL, NULL, 6, 1, 950, 'Cash on Delivery', '2023-03-14', '2023-03-14 06:13:50', NULL),
(16, 7, NULL, NULL, 6, 2, 1900, 'Cash on Delivery', '2023-03-17', '2023-03-17 05:43:47', NULL),
(17, 8, NULL, NULL, 6, 1, 150, 'Cash on Delivery', '2023-03-18', '2023-03-18 05:38:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `country_id`) VALUES
(1, 'ANDHRA PRADESH', 105),
(2, 'ASSAM', 105),
(3, 'ARUNACHAL PRADESH', 105),
(4, 'BIHAR', 105),
(5, 'GUJARAT', 105),
(6, 'HARYANA', 105),
(7, 'HIMACHAL PRADESH', 105),
(8, 'JAMMU & KASHMIR', 105),
(9, 'KARNATAKA', 105),
(10, 'KERALA', 105),
(11, 'MADHYA PRADESH', 105),
(12, 'MAHARASHTRA', 105),
(13, 'MANIPUR', 105),
(14, 'MEGHALAYA', 105),
(15, 'MIZORAM', 105),
(16, 'NAGALAND', 105),
(17, 'ORISSA', 105),
(18, 'PUNJAB', 105),
(19, 'RAJASTHAN', 105),
(20, 'SIKKIM', 105),
(21, 'TAMIL NADU', 105),
(22, 'TRIPURA', 105),
(23, 'UTTAR PRADESH', 105),
(24, 'WEST BENGAL', 105),
(25, 'DELHI', 105),
(26, 'GOA', 105),
(27, 'PONDICHERY', 105),
(28, 'LAKSHDWEEP', 105),
(29, 'DAMAN & DIU', 105),
(30, 'DADRA & NAGAR', 105),
(31, 'CHANDIGARH', 105),
(32, 'ANDAMAN & NICOBAR', 105),
(33, 'UTTARANCHAL', 105),
(34, 'JHARKHAND', 105),
(35, 'CHATTISGARH', 105);

-- --------------------------------------------------------

--
-- Table structure for table `subscription_master`
--

CREATE TABLE `subscription_master` (
  `id` int(11) NOT NULL,
  `subscription_name` varchar(500) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `rate` double DEFAULT NULL,
  `time_perioud` int(11) DEFAULT NULL,
  `status` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscription_master`
--

INSERT INTO `subscription_master` (`id`, `subscription_name`, `description`, `rate`, `time_perioud`, `status`, `created_at`, `updated_at`) VALUES
(9, 'Silver Plan', 'This Plan has been subscribed for 30 days which will allow to access all facilities in only  for Rs 200. ', 200, 30, 'Active', '2022-12-28 18:26:58', '2022-12-29 06:58:01'),
(10, 'Golden Plan', 'This Plan has been subscribed for 180 days which will allow to access all facilities in only for Rs 1000.', 1000, 180, 'Active', '2022-12-28 18:28:38', '2023-01-08 17:17:06'),
(11, 'Platinum Plan', 'This Plan has been subscribed for 365 days which will allow to access all facilities in only for Rs 1800.', 1800, 360, 'Active', '2022-12-28 18:29:56', '2023-01-04 06:09:27');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_selling`
--

CREATE TABLE `subscription_selling` (
  `id` int(11) NOT NULL,
  `subscription_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `payment_mode` varchar(400) DEFAULT NULL,
  `expiary_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscription_selling`
--

INSERT INTO `subscription_selling` (`id`, `subscription_id`, `user_id`, `payment_mode`, `expiary_date`, `created_at`, `updated_at`) VALUES
(1, 9, 7, 'Razorpay', '2023-02-04', '2023-01-05 05:34:45', NULL),
(6, 10, 8, 'Razorpay', '2023-03-04', '2023-02-02 20:31:34', NULL),
(8, 9, 6, 'Razorpay', '2023-04-09', '2023-03-10 05:32:19', NULL),
(9, 9, 7, 'Razorpay', '2023-04-18', '2023-03-19 06:13:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `id` int(11) NOT NULL,
  `profile_img` varchar(500) DEFAULT NULL,
  `bussiness_name` varchar(1000) DEFAULT NULL,
  `owner_name` varchar(800) DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  `password` varchar(500) NOT NULL,
  `pincode` int(11) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `address` varchar(1000) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `gst_no` varchar(20) DEFAULT NULL,
  `role` varchar(11) DEFAULT NULL,
  `status` varchar(100) DEFAULT 'active',
  `subscrib_id` int(11) DEFAULT NULL,
  `expiary_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`id`, `profile_img`, `bussiness_name`, `owner_name`, `email`, `password`, `pincode`, `state`, `city`, `address`, `phone`, `gender`, `gst_no`, `role`, `status`, `subscrib_id`, `expiary_date`, `created_at`, `updated_at`) VALUES
(6, 'Nitro_Wallpaper_5000x2813.jpg', NULL, 'Asti Paladiya', 'paladiyaasti@gmail.com', '$2y$10$bR0LalhyAHGhPCtiBJ8mUuaR7jg80/Ayzf8hhNvRDFJXqdalcZ6Me', 395006, 'Gujarat', 'Surat', '42, Shree Ramnagar Society, Hirabug, Surat', 6352778198, 'female', NULL, '2', 'active', 9, '2023-04-09', '2022-12-31 08:23:02', '2023-03-18 11:55:38'),
(7, 'planet9_Wallpaper_5000x2813.jpg', 'Grow With Shreeji', 'Deep Ganatra', 'ganatradeep9@gmail.com', '$2y$10$UjSMZk2RPNGoxnofGrk3k.6tNWnQ9cumqPaqJU.73kFjQTwMXXr9u', 395001, 'Gujarat', 'Surat', 'Athwagate, Surat', 9429267032, 'male', '24ABZPG2594B1ZJ', '1', 'active', 9, '2023-04-18', '2023-01-05 05:34:45', '2023-03-19 06:13:21'),
(8, NULL, NULL, 'Harsh Adadhiyawala', 'harshadadhiyawala@gmail.com', '$2y$10$H0L7Hnbwd/VBSmblBLaL8u6xIzUduJx.8As5kBpGpp3To8X0g5ziK', 395002, 'Gujarat', 'Surat', 'Kashinagar, Surat', 9558004132, 'male', NULL, '2', 'active', NULL, NULL, '2023-01-31 07:30:07', '2023-03-07 09:56:47'),
(9, 'Nitro_Wallpaper_5000x2813.jpg', NULL, 'Heet Bhansali', 'heet@gmail.com', '$2y$10$rgUOdN.JFVgB4zizmIgVz.Y.qd7x1iZ9omfTRbtBimWnMAkQStLgK', 395002, 'Gujarat', 'Surat', 'Kailashnagar, Surat', 9825121067, 'male', NULL, '2', 'active', NULL, NULL, '2023-03-02 06:27:08', '2023-03-17 19:22:13');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_master`
--

CREATE TABLE `visitor_master` (
  `id` int(11) NOT NULL,
  `mac_address` varchar(200) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitor_master`
--

INSERT INTO `visitor_master` (`id`, `mac_address`, `created_at`, `updated_at`) VALUES
(1, 'KGWKFH', '2022-12-01 17:02:55', '2023-01-10 17:08:50'),
(2, 'MJGDKUGKJ', '2023-01-10 17:03:03', NULL),
(3, '00-50-56-C0-00-01', '2023-02-01 17:07:39', '2023-01-31 12:21:19'),
(4, 'DU<M<Y', '2023-02-09 12:20:58', '2023-01-31 12:21:32'),
(5, 'HELLO', '2023-03-01 12:20:58', '2023-01-31 12:21:50');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_master`
--

CREATE TABLE `wishlist_master` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist_master`
--

INSERT INTO `wishlist_master` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(22, 6, 7, '2023-03-14 06:12:31', NULL),
(23, 6, 8, '2023-03-14 06:12:48', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_master`
--
ALTER TABLE `admin_master`
  ADD PRIMARY KEY (`admin_email`);

--
-- Indexes for table `assign_marketer`
--
ALTER TABLE `assign_marketer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `abc` (`marketer_id`),
  ADD KEY `xyz` (`product_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cart_to_user` (`user_id`),
  ADD KEY `fk_cart_to_product` (`product_id`);

--
-- Indexes for table `category_master`
--
ALTER TABLE `category_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_first`
--
ALTER TABLE `chat_first`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_to_chat` (`product_id`),
  ADD KEY `fk_user_to_chat1` (`user_first`),
  ADD KEY `fk_user_to_chat2` (`user_second`);

--
-- Indexes for table `chat_master`
--
ALTER TABLE `chat_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `efd` (`receiver_user_id`),
  ADD KEY `mno` (`sender_user_id`),
  ADD KEY `fk_chat_product` (`product_id`);

--
-- Indexes for table `complaint_product`
--
ALTER TABLE `complaint_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `xwz` (`product_id`),
  ADD KEY `opq` (`complainer_user_id`);

--
-- Indexes for table `complaint_user`
--
ALTER TABLE `complaint_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dcb` (`complainee_user_id`),
  ADD KEY `pqr` (`complainer_user_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `zxv` (`user_email`);

--
-- Indexes for table `listing_products`
--
ALTER TABLE `listing_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `upo` (`catagory_id`),
  ADD KEY `erf` (`user_id`);

--
-- Indexes for table `marketer`
--
ALTER TABLE `marketer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cdf` (`user_id`);

--
-- Indexes for table `order_tracking`
--
ALTER TABLE `order_tracking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jkl` (`sell_master_id`);

--
-- Indexes for table `return_order`
--
ALTER TABLE `return_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rfg` (`sell_master_id`);

--
-- Indexes for table `sold_master`
--
ALTER TABLE `sold_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sdf` (`product_id`),
  ADD KEY `ghj` (`buyer_user_id`),
  ADD KEY `mar` (`marketer_id`);

--
-- Indexes for table `subscription_master`
--
ALTER TABLE `subscription_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_selling`
--
ALTER TABLE `subscription_selling`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wer` (`subscription_id`),
  ADD KEY `vbc` (`user_id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitor_master`
--
ALTER TABLE `visitor_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist_master`
--
ALTER TABLE `wishlist_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wishlist_to_listing_products` (`product_id`),
  ADD KEY `fk_wishlist_to_user` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_marketer`
--
ALTER TABLE `assign_marketer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `category_master`
--
ALTER TABLE `category_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `chat_first`
--
ALTER TABLE `chat_first`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chat_master`
--
ALTER TABLE `chat_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `complaint_product`
--
ALTER TABLE `complaint_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `complaint_user`
--
ALTER TABLE `complaint_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `listing_products`
--
ALTER TABLE `listing_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `marketer`
--
ALTER TABLE `marketer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_tracking`
--
ALTER TABLE `order_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `return_order`
--
ALTER TABLE `return_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sold_master`
--
ALTER TABLE `sold_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `subscription_master`
--
ALTER TABLE `subscription_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subscription_selling`
--
ALTER TABLE `subscription_selling`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `visitor_master`
--
ALTER TABLE `visitor_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlist_master`
--
ALTER TABLE `wishlist_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign_marketer`
--
ALTER TABLE `assign_marketer`
  ADD CONSTRAINT `abc` FOREIGN KEY (`marketer_id`) REFERENCES `marketer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `xyz` FOREIGN KEY (`product_id`) REFERENCES `listing_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat_first`
--
ALTER TABLE `chat_first`
  ADD CONSTRAINT `fk_product_to_chat` FOREIGN KEY (`product_id`) REFERENCES `listing_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_to_chat1` FOREIGN KEY (`user_first`) REFERENCES `user_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_to_chat2` FOREIGN KEY (`user_second`) REFERENCES `user_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chat_master`
--
ALTER TABLE `chat_master`
  ADD CONSTRAINT `efd` FOREIGN KEY (`receiver_user_id`) REFERENCES `user_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_chat_product` FOREIGN KEY (`product_id`) REFERENCES `listing_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mno` FOREIGN KEY (`sender_user_id`) REFERENCES `user_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `complaint_product`
--
ALTER TABLE `complaint_product`
  ADD CONSTRAINT `opq` FOREIGN KEY (`complainer_user_id`) REFERENCES `user_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `xwz` FOREIGN KEY (`product_id`) REFERENCES `listing_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `complaint_user`
--
ALTER TABLE `complaint_user`
  ADD CONSTRAINT `dcb` FOREIGN KEY (`complainee_user_id`) REFERENCES `user_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pqr` FOREIGN KEY (`complainer_user_id`) REFERENCES `user_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `listing_products`
--
ALTER TABLE `listing_products`
  ADD CONSTRAINT `erf` FOREIGN KEY (`user_id`) REFERENCES `user_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `upo` FOREIGN KEY (`catagory_id`) REFERENCES `category_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `marketer`
--
ALTER TABLE `marketer`
  ADD CONSTRAINT `cdf` FOREIGN KEY (`user_id`) REFERENCES `user_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_tracking`
--
ALTER TABLE `order_tracking`
  ADD CONSTRAINT `jkl` FOREIGN KEY (`sell_master_id`) REFERENCES `sold_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `return_order`
--
ALTER TABLE `return_order`
  ADD CONSTRAINT `rfg` FOREIGN KEY (`sell_master_id`) REFERENCES `sold_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sold_master`
--
ALTER TABLE `sold_master`
  ADD CONSTRAINT `ghj` FOREIGN KEY (`buyer_user_id`) REFERENCES `user_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mar` FOREIGN KEY (`marketer_id`) REFERENCES `marketer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sdf` FOREIGN KEY (`product_id`) REFERENCES `listing_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subscription_selling`
--
ALTER TABLE `subscription_selling`
  ADD CONSTRAINT `vbc` FOREIGN KEY (`user_id`) REFERENCES `user_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wer` FOREIGN KEY (`subscription_id`) REFERENCES `subscription_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
