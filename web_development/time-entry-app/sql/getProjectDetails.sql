SELECT
p.RAID,
CONCAT(ra.research_agreement, '-', p.project) as project,
p.projectName,
p.startDate,
p.endDate,
p.oldestInvoice,
p.projectCap,
p.primaryContactName,
p.primaryContactEmail,
p.rate,
p.type,
p.pastDue,
ra.research_agreement,
ra.companyName,
APcontactName,
APcontactEmail,
notes
FROM projects p
JOIN research_agreements ra
    ON ra.RAID = p.RAID
WHERE p.projectID = :projectID