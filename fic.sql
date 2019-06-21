/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50556
Source Host           : localhost:3306
Source Database       : fic

Target Server Type    : MYSQL
Target Server Version : 50556
File Encoding         : 65001

Date: 2018-05-09 18:21:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `fic_author`
-- ----------------------------
DROP TABLE IF EXISTS `fic_author`;
CREATE TABLE `fic_author` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '真实名字',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `logo` varchar(255) NOT NULL DEFAULT '' COMMENT '商户图片',
  `city_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '城市外键id',
  `city_path` varchar(50) NOT NULL DEFAULT '' COMMENT '城市，位置',
  `tel` varchar(20) NOT NULL DEFAULT '' COMMENT '联系方式',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `name` (`username`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='作者表';

-- ----------------------------
-- Records of fic_author
-- ----------------------------
INSERT INTO `fic_author` VALUES ('1', '测试用户', '1765125517@qq.com', '', '4', '3,4', '15973817745', '1', '1', '1521544544', '1521713695');

-- ----------------------------
-- Table structure for `fic_author_account`
-- ----------------------------
DROP TABLE IF EXISTS `fic_author_account`;
CREATE TABLE `fic_author_account` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `user_id` int(11) NOT NULL COMMENT '用户账号升级上来的id',
  `code` varchar(10) NOT NULL DEFAULT '' COMMENT 'md加密数据',
  `wr_id` int(11) NOT NULL DEFAULT '0' COMMENT '作者权限，默认为普通作者',
  `author_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '链接作者表',
  `last_login_ip` varchar(20) NOT NULL DEFAULT '' COMMENT '登入ip',
  `last_login_time` int(11) NOT NULL DEFAULT '0' COMMENT '登入时间',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `bis_id` (`author_id`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='作者账号表';

-- ----------------------------
-- Records of fic_author_account
-- ----------------------------
INSERT INTO `fic_author_account` VALUES ('1', 'ceshi', '8d421e892a47dff539f46142eb09e56b', '1', '1234', '0', '1', '', '0', '0', '1', '1521544544', '1521544544');

-- ----------------------------
-- Table structure for `fic_city`
-- ----------------------------
DROP TABLE IF EXISTS `fic_city`;
CREATE TABLE `fic_city` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `uname` varchar(50) NOT NULL DEFAULT '' COMMENT '英文名',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '外键id',
  `is_default` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '外键id',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uname` (`uname`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='城市表';

-- ----------------------------
-- Records of fic_city
-- ----------------------------
INSERT INTO `fic_city` VALUES ('1', '北京', 'beijing1', '0', '1', '0', '1', '1474013959', '0');
INSERT INTO `fic_city` VALUES ('2', '北京', 'beijing', '1', '0', '0', '1', '1474013959', '0');
INSERT INTO `fic_city` VALUES ('3', '江西', 'jiangxi', '0', '0', '0', '1', '1474013959', '0');
INSERT INTO `fic_city` VALUES ('4', '南昌', 'nanchang', '3', '1', '0', '1', '1474013959', '0');
INSERT INTO `fic_city` VALUES ('5', '上饶', 'shangrao', '3', '0', '0', '1', '1474013959', '0');
INSERT INTO `fic_city` VALUES ('6', '抚州', 'fuzhou', '3', '0', '1', '1', '1474013959', '0');
INSERT INTO `fic_city` VALUES ('7', '景德镇', 'jdz', '3', '0', '0', '1', '1474013959', '0');

-- ----------------------------
-- Table structure for `fic_deal`
-- ----------------------------
DROP TABLE IF EXISTS `fic_deal`;
CREATE TABLE `fic_deal` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '商品名称',
  `cartegory_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `se_cartegory_id` int(11) NOT NULL DEFAULT '0' COMMENT '二级栏目',
  `bis_id` int(11) NOT NULL DEFAULT '0' COMMENT '作者id',
  `location_ids` varchar(100) NOT NULL DEFAULT '' COMMENT '所属作者',
  `image` varchar(200) NOT NULL DEFAULT '' COMMENT '商品图片',
  `description` text NOT NULL COMMENT '商品描述',
  `start_time` int(11) NOT NULL DEFAULT '0' COMMENT '商品开始时间',
  `end_time` int(11) NOT NULL DEFAULT '0' COMMENT '商品结束时间',
  `origin_price` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '商品的原价',
  `currigin_price` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '商品的折扣价',
  `buy_count` int(11) NOT NULL DEFAULT '0' COMMENT '商品购买多少份',
  `total_count` int(11) NOT NULL DEFAULT '0' COMMENT '商品总数',
  `coupons_begin_time` int(11) NOT NULL DEFAULT '0' COMMENT '团购劵开始时间',
  `coupons_end_time` int(11) NOT NULL DEFAULT '0' COMMENT '团购劵结束时间',
  `bis_account_id` int(10) NOT NULL DEFAULT '0' COMMENT '对应商户账户',
  `balance_price` decimal(20,2) NOT NULL DEFAULT '0.00' COMMENT '和平台商品结算',
  `notes` text NOT NULL COMMENT '商品提示',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `cartegory_id` (`cartegory_id`),
  KEY `se_cartegory_id` (`se_cartegory_id`),
  KEY `start_time` (`start_time`),
  KEY `end_time` (`end_time`),
  KEY `coupons_begin_time` (`coupons_begin_time`),
  KEY `coupons_end_time` (`coupons_end_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='特价书表';

-- ----------------------------
-- Records of fic_deal
-- ----------------------------

-- ----------------------------
-- Table structure for `fic_featured`
-- ----------------------------
DROP TABLE IF EXISTS `fic_featured`;
CREATE TABLE `fic_featured` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '分类',
  `title` varchar(30) NOT NULL DEFAULT '' COMMENT '标题',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '图片地址',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '图片描述',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='推荐位表';

-- ----------------------------
-- Records of fic_featured
-- ----------------------------

-- ----------------------------
-- Table structure for `fic_grp`
-- ----------------------------
DROP TABLE IF EXISTS `fic_grp`;
CREATE TABLE `fic_grp` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '组表id',
  `grp_name` varchar(50) NOT NULL DEFAULT '' COMMENT '组名称',
  `parent_id` int(10) NOT NULL DEFAULT '0' COMMENT '父组id',
  `grp_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '组描述',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='组表';

-- ----------------------------
-- Records of fic_grp
-- ----------------------------
INSERT INTO `fic_grp` VALUES ('1', '超级用户', '1', '1521544544', '可以更改任意数据');

-- ----------------------------
-- Table structure for `fic_grp_permission`
-- ----------------------------
DROP TABLE IF EXISTS `fic_grp_permission`;
CREATE TABLE `fic_grp_permission` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `grp_id` int(11) NOT NULL COMMENT '组表id',
  `name` varchar(50) NOT NULL COMMENT '权限名称',
  `description` varchar(255) NOT NULL COMMENT '权限描述',
  `tpmb` varchar(255) NOT NULL COMMENT '权限图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='组权限表';

-- ----------------------------
-- Records of fic_grp_permission
-- ----------------------------
INSERT INTO `fic_grp_permission` VALUES ('1', '1', '超级管理员', '管理任意表', 'null');

-- ----------------------------
-- Table structure for `fic_permission`
-- ----------------------------
DROP TABLE IF EXISTS `fic_permission`;
CREATE TABLE `fic_permission` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '权限id',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父类权限id',
  `name` varchar(50) NOT NULL COMMENT '权限名称',
  `description` varchar(255) NOT NULL COMMENT '权限描述',
  `tpmb` varchar(255) NOT NULL COMMENT '权限图片',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户权限表';

-- ----------------------------
-- Records of fic_permission
-- ----------------------------

-- ----------------------------
-- Table structure for `fic_permission_writer`
-- ----------------------------
DROP TABLE IF EXISTS `fic_permission_writer`;
CREATE TABLE `fic_permission_writer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '权限id',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '父类权限id',
  `name` varchar(50) NOT NULL COMMENT '权限名称',
  `description` varchar(255) NOT NULL COMMENT '权限描述',
  `tpmb` varchar(255) NOT NULL COMMENT '权限图片',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='作者权限表';

-- ----------------------------
-- Records of fic_permission_writer
-- ----------------------------

-- ----------------------------
-- Table structure for `fic_story`
-- ----------------------------
DROP TABLE IF EXISTS `fic_story`;
CREATE TABLE `fic_story` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '小说分类id',
  `story_tle` varchar(50) NOT NULL COMMENT '分类标题',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '外键id',
  `click` int(10) DEFAULT '0' COMMENT '点击率',
  `vieworder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '显示排序',
  `pmid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '作者权限',
  `sids` varchar(255) NOT NULL COMMENT '介绍',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='主分类表';

-- ----------------------------
-- Records of fic_story
-- ----------------------------
INSERT INTO `fic_story` VALUES ('1', '言情·都市', '0', '0', '0', '0', '', '0', '1', '1474113959', '1521875521');
INSERT INTO `fic_story` VALUES ('2', '武侠·仙侠', '0', '0', '0', '0', '', '0', '1', '1474013959', '1522054377');
INSERT INTO `fic_story` VALUES ('3', '玄幻·奇幻', '0', '0', '0', '0', '', '1', '1', '1474013959', '1522460782');
INSERT INTO `fic_story` VALUES ('4', '科幻·灵异', '0', '0', '0', '0', '', '3', '1', '1474013959', '1521875558');
INSERT INTO `fic_story` VALUES ('5', '历史·军事', '0', '0', '0', '0', '', '0', '1', '1474013959', '1521795827');
INSERT INTO `fic_story` VALUES ('6', '悬疑·惊悚', '0', '0', '0', '0', '', '0', '1', '1474013959', '1521794876');
INSERT INTO `fic_story` VALUES ('7', '作品合辑', '0', '0', '0', '0', '', '0', '1', '1474013959', '1522460684');

-- ----------------------------
-- Table structure for `fic_story_ares`
-- ----------------------------
DROP TABLE IF EXISTS `fic_story_ares`;
CREATE TABLE `fic_story_ares` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '小说id',
  `tle_name` varchar(50) NOT NULL COMMENT '小说名称',
  `uname` varchar(50) NOT NULL COMMENT '小说拼音缩写',
  `pm_id` int(10) NOT NULL COMMENT '所属作者id',
  `logo` varchar(255) NOT NULL DEFAULT '' COMMENT '小说图片',
  `collect_ren` int(11) NOT NULL DEFAULT '0' COMMENT '收藏人数',
  `collect` int(1) NOT NULL DEFAULT '0' COMMENT '收藏字段，默认为0 不收藏',
  `click` int(11) NOT NULL DEFAULT '0' COMMENT '点击率',
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '所属分类外键id',
  `available` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否需要购买 0是需要购买 1是不需要购买',
  `uavailable` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否已被购买 0是购买 1是没购买',
  `vieworder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '显示排序',
  `pmrid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '作者权限',
  `sids` varchar(255) NOT NULL COMMENT '介绍',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='小说表';

-- ----------------------------
-- Records of fic_story_ares
-- ----------------------------
INSERT INTO `fic_story_ares` VALUES ('1', '成功背后的身影', 'cgbhdsy', '1', '/upload\\20180323\\7cc7d137c6b6eb57f890fc9bce24d125.jpg', '0', '0', '1000066', '1', '1', '0', '0', '0', '&lt;p&gt;用饱含深情的文字，抒发对老师也是妈妈的热爱。只是结构上内容上还有待加强。&lt;/p&gt;', '2', '1', '1474013959', '1522057020');
INSERT INTO `fic_story_ares` VALUES ('3', '捂耳朵', 'dsf', '1', '/upload\\20180323\\7cc7d137c6b6eb57f890fc9bce24d125.jpg', '0', '0', '91', '7', '1', '0', '0', '0', '&lt;p&gt;的萨芬撒多烦死东方红d&lt;/p&gt;', '1', '1', '1521786563', '1522460684');
INSERT INTO `fic_story_ares` VALUES ('4', '我为王', 'whw', '1', '/upload\\20180323\\6fa85b476b54aacdd20d3d775ac4abf8.jpg', '1', '1', '291', '4', '1', '0', '0', '0', '&lt;p&gt;司法所大士大夫撒旦第三方&lt;/p&gt;', '3', '1', '1521786822', '1522056306');
INSERT INTO `fic_story_ares` VALUES ('5', '一年永恒', 'ynyh', '1', '/upload\\20180326\\96e6fff8fdf38c7300e8d8168292d6d2.jpg', '0', '0', '18', '2', '1', '0', '0', '0', '&lt;p&gt;介绍&lt;/p&gt;', '0', '1', '0', '1522460643');
INSERT INTO `fic_story_ares` VALUES ('6', '大法师', 'dfs', '1', '/upload\\20180329\\f53aa3ac5739a5478e815a347e3d2680.jpg', '0', '0', '0', '4', '1', '0', '0', '0', '&lt;p&gt;阿萨德发&lt;/p&gt;', '0', '1', '0', '1522330361');

-- ----------------------------
-- Table structure for `fic_story_cas`
-- ----------------------------
DROP TABLE IF EXISTS `fic_story_cas`;
CREATE TABLE `fic_story_cas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '小说id',
  `name_zhang` int(10) NOT NULL DEFAULT '1' COMMENT '小说第几话',
  `ares_id` int(10) NOT NULL COMMENT '所属书的外键id',
  `tle_name` varchar(50) NOT NULL COMMENT '章节名称',
  `content` text NOT NULL COMMENT '小说内容',
  `words` int(11) NOT NULL DEFAULT '0' COMMENT '字数统计',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `gold` smallint(5) unsigned zerofill NOT NULL DEFAULT '00000' COMMENT '金币',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`),
  KEY `ares_id` (`ares_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='小说章节表';

-- ----------------------------
-- Records of fic_story_cas
-- ----------------------------
INSERT INTO `fic_story_cas` VALUES ('1', '1', '1', '成功背后的身影', '&lt;p&gt;　　三年终于艰难的过去了，等到了成功的时候。高考过后，我等了一天，去学校看看分数。当我走到高考榜前的时候，一看，我顿时就像傻了一样，不敢相信的眼睛，我竟然得了第一名。顿时，我脑子里仿佛现出了一个身影，眼睛一热都快哭了出来，毕竟考上了自己梦寐以求的大学。\r\n　　我之所以能考上自己梦寐以求的大学，那都是因为有一个人一直在鼓励我努力学习。这个人是一位戴着眼镜，衣着普普通通的一名小学教师，如果没有她的鼓励，就没有今天高考中榜的我。\r\n　　我记得那高考前一个星期，由于面临着自己能不能考上大学的问题，我几乎每天都努力地在复习功课。\r\n　　一天晚上，我在房间里看书的，妈妈突然走了进来。对我说：&ldquo;京京，这么晚了还不睡吗？&rdquo;我对妈妈说：&ldquo;妈，你先睡吧！我再看一会儿书。&rdquo;妈妈回答：&ldquo;好吧，记得早点睡哦！&rdquo;嗯！我说。一转眼，在高中的最后一个晚上过去了。因为我知道这天是我们所有人希望到来的日子。于是，我虽然满怀高兴地去学校迎接高考。可是，正在我刚走进考场时，我心里突然紧张起来，但没过多久我想反正不是我一个人会紧张，其他人也会。我就平下心来进行考试，没过几天考试完了。但我仍还是有些紧张，怕自己没中榜。终于，过几天后高考成绩出来了，我怀着不安的心情向学校走去。当我走到学校广告栏的时候，我敢都不敢想，看那张红红的榜，最后我还是鼓起勇气去看那张红红的榜。当我把头刚抬起来的时候吓了我一跳，我不敢相信自己的眼睛，我竟然中榜了，而且还是第一名。我在心里默默地对自己说：&ldquo;我成功了！我终于成功了！&rdquo;\r\n　　我之所以有今天这样的成功，都是因为那位普普通通的小学教师在鼓励我，而这位普普通通的小学教师就是我的──母亲。\r\n　　最后，我想告诉大家：各位，我们应该感谢我们自己的父母，因为在背后一直在鼓励我们的就是他们，如果没有他们的鼓励我们就不会成功。&lt;/p&gt;', '0', '0', '00000', '1', '1474013959', '1522057020');
INSERT INTO `fic_story_cas` VALUES ('2', '1', '3', '捂耳朵', '&lt;p&gt;萨达 撒发生地方&lt;/p&gt;', '0', '0', '00000', '1', '1521786563', '0');
INSERT INTO `fic_story_cas` VALUES ('3', '1', '4', '我为王', '&lt;p&gt;萨达士大夫撒防&lt;/p&gt;', '70', '0', '00000', '1', '1521786563', '0');
INSERT INTO `fic_story_cas` VALUES ('4', '2', '4', '什么鬼', '手动阀', '30', '0', '00000', '1', '1521786563', '0');
INSERT INTO `fic_story_cas` VALUES ('5', '1', '5', '第一章', '&lt;p&gt;小说内容&lt;/p&gt;', '0', '0', '00000', '1', '0', '1522460643');
INSERT INTO `fic_story_cas` VALUES ('6', '3', '4', '测试', '&lt;p&gt;测试&lt;/p&gt;', '0', '0', '00000', '1', '0', '1522057141');
INSERT INTO `fic_story_cas` VALUES ('7', '2', '3', 'ceshi', '&lt;p&gt;dshow&lt;/p&gt;', '0', '0', '00000', '1', '0', '1522145038');
INSERT INTO `fic_story_cas` VALUES ('8', '3', '3', 'asfd', '&lt;p&gt;sdaf&lt;/p&gt;', '0', '0', '00000', '1', '0', '1522145207');
INSERT INTO `fic_story_cas` VALUES ('9', '1', '6', '12', '&lt;p&gt;是打发&lt;/p&gt;', '0', '0', '00000', '0', '0', '1522330361');

-- ----------------------------
-- Table structure for `fic_user`
-- ----------------------------
DROP TABLE IF EXISTS `fic_user`;
CREATE TABLE `fic_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `username` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `code` varchar(10) NOT NULL DEFAULT '' COMMENT 'md加密数据',
  `per_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户权限，默认为普通用户，1为超级管理员，0为普通用户，2为作者',
  `last_login_ip` varchar(20) NOT NULL DEFAULT '' COMMENT '登入ip',
  `last_login_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '登入时间',
  `email` varchar(30) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` varchar(20) NOT NULL DEFAULT '' COMMENT '电话',
  `tupm` varchar(255) DEFAULT NULL COMMENT '头像图片',
  `listorder` int(8) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `update_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
  `gexing` varchar(255) DEFAULT '这个作者很懒没有留下任何足迹' COMMENT '个性签名',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of fic_user
-- ----------------------------
INSERT INTO `fic_user` VALUES ('0', 'admin', '8d421e892a47dff539f46142eb09e56b', '1234', '1', '', '1523166832', '1765125517@qq.com', '15973817745', '/static/index/images/avatars/user.jpg', '1', '1', '1521544544', '1523166832', '这个作者很懒没有留下任何足迹');
INSERT INTO `fic_user` VALUES ('1', 'ceshi', '8d421e892a47dff539f46142eb09e56b', '1234', '2', '', '1522330835', '176515517@qq.com', '15973817745', null, '33', '1', '1521544544', '1522330835', '这个作者很懒没有留下任何足迹');
INSERT INTO `fic_user` VALUES ('2', 'adc', 'e0b480cdfcb1f1803e3b5422aa85ffd0', '5005', '0', '', '0', '1765121117@qq.com', '', null, '0', '1', '1521879942', '1522493813', '这个作者很懒没有留下任何足迹');
INSERT INTO `fic_user` VALUES ('3', 'adbb', '52286f3134a104d17af4187742cadd3b', '8824', '0', '', '1522331951', '123456@qq.cm', '', null, '0', '1', '1521880133', '1522331950', '这个作者很懒没有留下任何足迹');
INSERT INTO `fic_user` VALUES ('8', 'gzc00', '84201e57cdeea71b557118223357bc6e', '4962', '0', '', '1522055062', '11123456@qq.cm', '', null, '0', '1', '1522055054', '1522055062', '这个作者很懒没有留下任何足迹');
INSERT INTO `fic_user` VALUES ('9', 'abb', 'adaf68db678292b872535ee33fe858ea', '5376', '0', '', '0', '123455@qq.com', '', null, '0', '1', '1522057688', '1522057688', '这个作者很懒没有留下任何足迹');
