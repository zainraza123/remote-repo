UPDATE projects
SET pastDue = :daysPastDue
WHERE projectID = :projectID