SELECT (CONCAT(ra.research_agreement, '-', project, ' : '  , projectName)) AS projectName,
        CONCAT(ra.research_agreement, '-', project) AS project,
        p.projectID
FROM projects p
JOIN research_agreements AS ra
    ON ra.RAID = p.RAID
WHERE organizationID = :organizationID
        AND isActive = 1
ORDER BY  p.projectName