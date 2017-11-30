SELECT skill, s.skillID
FROM employee_skills es
JOIN skills s ON s.skillID = es.skillID
WHERE es.employeeEOID = :employeeEOID