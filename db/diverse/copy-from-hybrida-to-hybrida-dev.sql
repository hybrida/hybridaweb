-- kopierer fra hybrida-database til hybrida_dev

DELETE FROM hybrida_dev.`rbac_assignment`;
DELETE FROM hybrida_dev.rbac_item;
DELETE FROM hybrida_dev.rbac_itemchild;

INSERT INTO hybrida_dev.rbac_item  SELECT * FROM hybrida.rbac_item;
INSERT INTO hybrida_dev.rbac_itemchild SELECT * FROM hybrida.rbac_itemchild;
INSERT INTO hybrida_dev.rbac_assignment SELECT * FROM hybrida.rbac_assignment;

DELETE FROM hybrida_dev.group_membership;
INSERT INTO hybrida_dev.group_membership SELECT * FROM hybrida.group_membership;

DELETE FROM hybrida_dev.articles;
INSERT INTO hybrida_dev.articles SELECT * FROM hybrida.articles

DELETE FROM hybrida_dev.news;
INSERT INTO hybrida_dev.news SELECT * FROM hybrida.news
