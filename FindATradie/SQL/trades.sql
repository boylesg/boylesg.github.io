CREATE TABLE `trades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
SELECT * FROM `find-a-tradie`.trades;

INSERT INTO `trades` (`id`,`name`,`description`) VALUES (1,'Appliance Repair','Repair services for household appliances.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (2,'Asphalt and Paving','Asphalt and pavement installation and repair.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (3,'Bricklaying','Bricklaying for structures.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (4,'Cabinetry','Cabinet making and installation.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (5,'Carpentry','General carpentry and woodworking.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (6,'Computer Technician','Computer and network installation, repair, troubleshooting and upgrade.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (7,'Concreting','Concrete pouring and finishing.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (8,'Construction','General contractors, builders and construction companies.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (9,'Demolition','Demolition services for structure removal..');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (10,'Doors and Windows','Installation and repair of doors and windows..');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (11,'Drywall and Plastering','Drywall installation and plaster work.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (12,'Electrical','Wiring, electrical installations and repairs.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (13,'Elevator Installation and Repair','Elevator installation and maintenance.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (14,'Excavation and earth moving','Operation of excavators and dump trucks.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (15,'Fencing (domestic)','Construction of paling, picket and Colorbond fences.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (16,'Fencing (commercial)','Construction of commercial paling and cyclone wire fences.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (17,'Fencing (rural);','Construction of fences on rural properties.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (18,'Fireplace and Chimney','Installation and maintnence of fireplaces and chimneys.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (19,'Flooring','Installation and repair of various flooring types.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (20,'Framing','Structural framing for buildings.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (21,'Gardening and Mowing','Garden maintenance and lawn mowing.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (22,'Glass and Glazing','Glass installation and repair services.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (23,'Gutters and Downspouts','Gutter and downspout installation and maintenance.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (24,'Handyman','Installation of shelves, doors, small painting jobs, plasterboard repairs and furniture assembly etc.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (25,'Home Inspection','Home inspection services for buyers and sellers.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (26,'HVAC (Heating, Ventilation, and Air Conditioning)','Ventilation and Air Conditioning);, Heating and cooling systems installation and maintenance.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (27,'Insulation','Installation and maintenance of insulation.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (28,'Interior Design','Interior design and decor services.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (29,'Land Management','Weed spraying, planting, slashing and woody weed removal etc.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (30,'Landscaping','Creation of gardens where a building license is not required.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (31,'Landscape construction','Creation of gardens with structures requiring a building license.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (32,'Locksmith','Locksmith services for security needs.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (33,'Masonry','Bricklaying, stonework and concrete work.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (34,'Painting','Interior and exterior painting services.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (35,'Paving','Install or repair outdoor paving.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (36,'Pest Control','Pest control services for homes and businesses.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (37,'Pet Grooming','Pet fur trimming, bathing and nail clipping etc.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (38,'Plumbing','Plumbing services including installation and repairs.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (39,'Pool and Spa Maintenance','Pool and spa installation and maintenance.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (40,'Renovation and Remodeling','Home renovation and remodeling services.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (41,'Roofing','Roofing installations and repairs.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (42,'Scaffolding','Scaffolding rental and setup services.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (43,'Security Systems','Installation and maintenance of security systems.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (44,'Septic Systems','Installation and maintenance of septic systems.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (45,'Siding','Siding installation and repair services.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (46,'Solar Panel Installation','Solar panel installation and maintenance.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (47,'Surveying','Land surveyors and mapping services.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (48,'Tiling','Ceramic, porcelain and other tile installations.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (49,'Welding','Welding for metalwork and repairs.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (50,'Window Installation and Repair','Window installation and repair services.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (51,'Window Cleaning','Domestic and commercial window cleaning.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (52,'Landscaping - Australian native','Specialising in creation of landscapes using Australian native flora.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (53,'Lawn managment','Establishment and maintence of lawns (instant turf and seed sown).');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (54,'Lawn management (Australian native)','Establishment and maintence of lawns using Australian native grass species (\'Griffin\' irolaena stipoides, \'Oxley\' Austrodanthonia geniculata & \'Bass\' Bothtiochloa macra)');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (55,'Towing (light)','Towing of regular passenger vehicles.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (56,'Towing (heavy)','Towing of heavy vehicles likes trucks and busses.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (57,'Mechanic (petrol)','Trouble shooting and repair of petrol vehicles.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (58,'Mechanic (deisel)','Trouble shooting and reapair of deisel vehicles.');
INSERT INTO `trades` (`id`,`name`,`description`) VALUES (59,'Customer','A customer exclusively looking for tradies');
