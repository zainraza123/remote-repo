UPDATE projects
SET
	pastDue = pastDue + 1
WHERE pastDue != 0
