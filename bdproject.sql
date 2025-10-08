# Host: localhost  (Version 5.5.5-10.4.32-MariaDB)
# Date: 2025-10-02 16:00:53
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "maintenance"
#

DROP TABLE IF EXISTS `maintenance`;
CREATE TABLE `maintenance` (
  `idMaintenance` int(11) NOT NULL AUTO_INCREMENT,
  `idMotorcycle` int(11) DEFAULT NULL,
  `idMechanic` int(11) DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `partsUsed` text DEFAULT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `maintenanceDate` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idMaintenance`),
  KEY `idMotorcycle` (`idMotorcycle`),
  KEY `idMechanic` (`idMechanic`),
  CONSTRAINT `maintenance_ibfk_1` FOREIGN KEY (`idMotorcycle`) REFERENCES `motorcycle` (`idMotorcycle`),
  CONSTRAINT `maintenance_ibfk_2` FOREIGN KEY (`idMechanic`) REFERENCES `mechanic` (`idMechanic`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# Data for table "maintenance"
#

INSERT INTO `maintenance` VALUES (1,1,1,'Mantenimiento realizado\n',NULL,120.00,1,'2025-06-07 23:16:15','2025-06-07 23:59:14');

#
# Structure for table "store"
#

DROP TABLE IF EXISTS `store`;
CREATE TABLE `store` (
  `idPart` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `price` decimal(10,2) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `registrationDate` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idPart`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# Data for table "store"
#

INSERT INTO `store` VALUES (1,'Filtro de Aceite Honda CB500X','Filtros',50,15.99,1,'2025-06-03 21:19:40','2025-06-03 21:36:38','2025-06-03 21:36:38'),(2,'Pastillas de Freno Delanteras Kawasaki Z900','Frenos',30,45.50,1,'2025-06-03 21:19:40','2025-06-03 21:36:38','2025-06-03 21:36:38'),(3,'Neumático Trasero Michelin Pilot Road 5 180/55ZR17','Neumáticos',15,180.00,1,'2025-06-03 21:19:40','2025-06-03 21:36:38','2025-06-03 21:36:38'),(4,'Bujía NGK Iridium CR9EIX','Encendido',100,12.75,1,'2025-06-03 21:19:40','2025-06-03 21:36:38','2025-06-03 21:36:38'),(5,'Aceite de Motor Motul 7100 4T 10W-40 1L','Lubricantes',80,18.20,1,'2025-06-03 21:19:40','2025-06-03 21:36:38','2025-06-03 21:36:38'),(6,'Cadena DID 520VX3 X-Ring 120 eslabones','Transmisión',20,95.00,1,'2025-06-03 21:19:40','2025-06-03 21:36:38','2025-06-03 21:36:38'),(7,'Kit de Arrastre Yamaha MT-07','Transmisión',10,150.00,1,'2025-06-03 21:19:40','2025-06-03 21:36:38','2025-06-03 21:36:38'),(8,'Líquido de Frenos DOT 4 Castrol','Lubricantes',60,8.99,1,'2025-06-03 21:19:40','2025-06-03 21:36:38','2025-06-03 21:36:38'),(9,'Batería Yuasa YTX12-BS','Electricidad',25,75.00,1,'2025-06-03 21:19:40','2025-06-03 21:36:38','2025-06-03 21:36:38'),(10,'Maneta de Embrague Universal','Controles',40,22.00,1,'2025-06-03 21:19:40','2025-06-03 21:36:38','2025-06-03 21:36:38'),(11,'Filtro de Aire K&N Suzuki GSX-R600','Filtros',18,70.00,1,'2025-06-03 21:19:40','2025-06-03 21:36:38','2025-06-03 21:36:38'),(12,'Espejo Retrovisor Izquierdo Universal','Accesorios',35,18.50,1,'2025-06-03 21:19:40','2025-06-03 21:36:38','2025-06-03 21:36:38'),(13,'Pastillas de Freno Traseras BMW R1200GS','Frenos',28,38.00,1,'2025-06-03 21:19:40','2025-06-03 21:36:38','2025-06-03 21:36:38'),(14,'Bombilla H4 LED para Faro','Electricidad',55,29.99,1,'2025-06-03 21:19:40','2025-06-03 21:36:38','2025-06-03 21:36:38'),(15,'Kit de Reparación de Pinchazos para Neumáticos','Herramientas',40,25.00,1,'2025-06-03 21:19:40','2025-06-03 21:36:38','2025-06-03 21:36:38'),(16,'Limpiador de Cadenas Motorex','Químicos',70,9.50,1,'2025-06-03 21:19:40','2025-06-03 21:36:38','2025-06-03 21:36:38'),(17,'Grasa para Cadenas Repsol','Químicos',65,11.20,1,'2025-06-03 21:19:40','2025-06-03 21:36:38','2025-06-03 21:36:38'),(18,'Guantes de Taller Talla L','Equipamiento',90,7.00,1,'2025-06-03 21:19:40','2025-06-03 21:36:38','2025-06-03 21:36:38'),(19,'Caballete Trasero Universal','Herramientas',12,60.00,1,'2025-06-03 21:19:40','2025-06-03 21:36:38','2025-06-03 21:36:38'),(20,'Kit de Herramientas Básicas para Moto','Herramientas',20,40.00,1,'2025-06-03 21:19:40','2025-06-03 21:36:38','2025-06-03 21:36:38');

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) NOT NULL DEFAULT '',
  `lastName` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL DEFAULT '',
  `role` enum('admin','mechanic','client','others') NOT NULL DEFAULT 'client',
  `address` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `updateDate` datetime DEFAULT NULL,
  `registrationDate` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idUser`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# Data for table "user"
#

INSERT INTO `user` VALUES (1,'ROGER','NINA','rogernina8823@gmail.com','68463106','$2y$12$p2dG1IT1FtWZ/Hry7WVkDu0xzA32o7fyPpw.Yr9k60iBGURJ0tA5m','admin','Barrio 1ro de Mayo',1,'2025-06-02 08:06:26','2025-05-31 20:42:23','2025-06-01 20:07:41','2025-06-02 08:06:26'),(2,'JACOB','THOMAS','jacob@gmail.com','60748013','$2y$12$SFZ8ypm2fR54fK2uFTUT2eiGoj7PqFEBljJLV4jw7a70Fy1NzRmuO','mechanic','Barrio 1ro de mayo',1,'2025-06-01 19:14:14','2025-06-01 18:08:09','2025-06-01 18:08:09','2025-06-01 21:14:14'),(3,'PAMELA','SANTOS','pam@gmail.com','75936908','$2y$12$axVWNWMiNI0Ir.9Qv1bf7erEVCUyd0vtZeSy5d.EZbxzFfr8ggnkq','client','Av Blanco Galindo KM 5',1,'2025-06-02 08:03:02','2025-06-01 18:24:44','2025-06-01 18:24:44','2025-07-29 04:16:50'),(4,'ESTHER','IZQUIERDO','esther@gmail.com','73750063','$2y$12$ulUY9ePLrarRZKBIpC7Cy.xMSeMgmMnjFSApX0Owzmh1ZiuxU7C/C','client','Barrio 1ro de mayo',1,'2025-06-02 07:27:12','2025-06-02 07:25:42','2025-06-02 07:25:42','2025-06-02 07:27:12');

#
# Structure for table "motorcycle"
#

DROP TABLE IF EXISTS `motorcycle`;
CREATE TABLE `motorcycle` (
  `idMotorcycle` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `licensePlate` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idMotorcycle`),
  UNIQUE KEY `licensePlate` (`licensePlate`),
  KEY `idUser` (`idUser`),
  CONSTRAINT `motorcycle_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# Data for table "motorcycle"
#

INSERT INTO `motorcycle` VALUES (1,1,'YANFER','CAFE RAICER 250cc',2020,'5903-PYF',1,'2025-06-03 19:45:50','2025-06-03 18:09:36'),(2,2,'YANFER','CAFE RACER',2021,'5968-PFR',1,'2025-06-03 17:46:03','2025-07-28 12:55:23');

#
# Structure for table "reservation"
#

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE `reservation` (
  `idReservation` int(11) NOT NULL AUTO_INCREMENT,
  `idMotorcycle` int(11) DEFAULT NULL,
  `reservationDate` date DEFAULT NULL,
  `reservationTime` time DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `notes` text DEFAULT NULL,
  `creationDate` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`idReservation`),
  KEY `idMotorcycle` (`idMotorcycle`),
  CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`idMotorcycle`) REFERENCES `motorcycle` (`idMotorcycle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# Data for table "reservation"
#


#
# Structure for table "mechanic"
#

DROP TABLE IF EXISTS `mechanic`;
CREATE TABLE `mechanic` (
  `idMechanic` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) DEFAULT NULL,
  `professionalTitle` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idMechanic`),
  UNIQUE KEY `idUser` (`idUser`),
  CONSTRAINT `mechanic_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# Data for table "mechanic"
#

INSERT INTO `mechanic` VALUES (1,1,'TECNICO SUPERIOR MECANICA AUTOMOTRIZ');

#
# Structure for table "sale"
#

DROP TABLE IF EXISTS `sale`;
CREATE TABLE `sale` (
  `idSale` int(11) NOT NULL AUTO_INCREMENT,
  `idUser` int(11) DEFAULT NULL,
  `idMechanic` int(11) DEFAULT NULL,
  `saleDate` datetime DEFAULT current_timestamp(),
  `total` decimal(10,2) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`idSale`),
  KEY `idUser` (`idUser`),
  KEY `idMechanic` (`idMechanic`),
  CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`),
  CONSTRAINT `sale_ibfk_2` FOREIGN KEY (`idMechanic`) REFERENCES `mechanic` (`idMechanic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# Data for table "sale"
#


#
# Structure for table "detail"
#

DROP TABLE IF EXISTS `detail`;
CREATE TABLE `detail` (
  `idDetail` int(11) NOT NULL AUTO_INCREMENT,
  `idSale` int(11) DEFAULT NULL,
  `idPart` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unitPrice` decimal(10,2) DEFAULT NULL,
  `totalPrice` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`idDetail`),
  KEY `idSale` (`idSale`),
  KEY `detail_ibfk_2` (`idPart`),
  CONSTRAINT `detail_ibfk_1` FOREIGN KEY (`idSale`) REFERENCES `sale` (`idSale`),
  CONSTRAINT `detail_ibfk_2` FOREIGN KEY (`idPart`) REFERENCES `store` (`idPart`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

#
# Data for table "detail"
#

