/*创建小说数据库*/
create database fic;

#主分类表
CREATE TABLE fic_story (
  id int(11) unsigned NOT NULL AUTO_INCREMENT comment '小说分类id',
  story_tle varchar(50) NOT NULL comment'分类标题',
  parent_id int(10) unsigned NOT NULL DEFAULT '0' comment '外键id',
  vieworder int(8) unsigned NOT NULL DEFAULT '0' comment '显示排序',
  pmid int(10) unsigned NOT NULL DEFAULT '0' comment'作者权限',
  sids varchar(255) NOT NULL comment '介绍',
  listorder int(8) unsigned NOT NULL DEFAULT 0 comment'排序',
  status tinyint(1) NOT NULL DEFAULT 0 comment'状态',
  create_time int(11) unsigned NOT NULL DEFAULT 0 comment'添加时间',
  update_time int(11) unsigned NOT NULL DEFAULT 0 comment'修改时间',
  PRIMARY KEY (id),
  key parent_id(parent_id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 comment'主分类表';

#小说表
CREATE TABLE fic_story_ares(
   id int(11) unsigned NOT NULL AUTO_INCREMENT comment '小说id',
  tle_name varchar(50) NOT NULL comment'小说名称',
  uname varchar(50) NOT NULL comment'小说拼音缩写',
  pm_id int(10) NOT NULL comment '所属作者id',
  logo varchar(255) NOT NULL DEFAULT '' comment'小说图片',
  parent_id  id int(11) unsigned NOT NULL DEFAULT '0' comment '所属分类外键id',
  available tinyint(1) unsigned NOT NULL DEFAULT '1' comment '是否需要购买 0是需要购买 1是不需要购买',
  uavailable tinyint(1) unsigned NOT NULL DEFAULT '0' comment '是否已被购买 0是购买 1是没购买',
  vieworder int(8) unsigned NOT NULL DEFAULT '0' comment '显示排序',
  pmid  id int(11) unsigned NOT NULL DEFAULT '0' comment'作者权限',
  sids varchar(255) NOT NULL comment '介绍',
  listorder int(8) unsigned NOT NULL DEFAULT 0 comment'排序',
  status tinyint(1) NOT NULL DEFAULT 0 comment'状态',
  create_time int(11) unsigned NOT NULL DEFAULT 0 comment'添加时间',
  update_time int(11) unsigned NOT NULL DEFAULT 0 comment'修改时间',
  PRIMARY KEY (id),
  key parent_id(parent_id)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 comment'小说表';

#小说章节表
CREATE TABLE fic_story_cas(
  id int(11) unsigned NOT NULL AUTO_INCREMENT comment '小说id',
  ares_id int(10) NOT NULL comment '所属书的外键id',
  tle_name varchar(50) NOT NULL comment'小说名称',
  content text NOT NULL comment '小说内容',
  listorder int(8) unsigned NOT NULL DEFAULT 0 comment'排序',
  status tinyint(1) NOT NULL DEFAULT 0 comment'状态',
  create_time int(11) unsigned NOT NULL DEFAULT 0 comment'添加时间',
  update_time int(11) unsigned NOT NULL DEFAULT 0 comment'修改时间',
  PRIMARY KEY(id),
  key ares_id(ares_id)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 comment'小说章节表';

#用户权限表
CREATE TABLE fic_permission(
  id int(11) unsigned NOT NULL AUTO_INCREMENT comment '权限id',
  parent_id int(id) NOT NULL  DEFAULT'0' comment '父类权限id',
  name varchar(50) NOT NULL comment'权限名称',
  description varchar(255) NOT NULL comment '权限描述',
  tpmb varchar(255) NOT NULL comment '权限图片',
  PRIMARY KEY(id),
  key parent_id(parent_id)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 comment'用户权限表';

#作者权限表
CREATE TABLE fic_permission_writer(
  id int(11) unsigned NOT NULL AUTO_INCREMENT comment '权限id',
  parent_id int(id) NOT NULL  DEFAULT'0' comment '父类权限id',
  name varchar(50) NOT NULL comment'权限名称',
  description varchar(255) NOT NULL comment '权限描述',
  tpmb varchar(255) NOT NULL comment '权限图片',
  PRIMARY KEY(id),
  key parent_id(parent_id)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 comment'作者权限表';

#组表
CREATE TABLE fic_grp(
  id int(11) unsigned NOT NULL AUTO_INCREMENT comment '组表id',
  grp_name varchar(50) NOT NULL default'' comment '组名称',
  parent_id int(10) not null default '0' comment'父组id',
  grp_time int(11) unsigned NOT NULL DEFAULT 0 comment'添加时间',
  description varchar(255) NOT NULL DEFAULT '' comment'组描述',
  primary key(id),
  key(parent_id)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 comment'组表';

#组权限表
CREATE TABLE fic_grp_permission(
  id int(11) unsigned not null auto_increment comment'id',
  grp_id int(11) not null comment'组表id',
   name varchar(50) NOT NULL comment'权限名称',
  description varchar(255) NOT NULL comment '权限描述',
  tpmb varchar(255) NOT NULL comment '权限图片',
  PRIMARY KEY(id),
  key parent_id(parent_id) 
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 comment'组权限表';

#城市表
CREATE TABLE fic_city(
id int(11) unsigned NOT NULL auto_increment comment '主键id',
name varchar(50) NOT NULL DEFAULT '' comment'用户名',
uname varchar(50) NOT NULL DEFAULT '' comment'英文名',
parent_id int(10) unsigned NOT NULL DEFAULT 0 comment'外键id',
is_default int(10) unsigned NOT NULL DEFAULT 0 comment'外键id',
listorder int(8) unsigned NOT NULL DEFAULT 0 comment'排序',
status tinyint(1) NOT NULL DEFAULT 0 comment'状态',
create_time int(11) unsigned NOT NULL DEFAULT 0 comment'添加时间',
update_time int(11) unsigned NOT NULL DEFAULT 0 comment'修改时间',
PRIMARY KEY(id),
KEY parent_id(parent_id),
UNIQUE KEY uname(uname)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 comment'城市表';

#作者表
CREATE TABLE fic_author(
id int(11) unsigned NOT NULL auto_increment comment '主键id',
name varchar(50) NOT NULL DEFAULT '' comment'用户名',
email varchar(50) NOT NULL DEFAULT '' comment'邮箱',
logo varchar(255) NOT NULL DEFAULT '' comment'商户图片',
city_id int(11) unsigned NOT NULL DEFAULT 0 comment'城市外键id',
city_path varchar(50) NOT NULL DEFAULT '' comment'城市，位置',
tel varchar(20) NOT NULL DEFAULT '' comment'联系方式',
listorder int(8) unsigned NOT NULL DEFAULT 0 comment'排序',
status tinyint(1) NOT NULL DEFAULT 0 comment'状态',
create_time int(11) unsigned NOT NULL DEFAULT 0 comment'添加时间',
update_time int(11) unsigned NOT NULL DEFAULT 0 comment'修改时间',
PRIMARY KEY(id),
KEY name(name),
KEY city_id(city_id)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 comment '作者表';

#作者账号表
CREATE TABLE fic_author_account(
id int(11) unsigned NOT NULL auto_increment comment '主键id',
username varchar(50) NOT NULL DEFAULT '' comment'用户名',
password char(32) NOT NULL DEFAULT'' comment'密码',
code varchar(10) NOT NULL DEFAULT'' comment'md加密数据',
wr_id int(11) not null default '0' comment'作者权限，默认为普通作者',
author_id int(11) unsigned NOT NULL DEFAULT 0 comment'链接作者表',
last_login_ip varchar(20) NOT NULL DEFAULT '' comment'登入ip',
last_login_time int(11) unsigned NOT NULL DEFAULT 0 comment '登入时间',
listorder int(8) unsigned NOT NULL DEFAULT 0 comment '排序',
status tinyint(1) NOT NULL DEFAULT 0 comment '状态',
create_time int(11) unsigned NOT NULL DEFAULT 0 comment'添加时间',
update_time int(11) unsigned NOT NULL DEFAULT 0 comment'修改时间',
PRIMARY KEY(id),
KEY bis_id(bis_id),
KEY username(username)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 comment'作者账号表';

#特价书表
CREATE TABLE fic_deal(
id int(11) unsigned NOT NULL auto_increment comment '主键id',
name varchar(100) NOT NULL DEFAULT '' comment'商品名称',
cartegory_id int(11) NOT NULL DEFAULT 0 comment'商品id',
se_cartegory_id int(11) NOT NULL DEFAULT 0 comment'二级栏目',
bis_id int(11) NOT NULL DEFAULT 0 comment'作者id',
location_ids varchar(100) NOT NULL DEFAULT '' comment'所属作者',
image varchar(200) NOT NULL DEFAULT '' comment'商品图片',
description text NOT NULL comment'商品描述',
start_time int(11) NOT NULL DEFAULT 0 comment'商品开始时间',
end_time int(11) NOT NULL DEFAULT 0 comment'商品结束时间',
origin_price decimal(20,2) NOT NULL DEFAULT '0.00' comment'商品的原价',
currigin_price decimal(20,2) NOT NULL DEFAULT '0.00' comment'商品的折扣价',
buy_count int(11) NOT NULL DEFAULT 0 comment'商品购买多少份',
total_count int(11) NOT NULL DEFAULT 0 comment'商品总数',
coupons_begin_time int(11) NOT NULL DEFAULT 0 comment'团购劵开始时间',
coupons_end_time int(11) NOT NULL DEFAULT 0 comment'团购劵结束时间',
bis_account_id int(10) NOT NULL DEFAULT 0 comment'对应商户账户',
balance_price decimal(20,2) NOT NULL DEFAULT '0.00' comment'和平台商品结算',
notes text NOT NULL comment'商品提示',
listorder int(8) unsigned NOT NULL DEFAULT 0 comment'排序',
status tinyint(1) NOT NULL DEFAULT 0 comment'状态',
create_time int(11) unsigned NOT NULL DEFAULT 0 comment'添加时间',
update_time int(11) unsigned NOT NULL DEFAULT 0 comment'修改时间',
PRIMARY KEY(id),
KEY cartegory_id(cartegory_id),
KEY se_cartegory_id(se_cartegory_id),
KEY city_id(city_id),
KEY start_time(start_time),
KEY end_time(end_time),
KEY coupons_begin_time(coupons_begin_time),
KEY coupons_end_time(coupons_end_time)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 comment'特价书表';

#用户表
CREATE TABLE fic_user(
id int(11) unsigned NOT NULL auto_increment comment '主键id',
username varchar(50) NOT NULL DEFAULT '' comment'用户名',
password char(32) NOT NULL DEFAULT'' comment'密码',
code varchar(10) NOT NULL DEFAULT'' comment'md加密数据',
per_id int(11) not null default'0' comment '用户权限，默认为普通用户',
last_login_ip varchar(20) NOT NULL DEFAULT '' comment'登入ip',
last_login_time int(11) unsigned NOT NULL DEFAULT 0 comment '登入时间',
email varchar(30) NOT NULL DEFAULT '' comment'邮箱',
mobile varchar(20) NOT NULL DEFAULT '' comment'电话',
listorder int(8) unsigned NOT NULL DEFAULT 0 comment '排序',
status tinyint(1) NOT NULL DEFAULT 0 comment '状态',
create_time int(11) unsigned NOT NULL DEFAULT 0 comment'添加时间',
update_time int(11) unsigned NOT NULL DEFAULT 0 comment'修改时间',
PRIMARY KEY(id),
unique KEY username(username),
unique KEY email(email)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 comment'用户表';

#推荐位表
CREATE TABLE fic_featured(
id int(11) unsigned NOT NULL auto_increment comment '主键id',
type tinyint(1) NOT NULL DEFAULT 0 comment'分类',
title varchar(30) NOT NULL DEFAULT '' comment'标题',
image varchar(255) NOT NULL DEFAULT '' comment'图片',
url varchar(255) NOT NULL DEFAULT '' comment'图片地址',
description varchar(255) NOT NULL DEFAULT '' comment'图片描述',
listorder int(8) unsigned NOT NULL DEFAULT 0 comment '排序',
status tinyint(1) NOT NULL DEFAULT 0 comment '状态',
create_time int(11) unsigned NOT NULL DEFAULT 0 comment'添加时间',
update_time int(11) unsigned NOT NULL DEFAULT 0 comment'修改时间',
PRIMARY KEY(id)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 comment '推荐位表';

