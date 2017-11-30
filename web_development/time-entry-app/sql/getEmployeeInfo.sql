SELECT eo.employeeID,
         firstName,
         lastName,
         e.username,
         email,
         organizationID,
         role,
         EOID
FROM employees e
JOIN employees_organizations eo
    ON e.username = eo.username
        AND eo.isDefault = 1
JOIN roles r
    ON r.roleID = eo.roleID
WHERE e.username= :username