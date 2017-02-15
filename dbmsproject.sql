-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2016 at 05:04 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbmsproject`
--
CREATE DATABASE IF NOT EXISTS `dbmsproject` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dbmsproject`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `register_p`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `register_p`(IN `name` VARCHAR(30), IN `pwd` VARCHAR(30), IN `gender` VARCHAR(1), IN `contact` VARCHAR(11), IN `email` VARCHAR(50), IN `fb_ID` VARCHAR(50), IN `pay_method` VARCHAR(8))
    NO SQL
begin
DECLARE EXIT HANDLER FOR SQLEXCEPTION ROLLBACK;
DECLARE EXIT HANDLER FOR SQLWARNING ROLLBACK;
START TRANSACTION;
SET autocommit=0;
  insert into participants (pname,pwd,gender,contact,email,fbid,pay_method) values(name,pwd,gender,contact,email,fb_ID,pay_method);
 commit;
 end$$

DROP PROCEDURE IF EXISTS `update_p`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_p`(IN `name` VARCHAR(30), IN `pwd` VARCHAR(30), IN `gender` VARCHAR(1), IN `contact` VARCHAR(11), IN `email` VARCHAR(30), IN `fb_ID` VARCHAR(30), IN `pay_method` VARCHAR(8))
    NO SQL
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION ROLLBACK;
DECLARE EXIT HANDLER FOR SQLWARNING ROLLBACK;
START TRANSACTION;
SET autocommit=0;
  update participants set pname=name,pwd=pwd,gender=gender,contact=contact,pay_method=pay_method where email=email;
  COMMIT;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
`eid` int(11) NOT NULL,
  `ename` varchar(30) DEFAULT NULL,
  `edate` date DEFAULT NULL,
  `etime` time DEFAULT NULL,
  `evenue` varchar(50) DEFAULT NULL,
  `edesc` varchar(1000) DEFAULT NULL,
  `max_reg` int(11) DEFAULT NULL,
  `tot_reg` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eid`, `ename`, `edate`, `etime`, `evenue`, `edesc`, `max_reg`, `tot_reg`) VALUES
(37, 'Euphony  A Band Competition', '2017-01-14', '11:00:00', 'Cricket Ground, IIT Bhubaneswar', 'If you think your band is the next big thing ,then come and be a part of Euphony. Its a chance for emerging bands to captivate the crowd and make them head bang away symphonies. \r\n\r\n', 5, NULL),
(45, 'Shaedz', '2017-01-15', '00:00:00', 'School of Electrical Science', ' Nothing portrays feelings better than your own creation. Add life to your pencil strokes , frame your artwork and enjoy the day with ALMA FIESTA. Fill the sheet with the best shades of pencil you can and feel  the festivity of Alma Fiesta.', 4, NULL),
(38, 'Track the Track  A Solo singin', '2017-01-14', '00:00:00', 'Community Ground, IIT Bhubaneswar.', 'Come and be a part of the battle of voices. The solo singing event of Alma Fiesta gives you the opportunity to captivate a crowd of music lovers with your voice, in a bid to be crowned the champion of singing.', 1, NULL),
(39, 'Antakshari', '2017-01-15', '00:00:00', 'School of Electrical Science', 'You think no one can beat you and your squad at crooning bollywood hits? Then Alma Fiesta has the perfect event for you! Compete with other teams and show your expertise in the age old game of antakshari .', 4, NULL),
(40, 'Unplugged  Instrumental Compet', '2017-01-15', '00:00:00', 'School of Electrical Science ', 'Like to play music without all the modern beats and heavy metal sounds? Unplugged gives you a chance to do just that. It is a solo instrumental competition, where none of the modern mumbojumbo is allowed. Its back to the basics with this one, so come and show that you can do it old school.', 1, NULL),
(41, 'Duetto (Duet singing completio', '2017-01-14', '00:00:00', 'Community Ground', 'Duets have always enthralled us and now it your chance display your skills to the world. Duetto gives a platform budding vocalists  to showcase their talents along with a like minded other. ', 2, NULL),
(42, 'Face Off ( A Stage Play Compet', '2017-01-15', '00:00:00', 'Community Hall', ' ', 15, NULL),
(43, 'NCircled (A Street Play Compet', '2017-01-15', '00:00:00', 'Shopping Complex', ' ', 15, NULL),
(44, 'Blind Strokes', '2017-01-15', '00:00:00', 'School of Electrical Science', 'Test your presence of mind , your coordination and your communication with others. Explain a drawing to a person who can not see from his drawing how well you communicate and how well  the other person coordinates. A team event with a blindfolded artists and his able guide.', 2, NULL),
(46, 'RipOut (Solo Dance Competition', '2017-01-14', '00:00:00', 'Community Hall', ' ', 1, NULL),
(47, 'Rab Ne Bana Di Jodi (Duo Dance', '2017-01-14', '00:00:00', 'Community Hall', ' ', 2, NULL),
(48, 'Topsy  Turvy (Group Dance Comp', '2017-01-14', '00:00:00', 'Community Hall', ' ', 15, NULL),
(49, 'Cyber Crusade', '2017-01-14', '00:00:00', 'School of Electrical Science', 'Web D please decide rules and maximum Participants for this event.', 0, NULL),
(50, 'Leela  An Inaugural Night', '2017-01-13', '19:00:00', 'Cricket Ground', '(Source Wikipedia...If u want any changes in description let me inform)  Leela is the Indian Classical MusicDance show. It celebrates the rich cultural heritage of our nation. It is an event known for its aesthetic event.', 0, NULL),
(51, 'IITBBSR Model United Nation', '2017-01-13', '00:00:00', 'IIT Bhubaneswar', ' For details information and registration, visit http:iitbbsrmun.almafiesta.comindex.html.', 0, NULL),
(52, 'Salsa Workshop', '2017-01-14', '17:00:00', 'Community Hall', ' ', 2, NULL),
(53, 'Photography Workshop', '2017-01-14', '00:00:00', 'School of Electrical Science', ' ', 3, NULL),
(54, 'BACHPAN KA RANGMANCH (CHILDREN', '2017-01-13', '11:00:00', 'COMMUNITY HALL', ' ', 0, NULL),
(58, 'Dance and Groove', '2017-01-13', '03:00:00', 'IIT BBS', ' Show your talent here !', 20, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

DROP TABLE IF EXISTS `instructors`;
CREATE TABLE IF NOT EXISTS `instructors` (
  `instructor` varchar(30) NOT NULL,
  `wname` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`instructor`, `wname`) VALUES
('Kanisque', 'Animation Workshop'),
('zeus alpha', 'android workshop'),
('kanisque', 'android workshop'),
('Avdhesh', 'Animation Workshop'),
('Kanisque', 'Speaking and Presentation Work'),
('Avdhesh', 'Speaking and Presentation Work'),
('ins1', 'W1'),
('ins', 'W1'),
('ins3', 'W1');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

DROP TABLE IF EXISTS `participants`;
CREATE TABLE IF NOT EXISTS `participants` (
`pid` int(11) NOT NULL,
  `pname` varchar(30) DEFAULT NULL,
  `pwd` varchar(100) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `contact` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fbid` varchar(50) DEFAULT NULL,
  `pay_method` varchar(8) DEFAULT NULL,
  `pay_status` varchar(1) DEFAULT 'n',
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`pid`, `pname`, `pwd`, `gender`, `contact`, `email`, `fbid`, `pay_method`, `pay_status`, `time_stamp`) VALUES
(1, 'kanisque', 'kanisque', 'm', 2147483647, 'avdheshkp95@gmail.com', NULL, 'Online', 'n', '2016-11-15 03:57:31'),
(2, 'kanisque', 'kanisque', 'm', 2147483647, 'kanisquemeena@gmail.com', '', 'Online', 'n', '2016-11-15 03:56:15'),
(3, 'Basant', 'basant123', 'm', 2147483647, 'basant@gmail.com', '', 'Online', 'n', '2016-11-15 03:59:20'),
(4, 'Shailesh', 'shailesh', 'm', 2147483647, 'shailesh@gmail.com', '', 'Online', 'n', '2016-11-15 04:01:39'),
(5, 'jagpreet', 'jagpree', 'm', 1233455678, 'jagpreet@gmai.com', '', 'Online', 'n', '2016-11-15 04:23:05'),
(6, 'test123', 'test123', 'm', 1233455678, 'test@gmail.com', '', 'Online', 'n', '2016-11-15 04:24:12'),
(7, 'avd', 'aaaaaaa', 'm', 2147483647, 'ap23@iitbbs.ac', '', 'Online', 'n', '2016-11-15 05:49:32');

-- --------------------------------------------------------

--
-- Table structure for table `parti_events`
--

DROP TABLE IF EXISTS `parti_events`;
CREATE TABLE IF NOT EXISTS `parti_events` (
  `pid` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `r_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Triggers `parti_events`
--
DROP TRIGGER IF EXISTS `trig`;
DELIMITER //
CREATE TRIGGER `trig` BEFORE INSERT ON `parti_events`
 FOR EACH ROW BEGIN
declare msg varchar(30);	
update events set tot_reg=nvl(tot_reg,0)+1 where eid=NEW.eid;
if(NEW.r_time > '2017-01-14 18:00:00') then
	set msg = 'too late';
	signal sqlstate '45000' set message_text = msg;
end if;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

DROP TABLE IF EXISTS `rules`;
CREATE TABLE IF NOT EXISTS `rules` (
  `ename` varchar(30) NOT NULL,
`no` int(11) NOT NULL,
  `rule` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=97 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`ename`, `no`, `rule`) VALUES
('Shaedz', 95, 'The decision of the judge shall be final ^&amp^;amp^; binding on all participants.'),
('Shaedz', 94, 'Theme for sketch will be informed one hour prior to competition.'),
('Euphony  A Band Competition', 49, ' Each participant is allotted 15 minutes of performance time.'),
('Euphony  A Band Competition', 50, 'Participants are not required to play an original composition.'),
('Euphony  A Band Competition', 51, 'Rounds: prelims, semi finals and finals. '),
('Track the Track  A Solo singin', 52, 'Round 1 : Single performance (Knockout Round)'),
('Track the Track  A Solo singin', 53, 'Round 2 : Two performances (1. Participant''s choice, 2. Judges choice)'),
('Track the Track  A Solo singin', 54, 'Every contestant must bring hisher own karaoke tracks in CDPen drive. '),
('Track the Track  A Solo singin', 55, 'Participant must bring at least 5 tracks (2 for the participants choice rounds and three for the jud'),
('Track the Track  A Solo singin', 56, 'Languages of performance have been restricted to Hindi and English only.'),
('Antakshari', 57, 'Only Hindi movie songs are allowed in any round.  '),
('Antakshari', 58, 'No song can be repeated in the same round.'),
('Antakshari', 59, 'The decisions of the judges will be final.'),
('Unplugged  Instrumental Compet', 60, ' Each participant can only take part in 1 instrument'),
('Unplugged  Instrumental Compet', 61, 'Participants are not allowed to use laptops or mixers or any other digital modifiers.'),
('Unplugged  Instrumental Compet', 62, 'Electric guitar players are allowed to use amps only'),
('Duetto (Duet singing completio', 63, 'The decision of the organizers regarding the final lineup would be final'),
('Duetto (Duet singing completio', 64, 'Time limit should be strictly followed.'),
('Duetto (Duet singing completio', 65, 'Decision of the judges will be binding and final.'),
('Face Off ( A Stage Play Compet', 66, 'The maximum time permitted for each play is 15 minutes.'),
('Face Off ( A Stage Play Compet', 67, 'No logistics will be provided from the Organisation. The costumes and logistics must be self arrange'),
('Face Off ( A Stage Play Compet', 68, 'Groups performance is judged based on the Script, Stage presence, expressions and various other aspe'),
('NCircled (A Street Play Compet', 69, 'The maximum time permitted for each play is 15 minutes.'),
('NCircled (A Street Play Compet', 70, 'Logistics should be self arranged.'),
('NCircled (A Street Play Compet', 71, 'Each group will be judged mainly on performance,script and various other aspects.'),
('Blind Strokes', 72, 'One participant per team will be blindfolded.'),
('Blind Strokes', 73, 'The blindfolded participant will have to draw a given picture based on the verbal instructions of hi'),
('Blind Strokes', 74, 'Judges decision will be final &amp; binding on all participants'),
('Shaedz', 93, 'Each participant will be given maximum of 90 minutes to complete their sketch.'),
('RipOut (Solo Dance Competition', 78, 'The individual will be given 5 minutes to perform'),
('RipOut (Solo Dance Competition', 79, 'The individual must bring the audio track in a pendrive or hard disk in .mp3 format'),
('RipOut (Solo Dance Competition', 80, 'Submit audio track at the time of confirmation of registration at the event venue.'),
('Rab Ne Bana Di Jodi (Duo Dance', 81, 'The duo couple will be given 26 minutes to perform.'),
('Rab Ne Bana Di Jodi (Duo Dance', 82, 'The audio track must be submitted in a pendrive or hard disk in .mp3 format.'),
('Topsy  Turvy (Group Dance Comp', 83, 'Time limit: 58 minutes'),
('Topsy  Turvy (Group Dance Comp', 84, 'All dance forms are allowed.'),
('Topsy  Turvy (Group Dance Comp', 85, 'Use of water, fire and glass is prohibited.'),
('Topsy  Turvy (Group Dance Comp', 86, 'Audio track to be brought in .mp3 format, in a pen drive or a hard disk and should be submitted by g'),
('e1', 87, 'aaaaaaaaaaa'),
('e1', 88, 'bbbbbbb'),
('w1', 89, 'aaaaaa'),
('w1', 90, 'aaaaaaaaaaaa'),
('aaaa', 91, 'aaaa'),
('aaaa', 92, 'aaaaaaaaaaaa'),
('Shaedz', 96, 'rule4');

-- --------------------------------------------------------

--
-- Table structure for table `winner`
--

DROP TABLE IF EXISTS `winner`;
CREATE TABLE IF NOT EXISTS `winner` (
  `eid` int(11) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

DROP TABLE IF EXISTS `workshops`;
CREATE TABLE IF NOT EXISTS `workshops` (
`wid` int(11) NOT NULL,
  `wname` varchar(30) DEFAULT NULL,
  `wdate` date NOT NULL,
  `wtime` time NOT NULL,
  `wvenue` varchar(50) NOT NULL,
  `wdesc` varchar(1000) DEFAULT NULL,
  `max_reg` int(11) DEFAULT NULL,
  `tot_reg` int(11) DEFAULT NULL,
  `fees` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workshops`
--

INSERT INTO `workshops` (`wid`, `wname`, `wdate`, `wtime`, `wvenue`, `wdesc`, `max_reg`, `tot_reg`, `fees`) VALUES
(8, 'Speaking and Presentation Work', '0000-00-00', '03:00:00', 'SES', 'Learn and Improve your speaking and presentation skills. ', 50, NULL, NULL),
(4, 'android workshop lll', '2017-02-01', '14:01:00', 'SES', '   sad saf asdf sdf asdf .as d.asd .asd android wksp ', 32, NULL, NULL),
(7, 'Animation Workshop', '0000-00-00', '01:00:00', 'SES', 'Animation workshop will consist of Flash and 2D vector animation. ', 50, NULL, NULL),
(6, 'Photoshop Workshop', '2017-01-12', '13:00:00', 'SES', 'aaaaaaaaaaaaas d\r^\nas d\r^\na sdas .as.a asdasd asd asd. ', 30, NULL, NULL),
(9, 'W1', '2016-11-12', '10:00:00', 'v1', ' dddddd', 15, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `workshop_reg`
--

DROP TABLE IF EXISTS `workshop_reg`;
CREATE TABLE IF NOT EXISTS `workshop_reg` (
  `pid` int(11) NOT NULL,
  `wid` int(11) NOT NULL,
  `wpay_status` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `workshop_reg`
--

INSERT INTO `workshop_reg` (`pid`, `wid`, `wpay_status`) VALUES
(1, 2, ''),
(1, 3, ''),
(1, 4, ''),
(1, 2, ''),
(1, 3, ''),
(1, 6, ''),
(1, 3, '');

--
-- Triggers `workshop_reg`
--
DROP TRIGGER IF EXISTS `wksp_reg`;
DELIMITER //
CREATE TRIGGER `wksp_reg` BEFORE INSERT ON `workshop_reg`
 FOR EACH ROW BEGIN
declare msg varchar(30);	
declare t integer;
declare m integer;
update workshop_reg set tot_reg=nvl(tot_reg,0)+1 where wid=NEW.wid;
select tot_reg into t from workshop_reg;
select max_reg into m from workshop_reg;
if(t>m) then
	set msg = 'too many';
	signal sqlstate '45000' set message_text = msg;
end if;
END
//
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
 ADD PRIMARY KEY (`eid`), ADD UNIQUE KEY `ename` (`ename`), ADD UNIQUE KEY `ename_2` (`ename`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
 ADD KEY `wid` (`wname`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
 ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `parti_events`
--
ALTER TABLE `parti_events`
 ADD PRIMARY KEY (`pid`,`eid`), ADD KEY `eid` (`eid`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
 ADD PRIMARY KEY (`no`), ADD KEY `eid` (`ename`);

--
-- Indexes for table `winner`
--
ALTER TABLE `winner`
 ADD KEY `pid` (`pid`), ADD KEY `eid` (`eid`);

--
-- Indexes for table `workshops`
--
ALTER TABLE `workshops`
 ADD PRIMARY KEY (`wid`);

--
-- Indexes for table `workshop_reg`
--
ALTER TABLE `workshop_reg`
 ADD KEY `pid` (`pid`), ADD KEY `wid` (`wid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
MODIFY `no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `workshops`
--
ALTER TABLE `workshops`
MODIFY `wid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
