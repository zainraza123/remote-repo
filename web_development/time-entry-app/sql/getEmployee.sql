SELECT eo.employeeID,
         firstName,
         lastName,
         e.username,
         email,
         o.organizationID,
         o.organizationName,
         role,
         EOID
FROM employees e
JOIN employees_organizations eo
    ON e.username = eo.username
        AND eo.isDefault = 1
JOIN roles r
    ON r.roleID = eo.roleID
JOIN organization o
    ON o.organizationID = eo.organizationID
WHERE e.username = :username 