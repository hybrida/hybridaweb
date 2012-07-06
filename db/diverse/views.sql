use hybrida_dev;

DROP VIEW IF EXISTS group_membership_view_active;
DROP VIEW IF EXISTS group_membership_view;
DROP VIEW IF EXISTS rbac_assignment_view;


-- group_membership_view
CREATE VIEW group_membership_view AS
SELECT g.id AS gid, u.id AS uid, g.url, u.firstName, u.lastName, gm.comission, gm.start, gm.end
FROM `group_membership` as gm
JOIN user AS u ON u.id = gm.userId
JOIN groups AS g  ON g.id = gm.groupId
ORDER BY g.url ASC, u.firstName;


-- group_membership_view_active
CREATE VIEW group_membership_view_active AS
SELECT g.id AS gid, u.id AS uid, g.url, u.firstName, u.lastName, gm.comission, gm.start
FROM `group_membership` as gm
JOIN user AS u ON u.id = gm.userId
JOIN groups AS g  ON g.id = gm.groupId
WHERE gm.end = '0000-00-00'
ORDER BY g.url ASC, u.firstName;

-- rbac_assignment_view
CREATE VIEW rbac_assignment_view AS
SELECT itemname, userid, firstName, lastName
FROM rbac_assignment
JOIN user ON user.id = userid
ORDER BY userid;
