-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 2019 年 7 月 11 日 13:13
-- サーバのバージョン： 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gsf_d03_db26`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `php02_table`
--

CREATE TABLE `php02_table` (
  `id` int(12) NOT NULL,
  `task` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `deadline` date NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `indate` datetime NOT NULL,
  `image` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `php02_table`
--

INSERT INTO `php02_table` (`id`, `task`, `deadline`, `comment`, `indate`, `image`) VALUES
(5, 'PSP02test', '2019-01-05', 'コメントいれるよ', '2019-06-08 15:39:12', NULL),
(6, 'PSP02test', '2019-01-06', 'コメントいれるよ', '2019-06-08 15:39:12', NULL),
(7, 'PSP02test', '2019-01-07', 'コメントいれるよ', '2019-06-08 15:39:12', NULL),
(8, 'PSP02test', '2019-01-08', 'コメントいれるよ', '2019-06-08 15:40:39', NULL),
(9, 'PSP02test', '2019-01-09', 'コメ９', '2019-06-08 15:40:39', NULL),
(10, 'PSP02test', '2019-01-10', 'コメ１０', '2019-06-08 15:40:39', NULL),
(11, 'test', '2019-06-03', 'testcomment', '2019-06-08 16:42:35', NULL),
(12, 'test', '2019-06-03', 'testcomment', '2019-06-08 16:42:46', NULL),
(13, 'testtesttest', '2019-06-07', 'testtest', '2019-06-08 16:43:11', NULL),
(14, 'test', '2019-06-07', 'testtest', '2019-06-15 14:48:49', NULL),
(15, 'test', '2019-06-30', 'testtesttest', '2019-06-15 14:49:05', NULL),
(16, 'test', '2019-07-05', 'test', '2019-07-06 16:18:03', 'upload/20190706071803d41d8cd98f00b204e9800998ecf8427e.png'),
(17, 'testtest', '2019-07-13', 'testtest', '2019-07-06 16:18:33', 'upload/20190706071833d41d8cd98f00b204e9800998ecf8427e.png'),
(18, 'aaaaaaaa', '2019-07-06', 'testsetsetset', '2019-07-06 17:43:25', NULL),
(19, 'testtest', '2019-07-07', 'test', '2019-07-06 17:47:51', NULL),
(20, 'aa', '2019-07-01', 'a', '2019-07-06 17:50:18', NULL),
(21, 'a', '2019-07-06', 'a', '2019-07-06 17:52:05', NULL),
(22, 'teste', '2019-07-01', 'testtest', '2019-07-06 17:53:03', NULL),
(23, 'aa', '2019-07-06', 'aaa', '2019-07-06 17:54:23', NULL),
(24, 'aa', '2019-07-06', 'aa', '2019-07-06 17:57:41', NULL),
(25, 'あああ', '2019-07-01', 'ああああ', '2019-07-06 17:58:52', NULL),
(26, 'aaaa', '2019-07-06', 'aaaaa', '2019-07-06 17:59:15', NULL),
(27, 'aaaaa', '2019-07-05', 'aaaaa', '2019-07-06 18:00:48', NULL),
(28, 'aaaaa', '2019-07-05', 'aaaaa', '2019-07-06 18:01:15', NULL),
(29, 'test', '2019-07-01', 'testets', '2019-07-06 18:14:05', NULL),
(30, 'aaaaa', '2019-07-04', 'aaaaaa', '2019-07-11 20:27:05', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `t_chatjournal`
--

CREATE TABLE `t_chatjournal` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `message` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inputdatetime` datetime NOT NULL,
  `stampimagepath` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chatroomid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `t_chatjournal`
--

INSERT INTO `t_chatjournal` (`id`, `userid`, `message`, `inputdatetime`, `stampimagepath`, `chatroomid`) VALUES
(1, 1, 'test', '2019-01-01 10:10:10', NULL, 1),
(2, 3, 'test3', '2019-01-02 10:19:19', NULL, 1),
(3, 1, 'aaaaa', '2018-01-01 10:20:20', NULL, 1),
(4, 3, 'bbbbb', '2018-02-01 10:20:10', NULL, 1),
(5, 3, 'aaaa', '2019-07-11 20:43:35', NULL, 1),
(6, 3, 'aaaa', '2019-07-11 20:45:09', NULL, 1),
(7, 3, 'bbbbbbbbbbaaaa', '2019-07-11 20:46:30', NULL, 1),
(8, 3, 'aaaaaaaaa', '2019-07-11 20:47:29', NULL, 1),
(9, 3, 'aaaa', '2019-07-11 20:49:33', NULL, 1),
(10, 3, 'aaa', '2019-07-11 21:01:19', NULL, 1),
(11, 3, 'hhhhhh', '2019-07-11 21:05:43', NULL, 1),
(12, 3, 'nnnnn', '2019-07-11 21:05:55', NULL, 1),
(13, 3, 'aaaa', '2019-07-11 21:09:15', NULL, 1),
(14, 3, 'hhhhhhh', '2019-07-11 21:12:35', NULL, 1),
(15, 3, 'hhhh', '2019-07-11 21:14:22', NULL, 1),
(16, 3, 'jjjjjjj', '2019-07-11 21:15:02', NULL, 1),
(17, 3, 'test', '2019-07-11 21:35:46', NULL, 1),
(18, 3, 'aaaa', '2019-07-11 21:49:30', NULL, 1),
(19, 3, 'aaa', '2019-07-11 21:50:45', NULL, 1),
(20, 3, 'aaaa', '2019-07-11 21:52:08', NULL, 1),
(21, 3, 'aaaa', '2019-07-11 22:02:27', NULL, 1),
(22, 3, 'bbbbbb', '2019-07-11 22:02:34', NULL, 1),
(23, 3, 'こんにちわ。', '2019-07-11 22:03:45', NULL, 2),
(24, 3, 'はじめまして', '2019-07-11 22:04:05', NULL, 2),
(25, 1, 'あんただれ？？？？', '2019-07-11 22:04:21', NULL, 2),
(26, 1, '死ね', '2019-07-11 22:04:35', NULL, 2),
(27, 1, 'っっｈ', '2019-07-11 22:04:49', NULL, 2),
(28, 3, 'aaaa', '2019-07-11 22:07:31', NULL, 2),
(29, 3, 'てｓつぇつぇ', '2019-07-11 22:10:45', NULL, 2),
(30, 3, 'ああああああ', '2019-07-11 22:11:11', NULL, 2),
(31, 3, 'あああああああ', '2019-07-11 22:11:26', NULL, 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `t_chatroom`
--

CREATE TABLE `t_chatroom` (
  `id` int(11) NOT NULL,
  `roomname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `roomsummary` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `roomimage` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `t_chatroom`
--

INSERT INTO `t_chatroom` (`id`, `roomname`, `roomsummary`, `roomimage`) VALUES
(1, 'roomname', 'roomsummary', NULL),
(2, 'ChatRoom2', 'ChatRoom2', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `t_divisionname`
--

CREATE TABLE `t_divisionname` (
  `divisioncode` int(3) NOT NULL,
  `namecode` int(3) NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `t_divisionname`
--

INSERT INTO `t_divisionname` (`divisioncode`, `namecode`, `name`) VALUES
(1, 1, 'PS４'),
(1, 2, 'NINTENDO SWITCH'),
(2, 1, 'めっちゃおもろい'),
(2, 2, 'まぁまぁおもろい'),
(2, 3, '普通'),
(2, 4, 'くそげー'),
(2, 5, '超くそげー'),
(3, 1, '全クリ'),
(3, 2, '未クリ');

-- --------------------------------------------------------

--
-- テーブルの構造 `t_mygamelist`
--

CREATE TABLE `t_mygamelist` (
  `id` int(12) NOT NULL,
  `gamedivision` int(1) NOT NULL,
  `gamename` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `omoshirodivision` int(1) NOT NULL,
  `allcleardivision` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `t_mygamelist`
--

INSERT INTO `t_mygamelist` (`id`, `gamedivision`, `gamename`, `omoshirodivision`, `allcleardivision`) VALUES
(1, 1, 'グランドセフトオート５', 2, 2),
(7, 2, 'ゼルダの伝説　ブレスオブザ・ワイルドaa', 1, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `user_table`
--

CREATE TABLE `user_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `lid` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `lpw` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `user_table`
--

INSERT INTO `user_table` (`id`, `name`, `lid`, `lpw`, `kanri_flg`, `life_flg`) VALUES
(1, 'test', 'test', 'test', 0, 0),
(3, 'test3', 'test3', 'test3', 1, 0),
(4, 'test4', 'test4', 'test4', 1, 0),
(5, 'test4', 'test4', 'test4', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `php02_table`
--
ALTER TABLE `php02_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_chatjournal`
--
ALTER TABLE `t_chatjournal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_chatroom`
--
ALTER TABLE `t_chatroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_divisionname`
--
ALTER TABLE `t_divisionname`
  ADD PRIMARY KEY (`divisioncode`,`namecode`);

--
-- Indexes for table `t_mygamelist`
--
ALTER TABLE `t_mygamelist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `php02_table`
--
ALTER TABLE `php02_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `t_chatjournal`
--
ALTER TABLE `t_chatjournal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `t_chatroom`
--
ALTER TABLE `t_chatroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_mygamelist`
--
ALTER TABLE `t_mygamelist`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
