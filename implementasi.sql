# Host: localhost  (Version 5.5.5-10.1.38-MariaDB)
# Date: 2020-10-10 12:56:31
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "asisten"
#

CREATE TABLE `asisten` (
  `Id_asisten` varchar(11) NOT NULL DEFAULT '',
  `nama_asisten` varchar(255) NOT NULL DEFAULT '',
  `status_asisten` int(1) NOT NULL DEFAULT '0',
  `photo_asisten` varchar(255) DEFAULT '',
  PRIMARY KEY (`Id_asisten`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "asisten"
#

REPLACE INTO `asisten` VALUES ('AS001','Kukuh Yoga Rizki Ananda',1,''),('AS002','Kris setyawati',2,''),('AS003','Mockhamad Rizki Adnan',2,NULL);

#
# Structure for table "kriteria"
#

CREATE TABLE `kriteria` (
  `Id_kriteria` varchar(11) NOT NULL DEFAULT '',
  `nama_kriteria` varchar(255) NOT NULL DEFAULT '',
  `status_kriteria` varchar(255) NOT NULL DEFAULT '',
  `bobot_kriteria` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id_kriteria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "kriteria"
#

REPLACE INTO `kriteria` VALUES ('KR001 ','Presensi','1',4),('KR002 ','Asistensi','1',3),('KR003 ','Project','1',3),('KR004','Maintenance','1',2);

#
# Structure for table "nilai"
#

CREATE TABLE `nilai` (
  `Id_nilai` varchar(11) NOT NULL DEFAULT '',
  `Id_asisten` varchar(11) NOT NULL DEFAULT '',
  `Id_kriteria` varchar(11) NOT NULL DEFAULT '',
  `nilai_asisten` double NOT NULL DEFAULT '0',
  `tahun_nilai` char(4) NOT NULL DEFAULT '',
  PRIMARY KEY (`Id_nilai`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "nilai"
#

REPLACE INTO `nilai` VALUES ('NL005','AS003','KR002 ',72,'2019'),('NL006','AS003','KR004',70,'2019'),('NL007','AS003','KR001 ',60,'2019'),('NL008','AS003','KR003 ',10,'2019'),('NL009','AS001','KR002 ',71,'2019'),('NL010','AS001','KR004',80,'2019'),('NL011','AS001','KR001 ',80,'2019'),('NL012','AS001','KR003 ',71,'2019'),('NL013','AS002','KR002 ',67,'2019'),('NL014','AS002','KR004',62,'2019'),('NL015','AS002','KR001 ',70,'2019'),('NL016','AS002','KR003 ',65,'2019');

#
# Structure for table "user"
#

CREATE TABLE `user` (
  `Id_user` varchar(11) NOT NULL DEFAULT '',
  `nama_user` varchar(255) NOT NULL DEFAULT '',
  `email_user` varchar(255) NOT NULL DEFAULT '',
  `password_user` varchar(255) NOT NULL DEFAULT '',
  `image_user` varchar(255) NOT NULL DEFAULT '' COMMENT 'default.jpg',
  `is_active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

#
# Data for table "user"
#

REPLACE INTO `user` VALUES ('US001','Kukuh Yoga Rizki Ananda','kukuhyoga2304@gmail.com','$2y$10$6eCGPJJgsOXqWEEfo1xgF.EjxRrsq.04q3FrYdwfPbDvNEsI2bD96','item-201008-d4df284e01.jpg',1);
