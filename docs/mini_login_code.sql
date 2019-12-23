/*
Navicat MySQL Data Transfer

Source Server         : 本地Linux
Source Server Version : 50642
Source Host           : 192.168.1.103:3306
Source Database       : mini

Target Server Type    : MYSQL
Target Server Version : 50642
File Encoding         : 65001

Date: 2019-04-27 17:10:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mini_login_code
-- ----------------------------
DROP TABLE IF EXISTS `mini_login_code`;
CREATE TABLE `mini_login_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL DEFAULT '' COMMENT '获取到的验证码',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '验证码状态',
  `created_at` int(4) NOT NULL DEFAULT '0' COMMENT '获取验证码的时间戳',
  `updated_at` int(4) NOT NULL DEFAULT '0' COMMENT '验证码更新时间',
  `fgr_id` int(11) NOT NULL DEFAULT '0' COMMENT '获取到的账号记录ID号',
  `num` tinyint(1) NOT NULL DEFAULT '1' COMMENT '获取验证码次数',
  PRIMARY KEY (`id`),
  KEY `fgr_id` (`fgr_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
