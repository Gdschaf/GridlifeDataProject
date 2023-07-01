#set variable
set @trackname := 'Gingerman';

#add track if not exist
INSERT INTO tracks (name)
SELECT * FROM (SELECT @trackname) AS tmp
where not exists (
	select name from drivers where name = @trackname
) limit 1;