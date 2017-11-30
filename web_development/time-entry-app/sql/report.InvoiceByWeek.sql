SELECT CONCAT(ra.research_agreement, '-', p.project, ' (', p.projectName, ')') AS 'projectName',
	   CONCAT('APPROVED ', DATE_FORMAT(pp.startDate, '%c/%d/%Y'), ' - ', DATE_FORMAT(pp.endDate, '%c/%d/%Y')) AS 'payPeriod',
	   e.firstName,
       e.lastName,
       p.projectID,
       SUM(ph.projectHours) AS totalHours
FROM projects p
JOIN research_agreements ra ON ra.RAID = p.RAID
JOIN project_hours ph ON p.projectID = ph.projectID AND approvalStatus = 1
JOIN employees_organizations eo ON eo.EOID = ph.EOID AND eo.organizationID = :organizationID
JOIN employees e ON e.username = eo.username
JOIN weeks w ON w.weekID = ph.weekID
JOIN pay_periods pp ON w.startDay BETWEEN pp.startDate AND pp.endDate
WHERE w.startDay BETWEEN :startDate AND :endDate
GROUP BY p.projectID, eo.EOID, pp.ppid
ORDER BY ra.research_agreement, p.project, payPeriod DESC, e.firstName, e.lastName