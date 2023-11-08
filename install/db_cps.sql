-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 03, 2012 at 04:32 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_cps`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bankdetails`
--

CREATE TABLE IF NOT EXISTS `tb_bankdetails` (
  `bank_id` int(4) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(40) NOT NULL,
  `bank_code` varchar(10) NOT NULL,
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
  `bank_emailid` varchar(40) NOT NULL,
  `bank_website` varchar(40) NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


--
-- Table structure for table `tb_branchdetails`
--

CREATE TABLE IF NOT EXISTS `tb_branchdetails` (
  `branch_id` int(200) NOT NULL AUTO_INCREMENT,
  `branch_code` varchar(8) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `branch_micr` varchar(20) NOT NULL,
  `branch_atparmicrcode` varchar(20) NOT NULL,
  `branch_address1` varchar(35) NOT NULL,
  `branch_address2` varchar(35) NOT NULL,
  `branch_address3` varchar(35) NOT NULL,
  `branch_country_id` int(4) NOT NULL DEFAULT '0',
  `branch_state_id` int(11) NOT NULL,
  `branch_city_id` int(11) NOT NULL,
  `branch_suburb_id` int(4) NOT NULL,
  `branch_pin` int(15) NOT NULL,
  `branch_telephone1` int(11) NOT NULL,
  `branch_telephone2` int(11) NOT NULL,
  `branch_contactperson1` varchar(50) NOT NULL,
  `branch_contactperson2` varchar(50) NOT NULL,
  `branch_contactpersonmobile1` varchar(50) NOT NULL,
  `branch_contactpersonmobile2` varchar(50) NOT NULL,
  `branch_email1` varchar(30) NOT NULL,
  `branch_email2` varchar(30) NOT NULL,
  `branch_holiday` varchar(20) NOT NULL,
  `branch_neftifsccode` varchar(20) NOT NULL,
  `branch_working_hours` float NOT NULL,
  `branch_clearingthrough` tinyint(1) NOT NULL DEFAULT '0',
  `branch_clearingcenter` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`branch_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Table structure for table `tb_countrymaster`
--

CREATE TABLE IF NOT EXISTS `tb_countrymaster` (
  `country_id` int(250) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country_code` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `country_isdelete` int(2) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=251 ;

--
-- Dumping data for table `tb_countrymaster`
--

INSERT INTO `tb_countrymaster` (`country_id`, `country_name`, `country_code`, `country_isdelete`) VALUES
(1, 'ANDORRA', 'AD', 0),
(2, 'UNITED ARAB EMIRATES', 'AE', 0),
(3, 'AFGHANISTAN', 'AF', 0),
(4, 'ANTIGUA AND BARBUDA', 'AG', 0),
(5, 'ANGUILLA', 'AI', 0),
(6, 'ALBANIA', 'AL', 0),
(7, 'ARMENIA', 'AM', 0),
(8, 'ANGOLA', 'AO', 0),
(9, 'ANTARCTICA', 'AQ', 0),
(10, 'ARGENTINA', 'AR', 0),
(11, 'AMERICAN SAMOA', 'AS', 0),
(12, 'AUSTRIA', 'AT', 0),
(13, 'AUSTRALIA', 'AU', 0),
(14, 'ARUBA', 'AW', 0),
(15, 'ALAND ISLANDS', 'AX', 0),
(16, 'AZERBAIJAN', 'AZ', 0),
(17, 'BOSNIA AND HERZEGOVINA', 'BA', 0),
(18, 'BARBADOS', 'BB', 0),
(19, 'BANGLADESH', 'BD', 0),
(20, 'BELGIUM', 'BE', 0),
(21, 'BURKINA FASO', 'BF', 0),
(22, 'BULGARIA', 'BG', 0),
(23, 'BAHRAIN', 'BH', 0),
(24, 'BURUNDI', 'BI', 0),
(25, 'BENIN', 'BJ', 0),
(26, 'SAINT BARTHELEMY', 'BL', 0),
(27, 'BERMUDA', 'BM', 0),
(28, 'BRUNEI DARUSSALAM', 'BN', 0),
(29, 'BOLIVIA, PLURINATIONAL STATE OF', 'BO', 0),
(30, 'BONAIRE, SINT EUSTATIUS AND SABA', 'BQ', 0),
(31, 'BRAZIL', 'BR', 0),
(32, 'BAHAMAS', 'BS', 0),
(33, 'BHUTAN', 'BT', 0),
(34, 'BOUVET ISLAND', 'BV', 0),
(35, 'BOTSWANA', 'BW', 0),
(36, 'BELARUS', 'BY', 0),
(37, 'BELIZE', 'BZ', 0),
(38, 'CANADA', 'CA', 0),
(39, 'COCOS (KEELING) ISLANDS', 'CC', 0),
(40, 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'CD', 0),
(41, 'CENTRAL AFRICAN REPUBLIC', 'CF', 0),
(42, 'CONGO', 'CG', 0),
(43, 'SWITZERLAND', 'CH', 0),
(44, 'COTE DIVOIRE', 'CI', 0),
(45, 'COOK ISLANDS', 'CK', 0),
(46, 'CHILE', 'CL', 0),
(47, 'CAMEROON', 'CM', 0),
(48, 'CHINA', 'CN', 0),
(49, 'COLOMBIA', 'CO', 0),
(50, 'COSTA RICA', 'CR', 0),
(51, 'CUBA', 'CU', 0),
(52, 'CAPE VERDE', 'CV', 0),
(53, 'CURACAO', 'CW', 0),
(54, 'CHRISTMAS ISLAND', 'CX', 0),
(55, 'CYPRUS', 'CY', 0),
(56, 'CZECH REPUBLIC', 'CZ', 0),
(57, 'GERMANY', 'DE', 0),
(58, 'DJIBOUTI', 'DJ', 0),
(59, 'DENMARK', 'DK', 0),
(60, 'DOMINICA', 'DM', 0),
(61, 'DOMINICAN REPUBLIC', 'DO', 0),
(62, 'ALGERIA', 'DZ', 0),
(63, 'ECUADOR', 'EC', 0),
(64, 'ESTONIA', 'EE', 0),
(65, 'EGYPT', 'EG', 0),
(66, 'WESTERN SAHARA', 'EH', 0),
(67, 'ERITREA', 'ER', 0),
(68, 'SPAIN', 'ES', 0),
(69, 'ETHIOPIA', 'ET', 0),
(70, 'FINLAND', 'FI', 0),
(71, 'FIJI', 'FJ', 0),
(72, 'FALKLAND ISLANDS (MALVINAS)', 'FK', 0),
(73, 'MICRONESIA, FEDERATED STATES OF', 'FM', 0),
(74, 'FAROE ISLANDS', 'FO', 0),
(75, 'FRANCE', 'FR', 0),
(76, 'GABON', 'GA', 0),
(77, 'UNITED KINGDOM', 'GB', 0),
(78, 'GRENADA', 'GD', 0),
(79, 'GEORGIA', 'GE', 0),
(80, 'FRENCH GUIANA', 'GF', 0),
(81, 'GUERNSEY', 'GG', 0),
(82, 'GHANA', 'GH', 0),
(83, 'GIBRALTAR', 'GI', 0),
(84, 'GREENLAND', 'GL', 0),
(85, 'GAMBIA', 'GM', 0),
(86, 'GUINEA', 'GN', 0),
(87, 'GUADELOUPE', 'GP', 0),
(88, 'EQUATORIAL GUINEA', 'GQ', 0),
(89, 'GREECE', 'GR', 0),
(90, 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'GS', 0),
(91, 'GUATEMALA', 'GT', 0),
(92, 'GUAM', 'GU', 0),
(93, 'GUINEA-BISSAU', 'GW', 0),
(94, 'GUYANA', 'GY', 0),
(95, 'HONG KONG', 'HK', 0),
(96, 'HEARD ISLAND AND MCDONALD ISLANDS', 'HM', 0),
(97, 'HONDURAS', 'HN', 0),
(98, 'CROATIA', 'HR', 0),
(99, 'HAITI', 'HT', 0),
(100, 'HUNGARY', 'HU', 0),
(101, 'INDONESIA', 'ID', 0),
(102, 'IRELAND', 'IE', 0),
(103, 'ISRAEL', 'IL', 0),
(104, 'ISLE OF MAN', 'IM', 0),
(105, 'INDIA', 'IN', 0),
(106, 'BRITISH INDIAN OCEAN TERRITORY', 'IO', 0),
(107, 'IRAQ', 'IQ', 0),
(108, 'IRAN, ISLAMIC REPUBLIC OF', 'IR', 0),
(109, 'ICELAND', 'IS', 0),
(110, 'ITALY', 'IT', 0),
(111, 'JERSEY', 'JE', 0),
(112, 'JAMAICA', 'JM', 0),
(113, 'JORDAN', 'JO', 0),
(114, 'JAPAN', 'JP', 0),
(115, 'KENYA', 'KE', 0),
(116, 'KYRGYZSTAN', 'KG', 0),
(117, 'CAMBODIA', 'KH', 0),
(118, 'KIRIBATI', 'KI', 0),
(119, 'COMOROS', 'KM', 0),
(120, 'SAINT KITTS AND NEVIS', 'KN', 0),
(121, 'KOREA, DEMOCRATIC PEOPLES REPUBLIC OF', 'KP', 0),
(122, 'KOREA, REPUBLIC OF', 'KR', 0),
(123, 'KUWAIT', 'KW', 0),
(124, 'CAYMAN ISLANDS', 'KY', 0),
(125, 'KAZAKHSTAN', 'KZ', 0),
(126, 'LAO PEOPLES DEMOCRATIC REPUBLIC', 'LA', 0),
(127, 'LEBANON', 'LB', 0),
(128, 'SAINT LUCIA', 'LC', 0),
(129, 'LIECHTENSTEIN', 'LI', 0),
(130, 'SRI LANKA', 'LK', 0),
(131, 'LIBERIA', 'LR', 0),
(132, 'LESOTHO', 'LS', 0),
(133, 'LITHUANIA', 'LT', 0),
(134, 'LUXEMBOURG', 'LU', 0),
(135, 'LATVIA', 'LV', 0),
(136, 'LIBYA', 'LY', 0),
(137, 'MOROCCO', 'MA', 0),
(138, 'MONACO', 'MC', 0),
(139, 'MOLDOVA, REPUBLIC OF', 'MD', 0),
(140, 'MONTENEGRO', 'ME', 0),
(141, 'SAINT MARTIN (FRENCH PART)', 'MF', 0),
(142, 'MADAGASCAR', 'MG', 0),
(143, 'MARSHALL ISLANDS', 'MH', 0),
(144, 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'MK', 0),
(145, 'MALI', 'ML', 0),
(146, 'MYANMAR', 'MM', 0),
(147, 'MONGOLIA', 'MN', 0),
(148, 'MACAO', 'MO', 0),
(149, 'NORTHERN MARIANA ISLANDS', 'MP', 0),
(150, 'MARTINIQUE', 'MQ', 0),
(151, 'MAURITANIA', 'MR', 0),
(152, 'MONTSERRAT', 'MS', 0),
(153, 'MALTA', 'MT', 0),
(154, 'MAURITIUS', 'MU', 0),
(155, 'MALDIVES', 'MV', 0),
(156, 'MALAWI', 'MW', 0),
(157, 'MEXICO', 'MX', 0),
(158, 'MALAYSIA', 'MY', 0),
(159, 'MOZAMBIQUE', 'MZ', 0),
(160, 'NAMIBIA', 'NA', 0),
(161, 'NEW CALEDONIA', 'NC', 0),
(162, 'NIGER', 'NE', 0),
(163, 'NORFOLK ISLAND', 'NF', 0),
(164, 'NIGERIA', 'NG', 0),
(165, 'NICARAGUA', 'NI', 0),
(166, 'NETHERLANDS', 'NL', 0),
(167, 'NORWAY', 'NO', 0),
(168, 'NEPAL', 'NP', 0),
(169, 'NAURU', 'NR', 0),
(170, 'NIUE', 'NU', 0),
(171, 'NEW ZEALAND', 'NZ', 0),
(172, 'OMAN', 'OM', 0),
(173, 'PANAMA', 'PA', 0),
(174, 'PERU', 'PE', 0),
(175, 'FRENCH POLYNESIA', 'PF', 0),
(176, 'PAPUA NEW GUINEA', 'PG', 0),
(177, 'PHILIPPINES', 'PH', 0),
(178, 'PAKISTAN', 'PK', 0),
(179, 'POLAND', 'PL', 0),
(180, 'SAINT PIERRE AND MIQUELON', 'PM', 0),
(181, 'PITCAIRN', 'PN', 0),
(182, 'PUERTO RICO', 'PR', 0),
(183, 'PALESTINIAN TERRITORY, OCCUPIED', 'PS', 0),
(184, 'PORTUGAL', 'PT', 0),
(185, 'PALAU', 'PW', 0),
(186, 'PARAGUAY', 'PY', 0),
(187, 'QATAR', 'QA', 0),
(188, 'REUNION', 'RE', 0),
(189, 'ROMANIA', 'RO', 0),
(190, 'SERBIA', 'RS', 0),
(191, 'RUSSIAN FEDERATION', 'RU', 0),
(192, 'RWANDA', 'RW', 0),
(193, 'SAUDI ARABIA', 'SA', 0),
(194, 'SOLOMON ISLANDS', 'SB', 0),
(195, 'SEYCHELLES', 'SC', 0),
(196, 'SUDAN', 'SD', 0),
(197, 'SWEDEN', 'SE', 0),
(198, 'SINGAPORE', 'SG', 0),
(199, 'SAINT HELENA', 'SH', 0),
(200, 'SLOVENIA', 'SI', 0),
(201, 'SVALBARD AND JAN MAYEN', 'SJ', 0),
(202, 'SLOVAKIA', 'SK', 0),
(203, 'SIERRA LEONE', 'SL', 0),
(204, 'SAN MARINO', 'SM', 0),
(205, 'SENEGAL', 'SN', 0),
(206, 'SOMALIA', 'SO', 0),
(207, 'SURINAME', 'SR', 0),
(208, 'SOUTH SUDAN', 'SS', 0),
(209, 'SAO TOME AND PRINCIPE', 'ST', 0),
(210, 'EL SALVADOR', 'SV', 0),
(211, 'SINT MAARTEN (DUTCH PART)', 'SX', 0),
(212, 'SYRIAN ARAB REPUBLIC', 'SY', 0),
(213, 'SWAZILAND', 'SZ', 0),
(214, 'TURKS AND CAICOS ISLANDS', 'TC', 0),
(215, 'CHAD', 'TD', 0),
(216, 'FRENCH SOUTHERN TERRITORIES', 'TF', 0),
(217, 'TOGO', 'TG', 0),
(218, 'THAILAND', 'TH', 0),
(219, 'TAJIKISTAN', 'TJ', 0),
(220, 'TOKELAU', 'TK', 0),
(221, 'TIMOR-LESTE', 'TL', 0),
(222, 'TURKMENISTAN', 'TM', 0),
(223, 'TUNISIA', 'TN', 0),
(224, 'TONGA', 'TO', 0),
(225, 'TURKEY', 'TR', 0),
(226, 'TRINIDAD AND TOBAGO', 'TT', 0),
(227, 'TUVALU', 'TV', 0),
(228, 'TAIWAN, PROVINCE OF CHINA', 'TW', 0),
(229, 'TANZANIA', 'TZ', 0),
(230, 'UKRAINE', 'UA', 0),
(231, 'UGANDA', 'UG', 0),
(232, 'UNITED STATES MINOR OUTLYING ISLANDS', 'UM', 0),
(233, 'UNITED STATES', 'US', 0),
(234, 'URUGUAY', 'UY', 0),
(235, 'UZBEKISTAN', 'UZ', 0),
(236, 'HOLY SEE (VATICAN CITY STATE)', 'VA', 0),
(237, 'SAINT VINCENT AND THE GRENADINES', 'VC', 0),
(238, 'VENEZUELA, BOLIVARIAN REPUBLIC OF', 'VE', 0),
(239, 'VIRGIN ISLANDS, BRITISH', 'VG', 0),
(240, 'VIRGIN ISLANDS, U.S.', 'VI', 0),
(241, 'VIET NAM', 'VN', 0),
(242, 'VANUATU', 'VU', 0),
(243, 'WALLIS AND FUTUNA', 'WF', 0),
(244, 'SAMOA', 'WS', 0),
(245, 'YEMEN', 'YE', 0),
(246, 'MAYOTTE', 'YT', 0),
(247, 'SOUTH AFRICA', 'ZA', 0),
(248, 'ZAMBIA', 'ZM', 0),
(249, 'ZIMBABWE', 'ZW', 0),
(250, 'TESTCOUNTRY', 'TCS', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cps_chequeseries`
--

CREATE TABLE IF NOT EXISTS `tb_cps_chequeseries` (
  `series_id` int(11) NOT NULL AUTO_INCREMENT,
  `series_lastno` int(6) NOT NULL,
  PRIMARY KEY (`series_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


--
-- Table structure for table `tb_cps_groups`
--

CREATE TABLE IF NOT EXISTS `tb_cps_groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) NOT NULL,
  `group_createddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `opening_time1` time NOT NULL DEFAULT '00:00:00',
  `closing_time1` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`branch_halfday_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=ucs2 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=ucs2 AUTO_INCREMENT=1 ;


--
-- Table structure for table `tb_cps_mapfields`
--

CREATE TABLE IF NOT EXISTS `tb_cps_mapfields` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `cps_city_code` varchar(30) NOT NULL,
  `cps_bank_code` varchar(30) NOT NULL,
  `cps_branch_code` varchar(30) NOT NULL,
  `cps_branch_soleID` varchar(30) NOT NULL,
  `cps_micr_account_no` varchar(30) NOT NULL,
  `cps_account_no` varchar(30) NOT NULL,
  `cps_tr_code` varchar(30) NOT NULL,
  `cps_act_name` varchar(30) NOT NULL,
  `cps_act_jointname1` varchar(30) NOT NULL,
  `cps_act_jointname2` varchar(30) NOT NULL,
  `cps_auth_sign1` varchar(30) NOT NULL,
  `cps_auth_sign2` varchar(30) NOT NULL,
  `cps_auth_sign3` varchar(30) NOT NULL,
  `cps_act_address1` varchar(100) NOT NULL,
  `cps_act_address2` varchar(100) NOT NULL,
  `cps_act_address3` varchar(100) NOT NULL,
  `cps_act_address4` varchar(100) NOT NULL,
  `cps_act_address5` varchar(100) NOT NULL,
  `cps_act_city` varchar(30) NOT NULL,
  `cps_act_pin` varchar(30) NOT NULL,
  `cps_act_telephone_res` varchar(30) NOT NULL,
  `cps_act_telephone_off` varchar(30) NOT NULL,
  `cps_act_mobile` varchar(30) NOT NULL,
  `cps_no_of_books` varchar(30) NOT NULL,
  `cps_book_size` varchar(30) NOT NULL,
  `cps_dly_bearer_order` varchar(30) NOT NULL,
  `cps_atpar` varchar(30) NOT NULL,
  `cps_pr_code` varchar(30) NOT NULL,
  `cps_chq_no_from` varchar(30) NOT NULL,
  `cps_chq_no_to` varchar(30) NOT NULL,
  `cps_effective_date` varchar(20) NOT NULL,
  `cps_issue_date` varchar(20) NOT NULL,
  `cps_sr_no_infra` varchar(30) NOT NULL,
  `cps_alpha_code` varchar(30) NOT NULL,
  `cps_spectial_series` varchar(30) NOT NULL,
  `cps_ifsc_code` varchar(30) NOT NULL,
  `cps_rtgs_code` varchar(30) NOT NULL,
  `cps_neft_code` varchar(30) NOT NULL,
  `cps_unique_req` varchar(30) NOT NULL,
  `cps_state` varchar(25) NOT NULL,
  `cps_country` varchar(25) NOT NULL,
  `cps_emailid` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


--
-- Table structure for table `tb_cps_printerbrands`
--

CREATE TABLE IF NOT EXISTS `tb_cps_printerbrands` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_cps_printerbrands`
--

INSERT INTO `tb_cps_printerbrands` (`brand_id`, `brand_name`) VALUES
(1, 'Lexmark'),
(2, 'Canon');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cps_printermodels`
--

CREATE TABLE IF NOT EXISTS `tb_cps_printermodels` (
  `model_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) NOT NULL,
  `model_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cheque1_branchaddressline1X` int(11) NOT NULL,
  `cheque1_branchaddressline1Y` int(11) NOT NULL,
  `cheque1_branchaddressline2X` int(11) NOT NULL,
  `cheque1_branchaddressline2Y` int(11) NOT NULL,
  `cheque1_branchaddressline3X` int(11) NOT NULL,
  `cheque1_branchaddressline3Y` int(11) NOT NULL,
  `cheque1_accountnoX` int(11) NOT NULL,
  `cheque1_accountnoY` int(11) NOT NULL,
  `cheque1_accountholdernameX` int(11) NOT NULL,
  `cheque1_accountholdernameY` int(11) NOT NULL,
  `cheque1_authorizedsignatoryX` int(11) NOT NULL,
  `cheque1_authorizedsignatoryY` int(11) NOT NULL,
  `cheque1_micrbandY` int(11) NOT NULL,
  `cheque2_branchaddressline1X` int(11) NOT NULL,
  `cheque2_branchaddressline1Y` int(11) NOT NULL,
  `cheque2_branchaddressline2X` int(11) NOT NULL,
  `cheque2_branchaddressline2Y` int(11) NOT NULL,
  `cheque2_branchaddressline3X` int(11) NOT NULL,
  `cheque2_branchaddressline3Y` int(11) NOT NULL,
  `cheque2_accountnoX` int(11) NOT NULL,
  `cheque2_accountnoY` int(11) NOT NULL,
  `cheque2_accountholdernameX` int(11) NOT NULL,
  `cheque2_accountholdernameY` int(11) NOT NULL,
  `cheque2_authorizedsignatoryX` int(11) NOT NULL,
  `cheque2_authorizedsignatoryY` int(11) NOT NULL,
  `cheque2_micrbandY` int(11) NOT NULL,
  `cheque3_branchaddressline1X` int(11) NOT NULL,
  `cheque3_branchaddressline1Y` int(11) NOT NULL,
  `cheque3_branchaddressline2X` int(11) NOT NULL,
  `cheque3_branchaddressline2Y` int(11) NOT NULL,
  `cheque3_branchaddressline3X` int(11) NOT NULL,
  `cheque3_branchaddressline3Y` int(11) NOT NULL,
  `cheque3_accountnoX` int(11) NOT NULL,
  `cheque3_accountnoY` int(11) NOT NULL,
  `cheque3_accountholdernameX` int(11) NOT NULL,
  `cheque3_accountholdernameY` int(11) NOT NULL,
  `cheque3_authorizedsignatoryX` int(11) NOT NULL,
  `cheque3_authorizedsignatoryY` int(11) NOT NULL,
  `cheque3_micrbandY` int(11) NOT NULL,
  `cheques_trancodeX` int(11) NOT NULL,
  `cheques_micraccnoX` int(11) NOT NULL,
  `cheques_sortcodeX` int(11) NOT NULL,
  `cheques_chequenoX` int(11) NOT NULL,
  `font` float NOT NULL,
  PRIMARY KEY (`model_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_cps_printermodels`
--

INSERT INTO `tb_cps_printermodels` (`model_id`, `brand_id`, `model_name`, `cheque1_branchaddressline1X`, `cheque1_branchaddressline1Y`, `cheque1_branchaddressline2X`, `cheque1_branchaddressline2Y`, `cheque1_branchaddressline3X`, `cheque1_branchaddressline3Y`, `cheque1_accountnoX`, `cheque1_accountnoY`, `cheque1_accountholdernameX`, `cheque1_accountholdernameY`, `cheque1_authorizedsignatoryX`, `cheque1_authorizedsignatoryY`, `cheque1_micrbandY`, `cheque2_branchaddressline1X`, `cheque2_branchaddressline1Y`, `cheque2_branchaddressline2X`, `cheque2_branchaddressline2Y`, `cheque2_branchaddressline3X`, `cheque2_branchaddressline3Y`, `cheque2_accountnoX`, `cheque2_accountnoY`, `cheque2_accountholdernameX`, `cheque2_accountholdernameY`, `cheque2_authorizedsignatoryX`, `cheque2_authorizedsignatoryY`, `cheque2_micrbandY`, `cheque3_branchaddressline1X`, `cheque3_branchaddressline1Y`, `cheque3_branchaddressline2X`, `cheque3_branchaddressline2Y`, `cheque3_branchaddressline3X`, `cheque3_branchaddressline3Y`, `cheque3_accountnoX`, `cheque3_accountnoY`, `cheque3_accountholdernameX`, `cheque3_accountholdernameY`, `cheque3_authorizedsignatoryX`, `cheque3_authorizedsignatoryY`, `cheque3_micrbandY`, `cheques_trancodeX`, `cheques_micraccnoX`, `cheques_sortcodeX`, `cheques_chequenoX`, `font`) VALUES
(1, 1, 'E260dn', 153, 100, 153, 110, 153, 120, 153, 162, 609, 162, 579, 225, 295, 153, 460, 153, 470, 153, 480, 153, 510, 609, 510, 579, 575, 647, 153, 810, 153, 820, 153, 830, 153, 859, 611, 859, 579, 920, 996, 562, 528, 432, 300, 11.5),
(2, 2, 'LBP 3300', 153, 100, 153, 110, 153, 120, 153, 162, 609, 162, 579, 225, 295, 153, 460, 153, 470, 153, 480, 153, 510, 609, 510, 579, 575, 647, 153, 810, 153, 820, 153, 830, 153, 859, 611, 859, 579, 920, 996, 556, 522, 426, 294, 11.5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_cps_reprintque`
--

CREATE TABLE IF NOT EXISTS `tb_cps_reprintque` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `cps_city_code` int(3) unsigned zerofill NOT NULL,
  `cps_bank_code` int(3) unsigned zerofill NOT NULL,
  `cps_branch_code` int(3) unsigned zerofill NOT NULL,
  `cps_branch_soleID` int(20) NOT NULL,
  `cps_micr_account_no` int(6) unsigned zerofill NOT NULL,
  `cps_account_no` varchar(20) NOT NULL,
  `cps_tr_code` int(2) unsigned zerofill NOT NULL,
  `cps_act_name` varchar(30) NOT NULL,
  `cps_act_jointname1` varchar(30) NOT NULL,
  `cps_act_jointname2` varchar(30) NOT NULL,
  `cps_auth_sign1` varchar(30) NOT NULL,
  `cps_auth_sign2` varchar(30) NOT NULL,
  `cps_auth_sign3` varchar(30) NOT NULL,
  `cps_act_address1` varchar(100) NOT NULL,
  `cps_act_address2` varchar(100) NOT NULL,
  `cps_act_address3` varchar(100) NOT NULL,
  `cps_act_address4` varchar(100) NOT NULL,
  `cps_act_address5` varchar(100) NOT NULL,
  `cps_act_city` int(10) NOT NULL,
  `cps_act_pin` int(15) NOT NULL,
  `cps_act_telephone_res` int(15) NOT NULL,
  `cps_act_telephone_off` int(15) NOT NULL,
  `cps_act_mobile` int(15) NOT NULL,
  `cps_no_of_books` int(5) NOT NULL,
  `cps_book_size` int(5) NOT NULL,
  `cps_dly_bearer_order` varchar(15) NOT NULL,
  `cps_atpar` varchar(5) NOT NULL,
  `cps_pr_code` int(10) NOT NULL,
  `cps_chq_no_from` int(6) unsigned zerofill NOT NULL,
  `cps_chq_no_to` int(6) unsigned zerofill NOT NULL,
  `cps_effective_date` varchar(20) NOT NULL,
  `cps_issue_date` varchar(20) NOT NULL,
  `cps_sr_no_infra` int(5) NOT NULL,
  `cps_alpha_code` varchar(10) NOT NULL,
  `cps_spectial_series` int(50) NOT NULL,
  `cps_ifsc_code` varchar(5) NOT NULL,
  `cps_rtgs_code` varchar(5) NOT NULL,
  `cps_neft_code` varchar(5) NOT NULL,
  `cps_unique_req` varchar(50) NOT NULL,
  `cps_state` varchar(25) NOT NULL,
  `cps_country` varchar(25) NOT NULL,
  `cps_emailid` varchar(30) NOT NULL,
  `cps_date` date NOT NULL,
  `cps_reprint_approved` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


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
  `chk_no_from` int(7) NOT NULL,
  `chk_no_to` int(7) NOT NULL,
  `nooffailedpasswordattempt` int(11) NOT NULL,
  `password_expiry` int(11) NOT NULL,
  `homescreen_text` varchar(100) NOT NULL,
  `poweredby` varchar(100) NOT NULL,
  `banklogo` varchar(100) NOT NULL,
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
  `license_users_leaves` int(1) NOT NULL,
  `license_users_leaves_value` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Table structure for table `tb_cps_transactioncodes`
--

CREATE TABLE IF NOT EXISTS `tb_cps_transactioncodes` (
  `transactioncode_id` int(11) NOT NULL AUTO_INCREMENT,
  `transactioncode` int(2) NOT NULL,
  `transactioncodedescription` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `transactionstatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`transactioncode_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
  `opening_time1` time NOT NULL DEFAULT '00:00:00',
  `opening_time2` time NOT NULL DEFAULT '00:00:00',
  `closing_time1` time NOT NULL DEFAULT '00:00:00',
  `closing_time2` time NOT NULL DEFAULT '00:00:00',
  PRIMARY KEY (`branch_workingday_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=ucs2 AUTO_INCREMENT=1 ;



--
-- Table structure for table `tb_pending_print_req`
--

CREATE TABLE IF NOT EXISTS `tb_pending_print_req` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `cps_city_code` int(3) unsigned zerofill NOT NULL,
  `cps_bank_code` int(3) unsigned zerofill NOT NULL,
  `cps_branch_code` int(3) unsigned zerofill NOT NULL,
  `cps_branch_soleID` int(20) NOT NULL,
  `cps_micr_account_no` int(6) unsigned zerofill NOT NULL,
  `cps_account_no` varchar(20) NOT NULL,
  `cps_tr_code` int(2) unsigned zerofill NOT NULL,
  `cps_act_name` varchar(30) NOT NULL,
  `cps_act_jointname1` varchar(30) NOT NULL,
  `cps_act_jointname2` varchar(30) NOT NULL,
  `cps_auth_sign1` varchar(30) NOT NULL,
  `cps_auth_sign2` varchar(30) NOT NULL,
  `cps_auth_sign3` varchar(30) NOT NULL,
  `cps_act_address1` varchar(100) NOT NULL,
  `cps_act_address2` varchar(100) NOT NULL,
  `cps_act_address3` varchar(100) NOT NULL,
  `cps_act_address4` varchar(100) NOT NULL,
  `cps_act_address5` varchar(100) NOT NULL,
  `cps_act_city` int(10) NOT NULL,
  `cps_act_pin` int(15) NOT NULL,
  `cps_act_telephone_res` int(15) NOT NULL,
  `cps_act_telephone_off` int(15) NOT NULL,
  `cps_act_mobile` int(15) NOT NULL,
  `cps_no_of_books` int(5) NOT NULL,
  `cps_book_size` int(5) NOT NULL,
  `cps_dly_bearer_order` varchar(15) NOT NULL,
  `cps_atpar` varchar(5) NOT NULL,
  `cps_pr_code` int(10) NOT NULL,
  `cps_chq_no_from` int(6) unsigned zerofill NOT NULL,
  `cps_chq_no_to` int(6) unsigned zerofill NOT NULL,
  `cps_effective_date` varchar(20) NOT NULL,
  `cps_issue_date` varchar(20) NOT NULL,
  `cps_sr_no_infra` int(5) NOT NULL,
  `cps_alpha_code` varchar(10) NOT NULL,
  `cps_spectial_series` int(50) NOT NULL,
  `cps_ifsc_code` varchar(5) NOT NULL,
  `cps_rtgs_code` varchar(5) NOT NULL,
  `cps_neft_code` varchar(5) NOT NULL,
  `cps_unique_req` varchar(50) NOT NULL,
  `cps_isprint` int(5) NOT NULL DEFAULT '0',
  `cps_state` varchar(25) NOT NULL,
  `cps_country` varchar(25) NOT NULL,
  `cps_emailid` varchar(30) NOT NULL,
  `cps_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`adminid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


--
-- Table structure for table `tb_printque`
--

CREATE TABLE IF NOT EXISTS `tb_printque` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `cps_city_code` int(3) unsigned zerofill NOT NULL,
  `cps_bank_code` int(3) unsigned zerofill NOT NULL,
  `cps_branch_code` int(3) unsigned zerofill NOT NULL,
  `cps_branch_soleID` int(20) NOT NULL,
  `cps_micr_account_no` int(6) unsigned zerofill NOT NULL,
  `cps_account_no` varchar(20) NOT NULL,
  `cps_tr_code` int(2) unsigned zerofill NOT NULL,
  `cps_act_name` varchar(30) NOT NULL,
  `cps_act_jointname1` varchar(30) NOT NULL,
  `cps_act_jointname2` varchar(30) NOT NULL,
  `cps_auth_sign1` varchar(30) NOT NULL,
  `cps_auth_sign2` varchar(30) NOT NULL,
  `cps_auth_sign3` varchar(30) NOT NULL,
  `cps_act_address1` varchar(100) NOT NULL,
  `cps_act_address2` varchar(100) NOT NULL,
  `cps_act_address3` varchar(100) NOT NULL,
  `cps_act_address4` varchar(100) NOT NULL,
  `cps_act_address5` varchar(100) NOT NULL,
  `cps_act_city` int(10) NOT NULL,
  `cps_act_pin` int(15) NOT NULL,
  `cps_act_telephone_res` int(15) NOT NULL,
  `cps_act_telephone_off` int(15) NOT NULL,
  `cps_act_mobile` int(15) NOT NULL,
  `cps_no_of_books` int(5) NOT NULL,
  `cps_book_size` int(5) NOT NULL,
  `cps_dly_bearer_order` varchar(15) NOT NULL,
  `cps_atpar` varchar(5) NOT NULL,
  `cps_pr_code` int(10) NOT NULL,
  `cps_chq_no_from` int(6) unsigned zerofill NOT NULL,
  `cps_chq_no_to` int(6) unsigned zerofill NOT NULL,
  `cps_effective_date` varchar(20) NOT NULL,
  `cps_issue_date` varchar(20) NOT NULL,
  `cps_sr_no_infra` int(5) NOT NULL,
  `cps_alpha_code` varchar(10) NOT NULL,
  `cps_spectial_series` int(50) NOT NULL,
  `cps_ifsc_code` varchar(5) NOT NULL,
  `cps_rtgs_code` varchar(5) NOT NULL,
  `cps_neft_code` varchar(5) NOT NULL,
  `cps_unique_req` varchar(50) NOT NULL,
  `cps_state` varchar(25) NOT NULL,
  `cps_country` varchar(25) NOT NULL,
  `cps_emailid` varchar(30) NOT NULL,
  `cps_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_print_req_collection`
--

CREATE TABLE IF NOT EXISTS `tb_print_req_collection` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `cps_city_code` int(3) unsigned zerofill NOT NULL,
  `cps_bank_code` int(3) unsigned zerofill NOT NULL,
  `cps_branch_code` int(3) unsigned zerofill NOT NULL,
  `cps_branch_soleID` int(20) NOT NULL,
  `cps_micr_account_no` int(6) unsigned zerofill NOT NULL,
  `cps_account_no` varchar(20) NOT NULL,
  `cps_tr_code` int(2) unsigned zerofill NOT NULL,
  `cps_act_name` varchar(30) NOT NULL,
  `cps_act_jointname1` varchar(30) NOT NULL,
  `cps_act_jointname2` varchar(30) NOT NULL,
  `cps_auth_sign1` varchar(30) NOT NULL,
  `cps_auth_sign2` varchar(30) NOT NULL,
  `cps_auth_sign3` varchar(30) NOT NULL,
  `cps_act_address1` varchar(100) NOT NULL,
  `cps_act_address2` varchar(100) NOT NULL,
  `cps_act_address3` varchar(100) NOT NULL,
  `cps_act_address4` varchar(100) NOT NULL,
  `cps_act_address5` varchar(100) NOT NULL,
  `cps_act_city` int(10) NOT NULL,
  `cps_act_pin` int(15) NOT NULL,
  `cps_act_telephone_res` int(15) NOT NULL,
  `cps_act_telephone_off` int(15) NOT NULL,
  `cps_act_mobile` int(15) NOT NULL,
  `cps_no_of_books` int(5) NOT NULL,
  `cps_book_size` int(5) NOT NULL,
  `cps_dly_bearer_order` varchar(15) NOT NULL,
  `cps_atpar` varchar(5) NOT NULL,
  `cps_pr_code` int(10) NOT NULL,
  `cps_chq_no_from` int(6) unsigned zerofill NOT NULL,
  `cps_chq_no_to` int(6) unsigned zerofill NOT NULL,
  `cps_effective_date` varchar(20) NOT NULL,
  `cps_issue_date` varchar(20) NOT NULL,
  `cps_sr_no_infra` int(5) NOT NULL,
  `cps_alpha_code` varchar(10) NOT NULL,
  `cps_spectial_series` int(50) NOT NULL,
  `cps_ifsc_code` varchar(5) NOT NULL,
  `cps_rtgs_code` varchar(5) NOT NULL,
  `cps_neft_code` varchar(5) NOT NULL,
  `cps_unique_req` varchar(50) NOT NULL,
  `cps_state` varchar(25) NOT NULL,
  `cps_country` varchar(25) NOT NULL,
  `cps_emailid` varchar(30) NOT NULL,
  `cps_date` date NOT NULL,
  `cps_is_reprint` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


--
-- Table structure for table `tb_reprintadmin`
--

CREATE TABLE IF NOT EXISTS `tb_reprintadmin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `lastlogintime` datetime NOT NULL,
  `adminid` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`adminid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;


--
-- Table structure for table `tb_uploadingdata`
--

CREATE TABLE IF NOT EXISTS `tb_uploadingdata` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `cps_city_code` int(3) unsigned zerofill NOT NULL,
  `cps_bank_code` int(3) unsigned zerofill NOT NULL,
  `cps_branch_code` int(3) unsigned zerofill NOT NULL,
  `cps_branch_soleID` int(20) NOT NULL,
  `cps_micr_account_no` int(6) unsigned zerofill NOT NULL,
  `cps_account_no` varchar(20) NOT NULL,
  `cps_tr_code` int(2) unsigned zerofill NOT NULL,
  `cps_act_name` varchar(30) NOT NULL,
  `cps_act_jointname1` varchar(30) NOT NULL,
  `cps_act_jointname2` varchar(30) NOT NULL,
  `cps_auth_sign1` varchar(30) NOT NULL,
  `cps_auth_sign2` varchar(30) NOT NULL,
  `cps_auth_sign3` varchar(30) NOT NULL,
  `cps_act_address1` varchar(100) NOT NULL,
  `cps_act_address2` varchar(100) NOT NULL,
  `cps_act_address3` varchar(100) NOT NULL,
  `cps_act_address4` varchar(100) NOT NULL,
  `cps_act_address5` varchar(100) NOT NULL,
  `cps_act_city` int(10) NOT NULL,
  `cps_act_pin` int(15) NOT NULL,
  `cps_act_telephone_res` int(15) NOT NULL,
  `cps_act_telephone_off` int(15) NOT NULL,
  `cps_act_mobile` int(15) NOT NULL,
  `cps_no_of_books` int(5) NOT NULL,
  `cps_book_size` int(5) NOT NULL,
  `cps_dly_bearer_order` varchar(15) NOT NULL,
  `cps_atpar` varchar(5) NOT NULL,
  `cps_pr_code` int(10) NOT NULL,
  `cps_chq_no_from` int(6) unsigned zerofill NOT NULL,
  `cps_chq_no_to` int(6) unsigned zerofill NOT NULL,
  `cps_effective_date` varchar(20) NOT NULL,
  `cps_issue_date` varchar(20) NOT NULL,
  `cps_sr_no_infra` int(5) NOT NULL,
  `cps_alpha_code` varchar(10) NOT NULL,
  `cps_spectial_series` int(50) NOT NULL,
  `cps_ifsc_code` varchar(5) NOT NULL,
  `cps_rtgs_code` varchar(5) NOT NULL,
  `cps_neft_code` varchar(5) NOT NULL,
  `cps_unique_req` varchar(50) NOT NULL,
  `cps_state` varchar(25) NOT NULL,
  `cps_country` varchar(25) NOT NULL,
  `cps_emailid` varchar(30) NOT NULL,
  `cps_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
