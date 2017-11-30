SELECT *
FROM employees_organizations
WHERE employeeID = :employeeID
        AND organizationID = :organizationID;