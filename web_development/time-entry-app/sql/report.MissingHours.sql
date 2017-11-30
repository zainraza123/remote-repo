SELECT
    eo.employeeID,
    firstName,
    lastName,
    email
FROM employees_organizations eo
    JOIN employees e on e.username = eo.username
    JOIN roles r on r.roleID = eo.roleID
WHERE 
    eo.EOID NOT IN (
		SELECT DISTINCT employees_organizations.EOID
		FROM worked_hours wh
		JOIN employees_organizations ON wh.EOID = employees_organizations.EOID
		WHERE
				workedDate >= :startDate AND
				workedDate <= :endDate AND
				employees_organizations.organizationID = :organizationID
		GROUP BY employeeID
        HAVING count(distinct weekID) = 2
	) AND
    eo.organizationID = :organizationID AND
    r.role in ("Student", "Manager", "Student Administrator")

