SELECT EOID
FROM employees_organizations
WHERE username = :username
        AND organizationID = :organizationID