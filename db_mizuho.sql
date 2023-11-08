-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 15, 2015 at 10:24 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_mizuho`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_accountholdermaster`
--

CREATE TABLE IF NOT EXISTS `tb_accountholdermaster` (
  `ach_Id` int(11) NOT NULL AUTO_INCREMENT,
  `ach_account_No` int(12) NOT NULL,
  `ach_account_Name` varchar(40) NOT NULL,
  `ach_Bearer_Order` int(1) NOT NULL,
  `ach_Transaction_Code` int(15) NOT NULL,
  `ach_At_Par` int(1) NOT NULL,
  `ach_Joint_Name1` varchar(40) NOT NULL,
  `ach_Joint_Name2` varchar(40) NOT NULL,
  `ach_Authorized_Signatory1` varchar(25) NOT NULL,
  `ach_Authorized_Signatory2` varchar(25) NOT NULL,
  `ach_Authorized_Signatory3` varchar(25) NOT NULL,
  `ach_Address1` varchar(200) NOT NULL,
  `ach_Address2` varchar(200) NOT NULL,
  `ach_Suburb` int(10) NOT NULL,
  `ach_City` int(10) NOT NULL,
  `ach_State` int(6) NOT NULL,
  `ach_Country` int(3) NOT NULL,
  `ach_Pincode` int(12) NOT NULL,
  `ach_Telephone_Residence` int(12) NOT NULL,
  `ach_Telephone_Office` int(12) NOT NULL,
  `ach_Mobile_No` int(12) NOT NULL,
  `ach_Branch` int(11) NOT NULL,
  `ach_emailId` varchar(30) NOT NULL,
  PRIMARY KEY (`ach_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tb_accountholdermaster`
--

INSERT INTO `tb_accountholdermaster` (`ach_Id`, `ach_account_No`, `ach_account_Name`, `ach_Bearer_Order`, `ach_Transaction_Code`, `ach_At_Par`, `ach_Joint_Name1`, `ach_Joint_Name2`, `ach_Authorized_Signatory1`, `ach_Authorized_Signatory2`, `ach_Authorized_Signatory3`, `ach_Address1`, `ach_Address2`, `ach_Suburb`, `ach_City`, `ach_State`, `ach_Country`, `ach_Pincode`, `ach_Telephone_Residence`, `ach_Telephone_Office`, `ach_Mobile_No`, `ach_Branch`, `ach_emailId`) VALUES
(1, 1001223322, 'RAKESH SHAH', 0, 1, 0, 'RAKESH LUCKY', '', 'SIGN 1', '', '', 'VIKRILI', 'VIKRILI', 3, 1, 1, 105, 400030, 2147483647, 2147483647, 2147483647, 2, 'ach@gmail.com'),
(2, 1001223311, 'LIJESH SHARMA', 0, 1, 0, 'RAKESH LUCKY', '', 'SIGN 1', '', '', 'VIKRILI', 'VIKRILI', 3, 1, 1, 105, 400030, 2147483647, 2147483647, 2147483647, 5, 'lig@gmail.com'),
(5, 1001223344, 'RAKESH SHAHP', 0, 1, 0, 'RAKESH LUCKY', '', 'SIGN 1', '', '', 'VIKRILI', 'VIKRILI', 3, 1, 1, 105, 400030, 2147483647, 2147483647, 2147483647, 0, ''),
(6, 1001223341, 'HSDF', 0, 1, 0, '', '', 'SIGN 1', '', '', 'VIKRILI', 'VIKRILI', 3, 1, 1, 105, 400030, 2147483647, 2147483647, 2147483647, 0, 'ach@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bankdetails`
--

CREATE TABLE IF NOT EXISTS `tb_bankdetails` (
  `bank_id` int(4) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(46) NOT NULL,
  `bank_code` int(3) unsigned zerofill NOT NULL,
  `bank_address1` text NOT NULL,
  `bank_address2` varchar(36) NOT NULL,
  `bank_address3` varchar(36) NOT NULL,
  `bank_country_id` int(3) NOT NULL,
  `bank_state_id` int(3) NOT NULL,
  `bank_city_id` int(3) NOT NULL,
  `bank_suburb_id` int(3) NOT NULL,
  `bank_pin` varchar(15) NOT NULL,
  `bank_contact_no1` varchar(15) NOT NULL,
  `bank_contact_no2` varchar(15) NOT NULL,
  `bank_contact_per1` varchar(40) NOT NULL,
  `bank_contact_per2` varchar(40) NOT NULL,
  `bank_contact_per_LL1` int(12) NOT NULL,
  `bank_contact_per_LL2` int(12) NOT NULL,
  `bank_emailid2` varchar(30) NOT NULL,
  `bank_emailid` varchar(40) NOT NULL,
  `bank_website` varchar(40) NOT NULL,
  `bank_printers` text NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_bankdetails`
--

INSERT INTO `tb_bankdetails` (`bank_id`, `bank_name`, `bank_code`, `bank_address1`, `bank_address2`, `bank_address3`, `bank_country_id`, `bank_state_id`, `bank_city_id`, `bank_suburb_id`, `bank_pin`, `bank_contact_no1`, `bank_contact_no2`, `bank_contact_per1`, `bank_contact_per2`, `bank_contact_per_LL1`, `bank_contact_per_LL2`, `bank_emailid2`, `bank_emailid`, `bank_website`, `bank_printers`) VALUES
(0001, 'GOPINATH PATIL PARSIK JANATA S', 524, 'SHIVAJI PATH', 'POST BOX 19', 'THANE (W)', 1, 2, 7, 8, '401203', '', '', '', '', 0, 0, '', '', 'http://www.gpparsikbank.com/', 'a:1:{i:0;a:3:{i:0;s:13:"Canon LBP3300";i:1;s:6:"Tray 2";i:2;s:6:"Tray 3";}}'),
(0002, 'GOPINATH PATIL PARSIK JANATA S', 524, 'SHIVAJI PATH', 'POST BOX 19', 'THANE (W)', 1, 2, 7, 8, '401203', '', '', '', '', 0, 0, '', '', 'http://www.gpparsikbank.com/', 'a:1:{i:0;a:3:{i:0;s:13:"Canon LBP3300";i:1;s:6:"Tray 2";i:2;s:6:"Tray 3";}}');

-- --------------------------------------------------------

--
-- Table structure for table `tb_branchdetails`
--

CREATE TABLE IF NOT EXISTS `tb_branchdetails` (
  `branch_id` int(200) NOT NULL AUTO_INCREMENT,
  `branch_code` int(3) unsigned zerofill NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `branch_micr` varchar(20) NOT NULL,
  `branch_atparmicrcode` varchar(20) NOT NULL,
  `branch_address1` varchar(35) NOT NULL,
  `branch_address2` varchar(35) NOT NULL,
  `branch_address3` varchar(35) NOT NULL,
  `branch_country_id` int(3) NOT NULL DEFAULT '0',
  `branch_state_id` int(11) NOT NULL,
  `branch_city_id` int(11) NOT NULL,
  `branch_suburb_id` int(4) NOT NULL,
  `branch_pin` int(15) NOT NULL,
  `branch_telephone1` varchar(12) NOT NULL,
  `branch_telephone2` varchar(12) NOT NULL,
  `branch_contactperson1` varchar(50) NOT NULL,
  `branch_contactperson2` varchar(50) NOT NULL,
  `branch_contactpersonmobile1` varchar(50) NOT NULL,
  `branch_contactpersonmobile2` varchar(50) NOT NULL,
  `branch_email1` varchar(30) NOT NULL,
  `branch_email2` varchar(30) NOT NULL,
  `branch_holiday` varchar(20) NOT NULL,
  `branch_neftifsccode` varchar(20) NOT NULL,
  `branch_printers` text,
  `branch_working_hours` float NOT NULL,
  `branch_clearingthrough` tinyint(1) NOT NULL DEFAULT '0',
  `branch_clearingcenter` tinyint(1) NOT NULL DEFAULT '0',
  `clr_bank_code` varchar(15) NOT NULL,
  `clr_bank_city` int(5) NOT NULL,
  `branch_City_Code` int(3) unsigned zerofill NOT NULL,
  `branch_Services` varchar(30) NOT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tb_branchdetails`
--

INSERT INTO `tb_branchdetails` (`branch_id`, `branch_code`, `branch_name`, `branch_micr`, `branch_atparmicrcode`, `branch_address1`, `branch_address2`, `branch_address3`, `branch_country_id`, `branch_state_id`, `branch_city_id`, `branch_suburb_id`, `branch_pin`, `branch_telephone1`, `branch_telephone2`, `branch_contactperson1`, `branch_contactperson2`, `branch_contactpersonmobile1`, `branch_contactpersonmobile2`, `branch_email1`, `branch_email2`, `branch_holiday`, `branch_neftifsccode`, `branch_printers`, `branch_working_hours`, `branch_clearingthrough`, `branch_clearingcenter`, `clr_bank_code`, `clr_bank_city`, `branch_City_Code`, `branch_Services`) VALUES
(13, 312, 'VASAI ROAD BRANCH', '', '', 'KUBER APARTMENT', '', 'AMBADI ROAD, TAL-VASAI', 1, 2, 8, 9, 401202, '02502342401', '', '', '', '', '', '', '', '', 'TDCB0000003', NULL, 0, 0, 0, '', 0, 400, ''),
(14, 420, 'VIKROLI', '', '', 'STATE ROAD KALWA WEST', '', '', 1, 2, 6, 7, 401101, '', '', '', '', '', '', '', '', '', 'BOND007', NULL, 0, 0, 0, '', 0, 400, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_citymaster`
--

CREATE TABLE IF NOT EXISTS `tb_citymaster` (
  `city_id` int(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `city_code` varchar(7) NOT NULL,
  `city_place` varchar(30) NOT NULL,
  `city_name_al` varchar(4) NOT NULL,
  `country_id` int(200) NOT NULL,
  `state_id` int(200) NOT NULL,
  `is_delete` int(2) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tb_citymaster`
--

INSERT INTO `tb_citymaster` (`city_id`, `city_code`, `city_place`, `city_name_al`, `country_id`, `state_id`, `is_delete`) VALUES
(001, 'SUR001', 'SURAT', 'CHU', 1, 1, 1),
(002, 'MUM001', 'MUMBAI', 'KAN', 1, 2, 1),
(003, 'BAN001', 'BANGALORE', 'BAN', 1, 3, 1),
(004, 'HUB001', 'HUBLI', 'HUB', 1, 3, 1),
(005, 'THA001', 'THANE', 'THA', 1, 2, 0),
(006, 'BHA001', 'BHAYANDER (W)', 'BHA', 1, 2, 0),
(007, 'NAL001', 'NALASOPARA (E)', 'NAL', 1, 2, 0),
(008, 'VAS001', 'VASAI (W)', 'VAS', 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_countrymaster`
--

CREATE TABLE IF NOT EXISTS `tb_countrymaster` (
  `country_id` int(250) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country_code` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `country_isdelete` int(2) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_countrymaster`
--

INSERT INTO `tb_countrymaster` (`country_id`, `country_name`, `country_code`, `country_isdelete`) VALUES
(1, 'INDIA', 'IND', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cps_adminpasswords`
--

CREATE TABLE IF NOT EXISTS `tb_cps_adminpasswords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adminid` int(11) NOT NULL,
  `password` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `tb_cps_adminpasswords`
--

INSERT INTO `tb_cps_adminpasswords` (`id`, `adminid`, `password`, `date`) VALUES
(1, 0, 0, '2012-09-28'),
(2, 0, 192023, '2012-09-28'),
(3, 0, 466, '2013-04-10'),
(4, 0, 1, '2013-04-10'),
(5, 0, 0, '2013-04-10'),
(6, 0, 16, '2013-04-10'),
(7, 0, 192023, '2013-09-25'),
(8, 0, 0, '2013-09-25'),
(9, 0, 192023, '2014-01-02'),
(10, 0, 21232, '2014-01-02'),
(11, 0, 192023, '2014-01-03'),
(12, 0, 0, '2014-01-03'),
(13, 0, 0, '2014-01-08'),
(14, 0, 7, '2014-01-08'),
(15, 0, 9, '2014-01-28'),
(16, 0, 0, '2014-01-28'),
(17, 0, 3407936, '2014-01-28'),
(18, 0, 192023, '2014-02-03'),
(19, 0, 14, '2014-02-03'),
(20, 0, 192023, '2014-02-05'),
(21, 0, 0, '2014-02-05'),
(22, 0, 1, '2014-02-15'),
(23, 0, 8, '2014-02-15'),
(24, 0, 192023, '2015-02-14'),
(25, 0, 0, '2015-02-14'),
(26, 2079, 192023, '2015-06-02');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cps_chequeseries`
--

CREATE TABLE IF NOT EXISTS `tb_cps_chequeseries` (
  `series_id` int(11) NOT NULL AUTO_INCREMENT,
  `series_transationcode` int(2) NOT NULL,
  `series_branchcode` int(3) NOT NULL,
  `serise_branchcode_branch` int(11) NOT NULL,
  `series_from` int(6) unsigned zerofill NOT NULL,
  `series_to` int(6) unsigned zerofill NOT NULL,
  `series_lastno` int(6) unsigned zerofill NOT NULL,
  `serise_Bank` int(3) NOT NULL,
  PRIMARY KEY (`series_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=47 ;

--
-- Dumping data for table `tb_cps_chequeseries`
--

INSERT INTO `tb_cps_chequeseries` (`series_id`, `series_transationcode`, `series_branchcode`, `serise_branchcode_branch`, `series_from`, `series_to`, `series_lastno`, `serise_Bank`) VALUES
(44, 10, 13, 4, 585001, 999999, 590044, 1),
(41, 13, 11, 2, 555555, 666666, 555573, 1),
(46, 10, 14, 420, 000001, 000099, 000001, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cps_grouppermissions`
--

CREATE TABLE IF NOT EXISTS `tb_cps_grouppermissions` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `page_accessible` varchar(150) NOT NULL,
  `page_read` varchar(2) NOT NULL,
  `page_write` varchar(2) NOT NULL,
  `page_edit` varchar(2) NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `tb_cps_grouppermissions`
--


-- --------------------------------------------------------

--
-- Table structure for table `tb_cps_groups`
--

CREATE TABLE IF NOT EXISTS `tb_cps_groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) NOT NULL,
  `group_createddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `tb_cps_groups`
--

INSERT INTO `tb_cps_groups` (`group_id`, `group_name`, `group_createddate`) VALUES
(30, 'ADMINISTRATOR', '2013-02-10 23:58:48');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cps_halfdays`
--

CREATE TABLE IF NOT EXISTS `tb_cps_halfdays` (
  `branch_halfday_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `monday` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `tuesday` tinyint(4) NOT NULL DEFAULT '0',
  `wednesday` tinyint(4) NOT NULL DEFAULT '0',
  `thursday` tinyint(4) NOT NULL DEFAULT '0',
  `friday` tinyint(4) NOT NULL DEFAULT '0',
  `saturday` tinyint(4) NOT NULL DEFAULT '0',
  `sunday` tinyint(4) NOT NULL DEFAULT '0',
  `opening_time` varchar(7) NOT NULL,
  `closing_time` varchar(7) NOT NULL,
  PRIMARY KEY (`branch_halfday_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=ucs2 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `tb_cps_halfdays`
--

INSERT INTO `tb_cps_halfdays` (`branch_halfday_id`, `branch_id`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `opening_time`, `closing_time`) VALUES
(53, 3, 0, 0, 0, 0, 0, 1, 0, '9:00am', '1:00pm'),
(52, 2, 0, 0, 0, 0, 0, 1, 0, '9:00am', '1:00pm'),
(54, 4, 0, 0, 0, 0, 0, 1, 0, '9:00am', '1:00pm'),
(55, 5, 0, 0, 0, 0, 0, 1, 0, '10:00am', '2:00pm'),
(56, 6, 0, 0, 0, 0, 0, 1, 0, '9:30am', '1:30pm');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cps_holidays`
--

CREATE TABLE IF NOT EXISTS `tb_cps_holidays` (
  `branch_holiday_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `monday` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `tuesday` tinyint(4) NOT NULL DEFAULT '0',
  `wednesday` tinyint(4) NOT NULL DEFAULT '0',
  `thursday` tinyint(4) NOT NULL DEFAULT '0',
  `friday` tinyint(4) NOT NULL DEFAULT '0',
  `saturday` tinyint(4) NOT NULL DEFAULT '0',
  `sunday` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`branch_holiday_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=ucs2 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `tb_cps_holidays`
--

INSERT INTO `tb_cps_holidays` (`branch_holiday_id`, `branch_id`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`) VALUES
(63, 3, 0, 0, 0, 0, 0, 0, 1),
(62, 2, 0, 0, 0, 0, 0, 0, 1),
(61, 3, 0, 0, 0, 0, 0, 0, 1),
(60, 2, 0, 0, 0, 0, 0, 0, 1),
(59, 3, 0, 0, 0, 0, 0, 0, 1),
(58, 3, 0, 0, 0, 0, 0, 0, 1),
(57, 2, 0, 0, 0, 0, 0, 0, 1),
(64, 4, 0, 0, 0, 0, 0, 0, 1),
(65, 5, 0, 0, 0, 0, 0, 0, 1),
(66, 6, 0, 0, 0, 0, 0, 0, 1),
(67, 6, 0, 0, 0, 0, 0, 0, 1),
(68, 2, 0, 0, 0, 0, 0, 0, 1),
(69, 2, 0, 0, 0, 0, 0, 0, 1),
(70, 2, 0, 0, 0, 0, 0, 0, 1),
(71, 2, 0, 0, 0, 0, 0, 0, 1),
(72, 2, 0, 0, 0, 0, 0, 0, 1),
(73, 7, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cps_mapbankfields`
--

CREATE TABLE IF NOT EXISTS `tb_cps_mapbankfields` (
  `field_id` int(11) NOT NULL AUTO_INCREMENT,
  `field_name` varchar(50) NOT NULL,
  `bank_field_name` varchar(50) NOT NULL,
  `field_min_length` int(11) NOT NULL,
  `field_max_length` int(11) NOT NULL,
  `bank_field_length` int(11) NOT NULL,
  `field_data_type` varchar(50) NOT NULL,
  `field_format` varchar(50) NOT NULL,
  PRIMARY KEY (`field_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `tb_cps_mapbankfields`
--

INSERT INTO `tb_cps_mapbankfields` (`field_id`, `field_name`, `bank_field_name`, `field_min_length`, `field_max_length`, `bank_field_length`, `field_data_type`, `field_format`) VALUES
(1, 'cps_unique_req', 'cps_unique_req', 10, 15, 15, 'Numeric', ''),
(2, 'cps_micr_code', 'cps_micr_code', 9, 9, 9, 'Numeric', ''),
(3, 'cps_branchmicr_code', 'cps_branchmicr_code', 3, 3, 3, 'Numeric', ''),
(4, 'cps_account_no', 'cps_account_no', 15, 15, 15, 'Numeric', ''),
(5, 'cps_act_name', 'cps_act_name', 1, 35, 35, 'Varchar', ''),
(6, 'cps_book_size', 'cps_book_size', 1, 3, 3, 'Numeric', ''),
(7, 'cps_no_of_books', 'cps_no_of_books', 1, 2, 2, 'Numeric', ''),
(8, 'cps_dly_bearer_order', 'cps_dly_bearer_order', 1, 1, 1, 'Varchar', ''),
(9, 'cps_tr_code', 'cps_tr_code', 2, 2, 2, 'Numeric', ''),
(10, 'cps_atpar', 'cps_atpar', 1, 1, 1, 'Numeric', ''),
(11, 'cps_act_jointname1', 'cps_act_jointname1', 0, 35, 35, 'Varchar', ''),
(12, 'cps_act_jointname2', 'cps_act_jointname2', 0, 35, 35, 'Varchar', ''),
(13, 'cps_auth_sign1', 'cps_auth_sign1', 0, 35, 35, 'Varchar', ''),
(14, 'cps_auth_sign2', 'cps_auth_sign2', 0, 35, 35, 'Varchar', ''),
(15, 'cps_auth_sign3', 'cps_auth_sign3', 0, 35, 35, 'Varchar', ''),
(16, 'cps_act_address1', 'cps_act_address1', 0, 50, 50, 'Varchar', ''),
(17, 'cps_act_address2', 'cps_act_address2', 0, 50, 50, 'Varchar', ''),
(18, 'cps_act_city', 'cps_act_city', 0, 30, 30, 'Varchar', ''),
(19, 'cps_state', 'cps_state', 0, 30, 30, 'Varchar', ''),
(20, 'cps_country', 'cps_country', 0, 30, 30, 'Varchar', ''),
(21, 'cps_emailid', 'cps_emailid', 0, 50, 50, 'Varchar', ''),
(22, 'cps_act_pin', 'cps_act_pin', 0, 30, 30, 'Varchar', ''),
(23, 'cps_act_telephone_res', 'cps_act_telephone_res', 0, 15, 15, 'Numeric', ''),
(24, 'cps_act_telephone_off', 'cps_act_telephone_off', 0, 15, 15, 'Numeric', ''),
(25, 'cps_act_mobile', 'cps_act_mobile', 0, 15, 15, 'Numeric', ''),
(26, 'cps_chq_no_from', 'cps_chq_no_from', 0, 6, 6, 'Numeric', ''),
(27, 'cps_chq_no_to', 'cps_chq_no_to', 0, 6, 6, 'Numeric', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cps_nonworkingdays`
--

CREATE TABLE IF NOT EXISTS `tb_cps_nonworkingdays` (
  `branch_nonworkingday_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `monday` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `tuesday` tinyint(4) NOT NULL DEFAULT '0',
  `wednesday` tinyint(4) NOT NULL DEFAULT '0',
  `thursday` tinyint(4) NOT NULL DEFAULT '0',
  `friday` tinyint(4) NOT NULL DEFAULT '0',
  `saturday` tinyint(4) NOT NULL DEFAULT '0',
  `sunday` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`branch_nonworkingday_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=ucs2 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_cps_nonworkingdays`
--


-- --------------------------------------------------------

--
-- Table structure for table `tb_cps_reprintque`
--

CREATE TABLE IF NOT EXISTS `tb_cps_reprintque` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `cps_unique_req` bigint(8) unsigned zerofill NOT NULL,
  `cps_micr_code` int(3) unsigned zerofill NOT NULL,
  `cps_branchmicr_code` int(3) unsigned zerofill NOT NULL,
  `cps_account_no` varchar(15) NOT NULL,
  `cps_act_name` varchar(45) NOT NULL,
  `cps_no_of_books` int(3) NOT NULL,
  `cps_dly_bearer_order` varchar(1) NOT NULL,
  `cps_book_size` int(3) NOT NULL,
  `cps_tr_code` int(2) unsigned zerofill NOT NULL,
  `cps_atpar` int(1) NOT NULL,
  `cps_act_jointname1` varchar(45) NOT NULL,
  `cps_act_jointname2` varchar(45) NOT NULL,
  `cps_auth_sign1` varchar(35) NOT NULL,
  `cps_auth_sign2` varchar(35) NOT NULL,
  `cps_auth_sign3` varchar(35) NOT NULL,
  `cps_act_address1` varchar(50) NOT NULL,
  `cps_act_address2` varchar(50) NOT NULL,
  `cps_act_address3` varchar(35) NOT NULL,
  `cps_act_address4` varchar(35) NOT NULL,
  `cps_act_address5` varchar(35) NOT NULL,
  `cps_act_city` varchar(30) NOT NULL,
  `cps_state` varchar(30) NOT NULL,
  `cps_country` varchar(30) NOT NULL,
  `cps_emailid` varchar(50) NOT NULL,
  `cps_act_pin` int(30) NOT NULL,
  `cps_act_telephone_res` varchar(15) NOT NULL,
  `cps_act_telephone_off` varchar(15) NOT NULL,
  `cps_act_mobile` varchar(15) NOT NULL,
  `cps_ifsc_code` varchar(12) NOT NULL,
  `cps_chq_no_from` bigint(6) unsigned zerofill NOT NULL,
  `cps_chq_no_to` bigint(6) unsigned zerofill NOT NULL,
  `cps_micr_account_no` int(6) unsigned zerofill NOT NULL,
  `cps_date` date NOT NULL,
  `cps_process_user_id` int(6) NOT NULL,
  `cps_bsr_code` varchar(6) NOT NULL,
  `cps_pr_code` varchar(4) NOT NULL,
  `cps_reprint_approved` int(1) NOT NULL DEFAULT '0',
  `cps_short_name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tb_cps_reprintque`
--

INSERT INTO `tb_cps_reprintque` (`id`, `cps_unique_req`, `cps_micr_code`, `cps_branchmicr_code`, `cps_account_no`, `cps_act_name`, `cps_no_of_books`, `cps_dly_bearer_order`, `cps_book_size`, `cps_tr_code`, `cps_atpar`, `cps_act_jointname1`, `cps_act_jointname2`, `cps_auth_sign1`, `cps_auth_sign2`, `cps_auth_sign3`, `cps_act_address1`, `cps_act_address2`, `cps_act_address3`, `cps_act_address4`, `cps_act_address5`, `cps_act_city`, `cps_state`, `cps_country`, `cps_emailid`, `cps_act_pin`, `cps_act_telephone_res`, `cps_act_telephone_off`, `cps_act_mobile`, `cps_ifsc_code`, `cps_chq_no_from`, `cps_chq_no_to`, `cps_micr_account_no`, `cps_date`, `cps_process_user_id`, `cps_bsr_code`, `cps_pr_code`, `cps_reprint_approved`, `cps_short_name`) VALUES
(8, 00001111, 400524004, 004, '003400300020925', 'JAHANGIR ANSARI-1', 1, 'Y', 20, 10, 0, '', '', '', '', '', 'MUMBRA', 'THANE', '', '', '', '', '', '', '', 0, '', '', '', '', 589884, 589903, 020925, '2015-06-04', 1, '', '', 1, ''),
(9, 00001112, 400524004, 004, '003400300020925', 'JAHANGIR ANSARI-2', 1, 'Y', 20, 10, 0, '', '', '', '', '', 'MUMBRA', 'THANE', '', '', '', '', '', '', '', 0, '', '', '', '', 589904, 589923, 020925, '2015-06-04', 1, '', '', 1, ''),
(10, 00001113, 400524004, 004, '003400300020925', 'JAHANGIR ANSARI-3', 1, 'Y', 20, 10, 0, '', '', '', '', '', 'MUMBRA', 'THANE', '', '', '', '', '', '', '', 0, '', '', '', '', 589924, 589943, 020925, '2015-06-04', 1, '', '', 1, ''),
(11, 00001114, 400524004, 004, '003400300020925', 'JAHANGIR ANSARI-4', 1, 'Y', 20, 10, 0, '', '', '', '', '', 'MUMBRA', 'THANE', '', '', '', '', '', '', '', 0, '', '', '', '', 589944, 589963, 020925, '2015-06-04', 1, '', '', 1, ''),
(12, 00001115, 400524004, 004, '003400300020925', 'JAHANGIR ANSARI-5', 1, 'Y', 20, 10, 0, '', '', '', '', '', 'MUMBRA', 'THANE', '', '', '', '', '', '', '', 0, '', '', '', '', 589964, 589983, 020925, '2015-06-04', 1, '', '', 1, ''),
(13, 00001116, 400524004, 004, '003400300020925', 'JAHANGIR ANSARI-6', 1, 'Y', 20, 10, 0, '', '', '', '', '', 'MUMBRA', 'THANE', '', '', '', '', '', '', '', 0, '', '', '', '', 589984, 590003, 020925, '2015-06-04', 1, '', '', 1, ''),
(14, 00001117, 400524004, 004, '003400300020925', 'JAHANGIR ANSARI-1', 1, 'Y', 20, 10, 0, '', '', '', '', '', 'MUMBRA', 'THANE', '', '', '', '', '', '', '', 0, '', '', '', '', 590004, 590023, 020925, '2015-06-04', 1, '', '', 1, ''),
(16, 00010918, 400, 312, '017010100000359', 'PAWAR MADHUKAR BHAULAL', 1, 'Y', 15, 18, 0, 'PAWAR INDIRA MADHUKAR', '', '', '', '', 'A6 3  AMIT APT', 'RAJ PARK MUM POONA RD', 'KHAREGAON KALWA     THANE', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '2015-06-23', 0, '', '', 1, ''),
(17, 00010919, 400, 312, '017010100001006', 'BHOSALE ARUNA BABAN', 1, 'Y', 15, 18, 0, '', '', '', '', '', 'A 3   203 SANGITA APT  RAJ PARK ', 'MUMBAI PUNA ROAD ', 'KALWA THANE', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '2015-06-23', 0, '', '', 1, ''),
(18, 00010920, 400, 312, '017010100003860', 'PATIL SEEMA JAGDISH', 2, 'Y', 15, 18, 0, '', '', '', '', '', 'RAGHU ATH APARTMENT ', 'KHAREGAON PAKHADI  POST   KALWA ', 'DIST   THANE ', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000029, 000000, '2015-06-23', 0, '', '', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cps_settings`
--

CREATE TABLE IF NOT EXISTS `tb_cps_settings` (
  `inputfolderpath` varchar(100) NOT NULL,
  `archivefolderpath` varchar(50) NOT NULL,
  `inputfileformat` varchar(20) NOT NULL,
  `inputfiledelimiter` varchar(15) NOT NULL,
  `outputfolderpath` varchar(100) NOT NULL,
  `outputfileformat` varchar(20) NOT NULL,
  `outputfiledelimiter` varchar(15) NOT NULL,
  `typeofprinter` varchar(20) NOT NULL,
  `printermodel` int(11) NOT NULL,
  `chk_taken_from` int(1) NOT NULL,
  `chk_no_from` int(6) unsigned zerofill NOT NULL,
  `chk_no_to` int(6) unsigned zerofill NOT NULL,
  `nooffailedpasswordattempt` int(11) NOT NULL,
  `password_expiry` int(11) NOT NULL,
  `homescreen_text` varchar(100) NOT NULL,
  `poweredby` varchar(100) NOT NULL,
  `banklogo` varchar(100) NOT NULL,
  `chq_Image` text NOT NULL,
  `country` varchar(5) NOT NULL,
  `help_employeeid` varchar(20) NOT NULL,
  `help_helplineno1` varchar(30) NOT NULL,
  `help_emailid` varchar(100) NOT NULL,
  `autolockminutes` int(11) NOT NULL,
  `help_contactperson` varchar(200) NOT NULL,
  `help_helplineno2` varchar(20) NOT NULL,
  `license_type` varchar(10) NOT NULL,
  `license_install_date` date NOT NULL,
  `license_period` int(2) NOT NULL,
  `license_end_date` date NOT NULL,
  `license_no_of_users` int(5) NOT NULL,
  `license_cheque_leaves` int(250) NOT NULL,
  `license_users_leaves` int(1) NOT NULL,
  `license_users_leaves_value` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_cps_settings`
--

INSERT INTO `tb_cps_settings` (`inputfolderpath`, `archivefolderpath`, `inputfileformat`, `inputfiledelimiter`, `outputfolderpath`, `outputfileformat`, `outputfiledelimiter`, `typeofprinter`, `printermodel`, `chk_taken_from`, `chk_no_from`, `chk_no_to`, `nooffailedpasswordattempt`, `password_expiry`, `homescreen_text`, `poweredby`, `banklogo`, `chq_Image`, `country`, `help_employeeid`, `help_helplineno1`, `help_emailid`, `autolockminutes`, `help_contactperson`, `help_helplineno2`, `license_type`, `license_install_date`, `license_period`, `license_end_date`, `license_no_of_users`, `license_cheque_leaves`, `license_users_leaves`, `license_users_leaves_value`) VALUES
('', 'uploads/', 'Excel', '', '', 'Excel', '', '', 0, 1, 000000, 000000, 9, 365, 'Gopinath Patil Parsik Janata Sahakari Bank Ltd', 'DevHarsh Infotech Pvt Ltd', 'thane logo.jpg', '', '', '', '', '', 360, '', '', '', '0000-00-00', 0, '0000-00-00', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cps_transactioncodes`
--

CREATE TABLE IF NOT EXISTS `tb_cps_transactioncodes` (
  `transactioncode_id` int(11) NOT NULL AUTO_INCREMENT,
  `transactioncode` int(2) NOT NULL,
  `transactioncodedescription` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `transactionstatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`transactioncode_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tb_cps_transactioncodes`
--

INSERT INTO `tb_cps_transactioncodes` (`transactioncode_id`, `transactioncode`, `transactioncodedescription`, `transactionstatus`) VALUES
(1, 18, 'SAVINGS ACCOUNT', 0),
(2, 11, 'CURRENT', 0),
(3, 12, 'PAY ORDER', 0),
(4, 13, 'CASH CREDIT', 0),
(5, 14, 'DIVIDEND', 1),
(8, 15, 'PAY ORDER FOR RBI TESTING', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cps_weekdays`
--

CREATE TABLE IF NOT EXISTS `tb_cps_weekdays` (
  `branch_workingday_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `monday` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `tuesday` tinyint(4) NOT NULL DEFAULT '0',
  `wednesday` tinyint(4) NOT NULL DEFAULT '0',
  `thursday` tinyint(4) NOT NULL DEFAULT '0',
  `friday` tinyint(4) NOT NULL DEFAULT '0',
  `saturday` tinyint(4) NOT NULL DEFAULT '0',
  `sunday` tinyint(4) NOT NULL DEFAULT '0',
  `opening_time` varchar(7) NOT NULL,
  `closing_time` varchar(7) NOT NULL,
  PRIMARY KEY (`branch_workingday_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=ucs2 AUTO_INCREMENT=58 ;

--
-- Dumping data for table `tb_cps_weekdays`
--

INSERT INTO `tb_cps_weekdays` (`branch_workingday_id`, `branch_id`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `opening_time`, `closing_time`) VALUES
(53, 3, 1, 1, 1, 1, 1, 0, 0, '9:00am', '5:00pm'),
(52, 2, 1, 1, 1, 1, 1, 0, 0, '9:00am', '6:00pm'),
(54, 4, 1, 1, 1, 1, 1, 0, 0, '9:00am', '5:00pm'),
(55, 5, 1, 1, 1, 1, 1, 0, 0, '10:00am', '6:00pm'),
(56, 6, 1, 1, 1, 1, 1, 0, 0, '9:30am', '5:30pm'),
(57, 7, 0, 0, 0, 0, 0, 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE IF NOT EXISTS `tb_customer` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT,
  `cust_short_name` varchar(30) NOT NULL,
  `cust_name` varchar(50) NOT NULL,
  `cust_address` text NOT NULL,
  `cust_acc_no` varchar(15) NOT NULL,
  KEY `cust_id` (`cust_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`cust_id`, `cust_short_name`, `cust_name`, `cust_address`, `cust_acc_no`) VALUES
(1, 'AADEEPTA', 'AADEEPTA V.SHETTY & VIIVECK V.SHETTY', '27,4/F,GURU BHAKTI NIWAS,GURU MANDIR RD,DOMBIVLI (EAST)-421 201.', 'H15792102956'),
(2, 'ABHILASHA', 'ABHILASHA OZA', 'SHIV-VASANTI,BLDG.16,H.F.SOCIETY ROAD,  JOGESHWARI(E),MUMBAI 400 060.', 'H15792100857'),
(3, 'ABHISHEK', 'ABHISHEK BHARTIA', 'A-603,KRISHRAJ TWR,CHICKUWADI,BORIVALI-WOPP.OMKAR HIGH COURT SOC,M-92.', 'H15792101900');

-- --------------------------------------------------------

--
-- Table structure for table `tb_manual_print`
--

CREATE TABLE IF NOT EXISTS `tb_manual_print` (
  `mp_Id` int(11) NOT NULL AUTO_INCREMENT,
  `mp_AccountHolder_Id` int(11) NOT NULL,
  `mp_BookSize` int(4) NOT NULL,
  `mp_NoOfBooks` int(4) NOT NULL,
  `mp_Chk_From` int(7) NOT NULL,
  `mp_Chk_To` int(7) NOT NULL,
  PRIMARY KEY (`mp_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tb_manual_print`
--


-- --------------------------------------------------------

--
-- Table structure for table `tb_pending_print_req`
--

CREATE TABLE IF NOT EXISTS `tb_pending_print_req` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `cps_unique_req` bigint(8) unsigned zerofill NOT NULL,
  `cps_micr_code` int(3) unsigned zerofill NOT NULL,
  `cps_branchmicr_code` int(3) unsigned zerofill NOT NULL,
  `cps_account_no` varchar(15) NOT NULL,
  `cps_act_name` varchar(45) NOT NULL,
  `cps_no_of_books` int(2) unsigned zerofill NOT NULL,
  `cps_dly_bearer_order` varchar(1) NOT NULL,
  `cps_book_size` int(3) unsigned zerofill NOT NULL,
  `cps_tr_code` int(2) unsigned zerofill NOT NULL,
  `cps_atpar` int(1) NOT NULL,
  `cps_act_jointname1` varchar(45) NOT NULL,
  `cps_act_jointname2` varchar(45) NOT NULL,
  `cps_auth_sign1` varchar(35) NOT NULL,
  `cps_auth_sign2` varchar(35) NOT NULL,
  `cps_auth_sign3` varchar(35) NOT NULL,
  `cps_act_address1` varchar(50) NOT NULL,
  `cps_act_address2` varchar(50) NOT NULL,
  `cps_act_address3` varchar(35) NOT NULL,
  `cps_act_address4` varchar(35) NOT NULL,
  `cps_act_address5` varchar(35) NOT NULL,
  `cps_act_city` varchar(30) NOT NULL,
  `cps_state` varchar(30) NOT NULL,
  `cps_country` varchar(30) NOT NULL,
  `cps_emailid` varchar(50) NOT NULL,
  `cps_act_pin` int(30) NOT NULL,
  `cps_act_telephone_res` varchar(15) NOT NULL,
  `cps_act_telephone_off` varchar(15) NOT NULL,
  `cps_act_mobile` varchar(15) NOT NULL,
  `cps_ifsc_code` varchar(12) NOT NULL,
  `cps_chq_no_from` bigint(6) unsigned zerofill NOT NULL,
  `cps_chq_no_to` bigint(6) unsigned zerofill NOT NULL,
  `cps_micr_account_no` int(6) unsigned zerofill NOT NULL,
  `cps_date` date NOT NULL,
  `cps_process_user_id` int(6) NOT NULL,
  `cps_isprint` int(1) NOT NULL DEFAULT '0',
  `cps_bsr_code` varchar(6) NOT NULL,
  `cps_pr_code` varchar(4) NOT NULL,
  `cps_short_name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tb_pending_print_req`
--


-- --------------------------------------------------------

--
-- Table structure for table `tb_printadmin`
--

CREATE TABLE IF NOT EXISTS `tb_printadmin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `lastlogintime` datetime NOT NULL,
  `adminid` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(3) NOT NULL,
  `incorrect_attempt` int(11) NOT NULL,
  `password_status` int(11) NOT NULL,
  `user_type` int(11) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `create_date` date NOT NULL,
  `is_temp_password` int(11) NOT NULL,
  PRIMARY KEY (`adminid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `tb_printadmin`
--

INSERT INTO `tb_printadmin` (`username`, `password`, `lastlogintime`, `adminid`, `group_id`, `incorrect_attempt`, `password_status`, `user_type`, `userid`, `create_date`, `is_temp_password`) VALUES
('admin', '0192023a7bbd73250516f069df18b500', '2012-04-21 00:00:00', 1, 0, 0, 1, 2, 'admin', '2015-02-14', 1),
('adminreprint', 'c93ccd78b2076528346216b3b2f701e6', '2014-02-05 00:00:00', 15, 0, 2, 1, 1, 'adminreprint', '2014-02-05', 1),
('reprint', '0192023a7bbd73250516f069df18b500', '2015-05-31 00:00:00', 16, 0, 0, 1, 1, 'reprint', '2015-06-01', 1),
('reprint1', 'c93ccd78b2076528346216b3b2f701e6', '2015-02-14 00:00:00', 17, 0, 0, 1, 1, 'reprint1', '2015-02-14', 1),
('a', '0192023a7bbd73250516f069df18b500', '2015-06-02 00:00:00', 18, 0, 0, 1, 1, '2079', '2015-06-02', 1),
('', '', '0000-00-00 00:00:00', 19, 0, 0, 0, 0, '', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_printque`
--

CREATE TABLE IF NOT EXISTS `tb_printque` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `cps_unique_req` bigint(8) unsigned zerofill NOT NULL,
  `cps_micr_code` int(3) unsigned zerofill NOT NULL,
  `cps_branchmicr_code` int(3) unsigned zerofill NOT NULL,
  `cps_account_no` varchar(15) NOT NULL,
  `cps_act_name` varchar(45) NOT NULL,
  `cps_no_of_books` int(2) unsigned zerofill NOT NULL,
  `cps_dly_bearer_order` varchar(1) NOT NULL,
  `cps_book_size` int(3) unsigned zerofill NOT NULL,
  `cps_tr_code` int(2) unsigned zerofill NOT NULL,
  `cps_atpar` int(1) NOT NULL,
  `cps_act_jointname1` varchar(45) NOT NULL,
  `cps_act_jointname2` varchar(45) NOT NULL,
  `cps_auth_sign1` varchar(35) NOT NULL,
  `cps_auth_sign2` varchar(35) NOT NULL,
  `cps_auth_sign3` varchar(35) NOT NULL,
  `cps_act_address1` varchar(50) NOT NULL,
  `cps_act_address2` varchar(50) NOT NULL,
  `cps_act_address3` varchar(35) NOT NULL,
  `cps_act_address4` varchar(35) NOT NULL,
  `cps_act_address5` varchar(35) NOT NULL,
  `cps_act_city` varchar(30) NOT NULL,
  `cps_state` varchar(30) NOT NULL,
  `cps_country` varchar(30) NOT NULL,
  `cps_emailid` varchar(50) NOT NULL,
  `cps_act_pin` int(30) NOT NULL,
  `cps_act_telephone_res` varchar(15) NOT NULL,
  `cps_act_telephone_off` varchar(15) NOT NULL,
  `cps_act_mobile` varchar(15) NOT NULL,
  `cps_ifsc_code` varchar(12) NOT NULL,
  `cps_chq_no_from` bigint(6) unsigned zerofill NOT NULL,
  `cps_chq_no_to` bigint(6) unsigned zerofill NOT NULL,
  `cps_micr_account_no` int(6) unsigned zerofill NOT NULL,
  `cps_date` date NOT NULL,
  `cps_process_user_id` int(6) NOT NULL,
  `cps_bsr_code` varchar(6) NOT NULL,
  `cps_pr_code` varchar(4) NOT NULL,
  `cps_short_name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tb_printque`
--


-- --------------------------------------------------------

--
-- Table structure for table `tb_print_req_collection`
--

CREATE TABLE IF NOT EXISTS `tb_print_req_collection` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `cps_unique_req` bigint(8) unsigned zerofill NOT NULL,
  `cps_micr_code` int(3) unsigned zerofill NOT NULL,
  `cps_branchmicr_code` int(3) unsigned zerofill NOT NULL,
  `cps_account_no` varchar(15) NOT NULL,
  `cps_act_name` varchar(45) NOT NULL,
  `cps_no_of_books` int(2) unsigned zerofill NOT NULL,
  `cps_dly_bearer_order` varchar(1) NOT NULL,
  `cps_book_size` int(3) unsigned zerofill NOT NULL,
  `cps_tr_code` int(2) unsigned zerofill NOT NULL,
  `cps_atpar` int(1) NOT NULL,
  `cps_act_jointname1` varchar(45) NOT NULL,
  `cps_act_jointname2` varchar(45) NOT NULL,
  `cps_auth_sign1` varchar(35) NOT NULL,
  `cps_auth_sign2` varchar(35) NOT NULL,
  `cps_auth_sign3` varchar(35) NOT NULL,
  `cps_act_address1` varchar(50) NOT NULL,
  `cps_act_address2` varchar(50) NOT NULL,
  `cps_act_address3` varchar(35) NOT NULL,
  `cps_act_address4` varchar(35) NOT NULL,
  `cps_act_address5` varchar(35) NOT NULL,
  `cps_act_city` varchar(30) NOT NULL,
  `cps_state` varchar(30) NOT NULL,
  `cps_country` varchar(30) NOT NULL,
  `cps_emailid` varchar(50) NOT NULL,
  `cps_act_pin` int(30) NOT NULL,
  `cps_act_telephone_res` varchar(15) NOT NULL,
  `cps_act_telephone_off` varchar(15) NOT NULL,
  `cps_act_mobile` varchar(15) NOT NULL,
  `cps_ifsc_code` varchar(12) NOT NULL,
  `cps_chq_no_from` bigint(6) unsigned zerofill NOT NULL,
  `cps_chq_no_to` bigint(6) unsigned zerofill NOT NULL,
  `cps_micr_account_no` int(6) unsigned zerofill NOT NULL,
  `cps_date` date NOT NULL,
  `cps_process_user_id` int(6) NOT NULL,
  `cps_is_reprint` int(1) NOT NULL DEFAULT '0',
  `cps_pr_code` varchar(4) NOT NULL,
  `cps_bsr_code` varchar(6) NOT NULL,
  `cps_short_name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `tb_print_req_collection`
--

INSERT INTO `tb_print_req_collection` (`id`, `cps_unique_req`, `cps_micr_code`, `cps_branchmicr_code`, `cps_account_no`, `cps_act_name`, `cps_no_of_books`, `cps_dly_bearer_order`, `cps_book_size`, `cps_tr_code`, `cps_atpar`, `cps_act_jointname1`, `cps_act_jointname2`, `cps_auth_sign1`, `cps_auth_sign2`, `cps_auth_sign3`, `cps_act_address1`, `cps_act_address2`, `cps_act_address3`, `cps_act_address4`, `cps_act_address5`, `cps_act_city`, `cps_state`, `cps_country`, `cps_emailid`, `cps_act_pin`, `cps_act_telephone_res`, `cps_act_telephone_off`, `cps_act_mobile`, `cps_ifsc_code`, `cps_chq_no_from`, `cps_chq_no_to`, `cps_micr_account_no`, `cps_date`, `cps_process_user_id`, `cps_is_reprint`, `cps_pr_code`, `cps_bsr_code`, `cps_short_name`) VALUES
(1, 00010918, 400, 312, '017010100000359', 'PAWAR MADHUKAR BHAULAL', 01, 'Y', 015, 18, 0, 'PAWAR INDIRA MADHUKAR', '', '', '', '', 'A6 3  AMIT APT', 'RAJ PARK MUM POONA RD', 'KHAREGAON KALWA     THANE', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '0000-00-00', 0, 0, '', '', ''),
(2, 00010919, 400, 312, '017010100001006', 'BHOSALE ARUNA BABAN', 01, 'Y', 015, 18, 0, '', '', '', '', '', 'A 3   203 SANGITA APT  RAJ PARK ', 'MUMBAI PUNA ROAD ', 'KALWA THANE', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '0000-00-00', 0, 0, '', '', ''),
(3, 00010920, 400, 312, '017010100003860', 'PATIL SEEMA JAGDISH', 02, 'Y', 015, 18, 0, '', '', '', '', '', 'RAGHU ATH APARTMENT ', 'KHAREGAON PAKHADI  POST   KALWA ', 'DIST   THANE ', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000029, 000000, '0000-00-00', 0, 0, '', '', ''),
(4, 00010921, 400, 312, '017010100004164', 'DARGUDE AMBADAS VALUBA', 01, 'Y', 015, 18, 0, 'DARGUDE LILAVATI AMBADAS', '', '', '', '', '601   LDG NO 15  VASTU ANAND ', 'PARSIKNAGAR  KHAREGAON ', 'KALWA  THANE  40060  ', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '0000-00-00', 0, 0, '', '', ''),
(5, 00010922, 400, 312, '017010100008027', 'MORYE SUCHITA RAMESH', 01, 'Y', 015, 18, 0, '', '', '', '', '', 'A 4   106  APARNARAJ CHS LTD', 'GHOLAI NAGAR PARSIK NAGAR', 'KALWA               THANE', '', '', 'KALWA', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '0000-00-00', 0, 0, '', '', ''),
(6, 00010923, 400, 312, '017010100009311', 'BAMNE TANAJI SAMBHAJI', 01, 'Y', 015, 18, 0, '', '', '', '', '', 'B 301 KASHI DHAM BLDG', 'OLD MUMBAI PUNE ROAD', 'PARSIK NAGAR        KALWA', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '0000-00-00', 0, 0, '', '', ''),
(7, 00010924, 400, 312, '017010100009533', 'MISHRA SHIVAM RAJENDRAPRATAP', 01, 'Y', 015, 18, 0, '', '', '', '', '', '501 B ASHRFIRAJ SADAN', 'GHOLAI NAGAR', 'KHAREGAON KALWA E   THANE', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '0000-00-00', 0, 0, '', '', ''),
(8, 00010925, 400, 312, '017011300000891', 'VEDANT STONE CRUSHING CO.', 01, 'Y', 030, 18, 0, '', '', '', '', '', '      AT VASHERE POST AMANE ', 'TAL BHIVANDI ', 'THANE', '', '', 'KALWA', '', '', '', 421302, '', '', '', '', 000000, 000029, 000000, '0000-00-00', 0, 0, '', '', ''),
(9, 00010926, 400, 312, '017011300001179', 'JAI AMBE ENGINEERING WORK', 01, 'Y', 030, 18, 0, '', '', '', '', '', '      SAINATH NAGAR ', 'PARSIK RETI BUNDER ', 'KHAREGAON           KALWA', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000029, 000000, '0000-00-00', 0, 0, '', '', ''),
(10, 00010927, 400, 312, '017011300001190', 'SHREE SIDDHI MOTORS', 02, 'Y', 030, 18, 0, '', '', '', '', '', '      NEAR APPOLO GYM', 'DATTAWADI', 'KALWA               THANE', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000059, 000000, '0000-00-00', 0, 0, '', '', ''),
(11, 00010928, 400, 312, '017011300001229', 'TANMAYEE PRECISION ENGINEERING WORKS', 01, 'Y', 030, 18, 0, '', '', '', '', '', '      PAP R 345 346  TTC INDST AREA', 'RABALE MIDC', 'RABALE              NAVI MUMBAI', '', '', 'THANE', '', '', '', 400701, '', '', '', '', 000000, 000029, 000000, '0000-00-00', 0, 0, '', '', ''),
(12, 00010929, 400, 312, '017011300001245', 'MATAJI ELECTRIC AND HARDWARE STORES', 01, 'Y', 030, 18, 0, '', '', '', '', '', '      SHOP 13 MAITRI VATIKA CHS', 'OLD MUMBAI PUNE ROAD', 'PARSIK NAGAR        KALWA', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000029, 000000, '0000-00-00', 0, 0, '', '', ''),
(13, 00010918, 400, 312, '017010100000359', 'PAWAR MADHUKAR BHAULAL', 01, 'Y', 015, 18, 0, 'PAWAR INDIRA MADHUKAR', '', '', '', '', 'A6 3  AMIT APT', 'RAJ PARK MUM POONA RD', 'KHAREGAON KALWA     THANE', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '2015-06-23', 0, 0, '', '', ''),
(14, 00010919, 400, 312, '017010100001006', 'BHOSALE ARUNA BABAN', 01, 'Y', 015, 18, 0, '', '', '', '', '', 'A 3   203 SANGITA APT  RAJ PARK ', 'MUMBAI PUNA ROAD ', 'KALWA THANE', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '2015-06-23', 0, 0, '', '', ''),
(15, 00010920, 400, 312, '017010100003860', 'PATIL SEEMA JAGDISH', 02, 'Y', 015, 18, 0, '', '', '', '', '', 'RAGHU ATH APARTMENT ', 'KHAREGAON PAKHADI  POST   KALWA ', 'DIST   THANE ', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000029, 000000, '2015-06-23', 0, 0, '', '', ''),
(16, 00010921, 400, 312, '017010100004164', 'DARGUDE AMBADAS VALUBA', 01, 'Y', 015, 18, 0, 'DARGUDE LILAVATI AMBADAS', '', '', '', '', '601   LDG NO 15  VASTU ANAND ', 'PARSIKNAGAR  KHAREGAON ', 'KALWA  THANE  40060  ', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '2015-06-23', 0, 0, '', '', ''),
(17, 00010922, 400, 312, '017010100008027', 'MORYE SUCHITA RAMESH', 01, 'Y', 015, 18, 0, '', '', '', '', '', 'A 4   106  APARNARAJ CHS LTD', 'GHOLAI NAGAR PARSIK NAGAR', 'KALWA               THANE', '', '', 'KALWA', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '2015-06-23', 0, 0, '', '', ''),
(18, 00010923, 400, 312, '017010100009311', 'BAMNE TANAJI SAMBHAJI', 01, 'Y', 015, 18, 0, '', '', '', '', '', 'B 301 KASHI DHAM BLDG', 'OLD MUMBAI PUNE ROAD', 'PARSIK NAGAR        KALWA', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '2015-06-23', 0, 0, '', '', ''),
(19, 00010924, 400, 312, '017010100009533', 'MISHRA SHIVAM RAJENDRAPRATAP', 01, 'Y', 015, 18, 0, '', '', '', '', '', '501 B ASHRFIRAJ SADAN', 'GHOLAI NAGAR', 'KHAREGAON KALWA E   THANE', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '2015-06-23', 0, 0, '', '', ''),
(20, 00010925, 400, 312, '017011300000891', 'VEDANT STONE CRUSHING CO.', 01, 'Y', 030, 18, 0, '', '', '', '', '', '      AT VASHERE POST AMANE ', 'TAL BHIVANDI ', 'THANE', '', '', 'KALWA', '', '', '', 421302, '', '', '', '', 000000, 000029, 000000, '2015-06-23', 0, 0, '', '', ''),
(21, 00010926, 400, 312, '017011300001179', 'JAI AMBE ENGINEERING WORK', 01, 'Y', 030, 18, 0, '', '', '', '', '', '      SAINATH NAGAR ', 'PARSIK RETI BUNDER ', 'KHAREGAON           KALWA', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000029, 000000, '2015-06-23', 0, 0, '', '', ''),
(22, 00010927, 400, 312, '017011300001190', 'SHREE SIDDHI MOTORS', 02, 'Y', 030, 18, 0, '', '', '', '', '', '      NEAR APPOLO GYM', 'DATTAWADI', 'KALWA               THANE', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000059, 000000, '2015-06-23', 0, 0, '', '', ''),
(23, 00010928, 400, 312, '017011300001229', 'TANMAYEE PRECISION ENGINEERING WORKS', 01, 'Y', 030, 18, 0, '', '', '', '', '', '      PAP R 345 346  TTC INDST AREA', 'RABALE MIDC', 'RABALE              NAVI MUMBAI', '', '', 'THANE', '', '', '', 400701, '', '', '', '', 000000, 000029, 000000, '2015-06-23', 0, 0, '', '', ''),
(24, 00010929, 400, 312, '017011300001245', 'MATAJI ELECTRIC AND HARDWARE STORES', 01, 'Y', 030, 18, 0, '', '', '', '', '', '      SHOP 13 MAITRI VATIKA CHS', 'OLD MUMBAI PUNE ROAD', 'PARSIK NAGAR        KALWA', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000029, 000000, '2015-06-23', 0, 0, '', '', ''),
(25, 00010918, 400, 312, '017010100000359', 'PAWAR MADHUKAR BHAULAL', 01, 'Y', 015, 18, 0, 'PAWAR INDIRA MADHUKAR', '', '', '', '', 'A6 3  AMIT APT', 'RAJ PARK MUM POONA RD', 'KHAREGAON KALWA     THANE', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '2015-06-23', 0, 0, '', '', ''),
(26, 00010919, 400, 312, '017010100001006', 'BHOSALE ARUNA BABAN', 01, 'Y', 015, 18, 0, '', '', '', '', '', 'A 3   203 SANGITA APT  RAJ PARK ', 'MUMBAI PUNA ROAD ', 'KALWA THANE', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '2015-06-23', 0, 0, '', '', ''),
(27, 00010920, 400, 312, '017010100003860', 'PATIL SEEMA JAGDISH', 02, 'Y', 015, 18, 0, '', '', '', '', '', 'RAGHU ATH APARTMENT ', 'KHAREGAON PAKHADI  POST   KALWA ', 'DIST   THANE ', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000029, 000000, '2015-06-23', 0, 0, '', '', ''),
(28, 00010918, 400, 312, '017010100000359', 'PAWAR MADHUKAR BHAULAL', 01, 'Y', 003, 18, 0, 'PAWAR INDIRA MADHUKAR', '', '', '', '', 'A6 3  AMIT APT', 'RAJ PARK MUM POONA RD', 'KHAREGAON KALWA     THANE', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000002, 000000, '2015-06-23', 0, 0, '', '', ''),
(29, 00010919, 400, 312, '017010100001006', 'BHOSALE ARUNA BABAN', 01, 'Y', 003, 18, 0, '', '', '', '', '', 'A 3   203 SANGITA APT  RAJ PARK ', 'MUMBAI PUNA ROAD ', 'KALWA THANE', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000002, 000000, '2015-06-23', 0, 0, '', '', ''),
(30, 00010920, 400, 312, '017010100003860', 'PATIL SEEMA JAGDISH', 02, 'Y', 003, 18, 0, '', '', '', '', '', 'RAGHU ATH APARTMENT ', 'KHAREGAON PAKHADI  POST   KALWA ', 'DIST   THANE ', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000005, 000000, '2015-06-23', 0, 0, '', '', ''),
(31, 00010921, 400, 312, '017010100004164', 'DARGUDE AMBADAS VALUBA', 01, 'Y', 015, 18, 0, 'DARGUDE LILAVATI AMBADAS', '', '', '', '', '601   LDG NO 15  VASTU ANAND ', 'PARSIKNAGAR  KHAREGAON ', 'KALWA  THANE  40060  ', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '2015-06-23', 0, 0, '', '', ''),
(32, 00010922, 400, 312, '017010100008027', 'MORYE SUCHITA RAMESH', 01, 'Y', 015, 18, 0, '', '', '', '', '', 'A 4   106  APARNARAJ CHS LTD', 'GHOLAI NAGAR PARSIK NAGAR', 'KALWA               THANE', '', '', 'KALWA', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '2015-06-23', 0, 0, '', '', ''),
(33, 00010923, 400, 312, '017010100009311', 'BAMNE TANAJI SAMBHAJI', 01, 'Y', 015, 18, 0, '', '', '', '', '', 'B 301 KASHI DHAM BLDG', 'OLD MUMBAI PUNE ROAD', 'PARSIK NAGAR        KALWA', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '2015-06-23', 0, 0, '', '', ''),
(34, 00010918, 400, 312, '017010100000359', 'PAWAR SWAPNIL', 01, 'Y', 003, 18, 0, 'PAWAR INDIRA SWAPNIL', '', '', '', '', 'A6 3  AMIT APT', 'RAJ PARK MUM POONA RD', 'KHAREGAON KALWA     THANE', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000002, 000000, '2015-06-23', 0, 0, '', '', ''),
(35, 00010919, 400, 312, '017010100001006', 'BHOSALE SATSIH BABAN', 01, 'Y', 003, 18, 0, '', '', '', '', '', 'A 3   203 SANGITA APT  RAJ PARK ', 'MUMBAI PUNA ROAD ', 'KALWA THANE', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000002, 000000, '2015-06-23', 0, 0, '', '', ''),
(36, 00010920, 400, 312, '017010100003860', 'PATIL SEEMA JAGDISH', 02, 'Y', 003, 18, 0, '', '', '', '', '', 'RAGHU ATH APARTMENT ', 'KHAREGAON PAKHADI  POST   KALWA ', 'DIST   THANE ', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000005, 000000, '2015-06-23', 0, 0, '', '', ''),
(37, 00010918, 400, 312, '017010100000359', 'PAWAR SWAPNIL', 01, 'Y', 003, 18, 0, 'PAWAR INDIRA SWAPNIL', '', '', '', '', 'A6 3  AMIT APT', 'RAJ PARK MUM POONA RD', 'KHAREGAON KALWA     THANE', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000002, 000000, '2015-06-23', 0, 0, '', '', ''),
(38, 00010919, 400, 312, '017010100001006', 'BHOSALE SATSIH BABAN', 01, 'Y', 003, 18, 0, '', '', '', '', '', 'A 3   203 SANGITA APT  RAJ PARK ', 'MUMBAI PUNA ROAD ', 'KALWA THANE', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000002, 000000, '2015-06-23', 0, 0, '', '', ''),
(39, 00010920, 400, 312, '017010100003860', 'PATIL SEEMA JAGDISH', 02, 'Y', 003, 18, 0, '', '', '', '', '', 'RAGHU ATH APARTMENT ', 'KHAREGAON PAKHADI  POST   KALWA ', 'DIST   THANE ', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000005, 000000, '2015-06-23', 0, 0, '', '', ''),
(40, 00010921, 400, 312, '017010100004164', 'PATIL AMBADAS VALUBA', 01, 'Y', 015, 18, 0, 'PATIL LILAVATI AMBADAS', '', '', '', '', '601   LDG NO 15  VASTU ANAND ', 'PARSIKNAGAR  KHAREGAON ', 'KALWA  THANE  40060  ', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '2015-06-23', 0, 0, '', '', ''),
(41, 00010922, 400, 312, '017010100008027', 'MORYE SUCHITA RAMESH', 01, 'Y', 015, 18, 0, '', '', '', '', '', 'A 4   106  APARNARAJ CHS LTD', 'GHOLAI NAGAR PARSIK NAGAR', 'KALWA               THANE', '', '', 'KALWA', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '2015-06-23', 0, 0, '', '', ''),
(42, 00010918, 400, 312, '017010100000359', 'PAWAR SWAPNIL', 01, 'Y', 003, 18, 0, 'PAWAR INDIRA SWAPNIL', '', '', '', '', 'A6 3  AMIT APT', 'RAJ PARK MUM POONA RD', 'KHAREGAON KALWA     THANE', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000002, 000000, '2015-06-23', 0, 0, '', '', ''),
(43, 00010919, 400, 312, '017010100001006', 'BHOSALE SATSIH BABAN', 01, 'Y', 003, 18, 0, '', '', '', '', '', 'A 3   203 SANGITA APT  RAJ PARK ', 'MUMBAI PUNA ROAD ', 'KALWA THANE', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000002, 000000, '2015-06-23', 0, 0, '', '', ''),
(44, 00010922, 400, 312, '017010100008027', 'MORYE SUCHITA RAMESH', 01, 'Y', 015, 18, 0, '', '', '', '', '', 'A 4   106  APARNARAJ CHS LTD', 'GHOLAI NAGAR PARSIK NAGAR', 'KALWA               THANE', '', '', 'KALWA', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '2015-06-23', 0, 0, '', '', ''),
(45, 00010920, 400, 312, '017010100003860', 'PATIL SEEMA JAGDISH', 02, 'Y', 003, 18, 0, '', '', '', '', '', 'RAGHU ATH APARTMENT ', 'KHAREGAON PAKHADI  POST   KALWA ', 'DIST   THANE ', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000005, 000000, '2015-06-23', 0, 0, '', '', ''),
(46, 00010921, 400, 312, '017010100004164', 'PATIL AMBADAS VALUBA', 01, 'Y', 015, 18, 0, 'PATIL LILAVATI AMBADAS', '', '', '', '', '601   LDG NO 15  VASTU ANAND ', 'PARSIKNAGAR  KHAREGAON ', 'KALWA  THANE  40060  ', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000014, 000000, '2015-06-23', 0, 0, '', '', ''),
(47, 00010918, 400, 312, '017010100000359', 'PAWAR MADHUKAR BHAULAL', 01, 'Y', 003, 18, 0, 'PAWAR INDIRA MADHUKAR', '', '', '', '', 'A6 3  AMIT APT', 'RAJ PARK MUM POONA RD', 'KHAREGAON KALWA     THANE', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000002, 000000, '2015-06-23', 0, 0, '', '', ''),
(48, 00010919, 400, 312, '017010100001006', 'BHOSALE ARUNA BABAN', 01, 'Y', 003, 18, 0, '', '', '', '', '', 'A 3   203 SANGITA APT  RAJ PARK ', 'MUMBAI PUNA ROAD ', 'KALWA THANE', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000002, 000000, '2015-06-23', 0, 0, '', '', ''),
(49, 00010920, 400, 312, '017010100003860', 'PATIL SEEMA JAGDISH', 02, 'Y', 003, 18, 0, '', '', '', '', '', 'RAGHU ATH APARTMENT ', 'KHAREGAON PAKHADI  POST   KALWA ', 'DIST   THANE ', '', '', 'THANE', '', '', '', 400605, '', '', '', '', 000000, 000005, 000000, '2015-06-23', 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_reprint_req_collection`
--

CREATE TABLE IF NOT EXISTS `tb_reprint_req_collection` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `cps_unique_req` bigint(8) unsigned zerofill NOT NULL,
  `cps_micr_code` int(3) unsigned zerofill NOT NULL,
  `cps_branchmicr_code` int(3) unsigned zerofill NOT NULL,
  `cps_account_no` varchar(15) NOT NULL,
  `cps_act_name` varchar(45) NOT NULL,
  `cps_no_of_books` int(2) unsigned zerofill NOT NULL,
  `cps_dly_bearer_order` varchar(1) NOT NULL,
  `cps_book_size` int(3) unsigned zerofill NOT NULL,
  `cps_tr_code` int(2) unsigned zerofill NOT NULL,
  `cps_atpar` int(1) NOT NULL,
  `cps_act_jointname1` varchar(45) NOT NULL,
  `cps_act_jointname2` varchar(45) NOT NULL,
  `cps_auth_sign1` varchar(35) NOT NULL,
  `cps_auth_sign2` varchar(35) NOT NULL,
  `cps_auth_sign3` varchar(35) NOT NULL,
  `cps_act_address1` varchar(50) NOT NULL,
  `cps_act_address2` varchar(50) NOT NULL,
  `cps_act_address3` varchar(35) NOT NULL,
  `cps_act_address4` varchar(35) NOT NULL,
  `cps_act_address5` varchar(35) NOT NULL,
  `cps_act_city` varchar(30) NOT NULL,
  `cps_state` varchar(30) NOT NULL,
  `cps_country` varchar(30) NOT NULL,
  `cps_emailid` varchar(50) NOT NULL,
  `cps_act_pin` int(30) NOT NULL,
  `cps_act_telephone_res` varchar(15) NOT NULL,
  `cps_act_telephone_off` varchar(15) NOT NULL,
  `cps_act_mobile` varchar(15) NOT NULL,
  `cps_ifsc_code` varchar(12) NOT NULL,
  `cps_chq_no_from` bigint(6) unsigned zerofill NOT NULL,
  `cps_chq_no_to` bigint(6) unsigned zerofill NOT NULL,
  `cps_micr_account_no` int(6) unsigned zerofill NOT NULL,
  `cps_date` date NOT NULL,
  `cps_process_user_id` int(6) NOT NULL,
  `cps_is_reprint` int(1) NOT NULL DEFAULT '0',
  `cps_pr_code` varchar(4) NOT NULL,
  `cps_bsr_code` varchar(6) NOT NULL,
  `cps_short_name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tb_reprint_req_collection`
--


-- --------------------------------------------------------

--
-- Table structure for table `tb_statemaster`
--

CREATE TABLE IF NOT EXISTS `tb_statemaster` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_code` varchar(7) NOT NULL,
  `state_name_al` varchar(4) NOT NULL,
  `is_delete` int(2) NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tb_statemaster`
--

INSERT INTO `tb_statemaster` (`state_id`, `state_name`, `country_id`, `state_code`, `state_name_al`, `is_delete`) VALUES
(1, 'GUJRAT', 1, 'GUJ001', 'GUJ', 1),
(2, 'MAHARASHTRA', 1, 'MAH001', 'MAH', 0),
(3, 'KARNATAKA', 1, 'KAR001', 'KAR', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_suburbmaster`
--

CREATE TABLE IF NOT EXISTS `tb_suburbmaster` (
  `suburb_id` int(240) NOT NULL AUTO_INCREMENT,
  `suburb_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `suburb_postal_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `suburb_code` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `suburb_name_al` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `country_id` int(240) NOT NULL,
  `state_id` int(240) NOT NULL,
  `city_id` int(240) NOT NULL,
  `is_delete` int(2) NOT NULL,
  PRIMARY KEY (`suburb_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tb_suburbmaster`
--

INSERT INTO `tb_suburbmaster` (`suburb_id`, `suburb_name`, `suburb_postal_code`, `suburb_code`, `suburb_name_al`, `country_id`, `state_id`, `city_id`, `is_delete`) VALUES
(1, 'NEW SURAT', '800056', 'NEW001', 'LAL', 1, 1, 1, 1),
(2, 'DADAR', '400028', 'DAD001', 'CHA', 1, 2, 2, 1),
(3, 'INFANTRY ROAD', '560001', 'INF001', 'INF', 1, 3, 3, 1),
(4, 'GEDDALAHALLI', '560073', 'GED001', 'GED', 1, 3, 3, 1),
(5, 'BEGUR', '560068', 'BEG001', 'BEG', 1, 3, 3, 1),
(6, 'NARIMAN POINT', '400021', 'NAR001', 'NAR', 1, 2, 2, 1),
(7, 'BHAYANDER (W)', '401101', 'BHA001', 'BHA', 1, 2, 6, 0),
(8, 'NALASOPARA (E)', '401203', 'NAL001', 'NAL', 1, 2, 7, 0),
(9, 'TAL-VASAI', '401202', 'TAL001', 'TAL', 1, 2, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_uploadingdata`
--

CREATE TABLE IF NOT EXISTS `tb_uploadingdata` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `cps_unique_req` bigint(8) unsigned zerofill NOT NULL,
  `cps_micr_code` varchar(3) NOT NULL,
  `cps_branchmicr_code` varchar(3) NOT NULL,
  `cps_account_no` varchar(15) NOT NULL,
  `cps_act_name` varchar(45) NOT NULL,
  `cps_no_of_books` varchar(2) NOT NULL,
  `cps_dly_bearer_order` varchar(1) NOT NULL,
  `cps_book_size` varchar(3) NOT NULL,
  `cps_tr_code` varchar(2) NOT NULL,
  `cps_atpar` varchar(1) NOT NULL,
  `cps_act_jointname1` varchar(45) NOT NULL,
  `cps_act_jointname2` varchar(45) NOT NULL,
  `cps_auth_sign1` varchar(35) NOT NULL,
  `cps_auth_sign2` varchar(35) NOT NULL,
  `cps_auth_sign3` varchar(35) NOT NULL,
  `cps_act_address1` varchar(50) NOT NULL,
  `cps_act_address2` varchar(50) NOT NULL,
  `cps_act_address3` varchar(35) NOT NULL,
  `cps_act_address4` varchar(35) NOT NULL,
  `cps_act_address5` varchar(35) NOT NULL,
  `cps_act_city` varchar(30) NOT NULL,
  `cps_state` varchar(30) NOT NULL,
  `cps_country` varchar(30) NOT NULL,
  `cps_emailid` varchar(50) NOT NULL,
  `cps_act_pin` int(30) NOT NULL,
  `cps_act_telephone_res` varchar(15) NOT NULL,
  `cps_act_telephone_off` varchar(15) NOT NULL,
  `cps_act_mobile` varchar(15) NOT NULL,
  `cps_ifsc_code` varchar(12) NOT NULL,
  `cps_chq_no_from` varchar(6) NOT NULL,
  `cps_chq_no_to` varchar(6) NOT NULL,
  `cps_micr_account_no` varchar(6) NOT NULL,
  `cps_date` date NOT NULL,
  `cps_process_user_id` varchar(6) NOT NULL,
  `cps_bsr_code` varchar(6) NOT NULL,
  `cps_pr_code` varchar(4) NOT NULL,
  `cps_short_name` varchar(40) NOT NULL,
  `cps_issue_date` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `tb_uploadingdata`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
