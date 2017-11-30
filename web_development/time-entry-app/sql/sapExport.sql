SELECT
    sapNumber,
    eo.employeeID,
    concat(e.firstName, " " , e.lastName) as employeeName,
    workedDate,
    startTime,
    endTime,
    time_to_sec( timediff(endTime, startTime) ) / 3600 as workedTotal
FROM worked_hours wh
    JOIN employees_organizations eo on eo.EOID = wh.EOID
    JOIN employees e on e.username = eo.username
    JOIN roles r on r.roleID = eo.roleID
    JOIN pay_periods pp on wh.workedDate between pp.startDate and pp.endDate
WHERE
	eo.organizationID = 1 AND
    role in ('Student', 'Student Administrator')