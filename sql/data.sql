CREATE TABLE `employees` (
                         `employeeId` mediumint(8) unsigned NOT NULL auto_increment,
                         `name` varchar(255) default NULL,
                         `surname` varchar(255) NOT NULL,
                         `mail` varchar(255) default NULL,
                         `password` varchar(255) default NULL,
                         PRIMARY KEY (`employeeId`)
) AUTO_INCREMENT=1;

INSERT INTO `employees` (`name`,`surname`,`mail`, `password`) VALUES ("Samuel","Hamilton","ornare@sitametante.co.uk", "abc123"),("Porter","Faith","metus.urna@lacus.net", "dfs45"),("Harlan","Hollee","vel@feugiat.com", "hesloheslo"),("Duncan","April","dolor.nonummy.ac@pedeNuncsed.edu", "zemiak"),("Robin","Hilda","pellentesque.eget@Duis.co.uk", "jaohda"),("Tobias","Kendall","mus@tristiquesenectus.com", "paradajka"),("Hu","Caldwell","porta.elit@turpisvitaepurus.net", "mrkva"),("Keegan","Simone","commodo.hendrerit.Donec@liberoProinmi.org", "hrozno"),("Wanda","Carla","malesuada.fames.ac@odiovelest.com", "jablko"),("Veda","Shelley","at@nonmassanon.com", "hruska");
INSERT INTO `employees` (`name`,`surname`,`mail`) VALUES ("Hadley","Carly","turpis.Aliquam@doloregestasrhoncus.com"),("Quincy","Suki","ornare@accumsanlaoreetipsum.co.uk"),("Joseph","Brooke","Proin@NullaaliquetProin.net"),("Beau","Regan","molestie.sodales@malesuadavelvenenatis.com"),("Briar","Olympia","auctor@elit.org"),("Cameron","Bruce","sem.Pellentesque@nuncQuisque.com"),("Avram","Denise","enim@ullamcorpernisl.net"),("Lareina","Ella","turpis@ante.co.uk"),("Hannah","Troy","et.eros.Proin@eget.co.uk"),("Joan","Dara","mollis@Nuncullamcorper.net");

CREATE TABLE `attendance` (
                           `userId` mediumint(8) unsigned NOT NULL,
                           `time` datetime NOT NULL,
                           `action` varchar(10) NOT NULL,
                           PRIMARY KEY (`userId`),
                           FOREIGN KEY (userId) REFERENCES employees(employeeId)
) AUTO_INCREMENT=1;

CREATE TABLE `company` (
                        `companyId` mediumint(8) unsigned NOT NULL auto_increment,
                        `name` varchar(255) default NULL,
                        PRIMARY KEY (`companyId`)
) AUTO_INCREMENT=1;