INSERT INTO project_hours
    ( EOID,
    projectID,
    projectHours,
    weekID,
    approvalStatus )
VALUES
    ( :EOID,
        :projectID,
        :projectHours,
        :weekID,
        0 ) 