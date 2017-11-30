SELECT CONCAT(ra.research_agreement, '-', p.project) AS project,
    projectHours,
    approvalStatus,
    p.projectID
FROM project_hours ph
    JOIN projects p
    ON p.projectId = ph.projectId
    JOIN research_agreements ra
    ON p.RAID = ra.RAID
WHERE ph.EOID = :EOID
    AND weekID = :weekID 
ORDER BY approvalStatus DESC