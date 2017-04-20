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

insert  into `branches`(`branch_id`,`branch_name`,`branch_img`,`branch_desc`,`branch_address`,`branch_phone`,`branch_city`) values (1,'CABANG 1','1491463963_1491207459_1.png','','','0989906','SURABAYA'),(2,'CABANG 2','','','','0',''),(3,'CABANG 3','1491464041_1490170813_Name-tag-admin-1000.png','','','123123','PADANG');

/*Table structure for table `item_stocks` */

DROP TABLE IF EXISTS `item_stocks`;

CREATE TABLE `item_stocks` (
  `item_stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `item_stock_qty` float NOT NULL,
  `branch_id` int(11) NOT NULL,
  PRIMARY KEY (`item_stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `item_stocks` */

insert  into `item_stocks`(`item_stock_id`,`item_id`,`item_stock_qty`,`branch_id`) values (1,0,55,3),(2,2,20,2),(3,1,24.4,1);

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

insert  into `items`(`item_id`,`item_name`,`satuan_utama`,`item_kategori`,`item_limit`,`item_hpp_price`,`item_img`) values (1,'Stock',1,'1',11,110000,''),(2,'stock 1',2,'2',22,5500,''),(3,'ea',1,'2',12,1000,''),(4,'Tahu segitiga',1,'3',21,1200,''),(16,'asd',2,'3',12,25000,''),(17,'sadsad',1,'1',12,12312,'1491462896_default.png');

/*Table structure for table `journal_types` */

DROP TABLE IF EXISTS `journal_types`;

CREATE TABLE `journal_types` (
  `journal_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `journal_type_name` varchar(200) NOT NULL,
  PRIMARY KEY (`journal_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `journal_types` */

insert  into `journal_types`(`journal_type_id`,`journal_type_name`) values (1,'Penjualan'),(2,'Pembelian'),(3,'Pemasukan lainnya'),(4,'Pengeluaran lainnya');

/*Table structure for table `journals` */

DROP TABLE IF EXISTS `journals`;

CREATE TABLE `journals` (
  `journal_id` int(11) NOT NULL AUTO_INCREMENT,
  `journal_type_id` int(11) NOT NULL,
  `data_id` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `journals` */

insert  into `journals`(`journal_id`,`journal_type_id`,`data_id`,`data_url`,`journal_debit`,`journal_credit`,`journal_piutang`,`journal_hutang`,`journal_desc`,`journal_date`,`payment_method`,`bank_id`,`bank_account`,`bank_id_to`,`bank_account_to`,`user_id`,`branch_id`) values (1,2,0,'purchase.php?page=form&id=',0,30000,0,0,'','2017-04-03',0,0,0,0,0,1,3),(2,2,38,'purchase.php?page=form&id=',0,30000,0,0,'','2017-04-11',0,0,0,0,0,1,2),(3,2,39,'purchase.php?page=form&id=',0,32000,0,0,'','2017-04-11',0,0,0,0,0,1,1),(4,2,0,'purchase.php?page=form&id=',0,41000,0,0,'','2017-04-19',0,0,0,0,0,1,1),(5,0,0,'',0,53000,0,0,'','0000-00-00',0,0,0,0,0,0,0);

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `kategori` */

insert  into `kategori`(`kategori_id`,`kategori_name`) values (1,'Kategori 1'),(2,'Kategori 2'),(3,'Kategori 3');

/*Table structure for table `keranjang` */

DROP TABLE IF EXISTS `keranjang`;

CREATE TABLE `keranjang` (
  `keranjang_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  `qty` bigint(20) NOT NULL,
  `total` bigint(20) NOT NULL,
  PRIMARY KEY (`keranjang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `keranjang` */

insert  into `keranjang`(`keranjang_id`,`transaction_id`,`menu_id`,`price`,`qty`,`total`) values (9,17,2,2000,22,44000),(10,0,0,0,2,0),(11,0,0,0,1,0);

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `konversi_item` */

insert  into `konversi_item`(`konversi_id`,`item_id`,`satuan_utama`,`jumlah`,`satuan_konversi`,`jumlah_satuan_konversi`) values (27,1,1,1,2,10),(28,1,1,100,3,50),(31,2,2,10,1,1);

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

insert  into `members`(`member_id`,`member_name`,`member_phone`,`member_address`,`member_email`) values (1,'Wakwaw','123213','Mana Saja','wadaw@jimel.com'),(2,'Wadaw','0987271','Jl raya','awdw@yahu.kom');

/*Table structure for table `menu_recipes` */

DROP TABLE IF EXISTS `menu_recipes`;

CREATE TABLE `menu_recipes` (
  `menu_recipe_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `item_qty` bigint(11) NOT NULL,
  PRIMARY KEY (`menu_recipe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `menu_recipes` */

insert  into `menu_recipes`(`menu_recipe_id`,`menu_id`,`item_id`,`item_qty`) values (1,1,1,5),(2,2,2,2),(4,1,2,2),(6,0,2,3),(7,0,2,4),(8,0,3,5),(9,0,4,2),(10,0,4,3),(11,0,4,3),(12,1,16,5);

/*Table structure for table `menu_stock` */

DROP TABLE IF EXISTS `menu_stock`;

CREATE TABLE `menu_stock` (
  `menu_stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `menu_stock_qty` int(11) NOT NULL,
  PRIMARY KEY (`menu_stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `menu_stock` */

insert  into `menu_stock`(`menu_stock_id`,`menu_id`,`branch_id`,`menu_stock_qty`) values (1,1,1,228),(2,2,1,37);

/*Table structure for table `menus` */

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_kategori` int(11) NOT NULL,
  `menu_name` varchar(200) NOT NULL,
  `menu_original_price` bigint(200) NOT NULL,
  `menu_price` bigint(20) NOT NULL,
  `menu_img` text NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `menus` */

insert  into `menus`(`menu_id`,`menu_kategori`,`menu_name`,`menu_original_price`,`menu_price`,`menu_img`) values (1,1,'Tahu Bulat',500,1500,'1491469780_default.png'),(2,2,'Tahu Kotak',1000,2000,'1491469788_default.png'),(3,1,'dsasd',112312,131212,'');

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

insert  into `office`(`office_id`,`office_name`,`office_img`,`office_desc`,`office_address`,`office_phone`,`office_email`,`office_city`,`office_owner`,`office_owner_phone`,`office_owner_address`,`office_owner_email`) values (1,'TAHU','1486196649_twiin.jpg','','																																													JL. RAYA LONTAR 226 SURABAYA																																																								','','twoinone@gmail.com','SURABAYA','Danu Ariska','0856-343-423','Surabaya','danuariksa@gmail.com');

/*Table structure for table `payment_methods` */

DROP TABLE IF EXISTS `payment_methods`;

CREATE TABLE `payment_methods` (
  `payment_method_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_method_name` varchar(100) NOT NULL,
  PRIMARY KEY (`payment_method_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `payment_methods` */

insert  into `payment_methods`(`payment_method_id`,`payment_method_name`) values (1,'CASH'),(2,'DEBIT'),(3,'TRANSFER'),(4,'KREDIT'),(5,'ANGSURAN');

/*Table structure for table `permits` */

DROP TABLE IF EXISTS `permits`;

CREATE TABLE `permits` (
  `permit_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_id` int(11) NOT NULL,
  `side_menu_id` int(11) NOT NULL,
  `permit_acces` varchar(10) NOT NULL,
  PRIMARY KEY (`permit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3050 DEFAULT CHARSET=latin1;

/*Data for the table `permits` */

insert  into `permits`(`permit_id`,`user_type_id`,`side_menu_id`,`permit_acces`) values (409,28,1,'c,r,u,d'),(410,28,2,'c,r,u,d'),(411,28,3,'c,r,u,d'),(412,28,4,'c,r,u,d'),(413,28,5,'c,r,u,d'),(414,28,6,'c,r,u,d'),(415,28,7,'c,r,u,d'),(416,28,8,'c,r,u,d'),(417,28,9,'c,r,u,d'),(418,28,10,'c,r,u,d'),(419,28,11,'c,r,u,d'),(420,28,12,'c,r,u,d'),(421,28,13,'c,r,u,d'),(422,28,14,'c,r,u,d'),(423,28,15,'c,r,u,d'),(424,28,16,'c,r,u,d'),(425,28,17,'c,r,u,d'),(426,28,18,'c,r,u,d'),(427,28,19,'c,r,u,d'),(428,28,20,'c,r,u,d'),(429,28,21,'c,r,u,d'),(430,28,22,'c,r,u,d'),(431,28,23,'c,r,u,d'),(432,28,24,'c,r,u,d'),(481,2,1,'c,r,u,d'),(482,2,2,'c,r,u,d'),(483,2,3,'c,r,u,d'),(484,2,4,'c,r,u,d'),(485,2,5,'c,r,u,d'),(486,2,6,'c,r,u,d'),(487,2,7,'c,r,u,d'),(488,2,8,'c,r,u,d'),(489,2,9,'c,r,u,d'),(490,2,10,'c,r,u,d'),(491,2,11,'c,r,u,d'),(492,2,12,'c,r,u,d'),(493,2,13,'c,r,u,d'),(494,2,14,'c,r,u,d'),(495,2,15,'c,r,u,d'),(496,2,16,'c,r,u,d'),(497,2,17,'c,r,u,d'),(498,2,18,'c,r,u,d'),(499,2,19,'c,r,u,d'),(500,2,20,'c,r,u,d'),(501,2,21,'c,r,u,d'),(502,2,22,'c,r,u,d'),(503,2,23,'c,r,u,d'),(504,2,24,'c,r,u,d'),(505,4,1,'c,r,u,d'),(506,4,2,'c,r,u,d'),(507,4,3,'c,r,u,d'),(508,4,4,'c,r,u,d'),(509,4,5,'c,r,u,d'),(510,4,6,'c,r,u,d'),(511,4,7,'c,r,u,d'),(512,4,8,'c,r,u,d'),(513,4,9,'c,r,u,d'),(514,4,10,'c,r,u,d'),(515,4,11,'c,r,u,d'),(516,4,12,'c,r,u,d'),(517,4,13,'c,r,u,d'),(518,4,14,'c,r,u,d'),(519,4,15,'c,r,u,d'),(520,4,16,'c,r,u,d'),(521,4,17,'c,r,u,d'),(522,4,18,'c,r,u,d'),(523,4,19,'c,r,u,d'),(524,4,20,'c,r,u,d'),(525,4,21,'c,r,u,d'),(526,4,22,'c,r,u,d'),(527,4,23,'c,r,u,d'),(528,4,24,'c,r,u,d'),(3013,1,1,'0'),(3014,1,2,'0'),(3015,1,3,'0'),(3016,1,4,'0'),(3017,1,5,'0'),(3018,1,6,'0'),(3019,1,7,'0'),(3020,1,8,'c,r,u,d'),(3021,1,9,'c,r,u,d'),(3022,1,10,'c,r,u,d'),(3023,1,11,'c,r,u,d'),(3024,1,18,'c,r,u,d'),(3025,1,20,'c,r,u,d'),(3026,1,21,'c,r,u,d'),(3027,1,22,'c,r,u,d'),(3028,1,23,''),(3029,1,24,''),(3030,1,25,'c,r,u,d'),(3031,1,26,'c,r,u,d'),(3032,1,27,'c,r,u,d'),(3033,1,28,'0'),(3034,1,29,''),(3035,1,30,''),(3036,1,31,'c,r,u,d'),(3037,1,32,'c,r,u,d'),(3038,1,33,'c,r,u,d'),(3039,1,34,''),(3040,1,35,''),(3041,1,36,''),(3042,1,37,''),(3043,1,41,''),(3044,1,42,''),(3045,1,43,'c,r,u,d'),(3046,1,44,'c,r,u,d'),(3047,1,45,'c,r,u,d'),(3048,1,46,'c,r,u,d'),(3049,1,47,'c,r,u,d');

/*Table structure for table `produksi` */

DROP TABLE IF EXISTS `produksi`;

CREATE TABLE `produksi` (
  `produksi_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `produksi_date` datetime NOT NULL,
  `produksi_code` varchar(100) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`produksi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `produksi` */

insert  into `produksi`(`produksi_id`,`menu_id`,`branch_id`,`produksi_date`,`produksi_code`,`satuan_id`,`qty`) values (23,1,1,'2017-04-17 09:04:30','11492415970',1,22),(24,1,1,'2017-04-17 10:04:40','11492416280',1,22),(25,1,1,'2017-04-17 10:04:49','11492416289',1,22);

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Data for the table `purchases` */

insert  into `purchases`(`purchase_id`,`purchase_date`,`purchase_code`,`item_id`,`purchase_price`,`purchase_qty`,`purchase_total`,`user_id`,`supplier_id`,`branch_id`,`satuan_konversi`) values (32,'2017-03-24','11490328461',4,1000,2,2000,1,1,3,0),(33,'2017-03-24','11490344743',8,12000,2,0,1,1,3,0),(34,'2017-03-24','11490344855',4,2000,2,4000,1,1,3,0),(35,'2017-03-29','11490779847',4,12,1,0,1,1,3,0),(36,'2017-04-03','11491194196',4,20000,12,240000,1,1,3,0),(37,'2017-04-03','11491201954',4,12000,2,24000,1,1,3,0),(38,'2017-04-11','11491885160',2,25000,20,500000,1,1,2,0),(39,'2017-04-11','11491885206',1,2200,50,110000,1,4,1,0),(40,'2017-04-19','11492568658',1,12000,14,168000,1,1,1,2);

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

insert  into `satuan`(`satuan_id`,`satuan_name`) values (1,'Besar'),(2,'Kecil'),(3,'Sedang');

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
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

/*Data for the table `side_menus` */

insert  into `side_menus`(`side_menu_id`,`side_menu_name`,`side_menu_url`,`side_menu_parent`,`side_menu_icon`,`side_menu_level`,`side_menu_type_parent`) values (1,'Dashboard','home.php',0,'fa fa-tachometer',1,0),(2,'Master','#',0,'fa fa-edit',1,0),(3,'Order','penjualan.php',0,'fa fa-cutlery',1,0),(4,'Transaksi','#',0,'fa fa-shopping-cart',1,0),(5,'Accounting','#',0,'fa fa-list-alt',1,0),(6,'Laporan','#',0,'fa fa-book',1,0),(7,'Setting','#',0,'fa fa-cog',1,0),(8,'Tutorial','tutorial.php',0,'fa fa-video-camera',1,1),(9,'Cabang','branch.php',2,'',2,1),(10,'Stock','stock_master.php',2,'',2,1),(11,'Penyesuaian Stock','penyesuaian_stock.php',2,'',2,1),(18,'Kategori','kategori.php',2,'',2,1),(20,'Supplier','supplier.php',2,'',2,1),(21,'Bank','bank.php',2,'',2,1),(22,'Pembelian','purchase.php',4,'',2,1),(23,'Angsuran Piutang / Kredit','#',0,'',2,1),(24,'Angsuran Hutang','#',0,'',2,1),(25,'Arus Kas','arus_kas.php',5,'',2,1),(26,'Pemasukan Dan Pengeluaran Lainnya','jurnal_umum.php',5,'',2,1),(27,'Laporan Detail','report_detail.php',6,'',2,1),(28,'Laporan Harian','#',0,'',0,0),(29,'Laporan Piutang','#',6,'',2,1),(30,'Laporan hutang','#',6,'',2,1),(31,'Profil','office.php',7,'',2,1),(32,'User','user.php',7,'',2,1),(33,'Type User','user_type.php',7,'',2,1),(34,'Retur penjualan','#',4,'',2,1),(35,'Retur pembelian','#',4,'',2,1),(36,'Laporan retur penjualan','#',6,'',2,1),(37,'Laporan retur pembelian','#',6,'',2,1),(41,'Laporan Uang Kasir','#',6,'',2,1),(42,'Laporan Hapus Transaksi','#',6,'',2,1),(43,'Menu','menu.php',2,'',2,1),(44,'Member','member.php',2,'',2,1),(45,'Satuan','satuan.php',2,'',2,1),(46,'Produksi','produksi.php',2,'',2,1),(47,'Menu Stock','menustock.php',2,'',2,1);

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
  PRIMARY KEY (`transaction_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `transaction_details` */

insert  into `transaction_details`(`transaction_detail_id`,`transaction_id`,`menu_id`,`qty`,`price`,`grand_total`) values (1,1,1,2,1500,3000),(2,2,2,2,2000,4000),(3,3,1,2,1500,3000),(4,4,1,2,1500,3000),(5,5,1,2,1500,3000),(6,6,1,2,1500,3000),(7,7,1,1,1500,1500),(8,8,1,2,1500,3000),(9,10,1,2,1500,3000),(10,11,2,22,2000,44000),(11,12,1,30,1500,45000),(12,13,1,2,1500,3000),(13,13,2,2,2000,4000),(14,14,1,120,1500,180000),(15,15,1,30,1500,45000),(16,16,1,2,1500,3000),(17,16,2,5,2000,10000);

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

/*Table structure for table `transaction_histories` */

DROP TABLE IF EXISTS `transaction_histories`;

CREATE TABLE `transaction_histories` (
  `transaction_id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `transaction_total` int(11) NOT NULL,
  `transaction_discount` int(11) NOT NULL,
  `transaction_grand_total` int(11) NOT NULL,
  `transaction_payment` int(11) NOT NULL,
  `transaction_change` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bank_account_number` varchar(100) NOT NULL,
  `transaction_code` int(11) NOT NULL,
  `user_delete` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `transaction_histories` */

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
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `transactions` */

insert  into `transactions`(`transaction_id`,`branch_id`,`member_id`,`transaction_date`,`transaction_code`,`transaction_total`,`transaction_discount`,`disc_member`,`transaction_grand_total`,`transaction_payment`,`transaction_change`,`payment_method_id`,`bank_id`,`bank_account_number`) values (1,1,1,'0000-00-00 00:00:00','11491546625',3000,0,0,3000,21000,18000,1,0,0),(2,1,1,'2017-04-07 00:00:00','11491546980',4000,0,0,4000,12000,8000,1,0,0),(3,1,1,'2017-04-07 12:04:00','11491547095',3000,0,0,3000,4000,1000,1,0,0),(4,1,1,'2017-04-07 12:04:00','11491547488',3000,0,0,3000,10000,7000,1,0,0),(5,1,1,'2017-04-07 12:04:00','11491547546',3000,0,0,3000,10000,7000,1,0,0),(6,1,1,'2017-04-07 12:04:00','11491547595',3000,0,0,3000,5000,2000,1,0,0),(7,1,1,'2017-04-07 12:04:00','11491547652',1500,0,0,1500,2000,500,1,0,0),(8,1,2,'2017-04-07 12:04:00','11491547732',3000,0,0,3000,0,0,1,0,0),(9,1,1,'2017-04-07 12:04:00','11491547969',0,0,0,0,0,0,1,0,0),(10,1,1,'2017-04-07 12:04:00','11491548012',3000,10,0,3000,20000,17000,1,0,0),(11,1,1,'2017-04-07 12:04:00','11491550343',44000,20,0,35200,40000,4800,1,0,0),(12,1,1,'2017-04-07 12:04:00','11491550714',45000,20,0,36000,40000,4000,1,0,0),(13,1,1,'2017-04-07 12:04:00','11491552031',7000,0,0,7000,10000,3000,1,0,0),(14,1,1,'2017-04-10 12:04:00','11491809116',180000,0,0,180000,230000,50000,1,0,0),(15,1,1,'2017-04-10 12:04:00','11491809993',45000,0,0,45000,50000,5000,1,0,0),(16,1,1,'2017-04-10 12:04:00','11491811978',13000,0,0,13000,13000,0,2,1,546781221);

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

/* Trigger structure for table `produksi` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `mengurangi_item` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `mengurangi_item` AFTER INSERT ON `produksi` FOR EACH ROW BEGIN
	UPDATE item_stocks SET item_stock_qty = item_stock_qty - (menu_recipes.menu_id * produksi.qty)
	WHERE menu_id = NEW.menu_id;
    END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
