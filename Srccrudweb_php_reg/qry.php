-- Database: `31_reguser`
-- --------------------------------------------------------
-- Table structure for table `reguser`
--

DROP TABLE IF EXISTS `reguser`;
CREATE TABLE IF NOT EXISTS `reguser` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Ucode` int(11) NOT NULL,
  `Ufirstname` varchar(50) NOT NULL,
  `Ulastname` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reguser`
--

INSERT INTO `reguser` (`ID`, `Ucode`, `Ufirstname`, `Ulastname`) VALUES
(1, 1, 'deepaa', 'Cs'),
(2, 12, 'ria', 'dadas'),
(3, 13, 'hansi', 'ss');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;