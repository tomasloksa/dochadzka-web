CREATE TABLE `company` (
                        `id` mediumint(8) unsigned NOT NULL auto_increment,
                        `name` varchar(255) NOT NULL,
                        PRIMARY KEY (`id`)
) AUTO_INCREMENT=1;

INSERT INTO company(`id`, `name`) VALUES (1, "testovacia firma"), (2, "druha firma");

CREATE TABLE `employee` (
                         `id` mediumint(8) unsigned NOT NULL auto_increment,
                         `companyId` mediumint(8) unsigned NOT NULL,
                         `name` varchar(255) NOT NULL,
                         `surname` varchar(255) NOT NULL,
                         `mail` varchar(255) default NULL,
                         `password` varchar(255) default NULL,
                         `role` tinyint(1) default 0,
                         PRIMARY KEY (`id`),
                         FOREIGN KEY (`companyId`) REFERENCES company(id)
) AUTO_INCREMENT=1;

INSERT INTO `employee` VALUES  (1, 1, "Tomáš", "Lokša", "tomiloksa@gmail.com", "$2y$10$Th1rTraq5Yuf1H30Fck/3upXNTLQfvovqgMeMEvDRwFpJAcRnfiCO", 1);

CREATE TABLE `attendance` (
                           `id` int unsigned NOT NULL auto_increment,
                           `employeeId` mediumint(8) unsigned NOT NULL,
                           `time` datetime NOT NULL,
                           `action` smallint NOT NULL,
                           PRIMARY KEY (`id`),
                           CONSTRAINT `FK_attendance_user` FOREIGN KEY (`employeeId`) REFERENCES employee(id) ON DELETE CASCADE
) AUTO_INCREMENT=1;

CREATE TABLE `attendanceDay` (
                           `id` mediumint(8) unsigned NOT NULL auto_increment,
                           `day` tinyint NOT NULL check (`day` between 1 and 31),
                           `month` tinyint NOT NULL check (`month` between 1 and 12),
                           `year` smallint NOT NULL, 
                           `employeeId` mediumint(8) unsigned NULL,
                           `dayType` tinyint NOT NULL,
                           PRIMARY KEY (`id`),
                           CONSTRAINT `FK_attendanceDay_user` FOREIGN KEY (`employeeId`) REFERENCES employee(id) ON DELETE CASCADE
) AUTO_INCREMENT=1;
