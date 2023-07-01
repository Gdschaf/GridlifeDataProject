set @eventname := 'Gridlife Round 5',
@trackname := 'Gingerman',
@eventdate := '2017-10-07';

#create temp table
drop temporary table if exists tmp_import;
create temporary table tmp_import
(name varchar(45),
class varchar(20),
drive varchar(3),
laptime varchar(45),
make varchar(20),
model varchar(20)) ;

#load CSV into database
load data local infile 'C:\\Users\\i831714\\Documents\\mySQL Scripts\\2017-round5.csv'
into table tmp_import
fields terminated by ','
ignore 1 rows ;

#add ID columns
alter table tmp_import add driverid INT ;
alter table tmp_import add classid INT ;
alter table tmp_import add carid INT ;

# create drivers from temp table that do not exist
INSERT INTO drivers (name)
SELECT name
FROM tmp_import
WHERE Name not in (
 SELECT Name
 FROM drivers
) ;

# update temp table with driverid from drivers table
UPDATE tmp_import
inner join drivers on tmp_import.Name = drivers.Name
SET tmp_import.driverid = drivers.driverid
where tmp_import.driverid is null ;

# update temp table with classid from classes table
update tmp_import
inner join classes on (tmp_import.class = classes.name) and (tmp_import.drive = classes.drive)
set tmp_import.classid = classes.classid
where tmp_import.classid is null ;

# create cars from temp table that do not exist
INSERT INTO cars (make, model)
SELECT DISTINCT make, model
FROM tmp_import
WHERE (make, model) NOT IN (
	SELECT make, model
    FROM cars
) ;




select drivers.name from tmp_import inner join drivers on tmp_import.Name = drivers.Name

select * from drivers order by name asc
select * from tmp_import
select * from cars order by make, model asc

delete from cars where drive is null