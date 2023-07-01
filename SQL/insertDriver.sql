INSERT INTO drivers (name)
SELECT * FROM (SELECT 'Test Driver') AS tmp
where not exists (
	select name from drivers where name = 'Test Driver'
) limit 1;