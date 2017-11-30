SELECT p.projectID, p.rate
FROM research_agreements ra
    JOIN projects p ON p.raid = ra.raid
WHERE ra.research_agreement = :research_agreement AND p.project = :project