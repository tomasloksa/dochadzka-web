CREATE TABLE company (
                        `id` mediumint(8) unsigned NOT NULL auto_increment,
                        `name` varchar(255) default NULL,
                        PRIMARY KEY (`id`)
) AUTO_INCREMENT=1;

INSERT INTO company (`name`) VALUES ('testovacia firma'), ('druha firma');

CREATE TABLE employee (
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

INSERT INTO employee VALUES  (1, 1, 'Tomáš', 'Lokša', 'tomiloksa@gmail.com', '$2y$10$Th1rTraq5Yuf1H30Fck/3upXNTLQfvovqgMeMEvDRwFpJAcRnfiCO', 1);
-- INSERT INTO employee (`companyId`,`name`,`surname`,`mail`) VALUES (1, 'Samuel','Hamilton','ornare@sitametante.co.uk'),(1, 'Porter','Faith','metus.urna@lacus.net'),(1, 'Harlan','Hollee','vel@feugiat.com'),(1, 'Duncan','April','dolor.nonummy.ac@pedeNuncsed.edu'),(1, 'Robin','Hilda','pellentesque.eget@Duis.co.uk'),(1, 'Tobias','Kendall','mus@tristiquesenectus.com'),(1, 'Hu','Caldwell','porta.elit@turpisvitaepurus.net'),(1, 'Keegan','Simone','commodo.hendrerit.Donec@liberoProinmi.org'),(1, 'Wanda','Carla','malesuada.fames.ac@odiovelest.com'),(1, 'Veda','Shelley','at@nonmassanon.com');
-- INSERT INTO employee (`companyId`,`name`,`surname`,`mail`) VALUES (2, 'Hadley','Carly','turpis.Aliquam@doloregestasrhoncus.com'),(1, 'Quincy','Suki','ornare@accumsanlaoreetipsum.co.uk'),(1, 'Joseph','Brooke','Proin@NullaaliquetProin.net'),(1, 'Beau','Regan','molestie.sodales@malesuadavelvenenatis.com'),(1, 'Briar','Olympia','auctor@elit.org'),(1, 'Cameron','Bruce','sem.Pellentesque@nuncQuisque.com'),(1, 'Avram','Denise','enim@ullamcorpernisl.net'),(1, 'Lareina','Ella','turpis@ante.co.uk'),(1, 'Hannah','Troy','et.eros.Proin@eget.co.uk'),(1, 'Joan','Dara','mollis@Nuncullamcorper.net');

CREATE TABLE `attendance` (
                           `id` int unsigned NOT NULL auto_increment,
                           `employeeId` mediumint(8) unsigned NOT NULL,
                           `time` datetime NOT NULL,
                           `action` smallint NOT NULL,
                           PRIMARY KEY (`id`),
                           FOREIGN KEY (`employeeId`) REFERENCES employee(id)
) AUTO_INCREMENT=1;

CREATE TABLE `attendanceDay` (
                           `id` mediumint(8) unsigned NOT NULL auto_increment,
                           `day` tinyint NOT NULL check (`day` between 1 and 31),
                           `month` tinyint NOT NULL check (`month` between 1 and 12),
                           `year` smallint NOT NULL, 
                           `employeeId` mediumint(8) unsigned NULL,
                           `dayType` tinyint NOT NULL,
                           PRIMARY KEY (`id`),
                           FOREIGN KEY (`employeeId`) REFERENCES employee(id)
);
