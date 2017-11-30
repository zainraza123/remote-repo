SELECT *
FROM pay_periods
WHERE startDate < now()
ORDER BY  startDate DESC LIMIT 10 