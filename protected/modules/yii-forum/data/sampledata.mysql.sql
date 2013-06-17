INSERT INTO `forumuser` (`id`, `siteid`, `name`) VALUES
	(1, 'admin', 'admin'),
	(2, 'demo', 'demo');

INSERT INTO `forum` (`id`, `parent_id`, `title`, `description`, `listorder`, `is_locked`) VALUES
	(1, NULL, 'Announcements', 'Announcements', 0, 1),
	(2, 1, 'New releases', 'Announcements about new releases', 10, 0),
	(3, NULL, 'Support', '', 20, 0),
	(4, 3, 'Installation and configuration', 'Problems with installation and/or configuration, incompatibility issues, etc.', 10, 0),
	(5, 3, 'Bugs', 'Things not working at all, or not as they should', 20, 0),
	(6, 3, 'Missing features', 'Fetures you think should be included in a future release', 30, 0);

INSERT INTO `thread` (`id`, `forum_id`, `subject`, `is_sticky`, `is_locked`, `view_count`, `created`) VALUES
	(1, 2, 'First release', 1, 0, 27, 0),
	(2, 5, 'Subject is allowed to be blank when creating a new thread', 0, 0, 4, 0),
	(3, 5, 'Post date is not set', 0, 1, 16, 0),
	(4, 5, 'Forum view does not show correct last post', 0, 1, 10, 1349540563),
	(5, 6, 'User signatures', 0, 0, 1, 1349570366),
	(6, 6, 'BB Code', 0, 0, 1, 1349570413),
	(7, 5, 'Attachments', 0, 0, 21, 1349578699);

INSERT INTO `post` (`id`, `author_id`, `thread_id`, `editor_id`, `content`, `created`, `updated`) VALUES
	(1, 1, 1, NULL, 'The first release is a fact!', 0, 0),
	(2, 2, 2, NULL, 'This obviously can\'t be right.', 0, 0),
	(3, 2, 3, NULL, 'When posting a new thread, the creation date is set to Jan 1, 1970 01:00:00 AM...', 0, 0),
	(4, 2, 3, NULL, 'This should be fixed now!', 2012, 2012),
	(5, 2, 3, NULL, 'Oops! Let\'s try that again...\r\nThis should be fixed now!', 1349540442, 1349540442),
	(6, 2, 4, NULL, 'I believe it shows the the last thread instead...', 1349540563, 1349540563),
	(7, 2, 4, NULL, 'Fixed!', 1349561144, 1349561144),
	(8, 1, 4, NULL, 'Test reply', 1349563344, 1349563344),
	(9, 1, 4, NULL, 'Another test reply, locking thread', 1349563360, 1349563360),
	(10, 1, 4, NULL, 'Opps. Locking thread for real now', 1349564868, 1349564868),
	(11, 1, 3, NULL, 'Thread locked, maybe', 1349564945, 1349632036),
	(12, 1, 5, NULL, 'Allow users to define a signature, and add this to posts by them.', 1349570366, 1349570366),
	(13, 1, 6, NULL, 'Add BB code support, and some sort of wysiwyg editor', 1349570413, 1349570413),
	(14, 1, 7, NULL, 'Allow attachments to be added to posts\r\n\r\nSome *examples* of **markup**\r\n\r\ninline use of `code` is possible too!\r\n\r\nLet\'s see what a\r\n> blockquote looks like\r\nwithin a pargraph\r\n\r\n    [php showLineNumbers=1]\r\n    echo \'It can highlight code too!\';\r\n', 1349578699, 1349578699);
