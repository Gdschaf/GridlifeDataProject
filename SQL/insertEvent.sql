INSERT INTO events (name, track, date)
SELECT * FROM (SELECT 'test name', 
	#get trackid from tracks table
	(select trackid from tracks where name = 'test track')
    , '1900-01-01' ) AS tmp
where not exists (
	select name, track, date from events where name = 'test event' and track = 'test track' and date = '1900-01-01'
) limit 1;

select * from events