SELECT 
	*,
    date_format(startTime, '%l:%i %p') as startTime,
    date_format(endTime, '%l:%i %p') as endTime
FROM employees_organizations eo
JOIN employees e on e.username = eo.username
JOIN schedule_times st on st.EOID = eo.EOID
WHERE eo.organizationID = :organizationID
ORDER BY firstName, lastName, st.scheduleID