-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: hobort-db-1.cqu4fxffaity.us-east-2.rds.amazonaws.com
-- Generation Time: Oct 18, 2020 at 05:02 AM
-- Server version: 10.3.13-MariaDB-log
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hobort_shipping_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `adminUserID` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Active, 0:Inactive',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`adminUserID`, `name`, `email`, `password`, `avatar`, `status`, `updated_at`, `created_at`) VALUES
(2, 'Admin', 'admin@hobortshipping.com', '$2y$10$Y..DQrwnoMtsnqvP6Dp4ROUU3VlrrByaBlxvyGQWk3paeANZj0Vhq', 'PGDcpkMnR5AsSHuK.jpeg', 1, '2020-07-03 00:00:00', '2020-07-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `air_freight_items`
--

CREATE TABLE `air_freight_items` (
  `airFreightItemID` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Active, 2:Deleted',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `air_freight_items`
--

INSERT INTO `air_freight_items` (`airFreightItemID`, `title`, `status`, `updated_at`, `created_at`) VALUES
(1, 'Furniture', 2, '2020-07-10 08:41:45', '2020-07-10 08:41:32'),
(2, 'Furniture	', 2, '2020-07-10 09:01:32', '2020-07-10 08:42:19'),
(4, 'Furniture1', 2, '2020-07-10 09:01:40', '2020-07-10 09:01:40'),
(5, 'Furniture	', 1, '2020-07-10 11:43:28', '2020-07-10 10:21:38'),
(6, 'computer	', 1, '2020-09-28 11:04:09', '2020-07-10 10:21:52'),
(7, 'computer', 2, '2020-07-10 11:42:53', '2020-07-10 10:37:48'),
(8, 'Laptop	', 2, '2020-07-10 12:03:02', '2020-07-10 12:03:02'),
(9, 'Laptop	', 1, '2020-09-28 11:04:02', '2020-07-10 12:28:14'),
(10, 'Furniture', 2, '2020-07-11 09:07:54', '2020-07-11 05:43:34');

-- --------------------------------------------------------

--
-- Table structure for table `air_freight_order_info`
--

CREATE TABLE `air_freight_order_info` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `length` float NOT NULL,
  `height` float NOT NULL,
  `width` float NOT NULL,
  `weight` float NOT NULL,
  `volumetric_weight` float NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_value` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `air_freight_order_info`
--

INSERT INTO `air_freight_order_info` (`order_id`, `length`, `height`, `width`, `weight`, `volumetric_weight`, `item_id`, `item_value`) VALUES
(12, 23, 45, 54, 67, 4654.5, 6, '2'),
(18, 12, 45, 54, 56, 2428.44, 6, '5'),
(21, 12, 45, 45, 67, 2023.7, 5, '1'),
(24, 23, 44, 44, 44, 3708.28, 5, '5'),
(31, 35, 55, 55, 55, 8817.24, 6, '5'),
(35, 23, 45, 55, 55, 4740.7, 9, '5');

-- --------------------------------------------------------

--
-- Table structure for table `air_freight_services`
--

CREATE TABLE `air_freight_services` (
  `airFreightServiceID` int(10) UNSIGNED NOT NULL,
  `weight_from` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight_to` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'NULL for no end point',
  `price` decimal(8,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Active, 2:Deleted',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `air_freight_services`
--

INSERT INTO `air_freight_services` (`airFreightServiceID`, `weight_from`, `weight_to`, `price`, `status`, `updated_at`, `created_at`) VALUES
(1, '1', '10', '3.00', 1, '2020-07-24 05:27:45', '2020-07-10 13:15:11'),
(2, '11', '20', '5.00', 1, '2020-07-11 05:44:25', '2020-07-11 05:44:25'),
(3, '21', '30', '10.00', 1, '2020-07-11 14:40:15', '2020-07-11 05:48:27'),
(4, '31', '40', '15.00', 1, '2020-07-11 14:40:27', '2020-07-11 14:40:27'),
(6, '41', '50', '20.00', 1, '2020-07-24 06:17:27', '2020-07-24 06:17:27'),
(7, '51', '60', '25.00', 1, '2020-07-24 06:17:48', '2020-07-24 06:17:48'),
(8, '61', '70', '30.00', 1, '2020-07-24 06:18:10', '2020-07-24 06:18:10'),
(9, '71', '80', '35.00', 1, '2020-07-24 06:18:32', '2020-07-24 06:18:32'),
(10, '81', '90', '40.00', 1, '2020-07-24 06:19:00', '2020-07-24 06:19:00'),
(11, '91', '100', '45.00', 1, '2020-07-24 06:19:29', '2020-07-24 06:19:29'),
(12, '101', NULL, '85.00', 1, '2020-07-24 06:36:57', '2020-07-24 06:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `concierge_quotes`
--

CREATE TABLE `concierge_quotes` (
  `conciergeQuoteID` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_cost` decimal(8,2) DEFAULT NULL,
  `concierge_fee` decimal(8,2) DEFAULT NULL,
  `offer_price` decimal(8,2) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Pending, 2:Offer Sent, 3:Accepted, 4:Declined',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `concierge_quotes`
--

INSERT INTO `concierge_quotes` (`conciergeQuoteID`, `user_id`, `description`, `order_cost`, `concierge_fee`, `offer_price`, `status`, `updated_at`, `created_at`) VALUES
(3, 50, 'The definition of an order is a position, rank or arrangement of people or things. An example of order is people being served food according to when they arrived in a restaurant. An example of order is the names of fruit being listed by where their first letter occurs in the alphabet.', '100.00', '5.00', '105.00', 3, '2020-09-15 07:27:11', '2020-09-15 06:21:07'),
(4, 5, 'Hello,\r\nNeed to delivery some products.', '120.00', '130.00', '250.00', 3, '2020-09-15 07:09:24', '2020-09-15 06:42:49'),
(8, 39, 'The definition of an order is a position, rank or arrangement of people or things. An example of order is people being served food according to when they arrived in a restaurant. An example of order is the names of fruit being listed by where their first letter occurs in the alphabet.\r\n', '1.50', '5.00', '6.50', 3, '2020-09-15 10:47:32', '2020-09-15 10:43:35'),
(9, 39, 'JavaScript’ warning in Google PageSpeed Insights by deferring non-critical JavaScript(s). The newer version of Google PageSpeed Insight refers to this issue as ‘Eliminate render-blocking resources’; these render-blocking resources may include JavaScripts and CSS.', '6.00', '7.00', '13.00', 3, '2020-09-15 11:04:50', '2020-09-15 10:56:50'),
(10, 39, 'hello  this is my order', '1.50', '5.00', '6.50', 3, '2020-09-17 14:18:20', '2020-09-15 11:54:39'),
(12, 67, 'for concierge Shipping discount check', '1.50', '5.00', '5.85', 2, '2020-09-22 08:28:58', '2020-09-22 08:28:37'),
(13, 68, 'gbhbjknk jnkmlk, knmlkm,l, ', '10.00', '2.38', '11.14', 4, '2020-09-22 09:27:17', '2020-09-22 09:23:41'),
(14, 39, 'discount for concierge shipping', '4.50', '1.00', '4.95', 3, '2020-09-23 09:29:58', '2020-09-22 12:43:17'),
(15, 53, 'zXzsczs bfbfg', '1.50', '67.00', '68.50', 3, '2020-09-23 10:16:50', '2020-09-23 10:16:27'),
(16, 39, 'dswcdferdfvgrd fdvgdfgbftrb grgtrgyrt6', '5.00', '6.00', '11.00', 3, '2020-10-15 16:57:13', '2020-10-15 16:56:31');

-- --------------------------------------------------------

--
-- Table structure for table `courier_services`
--

CREATE TABLE `courier_services` (
  `courierServiceID` int(10) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Active, 2:Deleted',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courier_services`
--

INSERT INTO `courier_services` (`courierServiceID`, `title`, `price`, `status`, `updated_at`, `created_at`) VALUES
(1, ' Tattoo CT New', '5.00', 2, '2020-07-10 09:03:21', '2020-07-10 09:02:46'),
(2, 'Furniture	', '5.00', 2, '2020-07-10 10:28:34', '2020-07-10 10:28:34'),
(3, 'Furniture	', '5.00', 2, '2020-07-10 10:29:17', '2020-07-10 10:29:02'),
(4, 'Furniture1', '78.00', 1, '2020-07-10 12:08:27', '2020-07-10 10:29:28'),
(5, 'Furniture	', '5.00', 2, '2020-07-10 12:08:33', '2020-07-10 12:08:33'),
(6, 'Furniture	', '10.90', 1, '2020-07-11 09:06:49', '2020-07-10 12:08:59'),
(7, 'Furniture	', '5.00', 2, '2020-07-10 12:29:41', '2020-07-10 12:29:41');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `inquiryID` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inquiries`
--

INSERT INTO `inquiries` (`inquiryID`, `full_name`, `email`, `subject`, `message`, `created_at`) VALUES
(2, 'neha', 'nehasharmamindiii@gmail.com', 'email testing', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content', '2020-09-08 13:45:47'),
(3, 'neha', 'nehasharma@gmail.com', 'testing', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look li', '2020-09-08 13:58:35'),
(4, 'shikha', 'shikha@gmail.com', 'email testing', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look', '2020-09-08 13:59:23'),
(5, 'shikha', 'shikha@gmail.com', 'email testing', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here', '2020-09-08 14:00:07'),
(6, 'Manish Pareek', 'manish.mindiii@gmail.com', 'What kind of platform is it?', 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here\', content here.', '2020-09-08 14:33:42'),
(7, 'Manish', 'manish.mindiii@gmail.com', 'The help', 'This is for Testing', '2020-09-08 14:36:42'),
(8, 'mindiiisystems', 'neha@gmail.com', 'email testing', 'desfrgry', '2020-09-08 15:09:51'),
(9, 'rdh', 'nehasharmamindiii@gmail.com', 'hfhtjh', 'fesfegreyrty6tu6', '2020-09-09 04:55:34'),
(10, 'ramraj', 'admin@stars.app', 'We are demo subject', 'fdggdg', '2020-09-09 04:59:12'),
(11, 'neha', 'nehasharmamindiii@gmail.com', 'email testing', 'dsafesgrgthytjyuykukiul', '2020-09-09 05:09:53'),
(12, 'Manish pareek', 'manish.mindiii@gmail.com', 'Hello I need help!', 'I need to ship my vehicle.', '2020-09-09 05:36:21');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `optionID` int(10) UNSIGNED NOT NULL,
  `option_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `option_value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`optionID`, `option_name`, `option_value`, `created_at`, `updated_at`) VALUES
(1, 'terms_content', '<p><strong>By using Hobort Services, you agree to these conditions. Please read them carefully.</strong></p>\r\n\r\n<p><strong>INTRODUCTION</strong></p>\r\n\r\n<p>A) These terms and conditions (&ldquo;terms&rdquo;) set out the basis on which HOBORT will transport packages, documents and envelopes (&ldquo;packages&rdquo;) and palletized goods (&ldquo;pallets&rdquo;; pallets and packages are together &ldquo;shipments&rdquo;). These terms are supplemented by the current applicable HOBORT Service and Tariff Guide (&ldquo;the Guide&rdquo;). The Guide contains important details about the services of HOBORT which the shipper should read and which form part of the agreement between HOBORT and the shipper.</p>\r\n\r\n<p>B) In these terms, &ldquo;Waybill&rdquo; shall mean a single HOBORT waybill/consignment note or the entries recorded against the same date, address and service level on a collection record. All packages or pallets covered under a Waybill shall be considered a single shipment.</p>\r\n\r\n<p><strong>SERVICES</strong></p>\r\n\r\n<p>The Service enables you to make purchases from the United States of America (and such other countries as may be notified by Hobort from time to time) using&nbsp; &nbsp; &nbsp;a personalized physical address in the respective country (&ldquo;HOBORT Access point&rdquo;). On delivery of the purchased item to the respective Shop and move&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Location, Hobort will process the Shipment and arrange for delivery of the item to the address and country stated in the Application Form (&ldquo;Delivery Address&rdquo;).&nbsp; &nbsp; &nbsp;Shipments cannot be delivered to Post Office box address.</p>\r\n\r\n<p><strong>REGISTRATION AND APPOINTMENT OF HOBORT AS YOUR AGENT</strong></p>\r\n\r\n<p>To register for the Service, you will need to complete the Shop and move Application Form (&ldquo;Application Form&rdquo;) and set up an Account on the Website for free.</p>\r\n\r\n<p>Registration for access to the Service is open to individuals who are 18 years of age or older (or the legal age of majority in your country). By registering for our Service you are appointing Hobort as your agent for the receipt of, and organization of transportation for, your packages and you authorize Hobort to receive any and all packages addressed to you that are delivered to the respective Shop and move Location. Scope of Service</p>\r\n\r\n<p>Unless any special services are agreed, and subject to these terms, the service to be provided by HOBORT is limited to the collection, transportation, customs clearance where applicable, and delivery of the shipment. HOBORT is not a common carrier and reserves the right in its absolute discretion to refuse carriage to any shipment tendered to it for transportation.</p>\r\n\r\n<p><strong>1. CONDITIONS OF CARRIAGE</strong></p>\r\n\r\n<p>This section sets out various restrictions and conditions which apply to the carriage of shipments by HOBORT. It&nbsp;also explains what the consequences are of the shipper presenting shipments for carriage which do not meet&nbsp;these requirements. 3.1 Service Restrictions and Conditions</p>\r\n\r\n<p>Shipments must comply with the restrictions in paragraphs (i) to (iii) below.</p>\r\n\r\n<p>(i) Shipments must not contain any of the prohibited articles listed in the Guide including (but not limited to) articles of unusual value (such as works of art, antiques, precious stones, stamps, unique items, gold or silver), money or negotiable instruments (such as cheques, bills of exchange, bonds, savings books, pre-paid credit cards, share certificates or other securities), firearms and dangerous goods</p>\r\n\r\n<p>(ii) Shipments must not contain goods which might endanger human or animal life or any means of transportation, or which might otherwise taint or damage other goods being transported by HOBORT, or the carriage, export or import of which is prohibited by applicable law.</p>\r\n\r\n<p>(iii) Pallets must be palletized, stackable, and able to be lifted by forklift, and shrink-wrapped or banded to a skid. The shipper shall be responsible for the accuracy and completeness of the particulars inserted in the Waybill and for ensuring that all shipments set out adequate contact details for the shipper and receiver of the shipment and that they are so packed, marked and labelled, their contents so described and classified and are accompanied by&nbsp;such documentation as may (in each case) be necessary to make them suitable for transportation and to comply with the requirements of the Guide and applicable law. The shipper guarantees that all shipments presented for carriage under these terms comply with the restrictions in paragraphs (I) to (iii) above and have been prepared in secure premises, by him (in the case of an individual shipper) or by reliable staff employed by him or (where different) by the party tendering the shipment to HOBORT and have been protected against unauthorized interference during their preparation, storage and transportation to HOBORT. HOBORT relies on this guarantee in accepting any shipment for carriage hereunder.</p>\r\n\r\n<p>1.1 Refusal and Suspension of Carriage (i) If it comes to the attention of HOBORT that any shipment does not meet any of the above restrictions or conditions, HOBORT may refuse to transport the relevant shipment (or any relevant part thereof) and, if carriage is in progress, HOBORT may suspend carriage and hold the shipment (or any relevant part thereof) to the shipper&rsquo;s order.</p>\r\n\r\n<p>(ii) HOBORT may also suspend carriage if it cannot effect delivery, if the receiver refuses to accept delivery, if it is unable to effect delivery because of an incorrect address (having used all reasonable means to find the correct address) or because the correct address is found to be in another country from that set out on the shipment or on the Waybill or if it cannot collect amounts due from the receiver on delivery.</p>\r\n\r\n<p>(iii) Where HOBORT is entitled to suspend carriage of a shipment (or any relevant part thereof), it is also entitled to return it to the shipper at its own discretion.</p>\r\n\r\n<p>1.2 The shipper must pay and indemnify HOBORT for any reasonable costs and expenses (including storage), incurred by HOBORT, any losses, taxes and customs duties HOBORT may incur and all claims made against HOBORT because (i) a shipment does not meet any of the restrictions, conditions or representations in paragraph 1.1 above (ii) of any refusal or suspension of carriage or return of a shipment (or part thereof) by HOBORT which is allowed by this paragraph 1., or (iii) of a failure by the shipper to comply with these terms. In the case of the return of a package or shipment (or part thereof), the shipper will also be responsible for paying all applicable charges calculated in accordance with the prevailing commercial rates of HOBORT.</p>\r\n\r\n<p>1.3 If the shipper tenders to HOBORT a shipment which fails to comply with any of the restrictions or conditions in paragraph 1.1 above without HOBORT &rsquo;s express written consent, HOBORT will not meet any loss howsoever arising which the shipper may suffer in connection with the carriage by HOBORT of such shipment (regardless of whether that failure to comply has caused or contributed to the loss and notwithstanding any negligence on the part of HOBORT or its employees, contractors or representatives) and, if HOBORT does suspend carriage for a reason allowed by these terms, the shipper shall not be entitled to any refund on the carriage charges it has paid. HOBORT may bring a claim in respect of such non-compliance.</p>\r\n\r\n<p>1.4 If, having suspended carriage of a shipment (or any relevant part thereof) in accordance with these provisions, HOBORT is unable within a reasonable time to obtain the shipper&rsquo;s instructions on its disposition or to identify the shipper or any other person entitled to the goods (having if necessary opened the shipment), HOBORT shall be entitled to destroy or sell the shipment (or any relevant part thereof), at its absolute discretion. The proceeds of any such sale shall first be applied to any charges, costs or expenses (including interest) outstanding in respect of the shipment or otherwise from the shipper concerned. Any balance shall be held to the shipper&rsquo;s order.</p>\r\n\r\n<p>1.5 Unless prohibited by law, HOBORT reserves the right, but is not obliged, to open and inspect or scan by means of x-ray any shipment tendered to it for transportation at any time.</p>\r\n\r\n<p><strong>2. Customs Clearance</strong></p>\r\n\r\n<p>When a shipment requires customs clearance, it is the shipper&rsquo;s obligation to provide, or to ensure that the receiver will provide, HOBORT with complete and accurate documentation for the purpose but HOBORT will, unless instructed otherwise, act on behalf, at the expense and at the risk of the shipper or receiver in obtaining customs clearance. Provided that, in the case of shipments whose points of dispatch and destination are both within the same customs area, HOBORT only performs customs clearance if instructed to do so. The shipper also agrees that HOBORT may be considered as being the receiver of the package or the shipment for the sole purpose of appointing a customs broker to carry out any customs clearance insofar as is allowed by law.</p>\r\n\r\n<p><strong>3. Payment</strong></p>\r\n\r\n<p>3.1 The rates for carriage and other services are set out by HOBORT and, unless paid before shipment, all charges must be paid within the stipulated time after receipt of invoice or within such other period as the shipper may have agreed in writing with HOBORT. HOBORT may verify the actual and/or dimensional weight of shipments and, if greater than the declared weight, invoice on such basis.</p>\r\n\r\n<p>3.2 If a) HOBORT is required to pay any taxes, duties or levies on behalf of the shipper, receiver or a third party, b) the selected billing option indicates that the receiver or a third party should pay any charges, or (c) any taxes, duties, penalties, charges or expenses are imposed, rightly or wrongly by government authorities, or incurred by HOBORT due to any circumstances, including any failure by the shipper or the receiver to provide correct information and&nbsp;documentation or any permits or licenses required in connection with carriage, the shipper shall be jointly and severally liable to HOBORT with the receiver and such third parties for such amounts. In each case where the selected billing option indicates payment is to be charged, at first, to the receiver or any third party, HOBORT will (without prejudice to the shipper&rsquo;s contractual liability for payment), first demand payment of the relevant amount from the receiver and/or, where applicable, the third party. If the amount in question is not immediately paid to HOBORT in full by any of the above parties, the amount will be payable by the shipper on first written demand. In any other cases, the shipper hereby undertakes to pay the mentioned amounts to HOBORT at first request. HOBORT shall not be obliged to separately file a claim against the receiver or any third party for payment. In case of doubt, the burden of proving that the amount has been paid lies on the shipper.</p>\r\n\r\n<p>3.3 If any sum is not paid by the shipper, receiver or some other party under the agreed terms, HOBORT may hold any shipments it is carrying (or part thereof) until it receives payment in full or may sell them and use the proceeds to make good the debt to it in accordance with applicable local law. Any unpaid balance will remain payable.</p>\r\n\r\n<p><strong>4. Interruption of Service</strong></p>\r\n\r\n<p>If HOBORT is unable to start or continue with carriage of the shipper&rsquo;s shipment for a reason beyond its control, HOBORT will not be in breach of its agreement with the shipper but will take all steps that are reasonably practicable in the circumstances to commence or continue the carriage. Examples of events beyond HOBORT &rsquo;s control are disruption to air or sea transportation due to bad weather, fire, flood, war, hostilities, civil disturbance, acts of government or other authorities (including, without limitation, customs) and labor disputes or obligations affecting HOBORT or some other party</p>\r\n\r\n<p>HOBORT does not accept responsibility for any currency exchange risks.</p>\r\n\r\n<p>4.1 The shipper will indemnify HOBORT for all losses, expenses, and any claims made against HOBORT by the receiver or a third party, arising where HOBORT does not deliver a shipment because the receiver does not pay the COD amount in the appropriate form or refuses to accept the shipment.</p>\r\n\r\n<p>4.2 The liability of HOBORT in respect of the amount to be collected shall not exceed either the applicable maximum amount collectible under these terms or the COD amount indicated on the Waybill, whichever is the lesser. Further, the COD amount shall not in any event exceed the value of the goods at their destination plus applicable carriage charges.</p>\r\n\r\n<p>HOBORT does not accept any responsibility for any dishonest or fraudulent acts on behalf of the receiver including, but not limited to, presenting fraudulent cheques or one which is later dishonored, or for cheques incorrectly completed by the receiver.</p>\r\n\r\n<p><strong>5. Liability</strong></p>\r\n\r\n<p>5.1 Where the Warsaw or CMR Conventions or any national laws implementing or adopting these conventions apply (for convenience referred to as Convention Rules) or where (and to the extent that) other mandatory national law applies, the liability of HOBORT is governed by and will be limited according to the applicable rules.</p>\r\n\r\n<p>5.2 Where Convention Rules or other mandatory national laws do not apply, HOBORT will only be liable for failure to act with reasonable care and skill and its liability shall be exclusively governed by these terms and (save in the case of personal injury or death) limited to proven damages not exceeding the greater of either:</p>\r\n\r\n<p><strong>6. Delivery</strong></p>\r\n\r\n<p>HOBORT may deliver a shipment to the receiver or to any other person appearing to have authority to accept delivery of the shipment on the receiver&rsquo;s behalf, if suitable, unless the shipper has excluded such delivery options by using the applicable additional service. The receiver shall be informed of any alternate delivery arrangements (or redirection to a HOBORT Access Point&reg;)</p>\r\n\r\n<p>Notwithstanding the previous paragraph, andunless otherwise agreed with the shipper, HOBORT may apply any alternative delivery methods chosen by the receiver in accordance with the HOBORT My Choice&reg; Service Terms or any other agreement between HOBORT and the receiver. Such alternative delivery methods include, without limitation, redirecting delivery of a package to an alternate address (including a HOBORT Access Point), authorizing the driver to leave a package at the receiver&rsquo;s premises, modifying a service selected by the shipper or, rescheduling delivery. The shipper also agrees the receiver may receive delivery information regarding a package. The shipper expressly waives any claim it may have against HOBORT arising from HOBORT following any such instructions provided by the receiver.</p>\r\n\r\n<p>HOBORT may use an electronic device to obtain proof of delivery and the shipper agrees that it will not object to HOBORT relying on a printed copy of this as evidence merely on the grounds that the information concerned is obtained and stored in electronic form.</p>\r\n\r\n<p>Save where Convention Rules or other mandatory national laws require otherwise, HOBORT accepts no responsibility in any circumstances to suspend carriage, redirect delivery (whether to a different receiver or address from that named on the Waybill) or return a shipment to its shipper and, in the event that it should attempt but fail to do so, shall have no liability for any losses thereby occasioned.</p>\r\n\r\n<p><strong>7. Data Protection</strong></p>\r\n\r\n<p>7.1 HOBORT has the right to process data provided by the shipper or receiver in connection with carriage by HOBORT, to transfer such data to other group companies and contractors of HOBORT, including in other countries which may not have the same level of data protection as the country where the shipment is presented to HOBORT, and to have it processed there if and to the extent the transfer and processing of the data in such countries is required for performing the agreed shipment services. The shipper warrants that it (i) has obtained personal data the shipper provided to HOBORT for the shipment lawfully, (ii) is authorized to provide such data to HOBORT if and to the extent the transfer and processing of the data in such countries is required for performing the agreed shipment services, and (iii) has obtained informed and specific consent from such receiver that HOBORT may send e-mail and other notifications related to the agreed shipment services to the receiver. HOBORT uses the Shipper&rsquo;s personal data provided by the shipper in accordance with the HOBORT Privacy Notice published on HOBORT&rsquo;s web site.</p>\r\n\r\n<p>7.2 Furthermore, the Shipper warrants that he has obtained informed and specific consent from the receiver that HOBORT may use the receiver&rsquo;s personal data in accordance with the above linked HOBORT Privacy Notice in effect at the time of shipping with regard to uses other than those specified in subsection 11.1 above.</p>\r\n\r\n<p><strong>8. Claims Procedure &ndash; Prescription</strong></p>\r\n\r\n<p>All claims against HOBORT must be notified in writing as soon as reasonably practicable and in any event s of receipt in the case of damage (including partial loss of a shipment),. In addition, all claims against HOBORT in connection with any shipment shall be prescribed and barred by expiration of time, unless legal proceedings are brought and written notice of them is given to HOBORT. This term shall not affect any rights the shipper may have under Convention Rules or other mandatory national laws.</p>\r\n\r\n<p><strong>9. Entire Agreement &amp; Severability</strong></p>\r\n\r\n<p>It is the intention of HOBORT that all the terms of the contract between it and the shipper are contained in this document and in the Guide. If the shipper wishes to rely on any variation to these terms, it must ensure that that is recorded in writing and signed by the shipper and on behalf of HOBORT before the shipment is accepted for carriage by HOBORT. If any part of these terms is not enforceable, this will not affect the enforceability of any other part.</p>\r\n\r\n<p><strong>10. Governing Law</strong></p>\r\n\r\n<p>These terms shall be governed by the laws of the country where the shipment is presented to HOBORT for carriage.</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2020-04-03 14:30:32', '2020-08-17 10:22:01'),
(2, 'privacy_content', '<p>We at Hobort Shipping., along with our subsidiaries and affiliates (collectively, &quot;HOBORT&quot;), respect your concerns about privacy. ABC</p>\r\n\r\n<p>This Privacy Notice describes the types of personal information we collect about consumers, how we may use the information and with whom we may share it. The notice also describes the measures we take to safeguard the personal information. In addition, we tell you how you can ask us to<br />\r\n(i) access or change the personal information we maintain about you,<br />\r\n(ii) Withdraw consent you previously provided to us<br />\r\n(iii) refrain from sending you certain communications<br />\r\n(iv) Answer questions you may have about our privacy practices.</p>\r\n\r\n<p><strong>Information We Obtain</strong></p>\r\n\r\n<p>We may obtain consumer personal information (such as name, contact details and payment information) in connection with various activities such as<br />\r\n(i) use of the HOBORT websites and applications<br />\r\n(ii) shipping activities, including delivery and pick-up of shipments<br />\r\n(iii) Requests to track shipments or answer questions<br />\r\n(iv) Events in which we participate<br />\r\n(v) Promotions and other offers<br />\r\n(vi) Calls placed with customer service and accounting centers which may be recorded.</p>\r\n\r\n<p>The types of personal information we may obtain include:</p>\r\n\r\n<ul>\r\n	<li>Individual and business contact information (such as name, company name, physical address, email address&nbsp; and telephone or fax number)</li>\r\n	<li>Shipping information (such as (i) shipping-related contact details like the sender&#39;s, and consignee&#39;s name, physical address, email address and telephone number, (ii) signature for proof of delivery, (iii) HOBORT account number, and (iv) information given to us that helps us access locations to which we provide service) and information provided to us regarding the content of certain shipments, but only to the extent an identifiable person can be linked to such content.</li>\r\n	<li>Information that enables us to verify an individual&#39;s identity</li>\r\n	<li>Names, email addresses and telephone numbers of others to whom we are asked to send information</li>\r\n	<li>Information provided in response to surveys</li>\r\n	<li>Username, password and other credentials used to access HOBORT products and services</li>\r\n	<li>Social media handles, content and other data posted on our official social media pages or elsewhere on the Internet (such as other public locations), and information (such as email address and other information you<br />\r\n	allow to be shared) we obtain through HOBORT-related social media apps, tools, widgets and plug-ins (including third-party login services such as &quot;Login with Facebook&quot;)</li>\r\n	<li>The geographic location of your mobile device if you use certain features of our apps</li>\r\n	<li>Payment information (including payment card details or online payment services number and invoicing address) and financial information (such as bank account numbers)</li>\r\n	<li>Tax identification number in circumstances in which you request products or services for which this information is required, or in connection with certain promotions or prize draws</li>\r\n	<li>Other personal information that may be provided to us to obtain a HOBORT product or service</li>\r\n</ul>\r\n\r\n<p>We also receive consumer personal information from our customers in order to perform services. We may receive personal information from third parties, including public databases, social media platforms, or third party partners such as analytics or marketing providers.</p>\r\n\r\n<p>When we pick up or deliver a shipment or provide other services, we may obtain physical location data. This includes, for example, data identifying the actual location of a physical address using information such as GPS data, geocodes, latitude and longitude information, and images of the various locations.</p>\r\n\r\n<p>In addition, when you visit our websites, use our apps, or interact with HOBORT-related tools, widgets or plug-ins, we may collect certain information by automated means, such as cookies and web beacons. The information we collect in this manner includes IP address, unique device identifier, browser characteristics, device characteristics, operating system, language preferences, referring URLs, information on actions taken, and dates and times of activity. A&quot;cookie&quot; is a text file that websites send to a visitor&#39;s computer or other Internet -connected device to uniquely identify the visitor&#39;s browser or to store information or settings in the browser. A &quot;web beacon&quot; also known as an Internet tag, pixel tag or clear GIF, links web pages or apps to web servers and may be used to transmit information back to a web server. Through these automated collection methods, we obtain and store &ldquo;clickstream&rdquo; data to tell us usage patterns. We may link certain data elements we have collected through automated means, such as your browser information, with other information we have obtained about you to let us know, for example, whether you have opened an email we sent to you. We also may use third-party analytics tools that collect information about visitor traffic on our websites or apps. Your browser may tell you how to be notified when you receive certain types of cookies or how to restrict or disable certain types of cookies. Please note, however, that without cookies you may not be able to use all the features of our websites or apps. Both we and others (such as our advertising networks) may collect personal information about our visitors&#39; online activities, over time and across third-party websites, when using our websites and apps. The providers of third-party apps, tools, widgets and plug-ins on our websites and apps, such as Facebook &quot;Like&quot; button, also may use automated means to collect information regarding your interactions with these features. This information is subject to the privacy policies or notices of these providers.</p>\r\n\r\n<p><strong>How We Use the Information We Obtain</strong></p>\r\n\r\n<p>We may use the information we obtain to:</p>\r\n\r\n<ul>\r\n	<li>Pick up, deliver and track shipments</li>\r\n	<li>Provide products and services you request (such as logistics, supply chain management, customs clearance and brokerage services, and financial services)</li>\r\n	<li>Process and collect payments</li>\r\n	<li>Provide customer support and respond to and communicate with you about your requests, questions and comments</li>\r\n	<li>Send you tracking updates (from HOBORT and/or our business partners) and help you select convenient delivery options</li>\r\n	<li>Establish and manage your HOBORT account (including your online account on HOBORT.com and its various&nbsp;features, such as the address book and the HOBORT Billing Centre)</li>\r\n	<li>Offer you products and services we believe may interest you</li>\r\n	<li>Communicate about, and administer your participation in, special events, programmes, surveys, contests, prize draws and other offers or promotions</li>\r\n	<li>Enable you to post on our blogs and interact with HOBORT through social media</li>\r\n	<li>Send information to your contacts if you ask us to do so</li>\r\n	<li>Process claims we receive in connection with our services</li>\r\n	<li>Operate, evaluate and improve our business (including developing new products and services; managing our communications; determining the effectiveness of our sales, marketing and advertising; analysing and enhancing our products, services, websites and apps; ensuring the security of our networks and information systems; performing accounting, auditing, invoicing, reconciliation and collection activities; and improving and<br />\r\n	maintaining the quality of our customer services)</li>\r\n	<li>Perform data analyses (including market and consumer search and analytics, trend analysis and profiling, financial analysis and anonymisation of personal information)</li>\r\n	<li>Protect against, identify and prevent fraud and other prohibited or illegal activity, claims and other liabilities</li>\r\n	<li>Comply with applicable legal requirements and our policies</li>\r\n	<li>Establish, exercise and defend legal claims</li>\r\n	<li>Monitor and report compliance issues</li>\r\n</ul>\r\n\r\n<p>In addition, we use information collected online through cookies, web beacons and other automated means for purposes such as (i) customising our users&#39; visits to our websites and apps, (ii) delivering content (including advertising) tailored to our users&#39; interests and the manner in which our users browse our websites and apps, and (iii) managing our business. We may supplement data we collect through automated means with information about your location (such as your<br />\r\npostcode) to provide you with content that may be of interest to you. We also use this information to help d iagnose technical and service problems, administer our websites and apps, identify users of our websites and apps, and gather demographic information about our users. We use clickstream data to determine usage patterns and how we may tailor our websites and apps to better meet the needs of our users. Our websites and apps are not designed to respond to<br />\r\n&quot;do not track&quot; requests from browser</p>\r\n\r\n<p><strong>Interest-Based Advertising</strong></p>\r\n\r\n<p>On our websites and apps, we may collect information about your online activities for use in providing you with advertising about products and services tailored to your individual interests. This section of our Privacy Notice provides details and explains how to exercise your choices.</p>\r\n\r\n<p>You may see certain ads on other websites because we may participate in advertising networks. Ad networks allow us to target our messaging to users through demographic, interest-based and contextual means. These networks track your online activities over time by collecting information through automated means, including through the use of cookies, web server logs and web beacons. The networks use this information to show you advertisements that may be tailored to your individual interests. The information our ad networks may collect includes information about your visi ts to websites that participate in the relevant advertising networks, such as the pages or advertisements you view and the actions you take on the websites. This data collection takes place both on our websites and on third-party websites that participate in the ad networks. This process also helps us track the effectiveness of our marketing efforts. To learn how to opt out of this ad network interest-based advertising.</p>\r\n\r\n<p><strong>Information We Share</strong></p>\r\n\r\n<p>We do not sell or otherwise share personal information about you, except as described in this Privacy Notice. To perform our delivery services, we may share shipping information with third parties such as senders, consignees, third party payers and recipients. We also share personal information with third parties who perform services on our behalf based on our instructions. These third parties are not authorized by us to use or disclose the information except as necessary<br />\r\nto perform services on our behalf or comply with legal requirements.</p>\r\n\r\n<p>We also may share the personal information we obtain with our affiliates, franchisees, resellers and joint marketing partners. These entities, which collectively are referred to here as the &quot;HOBORT Business Partners&quot;, may use the information for the purposes described in this Privacy Notice. We may share physical location data with our HOBORT Business Partners and other third parties to, for example, enhance location-based services and develop accurate and up-to-date maps. In addition, except as described below, unless you object, we may share other personal information with third parties who are not HOBORT Business Partners for those parties&#39; own purposes, such as to offer products or services that may interest you.</p>\r\n\r\n<p>Information collected through third-party apps, tools, widgets and plug-ins (such as information obtained through third-party login services or relating to your use of a Facebook &quot;Like&quot; button) is collected directly by the providers of these features. This information is subject to the privacy policies of the providers of the features, and HOBORT is not responsible for those providers&#39; information practices.</p>\r\n\r\n<p>Many of our customers outsource all or a part of their supply chains to us. Through our forwarding and logistics business units, we manage these supply chains, focusing on supply chain optimization, freight forwarding and international trade and brokerage services for our customers worldwide (including a broad range of transportation s olutions such as air and ocean freight). We also provide information technology systems and distribution facilities adapted to the unique supply chains of specific industries such as health care, technology and consumer/retail businesses. In the course ofproviding forwarding and logistics services, we may obtain, use and disclose personal information about our customers&#39; customers. In these circumstances, we process the information based on the agreement with our customer. We also may disclose information about you (i) if we are required to do so by law, regulation or legal process (such as a court order or subpoena), (ii) in response to requests by government agencies, such as law enforcement authorities, or (iii) when we believe disclosure is necessary or appropriate to prevent ph ysical harm or financial loss or in connection with an investigation of suspected or actual illegal activity. We reserve the right to transfer any information we have about you in the event we sell or transfer all or a portion of our business or assets (including in the event of a reorganization, dissolution or liquidation).</p>\r\n\r\n<p><strong>Your Options</strong></p>\r\n\r\n<p>We offer you certain choices about how we communicate with you and what information we collect from you. You may choose not to receive marketing email communications from us by clicking on the unsubscribe link in our marketing emails, selecting the Email Unsubscribe link, adjusting your email preferences in your profile in My HOBORT, or contacting us as specified in the &quot;How To Contact Us&quot; section below. You also may ask us not to send you other marketing communications by contacting us as specified in the &quot;How To Contact Us&quot; section below, and we will honour your request. Consistent with the choices available in the &quot;Information We Share&quot; section, you may withdraw your consent or object to certain information sharing by selecting the Privacy Preferences Centre link or by contacting us as indicated below. In addition, as required by law, you may object at any time on legitimate grounds and free of charge to the processing of your personal information, and we will apply your preferences going forward.</p>\r\n\r\n<p><strong>Access and Correction</strong></p>\r\n\r\n<p>Subject to applicable law, (i) you may obtain a copy of certain personal information we maintain about you or update or correct inaccuracies in that information through your My HOBORT account on Hobortshipping.com or (ii) you may have the right to obtain access to personal information we maintain about you by contacting us as indicated in the &quot;How To Contact Us&quot; section of this Privacy Notice. To help protect your privacy and maintain security, we will take steps to verify your identity and/or may ask you to provide other details before granting you access to the information. In addition, if you believe that personal information we maintain about you is inaccurate, subject to applicable law, you may have the right to request that we correct or amend the information by contacting us as indicated.</p>\r\n\r\n<p><strong>Non-HOBORT Places and Services</strong></p>\r\n\r\n<p>For your convenience and information our websites and apps may contain links to non-HOBORT places that may be operated by companies not affiliated with HOBORT. These companies may have their own privacy policies or notices, which we strongly suggest you review. Our services also may be made available to you through third -party platforms (such as providers of app stores) or through other third-party channels. We are not responsible for the privacy practices<br />\r\nof any non-HOBORT places or services.</p>\r\n\r\n<p><strong>Data Transfers</strong></p>\r\n\r\n<p>We may transfer the personal information we collect about you to countries other than the country in which the information originally was collected. Those countries may not have the same data protection laws as the country in which you initially provided the information.</p>\r\n\r\n<p>When we transfer your personal information to other countries, we will protect that information as described in this Privacy Notice and in accordance with applicable law. We use contractual protections for the transfer of personal information among various jurisdictions.</p>\r\n\r\n<p><strong>How We Protect Personal Information</strong></p>\r\n\r\n<p>We maintain administrative, technical and physical safeguards designed to protect the personal information you provide against accidental, unlawful or unauthorised destruction, loss, alteration, access, disclosure or use. Although we take steps to limit access to our facilities to authorised individuals, information that is located on the outside of a package may be visible to others.</p>\r\n\r\n<p><strong>Updates To Our Privacy Notice</strong></p>\r\n\r\n<p>This Privacy Notice may be updated periodically and without prior notice to you to reflect changes in our personal information practices. We will post a prominent notice on our websites to notify you of any significant changes to our Privacy Notice and indicate at the top of the notice when it was most recently updated</p>\r\n\r\n<p><strong>How To Contact Us</strong></p>\r\n\r\n<p>If you have any questions or comments about this Privacy Notice, or if you would like us to update information we have about you or your preferences, please contact us by email using the Email Application</p>\r\n', '2020-04-03 14:30:47', '2020-08-19 06:40:12');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderID` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_type` tinyint(4) NOT NULL COMMENT '1:Air Freight, 2:Sea, 3:Courier, 4:Concierge, 5:My Shipment',
  `service_id` int(11) DEFAULT NULL,
  `concierge_quote_id` int(11) DEFAULT NULL COMMENT 'For Concierge Quotes only',
  `quantity` int(10) UNSIGNED NOT NULL,
  `order_cost` decimal(8,2) DEFAULT NULL COMMENT 'For Concierge Quotes only',
  `concierge_fee` decimal(8,2) DEFAULT NULL COMMENT 'For Concierge Quotes only',
  `price` decimal(8,2) NOT NULL,
  `tracking_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `drop_location` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipper_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipper_tracking_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipper_company_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipper_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipment_receiver_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'For My Shipment Quotes only',
  `shipment_origin` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'For My Shipment Quotes only',
  `shipment_value` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'For My Shipment Quotes only',
  `shipment_tracking_ids` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'For My Shipment Quotes only | Comma separated IDs',
  `shipment_weight` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'For My Shipment Quotes only',
  `receipt_file` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt_mime_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'image/jpeg, image/png etc',
  `receipt_file_extension` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'jpg, jpeg, png, pdf, docx etc..',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:New, 2:Pending/Approved, 3:Shipped by Customer, 4:Received from customer, 5:Packed, 6:On the way, 7:Delivered',
  `status_updated_at` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dynamic_link` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Firebase short/dynamic link',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderID`, `user_id`, `service_type`, `service_id`, `concierge_quote_id`, `quantity`, `order_cost`, `concierge_fee`, `price`, `tracking_id`, `drop_location`, `shipper_name`, `shipper_tracking_id`, `shipper_company_name`, `shipper_description`, `shipment_receiver_name`, `shipment_origin`, `shipment_value`, `shipment_tracking_ids`, `shipment_weight`, `receipt_file`, `receipt_mime_type`, `receipt_file_extension`, `status`, `status_updated_at`, `dynamic_link`, `updated_at`, `created_at`) VALUES
(3, 5, 4, NULL, 4, 0, '120.00', '130.00', '250.00', 'HS-TRCKID-143039925', 'bhopal', 'TT Conc Mail', 'TT24334FGH', 'Sam Couriers', 'Account to identify you and allow access to AmazDescription is the pattern of narrative development that aims to make vivid a place, object, character, or group. Description is one of four rhetorical modes, along with exposition, argumentation, and narration. In practice it would be difficult to write literature that drew on just one of the four basic modes on Web Services. Your use of this site is governed by our policies.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, '{\"approved_at\":\"2020-09-24 06:11:58\",\"shipped_by_customer_at\":\"2020-10-16 06:29:23\",\"received_from_customer_at\":\"2020-10-16 06:30:31\",\"packed_at\":\"2020-10-16 06:30:37\",\"on_the_way_at\":\"2020-10-16 06:30:42\",\"delivered_at\":\"2020-10-16 06:30:49\"}', 'https://hobortdev.page.link/bES7', '2020-10-16 06:30:49', '2020-09-15 07:09:24'),
(13, 39, 4, NULL, 10, 0, '1.50', '5.00', '6.50', 'Concierge123457', 'indore', 'shikha sharma', '1234567', 'hobort shipping', 'Cost of order: $1.50 Concierge Fee: $5.00 Total: $6.50 Description\r\nhello  this is my order\r\n', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, '{\"approved_at\":\"2020-09-17 14:19:13\",\"shipped_by_customer_at\":\"2020-09-17 14:20:51\",\"received_from_customer_at\":\"2020-09-17 14:21:20\",\"packed_at\":\"2020-09-17 14:21:30\",\"on_the_way_at\":\"2020-09-17 14:21:42\",\"delivered_at\":\"2020-09-17 14:21:50\"}', 'https://hobortdev.page.link/o5ZX', '2020-09-17 14:21:50', '2020-09-17 14:18:20'),
(14, 39, 2, 1, NULL, 1, NULL, NULL, '4.50', 'sea256', '59 ujjain road dewas ', 'swati sharma', 'sea1234', 'hobort shipping', 'cszcdsgfdhgtfhjy hgtjygkjyu', NULL, NULL, NULL, NULL, NULL, 'pWOEb78DZfdyXzJn.png', 'image/png', 'png', 7, '{\"approved_at\":\"2020-09-17 14:23:34\",\"shipped_by_customer_at\":\"2020-09-17 14:24:01\",\"received_from_customer_at\":\"2020-09-18 09:15:09\",\"packed_at\":\"2020-09-18 09:15:19\",\"on_the_way_at\":\"2020-09-18 09:15:27\",\"delivered_at\":\"2020-09-18 09:15:34\"}', 'https://hobortdev.page.link/VQTx', '2020-09-18 09:15:34', '2020-09-17 14:22:20'),
(15, 53, 2, 1, NULL, 1, NULL, NULL, '4.50', 'sea456', '59 ujjain road  in front of GDC collage Dewas', 'shikha sharma', 'a8959556645', 'hobort shipping', 'If you feel content, you\'re satisfied and happy. The content of a book, movie, or song is what it\'s about: the topic. This word has two main meanings. The first has to do with being pleased and satisfied (feeling content) or making someone else feel happy and at peace with things (contenting them).\r\n', NULL, NULL, NULL, NULL, NULL, 'cbixN0URodHtPEOp.png', 'image/png', 'png', 7, '{\"approved_at\":\"2020-09-18 12:59:55\",\"shipped_by_customer_at\":\"2020-09-18 13:03:50\",\"received_from_customer_at\":\"2020-09-18 13:04:35\",\"packed_at\":\"2020-09-18 13:04:43\",\"on_the_way_at\":\"2020-09-18 13:05:31\",\"delivered_at\":\"2020-09-18 13:05:44\"}', 'https://hobortdev.page.link/9d37', '2020-09-18 13:05:44', '2020-09-18 12:58:01'),
(16, 39, 3, 4, NULL, 1, NULL, NULL, '70.20', 'cou12345', 'dewas', 'shikha sharma', '123498', 'hobort shipping', ': Furniture1 - $78.00\r\nPrice : $70.20\r\nQuantity: 1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, '{\"approved_at\":\"2020-09-21 05:15:51\",\"shipped_by_customer_at\":\"2020-09-21 05:16:31\",\"received_from_customer_at\":\"2020-09-21 05:16:54\",\"packed_at\":\"2020-09-21 05:17:00\",\"on_the_way_at\":\"2020-09-21 05:17:05\",\"delivered_at\":\"2020-09-21 05:17:10\"}', 'https://hobortdev.page.link/JsZE', '2020-09-21 05:17:10', '2020-09-18 13:06:40'),
(28, 39, 2, 1, NULL, 1, NULL, NULL, '5.00', '345678', '59 ujjain road dewas ', 'swati sharma', 'sea1234fgr', 'hobort shipping', 'grthtyhjyutjuyk hthytjuy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, '{\"approved_at\":\"2020-09-23 09:48:05\",\"shipped_by_customer_at\":\"2020-09-23 09:48:39\",\"received_from_customer_at\":\"2020-09-23 09:48:49\",\"packed_at\":\"2020-09-23 09:48:57\",\"on_the_way_at\":\"2020-09-23 09:49:04\",\"delivered_at\":\"2020-09-23 09:49:12\"}', 'https://hobortdev.page.link/kS3s', '2020-09-23 09:49:12', '2020-09-23 09:47:50'),
(29, 39, 2, 1, NULL, 1, NULL, NULL, '5.00', 'HS-TRCKID-552405919', '59 ujjain road dewas ', 'shikha sharma', 'a8959556678', 'hobort shipping', 'hfjuy njhgkhjuk', NULL, NULL, NULL, NULL, NULL, 'WrpXiNn2Z7M0fTvK.pdf', 'application/pdf', 'pdf', 7, '{\"approved_at\":\"2020-09-24 05:34:07\",\"shipped_by_customer_at\":\"2020-09-28 11:40:58\",\"received_from_customer_at\":\"2020-10-15 12:46:02\",\"packed_at\":\"2020-10-15 12:46:18\",\"on_the_way_at\":\"2020-10-15 12:52:43\",\"delivered_at\":\"2020-10-15 12:53:03\"}', 'https://hobortdev.page.link/9G6K', '2020-10-15 12:53:03', '2020-09-23 09:49:24'),
(30, 27, 2, 1, NULL, 1, NULL, NULL, '5.00', 'HS-TRCKID-A00000002', '59 ujjain road dewas ', 'swati sharma', 'indore123', 'hobort shipping', 'dewgfreg gtirjgihr i5jyi6tjyho6 yji6u7mu bjgnj5ng ny5ny6m6m tn5ijyi56yo56 tn5my65h nyk56y6km ny5y65my6ou ny6k5mu6muo67 yn6k5mu6uo76 y5my6kuo6ku m6mu76uo7k y5yn5i6yi65u yk65um76uo76 ym6u6o5ku76ou um76u,7i,7 yo6ku6o5kuo67 ,li7,i78i87lip87 ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, '{\"approved_at\":\"2020-09-23 10:09:16\",\"shipped_by_customer_at\":\"2020-09-23 10:11:34\",\"received_from_customer_at\":\"2020-09-23 10:11:51\",\"packed_at\":\"2020-09-23 10:12:03\",\"on_the_way_at\":\"2020-09-23 10:12:10\",\"delivered_at\":\"2020-09-23 10:12:15\"}', 'https://hobortdev.page.link/kS3s', '2020-09-23 10:12:15', '2020-09-23 10:09:00'),
(31, 27, 1, 12, NULL, 1, NULL, NULL, '85.00', 'HS-TRCKID-A00000003', 'dewas', 'swati sharma', 'sea1234fgrfegre', 'hobort shipping', 'cdsfdgvrd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, '{\"approved_at\":\"2020-09-23 10:12:52\",\"shipped_by_customer_at\":\"2020-09-23 10:13:38\",\"received_from_customer_at\":\"2020-09-24 05:56:32\",\"packed_at\":\"2020-09-24 05:56:38\",\"on_the_way_at\":\"2020-09-24 05:56:43\",\"delivered_at\":\"2020-09-24 05:56:48\"}', 'https://hobortdev.page.link/HwdV', '2020-09-24 05:56:48', '2020-09-23 10:12:36'),
(32, 13, 3, 4, NULL, 1, NULL, NULL, '78.00', 'HS-TRCKID-681669235', '59 ujjain road dewas ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '{\"approved_at\":\"2020-09-24 05:33:28\"}', 'https://hobortdev.page.link/Womo', '2020-09-24 05:33:28', '2020-09-23 10:14:35'),
(34, 23, 2, 1, NULL, 1, NULL, NULL, '4.50', 'HS-TRCKID-A00000006', 'bhopal', 'nsharma 123', 'indore123vcv', 'hobort shipping', 'bfvngv  nghmhjmkjh n gnjhgjmhkuhjk bgnjhgjmh nhmjkm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, '{\"approved_at\":\"2020-09-23 10:44:20\",\"shipped_by_customer_at\":\"2020-09-23 10:44:55\",\"received_from_customer_at\":\"2020-09-24 05:57:04\",\"packed_at\":\"2020-09-24 05:57:12\",\"on_the_way_at\":\"2020-09-24 05:57:20\",\"delivered_at\":\"2020-09-24 05:57:29\"}', 'https://hobortdev.page.link/yFPN', '2020-09-24 05:57:29', '2020-09-23 10:43:56'),
(35, 27, 1, 12, NULL, 2, NULL, NULL, '170.00', 'HS-TRCKID-484956953', '59 ujjain road dewas ', 'aditi', 'asd345675', 'hobort shipping', 'zXASAC VFDVBGF BGFNGN BFNFG RBF ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, '{\"approved_at\":\"2020-09-17 14:19:13\",\"shipped_by_customer_at\":\"2020-09-17 14:20:51\",\"received_from_customer_at\":\"2020-09-17 14:21:20\",\"packed_at\":\"2020-09-17 14:21:30\",\"on_the_way_at\":\"2020-09-17 14:21:42\",\"delivered_at\":\"2020-09-17 14:21:50\"}', 'https://hobortdev.page.link/U131', '2020-09-24 06:03:54', '2020-09-24 06:03:34'),
(36, 27, 3, 4, NULL, 1, NULL, NULL, '78.00', 'HS-TRCKID-622831568', 'bhopal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '{\"approved_at\":\"2020-09-24 06:13:09\"}', 'https://hobortdev.page.link/E2qA', '2020-09-24 06:13:09', '2020-09-24 06:12:56'),
(37, 50, 2, 1, NULL, 1, NULL, NULL, '5.00', 'HS-TRCKID-204733830', '59 ujjain road dewas ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, '{\"approved_at\":\"2020-09-29 14:47:52\"}', 'https://hobortdev.page.link/Uk2y', '2020-09-29 14:47:52', '2020-09-29 14:47:10'),
(39, 53, 2, 8, NULL, 1, NULL, NULL, '56.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2020-09-30 11:12:25', '2020-09-30 11:12:25'),
(40, 64, 2, 1, NULL, 1, NULL, NULL, '4.50', 'HS-TRCKID-150995822', 'dewas', 'xscdsfdrfr', 'fefre', 'frtr45fefr', 'cffvrdvfdgf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, '{\"approved_at\":\"2020-10-15 10:09:18\",\"shipped_by_customer_at\":\"2020-10-15 10:09:48\",\"received_from_customer_at\":\"2020-10-15 10:10:31\",\"packed_at\":\"2020-10-15 10:10:49\",\"on_the_way_at\":\"2020-10-15 10:10:58\",\"delivered_at\":\"2020-10-15 10:11:05\"}', 'https://hobortdev.page.link/w3mf', '2020-10-15 10:11:05', '2020-10-14 17:34:30'),
(41, 64, 5, NULL, NULL, 0, NULL, NULL, '678.00', 'HS-TRCKID-330491123', NULL, 'shikha sharma', NULL, NULL, 'dssef gsvdhebscf whbfiejrngrmrt fhgriejgmtrmh dbfewnfrejg ', 'neha ', 'axxs', '4', '123456,  #234567', '67', 'EWA4kQB0JIplwnKc.jpeg', 'image/jpeg', 'jpeg', 7, '{\"received_from_customer_at\":\"2020-10-15 10:21:48\",\"packed_at\":\"2020-10-15 10:23:04\",\"on_the_way_at\":\"2020-10-15 10:23:27\",\"delivered_at\":\"2020-10-15 10:23:55\"}', 'https://hobortdev.page.link/ePmL', '2020-10-15 12:04:06', '2020-10-15 10:21:08'),
(44, 64, 3, 4, NULL, 1, NULL, NULL, '78.00', 'HS-TRCKID-133458974', '59 ujjain road dewas ', 'shikha sharma', '98765432ytuyu', 'hobort shipping', 'fj,hb fthvg vhgvjb tfvghjb tygykhjm rdtfgfhjbm tyfghbj ehdrtg rtdfvjgbh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, '{\"approved_at\":\"2020-10-15 16:10:44\",\"shipped_by_customer_at\":\"2020-10-15 16:11:52\",\"received_from_customer_at\":\"2020-10-16 04:57:55\"}', 'https://hobortdev.page.link/NRsE', '2020-10-16 04:57:55', '2020-10-15 16:01:37'),
(45, 39, 3, 4, NULL, 1, NULL, NULL, '78.00', 'HS-TRCKID-144917834', '59 ujjain road dewas ', 'vsdvfdv', 'vgfdgvb', 'Poste Italiane', 'ferfregvrtg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, '{\"approved_at\":\"2020-10-15 16:18:44\",\"shipped_by_customer_at\":\"2020-10-15 16:20:40\",\"received_from_customer_at\":\"2020-10-15 16:21:59\",\"packed_at\":\"2020-10-15 16:24:44\",\"on_the_way_at\":\"2020-10-15 16:24:59\",\"delivered_at\":\"2020-10-15 16:25:19\"}', 'https://hobortdev.page.link/5pj9', '2020-10-15 16:25:19', '2020-10-15 16:18:23'),
(46, 39, 5, NULL, NULL, 0, NULL, NULL, '890.00', 'HS-TRCKID-134103224', NULL, 'frgt', NULL, NULL, 'efregrt', 'ghthytj', 'rgrthgyty56y', '6hygjuyjuy', ',  #hthyjnyujkiuk', '567', 'G9tYlxJDqzjA4wB6.jpeg', 'image/jpeg', 'jpeg', 7, '{\"received_from_customer_at\":\"2020-10-15 16:26:41\",\"packed_at\":\"2020-10-15 16:30:51\",\"on_the_way_at\":\"2020-10-15 16:31:03\",\"delivered_at\":\"2020-10-15 16:31:18\"}', 'https://hobortdev.page.link/qZpu', '2020-10-15 16:31:18', '2020-10-15 16:26:04'),
(51, 5, 5, NULL, NULL, 0, NULL, NULL, '2999.00', 'HS-TRCKID-803544854', NULL, 'Chris Gayle', NULL, NULL, 'Hello,\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\r\n\r\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 'KL Rahul', 'Dubai', '120', 'ABC123,  #, #EGF567, #MPN578, #PICV9877, #FHK3456', '500', NULL, NULL, NULL, 5, '{\"received_from_customer_at\":\"2020-10-16 09:41:50\",\"packed_at\":\"2020-10-16 09:46:36\"}', 'https://hobortdev.page.link/7cNP', '2020-10-16 09:46:36', '2020-10-16 09:38:37'),
(52, 39, 5, NULL, NULL, 0, NULL, NULL, '567.00', 'HS-TRCKID-132490015', NULL, 'shikha sharma', NULL, NULL, 'Description is the pattern of narrative development that aims to make vivid a place, object, character, or group. Description is one of four rhetorical modes, along with exposition, argumentation, and narration. In practice it would be difficult to write literature that drew on just one of the four basic modesDescription is the pattern of narrative development that aims to make vivid a place, object, character, or group. Description is one of four rhetorical modes, along with exposition, argumentation, and narration. In practice it would be difficult to write literature that drew on just one of the four basic modes.\r\n\r\nDescription is the pattern of narrative development that aims to make vivid a place, object, character, or group. Description is one of four rhetorical modes, along with exposition, argumentation, and narration. In practice it would be difficult to write literature that drew on just one of the four basic modes.\r\n\r\n', 'neha sharma', 'dewas', '56', 'ASDFGH12345,  #ASDFGH12345789, #ASDFGH12908, #ASDFGH12908fefegfr', '67', NULL, NULL, NULL, 5, '{\"shipped_by_customer_at\":\"2020-10-16 14:32:48\",\"received_from_customer_at\":\"2020-10-16 14:34:04\",\"packed_at\":\"2020-10-16 14:50:10\"}', 'https://hobortdev.page.link/Go5n', '2020-10-16 14:50:10', '2020-10-16 14:32:48');

-- --------------------------------------------------------

--
-- Table structure for table `sea_freight_services`
--

CREATE TABLE `sea_freight_services` (
  `seaFreightServiceID` int(10) UNSIGNED NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1:Light, 2:Heavy',
  `price` decimal(8,2) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Active, 2:Deleted',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sea_freight_services`
--

INSERT INTO `sea_freight_services` (`seaFreightServiceID`, `title`, `type`, `price`, `status`, `updated_at`, `created_at`) VALUES
(1, 'small box', 2, '5.00', 1, '2020-07-10 10:26:57', '2020-07-10 08:54:27'),
(2, 'Furniture	', 1, '5.00', 2, '2020-07-10 08:55:19', '2020-07-10 08:55:19'),
(3, 'small box', 1, '5.00', 1, '2020-07-10 10:27:09', '2020-07-10 10:27:09'),
(4, 'Vehicle', 2, '5.00', 2, '2020-07-10 12:05:06', '2020-07-10 12:04:45'),
(5, 'Laptop	', 1, '5.00', 1, '2020-07-10 12:29:15', '2020-07-10 12:05:26'),
(6, 'Furniture	', 2, '5.00', 2, '2020-07-10 12:07:37', '2020-07-10 12:07:26'),
(7, 'Laptop	', 1, '3.00', 2, '2020-07-10 12:28:57', '2020-07-10 12:28:57'),
(8, 'Container ', 2, '56.00', 1, '2020-07-11 08:38:03', '2020-07-11 06:07:52');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticketID` int(10) UNSIGNED NOT NULL,
  `created_by_id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:Pending, 1:In Review, 2:Completed',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticketID`, `created_by_id`, `title`, `description`, `status`, `updated_at`, `created_at`) VALUES
(1, 39, 'testing', 'email and sms testing', 1, '2020-08-24 13:01:20', '2020-08-24 13:01:20'),
(2, 63, 'email testing', 'email test for a admin comment', 1, '2020-08-25 13:44:45', '2020-08-25 13:44:45'),
(3, 5, 'Training For future', 'Lorem ipsum', 0, '2020-08-25 14:20:34', '2020-08-25 14:20:34'),
(4, 39, 'Furniture', 'testing', 1, '2020-08-27 05:14:21', '2020-08-27 05:14:21'),
(5, 5, 'I need help for my order!!', 'Hello,\r\nPlease help me.\r\nMy order is not yet received? Why so much delay?\r\nReply to me soon.\r\nThanks!', 1, '2020-08-27 10:39:13', '2020-08-27 10:39:13'),
(6, 9, 'Regarding Late delivery', 'Hello,Hope you are doing well', 1, '2020-08-29 05:36:25', '2020-08-29 05:36:25'),
(7, 65, 'Furniture', 'testing', 2, '2020-09-02 12:01:20', '2020-08-29 08:25:15'),
(8, 53, 'Furniture', 'adsafse hbtyjtjyuhjyu', 0, '2020-09-23 10:19:25', '2020-09-23 10:19:25'),
(9, 27, 'Furniture1', 'zdxgcb', 0, '2020-09-24 06:05:12', '2020-09-24 06:05:12');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_comments`
--

CREATE TABLE `ticket_comments` (
  `ticketCommentID` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `commented_by_id` int(11) DEFAULT NULL COMMENT 'For Admin it will be NULL',
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0:Inactive, 1:Active',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_comments`
--

INSERT INTO `ticket_comments` (`ticketCommentID`, `ticket_id`, `commented_by_id`, `comment`, `status`, `updated_at`, `created_at`) VALUES
(1, 1, NULL, 'hello your order successfully received by hobort', 1, '2020-08-24 13:01:43', '2020-08-24 13:01:43'),
(2, 1, NULL, 'hiiii', 1, '2020-08-24 13:05:35', '2020-08-24 13:05:35'),
(3, 1, NULL, 'csfdgrdhytrutyi7y', 1, '2020-08-24 13:08:23', '2020-08-24 13:08:23'),
(4, 1, NULL, 'hello your order successfully received by hobort', 1, '2020-08-24 13:24:12', '2020-08-24 13:24:12'),
(5, 1, NULL, 'hello your order successfully received by hobort  we are try to  sent its place as soon as', 1, '2020-08-24 13:30:54', '2020-08-24 13:30:54'),
(6, 1, NULL, 'hello', 1, '2020-08-25 10:12:17', '2020-08-25 10:12:17'),
(7, 1, NULL, 'hii', 1, '2020-08-25 10:18:24', '2020-08-25 10:18:24'),
(8, 1, NULL, 'hello your order is packed', 1, '2020-08-25 11:02:52', '2020-08-25 11:02:52'),
(9, 2, NULL, 'hello your order successfully received by hobort', 1, '2020-08-25 13:45:05', '2020-08-25 13:45:05'),
(10, 2, 63, 'ok tq', 1, '2020-08-25 13:46:23', '2020-08-25 13:46:23'),
(11, 2, NULL, 'hiiii', 1, '2020-08-26 06:31:05', '2020-08-26 06:31:05'),
(12, 2, 63, 'hello', 1, '2020-08-26 06:34:20', '2020-08-26 06:34:20'),
(13, 1, 39, 'hello', 1, '2020-08-26 12:43:53', '2020-08-26 12:43:53'),
(14, 2, NULL, 'hello your order is packed', 1, '2020-08-26 12:44:54', '2020-08-26 12:44:54'),
(15, 2, NULL, 'hello your order is packed', 1, '2020-08-26 14:01:56', '2020-08-26 14:01:56'),
(16, 1, 39, 'hiii', 1, '2020-08-27 04:27:16', '2020-08-27 04:27:16'),
(17, 2, NULL, 'hello your order is on the way', 1, '2020-08-27 05:05:30', '2020-08-27 05:05:30'),
(18, 4, NULL, 'hiiii', 1, '2020-08-27 05:14:44', '2020-08-27 05:14:44'),
(19, 5, NULL, 'Hello,', 1, '2020-08-27 10:40:50', '2020-08-27 10:40:50'),
(20, 5, NULL, 'For report comments', 1, '2020-08-27 10:45:40', '2020-08-27 10:45:40'),
(21, 2, NULL, 'hello', 1, '2020-08-27 14:29:54', '2020-08-27 14:29:54'),
(22, 6, NULL, 'Hello Arvind', 1, '2020-08-29 05:37:51', '2020-08-29 05:37:51'),
(24, 7, 65, 'hello', 1, '2020-08-29 10:59:52', '2020-08-29 10:59:52'),
(25, 4, NULL, NULL, 1, '2020-09-17 13:19:37', '2020-09-17 13:19:37'),
(26, 1, 39, NULL, 1, '2020-09-17 14:03:12', '2020-09-17 14:03:12'),
(27, 1, NULL, 'hello', 1, '2020-09-17 14:04:47', '2020-09-17 14:04:47'),
(28, 4, NULL, NULL, 1, '2020-09-18 05:42:57', '2020-09-18 05:42:57'),
(29, 4, 39, NULL, 1, '2020-09-18 05:53:32', '2020-09-18 05:53:32'),
(30, 4, NULL, NULL, 1, '2020-09-18 05:54:29', '2020-09-18 05:54:29'),
(31, 4, NULL, 'hello your order successfully received by hobort  we are try to  sent its place as soon as', 1, '2020-09-18 05:56:38', '2020-09-18 05:56:38'),
(32, 4, 39, 'hello your order successfully received by hobort  we are try to  sent its place as soon as', 1, '2020-09-18 08:59:09', '2020-09-18 08:59:09'),
(33, 8, 53, 'hii', 1, '2020-09-23 10:37:06', '2020-09-23 10:37:06'),
(34, 8, 53, 'i need to help', 1, '2020-09-23 10:37:30', '2020-09-23 10:37:30'),
(35, 3, 5, 'Hello', 1, '2020-09-26 12:39:09', '2020-09-26 12:39:09'),
(36, 3, NULL, NULL, 1, '2020-09-26 12:40:17', '2020-09-26 12:40:17'),
(37, 4, 39, 'hiii', 1, '2020-09-28 11:37:54', '2020-09-28 11:37:54'),
(38, 4, 39, NULL, 1, '2020-09-28 11:38:00', '2020-09-28 11:38:00'),
(39, 4, NULL, NULL, 1, '2020-09-28 11:38:41', '2020-09-28 11:38:41'),
(40, 4, 39, NULL, 1, '2020-09-28 13:26:38', '2020-09-28 13:26:38'),
(41, 4, NULL, NULL, 1, '2020-09-28 13:26:55', '2020-09-28 13:26:55');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_comment_attachments`
--

CREATE TABLE `ticket_comment_attachments` (
  `ticketCommentAttachmentID` int(10) UNSIGNED NOT NULL,
  `ticket_comment_id` int(11) NOT NULL,
  `attachment_file` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mime_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'image/jpeg, image/png etc',
  `file_extension` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'jpg, jpeg, png, pdf, docx etc..',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_comment_attachments`
--

INSERT INTO `ticket_comment_attachments` (`ticketCommentAttachmentID`, `ticket_comment_id`, `attachment_file`, `mime_type`, `file_extension`, `created_at`) VALUES
(2, 25, 'lQIs4A9vhxoOWNwP.png', 'image/png', 'png', '2020-09-17 13:19:37'),
(3, 26, 'gkdLF5wCnEua9XD4.png', 'image/png', 'png', '2020-09-17 14:03:12'),
(4, 28, 'LG0dpWB1OJhTaxDI.jpeg', 'image/jpeg', 'jpeg', '2020-09-18 05:42:57'),
(5, 29, 'g92fmkKTnGsu8pWB.jpeg', 'image/jpeg', 'jpeg', '2020-09-18 05:53:32'),
(6, 30, '1ilbc2FhEtA74L3G.jpeg', 'image/jpeg', 'jpeg', '2020-09-18 05:54:29'),
(7, 36, 'mpBW8tldc90bOnuP.jpg', 'image/jpeg', 'jpg', '2020-09-26 12:40:17'),
(8, 38, 'gb95ATlEPLDKYzBX.jpeg', 'image/jpeg', 'jpeg', '2020-09-28 11:38:00'),
(9, 39, 'sS1yGNRu9Hlkn8Xh.jpeg', 'image/jpeg', 'jpeg', '2020-09-28 11:38:41'),
(10, 40, 'fJtLmQFzd04UK53h.jpeg', 'image/jpeg', 'jpeg', '2020-09-28 13:26:38'),
(11, 41, 'WXrhEmNPznwZ4GOu.jpeg', 'image/jpeg', 'jpeg', '2020-09-28 13:26:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) UNSIGNED NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_dial_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_proof` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_proof_status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:Not uploaded, 1:Pending, 2:Verified, 3:Rejected',
  `email_verification_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_email_verified` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:No, 1:Yes',
  `email_alert_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0:OFF, 1:ON',
  `last_login_at` datetime NOT NULL,
  `promo_applicable` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0:No, 1:Yes',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0:Inactive, 1:Active',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `full_name`, `email`, `password`, `avatar`, `phone_dial_code`, `country_code`, `phone_number`, `id_proof`, `id_proof_status`, `email_verification_token`, `is_email_verified`, `email_alert_status`, `last_login_at`, `promo_applicable`, `status`, `updated_at`, `created_at`) VALUES
(5, 'Manish Pareek 1', 'manish.mindiii@gmail.com', '$2y$10$jLg/yDvRL10G8lFgtGxCJeWkAOSv2AIw7Yn/iU4BfWU1zuKnR6t5S', 'pHVgf83uo9zeX7lS.jpg', '+91', 'in', '90981 91728', 'J5zrqKSBsTg9atDO.jpg', 1, NULL, 1, 1, '2020-10-16 09:34:45', 0, 1, '2020-10-16 09:40:41', '2020-07-16 06:21:39'),
(7, 'Manish', 'manishmindiii@gmail.com', '$2y$10$qj3eRV7QUnPXFHXeEu0q9OauBcRNbIvmJ8AklUjofGoidoc9KBQU6', '', '91', 'in', '4354565756', 'J5zrqKSBsTg9atDO.jpg', 1, '1', 1, 1, '2020-09-23 05:52:45', 1, 1, '2020-07-16 14:43:13', '2020-07-16 14:43:13'),
(9, 'Arvind Patidar', 'arvind.mindiii@gmail.com', '$2y$10$0hrJaOB9HTsGnWWhz90U1.54XLo3vHrwvyeh0beu2jKq.4xNW46tW', '3VPDuSy9YkIE4gpx.jpeg', '+91', 'in', '7869979679', 'J5zrqKSBsTg9atDO.jpg', 3, '1', 1, 1, '2020-08-29 05:35:06', 1, 1, '2020-08-14 05:00:20', '2020-08-14 05:00:20'),
(11, 'Braj', 'brajmohan.mindiii@gmail.com', '$2y$10$ZWdMLMV6y3pcJlu9ZSdti.NU6S.1hGDshz7XaTIH5EEZrqAnF267e', '', '91', 'in', '7879953591', 'O1Y2lHB8fGdL0VAU.jpeg', 1, NULL, 0, 1, '2020-07-31 07:58:31', 1, 0, '2020-07-22 06:59:12', '2020-07-17 11:32:12'),
(13, 'Neha sharma', 'neha@gmail.com', '$2y$10$I.5SpO7y918qOFodLb1X7.XiE1v2YfOHIYVvdZGLuPL6BfNMCUNYy', 'f6mUu0CjWy2YQ5bN.jpg', '+91', 'in', '6262 772 884', 'ZvFEz1meJg0KBsOY.png', 1, '1', 1, 1, '2020-10-16 04:52:31', 0, 1, '2020-09-28 12:54:41', '2020-07-22 05:17:28'),
(14, 'Manish New', 'manishmind.iii@gmail.com', '$2y$10$jIZiBCyhGdyUaS/BW4Tdme9Q4DoW0G3nyVydvcd3CmURFLdMYrmuK', 'KsyULQzxla70HtDB.jpg', '91', 'in', '2345667867', 'M97TQqxAchCbon5y.jpg', 1, NULL, 0, 1, '2020-07-23 05:51:31', 1, 1, '2020-07-22 07:11:35', '2020-07-22 07:11:35'),
(15, 'neha sharma', 'adsf@gmail.com', '$2y$10$IqGxgNlXvtZXuweoVYZxJuFvcGujgIExJ0gtD0JlTVoCr4.N0LeZa', NULL, '91', 'in', '6262772884', '2kTeOs6g15hPV8Iu.jpg', 1, NULL, 0, 1, '2020-07-24 07:46:43', 1, 1, '2020-07-24 14:30:20', '2020-07-22 11:03:36'),
(16, 'Sachin Pal', 'sachinpal.mindiii@gmail.com', '$2y$10$icLgdHIpqGSC7LEvXyHnLuPdhFzZMLRhcOhMH/CTqxVYhlYUiIr5O', 'giIfFcNVQre7mw2B.jpg', '+91', 'in', '6260 149 658', 'eKVEp5hvbD7kWxl0.jpg', 2, '1', 1, 1, '2020-09-22 05:36:30', 0, 1, '2020-08-13 14:12:05', '2020-08-13 14:12:05'),
(17, 'Manish 3', 'manish3@gmail.com', '$2y$10$DU3pyeNG4CHoWA6.dl8YL.JdZ4fSVB83kgdyyil0Ox2vXA2ftIDD.', '1pFPCrgteQU3AhdH.jpg', '91', 'in', '244656889', 'T4rnVHjhkbSNfJ3a.jpg', 3, NULL, 0, 1, '0000-00-00 00:00:00', 1, 1, '2020-07-23 05:42:46', '2020-07-23 05:42:46'),
(19, 'neha 1', 'neha1@gmail.com', '$2y$10$BD5gtrRNmXfmNfklhu21Te05rU/2Gee1TQz8AqwCRPwCAjg0YYiNy', 'IVnkARpbXy6Wm8tC.jpg', '91', 'in', '626272884', 'HkXW10eYTQsF4tfv.jpg', 1, NULL, 1, 1, '2020-08-19 09:24:05', 1, 1, '2020-07-23 06:09:25', '2020-07-23 06:09:25'),
(20, 'neha2', 'neha2@gmail.com', '$2y$10$KmsKH18NdcGWIp4hKomFAeS3qSXMA84mek/k3c3wv9wT.kywMvQZu', 'vhRn4H81uVPWTdQL.jpg', '36', 'hu', '1234567890', 'UpGPKEjnm1BlsNrH.jpg', 1, NULL, 1, 1, '0000-00-00 00:00:00', 1, 1, '2020-07-23 06:11:38', '2020-07-23 06:11:38'),
(21, 'Manish 4', 'manish4@gmail.com', '$2y$10$GyhAXtwnaUypE8MF0/ZOSuwOZjfjeTyBofc6j7P22shFnnuQGRjam', NULL, '', '', '346767947', 'pnW1v5s47CAJ90jU.jpg', 1, NULL, 0, 1, '0000-00-00 00:00:00', 1, 1, '2020-07-23 06:46:18', '2020-07-23 06:46:18'),
(22, 'neha12', 'neha12@gmail.com', '$2y$10$9KI.tQAGW23j7N8Zu6ifJ.vrv1W8/LGKSt0yzGucq6h5oZAFcQoHi', 'LRsN9mA14arQCPbq.jpg', '+91', 'in', '6262772884', 'aLw7RPO2yfUsvpqo.jpg', 1, NULL, 0, 1, '2020-07-23 07:48:28', 1, 1, '2020-07-23 07:48:28', '2020-07-23 07:48:28'),
(23, 'neha 123', 'neha123@gmail.com', '$2y$10$ONgiIKkPmQRFhXykr8gBveMQnSpN4XyGG6xmrpRxSmI77Si7E4Rrm', 'A5nvQCIyOpXoRmse.jpg', '+354', 'is', '576878', 'VLosC3P96dkKlv72.jpg', 1, '1', 1, 1, '2020-09-23 10:42:42', 0, 1, '2020-07-23 07:49:47', '2020-07-23 07:49:47'),
(26, 'priya', 'priya@gmail.com', '$2y$10$MRKVwfovhrDwJfJP6WnP4e9TY9aEpZKDlQQnHlQ0uoRAwUGVifpUO', 'PtsbOReQLmg9Ur0G.jpg', '+91', 'in', '9826502747', 'YOh9cJy0TSHqxLKo.jpg', 1, NULL, 0, 1, '2020-07-23 09:44:37', 1, 1, '2020-07-23 09:44:37', '2020-07-23 09:44:37'),
(27, 'shikha', 'shikha@gmail.com', '$2y$10$usJ1XXL1fQXJBld9vdieM.YSIH0mmnsgV9OfKdaO7m49DwOieMcfy', 'c4kyBhnMZmjl6g25.jpg', '+91', 'in', '6262772884', '41iqSmgC2LT8QpaN.jpg', 1, '1', 1, 1, '2020-09-24 06:03:14', 0, 1, '2020-07-23 09:48:01', '2020-07-23 09:48:01'),
(28, 'shikha1', 'shikha1@gmail.com', '$2y$10$M9YpxERfb7YD8RarOQyqPuMHNvK5K/.Xcnl77ufTimbc6tPA9c3le', '6yWXHT1loLNDkPU8.png', '+91', 'in', '6262772884', 'SbWc5HQx0igeAwtk.png', 1, NULL, 0, 1, '2020-07-23 11:03:17', 1, 1, '2020-07-23 11:03:17', '2020-07-23 11:03:17'),
(29, 'Sachin Don', 'root@gmail.com', '$2y$10$AymGTS3z8.fLxVGek8oRNu2aiofQe3EltXN.uL1YuHZjpUddjDzpy', 'wGNn4A9XBiyK0UdM.jpg', '+91', 'in', '6260149658', 'mTbOMqBgHLKQr10F.jpg', 1, NULL, 0, 1, '2020-07-23 11:03:53', 1, 1, '2020-07-23 11:03:53', '2020-07-23 11:03:53'),
(30, 'Sachin Demo', 'sachindemo@gmail.com', '$2y$10$FKTGjBAmvmLr5bLFVcBroO7pbeJ9AHCOsXXRM1x43HQCPyxLG8Ray', '4jTNctRyqvZLJdxV.jpg', '+91', 'in', '12345687', 'v23JeBj0bHPCGsXT.jpg', 1, NULL, 1, 1, '2020-07-24 05:44:35', 1, 1, '2020-07-24 05:44:35', '2020-07-24 05:44:35'),
(31, 'Sachin don Pal', 'sachinp.al.mindiii@gmail.com', '$2y$10$zvJYTbj66TP2vjd6nS4w3ONb918Xt2O.olyvjl3sIcrBX40E1n.Ky', 'yY2fGQaC4RD8W3Ow.jpg', '+91', 'in', '6260139658', 'RtQcdEPXB7Gw9VS4.jpg', 1, NULL, 0, 1, '2020-07-25 07:28:55', 1, 1, '2020-07-25 07:23:44', '2020-07-25 07:23:44'),
(32, 'Manish Quote', 'man.ishmindiii@gmail.com', '$2y$10$OMCcLv6NNUtapLL83UT5jOCcmJCoAQWLy11OvXB2k6VPvTtgGAopG', 'czFRVhQq410sgiOY.jpg', '+91', 'in', '78911365478', 'Xn3xUNTb2rlcoQ8u.jpg', 1, NULL, 1, 1, '2020-07-25 09:21:09', 1, 1, '2020-07-25 09:21:09', '2020-07-25 09:21:09'),
(33, 'Manish 5', 'mani.shmindiii@gmail.com', '$2y$10$OjtcNluDq/cNSVkfLpgefOn0lbF1alBGCsCaehLCjIEYLyi.MTa9W', NULL, '+91', 'in', '23466678', '9HBQskP8gqNI5i4e.jpg', 1, NULL, 0, 1, '2020-07-25 09:52:24', 1, 1, '2020-07-25 09:50:59', '2020-07-25 09:50:59'),
(34, 'Nihal', 'nihal.mindiii@gmail.com', '$2y$10$6qqwgHxNlx4ThUGJAKsu2ucuqeENnN5LKVztGfesn6jBRKZtWvwX.', '2X9txC3461rbvqVh.JPG', '+91', 'in', '7869979678', '6lNHaimho9JeqcTR.jpg', 1, '1', 0, 1, '2020-07-31 07:54:47', 1, 1, '2020-07-25 12:58:25', '2020-07-25 12:58:25'),
(35, 'Arvind Patidar', 'arvindpatidar00@gmail.com', '$2y$10$9LdN763.gEFllKPJ1GY9yea46arvyStPGEIba4kpCrr8PlbaF2Xb2', NULL, '+91', 'in', '7869979674', 'davjcOPNpQiYbuLw.png', 1, '1', 1, 1, '2020-07-31 07:55:21', 1, 1, '2020-07-25 13:01:13', '2020-07-25 13:01:13'),
(36, 'Arvind', 'root@hobort.com', '$2y$10$jmCHnm5.xKaxj2O3Szk61.nNeyTXUPrbWgO.LI/.pk4nP/qct59K.', 'aYHFGDKmnc1jh43w.jpeg', '+91', 'in', '12346652', 'hzCRPFWbgNsapj8q.jpeg', 1, '1', 0, 1, '2020-07-25 14:14:52', 1, 1, '2020-07-25 14:14:52', '2020-07-25 14:14:52'),
(38, 'Sohan', 's.achinpal.mindiii@gmail.com', '$2y$10$vyVYJhIf3wAG7MyrVLULteFcwPXLcm.W6qpLiI0dFCWTDQTOXhqxC', 'WYpHzei3hco9P762.jpeg', '+91', 'in', '123456123', 'zbHDiwBoFdVP5EOa.jpg', 1, '1', 1, 1, '2020-07-29 05:01:24', 1, 1, '2020-07-29 04:56:48', '2020-07-29 04:56:48'),
(39, 'Neha', 'nehasharmamindiii@gmail.com', '$2y$10$04AN/Rm0A44GYAx3UmfyluRCftm44jNwBvyksFsHcPBILWJFP1Fsi', '1p36iPtRIAMmfoS9.jpg', '+91', 'in', '6262 772 884', '7N9fn65DuB3qEsyz.png', 1, '1', 1, 1, '2020-10-16 14:30:13', 0, 1, '2020-09-28 13:26:16', '2020-07-29 07:27:40'),
(40, 'Sachin Pal (Pal saab)', 'sachinpal.mind.iii@gmail.com', '$2y$10$PplwNAM3EdioeVH1Qq0h6eqsTBNR5nmDASrnQWYABNgFHbV9hWTEu', 'k92qH1uQU0tzxmG5.jpg', '+91', 'in', '12487512', 'LwBjhJVKP7pcCNx8.jpg', 1, '1', 1, 1, '2020-07-31 08:56:11', 1, 1, '2020-07-31 08:58:25', '2020-07-30 05:17:01'),
(41, 'Sachin 1', 'sachi.npal.mindiii@gmail.com', '$2y$10$mgSe6e1l7QlOmnwfKkolBuNVcJex7t0L.cMb.Rh5DP71xEMuaFk5i', 'uWY0mSwQnB736rxe.jpg', '+91', 'in', '12484521', 'lPeYmogsBDhRwdU7.jpg', 1, '1', 1, 1, '2020-07-30 13:55:56', 1, 1, '2020-07-30 13:55:56', '2020-07-30 13:55:56'),
(42, 'Arvind new', 'arvi.ndmindiii@gmail.com', '$2y$10$CXYlQJfjQplI02AKYPTJlODVgt47LK6sgb4/w1IkSm5.dc1M7EzhS', 'PV7boTjJYe5HEsDx.JPG', '+91', 'in', '7869978678', '6CmnXQ2W0lfxeFoK.jpeg', 1, '1', 1, 1, '2020-07-31 08:00:47', 1, 1, '2020-07-31 08:00:47', '2020-07-31 08:00:47'),
(43, 'Mike Higgins', 'mhiggins3@mail.com', '$2y$10$.sGJWWkTr2rRVEVhWRQ4vOCG4Z7CtjPGpheVpNJYxTZ1MH2lG.H8G', 'EYR9yaOxup0Ci5XV.png', '+1', 'us', '7709886883', 'JiPW51DUtw4ZYezd.png', 1, '1', 0, 1, '2020-07-31 09:24:39', 1, 1, '2020-07-31 09:24:39', '2020-07-31 09:24:39'),
(44, 'Tom Ford', 'covellservices@hotmail.com', '$2y$10$f.g5TgF2278qZuP5DfZAKu1.CxyCEFEbUGgKKcsLrZQLyfsGofA.y', 'mvUX0bjsE74TtaWN.png', '+1', 'us', '4045434433', 'hpXjYiow5MtFJ2qf.JPG', 1, '1', 1, 1, '2020-09-01 00:36:57', 1, 1, '2020-07-31 09:33:12', '2020-07-31 09:33:12'),
(45, 'Divyanshu', 'divyanshu@gmail.com', '$2y$10$nR8Ix8OfGWirBRrQRy/s6eC00fv8aTPRAHAu3XBagaFL4mOTfmAHq', '4H1s2JzdR80iVwlK.png', '+91', 'in', '9121047859', 'TdFsje1273NkKtyQ.png', 1, '1', 0, 1, '2020-07-31 09:36:51', 1, 1, '2020-07-31 09:36:51', '2020-07-31 09:36:51'),
(46, 'S p', 'sachinpal.m.ind.iii@gmail.com', '$2y$10$xTYjrPxOI7LOjZKNUTeShuURJ15qXIuv0BSDh4TJEPyluyKDRCl5y', 'DQ41q29u56L7t0Aw.jpg', '+91', 'in', '112231123', 'GWbwuQevrfiUjd73.jpg', 1, '1', 1, 1, '2020-07-31 12:08:14', 1, 1, '2020-07-31 12:08:14', '2020-07-31 12:08:14'),
(47, 'Jitendra Patidar', 'jitendrapatidar.mindiii@gmail.com', '$2y$10$HwvsLPpHBCj8vrGKd84ZSu.ETJ92lKxA.4jnJY89GYHwmeG55mYsW', 'quUR3ihlSZTvAELa.png', '+91', 'in', '7869548521', 'yMPA5whkKtOidJ0W.jpg', 1, '1', 1, 1, '2020-08-08 06:33:23', 1, 1, '2020-08-08 06:06:54', '2020-08-08 06:06:54'),
(48, 'mahi', 'mahi@gmail.com', '$2y$10$BNaN7mvP3g.AJyKgUXjalOR9xMStP/.INiFisnIqDHK3U6Oc9edva', 'qEordlw7ULYfR2Cv.jpg', '+91', 'in', '6260149651', 'khsdvcpy7EI9ZSjC.jpeg', 1, '1', 0, 1, '2020-08-11 09:45:27', 1, 1, '2020-08-11 09:45:27', '2020-08-11 09:45:27'),
(49, 'neha', 'nehas@gmail.com', '$2y$10$PVLr4nTM9ybxHioulgISjeloD2Kv4TPA0yLL9G1jd1SbDnR/dPbb.', 'l2U5LV9iWhRjn8fd.jpg', '+91', 'in', '1234567890', 'EldpwtYQIWKzCT7B.png', 1, '1', 1, 1, '2020-08-13 08:00:21', 1, 1, '2020-08-11 14:04:45', '2020-08-11 14:04:45'),
(50, 'shikha', 'neha.sharmamindiii@gmail.com', '$2y$10$EsHrENF5kmlBZyF.WMKqlOCBCtKaqyrDxTxZaZOctVkb9s.BIcUS6', NULL, '+91', 'in', '9179636900', '3QoZqWVMzFaCHIsc.png', 1, '1', 1, 1, '2020-10-13 13:05:10', 0, 1, '2020-08-13 08:56:11', '2020-08-13 08:56:11'),
(51, 'nsharma', 'nehasharma.mindiii@gmail.com', '$2y$10$YAYN83vMegsDHMvoqn5ZcOzc9.lo1iKbP57uoRDduc7BoWbrQQgBW', NULL, '+91', 'in', '8959578444', 'lgOXCBWNtDURLa3z.png', 1, '1', 1, 1, '2020-08-19 13:43:09', 1, 1, '2020-08-13 09:03:09', '2020-08-13 09:03:09'),
(52, 'Dhakad', 's.a.chinpal.mindiii@gmail.com', '$2y$10$w.HZnXK95Szr/N1jcB/.WOW2AWYYT4BqqoHEStJ1IPBcNWql.MAsK', 'fXRCkjmdgMY650FS.jpg', '+91', 'in', '9926412541', 'LOfUVijhJ4kybv0Z.jpg', 1, '1', 1, 1, '2020-08-14 09:08:29', 1, 1, '2020-08-14 11:30:48', '2020-08-13 09:20:23'),
(53, 'neha S', 'n.ehasharmamindiii@gmail.com', '$2y$10$Y8gzl276UwhoGMMRBL/SW.2.0GH86EVSME9bGmkKl3opGBo3rD/Cq', NULL, '+91', 'in', '789456123', 'sHemiwaCupD4zUBE.png', 1, '1', 1, 1, '2020-09-30 11:12:23', 0, 1, '2020-08-13 12:34:02', '2020-08-13 12:34:02'),
(54, 'Manish 1', 'manishmin.diii@gmail.com', '$2y$10$7Pzz3Tq/oKcC4IRadWg2Xe59/uXK/l3klF1Gs/tJS7e9DKb5L0ONi', '3J6pfxFlDCXbetqB.jpg', '+91', 'in', '32434656768', 'Hp5lygXDJvr4WG9x.jpg', 1, '1', 1, 1, '2020-08-19 07:26:15', 1, 1, '2020-08-19 07:33:10', '2020-08-18 13:45:54'),
(55, 'shikha', '70sharmaneha@gmail.com', '$2y$10$zWfsijkyxiFIt/C9hsGmfOZSEOAMO4uyjV0hnrFgfbmnC0zBiTVMW', NULL, '+91', 'in', '8982152570', 'zUwmHpIKvLVPqgi8.jpeg', 1, '1', 1, 1, '2020-08-21 13:26:55', 1, 1, '2020-08-21 12:37:49', '2020-08-21 12:37:49'),
(56, 'shikha', 'ne.hasharmamindiii@gmail.com', '$2y$10$hBLWVMolurINZdrdoeqANemYIhZk81D7T6xfPHoCTTctUGtJVPLBu', NULL, '+91', 'in', '57868686', 'MraNhFZAeT9BqYcg.png', 1, '1', 1, 1, '2020-08-21 12:44:30', 1, 1, '2020-08-21 12:44:30', '2020-08-21 12:44:30'),
(57, 'priya', 'nehash.mindiii@gmail.com', '$2y$10$sfAdGZXm4SqMJ/utqIYR1OogZy2bIklTV0CVNm2cmE9hegNik280C', NULL, '+91', 'in', '12365478', '92HbYMiUcevDyL5R.jpeg', 1, '1', 0, 1, '2020-08-21 13:07:21', 1, 1, '2020-08-21 13:07:21', '2020-08-21 13:07:21'),
(58, 'priyanka', 'nehas.harma@gmail.com', '$2y$10$OLozitE3zpGGzcMkHFnajeKNsrw0BZCNtOGdH/S99bugGtGmr8wfa', NULL, '+91', 'in', '456987', 'DygaOQ5Eb34ANXjU.png', 1, '1', 0, 1, '2020-08-21 13:15:51', 1, 1, '2020-08-21 13:15:51', '2020-08-21 13:15:51'),
(59, 'Swati', '70s.harmaneha@gmail.com', '$2y$10$jydyMjdT5zlIE/fCa1M/jePc0Lq/IPTZm5wJKEFSMuSL9Xcr5ZgJ6', NULL, '+91', 'in', '7987674739', 'bWZOmIQVLM3HuJ2f.jpeg', 1, '1', 1, 1, '2020-08-21 13:39:50', 1, 1, '2020-08-21 13:39:50', '2020-08-21 13:39:50'),
(60, 'yashika', '70sh.armaneha@gmail.com', '$2y$10$AoyLcEIX41In72Q/.05Wi.HJ8xrS.hu/8QOcAeoN47sV1GmiCyfi2', NULL, '+91', 'in', '8982152572', 'WURGIMcLKXdExNzs.jpeg', 1, '1', 1, 1, '2020-08-22 04:22:11', 1, 1, '2020-08-22 04:22:11', '2020-08-22 04:22:11'),
(61, 'shakshi', 'nehasharmam.indiii@gmail.com', '$2y$10$lM.E6qJq0TEBcjNSnc7jquUuQjFNlWh1OL17g.aVMzJRZdxMsp2YC', 'KcWJCvZPQDlmXIhp.jpeg', '+91', 'in', '6262772884', 'gzIqUanFGmDH6KR7.png', 1, '1', 1, 1, '2020-08-24 12:10:43', 1, 1, '2020-08-22 12:29:21', '2020-08-22 12:29:21'),
(62, 'ritik', 'neh.asharmamindiii@gmail.com', '$2y$10$W5tqJ61hZ2gzuwVtcKl04.FN.jCNLgzk0uGEY64w7RiYyiiKWFhsC', NULL, '+91', 'in', '9630927880', 'VxHyPWDRZbudiN4a.png', 1, '1', 1, 1, '2020-08-24 09:39:48', 1, 1, '2020-08-24 09:39:48', '2020-08-24 09:39:48'),
(63, 'Janvi vyas', 'nehasha.rmamindiii@gmail.com', '$2y$10$Oi4uNVTkOrLfCZH5DUaH7ujL3zFv4j3gVyzAu/OHBRg/yfQJPoIXG', NULL, '+91', 'in', '9179636900', 'E8Jt370bDNXLkiZy.png', 1, '1', 1, 1, '2020-08-27 12:28:41', 1, 1, '2020-08-25 12:44:19', '2020-08-25 12:44:19'),
(64, 'aditi', 'aditi@gmail.com', '$2y$10$P2vuiNVeqMJRJudnmXArKuUFDCAGlnqaWwbbnwrp0farTyBwqw1k.', NULL, '+91', 'in', '6784321', 'TsKdBQEcMOLe5RpY.png', 1, '1', 1, 1, '2020-10-15 14:10:48', 0, 1, '2020-08-27 04:30:28', '2020-08-27 04:30:28'),
(65, 'test', 'nehasharmamin.diii@gmail.com', '$2y$10$sRRMwNlD74E0F0/JeMOGyOCt7tLBgdqWDZi/eievmD9MCrksJWai6', 'MVqmifxScN291pdC.jpeg', '+91', 'in', '898596321', 'sZzpGXKEgoDFaW6L.jpeg', 3, '1', 1, 1, '2020-08-29 07:25:46', 1, 1, '2020-08-29 07:34:07', '2020-08-29 07:25:46'),
(66, 'dr swati Sharma', '70sharmaneha.@gmail.com', '$2y$10$bqJfKROH0cWF1U4gLVAFYebHP.1QlVjuFZPVGiwBbU0cdDWM65hNi', NULL, '+91', 'in', '7987674738', '8LaBbC5KEWsDuST4.png', 1, '1', 1, 1, '2020-09-17 11:38:23', 1, 1, '2020-09-17 11:38:23', '2020-09-17 11:38:23'),
(67, 'shikha', 'nehasharm.amindiii@gmail.com', '$2y$10$5PR6GoJqapfDTfuCblmISO/HK7y37ZttMjzju0dU1GmkDgnxaZhDi', NULL, '+91', 'in', '7890675', 'oGeiRlbFdXA9ncV3.jpeg', 1, '1', 1, 1, '2020-09-22 08:27:24', 1, 1, '2020-09-22 08:27:24', '2020-09-22 08:27:24'),
(68, 'sachin', 'sachin@gmail.com', '$2y$10$3mlIdPnJ.Tx9RyBp.Td3Eu7xR.kNeUx.cRc2oxGXMmaFHjgMOM0U.', NULL, '+91', 'in', '23654789', 'b9p3lMIWDzTYu6kL.png', 2, '1', 1, 1, '2020-09-22 09:36:46', 0, 1, '2020-09-22 09:16:07', '2020-09-22 09:16:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`adminUserID`),
  ADD UNIQUE KEY `idx_email` (`email`);

--
-- Indexes for table `air_freight_items`
--
ALTER TABLE `air_freight_items`
  ADD PRIMARY KEY (`airFreightItemID`);

--
-- Indexes for table `air_freight_order_info`
--
ALTER TABLE `air_freight_order_info`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `air_freight_services`
--
ALTER TABLE `air_freight_services`
  ADD PRIMARY KEY (`airFreightServiceID`);

--
-- Indexes for table `concierge_quotes`
--
ALTER TABLE `concierge_quotes`
  ADD PRIMARY KEY (`conciergeQuoteID`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Indexes for table `courier_services`
--
ALTER TABLE `courier_services`
  ADD PRIMARY KEY (`courierServiceID`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`inquiryID`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`optionID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD UNIQUE KEY `tracking_id` (`tracking_id`),
  ADD UNIQUE KEY `shipper_tracking_id` (`shipper_tracking_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_concierge_quote_id` (`concierge_quote_id`);

--
-- Indexes for table `sea_freight_services`
--
ALTER TABLE `sea_freight_services`
  ADD PRIMARY KEY (`seaFreightServiceID`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticketID`),
  ADD KEY `idx_user_id` (`created_by_id`);

--
-- Indexes for table `ticket_comments`
--
ALTER TABLE `ticket_comments`
  ADD PRIMARY KEY (`ticketCommentID`);

--
-- Indexes for table `ticket_comment_attachments`
--
ALTER TABLE `ticket_comment_attachments`
  ADD PRIMARY KEY (`ticketCommentAttachmentID`),
  ADD KEY `idx_ticket_comment_id` (`ticket_comment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `idx_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `adminUserID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `air_freight_items`
--
ALTER TABLE `air_freight_items`
  MODIFY `airFreightItemID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `air_freight_order_info`
--
ALTER TABLE `air_freight_order_info`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `air_freight_services`
--
ALTER TABLE `air_freight_services`
  MODIFY `airFreightServiceID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `concierge_quotes`
--
ALTER TABLE `concierge_quotes`
  MODIFY `conciergeQuoteID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `courier_services`
--
ALTER TABLE `courier_services`
  MODIFY `courierServiceID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `inquiryID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `optionID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `sea_freight_services`
--
ALTER TABLE `sea_freight_services`
  MODIFY `seaFreightServiceID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticketID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ticket_comments`
--
ALTER TABLE `ticket_comments`
  MODIFY `ticketCommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `ticket_comment_attachments`
--
ALTER TABLE `ticket_comment_attachments`
  MODIFY `ticketCommentAttachmentID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
