SELECT 
    EOID,
    firstName,
    lastName,
    email
FROM employees_organizations eo
JOIN employees e on e.username = eo.username
JOIN roles r on r.roleID = eo.roleID
WHERE
	organizationID = :organizationID AND
    eo.isActive = 1 AND
    (role = 'Manager' OR role = 'Administrator')