SELECT *,
	date_format(startTime, '%l:%i %p') as startTime,
	date_format(endTime, '%l:%i %p') as endTime,
	dayname(workedDate) AS day
FROM worked_hours wh
	JOIN weeks w on w.weekID = wh.weekID
	JOIN employees_organizations eo on eo.EOID = wh.EOID
	JOIN employees e on e.username = eo.username
WHERE
	workedDate between :startDate AND :endDate AND
    organizationID = :organizationID
ORDER BY e.firstName, e.lastName, w.startDay, workedDate
