SELECT DISTINCT u.id, u.firstName, u.lastName
FROM user AS u
JOIN signup_membership AS sm ON sm.userId = u.id
WHERE u.id IN (
		SELECT userId
		FROM signup_membership
		WHERE eventId =114
	)
AND u.id NOT IN (
		SELECT userId
		FROM signup_membership
		WHERE eventId =130
	)