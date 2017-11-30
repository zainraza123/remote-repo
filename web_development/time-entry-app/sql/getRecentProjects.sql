SELECT DISTINCT (CONCAT(ra.research_agreement, '-', p.project, ' : ' , p.projectName)) AS projectName,
         CONCAT(ra.research_agreement, '-', p.project) AS project,
         p.projectID
FROM project_hours ph
JOIN projects p
    ON p.projectID = ph.projectID
JOIN research_agreements ra
    ON ra.RAID = p.RAID
JOIN weeks w
    ON w.weekID = ph.weekID
WHERE ph.EOID = :EOID
        AND p.isActive = 1
ORDER BY  w.startDay LIMIT 5