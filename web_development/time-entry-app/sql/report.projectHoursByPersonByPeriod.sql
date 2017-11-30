SELECT eo.employeeID,
	CONCAT(e.firstName, " ", e.lastName) AS employeeName,
    CONCAT(ra.research_agreement, '-', p.project) AS project,
    p.projectID,
    p.projectName,
    SUM(ph.projectHours) AS projectHours
FROM project_hours ph
JOIN projects p ON p.projectID = ph.projectID
JOIN research_agreements ra ON ra.RAID = p.RAID
JOIN employees_organizations eo on ph.EOID = eo.EOID
JOIN employees AS e ON e.username = eo.username
WHERE weekID IN ( 
    (
		SELECT weekID
		FROM weeks
		WHERE 
			startDay >= :startDate AND 
			endDay <= :endDate 
	) 
) AND 
ra.organizationID = :organizationID
GROUP BY p.projectName, employeeName