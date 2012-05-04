-- kopierer fra hybrida-database til hybrida_dev

DELETE FROM hybrida_dev.`rbac_assignment`;
DELETE FROM hybrida_dev.rbac_item;
DELETE FROM hybrida_dev.rbac_itemchild;

INSERT INTO hybrida_dev.rbac_assignment SELECT * FROM hybrida.rbac_assignment;
INSERT INTO hybrida_dev.rbac_item  SELECT * FROM hybrida.rbac_item;
INSERT INTO hybrida_dev.rbac_itemchild SELECT * FROM hybrida.rbac_itemchild;

DELETE FROM hybrida_dev.group_membership
INSERT INTO hybrida_dev.group_membership SELECT * FROM hybrida.group_membership

-- Fjerner alle bilder
DELETE FROM image;
UPDATE `user` SET imageId = NULL;
UPDATE `news` SET imageId = NULL;