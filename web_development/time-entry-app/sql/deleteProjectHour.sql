DELETE
FROM project_hours
WHERE EOID = :EOID
        AND weekID = :weekID
        AND approvalStatus = 0 