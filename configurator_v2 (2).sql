-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2024 at 02:23 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `configurator_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_master`
--

CREATE TABLE `login_master` (
  `id` int(11) NOT NULL,
  `employee_code` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `department` varchar(10) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `manager_code` int(10) NOT NULL,
  `user_role` int(11) NOT NULL,
  `crm_user_id` int(11) NOT NULL,
  `applicable_discounting_percentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_master`
--

INSERT INTO `login_master` (`id`, `employee_code`, `first_name`, `last_name`, `username`, `email`, `password`, `department`, `designation`, `manager_code`, `user_role`, `crm_user_id`, `applicable_discounting_percentage`) VALUES
(1, 9999, 'ADMIN', '', 'admin', 'admin@esds.co.in', '4de93544234adffbb681ed60ffcfb941', 'Admin', 'ADMIN', 0, 1, 1, 99),
(2, 2950, 'Akash', 'Shewale', 'Akash.shewale', 'Akash.Shewale@esds.co.in', '4533dcab532406ee2a900b80ea8da8b4', 'Pre-Sales', 'Jr. Solution Architect', 794, 2, 412, 0),
(3, 3086, 'Akshay', 'Dayma', 'Akshay.Dayma', 'Akshay.Dayma@esds.co.in', '', 'Pre-Sales', 'Jr. Solution Architect', 2334, 2, 452, 0),
(4, 1402, 'Akshay', 'Karandikar', 'Akshay.karandikar', 'akshay.karandikar@esds.co.in', '', 'Pre-Sales', 'Solution Archcitect', 794, 2, 0, 0),
(5, 2176, 'Akshay', 'More', 'akshay.more', 'akshay.more@esds.co.in', '', 'Pre-Sales', 'Solution Archcitect', 794, 2, 282, 0),
(6, 3055, 'Alok', 'Kumar', 'Alok.kumar', 'Alok.Kumar@esds.co.in', '', 'Pre-Sales', 'Jr. Solution Architect', 2941, 2, 413, 0),
(7, 2158, 'Amit', 'Katewa', 'amit.katewa', 'amit.katewa@esds.co.in', '', 'Pre-Sales', 'Solution Archcitect', 821, 2, 274, 0),
(8, 2677, 'Ayushi', 'Malviya', 'Ayushi.Malviya', 'ayushi.malviya@esds.co.in', '', 'Pre-Sales', 'Senior Solution Architect', 2334, 2, 365, 0),
(9, 2175, 'Dhanashri', 'Vispute', 'dhanashri.vispute', 'dhanashri.vispute@esds.co.in', '25f9e794323b453885f5181f1b624d0b', 'Pre-Sales', 'Solution Archcitect', 821, 2, 288, 0),
(10, 2941, 'Dhermender', 'Singh', 'Dhermender.singh', 'Dhermender.Singh@esds.co.in', '', 'Pre-Sales', 'Lead Solution Architect', 211, 2, 411, 0),
(11, 2838, 'Ganesh', 'Aher', 'ganesh.aher', 'Ganesh.A@esds.co.in', '00861f3097d40f276cd7083a83bb78b9', 'Pre-Sales', 'Jr. Solution Architect', 675, 2, 287, 0),
(12, 821, 'Gaurav', 'Godse', 'gaurav.godse', 'gaurav.godse@esds.co.in', 'b95c15297bf2dadeedd66c4222d53f63', 'Pre-Sales', 'Lead Solution Architect', 211, 2, 175, 0),
(13, 2948, 'Harshal', 'Vispute', 'Harshal.vispute', 'Harshal.Vispute@esds.co.in', '', 'Pre-Sales', 'Jr. Solution Architect', 794, 2, 414, 0),
(14, 794, 'Hemant', 'Bhagwat', 'hemant.bhagwat', 'Hemant.Bhagwat@esds.co.in', '', 'Pre-Sales', 'Lead Solution Architect', 211, 2, 168, 0),
(15, 1382, 'Kanchan', 'Kulkarni', 'kanchan.kulkarni', 'kanchan.kulkarni@esds.co.in', '', 'Pre-Sales', 'Senior Executive - Bid Desk', 1868, 2, 178, 0),
(16, 2665, 'Kavish', 'Singh', 'kavish.singh', 'kavish.singh@esds.co.in', '', 'Pre-Sales', 'Bid Coordinator', 1868, 2, 370, 0),
(17, 2820, 'Kavya', 'Jatteppanavar', 'Kavya.jatteppanavar', 'Kavya.Jatteppanavar@esds.co.in', '', 'Pre-Sales', 'Jr. Solution Architect', 2334, 2, 415, 0),
(18, 3044, 'Kunal', 'Godse', 'Kunal.godse', 'Kunal.Godse@esds.co.in', '', 'Pre-Sales', 'Jr. Solution Architect', 211, 2, 416, 0),
(19, 3111, 'Milind', 'Barhate', 'milind.barhate', 'Milind.Barhate@esds.co.in', '2b1b60a735685696bb2ae8b77165bfa1', 'Pre-Sales', 'Senior Executive - Bid Management', 1868, 2, 446, 0),
(20, 1868, 'Neelesh', 'Kumar', 'neelesh.kumar', 'neelesh.kumar@esds.co.in', '', 'Pre-Sales', 'Senior Bid Manager', 211, 2, 183, 0),
(21, 2236, 'Niketan', 'Borse', 'niketan.borse', 'niketan.borse@esds.co.in', '', 'Pre-Sales', 'Executive - Bid Desk', 1868, 2, 273, 0),
(22, 5430, 'Nilesh', 'Kaklij', 'Nilesh.kaklij', 'Nilesh.Kaklij@esds.co.in', 'b5fa8472248a66e937cc4cf2806e01a2', 'Pre-Sales', 'Trainee', 675, 2, 395, 0),
(23, 2964, 'Pooja', 'Kale', 'Pooja.kale', 'Pooja.Kale@esds.co.in', '', 'Pre-Sales', 'Jr. Solution Architect', 675, 2, 417, 0),
(24, 3043, 'Prajakta', 'More', 'Prajakta.more', 'Prajakta.More@esds.co.in', '562cee9da868d406f7dc17b54dc1a610', 'Pre-Sales', 'Jr. Solution Architect', 211, 2, 418, 0),
(25, 3063, 'Prajakta', 'Padwal', 'Prajakta.padwal', 'Prajakta.Padwal@esds.co.in', '', 'Pre-Sales', 'Jr. Solution Architect', 2334, 2, 419, 0),
(26, 2199, 'Prashant', 'Nimbekar', 'prashant.nimbekar', 'prashant.nimbekar@esds.co.in', '7fe4396c785b83cb84d1cd78b7a00434', 'Pre-Sales', 'Solution Archcitect', 821, 2, 285, 0),
(27, 3094, 'Prathamesh', 'Chavan', 'Prathamesh.chavan', 'Prathamesh.Chavan@esds.co.in', '2c9341ca4cf3d87b9e4eb905d6a3ec45', 'Pre-Sales', 'Jr. Solution Architect', 675, 2, 420, 0),
(28, 2968, 'Pratiksha', 'Paithankar', 'Pratiksha.paithankar', 'Pratiksha.Paithankar@esds.co.in', 'a01ebe5b4d8e70ee69447b3a13ffd904', 'Pre-Sales', 'Jr. Solution Architect', 675, 2, 421, 0),
(29, 1558, 'Priyanka', 'Kshirsagar', 'Priyanka.kshirsagar', 'Priyanka.kshirsagar@esds.co.in', '', 'Pre-Sales', 'Senior Executive - Bid Management', 1868, 2, 186, 0),
(30, 2195, 'Priyanka', 'Malunjkar', 'priyanka.malunjkar', 'priyanka.malunjkar@esds.co.in', '', 'Pre-Sales', 'Solution Archcitect', 2334, 2, 289, 0),
(31, 2863, 'Ravikiran', 'Bharadwaj', 'Ravikiran.bharadwaj', 'Ravikiran.Bharadwaj@esds.co.in', '', 'Pre-Sales', 'Solution Archcitect', 675, 2, 422, 0),
(32, 2739, 'Ritika', 'Taneja', 'Ritika.Taneja', 'Ritika.Taneja@esds.co.in', '', 'Pre-Sales', 'Senior Executive - Bid Management', 1868, 2, 375, 0),
(33, 2987, 'Rishan', 'Shaikh', 'Rishan.shaikh', 'Rishan.Shaikh@esds.co.in', '4ef4d3b296aab9434da77e423cff3b8f', 'Pre-Sales', 'Solution Archcitect', 211, 2, 423, 0),
(34, 2821, 'Sagar', 'Kirale', 'Sagar.kirale', 'Sagar.Kirale@esds.co.in', '', 'Pre-Sales', 'Jr. Solution Architect', 2334, 2, 425, 0),
(35, 2822, 'Sai', 'Dhanush', 'Sai.dhanush', 'S.Dhanush@esds.co.in', '', 'Pre-Sales', 'Jr. Solution Architect', 675, 2, 424, 0),
(36, 3121, 'Sairaj', 'Magar', 'sairaj.magar', 'Sairaj.Magar@esds.co.in', '', 'Pre-Sales', 'Solution Archcitect', 211, 2, 426, 0),
(37, 2398, 'Sameer', 'Redij', 'Sameer.Redij', 'sameer@esds.co.in', '', 'Pre-Sales', 'Chief Business Officer', 9999, 1, 314, 55),
(38, 2334, 'Sandeep', 'Mathure', 'sandeep.mathure', 'sandeep.mathure@esds.co.in', '', 'Pre-Sales', 'Lead Solution Architect', 211, 2, 311, 0),
(39, 1167, 'Shahrukh', 'Shaikh', 'shahrukh.shaikh', 'Shahrukh@esds.co.in', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Pre-Sales', 'Solution Archcitect', 675, 2, 193, 0),
(40, 2979, 'Shubham', 'Nagare', 'Shubham.nagare', 'Shubham.Nagare@esds.co.in', '', 'Pre-Sales', 'Jr. Solution Architect', 675, 2, 427, 0),
(41, 2823, 'Suhas', 'Gowda', 'Suhas.gowda', 'Suhas.Gowda@esds.co.in', '', 'Pre-Sales', 'Jr. Solution Architect', 2334, 2, 431, 0),
(42, 2194, 'Tushar', 'Shinde', 'tushar.shinde', 'tushar.shinde@esds.co.in', '', 'Pre-Sales', 'Solution Archcitect', 2334, 2, 270, 0),
(43, 2985, 'Vishal', 'Pawale', 'Vishal.pawale', 'Vishal.Pawale@esds.co.in', '4d1ede6356c1d9d00bccb82aab515b64', 'Pre-Sales', 'Jr. Solution Architect', 675, 2, 430, 0),
(44, 3093, 'Vishal V', 'Patra', 'VishalV.Patra', 'Vishal.Patra@esds.co.in', 'aa9bc13a883166b390dba7aa01300c51', 'Pre-Sales', 'Jr. Solution Architect', 675, 2, 440, 0),
(45, 211, 'Vivek', 'Kharpude', 'vivek.kharpude', 'vivek.k@esds.co.in', '', 'Pre-Sales', 'AVP', 2398, 1, 165, 35),
(46, 675, 'Yogesh', 'Dusane', 'yogesh.dusane', 'yogesh.dusane@esds.co.in', 'd00f5d5217896fb7fd601412cb890830', 'Pre-Sales', 'Lead Solution Architect', 211, 2, 202, 0),
(47, 1238, 'Aditya', 'Alok', 'Aditya.Alok', 'Aditya.Alok@esds.co.in', '', 'Sales', 'Senior Business Manager', 2819, 3, 113, 15),
(48, 2075, 'Aftab', 'Shah', 'Aftab.Shah', 'Aftab.Shah@esds.co.in', '', 'Sales', 'Senior Executive - Digital Business', 2069, 3, 206, 0),
(49, 1459, 'Aftab', 'Memon', 'Aftab.Memon', 'Aftab.Memon@esds.co.in', '', 'Sales', 'Senior Business Manager', 679, 3, 142, 0),
(50, 3159, 'Aman', 'Thakkar', 'Aman.Thakkar', 'Aman.Thakkar@esds.co.in', '', 'Sales', 'Senior Executive - Digital Business', 2308, 3, 451, 0),
(51, 882, 'Amandeep', 'Sidhu', 'Amandeep.Sidhu', 'Amandeep.Sidhu@esds.co.in', '', 'Sales', 'Business Manager', 295, 3, 122, 0),
(52, 2050, 'Amit', 'Sisodiya', 'Amit.Sisodiya', 'Amit.Sisodiya@esds.co.in', '74d750d1e0257756c8aeb9f0165125c1', 'Sales', 'Head-Digital,Business', 2398, 3, 157, 15),
(53, 3215, 'Amit', 'Relkar', '', 'Amit.Relkar@esds.co.in', '', 'Sales', 'Business Development Executive', 424, 3, 0, 0),
(54, 2883, 'Amod', 'Bidnurkar', 'amod.bidnurkar', 'amod.bidnurkar@esds.co.in', '', 'Sales', 'Business Development Manager', 424, 3, 0, 0),
(55, 2660, 'Aniket', 'Deore', 'Aniket.Deore', 'Aniket.Deore@esds.co.in', '', 'Sales', 'Business Coordinator', 70, 3, 364, 0),
(56, 2143, 'Anowarul', 'Islam', 'Anowarul.Islam', 'Anowarul.Islam@esds.co.in', '', 'Sales', 'Regional Director-North East Government & PSU Busi', 1634, 3, 237, 15),
(57, 3001, 'Ashmeet', 'Aurora', '', 'Ashmeet.Aurora@esds.co.in', '', 'Sales', 'Digital Business Executive', 2076, 3, 0, 0),
(58, 2055, 'Bhushan', 'Ahirrao', 'Bhushan.Ahirrao', 'Bhushan.Ahirrao@esds.co.in', '', 'Sales', 'Business Coordinator', 424, 3, 258, 0),
(59, 70, 'Chetan', 'Chandole', 'Chetan.Chandole', 'Chetan.Chandole@esds.co.in', '', 'Sales', 'Regional Director-West Government & PSU Business', 1634, 3, 99, 15),
(60, 1634, 'Deepak', 'Anand', 'Deepak.Anand', 'Deepak.Anand@esds.co.in', '', 'Sales', 'Vice President- Government & PSU Business', 2398, 3, 85, 0),
(61, 2719, 'Dhanaswini', 'Jadhavrao', '', 'Dhanaswini.Jadhavrao@esds.co.in', '', 'Sales', 'Business Coordinator', 424, 3, 0, 0),
(62, 490, 'Husain', 'Telwala', 'Husain.Telwala', 'Husain.Telwala@esds.co.in', '', 'Sales', 'Regional Director-West Government & PSU Business', 1634, 3, 110, 15),
(63, 2069, 'Ishaque', 'Shaikh', 'Ishaque.Shaikh', 'Ishaque.Shaikh@esds.co.in', '', 'Sales', 'Busines Manager - Campaign & Database', 2050, 3, 262, 0),
(64, 2826, 'Jitendra', 'Razdan', 'Jitendra.Razdan', 'Jitendra.Razdan@esds.co.in', '', 'Sales', 'Senior Business Manager', 424, 3, 394, 0),
(65, 3233, 'Kanika', 'Aggarwal', '', 'Kanika.Aggarwal@esds.co.in', '', 'Sales', 'Business Development Executive', 295, 3, 0, 0),
(66, 3100, 'Karan', 'Jobanputra', 'Karan.Jobanputra', 'Karan.Jobanputra@esds.co.in', '', 'Sales', 'Sales Executive', 679, 3, 437, 0),
(67, 2905, 'Karan', 'Thakur', 'Karan.Thakur', 'Karan.Thakur@esds.co.in', '', 'Sales', 'Business Development Executive', 424, 3, 449, 0),
(68, 2727, 'Kedar', 'Kumbhar', 'Kedar.kumbhar', 'Kedar.kumbhar@esds.co.in', '', 'Sales', 'Senior Executive - Digital Business', 2076, 3, 0, 0),
(69, 2637, 'Komal', 'Bramhane', 'Komal.Bramhane', 'Komal.Bramhane@esds.co.in', '', 'Sales', 'Executive - Digital Business', 2076, 3, 357, 0),
(70, 679, 'Lokesh', 'Sharma', 'Lokesh.Sharma', 'Lokesh.Sharma@esds.co.in', '', 'Sales', 'Regional Director-West Government & PSU Business', 1634, 3, 100, 15),
(71, 379, 'Mahavir', 'Goel', 'Mahavir.Goel', 'Mahavir.Goel@esds.co.in', '', 'Sales', 'Regional Director-North Enterprise Business', 2819, 3, 96, 15),
(72, 2270, 'Misha', 'Maikhuri', 'Misha.Maikhuri', 'Misha.Maikhuri@esds.co.in', '', 'Sales', 'Assistant Manager - Digital Business', 2308, 3, 251, 0),
(73, 2453, 'Mitesh', 'Bharadwaj', 'Mitesh.Bharadwaj', 'Mitesh.Bharadwaj@esds.co.in', '', 'Sales', 'Business Manager', 424, 3, 327, 15),
(74, 3247, 'Naman', 'Garg', '', 'Naman.Garg@esds.co.in', '', 'Sales', 'Business Development Executive', 295, 3, 0, 0),
(75, 3084, 'Nehal', 'Gandhi', 'Nehal.Gandhi', 'Nehal.Gandhi@esds.co.in', '', 'Sales', 'Regional Director- West Enterprise Business', 2819, 3, 436, 15),
(76, 2433, 'Netaji', 'Bhople', 'Netaji.Bhople', 'Netaji.Bhople@esds.co.in', '', 'Sales', 'Senior Executive - MIS', 2069, 3, 324, 0),
(77, 3171, 'Nikita', 'D\'sa', '', 'Nikita.more@esds.co.in', '', 'Sales', 'Senior Executive - Digital Business', 2076, 3, 0, 0),
(78, 2568, 'Nisha', 'Wadale', 'Nisha.Wadale', 'Nisha.Wadale@esds.co.in', '', 'Sales', 'Business Analyst -Business Data', 2398, 3, 378, 0),
(79, 754, 'Nitin', 'Kubitkar', 'Nitin.Kubitkar', 'Nitin.Kubitkar@esds.co.in', '', 'Sales', 'Relationship Manager', 70, 3, 132, 0),
(80, 2068, 'Noorulla', 'Haq', 'Noorulla.Haq', 'Noorulla.Haq@esds.co.in', '', 'Sales', 'Business Manager - Digital Business', 2050, 3, 213, 0),
(81, 2308, 'Pallavi', 'Mishra', 'Pallavi.Mishra', 'Pallavi.Mishra@esds.co.in', '', 'Sales', 'Business Manager - Digital Business', 2050, 3, 292, 0),
(82, 2542, 'Pankaj', 'Beniwal', 'Pankaj.Beniwal', 'Pankaj.Beniwal@esds.co.in', '', 'Sales', 'Executive - Digital Business', 2069, 3, 342, 0),
(83, 2848, 'Pooja', 'Bhogekar', 'Pooja.Bhogekar', 'Pooja.Bhogekar@esds.co.in', '', 'Sales', 'Digital Business Executive', 2308, 3, 405, 0),
(84, 1427, 'Pooja', 'Singh', 'Pooja.Singh', 'Pooja.Singh@esds.co.in', '', 'Sales', 'Business Development Executive', 490, 3, 254, 0),
(85, 3072, 'Pooja', 'Tiwari', 'Pooja.Tiwari', 'Pooja.Tiwari@esds.co.in', '', 'Sales', 'Business Coordinator', 424, 3, 447, 0),
(86, 1694, 'Pramit', 'Gandhi', 'Pramit.Gandhi', 'Pramit.Gandhi@esds.co.in', '', 'Sales', 'Senior Business Manager', 679, 3, 140, 0),
(87, 3221, 'Pravin', 'Deshpande', '', 'Pravin.Deshpande@esds.co.in', '', 'Sales', 'Senior Sales Manager', 424, 3, 0, 0),
(88, 2889, 'Rajat', 'Basu', 'Rajat.Basu', 'Rajat.Basu@esds.co.in', '', 'Sales', 'Regional Business Manager-East Enterprise', 2819, 3, 404, 15),
(89, 2427, 'Rakesh', 'Chandgude', '', 'Rakesh.Chandgude@esds.co.in', '', 'Sales', 'Business Manager', 490, 3, 0, 0),
(90, 707, 'Ravi', 'Shandilya', 'Ravi.Shandilya', 'Ravi.Shandilya@esds.co.in', '', 'Sales', 'Business Manager', 295, 3, 135, 0),
(91, 2543, 'Rishi', 'Vijan', 'Rishi.Vijan', 'Rishi.Vijan@esds.co.in', '', 'Sales', 'Senior Executive - Digital Business', 2308, 3, 343, 0),
(92, 1941, 'Ritu', 'Gupta', 'Ritu.Gupta', 'Ritu.Gupta@esds.co.in', '', 'Sales', 'Business Manager - Digital Business', 2050, 3, 261, 0),
(93, 2586, 'Roshni', 'Maind', 'Roshni.Maind', 'Roshni.Maind@esds.co.in', '', 'Sales', 'Junior Business Coordinator', 424, 3, 448, 0),
(94, 3170, 'S.N', 'Sharma', '', 'snsharma@esds.co.in', '', 'Sales', 'Assistant General Manager', 424, 3, 0, 0),
(95, 295, 'Sanchit', 'Taraiya', 'sanchit.t', 'sanchit@esds.co.in', '', 'Sales', 'Regional Director-North Government & PSU Business', 1634, 3, 0, 15),
(96, 5471, 'Sanchita', 'Chalke', '', 'Sanchita.Chalke@esds.co.in', '', 'Sales', 'Trainee', 2069, 3, 0, 0),
(97, 2819, 'Sandeep', 'Khanna', 'Sandeep.Khanna', 'Sandeep.Khanna@esds.co.in', '', 'Sales', 'Vice President- Enterprise Business', 2398, 3, 434, 15),
(98, 424, 'Sandesh', 'Sonar', 'Sandesh.Sonar', 'Sandesh.Sonar@esds.co.in', '', 'Sales', 'Head-Coopeeratives Agriculture&Healthcare', 2398, 3, 89, 0),
(99, 3234, 'Sangeet', 'Kadiyan', '', 'Sangeet.Kadiyan@esds.co.in', '', 'Sales', 'General Manager', 2819, 3, 0, 0),
(100, 1939, 'Satrujeet', 'Mohanty', 'Satrujeet.Mohanty', 'Satrujeet.Mohanty@esds.co.in', '', 'Sales', 'Business Manager', 295, 3, 115, 0),
(101, 3205, 'Saurav', 'Chakravorty', 'Saurav.Chakravorty', 'Saurav.Chakravorty@esds.co.in', '', 'Sales', 'Senior Business Manager', 2398, 3, 233, 0),
(102, 1281, 'Sayali', 'Jadhav', 'Sayli.Jadhav', 'Sayli.Jadhav@esds.co.in', '', 'Sales', 'Senior Analyst-Business Data', 2398, 3, 0, 0),
(103, 2210, 'Shoaib', 'Shaikh', 'Shoaib.Shaikh', 'Shoaib.Shaikh@esds.co.in', '', 'Sales', 'Assistant Manager - Digital Business', 2076, 3, 240, 0),
(104, 2420, 'Shreyas', 'Shetye', 'Shreyas.Shetye', 'Shreyas.Shetye@esds.co.in', '', 'Sales', 'Business Manager', 490, 3, 326, 0),
(105, 3216, 'Shruti', 'Sharma', '', 'Shruti.Sharma@esds.co.in', '', 'Sales', 'Sr. Business Development Executive', 490, 3, 0, 0),
(106, 2394, 'Simran', 'Sawant', 'Simran.Sawant', 'Simran.Sawant@esds.co.in', '', 'Sales', 'Executive - Digital Business', 2076, 3, 317, 0),
(107, 777, 'Simran', 'Kaur', 'Simran.Kaur', 'Simran.Kaur@esds.co.in', '', 'Sales', 'Digital Business Manager', 295, 3, 207, 0),
(108, 2452, 'Sonali', 'Khelukar', 'Sonali.Khelukar', 'Sonali.Khelukar@esds.co.in', '', 'Sales', 'Business Coordinator', 679, 3, 329, 0),
(109, 3238, 'Sudesh', 'Saxena', '', 'Sudesh.Saxena@esds.co.in', '', 'Sales', 'Assistant General Manager', 1634, 3, 0, 0),
(110, 3149, 'Sujay', 'Sen', 'Sujay.Sen', 'Sujay.Sen@esds.co.in', '', 'Sales', 'Deputy General Manager', 2819, 3, 450, 15),
(111, 2688, 'Sybil', 'Farnandes', 'Sybil.Fernandes', 'Sybil.Fernandes@esds.co.in', '', 'Sales', 'Executive - Digital Business', 2069, 3, 0, 0),
(112, 1922, 'Tejas', 'Joshi', 'Tejas.Joshi', 'Tejas.Joshi@esds.co.in', '', 'Sales', 'Sales Manager', 70, 3, 117, 0),
(113, 2038, 'Utpal', 'Saha', 'Utpal.Saha', 'Utpal.Saha@esds.co.in', '', 'Sales', 'Regional Director-East Government & PSU Business', 1634, 3, 119, 15),
(114, 20026, 'Virender', 'Verma', '', 'Virender.Verma@esds.co.in', '', 'Sales', 'Assistant General Manager', 2819, 3, 0, 0),
(115, 2076, 'Yashwant', 'Malkar', 'Yashwant.Malkar', 'Yashwant.Malkar@esds.co.in', '', 'Sales', 'Business Manager - Digital Business', 2050, 3, 162, 0),
(116, 11, 'Demo', 'Sales1', 'demo.sales1', 'demo@esds.co.in', 'e0ed18dc67b295f9518eaead0edcbfff', 'sales', 'sales', 9999, 3, 454, 0),
(117, 12, 'Demo', 'Sales2', 'demo.sales2', 'demo@esds.co.in', 'de34ca02307b653e146eb3798e4d5713', 'sales', 'sales', 9999, 3, 454, 0),
(118, 13, 'Demo', 'Sales3', 'demo.sales3', 'demo@esds.co.in', '6bbbd8ef0467357886c90bd4c8020f5e', 'sales', 'sales', 9999, 3, 454, 0),
(119, 14, 'Demo', 'Sales4', 'demo.sales4', 'demo@esds.co.in', 'e34f80ca469ea6fec995f3cd8f5650fa', 'sales', 'sales', 9999, 3, 454, 0);

-- --------------------------------------------------------

--
-- Table structure for table `permission_master`
--

CREATE TABLE `permission_master` (
  `id` int(11) NOT NULL,
  `permission` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permission_master`
--

INSERT INTO `permission_master` (`id`, `permission`) VALUES
(1, 'Export To Excel'),
(2, 'Push To CRM'),
(3, 'Discounting'),
(4, 'Create Quot'),
(5, 'Edit quot'),
(6, 'Forget Password'),
(7, 'Create Private Rate Card'),
(8, 'Edit Rate Card'),
(9, 'View Rate Card'),
(10, 'Change Rate Card Visibility'),
(11, 'Create Public Rate Card'),
(12, 'Approve Discount'),
(13, 'Modify Discount');

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `id` int(11) NOT NULL,
  `sku_code` varchar(18) DEFAULT NULL,
  `region` int(11) NOT NULL,
  `crm_group_id` int(11) NOT NULL,
  `primary_category` varchar(25) NOT NULL,
  `sec_category` varchar(25) NOT NULL,
  `default_int` varchar(30) NOT NULL,
  `default_name` text NOT NULL,
  `prod_int` varchar(30) NOT NULL,
  `product` text NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`id`, `sku_code`, `region`, `crm_group_id`, `primary_category`, `sec_category`, `default_int`, `default_name`, `prod_int`, `product`, `is_active`) VALUES
(1, 'OT00000000000000', 0, 49, 'otc', 'otc', 'otc', 'One Time Cost', 'otc', 'otc-5', 1),
(2, 'STAS000000000000', 0, 8, 'storage', 'archive_storage', 'arc_strg', 'Archive Storage ', 'arc_strg', 'Archive Storage ', 1),
(3, 'STOREC0000000000', 0, 8, 'storage', 'object_storage', 'obj_strg', 'eCOS-Object Storage - Storage', 'obj_strg', 'Object Storage  1 IOPS per GB  ', 1),
(4, 'CCSTNKBTP3000000', 0, 7, 'storage', 'block_storage', 'block_03', 'Block Storage 0.3 IOPS per GB ', 'block_03', 'Block Storage 0.3 IOPS per GB ', 1),
(5, 'CCSTNKBTI1000000', 0, 7, 'storage', 'block_storage', 'block_1', 'Block Storage  1 IOPS per GB  ', 'block_1', 'Block Storage 1 IOPS per GB ', 1),
(6, 'CCSTNKBTI2000000', 0, 7, 'storage', 'block_storage', 'block_2', 'Block Storage 2 IOPS per GB ', 'block_2', 'Block Storage 2 IOPS per GB ', 1),
(7, 'CCSTNKBTI3000000', 0, 7, 'storage', 'block_storage', 'block_3', 'Block Storage 3 IOPS per GB  ', 'block_3', 'Block Storage 3 IOPS per GB ', 1),
(8, 'CCSTNKBTI4000000', 0, 7, 'storage', 'block_storage', 'block_4', 'Block Storage 4 IOPS per GB ', 'block_4', 'Block Storage 4 IOPS per GB ', 1),
(9, 'CCSTNKBTI5000000', 0, 7, 'storage', 'block_storage', 'block_5', 'Block Storage 5 IOPS per GB  ', 'block_5', 'Block Storage 5 IOPS per GB ', 1),
(10, 'CCSTNKBTI6000000', 0, 7, 'storage', 'block_storage', 'block_6', 'Block Storage 6 IOPS per GB ', 'block_6', 'Block Storage 6 IOPS per GB ', 1),
(11, 'CCSTNKBTI7000000', 0, 7, 'storage', 'block_storage', 'block_7', 'Block Storage 7 IOPS per GB ', 'block_7', 'Block Storage 7 IOPS per GB ', 1),
(12, 'CCSTNKBTI8000000', 0, 7, 'storage', 'block_storage', 'block_8', 'Block Storage 8 IOPS per GB  ', 'block_8', 'Block Storage 8 IOPS per GB ', 1),
(13, 'CCSTNKBTI9000000', 0, 7, 'storage', 'block_storage', 'block_9', 'Block Storage 9 IOPS per GB ', 'block_9', 'Block Storage 9 IOPS per GB ', 1),
(14, 'CCSTNKBTP1000000', 0, 7, 'storage', 'block_storage', 'block_10', 'Block Storage 10 IOPS per GB  ', 'block_10', 'Block Storage 10 IOPS per GB ', 1),
(15, 'CCSTNKBT15000000', 0, 7, 'storage', 'block_storage', 'block_15', 'Block Storage 15 IOPS per GB ', 'block_15', 'Block Storage 15 IOPS per GB ', 1),
(16, 'CCSTNKBTP2000000', 0, 7, 'storage', 'block_storage', 'block_20', 'Block Storage 20 IOPS per GB ', 'block_20', 'Block Storage 20 IOPS per GB ', 1),
(17, 'CCSTNKBT25000000', 0, 7, 'storage', 'block_storage', 'block_25', 'Block Storage 25 IOPS per GB ', 'block_25', 'Block Storage 25 IOPS per GB ', 1),
(18, 'CCSTNKBTP3000000', 0, 7, 'storage', 'block_storage', 'block_30', 'Block Storage 30 IOPS per GB ', 'block_30', 'Block Storage 30 IOPS per GB ', 1),
(19, 'CCSTNKBTP4000000', 0, 7, 'storage', 'block_storage', 'block_40', 'Block Storage 40 IOPS per GB ', 'block_40', 'Block Storage 40 IOPS per GB ', 1),
(20, 'CCSTNKBTP5000000', 0, 7, 'storage', 'block_storage', 'block_50', 'Block Storage 50 IOPS per GB ', 'block_50', 'Block Storage 50 IOPS per GB ', 1),
(21, 'CCSTNKBTH1000000', 0, 7, 'storage', 'block_storage', 'block_100', 'Block Storage 100 IOPS per GB ', 'block_100', 'Block Storage 100 IOPS per GB ', 1),
(22, 'EKCB000000000000', 0, 38, 'storage', 'backup_soft', 'carbonite', 'Backup Agent', 'carbonite', 'Backup Agent - Carbonite ', 1),
(23, 'SOBAVM0000000000', 0, 11, 'storage', 'backup_soft', 'veeam', 'Backup Agent', 'veeam', 'Backup Agent - Veeam ', 1),
(24, 'STTL000000000000', 0, 8, 'storage', 'offline_backup', 'tl', 'Tape Library', 'tl', 'Tape Library', 1),
(27, 'ESSRDWWM00000000', 0, 3, 'security', 'ssl_certificate', 'ssl_certificate', 'SSL Certificate', 'domain_wild_ssl', 'Domain SSL Wild Card ', 1),
(28, 'MSEGFWVT00000000', 0, 12, 'managed', 'firewall_mgmt', 'firewall_mgmt', 'Firewall Managed Services', 'vfirewall_mgmt', 'Virtual Firewall External - Managed Services ', 1),
(29, 'ESSRADDVWD000000', 0, 3, 'security', 'ssl_certificate', 'ssl_certificate', 'SSL Certificate', 'alpha_wild_ssl', 'Alpha SSL Wild Card ', 1),
(30, 'ICUTVU0000000000', 0, 3, 'security', 'utm', 'utm', 'Virtual UTM- 1 Gpbs', 'utm', 'Virtual UTM- 1 Gpbs', 1),
(31, 'ESSROL0000000000', 0, 3, 'security', 'ssl_certificate', 'ssl_certificate', 'SSL Certificate', 'org_wild_ssl', 'Organizational SSL Wild Card ', 1),
(32, 'ICTS3S0000000000', 0, 3, 'security', 'vtm_scan', 'vtm_scan', 'VTM Scan', 'vtm_scan_30', 'VTMScan -30Scan', 1),
(33, 'ICTS6S0000000000', 0, 3, 'security', 'vtm_scan', 'vtm_scan', 'VTM Scan', 'vtm_scan_60', 'VTMScan - 60Scan', 1),
(34, 'ESSRDC0000000000', 0, 3, 'security', 'ssl_certificate', 'ssl_certificate', 'SSL Certificate', 'domain_ssl', 'Domain SSL ', 1),
(35, 'ICTS1S0000000000', 0, 3, 'security', 'vtm_scan', 'vtm_scan', 'VTM Scan', 'vtm_scan_1', 'VTMScan- 1Scan', 1),
(36, 'ICTS4S0000000000', 0, 3, 'security', 'vtm_scan', 'vtm_scan', 'VTM Scan', 'vtm_scan_4', 'VTMScan 4Scan', 1),
(37, 'ESSRADDV00000000', 0, 3, 'security', 'ssl_certificate', 'ssl_certificate', 'SSL Certificate', 'alpha_ssl', 'Alpha SSL ', 1),
(38, 'MSEGFWUM00000000', 0, 12, 'managed', 'firewall_mgmt', 'firewall_mgmt', 'Firewall Managed Services', 'utm_mgmt', 'vUTM Firewall - Managed Services ', 1),
(39, 'ESSROZ0000000000', 0, 3, 'security', 'ssl_certificate', 'ssl_certificate', 'SSL Certificate', 'org_ssl', 'Organizational SSL ', 1),
(40, 'ESSREXSF00000000', 0, 2, 'security', 'ssl_certificate', 'ssl_certificate', 'SSL Certificate', 'ext_ssl', 'Extended SSL - SSL-Internal Security ', 1),
(41, 'MSBM000000000000', 0, 12, 'managed', 'storage_mgmt', 'backup_mgmt', 'Backup Management', 'backup_mgmt', 'Backup Management - Managed Services ', 1),
(42, 'MSTN000000000000', 0, 12, 'managed', 'storage_mgmt', 'strg_mgmt', 'Storage Management', 'strg_mgmt', 'Storage Management (Per TB) Mng - Managed Services ', 1),
(43, 'STBS000000000000', 0, 8, 'storage', 'backup', 'backup_gb', 'Backup Storage', 'backup_gb', 'Backup Storage', 1),
(44, 'MSDMMG0000000000', 0, 12, 'managed', 'db_mgmt', 'db_mgmt', 'Database Managed Services', 'mong_db_mgmt', 'MongoDB Database Managed Services', 1),
(45, 'MSDMOA0000000000', 0, 12, 'managed', 'db_mgmt', 'db_mgmt', 'Database Managed Services', 'orc_db_mgmt', 'Oracle Database Managed Services', 1),
(46, 'MSDMSD0000000000', 0, 12, 'managed', 'db_mgmt', 'db_mgmt', 'Database Managed Services', 'syb_db_mgmt', 'Sybase Database Managed Services', 1),
(47, 'MSOGDD0000000000', 0, 12, 'managed', 'dr_drill', 'dr_drill', 'DR Drill', 'dr_drill', 'DR Drill (Per Application) ', 1),
(48, 'MSOGRA0000000000', 0, 12, 'managed', 'rep_mgmt', 'rep_mgmt', 'Replication Link Management', 'rep_mgmt', 'Replication Mng - Managed Services ', 1),
(49, 'MSDMMQ0000000000', 0, 12, 'managed', 'db_mgmt', 'db_mgmt', 'Database Managed Services', 'ms_db_mgmt', 'MSSQL Database Managed Services', 1),
(50, 'MSDMMY0000000000', 0, 12, 'managed', 'db_mgmt', 'db_mgmt', 'Database Managed Services', 'my_db_mgmt', 'MYSQL Database Managed Services', 1),
(51, 'MSDMPS0000000000', 0, 12, 'managed', 'db_mgmt', 'db_mgmt', 'Database Managed Services', 'post_db_mgmt', 'PostgresSQL Database Managed Services', 1),
(52, 'CCVRAT0000000000', 0, 7, 'compute', 'vRAM', 'compute', 'RAM', 'vram_static', 'vRAM Static- Compute ', 1),
(53, 'CCVCVE0000000000', 0, 7, 'compute', 'vCPU', 'compute', 'CPU', 'vcpu_elastic', 'vCPU Elastic Cloud - Compute ', 1),
(54, 'CCVRRL0000000000', 0, 7, 'compute', 'vRAM', 'compute', 'RAM', 'vram_elastic', 'vRAM Elastic Cloud- Compute ', 1),
(55, 'CCVCVS0000000000', 0, 7, 'compute', 'vCPU', 'compute', 'CPU', 'vcpu_static', 'vCPU Static Cloud- Compute ', 1),
(56, 'ICSIFSNANA000000', 0, 3, 'security', 'siem', 'siem', 'SIEM', 'forti_siem', 'Forti - SIEM - Internal Security ', 1),
(57, 'ESVANV0000000000', 0, 4, 'security', 'vapt', 'vapt', 'VAPT Audit', 'noncert_vapt', 'NON CERT IN- VAPT Audit ', 1),
(58, 'CNIBVB0000000000', 0, 2, 'network', 'bandwidth', 'bandwidth', 'Bandwidth', 'volume_band', 'Volume Based : Internet Bandwidth ', 1),
(59, 'CNIBSB0000000000', 0, 2, 'network', 'bandwidth', 'bandwidth', 'Bandwidth', 'speed_band', 'Speed Based : Internet Bandwidth', 1),
(60, 'ESDIIDAI00000000', 0, 4, 'security', 'ddos', 'ddos', 'DDOS Mitigation', 'ddos', 'DDOS Mitigation - 1Gbps', 1),
(61, 'ICSICS0000000000', 0, 3, 'security', 'siem', 'siem', 'SIEM', 'seceon_siem', 'SECEON - SIEM - Internal Security ', 1),
(62, 'ICSIOSIQ00000000', 0, 3, 'security', 'siem', 'siem', 'SIEM', 'ibm_siem', 'IBM Qradar - SIEM - Internal Security ', 1),
(63, 'CN00000000000000', 0, 2, 'network', 'link', 'link', 'Replication Link', 'mpls_link', 'MPLS Link', 1),
(64, 'ESVACVSQ00000000', 0, 4, 'security', 'vapt', 'vapt', 'VAPT Audit', 'cert_vapt', 'CERTIN- VAPT Audit ', 1),
(65, 'CNPP000000000000', 0, 2, 'network', 'link', 'link', 'Replication Link', 'p2p_link', 'P2P Link', 1),
(66, '', 0, 3, 'security', 'soar', 'soar', 'Security orchestration, automation and response ', 'soar', 'Security orchestration, automation and response ', 0),
(67, 'MSRMDR0000000000', 0, 12, 'software', 'drm', 'drm', 'DRM Tool', 'veeam_drm', 'DRM -Software- veeam ', 1),
(68, 'SODRCR0000000000', 0, 11, 'software', 'drm', 'drm', 'DRM Tool', 'carb_drm', 'DRM -Software- Carbonite ', 1),
(69, 'ICWAVWEV00000000', 0, 3, 'security', 'waf', 'waf', 'Web App Firewall', 'enligh_vwaf_1gbps', 'eNlight - VWAF - 1Gbps', 1),
(70, 'ICWAVWOWFN000000', 0, 3, 'security', 'waf', 'waf', 'Web App Firewall', 'fortinet _ vwaf_1gbps', 'Fortinet - VWAF - 1Gbps', 1),
(71, 'ICFWVFIFFN000000', 0, 3, 'security', 'ifw', 'ifw', 'Internal Firewall', 'ifw_fortinet_1gbps', 'Fortinet - Virtual Internal Firewall - 1 Gpbs', 1),
(72, 'ICFWVFEFPO000000', 0, 3, 'security', 'ifw', 'ifw', 'Internal Firewall', 'ifw_palo_1gbps', 'PALO ALTO - Virtual Internal Firewall - 1 Gpbs', 1),
(73, 'CNRTCO1G00000000', 0, 2, 'network', 'net', 'port_termition', 'Port Termination', 'copper_port_1g', 'Copper-1 Gig -Port Termination - Connectivity ', 1),
(74, 'CNRTCO0G00000000', 0, 2, 'network', 'net', 'port_termition', 'Port Termination', 'copper_port_10g', 'Copper -10 Gig-Port Termination - Connectivity ', 1),
(75, 'MSEGEVWB00000000', 0, 12, 'managed', 'waf_mgmt', 'waf_mgmt', 'Web App Firewall Managed Services', 'esds_waf_mgmt', 'ESDS vWAF - Managed Services ', 1),
(76, 'CNNR000000000000', 0, 2, 'network', 'net', 'cross_connect', 'Cross Connect', 'cross_connect', 'Cross-connect', 1),
(77, '', 0, 3, 'security', 'hsm', 'hsm', 'Hardware Security Module', 'dedicate_hsm', 'Hardware Security Module - Dedicated ', 0),
(78, 'SOLPDETDDD000000', 0, 51, 'security', 'dlp', 'dlp', 'DLP', 'dlp', 'DLP ', 1),
(79, '', 0, 3, 'security', 'hsm', 'hsm', 'Hardware Security Module', 'shared_hsm', 'Hardware Security Module - Shared ', 0),
(80, 'CNVPIV0000000000', 0, 2, 'network', 'vpn', 'ipsec_vpn', 'IPSEC VPN', 'ipsec_vpn', 'IPSEC-VPN - Connectivity ', 1),
(81, 'ESPDMEAR00000000', 0, 4, 'security', 'pim', 'pim', 'PIM', 'pim', 'Priviledge Identity Management-OEM ', 1),
(82, '', 0, 3, 'security', 'pim', 'pim', 'Priviledge Identity Management', 'iraje_pim', 'iRaje- Priviledge Identity Management-OEM ', 0),
(83, 'CNVPSV0000000000', 0, 2, 'network', 'vpn', 'ssl_vpn', 'SSL VPN', 'ssl_vpn', 'SSL-VPN - Connectivity ', 1),
(84, 'CNVPWVDP00000000', 0, 2, 'network', 'vpn', 'web_vpn', 'WEB VPN', 'web_vpn', 'ESDS-WEB VPN -VPN - Connectivity ', 1),
(85, 'SOCMEO0000000000', 0, 12, 'managed', 'emagic', 'emagic', 'eMagic', 'emagic', 'eMagic- Cloud Monitoring ', 1),
(86, 'ESIAUS0000000000', 0, 4, 'security', 'iam', 'iam', 'Identity Access Management ', 'iam', 'Identity Access Management ', 1),
(87, '', 0, 3, 'security', 'edr', 'edr', 'Endpoint Detection & Response Service ', 'edr', 'Endpoint Detection & Response Service ', 0),
(88, 'ESDMMf0000000000', 0, 4, 'security', 'dam', 'dam', 'Database activity monitoring  ', 'mc_dam', 'McAfee - Database activity monitoring ', 1),
(89, 'ESDMED0000000000', 0, 4, 'security', 'dam', 'dam', 'Database activity monitoring  ', 'enlight_dam', 'ESDS - Database activity monitoring ', 1),
(90, 'ESMFEMSP00000000', 0, 4, 'security', 'mfa', 'mfa', 'Multi Factor Authentication', 'mfa', 'OEM MFA Fortinet ', 1),
(91, 'SOMQXE0000000000', 0, 11, 'compute', 'db', 'compute', 'Database', 'ms_express', 'MSSQL-Express-Software ', 1),
(92, 'SOPSCE0000000000', 0, 11, 'compute', 'db', 'compute', 'Database', 'post_com', 'PostgreSQL-DB-Community ', 1),
(93, 'SOMGCE0000000000', 0, 11, 'compute', 'db', 'compute', 'Database', 'mong_com', 'MongoDB - Community ', 1),
(94, 'SOD2CE0000000000', 0, 11, 'compute', 'db', 'compute', 'Database', 'orc_db2_comm', 'DB2 - Community ', 1),
(95, 'SOOANU0000000000', 0, 11, 'compute', 'db', 'compute', 'Database', 'orc_nup', 'OracleDB-NUP ', 1),
(96, 'SOOAEE0000000000', 0, 11, 'compute', 'db', 'compute', 'Database', 'orc_ent', 'OracleDB-Enterprise ', 1),
(97, 'SOWSSE0000000000', 0, 11, 'compute', 'os', 'compute', 'Operating System', 'win_se', 'Windows Standard Edition ', 1),
(98, 'SOWSDE0000000000', 0, 11, 'compute', 'os', 'compute', 'Operating System', 'win_dc', 'Windows Data Center Edition ', 1),
(99, 'SOLONC0000000000', 0, 11, 'compute', 'os', 'compute', 'Operating System', 'centos', 'Linux : CentOS ', 1),
(100, 'SOLOUB0000000000', 0, 11, 'compute', 'os', 'compute', 'Operating System', 'ubuntu', 'Linux : Ubuntu ', 1),
(101, 'SORROP0000000000', 0, 11, 'compute', 'os', 'compute', 'Linux : Oracle Linux', 'orc_linux', 'Linux : Oracle Linux', 1),
(102, 'SOMQSE0000000000', 0, 11, 'compute', 'db', 'compute', 'Database', 'ms_std', 'MSSQL-STD ', 1),
(103, 'SOMQEE0000000000', 0, 11, 'compute', 'db', 'compute', 'Database', 'ms_ent', 'MSSQL-Enterprise ', 1),
(104, 'SOMQVD0000000000', 0, 11, 'compute', 'db', 'compute', 'Database', 'ms_dev', 'MSSQL-Development-Software ', 1),
(105, 'SOMQWD0000000000', 0, 11, 'compute', 'db', 'compute', 'Database', 'ms_web', 'MSSQL-Web-Software ', 1),
(106, 'SOMYCE0000000000', 0, 11, 'compute', 'db', 'compute', 'Database', 'my_com', 'MYSQL-Community ', 1),
(107, 'SOMYSE0000000000', 0, 11, 'compute', 'db', 'compute', 'Database', 'my_std', 'MYSQL-Standard ', 1),
(108, 'SOMYEE0000000000', 0, 11, 'compute', 'db', 'compute', 'Database', 'my_ent', 'MYSQL-Enterprise ', 1),
(109, 'SOLORE0000000000', 0, 11, 'compute', 'os', 'compute', 'Operating System', 'rhel', 'Linux : RHEL ', 1),
(110, 'SOLOSU0000000000', 0, 11, 'compute', 'os', 'compute', 'Operating System', 'suse', 'Linux : SUSE ', 1),
(111, 'MSNMLMVI00000000', 0, 12, 'managed', 'lb_mgmt', 'lb_mgmt', 'Load Balancer Management', 'virt_lb_mgmt', 'Virtual Load Balancer Management', 1),
(112, 'ESAVBASM00000000', 0, 4, 'compute', 'av', 'compute', 'Anti Virus', 'sym_av_basic', 'SYMENTEC - Basic Antivirus ', 1),
(113, 'MSOYLINU00000000', 0, 12, 'managed', 'os_mgmt', 'os_mgmt', 'OS Management', 'centos_mgmt', 'CENTOS Operating System Managed Services', 1),
(114, 'MSOYLIUB00000000', 0, 12, 'managed', 'os_mgmt', 'os_mgmt', 'OS Management', 'ubuntu_mgmt', 'UBUNTU Operating System Managed Services ', 1),
(115, 'ESAVBATM00000000', 0, 4, 'compute', 'av', 'compute', 'Anti Virus', 'tm_av_basic', 'Trend Micro - Basic Antivirus ', 1),
(116, 'ESAVBAMA00000000', 0, 4, 'compute', 'av', 'compute', 'Anti Virus', 'mc_av_basic', 'McAfee - Basic Antivirus ', 1),
(117, 'ESAVAHSM00000000', 0, 4, 'compute', 'av', 'compute', 'Anti Virus', 'sym_av_hips', 'SYMENTEC - AV + HIPS ', 1),
(118, 'ESAVAHSM00000000', 0, 4, 'compute', 'av', 'compute', 'Anti Virus', 'tm_av_hips', 'Trend Micro - AV + HIPS ', 1),
(119, 'ESAVAHMA00000000', 0, 4, 'compute', 'av', 'compute', 'Anti Virus', 'mc_av_hips', 'McAfee - AV + HIPS ', 1),
(120, 'MSOYLIRE00000000', 0, 12, 'managed', 'os_mgmt', 'os_mgmt', 'OS Management', 'rhel_mgmt', 'RHEL - OSMng- Managed Services ', 1),
(121, 'MSOYLISU00000000', 0, 12, 'managed', 'os_mgmt', 'os_mgmt', 'OS Management', 'suse_mgmt', 'SUSE - OSMng- Managed Services ', 1),
(122, 'MSOYLISS00000000', 0, 12, 'managed', 'os_mgmt', 'os_mgmt', 'OS Management', 'hana_mgmt', 'SUSE HANA Failover OSMng - Managed Services ', 1),
(123, 'MSOYWI0000000000', 0, 12, 'managed', 'os_mgmt', 'os_mgmt', 'OS Management', 'win_mgmt', 'Windows Operating System Managed Services', 1),
(124, 'INLBVLHP00000000', 0, 6, 'network', 'lb', 'lb', 'Load Balancer', 'vlb_proxy_1G', 'HA Proxy - Virtual Load Balancer - 1 Gpbs', 1),
(125, 'INIPPII400000000', 0, 6, 'network', 'ip', 'ip', 'IP Address', 'ipv4', 'IPv4- Public IP ', 1),
(126, 'INIPPII600000000', 0, 6, 'network', 'ip', 'ip', 'IP Address', 'ipv6', 'IPv6 - Public IP ', 1),
(127, 'STLD000000000000', 0, 8, 'storage', 'offline_backup', 'tc', 'Tape Catridge', 'tc', 'Tape Catridge', 1),
(128, 'MSETIE0000000000', 0, 12, 'managed', 'soc_mgmt', 'soc_mgmt', 'Eagle Eye Monitoring Service', 'eagle_mont', 'Eagle Eye Monitoring Service', 1),
(129, 'MSAM000000000000', 0, 12, 'managed', 'av_mgmt', 'av_mgmt', 'Anti Virus Management', 'av_mgmt', 'Anti Virus Management', 1),
(130, 'MSADU10000000000', 0, 12, 'managed', 'ad_mgmt', 'ad_mgmt', 'Active Directory Managed Services- up to 100 Users', 'ad_mgmt', 'Active Directory Managed Services- up to 100 Users', 1),
(131, 'ICFWVFEFPO000000', 0, 3, 'security', 'efw', 'efw', 'External Firewall', 'efw_palo_1gbps', 'PALO ALTO -Virtual External Firewall', 1),
(132, 'ICFWVFEFFN000000', 0, 3, 'security', 'efw', 'efw', 'External Firewall', 'efw_fortinet_1gbps', 'Fortinet - Virtual External Firewall', 1),
(133, 'ICFWVFEFOR000000', 0, 3, 'security', 'efw', 'efw', 'External Firewall', 'efw_other', 'Other -Virtual External Firewall', 1),
(134, 'SOLOAL0000000000', 0, 11, 'compute', 'os', 'compute', 'OS Management', 'alm_linux', 'Linux : Alma Linux', 1),
(135, 'INLBVLCI00000000', 0, 6, 'network', 'lb', 'lb', 'Load Balancer', 'vlb_citrix_1G', 'CITRIX - Virtual Load Balancer - 1 Gbps', 1),
(136, 'ICFWSF0000000000', 0, 3, 'security', 'efw', 'efw', 'External Firewall', 'efw_shared', 'Shared Firewall', 1),
(137, 'STORSOOL00000000', 0, 8, 'storage', 'object_storage', 'obj_strg_shared', 'eCOS-Object Storage - Storage', 'obj_strg_shared', 'Object Storage Shared 1 IOPS per GB ', 1),
(138, 'MSOGIM0000000000', 0, 12, 'managed', 'infra_mgmt', 'infra_mgmt', 'Infra VM Management', 'infra_mgmt', 'Infra VM Management', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rate_card_prices`
--

CREATE TABLE `rate_card_prices` (
  `id` int(11) NOT NULL,
  `rate_card_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `input_price` float NOT NULL,
  `price` float NOT NULL,
  `discountable_price` float NOT NULL,
  `date_created` datetime NOT NULL,
  `is_active` enum('True','False') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rate_card_prices`
--

INSERT INTO `rate_card_prices` (`id`, `rate_card_id`, `prod_id`, `input_price`, `price`, `discountable_price`, `date_created`, `is_active`) VALUES
(1, 1, 1, 0, 0, 0, '2024-01-22 11:39:17', 'True'),
(2, 1, 2, 1.4, 2, 1, '2024-01-22 11:39:17', 'True'),
(3, 1, 3, 1.4, 2, 1, '2024-01-22 11:39:17', 'True'),
(4, 1, 4, 1.05, 1.5, 1, '2024-01-22 11:39:17', 'True'),
(5, 1, 5, 1.414, 2.02, 0.404, '2024-01-22 11:39:17', 'True'),
(6, 1, 6, 2.121, 3.03, 0.606, '2024-01-22 11:39:17', 'True'),
(7, 1, 7, 2.828, 4.04, 0.808, '2024-01-22 11:39:17', 'True'),
(8, 1, 8, 3.528, 5.04, 1.008, '2024-01-22 11:39:17', 'True'),
(9, 1, 9, 4.235, 6.05, 1.21, '2024-01-22 11:39:17', 'True'),
(10, 1, 10, 4.942, 7.06, 1.412, '2024-01-22 11:39:17', 'True'),
(11, 1, 11, 5.649, 8.07, 1.614, '2024-01-22 11:39:17', 'True'),
(12, 1, 12, 6.363, 9.09, 1.818, '2024-01-22 11:39:17', 'True'),
(13, 1, 13, 7.063, 10.09, 2.018, '2024-01-22 11:39:17', 'True'),
(14, 1, 14, 7.77, 11.1, 2.22, '2024-01-22 11:39:17', 'True'),
(15, 1, 15, 11.298, 16.14, 3.228, '2024-01-22 11:39:17', 'True'),
(16, 1, 16, 14.833, 21.19, 4.238, '2024-01-22 11:39:17', 'True'),
(17, 1, 17, 18.361, 26.23, 5.246, '2024-01-22 11:39:17', 'True'),
(18, 1, 18, 1.05, 1.5, 0.3, '2024-01-22 11:39:17', 'True'),
(19, 1, 19, 28.959, 41.37, 8.274, '2024-01-22 11:39:17', 'True'),
(20, 1, 20, 36.022, 51.46, 10.292, '2024-01-22 11:39:17', 'True'),
(21, 1, 21, 69.769, 99.67, 19.934, '2024-01-22 11:39:17', 'True'),
(22, 1, 22, 291.9, 417, 83.4, '2024-01-22 11:39:17', 'True'),
(23, 1, 23, 350, 500, 100, '2024-01-22 11:39:17', 'True'),
(24, 1, 24, 12250, 17500, 3500, '2024-01-22 11:39:17', 'True'),
(27, 1, 27, 1574.94, 2249.92, 449.984, '2024-01-22 11:39:17', 'True'),
(28, 1, 28, 1050, 1500, 300, '2024-01-22 11:39:17', 'True'),
(29, 1, 29, 525, 750, 150, '2024-01-22 11:39:17', 'True'),
(30, 1, 30, 11550, 16500, 3300, '2024-01-22 11:39:17', 'True'),
(31, 1, 31, 1750, 2500, 500, '2024-01-22 11:39:17', 'True'),
(32, 1, 32, 700, 1000, 200, '2024-01-22 11:39:17', 'True'),
(33, 1, 33, 1050, 1500, 300, '2024-01-22 11:39:17', 'True'),
(34, 1, 34, 525, 750, 150, '2024-01-22 11:39:17', 'True'),
(35, 1, 35, 583.331, 833.33, 166.666, '2024-01-22 11:39:17', 'True'),
(36, 1, 36, 560, 800, 160, '2024-01-22 11:39:17', 'True'),
(37, 1, 37, 145.775, 208.25, 41.65, '2024-01-22 11:39:17', 'True'),
(38, 1, 38, 1400, 2000, 400, '2024-01-22 11:39:17', 'True'),
(39, 1, 39, 758.8, 1084, 216.8, '2024-01-22 11:39:17', 'True'),
(40, 1, 40, 1166.9, 1667, 333.4, '2024-01-22 11:39:17', 'True'),
(41, 1, 41, 210, 300, 60, '2024-01-22 11:39:17', 'True'),
(42, 1, 42, 1050, 1500, 300, '2024-01-22 11:39:17', 'True'),
(43, 1, 43, 2.8, 4, 0.8, '2024-01-22 11:39:17', 'True'),
(44, 1, 44, 5250, 7500, 1500, '2024-01-22 11:39:17', 'True'),
(45, 1, 45, 5250, 7500, 1500, '2024-01-22 11:39:17', 'True'),
(46, 1, 46, 8750, 12500, 2500, '2024-01-22 11:39:17', 'True'),
(47, 1, 47, 3850, 5500, 1100, '2024-01-22 11:39:17', 'True'),
(48, 1, 48, 1050, 1500, 300, '2024-01-22 11:39:17', 'True'),
(49, 1, 49, 3850, 5500, 1100, '2024-01-22 11:39:17', 'True'),
(50, 1, 50, 5250, 7500, 1500, '2024-01-22 11:39:17', 'True'),
(51, 1, 51, 5250, 7500, 1500, '2024-01-22 11:39:17', 'True'),
(52, 1, 52, 52.5, 75, 15, '2024-01-22 11:39:17', 'True'),
(53, 1, 53, 67.2, 96, 19.2, '2024-01-22 11:39:17', 'True'),
(54, 1, 54, 67.2, 96, 19.2, '2024-01-22 11:39:17', 'True'),
(55, 1, 55, 52.5, 75, 15, '2024-01-22 11:39:17', 'True'),
(56, 1, 56, 3360, 4800, 960, '2024-01-22 11:39:17', 'True'),
(57, 1, 57, 910, 1300, 260, '2024-01-22 11:39:17', 'True'),
(58, 1, 58, 4.2, 6, 1.2, '2024-01-22 11:39:17', 'True'),
(59, 1, 59, 350, 500, 100, '2024-01-22 11:39:17', 'True'),
(60, 1, 60, 10208.1, 14583, 2916.6, '2024-01-22 11:39:17', 'True'),
(61, 1, 61, 1260, 1800, 360, '2024-01-22 11:39:17', 'True'),
(62, 1, 62, 1750, 2500, 500, '2024-01-22 11:39:17', 'True'),
(63, 1, 63, 0.7, 1, 0.2, '2024-01-22 11:39:17', 'True'),
(64, 1, 64, 3500, 5000, 1000, '2024-01-22 11:39:17', 'True'),
(65, 1, 65, 350, 500, 100, '2024-01-22 11:39:17', 'True'),
(66, 1, 66, 0, 0, 0, '2024-01-22 11:39:17', ''),
(67, 1, 67, 1050, 1500, 300, '2024-01-22 11:39:17', 'True'),
(68, 1, 68, 3500, 5000, 1000, '2024-01-22 11:39:17', 'True'),
(69, 1, 69, 7350, 10500, 2100, '2024-01-22 11:39:17', 'True'),
(70, 1, 70, 11550, 16500, 3300, '2024-01-22 11:39:17', 'True'),
(71, 1, 71, 5849.9, 8357, 1671.4, '2024-01-22 11:39:17', 'True'),
(72, 1, 72, 11672.5, 16675, 3335, '2024-01-22 11:39:17', 'True'),
(73, 1, 73, 1470, 2100, 420, '2024-01-22 11:39:17', 'True'),
(74, 1, 74, 1750, 2500, 500, '2024-01-22 11:39:17', 'True'),
(75, 1, 75, 1050, 1500, 300, '2024-01-22 11:39:17', 'True'),
(76, 1, 76, 1470, 2100, 420, '2024-01-22 11:39:17', 'True'),
(77, 1, 77, 0, 0, 0, '2024-01-22 11:39:17', ''),
(78, 1, 78, 175, 250, 50, '2024-01-22 11:39:17', 'True'),
(79, 1, 79, 0, 0, 0, '2024-01-22 11:39:17', ''),
(80, 1, 80, 350, 500, 100, '2024-01-22 11:39:17', 'True'),
(81, 1, 81, 1400, 2000, 400, '2024-01-22 11:39:17', 'True'),
(82, 1, 82, 0, 0, 0, '2024-01-22 11:39:17', ''),
(83, 1, 83, 210, 300, 60, '2024-01-22 11:39:17', 'True'),
(84, 1, 84, 175, 250, 50, '2024-01-22 11:39:17', 'True'),
(85, 1, 85, 350, 500, 100, '2024-01-22 11:39:17', 'True'),
(86, 1, 86, 700, 1000, 200, '2024-01-22 11:39:17', 'True'),
(87, 1, 87, 0, 0, 0, '2024-01-22 11:39:17', 'True'),
(88, 1, 88, 33600, 48000, 9600, '2024-01-22 11:39:17', 'True'),
(89, 1, 89, 4200, 6000, 1200, '2024-01-22 11:39:17', 'True'),
(90, 1, 90, 70, 100, 20, '2024-01-22 11:39:17', 'True'),
(91, 1, 91, 0, 0, 0, '2024-01-22 11:39:17', 'True'),
(92, 1, 92, 0, 0, 0, '2024-01-22 11:39:17', 'True'),
(93, 1, 93, 0, 0, 0, '2024-01-22 11:39:17', 'True'),
(94, 1, 94, 0, 0, 0, '2024-01-22 11:39:17', 'True'),
(95, 1, 95, 13407.1, 19153, 3830.6, '2024-01-22 11:39:17', 'True'),
(96, 1, 96, 126666, 180952, 36190.4, '2024-01-22 11:39:17', 'True'),
(97, 1, 97, 364, 520, 104, '2024-01-22 11:39:17', 'True'),
(98, 1, 98, 2457, 3510, 702, '2024-01-22 11:39:17', 'True'),
(99, 1, 99, 0, 0, 0, '2024-01-22 11:39:17', 'True'),
(100, 1, 100, 0, 0, 0, '2024-01-22 11:39:17', 'True'),
(101, 1, 101, 13160, 18800, 3760, '2024-01-22 11:39:17', 'True'),
(102, 1, 102, 11830, 16900, 3380, '2024-01-22 11:39:17', 'True'),
(103, 1, 103, 43680, 62400, 12480, '2024-01-22 11:39:17', 'True'),
(104, 1, 104, 0, 0, 0, '2024-01-22 11:39:17', 'True'),
(105, 1, 105, 728, 1040, 208, '2024-01-22 11:39:17', 'True'),
(106, 1, 106, 0, 0, 0, '2024-01-22 11:39:17', 'True'),
(107, 1, 107, 12262.6, 17518, 3503.6, '2024-01-22 11:39:17', 'True'),
(108, 1, 108, 30655.8, 43794, 8758.8, '2024-01-22 11:39:17', 'True'),
(109, 1, 109, 3150, 4500, 900, '2024-01-22 11:39:17', 'True'),
(110, 1, 110, 1613.5, 2305, 461, '2024-01-22 11:39:17', 'True'),
(111, 1, 111, 1050, 1500, 300, '2024-01-22 11:39:17', 'True'),
(112, 1, 112, 210, 300, 60, '2024-01-22 11:39:17', 'True'),
(113, 1, 113, 1050, 1500, 300, '2024-01-22 11:39:17', 'True'),
(114, 1, 114, 1050, 1500, 300, '2024-01-22 11:39:17', 'True'),
(115, 1, 115, 210, 300, 60, '2024-01-22 11:39:17', 'True'),
(116, 1, 116, 210, 300, 60, '2024-01-22 11:39:17', 'True'),
(117, 1, 117, 840, 1200, 240, '2024-01-22 11:39:17', 'True'),
(118, 1, 118, 840, 1200, 240, '2024-01-22 11:39:17', 'True'),
(119, 1, 119, 840, 1200, 240, '2024-01-22 11:39:17', 'True'),
(120, 1, 120, 1050, 1500, 300, '2024-01-22 11:39:17', 'True'),
(121, 1, 121, 1050, 1500, 300, '2024-01-22 11:39:17', 'True'),
(122, 1, 122, 5250, 7500, 1500, '2024-01-22 11:39:17', 'True'),
(123, 1, 123, 1050, 1500, 300, '2024-01-22 11:39:17', 'True'),
(124, 1, 124, 3360, 4800, 960, '2024-01-22 11:39:17', 'True'),
(125, 1, 125, 700, 1000, 200, '2024-01-22 11:39:17', 'True'),
(126, 1, 126, 700, 1000, 200, '2024-01-22 11:39:17', 'True'),
(127, 1, 127, 840, 1200, 240, '2024-01-22 11:39:17', 'True'),
(128, 1, 128, 1050, 1500, 300, '2024-01-22 11:39:17', 'True'),
(129, 1, 129, 1050, 1500, 300, '2024-01-22 11:39:17', 'True'),
(130, 1, 130, 5250, 7500, 1500, '2024-02-05 11:39:17', 'True'),
(131, 1, 131, 1050, 1500, 300, '2024-01-22 11:39:17', 'True'),
(132, 1, 132, 3360, 4800, 960, '2024-01-22 11:39:17', 'True'),
(133, 1, 135, 77000, 110000, 22000, '2024-01-22 11:39:17', 'True'),
(134, 1, 134, 700, 1000, 200, '2024-01-22 11:39:17', 'True'),
(135, 1, 133, 700, 1000, 200, '2024-01-22 11:39:17', 'True'),
(136, 1, 136, 900, 1500, 1000, '2024-02-06 07:52:51', 'True'),
(137, 1, 137, 2, 3.17, 1, '2024-02-06 08:00:42', 'True'),
(138, 1, 138, 100, 150, 50, '2024-02-21 09:50:26', 'True');

-- --------------------------------------------------------

--
-- Table structure for table `role_master`
--

CREATE TABLE `role_master` (
  `id` int(11) NOT NULL,
  `role_name` varchar(15) NOT NULL,
  `prefix` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_master`
--

INSERT INTO `role_master` (`id`, `role_name`, `prefix`) VALUES
(1, 'Super Admin', 'SA'),
(2, 'Admin', 'AD'),
(3, 'User', 'UR');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `permission_id`) VALUES
(1, 1, '1,2,3,4,5,6,7,8,9,10,11,12,13'),
(2, 2, '1,2,3,4,5,6,9,7'),
(3, 3, '1,4,5,6,9');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_calculation`
--

CREATE TABLE `tbl_calculation` (
  `id` int(11) NOT NULL,
  `sec_cat_name` varchar(25) NOT NULL,
  `calculation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_calculation`
--

INSERT INTO `tbl_calculation` (`id`, `sec_cat_name`, `calculation`) VALUES
(1, 'siem', 'vmqty,ifw_qty,efw_qty,waf_qty,lbqty,hsm_qty'),
(2, 'vapt', 'vmqty,ifw_qty,efw_qty,waf_qty,lbqty,hsm_qty');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_discount_data`
--

CREATE TABLE `tbl_discount_data` (
  `id` int(11) NOT NULL,
  `quot_id` int(11) NOT NULL,
  `discounted_data` text NOT NULL,
  `discounted_mrc` int(20) NOT NULL,
  `approved_status` enum('Approved','Rejected','Remaining','') NOT NULL,
  `approved_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_discount_data`
--

INSERT INTO `tbl_discount_data` (`id`, `quot_id`, `discounted_data`, `discounted_mrc`, `approved_status`, `approved_by`) VALUES
(1, 1, '{\"1\":{\"percentage\":0.1,\"Data\":{\"VM0_1\":{\"CPU\":21.313127669919027,\"RAM\":21.313127669919027,\"Disk\":21.526258946618213},\"VM1_1\":{\"CPU\":21.313127669919027,\"RAM\":21.313127669919027,\"Disk\":21.483632691278373},\"centos_1\":0,\"win_se_1\":21.313127669919027,\"my_std_1\":21.313127669919012,\"my_com_1\":0,\"backup_age_1\":21.313127669919012,\"obj_strg_1\":0.052034003100388304,\"block_03_1\":106.56563834959512,\"block_1_1\":21.526258946618213,\"block_20_1\":21.50596072978972,\"block_40_1\":21.505465651330482,\"block_50_1\":21.5053637234124,\"backup_gb_1\":0,\"arc_strg_gb_1\":53.28281917479755,\"tl_1\":21.313127669919027,\"ipv4_1\":21.313127669919027,\"speed_band_1\":21.313127669919012,\"cross_connect_1\":21.313127669919012,\"ipsec_vpn_1\":21.313127669919027,\"ssl_vpn_1\":21.313127669919027,\"vlb_proxy_1G_1\":0,\"av_1\":21.313127669919027,\"dam_1\":21.313127669919012,\"ddos_1\":21.313127669919012,\"dlp_1\":21.313127669919027,\"efw_1\":21.313127669919027,\"iam_1\":21.313127669919027,\"ifw_1\":21.313127669919012,\"mfa_1\":21.313127669919027,\"pim_1\":21.313127669919027,\"siem_1\":21.313127669919012,\"ssl_certificate_1\":21.3218462459334,\"utm_1\":21.313127669919027,\"vapt_1\":21.313127669919027,\"vtm_scan_1\":21.313127669919027,\"waf_1\":21.313127669919012,\"centos_mgmt_1\":21.313127669919012,\"win_mgmt_1\":21.313127669919012,\"my_db_mgmt_1\":21.313127669919012,\"strg_mgmt_1\":20.82128626215166,\"backup_mgmt_1\":21.313127669919027,\"lb_mg_1\":21.313127669919012,\"vfirewall_mgmt_1\":15.98484575243927,\"waf_mg_1\":21.313127669919012,\"emagic_1\":21.313127669919012}}}', 0, 'Approved', 9999),
(3, 3, '{\"1\":{\"percentage\":20,\"Data\":{\"VM0_1\":20,\"emagic_1\":20}}}', 0, '', 0),
(4, 5, '{\"1\":{\"percentage\":20,\"Data\":{\"VM0_1\":20,\"emagic_1\":20}}}', 0, 'Approved', 9999),
(5, 7, '{\"1\":{\"percentage\":20,\"Data\":{\"VM0_1\":20,\"emagic_1\":20}}}', 0, '', 0),
(6, 10, '{\"1\":{\"percentage\":56.55823869142215,\"Data\":{\"VM0_1\":47.852,\"VM1_1\":47.121,\"ubuntu_1\":0,\"block_3_1\":50.495000000000005,\"ubuntu_mgmt_1\":56.6666,\"strg_mgmt_1\":66.666,\"emagic_1\":80,\"infra_mg_1\":16.6667}}}', 0, 'Approved', 9999);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_os_calculation`
--

CREATE TABLE `tbl_os_calculation` (
  `id` int(11) NOT NULL,
  `product_int` varchar(30) NOT NULL,
  `calculation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_os_calculation`
--

INSERT INTO `tbl_os_calculation` (`id`, `product_int`, `calculation`) VALUES
(1, 'ms_express', 'core_devide = 2'),
(2, 'ms_express', 'core_devide = 2'),
(3, 'post_ent', 'core_devide = 1'),
(4, 'ms_std', 'core_devide = 2'),
(5, 'ms_ent', 'core_devide = 2'),
(6, 'ms_dev', 'core_devide = 2'),
(7, 'ms_web', 'core_devide = 2'),
(8, 'win_se', 'core_devide = 2'),
(9, 'win_dc', 'core_devide = 2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pack`
--

CREATE TABLE `tbl_pack` (
  `id` int(11) NOT NULL,
  `region` varchar(9) CHARACTER SET utf8 DEFAULT NULL,
  `pack_series` varchar(7) CHARACTER SET utf8 DEFAULT NULL,
  `sr_no` varchar(4) CHARACTER SET utf8 DEFAULT NULL,
  `pack` varchar(77) CHARACTER SET utf8 DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `vCores` int(11) DEFAULT NULL,
  `ram` int(11) DEFAULT NULL,
  `disk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pack`
--

INSERT INTO `tbl_pack` (`id`, `region`, `pack_series`, `sr_no`, `pack`, `price`, `vCores`, `ram`, `disk`) VALUES
(1, 'Nashik', 'Small', 'S1', 'S1 : vCores 2 | RAM  4 GB | Disk - 1000 IOPS -  100 GB | ₹  7.7 / hr', 5508, 2, 4, 100),
(2, 'Nashik', 'Small', 'S2', 'S2 : vCores 2 | RAM  8 GB | Disk - 1000 IOPS -  100 GB | ₹  8.1 / hr', 5808, 2, 8, 100),
(3, 'Nashik', 'Small', 'S3', 'S3 : vCores 4 | RAM  8 GB | Disk - 1000 IOPS -  100 GB | ₹  8.3 / hr', 5908, 4, 8, 100),
(4, 'Nashik', 'Small', 'S4', 'S4 : vCores 4 | RAM  16 GB | Disk - 1000 IOPS -  100 GB | ₹  9.1 / hr', 6508, 4, 16, 100),
(5, 'Nashik', 'Small', 'S5', 'S5 : vCores 4 | RAM  24 GB | Disk - 1000 IOPS -  100 GB | ₹  9.9 / hr', 7108, 4, 24, 100),
(6, 'Nashik', 'Small', 'S6', 'S6 : vCores 4 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  10.8 / hr', 7708, 4, 32, 100),
(7, 'Nashik', 'Small', 'S7', 'S7 : vCores 6 | RAM  12 GB | Disk - 1000 IOPS -  100 GB | ₹  8.8 / hr', 6308, 6, 12, 100),
(8, 'Nashik', 'Small', 'S8', 'S8 : vCores 6 | RAM  24 GB | Disk - 1000 IOPS -  100 GB | ₹  10.1 / hr', 7208, 6, 24, 100),
(9, 'Nashik', 'Small', 'S9', 'S9 : vCores 6 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  10.9 / hr', 7808, 6, 32, 100),
(10, 'Nashik', 'Small', 'S10', 'S10 : vCores 8 | RAM  16 GB | Disk - 1000 IOPS -  100 GB | ₹  9.4 / hr', 6708, 8, 16, 100),
(11, 'Nashik', 'Small', 'S11', 'S11 : vCores 8 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11 / hr', 7908, 8, 32, 100),
(12, 'Nashik', 'Small', 'S12', 'S12 : vCores 8 | RAM  56 GB | Disk - 1000 IOPS -  100 GB | ₹  13.5 / hr', 9708, 8, 56, 100),
(13, 'Nashik', 'Small', 'S13', 'S13 : vCores 8 | RAM  64 GB | Disk - 1000 IOPS -  100 GB | ₹  14.4 / hr', 10308, 8, 64, 100),
(14, 'Nashik', 'Medium', 'M1', 'M1 : vCores 8 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  21.3 / hr', 15308, 8, 128, 100),
(15, 'Nashik', 'Medium', 'M2', 'M2 : vCores 8 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  34.6 / hr', 24908, 8, 256, 100),
(16, 'Nashik', 'Medium', 'M3', 'M3 : vCores 10 | RAM  24 GB | Disk - 1000 IOPS -  100 GB | ₹  10.7 / hr', 7658, 10, 24, 100),
(17, 'Nashik', 'Medium', 'M4', 'M4 : vCores 10 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11.5 / hr', 8258, 10, 32, 100),
(18, 'Nashik', 'Medium', 'M5', 'M5 : vCores 12 | RAM  12 GB | Disk - 1000 IOPS -  100 GB | ₹  9.6 / hr', 6908, 12, 12, 100),
(19, 'Nashik', 'Medium', 'M6', 'M6 : vCores 12 | RAM  16 GB | Disk - 1000 IOPS -  100 GB | ₹  10.1 / hr', 7208, 12, 16, 100),
(20, 'Nashik', 'Medium', 'M7', 'M7 : vCores 12 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11.7 / hr', 8408, 12, 32, 100),
(21, 'Nashik', 'Medium', 'M8', 'M8 : vCores 12 | RAM  48 GB | Disk - 1000 IOPS -  100 GB | ₹  13.4 / hr', 9608, 12, 48, 100),
(22, 'Nashik', 'Medium', 'M9', 'M9 : vCores 12 | RAM  64 GB | Disk - 1000 IOPS -  100 GB | ₹  15.1 / hr', 10808, 12, 64, 100),
(23, 'Nashik', 'Medium', 'M10', 'M10 : vCores 12 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  21.7 / hr', 15608, 12, 128, 100),
(24, 'Nashik', 'Medium', 'M11', 'M11 : vCores 14 | RAM  28 GB | Disk - 1000 IOPS -  100 GB | ₹  11.5 / hr', 8258, 14, 28, 100),
(25, 'Nashik', 'Medium', 'M12', 'M12 : vCores 14 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11.9 / hr', 8558, 14, 32, 100),
(26, 'Nashik', 'Medium', 'M13', 'M13 : vCores 14 | RAM  64 GB | Disk - 1000 IOPS -  100 GB | ₹  15.3 / hr', 10958, 14, 64, 100),
(27, 'Nashik', 'Medium', 'M14', 'M14 : vCores 14 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  21.9 / hr', 15758, 14, 128, 100),
(28, 'Nashik', 'Large', 'L1', 'L1 : vCores 16 | RAM  16 GB | Disk - 1000 IOPS -  100 GB | ₹  10.5 / hr', 7508, 16, 16, 100),
(29, 'Nashik', 'Large', 'L2', 'L2 : vCores 16 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  12.1 / hr', 8708, 16, 32, 100),
(30, 'Nashik', 'Large', 'L3', 'L3 : vCores 16 | RAM  64 GB | Disk - 1000 IOPS -  100 GB | ₹  30.9 / hr', 15908, 16, 64, 100),
(31, 'Nashik', 'Large', 'L4', 'L4 : vCores 16 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  22.1 / hr', 25508, 16, 128, 100),
(32, 'Nashik', 'Large', 'L5', 'L5 : vCores 16 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  35.5 / hr', 9908, 32, 256, 100),
(33, 'Nashik', 'Large', 'L6', 'L6 : vCores 32 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  13.8 / hr', 12308, 32, 32, 100),
(34, 'Nashik', 'Large', 'L7', 'L7 : vCores 32 | RAM  64 GB | Disk - 1000 IOPS -  100 GB | ₹  17.1 / hr', 17108, 32, 64, 100),
(35, 'Nashik', 'X-Large', 'XL1', 'XL1 : vCores 14 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  21.9 / hr', 15758, 14, 14, 100),
(36, 'Nashik', 'X-Large', 'XL2', 'XL2 : vCores 16 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  35.5 / hr', 25508, 16, 16, 100),
(37, 'Nashik', 'X-Large', 'XL3', 'XL3 : vCores 16 | RAM  512 GB | Disk - 1000 IOPS -  100 GB | ₹  62.1 / hr', 44708, 16, 16, 100),
(38, 'Nashik', 'X-Large', 'XL4', 'XL4 : vCores 32 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  37.1 / hr', 26708, 32, 32, 100),
(39, 'Nashik', 'X-Large', 'XL5', 'XL5 : vCores 32 | RAM  512 GB | Disk - 1000 IOPS -  100 GB | ₹  63.8 / hr', 45908, 32, 32, 100),
(40, 'Nashik', 'X-Large', 'XL6', 'XL6 : vCores 64 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  27.1 / hr', 19508, 64, 64, 100),
(41, 'Nashik', 'X-Large', 'XL7', 'XL7 : vCores 64 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  40.5 / hr', 29108, 64, 64, 100),
(42, 'Nashik', 'X-Large', 'XL8', 'XL8 : vCores 64 | RAM  512 GB | Disk - 1000 IOPS -  100 GB | ₹  67.1 / hr', 48308, 64, 64, 100),
(43, 'Nashik', 'X-Large', 'XL9', 'XL9 : vCores 128 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  47.1 / hr', 33908, 128, 128, 100),
(44, 'Nashik', 'X-Large', 'XL10', 'XL10 : vCores 256 | RAM  512 GB | Disk - 1000 IOPS -  100 GB | ₹  87.1 / hr', 62708, 256, 256, 100),
(45, 'Nashik', 'X-Large', 'XL11', 'XL11 : vCores 256 | RAM  1024 GB | Disk - 1000 IOPS -  100 GB | ₹  140.5 / hr', 101108, 256, 256, 100),
(46, 'Mumbai', 'Small', 'S1', 'S1 : vCores 2 | RAM  4 GB | Disk - 1000 IOPS -  100 GB | ₹  7.6 / hr', 5468, 2, 4, 100),
(47, 'Mumbai', 'Small', 'S2', 'S2 : vCores 2 | RAM  8 GB | Disk - 1000 IOPS -  100 GB | ₹  8 / hr', 5728, 2, 8, 100),
(48, 'Mumbai', 'Small', 'S3', 'S3 : vCores 4 | RAM  8 GB | Disk - 1000 IOPS -  100 GB | ₹  8.1 / hr', 5828, 4, 8, 100),
(49, 'Mumbai', 'Small', 'S4', 'S4 : vCores 4 | RAM  16 GB | Disk - 1000 IOPS -  100 GB | ₹  8.9 / hr', 6348, 4, 16, 100),
(50, 'Mumbai', 'Small', 'S5', 'S5 : vCores 4 | RAM  24 GB | Disk - 1000 IOPS -  100 GB | ₹  9.6 / hr', 6868, 4, 24, 100),
(51, 'Mumbai', 'Small', 'S6', 'S6 : vCores 4 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  10.3 / hr', 7388, 4, 32, 100),
(52, 'Mumbai', 'Small', 'S7', 'S7 : vCores 6 | RAM  12 GB | Disk - 1000 IOPS -  100 GB | ₹  8.6 / hr', 6188, 6, 12, 100),
(53, 'Mumbai', 'Small', 'S8', 'S8 : vCores 6 | RAM  24 GB | Disk - 1000 IOPS -  100 GB | ₹  9.7 / hr', 6968, 6, 24, 100),
(54, 'Mumbai', 'Small', 'S9', 'S9 : vCores 6 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  10.4 / hr', 7488, 6, 32, 100),
(55, 'Mumbai', 'Small', 'S10', 'S10 : vCores 8 | RAM  16 GB | Disk - 1000 IOPS -  100 GB | ₹  9.1 / hr', 6548, 8, 16, 100),
(56, 'Mumbai', 'Small', 'S11', 'S11 : vCores 8 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  10.6 / hr', 7588, 8, 32, 100),
(57, 'Mumbai', 'Small', 'S12', 'S12 : vCores 8 | RAM  56 GB | Disk - 1000 IOPS -  100 GB | ₹  12.8 / hr', 9148, 8, 56, 100),
(58, 'Mumbai', 'Small', 'S13', 'S13 : vCores 8 | RAM  64 GB | Disk - 1000 IOPS -  100 GB | ₹  13.5 / hr', 9668, 8, 64, 100),
(59, 'Mumbai', 'Medium', 'M1', 'M1 : vCores 8 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  19.5 / hr', 14028, 8, 128, 100),
(60, 'Mumbai', 'Medium', 'M2', 'M2 : vCores 8 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  31.1 / hr', 22348, 8, 256, 100),
(61, 'Mumbai', 'Medium', 'M3', 'M3 : vCores 10 | RAM  24 GB | Disk - 1000 IOPS -  100 GB | ₹  10.4 / hr', 7418, 10, 24, 100),
(62, 'Mumbai', 'Medium', 'M4', 'M4 : vCores 10 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11.1 / hr', 7938, 10, 32, 100),
(63, 'Mumbai', 'Medium', 'M5', 'M5 : vCores 12 | RAM  12 GB | Disk - 1000 IOPS -  100 GB | ₹  9.5 / hr', 6788, 12, 12, 100),
(64, 'Mumbai', 'Medium', 'M6', 'M6 : vCores 12 | RAM  16 GB | Disk - 1000 IOPS -  100 GB | ₹  9.8 / hr', 7048, 12, 16, 100),
(65, 'Mumbai', 'Medium', 'M7', 'M7 : vCores 12 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11.3 / hr', 8088, 12, 32, 100),
(66, 'Mumbai', 'Medium', 'M8', 'M8 : vCores 12 | RAM  48 GB | Disk - 1000 IOPS -  100 GB | ₹  12.7 / hr', 9128, 12, 48, 100),
(67, 'Mumbai', 'Medium', 'M9', 'M9 : vCores 12 | RAM  64 GB | Disk - 1000 IOPS -  100 GB | ₹  14.2 / hr', 10168, 12, 64, 100),
(68, 'Mumbai', 'Medium', 'M10', 'M10 : vCores 12 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  19.9 / hr', 14328, 12, 128, 100),
(69, 'Mumbai', 'Medium', 'M11', 'M11 : vCores 14 | RAM  28 GB | Disk - 1000 IOPS -  100 GB | ₹  11.1 / hr', 7978, 14, 28, 100),
(70, 'Mumbai', 'Medium', 'M12', 'M12 : vCores 14 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11.5 / hr', 8238, 14, 32, 100),
(71, 'Mumbai', 'Medium', 'M13', 'M13 : vCores 14 | RAM  64 GB | Disk - 1000 IOPS -  100 GB | ₹  14.4 / hr', 10318, 14, 64, 100),
(72, 'Mumbai', 'Medium', 'M14', 'M14 : vCores 14 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  20.2 / hr', 14478, 14, 128, 100),
(73, 'Mumbai', 'Large', 'L1', 'L1 : vCores 16 | RAM  16 GB | Disk - 1000 IOPS -  100 GB | ₹  10.3 / hr', 7348, 16, 16, 100),
(74, 'Mumbai', 'Large', 'L2', 'L2 : vCores 16 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11.7 / hr', 8388, 16, 32, 100),
(75, 'Mumbai', 'Large', 'L3', 'L3 : vCores 16 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  20.4 / hr', 14628, 16, 64, 100),
(76, 'Mumbai', 'Large', 'L4', 'L4 : vCores 16 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  31.9 / hr', 22948, 16, 128, 100),
(77, 'Mumbai', 'Large', 'L5', 'L5 : vCores 32 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  13.4 / hr', 9588, 32, 256, 100),
(78, 'Mumbai', 'Large', 'L6', 'L6 : vCores 32 | RAM  64 GB | Disk - 1000 IOPS -  100 GB | ₹  16.3 / hr', 11668, 32, 32, 100),
(79, 'Mumbai', 'Large', 'L7', 'L7 : vCores 32 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  22 / hr', 15828, 32, 64, 100),
(80, 'Mumbai', 'X-Large', 'XL1', 'XL1 : vCores 14 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  21.9 / hr', 15758, 14, 14, 100),
(81, 'Mumbai', 'X-Large', 'XL2', 'XL2 : vCores 16 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  35.5 / hr', 25508, 16, 16, 100),
(82, 'Mumbai', 'X-Large', 'XL3', 'XL3 : vCores 16 | RAM  512 GB | Disk - 1000 IOPS -  100 GB | ₹  62.1 / hr', 44708, 16, 16, 100),
(83, 'Mumbai', 'X-Large', 'XL4', 'XL4 : vCores 32 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  37.1 / hr', 26708, 32, 32, 100),
(84, 'Mumbai', 'X-Large', 'XL5', 'XL5 : vCores 32 | RAM  512 GB | Disk - 1000 IOPS -  100 GB | ₹  63.8 / hr', 45908, 32, 32, 100),
(85, 'Mumbai', 'X-Large', 'XL6', 'XL6 : vCores 64 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  27.1 / hr', 19508, 64, 64, 100),
(86, 'Mumbai', 'X-Large', 'XL7', 'XL7 : vCores 64 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  40.5 / hr', 29108, 64, 64, 100),
(87, 'Mumbai', 'X-Large', 'XL8', 'XL8 : vCores 64 | RAM  512 GB | Disk - 1000 IOPS -  100 GB | ₹  67.1 / hr', 48308, 64, 64, 100),
(88, 'Mumbai', 'X-Large', 'XL9', 'XL9 : vCores 128 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  47.1 / hr', 33908, 128, 128, 100),
(89, 'Mumbai', 'X-Large', 'XL10', 'XL10 : vCores 256 | RAM  512 GB | Disk - 1000 IOPS -  100 GB | ₹  87.1 / hr', 62708, 256, 256, 100),
(90, 'Mumbai', 'X-Large', 'XL11', 'XL11 : vCores 256 | RAM  1024 GB | Disk - 1000 IOPS -  100 GB | ₹  140.5 / hr', 101108, 256, 256, 100),
(91, 'Bangalore', 'Small', 'S1', 'S1 : vCores 2 | RAM  4 GB | Disk - 1000 IOPS -  100 GB | ₹  7.8 / hr', 5558, 2, 4, 100),
(92, 'Bangalore', 'Small', 'S2', 'S2 : vCores 2 | RAM  8 GB | Disk - 1000 IOPS -  100 GB | ₹  8.2 / hr', 5858, 2, 8, 100),
(93, 'Bangalore', 'Small', 'S3', 'S3 : vCores 4 | RAM  8 GB | Disk - 1000 IOPS -  100 GB | ₹  8.4 / hr', 6008, 4, 8, 100),
(94, 'Bangalore', 'Small', 'S4', 'S4 : vCores 4 | RAM  16 GB | Disk - 1000 IOPS -  100 GB | ₹  9.2 / hr', 6608, 4, 16, 100),
(95, 'Bangalore', 'Small', 'S5', 'S5 : vCores 4 | RAM  24 GB | Disk - 1000 IOPS -  100 GB | ₹  10.1 / hr', 7208, 4, 24, 100),
(96, 'Bangalore', 'Small', 'S6', 'S6 : vCores 4 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  10.9 / hr', 7808, 4, 32, 100),
(97, 'Bangalore', 'Small', 'S7', 'S7 : vCores 6 | RAM  12 GB | Disk - 1000 IOPS -  100 GB | ₹  9 / hr', 6458, 6, 12, 100),
(98, 'Bangalore', 'Small', 'S8', 'S8 : vCores 6 | RAM  24 GB | Disk - 1000 IOPS -  100 GB | ₹  10.3 / hr', 7358, 6, 24, 100),
(99, 'Bangalore', 'Small', 'S9', 'S9 : vCores 6 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11.1 / hr', 7958, 6, 32, 100),
(100, 'Bangalore', 'Small', 'S10', 'S10 : vCores 8 | RAM  16 GB | Disk - 1000 IOPS -  100 GB | ₹  9.6 / hr', 6908, 8, 16, 100),
(101, 'Bangalore', 'Small', 'S11', 'S11 : vCores 8 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11.3 / hr', 8108, 8, 32, 100),
(102, 'Bangalore', 'Small', 'S12', 'S12 : vCores 8 | RAM  56 GB | Disk - 1000 IOPS -  100 GB | ₹  13.8 / hr', 9908, 8, 56, 100),
(103, 'Bangalore', 'Small', 'S13', 'S13 : vCores 8 | RAM  64 GB | Disk - 1000 IOPS -  100 GB | ₹  14.6 / hr', 10508, 8, 64, 100),
(104, 'Bangalore', 'Medium', 'M1', 'M1 : vCores 8 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  21.3 / hr', 15308, 8, 128, 100),
(105, 'Bangalore', 'Medium', 'M2', 'M2 : vCores 8 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  34.6 / hr', 24908, 8, 256, 100),
(106, 'Bangalore', 'Medium', 'M3', 'M3 : vCores 10 | RAM  24 GB | Disk - 1000 IOPS -  100 GB | ₹  10.7 / hr', 7658, 10, 24, 100),
(107, 'Bangalore', 'Medium', 'M4', 'M4 : vCores 10 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11.5 / hr', 8258, 10, 32, 100),
(108, 'Bangalore', 'Medium', 'M5', 'M5 : vCores 12 | RAM  12 GB | Disk - 1000 IOPS -  100 GB | ₹  9.6 / hr', 6908, 12, 12, 100),
(109, 'Bangalore', 'Medium', 'M6', 'M6 : vCores 12 | RAM  16 GB | Disk - 1000 IOPS -  100 GB | ₹  10.1 / hr', 7208, 12, 16, 100),
(110, 'Bangalore', 'Medium', 'M7', 'M7 : vCores 12 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11.7 / hr', 8408, 12, 32, 100),
(111, 'Bangalore', 'Medium', 'M8', 'M8 : vCores 12 | RAM  48 GB | Disk - 1000 IOPS -  100 GB | ₹  13.4 / hr', 9608, 12, 48, 100),
(112, 'Bangalore', 'Medium', 'M9', 'M9 : vCores 12 | RAM  64 GB | Disk - 1000 IOPS -  100 GB | ₹  15.1 / hr', 10808, 12, 64, 100),
(113, 'Bangalore', 'Medium', 'M10', 'M10 : vCores 12 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  21.7 / hr', 15608, 12, 128, 100),
(114, 'Bangalore', 'Medium', 'M11', 'M11 : vCores 14 | RAM  28 GB | Disk - 1000 IOPS -  100 GB | ₹  11.5 / hr', 8258, 14, 28, 100),
(115, 'Bangalore', 'Medium', 'M12', 'M12 : vCores 14 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11.9 / hr', 8558, 14, 32, 100),
(116, 'Bangalore', 'Medium', 'M13', 'M13 : vCores 14 | RAM  64 GB | Disk - 1000 IOPS -  100 GB | ₹  15.3 / hr', 10958, 14, 64, 100),
(117, 'Bangalore', 'Medium', 'M14', 'M14 : vCores 14 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  21.9 / hr', 15758, 14, 128, 100),
(118, 'Bangalore', 'Large', 'L1', 'L1 : vCores 16 | RAM  16 GB | Disk - 1000 IOPS -  100 GB | ₹  10.5 / hr', 7508, 16, 16, 100),
(119, 'Bangalore', 'Large', 'L2', 'L2 : vCores 16 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  12.1 / hr', 8708, 16, 32, 100),
(120, 'Bangalore', 'Large', 'L3', 'L3 : vCores 16 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  22.1 / hr', 15908, 16, 64, 100),
(121, 'Bangalore', 'Large', 'L4', 'L4 : vCores 16 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  35.5 / hr', 25508, 16, 128, 100),
(122, 'Bangalore', 'Large', 'L5', 'L5 : vCores 32 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  13.8 / hr', 9908, 32, 256, 100),
(123, 'Bangalore', 'Large', 'L6', 'L6 : vCores 32 | RAM  64 GB | Disk - 1000 IOPS -  100 GB | ₹  17.1 / hr', 12308, 32, 32, 100),
(124, 'Bangalore', 'Large', 'L7', 'L7 : vCores 32 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  23.8 / hr', 17108, 32, 64, 100),
(125, 'Bangalore', 'X-Large', 'XL1', 'XL1 : vCores 14 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  21.9 / hr', 15758, 14, 14, 100),
(126, 'Bangalore', 'X-Large', 'XL2', 'XL2 : vCores 16 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  35.5 / hr', 25508, 16, 16, 100),
(127, 'Bangalore', 'X-Large', 'XL3', 'XL3 : vCores 16 | RAM  512 GB | Disk - 1000 IOPS -  100 GB | ₹  62.1 / hr', 44708, 16, 16, 100),
(128, 'Bangalore', 'X-Large', 'XL4', 'XL4 : vCores 32 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  37.1 / hr', 26708, 32, 32, 100),
(129, 'Bangalore', 'X-Large', 'XL5', 'XL5 : vCores 32 | RAM  512 GB | Disk - 1000 IOPS -  100 GB | ₹  63.8 / hr', 45908, 32, 32, 100),
(130, 'Bangalore', 'X-Large', 'XL6', 'XL6 : vCores 64 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  27.1 / hr', 19508, 64, 64, 100),
(131, 'Bangalore', 'X-Large', 'XL7', 'XL7 : vCores 64 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  40.5 / hr', 29108, 64, 64, 100),
(132, 'Bangalore', 'X-Large', 'XL8', 'XL8 : vCores 64 | RAM  512 GB | Disk - 1000 IOPS -  100 GB | ₹  67.1 / hr', 48308, 64, 64, 100),
(133, 'Bangalore', 'X-Large', 'XL9', 'XL9 : vCores 128 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  47.1 / hr', 33908, 128, 128, 100),
(134, 'Bangalore', 'X-Large', 'XL10', 'XL10 : vCores 256 | RAM  512 GB | Disk - 1000 IOPS -  100 GB | ₹  87.1 / hr', 62708, 256, 256, 100),
(135, 'Bangalore', 'X-Large', 'XL11', 'XL11 : vCores 256 | RAM  1024 GB | Disk - 1000 IOPS -  100 GB | ₹  140.5 / hr', 101108, 256, 256, 100),
(136, 'Mohali', 'Small', 'S1', 'S1 : vCores 2 | RAM  4 GB | Disk - 1000 IOPS -  100 GB | ₹  7.8 / hr', 5558, 2, 4, 100),
(137, 'Mohali', 'Small', 'S2', 'S2 : vCores 2 | RAM  8 GB | Disk - 1000 IOPS -  100 GB | ₹  8.2 / hr', 5858, 2, 8, 100),
(138, 'Mohali', 'Small', 'S3', 'S3 : vCores 4 | RAM  8 GB | Disk - 1000 IOPS -  100 GB | ₹  8.4 / hr', 6008, 4, 8, 100),
(139, 'Mohali', 'Small', 'S4', 'S4 : vCores 4 | RAM  16 GB | Disk - 1000 IOPS -  100 GB | ₹  9.2 / hr', 6608, 4, 16, 100),
(140, 'Mohali', 'Small', 'S5', 'S5 : vCores 4 | RAM  24 GB | Disk - 1000 IOPS -  100 GB | ₹  10.1 / hr', 7208, 4, 24, 100),
(141, 'Mohali', 'Small', 'S6', 'S6 : vCores 4 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  10.9 / hr', 7808, 4, 32, 100),
(142, 'Mohali', 'Small', 'S7', 'S7 : vCores 6 | RAM  12 GB | Disk - 1000 IOPS -  100 GB | ₹  9 / hr', 6458, 6, 12, 100),
(143, 'Mohali', 'Small', 'S8', 'S8 : vCores 6 | RAM  24 GB | Disk - 1000 IOPS -  100 GB | ₹  10.3 / hr', 7358, 6, 24, 100),
(144, 'Mohali', 'Small', 'S9', 'S9 : vCores 6 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11.1 / hr', 7958, 6, 32, 100),
(145, 'Mohali', 'Small', 'S10', 'S10 : vCores 8 | RAM  16 GB | Disk - 1000 IOPS -  100 GB | ₹  9.6 / hr', 6908, 8, 16, 100),
(146, 'Mohali', 'Small', 'S11', 'S11 : vCores 8 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11.3 / hr', 8108, 8, 32, 100),
(147, 'Mohali', 'Small', 'S12', 'S12 : vCores 8 | RAM  56 GB | Disk - 1000 IOPS -  100 GB | ₹  13.8 / hr', 9908, 8, 56, 100),
(148, 'Mohali', 'Small', 'S13', 'S13 : vCores 8 | RAM  64 GB | Disk - 1000 IOPS -  100 GB | ₹  14.6 / hr', 10508, 8, 64, 100),
(149, 'Mohali', 'Medium', 'M1', 'M1 : vCores 8 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  21.3 / hr', 15308, 8, 128, 100),
(150, 'Mohali', 'Medium', 'M2', 'M2 : vCores 8 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  34.6 / hr', 24908, 8, 256, 100),
(151, 'Mohali', 'Medium', 'M3', 'M3 : vCores 10 | RAM  24 GB | Disk - 1000 IOPS -  100 GB | ₹  10.7 / hr', 7658, 10, 24, 100),
(152, 'Mohali', 'Medium', 'M4', 'M4 : vCores 10 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11.5 / hr', 8258, 10, 32, 100),
(153, 'Mohali', 'Medium', 'M5', 'M5 : vCores 12 | RAM  12 GB | Disk - 1000 IOPS -  100 GB | ₹  9.6 / hr', 6908, 12, 12, 100),
(154, 'Mohali', 'Medium', 'M6', 'M6 : vCores 12 | RAM  16 GB | Disk - 1000 IOPS -  100 GB | ₹  10.1 / hr', 7208, 12, 16, 100),
(155, 'Mohali', 'Medium', 'M7', 'M7 : vCores 12 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11.7 / hr', 8408, 12, 32, 100),
(156, 'Mohali', 'Medium', 'M8', 'M8 : vCores 12 | RAM  48 GB | Disk - 1000 IOPS -  100 GB | ₹  13.4 / hr', 9608, 12, 48, 100),
(157, 'Mohali', 'Medium', 'M9', 'M9 : vCores 12 | RAM  64 GB | Disk - 1000 IOPS -  100 GB | ₹  15.1 / hr', 10808, 12, 64, 100),
(158, 'Mohali', 'Medium', 'M10', 'M10 : vCores 12 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  21.7 / hr', 15608, 12, 128, 100),
(159, 'Mohali', 'Medium', 'M11', 'M11 : vCores 14 | RAM  28 GB | Disk - 1000 IOPS -  100 GB | ₹  11.5 / hr', 8258, 14, 28, 100),
(160, 'Mohali', 'Medium', 'M12', 'M12 : vCores 14 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11.9 / hr', 8558, 14, 32, 100),
(161, 'Mohali', 'Medium', 'M13', 'M13 : vCores 14 | RAM  64 GB | Disk - 1000 IOPS -  100 GB | ₹  15.3 / hr', 10958, 14, 64, 100),
(162, 'Mohali', 'Medium', 'M14', 'M14 : vCores 14 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  21.9 / hr', 15758, 14, 128, 100),
(163, 'Mohali', 'Large', 'L1', 'L1 : vCores 16 | RAM  16 GB | Disk - 1000 IOPS -  100 GB | ₹  10.5 / hr', 7508, 16, 16, 100),
(164, 'Mohali', 'Large', 'L2', 'L2 : vCores 16 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  12.1 / hr', 8708, 16, 32, 100),
(165, 'Mohali', 'Large', 'L3', 'L3 : vCores 16 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  22.1 / hr', 15908, 16, 64, 100),
(166, 'Mohali', 'Large', 'L4', 'L4 : vCores 16 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  35.5 / hr', 25508, 16, 128, 100),
(167, 'Mohali', 'Large', 'L5', 'L5 : vCores 32 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  13.8 / hr', 9908, 32, 256, 100),
(168, 'Mohali', 'Large', 'L6', 'L6 : vCores 32 | RAM  64 GB | Disk - 1000 IOPS -  100 GB | ₹  17.1 / hr', 12308, 32, 32, 100),
(169, 'Mohali', 'Large', 'L7', 'L7 : vCores 32 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  23.8 / hr', 17108, 32, 64, 100),
(170, 'Mohali', 'X-Large', 'XL1', 'XL1 : vCores 14 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  21.9 / hr', 15758, 14, 14, 100),
(171, 'Mohali', 'X-Large', 'XL2', 'XL2 : vCores 16 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  35.5 / hr', 25508, 16, 16, 100),
(172, 'Mohali', 'X-Large', 'XL3', 'XL3 : vCores 16 | RAM  512 GB | Disk - 1000 IOPS -  100 GB | ₹  62.1 / hr', 44708, 16, 16, 100),
(173, 'Mohali', 'X-Large', 'XL4', 'XL4 : vCores 32 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  37.1 / hr', 26708, 32, 32, 100),
(174, 'Mohali', 'X-Large', 'XL5', 'XL5 : vCores 32 | RAM  512 GB | Disk - 1000 IOPS -  100 GB | ₹  63.8 / hr', 45908, 32, 32, 100),
(175, 'Mohali', 'X-Large', 'XL6', 'XL6 : vCores 64 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  27.1 / hr', 19508, 64, 64, 100),
(176, 'Mohali', 'X-Large', 'XL7', 'XL7 : vCores 64 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  40.5 / hr', 29108, 64, 64, 100),
(177, 'Mohali', 'X-Large', 'XL8', 'XL8 : vCores 64 | RAM  512 GB | Disk - 1000 IOPS -  100 GB | ₹  67.1 / hr', 48308, 64, 64, 100),
(178, 'Mohali', 'X-Large', 'XL9', 'XL9 : vCores 128 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  47.1 / hr', 33908, 128, 128, 100),
(179, 'Mohali', 'X-Large', 'XL10', 'XL10 : vCores 256 | RAM  512 GB | Disk - 1000 IOPS -  100 GB | ₹  87.1 / hr', 62708, 256, 256, 100),
(180, 'Mohali', 'X-Large', 'XL11', 'XL11 : vCores 256 | RAM  1024 GB | Disk - 1000 IOPS -  100 GB | ₹  140.5 / hr', 101108, 256, 256, 100),
(181, 'Noida', 'Small', 'S1', 'S1 : vCores 2 | RAM  4 GB | Disk - 1000 IOPS -  100 GB | ₹  7.8 / hr', 5558, 2, 4, 100),
(182, 'Noida', 'Small', 'S2', 'S2 : vCores 2 | RAM  8 GB | Disk - 1000 IOPS -  100 GB | ₹  8.2 / hr', 5858, 2, 8, 100),
(183, 'Noida', 'Small', 'S3', 'S3 : vCores 4 | RAM  8 GB | Disk - 1000 IOPS -  100 GB | ₹  8.4 / hr', 6008, 4, 8, 100),
(184, 'Noida', 'Small', 'S4', 'S4 : vCores 4 | RAM  16 GB | Disk - 1000 IOPS -  100 GB | ₹  9.2 / hr', 6608, 4, 16, 100),
(185, 'Noida', 'Small', 'S5', 'S5 : vCores 4 | RAM  24 GB | Disk - 1000 IOPS -  100 GB | ₹  10.1 / hr', 7208, 4, 24, 100),
(186, 'Noida', 'Small', 'S6', 'S6 : vCores 4 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  10.9 / hr', 7808, 4, 32, 100),
(187, 'Noida', 'Small', 'S7', 'S7 : vCores 6 | RAM  12 GB | Disk - 1000 IOPS -  100 GB | ₹  9 / hr', 6458, 6, 12, 100),
(188, 'Noida', 'Small', 'S8', 'S8 : vCores 6 | RAM  24 GB | Disk - 1000 IOPS -  100 GB | ₹  10.3 / hr', 7358, 6, 24, 100),
(189, 'Noida', 'Small', 'S9', 'S9 : vCores 6 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11.1 / hr', 7958, 6, 32, 100),
(190, 'Noida', 'Small', 'S10', 'S10 : vCores 8 | RAM  16 GB | Disk - 1000 IOPS -  100 GB | ₹  9.6 / hr', 6908, 8, 16, 100),
(191, 'Noida', 'Small', 'S11', 'S11 : vCores 8 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11.3 / hr', 8108, 8, 32, 100),
(192, 'Noida', 'Small', 'S12', 'S12 : vCores 8 | RAM  56 GB | Disk - 1000 IOPS -  100 GB | ₹  13.8 / hr', 9908, 8, 56, 100),
(193, 'Noida', 'Small', 'S13', 'S13 : vCores 8 | RAM  64 GB | Disk - 1000 IOPS -  100 GB | ₹  14.6 / hr', 10508, 8, 64, 100),
(194, 'Noida', 'Medium', 'M1', 'M1 : vCores 8 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  21.3 / hr', 15308, 8, 128, 100),
(195, 'Noida', 'Medium', 'M2', 'M2 : vCores 8 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  34.6 / hr', 24908, 8, 256, 100),
(196, 'Noida', 'Medium', 'M3', 'M3 : vCores 10 | RAM  24 GB | Disk - 1000 IOPS -  100 GB | ₹  10.7 / hr', 7658, 10, 24, 100),
(197, 'Noida', 'Medium', 'M4', 'M4 : vCores 10 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11.5 / hr', 8258, 10, 32, 100),
(198, 'Noida', 'Medium', 'M5', 'M5 : vCores 12 | RAM  12 GB | Disk - 1000 IOPS -  100 GB | ₹  9.6 / hr', 6908, 12, 12, 100),
(199, 'Noida', 'Medium', 'M6', 'M6 : vCores 12 | RAM  16 GB | Disk - 1000 IOPS -  100 GB | ₹  10.1 / hr', 7208, 12, 16, 100),
(200, 'Noida', 'Medium', 'M7', 'M7 : vCores 12 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11.7 / hr', 8408, 12, 32, 100),
(201, 'Noida', 'Medium', 'M8', 'M8 : vCores 12 | RAM  48 GB | Disk - 1000 IOPS -  100 GB | ₹  13.4 / hr', 9608, 12, 48, 100),
(202, 'Noida', 'Medium', 'M9', 'M9 : vCores 12 | RAM  64 GB | Disk - 1000 IOPS -  100 GB | ₹  15.1 / hr', 10808, 12, 64, 100),
(203, 'Noida', 'Medium', 'M10', 'M10 : vCores 12 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  21.7 / hr', 15608, 12, 128, 100),
(204, 'Noida', 'Medium', 'M11', 'M11 : vCores 14 | RAM  28 GB | Disk - 1000 IOPS -  100 GB | ₹  11.5 / hr', 8258, 14, 28, 100),
(205, 'Noida', 'Medium', 'M12', 'M12 : vCores 14 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  11.9 / hr', 8558, 14, 32, 100),
(206, 'Noida', 'Medium', 'M13', 'M13 : vCores 14 | RAM  64 GB | Disk - 1000 IOPS -  100 GB | ₹  15.3 / hr', 10958, 14, 64, 100),
(207, 'Noida', 'Medium', 'M14', 'M14 : vCores 14 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  21.9 / hr', 15758, 14, 128, 100),
(208, 'Noida', 'Large', 'L1', 'L1 : vCores 16 | RAM  16 GB | Disk - 1000 IOPS -  100 GB | ₹  10.5 / hr', 7508, 16, 16, 100),
(209, 'Noida', 'Large', 'L2', 'L2 : vCores 16 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  12.1 / hr', 8708, 16, 32, 100),
(210, 'Noida', 'Large', 'L3', 'L3 : vCores 16 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  22.1 / hr', 15908, 16, 64, 100),
(211, 'Noida', 'Large', 'L4', 'L4 : vCores 16 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  35.5 / hr', 25508, 16, 128, 100),
(212, 'Noida', 'Large', 'L5', 'L5 : vCores 32 | RAM  32 GB | Disk - 1000 IOPS -  100 GB | ₹  13.8 / hr', 9908, 32, 256, 100),
(213, 'Noida', 'Large', 'L6', 'L6 : vCores 32 | RAM  64 GB | Disk - 1000 IOPS -  100 GB | ₹  17.1 / hr', 12308, 32, 32, 100),
(214, 'Noida', 'Large', 'L7', 'L7 : vCores 32 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  23.8 / hr', 17108, 32, 64, 100),
(215, 'Noida', 'X-Large', 'XL1', 'XL1 : vCores 14 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  21.9 / hr', 15758, 14, 14, 100),
(216, 'Noida', 'X-Large', 'XL2', 'XL2 : vCores 16 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  35.5 / hr', 25508, 16, 16, 100),
(217, 'Noida', 'X-Large', 'XL3', 'XL3 : vCores 16 | RAM  512 GB | Disk - 1000 IOPS -  100 GB | ₹  62.1 / hr', 44708, 16, 16, 100),
(218, 'Noida', 'X-Large', 'XL4', 'XL4 : vCores 32 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  37.1 / hr', 26708, 32, 32, 100),
(219, 'Noida', 'X-Large', 'XL5', 'XL5 : vCores 32 | RAM  512 GB | Disk - 1000 IOPS -  100 GB | ₹  63.8 / hr', 45908, 32, 32, 100),
(220, 'Noida', 'X-Large', 'XL6', 'XL6 : vCores 64 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  27.1 / hr', 19508, 64, 64, 100),
(221, 'Noida', 'X-Large', 'XL7', 'XL7 : vCores 64 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  40.5 / hr', 29108, 64, 64, 100),
(222, 'Noida', 'X-Large', 'XL8', 'XL8 : vCores 64 | RAM  512 GB | Disk - 1000 IOPS -  100 GB | ₹  67.1 / hr', 48308, 64, 64, 100),
(223, 'Noida', 'X-Large', 'XL9', 'XL9 : vCores 128 | RAM  256 GB | Disk - 1000 IOPS -  100 GB | ₹  47.1 / hr', 33908, 128, 128, 100),
(224, 'Noida', 'X-Large', 'XL10', 'XL10 : vCores 256 | RAM  512 GB | Disk - 1000 IOPS -  100 GB | ₹  87.1 / hr', 62708, 256, 256, 100),
(225, 'Noida', 'X-Large', 'XL11', 'XL11 : vCores 256 | RAM  1024 GB | Disk - 1000 IOPS -  100 GB | ₹  140.5 / hr', 101108, 256, 256, 100),
(226, 'Noida', 'Large', 'L8', 'L8 : vCores 32 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  18.1 / hr', 12608, 32, 128, 100),
(227, 'Nashik', 'Large', 'L8', 'L8 : vCores 32 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  18.1 / hr', 12608, 32, 128, 100),
(228, 'Mumbai', 'Large', 'L8', 'L8 : vCores 32 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  18.1 / hr', 12608, 32, 128, 100),
(229, 'Bangalore', 'Large', 'L8', 'L8 : vCores 32 | RAM  128 GB | Disk - 1000 IOPS -  100 GB | ₹  18.1 / hr', 12608, 32, 128, 100);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quot_type`
--

CREATE TABLE `tbl_quot_type` (
  `id` int(11) NOT NULL,
  `template_name` varchar(30) NOT NULL,
  `date_created` datetime NOT NULL,
  `is_active` enum('True','False','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_quot_type`
--

INSERT INTO `tbl_quot_type` (`id`, `template_name`, `date_created`, `is_active`) VALUES
(1, 'DC_DR', '2023-08-24 10:50:35', 'True'),
(2, 'Colocation', '2023-08-24 14:22:56', 'True');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rate_cards`
--

CREATE TABLE `tbl_rate_cards` (
  `id` int(11) NOT NULL,
  `rate_card_name` varchar(50) NOT NULL,
  `card_type` enum('Public','Private') NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_date` datetime NOT NULL,
  `is_active` enum('True','False') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_rate_cards`
--

INSERT INTO `tbl_rate_cards` (`id`, `rate_card_name`, `card_type`, `created_by`, `created_date`, `is_active`) VALUES
(1, 'General Price List', 'Public', '9999', '2023-08-28 11:38:31', 'True'),
(2, 'DIT Price List', 'Public', '9999', '2023-08-28 11:38:31', 'True'),
(3, 'Enterprise Price List', 'Public', '9999', '2023-08-28 11:38:31', 'True'),
(4, 'STPI Price List', 'Public', '9999', '2023-08-28 11:38:31', 'True'),
(14, 'Sasta Rate Card', 'Private', '3094', '2024-01-12 15:03:36', 'True');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_region`
--

CREATE TABLE `tbl_region` (
  `id` int(11) NOT NULL,
  `region` varchar(20) NOT NULL,
  `abbrivation` varchar(3) NOT NULL,
  `is_active` enum('True','Flase') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_region`
--

INSERT INTO `tbl_region` (`id`, `region`, `abbrivation`, `is_active`) VALUES
(0, 'All', 'ALL', 'True'),
(1, 'Nashik', 'NSK', 'True'),
(2, 'Mumbai', 'MUM', 'True'),
(3, 'Bangalore', 'BAN', 'True');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_saved_estimates`
--

CREATE TABLE `tbl_saved_estimates` (
  `id` int(11) NOT NULL,
  `emp_code` int(11) NOT NULL,
  `pot_id` int(11) NOT NULL,
  `project_name` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `version` varchar(5) COLLATE utf8_bin NOT NULL,
  `owner` int(11) NOT NULL,
  `last_changed_by` int(11) NOT NULL,
  `date_created` date NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `contract_period` int(11) NOT NULL,
  `total_upfront` int(11) NOT NULL,
  `discounted_upfront` int(20) NOT NULL,
  `data` text CHARACTER SET utf8mb4 NOT NULL,
  `prices` text COLLATE utf8_bin NOT NULL,
  `discountdata` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tbl_saved_estimates`
--

INSERT INTO `tbl_saved_estimates` (`id`, `emp_code`, `pot_id`, `project_name`, `version`, `owner`, `last_changed_by`, `date_created`, `date_updated`, `contract_period`, `total_upfront`, `discounted_upfront`, `data`, `prices`, `discountdata`) VALUES
(1, 3094, 1234, 'test', '1', 3094, 3094, '2024-01-22', '2024-01-22 05:22:32', 2, 13301864, 0, '{\"quot_type\":\"1\",\"product_list\":\"1\",\"pot_id\":\"1234\",\"edit_id\":\"1\",\"project_name\":\"test\",\"old_pot\":\"1234\",\"version\":\" 1 \",\"count_of_est\":\"1\",\"region\":{\"1\":\"1\"},\"EstType\":{\"1\":\"DC\"},\"estmtname\":{\"1\":\"BOM DC\"},\"period\":{\"1\":\"2\"},\"count_of_virtual_machine\":{\"1\":\"1\"},\"vmname\":{\"1\":[\"Application Server\",\"Application Server\"]},\"vmqty\":{\"1\":[\"1\",\"2\"]},\"vcpu\":{\"1\":[\"12\",\"2\"]},\"ram\":{\"1\":[\"24\",\"6\"]},\"vmDiskIOPS\":{\"1\":[\"block_1\",\"block_4\"]},\"inst_disk\":{\"1\":[\"500\",\"500\"]},\"state\":{\"1\":[\"Standalone\",\"Active\"]},\"os\":{\"1\":[\"centos\",\"win_se\"]},\"database\":{\"1\":[\"my_std\",\"my_com\"]},\"ip_public_type\":{\"1\":[\"ipv4\",\"ipv4\"]},\"ip_public\":{\"1\":[\"02\",\"0\"]},\"virus_type\":{\"1\":[\"tm_av_basic\",\"sym_av_basic\"]},\"block_03_unit\":{\"1\":\"GB\"},\"block_03\":{\"1\":\"on\"},\"block_03_qty\":{\"1\":\"2\"},\"block_1_unit\":{\"1\":\"GB\"},\"block_1\":{\"1\":\"on\"},\"block_1_qty\":{\"1\":\"3\"},\"block_2_unit\":{\"1\":\"GB\"},\"block_2_qty\":{\"1\":\"\"},\"block_3_unit\":{\"1\":\"GB\"},\"block_3_qty\":{\"1\":\"\"},\"block_4_unit\":{\"1\":\"GB\"},\"block_4_qty\":{\"1\":\"\"},\"block_5_unit\":{\"1\":\"GB\"},\"block_5_qty\":{\"1\":\"\"},\"block_6_unit\":{\"1\":\"GB\"},\"block_6_qty\":{\"1\":\"\"},\"block_7_unit\":{\"1\":\"GB\"},\"block_7_qty\":{\"1\":\"\"},\"block_8_unit\":{\"1\":\"GB\"},\"block_8_qty\":{\"1\":\"\"},\"block_9_unit\":{\"1\":\"GB\"},\"block_9_qty\":{\"1\":\"\"},\"block_10_unit\":{\"1\":\"GB\"},\"block_10_qty\":{\"1\":\"\"},\"block_15_unit\":{\"1\":\"GB\"},\"block_15_qty\":{\"1\":\"\"},\"block_20_unit\":{\"1\":\"GB\"},\"block_20\":{\"1\":\"on\"},\"block_20_qty\":{\"1\":\"3\"},\"block_25_unit\":{\"1\":\"GB\"},\"block_25_qty\":{\"1\":\"\"},\"block_30_unit\":{\"1\":\"GB\"},\"block_30_qty\":{\"1\":\"\"},\"block_40_unit\":{\"1\":\"GB\"},\"block_40\":{\"1\":\"on\"},\"block_40_qty\":{\"1\":\"3\"},\"block_50_unit\":{\"1\":\"GB\"},\"block_50\":{\"1\":\"on\"},\"block_50_qty\":{\"1\":\"2\"},\"block_100_unit\":{\"1\":\"GB\"},\"block_100_qty\":{\"1\":\"\"},\"obj_strg_unit\":{\"1\":\"TB\"},\"obj_strg\":{\"1\":\"on\"},\"obj_strg_qty\":{\"1\":\"1651\"},\"obj_strg_shared_unit\":{\"1\":\"GB\"},\"obj_strg_shared_qty\":{\"1\":\"\"},\"backup_strg\":{\"1\":\"39090\"},\"age_qty_type\":{\"1\":\"All VM\"},\"ageqty\":{\"1\":\"\"},\"arc_strg\":{\"1\":\"22\"},\"archival_unit\":{\"1\":\"TB\"},\"tape_lib\":{\"1\":\"on\"},\"tlqty\":{\"1\":\"2\"},\"tcqty\":{\"1\":\"\"},\"fcqty\":{\"1\":\"\"},\"bandwidthType\":{\"1\":\"Speed Based Internet Bandwidth\"},\"bandwidth\":{\"1\":\"22\"},\"load_balancer\":{\"1\":\"vlb_proxy_1G\"},\"lbqty\":{\"1\":\"2\"},\"ccptqty\":{\"1\":\"1\"},\"sslvpn\":{\"1\":\"on\"},\"sslvpnqty\":{\"1\":\"2\"},\"ipsec\":{\"1\":\"on\"},\"ipsecqty\":{\"1\":\"2\"},\"rep_link_qty\":{\"1\":\"\"},\"ssl_certificate_select\":{\"1\":\"domain_wild_ssl\"},\"ssl_certificate_check\":{\"1\":\"on\"},\"ssl_certificate_qty\":{\"1\":\"2\"},\"utm_check\":{\"1\":\"on\"},\"utm_qty\":{\"1\":\"2\"},\"vtm_scan_select\":{\"1\":\"vtm_scan_30\"},\"vtm_scan_check\":{\"1\":\"on\"},\"vtm_scan_qty\":{\"1\":\"2\"},\"siem_select\":{\"1\":\"forti_siem\"},\"siem_check\":{\"1\":\"on\"},\"vapt_select\":{\"1\":\"noncert_vapt\"},\"vapt_check\":{\"1\":\"on\"},\"ddos_check\":{\"1\":\"on\"},\"ddos_qty\":{\"1\":\"2\"},\"waf_select\":{\"1\":\"enligh_vwaf_1gbps\"},\"waf_check\":{\"1\":\"on\"},\"waf_qty\":{\"1\":\"2\"},\"ifw_select\":{\"1\":\"ifw_palo_1gbps\"},\"ifw_check\":{\"1\":\"on\"},\"ifw_qty\":{\"1\":\"2\"},\"dlp_check\":{\"1\":\"on\"},\"dlp_qty\":{\"1\":\"2\"},\"pim_select\":{\"1\":\"pim\"},\"pim_check\":{\"1\":\"on\"},\"pim_qty\":{\"1\":\"2\"},\"iam_check\":{\"1\":\"on\"},\"iam_qty\":{\"1\":\"2\"},\"dam_select\":{\"1\":\"mc_dam\"},\"dam_check\":{\"1\":\"on\"},\"dam_qty\":{\"1\":\"2\"},\"mfa_check\":{\"1\":\"on\"},\"mfa_qty\":{\"1\":\"2\"},\"efw_select\":{\"1\":\"efw_fortinet_1gbps\"},\"efw_check\":{\"1\":\"on\"},\"efw_qty\":{\"1\":\"2\"},\"osmgmt\":{\"1\":\"on\"},\"dbmgmt\":{\"1\":\"on\"},\"strgmgmt\":{\"1\":\"on\"},\"backmgmt\":{\"1\":\"on\"},\"lb_mgmt\":{\"1\":\"on\"},\"fv_mgmt\":{\"1\":\"on\"},\"wafmgmt\":{\"1\":\"on\"},\"emagic_type\":{\"1\":\"Advanced\"},\"emagic\":{\"1\":\"on\"},\"otc\":{\"1\":\"on\"},\"drm_type\":{\"1\":\"\"},\"drillqty\":{\"1\":\"\"},\"rep_link_type\":{\"1\":\"\"},\"proceed\":\"\",\"siem_qty\":{\"1\":11},\"vapt_qty\":{\"1\":11}}', '{\"1\":{\"VM0\":{\"os\":0,\"db\":17518,\"Application Server\":3700},\"VM1\":{\"os\":1040,\"db\":0,\"Application Server\":6200},\"Software\":{\"veeam\":1500},\"Storage Solution\":{\"obj_strg\":3381248,\"block_03\":2,\"block_1\":6,\"block_20\":63,\"block_40\":123,\"block_50\":102,\"Backup Space\":156360,\"Archival Space\":45056,\"Offline Backup Solution Tape Library\":35000},\"Network Solution\":{\"ipv4\":2000,\"bandwidth\":11000,\"cross_connect\":2100,\"ipsec_vpn\":1000,\"sslvpn\":600,\"lb\":9600},\"Security Solution\":{\"av\":900,\"dam\":96000,\"ddos\":29166,\"dlp\":500,\"efw\":9600,\"iam\":2000,\"ifw\":33350,\"mfa\":200,\"pim\":4000,\"siem\":52800,\"ssl_certificate\":4498,\"utm\":33000,\"vapt\":14300,\"vtm_scan\":2000,\"waf\":21000},\"Managed Services\":{\"st_mg\":2535000,\"back_mg\":900,\"rep_mgmt\":0,\"dr_drill\":0,\"lb_mgmt\":3000,\"fw_mgmt\":8000,\"waf_mgmt\":3000,\"emagic\":6500,\"centos_mgmt\":1500,\"win_mgmt\":3000,\"my_db_mgmt\":112500},\"MonthlyTotal\":6650932}}', ''),
(2, 3094, 8615, 'Test', '1', 3094, 3094, '2024-02-06', '2024-02-06 02:27:22', 12, 5491200, 0, '{\"quot_type\":\"1\",\"product_list\":\"1\",\"pot_id\":\"8615\",\"edit_id\":\"2\",\"project_name\":\"Test\",\"old_pot\":\"8615\",\"version\":\" 1 \",\"count_of_est\":\"1\",\"region\":{\"1\":\"1\"},\"EstType\":{\"1\":\"DC\"},\"estmtname\":{\"1\":\"BOM DC\"},\"period\":{\"1\":\"12\"},\"count_of_virtual_machine\":{\"1\":\"1\"},\"vmname\":{\"1\":[\"VM\"]},\"vmqty\":{\"1\":[\"1\"]},\"vcpu\":{\"1\":[\"4\"]},\"ram\":{\"1\":[\"8\"]},\"vmDiskIOPS\":{\"1\":[\"block_1\"]},\"inst_disk\":{\"1\":[\"100\"]},\"state\":{\"1\":[\"Standalone\"]},\"os\":{\"1\":[\"ubuntu\"]},\"database\":{\"1\":[\"\"]},\"ip_public_type\":{\"1\":[\"ipv4\"]},\"ip_public\":{\"1\":[\"1\"]},\"virus_type\":{\"1\":[\"\"]},\"block_03_unit\":{\"1\":\"GB\"},\"block_03_qty\":{\"1\":\"\"},\"block_1_unit\":{\"1\":\"GB\"},\"block_1_qty\":{\"1\":\"\"},\"block_2_unit\":{\"1\":\"GB\"},\"block_2_qty\":{\"1\":\"\"},\"block_3_unit\":{\"1\":\"GB\"},\"block_3_qty\":{\"1\":\"\"},\"block_4_unit\":{\"1\":\"GB\"},\"block_4_qty\":{\"1\":\"\"},\"block_5_unit\":{\"1\":\"GB\"},\"block_5_qty\":{\"1\":\"\"},\"block_6_unit\":{\"1\":\"GB\"},\"block_6_qty\":{\"1\":\"\"},\"block_7_unit\":{\"1\":\"GB\"},\"block_7_qty\":{\"1\":\"\"},\"block_8_unit\":{\"1\":\"GB\"},\"block_8_qty\":{\"1\":\"\"},\"block_9_unit\":{\"1\":\"GB\"},\"block_9_qty\":{\"1\":\"\"},\"block_10_unit\":{\"1\":\"GB\"},\"block_10_qty\":{\"1\":\"\"},\"block_15_unit\":{\"1\":\"GB\"},\"block_15_qty\":{\"1\":\"\"},\"block_20_unit\":{\"1\":\"GB\"},\"block_20_qty\":{\"1\":\"\"},\"block_25_unit\":{\"1\":\"GB\"},\"block_25_qty\":{\"1\":\"\"},\"block_30_unit\":{\"1\":\"GB\"},\"block_30_qty\":{\"1\":\"\"},\"block_40_unit\":{\"1\":\"GB\"},\"block_40_qty\":{\"1\":\"\"},\"block_50_unit\":{\"1\":\"GB\"},\"block_50_qty\":{\"1\":\"\"},\"block_100_unit\":{\"1\":\"GB\"},\"block_100_qty\":{\"1\":\"\"},\"obj_strg_unit\":{\"1\":\"GB\"},\"obj_strg_qty\":{\"1\":\"\"},\"obj_strg_shared_unit\":{\"1\":\"GB\"},\"obj_strg_shared\":{\"1\":\"on\"},\"obj_strg_shared_qty\":{\"1\":\"100000\"},\"backup_strg\":{\"1\":\"\"},\"age_qty_type\":{\"1\":\"\"},\"ageqty\":{\"1\":\"\"},\"arc_strg\":{\"1\":\"\"},\"archival_unit\":{\"1\":\"TB\"},\"tlqty\":{\"1\":\"\"},\"tcqty\":{\"1\":\"\"},\"fcqty\":{\"1\":\"\"},\"bandwidthType\":{\"1\":\"Speed Based Internet Bandwidth\"},\"bandwidth\":{\"1\":\"\"},\"load_balancer\":{\"1\":\"\"},\"lbqty\":{\"1\":\"\"},\"ccptqty\":{\"1\":\"\"},\"sslvpnqty\":{\"1\":\"\"},\"ipsecqty\":{\"1\":\"\"},\"rep_link_qty\":{\"1\":\"\"},\"ssl_certificate_select\":{\"1\":\"\"},\"ssl_certificate_qty\":{\"1\":\"\"},\"utm_qty\":{\"1\":\"\"},\"vtm_scan_select\":{\"1\":\"\"},\"vtm_scan_qty\":{\"1\":\"\"},\"siem_select\":{\"1\":\"\"},\"vapt_select\":{\"1\":\"\"},\"ddos_qty\":{\"1\":\"\"},\"waf_select\":{\"1\":\"\"},\"waf_qty\":{\"1\":\"\"},\"ifw_select\":{\"1\":\"\"},\"ifw_qty\":{\"1\":\"\"},\"dlp_qty\":{\"1\":\"\"},\"pim_select\":{\"1\":\"\"},\"pim_qty\":{\"1\":\"\"},\"iam_qty\":{\"1\":\"\"},\"dam_select\":{\"1\":\"\"},\"dam_qty\":{\"1\":\"\"},\"mfa_qty\":{\"1\":\"\"},\"efw_select\":{\"1\":\"efw_shared\"},\"efw_check\":{\"1\":\"on\"},\"efw_qty\":{\"1\":\"1\"},\"osmgmt\":{\"1\":\"on\"},\"strgmgmt\":{\"1\":\"on\"},\"fv_mgmt\":{\"1\":\"on\"},\"emagic_type\":{\"1\":\"Basic\"},\"emagic\":{\"1\":\"on\"},\"otc\":{\"1\":\"on\"},\"drm_type\":{\"1\":\"\"},\"drillqty\":{\"1\":\"\"},\"rep_link_type\":{\"1\":\"\"},\"proceed\":\"\"}', '{\"1\":{\"VM0\":{\"os\":0,\"VM\":1100},\"Storage Solution\":{\"obj_strg_shared\":300000},\"Network Solution\":{\"ipv4\":1000},\"Security Solution\":{\"efw\":1500},\"Managed Services\":{\"st_mg\":150000,\"back_mg\":0,\"rep_mgmt\":0,\"dr_drill\":0,\"lb_mgmt\":0,\"fw_mgmt\":1500,\"waf_mgmt\":0,\"emagic\":1000,\"ubuntu_mgmt\":1500},\"MonthlyTotal\":457600}}', ''),
(3, 9999, 2232, '32323', '1', 9999, 9999, '2024-02-20', '2024-02-20 02:10:23', 2, 7000, 0, '{\"quot_type\":\"1\",\"product_list\":\"1\",\"pot_id\":\"2232\",\"edit_id\":\"\",\"project_name\":\"32323\",\"version\":\"  \",\"count_of_est\":\"1\",\"region\":{\"1\":\"1\"},\"EstType\":{\"1\":\"DC\"},\"estmtname\":{\"1\":\"BOM DC\"},\"period\":{\"1\":\"2\"},\"count_of_virtual_machine\":{\"1\":\"1\"},\"vmname\":{\"1\":[\"Application Server\"]},\"vmqty\":{\"1\":[\"02\"]},\"vcpu\":{\"1\":[\"2\"]},\"ram\":{\"1\":[\"8\"]},\"vmDiskIOPS\":{\"1\":[\"block_4\"]},\"inst_disk\":{\"1\":[\"100\"]},\"state\":{\"1\":[\"Standalone\"]},\"os\":{\"1\":[\"\"]},\"database\":{\"1\":[\"\"]},\"ip_public_type\":{\"1\":[\"ipv4\"]},\"ip_public\":{\"1\":[\"0\"]},\"virus_type\":{\"1\":[\"\"]},\"block_03_unit\":{\"1\":\"GB\"},\"block_03_qty\":{\"1\":\"\"},\"block_1_unit\":{\"1\":\"GB\"},\"block_1_qty\":{\"1\":\"\"},\"block_2_unit\":{\"1\":\"GB\"},\"block_2_qty\":{\"1\":\"\"},\"block_3_unit\":{\"1\":\"GB\"},\"block_3_qty\":{\"1\":\"\"},\"block_4_unit\":{\"1\":\"GB\"},\"block_4_qty\":{\"1\":\"\"},\"block_5_unit\":{\"1\":\"GB\"},\"block_5_qty\":{\"1\":\"\"},\"block_6_unit\":{\"1\":\"GB\"},\"block_6_qty\":{\"1\":\"\"},\"block_7_unit\":{\"1\":\"GB\"},\"block_7_qty\":{\"1\":\"\"},\"block_8_unit\":{\"1\":\"GB\"},\"block_8_qty\":{\"1\":\"\"},\"block_9_unit\":{\"1\":\"GB\"},\"block_9_qty\":{\"1\":\"\"},\"block_10_unit\":{\"1\":\"GB\"},\"block_10_qty\":{\"1\":\"\"},\"block_15_unit\":{\"1\":\"GB\"},\"block_15_qty\":{\"1\":\"\"},\"block_20_unit\":{\"1\":\"GB\"},\"block_20_qty\":{\"1\":\"\"},\"block_25_unit\":{\"1\":\"GB\"},\"block_25_qty\":{\"1\":\"\"},\"block_30_unit\":{\"1\":\"GB\"},\"block_30_qty\":{\"1\":\"\"},\"block_40_unit\":{\"1\":\"GB\"},\"block_40_qty\":{\"1\":\"\"},\"block_50_unit\":{\"1\":\"GB\"},\"block_50_qty\":{\"1\":\"\"},\"block_100_unit\":{\"1\":\"GB\"},\"block_100_qty\":{\"1\":\"\"},\"obj_strg_unit\":{\"1\":\"GB\"},\"obj_strg_qty\":{\"1\":\"\"},\"obj_strg_shared_unit\":{\"1\":\"GB\"},\"obj_strg_shared_qty\":{\"1\":\"\"},\"backup_strg\":{\"1\":\"\"},\"age_qty_type\":{\"1\":\"\"},\"ageqty\":{\"1\":\"\"},\"arc_strg\":{\"1\":\"\"},\"archival_unit\":{\"1\":\"TB\"},\"tlqty\":{\"1\":\"\"},\"tcqty\":{\"1\":\"\"},\"fcqty\":{\"1\":\"\"},\"bandwidthType\":{\"1\":\"Speed Based Internet Bandwidth\"},\"bandwidth\":{\"1\":\"\"},\"load_balancer\":{\"1\":\"\"},\"lbqty\":{\"1\":\"\"},\"ccptqty\":{\"1\":\"\"},\"sslvpnqty\":{\"1\":\"\"},\"ipsecqty\":{\"1\":\"\"},\"rep_link_qty\":{\"1\":\"\"},\"ssl_certificate_select\":{\"1\":\"\"},\"ssl_certificate_qty\":{\"1\":\"\"},\"utm_qty\":{\"1\":\"\"},\"vtm_scan_select\":{\"1\":\"\"},\"vtm_scan_qty\":{\"1\":\"\"},\"siem_select\":{\"1\":\"\"},\"vapt_select\":{\"1\":\"\"},\"ddos_qty\":{\"1\":\"\"},\"waf_select\":{\"1\":\"\"},\"waf_qty\":{\"1\":\"\"},\"ifw_select\":{\"1\":\"\"},\"ifw_qty\":{\"1\":\"\"},\"dlp_qty\":{\"1\":\"\"},\"pim_select\":{\"1\":\"\"},\"pim_qty\":{\"1\":\"\"},\"iam_qty\":{\"1\":\"\"},\"dam_select\":{\"1\":\"\"},\"dam_qty\":{\"1\":\"\"},\"mfa_qty\":{\"1\":\"\"},\"efw_select\":{\"1\":\"\"},\"efw_qty\":{\"1\":\"\"},\"emagic_type\":{\"1\":\"Basic\"},\"emagic\":{\"1\":\"on\"},\"drm_type\":{\"1\":\"\"},\"drillqty\":{\"1\":\"\"},\"rep_link_type\":{\"1\":\"\"},\"proceed\":\"\"}', '{\"1\":{\"VM0\":{\"Application Server\":2500},\"Managed Services\":{\"st_mg\":0,\"back_mg\":0,\"rep_mgmt\":0,\"dr_drill\":0,\"lb_mgmt\":0,\"fw_mgmt\":0,\"waf_mgmt\":0,\"emagic\":1000},\"MonthlyTotal\":3500}}', ''),
(4, 9999, 2232, '32323', '1', 9999, 9999, '2024-02-20', '2024-02-20 02:15:57', 22, 61600, 0, '{\"quot_type\":\"1\",\"product_list\":\"1\",\"pot_id\":\"2232\",\"edit_id\":\"\",\"project_name\":\"32323\",\"version\":\"  \",\"count_of_est\":\"1\",\"region\":{\"1\":\"1\"},\"EstType\":{\"1\":\"DC\"},\"estmtname\":{\"1\":\"BOM DC\"},\"period\":{\"1\":\"22\"},\"count_of_virtual_machine\":{\"1\":\"1\"},\"vmname\":{\"1\":[\"Application Server\"]},\"vmqty\":{\"1\":[\"2\"]},\"vcpu\":{\"1\":[\"2\"]},\"ram\":{\"1\":[\"8\"]},\"vmDiskIOPS\":{\"1\":[\"block_03\"]},\"inst_disk\":{\"1\":[\"100\"]},\"state\":{\"1\":[\"Standalone\"]},\"os\":{\"1\":[\"\"]},\"database\":{\"1\":[\"\"]},\"ip_public_type\":{\"1\":[\"ipv4\"]},\"ip_public\":{\"1\":[\"0\"]},\"virus_type\":{\"1\":[\"\"]},\"block_03_unit\":{\"1\":\"GB\"},\"block_03_qty\":{\"1\":\"\"},\"block_1_unit\":{\"1\":\"GB\"},\"block_1_qty\":{\"1\":\"\"},\"block_2_unit\":{\"1\":\"GB\"},\"block_2_qty\":{\"1\":\"\"},\"block_3_unit\":{\"1\":\"GB\"},\"block_3_qty\":{\"1\":\"\"},\"block_4_unit\":{\"1\":\"GB\"},\"block_4_qty\":{\"1\":\"\"},\"block_5_unit\":{\"1\":\"GB\"},\"block_5_qty\":{\"1\":\"\"},\"block_6_unit\":{\"1\":\"GB\"},\"block_6_qty\":{\"1\":\"\"},\"block_7_unit\":{\"1\":\"GB\"},\"block_7_qty\":{\"1\":\"\"},\"block_8_unit\":{\"1\":\"GB\"},\"block_8_qty\":{\"1\":\"\"},\"block_9_unit\":{\"1\":\"GB\"},\"block_9_qty\":{\"1\":\"\"},\"block_10_unit\":{\"1\":\"GB\"},\"block_10_qty\":{\"1\":\"\"},\"block_15_unit\":{\"1\":\"GB\"},\"block_15_qty\":{\"1\":\"\"},\"block_20_unit\":{\"1\":\"GB\"},\"block_20_qty\":{\"1\":\"\"},\"block_25_unit\":{\"1\":\"GB\"},\"block_25_qty\":{\"1\":\"\"},\"block_30_unit\":{\"1\":\"GB\"},\"block_30_qty\":{\"1\":\"\"},\"block_40_unit\":{\"1\":\"GB\"},\"block_40_qty\":{\"1\":\"\"},\"block_50_unit\":{\"1\":\"GB\"},\"block_50_qty\":{\"1\":\"\"},\"block_100_unit\":{\"1\":\"GB\"},\"block_100_qty\":{\"1\":\"\"},\"obj_strg_unit\":{\"1\":\"GB\"},\"obj_strg_qty\":{\"1\":\"\"},\"obj_strg_shared_unit\":{\"1\":\"GB\"},\"obj_strg_shared_qty\":{\"1\":\"\"},\"backup_strg\":{\"1\":\"\"},\"age_qty_type\":{\"1\":\"\"},\"ageqty\":{\"1\":\"\"},\"arc_strg\":{\"1\":\"\"},\"archival_unit\":{\"1\":\"TB\"},\"tlqty\":{\"1\":\"\"},\"tcqty\":{\"1\":\"\"},\"fcqty\":{\"1\":\"\"},\"bandwidthType\":{\"1\":\"Speed Based Internet Bandwidth\"},\"bandwidth\":{\"1\":\"\"},\"load_balancer\":{\"1\":\"\"},\"lbqty\":{\"1\":\"\"},\"ccptqty\":{\"1\":\"\"},\"sslvpnqty\":{\"1\":\"\"},\"ipsecqty\":{\"1\":\"\"},\"rep_link_qty\":{\"1\":\"\"},\"ssl_certificate_select\":{\"1\":\"\"},\"ssl_certificate_qty\":{\"1\":\"\"},\"utm_qty\":{\"1\":\"\"},\"vtm_scan_select\":{\"1\":\"\"},\"vtm_scan_qty\":{\"1\":\"\"},\"siem_select\":{\"1\":\"\"},\"vapt_select\":{\"1\":\"\"},\"ddos_qty\":{\"1\":\"\"},\"waf_select\":{\"1\":\"\"},\"waf_qty\":{\"1\":\"\"},\"ifw_select\":{\"1\":\"\"},\"ifw_qty\":{\"1\":\"\"},\"dlp_qty\":{\"1\":\"\"},\"pim_select\":{\"1\":\"\"},\"pim_qty\":{\"1\":\"\"},\"iam_qty\":{\"1\":\"\"},\"dam_select\":{\"1\":\"\"},\"dam_qty\":{\"1\":\"\"},\"mfa_qty\":{\"1\":\"\"},\"efw_select\":{\"1\":\"\"},\"efw_qty\":{\"1\":\"\"},\"emagic_type\":{\"1\":\"Basic\"},\"emagic\":{\"1\":\"on\"},\"drm_type\":{\"1\":\"\"},\"drillqty\":{\"1\":\"\"},\"rep_link_type\":{\"1\":\"\"},\"proceed\":\"\"}', '{\"1\":{\"VM0\":{\"Application Server\":1800},\"Managed Services\":{\"st_mg\":0,\"back_mg\":0,\"rep_mgmt\":0,\"dr_drill\":0,\"lb_mgmt\":0,\"fw_mgmt\":0,\"waf_mgmt\":0,\"emagic\":1000},\"MonthlyTotal\":2800}}', ''),
(5, 9999, 1234, 'ABC', '1', 9999, 9999, '2024-02-20', '2024-02-20 04:06:36', 2, 9600, 0, '{\"quot_type\":\"1\",\"product_list\":\"1\",\"pot_id\":\"1234\",\"edit_id\":\"\",\"project_name\":\"ABC\",\"version\":\"  \",\"count_of_est\":\"1\",\"region\":{\"1\":\"1\"},\"EstType\":{\"1\":\"DC\"},\"estmtname\":{\"1\":\"BOM DC\"},\"period\":{\"1\":\"2\"},\"count_of_virtual_machine\":{\"1\":\"1\"},\"vmname\":{\"1\":[\"Application Server\"]},\"vmqty\":{\"1\":[\"02\"]},\"vcpu\":{\"1\":[\"22\"]},\"ram\":{\"1\":[\"2\"]},\"vmDiskIOPS\":{\"1\":[\"block_03\"]},\"inst_disk\":{\"1\":[\"100\"]},\"state\":{\"1\":[\"Standalone\"]},\"os\":{\"1\":[\"\"]},\"database\":{\"1\":[\"\"]},\"ip_public_type\":{\"1\":[\"ipv4\"]},\"ip_public\":{\"1\":[\"0\"]},\"virus_type\":{\"1\":[\"\"]},\"block_03_unit\":{\"1\":\"GB\"},\"block_03_qty\":{\"1\":\"\"},\"block_1_unit\":{\"1\":\"GB\"},\"block_1_qty\":{\"1\":\"\"},\"block_2_unit\":{\"1\":\"GB\"},\"block_2_qty\":{\"1\":\"\"},\"block_3_unit\":{\"1\":\"GB\"},\"block_3_qty\":{\"1\":\"\"},\"block_4_unit\":{\"1\":\"GB\"},\"block_4_qty\":{\"1\":\"\"},\"block_5_unit\":{\"1\":\"GB\"},\"block_5_qty\":{\"1\":\"\"},\"block_6_unit\":{\"1\":\"GB\"},\"block_6_qty\":{\"1\":\"\"},\"block_7_unit\":{\"1\":\"GB\"},\"block_7_qty\":{\"1\":\"\"},\"block_8_unit\":{\"1\":\"GB\"},\"block_8_qty\":{\"1\":\"\"},\"block_9_unit\":{\"1\":\"GB\"},\"block_9_qty\":{\"1\":\"\"},\"block_10_unit\":{\"1\":\"GB\"},\"block_10_qty\":{\"1\":\"\"},\"block_15_unit\":{\"1\":\"GB\"},\"block_15_qty\":{\"1\":\"\"},\"block_20_unit\":{\"1\":\"GB\"},\"block_20_qty\":{\"1\":\"\"},\"block_25_unit\":{\"1\":\"GB\"},\"block_25_qty\":{\"1\":\"\"},\"block_30_unit\":{\"1\":\"GB\"},\"block_30_qty\":{\"1\":\"\"},\"block_40_unit\":{\"1\":\"GB\"},\"block_40_qty\":{\"1\":\"\"},\"block_50_unit\":{\"1\":\"GB\"},\"block_50_qty\":{\"1\":\"\"},\"block_100_unit\":{\"1\":\"GB\"},\"block_100_qty\":{\"1\":\"\"},\"obj_strg_unit\":{\"1\":\"GB\"},\"obj_strg_qty\":{\"1\":\"\"},\"obj_strg_shared_unit\":{\"1\":\"GB\"},\"obj_strg_shared_qty\":{\"1\":\"\"},\"backup_strg\":{\"1\":\"\"},\"age_qty_type\":{\"1\":\"\"},\"ageqty\":{\"1\":\"\"},\"arc_strg\":{\"1\":\"\"},\"archival_unit\":{\"1\":\"TB\"},\"tlqty\":{\"1\":\"\"},\"tcqty\":{\"1\":\"\"},\"fcqty\":{\"1\":\"\"},\"bandwidthType\":{\"1\":\"Speed Based Internet Bandwidth\"},\"bandwidth\":{\"1\":\"\"},\"load_balancer\":{\"1\":\"\"},\"lbqty\":{\"1\":\"\"},\"ccptqty\":{\"1\":\"\"},\"sslvpnqty\":{\"1\":\"\"},\"ipsecqty\":{\"1\":\"\"},\"rep_link_qty\":{\"1\":\"\"},\"ssl_certificate_select\":{\"1\":\"\"},\"ssl_certificate_qty\":{\"1\":\"\"},\"utm_qty\":{\"1\":\"\"},\"vtm_scan_select\":{\"1\":\"\"},\"vtm_scan_qty\":{\"1\":\"\"},\"siem_select\":{\"1\":\"\"},\"vapt_select\":{\"1\":\"\"},\"ddos_qty\":{\"1\":\"\"},\"waf_select\":{\"1\":\"\"},\"waf_qty\":{\"1\":\"\"},\"ifw_select\":{\"1\":\"\"},\"ifw_qty\":{\"1\":\"\"},\"dlp_qty\":{\"1\":\"\"},\"pim_select\":{\"1\":\"\"},\"pim_qty\":{\"1\":\"\"},\"iam_qty\":{\"1\":\"\"},\"dam_select\":{\"1\":\"\"},\"dam_qty\":{\"1\":\"\"},\"mfa_qty\":{\"1\":\"\"},\"efw_select\":{\"1\":\"\"},\"efw_qty\":{\"1\":\"\"},\"emagic_type\":{\"1\":\"Basic\"},\"emagic\":{\"1\":\"on\"},\"drm_type\":{\"1\":\"\"},\"drillqty\":{\"1\":\"\"},\"rep_link_type\":{\"1\":\"\"},\"proceed\":\"\"}', '{\"1\":{\"VM0\":{\"Application Server\":3800},\"Managed Services\":{\"st_mg\":0,\"back_mg\":0,\"rep_mgmt\":0,\"dr_drill\":0,\"lb_mgmt\":0,\"fw_mgmt\":0,\"waf_mgmt\":0,\"emagic\":1000},\"MonthlyTotal\":4800}}', ''),
(6, 3094, 1234, 'test', '2', 3094, 3094, '2024-01-22', '2024-01-22 05:22:32', 2, 13301864, 0, '{\"quot_type\":\"1\",\"product_list\":\"1\",\"pot_id\":\"1234\",\"edit_id\":\"1\",\"project_name\":\"test\",\"old_pot\":\"1234\",\"version\":\" 1 \",\"count_of_est\":\"1\",\"region\":{\"1\":\"1\"},\"EstType\":{\"1\":\"DC\"},\"estmtname\":{\"1\":\"BOM DC\"},\"period\":{\"1\":\"2\"},\"count_of_virtual_machine\":{\"1\":\"1\"},\"vmname\":{\"1\":[\"Application Server\",\"Application Server\"]},\"vmqty\":{\"1\":[\"1\",\"2\"]},\"vcpu\":{\"1\":[\"12\",\"2\"]},\"ram\":{\"1\":[\"24\",\"6\"]},\"vmDiskIOPS\":{\"1\":[\"block_1\",\"block_4\"]},\"inst_disk\":{\"1\":[\"500\",\"500\"]},\"state\":{\"1\":[\"Standalone\",\"Active\"]},\"os\":{\"1\":[\"centos\",\"win_se\"]},\"database\":{\"1\":[\"my_std\",\"my_com\"]},\"ip_public_type\":{\"1\":[\"ipv4\",\"ipv4\"]},\"ip_public\":{\"1\":[\"02\",\"0\"]},\"virus_type\":{\"1\":[\"tm_av_basic\",\"sym_av_basic\"]},\"block_03_unit\":{\"1\":\"GB\"},\"block_03\":{\"1\":\"on\"},\"block_03_qty\":{\"1\":\"2\"},\"block_1_unit\":{\"1\":\"GB\"},\"block_1\":{\"1\":\"on\"},\"block_1_qty\":{\"1\":\"3\"},\"block_2_unit\":{\"1\":\"GB\"},\"block_2_qty\":{\"1\":\"\"},\"block_3_unit\":{\"1\":\"GB\"},\"block_3_qty\":{\"1\":\"\"},\"block_4_unit\":{\"1\":\"GB\"},\"block_4_qty\":{\"1\":\"\"},\"block_5_unit\":{\"1\":\"GB\"},\"block_5_qty\":{\"1\":\"\"},\"block_6_unit\":{\"1\":\"GB\"},\"block_6_qty\":{\"1\":\"\"},\"block_7_unit\":{\"1\":\"GB\"},\"block_7_qty\":{\"1\":\"\"},\"block_8_unit\":{\"1\":\"GB\"},\"block_8_qty\":{\"1\":\"\"},\"block_9_unit\":{\"1\":\"GB\"},\"block_9_qty\":{\"1\":\"\"},\"block_10_unit\":{\"1\":\"GB\"},\"block_10_qty\":{\"1\":\"\"},\"block_15_unit\":{\"1\":\"GB\"},\"block_15_qty\":{\"1\":\"\"},\"block_20_unit\":{\"1\":\"GB\"},\"block_20\":{\"1\":\"on\"},\"block_20_qty\":{\"1\":\"3\"},\"block_25_unit\":{\"1\":\"GB\"},\"block_25_qty\":{\"1\":\"\"},\"block_30_unit\":{\"1\":\"GB\"},\"block_30_qty\":{\"1\":\"\"},\"block_40_unit\":{\"1\":\"GB\"},\"block_40\":{\"1\":\"on\"},\"block_40_qty\":{\"1\":\"3\"},\"block_50_unit\":{\"1\":\"GB\"},\"block_50\":{\"1\":\"on\"},\"block_50_qty\":{\"1\":\"2\"},\"block_100_unit\":{\"1\":\"GB\"},\"block_100_qty\":{\"1\":\"\"},\"obj_strg_unit\":{\"1\":\"TB\"},\"obj_strg\":{\"1\":\"on\"},\"obj_strg_qty\":{\"1\":\"1651\"},\"obj_strg_shared_unit\":{\"1\":\"GB\"},\"obj_strg_shared_qty\":{\"1\":\"\"},\"backup_strg\":{\"1\":\"39090\"},\"age_qty_type\":{\"1\":\"All VM\"},\"ageqty\":{\"1\":\"\"},\"arc_strg\":{\"1\":\"22\"},\"archival_unit\":{\"1\":\"TB\"},\"tape_lib\":{\"1\":\"on\"},\"tlqty\":{\"1\":\"2\"},\"tcqty\":{\"1\":\"\"},\"fcqty\":{\"1\":\"\"},\"bandwidthType\":{\"1\":\"Speed Based Internet Bandwidth\"},\"bandwidth\":{\"1\":\"22\"},\"load_balancer\":{\"1\":\"vlb_proxy_1G\"},\"lbqty\":{\"1\":\"2\"},\"ccptqty\":{\"1\":\"1\"},\"sslvpn\":{\"1\":\"on\"},\"sslvpnqty\":{\"1\":\"2\"},\"ipsec\":{\"1\":\"on\"},\"ipsecqty\":{\"1\":\"2\"},\"rep_link_qty\":{\"1\":\"\"},\"ssl_certificate_select\":{\"1\":\"domain_wild_ssl\"},\"ssl_certificate_check\":{\"1\":\"on\"},\"ssl_certificate_qty\":{\"1\":\"2\"},\"utm_check\":{\"1\":\"on\"},\"utm_qty\":{\"1\":\"2\"},\"vtm_scan_select\":{\"1\":\"vtm_scan_30\"},\"vtm_scan_check\":{\"1\":\"on\"},\"vtm_scan_qty\":{\"1\":\"2\"},\"siem_select\":{\"1\":\"forti_siem\"},\"siem_check\":{\"1\":\"on\"},\"vapt_select\":{\"1\":\"noncert_vapt\"},\"vapt_check\":{\"1\":\"on\"},\"ddos_check\":{\"1\":\"on\"},\"ddos_qty\":{\"1\":\"2\"},\"waf_select\":{\"1\":\"enligh_vwaf_1gbps\"},\"waf_check\":{\"1\":\"on\"},\"waf_qty\":{\"1\":\"2\"},\"ifw_select\":{\"1\":\"ifw_palo_1gbps\"},\"ifw_check\":{\"1\":\"on\"},\"ifw_qty\":{\"1\":\"2\"},\"dlp_check\":{\"1\":\"on\"},\"dlp_qty\":{\"1\":\"2\"},\"pim_select\":{\"1\":\"pim\"},\"pim_check\":{\"1\":\"on\"},\"pim_qty\":{\"1\":\"2\"},\"iam_check\":{\"1\":\"on\"},\"iam_qty\":{\"1\":\"2\"},\"dam_select\":{\"1\":\"mc_dam\"},\"dam_check\":{\"1\":\"on\"},\"dam_qty\":{\"1\":\"2\"},\"mfa_check\":{\"1\":\"on\"},\"mfa_qty\":{\"1\":\"2\"},\"efw_select\":{\"1\":\"efw_fortinet_1gbps\"},\"efw_check\":{\"1\":\"on\"},\"efw_qty\":{\"1\":\"2\"},\"osmgmt\":{\"1\":\"on\"},\"dbmgmt\":{\"1\":\"on\"},\"strgmgmt\":{\"1\":\"on\"},\"backmgmt\":{\"1\":\"on\"},\"lb_mgmt\":{\"1\":\"on\"},\"fv_mgmt\":{\"1\":\"on\"},\"wafmgmt\":{\"1\":\"on\"},\"emagic_type\":{\"1\":\"Advanced\"},\"emagic\":{\"1\":\"on\"},\"otc\":{\"1\":\"on\"},\"drm_type\":{\"1\":\"\"},\"drillqty\":{\"1\":\"\"},\"rep_link_type\":{\"1\":\"\"},\"proceed\":\"\",\"siem_qty\":{\"1\":11},\"vapt_qty\":{\"1\":11}}', '', ''),
(7, 3094, 1234, 'ABC', '1', 3094, 3094, '2024-02-20', '2024-02-20 05:16:19', 2, 3300, 0, '{\"quot_type\":\"1\",\"product_list\":\"1\",\"pot_id\":\"1234\",\"edit_id\":\"\",\"project_name\":\"ABC\",\"version\":\"  \",\"count_of_est\":\"1\",\"region\":{\"1\":\"1\"},\"EstType\":{\"1\":\"DC\"},\"estmtname\":{\"1\":\"BOM DC\"},\"period\":{\"1\":\"2\"},\"count_of_virtual_machine\":{\"1\":\"1\"},\"vmname\":{\"1\":[\"Application Server\"]},\"vmqty\":{\"1\":[\"02\"]},\"vcpu\":{\"1\":[\"1\"]},\"ram\":{\"1\":[\"2\"]},\"vmDiskIOPS\":{\"1\":[\"block_03\"]},\"inst_disk\":{\"1\":[\"100\"]},\"state\":{\"1\":[\"Standalone\"]},\"os\":{\"1\":[\"\"]},\"database\":{\"1\":[\"\"]},\"ip_public_type\":{\"1\":[\"ipv4\"]},\"ip_public\":{\"1\":[\"0\"]},\"virus_type\":{\"1\":[\"\"]},\"block_03_unit\":{\"1\":\"GB\"},\"block_03_qty\":{\"1\":\"\"},\"block_1_unit\":{\"1\":\"GB\"},\"block_1_qty\":{\"1\":\"\"},\"block_2_unit\":{\"1\":\"GB\"},\"block_2_qty\":{\"1\":\"\"},\"block_3_unit\":{\"1\":\"GB\"},\"block_3_qty\":{\"1\":\"\"},\"block_4_unit\":{\"1\":\"GB\"},\"block_4_qty\":{\"1\":\"\"},\"block_5_unit\":{\"1\":\"GB\"},\"block_5_qty\":{\"1\":\"\"},\"block_6_unit\":{\"1\":\"GB\"},\"block_6_qty\":{\"1\":\"\"},\"block_7_unit\":{\"1\":\"GB\"},\"block_7_qty\":{\"1\":\"\"},\"block_8_unit\":{\"1\":\"GB\"},\"block_8_qty\":{\"1\":\"\"},\"block_9_unit\":{\"1\":\"GB\"},\"block_9_qty\":{\"1\":\"\"},\"block_10_unit\":{\"1\":\"GB\"},\"block_10_qty\":{\"1\":\"\"},\"block_15_unit\":{\"1\":\"GB\"},\"block_15_qty\":{\"1\":\"\"},\"block_20_unit\":{\"1\":\"GB\"},\"block_20_qty\":{\"1\":\"\"},\"block_25_unit\":{\"1\":\"GB\"},\"block_25_qty\":{\"1\":\"\"},\"block_30_unit\":{\"1\":\"GB\"},\"block_30_qty\":{\"1\":\"\"},\"block_40_unit\":{\"1\":\"GB\"},\"block_40_qty\":{\"1\":\"\"},\"block_50_unit\":{\"1\":\"GB\"},\"block_50_qty\":{\"1\":\"\"},\"block_100_unit\":{\"1\":\"GB\"},\"block_100_qty\":{\"1\":\"\"},\"obj_strg_unit\":{\"1\":\"GB\"},\"obj_strg_qty\":{\"1\":\"\"},\"obj_strg_shared_unit\":{\"1\":\"GB\"},\"obj_strg_shared_qty\":{\"1\":\"\"},\"backup_strg\":{\"1\":\"\"},\"age_qty_type\":{\"1\":\"\"},\"ageqty\":{\"1\":\"\"},\"arc_strg\":{\"1\":\"\"},\"archival_unit\":{\"1\":\"TB\"},\"tlqty\":{\"1\":\"\"},\"tcqty\":{\"1\":\"\"},\"fcqty\":{\"1\":\"\"},\"bandwidthType\":{\"1\":\"Speed Based Internet Bandwidth\"},\"bandwidth\":{\"1\":\"\"},\"load_balancer\":{\"1\":\"\"},\"lbqty\":{\"1\":\"\"},\"ccptqty\":{\"1\":\"\"},\"sslvpnqty\":{\"1\":\"\"},\"ipsecqty\":{\"1\":\"\"},\"rep_link_qty\":{\"1\":\"\"},\"ssl_certificate_select\":{\"1\":\"\"},\"ssl_certificate_qty\":{\"1\":\"\"},\"utm_qty\":{\"1\":\"\"},\"vtm_scan_select\":{\"1\":\"\"},\"vtm_scan_qty\":{\"1\":\"\"},\"siem_select\":{\"1\":\"\"},\"vapt_select\":{\"1\":\"\"},\"ddos_qty\":{\"1\":\"\"},\"waf_select\":{\"1\":\"\"},\"waf_qty\":{\"1\":\"\"},\"ifw_select\":{\"1\":\"\"},\"ifw_qty\":{\"1\":\"\"},\"dlp_qty\":{\"1\":\"\"},\"pim_select\":{\"1\":\"\"},\"pim_qty\":{\"1\":\"\"},\"iam_qty\":{\"1\":\"\"},\"dam_select\":{\"1\":\"\"},\"dam_qty\":{\"1\":\"\"},\"mfa_qty\":{\"1\":\"\"},\"efw_select\":{\"1\":\"\"},\"efw_qty\":{\"1\":\"\"},\"emagic_type\":{\"1\":\"Basic\"},\"emagic\":{\"1\":\"on\"},\"drm_type\":{\"1\":\"\"},\"drillqty\":{\"1\":\"\"},\"rep_link_type\":{\"1\":\"\"},\"proceed\":\"\"}', '{\"1\":{\"VM0\":{\"Application Server\":650},\"Managed Services\":{\"st_mg\":0,\"back_mg\":0,\"rep_mgmt\":0,\"dr_drill\":0,\"lb_mgmt\":0,\"fw_mgmt\":0,\"waf_mgmt\":0,\"emagic\":1000},\"MonthlyTotal\":1650}}', ''),
(8, 3094, 1111, '122', '1', 3094, 3094, '2024-02-20', '2024-02-20 05:50:49', 22, 38324, 0, '{\"quot_type\":\"1\",\"product_list\":\"1\",\"pot_id\":\"1111\",\"edit_id\":\"\",\"project_name\":\"122\",\"version\":\"  \",\"count_of_est\":\"1\",\"region\":{\"1\":\"1\"},\"EstType\":{\"1\":\"DC\"},\"estmtname\":{\"1\":\"fefe\"},\"period\":{\"1\":\"22\"},\"count_of_virtual_machine\":{\"1\":\"1\"},\"vmname\":{\"1\":[\"Application Server\"]},\"vmqty\":{\"1\":[\"02\"]},\"vcpu\":{\"1\":[\"1\"]},\"ram\":{\"1\":[\"2\"]},\"vmDiskIOPS\":{\"1\":[\"block_03\"]},\"inst_disk\":{\"1\":[\"100\"]},\"state\":{\"1\":[\"Standalone\"]},\"os\":{\"1\":[\"\"]},\"database\":{\"1\":[\"\"]},\"ip_public_type\":{\"1\":[\"ipv4\"]},\"ip_public\":{\"1\":[\"0\"]},\"virus_type\":{\"1\":[\"\"]},\"block_03_unit\":{\"1\":\"GB\"},\"block_03_qty\":{\"1\":\"\"},\"block_1_unit\":{\"1\":\"GB\"},\"block_1_qty\":{\"1\":\"\"},\"block_2_unit\":{\"1\":\"GB\"},\"block_2_qty\":{\"1\":\"\"},\"block_3_unit\":{\"1\":\"GB\"},\"block_3_qty\":{\"1\":\"\"},\"block_4_unit\":{\"1\":\"GB\"},\"block_4_qty\":{\"1\":\"\"},\"block_5_unit\":{\"1\":\"GB\"},\"block_5_qty\":{\"1\":\"\"},\"block_6_unit\":{\"1\":\"GB\"},\"block_6_qty\":{\"1\":\"\"},\"block_7_unit\":{\"1\":\"GB\"},\"block_7_qty\":{\"1\":\"\"},\"block_8_unit\":{\"1\":\"GB\"},\"block_8_qty\":{\"1\":\"\"},\"block_9_unit\":{\"1\":\"GB\"},\"block_9_qty\":{\"1\":\"\"},\"block_10_unit\":{\"1\":\"GB\"},\"block_10_qty\":{\"1\":\"\"},\"block_15_unit\":{\"1\":\"GB\"},\"block_15_qty\":{\"1\":\"\"},\"block_20_unit\":{\"1\":\"GB\"},\"block_20_qty\":{\"1\":\"\"},\"block_25_unit\":{\"1\":\"GB\"},\"block_25_qty\":{\"1\":\"\"},\"block_30_unit\":{\"1\":\"GB\"},\"block_30_qty\":{\"1\":\"\"},\"block_40_unit\":{\"1\":\"GB\"},\"block_40_qty\":{\"1\":\"\"},\"block_50_unit\":{\"1\":\"GB\"},\"block_50_qty\":{\"1\":\"\"},\"block_100_unit\":{\"1\":\"GB\"},\"block_100_qty\":{\"1\":\"\"},\"obj_strg_unit\":{\"1\":\"GB\"},\"obj_strg\":{\"1\":\"on\"},\"obj_strg_qty\":{\"1\":\"2\"},\"obj_strg_shared_unit\":{\"1\":\"GB\"},\"obj_strg_shared_qty\":{\"1\":\"\"},\"backup_strg\":{\"1\":\"22\"},\"age_qty_type\":{\"1\":\"\"},\"ageqty\":{\"1\":\"\"},\"arc_strg\":{\"1\":\"\"},\"archival_unit\":{\"1\":\"TB\"},\"tlqty\":{\"1\":\"\"},\"tcqty\":{\"1\":\"\"},\"fcqty\":{\"1\":\"\"},\"bandwidthType\":{\"1\":\"Speed Based Internet Bandwidth\"},\"bandwidth\":{\"1\":\"\"},\"load_balancer\":{\"1\":\"\"},\"lbqty\":{\"1\":\"\"},\"ccptqty\":{\"1\":\"\"},\"sslvpnqty\":{\"1\":\"\"},\"ipsecqty\":{\"1\":\"\"},\"rep_link_qty\":{\"1\":\"\"},\"ssl_certificate_select\":{\"1\":\"\"},\"ssl_certificate_qty\":{\"1\":\"0\"},\"utm_qty\":{\"1\":\"\"},\"vtm_scan_select\":{\"1\":\"\"},\"vtm_scan_qty\":{\"1\":\"\"},\"siem_select\":{\"1\":\"\"},\"vapt_select\":{\"1\":\"\"},\"ddos_qty\":{\"1\":\"\"},\"waf_select\":{\"1\":\"\"},\"waf_qty\":{\"1\":\"\"},\"ifw_select\":{\"1\":\"\"},\"ifw_qty\":{\"1\":\"\"},\"dlp_qty\":{\"1\":\"\"},\"pim_select\":{\"1\":\"\"},\"pim_qty\":{\"1\":\"\"},\"iam_qty\":{\"1\":\"\"},\"dam_select\":{\"1\":\"\"},\"dam_qty\":{\"1\":\"\"},\"mfa_qty\":{\"1\":\"\"},\"efw_select\":{\"1\":\"\"},\"efw_qty\":{\"1\":\"\"},\"emagic_type\":{\"1\":\"Basic\"},\"emagic\":{\"1\":\"on\"},\"drm_type\":{\"1\":\"\"},\"drillqty\":{\"1\":\"\"},\"rep_link_type\":{\"1\":\"\"},\"proceed\":\"\"}', '{\"1\":{\"VM0\":{\"Application Server\":650},\"Storage Solution\":{\"obj_strg\":4,\"Backup Space\":88},\"Managed Services\":{\"st_mg\":0,\"back_mg\":0,\"rep_mgmt\":0,\"dr_drill\":0,\"lb_mgmt\":0,\"fw_mgmt\":0,\"waf_mgmt\":0,\"emagic\":1000},\"MonthlyTotal\":1742}}', ''),
(9, 3094, 12222, 'dsfv', '1', 3094, 3094, '2024-02-21', '2024-02-21 02:05:18', 2, 230540, 0, '{\"quot_type\":\"1\",\"product_list\":\"1\",\"pot_id\":\"12222\",\"edit_id\":\"\",\"project_name\":\"dsfv\",\"version\":\"  \",\"count_of_est\":\"1\",\"region\":{\"1\":\"1\"},\"EstType\":{\"1\":\"DC\"},\"estmtname\":{\"1\":\"BOM DC\"},\"period\":{\"1\":\"2\"},\"count_of_virtual_machine\":{\"1\":\"3\"},\"vmname\":{\"1\":[\"Application Server\",\"DB Server\",\"wdwdw\"]},\"vmqty\":{\"1\":[\"02\",\"2\",\"2\"]},\"vcpu\":{\"1\":[\"2\",\"6\",\"12\"]},\"ram\":{\"1\":[\"22\",\"20\",\"22\"]},\"vmDiskIOPS\":{\"1\":[\"block_2\",\"block_03\",\"block_03\"]},\"inst_disk\":{\"1\":[\"550\",\"100\",\"225\"]},\"state\":{\"1\":[\"Standalone\",\"Standalone\",\"Standalone\"]},\"os\":{\"1\":[\"win_se\",\"win_dc\",\"win_se\"]},\"database\":{\"1\":[\"ms_express\",\"my_com\",\"ms_web\"]},\"ip_public_type\":{\"1\":[\"ipv4\",\"ipv4\",\"ipv4\"]},\"ip_public\":{\"1\":[\"02\",\"2\",\"02\"]},\"virus_type\":{\"1\":[\"sym_av_basic\",\"tm_av_basic\",\"\"]},\"block_03_unit\":{\"1\":\"GB\"},\"block_03_qty\":{\"1\":\"\"},\"block_1_unit\":{\"1\":\"GB\"},\"block_1_qty\":{\"1\":\"\"},\"block_2_unit\":{\"1\":\"GB\"},\"block_2_qty\":{\"1\":\"\"},\"block_3_unit\":{\"1\":\"GB\"},\"block_3_qty\":{\"1\":\"\"},\"block_4_unit\":{\"1\":\"GB\"},\"block_4_qty\":{\"1\":\"\"},\"block_5_unit\":{\"1\":\"GB\"},\"block_5_qty\":{\"1\":\"\"},\"block_6_unit\":{\"1\":\"GB\"},\"block_6_qty\":{\"1\":\"\"},\"block_7_unit\":{\"1\":\"GB\"},\"block_7_qty\":{\"1\":\"\"},\"block_8_unit\":{\"1\":\"GB\"},\"block_8_qty\":{\"1\":\"\"},\"block_9_unit\":{\"1\":\"GB\"},\"block_9_qty\":{\"1\":\"\"},\"block_10_unit\":{\"1\":\"GB\"},\"block_10_qty\":{\"1\":\"\"},\"block_15_unit\":{\"1\":\"GB\"},\"block_15_qty\":{\"1\":\"\"},\"block_20_unit\":{\"1\":\"GB\"},\"block_20_qty\":{\"1\":\"\"},\"block_25_unit\":{\"1\":\"GB\"},\"block_25_qty\":{\"1\":\"\"},\"block_30_unit\":{\"1\":\"GB\"},\"block_30_qty\":{\"1\":\"\"},\"block_40_unit\":{\"1\":\"GB\"},\"block_40_qty\":{\"1\":\"\"},\"block_50_unit\":{\"1\":\"GB\"},\"block_50_qty\":{\"1\":\"\"},\"block_100_unit\":{\"1\":\"GB\"},\"block_100_qty\":{\"1\":\"\"},\"obj_strg_unit\":{\"1\":\"GB\"},\"obj_strg_qty\":{\"1\":\"\"},\"obj_strg_shared_unit\":{\"1\":\"GB\"},\"obj_strg_shared_qty\":{\"1\":\"\"},\"backup_strg\":{\"1\":\"\"},\"age_qty_type\":{\"1\":\"\"},\"ageqty\":{\"1\":\"\"},\"arc_strg\":{\"1\":\"\"},\"archival_unit\":{\"1\":\"TB\"},\"tlqty\":{\"1\":\"\"},\"tcqty\":{\"1\":\"\"},\"fcqty\":{\"1\":\"\"},\"bandwidthType\":{\"1\":\"Speed Based Internet Bandwidth\"},\"bandwidth\":{\"1\":\"\"},\"load_balancer\":{\"1\":\"\"},\"lbqty\":{\"1\":\"\"},\"ccptqty\":{\"1\":\"\"},\"sslvpnqty\":{\"1\":\"\"},\"ipsecqty\":{\"1\":\"\"},\"rep_link_qty\":{\"1\":\"\"},\"ssl_certificate_select\":{\"1\":\"\"},\"ssl_certificate_qty\":{\"1\":\"\"},\"utm_qty\":{\"1\":\"\"},\"vtm_scan_select\":{\"1\":\"\"},\"vtm_scan_qty\":{\"1\":\"\"},\"siem_select\":{\"1\":\"\"},\"vapt_select\":{\"1\":\"\"},\"ddos_qty\":{\"1\":\"\"},\"waf_select\":{\"1\":\"\"},\"waf_qty\":{\"1\":\"\"},\"ifw_select\":{\"1\":\"\"},\"ifw_qty\":{\"1\":\"\"},\"dlp_qty\":{\"1\":\"\"},\"pim_select\":{\"1\":\"\"},\"pim_qty\":{\"1\":\"\"},\"iam_qty\":{\"1\":\"\"},\"dam_select\":{\"1\":\"\"},\"dam_qty\":{\"1\":\"\"},\"mfa_qty\":{\"1\":\"\"},\"efw_select\":{\"1\":\"\"},\"efw_qty\":{\"1\":\"\"},\"osmgmt\":{\"1\":\"on\"},\"dbmgmt\":{\"1\":\"on\"},\"emagic_type\":{\"1\":\"Basic\"},\"emagic\":{\"1\":\"on\"},\"drm_type\":{\"1\":\"\"},\"drillqty\":{\"1\":\"\"},\"rep_link_type\":{\"1\":\"\"},\"proceed\":\"\"}', '{\"1\":{\"VM0\":{\"db\":0,\"os\":1040,\"Application Server\":6900},\"VM1\":{\"os\":21060,\"db\":0,\"DB Server\":4100},\"VM2\":{\"os\":6240,\"db\":12480,\"wdwdw\":5550},\"Network Solution\":{\"ipv4\":2000},\"Security Solution\":{\"av\":1200},\"Managed Services\":{\"st_mg\":0,\"back_mg\":0,\"rep_mgmt\":0,\"dr_drill\":0,\"lb_mgmt\":0,\"fw_mgmt\":0,\"waf_mgmt\":0,\"emagic\":3000,\"win_mgmt\":23650,\"ms_db_mgmt\":21450,\"my_db_mgmt\":6600},\"MonthlyTotal\":115270}}', ''),
(10, 3094, 12783, 'CE INFO SYSTEMS LIMITED', '1', 3094, 3094, '2024-02-21', '2024-02-21 04:15:51', 60, 3095880, 0, '{\"quot_type\":\"1\",\"product_list\":\"1\",\"pot_id\":\"12783\",\"edit_id\":\"10\",\"project_name\":\"CE INFO SYSTEMS LIMITED\",\"old_pot\":\"12783\",\"version\":\" 1 \",\"count_of_est\":\"1\",\"region\":{\"1\":\"1\"},\"EstType\":{\"1\":\"DC\"},\"estmtname\":{\"1\":\"BOM DC\"},\"period\":{\"1\":\"60\"},\"count_of_virtual_machine\":{\"1\":\"1\"},\"vmname\":{\"1\":[\"VM 1\",\"VM 2\"]},\"vmqty\":{\"1\":[\"16\",\"1\"]},\"vcpu\":{\"1\":[\"2\",\"4\"]},\"ram\":{\"1\":[\"4\",\"16\"]},\"vmDiskIOPS\":{\"1\":[\"block_3\",\"block_3\"]},\"inst_disk\":{\"1\":[\"50\",\"50\"]},\"state\":{\"1\":[\"Standalone\",\"Standalone\"]},\"os\":{\"1\":[\"ubuntu\",\"ubuntu\"]},\"database\":{\"1\":[\"\",\"\"]},\"ip_public_type\":{\"1\":[\"ipv4\",\"ipv4\"]},\"ip_public\":{\"1\":[\"0\",\"0\"]},\"virus_type\":{\"1\":[\"\",\"\"]},\"block_03_unit\":{\"1\":\"GB\"},\"block_03_qty\":{\"1\":\"\"},\"block_1_unit\":{\"1\":\"GB\"},\"block_1_qty\":{\"1\":\"350\"},\"block_2_unit\":{\"1\":\"GB\"},\"block_2_qty\":{\"1\":\"\"},\"block_3_unit\":{\"1\":\"GB\"},\"block_3\":{\"1\":\"on\"},\"block_3_qty\":{\"1\":\"350\"},\"block_4_unit\":{\"1\":\"GB\"},\"block_4_qty\":{\"1\":\"\"},\"block_5_unit\":{\"1\":\"GB\"},\"block_5_qty\":{\"1\":\"\"},\"block_6_unit\":{\"1\":\"GB\"},\"block_6_qty\":{\"1\":\"\"},\"block_7_unit\":{\"1\":\"GB\"},\"block_7_qty\":{\"1\":\"\"},\"block_8_unit\":{\"1\":\"GB\"},\"block_8_qty\":{\"1\":\"\"},\"block_9_unit\":{\"1\":\"GB\"},\"block_9_qty\":{\"1\":\"\"},\"block_10_unit\":{\"1\":\"GB\"},\"block_10_qty\":{\"1\":\"\"},\"block_15_unit\":{\"1\":\"GB\"},\"block_15_qty\":{\"1\":\"\"},\"block_20_unit\":{\"1\":\"GB\"},\"block_20_qty\":{\"1\":\"\"},\"block_25_unit\":{\"1\":\"GB\"},\"block_25_qty\":{\"1\":\"\"},\"block_30_unit\":{\"1\":\"GB\"},\"block_30_qty\":{\"1\":\"\"},\"block_40_unit\":{\"1\":\"GB\"},\"block_40_qty\":{\"1\":\"\"},\"block_50_unit\":{\"1\":\"GB\"},\"block_50_qty\":{\"1\":\"\"},\"block_100_unit\":{\"1\":\"GB\"},\"block_100_qty\":{\"1\":\"\"},\"obj_strg_unit\":{\"1\":\"GB\"},\"obj_strg_qty\":{\"1\":\"\"},\"obj_strg_shared_unit\":{\"1\":\"GB\"},\"obj_strg_shared_qty\":{\"1\":\"\"},\"backup_strg\":{\"1\":\"\"},\"age_qty_type\":{\"1\":\"\"},\"ageqty\":{\"1\":\"\"},\"arc_strg\":{\"1\":\"\"},\"archival_unit\":{\"1\":\"TB\"},\"tlqty\":{\"1\":\"\"},\"tcqty\":{\"1\":\"\"},\"fcqty\":{\"1\":\"\"},\"bandwidthType\":{\"1\":\"Speed Based Internet Bandwidth\"},\"bandwidth\":{\"1\":\"\"},\"load_balancer\":{\"1\":\"\"},\"lbqty\":{\"1\":\"\"},\"ccptqty\":{\"1\":\"\"},\"sslvpnqty\":{\"1\":\"\"},\"ipsecqty\":{\"1\":\"\"},\"rep_link_qty\":{\"1\":\"\"},\"ssl_certificate_select\":{\"1\":\"\"},\"ssl_certificate_qty\":{\"1\":\"\"},\"utm_qty\":{\"1\":\"\"},\"vtm_scan_select\":{\"1\":\"\"},\"vtm_scan_qty\":{\"1\":\"\"},\"siem_select\":{\"1\":\"\"},\"vapt_select\":{\"1\":\"\"},\"ddos_qty\":{\"1\":\"\"},\"waf_select\":{\"1\":\"\"},\"waf_qty\":{\"1\":\"\"},\"ifw_select\":{\"1\":\"\"},\"ifw_qty\":{\"1\":\"\"},\"dlp_qty\":{\"1\":\"\"},\"pim_select\":{\"1\":\"\"},\"pim_qty\":{\"1\":\"\"},\"iam_qty\":{\"1\":\"\"},\"dam_select\":{\"1\":\"\"},\"dam_qty\":{\"1\":\"\"},\"mfa_qty\":{\"1\":\"\"},\"efw_select\":{\"1\":\"\"},\"efw_qty\":{\"1\":\"\"},\"storage_mgmt\":{\"1\":\"on\"},\"emagic\":{\"1\":\"on\"},\"os_mgmt\":{\"1\":\"on\"},\"infra_mgmt\":{\"1\":\"on\"},\"drm_type\":{\"1\":\"\"},\"drillqty\":{\"1\":\"\"},\"rep_link_type\":{\"1\":\"\"},\"proceed\":\"\"}', '{\"1\":{\"VM0\":{\"os\":0,\"VM 1\":10432},\"VM1\":{\"os\":0,\"VM 2\":1702},\"Storage Solution\":{\"block_3\":1414},\"Managed Services\":{\"st_mg\":1500,\"back_mg\":0,\"rep_mgmt\":0,\"dr_drill\":0,\"lb_mgmt\":0,\"fw_mgmt\":0,\"waf_mgmt\":0,\"emagic\":8500,\"ubuntu_mgmt\":25500,\"infra_mgmt\":2550},\"MonthlyTotal\":51598}}', ''),
(11, 3094, 12783, 'CE INFO SYSTEMS LIMITED', '2', 3094, 3094, '2024-02-21', '2024-02-21 04:15:51', 60, 3095880, 0, '{\"quot_type\":\"1\",\"product_list\":\"1\",\"pot_id\":\"12783\",\"edit_id\":\"10\",\"project_name\":\"CE INFO SYSTEMS LIMITED\",\"old_pot\":\"12783\",\"version\":\" 1 \",\"count_of_est\":\"1\",\"region\":{\"1\":\"1\"},\"EstType\":{\"1\":\"DC\"},\"estmtname\":{\"1\":\"BOM DC\"},\"period\":{\"1\":\"60\"},\"count_of_virtual_machine\":{\"1\":\"1\"},\"vmname\":{\"1\":[\"VM 1\",\"VM 2\"]},\"vmqty\":{\"1\":[\"16\",\"1\"]},\"vcpu\":{\"1\":[\"2\",\"4\"]},\"ram\":{\"1\":[\"4\",\"16\"]},\"vmDiskIOPS\":{\"1\":[\"block_3\",\"block_3\"]},\"inst_disk\":{\"1\":[\"50\",\"50\"]},\"state\":{\"1\":[\"Standalone\",\"Standalone\"]},\"os\":{\"1\":[\"ubuntu\",\"ubuntu\"]},\"database\":{\"1\":[\"\",\"\"]},\"ip_public_type\":{\"1\":[\"ipv4\",\"ipv4\"]},\"ip_public\":{\"1\":[\"0\",\"0\"]},\"virus_type\":{\"1\":[\"\",\"\"]},\"block_03_unit\":{\"1\":\"GB\"},\"block_03_qty\":{\"1\":\"\"},\"block_1_unit\":{\"1\":\"GB\"},\"block_1_qty\":{\"1\":\"350\"},\"block_2_unit\":{\"1\":\"GB\"},\"block_2_qty\":{\"1\":\"\"},\"block_3_unit\":{\"1\":\"GB\"},\"block_3\":{\"1\":\"on\"},\"block_3_qty\":{\"1\":\"350\"},\"block_4_unit\":{\"1\":\"GB\"},\"block_4_qty\":{\"1\":\"\"},\"block_5_unit\":{\"1\":\"GB\"},\"block_5_qty\":{\"1\":\"\"},\"block_6_unit\":{\"1\":\"GB\"},\"block_6_qty\":{\"1\":\"\"},\"block_7_unit\":{\"1\":\"GB\"},\"block_7_qty\":{\"1\":\"\"},\"block_8_unit\":{\"1\":\"GB\"},\"block_8_qty\":{\"1\":\"\"},\"block_9_unit\":{\"1\":\"GB\"},\"block_9_qty\":{\"1\":\"\"},\"block_10_unit\":{\"1\":\"GB\"},\"block_10_qty\":{\"1\":\"\"},\"block_15_unit\":{\"1\":\"GB\"},\"block_15_qty\":{\"1\":\"\"},\"block_20_unit\":{\"1\":\"GB\"},\"block_20_qty\":{\"1\":\"\"},\"block_25_unit\":{\"1\":\"GB\"},\"block_25_qty\":{\"1\":\"\"},\"block_30_unit\":{\"1\":\"GB\"},\"block_30_qty\":{\"1\":\"\"},\"block_40_unit\":{\"1\":\"GB\"},\"block_40_qty\":{\"1\":\"\"},\"block_50_unit\":{\"1\":\"GB\"},\"block_50_qty\":{\"1\":\"\"},\"block_100_unit\":{\"1\":\"GB\"},\"block_100_qty\":{\"1\":\"\"},\"obj_strg_unit\":{\"1\":\"GB\"},\"obj_strg_qty\":{\"1\":\"\"},\"obj_strg_shared_unit\":{\"1\":\"GB\"},\"obj_strg_shared_qty\":{\"1\":\"\"},\"backup_strg\":{\"1\":\"\"},\"age_qty_type\":{\"1\":\"\"},\"ageqty\":{\"1\":\"\"},\"arc_strg\":{\"1\":\"\"},\"archival_unit\":{\"1\":\"TB\"},\"tlqty\":{\"1\":\"\"},\"tcqty\":{\"1\":\"\"},\"fcqty\":{\"1\":\"\"},\"bandwidthType\":{\"1\":\"Speed Based Internet Bandwidth\"},\"bandwidth\":{\"1\":\"\"},\"load_balancer\":{\"1\":\"\"},\"lbqty\":{\"1\":\"\"},\"ccptqty\":{\"1\":\"\"},\"sslvpnqty\":{\"1\":\"\"},\"ipsecqty\":{\"1\":\"\"},\"rep_link_qty\":{\"1\":\"\"},\"ssl_certificate_select\":{\"1\":\"\"},\"ssl_certificate_qty\":{\"1\":\"\"},\"utm_qty\":{\"1\":\"\"},\"vtm_scan_select\":{\"1\":\"\"},\"vtm_scan_qty\":{\"1\":\"\"},\"siem_select\":{\"1\":\"\"},\"vapt_select\":{\"1\":\"\"},\"ddos_qty\":{\"1\":\"\"},\"waf_select\":{\"1\":\"\"},\"waf_qty\":{\"1\":\"\"},\"ifw_select\":{\"1\":\"\"},\"ifw_qty\":{\"1\":\"\"},\"dlp_qty\":{\"1\":\"\"},\"pim_select\":{\"1\":\"\"},\"pim_qty\":{\"1\":\"\"},\"iam_qty\":{\"1\":\"\"},\"dam_select\":{\"1\":\"\"},\"dam_qty\":{\"1\":\"\"},\"mfa_qty\":{\"1\":\"\"},\"efw_select\":{\"1\":\"\"},\"efw_qty\":{\"1\":\"\"},\"storage_mgmt\":{\"1\":\"on\"},\"emagic\":{\"1\":\"on\"},\"os_mgmt\":{\"1\":\"on\"},\"infra_mgmt\":{\"1\":\"on\"},\"drm_type\":{\"1\":\"\"},\"drillqty\":{\"1\":\"\"},\"rep_link_type\":{\"1\":\"\"},\"proceed\":\"\"}', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sector`
--

CREATE TABLE `tbl_sector` (
  `id` int(11) NOT NULL,
  `sector` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sector`
--

INSERT INTO `tbl_sector` (`id`, `sector`) VALUES
(1, 'Enterprise'),
(2, 'BFSI'),
(3, 'SAP'),
(4, 'Government'),
(5, 'Public');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ui_options`
--

CREATE TABLE `tbl_ui_options` (
  `id` int(11) NOT NULL,
  `sec_category_name` varchar(50) NOT NULL,
  `input_num` enum('True','False') NOT NULL,
  `select_box` enum('True','False') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ui_options`
--

INSERT INTO `tbl_ui_options` (`id`, `sec_category_name`, `input_num`, `select_box`) VALUES
(1, 'archival_storage', 'True', 'False'),
(2, 'object_storage', 'True', 'False'),
(3, 'block_storage', 'True', 'False'),
(4, 'file_storage', 'True', 'False'),
(5, 'backup_soft', 'True', 'False'),
(6, 'offline_backup', 'True', 'False'),
(7, 'ssl_certificate', 'True', 'True'),
(8, 'firewall_mgmt', 'False', 'False'),
(9, 'utm', 'True', 'True'),
(10, 'vtm_scan', 'True', 'True'),
(11, 'storage_mgmt', 'True', 'False'),
(12, 'backup', 'True', 'False'),
(13, 'db_mgmt', 'False', 'False'),
(14, 'dr_mng', 'False', 'False'),
(15, 'vRAM', 'True', 'False'),
(16, 'vCPU', 'True', 'False'),
(17, 'siem', 'False', 'True'),
(18, 'vapt', 'False', 'True'),
(19, 'bandwidth', 'True', 'True'),
(20, 'ddos', 'True', 'True'),
(21, 'link', 'True', 'True'),
(22, 'soar', 'True', 'True'),
(23, 'drm', 'True', 'True'),
(24, 'waf', 'True', 'True'),
(25, 'ifw', 'True', 'True'),
(26, 'efw', 'True', 'True'),
(27, 'net', 'True', 'True'),
(28, 'waf_mgmt', 'True', 'False'),
(29, 'hsm', 'True', 'True'),
(30, 'dlp', 'True', 'True'),
(31, 'vpn', 'True', 'True'),
(32, 'pim', 'True', 'True'),
(33, 'emagic', 'False', 'False'),
(34, 'iam', 'True', 'True'),
(35, 'edr', 'True', 'True'),
(36, 'dam', 'True', 'True'),
(37, 'mfa', 'True', 'True'),
(38, 'db', 'False', 'True'),
(39, 'os', 'False', 'True'),
(40, 'lb_mgmt', 'False', 'False'),
(41, 'av', 'False', 'True'),
(42, 'os_mgmt', 'False', 'False'),
(43, 'lb', 'True', 'True'),
(44, 'ip', 'True', 'True');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit`
--

CREATE TABLE `tbl_unit` (
  `id` int(11) NOT NULL,
  `unit_name` varchar(512) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_unit`
--

INSERT INTO `tbl_unit` (`id`, `unit_name`, `is_active`) VALUES
(1, 'GB', 1),
(2, 'TB', 1),
(3, 'Mbps', 1),
(4, 'Gbps', 1),
(5, 'NO', 1),
(6, 'Yearly', 1),
(7, 'Quarterly', 1),
(8, 'Monthly', 1),
(9, 'Users', 1),
(10, 'Device', 1),
(11, 'Lic', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit_map`
--

CREATE TABLE `tbl_unit_map` (
  `id` int(11) NOT NULL,
  `prod_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `visitor_activity_logs`
--

CREATE TABLE `visitor_activity_logs` (
  `id` int(11) NOT NULL,
  `user_ip_address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `emp_code` int(11) NOT NULL,
  `uname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `visitor_activity_logs`
--

INSERT INTO `visitor_activity_logs` (`id`, `user_ip_address`, `emp_code`, `uname`, `page_url`, `created_on`) VALUES
(859, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?create_newcreate_new', '2024-01-22 12:26:38'),
(860, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=1234&project_name=5&list=1&type=1next&pot_id=1234&project_name=5&list=1&type=1', '2024-01-22 12:26:52'),
(861, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=1234&project_name=5&list=1&type=1next&pot_id=1234&project_name=5&list=1&type=1', '2024-01-22 12:30:57'),
(862, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=1234&project_name=5&list=1&type=1next&pot_id=1234&project_name=5&list=1&type=1', '2024-01-22 12:31:47'),
(863, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=1234&project_name=5&list=1&type=1next&pot_id=1234&project_name=5&list=1&type=1', '2024-01-22 12:32:11'),
(864, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=1234&project_name=5&list=1&type=1next&pot_id=1234&project_name=5&list=1&type=1', '2024-01-22 12:33:05'),
(865, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=1234&project_name=5&list=1&type=1next&pot_id=1234&project_name=5&list=1&type=1', '2024-01-22 12:36:27'),
(866, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=1234&project_name=5&list=1&type=1next&pot_id=1234&project_name=5&list=1&type=1', '2024-01-22 12:43:19'),
(867, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=1234&project_name=5&list=1&type=1next&pot_id=1234&project_name=5&list=1&type=1', '2024-01-22 12:45:02'),
(868, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=1234&project_name=5&list=1&type=1next&pot_id=1234&project_name=5&list=1&type=1', '2024-01-22 14:34:44'),
(869, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=1234&project_name=5&list=1&type=1next&pot_id=1234&project_name=5&list=1&type=1', '2024-01-22 14:38:10'),
(870, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=1234&project_name=5&list=1&type=1next&pot_id=1234&project_name=5&list=1&type=1', '2024-01-22 14:39:19'),
(871, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=1234&project_name=5&list=1&type=1next&pot_id=1234&project_name=5&list=1&type=1', '2024-01-22 14:43:17'),
(872, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=1234&project_name=5&list=1&type=1next&pot_id=1234&project_name=5&list=1&type=1', '2024-01-22 14:44:39'),
(873, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=1234&project_name=5&list=1&type=1next&pot_id=1234&project_name=5&list=1&type=1', '2024-01-22 15:14:35'),
(874, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=1234&project_name=5&list=1&type=1next&pot_id=1234&project_name=5&list=1&type=1', '2024-01-22 15:14:50'),
(875, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=1234&project_name=5&list=1&type=1next&pot_id=1234&project_name=5&list=1&type=1', '2024-01-22 15:15:00'),
(876, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=1234&project_name=5&list=1&type=1next&pot_id=1234&project_name=5&list=1&type=1', '2024-01-22 15:17:33'),
(877, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=1234&project_name=5&list=1&type=1next&pot_id=1234&project_name=5&list=1&type=1', '2024-01-22 15:19:14'),
(878, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=1234&project_name=test&list=1&type=1next&pot_id=1234&project_name=test&list=1&type=1', '2024-01-22 15:20:32'),
(879, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?allall', '2024-01-22 15:22:34'),
(880, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=1edit_id=1', '2024-01-22 15:22:37'),
(881, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1', '2024-01-22 15:22:38'),
(882, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1', '2024-01-22 17:21:31'),
(883, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1', '2024-01-22 18:34:40'),
(884, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-01-23 11:14:04'),
(885, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?allall', '2024-01-23 11:14:08'),
(886, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=1edit_id=1', '2024-01-23 11:14:11'),
(887, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1', '2024-01-23 11:14:14'),
(888, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-01-23 13:46:09'),
(889, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-01-23 13:47:33'),
(890, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-01-23 13:47:34'),
(891, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-01-23 13:47:37'),
(892, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-01-23 13:47:44'),
(893, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-01-23 13:48:02'),
(894, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-01-23 13:48:51'),
(895, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?allall', '2024-01-23 15:17:48'),
(896, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=1edit_id=1', '2024-01-23 15:17:51'),
(897, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1', '2024-01-23 15:17:53'),
(898, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-01-25 10:09:18'),
(899, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?allall', '2024-01-25 10:09:30'),
(900, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=1edit_id=1', '2024-01-25 10:09:33'),
(901, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1', '2024-01-25 10:09:34'),
(902, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1', '2024-01-25 10:16:34'),
(903, '127.0.0.1', 9999, 'Admin', 'http://localhost/configurator/v3/estimate/index.php', '2024-01-25 10:21:37'),
(904, '127.0.0.1', 9999, 'Admin', 'http://localhost/configurator/v3/estimate/index.php?edit_id=1edit_id=1', '2024-01-25 10:21:43'),
(905, '127.0.0.1', 9999, 'Admin', 'http://localhost/configurator/v3/estimate/index.php?edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1', '2024-01-25 10:21:45'),
(906, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?rateCardrateCard', '2024-01-25 10:22:23'),
(907, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?rateCardrateCard', '2024-01-25 12:06:44'),
(908, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?rateCardrateCard', '2024-01-25 12:07:09'),
(909, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-01-25 12:08:14'),
(910, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?usersusers', '2024-01-25 12:08:17'),
(911, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-01-25 14:11:10'),
(912, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 14:11:16'),
(913, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 14:12:59'),
(914, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 14:13:06'),
(915, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 15:10:54'),
(916, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 15:13:54'),
(917, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 15:15:19'),
(918, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 15:17:40'),
(919, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 15:18:35'),
(920, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 15:21:03'),
(921, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 15:30:09'),
(922, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 15:31:20'),
(923, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 15:35:11'),
(924, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 15:37:18'),
(925, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 15:37:45'),
(926, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 15:40:28'),
(927, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 15:40:46'),
(928, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 15:41:05'),
(929, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?create_newcreate_new', '2024-01-25 15:45:42'),
(930, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-01-25 15:46:22'),
(931, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?rateCardrateCard', '2024-01-25 15:46:28'),
(932, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?rateCardId=1rateCardId=1', '2024-01-25 15:46:35'),
(933, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?rateCardrateCard', '2024-01-25 15:46:40'),
(934, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?allall', '2024-01-25 15:46:46'),
(935, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?rateCardrateCard', '2024-01-25 15:46:49'),
(936, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?rateCardId=14rateCardId=14', '2024-01-25 15:46:54'),
(937, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 15:47:11'),
(938, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?create_newcreate_new', '2024-01-25 15:47:57'),
(939, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=32424&project_name=423424&list=1&type=1next&pot_id=32424&project_name=423424&list=1&type=1', '2024-01-25 15:48:21'),
(940, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?rateCardrateCard', '2024-01-25 15:48:41'),
(941, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?create_newcreate_new', '2024-01-25 15:49:17'),
(942, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?create_newcreate_new', '2024-01-25 16:04:19'),
(943, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 16:04:23'),
(944, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 16:05:35'),
(945, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?usersusers', '2024-01-25 17:30:15'),
(946, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 17:30:18'),
(947, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 17:31:01'),
(948, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 17:31:22'),
(949, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 17:32:57'),
(950, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 17:35:18'),
(951, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 17:37:06'),
(952, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 17:37:21'),
(953, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 17:38:02'),
(954, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 17:38:39'),
(955, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 17:39:49'),
(956, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 17:40:46'),
(957, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 17:43:08'),
(958, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 17:43:23'),
(959, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 17:43:48'),
(960, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 17:44:59'),
(961, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 17:45:25'),
(962, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 17:46:15'),
(963, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 17:46:51'),
(964, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 17:46:58'),
(965, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 17:58:28'),
(966, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 18:00:02'),
(967, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 18:00:16'),
(968, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 18:00:28'),
(969, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 18:02:15'),
(970, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 18:02:22'),
(971, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 18:02:29'),
(972, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 18:02:36'),
(973, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 18:03:25'),
(974, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 18:03:40'),
(975, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 18:03:56'),
(976, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?testtest', '2024-01-25 18:04:16'),
(977, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-01-29 11:29:05'),
(978, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?allall', '2024-01-29 11:29:36'),
(979, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=1edit_id=1', '2024-01-29 11:29:55'),
(980, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1', '2024-01-29 11:29:59'),
(981, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1', '2024-01-29 11:44:50'),
(982, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-01-31 11:07:40'),
(983, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?allall', '2024-01-31 11:07:58'),
(984, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?allall', '2024-01-31 17:35:29'),
(985, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php', '2024-02-05 10:53:25'),
(986, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?allall', '2024-02-05 10:53:31'),
(987, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=1edit_id=1', '2024-02-05 10:53:34'),
(988, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1', '2024-02-05 10:53:36'),
(989, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-02-05 18:00:15'),
(990, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-02-06 12:14:38'),
(991, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?allall', '2024-02-06 12:14:41'),
(992, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=1edit_id=1', '2024-02-06 12:14:44'),
(993, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1', '2024-02-06 12:14:46'),
(994, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?allall', '2024-02-06 12:14:50'),
(995, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-02-06 12:14:51'),
(996, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?create_newcreate_new', '2024-02-06 12:14:53'),
(997, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=1234&project_name=Test&list=1&type=1next&pot_id=1234&project_name=Test&list=1&type=1', '2024-02-06 12:15:09'),
(998, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?allall', '2024-02-06 12:17:38'),
(999, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?create_newcreate_new', '2024-02-06 12:17:40'),
(1000, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?create_newcreate_new', '2024-02-06 12:24:04'),
(1001, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=1356&project_name=Test&list=1&type=1next&pot_id=1356&project_name=Test&list=1&type=1', '2024-02-06 12:24:11'),
(1002, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?allall', '2024-02-06 12:27:23'),
(1003, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=2edit_id=2', '2024-02-06 12:27:27'),
(1004, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=2&next&pot_id=1356&project_name=Test&list=1&type=1edit_id=2&next&pot_id=1356&project_name=Test&list=1&type=1', '2024-02-06 12:27:28'),
(1005, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=2&next&pot_id=1356&project_name=Test&list=1&type=1edit_id=2&next&pot_id=1356&project_name=Test&list=1&type=1', '2024-02-06 12:31:26'),
(1006, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php', '2024-02-07 10:49:17'),
(1007, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?allall', '2024-02-07 10:50:29'),
(1008, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=2edit_id=2', '2024-02-07 10:50:35'),
(1009, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=2&next&pot_id=1356&project_name=Test&list=1&type=1edit_id=2&next&pot_id=1356&project_name=Test&list=1&type=1', '2024-02-07 10:50:38'),
(1010, '127.0.0.1', 9999, 'Admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php', '2024-02-07 11:10:53'),
(1011, '127.0.0.1', 9999, 'Admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=2edit_id=2', '2024-02-07 11:10:58'),
(1012, '127.0.0.1', 9999, 'Admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=2&next&pot_id=1356&project_name=Test&list=1&type=1edit_id=2&next&pot_id=1356&project_name=Test&list=1&type=1', '2024-02-07 11:11:00'),
(1013, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=2&next&pot_id=8615&project_name=Test&list=1&type=1edit_id=2&next&pot_id=8615&project_name=Test&list=1&type=1', '2024-02-07 11:16:01'),
(1014, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=2&next&pot_id=8615&project_name=Test&list=1&type=1edit_id=2&next&pot_id=8615&project_name=Test&list=1&type=1', '2024-02-07 11:16:26'),
(1015, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?allall', '2024-02-07 11:16:33'),
(1016, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=2edit_id=2', '2024-02-07 11:16:37'),
(1017, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=2&next&pot_id=8615&project_name=Test&list=1&type=1edit_id=2&next&pot_id=8615&project_name=Test&list=1&type=1', '2024-02-07 11:16:39'),
(1018, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-02-12 11:45:03'),
(1019, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?allall', '2024-02-12 11:45:07'),
(1020, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=2edit_id=2', '2024-02-12 11:45:11'),
(1021, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=2&next&pot_id=8615&project_name=Test&list=1&type=1edit_id=2&next&pot_id=8615&project_name=Test&list=1&type=1', '2024-02-12 11:45:13'),
(1022, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-02-12 12:03:50'),
(1023, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?allall', '2024-02-12 12:28:02'),
(1024, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=1edit_id=1', '2024-02-12 12:28:05'),
(1025, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1', '2024-02-12 12:28:07'),
(1026, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-02-13 15:16:52'),
(1027, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php', '2024-02-19 11:10:49'),
(1028, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?allall', '2024-02-19 11:11:05'),
(1029, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=1edit_id=1', '2024-02-19 11:11:09'),
(1030, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1', '2024-02-19 11:11:13'),
(1031, '::1', 9999, 'admin', 'http://localhost/configurator/v3/estimate/index.php', '2024-02-20 11:30:34'),
(1032, '::1', 9999, 'admin', 'http://localhost/configurator/v3/estimate/index.php?usersusers', '2024-02-20 11:30:35'),
(1033, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php', '2024-02-20 11:39:29'),
(1034, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?usersusers', '2024-02-20 11:39:32'),
(1035, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?all=3094all=3094', '2024-02-20 11:40:19'),
(1036, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=1edit_id=1', '2024-02-20 11:40:22'),
(1037, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1', '2024-02-20 11:40:24'),
(1038, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?usersusers', '2024-02-20 12:05:44'),
(1039, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?usersusers', '2024-02-20 12:05:50'),
(1040, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php', '2024-02-20 12:05:54'),
(1041, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?usersusers', '2024-02-20 12:05:56'),
(1042, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?usersusers', '2024-02-20 12:09:31'),
(1043, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?allall', '2024-02-20 12:09:33'),
(1044, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?create_newcreate_new', '2024-02-20 12:09:34'),
(1045, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?allall', '2024-02-20 12:09:36'),
(1046, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?usersusers', '2024-02-20 12:09:39'),
(1047, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?create_newcreate_new', '2024-02-20 12:09:44'),
(1048, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?next&pot_id=2232&project_name=32323&list=1&type=1next&pot_id=2232&project_name=32323&list=1&type=1', '2024-02-20 12:09:52'),
(1049, '::1', 9999, 'admin', 'http://localhost/configurator/v3/estimate/index.php', '2024-02-20 12:14:07'),
(1050, '::1', 9999, 'admin', 'http://localhost/configurator/v3/estimate/index.php?create_newcreate_new', '2024-02-20 12:14:09'),
(1051, '::1', 9999, 'admin', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=2232&project_name=32323&list=1&type=1next&pot_id=2232&project_name=32323&list=1&type=1', '2024-02-20 12:14:16'),
(1052, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?allall', '2024-02-20 13:56:52'),
(1053, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=3edit_id=3', '2024-02-20 13:56:56'),
(1054, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=3&next&pot_id=2232&project_name=32323&list=1&type=1edit_id=3&next&pot_id=2232&project_name=32323&list=1&type=1', '2024-02-20 13:57:02'),
(1055, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?create_newcreate_new', '2024-02-20 13:58:51'),
(1056, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?allall', '2024-02-20 13:58:54'),
(1057, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?create_newcreate_new', '2024-02-20 13:58:55'),
(1058, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?next&pot_id=55555&project_name=dsfv&list=1&type=1next&pot_id=55555&project_name=dsfv&list=1&type=1', '2024-02-20 13:59:00'),
(1059, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?next&pot_id=2232&project_name=32323&list=1&type=1next&pot_id=2232&project_name=32323&list=1&type=1', '2024-02-20 14:01:15'),
(1060, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php', '2024-02-20 14:01:19'),
(1061, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?allall', '2024-02-20 14:01:22'),
(1062, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?create_newcreate_new', '2024-02-20 14:01:24'),
(1063, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?next&pot_id=23433&project_name=qwerf&list=1&type=1next&pot_id=23433&project_name=qwerf&list=1&type=1', '2024-02-20 14:01:32'),
(1064, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?allall', '2024-02-20 14:03:54'),
(1065, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?create_newcreate_new', '2024-02-20 14:04:07'),
(1066, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?next&pot_id=1244&project_name=ABC&list=1&type=1next&pot_id=1244&project_name=ABC&list=1&type=1', '2024-02-20 14:04:12'),
(1067, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?create_newcreate_new', '2024-02-20 14:05:30'),
(1068, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php', '2024-02-20 14:05:48'),
(1069, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?create_newcreate_new', '2024-02-20 14:05:50'),
(1070, '::1', 9999, 'admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?next&pot_id=1234&project_name=ABC&list=1&type=1next&pot_id=1234&project_name=ABC&list=1&type=1', '2024-02-20 14:05:56'),
(1071, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php', '2024-02-20 14:15:39'),
(1072, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?create_newcreate_new', '2024-02-20 14:15:41'),
(1073, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?create_newcreate_new', '2024-02-20 14:18:52'),
(1074, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?create_newcreate_new', '2024-02-20 14:20:58'),
(1075, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?allall', '2024-02-20 14:21:00'),
(1076, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?clone_id=1clone_id=1', '2024-02-20 14:21:03'),
(1077, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?allall', '2024-02-20 14:21:05'),
(1078, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=1edit_id=1', '2024-02-20 14:21:07'),
(1079, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1', '2024-02-20 14:21:09'),
(1080, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?create_new=newcreate_new=new', '2024-02-20 14:21:11'),
(1081, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?create_new=newcreate_new=new', '2024-02-20 14:21:36'),
(1082, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?allall', '2024-02-20 14:21:39'),
(1083, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?create_new=newcreate_new=new', '2024-02-20 14:21:40'),
(1084, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?allall', '2024-02-20 14:21:42'),
(1085, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=1edit_id=1', '2024-02-20 14:21:44'),
(1086, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1edit_id=1&next&pot_id=1234&project_name=test&list=1&type=1', '2024-02-20 14:21:45'),
(1087, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?create_new=newcreate_new=new', '2024-02-20 14:21:48'),
(1088, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?create_new=newcreate_new=new', '2024-02-20 15:16:01'),
(1089, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?next&pot_id=1234&project_name=ABC&list=1&type=1next&pot_id=1234&project_name=ABC&list=1&type=1', '2024-02-20 15:16:07'),
(1090, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?rateCardrateCard', '2024-02-20 15:17:36'),
(1091, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?usersusers', '2024-02-20 15:17:38'),
(1092, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?usersusers', '2024-02-20 15:17:57'),
(1093, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php', '2024-02-20 15:18:17'),
(1094, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?usersusers', '2024-02-20 15:18:18'),
(1095, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?create_new=newcreate_new=new', '2024-02-20 15:26:42'),
(1096, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?usersusers', '2024-02-20 15:26:51'),
(1097, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php', '2024-02-20 15:26:54'),
(1098, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?allall', '2024-02-20 15:26:55'),
(1099, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=2edit_id=2', '2024-02-20 15:26:58'),
(1100, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=2&next&pot_id=8615&project_name=Test&list=1&type=1edit_id=2&next&pot_id=8615&project_name=Test&list=1&type=1', '2024-02-20 15:27:00'),
(1101, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?next&pot_id=1234&project_name=ABC&list=1&type=1next&pot_id=1234&project_name=ABC&list=1&type=1', '2024-02-20 15:37:58'),
(1102, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?allall', '2024-02-20 15:42:46'),
(1103, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?create_new=newcreate_new=new', '2024-02-20 15:42:49'),
(1104, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?next&pot_id=1111&project_name=122&list=1&type=1next&pot_id=1111&project_name=122&list=1&type=1', '2024-02-20 15:42:57'),
(1105, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php', '2024-02-20 15:57:37'),
(1106, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?usersusers', '2024-02-20 15:57:39'),
(1107, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-02-20 16:47:28'),
(1108, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php', '2024-02-20 16:47:32'),
(1109, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?create_newcreate_new', '2024-02-20 16:47:37'),
(1110, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=12222&project_name=dsfv&list=1&type=1next&pot_id=12222&project_name=dsfv&list=1&type=1', '2024-02-20 16:47:43'),
(1111, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php', '2024-02-21 14:02:23'),
(1112, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?create_newcreate_new', '2024-02-21 14:02:27'),
(1113, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1', '2024-02-21 14:02:46'),
(1114, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?allall', '2024-02-21 14:15:55'),
(1115, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?rateCardrateCard', '2024-02-21 14:15:58'),
(1116, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?rateCardId=1rateCardId=1', '2024-02-21 14:19:24'),
(1117, '127.0.0.1', 9999, 'Admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php', '2024-02-21 14:19:50'),
(1118, '127.0.0.1', 9999, 'Admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?rateCardrateCard', '2024-02-21 14:19:54'),
(1119, '127.0.0.1', 9999, 'Admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?rateCardId=1rateCardId=1', '2024-02-21 14:19:58'),
(1120, '127.0.0.1', 9999, 'Admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?rateCardId=1rateCardId=1', '2024-02-21 14:20:10'),
(1121, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?allall', '2024-02-21 14:21:44'),
(1122, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=10edit_id=10', '2024-02-21 14:21:47'),
(1123, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1', '2024-02-21 14:21:49'),
(1124, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1', '2024-02-21 14:26:21'),
(1125, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1', '2024-02-21 14:31:04'),
(1126, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1', '2024-02-21 14:32:00'),
(1127, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1', '2024-02-21 14:32:20'),
(1128, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1', '2024-02-21 14:33:20'),
(1129, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1', '2024-02-21 14:33:39'),
(1130, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1', '2024-02-21 14:34:11'),
(1131, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1', '2024-02-21 14:35:01'),
(1132, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1', '2024-02-21 14:40:49'),
(1133, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1', '2024-02-21 14:41:41'),
(1134, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1', '2024-02-21 14:45:51'),
(1135, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php', '2024-02-21 15:49:01'),
(1136, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?allall', '2024-02-21 15:49:03'),
(1137, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=10edit_id=10', '2024-02-21 15:49:06'),
(1138, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1', '2024-02-21 15:49:08'),
(1139, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1', '2024-02-21 16:24:58'),
(1140, '127.0.0.1', 9999, 'Admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php', '2024-02-22 10:38:47'),
(1141, '127.0.0.1', 9999, 'Admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=10edit_id=10', '2024-02-22 10:38:54'),
(1142, '127.0.0.1', 9999, 'Admin', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1', '2024-02-22 10:38:57'),
(1143, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?allall', '2024-02-22 10:39:51'),
(1144, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?clone_id=10clone_id=10', '2024-02-22 10:40:19'),
(1145, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?allall', '2024-02-22 10:40:21'),
(1146, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=11edit_id=11', '2024-02-22 10:40:25'),
(1147, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/swayatta.configurator/v2/estimate/index.php?edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1edit_id=10&next&pot_id=12783&project_name=CE%20INFO%20SYSTEMS%20LIMITED&list=1&type=1', '2024-02-22 10:57:26'),
(1148, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php', '2024-02-22 12:59:21'),
(1149, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php', '2024-02-22 12:59:27'),
(1150, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php', '2024-02-27 11:44:10'),
(1151, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?create_newcreate_new', '2024-02-27 11:44:13'),
(1152, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 11:44:21'),
(1153, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 11:47:40'),
(1154, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 11:48:54'),
(1155, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 12:27:17'),
(1156, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-02-27 12:33:45'),
(1157, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?create_newcreate_new', '2024-02-27 12:33:48'),
(1158, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=13131&project_name=dsfv&list=1&type=1next&pot_id=13131&project_name=dsfv&list=1&type=1', '2024-02-27 12:33:52'),
(1159, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 13:44:39'),
(1160, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 14:14:18'),
(1161, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 14:22:16'),
(1162, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=13131&project_name=dsfv&list=1&type=1next&pot_id=13131&project_name=dsfv&list=1&type=1', '2024-02-27 14:48:06'),
(1163, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 14:48:10'),
(1164, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 15:20:41'),
(1165, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 15:22:44'),
(1166, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 15:25:24'),
(1167, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 15:30:46');
INSERT INTO `visitor_activity_logs` (`id`, `user_ip_address`, `emp_code`, `uname`, `page_url`, `created_on`) VALUES
(1168, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 15:32:02'),
(1169, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 15:35:06'),
(1170, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 15:45:08'),
(1171, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 15:46:11'),
(1172, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 15:46:46'),
(1173, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 15:47:30'),
(1174, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 16:04:52'),
(1175, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 16:05:32'),
(1176, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 16:08:49'),
(1177, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 16:10:07'),
(1178, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php', '2024-02-27 17:32:34'),
(1179, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 17:51:48'),
(1180, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 18:13:30'),
(1181, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 18:13:48'),
(1182, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 18:13:50'),
(1183, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 18:13:56'),
(1184, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 18:31:01'),
(1185, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/configurator/v3/estimate/index.php?next&pot_id=13131&project_name=dsfv&list=1&type=1next&pot_id=13131&project_name=dsfv&list=1&type=1', '2024-02-27 18:31:05'),
(1186, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/', '2024-02-27 18:31:12'),
(1187, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/', '2024-02-27 18:31:14'),
(1188, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php', '2024-02-27 18:31:17'),
(1189, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/', '2024-02-27 18:31:25'),
(1190, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=21121&project_name=ABC&list=1&type=1next&pot_id=21121&project_name=ABC&list=1&type=1', '2024-02-27 18:31:25'),
(1191, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?create_newcreate_new', '2024-02-27 18:31:26'),
(1192, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php', '2024-02-27 18:31:41'),
(1193, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php', '2024-02-27 18:31:58'),
(1194, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php', '2024-02-27 18:32:35'),
(1195, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?create_newcreate_new', '2024-02-27 18:32:39'),
(1196, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=4123&project_name=dwedwedf&list=1&type=1next&pot_id=4123&project_name=dwedwedf&list=1&type=1', '2024-02-27 18:32:45'),
(1197, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=4123&project_name=dwedwedf&list=1&type=1next&pot_id=4123&project_name=dwedwedf&list=1&type=1', '2024-02-27 18:34:13'),
(1198, '::1', 3094, 'Prathamesh.chavan', 'http://localhost/calculator/estimate/index.php?next&pot_id=4123&project_name=dwedwedf&list=1&type=1next&pot_id=4123&project_name=dwedwedf&list=1&type=1', '2024-02-27 18:34:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_master`
--
ALTER TABLE `login_master`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_code` (`employee_code`),
  ADD KEY `user_role` (`user_role`);

--
-- Indexes for table `permission_master`
--
ALTER TABLE `permission_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `fkc_region_id` (`region`),
  ADD KEY `prod_int` (`prod_int`),
  ADD KEY `sec_category` (`sec_category`);

--
-- Indexes for table `rate_card_prices`
--
ALTER TABLE `rate_card_prices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `rate_card_fkc` (`rate_card_id`),
  ADD KEY `product_fkc` (`prod_id`);

--
-- Indexes for table `role_master`
--
ALTER TABLE `role_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `permission_id` (`permission_id`(768));

--
-- Indexes for table `tbl_calculation`
--
ALTER TABLE `tbl_calculation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkc_sec_category_cal` (`sec_cat_name`);

--
-- Indexes for table `tbl_discount_data`
--
ALTER TABLE `tbl_discount_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reg_fkc` (`quot_id`);

--
-- Indexes for table `tbl_os_calculation`
--
ALTER TABLE `tbl_os_calculation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkc_prod_cal` (`product_int`);

--
-- Indexes for table `tbl_pack`
--
ALTER TABLE `tbl_pack`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tbl_quot_type`
--
ALTER TABLE `tbl_quot_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rate_cards`
--
ALTER TABLE `tbl_rate_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_region`
--
ALTER TABLE `tbl_region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_saved_estimates`
--
ALTER TABLE `tbl_saved_estimates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_code` (`emp_code`);

--
-- Indexes for table `tbl_sector`
--
ALTER TABLE `tbl_sector`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ui_options`
--
ALTER TABLE `tbl_ui_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkc_sec_category_ui` (`sec_category_name`);

--
-- Indexes for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_unit_map`
--
ALTER TABLE `tbl_unit_map`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkc_unit` (`unit_id`);

--
-- Indexes for table `visitor_activity_logs`
--
ALTER TABLE `visitor_activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_master`
--
ALTER TABLE `login_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `permission_master`
--
ALTER TABLE `permission_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `rate_card_prices`
--
ALTER TABLE `rate_card_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `role_master`
--
ALTER TABLE `role_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_calculation`
--
ALTER TABLE `tbl_calculation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_discount_data`
--
ALTER TABLE `tbl_discount_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_os_calculation`
--
ALTER TABLE `tbl_os_calculation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_pack`
--
ALTER TABLE `tbl_pack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=230;

--
-- AUTO_INCREMENT for table `tbl_quot_type`
--
ALTER TABLE `tbl_quot_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_rate_cards`
--
ALTER TABLE `tbl_rate_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_region`
--
ALTER TABLE `tbl_region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_saved_estimates`
--
ALTER TABLE `tbl_saved_estimates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_sector`
--
ALTER TABLE `tbl_sector`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_ui_options`
--
ALTER TABLE `tbl_ui_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_unit_map`
--
ALTER TABLE `tbl_unit_map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `visitor_activity_logs`
--
ALTER TABLE `visitor_activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1199;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_master`
--
ALTER TABLE `login_master`
  ADD CONSTRAINT `login_master_ibfk_1` FOREIGN KEY (`user_role`) REFERENCES `role_master` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_list`
--
ALTER TABLE `product_list`
  ADD CONSTRAINT `fkc_region_id` FOREIGN KEY (`region`) REFERENCES `tbl_region` (`id`);

--
-- Constraints for table `rate_card_prices`
--
ALTER TABLE `rate_card_prices`
  ADD CONSTRAINT `product_fkc` FOREIGN KEY (`prod_id`) REFERENCES `product_list` (`id`);

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role_master` (`id`);

--
-- Constraints for table `tbl_discount_data`
--
ALTER TABLE `tbl_discount_data`
  ADD CONSTRAINT `reg_fkc` FOREIGN KEY (`quot_id`) REFERENCES `tbl_saved_estimates` (`id`);

--
-- Constraints for table `tbl_unit_map`
--
ALTER TABLE `tbl_unit_map`
  ADD CONSTRAINT `fkc_prod_unit` FOREIGN KEY (`id`) REFERENCES `product_list` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkc_unit` FOREIGN KEY (`unit_id`) REFERENCES `tbl_unit` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
