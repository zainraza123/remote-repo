UPDATE project_hours 
SET approvedBy = :EOID,
    approvalStatus = 1
WHERE projectID = :projectID 