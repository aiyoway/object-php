/*
Navicat MySQL Data Transfer

Source Server         : local-win
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-10-18 17:50:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinytext,
  `firstname` varchar(255) DEFAULT '',
  `mainname` varchar(255) DEFAULT '',
  `title` varchar(255) DEFAULT '',
  `price` decimal(10,0) unsigned NOT NULL DEFAULT '0',
  `num_pages` int(10) unsigned NOT NULL DEFAULT '0',
  `play_length` int(10) unsigned NOT NULL DEFAULT '0',
  `discount` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
