SELECT o.organizationID,
       o.organizationName
FROM organization o
JOIN employees_organizations eo ON o.organizationID = eo.organizationID
WHERE eo.username = :username