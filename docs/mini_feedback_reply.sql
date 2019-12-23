/*
Navicat MySQL Data Transfer

Source Server         : 本地Linux
Source Server Version : 50642
Source Host           : 192.168.1.103:3306
Source Database       : mini

Target Server Type    : MYSQL
Target Server Version : 50642
File Encoding         : 65001

Date: 2019-05-12 20:46:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mini_feedback_reply
-- ----------------------------
DROP TABLE IF EXISTS `mini_feedback_reply`;
CREATE TABLE `mini_feedback_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `feedback_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户反馈索引',
  `content` text NOT NULL COMMENT '解答反馈的内容',
  `created_at` int(4) NOT NULL DEFAULT '0' COMMENT '回复时间',
  `updated_at` int(4) NOT NULL DEFAULT '0' COMMENT '更新回复时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
