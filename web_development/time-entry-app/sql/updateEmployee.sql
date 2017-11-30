UPDATE Employees 
SET firstName = :firstName,
    lastName = :lastName,
    email = :email,
    username = :username
WHERE username = :username