SELECT eo.employeeID,
         concat(e.firstName, " ", e.lastName) AS employeeName,
         CONCAT(ph.research_agreement, '-', ph.project) AS project,
         p.projectName,
         sum(ph.projectHours),
    (SELECT concat(pp.startDate,
        " - ",
         pp.endDate)
    FROM pay_periods AS pp
    WHERE w.startDay
        BETWEEN pp.startDate
            AND pp.endDate) AS payPeriod
FROM project_hours AS ph
JOIN projects AS p
    ON p.RAID = ph.RAID
        AND p.project = ph.project
JOIN employees AS e
    ON e.employeeID = ph.employeeID
JOIN weeks AS w
    ON w.weekID = ph.weekID
WHERE ph.approvalStatus = 0
        AND e.organizationID = :organizationID
GROUP BY  project, employeeID, payPeriod