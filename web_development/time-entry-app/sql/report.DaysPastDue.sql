SELECT
    projectID,
    CONCAT(ra.research_agreement,'-', p.project) AS project,
    projectName,
    pastDue
FROM projects p
    JOIN research_agreements ra
    ON p.RAID = ra.RAID
WHERE ra.organizationID = :organizationID
    AND p.isActive = 1