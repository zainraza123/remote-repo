SELECT distinct firstName, lastName
FROM worked_hours wh
JOIN weeks w on wh.weekID = w.weekID
JOIN employees_organizations eo on wh.EOID = eo.EOID
JOIN employees e on e.username = eo.username
WHERE 
	eo.employeeID not in 
    (
			(
				SELECT distinct employeeID
				FROM project_hours
				WHERE
					approvalStatus = 0 and
					project_hours.employeeID = eo.employeeID
			)
    ) AND
    wh.isExported = 0