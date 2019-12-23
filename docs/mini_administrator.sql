/*
Navicat MySQL Data Transfer

Source Server         : 本地Linux
Source Server Version : 50642
Source Host           : 192.168.1.103:3306
Source Database       : mini

Target Server Type    : MYSQL
Target Server Version : 50642
File Encoding         : 65001

Date: 2019-05-19 13:50:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mini_administrator
-- ----------------------------
DROP TABLE IF EXISTS `mini_administrator`;
CREATE TABLE `mini_administrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `access_token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`,`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mini_administrator
-- ----------------------------
INSERT INTO `mini_administrator` VALUES ('1', '1002', 'admin', 'admin', '$2y$13$PDGxiXacyRqOw1XjfGuSveJW2BS4nWaEAwWb227V/SuLXf7WWrLKy');
