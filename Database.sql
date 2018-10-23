-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 23, 2018 at 12:55 PM
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
-- Database: `cp357577_otec`
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
  `acc_discount` varchar(10) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accessory`
--

INSERT INTO `accessory` (`acc_id`, `acc_pro_id`, `acc_qty`, `acc_prj_id`, `acc_discount`) VALUES
(1, 5, 1, 1, '0'),
(2, 4, 5, 1, '0');

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
(1, 'Rise'),
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
(2, 4, 1);

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
(6, 'Galaxy', 0),
(7, 'test_del', 1),
(8, 'testss', 1);

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
(1, 1, 3),
(2, 1, 5),
(3, 2, 2),
(4, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `condition`
--

CREATE TABLE `condition` (
  `con_id` int(11) NOT NULL,
  `con_value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `condition`
--

INSERT INTO `condition` (`con_id`, `con_value`) VALUES
(1, 'ทดสอบเงื่อนไข');

-- --------------------------------------------------------

--
-- Table structure for table `condition_log`
--

CREATE TABLE `condition_log` (
  `col_id` int(11) UNSIGNED NOT NULL,
  `col_prj_id` int(11) NOT NULL,
  `col_con_id` int(11) NOT NULL,
  `col_con_other` text CHARACTER SET utf8
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(106, 'admin', 'admin@2017', 'Admin', 'Admin', '2017-11-19 14:28:14', '2017-11-02 15:02:21', 1, 'admin@admin.com', 0, 1),
(124, 'sale', 'sale@2017', 'Sale', 'Sale', '2017-11-19 15:10:13', '0000-00-00 00:00:00', 3, 'sale@sale.com', 0, 1),
(125, 'support', 'support@2017', 'Support', 'Support', '2017-11-19 15:10:18', '0000-00-00 00:00:00', 5, 'support@support.com', 0, 1),
(126, 'estimate', 'estimate@2017', 'Estimate', 'Estimate', '2017-11-19 15:10:16', '0000-00-00 00:00:00', 4, 'estimate@estimate.com', 0, 1),
(127, 'assistance', 'assistance@2017', 'Assistance', 'Assistance', '2017-11-19 15:10:50', '0000-00-00 00:00:00', 2, 'assistance', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `follow_up`
--

CREATE TABLE `follow_up` (
  `fol_id` int(11) NOT NULL,
  `fol_type` int(1) NOT NULL COMMENT '0 = support, 1 = estimate',
  `fol_date` date NOT NULL,
  `fol_success` int(3) NOT NULL,
  `fol_msg` text NOT NULL,
  `fol_prj_id` int(11) NOT NULL,
  `fol_emp_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `follow_up`
--

INSERT INTO `follow_up` (`fol_id`, `fol_type`, `fol_date`, `fol_success`, `fol_msg`, `fol_prj_id`, `fol_emp_id`) VALUES
(1, 0, '2017-11-19', 10, 'DEMO', 1, 106),
(2, 1, '2017-11-19', 10, 'DEMO', 1, 106);

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
(1, 1, 1, 5, 1, '0'),
(2, 4, 1, 5, 1, '0'),
(3, 5, 1, 10, 1, '0');

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
(1, 'Acess Employee', '2017-11-19 15:03:01', 106),
(2, 'Acess Fundamental', '2017-11-19 15:03:17', 106),
(3, 'Acess Employee', '2017-11-19 15:03:49', 106),
(4, 'Acess Employee', '2017-11-19 15:04:30', 106),
(5, 'Acess Employee', '2017-11-19 15:04:52', 106),
(6, 'Acess Employee', '2017-11-19 15:05:01', 106),
(7, 'Acess Fundamental', '2017-11-19 15:05:04', 106),
(8, 'Acess Employee', '2017-11-19 15:07:27', 106),
(9, 'Create user sale', '2017-11-19 15:07:58', 106),
(10, 'Create user support', '2017-11-19 15:08:40', 106),
(11, 'Create user estimate', '2017-11-19 15:09:11', 106),
(12, 'Grand permission user sale', '2017-11-19 15:09:27', 106),
(13, 'Grand permission user sale', '2017-11-19 15:09:28', 106),
(14, 'Grand permission user sale', '2017-11-19 15:09:28', 106),
(15, 'Grand permission user sale', '2017-11-19 15:09:29', 106),
(16, 'Grand permission user sale', '2017-11-19 15:09:30', 106),
(17, 'Grand permission user sale', '2017-11-19 15:09:31', 106),
(18, 'Grand permission user sale', '2017-11-19 15:09:32', 106),
(19, 'Grand permission user estimate', '2017-11-19 15:09:37', 106),
(20, 'Grand permission user estimate', '2017-11-19 15:09:38', 106),
(21, 'Grand permission user estimate', '2017-11-19 15:09:39', 106),
(22, 'Grand permission user estimate', '2017-11-19 15:09:40', 106),
(23, 'Grand permission user estimate', '2017-11-19 15:09:41', 106),
(24, 'Grand permission user estimate', '2017-11-19 15:09:41', 106),
(25, 'Grand permission user estimate', '2017-11-19 15:09:42', 106),
(26, 'Grand permission user support', '2017-11-19 15:09:46', 106),
(27, 'Grand permission user support', '2017-11-19 15:09:47', 106),
(28, 'Grand permission user support', '2017-11-19 15:09:48', 106),
(29, 'Grand permission user support', '2017-11-19 15:09:49', 106),
(30, 'Grand permission user support', '2017-11-19 15:09:49', 106),
(31, 'Grand permission user support', '2017-11-19 15:09:50', 106),
(32, 'Grand permission user support', '2017-11-19 15:09:51', 106),
(33, 'Approve user sale', '2017-11-19 15:10:13', 106),
(34, 'Approve user estimate', '2017-11-19 15:10:16', 106),
(35, 'Approve user support', '2017-11-19 15:10:18', 106),
(36, 'Create user assistance', '2017-11-19 15:10:50', 106),
(37, 'Acess Employee', '2017-11-19 15:15:42', 106),
(38, 'Acess Employee', '2017-11-19 17:41:32', 106),
(39, 'Acess Employee', '2017-11-20 12:12:05', 106),
(40, 'Acess Fundamental', '2017-11-20 12:12:12', 106),
(41, 'Acess Employee', '2017-11-21 17:17:18', 106),
(42, 'Acess Employee', '2017-11-21 17:18:18', 106),
(43, 'Acess Employee', '2018-03-05 02:41:16', 106),
(44, 'Acess Employee', '2018-05-28 08:42:55', 106),
(45, 'Acess Employee', '2018-05-28 08:42:59', 106),
(46, 'Acess Employee', '2018-05-28 08:44:56', 106),
(47, 'Acess Employee', '2018-05-28 08:45:55', 106),
(48, 'Acess Fundamental', '2018-05-28 08:46:26', 106),
(49, 'Acess Employee', '2018-05-28 08:47:21', 106),
(50, 'Acess Employee', '2018-05-28 08:47:50', 106),
(51, 'Acess Employee', '2018-08-24 15:22:40', 106);

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
(146, 127, 7, 0, 0),
(145, 127, 6, 0, 0),
(144, 127, 5, 0, 0),
(143, 127, 4, 0, 0),
(142, 127, 3, 0, 0),
(141, 127, 2, 0, 0),
(140, 127, 1, 0, 0),
(139, 126, 7, 1, 0),
(138, 126, 6, 1, 0),
(137, 126, 5, 1, 0),
(136, 126, 4, 1, 0),
(135, 126, 3, 1, 0),
(134, 126, 2, 1, 0),
(133, 126, 1, 1, 0),
(132, 125, 7, 1, 0),
(131, 125, 6, 1, 0),
(130, 125, 5, 1, 0),
(129, 125, 4, 1, 0),
(128, 125, 3, 1, 0),
(127, 125, 2, 1, 0),
(126, 125, 1, 1, 0),
(125, 124, 7, 1, 0),
(124, 124, 6, 1, 0),
(123, 124, 5, 1, 0),
(122, 124, 4, 1, 0),
(121, 124, 3, 1, 0),
(120, 124, 2, 1, 0),
(119, 124, 1, 1, 0),
(118, 106, 7, 1, 0);

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
  `pro_uni_id` int(11) NOT NULL,
  `pro_delete` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pro_id`, `pro_model`, `pro_pic`, `pro_description`, `pro_cost`, `pro_price`, `pro_profit`, `pro_bra_id`, `pro_uni_id`, `pro_delete`) VALUES
(1, 'MODEL', 'f2c7e4e54b9be25401688ea9a4e77568.png', 'DEMO', 10, 20, 10, 1, 1, 0),
(2, 'MODEL', 'f878fed9b3de43ec832334cd12bb8479.png', 'DEMO', 10, 20, 10, 1, 2, 0),
(3, 'MODEL', '93cc731a5f2da212c4528da133868309.png', 'DEMO', 10, 20, 10, 1, 2, 0),
(4, 'MODEL', '5bb060e2984b56e044af3ed31ad52cc1.png', 'DEMO', 10, 20, 10, 2, 3, 0),
(5, 'MODEL', '0662c747ae5b12c4112080eaeace7ded.png', 'DEMO', 10, 20, 10, 3, 3, 0);

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
  `prj_discount` double DEFAULT '0',
  `prj_price` double NOT NULL DEFAULT '0',
  `prj_plt_id` int(11) NOT NULL,
  `prj_wor_id` int(10) NOT NULL,
  `prj_sta_id` int(10) NOT NULL,
  `prj_emp_id` int(10) NOT NULL,
  `prj_delete` int(1) NOT NULL DEFAULT '0',
  `prj_create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `prj_vat` int(11) DEFAULT '7',
  `prj_last_version` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`prj_id`, `prj_ref_no`, `prj_title`, `prj_company`, `prj_contact`, `prj_mobile`, `prj_tel`, `prj_fax`, `prj_email`, `prj_ctp_id`, `prj_regular_customer`, `prj_customer_name`, `prj_wot_date`, `prj_att_file`, `prj_att_location`, `prj_parent_id`, `prj_version`, `prj_discount`, `prj_price`, `prj_plt_id`, `prj_wor_id`, `prj_sta_id`, `prj_emp_id`, `prj_delete`, `prj_create_date`, `prj_vat`, `prj_last_version`) VALUES
(1, '201711191', 'DEMO', 'DEMO', 'DEMO', '(000) 000-0000', '(000) 000-0000', '(000) 000-0000', 'demo@demo.com', 1, 1, 'DEMO', '2017-11-22', 'C:\\fakepath\\box.png', 'DEMO', NULL, NULL, 0, 260, 1, 1, 1, 124, 0, '2018-05-28 08:49:36', 7, 0);

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
  `sow_value` varchar(50) NOT NULL,
  `sow_prj_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scope_of_work`
--

INSERT INTO `scope_of_work` (`sow_id`, `sow_value`, `sow_prj_id`) VALUES
(1, 'ทดสอบขอบเขตงาน', 1);

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
(11, 'Warranty');

-- --------------------------------------------------------

--
-- Table structure for table `service_log`
--

CREATE TABLE `service_log` (
  `sel_id` int(11) NOT NULL,
  `sel_prj_id` int(11) NOT NULL,
  `sel_ser_id` int(11) NOT NULL,
  `sel_ser_price` int(11) DEFAULT '0',
  `sel_ser_other` text,
  `sel_ser_unit` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_log`
--

INSERT INTO `service_log` (`sel_id`, `sel_prj_id`, `sel_ser_id`, `sel_ser_price`, `sel_ser_other`, `sel_ser_unit`) VALUES
(1, 1, 1, 1000, NULL, 1),
(2, 1, 4, 2500, NULL, 1);

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
  MODIFY `atl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `condition_log`
--
ALTER TABLE `condition_log`
  MODIFY `col_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer_type`
--
ALTER TABLE `customer_type`
  MODIFY `ctp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
--
-- AUTO_INCREMENT for table `follow_up`
--
ALTER TABLE `follow_up`
  MODIFY `fol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `permission_module`
--
ALTER TABLE `permission_module`
  MODIFY `pmm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;
--
-- AUTO_INCREMENT for table `place_type`
--
ALTER TABLE `place_type`
  MODIFY `plt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `pos_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pro_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
  MODIFY `sow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `ser_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `service_log`
--
ALTER TABLE `service_log`
  MODIFY `sel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `syt_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
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
