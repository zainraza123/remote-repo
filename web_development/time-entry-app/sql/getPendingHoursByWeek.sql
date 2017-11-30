SELECT 
    eo.employeeID,
    eo.EOID,
    CONCAT(e.firstName, " ", e.lastName) AS employeeName,
    CONCAT(ra.research_agreement,'-', p.project) AS project, 
    p.projectID, 
    p.projectName, 
    p.rate, 
    p.projectCap,  
    p.totalInvoice, 
    ph.projectHours, 
    w.startDay, 
    w.endDay,
    w.weekID,
    pastDue,
    p.notes, 
    (SELECT concat(pp.startDate, " - ", pp.endDate)
    FROM pay_periods AS pp
    WHERE w.startDay
        BETWEEN pp.startDate
            AND pp.endDate ) AS payPeriod, 

    (SELECT SUM(projectHours) * p.rate
    FROM project_hours
    WHERE projectID = p.projectID
            AND approvalStatus = 1 ) AS currentlyApproved, 

    (SELECT SUM(projectHours) * p.rate
    FROM project_hours
    WHERE projectID = p.projectID ) AS estimatedTotal
FROM project_hours ph
JOIN projects p
    ON p.projectID = ph.projectID
JOIN research_agreements ra
    ON ra.RAID = p.RAID
JOIN employees_organizations eo ON ph.EOID = eo.EOID
JOIN employees e
    ON e.username = eo.username
JOIN weeks w
    ON w.weekID = ph.weekID
WHERE ph.approvalStatus = 0
        AND ra.organizationID = :organizationID
ORDER BY projectName, firstName, lastName, w.weekID desc