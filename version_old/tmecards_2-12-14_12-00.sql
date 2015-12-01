/*
Navicat MySQL Data Transfer

Source Server         : dbs
Source Server Version : 50611
Source Host           : localhost:3306
Source Database       : tmecards

Target Server Type    : MYSQL
Target Server Version : 50611
File Encoding         : 65001

Date: 2014-12-02 11:49:22
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
  PRIMARY KEY (`receiver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of receiver
-- ----------------------------
INSERT INTO `receiver` VALUES ('21', 'Marc', 'Doe', 'john.doe@domain.com');
INSERT INTO `receiver` VALUES ('22', 'Foo', 'Bar', 'foo.bar@domain.com');
INSERT INTO `receiver` VALUES ('23', 'John', 'Doe', 'john.doe@domain.com');
INSERT INTO `receiver` VALUES ('24', 'Foo', 'Bar', 'foo.bar@domain.com');
INSERT INTO `receiver` VALUES ('25', 'John', 'Doe', 'john.doe@domain.com');
INSERT INTO `receiver` VALUES ('26', 'Foo', 'Bar', 'foo.bar@domain.com');
INSERT INTO `receiver` VALUES ('27', 'John', 'Doe', 'john.doe@domain.com');
INSERT INTO `receiver` VALUES ('28', 'Foo', 'Bar', 'foo.bar@domain.com');
INSERT INTO `receiver` VALUES ('29', 'John', 'Doe', 'john.doe@domain.com');
INSERT INTO `receiver` VALUES ('30', 'Foo', 'Bar', 'foo.bar@domain.com');
INSERT INTO `receiver` VALUES ('31', 'John', 'Doe', 'john.doe@domain.com');
INSERT INTO `receiver` VALUES ('32', 'Foo', 'Bar', 'foo.bar@domain.com');
INSERT INTO `receiver` VALUES ('33', 'John', 'Doe', 'john.doe@domain.com');
INSERT INTO `receiver` VALUES ('34', 'naam', 'achternaam', 'naam@domain.com');
INSERT INTO `receiver` VALUES ('35', 'Kristof', 'Van Espen', 'krisvanespen@hotmail.com');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of sender
-- ----------------------------
INSERT INTO `sender` VALUES ('5', 'Kristof', 'Van Espen', 'naam@domain.com', 'Alles wat je kunt wensen.\nEn een klein beetje meer.\nZalig kerstfeest en\neen gelukkig Nieuwjaar!Alles wat je kunt wensen.\nEn een klein beetje meer.\nZalig kerstfeest en\neen gelukkig Nieuwjaar!Alles wat je kunt wensen.\nEn een klein beetje meer.\nZalig kerstfeest en\neen gelukkig Nieuwjaar!Alles wat je kunt wensen.\nEn een klein beetje meer.\nZalig kerstfeest en\neen gelukkig Nieuwjaar!Alles wat je kunt wensen.\nEn een klein beetje meer.\nZalig kerstfeest en\neen gelukkig Nieuwjaar!');
INSERT INTO `sender` VALUES ('6', 'Kristof', 'Van Espen', 'naam@domain.com', 'Placeholder text ');
