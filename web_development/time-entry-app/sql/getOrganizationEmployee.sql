SELECT eo.*,
		r.role,
        em.managerEOID,
        e.firstName,
        e.lastName
FROM employees_organizations eo
JOIN employees as e on e.username = eo.username
JOIN roles r ON r.roleID = eo.roleID
LEFT JOIN employee_managers em ON em.employeeEOID = eo.EOID
WHERE EOID = :EOID