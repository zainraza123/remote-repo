SELECT *,
        dayname(workedDate) AS day
FROM worked_hours
WHERE weekID = :weekID
        AND EOID = :EOID