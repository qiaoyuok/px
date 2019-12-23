/*
Navicat MySQL Data Transfer

Source Server         : 本地Linux
Source Server Version : 50642
Source Host           : 192.168.159.129:3306
Source Database       : mini

Target Server Type    : MYSQL
Target Server Version : 50642
File Encoding         : 65001

Date: 2019-05-03 16:49:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mini_swiper
-- ----------------------------
DROP TABLE IF EXISTS `mini_swiper`;
CREATE TABLE `mini_swiper` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '轮播图状态',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '排序权重',
  `imgUrl` varchar(255) NOT NULL DEFAULT '' COMMENT '图片地址',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '标题',
  `content` text NOT NULL COMMENT '对应的内容',
  `created_at` int(4) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(4) NOT NULL DEFAULT '0' COMMENT '上次更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mini_swiper
-- ----------------------------
INSERT INTO `mini_swiper` VALUES ('3', '1', '3', 'swiper__1556854681861.png', '', '', '1556805893', '1556871122');
INSERT INTO `mini_swiper` VALUES ('4', '1', '2', 'swiper__1556805895373.png', '', '', '1556805896', '1556871137');
INSERT INTO `mini_swiper` VALUES ('5', '1', '1', 'swiper__1556805899592.png', '', '', '1556805901', '1556805901');
INSERT INTO `mini_swiper` VALUES ('6', '1', '1', 'swiper__1556845597473.png', '反倒是', '<p>富商大贾</p>', '1556805905', '1556870889');
INSERT INTO `mini_swiper` VALUES ('11', '1', '1', 'swiper__1556845585176.png', '马尔快跑', '<p>佛挡杀佛防守打法</p>', '1556845587', '1556870988');
