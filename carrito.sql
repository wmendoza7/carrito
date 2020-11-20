/*
SQLyog Community v13.1.5  (64 bit)
MySQL - 10.4.11-MariaDB : Database - carrito
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`carrito` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `carrito`;

/*Table structure for table `carrito` */

DROP TABLE IF EXISTS `carrito`;

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `carrito` */

/*Table structure for table `productos` */

DROP TABLE IF EXISTS `productos`;

CREATE TABLE `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) NOT NULL,
  `precio` double NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `inventario` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `productos` */

insert  into `productos`(`id`,`nombre`,`precio`,`imagen`,`inventario`,`estado`) values 
(1,'Harry Potter y la camara secreta ',60,'1605828809.jpg',17,1),
(2,'Harry Potter y la piedra filosofal',20,'1605828796.jpg',0,1),
(3,'Harry Potter y la orden del fenix',50,'1605828667.jpg',17,1),
(4,'hp3.jpg',50,'1605805347.jpg',20,0);

/*Table structure for table `productos_venta` */

DROP TABLE IF EXISTS `productos_venta`;

CREATE TABLE `productos_venta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  `precio` double NOT NULL,
  `subtotal` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `productos_venta` */

insert  into `productos_venta`(`id`,`id_venta`,`id_producto`,`cantidad`,`precio`,`subtotal`) values 
(1,1,1,1,60,60),
(2,1,2,1,20,20),
(3,2,2,2,20,40),
(4,2,1,5,60,300),
(5,3,1,5,60,300),
(6,4,1,5,60,300),
(7,4,2,1,20,20),
(8,6,1,1,60,60),
(9,7,1,1,60,60),
(10,7,2,1,20,20),
(11,8,1,1,60,60),
(12,8,2,1,20,20),
(13,9,2,1,20,20),
(14,9,1,6,60,360),
(15,10,1,1,60,60),
(16,11,3,3,50,150),
(17,11,1,2,60,120);

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `telefono` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nivel` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `usuario` */

insert  into `usuario`(`id`,`nombre`,`telefono`,`email`,`password`,`nivel`) values 
(1,'Wilmar Mendoza','3057244867','wilmar.mendoza@uac.edu.co','deff9e4bb53b2eccbd4eba157430f50b','admin'),
(5,'Juan','3222222','juan@hotmail.com','c7f626ad40317f4dc7b295c6f04c850d','cliente');

/*Table structure for table `ventas` */

DROP TABLE IF EXISTS `ventas`;

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `total` double NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `ventas` */

insert  into `ventas`(`id`,`id_usuario`,`total`,`fecha`) values 
(1,1,80,'2020-11-18 11:11:35'),
(2,1,340,'2020-11-19 01:11:55'),
(3,1,320,'2020-11-19 01:11:48'),
(4,1,320,'2020-11-19 01:11:33'),
(5,1,0,'2020-11-19 01:11:11'),
(6,1,80,'2020-11-19 01:11:30'),
(7,1,80,'2020-11-19 01:11:58'),
(8,1,80,'2020-11-19 01:11:28'),
(9,1,380,'2020-11-19 01:11:55'),
(10,1,60,'2020-11-19 03:11:30'),
(11,5,270,'2020-11-20 12:11:07');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
