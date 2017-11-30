SELECT CONCAT(ra.research_agreement, '-', p.project) AS project,
    projectName,
    SUM(projectHours) AS projectHours,
    SUM(projectHours * p.rate) AS projectTotal
FROM project_hours ph
    JOIN projects p
    ON p.projectID = ph.projectID
    JOIN research_agreements ra
    ON ra.RAID = p.RAID
WHERE weekID IN ( 
    (SELECT weekID
    FROM weeks
    WHERE startDay >= :startDate
        AND endDay <= :endDate ) )
    AND approvalStatus = 1
    AND ra.organizationID = :organizationID
GROUP BY  project 