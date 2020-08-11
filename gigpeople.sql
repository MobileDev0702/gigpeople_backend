-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 31, 2020 at 09:32 PM
-- Server version: 5.6.47-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gigpeople`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(30) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `image` varchar(60) NOT NULL,
  `terms` text NOT NULL,
  `privacy` text NOT NULL,
  `commission_per` text NOT NULL,
  `support_email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `email`, `password`, `image`, `terms`, `privacy`, `commission_per`, `support_email`) VALUES
(1, 'admin', 'gigpeople@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin.png', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</strong></p><p><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</em></p>', '<p>A Privacy Policy is a legal statement that specifies what the business owner does with the personal data collected from users, along with how the data is processed and for what purposes.</p><p>This marks the start of what we know now as a &ldquo;Privacy Policy.&rdquo; While the name &ldquo;Privacy Policy&rdquo; refers to the legal agreement, the concept of privacy and protecting user data is closely related.</p><p>This agreement can also be known under these names:</p><ul><li>Privacy Statement</li><li>Privacy Notice</li><li>Privacy Information</li><li>Privacy Page</li></ul>', '2.5', 'noreply.backend.development@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `app_user`
--

CREATE TABLE `app_user` (
  `id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL COMMENT '1.Buyer, 2.Seller, 3.Buyer & Seller',
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `email` text NOT NULL,
  `email_otp` text NOT NULL,
  `is_email_verified` tinyint(4) NOT NULL COMMENT '0-no/1-yes',
  `mobile_country` text NOT NULL,
  `phone_no` text NOT NULL,
  `mobile_otp` text NOT NULL,
  `is_mobile_verified` int(11) NOT NULL COMMENT '0-no/1-yes',
  `password` text NOT NULL,
  `address` text CHARACTER SET utf8 NOT NULL COMMENT 'correct address',
  `country` text NOT NULL,
  `profile_picture` text NOT NULL,
  `language` text NOT NULL,
  `skills` text NOT NULL,
  `about` text NOT NULL,
  `lattitude` text NOT NULL COMMENT 'common address collected frm signup',
  `longitude` text NOT NULL,
  `wallet` double(10,2) NOT NULL,
  `wallet_status` int(11) NOT NULL COMMENT '0-not withdraw,1-withdraw',
  `account_status` int(11) NOT NULL COMMENT '0-Active, 1-Inactive, 2.Deleted',
  `live_status` int(11) NOT NULL COMMENT '0-Offline, 1-Online',
  `ratings` double(10,2) NOT NULL,
  `notification` int(11) NOT NULL COMMENT '1-on/0-off',
  `customer_order` int(11) NOT NULL COMMENT '1-On/0-Off',
  `device_type` text NOT NULL,
  `device_token` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_user`
--

INSERT INTO `app_user` (`id`, `user_type`, `first_name`, `last_name`, `email`, `email_otp`, `is_email_verified`, `mobile_country`, `phone_no`, `mobile_otp`, `is_mobile_verified`, `password`, `address`, `country`, `profile_picture`, `language`, `skills`, `about`, `lattitude`, `longitude`, `wallet`, `wallet_status`, `account_status`, `live_status`, `ratings`, `notification`, `customer_order`, `device_type`, `device_token`, `created_at`, `updated_at`) VALUES
(1, 3, 'SOWNTHARRAJ', 'KUMAR', 'rjsownthar@gmail.com', '5837', 1, '44', '1234567890', '9077', 1, '4297f44b13955235245b2497399d7a93', 'Sydney NSW, Australia', '', '', 'English ', 'Graphics & Design', 'aa', '-33.8688197', '151.2092955', 0.00, 0, 0, 1, 0.00, 1, 1, 'Android', 'eNxgAxv54lM:APA91bFFz92HnDRi0tU4R1DK_Cmqj_MISF3lK-0ZTKbmYbRXib1ya7uYTtjF2lFCP5Z9b4d_lrPiNBodeKd-Ezm6Z6ZHpPE98H6hxOrbMjw5TnN1mtItukFmdKdSPsLrDehlWVOb3HI1', '2020-02-21 05:21:25', '2020-02-21 17:51:25'),
(3, 3, 'Rohit', 'Kulkarni', 'hua2@mailinator.com', '', 0, '44', '1', '', 0, '93f57323e0205dffea729add44cb702b', 'Pune, Maharashtra, India', 'India', '1582137000.jpg', 'English ', 'Website Builders & CMS', 'testre', '18.5204303', '73.8567437', 0.00, 0, 0, 1, 0.00, 1, 1, 'Android', 'fv3oIbhbdak:APA91bHozzBycnERYloJqa-JHaoEN4ZsKdGdYWTJVi7JxEv63D0ojl2NUDpP8l53zMoBsfN9vHclvwrF8Ihghh967KbEZK6RDctXT1gTl-1DzGYZp9W599_AERhfT2bIHrA1cNIEMkFr', '2020-02-20 18:10:32', '2020-02-21 06:40:32'),
(5, 3, 'Yahoo', 'Dev', 'yahoo.devv@gmail.com', '', 0, '93', '85214736', '', 0, 'e10adc3949ba59abbe56e057f20f883e', 'Chinatown, New York, NY, USA', 'United States', '', 'English,Chinese', 'All Development', 'This is my new design', '40.71575089999999', '-73.9970307', 0.00, 0, 0, 0, 0.00, 1, 1, '', '', '2020-05-16 07:15:23', '2020-05-16 19:45:23'),
(6, 3, 'Seller', 'Sell', 'seller@gmail.com', '', 0, '91', '9677382536', '', 0, '76d80224611fc919a5d54f0ff9fba446', 'Airport Rd, Civil Aerodrome Post, Peelamedu, Tamil Nadu 641014, India', '', '', 'English,Tamil', 'Desktop applications ', 'your time and consideration and look forward to hearing from you soon and I will be in PDF format', '11.0304324', '77.03909279999999', 0.00, 0, 0, 1, 0.00, 1, 1, 'Android', 'cugtOFQWdu4:APA91bFh5si7tbva-XLbWqrT7kMTqwyuHtP3Js87Xd3KuktSIaTNIhfLlM9EmWGEFz6yIB-AWKbkWolO1NQ72YJebd7ROIDEOzB_cex4FP99266s1WbVriysNQH2TubhUDuB03zidui1', '2020-02-22 12:02:19', '2020-02-23 00:32:19'),
(11, 3, 'Seller', 'Seller', 'sellers@gmail.com', '', 0, '44', '996632888', '', 0, 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Chicago, IL, USA', 'United States', '1582569000.jpg', 'English,Spanish', 'Gaming', 'you will come 7', '41.8781136', '-87.6297982', 0.00, 0, 0, 0, 0.00, 1, 0, '', '', '2020-02-25 12:07:46', '2020-02-26 00:37:46'),
(12, 3, 'Nan', 'Seller', 'nan.seller@gmail.com', '', 0, '44', '99663588989', '', 0, 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Ubud, Gianyar, Bali, Indonesia', 'Indonesia', '', 'English,Spanish', 'Gaming', 'thanks and best of that I', '-8.506853599999998', '115.2624778', 0.00, 0, 0, 1, 0.00, 1, 1, 'Android', 'fsSUgsMVV5I:APA91bHe8TqUivNWf_1nBkbq06sUFVV-4T61AG-eX3tDE0OB8YukPmcoATrluPLPwkX3tv0qknDl3iBJijdm3WU1QemYeTRinBn-NO4SRyoBH_HnM829VYdDntWL9PhVxXpemGAdEMYx', '2020-02-25 12:24:02', '2020-02-26 00:54:02'),
(16, 3, 'Rohit', 'Kulkarni', 'hua11@mailinator.com', '', 0, '44', '123', '', 0, '93f57323e0205dffea729add44cb702b', 'Pune, Maharashtra, India', 'India', '1587061800.jpg', 'English ,A', 'User Testing', 'aaaaa', '18.5204303', '73.8567437', 0.00, 0, 0, 1, 0.00, 1, 1, 'Android', 'dJpf7GTXZRA:APA91bHlACKZ9FhgFrPVnvrxc-0gnKVGfGdAFux60OTcMQFwtkOEpXt4tvpXF74sIGIVWkuVqXokASar1SI-QUMVchCxM00ViKyv6RScKgqX81LAQhIJswoupDVIQxIrg8j8Yafl72vy', '2020-04-17 08:32:38', '2020-04-17 21:02:38'),
(17, 3, 'Ashwini', 'Kulkarni', 'hua12@mailinator.com', '', 0, '', '', '', 0, '93f57323e0205dffea729add44cb702b', '', '', '', '', '', '', '', '', 0.00, 0, 0, 1, 0.00, 1, 1, 'Android', 'cgc7mppoWF4:APA91bFD4stty8rqHiJ_-x5b0c5aKkUcpRwfDGfnZ-KiYt6xyz0JzhiRZKotfmdJgYKa08LVsBi4uVcs9gFuP6LeXWrp6AgSw9x3MrumFChLUDLThBTX8I5Kcyu-HmF4HJItbSBelc9_', '2020-04-17 10:59:15', '2020-04-17 23:29:15'),
(18, 3, 'Uniflyn', 'Development seller', 'uniflyn.development1@gmail.com', '7665', 1, '44', '8877995566', '', 0, '053ac59788b11139d33f272bb82d3016', 'Coimbatore, Tamil Nadu, India', 'India', '1587407400.jpg', 'English ,French ', 'Databases', 'T the first one to one of the most important thing is that the first one to ', '11.0168445', '76.9558321', 0.00, 0, 0, 0, 0.00, 1, 1, '', '', '2020-05-13 13:27:47', '2020-05-14 01:57:47'),
(19, 3, 'uniflyn', 'Development buyer', 'uniflyndevelopment2@gmail.com', '', 0, '44', '8855441122', '7588', 1, '6160998cc317b11afa666d2a1a498814', 'Airport Rd, Peelamedu, Civil Aerodrome Post, Coimbatore, Tamil Nadu 641014, India', 'India', '15874074001.jpg', 'English ,French ', 'Business', 'The most popular properties and a bit more time and effort and ', '11.0304324', '77.03909279999999', 0.00, 0, 0, 0, 0.00, 1, 0, '', '', '2020-05-13 13:27:58', '2020-05-14 01:57:58'),
(20, 3, 'Mathi', 'G', 'mathig302@gmail.com', '', 0, '44', '864994884648', '', 0, '81dc9bdb52d04dc20036dbd8313ed055', 'Coimbatore, Tamil Nadu, India', 'India', '', 'English,Tamil', 'Graphics & Design', 'I\'m iron man', '11.0168445', '76.9558321', 0.00, 0, 0, 1, 0.00, 1, 0, 'Android', 'dVM8_08CtqY:APA91bHdMOWnhv0XbiLFak97gExI9JS4xb5T8cmp3SfctaB7dJQh1W3z2P1zVbap6dr3H2rIK-K5adp9FnlMAZd8M8rdr6wR7QVifkY2dkHT1jiHZadM9adZdeQEjLKVfrZUxI28sDXd', '2020-04-28 15:24:48', '2020-04-29 03:54:48'),
(22, 3, 'Rohit', 'Kulkarni', 'rohitck007@gmail.com', '', 0, '44', '1239', '', 0, '', 'Pune, Maharashtra, India', 'India', '', 'English ,Hindi ', 'QA', 'aaaaa', '18.5204303', '73.8567437', 0.00, 0, 0, 0, 0.00, 1, 0, '', '', '2020-04-25 07:51:06', '2020-04-25 20:21:06'),
(23, 3, 'Omkar', 'Mande', 'huat1@mailinator.com', '', 0, '44', '321', '', 0, '93f57323e0205dffea729add44cb702b', 'Pune, Maharashtra, India', 'India', '1587753000.jpg', 'English ,Hindi ,Marathi ', 'QA', 'tester', '18.5204303', '73.8567437', 0.00, 0, 0, 1, 0.00, 1, 1, 'Android', 'fCMLumEnw1E:APA91bGXRfKG9klcb4X2-MztwP3CglymRorQK9ogJNufkg-TBUQwYcoS_whfpa4aR1TdFlkh3Za552XVAlITwY0VDFunM5i0xIjYbe4zBlm4lFp-Yx5VqdqjT_m9tNX_Subphqp4J3mY', '2020-04-25 10:40:14', '2020-04-25 23:10:14'),
(25, 3, 'Testing', 'User', 'test@gmail.com', '', 0, '44', '123456789', '', 0, 'e10adc3949ba59abbe56e057f20f883e', 'China', 'China', '', 'This', 'Web & Mobile Design', 'hh', '35.86166000000001', '104.195397', 0.00, 0, 0, 1, 0.00, 1, 0, 'Android', 'fCqBcDC27A0:APA91bEGF5tldwkA7k3oLYNOAPcNJWoXdajKGcrTqilfQTSJ2A0J2jO-aLD-ZV50gEcZcfLKDshf-ImDNbrjC5uqiwjJiBYhL4JKFcp1KEWs_LwxzjxiEwxmXdiqfeClWuRtbRMbGfh3', '2020-04-28 15:30:51', '2020-04-29 04:00:51'),
(26, 3, 'Vinay', 'Ar', 'huab@mailinator.com', '', 0, '44', '5643', '', 0, '93f57323e0205dffea729add44cb702b', 'Pune, Maharashtra, India', 'India', '', 'English', 'buyer', 'shsjs', '18.5204303', '73.8567437', 0.00, 0, 0, 1, 0.00, 1, 1, 'Android', 'dvlgKM3ZAyM:APA91bHV17xNu4FN0KaKmiKpo9ITWSB1G1UeL9I-eNT8bXjq6etgu7svKu3yg4KqQBuRgsTZyZBnsEdVL479pEl0K6P9YlAw4ICaUj69hQ3ybcToSSeFea7fzc_KvmFWjD_76nHM86IN', '2020-05-03 09:24:11', '2020-05-03 21:54:11'),
(27, 3, 'Ashwini', 'Kulkarni', 'huas@mailinator.com', '', 0, '44', '1142', '', 0, '93f57323e0205dffea729add44cb702b', 'Pune, Maharashtra, India', 'India', '', 'English ', 'Arts & Crafts', 'frgbju', '18.5204303', '73.8567437', 0.00, 0, 0, 1, 0.00, 1, 1, 'Android', 'eyQYH8WsXjU:APA91bEnpKoh_Vjy7wTSugQ27T8J6ike9izWly7U4kDtSCjxwo9Djy-T3k8RbUbr2z30dde-EPlgxQsutTn8QLmc_oSl6_44wMD3egppcg8vJnlx9W2eNkcQTWkfpP1ZmKafWy5PICrz', '2020-05-03 09:37:29', '2020-05-03 22:07:29'),
(28, 3, 'Xyz', 'Ddd', 'huab1@mailinator.com', '', 0, '44', '332', '', 0, '93f57323e0205dffea729add44cb702b', 'Pune, Maharashtra, India', 'India', '', 'English ', 'Career Advice', 'uubv', '18.5204303', '73.8567437', 0.00, 0, 0, 1, 0.00, 1, 0, 'Android', 'duwD48lxbI8:APA91bFsUurB59D5Er6eN5SlnwEOh928qvp-N0BQmMY9q3ElF6yhiVCd54PAaTnVjxOSKdda0Gj-AJpaU6WfrjcFJXyRTyUKOsflUTfz6ytYwoHA-z2y4UFTdjU5SC2gXwUTk3thSAJV', '2020-05-12 05:46:31', '2020-05-12 18:16:31'),
(29, 3, 'Seller', 'Zzz', 'huas1@mailinator.com', '', 0, '', '', '', 0, '93f57323e0205dffea729add44cb702b', '', '', '', '', '', '', '', '', 0.00, 0, 0, 1, 0.00, 1, 0, 'Android', 'cVh46vuZl1c:APA91bGID1r0oqKgKdrg2iisSW49cqrGUrAWa4tjlkTNMrPm_BpfdgCeYlbP-IFZNSp5_XLe4gei4L7mODBcSkk1O5AY-vahELGQYvtlDCU0N2X2h8uyUUcBLcTLVIMjZ41u9z3FIOOl', '2020-05-12 18:17:29', '0000-00-00 00:00:00'),
(30, 3, 'Nan', 'Seller', 'nan@seller.com', '', 0, '44', '9988774455', '', 0, 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Airport Rd, Peelamedu, Civil Aerodrome Post, Coimbatore, Tamil Nadu 641014, India', '', '', 'English,French', 'Digital Marketing', 'The The most popular of my life and the other side of the most important thing is that the first one ', '11.0304324', '77.03909279999999', 0.00, 0, 0, 1, 0.00, 1, 1, 'Android', 'cP8MfozSZ8g:APA91bHfGrLMMhnphf765EOWRKptfP2RNqZ-9Scslq68Pv8vABhifimCH2b4Ij40Z1OEwBqfN96OKsh23OMzFx1SfORiOZTwoF-BDR_S9i1M7fhq-R-glvS7ZUdHq2U1_uYXujnkVFr6', '2020-05-25 07:09:00', '2020-05-25 19:39:00'),
(31, 3, 'Nan', 'Buyer', 'nan@buyer.com', '', 0, '44', '9988774458', '', 0, 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Airport Rd, Peelamedu, Civil Aerodrome Post, Coimbatore, Tamil Nadu 641014, India', '', '1590345000.jpg', 'English ,French ', 'Databases', 'The first one to one of the most important thing is that the first one to one of the most important thing is that the first one to one of the most important thing is that the first one to one of the most important thing is ', '11.0304324', '77.03909279999999', 0.00, 0, 0, 1, 0.00, 1, 1, 'Android', 'fvtsxbzPUC0:APA91bEIu1fEhupQmqNafDkiu6NfA5QT6oD5tacu4Fx5sUuJUwa8ObK7dLKptqzTK30g5nHDMbYLAB8K4o2RBsEWxdwyH1gGQTFzyj4PXDJm8VR-poXM1BfBvp-ZrapxV4MAG2nYl1tv', '2020-05-25 07:07:25', '2020-05-25 19:37:25'),
(32, 3, 'Ashwinii', 'Kkkkkk', 'huaash@mailinator.com', '', 0, '44', '523', '', 0, '93f57323e0205dffea729add44cb702b', 'Pune, Maharashtra, India', 'India', '', 'English ', 'Web & Mobile Design', 'shsjs', '18.5204303', '73.8567437', 0.00, 0, 0, 1, 0.00, 1, 0, 'Android', 'd6YH_ObVkv4:APA91bHvxtfw3BUhk1AagYXmDH7vzafWpPcWEMCsBzRPLVJ7pD_myUTNnci5UmfBoIRugRi-Uy6zTwzJVre2TJIUVsQxukTOzerepNHdZQXMQj_4cdGnL_-1MU2MMqnX5v8YrKWh0EQp', '2020-05-14 19:14:06', '2020-05-15 07:44:06'),
(33, 3, 'Buyer', 'Aaa', 'huabuy@mailinator.com', '', 0, '', '', '', 0, '93f57323e0205dffea729add44cb702b', '', '', '', '', '', '', '', '', 0.00, 0, 0, 1, 0.00, 1, 0, 'Android', 'eAn9EhYd_S4:APA91bG-5At9uqOnswS3bgfVKEh50xAnmjWXasug7aBrnBJQcIvsYexFcG0bfv4tNS9HHT9Js8kTnE-aKt_ZqAvq7f_U-fcRr1XuPCCzIk7F8PP9FogO4zVEIk7UBa-MIDpypX_otZLo', '2020-05-15 07:46:42', '0000-00-00 00:00:00'),
(34, 3, 'Gowtham', 'Uniflyn', 'gowthamuniflyn@gmail.com', '', 0, '', '', '', 0, '7aca48427cc8b53060886248be3d4003', '', '', '', '', '', '', '', '', 0.00, 0, 0, 1, 0.00, 1, 0, 'Android', 'fniEdgUnsSM:APA91bHo57A8WL_L8Y423zcU08Q6qWZQvMXwqH41RD3b2-LBOvYiJjnKP3v8I2ZZqU0hrKUJuf6jDYxtB40gZL76aXri57f2ghJvoltYnfVjH6aVwPVF7NJ4KDmXrO3LHBuOOmDgRjqP', '2020-05-15 12:26:37', '2020-05-16 00:56:37'),
(35, 3, 'Ali', 'Qureshi', 'adijikhan@gmail.com', '', 0, '92', '3045636257', '', 0, '459e333573197638fe235524084b805e', 'Multan, Punjab, Pakistan', 'Pakistan', '', 'Social media marketing ,Content writing ,User testing ', 'User Testing, content writing , Social ', 'ok this is me for testing ', '30.157458', '71.5249154', 0.00, 0, 0, 0, 0.00, 1, 1, '', '', '2020-05-31 18:14:34', '2020-06-01 06:44:34'),
(36, 3, 'Adeel', 'Ahmad', 'mamhamakhtar@gmail.com', '', 0, '92', '3045636257888', '', 0, 'c4ca4238a0b923820dcc509a6f75849b', 'No. 39, Lane 260, Guangfu South Road, Da’an District, Taipei City, Taiwan 106', 'Taiwan', '', 'English ,ch', 'Social Media Marketing', 'anababnshhssjsjsjjaa', '25.0401553', '121.5556481', 0.00, 0, 0, 1, 0.00, 1, 1, 'Android', 'f7_J7LWIM_k:APA91bG9U1kGBAyL8zb6mQvjEbzXI-8Ehg1KjMOUKXAPF7CLqmR--XIVypbDiqubxCYrvhNylC5ejowi0XC7yXj_BBLUZj2FIyykhBa_67q1R7sThPx6pDjkNah_wPb-_ULC1yIOq6Gq', '2020-05-31 18:14:56', '2020-06-01 06:44:56');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `full_name` text NOT NULL,
  `address` text NOT NULL,
  `billing_lattitude` text NOT NULL,
  `billing_longitude` text NOT NULL,
  `city` text NOT NULL,
  `country` text NOT NULL,
  `zipcode` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `gig_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `delivery_time` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `total_cost` double(10,2) NOT NULL,
  `shipping_cost` double(10,2) NOT NULL,
  `final_cost` double(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `seller_id`, `gig_id`, `description`, `delivery_time`, `quantity`, `price`, `total_cost`, `shipping_cost`, `final_cost`, `created_at`, `updated_at`) VALUES
(10, 20, 25, 33, 'hi', 7, 1, 123.00, 123.00, 0.00, 123.00, '2020-04-29 04:14:41', '0000-00-00 00:00:00'),
(21, 18, 25, 35, 'Yy', 10, 1, 1000.00, 1000.00, 0.00, 1000.00, '2020-05-07 03:52:17', '2020-05-07 16:22:17'),
(22, 18, 25, 33, '', 7, 2, 123.00, 246.00, 0.00, 246.00, '2020-05-07 03:52:47', '2020-05-07 16:22:47'),
(17, 25, 25, 35, 'Yy', 10, 1, 1000.00, 1000.00, 0.00, 1000.00, '2020-05-06 15:48:31', '2020-05-07 04:18:31'),
(42, 35, 1, 2, 'y', 10, 1, 200.00, 200.00, 0.00, 200.00, '2020-05-27 10:53:45', '0000-00-00 00:00:00'),
(41, 35, 18, 19, '', 30, 1, 300.00, 300.00, 30.00, 330.00, '2020-05-26 14:39:37', '2020-05-27 03:09:37'),
(43, 36, 35, 41, 'i will do with you', 7, 1, 20.00, 20.00, 0.00, 20.00, '2020-05-27 13:02:21', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_name` text CHARACTER SET utf8,
  `category_icon` text NOT NULL,
  `parent_category_id` int(11) NOT NULL,
  `category_status` int(11) NOT NULL COMMENT '0-inactive/1-active/2-deleted',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_icon`, `parent_category_id`, `category_status`, `created_at`, `updated_at`) VALUES
(1, 'Graphics & Design', '1571769000.png', 0, 1, '2019-09-06 15:30:13', '2019-10-23 19:48:56'),
(2, 'Digital Marketing', '15717690001.png', 0, 1, '2019-09-06 15:31:12', '2019-10-23 19:49:29'),
(3, 'Writing & Translation', '15717690008.png', 0, 1, '2019-09-06 15:32:04', '2019-10-23 19:59:45'),
(4, 'Video & Animation', '15717690004.png', 0, 1, '2019-09-06 15:32:33', '2019-10-23 19:50:56'),
(5, 'Music & Audio', '15717690003.png', 0, 1, '2019-09-06 15:33:53', '2019-10-23 19:50:36'),
(6, 'Programming & Tech', '15717690006.png', 0, 1, '2019-09-06 15:37:58', '2019-10-23 19:51:42'),
(7, 'Advertising', '15717690005.png', 0, 1, '2019-09-06 15:39:25', '2019-10-23 19:51:16'),
(8, 'Business', '15717690007.png', 0, 1, '2019-09-06 15:40:18', '2019-10-23 19:57:43'),
(9, 'Fun & Lifestyle', '15717690002.png', 0, 1, '2019-09-06 15:40:58', '2019-10-23 19:50:13'),
(10, 'Logo Design', '156772800010.png', 1, 1, '2019-09-06 15:44:35', '0000-00-00 00:00:00'),
(11, 'Business Cards & Stationery', '156772800011.png', 1, 1, '2019-09-06 15:45:35', '0000-00-00 00:00:00'),
(12, 'Illustration', '156772800012.png', 1, 1, '2019-09-06 15:46:38', '0000-00-00 00:00:00'),
(13, 'Cartoons & Caricatures', '156772800013.png', 1, 1, '2019-09-06 15:47:18', '0000-00-00 00:00:00'),
(14, 'Flyers & Posters', '156772800014.png', 1, 1, '2019-09-06 15:47:44', '0000-00-00 00:00:00'),
(15, 'Book Covers & Packaging', '156772800017.png', 0, 2, '2019-09-06 15:48:23', '2019-09-06 15:55:08'),
(16, 'Web & Mobile Design', '156772800018.png', 1, 1, '2019-09-06 15:49:03', '0000-00-00 00:00:00'),
(17, 'Social Media Design', '156772800019.png', 1, 1, '2019-09-06 15:49:27', '0000-00-00 00:00:00'),
(18, 'Banner Ads', '156772800020.png', 1, 1, '2019-09-06 15:49:51', '0000-00-00 00:00:00'),
(19, 'Photoshop Editing', '156772800021.png', 1, 1, '2019-09-06 15:50:20', '0000-00-00 00:00:00'),
(20, '3D & 2D Models', '156772800022.png', 1, 1, '2019-09-06 15:50:50', '0000-00-00 00:00:00'),
(21, 'T-Shirts', '156772800023.png', 1, 1, '2019-09-06 15:51:26', '0000-00-00 00:00:00'),
(22, 'Presentation Design', '156772800024.png', 1, 1, '2019-09-06 15:52:09', '0000-00-00 00:00:00'),
(23, 'Infographics', '156772800025.png', 1, 1, '2019-09-06 15:52:45', '0000-00-00 00:00:00'),
(24, 'Vector Tracing', '156772800026.png', 1, 1, '2019-09-06 15:53:12', '0000-00-00 00:00:00'),
(25, 'Invitations', '156772800027.png', 1, 1, '2019-09-06 15:53:39', '0000-00-00 00:00:00'),
(26, 'Book Covers & Packaging', '156772800028.png', 1, 1, '2019-09-06 15:56:12', '0000-00-00 00:00:00'),
(27, 'SEO', '156772800029.png', 2, 1, '2019-09-06 15:57:19', '0000-00-00 00:00:00'),
(28, 'Social Media Marketing', '156772800030.png', 2, 1, '2019-09-06 15:57:43', '0000-00-00 00:00:00'),
(29, 'Web Traffic', '156772800031.png', 2, 1, '2019-09-06 15:58:13', '0000-00-00 00:00:00'),
(30, 'Content Marketing', '156772800033.png', 0, 2, '2019-09-06 15:58:43', '2019-09-06 16:03:37'),
(31, 'Social Video Marketing', '156772800034.png', 2, 1, '2019-09-06 15:59:23', '0000-00-00 00:00:00'),
(32, 'Email Marketing', '156772800035.png', 2, 1, '2019-09-06 15:59:49', '0000-00-00 00:00:00'),
(33, 'Local Listings', '156772800036.png', 2, 1, '2019-09-06 16:00:40', '0000-00-00 00:00:00'),
(34, 'Domain Research', '156772800037.png', 2, 1, '2019-09-06 16:01:04', '0000-00-00 00:00:00'),
(35, 'SEM', '156772800038.png', 2, 1, '2019-09-06 16:01:29', '0000-00-00 00:00:00'),
(36, 'Marketing Strategy', '156772800039.png', 2, 1, '2019-09-06 16:01:58', '0000-00-00 00:00:00'),
(37, 'Web Analytics', '156772800040.png', 2, 1, '2019-09-06 16:02:28', '0000-00-00 00:00:00'),
(38, 'Mobile Advertising', '156772800041.png', 2, 1, '2019-09-06 16:02:52', '0000-00-00 00:00:00'),
(39, 'Influencer Marketing', '156772800042.png', 2, 1, '2019-09-06 16:03:20', '0000-00-00 00:00:00'),
(40, 'Content Marketing', '156772800043.png', 2, 1, '2019-09-06 16:04:10', '0000-00-00 00:00:00'),
(41, 'Articles & Blog Posts', '1567814400.png', 0, 2, '2019-09-06 16:05:34', '2019-09-07 12:35:44'),
(42, 'Business Copywriting', '15678144001.png', 0, 2, '2019-09-06 16:06:46', '2019-09-07 12:35:37'),
(43, 'Resumes & Cover Letters', '15678144006.png', 3, 1, '2019-09-06 16:07:08', '2019-09-07 17:48:08'),
(44, 'Research & Summaries', '15678144007.png', 3, 1, '2019-09-06 16:07:49', '2019-09-07 17:48:29'),
(45, 'Translation', '15678144008.png', 3, 1, '2019-09-06 16:08:18', '2019-09-07 17:48:46'),
(46, 'Creative Writing', '15678144009.png', 3, 1, '2019-09-06 16:08:59', '2019-09-07 17:49:07'),
(47, 'Proof Reading & Editing', '156781440010.png', 3, 1, '2019-09-06 16:09:31', '2019-09-07 17:49:46'),
(48, 'Press Releases', '156781440011.png', 3, 1, '2019-09-06 16:10:04', '2019-09-07 17:50:06'),
(49, 'Transcription', '156781440012.png', 3, 1, '2019-09-06 16:10:43', '2019-09-07 17:50:21'),
(50, 'Legal Writing', '156781440013.png', 3, 1, '2019-09-06 16:11:10', '2019-09-07 17:50:42'),
(51, 'Whiteboard & Explainer Videos', '156781440014.png', 4, 1, '2019-09-06 16:11:54', '2019-09-07 17:51:18'),
(52, 'Intros & Animated Logos', '156781440015.png', 4, 1, '2019-09-06 16:12:23', '2019-09-07 17:51:33'),
(53, 'Promotional & Brand Videos', '156781440016.png', 4, 1, '2019-09-06 16:12:53', '2019-09-07 17:51:48'),
(54, 'Lyric & Music Videos', '156781440017.png', 4, 1, '2019-09-06 16:13:24', '2019-09-07 17:52:03'),
(55, 'Spokespersons & Testimonials', '156781440018.png', 4, 1, '2019-09-06 16:13:50', '2019-09-07 17:52:34'),
(56, 'Editing & Post Production', '156781440019.png', 4, 1, '2019-09-06 16:14:27', '2019-09-07 17:52:57'),
(57, 'Animated Characters & Modeling', '156781440020.png', 4, 1, '2019-09-06 16:14:50', '2019-09-07 17:53:12'),
(58, 'Voice Over', '156781440021.png', 5, 1, '2019-09-06 16:19:41', '2019-09-07 17:53:35'),
(59, 'Mixing & Mastering', '156781440022.png', 5, 1, '2019-09-06 16:20:22', '2019-09-07 17:53:49'),
(60, 'Producers & Composers', '156781440023.png', 5, 1, '2019-09-06 16:20:46', '2019-09-07 17:54:11'),
(61, 'Singer-Songwriters', '156781440024.png', 5, 1, '2019-09-06 16:21:16', '2019-09-07 17:54:29'),
(62, 'Session Musicians & Singers', '156781440025.png', 5, 1, '2019-09-06 16:21:45', '2019-09-07 17:54:59'),
(63, 'Jingles & Drops', '156781440026.png', 5, 1, '2019-09-06 16:22:13', '2019-09-07 17:55:34'),
(64, 'Sound Effects', '156781440027.png', 5, 1, '2019-09-06 16:22:46', '2019-09-07 17:55:49'),
(65, 'WordPress', '156781440028.png', 6, 1, '2019-09-06 16:38:09', '2019-09-07 17:56:57'),
(66, 'Web Programming', '156781440029.png', 6, 1, '2019-09-06 16:38:31', '2019-09-07 17:57:12'),
(67, 'Ecommerce', '156781440030.png', 6, 1, '2019-09-06 16:38:56', '2019-09-07 17:57:37'),
(68, 'Mobile Apps & Web', '156781440031.png', 6, 1, '2019-09-06 16:39:22', '2019-09-07 17:57:57'),
(69, 'Website Builders & CMS', '156781440032.png', 6, 1, '2019-09-06 16:39:46', '2019-09-07 17:59:01'),
(70, 'Desktop applications', '156781440033.png', 6, 1, '2019-09-06 16:40:12', '2019-09-07 17:59:17'),
(71, 'Data Analysis & Reports', '156781440034.png', 6, 1, '2019-09-06 16:40:34', '2019-09-07 17:59:37'),
(72, 'Convert Files', '156781440035.png', 6, 1, '2019-09-06 16:40:57', '2019-09-07 17:59:59'),
(73, 'Support & IT', '156781440036.png', 6, 1, '2019-09-06 16:41:18', '2019-09-07 18:00:25'),
(74, 'Databases', '156781440037.png', 6, 1, '2019-09-06 16:41:46', '2019-09-07 18:00:37'),
(75, 'User Testing', '156781440038.png', 6, 1, '2019-09-06 16:42:06', '2019-09-07 18:00:50'),
(76, 'QA', '156781440039.png', 6, 1, '2019-09-06 16:42:25', '2019-09-07 18:01:01'),
(77, 'Music Promotion', '156781440040.png', 7, 1, '2019-09-06 16:43:21', '2019-09-07 18:01:19'),
(78, 'Radio', '156781440041.png', 7, 1, '2019-09-06 16:43:39', '2019-09-07 18:01:37'),
(79, 'Banner Advertising', '156781440042.png', 7, 1, '2019-09-06 16:44:04', '2019-09-07 18:01:52'),
(80, 'Flyers & Handouts', '156781440043.png', 7, 1, '2019-09-06 16:44:23', '2019-09-07 18:02:06'),
(81, 'Pet Models', '156781440044.png', 7, 1, '2019-09-06 16:44:45', '2019-09-07 18:02:21'),
(82, 'Virtual Assistant', '156781440045.png', 8, 1, '2019-09-06 16:45:45', '2019-09-07 18:03:05'),
(83, 'Market Research', '156781440046.png', 8, 1, '2019-09-06 16:46:11', '2019-09-07 18:03:18'),
(84, 'Business Plans', '156781440047.png', 8, 1, '2019-09-06 16:46:34', '2019-09-07 18:04:00'),
(85, 'Branding Services', '156772800088.png', 0, 2, '2019-09-06 16:46:54', '2019-09-06 16:47:24'),
(86, 'Branding Services', '156781440048.png', 8, 1, '2019-09-06 16:47:40', '2019-09-07 18:04:14'),
(87, 'Legal Consulting', '156781440049.png', 8, 1, '2019-09-06 16:48:04', '2019-09-07 18:04:31'),
(88, 'Financial Consulting', '156781440050.png', 8, 1, '2019-09-06 16:48:29', '2019-09-07 18:04:42'),
(89, 'Business Tips', '156781440051.png', 8, 1, '2019-09-06 16:48:49', '2019-09-07 18:04:54'),
(90, 'Presentations', '156781440052.png', 8, 1, '2019-09-06 16:49:09', '2019-09-07 18:05:06'),
(91, 'Career Advice', '156781440053.png', 8, 1, '2019-09-06 16:49:33', '2019-09-07 18:05:17'),
(92, 'Online Lessons', '156781440054.png', 9, 1, '2019-09-06 16:50:13', '2019-09-07 18:05:35'),
(93, 'Arts & Crafts', '156781440055.png', 9, 1, '2019-09-06 16:50:32', '2019-09-07 18:05:48'),
(94, 'Relationship Advice', '156781440056.png', 9, 1, '2019-09-06 16:50:51', '2019-09-07 18:06:18'),
(95, 'Health, Nutrition & Fitness', '156781440057.png', 9, 1, '2019-09-06 16:51:10', '2019-09-07 18:06:36'),
(96, 'Astrology & Readings', '156781440058.png', 9, 1, '2019-09-06 16:51:31', '2019-09-07 18:07:03'),
(97, 'Spiritual & Healing ', '156781440059.png', 9, 1, '2019-09-06 17:28:57', '2019-09-07 18:07:44'),
(98, 'Family & Genealogy', '156781440060.png', 9, 1, '2019-09-06 17:41:34', '2019-09-07 18:07:56'),
(99, 'Collectibles', '156781440061.png', 9, 1, '2019-09-06 17:43:05', '2019-09-07 18:08:07'),
(100, 'Greeting Cards & Videos', '156781440062.png', 9, 1, '2019-09-06 17:44:36', '2019-09-07 18:08:43'),
(101, 'Your Message On...', '156781440063.png', 9, 1, '2019-09-06 17:45:10', '2019-09-07 18:08:55'),
(102, 'Viral Videos', '156781440064.png', 9, 1, '2019-09-06 17:45:45', '2019-09-07 18:09:07'),
(103, 'Pranks & Stunts', '156781440065.png', 9, 1, '2019-09-06 17:46:05', '2019-09-07 18:09:20'),
(104, 'Celebrity Impersonators', '156781440066.png', 9, 1, '2019-09-06 17:46:43', '2019-09-07 18:09:33'),
(105, 'Gaming', '156781440067.png', 9, 1, '2019-09-06 17:47:07', '2019-09-07 18:09:56'),
(106, 'Global Culture', '156781440068.png', 9, 1, '2019-09-06 17:47:31', '2019-09-07 18:10:09'),
(107, 'Articles & Blog Posts', '15678144004.png', 3, 1, '2019-09-07 17:35:15', '2019-09-07 17:47:01'),
(108, 'Business Copywriting', '15678144005.png', 3, 1, '2019-09-07 17:47:50', '2019-12-08 14:27:32'),
(109, 'AA', '1569456000.jpg', 8, 2, '2019-09-26 18:59:01', '2019-09-26 18:59:12');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `firebase_id` text NOT NULL,
  `from_user_unread_count` int(11) NOT NULL,
  `to_user_unread_count` int(11) NOT NULL COMMENT 'unread message count',
  `status` int(11) NOT NULL COMMENT '0-not read/1-read/2-from user To to user block / 3 to user to from user block',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `from_user_id`, `to_user_id`, `message`, `firebase_id`, `from_user_unread_count`, `to_user_unread_count`, `status`, `created_at`) VALUES
(1, 25, 23, 'g', '23-25', 0, 1, 0, '2020-04-29 04:04:30'),
(2, 25, 22, 'hi', '22-25', 0, 1, 0, '2020-04-29 04:04:41'),
(3, 25, 11, 'hi', '11-25', 0, 1, 0, '2020-04-29 18:20:10'),
(4, 5, 27, 'hi', '27-5', 0, 1, 2, '2020-05-06 19:45:39'),
(5, 35, 1, 'hey', '1-35', 0, 1, 0, '2020-05-27 12:55:59'),
(6, 35, 28, 'hello', '28-35', 0, 1, 0, '2020-05-27 03:09:12'),
(7, 36, 35, 'http://mobwebapps.com/gig_people//uploads/profile/1590863400.jpg', '35-36', 3, 0, 0, '2020-06-01 06:37:52');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` text NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `user_id`, `type`, `content`, `created_at`) VALUES
(1, 36, 'My Gigs', 'need help', '2020-05-27 13:48:33.000000');

-- --------------------------------------------------------

--
-- Table structure for table `favouritelist`
--

CREATE TABLE `favouritelist` (
  `id` int(11) NOT NULL,
  `favourite_type` int(11) NOT NULL COMMENT '1.Seller,2,Gig',
  `user_id` int(11) NOT NULL,
  `favourite_id` int(11) NOT NULL COMMENT 'favourite type 1.means seller id, 2.means gig id',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favouritelist`
--

INSERT INTO `favouritelist` (`id`, `favourite_type`, `user_id`, `favourite_id`, `created_at`) VALUES
(1, 2, 25, 9, '2020-04-29 03:42:51'),
(2, 2, 25, 4, '2020-04-29 04:08:17'),
(3, 2, 25, 13, '2020-04-29 04:08:28'),
(4, 2, 25, 19, '2020-04-29 04:08:32'),
(5, 1, 25, 23, '2020-04-29 04:08:52'),
(6, 1, 20, 23, '2020-04-29 04:09:01'),
(7, 2, 26, 36, '2020-05-03 19:30:48'),
(9, 1, 26, 27, '2020-05-03 19:31:34'),
(13, 1, 5, 27, '2020-05-07 00:23:55'),
(12, 2, 5, 36, '2020-05-07 00:23:47'),
(14, 2, 5, 18, '2020-05-07 00:24:42'),
(15, 1, 5, 11, '2020-05-07 01:30:43'),
(16, 1, 18, 27, '2020-05-07 03:15:25'),
(17, 1, 18, 25, '2020-05-07 03:15:30'),
(18, 2, 18, 36, '2020-05-07 03:15:38'),
(19, 2, 18, 13, '2020-05-07 03:16:07'),
(20, 2, 5, 2, '2020-05-07 13:20:08'),
(21, 2, 5, 3, '2020-05-07 13:24:20'),
(22, 1, 5, 30, '2020-05-14 13:38:41'),
(25, 2, 35, 19, '2020-05-26 19:34:19');

-- --------------------------------------------------------

--
-- Table structure for table `gig_list`
--

CREATE TABLE `gig_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `price` double(10,2) NOT NULL,
  `delivery_time` int(11) NOT NULL,
  `shipping` int(11) NOT NULL COMMENT '1-No, 2-Yes',
  `shipping_price` double(10,2) NOT NULL,
  `total_cost` double(10,2) NOT NULL,
  `revisions` int(11) NOT NULL,
  `gig_tag` text NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0.New/Waiting, 1.Draft/Pause, 2.Pubilsh, 3.Denied',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gig_list`
--

INSERT INTO `gig_list` (`id`, `user_id`, `title`, `category_id`, `sub_category_id`, `image`, `price`, `delivery_time`, `shipping`, `shipping_price`, `total_cost`, `revisions`, `gig_tag`, `description`, `status`, `created_at`, `updated_at`, `published_at`) VALUES
(1, 1, 'I will Gig1', 1, 26, '{\"image_list\":[{\"file\":\"15792858003.jpg\",\"thumnail\":\"15792858003.jpg\",\"type\":\"1\"}]}', 165.00, 15, 2, 5.00, 170.00, 3, 'qwe', '????', 2, '2020-01-18 17:39:27', '0000-00-00 00:00:00', '2020-01-18 17:41:22'),
(2, 1, 'I will Gig2', 1, 25, '{\"image_list\":[{\"file\":\"1579285800.png\",\"thumnail\":\"1579285800.png\",\"type\":\"1\"}]}', 200.00, 10, 1, 0.00, 200.00, 5, 'fd', '?(((', 2, '2020-01-18 17:40:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 3, 'I will testing', 6, 74, '{\"image_list\":[{\"file\":\"1582137000.jpg\",\"thumnail\":\"1582137000.jpg\",\"type\":\"1\"}]}', 25.00, 2, 1, 0.00, 25.00, 2, 'tt', 'test', 2, '2020-02-20 20:16:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 5, 'I will New gig dev 1', 9, 105, '{\"image_list\":[{\"file\":\"15822234001.jpg\",\"thumnail\":\"15822234001.jpg\",\"type\":\"1\"}]}', 1250.00, 25, 2, 50.00, 1300.00, 5, 'Games', 'this is my favourite game', 2, '2020-02-21 18:52:03', '0000-00-00 00:00:00', '2020-02-21 18:52:26'),
(5, 5, 'I will New gig 2', 1, 10, '{\"image_list\":[{\"file\":\"15822234002.jpg\",\"thumnail\":\"15822234002.jpg\",\"type\":\"1\"}]}', 500.00, 10, 2, 25.00, 525.00, 7, 'logo', 'logo', 2, '2020-02-21 18:54:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 5, 'I will developer', 4, 54, '{\"image_list\":[{\"file\":\"1582223400.mp4\",\"thumnail\":\"15822234003.jpg\",\"type\":\"2\"},{\"file\":\"15822234001.mp4\",\"thumnail\":\"15822234004.jpg\",\"type\":\"2\"}]}', 1500.00, 13, 1, 0.00, 1500.00, 7, 'Video, Animation', 'this is video Animation', 2, '2020-02-21 18:57:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 6, 'I will do program', 6, 68, '{\"image_list\":[{\"file\":\"15822234005.jpg\",\"thumnail\":\"15822234005.jpg\",\"type\":\"1\"}]}', 10.00, 24, 1, 0.00, 10.00, 6, 'Android, java, xml', 'the future of our you can forward it to the attach', 2, '2020-02-21 19:55:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 6, 'I will do program1', 6, 68, '{\"image_list\":[{\"file\":\"15822234006.jpg\",\"thumnail\":\"15822234006.jpg\",\"type\":\"1\"}]}', 10.00, 7, 1, 0.00, 10.00, 5, 'android, java', 'the future of our you can forward it to the attach', 2, '2020-02-21 19:57:50', '0000-00-00 00:00:00', '2020-02-21 20:00:22'),
(9, 5, 'I will dd', 5, 60, '{\"image_list\":[{\"file\":\"15822234007.jpg\",\"thumnail\":\"15822234007.jpg\",\"type\":\"1\"}]}', 1000.00, 10, 1, 0.00, 1000.00, 7, 'dddd', 'd', 2, '2020-02-21 20:05:12', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 5, 'I will vid', 5, 62, '{\"image_list\":[{\"file\":\"15822234008.jpg\",\"thumnail\":\"15822234008.jpg\",\"type\":\"1\"}]}', 500.00, 10, 1, 0.00, 500.00, 7, 'gig, and', 'f', 2, '2020-02-21 20:07:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 6, 'I will do program2', 6, 68, '{\"image_list\":[{\"file\":\"15822234009.jpg\",\"thumnail\":\"15822234009.jpg\",\"type\":\"1\"}]}', 10.00, 6, 1, 0.00, 10.00, 4, 'java,  android', 'The first one to one of the most important ', 2, '2020-02-21 21:21:58', '0000-00-00 00:00:00', '2020-02-21 21:25:08'),
(12, 6, 'I will do program3', 6, 68, '{\"image_list\":[{\"file\":\"1582309800.jpg\",\"thumnail\":\"1582309800.jpg\",\"type\":\"1\"}]}', 50.00, 6, 2, 5.00, 55.00, 6, 'android, java', 'The first one to one of the most important ', 2, '2020-02-23 00:24:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 11, 'I will do gaming', 9, 105, '{\"image_list\":[{\"file\":\"1582569000.jpg\",\"thumnail\":\"1582569000.jpg\",\"type\":\"1\"}]}', 100.00, 5, 2, 5.00, 105.00, 4, 'gaming', 'thanks in android development manager we support', 2, '2020-02-26 00:03:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 12, 'I will o business', 8, 91, '{\"image_list\":[{\"file\":\"15825690001.jpg\",\"thumnail\":\"15825690001.jpg\",\"type\":\"1\"}]}', 100.00, 5, 2, 10.00, 110.00, 3, 'business', 'thanks so rejected by a time that', 2, '2020-02-26 00:55:30', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 16, 'I will test app', 6, 75, '{\"image_list\":[{\"file\":\"1587061800.jpg\",\"thumnail\":\"1587061800.jpg\",\"type\":\"1\"},{\"file\":\"1587061800.mp4\",\"thumnail\":\"15870618001.jpg\",\"type\":\"2\"}]}', 12.00, 3, 1, 0.00, 12.00, 1, 'abc', 'test description snsjsksmsks snsksksms zjzkzkzkzz', 2, '2020-04-17 21:05:28', '0000-00-00 00:00:00', '2020-04-17 21:05:49'),
(16, 18, 'I will do database', 6, 74, '{\"image_list\":[{\"file\":\"1587407400.jpg\",\"thumnail\":\"1587407400.jpg\",\"type\":\"1\"}]}', 100.00, 10, 2, 10.00, 110.00, 5, 'database, programming', 'T the first one to one of the most important thin', 2, '2020-04-21 18:44:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 20, 'I will Hai', 6, 70, '{\"image_list\":[{\"file\":\"15874074002.jpg\",\"thumnail\":\"15874074002.jpg\",\"type\":\"1\"}]}', 50.00, 6, 2, 20.00, 70.00, 4, 'His,hj,', 'the new gig', 2, '2020-04-21 19:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 18, 'I will do business ', 8, 91, '{\"image_list\":[{\"file\":\"15874074001.jpg\",\"thumnail\":\"15874074001.jpg\",\"type\":\"1\"}]}', 200.00, 20, 2, 20.00, 220.00, 0, 'business,  careers ', 'Yes please let us have the opportunity of my ow', 2, '2020-04-21 19:01:19', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 18, 'I will do gaming', 9, 105, '{\"image_list\":[{\"file\":\"15874074003.jpg\",\"thumnail\":\"15874074003.jpg\",\"type\":\"1\"}]}', 300.00, 30, 2, 30.00, 330.00, 7, 'gaming, fun', 'To one of the of this month so you know th', 2, '2020-04-21 22:15:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 20, 'I will hin', 5, 61, '{\"image_list\":[{\"file\":\"15874074004.jpg\",\"thumnail\":\"15874074004.jpg\",\"type\":\"1\"}]}', 50.00, 4, 2, 50.00, 100.00, 4, 'fg,', 'ghjjh', 1, '2020-04-21 22:19:24', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 20, 'I will hi', 5, 61, '{\"image_list\":[{\"file\":\"15874074005.jpg\",\"thumnail\":\"15874074005.jpg\",\"type\":\"1\"}]}', 50.00, 6, 2, 50.00, 100.00, 5, 'g', 'vbjj', 1, '2020-04-21 22:21:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 20, 'I will gi', 4, 53, '{\"image_list\":[{\"file\":\"15874074006.jpg\",\"thumnail\":\"15874074006.jpg\",\"type\":\"1\"}]}', 50.00, 9, 2, 50.00, 100.00, 5, 'gh', 'gi', 2, '2020-04-21 22:22:44', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 20, 'I will hi ', 6, 70, '{\"image_list\":[{\"file\":\"15874074007.jpg\",\"thumnail\":\"15874074007.jpg\",\"type\":\"1\"}]}', 50.00, 6, 2, 50.00, 100.00, 5, 'yy', 'bjj', 2, '2020-04-21 22:25:56', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 32, 'I will dance', 5, 61, '{\"image_list\":[{\"file\":\"15894810001.jpg\",\"thumnail\":\"15894810001.jpg\",\"type\":\"1\"}]}', 5.00, 3, 1, 0.00, 5.00, 1, 'rrr', 'ffff', 2, '2020-05-15 08:12:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 35, 'I will do manage your fB page ', 2, 28, '{\"image_list\":[{\"file\":\"1590431400.png\",\"thumnail\":\"1590431400.png\",\"type\":\"1\"}]}', 20.00, 7, 1, 0.00, 20.00, 2, 'socialmediamarkeing, facebookmarketing, facebookads', 'i will do manage your facebook page handle it also', 2, '2020-05-26 19:50:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 30, 'I will do digital marketing ', 2, 35, '{\"image_list\":[{\"file\":\"1589308200.jpg\",\"thumnail\":\"1589308200.jpg\",\"type\":\"1\"}]}', 100.00, 8, 2, 10.00, 110.00, 5, 'Seo, digital', 'To get a good idea for the most popular and ', 2, '2020-05-14 02:03:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 32, 'I will aaaaaaa', 5, 63, '{\"image_list\":[{\"file\":\"1589481000.jpg\",\"thumnail\":\"1589481000.jpg\",\"type\":\"1\"}]}', 5.00, 2, 1, 0.00, 5.00, 1, 'fff', 'bbbb', 2, '2020-05-15 07:48:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 27, 'I will draw cartoons', 1, 13, '{\"image_list\":[{\"file\":\"1588444200.jpg\",\"thumnail\":\"1588444200.jpg\",\"type\":\"1\"}]}', 10.00, 1, 1, 0.00, 10.00, 1, 'cartoon', 'testing', 2, '2020-05-03 19:12:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 28, 'I will advice', 8, 91, '{\"image_list\":[{\"file\":\"1589221800.jpg\",\"thumnail\":\"1589221800.jpg\",\"type\":\"1\"}]}', 50.00, 1, 1, 0.00, 50.00, 1, 't1, t2', 'dhjj', 2, '2020-05-12 18:19:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 18, 'I will do ads', 7, 81, '{\"image_list\":[{\"file\":\"15874074008.jpg\",\"thumnail\":\"15874074008.jpg\",\"type\":\"1\"}]}', 400.00, 30, 2, 40.00, 440.00, 7, 'pet, ads', 'Y u can be used to be a good time to time to time ', 2, '2020-04-21 23:34:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 20, 'I will hi', 6, 71, '{\"image_list\":[{\"file\":\"15880122001.jpg\",\"thumnail\":\"15880122001.jpg\",\"type\":\"1\"}]}', 200.00, 8, 1, 0.00, 200.00, 4, 'php,how ', 'hai', 2, '2020-04-29 04:12:06', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 25, 'I will gg', 1, 19, '{\"image_list\":[{\"file\":\"1588098600.jpg\",\"thumnail\":\"1588098600.jpg\",\"type\":\"1\"}]}', 1000.00, 10, 1, 0.00, 1000.00, 7, 'ten', 'js', 2, '2020-04-29 18:18:09', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 5, 'I will labc', 1, 10, '{\"image_list\":[{\"file\":\"1588012200.gif\",\"thumnail\":\"1588012200.gif\",\"type\":\"1\"}]}', 2000.00, 10, 1, 0.00, 2000.00, 6, 'testing', 't', 2, '2020-04-28 23:32:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 25, 'I will djjdjd', 8, 86, '{\"image_list\":[{\"file\":\"15880122001.gif\",\"thumnail\":\"15880122001.gif\",\"type\":\"1\"}]}', 123.00, 7, 1, 0.00, 123.00, 6, 'jfjfjf', 'ksksks', 2, '2020-04-29 04:10:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 22, 'I will test apps', 6, 76, '{\"image_list\":[{\"file\":\"1587666600.jpg\",\"thumnail\":\"1587666600.jpg\",\"type\":\"1\"}]}', 15.00, 1, 2, 5.00, 20.00, 1, 'test, qa', 'test gig', 2, '2020-04-25 04:47:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 23, 'I will review app', 6, 75, '{\"image_list\":[{\"file\":\"1587753000.jpg\",\"thumnail\":\"1587753000.jpg\",\"type\":\"1\"}]}', 5.00, 2, 1, 0.00, 5.00, 1, 't, y', 'i will review your app', 2, '2020-04-25 20:26:35', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `help`
--

CREATE TABLE `help` (
  `id` int(11) NOT NULL,
  `help` text NOT NULL,
  `parent_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `help`
--

INSERT INTO `help` (`id`, `help`, `parent_id`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, 'How do I reset my password?', 1, 1, '<ul><li><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry.</li></ul>', '2019-10-02 08:42:49.316676', '2019-10-02 08:42:49.316676'),
(2, 'How to change my profile picture?', 1, 1, '<ul><li><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry.</li><li>Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li><li>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</li></ul>', '2019-09-06 17:25:57.000000', '2019-09-06 10:25:57.320372'),
(3, 'Cancel payment that I\'ve already send?', 1, 1, '<ul><li><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry.</li><li>Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li><li>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</li></ul>', '2019-09-06 17:27:31.000000', '2019-09-06 10:27:31.211169'),
(4, 'What are the fees for accounts?', 1, 1, '<ul><li><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry.</li><li>Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li><li>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</li></ul>', '2019-09-06 17:30:05.000000', '2019-09-06 10:30:05.458992'),
(5, 'How do I receive payments?', 1, 1, '<ul><li>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</li><li>Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li><li>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</li></ul>', '2019-09-06 17:31:07.000000', '2019-09-06 10:31:07.197949'),
(6, 'What is digital marketing?', 2, 1, '<p>Digital marketing involves marketing to people using Internet-connected electronic devices, namely computers, smartphones and tablets. Digital marketing focuses on channels such as search engines, social media, email, websites and apps to connect with prospects and customers.</p>', '2019-09-20 11:14:08.000000', '2019-09-20 04:14:08.446109'),
(7, 'What does a digital marketer do?', 2, 1, '<ul><li><em><strong>Digital marketing</strong></em> has evolved to the point where an immense array of specialists consult with brands to develop effective strategies or implement programs.</li><li>If you&rsquo;re new to digital marketing, or lack experience or resources, you should consider engaging an experienced and versatile digital marketing consultant.</li></ul>', '2019-10-02 03:37:53.976402', '2019-10-02 10:37:53.000000');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` text NOT NULL,
  `title` text NOT NULL,
  `body` text NOT NULL,
  `status` text NOT NULL,
  `read_status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `body`, `status`, `read_status`, `created_at`) VALUES
(1, '25', 'Account Confirmation', 'Welcome to Gig People !!!', '0', 1, '2020-04-29 03:41:33'),
(2, '20', 'Order Placed', 'New Order Placed #1', '4', 1, '2020-04-29 03:56:13'),
(3, '5', 'Order Received', 'Mathi G has placed the order #1', '7', 1, '2020-04-29 03:56:13'),
(4, '25', 'Order Placed', 'New Order Placed #2', '4', 1, '2020-04-29 04:02:15'),
(5, '22', 'Order Received', 'Testing User has placed the order #2', '7', 0, '2020-04-29 04:02:15'),
(6, '22', 'New Comment', 'You have a new comment on your order', '7-2-3', 0, '2020-04-29 04:03:55'),
(7, '25', 'Order Placed', 'New Order Placed #3', '4', 1, '2020-04-29 04:06:33'),
(8, '11', 'Order Received', 'Testing User has placed the order #3', '7', 0, '2020-04-29 04:06:33'),
(9, '25', 'Order Placed', 'New Order Placed #4', '4', 1, '2020-04-29 04:06:33'),
(10, '5', 'Order Received', 'Testing User has placed the order #4', '7', 1, '2020-04-29 04:06:33'),
(11, '25', 'Order Placed', 'New Order Placed #5', '4', 1, '2020-04-29 04:07:07'),
(12, '11', 'Order Received', 'Testing User has placed the order #5', '7', 0, '2020-04-29 04:07:07'),
(13, '20', 'Order Placed', 'New Order Placed #6', '4', 1, '2020-04-29 04:07:51'),
(14, '5', 'Order Received', 'Mathi G has placed the order #6', '7', 1, '2020-04-29 04:07:51'),
(15, '25', 'Gig Published', 'You have published a new gig', '2-33-2', 1, '2020-04-29 04:10:28'),
(16, '20', 'Gig Published', 'You have published a new gig', '2-34-2', 1, '2020-04-29 04:12:06'),
(17, '25', 'Gig Published', 'You have published a new gig', '2-35-2', 1, '2020-04-29 18:18:09'),
(18, '25', 'Order Placed', 'New Order Placed #7', '4', 1, '2020-04-29 18:19:53'),
(19, '18', 'Order Received', 'Testing User has placed the order #7', '7', 1, '2020-04-29 18:19:53'),
(20, '26', 'Account Confirmation', 'Welcome to Gig People !!!', '0', 1, '2020-05-03 19:06:27'),
(21, '27', 'Account Confirmation', 'Welcome to Gig People !!!', '0', 1, '2020-05-03 19:07:49'),
(22, '27', 'Gig Published', 'You have published a new gig', '2-36-2', 1, '2020-05-03 19:12:21'),
(23, '26', 'Order Placed', 'New Order Placed #8', '4', 1, '2020-05-03 19:14:12'),
(24, '27', 'Order Received', 'Vinay Ar has placed the order #8', '7', 1, '2020-05-03 19:14:12'),
(25, '26', 'Time Requested', 'Seller requested time extension on your order', '4-8-3', 1, '2020-05-03 19:18:59'),
(26, '27', 'Time Request Accepted', 'Your time request accepted', '7-8-3', 1, '2020-05-03 19:19:37'),
(27, '26', 'Order Delivered', 'Order has been successfully delivered #8', '4-8-3', 1, '2020-05-03 19:25:13'),
(28, '27', 'User Rating', 'You received review from #Vinay Ar', '7-8-4', 1, '2020-05-03 19:25:49'),
(29, '26', 'User Rating', 'You received review from #Ashwini Kulkarni', '4-8-4', 1, '2020-05-03 19:26:46'),
(30, '26', 'Order Placed', 'New Order Placed #9', '4', 1, '2020-05-03 19:41:23'),
(31, '27', 'Order Received', 'Vinay Ar has placed the order #9', '7', 1, '2020-05-03 19:41:23'),
(32, '26', 'Order Delivered', 'Order has been successfully delivered #9', '4-9-3', 1, '2020-05-03 19:43:05'),
(33, '27', 'User Rating', 'You received review from #Vinay Ar', '7-9-4', 1, '2020-05-03 19:43:28'),
(34, '26', 'User Rating', 'You received review from #Ashwini Kulkarni', '4-9-4', 1, '2020-05-03 19:43:58'),
(35, '27', 'Gig Request', 'New gig request received from #Vinay Ar', '1', 1, '2020-05-03 21:56:27'),
(36, '26', 'Offer Received', 'New Offer Received', '3', 1, '2020-05-03 22:07:51'),
(37, '27', 'Offer Accepted', 'Your offer accepted', '7', 1, '2020-05-03 22:08:49'),
(38, '26', 'Request Accepted', 'Your gig request accepted', '4', 1, '2020-05-03 22:09:21'),
(39, '26', 'Order Delivered', 'Order has been successfully delivered #10', '4-10-3', 1, '2020-05-03 22:10:18'),
(40, '26', 'Order Placed', 'New Order Placed #11', '4', 0, '2020-05-03 22:13:24'),
(41, '27', 'Order Received', 'Vinay Ar has placed the order #11', '7', 1, '2020-05-03 22:13:24'),
(42, '26', 'Time Requested', 'Seller requested time extension on your order', '4-11-3', 0, '2020-05-03 22:14:23'),
(43, '26', 'Order Delivered', 'Order has been successfully delivered #11', '4-11-3', 0, '2020-05-03 22:16:19'),
(44, '27', 'New Revision', 'Buyer requested revision on the order', '7-11-4', 0, '2020-05-03 22:16:56'),
(45, '26', 'User Rating', 'You received review from #Ashwini Kulkarni', '4-11-4', 0, '2020-05-03 22:17:26'),
(46, '26', 'Revision Accepted', 'Your revision request accepted #11', '4-11-4', 0, '2020-05-03 22:17:37'),
(47, '26', 'Order Delivered', 'Order has been successfully delivered #11', '4-11-3', 0, '2020-05-03 22:19:17'),
(48, '27', 'User Rating', 'You received review from #Vinay Ar', '7-11-4', 0, '2020-05-03 22:19:47'),
(49, '19', 'Order Placed', 'New Order Placed #12', '4', 1, '2020-05-07 04:07:35'),
(50, '27', 'Order Received', 'uniflyn Development buyer has placed the order #12', '7', 0, '2020-05-07 04:07:35'),
(51, '19', 'Order Placed', 'New Order Placed #13', '4', 1, '2020-05-07 04:15:37'),
(52, '18', 'Order Received', 'uniflyn Development buyer has placed the order #13', '7', 1, '2020-05-07 04:15:37'),
(53, '19', 'Time Requested', 'Seller requested time extension on your order', '4-13-3', 0, '2020-05-07 04:16:50'),
(54, '18', 'Time Request Accepted', 'Your time request accepted', '7-13-3', 1, '2020-05-07 04:17:25'),
(55, '5', 'Order Placed', 'New Order Placed #14', '4', 1, '2020-05-07 13:25:22'),
(56, '1', 'Order Received', 'Yahoo Dev has placed the order #14', '7', 0, '2020-05-07 13:25:22'),
(57, '5', 'Order Placed', 'New Order Placed #15', '4', 1, '2020-05-07 13:25:22'),
(58, '1', 'Order Received', 'Yahoo Dev has placed the order #15', '7', 0, '2020-05-07 13:25:22'),
(59, '1', 'New Comment', 'You have a new comment on your order', '7-14-3', 0, '2020-05-07 13:26:03'),
(60, '28', 'Account Confirmation', 'Welcome to Gig People !!!', '0', 1, '2020-05-12 18:15:37'),
(61, '29', 'Account Confirmation', 'Welcome to Gig People !!!', '0', 1, '2020-05-12 18:17:29'),
(62, '28', 'Gig Published', 'You have published a new gig', '2-37-2', 1, '2020-05-12 18:19:14'),
(63, '29', 'Order Placed', 'New Order Placed #16', '4', 1, '2020-05-12 18:21:25'),
(64, '28', 'Order Received', 'Seller Zzz has placed the order #16', '7', 1, '2020-05-12 18:21:25'),
(65, '29', 'Time Requested', 'Seller requested time extension on your order', '4-16-3', 1, '2020-05-12 19:44:41'),
(66, '29', 'Order Delivered', 'Order has been successfully delivered #16', '4-16-3', 1, '2020-05-12 20:06:22'),
(67, '28', 'User Rating', 'You received review from #Seller Zzz', '7-16-4', 0, '2020-05-12 20:07:13'),
(68, '29', 'User Rating', 'You received review from #Xyz Ddd', '4-16-4', 1, '2020-05-12 20:08:33'),
(69, '19', 'Order Placed', 'New Order Placed #17', '4', 0, '2020-05-13 20:21:15'),
(70, '18', 'Order Received', 'uniflyn Development buyer has placed the order #17', '7', 1, '2020-05-13 20:21:15'),
(71, '19', 'Order Placed', 'New Order Placed #18', '4', 0, '2020-05-13 20:27:30'),
(72, '18', 'Order Received', 'uniflyn Development buyer has placed the order #18', '7', 1, '2020-05-13 20:27:30'),
(73, '19', 'Order Delivered', 'Order has been successfully delivered #18', '4-18-3', 0, '2020-05-13 21:00:32'),
(74, '19', 'Time Requested', 'Seller requested time extension on your order', '4-17-3', 0, '2020-05-13 21:04:25'),
(75, '18', 'Time Request Accepted', 'Your time request accepted', '7-17-3', 1, '2020-05-13 21:19:09'),
(76, '30', 'Account Confirmation', 'Welcome to Gig People !!!', '0', 1, '2020-05-14 01:58:40'),
(77, '31', 'Account Confirmation', 'Welcome to Gig People !!!', '0', 1, '2020-05-14 01:59:53'),
(78, '30', 'Gig Published', 'You have published a new gig', '2-38-2', 1, '2020-05-14 02:03:18'),
(79, '31', 'Order Placed', 'New Order Placed #19', '4', 1, '2020-05-14 02:07:16'),
(80, '30', 'Order Received', 'Nan Buyer has placed the order #19', '7', 1, '2020-05-14 02:07:16'),
(81, '30', 'New Comment', 'You have a new comment on your order', '7-19-3', 1, '2020-05-14 02:07:24'),
(82, '30', 'New Comment', 'You have a new comment on your order', '7-19-3', 1, '2020-05-14 02:07:35'),
(83, '31', 'New Comment', 'You have a new comment on your order', '4-19-3', 1, '2020-05-14 02:08:19'),
(84, '31', 'Order Delivered', 'Order has been successfully delivered #19', '4-19-3', 1, '2020-05-14 02:08:45'),
(85, '31', 'User Rating', 'You received review from #Nan Seller', '4-19-4', 1, '2020-05-14 02:09:45'),
(86, '30', 'User Rating', 'You received review from #Nan Buyer', '7-19-4', 1, '2020-05-14 02:10:43'),
(87, '30', 'Gig Rating', 'You have received a feedback on order', '2-19-4', 1, '2020-05-14 02:11:18'),
(88, '32', 'Account Confirmation', 'Welcome to Gig People !!!', '0', 1, '2020-05-15 07:38:04'),
(89, '33', 'Account Confirmation', 'Welcome to Gig People !!!', '0', 1, '2020-05-15 07:46:42'),
(90, '32', 'Gig Published', 'You have published a new gig', '2-39-2', 0, '2020-05-15 07:48:21'),
(91, '33', 'Order Placed', 'New Order Placed #20', '4', 1, '2020-05-15 07:50:02'),
(92, '32', 'Order Received', 'Buyer Aaa has placed the order #20', '7', 0, '2020-05-15 07:50:07'),
(93, '33', 'Order Delivered', 'Order has been successfully delivered #20', '4-20-3', 1, '2020-05-15 07:51:04'),
(94, '32', 'User Rating', 'You received review from #Buyer Aaa', '7-20-4', 0, '2020-05-15 07:51:44'),
(95, '33', 'User Rating', 'You received review from #Ashwinii Kkkkkk', '4-20-4', 1, '2020-05-15 07:52:04'),
(96, '33', 'Order Placed', 'New Order Placed #21', '4', 1, '2020-05-15 08:08:14'),
(97, '32', 'Order Received', 'Buyer Aaa has placed the order #21', '7', 0, '2020-05-15 08:08:14'),
(98, '33', 'Order Delivered', 'Order has been successfully delivered #21', '4-21-3', 1, '2020-05-15 08:09:26'),
(99, '32', 'User Rating', 'You received review from #Buyer Aaa', '7-21-4', 0, '2020-05-15 08:10:02'),
(100, '33', 'User Rating', 'You received review from #Ashwinii Kkkkkk', '4-21-4', 1, '2020-05-15 08:10:32'),
(101, '32', 'Gig Published', 'You have published a new gig', '2-40-2', 0, '2020-05-15 08:12:11'),
(102, '33', 'Order Placed', 'New Order Placed #22', '4', 1, '2020-05-15 08:13:07'),
(103, '32', 'Order Received', 'Buyer Aaa has placed the order #22', '7', 0, '2020-05-15 08:13:07'),
(104, '33', 'Order Delivered', 'Order has been successfully delivered #22', '4-22-3', 1, '2020-05-15 08:13:47'),
(105, '32', 'User Rating', 'You received review from #Buyer Aaa', '7-22-4', 0, '2020-05-15 08:14:05'),
(106, '33', 'User Rating', 'You received review from #Ashwinii Kkkkkk', '4-22-4', 1, '2020-05-15 08:14:29'),
(107, '34', 'Account Confirmation', 'Welcome to Gig People !!!', '0', 0, '2020-05-16 00:54:41'),
(108, '31', 'Order Placed', 'New Order Placed #23', '4', 1, '2020-05-16 16:55:09'),
(109, '30', 'Order Received', 'Nan Buyer has placed the order #23', '7', 1, '2020-05-16 16:55:14'),
(110, '30', 'New Comment', 'You have a new comment on your order', '7-23-3', 1, '2020-05-16 16:55:41'),
(111, '31', 'New Comment', 'You have a new comment on your order', '4-23-3', 1, '2020-05-16 16:56:13'),
(112, '31', 'Order Delivered', 'Order has been successfully delivered #23', '4-23-3', 1, '2020-05-16 16:56:53'),
(113, '31', 'User Rating', 'You received review from #Nan Seller', '4-23-4', 1, '2020-05-16 16:58:28'),
(114, '30', 'User Rating', 'You received review from #Nan Buyer', '7-23-4', 0, '2020-05-16 21:37:05'),
(115, '30', 'Gig Rating', 'You have received a feedback on order', '2-23-4', 0, '2020-05-16 21:37:39'),
(116, '31', 'Order Placed', 'New Order Placed #24', '4', 1, '2020-05-16 21:40:12'),
(117, '30', 'Order Received', 'Nan Buyer has placed the order #24', '7', 0, '2020-05-16 21:40:12'),
(118, '30', 'New Comment', 'You have a new comment on your order', '7-24-3', 0, '2020-05-16 21:40:39'),
(119, '31', 'New Comment', 'You have a new comment on your order', '4-24-3', 1, '2020-05-16 21:41:07'),
(120, '31', 'Order Delivered', 'Order has been successfully delivered #24', '4-24-3', 1, '2020-05-16 21:42:07'),
(121, '31', 'User Rating', 'You received review from #Nan Seller', '4-24-4', 1, '2020-05-16 21:45:42'),
(122, '30', 'User Rating', 'You received review from #Nan Buyer', '7-24-4', 0, '2020-05-16 21:48:38'),
(123, '30', 'Gig Rating', 'You have received a feedback on order', '2-24-4', 0, '2020-05-16 21:50:01'),
(124, '31', 'Order Placed', 'New Order Placed #25', '4', 0, '2020-05-16 22:08:14'),
(125, '30', 'Order Received', 'Nan Buyer has placed the order #25', '7', 0, '2020-05-16 22:08:14'),
(126, '31', 'Offer Received', 'New Offer Received', '3', 0, '2020-05-25 19:39:59'),
(127, '30', 'Offer Accepted', 'Your offer accepted', '7', 0, '2020-05-25 20:16:40'),
(128, '31', 'Order Placed', 'New Order Placed #27', '4', 0, '2020-05-25 20:20:54'),
(129, '18', 'Order Received', 'Nan Buyer has placed the order #27', '7', 0, '2020-05-25 20:20:54'),
(130, '31', 'Order Placed', 'New Order Placed #28', '4', 0, '2020-05-25 20:24:51'),
(131, '18', 'Order Received', 'Nan Buyer has placed the order #28', '7', 0, '2020-05-25 20:24:51'),
(132, '35', 'Account Confirmation', 'Welcome to Gig People !!!', '0', 1, '2020-05-26 19:31:02'),
(133, '35', 'Gig Published', 'You have published a new gig', '2-41-2', 1, '2020-05-26 19:50:36'),
(134, '36', 'Account Confirmation', 'Welcome to Gig People !!!', '0', 1, '2020-05-27 12:53:11'),
(135, '35', 'Offer Received', 'New Offer Received', '3', 1, '2020-05-27 12:57:51'),
(136, '35', 'Offer Received', 'New Offer Received', '3', 1, '2020-05-27 12:58:07'),
(137, '18', 'Gig Request', 'New gig request received from #Ali Qureshi', '1', 0, '2020-05-27 13:09:55'),
(138, '11', 'Gig Request', 'New gig request received from #Ali Qureshi', '1', 0, '2020-05-27 13:09:55'),
(139, '5', 'Gig Request', 'New gig request received from #Ali Qureshi', '1', 0, '2020-05-27 13:09:55'),
(140, '36', 'Offer Rejected', 'Your offer rejected by buyer', '1', 1, '2020-05-27 13:30:16'),
(141, '35', 'Offer Received', 'New Offer Received', '3', 1, '2020-06-01 06:11:53'),
(142, '36', 'Offer Accepted', 'Your offer accepted', '7', 1, '2020-06-01 06:18:27'),
(143, '35', 'Request Accepted', 'Your gig request accepted', '4', 1, '2020-06-01 06:26:00'),
(144, '35', 'Order Delivered', 'Order has been successfully delivered #29', '4-29-3', 1, '2020-06-01 06:27:26'),
(145, '36', 'New Revision', 'Buyer requested revision on the order', '7-29-4', 1, '2020-06-01 06:29:24'),
(146, '35', 'Revision Accepted', 'Your revision request accepted #29', '4-29-4', 1, '2020-06-01 06:30:24'),
(147, '36', 'New Comment', 'You have a new comment on your order', '7-29-3', 1, '2020-06-01 06:34:44'),
(148, '35', 'Order Delivered', 'Order has been successfully delivered #29', '4-29-3', 1, '2020-06-01 06:39:40'),
(149, '36', 'Order Dispute', 'Your Order is disputed #29', '7-29-4', 1, '2020-06-01 06:43:31');

-- --------------------------------------------------------

--
-- Table structure for table `offer_sent`
--

CREATE TABLE `offer_sent` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deliver_time` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `description` text NOT NULL,
  `offer_status` int(11) NOT NULL COMMENT '0-New/Waiting,1-Accepted,2-Rejected',
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6),
  `updated_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offer_sent`
--

INSERT INTO `offer_sent` (`id`, `request_id`, `user_id`, `deliver_time`, `price`, `description`, `offer_status`, `created_at`, `updated_at`) VALUES
(1, 1, 27, 1, 26.00, '??', 0, '2020-05-03 22:07:51.000000', '2020-05-03 09:37:51.899285'),
(2, 2, 30, 5, 100.00, 'T the first one to one of the most important thing', 0, '2020-05-25 19:39:59.000000', '2020-05-25 07:09:59.789028'),
(3, 3, 36, 10, 1.00, 'i will do it for you.ok ok', 2, '2020-05-27 01:00:16.597737', '2020-05-27 13:30:16.000000'),
(4, 4, 36, 3, 1.00, 'i will do it for you', 0, '2020-06-01 06:11:53.000000', '2020-05-31 17:41:53.810122');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1.Gig,2.Request',
  `product_id` int(11) NOT NULL,
  `delivery_time` int(11) NOT NULL,
  `time_extension` int(11) NOT NULL,
  `time_status` int(11) NOT NULL COMMENT '1.Accept, 2.Rejected',
  `time_description` text NOT NULL,
  `price` double(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost` double(10,2) NOT NULL,
  `shipping_cost` double(10,2) NOT NULL,
  `final_cost` double(10,2) NOT NULL,
  `payment_option` text NOT NULL,
  `payment_id` text NOT NULL,
  `attachment` text NOT NULL,
  `project_description` text NOT NULL,
  `description` text NOT NULL,
  `cancel_reason` text NOT NULL,
  `order_status` int(11) NOT NULL COMMENT '0.New, 1.Gig Request Seller Accepted, 2.Gig Request Seller Rejected, 3.Order Started, 4.Order Completed, 5.Order Delivered, 6.Seller Order Cancelled, 7.Buyer Order Cancelled',
  `wallet_status` int(11) NOT NULL COMMENT '0.No, 1.Yes',
  `company_amount` double(10,2) NOT NULL,
  `user_amount` double(10,2) NOT NULL,
  `total_amount` double(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `started_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delivered_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `completed_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cancelled_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `seller_id`, `buyer_id`, `type`, `product_id`, `delivery_time`, `time_extension`, `time_status`, `time_description`, `price`, `quantity`, `total_cost`, `shipping_cost`, `final_cost`, `payment_option`, `payment_id`, `attachment`, `project_description`, `description`, `cancel_reason`, `order_status`, `wallet_status`, `company_amount`, `user_amount`, `total_amount`, `created_at`, `updated_at`, `started_at`, `delivered_at`, `completed_at`, `cancelled_at`) VALUES
(1, 5, 20, 1, 32, 10, 0, 0, '', 2000.00, 5, 10000.00, 0.00, 10000.00, '', '', '', '', '', '', 3, 0, 0.00, 0.00, 0.00, '2020-04-29 03:56:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 22, 25, 1, 30, 1, 0, 0, '', 15.00, 1, 15.00, 5.00, 20.00, '', '', '', '', 'jjj', '', 3, 0, 0.00, 0.00, 0.00, '2020-04-29 04:02:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 11, 25, 1, 13, 5, 0, 0, '', 100.00, 1, 100.00, 5.00, 105.00, '', '', '', '', 'ted', '', 3, 0, 0.00, 0.00, 0.00, '2020-04-29 04:06:33', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 5, 25, 1, 4, 25, 0, 0, '', 1250.00, 1, 1250.00, 50.00, 1300.00, '', '', '', '', 'y', '', 3, 0, 0.00, 0.00, 0.00, '2020-04-29 04:06:33', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 11, 25, 1, 13, 5, 0, 0, '', 100.00, 1, 100.00, 5.00, 105.00, '', '', '', '', 'hy', '', 3, 0, 0.00, 0.00, 0.00, '2020-04-29 04:07:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 5, 20, 1, 4, 25, 0, 0, '', 1250.00, 3, 3750.00, 50.00, 3800.00, '', '', '', '', '', '', 3, 0, 0.00, 0.00, 0.00, '2020-04-29 04:07:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 18, 25, 1, 19, 30, 0, 0, '', 300.00, 1, 300.00, 30.00, 330.00, '', '', '', '', 'uj', '', 3, 0, 0.00, 0.00, 0.00, '2020-04-29 18:19:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 27, 26, 1, 36, 1, 2, 2, 'complex', 10.00, 1, 10.00, 0.00, 10.00, '', '', '', '', 'draw image', '', 4, 0, 0.00, 0.00, 0.00, '2020-05-03 06:55:13', '2020-05-03 19:19:37', '0000-00-00 00:00:00', '2020-05-03 19:25:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 27, 26, 1, 36, 1, 0, 0, '', 10.00, 1, 10.00, 0.00, 10.00, '', '', '', '', '\nnew', '', 4, 0, 0.00, 0.00, 0.00, '2020-05-03 07:13:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2020-05-03 19:43:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 27, 26, 2, 1, 0, 0, 0, '', 26.00, 2, 26.00, 0.00, 26.00, '1', 'PAYID-L2XJCHY54856955B3826512D', '', '', '', '', 4, 0, 0.00, 0.00, 0.00, '2020-05-03 09:40:18', '2020-05-03 22:09:21', '0000-00-00 00:00:00', '2020-05-03 22:10:18', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 27, 26, 1, 36, 1, 3, 1, 'fd', 10.00, 1, 10.00, 0.00, 10.00, '', '', '', '', 'fffff', '', 4, 0, 0.00, 0.00, 0.00, '2020-05-03 09:49:17', '2020-05-03 22:17:37', '0000-00-00 00:00:00', '2020-05-03 22:19:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 27, 19, 1, 36, 1, 0, 0, '', 10.00, 1, 10.00, 0.00, 10.00, '', '', '', '', 'tttttttt', '', 3, 0, 0.00, 0.00, 0.00, '2020-05-07 04:07:35', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 18, 19, 1, 27, 30, 6, 2, 'I need time ', 400.00, 1, 400.00, 40.00, 440.00, '', '', '', '', 'Test', '', 3, 0, 0.00, 0.00, 0.00, '2020-05-06 15:47:25', '2020-05-07 04:17:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 1, 5, 1, 2, 10, 0, 0, '', 200.00, 1, 200.00, 0.00, 200.00, '', '', '', '', 'g', '', 3, 0, 0.00, 0.00, 0.00, '2020-05-07 13:25:22', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 1, 5, 1, 1, 15, 0, 0, '', 165.00, 1, 165.00, 5.00, 170.00, '', '', '', '', 'ttt', '', 3, 0, 0.00, 0.00, 0.00, '2020-05-07 13:25:22', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 28, 29, 1, 37, 1, 2, 1, 'ssss', 50.00, 1, 50.00, 0.00, 50.00, '', '', '', '', '1st order', '', 4, 0, 0.00, 0.00, 0.00, '2020-05-12 07:36:22', '2020-05-12 19:44:41', '0000-00-00 00:00:00', '2020-05-12 20:06:22', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 18, 19, 1, 27, 30, 8, 2, 'Seller ask time extention  notification ', 400.00, 1, 400.00, 40.00, 440.00, '', '', '', '', 'Order notification  to buyer', '', 3, 0, 0.00, 0.00, 0.00, '2020-05-13 08:49:09', '2020-05-13 21:19:09', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 18, 19, 1, 19, 30, 0, 0, '', 300.00, 1, 300.00, 30.00, 330.00, '', '', '', '', 'Notification', '', 4, 0, 0.00, 0.00, 0.00, '2020-05-13 08:30:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2020-05-13 21:00:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 30, 31, 1, 38, 8, 0, 0, '', 100.00, 1, 100.00, 10.00, 110.00, '', '', '', '', 'I am going to order seo gig', '', 4, 0, 0.00, 0.00, 0.00, '2020-05-13 13:38:45', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2020-05-14 02:08:45', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 32, 33, 1, 39, 2, 0, 0, '', 5.00, 1, 5.00, 0.00, 5.00, '', '', '', '', 'fff', '', 4, 0, 0.00, 0.00, 0.00, '2020-05-14 19:20:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2020-05-15 07:50:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 32, 33, 1, 39, 2, 0, 0, '', 5.00, 1, 5.00, 0.00, 5.00, '', '', '', '', '2', '', 4, 0, 0.00, 0.00, 0.00, '2020-05-14 19:39:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2020-05-15 08:09:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 32, 33, 1, 40, 3, 0, 0, '', 5.00, 1, 5.00, 0.00, 5.00, '', '', '', '', 'dddd', '', 4, 0, 0.00, 0.00, 0.00, '2020-05-14 19:43:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2020-05-15 08:13:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 30, 31, 1, 38, 8, 0, 0, '', 100.00, 1, 100.00, 10.00, 110.00, '', '', '', '', 'The', '', 4, 0, 0.00, 0.00, 0.00, '2020-05-16 04:26:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2020-05-16 16:56:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 30, 31, 1, 38, 8, 0, 0, '', 100.00, 1, 100.00, 10.00, 110.00, '', '', '', '', 'T the first one to one of the most important thing', '', 4, 0, 0.00, 0.00, 0.00, '2020-05-16 09:12:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2020-05-16 21:42:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 30, 31, 1, 38, 8, 0, 0, '', 100.00, 1, 100.00, 10.00, 110.00, '', '', '', '', 'Yyyyyyyyyyyu', '', 3, 0, 0.00, 0.00, 0.00, '2020-05-16 22:08:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 30, 31, 2, 2, 0, 0, 0, '', 100.00, 5, 100.00, 0.00, 100.00, '3', 'tok_1Gmb19GZ6k3FCItCcV7tPreE', '', '', '', '', 1, 0, 0.00, 0.00, 0.00, '2020-05-25 20:16:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 18, 31, 1, 19, 30, 0, 0, '', 300.00, 1, 300.00, 30.00, 330.00, '', '', '', '', 'Tes', '', 3, 0, 0.00, 0.00, 0.00, '2020-05-25 20:20:54', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 18, 31, 1, 19, 30, 0, 0, '', 300.00, 1, 300.00, 30.00, 330.00, '', '', '', '', 'Hhhh', '', 3, 0, 0.00, 0.00, 0.00, '2020-05-25 20:24:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 36, 35, 2, 4, 0, 0, 0, '', 1.00, 1, 1.00, 0.00, 1.00, '3', 'tok_1GovGoGZ6k3FCItCvMZDaEvV', '', '', '', '', 4, 0, 0.00, 0.00, 0.00, '2020-05-31 18:09:40', '2020-06-01 06:30:24', '0000-00-00 00:00:00', '2020-06-01 06:39:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_delivery`
--

CREATE TABLE `order_delivery` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1.Image, 2.Video',
  `thumb` text NOT NULL,
  `project` text NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_delivery`
--

INSERT INTO `order_delivery` (`id`, `user_id`, `buyer_id`, `order_id`, `type`, `thumb`, `project`, `description`, `status`, `created_at`) VALUES
(1, 27, 26, 8, 1, '', '1588444200.jpg', 'test', 0, '2020-05-03 19:25:13'),
(2, 27, 26, 9, 1, '', '15884442001.jpg', 'ghhhh', 0, '2020-05-03 19:43:05'),
(3, 27, 26, 10, 1, '', '15884442002.jpg', 'fhgg', 0, '2020-05-03 22:10:18'),
(4, 27, 26, 11, 1, '', '15884442004.jpg', 'ssd', 0, '2020-05-03 22:16:19'),
(5, 27, 26, 11, 1, '', '15884442005.jpg', 'gjvh', 0, '2020-05-03 22:19:17'),
(6, 28, 29, 16, 1, '', '1589221800.jpg', 'delivery', 0, '2020-05-12 20:06:22'),
(7, 18, 19, 18, 1, '', '1589308200.jpg', 'Order delivery notification test', 0, '2020-05-13 21:00:32'),
(8, 30, 31, 19, 1, '', '15893082001.jpg', 'T the first one to one of the most important thing is that the first one to one of ', 0, '2020-05-14 02:08:45'),
(9, 32, 33, 20, 1, '', '1589481000.jpg', 'gggg', 0, '2020-05-15 07:50:54'),
(10, 32, 33, 21, 1, '', '15894810001.jpg', 'hhh', 0, '2020-05-15 08:09:26'),
(11, 32, 33, 22, 1, '', '15894810002.jpg', 'ggg', 0, '2020-05-15 08:13:47'),
(12, 30, 31, 23, 1, '', '1589567400.jpg', 'I deliver the oroduct', 0, '2020-05-16 16:56:53'),
(13, 30, 31, 24, 1, '', '15895674001.jpg', 'T the first one to one of ', 0, '2020-05-16 21:42:07'),
(14, 36, 35, 29, 1, '', '1590863400.jpg', 'i hve done the task please check \n', 0, '2020-06-01 06:27:26'),
(15, 36, 35, 29, 1, '', '15908634001.jpg', 'done', 0, '2020-06-01 06:39:40');

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE `order_history` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `history_type` int(11) NOT NULL COMMENT '1.Message, 2.Order Deliverd, 3.Feedback, 4.Revision, 5.Cancelled, 6.Dispute, 7.Admin',
  `details` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0.waiting, 1.Accept, 2.Rejected',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_history`
--

INSERT INTO `order_history` (`id`, `order_id`, `from_user_id`, `history_type`, `details`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 25, 1, '{\"from\":\"25\",\"to\":\"22\",\"message\":\"ywywyw\",\"is_date\":\"2020-04-28 21:03:55\"}', 0, '2020-04-29 04:03:55', '0000-00-00 00:00:00'),
(2, 4, 25, 4, 'hhh', 1, '2020-04-29 04:07:39', '0000-00-00 00:00:00'),
(3, 3, 25, 4, 'hello', 1, '2020-04-29 18:20:34', '0000-00-00 00:00:00'),
(4, 11, 26, 2, '{\"from\":\"26\",\"to\":\"27\",\"message\":\"rwvision\",\"is_date\":\"2020-05-03 15:16:56\"}', 1, '2020-05-03 09:47:37', '2020-05-03 22:17:37'),
(5, 14, 5, 1, '{\"from\":\"5\",\"to\":\"1\",\"message\":\"hi\",\"is_date\":\"2020-05-07 06:26:03\"}', 0, '2020-05-07 13:26:03', '0000-00-00 00:00:00'),
(6, 19, 31, 1, '{\"from\":\"31\",\"to\":\"30\",\"message\":\"Hi\",\"is_date\":\"2020-05-13 19:07:24\"}', 0, '2020-05-14 02:07:24', '0000-00-00 00:00:00'),
(7, 19, 31, 1, '{\"from\":\"31\",\"to\":\"30\",\"message\":\"Hello\",\"is_date\":\"2020-05-13 19:07:35\"}', 0, '2020-05-14 02:07:35', '0000-00-00 00:00:00'),
(8, 19, 30, 1, '{\"from\":\"30\",\"to\":\"31\",\"message\":\"Hello\",\"is_date\":\"2020-05-13 19:08:19\"}', 0, '2020-05-14 02:08:19', '0000-00-00 00:00:00'),
(9, 23, 31, 1, '{\"from\":\"31\",\"to\":\"30\",\"message\":\"Hi I ordered gig\",\"is_date\":\"2020-05-16 09:55:36\"}', 0, '2020-05-16 16:55:36', '0000-00-00 00:00:00'),
(10, 23, 30, 1, '{\"from\":\"30\",\"to\":\"31\",\"message\":\"I am going  to deliver\",\"is_date\":\"2020-05-16 09:56:13\"}', 0, '2020-05-16 16:56:13', '0000-00-00 00:00:00'),
(11, 24, 31, 1, '{\"from\":\"31\",\"to\":\"30\",\"message\":\"Hhhhh\",\"is_date\":\"2020-05-16 14:40:39\"}', 0, '2020-05-16 21:40:39', '0000-00-00 00:00:00'),
(12, 24, 30, 1, '{\"from\":\"30\",\"to\":\"31\",\"message\":\"Tttt\",\"is_date\":\"2020-05-16 14:40:57\"}', 0, '2020-05-16 21:40:57', '0000-00-00 00:00:00'),
(13, 29, 35, 2, '{\"from\":\"35\",\"to\":\"36\",\"message\":\"can you test it again\",\"is_date\":\"2020-05-31 23:29:24\"}', 1, '2020-05-31 18:00:24', '2020-06-01 06:30:24'),
(14, 29, 35, 1, '{\"from\":\"35\",\"to\":\"36\",\"message\":\"good work \",\"is_date\":\"2020-05-31 23:34:44\"}', 0, '2020-06-01 06:34:44', '0000-00-00 00:00:00'),
(15, 29, 35, 3, '{\"from\":\"35\",\"to\":\"36\",\"message\":\"cant do good work \",\"is_date\":\"2020-05-31 23:43:31\"}', 0, '2020-06-01 06:43:31', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `promotion_banners`
--

CREATE TABLE `promotion_banners` (
  `id` int(11) NOT NULL,
  `banner_image` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0-active/1-inactive',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promotion_banners`
--

INSERT INTO `promotion_banners` (`id`, `banner_image`, `status`, `created_at`, `updated_at`) VALUES
(1, '1567728000.jpg', 1, '2019-09-06 14:08:09', '2019-09-06 07:08:09'),
(2, '1567728000.png', 2, '2019-10-23 07:15:24', '2019-10-23 19:45:24'),
(3, '15677280001.jpg', 2, '2019-10-23 07:15:39', '2019-10-23 19:45:39'),
(4, '15677280002.jpg', 2, '2019-10-23 07:15:32', '2019-10-23 19:45:32'),
(5, '15677280003.jpg', 2, '2019-10-23 07:15:15', '2019-10-23 19:45:15'),
(6, '15677280004.jpg', 2, '2019-10-23 07:16:14', '2019-10-23 19:46:14'),
(7, '15677280005.jpg', 1, '2019-09-06 14:10:04', '2019-09-06 07:10:04'),
(8, '15677280006.jpg', 1, '2019-12-08 01:49:27', '2019-12-08 14:19:27'),
(9, '15678144001.jpg', 2, '2019-10-23 07:16:00', '2019-10-23 19:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `subcategory` int(11) NOT NULL,
  `image` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `deliverytime` int(11) NOT NULL,
  `description` text NOT NULL,
  `request_status` int(11) NOT NULL COMMENT '0.New Post, 1.Offer Accepted, 2.Offer Rejected, 3-Offer Send',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `user_id`, `seller_id`, `category`, `subcategory`, `image`, `quantity`, `price`, `deliverytime`, `description`, `request_status`, `created_at`, `updated_at`) VALUES
(1, 26, 27, 1, 13, '1588444200.jpg', 2, 25.00, 2, 'fgh', 1, '2020-05-03 09:38:49', '2020-05-03 22:08:49'),
(2, 31, 30, 9, 106, '1590345000.jpg', 5, 100.00, 8, 'The The most popular properties for the most ', 1, '2020-05-25 07:46:40', '2020-05-25 20:16:40'),
(3, 35, 0, 9, 106, '15905178001.jpg,15905178002.jpg', 1, 1.00, 9, 'i will add any art for you ', 0, '2020-05-26 22:46:26', '2020-05-27 11:16:26'),
(4, 35, 36, 9, 106, '15905178003.jpg', 1, 1.00, 12, 'okkkkkkkkkk', 1, '2020-05-31 17:48:27', '2020-06-01 06:18:27');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `gigs_id` int(11) NOT NULL,
  `order_rating` int(11) NOT NULL,
  `order_review` text NOT NULL,
  `order_date` datetime NOT NULL,
  `buyer_rating` int(11) NOT NULL COMMENT 'buyer given to seller',
  `buyer_review` text NOT NULL COMMENT 'buyer given to seller',
  `seller_rating` int(11) NOT NULL COMMENT 'seller given to buyer',
  `seller_review` text NOT NULL COMMENT 'seller given to buyer',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `order_id`, `buyer_id`, `seller_id`, `gigs_id`, `order_rating`, `order_review`, `order_date`, `buyer_rating`, `buyer_review`, `seller_rating`, `seller_review`, `created_at`, `updated_at`) VALUES
(1, 8, 26, 27, 36, 1, 'Super!!!', '0000-00-00 00:00:00', 4, 'happy', 5, 'good job', '2020-05-06 12:02:14', '2020-05-03 19:26:46'),
(2, 9, 26, 27, 36, 0, '', '0000-00-00 00:00:00', 2, 'bad', 3, 'good', '2020-05-03 07:13:58', '2020-05-03 19:43:58'),
(3, 11, 26, 27, 36, 0, '', '0000-00-00 00:00:00', 4, 'dddd', 1, 'poir', '2020-05-03 09:49:47', '2020-05-03 22:19:47'),
(4, 16, 29, 28, 37, 0, '', '0000-00-00 00:00:00', 4, 'good', 3, 'not bad', '2020-05-12 07:38:33', '2020-05-12 20:08:33'),
(5, 19, 31, 30, 38, 4, 'Good gig', '0000-00-00 00:00:00', 4, 'Good buyer', 3, 'Good seller', '2020-05-13 13:41:18', '2020-05-14 02:11:18'),
(6, 20, 33, 32, 39, 0, '', '0000-00-00 00:00:00', 4, '4 stars', 3, '3 stars given', '2020-05-14 19:22:04', '2020-05-15 07:52:04'),
(7, 21, 33, 32, 39, 0, '', '0000-00-00 00:00:00', 1, 'bad', 5, '5 stars', '2020-05-14 19:40:32', '2020-05-15 08:10:32'),
(8, 22, 33, 32, 40, 0, '', '0000-00-00 00:00:00', 4, 'gggg', 1, 'bbb', '2020-05-14 19:44:19', '2020-05-15 08:14:19'),
(9, 23, 31, 30, 38, 4, 'Good gig1', '0000-00-00 00:00:00', 2, 'Good buyer1', 3, 'Good seller1', '2020-05-16 09:07:39', '2020-05-16 21:37:39'),
(10, 24, 31, 30, 38, 2, 'Good gig2', '0000-00-00 00:00:00', 5, 'Good buyer2', 2, 'Good seller2', '2020-05-16 09:20:01', '2020-05-16 21:50:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `app_user`
--
ALTER TABLE `app_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favouritelist`
--
ALTER TABLE `favouritelist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gig_list`
--
ALTER TABLE `gig_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `help`
--
ALTER TABLE `help`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer_sent`
--
ALTER TABLE `offer_sent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_delivery`
--
ALTER TABLE `order_delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotion_banners`
--
ALTER TABLE `promotion_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_user`
--
ALTER TABLE `app_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `favouritelist`
--
ALTER TABLE `favouritelist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `gig_list`
--
ALTER TABLE `gig_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `help`
--
ALTER TABLE `help`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `offer_sent`
--
ALTER TABLE `offer_sent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `order_delivery`
--
ALTER TABLE `order_delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_history`
--
ALTER TABLE `order_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `promotion_banners`
--
ALTER TABLE `promotion_banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
