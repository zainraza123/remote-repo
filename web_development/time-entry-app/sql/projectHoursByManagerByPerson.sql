SELECT eo.employeeID,
	CONCAT(e.firstName, " ", e.lastName) AS employeeName,
    CONCAT(ra.research_agreement, '-', p.project) AS project,
    p.projectID,
    p.projectName,
    w.startDay,
    w.endDay,
    SUM(ph.projectHours) AS projectHours
FROM project_hours ph
JOIN projects p ON p.projectID = ph.projectID
JOIN research_agreements ra ON ra.RAID = p.RAID
JOIN employees_organizations eo ON ph.EOID = eo.EOID
JOIN employee_managers em ON em.employeeEOID = eo.EOID
JOIN employees AS e ON e.username = eo.username
JOIN weeks w ON w.weekID = ph.weekID
WHERE ph.approvalStatus = 0 AND em.managerEOID = :managerEOID
GROUP BY p.projectName, employeeName
ORDER BY e.firstName, e.lastName