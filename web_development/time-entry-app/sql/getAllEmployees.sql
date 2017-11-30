SELECT eo.employeeID,
        role,
        firstName,
        lastName,
        email,
        EOID,
        isActive 
FROM employees e
JOIN employees_organizations eo on eo.username = e.username
JOIN roles r on r.roleID = eo.roleID
WHERE organizationID = :organizationID
ORDER BY isActive desc, lastName
