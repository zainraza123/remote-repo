SELECT *,
         CONCAT(ra.research_agreement,
         '-', p.project) AS project
FROM projects AS p
JOIN research_agreements ra
    ON ra.RAID = p.RAID
WHERE ra.organizationID = :organizationID
ORDER BY isActive desc, p.projectName
