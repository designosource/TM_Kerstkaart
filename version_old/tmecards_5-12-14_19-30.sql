/*
Navicat MySQL Data Transfer

Source Server         : dbs
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : tmecards

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2014-12-05 19:33:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `card`
-- ----------------------------
DROP TABLE IF EXISTS `card`;
CREATE TABLE `card` (
  `card_id` int(11) NOT NULL AUTO_INCREMENT,
  `card_url` text NOT NULL,
  `card_title` text NOT NULL,
  PRIMARY KEY (`card_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of card
-- ----------------------------
INSERT INTO `card` VALUES ('1', 'placeholderImg_1.png', 'Placeholder 1');
INSERT INTO `card` VALUES ('2', 'placeholderImg_2.png', 'Placeholder 2');

-- ----------------------------
-- Table structure for `receiver`
-- ----------------------------
DROP TABLE IF EXISTS `receiver`;
CREATE TABLE `receiver` (
  `receiver_id` int(11) NOT NULL AUTO_INCREMENT,
  `receiver_firstname` varchar(255) NOT NULL,
  `receiver_lastname` varchar(255) NOT NULL,
  `receiver_email` varchar(255) NOT NULL,
  `sender_id` int(11) NOT NULL,
  PRIMARY KEY (`receiver_id`,`sender_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of receiver
-- ----------------------------

-- ----------------------------
-- Table structure for `sender`
-- ----------------------------
DROP TABLE IF EXISTS `sender`;
CREATE TABLE `sender` (
  `sender_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_firstname` varchar(255) NOT NULL,
  `sender_lastname` varchar(255) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `sender_message` varchar(500) NOT NULL,
  PRIMARY KEY (`sender_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sender
-- ----------------------------
