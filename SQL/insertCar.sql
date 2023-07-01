INSERT INTO cars (make, model, drive)
SELECT * FROM (SELECT 'testcar', 'testmodel', 'RWD') AS tmp
where not exists (
	select make, model, drive from cars where make = 'testcar' and model = 'testmodel' and drive = 'RWD'
) limit 1;