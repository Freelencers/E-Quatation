-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 23, 2018 at 12:58 PM
-- Server version: 5.6.37
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cp357577_develop`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessory`
--

CREATE TABLE `accessory` (
  `acc_id` int(11) NOT NULL,
  `acc_pro_id` int(11) NOT NULL,
  `acc_qty` int(11) NOT NULL,
  `acc_prj_id` int(11) NOT NULL,
  `acc_discount` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accessory`
--

INSERT INTO `accessory` (`acc_id`, `acc_pro_id`, `acc_qty`, `acc_prj_id`, `acc_discount`) VALUES
(1, 4, 1, 1, '0'),
(2, 3, 1, 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `attachment`
--

CREATE TABLE `attachment` (
  `att_id` int(11) NOT NULL,
  `att_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attachment`
--

INSERT INTO `attachment` (`att_id`, `att_name`) VALUES
(1, 'Riser'),
(2, 'Vendor list'),
(3, 'Floor plan'),
(4, 'ปริมาณ'),
(5, 'spec'),
(6, 'อื่นๆ');

-- --------------------------------------------------------

--
-- Table structure for table `attachment_log`
--

CREATE TABLE `attachment_log` (
  `atl_id` int(11) NOT NULL,
  `atl_att_id` int(11) NOT NULL,
  `atl_prj_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attachment_log`
--

INSERT INTO `attachment_log` (`atl_id`, `atl_att_id`, `atl_prj_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `bra_id` int(10) NOT NULL,
  `bra_name` varchar(50) NOT NULL,
  `bra_delete` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`bra_id`, `bra_name`, `bra_delete`) VALUES
(1, 'INOX', 0),
(2, 'PELCO', 0),
(3, 'Panasonic', 0),
(4, 'GE Security', 0),
(5, 'HID', 0),
(6, 'Galaxy', 0);

-- --------------------------------------------------------

--
-- Table structure for table `brand_log`
--

CREATE TABLE `brand_log` (
  `brl_id` int(11) NOT NULL,
  `brl_syl_id` int(11) NOT NULL,
  `brl_bra_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brand_log`
--

INSERT INTO `brand_log` (`brl_id`, `brl_syl_id`, `brl_bra_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `condition`
--

CREATE TABLE `condition` (
  `con_id` int(11) NOT NULL,
  `con_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `condition`
--

INSERT INTO `condition` (`con_id`, `con_value`) VALUES
(1, 'ราคาที่เสนอรวมกับ VAT เป็นที่เรียบร้อย'),
(2, 'ราคานี้มีผลภายใน 30 วัน'),
(3, ' บริษัทจะจัดส่งสินค้าภายใน 45 วัน นับจากวันที่ได้ร'),
(4, '30% เงินมัดจำการสั่ง ซื้อ โปรดชำระภายใน 7 วัน เมื่ออนุมัติการสั่งซื้อ'),
(5, '70% ของมูลค่าสินค้าที่จัดส่งจริงในแต่ละงวด โปรดชำระเป็น PDC เช็ค 30 วัน เมื่อได้เซ็นรับสินค้า'),
(99, 'อื่น ๆ'),
(100, 'เงื่อนไชทดสอบ02');

-- --------------------------------------------------------

--
-- Table structure for table `condition_log`
--

CREATE TABLE `condition_log` (
  `col_id` int(11) NOT NULL,
  `col_prj_id` int(11) NOT NULL,
  `col_con_id` int(11) NOT NULL,
  `col_con_other` text CHARACTER SET utf8
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `condition_log`
--

INSERT INTO `condition_log` (`col_id`, `col_prj_id`, `col_con_id`, `col_con_other`) VALUES
(1, 1, 3, NULL),
(2, 1, 4, NULL),
(3, 1, 99, 'ทดสอบ Condition'),
(4, 1, 99, 'เงื่อนไชทดสอบ'),
(5, 1, 99, 'เงื่อนไชทดสอบ02');

-- --------------------------------------------------------

--
-- Table structure for table `customer_type`
--

CREATE TABLE `customer_type` (
  `ctp_id` int(11) NOT NULL,
  `ctp_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_type`
--

INSERT INTO `customer_type` (`ctp_id`, `ctp_name`) VALUES
(1, 'Owner'),
(2, 'Main'),
(3, 'Sub-con'),
(4, 'คอนซัล'),
(5, 'ผู้ออกแบบ');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(10) NOT NULL,
  `emp_username` varchar(50) NOT NULL,
  `emp_password` varchar(50) NOT NULL,
  `emp_first_name` varchar(100) NOT NULL,
  `emp_last_name` varchar(100) NOT NULL,
  `emp_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `emp_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `emp_pos_id` int(10) NOT NULL,
  `emp_email` varchar(100) NOT NULL,
  `emp_delete` int(1) NOT NULL DEFAULT '0',
  `emp_approve` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_username`, `emp_password`, `emp_first_name`, `emp_last_name`, `emp_create`, `emp_update`, `emp_pos_id`, `emp_email`, `emp_delete`, `emp_approve`) VALUES
(106, 'admin', 'admin@2017', 'Pakorn', 'Traipan', '2017-11-22 02:39:58', '2017-11-02 15:02:21', 1, 'pakorn_traipan@icloud.com', 0, 1),
(130, 'Sale', 'Sale', 'Firstnamr', 'Lastname', '2018-01-14 07:14:18', '0000-00-00 00:00:00', 3, 'sale@company.com', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `follow_up`
--

CREATE TABLE `follow_up` (
  `fol_id` int(11) NOT NULL,
  `fol_type` int(1) NOT NULL COMMENT '0 = support, 1 = estimate',
  `fol_date` date NOT NULL,
  `fol_success` int(3) NOT NULL,
  `fol_msg` text CHARACTER SET utf8 NOT NULL,
  `fol_prj_id` int(11) NOT NULL,
  `fol_emp_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follow_up`
--

INSERT INTO `follow_up` (`fol_id`, `fol_type`, `fol_date`, `fol_success`, `fol_msg`, `fol_prj_id`, `fol_emp_id`) VALUES
(1, 1, '2018-01-14', 10, 'Follow msg 01', 1, 106),
(2, 0, '2018-01-14', 15, 'Follow up msg 01', 1, 106),
(3, 0, '2018-05-28', 0, 'test', 1, 106),
(4, 0, '2018-05-28', 0, 'test', 1, 106),
(5, 0, '2018-05-28', 0, 'test', 1, 106),
(6, 0, '2018-05-28', 0, 'test', 1, 106),
(7, 0, '2018-05-28', 0, 'test', 1, 106),
(8, 0, '2018-05-28', 0, 'test', 1, 106),
(9, 0, '2018-07-02', 0, 'TEST', 1, 106);

-- --------------------------------------------------------

--
-- Table structure for table `hardware`
--

CREATE TABLE `hardware` (
  `har_id` int(11) NOT NULL,
  `har_pro_id` int(11) DEFAULT NULL,
  `har_prj_id` int(11) NOT NULL,
  `har_qty` int(11) DEFAULT NULL,
  `har_syt_id` int(11) DEFAULT NULL,
  `har_discount` varchar(10) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hardware`
--

INSERT INTO `hardware` (`har_id`, `har_pro_id`, `har_prj_id`, `har_qty`, `har_syt_id`, `har_discount`) VALUES
(1, 2, 1, 1, 1, '10+5'),
(2, 2, 1, 1, 1, '1'),
(3, 5, 1, 5, 2, '1');

-- --------------------------------------------------------

--
-- Table structure for table `item_set`
--

CREATE TABLE `item_set` (
  `its_id` int(11) NOT NULL,
  `its_name` varchar(100) NOT NULL,
  `its_delete` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_set_log`
--

CREATE TABLE `item_set_log` (
  `isl_id` int(11) NOT NULL,
  `isl_its_id` int(11) NOT NULL,
  `isl_pro_id` int(11) NOT NULL,
  `isl_qty` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `log_id` int(11) NOT NULL,
  `log_msg` text NOT NULL,
  `log_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `log_emp_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`log_id`, `log_msg`, `log_date`, `log_emp_id`) VALUES
(1, 'Acess Employee', '2018-01-14 05:48:00', 106),
(2, 'Acess Fundamental', '2018-01-14 05:48:07', 106),
(3, 'Acess Fundamental', '2018-01-14 05:48:11', 106),
(4, 'Acess Fundamental', '2018-01-14 05:48:13', 106),
(5, 'Acess Fundamental', '2018-01-14 05:48:16', 106),
(6, 'Insert product  model:SAMPLE id:1 detail :{\"pro_id\":\"1\",\"pro_model\":\"SAMPLE\",\"pro_pic\":\"2c03174f3b4eb0fcb3f2198dd84a638d.png\",\"pro_description\":\"\",\"pro_cost\":\"1\",\"pro_price\":\"10\",\"pro_profit\":\"9\",\"pro_bra_id\":\"6\",\"pro_uni_id\":\"1\",\"pro_delete\":\"0\"}', '2018-01-14 07:08:55', 106),
(7, 'Insert product  model:SAMPLE id:2 detail :{\"pro_id\":\"2\",\"pro_model\":\"SAMPLE\",\"pro_pic\":\"aa2c1287448c2ba2023fa1d2c6f97d2d.png\",\"pro_description\":\"\",\"pro_cost\":\"1\",\"pro_price\":\"10\",\"pro_profit\":\"9\",\"pro_bra_id\":\"1\",\"pro_uni_id\":\"1\",\"pro_delete\":\"0\"}', '2018-01-14 07:09:16', 106),
(8, 'Insert product  model:SAMPLE id:3 detail :{\"pro_id\":\"3\",\"pro_model\":\"SAMPLE\",\"pro_pic\":\"110c059343d5fdae9896369c9ecc79be.png\",\"pro_description\":\"\",\"pro_cost\":\"1\",\"pro_price\":\"10\",\"pro_profit\":\"9\",\"pro_bra_id\":\"2\",\"pro_uni_id\":\"1\",\"pro_delete\":\"0\"}', '2018-01-14 07:09:33', 106),
(9, 'Insert product  model:SAMPLE id:4 detail :{\"pro_id\":\"4\",\"pro_model\":\"SAMPLE\",\"pro_pic\":\"37ad703aaa97d030a5a91df8803b636c.png\",\"pro_description\":\"\",\"pro_cost\":\"1\",\"pro_price\":\"10\",\"pro_profit\":\"9\",\"pro_bra_id\":\"3\",\"pro_uni_id\":\"0\",\"pro_delete\":\"0\"}', '2018-01-14 07:09:46', 106),
(10, 'Insert product  model:SAMPLE id:5 detail :{\"pro_id\":\"5\",\"pro_model\":\"SAMPLE\",\"pro_pic\":\"f83bda31a7af89d2ffdc079622b6d35c.png\",\"pro_description\":\"\",\"pro_cost\":\"1\",\"pro_price\":\"10\",\"pro_profit\":\"9\",\"pro_bra_id\":\"4\",\"pro_uni_id\":\"0\",\"pro_delete\":\"0\"}', '2018-01-14 07:09:59', 106),
(11, 'Insert product  model:SAMPLE id:6 detail :{\"pro_id\":\"6\",\"pro_model\":\"SAMPLE\",\"pro_pic\":\"62dc84c344486b339ab415bb91dbb208.png\",\"pro_description\":\"\",\"pro_cost\":\"1\",\"pro_price\":\"10\",\"pro_profit\":\"9\",\"pro_bra_id\":\"5\",\"pro_uni_id\":\"1\",\"pro_delete\":\"0\"}', '2018-01-14 07:10:13', 106),
(12, 'Acess Fundamental', '2018-01-14 07:12:26', 106),
(13, 'Acess Employee', '2018-01-14 07:12:35', 106),
(14, 'Acess Fundamental', '2018-01-14 07:12:38', 106),
(15, 'Acess Employee', '2018-01-14 07:13:36', 106),
(16, 'Create user Sale', '2018-01-14 07:14:13', 106),
(17, 'Approve user Sale', '2018-01-14 07:14:18', 106),
(18, 'Acess Employee', '2018-01-14 07:56:33', 106),
(19, 'Acess Employee', '2018-01-14 07:56:48', 106),
(20, 'Acess Employee', '2018-01-14 07:59:46', 106),
(21, 'Acess Fundamental', '2018-01-14 08:03:44', 106),
(22, 'Acess Fundamental', '2018-01-14 08:44:25', 106),
(23, 'Acess Employee', '2018-06-29 10:21:56', 106),
(24, 'Acess Employee', '2018-06-29 10:22:18', 106),
(25, 'Acess Fundamental', '2018-06-29 10:38:39', 106),
(26, 'Acess Employee', '2018-06-29 10:38:44', 106),
(27, 'Acess Employee', '2018-06-29 10:38:57', 106),
(28, 'Acess Employee', '2018-07-02 04:49:25', 106),
(29, 'Acess Employee', '2018-07-02 04:49:29', 106),
(30, 'Acess Employee', '2018-07-02 04:50:10', 106),
(31, 'Acess Employee', '2018-07-02 04:50:55', 106),
(32, 'Acess Employee', '2018-07-02 08:52:24', 106),
(33, 'Acess Employee', '2018-07-02 08:52:33', 106),
(34, 'Acess Employee', '2018-07-02 08:52:50', 106),
(35, 'Acess Employee', '2018-07-02 09:20:18', 106),
(36, 'Acess Fundamental', '2018-07-02 09:20:34', 106),
(37, 'Acess Fundamental', '2018-07-02 09:21:56', 106);

-- --------------------------------------------------------

--
-- Table structure for table `permission_module`
--

CREATE TABLE `permission_module` (
  `pmm_id` int(11) NOT NULL,
  `pmm_emp_id` int(11) NOT NULL,
  `pmm_stm_id` int(11) NOT NULL,
  `pmm_read` int(1) NOT NULL DEFAULT '0',
  `pmm_copy` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission_module`
--

INSERT INTO `permission_module` (`pmm_id`, `pmm_emp_id`, `pmm_stm_id`, `pmm_read`, `pmm_copy`) VALUES
(7, 106, 1, 1, 0),
(8, 106, 2, 1, 0),
(9, 106, 3, 1, 0),
(10, 106, 4, 1, 0),
(11, 106, 5, 1, 0),
(12, 106, 6, 1, 0),
(168, 106, 7, 1, 0),
(167, 130, 7, 0, 0),
(166, 130, 6, 0, 0),
(165, 130, 5, 0, 0),
(164, 130, 4, 0, 0),
(163, 130, 3, 0, 0),
(162, 130, 2, 0, 0),
(161, 130, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `place_type`
--

CREATE TABLE `place_type` (
  `plt_id` int(11) NOT NULL,
  `plt_name` varchar(50) NOT NULL,
  `plt_delete` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `place_type`
--

INSERT INTO `place_type` (`plt_id`, `plt_name`, `plt_delete`) VALUES
(1, 'Hospital', 0),
(2, 'Plaza', 0),
(3, 'Condo', 0),
(4, 'Hotel', 0),
(5, 'Factory', 0);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `pos_id` int(10) NOT NULL,
  `pos_name` varchar(50) NOT NULL,
  `pos_piority` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`pos_id`, `pos_name`, `pos_piority`) VALUES
(1, 'Super User', 1),
(2, 'Admin', 2),
(3, 'Sale', 3),
(4, 'Estimate', 3),
(5, 'Support', 3);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pro_id` int(10) NOT NULL,
  `pro_model` varchar(50) NOT NULL,
  `pro_pic` varchar(255) DEFAULT NULL,
  `pro_description` varchar(255) DEFAULT NULL,
  `pro_cost` double NOT NULL,
  `pro_price` double NOT NULL,
  `pro_profit` double NOT NULL,
  `pro_bra_id` int(10) NOT NULL,
  `pro_uni_id` int(11) NOT NULL DEFAULT '1',
  `pro_delete` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pro_id`, `pro_model`, `pro_pic`, `pro_description`, `pro_cost`, `pro_price`, `pro_profit`, `pro_bra_id`, `pro_uni_id`, `pro_delete`) VALUES
(1, 'SAMPLE', '2c03174f3b4eb0fcb3f2198dd84a638d.png', '', 1, 10, 9, 6, 1, 0),
(2, 'SAMPLE', 'aa2c1287448c2ba2023fa1d2c6f97d2d.png', '', 1, 10, 9, 1, 1, 0),
(3, 'SAMPLE', '110c059343d5fdae9896369c9ecc79be.png', '', 1, 10, 9, 2, 1, 0),
(4, 'SAMPLE', '37ad703aaa97d030a5a91df8803b636c.png', '', 1, 10, 9, 3, 1, 0),
(5, 'SAMPLE', 'f83bda31a7af89d2ffdc079622b6d35c.png', '', 1, 10, 9, 4, 1, 0),
(6, 'SAMPLE', '62dc84c344486b339ab415bb91dbb208.png', '', 1, 10, 9, 5, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `prj_id` int(11) NOT NULL,
  `prj_ref_no` varchar(50) NOT NULL,
  `prj_title` varchar(255) NOT NULL,
  `prj_company` varchar(255) NOT NULL,
  `prj_contact` varchar(100) DEFAULT NULL,
  `prj_mobile` varchar(15) DEFAULT NULL,
  `prj_tel` varchar(15) DEFAULT NULL,
  `prj_fax` varchar(15) DEFAULT NULL,
  `prj_email` varchar(100) NOT NULL,
  `prj_ctp_id` int(1) NOT NULL,
  `prj_regular_customer` int(11) NOT NULL,
  `prj_customer_name` varchar(255) NOT NULL,
  `prj_wot_date` date DEFAULT NULL,
  `prj_att_file` varchar(255) DEFAULT NULL,
  `prj_att_location` varchar(255) DEFAULT NULL,
  `prj_parent_id` int(11) DEFAULT NULL,
  `prj_version` varchar(2) DEFAULT NULL,
  `prj_last_version` int(11) NOT NULL DEFAULT '0',
  `prj_discount` double DEFAULT '0',
  `prj_vat` int(11) NOT NULL DEFAULT '7',
  `prj_price` double NOT NULL DEFAULT '0',
  `prj_plt_id` int(11) NOT NULL,
  `prj_wor_id` int(10) NOT NULL,
  `prj_sta_id` int(10) NOT NULL,
  `prj_emp_id` int(10) NOT NULL,
  `prj_delete` int(1) NOT NULL DEFAULT '0',
  `prj_create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`prj_id`, `prj_ref_no`, `prj_title`, `prj_company`, `prj_contact`, `prj_mobile`, `prj_tel`, `prj_fax`, `prj_email`, `prj_ctp_id`, `prj_regular_customer`, `prj_customer_name`, `prj_wot_date`, `prj_att_file`, `prj_att_location`, `prj_parent_id`, `prj_version`, `prj_last_version`, `prj_discount`, `prj_vat`, `prj_price`, `prj_plt_id`, `prj_wor_id`, `prj_sta_id`, `prj_emp_id`, `prj_delete`, `prj_create_date`) VALUES
(1, '20180114001', 'Fist project', 'Company name', 'Fistname Lastname', '(088) 888-8888', '(088) 888-8888', '(088) 888-8888', 'sale@company.com', 1, 0, 'Customer_01', '2018-01-03', '', '', NULL, NULL, 0, 0, 7, 201, 2, 2, 1, 130, 0, '2018-01-14 14:16:22');

-- --------------------------------------------------------

--
-- Table structure for table `quatation`
--

CREATE TABLE `quatation` (
  `qua_id` int(11) NOT NULL,
  `qua_sale_msg` varchar(255) DEFAULT NULL,
  `qua_est_msg` varchar(255) DEFAULT NULL,
  `qua_prj_id` int(11) NOT NULL,
  `qua_syt_id` int(10) NOT NULL,
  `qua_bra_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `scope_of_work`
--

CREATE TABLE `scope_of_work` (
  `sow_id` int(11) NOT NULL,
  `sow_value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scope_of_work`
--

INSERT INTO `scope_of_work` (`sow_id`, `sow_value`) VALUES
(1, 'ให้บริการแนะนำ  การติดตั้งเป็นระยะ 1 ครั้ง'),
(2, 'รับประกันสินค้า และบริการ  เป็นระยะเวลา 1 ปี'),
(3, ' เอกสารคู่มือ จำนวน 3 ชุด'),
(9, 'xxxxxx'),
(10, 'fffff'),
(99, 'อื่น ๆ');

-- --------------------------------------------------------

--
-- Table structure for table `scope_of_work_log`
--

CREATE TABLE `scope_of_work_log` (
  `sol_id` int(11) NOT NULL,
  `sol_sow_id` int(11) NOT NULL,
  `sol_sow_other` text CHARACTER SET utf8 NOT NULL,
  `sol_prj_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scope_of_work_log`
--

INSERT INTO `scope_of_work_log` (`sol_id`, `sol_sow_id`, `sol_sow_other`, `sol_prj_id`) VALUES
(1, 2, '', 1),
(2, 99, 'ทดสอบ scope of work', 1),
(3, 99, 'xxxxxx', 1),
(4, 99, 'fffff', 1);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `ser_id` int(11) NOT NULL,
  `ser_name` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`ser_id`, `ser_name`) VALUES
(1, 'ค่าส่งของ (วัน)'),
(2, 'ค่าอบรม (วัน)'),
(3, 'ค่าส่งงาน (วัน)'),
(4, 'ค่าช่างคุมงาน (วัน)'),
(5, 'ค่า Engineer'),
(6, 'ค่าเบี้ยเลี้ยง ตจว. (วัน)'),
(7, 'ค่าทางด่วน (ไป-กลับ)'),
(8, 'ค่าเดินทาง (ครั้ง)'),
(9, 'ค่าที่พัก'),
(10, 'Service'),
(11, 'Warranty'),
(12, 'ค่าดำเดินการต่าง ๆ'),
(15, 'gggg'),
(99, 'อื่น ๆ');

-- --------------------------------------------------------

--
-- Table structure for table `service_log`
--

CREATE TABLE `service_log` (
  `sel_id` int(11) NOT NULL,
  `sel_prj_id` int(11) NOT NULL,
  `sel_ser_id` int(11) NOT NULL,
  `sel_ser_other` text,
  `sel_ser_price` int(11) NOT NULL,
  `sel_ser_unit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_log`
--

INSERT INTO `service_log` (`sel_id`, `sel_prj_id`, `sel_ser_id`, `sel_ser_other`, `sel_ser_price`, `sel_ser_unit`) VALUES
(1, 1, 2, NULL, 10, 5),
(2, 1, 6, NULL, 4, 5),
(3, 1, 99, 'rrrr', 11, 11),
(4, 1, 99, 'gggg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `sta_id` int(10) NOT NULL,
  `sta_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`sta_id`, `sta_name`) VALUES
(1, 'ได้งานแล้ว'),
(2, 'Bidding'),
(3, 'จบราคา'),
(4, 'ทำ Budget'),
(5, 'เสนอให้ Owner'),
(6, 'เสนอให้นิติบุคคล'),
(7, 'เพิ่มงาน'),
(8, 'งานลด');

-- --------------------------------------------------------

--
-- Table structure for table `system_log`
--

CREATE TABLE `system_log` (
  `syl_id` int(11) NOT NULL,
  `syl_prj_id` int(11) NOT NULL,
  `syl_syt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_log`
--

INSERT INTO `system_log` (`syl_id`, `syl_prj_id`, `syl_syt_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `system_module`
--

CREATE TABLE `system_module` (
  `stm_id` int(11) NOT NULL,
  `stm_name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_module`
--

INSERT INTO `system_module` (`stm_id`, `stm_name`) VALUES
(1, 'Employee'),
(2, 'Setting'),
(3, 'Project'),
(4, 'Quatation'),
(5, 'Follow up'),
(6, 'Report'),
(7, 'Log');

-- --------------------------------------------------------

--
-- Table structure for table `system_type`
--

CREATE TABLE `system_type` (
  `syt_id` int(10) NOT NULL,
  `syt_name` varchar(50) NOT NULL,
  `syt_delete` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_type`
--

INSERT INTO `system_type` (`syt_id`, `syt_name`, `syt_delete`) VALUES
(1, 'CCTV', 0),
(2, 'Fire Alarm', 0),
(3, 'Access Control', 0),
(4, 'Other', 0);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `uni_id` int(11) NOT NULL,
  `uni_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`uni_id`, `uni_name`) VALUES
(1, 'ชิ้น'),
(2, 'อัน'),
(3, 'กล่อง'),
(4, 'คู่');

-- --------------------------------------------------------

--
-- Table structure for table `work_type`
--

CREATE TABLE `work_type` (
  `wor_id` int(10) NOT NULL,
  `wor_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `work_type`
--

INSERT INTO `work_type` (`wor_id`, `wor_name`) VALUES
(1, 'ปกติ'),
(2, 'ปกติด่วน'),
(3, 'ได้งานแล้ว'),
(4, 'ได้งานแล้วด่วน');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessory`
--
ALTER TABLE `accessory`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `attachment`
--
ALTER TABLE `attachment`
  ADD PRIMARY KEY (`att_id`);

--
-- Indexes for table `attachment_log`
--
ALTER TABLE `attachment_log`
  ADD PRIMARY KEY (`atl_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`bra_id`);

--
-- Indexes for table `brand_log`
--
ALTER TABLE `brand_log`
  ADD PRIMARY KEY (`brl_id`);

--
-- Indexes for table `condition`
--
ALTER TABLE `condition`
  ADD PRIMARY KEY (`con_id`);

--
-- Indexes for table `condition_log`
--
ALTER TABLE `condition_log`
  ADD PRIMARY KEY (`col_id`);

--
-- Indexes for table `customer_type`
--
ALTER TABLE `customer_type`
  ADD PRIMARY KEY (`ctp_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `follow_up`
--
ALTER TABLE `follow_up`
  ADD PRIMARY KEY (`fol_id`);

--
-- Indexes for table `hardware`
--
ALTER TABLE `hardware`
  ADD PRIMARY KEY (`har_id`);

--
-- Indexes for table `item_set`
--
ALTER TABLE `item_set`
  ADD PRIMARY KEY (`its_id`);

--
-- Indexes for table `item_set_log`
--
ALTER TABLE `item_set_log`
  ADD PRIMARY KEY (`isl_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `permission_module`
--
ALTER TABLE `permission_module`
  ADD PRIMARY KEY (`pmm_id`);

--
-- Indexes for table `place_type`
--
ALTER TABLE `place_type`
  ADD PRIMARY KEY (`plt_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`pos_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`prj_id`);

--
-- Indexes for table `quatation`
--
ALTER TABLE `quatation`
  ADD PRIMARY KEY (`qua_id`);

--
-- Indexes for table `scope_of_work`
--
ALTER TABLE `scope_of_work`
  ADD PRIMARY KEY (`sow_id`);

--
-- Indexes for table `scope_of_work_log`
--
ALTER TABLE `scope_of_work_log`
  ADD PRIMARY KEY (`sol_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ser_id`);

--
-- Indexes for table `service_log`
--
ALTER TABLE `service_log`
  ADD PRIMARY KEY (`sel_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`sta_id`);

--
-- Indexes for table `system_log`
--
ALTER TABLE `system_log`
  ADD PRIMARY KEY (`syl_id`);

--
-- Indexes for table `system_module`
--
ALTER TABLE `system_module`
  ADD PRIMARY KEY (`stm_id`);

--
-- Indexes for table `system_type`
--
ALTER TABLE `system_type`
  ADD PRIMARY KEY (`syt_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`uni_id`);

--
-- Indexes for table `work_type`
--
ALTER TABLE `work_type`
  ADD PRIMARY KEY (`wor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessory`
--
ALTER TABLE `accessory`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `attachment`
--
ALTER TABLE `attachment`
  MODIFY `att_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `attachment_log`
--
ALTER TABLE `attachment_log`
  MODIFY `atl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `bra_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `brand_log`
--
ALTER TABLE `brand_log`
  MODIFY `brl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `condition`
--
ALTER TABLE `condition`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `condition_log`
--
ALTER TABLE `condition_log`
  MODIFY `col_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `customer_type`
--
ALTER TABLE `customer_type`
  MODIFY `ctp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
--
-- AUTO_INCREMENT for table `follow_up`
--
ALTER TABLE `follow_up`
  MODIFY `fol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `hardware`
--
ALTER TABLE `hardware`
  MODIFY `har_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `item_set`
--
ALTER TABLE `item_set`
  MODIFY `its_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_set_log`
--
ALTER TABLE `item_set_log`
  MODIFY `isl_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `permission_module`
--
ALTER TABLE `permission_module`
  MODIFY `pmm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;
--
-- AUTO_INCREMENT for table `place_type`
--
ALTER TABLE `place_type`
  MODIFY `plt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `pos_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pro_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `prj_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `quatation`
--
ALTER TABLE `quatation`
  MODIFY `qua_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `scope_of_work`
--
ALTER TABLE `scope_of_work`
  MODIFY `sow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `scope_of_work_log`
--
ALTER TABLE `scope_of_work_log`
  MODIFY `sol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `ser_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `service_log`
--
ALTER TABLE `service_log`
  MODIFY `sel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `sta_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `system_log`
--
ALTER TABLE `system_log`
  MODIFY `syl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `system_module`
--
ALTER TABLE `system_module`
  MODIFY `stm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `system_type`
--
ALTER TABLE `system_type`
  MODIFY `syt_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `uni_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `work_type`
--
ALTER TABLE `work_type`
  MODIFY `wor_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
