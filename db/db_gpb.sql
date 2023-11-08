-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 01, 2023 at 03:35 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_gpb`
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
  `bank_name` varchar(100) NOT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tb_bankdetails`
--

INSERT INTO `tb_bankdetails` (`bank_id`, `bank_name`, `bank_code`, `bank_address1`, `bank_address2`, `bank_address3`, `bank_country_id`, `bank_state_id`, `bank_city_id`, `bank_suburb_id`, `bank_pin`, `bank_contact_no1`, `bank_contact_no2`, `bank_contact_per1`, `bank_contact_per2`, `bank_contact_per_LL1`, `bank_contact_per_LL2`, `bank_emailid2`, `bank_emailid`, `bank_website`, `bank_printers`) VALUES
(0001, 'GP PARSIK SAHKARI BANK LTD.', 312, 'SHIVAJI PATH', 'POST BOX 19', 'THANE (W)', 1, 2, 5, 10, '400605', '', '', '', '', 0, 0, '', '', 'http://www.gpparsikbank.com/', 'a:1:{i:0;a:3:{i:0;s:26:"HP LaserJet 400 M401 PCL 6";i:1;s:6:"Tray 2";i:2;s:6:"Tray 3";}}');

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
  `branch_address1` varchar(85) NOT NULL,
  `branch_address2` varchar(65) NOT NULL,
  `branch_address3` varchar(85) NOT NULL,
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
  `branch_Services` varchar(100) NOT NULL,
  `branch_reg_busi_hrs` varchar(100) NOT NULL,
  `branch_half_busi_hrs` varchar(100) NOT NULL,
  `branch_sunday_working` varchar(100) NOT NULL,
  `branch_tollfree_no` varchar(20) NOT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=97 ;

--
-- Dumping data for table `tb_branchdetails`
--

INSERT INTO `tb_branchdetails` (`branch_id`, `branch_code`, `branch_name`, `branch_micr`, `branch_atparmicrcode`, `branch_address1`, `branch_address2`, `branch_address3`, `branch_country_id`, `branch_state_id`, `branch_city_id`, `branch_suburb_id`, `branch_pin`, `branch_telephone1`, `branch_telephone2`, `branch_contactperson1`, `branch_contactperson2`, `branch_contactpersonmobile1`, `branch_contactpersonmobile2`, `branch_email1`, `branch_email2`, `branch_holiday`, `branch_neftifsccode`, `branch_printers`, `branch_working_hours`, `branch_clearingthrough`, `branch_clearingcenter`, `clr_bank_code`, `clr_bank_city`, `branch_City_Code`, `branch_Services`, `branch_reg_busi_hrs`, `branch_half_busi_hrs`, `branch_sunday_working`, `branch_tollfree_no`) VALUES
(1, 007, 'KHARKAR ALI BRANCH', '', '', 'SHOP NO.1, 2, 3, 4 & 5 1ST FLOOR, RAMDAS TOWER', 'BAZAR PETH', 'JAMBHALI NAKA, KHARKAR ALI', 1, 2, 12, 13, 400601, '', '', '', '', '', '', '', '', '', 'PJSB0000007', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(6, 034, 'BADLAPUR BRANCH', '400312034', '', 'SHOP NO. 8, 9, 32, C-BLOCK, ', 'SHREEJI BUILDING,', 'KATRAP GAON,', 1, 2, 13, 15, 421503, '0251-2691225', '0251-6481225', '', '', '', '', '', '', '', 'PJSB0000034', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(7, 047, 'AMBERNATH BRANCH', '400312047', '', 'SHOP NO.1, GROUND FLOOR, â€œROYAL JEWELSâ€ ', 'SURYODAYA CO-OP. HSG. SOCIETY LTD.,', 'PLOT NO.19, VILLAGE KOHOJ, KHUTAVALI,', 1, 2, 5, 14, 421501, '02512604050', '', '', '', '', '', '', '', '', 'PJSB0000048', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(8, 025, 'BHAYANDAR BRANCH', '400312025', '', 'HALL NO. 1 & 2, SHREE VINAYAK BUILDING,', '1ST FLOOR, SARVODAYA COMPLEX,', '', 1, 2, 15, 16, 401107, '02228126500', '', '', '', '', '', '', '', '', 'PJSB0000025', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(9, 008, 'BHIWANDI BRANCH', '400312008', '', 'UNIT NO. 2 & 3, GR. FLOOR PLUS BASEMENT, ', 'â€œSURYA EXCELLENCY 94", SURYABHAI COMPOUND,', 'NEAR NORTHERN INDIA PETROL PUMP, AGRA ROAD, ', 1, 2, 17, 27, 421302, '02522 279262', '02522 279263', '', '', '', '', '', '', '', 'PJSB0000008', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(10, 038, 'BHIWANDI SHIVAJI CHOWK BRANCH', '400312038', '', 'A-101, PRESIDENT PLAZA,', ' SHIVAJI CHOWK,', '', 1, 2, 5, 17, 421302, '02522 225255', '02522 225256', '', '', '', '', '', '', '', 'PJSB0000038', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(11, 045, 'DOMBIVALI BRANCH', '400312045', '', 'SHOP NO. 2,3,4 & 5, GROUND FLOOR,', 'SUCHIT SQUARE, VILLAGE AYARE,', ' DR. R.P.ROAD,', 1, 2, 5, 18, 421201, '02512862228', '02512862226', '', '', '', '', '', '', '', 'PJSB0000046', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(12, 022, 'KALHER BRANCH', '400312022', '', 'HOUSE NO. 453 D, BUILDING NO. 5,', 'SHETKARI UNNATI MANDAL PARSHURAM DHONDU', 'TAWARE VIDYALAYA,', 1, 2, 5, 17, 421302, '02522 276688', '02522 646696', '', '', '', '', '', '', '', 'PJSB0000022', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(13, 003, 'KALWA BRANCH', '', '', 'CREEK VIEW APARTMENT', '1ST FLOOR, BOMBAY PUNE ROAD', '', 1, 2, 5, 10, 400605, '02225378350', '', '', '', '', '', '', '', '', 'PJSB0000003', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(14, 054, 'KALYAN EAST BRANCH', '400312054', '', 'SHOP NO.5, 6 & 7, GROUND FLOOR,', 'â€œVIVAN HEIGHTSâ€ A-WING', 'PUNE - LINK ROAD, TISGAON,', 1, 2, 5, 19, 421306, '02512 355422', '', '', '', '', '', '', '', '', 'PJSB0000060', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(15, 021, 'KALYAN BRANCH', '400312021', '', 'PYARA-DECK BUILDING GALA NO. 5 & 6, ', 'OPP. BIRLA COLLEGE, MHADA, PLOT NO. C - 1, ', 'S.NO. 42A,', 1, 2, 5, 20, 421301, '0251 2316846', '', '', '', '', '', '', '', '', 'PJSB0000021', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(16, 020, 'KASARVADAVALI BRANCH', '400312020', '', 'SHOP NO. 3,4 & 5 SATNAM GARDEN C.H.S LTD.,', 'OPP POLICE STATION KASARWADAVALI, G.B.ROAD', '', 1, 2, 5, 21, 400615, '02225970629', '02225973202', '', '', '', '', '', '', '', 'PJSB0000020', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(17, 053, 'KATAI-NILJE  BRANCH', '400312053', '', 'SHOP NO. 1, GROUND FLOOR, C-WING,', 'SAMAIRA SWAY COMMERCIAL COMPLEX,', 'OPP. HP PETROL PUMP, KALYAN-SHIL ROAD,', 1, 2, 16, 22, 421204, '2513244886	', '', '', '', '', '', '', '', '', 'PJSB0000059', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(18, 063, 'KHARBHAV  BRANCH', '400312063', '', 'HOUSE NO. 1-A, GROUND FLOOR, KHARBHAV ', '', '', 1, 2, 5, 17, 421302, '8149655353	', '', '', '', '', '', '', '', '', 'PJSB0000072', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(19, 012, 'KHARIGAON BRANCH', '400312012', '', 'JAY BHARAT SPORTS CLUB BUILDING, ', 'KHARIGAON, PAKHADI, POST.', '', 1, 2, 5, 10, 400605, '02225413268', '', '', '', '', '', '', '', '', 'PJSB0000012', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(20, 051, 'KON BRANCH', '400312051', '', 'SHOP NO. 101 & 102, FIRST FLOOR', 'SHRI PRAGATI ROYAL BUILDING, A WING,', 'KALYAN-BHIWANDI ROAD, KON,', 1, 2, 5, 23, 421311, '02522-280034', '', '', '', '', '', '', '', '', 'PJSB0000057', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(21, 010, 'LOUISWADI BRANCH', '400312010', '', 'SURABHI APARTMENT,', ' GROUND FLOOR, LOUISWADI', '', 1, 2, 5, 24, 400604, '022-25811096', '022-25837982', '', '', '', '', '', '', '', 'PJSB0000010', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(22, 006, 'MAJIWADE BRANCH', '', '', 'HIGH STREET CUM HIGHLAND CORPORATE CENTRE, ', 'GR.FLOOR, GB-149, NEAR BIG BAZAR', '', 1, 2, 5, 25, 400607, '022 25420359', '022 25430777', '', '', '', '', '', '', '', 'PJSB0000006', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(23, 027, 'MANKOLI BRANCH', '400312027', '', 'SHOP NO. 101 TO 105, FIRST FLOOR, ', 'SHREE KRUSHNA COMMERCIAL COMPLEX,', 'MAUJE MANKOLI, POST-ANJUR', 1, 2, 5, 17, 421302, '8010295106', '', '', '', '', '', '', '', '', 'PJSB0000027', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(24, 033, 'MURBAD BRANCH', '400312033', '', 'CONGRESS BHAVAN BUILDING,', ' 1ST FLOOR, MURBAD, ', '', 1, 2, 5, 26, 421401, '7499054533', '', '', '', '', '', '', '', '', 'PJSB0000051', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(25, 017, 'NAUPADA BRANCH', '400312017', '', 'HEMENDRA SHOPPING CENTRE,', '1ST FLOOR, GOKHALE ROAD,', '', 1, 2, 5, 28, 400602, '022 25364707', '022 25379058', '', '', '', '', '', '', '', 'PJSB0000017', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(26, 024, 'PADAGHA BRANCH', '400312024', '', 'MASAHEB MEENATAI THAKARE COMPLEX', 'PADGHA BAZAR PETH,', '', 1, 2, 5, 29, 421101, '02522 268203', '02522 649958', '', '', '', '', '', '', '', 'PJSB0000052', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(27, 018, 'PARSIK NAGAR BRANCH', '400312018', '', 'SAHAKARMURTI GOPINATH SHIVRAM PATIL BHAVAN', 'GROUND FLOOR, PARSIK NAGAR,', '', 1, 2, 5, 10, 400605, '022 25456551', '022 25456547', '', '', '', '', '', '', '', 'PJSB0000018', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(28, 040, 'SABA (DIVA) BRANCH', '400312040', '', 'SHOP NO. 5, GROUND FLOOR & OFFICE NO.A-13,', '1ST FLOOR, CHANDRANGAN RESIDENCY,', 'SHIL DIVA ROAD', 1, 2, 5, 30, 400612, '022 25318823', '', '', '', '', '', '', '', '', 'PJSB0000040', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(29, 030, 'SHAHAPUR BRANCH', '400312030', '', 'SAI PLAZA BUILDING, 1ST FLOOR,', 'SHAHAPUR BUS STAND, (PANDIT NAKA),', 'SHAHAPUR (GOTHEGHAR', 1, 2, 5, 31, 421601, '02527 270097', '02527 270096', '', '', '', '', '', '', '', 'PJSB0000030', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(30, 037, 'SHILGAON  BRANCH', '400312037', '', 'SHIVKRUPA BUILDING, FIRST FLOOR,', 'SURVEY NO. 210/7, 8, SHILGAON, ', 'POST. PADLE,', 1, 2, 5, 32, 421204, '8655651115', '8097051192', '', '', '', '', '', '', '', 'PJSB0000037', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(31, 052, 'VARTAK NAGAR BRANCH', '400312052', '', 'SHOP NO. B, FIRST FLOOR, TAMANNA CO-OP HSG. SOCIETYâ€,', 'PLOT NO.27, LOKMANYA NAGAR-2, VARTAK NAGAR, ', '', 1, 2, 5, 33, 400606, '022 25880007', '022 25880006', '', '', '', '', '', '', '', 'PJSB0000058', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(32, 035, 'VASIND BRANCH', '400312035', '', 'SHOP NO. 7 TO 10, GROUND FLOOR', 'ROHINI APARTMENT', 'PADMASHRI TARMALE NAGAR, VASIND,', 1, 2, 5, 31, 421601, '02527 222981', '', '', '', '9272207077', '', '', '', '', 'PJSB0000035', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(33, 043, 'VITAWA BRANCH', '400312043', '', 'SHOP NO. 1, ', 'VISHRAM CO-OP. HSG. SOCIETY,', 'VITAWA', 1, 2, 5, 10, 400605, '7208101444', '7208201444', '', '', '', '', '', '', '', 'PJSB0000043', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(34, 036, 'WAGHBIL BRANCH', '400312036', '', 'SHOP NO. 1 & 2, GROUND FLOOR,', ' R-PLAZIA, NEAR SWASTIK RIGALIA, KAVESAR,', 'GHODBUNDER ROAD', 1, 2, 5, 34, 400615, '022 25975108', '022 25975109', '', '', '', '', '', '', '', 'PJSB0000036', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(35, 048, 'BHANDUP  BRANCH ', '400312048', '', 'SHOP NO. 6,7 & 8, GROUND FLOOR,', 'â€œSACHDEV COMPLEXâ€, J. M. ROAD', '', 1, 2, 2, 35, 400078, ' 022 2594707', '', '', '', '', '', '', '', '', 'PJSB0000049', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(36, 059, 'BORIVALI BRANCH', '400312059', '', 'SHOP NO.2,  GROUND FLOOR, ', ' ABHILASHA-II CO- -OP.HSG. SOCIETY LTD ', 'CTS NO.613, 613/1 TO 12, VILLAGE BORIVALI, TPS-I PUNJABI LANE,', 1, 2, 2, 36, 400092, '022 28010905', '', '', '', '', '', '', '', '', 'PJSB0000066', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(37, 065, 'CHEMBUR BRANCH', '400312065', '', 'SHOP NO. 2 & 3, GROUND FLOOR,', 'ASHISH CHAMBERS, ASHISH THEATRE', 'PLOT NO. 105/8, MARAVALI VILLAGE, MAHUL ROAD,', 1, 2, 2, 37, 400074, '022 25330031', '022 25330032', '', '', '', '', '', '', '', 'PJSB0000070', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(38, 049, 'DASHISAR BRANCH', '400312049', '', 'SHOP NO. 1 & 2, GR. FLOOR,', 'â€œHARESHWAR PARADISEâ€ KANDARPADA, NEW LINK ROAD, ', 'OPP. PRAMILA NAGAR,DAHISAR(W), TAL.BORIVLI, ', 1, 2, 2, 39, 400068, '022 28903517', '022 28903518', '', '', '', '', '', '', '', 'PJSB0000050', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(39, 064, 'GHATKOPAR  BRANCH', '400312064', '', 'SHOP NO.1, GR. FLOOR, ', 'SAPPHIRE ARCADE PREMISES CO-OP. SOCIETY LTD.,', 'PLOT NO.42, M.G. ROAD, ', 1, 2, 2, 38, 400077, '022 21020421', '', '', '', '', '', '', '', '', 'PJSB0000071', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(40, 057, 'KANJURMARG BRANCH', '400312057', '', 'APSARA CO-OP HSG. SOCIETY LTD', 'CTS NO. 1250, KANJUR VILLAGE ROAD', '', 1, 2, 2, 40, 400042, '022 25777273', '', '', '', '', '', '', '', '', 'PJSB0000064', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(41, 023, 'KALBADEVI  BRANCH', '400312023', '', 'SHOP NO. 07 ON GROUND FLOOR &', ' 7 & 7A ON FIRST FLOOR, EARTH BAUG,', '116, PRINCESS STREET', 1, 2, 2, 41, 400002, '022 22037080', '022 22057080', '', '', '', '', '', '', '', 'PJSB0000023', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(42, 066, 'MALAD EAST BRANCH', '400312066', '', 'SHOP NO. 25, GROUND FLOOR, ', 'LEVELSâ€ BUILDING NO.6, ', ' KHOT DONGRI, RANI SATI MARG', 1, 2, 2, 42, 400097, '022 28748696', '', '', '', '', '', '', '', '', 'PJSB0000079', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(43, 056, 'MALAD (WEST) BRANCH', '400312056', '', 'GROUND FLOOR, MAYFAIR HIGH END RETAIL,', ' NEW ERA TALKIES, S. V. ROAD,', '', 1, 2, 2, 43, 400064, '022 28802998', '022 28802999', '', '', '', '', '', '', '', 'PJSB0000063', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(44, 041, 'MULUND BRANCH', '400312041', '', 'SHOP NO. 5 & 6A, GROUND FLOOR, ', ' BELLEZZA OF SHANTI SADAN CHS LTD.', ' JUNCTION OF 90 FEET ROAD & GV SCHEME, ROAD NO.2,', 1, 2, 2, 44, 400081, '022 21639761', '022 21639762', '', '', '', '', '', '', '', 'PJSB0000041', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(45, 067, 'SAKINAKA BRANCH', '400312067', '', 'UNIT NO. G-3, GROUND FLOOR', 'SAGARTEK PLAZA, ', ' ANDHERI KURLA ROAD,', 1, 2, 2, 45, 400072, '022 28500234', '', '', '', '', '', '', '', '', 'PJSB0000080', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(46, 013, 'AIROLI  SECTOR - 1 BRANCH', '', '', 'SHOP NO. 1 TO 6 SANJEEVANI VRUNDAVAN', 'PLOT NO. 38', 'SECTOR-19, AIROLI', 1, 2, 19, 46, 400708, '022-27790662', '022-27796890', '', '', '', '', '', '', '', 'PJSB0000013', NULL, 0, 0, 0, '', 0, 400, 'ATM / LOCKER', '', '', '', '1800222511'),
(47, 016, 'AIROLI  SECTOR - 5 BRANCH', '400312016', '', 'SHIVSAMARTHA SAHAKARI PATHPEDI LTD., GROUND FLOOR', 'PLOT NO. 23A, SECTOR -5', 'AIROLI', 1, 2, 19, 46, 400708, '022-27794483', '022-27794976', '', '', '', '', '', '', '', 'PJSB0000016', NULL, 0, 0, 0, '', 0, 400, 'ATM / LOCKER', '', '', '', '1800222511'),
(48, 068, 'DIGHA BRANCH', '400312068', '', 'PLOT NO. GEN 30, 30/1, BUILDING A', 'VILLAGE DIGHA, THANE BELAPUR ROAD', 'DIGHA', 1, 2, 19, 46, 400708, '', '', '', '', '7777025157', ' 8879054232', '', '', '', 'PJSB0000081', NULL, 0, 0, 0, '', 0, 400, 'ATM / LOCKER', '', '', '', ''),
(49, 004, 'BELAPUR BRANCH', '400312004', '', 'YAMUNAI APARTMENT, 1ST FLOOR', 'PLOT NO. D-10C, / D-10D, SECTOR-29, AGROLI GAON', 'BELAPUR', 1, 2, 19, 47, 400614, '02227572628', ' 02227576273', '', '', '', '', '', '', '', 'PJSB0000004', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(50, 032, 'GHANSOLI  BRANCH', '400312032', '', 'SHOP NO. 7, GROUND FLOOR', 'CALISTA BUILDING, PLOT  NO. 15, SECTOR-8', 'GHANSOLI', 1, 2, 19, 48, 400701, '', '', '', '', '8451847080', '', '', '', '', 'PJSB0000032', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(51, 042, 'KARAVE BRANCH', '', '', 'C QUEEN EXCELLANCYâ€ SHOP NO. 1,2,3, SECTOR-44A', 'PLOT NO. 63,64,65 & 73,74,75 NEAR SEA WOOD RAILWAY STN', 'Karave, Nerul (west)', 1, 2, 19, 49, 400706, '02227705448', '02227705441', '', '', '', '', '', '', '', 'PJSB0000042', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(52, 005, 'KOPARKHAIRNE BRANCH', '', '', ' Plot No. 80, Sector No. 5', ' KOPARKHAIRNE', '', 1, 2, 19, 50, 400709, '02227541916', '02227546680', '', '', '', '', '', '', '', 'PJSB0000005', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(53, 015, 'KOPARKHAIRNE SECTOR - 17 BRANCH', '400312015', '', 'SECTOR NO. 17, DNYAN VIKAS SANSTHA VIDYALAYA', 'KOPARKHAIRNE VILLAGE', 'KOPARKHAIRNE', 1, 2, 19, 50, 400709, '02227546051', '02227546059', '', '', '', '', '', '', '', 'PJSB0000015', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(54, 062, 'MAHAPE BRANCH', '400312062', '', 'PLOT NO. R-320,', 'MIDC TTC Industrial Area', 'RABALE', 1, 2, 19, 48, 400701, '02227781010', '', '', '', '', '', '', '', '', 'PJSB0000073', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(55, 009, 'NERUL NAGAR BRANCH', '400312009', '', 'Plot No. 4B', 'Sector No.3', ' Nerul', 1, 2, 19, 46, 400708, '02227707654', '02227707559', '', '', '', '', '', '', '', 'PJSB0000009', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(56, 019, 'NERUL PHASE II', '400312019', '', 'PLOT NO. 28B,SECTOR NO 10,NERUL', 'OPP SAROLE BUS STOP', 'NAVI MUMBAI', 1, 2, 19, 46, 400708, '02227716864', '02227718739', '', '', '', '', '', '', '', 'PJSB0000019', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(57, 014, 'SANPADA BRANCH', '400312014', '', 'PLOT NO. 7,SECTOR 5', '', 'SANPADA', 1, 2, 19, 51, 400705, '02227754939', '02227752278', '', '', '', '', '', '', '', 'PJSB0000014', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(58, 039, 'TURBHE BRANCH', '400312039', '', 'Vimal Smruti, Ground Floor,', ' Plot No.467B, Sector-22', 'TURBHE', 1, 2, 19, 52, 400703, '02227831170', '02227831171', '', '', '', '', '', '', '', 'PJSB0000039', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(59, 055, 'VASHI BRANCH', '400312055', '', 'SHOP NO. 1 & 2 SAI UDYAN CO-OP HSG.SOC', 'Plot No.25 Near Gaondevi Mandir, Sector-14,', 'VASHI', 1, 2, 19, 52, 400703, '02227882916', '02227882917', '', '', '', '', '', '', '', 'PJSB0000061', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(60, 101, 'ALIBAUG BRANCH', '', '', 'Shop No. 7 & 8', ' Alibag Pride Co-op. Hsg,', 'ALIBAUG', 1, 2, 20, 53, 402201, '02141202158', '', '', '', '', '', '', '', '', 'PJSB0000077', NULL, 0, 0, 0, '', 0, 402, 'LOCKER/ATM', '', '', '', ''),
(61, 060, 'KALAMBOLI BRANCH', '400312060', '', 'Shop No.13-14, Ground Floor,', 'Matruchhaya Heritage CHS Ltd., Plot No.21, Sector-11', 'KALAMBOLI', 1, 2, 19, 54, 410218, '02227422420', '', '', '', '', '', '', '', '', 'PJSB0000067', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(62, 029, 'KAMOTHE BRANCH', '400312029', '', 'Shivparvati Building,', 'Plot No. 5A, Sector No. 11,', 'Kamothe', 1, 2, 19, 55, 410209, '02227430751', '', '', '', '', '', '', '', '', 'PJSB0000029', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(63, 050, 'KARJAT BRANCH', '400312050', '', 'Ground Floor, Parshvanath Tower', ' Survey No. 27A, 27B, Mahavir Peth Road,', 'Karjat', 1, 2, 20, 56, 410201, '02148223353', '', '', '', '', '', '', '', '', 'PJSB0000056', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(64, 031, 'KHARGHAR BRANCH', '400312031', '', 'Shop No. 17, 18, 19, Ground Floor,', 'Kamdhenu Commerz Commercial Complex, Sector-14, ', 'Kharghar', 1, 2, 19, 57, 410210, '', '', '', '', '7304114907', '7304114908', '', '', '', 'PJSB0000031', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(65, 101, 'KHOPOLI BRANCH', '410312101', '', 'SHOP NO. 3, GROUND FLOOR, JAGANNATH COMPLEX, SURVEY NO. 3878(P),', 'CTS NO. 3879, 3880, HOUSE NO. 64, 65, BHANVAJ VILLAGE', 'KHOPOLI', 1, 2, 20, 58, 410203, '02192268855', '02192269855', '', '', '', '', '', '', '', 'PJSB0000078', NULL, 0, 0, 0, '', 0, 410, 'LOCKER/ATM', '', '', '', ''),
(66, 501, 'NAVADE BRANCH', '400312501', '', 'Shop No. 1-2, Dev Srushti Building,', ' Navade Phata, Opp. Navade Grampanchayat,', 'Navade', 1, 2, 20, 59, 410208, '02265642333', '', '', '', '', '', '', '', '', 'PJSB0000045', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(67, 058, 'NERE BRANCH', '400312058', '', 'Shop No.3,4,5,6 & 7, Ground Floor, Sainik Apartment-II,', ' Hissa No.06, Gate No.178, Village Nere Panvel Matheran Road,', 'Nere', 1, 2, 20, 60, 410206, '02143238254', '', '', '', '', '', '', '', '', 'PJSB0000065', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(68, 069, 'NEW PANVEL BRANCH', '400312069', '', 'Shop No. 3 & 4, Ground Floor, Dhawalgiri Building,', ' Plot No.11, Sector-11, Village New Panvel', '', 1, 2, 20, 60, 410206, '02227460060', '02227460070', '', '', '', '', '', '', '', 'PJSB0000082', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(69, 028, 'PANVEL BRANCH', '400312028', '', 'GB-NEA-107, Sai Arcade,', 'Ground Floor, Opp. Panvel Bus Stand,', 'Panvel', 1, 2, 20, 60, 410206, '02227451867', '02227451867', '', '', '', '', '', '', '', 'PJSB0000028', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(70, 053, 'PEN BRANCH', '402312053', '', 'Plot No. 119, Shop No. 14, 15, 26,', 'Sharad Pawar Bhawan, Pen Khopoli Road', 'Pen', 1, 2, 20, 61, 402107, '02143255633', '', '', '', '', '', '', '', '', 'PJSB0000083', NULL, 0, 0, 0, '', 0, 402, 'LOCKER/ATM', '', '', '', ''),
(71, 061, 'TALOJA BRANCH', '', '', 'Shop No.1,2,3 Ground Floor, Shree Smaran Building,', ' Plot No.34-35, Sector-11, Panchnand', 'Taloja', 1, 2, 20, 59, 410208, '', '', '', '', '8356884573', '', '', '', '', 'PJSB0000068', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(72, 046, 'ULWE BRANCH', '400312046', '', 'Shop No.S 14, Ulwe Commercial Complex', 'Sector- 19A,', 'Ulwe', 1, 2, 20, 60, 410206, '', '', '', '', '9167921140', '', '', '', '', 'PJSB0000047', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(73, 026, 'URAN BRANCH', '400312026', '', 'House No. 72', ' 1st Floor, Kot  Naka,', 'Uran', 1, 2, 19, 62, 400702, '02227230505', '02227230507', '', '', '', '', '', '', '', 'PJSB0000026', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(74, 052, 'VADKHAL BRANCH', '402312052', '', 'Sai Ashirwad Complex,', ' 1st Floor, Vadakhal Naka,', 'Vadakhal', 1, 2, 20, 61, 402107, '02143269138', '', '', '', '', '', '', '', '', 'PJSB0000053', NULL, 0, 0, 0, '', 0, 402, 'LOCKER/ATM', '', '', '', ''),
(75, 001, 'NASHIK BRANCH', '', '', 'SHOP NO. 10, 11, SHREE TIRUMALA PLAZA', 'OPP. ATUL DAIRY, UPENDRA NAGAR, CIDCO, AMBAD', 'NASHIK', 1, 2, 21, 63, 422009, '2532380345', '', '', '', '', '', '', '', '', 'PJSB0000055', NULL, 0, 0, 0, '', 0, 422, 'LOCKER/ATM', '', '', '', ''),
(76, 003, 'PANCHAVATI NASHIK BRANCH', '', '', 'FIRST FLOOR, MOTUMAL DANDUMAL KALRO TRUST NASHIK', 'CITY SURVEY NO.5869 A3B-1B K.N. KELA ROAD,', ' PANCHAVATI KARANJA, NASHIK', 1, 2, 21, 64, 422003, '02532629000', '', '', '', '', '', '', '', '', 'PJSB0000062', NULL, 0, 0, 0, '', 0, 422, 'LOCKER/ATM', '', '', '', ''),
(77, 201, 'ICH MAIN BRANCH ADAT PETH', '416312201', '', 'Devki Building, Adat Peth,', 'Main Road, Near Bargale Hospital,', ' Ichalkaranji', 1, 2, 23, 65, 416115, '02302430334', '02302434696', '', '', '', '', '', '', '', 'PJSB0000201', NULL, 0, 0, 0, '', 0, 416, 'LOCKER/ATM', '', '', '', ''),
(78, 152, 'JAISINGPUR BRANCH', '416312152', '', 'Block No. 251/1A, Galli No. 9,', ' House No. 21000094, City Survey No. 1126/A,', 'Subhash Road, Jaisingpur, Shirol, Kolhapur', 1, 2, 22, 67, 416101, '02322227755', '', '', '', '', '', '', '', '', 'PJSB0000207', NULL, 0, 0, 0, '', 0, 416, 'LOCKER/ATM', '', '', '', ''),
(79, 001, 'KOLHAPUR BRANCH', '', '', 'SHOP NO.1 & 2, GR.FLOOR, DAMODAR HEIGHTS BUILDING', 'C.S. NO.2026/01, 8TH LANE, RAJARAMPURI, E-WARD', ' KOLHAPUR', 1, 2, 22, 68, 416008, '02312530555', '', '', '', '', '', '', '', '', 'PJSB0000203', NULL, 0, 0, 0, '', 0, 416, 'LOCKER/ATM', '', '', '', ''),
(80, 202, 'KOROCHI BRANCH', '416312202', '', 'Near Bus-stand,', ' Main Road, At-Post - Korochi', '', 1, 2, 23, 65, 416115, '02302402031', '02302402067', '', '', '', '', '', '', '', 'PJSB0000202', NULL, 0, 0, 0, '', 0, 416, 'LOCKER/ATM', '', '', '', ''),
(81, 203, 'SHAHUPUTLA BRANCH', '416312203', '', 'Plot No. 77, Ward No. 18/489, Parsik Bhavan,', 'Building No.119, The Ichalkaranji Co-op. Industrial Estate Ltd., ', 'Shahu Putala', 1, 2, 23, 66, 416118, '02302433702', '', '', '', '', '', '', '', '', 'PJSB0000208', NULL, 0, 0, 0, '', 0, 416, 'LOCKER/ATM', '', '', '', ''),
(82, 044, 'VASAI BRANCH', '400312044', '', 'Shop No. 31,32,33,34,35,', 'Yashwant Viva Township, Sector-4, Durvas Tower, Achole,', 'Vasai (E)', 1, 2, 8, 9, 401202, '02532380345', '', '', '', '', '', '', '', '', 'PJSB0000044', NULL, 0, 0, 0, '', 0, 400, 'LOCKER/ATM', '', '', '', ''),
(83, 003, 'BHAVANI PETH BRANCH', '', '', 'SHOP NO. 1 & 2, GROUND FLOOR', 'BHANDARI PALESHA MANSION, CTS NO.16', ' BHAVANI PETH', 1, 2, 24, 69, 411042, '02026386688', '02026385588', '', '', '', '', '', '', '', 'PJSB0000069', NULL, 0, 0, 0, '', 0, 411, 'LOCKER/ATM', '', '', '', ''),
(84, 006, 'CHAKAN BRANCH', '411312006', '', 'Shop No. 2,5,5A, 6 & 6A, Ground Floor, Kohinoor Centre Building No.A', ' New Gut No.1281, Plot No.1, Shivaji Chowk, Nashik Road,', 'Chakan', 1, 2, 24, 70, 410501, '02135249334', '02315249335', '', '', '', '', '', '', '', 'PJSB0000076', NULL, 0, 0, 0, '', 0, 411, 'LOCKER/ATM', '', '', '', ''),
(85, 004, 'PIMPRI BRANCH', '411312004', '', 'Shop No. 5, 6 & 7, Ground Floor,', 'Deulex Fortune Building, Survey No.2520, 2521, 2521/1 to 22', ' Pimpri', 1, 2, 24, 71, 411017, '', '', '', '', '9765876667', '', '', '', '', 'PJSB0000074', NULL, 0, 0, 0, '', 0, 411, 'LOCKER/ATM', '', '', '', ''),
(86, 001, 'PUNE BRANCH', '', '', 'SHOWROOM NO. 1, GROUND FLOOR, TREASURE PARK', 'J BUILDING, SURVEY NO. 61, SANT NAGAR, PARVATI', 'PUNE', 1, 2, 24, 72, 411009, '02024203344', '02024203019', '', '', '', '', '', '', '', 'PJSB0000054', NULL, 0, 0, 0, '', 0, 411, 'LOCKER/ATM', '', '', '', ''),
(87, 005, 'TALEGAON BRANCH', '411312005', '', 'Shop No.1,2,3, Ground Floor, Satyakamal Colony,', ' Plot No.19, S.No.61 (New) Talegaon, Dabhade', 'Talegaon', 1, 2, 24, 73, 410507, '', '', '', '', '7709111123', '', '', '', '', 'PJSB0000075', NULL, 0, 0, 0, '', 0, 411, 'LOCKER/ATM', '', '', '', ''),
(88, 151, 'SANGLI BRANCH', '416312151', '', 'SHOP NO.1,GROUND FLOOR,', 'MEHTA ARCADE,737 GANPATI PETH', 'SANGLI', 1, 2, 25, 74, 416416, '', '', '', '', '', '', '', '', '', 'PJSB0000204', NULL, 0, 0, 0, '', 0, 416, 'LOCKER/ATM', '', '', '', ''),
(89, 003, 'DHARAMPEETH NAGPUR BRANCH', '', '', 'Plot No. 222, Block No. G1,', 'Ground Floor, Corporate House No.341, Ram Nagar Road,', 'Dharampeth, Nagpur', 1, 2, 26, 75, 440010, '07122545423', '', '', '', '', '', '', '', '', 'PJSB0000402', NULL, 0, 0, 0, '', 0, 440, 'LOCKER/ATM', '', '', '', ''),
(90, 001, 'LOKMAT SQUARE NAGPUR BRANCH', '', '', 'HOUSE NO. 521, GROUND FLOOR', ' BADWAIK COMPLEX, WARDHA ROAD', 'LOKMAT SQUARE, NAGPUR', 1, 2, 26, 76, 440012, '07122422422', '', '', '', '', '', '', '', '', 'PJSB0000401', NULL, 0, 0, 0, '', 0, 440, 'LOCKER/ATM', '', '', '', ''),
(91, 001, 'BELGAVI BRANCH ', '', '', 'C.T. SURVEY NO. 1049, A2', 'F. S. Plaza, Khanapur Road', 'Belgavi', 1, 3, 27, 77, 590006, '0831242170', '', '', '', '', '', '', '', '', 'PJSB0000206', NULL, 0, 0, 0, '', 0, 590, 'LOCKER/ATM', '', '', '', ''),
(92, 302, 'NIPANI BRANCH', '591312302', '', 'House No.14 E, Ground Floor', 'Old P. B. Road, Ward No. 31', 'Nipani', 1, 3, 27, 78, 591237, '', '', '', '', '8338223544', '', '', '', '', 'PJSB0000205', NULL, 0, 0, 0, '', 0, 591, 'LOCKER/ATM', '', '', '', ''),
(93, 001, 'MARGAO BRANCH', '', '', 'Shop No. SH-20', 'Costa Tower at Margao, Salcete', 'MARGOA', 1, 4, 11, 12, 403601, '', '', '', '', '8322706944', '', '', '', '', 'PJSB0000301', NULL, 0, 0, 0, '', 0, 403, 'LOCKER/ATM', '', '', '', ''),
(94, 003, 'MAPUSA BRANCH', '', '', 'Shop No.S-10, S-11, S-12, Ground Floor, Kavlekar Tower Co-op. Hsg. Society Ltd', 'Chalta No.66, Xim Khorlim, Ansabhat, PT Sheet No.131, Tal. Bardez', 'Mapusa', 1, 4, 10, 11, 403507, '', '', '', '', '8322255330', '', '', '', '', 'PJSB0000302', NULL, 0, 0, 0, '', 0, 422, 'LOCKER/ATM', '', '', '', ''),
(95, 011, 'A.P.M.C. BRANCH', '', '', 'CENTRAL FACILITY BUILDING II, A.P.M.C. MARKET', 'SECTOR-19', ' VASHI', 1, 2, 19, 79, -400705, '022-27654035', '', '', '', '', '', '', '', '', 'PJSB0000011', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', ''),
(96, 002, 'HEAD OFFICE', '', '', 'SAHAKARMURTI GOPINATH SHIVRAM PATIL BHAVAN', 'PARSIK NAGAR', '', 1, 2, 29, 80, 400605, '02225456500', '', '', '', '', '', '', '', '', 'PJSB0000002', NULL, 0, 0, 0, '', 0, 400, '', '', '', '', '1800222511');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `tb_citymaster`
--

INSERT INTO `tb_citymaster` (`city_id`, `city_code`, `city_place`, `city_name_al`, `country_id`, `state_id`, `is_delete`) VALUES
(001, 'SUR001', 'SURAT', 'CHU', 1, 1, 0),
(002, 'MUM001', 'MUMBAI', 'KAN', 1, 2, 0),
(003, 'BAN001', 'BANGALORE', 'BAN', 1, 3, 0),
(004, 'HUB001', 'HUBLI', 'HUB', 1, 3, 0),
(005, 'THA001', 'THANE', 'THA', 1, 2, 0),
(006, 'BHA001', 'BHAYANDER (W)', 'BHA', 1, 2, 0),
(007, 'NAL001', 'NALASOPARA (E)', 'NAL', 1, 2, 0),
(008, 'VAS001', 'VASAI (W)', 'VAS', 1, 2, 0),
(009, 'PAN001', 'PAN', 'PAN', 1, 2, 0),
(010, 'MAP001', 'GOA', 'MAP', 1, 4, 0),
(011, 'MAR001', 'SOUTH GOA', 'MAR', 1, 4, 0),
(012, 'THA002', 'THANE (W)', 'THA', 1, 2, 0),
(013, 'BAD001', 'BADLAPUR', 'BAD', 1, 2, 0),
(014, 'THA003', 'THANE.', 'THA', 1, 2, 1),
(015, 'BHA002', 'BHAYANDAR', 'BHA', 1, 2, 0),
(016, 'DOM001', 'DOMBIVLI', 'DOM', 1, 2, 0),
(017, 'BHI001', 'BHIWANDI', 'BHI', 1, 2, 0),
(018, 'MUM001', 'MUMBAI SUBURBAN', 'MUM', 1, 2, 0),
(019, 'NAV001', 'NAVI MUMBAI', 'NAV', 1, 2, 0),
(020, 'RAI001', 'RAIGAD', 'RAI', 1, 2, 0),
(021, 'NAS001', 'NASHIK', 'NAS', 1, 2, 0),
(022, 'KOL001', 'KOLHAPUR', 'KOL', 1, 2, 0),
(023, 'ICH001', 'ICHALKARANJI', 'ICH', 1, 2, 0),
(024, 'PUN001', 'PUNE', 'PUN', 1, 2, 0),
(025, 'SAN001', 'SANGLI', 'SAN', 1, 2, 0),
(026, 'NAG001', 'NAGPUR', 'NAG', 1, 2, 0),
(027, 'BEL001', 'BELGAVI', 'BEL', 1, 3, 0),
(028, 'VAS002', 'VASHI', 'VAS', 1, 2, 0),
(029, 'KAL001', 'KALWA-THANE', 'KAL', 1, 2, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

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
(26, 2079, 192023, '2015-06-02'),
(27, 0, 1, '2016-01-13'),
(28, 0, 25, '2016-01-18'),
(29, 0, 192023, '2016-01-18'),
(30, 0, 0, '2016-01-18'),
(31, 0, 202, '2016-01-19'),
(32, 0, 250, '2016-01-19'),
(33, 0, 192023, '2016-01-19'),
(34, 0, 0, '2016-01-19'),
(35, 0, 1, '2016-01-19'),
(36, 0, 7113, '2016-01-29'),
(37, 0, 0, '2022-09-20'),
(38, 0, 0, '2022-09-20'),
(39, 0, 0, '2022-09-20'),
(40, 0, 0, '2022-09-20'),
(41, 0, 0, '2022-09-20'),
(42, 0, 2147483647, '2022-09-20'),
(43, 0, 9, '2022-09-20'),
(44, 0, 8787, '2022-09-20'),
(45, 0, 2147483647, '2022-09-21'),
(46, 0, 2, '2022-09-21'),
(47, 0, 21232, '2022-09-21'),
(48, 0, 748, '2023-09-22');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `tb_cps_chequeseries`
--

INSERT INTO `tb_cps_chequeseries` (`series_id`, `series_transationcode`, `series_branchcode`, `serise_branchcode_branch`, `series_from`, `series_to`, `series_lastno`, `serise_Bank`) VALUES
(1, 12, 21, 10, 000001, 999999, 031251, 1),
(4, 12, 30, 37, 000001, 999999, 002851, 1),
(5, 12, 25, 17, 000001, 999999, 019651, 1),
(6, 12, 52, 5, 000001, 999999, 039101, 1),
(7, 12, 72, 46, 000001, 999999, 002201, 1),
(8, 12, 51, 42, 000001, 999999, 003001, 1),
(9, 12, 56, 19, 000001, 999999, 029951, 1),
(10, 12, 33, 43, 000001, 999999, 001501, 1),
(11, 12, 47, 16, 000001, 999999, 066701, 1),
(12, 12, 10, 38, 000001, 999999, 002751, 1),
(13, 12, 9, 8, 000001, 999999, 047751, 1),
(14, 12, 53, 15, 000001, 999999, 011601, 1),
(15, 12, 27, 18, 000001, 999999, 024801, 1),
(16, 12, 95, 11, 000001, 999999, 022151, 1),
(17, 12, 13, 3, 000001, 999999, 110951, 1),
(18, 12, 64, 31, 000001, 999999, 008951, 1),
(19, 12, 24, 33, 000001, 999999, 006951, 1),
(20, 12, 55, 9, 000001, 999999, 038901, 1),
(21, 12, 50, 32, 000001, 999999, 008251, 1),
(22, 12, 57, 14, 000001, 999999, 032501, 1),
(23, 12, 12, 22, 000001, 999999, 009551, 1),
(24, 12, 46, 13, 000001, 999999, 037301, 1),
(25, 12, 23, 27, 000001, 999999, 008301, 1),
(26, 12, 1, 7, 000001, 999999, 032751, 1),
(27, 12, 36, 59, 000001, 999999, 000401, 1),
(28, 12, 83, 3, 000001, 999999, 000551, 1),
(29, 12, 96, 2, 000001, 999999, 063901, 1),
(30, 12, 94, 3, 000001, 999999, 000451, 1);

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
(30, 'ADMINISTRATOR', '2013-02-10 23:58:24');

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
  `cps_act_name` varchar(55) NOT NULL,
  `cps_no_of_books` int(3) NOT NULL,
  `cps_dly_bearer_order` varchar(1) NOT NULL,
  `cps_book_size` int(3) NOT NULL,
  `cps_tr_code` int(2) unsigned zerofill NOT NULL,
  `cps_atpar` varchar(10) DEFAULT NULL,
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
  `cps_bsr_code` varchar(6) DEFAULT NULL,
  `cps_pr_code` varchar(4) DEFAULT NULL,
  `cps_reprint_approved` int(1) NOT NULL DEFAULT '0',
  `cps_short_name` varchar(40) DEFAULT NULL,
  `cps_product_code` varchar(5) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tb_cps_reprintque`
--


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
  `desktop_image` varchar(100) NOT NULL,
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
  `license_users_leaves_value` int(20) NOT NULL,
  `toner_leaves_capacity` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_cps_settings`
--

INSERT INTO `tb_cps_settings` (`inputfolderpath`, `archivefolderpath`, `inputfileformat`, `inputfiledelimiter`, `outputfolderpath`, `outputfileformat`, `outputfiledelimiter`, `typeofprinter`, `printermodel`, `chk_taken_from`, `chk_no_from`, `chk_no_to`, `nooffailedpasswordattempt`, `password_expiry`, `homescreen_text`, `poweredby`, `banklogo`, `desktop_image`, `chq_Image`, `country`, `help_employeeid`, `help_helplineno1`, `help_emailid`, `autolockminutes`, `help_contactperson`, `help_helplineno2`, `license_type`, `license_install_date`, `license_period`, `license_end_date`, `license_no_of_users`, `license_cheque_leaves`, `license_users_leaves`, `license_users_leaves_value`, `toner_leaves_capacity`) VALUES
('', 'uploads/', 'Excel', '', '', 'Excel', '', '', 0, 1, 000000, 000000, 9, 365, 'Gopinath Patil Parsik Janata Sahakari Bank Ltd', 'DevHarsh Infotech Pvt Ltd', 'gpparsiklogo.jpg', 'GPPARSIKLOGO11.jpg', '', '', '', '', '', 360, '', '', '', '0000-00-00', 0, '0000-00-00', 0, 0, 0, 0, 1000);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tb_cps_transactioncodes`
--

INSERT INTO `tb_cps_transactioncodes` (`transactioncode_id`, `transactioncode`, `transactioncodedescription`, `transactionstatus`) VALUES
(3, 12, 'PAY ORDER', 0);

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
  `cps_atpar` varchar(1) DEFAULT NULL,
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
  `cps_state` varchar(30) DEFAULT NULL,
  `cps_country` varchar(30) DEFAULT NULL,
  `cps_emailid` varchar(50) DEFAULT NULL,
  `cps_act_pin` int(30) NOT NULL,
  `cps_act_telephone_res` varchar(15) NOT NULL,
  `cps_act_telephone_off` varchar(15) NOT NULL,
  `cps_act_mobile` varchar(15) NOT NULL,
  `cps_ifsc_code` varchar(12) DEFAULT NULL,
  `cps_chq_no_from` bigint(6) unsigned zerofill NOT NULL,
  `cps_chq_no_to` bigint(6) unsigned zerofill NOT NULL,
  `cps_micr_account_no` int(6) unsigned zerofill NOT NULL,
  `cps_date` date NOT NULL,
  `cps_process_user_id` int(6) NOT NULL,
  `cps_isprint` int(1) NOT NULL DEFAULT '0',
  `cps_bsr_code` varchar(6) DEFAULT NULL,
  `cps_pr_code` varchar(4) DEFAULT NULL,
  `cps_short_name` varchar(40) DEFAULT NULL,
  `cps_product_code` varchar(5) DEFAULT NULL,
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
  `user_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`adminid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `tb_printadmin`
--

INSERT INTO `tb_printadmin` (`username`, `password`, `lastlogintime`, `adminid`, `group_id`, `incorrect_attempt`, `password_status`, `user_type`, `userid`, `create_date`, `is_temp_password`, `user_status`) VALUES
('superadmin', '17c4520f6cfd1ab53d8745e84681eb49', '2023-11-01 15:31:15', 30, 0, 0, 1, 2, 'superadmin', '2023-09-22', 1, 1),
('admin', '21232f297a57a5a743894a0e4a801fc3', '2023-11-01 15:32:34', 20, 0, 0, 1, 0, 'admin', '2023-09-25', 1, 1),
('reprint', '1babe098befd805689339582881da1d8', '2023-11-01 15:35:13', 21, 0, 0, 1, 1, 'reprint', '2023-09-21', 1, 1);

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
  `cps_act_name` varchar(55) NOT NULL,
  `cps_no_of_books` int(2) unsigned zerofill NOT NULL,
  `cps_dly_bearer_order` varchar(1) NOT NULL,
  `cps_book_size` int(3) unsigned zerofill NOT NULL,
  `cps_tr_code` int(2) unsigned zerofill NOT NULL,
  `cps_atpar` varchar(1) DEFAULT NULL,
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
  `cps_state` varchar(30) DEFAULT NULL,
  `cps_country` varchar(30) DEFAULT NULL,
  `cps_emailid` varchar(50) DEFAULT NULL,
  `cps_act_pin` int(30) NOT NULL,
  `cps_act_telephone_res` varchar(15) NOT NULL,
  `cps_act_telephone_off` varchar(15) NOT NULL,
  `cps_act_mobile` varchar(15) NOT NULL,
  `cps_ifsc_code` varchar(12) DEFAULT NULL,
  `cps_chq_no_from` bigint(6) unsigned zerofill NOT NULL,
  `cps_chq_no_to` bigint(6) unsigned zerofill NOT NULL,
  `cps_micr_account_no` int(6) unsigned zerofill NOT NULL,
  `cps_date` date NOT NULL,
  `cps_process_user_id` int(6) NOT NULL,
  `cps_bsr_code` varchar(6) DEFAULT NULL,
  `cps_pr_code` varchar(4) DEFAULT NULL,
  `cps_short_name` varchar(40) DEFAULT NULL,
  `cps_product_code` varchar(5) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
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
  `cps_act_name` varchar(55) NOT NULL,
  `cps_no_of_books` int(2) unsigned zerofill NOT NULL,
  `cps_dly_bearer_order` varchar(1) NOT NULL,
  `cps_book_size` int(3) unsigned zerofill NOT NULL,
  `cps_tr_code` int(2) unsigned zerofill NOT NULL,
  `cps_atpar` varchar(1) DEFAULT NULL,
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
  `cps_state` varchar(30) DEFAULT NULL,
  `cps_country` varchar(30) DEFAULT NULL,
  `cps_emailid` varchar(50) DEFAULT NULL,
  `cps_act_pin` int(30) NOT NULL,
  `cps_act_telephone_res` varchar(15) NOT NULL,
  `cps_act_telephone_off` varchar(15) NOT NULL,
  `cps_act_mobile` varchar(15) NOT NULL,
  `cps_ifsc_code` varchar(12) DEFAULT NULL,
  `cps_chq_no_from` bigint(6) unsigned zerofill NOT NULL,
  `cps_chq_no_to` bigint(6) unsigned zerofill NOT NULL,
  `cps_micr_account_no` int(6) unsigned zerofill NOT NULL,
  `cps_date` date NOT NULL,
  `cps_process_user_id` int(6) NOT NULL,
  `cps_is_reprint` int(1) NOT NULL DEFAULT '0',
  `cps_pr_code` varchar(4) DEFAULT NULL,
  `cps_bsr_code` varchar(6) DEFAULT NULL,
  `cps_short_name` varchar(40) DEFAULT NULL,
  `cps_product_code` varchar(5) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `tb_print_req_collection`
--

INSERT INTO `tb_print_req_collection` (`id`, `cps_unique_req`, `cps_micr_code`, `cps_branchmicr_code`, `cps_account_no`, `cps_act_name`, `cps_no_of_books`, `cps_dly_bearer_order`, `cps_book_size`, `cps_tr_code`, `cps_atpar`, `cps_act_jointname1`, `cps_act_jointname2`, `cps_auth_sign1`, `cps_auth_sign2`, `cps_auth_sign3`, `cps_act_address1`, `cps_act_address2`, `cps_act_address3`, `cps_act_address4`, `cps_act_address5`, `cps_act_city`, `cps_state`, `cps_country`, `cps_emailid`, `cps_act_pin`, `cps_act_telephone_res`, `cps_act_telephone_off`, `cps_act_mobile`, `cps_ifsc_code`, `cps_chq_no_from`, `cps_chq_no_to`, `cps_micr_account_no`, `cps_date`, `cps_process_user_id`, `cps_is_reprint`, `cps_pr_code`, `cps_bsr_code`, `cps_short_name`, `cps_product_code`, `branch_id`) VALUES
(1, 00000001, 400312007, 007, '', 'GP PARSIK SAHKARI BANK LTD.', 01, '0', 010, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 400031, 400040, 000000, '2022-09-17', 1, 0, '', '', '', '', NULL),
(2, 00000002, 400312007, 007, '', 'GP PARSIK SAHKARI BANK LTD.', 01, '0', 010, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 400041, 400050, 000000, '2022-09-17', 1, 0, '', '', '', '', NULL),
(3, 00000003, 400312007, 007, '', 'GP PARSIK SAHKARI BANK LTD.', 01, '0', 010, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 400051, 400060, 000000, '2022-09-17', 1, 0, '', '', '', '', NULL),
(4, 00000004, 400312007, 007, '', 'GP PARSIK SAHKARI BANK LTD.', 01, '0', 010, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 400061, 400070, 000000, '2022-09-17', 1, 0, '', '', '', '', NULL),
(5, 00000005, 400312007, 007, '', 'GP PARSIK SAHKARI BANK LTD.', 01, '0', 010, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 400071, 400080, 000000, '2022-09-17', 1, 0, '', '', '', '', NULL),
(6, 00000006, 400312007, 007, '', 'GP PARSIK SAHKARI BANK LTD.', 01, '0', 003, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 400081, 400083, 000000, '2022-09-19', 1, 0, '', '', '', '', NULL),
(7, 00000007, 400312007, 007, '', 'GP PARSIK SAHKARI BANK LTD.', 01, '0', 003, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 400084, 400086, 000000, '2022-09-19', 1, 0, '', '', '', '', NULL),
(8, 00000008, 400312007, 007, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 032251, 032500, 000000, '2022-09-21', 22, 0, '', '', '', '', NULL),
(9, 00000009, 400312013, 013, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 036801, 037050, 000000, '2022-10-01', 20, 0, '', '', '', '', NULL),
(10, 00000010, 400312040, 040, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 001551, 001800, 000000, '2022-10-06', 20, 0, '', '', '', '', NULL),
(11, 00000011, 400312009, 009, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 038401, 038650, 000000, '2022-10-29', 20, 0, '', '', '', '', NULL),
(12, 00000012, 400312003, 003, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 110401, 110650, 000000, '2022-11-23', 20, 0, '', '', '', '', NULL),
(13, 00000013, 400312055, 055, '', 'GP PARSIK SAHKARI BANK LTD.', 06, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 001601, 001900, 000000, '2022-11-23', 20, 0, '', '', '', '', NULL),
(14, 00000014, 400312004, 004, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 042201, 042450, 000000, '2022-12-07', 20, 0, '', '', '', '', NULL),
(15, 00000015, 400312034, 034, '', 'GP PARSIK SAHKARI BANK LTD.', 03, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 003201, 003350, 000000, '2022-12-12', 20, 0, '', '', '', '', NULL),
(16, 00000016, 400312014, 014, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 032001, 032250, 000000, '2022-12-12', 20, 0, '', '', '', '', NULL),
(17, 00000017, 400312062, 062, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 000501, 000750, 000000, '2022-12-21', 20, 0, '', '', '', '', NULL),
(18, 00000018, 400312012, 012, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 045901, 046150, 000000, '2023-01-11', 20, 0, '', '', '', '', NULL),
(19, 00000019, 400312006, 006, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 049451, 049700, 000000, '2023-01-23', 20, 0, '', '', '', '', NULL),
(20, 00000020, 400312041, 041, '', 'GP PARSIK SAHKARI BANK LTD.', 02, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 001001, 001100, 000000, '2023-02-03', 20, 0, '', '', '', '', NULL),
(21, 00000021, 400312010, 010, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 031001, 031250, 000000, '2023-02-22', 20, 0, '', '', '', '', NULL),
(22, 00000022, 400312037, 037, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 002601, 002850, 000000, '2023-04-10', 20, 0, '', '', '', '', NULL),
(23, 00000023, 400312017, 017, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 019401, 019650, 000000, '2023-04-10', 20, 0, '', '', '', '', NULL),
(24, 00000024, 400312005, 005, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 038851, 039100, 000000, '2023-04-19', 20, 0, '', '', '', '', NULL),
(25, 00000025, 400312046, 046, '', 'GP PARSIK SAHKARI BANK LTD.', 04, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 002001, 002200, 000000, '2023-04-19', 20, 0, '', '', '', '', NULL),
(26, 00000026, 400312042, 042, '', 'GP PARSIK SAHKARI BANK LTD.', 06, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 002701, 003000, 000000, '2023-04-19', 20, 0, '', '', '', '', NULL),
(27, 00000027, 400312019, 019, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 029701, 029950, 000000, '2023-04-28', 20, 0, '', '', '', '', NULL),
(28, 00000028, 400312043, 043, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 001251, 001500, 000000, '2023-04-28', 20, 0, '', '', '', '', NULL),
(29, 00000029, 400312016, 016, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 066451, 066700, 000000, '2023-05-08', 20, 0, '', '', '', '', NULL),
(30, 00000030, 400312038, 038, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 002501, 002750, 000000, '2023-05-09', 20, 0, '', '', '', '', NULL),
(31, 00000031, 400312008, 008, '', 'GP PARSIK SAHKARI BANK LTD.', 06, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 047451, 047750, 000000, '2023-05-12', 20, 0, '', '', '', '', NULL),
(32, 00000032, 400312015, 015, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 011351, 011600, 000000, '2023-05-17', 20, 0, '', '', '', '', NULL),
(33, 00000033, 400312018, 018, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 024551, 024800, 000000, '2023-05-23', 20, 0, '', '', '', '', NULL),
(34, 00000034, 400312011, 011, '', 'GP PARSIK SAHKARI BANK LTD.', 01, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 021901, 021950, 000000, '2023-06-03', 20, 0, '', '', '', '', NULL),
(35, 00000035, 400312011, 011, '', 'GP PARSIK SAHKARI BANK LTD.', 04, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 021951, 022150, 000000, '2023-06-03', 20, 0, '', '', '', '', NULL),
(36, 00000036, 400312003, 003, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 110651, 110900, 000000, '2023-06-06', 20, 0, '', '', '', '', NULL),
(37, 00000037, 400312031, 031, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 008701, 008950, 000000, '2023-06-21', 20, 0, '', '', '', '', NULL),
(38, 00000038, 400312033, 033, '', 'GP PARSIK SAHKARI BANK LTD.', 02, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 006851, 006950, 000000, '2023-07-04', 20, 0, '', '', '', '', NULL),
(39, 00000039, 400312009, 009, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 038651, 038900, 000000, '2023-07-10', 20, 0, '', '', '', '', NULL),
(40, 00000040, 400312032, 032, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 008001, 008250, 000000, '2023-07-12', 20, 0, '', '', '', '', NULL),
(41, 00000041, 400312014, 014, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 032251, 032500, 000000, '2023-07-25', 20, 0, '', '', '', '', NULL),
(42, 00000042, 400312022, 022, '', 'GP PARSIK SAHKARI BANK LTD.', 03, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 009401, 009550, 000000, '2023-08-09', 20, 0, '', '', '', '', NULL),
(43, 00000043, 400312013, 013, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 037051, 037300, 000000, '2023-08-29', 20, 0, '', '', '', '', NULL),
(44, 00000044, 400312027, 027, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 008051, 008300, 000000, '2023-08-29', 20, 0, '', '', '', '', NULL),
(45, 00000045, 400312007, 007, '', 'GP PARSIK SAHKARI BANK LTD.', 05, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 032501, 032750, 000000, '2023-09-04', 20, 0, '', '', '', '', NULL),
(46, 00000046, 400312059, 059, '', 'GP PARSIK SAHKARI BANK LTD.', 03, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 000251, 000400, 000000, '2023-09-18', 20, 0, '', '', '', '', NULL),
(47, 00000047, 411312003, 003, '', 'GP PARSIK SAHKARI BANK LTD.', 02, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 000451, 000550, 000000, '2023-09-25', 20, 0, '', '', '', '', NULL),
(48, 00000048, 400312002, 002, '', 'GP PARSIK SAHKARI BANK LTD.', 02, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 063801, 063900, 000000, '2023-09-27', 20, 0, '', '', '', '', NULL),
(49, 00000049, 400312003, 003, '', 'GP PARSIK SAHKARI BANK LTD.', 01, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 110901, 110950, 000000, '2023-10-05', 30, 0, '', '', '', '', NULL),
(50, 00000050, 403312003, 003, '', 'GP PARSIK SAHKARI BANK LTD.', 01, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 000001, 000050, 000000, '2023-10-05', 30, 0, '', '', '', '', NULL),
(51, 00000051, 403312003, 003, '', 'GP PARSIK SAHKARI BANK LTD.', 01, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 000051, 000100, 000000, '2023-10-05', 30, 0, '', '', '', '', NULL),
(52, 00000052, 403312003, 003, '', 'GP PARSIK SAHKARI BANK LTD.', 01, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 000101, 000150, 000000, '2023-10-05', 30, 0, '', '', '', '', 94),
(53, 00000053, 403312003, 003, '', 'GP PARSIK SAHKARI BANK LTD.', 01, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 000151, 000200, 000000, '2023-10-05', 30, 0, '', '', '', '', 94),
(54, 00000054, 403312003, 003, '', 'GP PARSIK SAHKARI BANK LTD.', 01, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 000201, 000250, 000000, '2023-10-05', 30, 0, '', '', '', '', 94),
(55, 00000055, 422312003, 003, '', 'GP PARSIK SAHKARI BANK LTD.', 01, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 000251, 000300, 000000, '2023-10-05', 30, 0, '', '', '', '', 94),
(56, 00000056, 422312003, 003, '', 'GP PARSIK SAHKARI BANK LTD.', 01, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 000301, 000350, 000000, '2023-10-05', 30, 0, '', '', '', '', 94),
(57, 00000057, 422312003, 003, '', 'GP PARSIK SAHKARI BANK LTD.', 01, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 000351, 000400, 000000, '2023-10-05', 30, 0, '', '', '', '', 94),
(58, 00000058, 422312003, 003, '', 'GP PARSIK SAHKARI BANK LTD.', 01, '0', 050, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', 000401, 000450, 000000, '2023-10-06', 30, 0, '', '', '', '', 94);

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
  `cps_act_name` varchar(55) NOT NULL,
  `cps_no_of_books` int(2) unsigned zerofill NOT NULL,
  `cps_dly_bearer_order` varchar(1) NOT NULL,
  `cps_book_size` int(3) unsigned zerofill NOT NULL,
  `cps_tr_code` int(2) unsigned zerofill NOT NULL,
  `cps_atpar` varchar(10) NOT NULL,
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
  `cps_short_name` varchar(40) DEFAULT NULL,
  `cps_product_code` varchar(5) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tb_statemaster`
--

INSERT INTO `tb_statemaster` (`state_id`, `state_name`, `country_id`, `state_code`, `state_name_al`, `is_delete`) VALUES
(1, 'GUJRAT', 1, 'GUJ001', 'GUJ', 0),
(2, 'MAHARASHTRA', 1, 'MAH001', 'MAH', 0),
(3, 'KARNATAKA', 1, 'KAR001', 'KAR', 0),
(4, 'GOA', 1, 'GOA001', 'GOA', 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=81 ;

--
-- Dumping data for table `tb_suburbmaster`
--

INSERT INTO `tb_suburbmaster` (`suburb_id`, `suburb_name`, `suburb_postal_code`, `suburb_code`, `suburb_name_al`, `country_id`, `state_id`, `city_id`, `is_delete`) VALUES
(1, 'NEW SURAT', '800056', 'NEW001', 'LAL', 1, 1, 1, 1),
(2, 'DADAR', '400028', 'DAD001', 'CHA', 1, 2, 2, 0),
(3, 'INFANTRY ROAD', '560001', 'INF001', 'INF', 1, 3, 3, 1),
(4, 'GEDDALAHALLI', '560073', 'GED001', 'GED', 1, 3, 3, 1),
(5, 'BEGUR', '560068', 'BEG001', 'BEG', 1, 3, 3, 1),
(6, 'NARIMAN POINT', '400021', 'NAR001', 'NAR', 1, 2, 2, 0),
(7, 'BHAYANDER (W)', '401101', 'BHA001', 'BHA', 1, 2, 6, 0),
(8, 'NALASOPARA (E)', '401203', 'NAL001', 'NAL', 1, 2, 7, 0),
(9, 'TAL-VASAI', '401202', 'TAL001', 'TAL', 1, 2, 8, 0),
(10, 'KALWA', '400605', 'KAL001', 'KAL', 1, 2, 5, 0),
(11, 'GOA', '403507', 'GOA001', 'GOA', 1, 4, 10, 0),
(12, 'SOUTH GOA', '403601', 'SOU001', 'SOU', 1, 4, 11, 0),
(13, 'KHARKARALI', '400601', 'KHA001', 'KHA', 1, 2, 12, 0),
(14, 'AMBERNATH', '421501', 'AMB001', 'AMB', 1, 2, 5, 0),
(15, 'BADLAPUR', '421503', 'BAD001', 'BAD', 1, 2, 13, 0),
(16, 'BHAYANDAR', '401107', 'BHA002', 'BHA', 1, 2, 15, 0),
(17, 'BHIWANDI', '421302', 'BHI001', 'BHI', 1, 2, 5, 0),
(18, 'DOMBIVALI', '421201', 'DOM001', 'DOM', 1, 2, 5, 0),
(19, 'KALYAN', '421306', 'KAL002', 'KAL', 1, 2, 5, 0),
(20, 'KALYAN.', '421301', 'KAL003', 'KAL', 1, 2, 5, 0),
(21, 'KASARWADAVALI', '400615', 'KAS001', 'KAS', 1, 2, 5, 0),
(22, 'KATAI-NILJE', '421204', 'KAT001', 'KAT', 1, 2, 16, 0),
(23, 'BHIWANDI.', '421311', 'BHI002', 'BHI', 1, 2, 5, 0),
(24, ' LOUISWADI', '400604', ' LO001', ' LO', 1, 2, 5, 0),
(25, 'MAJIWADI', '400607', 'MAJ001', 'MAJ', 1, 2, 5, 0),
(26, 'MURBAD', '421401', 'MUR001', 'MUR', 1, 2, 5, 0),
(27, 'NARPOLI', '421302.', 'NAR002', 'NAR', 1, 2, 17, 0),
(28, 'NAUPADA', '400602', 'NAU001', 'NAU', 1, 2, 5, 0),
(29, 'BHIWANDI,', '421101', 'BHI003', 'BHI', 1, 2, 5, 0),
(30, 'SABA (DIVA)', '400612', 'SAB001', 'SAB', 1, 2, 5, 0),
(31, 'SHAHAPUR', ' 421601', 'SHA001', 'SHA', 1, 2, 5, 0),
(32, ' SHILGAON', '421204.', ' SH001', ' SH', 1, 2, 5, 0),
(33, 'VARTAK NAGAR', '400606', 'VAR001', 'VAR', 1, 2, 5, 0),
(34, 'WAGHBIL', '400615.', 'WAG001', 'WAG', 1, 2, 5, 0),
(35, 'BHANDUP (W)', '400078', 'BHA003', 'BHA', 1, 2, 2, 0),
(36, 'BORIVALI (W)', '400092', 'BOR001', 'BOR', 1, 2, 2, 0),
(37, 'CHEMBUR (EAST)', ' 400074', 'CHE001', 'CHE', 1, 2, 2, 0),
(38, 'GHATKOPAR(E )', '400077', 'GHA001', 'GHA', 1, 2, 2, 0),
(39, 'BORIVLI', ' 400068', 'BOR002', 'BOR', 1, 2, 2, 0),
(40, 'KANJURMARG (E)', '400042', 'KAN001', 'KAN', 1, 2, 2, 0),
(41, 'KALBADEVI', '400002', 'KAL004', 'KAL', 1, 2, 2, 0),
(42, 'MALAD (E)', '400097', 'MAL001', 'MAL', 1, 2, 2, 0),
(43, 'MALAD (WEST)', '400064', 'MAL002', 'MAL', 1, 2, 2, 0),
(44, 'MULUND (E)', '400081', 'MUL001', 'MUL', 1, 2, 2, 0),
(45, 'SAKINAKA', '400072', 'SAK001', 'SAK', 1, 2, 2, 0),
(46, 'NERUL', '400708', 'NER001', 'NAV', 1, 2, 19, 0),
(47, 'BELAPUR', '400614', 'BEL001', 'BEL', 1, 2, 19, 0),
(48, 'GHANSOLI', '400701', 'GHA002', 'GHA', 1, 2, 19, 0),
(49, 'KARAVE', '400706', 'KAR001', 'KAR', 1, 2, 19, 0),
(50, 'KOPARKHAIRNE', '400709', 'KOP001', 'KOP', 1, 2, 19, 0),
(51, 'SANPADA', '400705', 'SAN001', 'SAN', 1, 2, 19, 0),
(52, 'TURBHE', '400703', 'TUR001', 'TUR', 1, 2, 19, 0),
(53, 'ALIBAUG', '402201', 'ALI001', 'ALI', 1, 2, 20, 0),
(54, 'KALAMBOLI', '410218', 'KAL005', 'KAL', 1, 2, 19, 0),
(55, 'KAMOTHE', '410209', 'KAM001', 'KAM', 1, 2, 19, 0),
(56, 'KARJAT', '410201', 'KAR002', 'KAR', 1, 2, 20, 0),
(57, 'KHARGHAR', '410210', 'KHA002', 'KHA', 1, 2, 19, 0),
(58, 'KHOPOLI', '410203', 'KHO001', 'KHO', 1, 2, 20, 0),
(59, 'NAVADE', '410208', 'NAV002', 'NAV', 1, 2, 20, 0),
(60, 'PANVEL', '410206', 'PAN001', 'NER', 1, 2, 20, 0),
(61, 'PEN', '402107', 'PEN001', 'PEN', 1, 2, 20, 0),
(62, 'URAN', '400702', 'URA001', 'URA', 1, 2, 19, 0),
(63, 'AMBAD', '422009', 'AMB002', 'AMB', 1, 2, 21, 0),
(64, 'PANCHVATI', '422003', 'PAN001', 'PAN', 1, 2, 21, 0),
(65, 'ICHALKARANJI.', '416115', 'ICH001', 'ICH', 1, 2, 23, 0),
(66, 'SHAHUPUTLA', '416118', 'SHA002', 'SHA', 1, 2, 23, 0),
(67, 'JAISINGPUR', '416101', 'JAI001', 'JAI', 1, 2, 22, 0),
(68, 'KOLHAPUR', '416008', 'KOL001', 'KOL', 1, 2, 22, 0),
(69, 'BHAVANI PETH', '411042', 'BHA004', 'BHA', 1, 2, 24, 0),
(70, 'CHAKAN', '410501', 'CHA002', 'CHA', 1, 2, 24, 0),
(71, 'PIMPRI', '411017', 'PIM001', 'PIM', 1, 2, 24, 0),
(72, 'PARVATI', '411009', 'PAR001', 'PAR', 1, 2, 24, 0),
(73, 'TALEGAON DABHADE', '410507', 'TAL002', 'TAL', 1, 2, 24, 0),
(74, 'SANGLI', '416416', 'SAN002', 'SAN', 1, 2, 25, 0),
(75, 'DHARAMPEETH', '440010', 'DHA001', 'DHA', 1, 2, 26, 0),
(76, 'LOKMAT SQUARE', '440012', 'LOK001', 'LOK', 1, 2, 26, 0),
(77, 'BELGAVI.', '590006', 'BEL002', 'BEL', 1, 3, 27, 0),
(78, 'NIPANI', '591237', 'NIP001', 'NIP', 1, 3, 27, 0),
(79, 'NAVI MUMBAI', '-400705', 'NAV003', 'NAV', 1, 2, 19, 0),
(80, 'KALWA-THANE', '400605', 'KAL006', 'KAL', 1, 2, 29, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_uploadingdata`
--

CREATE TABLE IF NOT EXISTS `tb_uploadingdata` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `cps_unique_req` bigint(8) unsigned zerofill NOT NULL,
  `cps_micr_code` int(3) NOT NULL,
  `cps_branchmicr_code` varchar(3) NOT NULL,
  `cps_account_no` varchar(15) NOT NULL,
  `cps_act_name` varchar(45) NOT NULL,
  `cps_no_of_books` varchar(2) NOT NULL,
  `cps_dly_bearer_order` varchar(1) NOT NULL,
  `cps_book_size` varchar(3) NOT NULL,
  `cps_tr_code` varchar(2) NOT NULL,
  `cps_atpar` varchar(1) DEFAULT NULL,
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
  `cps_state` varchar(30) DEFAULT NULL,
  `cps_country` varchar(30) DEFAULT NULL,
  `cps_emailid` varchar(50) DEFAULT NULL,
  `cps_act_pin` int(30) NOT NULL,
  `cps_act_telephone_res` varchar(15) NOT NULL,
  `cps_act_telephone_off` varchar(15) NOT NULL,
  `cps_act_mobile` varchar(15) NOT NULL,
  `cps_ifsc_code` varchar(12) DEFAULT NULL,
  `cps_chq_no_from` varchar(6) NOT NULL,
  `cps_chq_no_to` varchar(6) NOT NULL,
  `cps_micr_account_no` varchar(6) NOT NULL,
  `cps_date` date NOT NULL,
  `cps_process_user_id` varchar(6) NOT NULL,
  `cps_bsr_code` varchar(6) DEFAULT NULL,
  `cps_pr_code` varchar(4) DEFAULT NULL,
  `cps_short_name` varchar(40) DEFAULT NULL,
  `cps_issue_date` varchar(255) DEFAULT NULL,
  `cps_product_code` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tb_uploadingdata`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
