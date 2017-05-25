/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.6.26 : Database - tahu
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tahu` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `tahu`;

/*Table structure for table `angsuran_kredit` */

DROP TABLE IF EXISTS `angsuran_kredit`;

CREATE TABLE `angsuran_kredit` (
  `angsuran_id` int(11) NOT NULL AUTO_INCREMENT,
  `kredit_id` varchar(200) NOT NULL,
  `trasaction_code` varchar(200) NOT NULL,
  `angsuran_payment` int(11) NOT NULL,
  `angsuran_date` datetime NOT NULL,
  `angsuran_payment_method` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `no_account` int(11) NOT NULL,
  PRIMARY KEY (`angsuran_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `angsuran_kredit` */

insert  into `angsuran_kredit`(`angsuran_id`,`kredit_id`,`trasaction_code`,`angsuran_payment`,`angsuran_date`,`angsuran_payment_method`,`bank_id`,`no_account`) values (1,'1','11492681934',2000,'2017-04-21 00:00:00',1,0,0),(2,'1','11492681934',15000,'2017-04-21 00:00:00',1,0,0),(3,'1','11492681934',100,'2017-04-21 00:00:00',3,1,123),(4,'1','11492681934',20,'2017-04-21 00:00:00',1,0,0),(5,'2','11492755124',5000,'2017-04-21 00:00:00',1,0,0),(6,'2','11492755124',1000,'2017-04-21 00:00:00',1,0,0),(7,'2','11492755124',2000,'2017-04-25 00:00:00',1,0,0),(8,'2','11492755124',4000,'2017-04-25 00:00:00',1,0,0),(9,'2','11492755124',4000,'2017-04-25 00:00:00',1,0,0),(10,'0','11493112127',50000,'2017-04-26 00:00:00',1,0,0),(11,'0','11493112127',50000,'2017-05-05 00:00:00',1,0,0),(12,'0','11493112127',50000,'2017-05-05 00:00:00',1,0,0),(13,'0','11493112127',23000,'2017-05-05 00:00:00',1,0,0),(14,'0','11493112127',45000,'2017-05-05 00:00:00',1,0,0),(15,'0','11493112127',12000,'2017-05-05 00:00:00',1,0,0),(16,'0','11493112127',20000,'2017-05-05 00:00:00',1,0,0);

/*Table structure for table `banks` */

DROP TABLE IF EXISTS `banks`;

CREATE TABLE `banks` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(100) NOT NULL,
  `bank_account_number` varchar(100) NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `banks` */

insert  into `banks`(`bank_id`,`bank_name`,`bank_account_number`) values (1,'BCA','4671271445'),(2,'BRI','7124623462');

/*Table structure for table `branches` */

DROP TABLE IF EXISTS `branches`;

CREATE TABLE `branches` (
  `branch_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(200) NOT NULL,
  `branch_img` text NOT NULL,
  `branch_desc` text NOT NULL,
  `branch_address` text NOT NULL,
  `branch_phone` varchar(100) NOT NULL,
  `branch_city` varchar(100) NOT NULL,
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `branches` */

insert  into `branches`(`branch_id`,`branch_name`,`branch_img`,`branch_desc`,`branch_address`,`branch_phone`,`branch_city`) values (1,'CABANG 1','1491463963_1491207459_1.png','','','0989906','SURABAYA'),(2,'CABANG 2','','','','0234567890','SAMARINDA'),(3,'CABANG 3','1491464041_1490170813_Name-tag-admin-1000.png','','','123123','PADANG');

/*Table structure for table `item_stocks` */

DROP TABLE IF EXISTS `item_stocks`;

CREATE TABLE `item_stocks` (
  `item_stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `item_stock_qty` float NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`item_stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `item_stocks` */

insert  into `item_stocks`(`item_stock_id`,`item_id`,`item_stock_qty`,`branch_id`) values (1,1,3,1),(2,2,100,1);

/*Table structure for table `items` */

DROP TABLE IF EXISTS `items`;

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(200) NOT NULL,
  `satuan_utama` int(11) NOT NULL,
  `item_kategori` varchar(100) NOT NULL,
  `item_limit` int(11) NOT NULL,
  `item_hpp_price` bigint(20) NOT NULL,
  `item_img` text NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `items` */

insert  into `items`(`item_id`,`item_name`,`satuan_utama`,`item_kategori`,`item_limit`,`item_hpp_price`,`item_img`) values (1,'Bawang Merah',1,'1',11,110000,''),(2,'Bawang Putih',1,'2',22,5500,''),(3,'Udang',1,'2',12,1000,''),(4,'Ayam',2,'3',21,1200,''),(16,'Telur',1,'3',12,25000,''),(17,'Kentang',1,'1',12,12312,'1491462896_default.png');

/*Table structure for table `journal_types` */

DROP TABLE IF EXISTS `journal_types`;

CREATE TABLE `journal_types` (
  `journal_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `journal_type_name` varchar(200) NOT NULL,
  PRIMARY KEY (`journal_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `journal_types` */

insert  into `journal_types`(`journal_type_id`,`journal_type_name`) values (1,'Penjualan'),(2,'Pembelian'),(3,'Pemasukan lainnya'),(4,'Pengeluaran lainnya'),(5,'Pengangsuran Piutang');

/*Table structure for table `journals` */

DROP TABLE IF EXISTS `journals`;

CREATE TABLE `journals` (
  `journal_id` int(11) NOT NULL AUTO_INCREMENT,
  `journal_type_id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `data_url` text NOT NULL,
  `journal_debit` int(11) NOT NULL,
  `journal_credit` int(11) NOT NULL,
  `journal_piutang` int(11) NOT NULL,
  `journal_hutang` int(11) NOT NULL,
  `journal_desc` text NOT NULL,
  `journal_date` date NOT NULL,
  `payment_method` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `bank_account` int(11) NOT NULL,
  `bank_id_to` int(11) NOT NULL,
  `bank_account_to` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`journal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

/*Data for the table `journals` */

insert  into `journals`(`journal_id`,`journal_type_id`,`code`,`data_url`,`journal_debit`,`journal_credit`,`journal_piutang`,`journal_hutang`,`journal_desc`,`journal_date`,`payment_method`,`bank_id`,`bank_account`,`bank_id_to`,`bank_account_to`,`user_id`,`branch_id`) values (1,2,'11492760505','purchase.php?page=form&id=',0,35000,0,0,'','2017-04-21',0,0,0,0,0,1,2),(2,1,'11492761036','penjualan.php?page=form&id=',100000,0,0,0,'','2017-04-21',0,0,0,0,0,1,1),(3,1,'11492761074','penjualan.php?page=form&id=',117000,0,0,0,'','2017-04-21',0,0,0,0,0,1,1),(4,1,'11492761115','penjualan.php?page=form&id=',18000,0,0,0,'','2017-04-21',0,0,0,0,0,1,1),(5,1,'11492761212','penjualan.php?page=form&id=',16000,0,0,0,'','2017-04-21',0,0,0,0,0,1,1),(6,1,'11492761366','penjualan.php?page=form&id=',24000,0,0,0,'','2017-04-21',0,0,0,0,0,1,1),(7,1,'11493090605','penjualan.php?page=form&id=',5700,0,0,0,'','2017-04-25',0,0,0,0,0,1,1),(8,2,'11493092268','purchase.php?page=form&id=',0,2000000,0,0,'','2017-04-25',0,0,0,0,0,1,1),(9,1,'11493112059','penjualan.php?page=form&id=',12600000,0,0,0,'','2017-04-25',0,0,0,0,0,1,1),(10,1,'11493112127','penjualan.php?page=form&id=',180000,0,0,0,'','2017-04-25',0,0,0,0,0,1,1),(11,2,'11493178486','purchase.php?page=form&id=',0,200000,0,0,'','2017-04-26',0,0,0,0,0,1,1),(12,2,'11493178526','purchase.php?page=form&id=',0,2000000,0,0,'','2017-04-26',0,0,0,0,0,1,1),(13,2,'11493181215','purchase.php?page=form&id=',0,1000000,0,0,'','2017-04-26',0,0,0,0,0,1,1),(14,2,'11493181242','purchase.php?page=form&id=',0,2000000,0,0,'','2017-04-26',0,0,0,0,0,1,1),(15,5,'11493112127','piutang.php?page=form0=',0,50000,0,0,'','2017-04-26',1,0,0,0,0,1,1),(16,2,'11493259242','purchase.php?page=form&id=',0,1000000,0,0,'','2017-04-27',0,0,0,0,0,1,1),(17,1,'11493260018','penjualan.php?page=form&id=',105127,0,0,0,'','2017-04-27',0,0,0,0,0,1,1),(18,1,'11493260222','penjualan.php?page=form&id=',4111100,0,0,0,'','2017-04-27',0,0,0,0,0,1,1),(19,1,'11493261829','penjualan.php?page=form&id=',9999000,0,0,0,'','2017-04-27',0,0,0,0,0,1,1),(20,1,'11493263096','penjualan.php?page=form&id=',0,0,0,0,'','2017-04-27',0,0,0,0,0,1,1),(21,1,'11493263995','penjualan.php?page=form&id=',200000,0,0,0,'','2017-04-27',0,0,0,0,0,1,1),(22,1,'11493264045','penjualan.php?page=form&id=',444000,0,0,0,'','2017-04-27',0,0,0,0,0,1,1),(23,1,'11493264210','penjualan.php?page=form&id=',24600,0,0,0,'','2017-04-27',0,0,0,0,0,1,1),(24,1,'11493264272','penjualan.php?page=form&id=',303184,0,0,0,'','2017-04-27',0,0,0,0,0,1,1),(25,1,'11493264582','penjualan.php?page=form&id=',99990,0,0,0,'','2017-04-27',0,0,0,0,0,1,1),(26,2,'11493264865','purchase.php?page=form&id=',0,20000,0,0,'','2017-04-27',0,0,0,0,0,1,1),(27,2,'11493267879','purchase.php?page=form&id=',0,10000000,0,0,'','2017-04-27',0,0,0,0,0,1,1),(28,2,'11493267895','purchase.php?page=form&id=',0,10000000,0,0,'','2017-04-27',0,0,0,0,0,1,1),(29,2,'11493347417','purchase.php?page=form&id=',0,2000000,0,0,'','2017-04-28',0,0,0,0,0,1,1),(30,1,'11493347444','penjualan.php?page=form&id=',499950,0,0,0,'','2017-04-28',0,0,0,0,0,1,1),(31,1,'11493351228','penjualan.php?page=form&id=',4999500,0,0,0,'','2017-04-28',0,0,0,0,0,1,1),(32,5,'11493112127','piutang.php?page=form0=',0,50000,0,0,'','2017-05-05',1,0,0,0,0,1,1),(33,5,'11493112127','piutang.php?page=form0=',0,50000,0,0,'','2017-05-05',1,0,0,0,0,1,1),(34,5,'11493112127','piutang.php?page=form0=',0,23000,0,0,'','2017-05-05',1,0,0,0,0,1,1),(35,5,'11493112127','piutang.php?page=form0=',0,45000,0,0,'','2017-05-05',1,0,0,0,0,1,1),(36,5,'11493112127','piutang.php?page=form0=',0,12000,0,0,'','2017-05-05',1,0,0,0,0,1,1),(37,5,'11493112127','piutang.php?page=form0=',0,20000,0,0,'','2017-05-05',1,0,0,0,0,1,1),(38,1,'11493966264','penjualan.php?page=form&id=',24000,0,0,0,'','2017-05-05',0,0,0,0,0,1,1),(39,1,'11493966273','penjualan.php?page=form&id=',0,0,0,0,'','2017-05-05',0,0,0,0,0,1,1),(40,1,'11493966311','penjualan.php?page=form&id=',0,0,0,0,'','2017-05-05',0,0,0,0,0,1,1),(41,1,'11493967305','penjualan.php?page=form&id=',6822000,0,0,0,'','2017-05-05',0,0,0,0,0,1,1),(42,1,'11493967429','penjualan.php?page=form&id=',17184,0,0,0,'','2017-05-05',0,0,0,0,0,1,1),(43,1,'11493972727','penjualan.php?page=form&id=',1400000,0,0,0,'','2017-05-05',0,0,0,0,0,1,1);

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `kategori` */

insert  into `kategori`(`kategori_id`,`kategori_name`) values (1,'Goreng'),(2,'Rebus'),(3,'Kukus');

/*Table structure for table `keranjang` */

DROP TABLE IF EXISTS `keranjang`;

CREATE TABLE `keranjang` (
  `keranjang_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  `qty` bigint(20) NOT NULL,
  `satuan` int(11) DEFAULT NULL,
  `total` bigint(20) NOT NULL,
  PRIMARY KEY (`keranjang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `keranjang` */

/*Table structure for table `konversi_item` */

DROP TABLE IF EXISTS `konversi_item`;

CREATE TABLE `konversi_item` (
  `konversi_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `satuan_utama` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan_konversi` int(11) NOT NULL,
  `jumlah_satuan_konversi` int(11) NOT NULL,
  PRIMARY KEY (`konversi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `konversi_item` */

insert  into `konversi_item`(`konversi_id`,`item_id`,`satuan_utama`,`jumlah`,`satuan_konversi`,`jumlah_satuan_konversi`) values (27,1,1,1,2,10),(30,2,1,1,2,10),(31,2,1,1,3,5),(32,1,1,1,3,100);

/*Table structure for table `konversi_menu` */

DROP TABLE IF EXISTS `konversi_menu`;

CREATE TABLE `konversi_menu` (
  `konversi_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `satuan_utama` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan_konversi` int(11) NOT NULL,
  `jumlah_satuan_konversi` int(11) NOT NULL,
  `konversi_harga` bigint(11) NOT NULL,
  PRIMARY KEY (`konversi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `konversi_menu` */

insert  into `konversi_menu`(`konversi_id`,`menu_id`,`satuan_utama`,`jumlah`,`satuan_konversi`,`jumlah_satuan_konversi`,`konversi_harga`) values (4,5,1,1,2,5,112),(5,5,1,1,3,10,1432),(6,1,1,1,2,5,5555),(10,6,1,1,2,10,1231),(12,6,1,1,3,55,3231),(15,2,1,1,2,10,13000),(16,2,1,1,3,5,7000);

/*Table structure for table `kredit` */

DROP TABLE IF EXISTS `kredit`;

CREATE TABLE `kredit` (
  `kredit_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_code` varchar(200) NOT NULL,
  `transaction_total` int(11) DEFAULT NULL,
  `transaction_uang_muka` int(11) DEFAULT NULL,
  `transaction_piutang` int(11) DEFAULT NULL,
  `branch` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`kredit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `kredit` */

insert  into `kredit`(`kredit_id`,`transaction_code`,`transaction_total`,`transaction_uang_muka`,`transaction_piutang`,`branch`,`status`) values (0,'11493112127',180000,80000,300000,1,0),(2,'11492755124',44000,50000,0,1,2),(3,'11493090605',5700,6000,-300,1,0);

/*Table structure for table `members` */

DROP TABLE IF EXISTS `members`;

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_name` varchar(200) NOT NULL,
  `member_phone` varchar(50) NOT NULL,
  `member_address` varchar(200) NOT NULL,
  `member_email` varchar(200) NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `members` */

insert  into `members`(`member_id`,`member_name`,`member_phone`,`member_address`,`member_email`) values (1,'Ambon','123456789','Mana Saja','ambon@ambon.com'),(2,'Livi','015234567','Jl raya','livi@livi.com');

/*Table structure for table `menu_recipes` */

DROP TABLE IF EXISTS `menu_recipes`;

CREATE TABLE `menu_recipes` (
  `menu_recipe_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_qty` bigint(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  PRIMARY KEY (`menu_recipe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `menu_recipes` */

insert  into `menu_recipes`(`menu_recipe_id`,`menu_id`,`item_id`,`item_qty`,`satuan_id`) values (1,1,1,5,3),(2,2,2,2,3),(4,1,2,2,3),(6,0,2,3,3),(7,0,2,4,3),(8,0,3,5,3),(9,0,4,2,3),(10,0,4,3,3),(11,0,4,3,3);

/*Table structure for table `menu_stock` */

DROP TABLE IF EXISTS `menu_stock`;

CREATE TABLE `menu_stock` (
  `menu_stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `menu_stock_qty` float NOT NULL,
  PRIMARY KEY (`menu_stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `menu_stock` */

insert  into `menu_stock`(`menu_stock_id`,`menu_id`,`branch_id`,`menu_stock_qty`) values (1,1,1,660),(2,2,1,48.2),(3,5,1,40);

/*Table structure for table `menus` */

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_kategori` int(11) NOT NULL,
  `menu_name` varchar(200) NOT NULL,
  `menu_original_price` bigint(200) NOT NULL,
  `menu_price` bigint(20) NOT NULL,
  `menu_img` text NOT NULL,
  `menu_satuan` int(11) NOT NULL,
  `menu_limit` int(11) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `menus` */

insert  into `menus`(`menu_id`,`menu_kategori`,`menu_name`,`menu_original_price`,`menu_price`,`menu_img`,`menu_satuan`,`menu_limit`) values (1,1,'Tahu Udang',500,2000,'1491469780_default.png',1,20),(2,2,'Tahu Ayam',1000,2000,'1491469788_default.png',1,20),(5,3,'Tahu Sapi',6000,8000,'1492587932_default.png',1,50),(6,1,'Tahu Bebek',7500,9000,'1492587940_default.png',1,20);

/*Table structure for table `office` */

DROP TABLE IF EXISTS `office`;

CREATE TABLE `office` (
  `office_id` int(11) NOT NULL,
  `office_name` varchar(200) NOT NULL,
  `office_img` text NOT NULL,
  `office_desc` text NOT NULL,
  `office_address` text NOT NULL,
  `office_phone` varchar(100) NOT NULL,
  `office_email` varchar(300) NOT NULL,
  `office_city` varchar(100) NOT NULL,
  `office_owner` varchar(100) NOT NULL,
  `office_owner_phone` varchar(100) NOT NULL,
  `office_owner_address` varchar(100) NOT NULL,
  `office_owner_email` varchar(100) NOT NULL,
  PRIMARY KEY (`office_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `office` */

insert  into `office`(`office_id`,`office_name`,`office_img`,`office_desc`,`office_address`,`office_phone`,`office_email`,`office_city`,`office_owner`,`office_owner_phone`,`office_owner_address`,`office_owner_email`) values (1,'TAHU','1492485912_succes.jpg','','																	','','','','','','','');

/*Table structure for table `payment_methods` */

DROP TABLE IF EXISTS `payment_methods`;

CREATE TABLE `payment_methods` (
  `payment_method_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_method_name` varchar(100) NOT NULL,
  PRIMARY KEY (`payment_method_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `payment_methods` */

insert  into `payment_methods`(`payment_method_id`,`payment_method_name`) values (1,'CASH'),(2,'KREDIT'),(3,'DEBIT'),(4,'TRANSFER'),(5,'ANGSURAN');

/*Table structure for table `pengurangan_produksi` */

DROP TABLE IF EXISTS `pengurangan_produksi`;

CREATE TABLE `pengurangan_produksi` (
  `pengurangan_produksi_id` int(11) NOT NULL AUTO_INCREMENT,
  `produksi_code` varchar(200) NOT NULL,
  `produksi_date` datetime DEFAULT NULL,
  `menu_qty` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_qty` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`pengurangan_produksi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

/*Data for the table `pengurangan_produksi` */

insert  into `pengurangan_produksi`(`pengurangan_produksi_id`,`produksi_code`,`produksi_date`,`menu_qty`,`item_id`,`item_qty`,`branch_id`) values (5,'11493178424','2017-04-26 00:00:00',1,1,5,1),(6,'11493178424','2017-04-26 00:00:00',1,2,2,1),(7,'11493178625','2017-04-26 00:00:00',10,1,50,1),(8,'11493178625','2017-04-26 00:00:00',10,2,20,1),(9,'11493190867','2017-04-26 00:00:00',20,1,100,1),(10,'11493190867','2017-04-26 00:00:00',20,2,40,1),(11,'11493192169','2017-04-26 00:00:00',1,1,5,1),(12,'11493192169','2017-04-26 00:00:00',1,2,2,1),(13,'11493192236','2017-04-26 00:00:00',1,1,5,1),(14,'11493192236','2017-04-26 00:00:00',1,2,2,1),(15,'11493267828','2017-04-27 00:00:00',20,1,100,1),(16,'11493267828','2017-04-27 00:00:00',20,2,40,1),(17,'11493267936','2017-04-27 00:00:00',1,1,5,1),(18,'11493267936','2017-04-27 00:00:00',1,2,2,1),(19,'11493267984','2017-04-27 00:00:00',5,1,25,1),(20,'11493267984','2017-04-27 00:00:00',5,2,10,1),(21,'11493268011','2017-04-27 00:00:00',1,1,5,1),(22,'11493268011','2017-04-27 00:00:00',1,2,2,1),(23,'11493268462','2017-04-27 00:00:00',1,1,5,1),(24,'11493268462','2017-04-27 00:00:00',1,2,2,1),(25,'11493268484','2017-04-27 00:00:00',1,1,5,1),(26,'11493268484','2017-04-27 00:00:00',1,2,2,1),(28,'11493279925','2017-04-27 00:00:00',1,1,5,1),(29,'11493279925','2017-04-27 00:00:00',1,2,2,1),(30,'11493279936','2017-04-27 00:00:00',1,1,5,1),(31,'11493279936','2017-04-27 00:00:00',1,2,2,1),(32,'11493279955','2017-04-27 00:00:00',1,1,5,1),(33,'11493279955','2017-04-27 00:00:00',1,2,2,1),(34,'11493352288','2017-04-28 00:00:00',20,1,100,1),(35,'11493352288','2017-04-28 00:00:00',20,2,40,1),(36,'11493352582','2017-04-28 00:00:00',10,2,20,1),(37,'11493954674','2017-05-05 05:05:34',200,1,1000,1),(38,'11493954674','2017-05-05 05:05:34',200,2,400,1),(39,'11494212192','2017-05-08 04:05:32',1,2,2,1);

/*Table structure for table `permits` */

DROP TABLE IF EXISTS `permits`;

CREATE TABLE `permits` (
  `permit_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_id` int(11) NOT NULL,
  `side_menu_id` int(11) NOT NULL,
  `permit_acces` varchar(10) NOT NULL,
  PRIMARY KEY (`permit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3483 DEFAULT CHARSET=latin1;

/*Data for the table `permits` */

insert  into `permits`(`permit_id`,`user_type_id`,`side_menu_id`,`permit_acces`) values (409,28,1,'c,r,u,d'),(410,28,2,'c,r,u,d'),(411,28,3,'c,r,u,d'),(412,28,4,'c,r,u,d'),(413,28,5,'c,r,u,d'),(414,28,6,'c,r,u,d'),(415,28,7,'c,r,u,d'),(416,28,8,'c,r,u,d'),(417,28,9,'c,r,u,d'),(418,28,10,'c,r,u,d'),(419,28,11,'c,r,u,d'),(420,28,12,'c,r,u,d'),(421,28,13,'c,r,u,d'),(422,28,14,'c,r,u,d'),(423,28,15,'c,r,u,d'),(424,28,16,'c,r,u,d'),(425,28,17,'c,r,u,d'),(426,28,18,'c,r,u,d'),(427,28,19,'c,r,u,d'),(428,28,20,'c,r,u,d'),(429,28,21,'c,r,u,d'),(430,28,22,'c,r,u,d'),(431,28,23,'c,r,u,d'),(432,28,24,'c,r,u,d'),(481,2,1,'c,r,u,d'),(482,2,2,'c,r,u,d'),(483,2,3,'c,r,u,d'),(484,2,4,'c,r,u,d'),(485,2,5,'c,r,u,d'),(486,2,6,'c,r,u,d'),(487,2,7,'c,r,u,d'),(488,2,8,'c,r,u,d'),(489,2,9,'c,r,u,d'),(490,2,10,'c,r,u,d'),(491,2,11,'c,r,u,d'),(492,2,12,'c,r,u,d'),(493,2,13,'c,r,u,d'),(494,2,14,'c,r,u,d'),(495,2,15,'c,r,u,d'),(496,2,16,'c,r,u,d'),(497,2,17,'c,r,u,d'),(498,2,18,'c,r,u,d'),(499,2,19,'c,r,u,d'),(500,2,20,'c,r,u,d'),(501,2,21,'c,r,u,d'),(502,2,22,'c,r,u,d'),(503,2,23,'c,r,u,d'),(504,2,24,'c,r,u,d'),(505,4,1,'c,r,u,d'),(506,4,2,'c,r,u,d'),(507,4,3,'c,r,u,d'),(508,4,4,'c,r,u,d'),(509,4,5,'c,r,u,d'),(510,4,6,'c,r,u,d'),(511,4,7,'c,r,u,d'),(512,4,8,'c,r,u,d'),(513,4,9,'c,r,u,d'),(514,4,10,'c,r,u,d'),(515,4,11,'c,r,u,d'),(516,4,12,'c,r,u,d'),(517,4,13,'c,r,u,d'),(518,4,14,'c,r,u,d'),(519,4,15,'c,r,u,d'),(520,4,16,'c,r,u,d'),(521,4,17,'c,r,u,d'),(522,4,18,'c,r,u,d'),(523,4,19,'c,r,u,d'),(524,4,20,'c,r,u,d'),(525,4,21,'c,r,u,d'),(526,4,22,'c,r,u,d'),(527,4,23,'c,r,u,d'),(528,4,24,'c,r,u,d'),(3442,1,1,'0'),(3443,1,2,'0'),(3444,1,3,'0'),(3445,1,4,'0'),(3446,1,5,'0'),(3447,1,6,'0'),(3448,1,7,'0'),(3449,1,8,'0'),(3450,1,9,'c,r,u,d'),(3451,1,10,'c,r,u,d'),(3452,1,11,'c,r,u,d'),(3453,1,12,'c,r,u,d'),(3454,1,13,'c,r,u,d'),(3455,1,14,''),(3456,1,15,'c,r,u,d'),(3457,1,16,'c,r,u,d'),(3458,1,17,'c,r,u,d'),(3459,1,18,'c,r,u,d'),(3460,1,19,'c,r,u,d'),(3461,1,20,'c,r,u,d'),(3462,1,21,''),(3463,1,22,'c,r,u,d'),(3464,1,23,'c,r,u,d'),(3465,1,24,''),(3466,1,25,''),(3467,1,26,'c,r,u,d'),(3468,1,27,'c,r,u,d'),(3469,1,28,'c,r,u,d'),(3470,1,29,'0'),(3471,1,30,''),(3472,1,31,''),(3473,1,32,'c,r,u,d'),(3474,1,33,'c,r,u,d'),(3475,1,34,'c,r,u,d'),(3476,1,35,''),(3477,1,36,''),(3478,1,37,''),(3479,1,38,''),(3480,1,41,''),(3481,1,42,''),(3482,1,43,'c,r,u,d');

/*Table structure for table `produksi` */

DROP TABLE IF EXISTS `produksi`;

CREATE TABLE `produksi` (
  `produksi_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `produksi_date` datetime NOT NULL,
  `produksi_code` varchar(100) NOT NULL,
  `produksi_code_2` varchar(200) DEFAULT NULL,
  `satuan_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`produksi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

/*Data for the table `produksi` */

insert  into `produksi`(`produksi_id`,`menu_id`,`branch_id`,`produksi_date`,`produksi_code`,`produksi_code_2`,`satuan_id`,`qty`) values (51,1,1,'2017-04-27 00:00:00','11493267828',NULL,2,20),(52,1,1,'2017-04-27 00:00:00','11493267936',NULL,1,1),(53,1,1,'2017-04-27 00:00:00','11493267984',NULL,2,5),(54,1,1,'2017-04-27 00:00:00','11493268011',NULL,2,1),(55,1,1,'2017-04-27 00:00:00','11493268126',NULL,2,5),(56,1,1,'2017-04-27 00:00:00','11493268159',NULL,2,5),(57,1,1,'2017-04-27 00:00:00','11493268462',NULL,2,5),(58,1,1,'2017-04-27 00:00:00','11493268484',NULL,2,5),(59,1,1,'2017-04-27 00:00:00','11493279925',NULL,1,1),(60,1,1,'2017-04-27 00:00:00','11493279936',NULL,2,5),(61,1,1,'2017-04-27 00:00:00','11493279955',NULL,2,5),(62,1,1,'2017-04-28 00:00:00','11493352288',NULL,2,100),(63,2,1,'2017-04-28 00:00:00','11493352582',NULL,2,100),(64,1,1,'2017-05-05 05:05:34','11493954674',NULL,2,1000),(65,2,1,'2017-05-08 04:05:32','11494212192','',2,12);

/*Table structure for table `purchases` */

DROP TABLE IF EXISTS `purchases`;

CREATE TABLE `purchases` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_date` date NOT NULL,
  `purchase_code` varchar(200) NOT NULL,
  `item_id` int(11) NOT NULL,
  `purchase_price` bigint(11) NOT NULL,
  `purchase_qty` int(11) NOT NULL,
  `purchase_total` bigint(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `satuan_konversi` int(11) NOT NULL,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `purchases` */

insert  into `purchases`(`purchase_id`,`purchase_date`,`purchase_code`,`item_id`,`purchase_price`,`purchase_qty`,`purchase_total`,`user_id`,`supplier_id`,`branch_id`,`satuan_konversi`) values (1,'2017-04-21','11492760505',2,5000,7,35000,1,1,2,0),(2,'2017-04-22','11493092268',1,20000,100,2000000,1,1,1,2),(3,'2017-04-23','11493178486',1,1000,200,200000,1,1,1,2),(4,'2017-04-24','11493178526',1,2000,1000,2000000,1,1,1,3),(5,'2017-04-25','11493181215',1,5000,200,1000000,1,1,1,2),(6,'2017-04-26','11493181242',1,2000,1000,2000000,1,1,1,2),(7,'2017-04-27','11493259242',2,2000,500,1000000,1,1,1,2),(8,'2017-04-27','11493264865',1,1000,20,20000,1,1,1,3),(9,'2017-04-27','11493267879',2,1000,10000,10000000,1,1,1,2),(10,'2017-04-27','11493267895',1,1000,10000,10000000,1,1,1,2),(11,'2017-04-28','11493347417',2,20000,100,2000000,1,1,1,2);

/*Table structure for table `purchases_tmp` */

DROP TABLE IF EXISTS `purchases_tmp`;

CREATE TABLE `purchases_tmp` (
  `purchases_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `purchases_date` datetime NOT NULL,
  `purchases_code` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`purchases_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `purchases_tmp` */

/*Table structure for table `satuan` */

DROP TABLE IF EXISTS `satuan`;

CREATE TABLE `satuan` (
  `satuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `satuan_name` varchar(200) NOT NULL,
  PRIMARY KEY (`satuan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `satuan` */

insert  into `satuan`(`satuan_id`,`satuan_name`) values (1,'Keranjang'),(2,'Bungkus'),(3,'Buah');

/*Table structure for table `satuan_menu` */

DROP TABLE IF EXISTS `satuan_menu`;

CREATE TABLE `satuan_menu` (
  `satuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `satuan_name` varchar(200) NOT NULL,
  PRIMARY KEY (`satuan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `satuan_menu` */

insert  into `satuan_menu`(`satuan_id`,`satuan_name`) values (1,'Lemari'),(2,'Keranjang'),(3,'Bungkus');

/*Table structure for table `selisih_itemsday` */

DROP TABLE IF EXISTS `selisih_itemsday`;

CREATE TABLE `selisih_itemsday` (
  `selisih_id` int(11) NOT NULL AUTO_INCREMENT,
  `selisih_date` datetime DEFAULT NULL,
  `branch` int(11) DEFAULT NULL,
  `item` int(11) DEFAULT NULL,
  `item_qty` float DEFAULT NULL,
  PRIMARY KEY (`selisih_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `selisih_itemsday` */

insert  into `selisih_itemsday`(`selisih_id`,`selisih_date`,`branch`,`item`,`item_qty`) values (1,'0000-00-00 00:00:00',0,0,0);

/*Table structure for table `side_menus` */

DROP TABLE IF EXISTS `side_menus`;

CREATE TABLE `side_menus` (
  `side_menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `side_menu_name` varchar(100) NOT NULL,
  `side_menu_url` varchar(100) NOT NULL,
  `side_menu_parent` int(11) NOT NULL,
  `side_menu_icon` varchar(100) NOT NULL,
  `side_menu_level` int(11) NOT NULL,
  `side_menu_type_parent` int(11) NOT NULL,
  PRIMARY KEY (`side_menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

/*Data for the table `side_menus` */

insert  into `side_menus`(`side_menu_id`,`side_menu_name`,`side_menu_url`,`side_menu_parent`,`side_menu_icon`,`side_menu_level`,`side_menu_type_parent`) values (1,'Dashboard','home.php',0,'fa fa-tachometer',1,0),(2,'Master','#',0,'fa fa-edit',1,0),(3,'Produksi','produksi.php',0,'fa fa-tasks',1,0),(4,'Inventory','#',0,'fa fa-briefcase',1,0),(5,'Transaksi','#',0,'fa fa-shopping-cart',1,0),(6,'Accounting','#',0,'fa fa-list-alt',1,0),(7,'Laporan','#',0,'fa fa-book',1,0),(8,'Setting','#',0,'fa fa-cog',1,0),(9,'Tutorial','tutorial.php',0,'fa fa-video-camera',1,1),(10,'Cabang','branch.php',2,'',2,1),(11,'Bank','bank.php',2,'',2,1),(12,'Supplier','supplier.php',2,'',2,1),(13,'Member','member.php',2,'',2,1),(14,'Kategori','kategori.php',2,'',2,1),(15,'Bahan','stock_master.php',2,'',2,1),(16,'Satuan Bahan','satuan.php',2,'',2,1),(17,'Penyesuaian Stock','penyesuaian_stock.php',4,'',2,1),(18,'Tahu','menu.php',2,'',2,1),(19,'Satuan Tahu','satuan_menu.php',2,'',2,1),(20,'Stock Tahu','menustock.php',4,'',2,1),(21,'Produksi','produksi.php',3,'',2,1),(22,'Piutang','piutang.php',5,'',2,1),(23,'Pembelian','purchase.php',5,'',2,1),(24,'Angsuran Piutang / Kredit','#',0,'',2,1),(25,'Angsuran Hutang','#',0,'',2,1),(26,'Arus Kas','arus_kas.php',6,'',2,1),(27,'Pemasukan Dan Pengeluaran Lainnya','jurnal_umum.php',6,'',2,1),(28,'Laporan Detail','report_detail.php',7,'',2,1),(29,'Laporan Harian','#',0,'',0,0),(30,'Laporan Piutang','#',7,'',2,1),(31,'Laporan hutang','#',7,'',2,1),(32,'Profil','office.php',8,'',2,1),(33,'User','user.php',8,'',2,1),(34,'Type User','user_type.php',8,'',2,1),(35,'Retur penjualan','#',5,'',2,1),(36,'Retur pembelian','#',5,'',2,1),(37,'Laporan retur penjualan','#',7,'',2,1),(38,'Laporan retur pembelian','#',7,'',2,1),(41,'Laporan Uang Kasir','#',7,'',2,1),(42,'Laporan Hapus Transaksi','#',7,'',2,1),(43,'Penjualan','penjualan.php',5,'',2,1);

/*Table structure for table `suppliers` */

DROP TABLE IF EXISTS `suppliers`;

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(50) NOT NULL,
  `supplier_phone` varchar(11) NOT NULL,
  `supplier_email` varchar(100) NOT NULL,
  `supplier_addres` varchar(100) NOT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `suppliers` */

insert  into `suppliers`(`supplier_id`,`supplier_name`,`supplier_phone`,`supplier_email`,`supplier_addres`) values (1,'Berkah Nusantara','021-4340194','',''),(4,'MASPION','084-9349-34','',''),(5,'PT. PANAROMA','089-987-345','','\r\n\r\n'),(6,'PT. PALAWIJA','031-234875','',''),(7,'WTC','0317908848','','WTC SURABAYA');

/*Table structure for table `transaction_details` */

DROP TABLE IF EXISTS `transaction_details`;

CREATE TABLE `transaction_details` (
  `transaction_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  `grand_total` bigint(20) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  PRIMARY KEY (`transaction_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

/*Data for the table `transaction_details` */

insert  into `transaction_details`(`transaction_detail_id`,`transaction_id`,`menu_id`,`qty`,`price`,`grand_total`,`satuan_id`) values (1,1,1,2,1500,3000,0),(2,2,2,2,2000,4000,0),(3,3,1,2,1500,3000,0),(4,4,1,2,1500,3000,0),(5,5,1,2,1500,3000,0),(6,6,1,2,1500,3000,0),(7,7,1,1,1500,1500,0),(8,8,1,2,1500,3000,0),(9,10,1,2,1500,3000,0),(10,11,2,22,2000,44000,0),(11,12,1,30,1500,45000,0),(12,13,1,2,1500,3000,0),(13,13,2,2,2000,4000,0),(14,14,1,120,1500,180000,0),(15,15,1,30,1500,45000,0),(16,16,1,2,1500,3000,0),(17,16,2,5,2000,10000,0),(18,17,1,5,2000,10000,0),(19,18,1,2,2000,4000,0),(20,20,1,2,2000,4000,0),(21,20,5,2,8000,16000,0),(22,20,2,2,2000,4000,0),(23,20,5,2,8000,16000,0),(24,20,1,55,2000,110000,0),(25,20,1,2,2000,4000,0),(26,22,1,2,2000,4000,0),(27,23,2,22,2000,44000,0),(28,24,1,120,2000,240000,0),(29,25,2,222,2000,444000,0),(30,26,1,50,2000,100000,0),(31,27,6,13,9000,117000,0),(32,28,6,2,9000,18000,0),(33,29,5,2,8000,16000,0),(34,30,5,3,8000,24000,0),(35,31,1,3,2000,6000,0),(36,32,1,7000,2000,14000000,0),(37,33,1,90,2000,180000,0),(38,34,1,34,5555,110660,0),(39,35,1,20,5555,111100,0),(40,35,1,2000,2000,4000000,0),(41,36,1,2000,5555,11110000,0),(42,38,1,100,2000,200000,0),(43,39,1,222,2000,444000,0),(44,40,1,123,2000,246000,0),(45,41,2,22,13000,286000,0),(46,41,5,12,1432,17184,0),(47,42,1,20,5555,111100,2),(48,43,1,90,5555,499950,2),(49,44,1,900,5555,4999500,2),(50,45,2,12,2000,24000,0),(51,48,1,1200,5555,6666000,2),(52,48,2,12,13000,156000,2),(53,49,5,12,1432,17184,3),(54,50,2,200,7000,1400000,3);

/*Table structure for table `transaction_details_item` */

DROP TABLE IF EXISTS `transaction_details_item`;

CREATE TABLE `transaction_details_item` (
  `transaction_details_item` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `transaction_detail_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `keterangan_item` int(11) NOT NULL,
  PRIMARY KEY (`transaction_details_item`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaction_details_item` */

/*Table structure for table `transaction_new_tmp` */

DROP TABLE IF EXISTS `transaction_new_tmp`;

CREATE TABLE `transaction_new_tmp` (
  `tnt_id` int(11) NOT NULL AUTO_INCREMENT,
  `table_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `tnt_price` int(11) NOT NULL,
  `tnt_discount` int(11) NOT NULL,
  `tnt_grand_price` int(11) NOT NULL,
  `tnt_qty` int(11) NOT NULL,
  `tnt_total` int(11) NOT NULL,
  PRIMARY KEY (`tnt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaction_new_tmp` */

/*Table structure for table `transaction_order_types` */

DROP TABLE IF EXISTS `transaction_order_types`;

CREATE TABLE `transaction_order_types` (
  `tot_id` int(11) NOT NULL AUTO_INCREMENT,
  `tot_name` varchar(100) NOT NULL,
  PRIMARY KEY (`tot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaction_order_types` */

/*Table structure for table `transaction_tmp_details` */

DROP TABLE IF EXISTS `transaction_tmp_details`;

CREATE TABLE `transaction_tmp_details` (
  `transaction_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `kategori` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `transaction_detail_original_price` bigint(11) NOT NULL,
  `transaction_detail_margin_price` bigint(11) NOT NULL,
  `transaction_detail_price` bigint(11) NOT NULL,
  `transaction_detail_price_discount` bigint(11) NOT NULL,
  `transaction_detail_grand_price` bigint(11) NOT NULL,
  `transaction_detail_qty_real` int(11) NOT NULL,
  `transaction_detail_qty` float NOT NULL,
  `transaction_detail_unit` int(11) NOT NULL,
  `transaction_detail_total` bigint(11) NOT NULL,
  `transaction_detail_status` int(11) NOT NULL,
  PRIMARY KEY (`transaction_detail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaction_tmp_details` */

/*Table structure for table `transactions` */

DROP TABLE IF EXISTS `transactions`;

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `branch_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `transaction_code` varchar(200) NOT NULL,
  `transaction_total` int(11) NOT NULL,
  `transaction_discount` int(11) NOT NULL,
  `disc_member` int(11) NOT NULL,
  `transaction_grand_total` int(11) NOT NULL,
  `transaction_payment` int(11) NOT NULL,
  `transaction_change` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `bank_account_number` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

/*Data for the table `transactions` */

insert  into `transactions`(`transaction_id`,`branch_id`,`member_id`,`transaction_date`,`transaction_code`,`transaction_total`,`transaction_discount`,`disc_member`,`transaction_grand_total`,`transaction_payment`,`transaction_change`,`payment_method_id`,`bank_id`,`bank_account_number`,`status`) values (1,1,1,'0000-00-00 00:00:00','11491546625',3000,0,0,3000,21000,18000,1,0,0,0),(2,1,1,'2017-04-07 00:00:00','11491546980',4000,0,0,4000,12000,8000,1,0,0,0),(3,1,1,'2017-04-07 12:04:00','11491547095',3000,0,0,3000,4000,1000,1,0,0,0),(4,1,1,'2017-04-07 12:04:00','11491547488',3000,0,0,3000,10000,7000,1,0,0,0),(5,1,1,'2017-04-07 12:04:00','11491547546',3000,0,0,3000,10000,7000,1,0,0,0),(6,1,1,'2017-04-07 12:04:00','11491547595',3000,0,0,3000,5000,2000,1,0,0,0),(7,1,1,'2017-04-07 12:04:00','11491547652',1500,0,0,1500,2000,500,1,0,0,0),(8,1,2,'2017-04-07 12:04:00','11491547732',3000,0,0,3000,0,0,1,0,0,0),(9,1,1,'2017-04-07 12:04:00','11491547969',0,0,0,0,0,0,1,0,0,0),(10,1,1,'2017-04-07 12:04:00','11491548012',3000,10,0,3000,20000,17000,1,0,0,0),(11,1,1,'2017-04-07 12:04:00','11491550343',44000,20,0,35200,40000,4800,1,0,0,0),(12,1,1,'2017-04-07 12:04:00','11491550714',45000,20,0,36000,40000,4000,1,0,0,0),(13,1,1,'2017-04-07 12:04:00','11491552031',7000,0,0,7000,10000,3000,1,0,0,0),(14,1,1,'2017-04-10 12:04:00','11491809116',180000,0,0,180000,230000,50000,1,0,0,0),(15,1,1,'2017-04-10 12:04:00','11491809993',45000,0,0,45000,50000,5000,1,0,0,0),(16,1,1,'2017-04-10 12:04:00','11491811978',13000,0,0,13000,13000,0,2,1,546781221,0),(17,1,1,'2017-04-18 12:04:00','11492525702',10,0,0,10000,50000,40000,1,0,0,0),(18,1,1,'2017-04-19 12:04:00','11492578185',4000,0,0,4000,0,0,1,0,0,0),(19,1,1,'2017-04-19 12:04:00','11492578253',0,0,0,0,0,0,1,0,0,0),(20,1,1,'2017-04-21 12:04:00','11492754230',0,0,0,0,0,0,1,0,0,0),(21,1,1,'2017-04-21 12:04:00','11492754259',0,0,0,0,0,0,1,0,0,0),(22,1,1,'2017-04-21 12:04:00','11492754281',4000,0,0,4000,5000,1000,1,0,0,0),(23,1,1,'2017-04-21 12:04:00','11492755124',44000,0,0,44000,50000,6000,5,0,0,2),(24,1,1,'2017-04-21 12:04:00','11492759365',240000,0,0,240000,50000,-190000,1,0,0,0),(25,1,1,'2017-04-21 12:04:00','11492759631',444000,0,0,444000,55555555,55111555,1,0,0,0),(26,1,1,'2017-04-21 12:04:00','11492761036',100000,0,0,100000,200000,100000,1,0,0,0),(27,1,1,'2017-04-21 12:04:00','11492761074',117000,0,0,117000,200000,83000,1,0,0,0),(28,1,1,'2017-04-10 12:04:00','11492761115',18000,0,0,18000,20000,2000,1,0,0,0),(29,1,1,'2017-04-15 12:04:00','11492761212',16000,0,0,16000,20000,4000,1,0,0,0),(30,1,1,'2017-04-15 12:04:00','11492761366',24000,0,0,24000,50000,26000,1,0,0,0),(31,1,1,'2017-04-25 12:04:00','11493090605',6000,5,0,5700,6000,300,5,0,0,1),(32,1,1,'2017-04-25 12:04:00','11493112059',14000000,10,0,12600000,12000000,-600000,1,0,0,0),(33,1,1,'2017-04-25 12:04:00','11493112127',180000,0,0,180000,80000,-100000,5,1,6789,1),(34,1,1,'2017-04-27 12:04:00','11493260018',110660,5,0,105127,200000,94873,1,0,0,0),(35,1,1,'2017-04-27 12:04:00','11493260222',4111100,0,0,4111100,5000000,888900,1,0,0,0),(36,1,1,'2017-04-27 12:04:00','11493261829',11110000,10,0,9999000,10000000,1000,1,0,0,0),(37,1,1,'2017-04-27 12:04:00','11493263096',0,0,0,0,0,0,1,0,0,0),(38,1,1,'2017-04-27 12:04:00','11493263995',200000,0,0,200000,300000,100000,1,0,0,0),(39,1,1,'2017-04-27 12:04:00','11493264045',444000,0,0,444000,515151,71151,1,0,0,0),(40,1,1,'2017-04-27 12:04:00','11493264210',246000,90,0,24600,50000,25400,1,0,0,0),(41,1,1,'2017-04-27 12:04:00','11493264272',303184,0,0,303184,320000,16816,1,0,0,0),(42,1,1,'2017-04-27 12:04:00','11493264582',111100,10,0,99990,100000,10,1,0,0,0),(43,1,1,'2017-04-28 12:04:00','11493347444',499950,0,0,499950,500000,50,1,0,0,0),(44,1,1,'2017-04-28 12:04:00','11493351228',4999500,0,0,4999500,5000000,500,1,0,0,0),(45,1,1,'2017-05-05 12:05:00','11493966264',24000,0,0,24000,25000,1000,1,0,0,0),(46,1,1,'2017-05-05 12:05:00','11493966273',0,0,0,0,12000,12000,1,0,0,0),(47,1,1,'2017-05-05 12:05:00','11493966311',0,0,0,0,12,12,1,0,0,0),(48,1,1,'2017-05-05 12:05:00','11493967305',6822000,0,0,6822000,7000000,178000,1,0,0,0),(49,1,1,'2017-05-05 12:05:00','11493967429',17184,0,0,17184,230,-16954,1,0,0,0),(50,1,1,'2017-05-05 12:05:00','11493972727',1400000,0,0,1400000,5000000,3600000,1,0,0,0);

/*Table structure for table `transactions_tmp` */

DROP TABLE IF EXISTS `transactions_tmp`;

CREATE TABLE `transactions_tmp` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `transaction_code` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `partner_id` int(11) NOT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transactions_tmp` */

/*Table structure for table `tutorial` */

DROP TABLE IF EXISTS `tutorial`;

CREATE TABLE `tutorial` (
  `tutorial_id` int(11) NOT NULL AUTO_INCREMENT,
  `tutorial_date` date NOT NULL,
  `tutorial_name` varchar(200) NOT NULL,
  `tutorial_video` text NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`tutorial_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tutorial` */

insert  into `tutorial`(`tutorial_id`,`tutorial_date`,`tutorial_name`,`tutorial_video`,`user_id`) values (9,'2017-04-07','CABANG','',1);

/*Table structure for table `uang_kasir` */

DROP TABLE IF EXISTS `uang_kasir`;

CREATE TABLE `uang_kasir` (
  `uang_kasir_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `uang_kasir_date` datetime NOT NULL,
  `nilai_uang_kasir` bigint(20) NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`uang_kasir_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `uang_kasir` */

insert  into `uang_kasir`(`uang_kasir_id`,`user_id`,`uang_kasir_date`,`nilai_uang_kasir`,`branch_id`) values (1,1,'2017-01-08 21:01:39',12000000,3),(2,1,'2017-01-08 21:01:28',120000,3),(3,1,'2017-01-20 09:01:04',0,3),(4,1,'2017-01-23 03:01:24',0,3),(5,11,'2017-02-01 08:02:02',0,1),(6,11,'2017-02-03 11:02:26',0,3),(7,1,'2017-02-04 06:02:08',0,3),(8,1,'2017-02-04 06:02:27',100000,3),(9,1,'2017-02-05 08:02:33',0,3),(10,1,'2017-02-05 13:02:03',0,3),(11,1,'2017-02-05 13:02:17',0,3),(12,1,'2017-02-05 16:02:11',1200000,3),(13,11,'2017-02-06 10:02:39',0,3),(14,1,'2017-02-08 07:02:35',0,3),(15,11,'2017-02-10 13:02:39',0,3),(16,11,'2017-02-21 16:02:14',0,3),(17,2,'2017-02-23 09:02:09',200000,3),(18,11,'2017-02-24 04:02:15',0,3),(19,1,'2017-02-25 13:02:24',0,3),(20,1,'2017-03-21 04:03:25',12312,3);

/*Table structure for table `user_types` */

DROP TABLE IF EXISTS `user_types`;

CREATE TABLE `user_types` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_name` varchar(200) NOT NULL,
  PRIMARY KEY (`user_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `user_types` */

insert  into `user_types`(`user_type_id`,`user_type_name`) values (1,'Administrator'),(2,'Owner'),(3,'Manager'),(4,'Cashier'),(5,'Waitress');

/*Table structure for table `user_typesz` */

DROP TABLE IF EXISTS `user_typesz`;

CREATE TABLE `user_typesz` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_name` varchar(200) NOT NULL,
  PRIMARY KEY (`user_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `user_typesz` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_id` int(11) NOT NULL,
  `user_login` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_code` varchar(100) NOT NULL,
  `user_phone` varchar(100) NOT NULL,
  `user_img` text NOT NULL,
  `user_active_status` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `user_desc` varchar(200) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`user_id`,`user_type_id`,`user_login`,`user_password`,`user_name`,`user_code`,`user_phone`,`user_img`,`user_active_status`,`branch_id`,`user_desc`) values (1,1,'admin','fe01ce2a7fbac8fafaed7c982a04e229','admin','','747473773673','1490170725_user.png',1,1,''),(2,1,'admin2','fe01ce2a7fbac8fafaed7c982a04e229','admin2','','1212','',1,2,''),(3,1,'admin3','fe01ce2a7fbac8fafaed7c982a04e229','admin3','','221312312','',1,3,'');

/* Trigger structure for table `angsuran_kredit` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `update_kredit` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `update_kredit` BEFORE INSERT ON `angsuran_kredit` FOR EACH ROW BEGIN
     
	DECLARE piutang INT;
	DECLARE t_code VARCHAR(200);
	
	UPDATE kredit SET transaction_piutang = transaction_piutang-new.angsuran_payment WHERE kredit_id = new.kredit_id;
	SET piutang = (SELECT transaction_piutang FROM kredit WHERE kredit_id = new.kredit_id);
	SET t_code = (SELECT transaction_code FROM kredit WHERE kredit_id = new.kredit_id);
	IF (piutang=0)
		THEN
		UPDATE kredit SET STATUS = 2 WHERE kredit_id = new.kredit_id;
		UPDATE transactions SET STATUS = 2 WHERE transaction_code = t_code;
	END IF;
    END */$$


DELIMITER ;

/* Trigger structure for table `transactions` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `add_kredit` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `add_kredit` AFTER INSERT ON `transactions` FOR EACH ROW BEGIN
    DECLARE sisa_piutang INTEGER;
	SET sisa_piutang = NEW.transaction_grand_total - NEW.transaction_payment;
	IF (new.payment_method_id = 5)
	THEN
		INSERT INTO tahu.kredit VALUES (
					'',
					NEW.transaction_code,
					NEW.transaction_grand_total,
					NEW.transaction_payment,
					sisa_piutang,
					NEW.branch_id,
					0
					);			
					
    END IF;
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
