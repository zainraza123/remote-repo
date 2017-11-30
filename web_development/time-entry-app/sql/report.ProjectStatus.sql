SELECT CONCAT(research_agreement, '-', project) AS project,
    p.projectID,
    projectName,
    startDate,
    endDate,
    oldestInvoice,
    totalInvoice,
    projectCap,
    primaryContactName,
    primaryContactEmail,
    rate,
    type,
    pastDue,
    (SELECT SUM(projectHours) * p.rate
    FROM project_hours ph
    WHERE ph.projectID = p.projectID
        AND approvalStatus = 1 ) AS currentlyApproved
FROM projects p
    JOIN research_agreements ra
    ON ra.RAID = p.RAID
WHERE ra.organizationID = :organizationID AND
    p.isActive = 1
ORDER BY  p.projectName 