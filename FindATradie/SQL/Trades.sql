
CREATE TABLE Trades (

    ID int NOT NULL AUTO_INCREMENT KEY,
    Name varchar(255),
    Description varchar(255)
);

insert into Trades values (0,'Appliance Repair','Repair services for household appliances.');
insert into Trades values (0,'Asphalt and Paving','Asphalt and pavement installation and repair.');
insert into Trades values (0,'Bricklaying','Bricklaying for structures.');
insert into Trades values (0,'Cabinetry','Cabinet making and installation.');
insert into Trades values (0,'Carpentry','General carpentry and woodworking.');
insert into Trades values (0,'Concreting','Concrete pouring and finishing.');
insert into Trades values (0,'Construction','General contractors, builders and construction companies.');
insert into Trades values (0,'Demolition','Demolition services for structure removal..');
insert into Trades values (0,'Doors and Windows','Installation and repair of doors and windows..');
insert into Trades values (0,'Drywall and Plastering','Drywall installation and plaster work.');
insert into Trades values (0,'Electrical','Wiring, electrical installations and repairs.');
insert into Trades values (0,'Elevator Installation and Repair','Elevator installation and maintenance.');
insert into Trades values (0,'Excavation and earth moving','Operation of excavators and dump trucks.');
insert into Trades values (0,'Fencing (domestic);','Construction of paling, picket and Colorbond fences.');
insert into Trades values (0,'Fencing (commercial);','Construction of commercial paling and cyclone wire fences.');
insert into Trades values (0,'Fencing (rural);','Construction of fences on rural properties.');
insert into Trades values (0,'Fireplace and Chimney','Installation and maintnence of fireplaces and chimneys.');
insert into Trades values (0,'Flooring','Installation and repair of various flooring types.');
insert into Trades values (0,'Framing','Structural framing for buildings.');
insert into Trades values (0,'Gardening and Mowing','Garden maintenance and lawn mowing.');
insert into Trades values (0,'Glass and Glazing','Glass installation and repair services.');
insert into Trades values (0,'Gutters and Downspouts','Gutter and downspout installation and maintenance.');
insert into Trades values (0,'Handyman','Installation of shelves, doors, small painting jobs, plasterboard repairs and furniture assembly etc.');
insert into Trades values (0,'Home Inspection','Home inspection services for buyers and sellers.');
insert into Trades values (0,'HVAC (Heating, Ventilation, and Air Conditioning);','Ventilation and Air Conditioning);, Heating and cooling systems installation and maintenance.');
insert into Trades values (0,'Insulation','Installation and maintenance of insulation.');
insert into Trades values (0,'Interior Design','Interior design and decor services.');
insert into Trades values (0,'Land Management','Weed spraying, planting, slashing and woody weed removal etc.');
insert into Trades values (0,'Landscaping','Creation of simple gardens, inlcuding ongoing maintnence.');
insert into Trades values (0,'Landscape construction','Creation of gardens with structures.');
insert into Trades values (0,'Locksmith','Locksmith services for security needs.');
insert into Trades values (0,'Masonry','Bricklaying, stonework and concrete work.');
insert into Trades values (0,'Painting','Interior and exterior painting services.');
insert into Trades values (0,'Pest Control','Pest control services for homes and businesses.');
insert into Trades values (0,'Pet Grooming','Pet fur trimming, bathing and nail clipping etc.');
insert into Trades values (0,'Plumbing','Plumbing services including installation and repairs.');
insert into Trades values (0,'Pool and Spa Maintenance','Pool and spa installation and maintenance.');
insert into Trades values (0,'Renovation and Remodeling','Home renovation and remodeling services.');
insert into Trades values (0,'Roofing','Roofing installations and repairs.');
insert into Trades values (0,'Scaffolding','Scaffolding rental and setup services.');
insert into Trades values (0,'Security Systems','Installation and maintenance of security systems.');
insert into Trades values (0,'Septic Systems','Installation and maintenance of septic systems.');
insert into Trades values (0,'Siding','Siding installation and repair services.');
insert into Trades values (0,'Solar Panel Installation','Solar panel installation and maintenance.');
insert into Trades values (0,'Surveying','Land surveyors and mapping services.');
insert into Trades values (0,'Tiling','Ceramic, porcelain and other tile installations.');
insert into Trades values (0,'Welding','Welding for metalwork and repairs.');
insert into Trades values (0,'Window Installation and Repair','Window installation and repair services.');
insert into Trades values (0,'Window Cleaning','Domestic and commercial window cleaning.');

/*drop table if exists Trades
go

create table Trades 
( TradeID	int primary key clustered identity(1,1) not null,
      [Name]	varchar(50)	not null,
      [Description] varchar(255)	not null
);
go

insert into dbo.Trades values ('Appliance Repair','Repair services for household appliances.')
insert into dbo.Trades values ('Asphalt and Paving','Asphalt and pavement installation and repair.')
insert into dbo.Trades values ('Bricklaying','Bricklaying for structures.')
insert into dbo.Trades values ('Cabinetry','Cabinet making and installation.')
insert into dbo.Trades values ('Carpentry','General carpentry and woodworking.')
insert into dbo.Trades values ('Concreting','Concrete pouring and finishing.')
insert into dbo.Trades values ('Construction','General contractors, builders and construction companies.')
insert into dbo.Trades values ('Demolition','Demolition services for structure removal..')
insert into dbo.Trades values ('Doors and Windows','Installation and repair of doors and windows..')
insert into dbo.Trades values ('Drywall and Plastering','Drywall installation and plaster work.')
insert into dbo.Trades values ('Electrical','Wiring, electrical installations and repairs.')
insert into dbo.Trades values ('Elevator Installation and Repair','Elevator installation and maintenance.')
insert into dbo.Trades values ('Excavation and earth moving','Operation of excavators and dump trucks.')
insert into dbo.Trades values ('Fencing (domestic)','Construction of paling, picket and Colorbond fences.')
insert into dbo.Trades values ('Fencing (commercial)','Construction of commercial paling and cyclone wire fences.')
insert into dbo.Trades values ('Fencing (rural)','Construction of fences on rural properties.')
insert into dbo.Trades values ('Fireplace and Chimney','Installation and maintnence of fireplaces and chimneys.')
insert into dbo.Trades values ('Flooring','Installation and repair of various flooring types.')
insert into dbo.Trades values ('Framing','Structural framing for buildings.')
insert into dbo.Trades values ('Gardening and Mowing','Garden maintenance and lawn mowing.')
insert into dbo.Trades values ('Glass and Glazing','Glass installation and repair services.')
insert into dbo.Trades values ('Gutters and Downspouts','Gutter and downspout installation and maintenance.')
insert into dbo.Trades values ('Handyman','Installation of shelves, doors, small painting jobs, plasterboard repairs and furniture assembly etc.')
insert into dbo.Trades values ('Home Inspection','Home inspection services for buyers and sellers.')
insert into dbo.Trades values ('HVAC (Heating, Ventilation, and Air Conditioning)','Ventilation and Air Conditioning), Heating and cooling systems installation and maintenance.')
insert into dbo.Trades values ('Insulation','Installation and maintenance of insulation.')
insert into dbo.Trades values ('Interior Design','Interior design and decor services.')
insert into dbo.Trades values ('Land Management','Weed spraying, planting, slashing and woody weed removal etc.')
insert into dbo.Trades values ('Landscaping','Creation of simple gardens, inlcuding ongoing maintnence.')
insert into dbo.Trades values ('Landscape construction','Creation of gardens with structures.')
insert into dbo.Trades values ('Locksmith','Locksmith services for security needs.')
insert into dbo.Trades values ('Masonry','Bricklaying, stonework and concrete work.')
insert into dbo.Trades values ('Painting','Interior and exterior painting services.')
insert into dbo.Trades values ('Pest Control','Pest control services for homes and businesses.')
insert into dbo.Trades values ('Pet Grooming','Pet fur trimming, bathing and nail clipping etc.')
insert into dbo.Trades values ('Plumbing','Plumbing services including installation and repairs.')
insert into dbo.Trades values ('Pool and Spa Maintenance','Pool and spa installation and maintenance.')
insert into dbo.Trades values ('Renovation and Remodeling','Home renovation and remodeling services.')
insert into dbo.Trades values ('Roofing','Roofing installations and repairs.')
insert into dbo.Trades values ('Scaffolding','Scaffolding rental and setup services.')
insert into dbo.Trades values ('Security Systems','Installation and maintenance of security systems.')
insert into dbo.Trades values ('Septic Systems','Installation and maintenance of septic systems.')
insert into dbo.Trades values ('Siding','Siding installation and repair services.')
insert into dbo.Trades values ('Solar Panel Installation','Solar panel installation and maintenance.')
insert into dbo.Trades values ('Surveying','Land surveyors and mapping services.')
insert into dbo.Trades values ('Tiling','Ceramic, porcelain and other tile installations.')
insert into dbo.Trades values ('Welding','Welding for metalwork and repairs.')
insert into dbo.Trades values ('Window Installation and Repair','Window installation and repair services.')
insert into dbo.Trades values ('Window Cleaning','Domestic and commercial window cleaning.')
*/