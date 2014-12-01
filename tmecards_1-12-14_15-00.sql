/*
Navicat MySQL Data Transfer

Source Server         : dbs
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : tmecards

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2014-12-01 15:04:03
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of card
-- ----------------------------
INSERT INTO `card` VALUES ('1', 'placeholderImg_1.png', 'Placeholder 1');
INSERT INTO `card` VALUES ('2', 'placeholderImg_2.png', 'Placeholder 2');

-- ----------------------------
-- Table structure for `personaltext`
-- ----------------------------
DROP TABLE IF EXISTS `personaltext`;
CREATE TABLE `personaltext` (
  `personaltext_id` int(11) NOT NULL,
  `personaltext_message` longtext NOT NULL,
  PRIMARY KEY (`personaltext_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of personaltext
-- ----------------------------
