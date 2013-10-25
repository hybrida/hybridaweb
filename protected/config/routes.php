<?php

return array(
	'admin/articles' => '/admin/articles',
	'admin/news' => '/admin/news',
	'admin/stats' => '/admin/stats',
	'alumni/<action:\w+>' => '/graduate/<action>',
	'alumni/form' => 'alumni/form',
	'alumni' => '/graduate/index',
	'alumni/<id:\d+>' => '/graduate/graduationyear',
	'artikler/<id:\d+>/<title>' => '/article/view',

	'bedpres/<id:\d+>/<title>' => 'bpc/default/view',
	'bilde/<size:\w+>/<id:\d+>' => 'image/view',
	'bk' => 'bk/bktool/index',
	'bk/<action:\w+>' => 'bk/bktool/<action>',

	'gallery' => 'gallery/album',
	'gallery/<id:\d+>' => 'gallery/album/view',
	'gallery/<id:\d+>/<pid:\d+>' => 'gallery/album/picview',
	'gallery/album' => 'gallery/album',
	'gallery/<action:\w+>' => 'gallery/album/<action>',
	'gallery/<action:\w+>/<id:\d+>' => 'gallery/album/<action>',
	'gallery/<action:\w+>/<id:\d+>/<pid:\d+>' => 'gallery/album/<action>',

	'get/<extra:\w+>' => 'ajax/get/<extra>',
	'grupper' => 'group/index',
	'grupper/<url:\w+>/<action:\w+>' => 'group/<action>',
	'grupper/<url:\w+>' => '/group/view',

	'jobb' => 'jobAnnouncement/jobAnnouncement/index',
	'jobb/<action:\w+>' => 'jobAnnouncement/jobAnnouncement/<action>',
	'jobb/<id:\d>/<name>' => 'jobAnnouncement/jobAnnouncement/view',

	'kalender' => '/calendar/default/index',
	'nyheter' => 'newsfeed/index',
	'nyheter/<id:\d+>/<title>' => 'news/view',

	'profil' => '/profile/',
	'profil/<username:\w+>/<action:\w+>' => 'profile/<action>/',
	'profil/<username:\w+>' => '/profile/info/',

	'test' => 'dev/default/test',
	'html' => 'dev/default/html',

	'varslinger' => '/notifications',

	'bigdaddy/<action:\w+>' => 'timetracker/default/<action>',
	'bigdaddy' => 'timetracker/default/index',

	'dev/login/<id:\w+>' => 'dev/default/login',
	'<module:(dev|ajax)>/<action:\w+>/<id:\d+>' => '<module>/default/<action>',
	'<module:(dev|ajax)>/<action:\w+>' => '<module>/default/<action>',
	'<controller:\w+>/<id:\d+>' => '<controller>/view',
	'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
	'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
);
