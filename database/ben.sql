/*
MySQL Data Transfer
Source Host: localhost
Source Database: ben
Target Host: localhost
Target Database: ben
Date: 2020/1/6 9:49:07
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for face
-- ----------------------------
DROP TABLE IF EXISTS `face`;
CREATE TABLE `face` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `pubtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for link
-- ----------------------------
DROP TABLE IF EXISTS `link`;
CREATE TABLE `link` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `addr` varchar(64) NOT NULL DEFAULT '',
  `weight` int(11) NOT NULL DEFAULT '0',
  `pubtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for log
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `pubtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `read_num` int(11) NOT NULL DEFAULT '0',
  `comment_num` int(11) NOT NULL DEFAULT '0',
  `title` varchar(64) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `cid` int(11) NOT NULL DEFAULT '0',
  `photo` varchar(100) NOT NULL DEFAULT '',
  `tags` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for log_comment
-- ----------------------------
DROP TABLE IF EXISTS `log_comment`;
CREATE TABLE `log_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(64) NOT NULL DEFAULT '',
  `email` varchar(64) NOT NULL DEFAULT '',
  `addr` varchar(64) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `pubtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for phone
-- ----------------------------
DROP TABLE IF EXISTS `phone`;
CREATE TABLE `phone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `pubtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for photo
-- ----------------------------
DROP TABLE IF EXISTS `photo`;
CREATE TABLE `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `title` varchar(32) NOT NULL DEFAULT '',
  `tags` varchar(128) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `city_want_num` int(11) NOT NULL DEFAULT '0',
  `pubtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_out` tinyint(4) NOT NULL DEFAULT '0',
  `addr` varchar(255) NOT NULL DEFAULT '',
  `comment_num` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for photo_comment
-- ----------------------------
DROP TABLE IF EXISTS `photo_comment`;
CREATE TABLE `photo_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  `pubtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for photo_tag
-- ----------------------------
DROP TABLE IF EXISTS `photo_tag`;
CREATE TABLE `photo_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '0',
  `tag` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for tags
-- ----------------------------
DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(100) NOT NULL DEFAULT '',
  `hit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(32) NOT NULL DEFAULT '',
  `pass` varchar(40) NOT NULL DEFAULT '',
  `name` varchar(16) NOT NULL DEFAULT '',
  `birth` date NOT NULL DEFAULT '0000-00-00',
  `gender` tinyint(4) NOT NULL DEFAULT '2',
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `register_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `face` varchar(64) NOT NULL DEFAULT '',
  `sign` varchar(64) NOT NULL DEFAULT '',
  `qqmsn` varchar(64) NOT NULL DEFAULT '',
  `other_email` varchar(32) NOT NULL DEFAULT '',
  `tel` varchar(32) NOT NULL DEFAULT '',
  `addr` varchar(64) NOT NULL DEFAULT '',
  `privacy` varchar(10) NOT NULL DEFAULT '',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `category` VALUES ('1', '个人简介');
INSERT INTO `category` VALUES ('2', '代码分析');
INSERT INTO `category` VALUES ('3', '算法分析');
INSERT INTO `category` VALUES ('4', '疾病谱');
INSERT INTO `category` VALUES ('5', '股票分析');

INSERT INTO `link` VALUES ('1', '小ben成长手册', 'http://www.benen005.cn/', '0', '2016-05-12 09:09:09');

INSERT INTO `log` VALUES ('1', '1', '2016-05-12 09:09:09', '0', '0', '个人简介', '个人简介', '1', '', '');

INSERT INTO `log` VALUES ('2', '1', '2016-05-12 09:09:09', '0', '0', 'bbs', 'bbs', '21', '', '');

INSERT INTO `log_comment` VALUES ('1', '1', 'ben', 'ben@163.com', '', '测试', '2016-05-12 09:09:09', '0');
INSERT INTO `tags` VALUES ('1', '西湖', '8');
INSERT INTO `tags` VALUES ('2', '旅游', '1');
INSERT INTO `tags` VALUES ('3', '山', '103');
INSERT INTO `tags` VALUES ('4', '黄英', '229');
INSERT INTO `tags` VALUES ('5', '刘惜君', '84');
INSERT INTO `user` VALUES ('1', '', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'benen005', '0000-00-00', '2', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '0');
