/*
Navicat MySQL Data Transfer

Source Server         : 本地Linux
Source Server Version : 50642
Source Host           : 192.168.159.130:3306
Source Database       : mini

Target Server Type    : MYSQL
Target Server Version : 50642
File Encoding         : 65001

Date: 2019-05-04 09:57:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mini_get_vip_announce_log
-- ----------------------------
DROP TABLE IF EXISTS `mini_get_vip_announce_log`;
CREATE TABLE `mini_get_vip_announce_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `total` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '当天该时段发送通知的人数',
  `time` int(4) unsigned NOT NULL DEFAULT '0' COMMENT '通知的时间段',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
