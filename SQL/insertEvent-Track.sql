#create track if not exist, then create event if not exist
#set variables first
set @eventname := 'Gridlife Round 5', #Gridlife Round X, Gridlife Midwest, Gridlife South
@trackname := 'Gingerman', #Gingerman, Road Atlanta, Mid-Ohio, 
@eventdate := '2017-10-07'; #YYYY-MM-DD

#track
INSERT INTO tracks (name)
SELECT * FROM (SELECT @trackname) AS tmp
where not exists (
	select name from tracks where name = @trackname
) limit 1;

#event
INSERT INTO events (name, track, date)
SELECT * FROM (SELECT @eventname, 
	#get trackid from tracks table
	(select trackid from tracks where name = @trackname),
	@eventdate ) AS tmp
where not exists (
	select name, track, date from events where name = @eventname and track = @trackname and date = @eventdate
) limit 1;