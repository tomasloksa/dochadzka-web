CREATE TABLE `companies` (
                        `companyId` mediumint(8) unsigned NOT NULL auto_increment,
                        `name` varchar(255) default NULL,
                        PRIMARY KEY (`companyId`)
) AUTO_INCREMENT=1;

INSERT INTO `companies` (`name`) VALUES ("testovacia firma"), ("druha firma");

CREATE TABLE `employees` (
                         `employeeId` mediumint(8) unsigned NOT NULL auto_increment,
                         `companyId` mediumint(8) unsigned NOT NULL,
                         `name` varchar(255) default NULL,
                         `surname` varchar(255) NOT NULL,
                         `mail` varchar(255) default NULL,
                         PRIMARY KEY (`employeeId`),
                         FOREIGN KEY (companyId) REFERENCES companies(companyId)
) AUTO_INCREMENT=1;

INSERT INTO `employees` (`companyId`,`name`,`surname`,`mail`) VALUES (1, "Samuel","Hamilton","ornare@sitametante.co.uk"),(1, "Porter","Faith","metus.urna@lacus.net"),(1, "Harlan","Hollee","vel@feugiat.com"),(1, "Duncan","April","dolor.nonummy.ac@pedeNuncsed.edu"),(1, "Robin","Hilda","pellentesque.eget@Duis.co.uk"),(1, "Tobias","Kendall","mus@tristiquesenectus.com"),(1, "Hu","Caldwell","porta.elit@turpisvitaepurus.net"),(1, "Keegan","Simone","commodo.hendrerit.Donec@liberoProinmi.org"),(1, "Wanda","Carla","malesuada.fames.ac@odiovelest.com"),(1, "Veda","Shelley","at@nonmassanon.com");
INSERT INTO `employees` (`companyId`,`name`,`surname`,`mail`) VALUES (2, "Hadley","Carly","turpis.Aliquam@doloregestasrhoncus.com"),(1, "Quincy","Suki","ornare@accumsanlaoreetipsum.co.uk"),(1, "Joseph","Brooke","Proin@NullaaliquetProin.net"),(1, "Beau","Regan","molestie.sodales@malesuadavelvenenatis.com"),(1, "Briar","Olympia","auctor@elit.org"),(1, "Cameron","Bruce","sem.Pellentesque@nuncQuisque.com"),(1, "Avram","Denise","enim@ullamcorpernisl.net"),(1, "Lareina","Ella","turpis@ante.co.uk"),(1, "Hannah","Troy","et.eros.Proin@eget.co.uk"),(1, "Joan","Dara","mollis@Nuncullamcorper.net");

CREATE TABLE `users` (
                         `employeeId` mediumint(8) unsigned NOT NULL,
                         `username` varchar(255) NOT NULL,
                         `password` varchar(255) default NULL,
                         PRIMARY KEY (`employeeId`),
                         FOREIGN KEY (`employeeId`) REFERENCES employees(employeeId)
);

INSERT INTO `users` VALUES (1, "hamilton", "test123"), (2, "faith", "abcdefg");
--pridat autogenerovanie username - prizvisko lowercase + cislo, ak ich uz je viac.

CREATE TABLE `attendance` (
                           `employeeId` mediumint(8) unsigned NOT NULL,
                           `time` datetime NOT NULL,
                           `action` varchar(10) NOT NULL,
                           PRIMARY KEY (`employeeId`),
                           FOREIGN KEY (`employeeId`) REFERENCES employees(employeeId)
)
