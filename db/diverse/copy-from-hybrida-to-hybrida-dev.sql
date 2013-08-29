-- kopierer fra hybrida-database til hybrida_dev

-- Rettigheter
DELETE FROM hybrida_dev.`rbac_assignment`;
DELETE FROM hybrida_dev.rbac_item;
DELETE FROM hybrida_dev.rbac_itemchild;

INSERT INTO hybrida_dev.rbac_item  SELECT * FROM hybrida.rbac_item;
INSERT INTO hybrida_dev.rbac_itemchild SELECT * FROM hybrida.rbac_itemchild;
INSERT INTO hybrida_dev.rbac_assignment SELECT * FROM hybrida.rbac_assignment;

-- Gruppemedlemskap
DELETE FROM hybrida_dev.group_membership;
INSERT INTO hybrida_dev.group_membership SELECT * FROM hybrida.group_membership;

-- Artikler
DELETE FROM hybrida_dev.article;
INSERT INTO hybrida_dev.article SELECT * FROM hybrida.article;

-- Brukere
SET FOREIGN_KEY_CHECKS=0;
DELETE FROM hybrida_dev.user;
INSERT INTO hybrida_dev.user SELECT * FROM hybrida.user;
SET FOREIGN_KEY_CHECKS=1;
