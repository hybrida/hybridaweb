<?php

return array(
	'http://login.hybrida.no' => '/site/innsidaLogin',
	'admin/articles' => '/admin/articles',
	'admin/news' => '/admin/news',
	'admin/stats' => '/admin/stats',
	'alumni/<action:\w+>' => '/graduate/<action>',
	'alumni/form' => 'alumni/form',
	'alumni' => '/graduate/index',
	'alumni/<id:\d+>' => '/graduate/graduationyear',
	'artikler/<id:\d+>/<title>' => '/article/view',
    'artikler/<id:\d+>/' => '/article/view',
    'avstemning' => '/poll',
    'avstemning/opprett' => '/poll/create',
    'avstemning/<id:\d+>' => '/poll/vote',
    'avstemning/<id:\d+>/rediger' => '/poll/edit',
    'avstemning/<id:\d+>/resultater' => '/poll/results',

    'bedpres/<id:\d+>/<title>' => 'bpc/default/view',
	'bilde/<size:\w+>/<id:\d+>' => 'image/view',
	'bk' => 'bk/bktool/index',
	'bk/<action:\w+>' => 'bk/bktool/<action>',

	'galleri' => 'gallery/album',
	'galleri/<id:\d+>' => 'gallery/album/view',
	'galleri/<id:\d+>/<pid:\d+>' => 'gallery/album/picview',
	'galleri/album' => 'gallery/album',
	'galleri/<action:\w+>' => 'gallery/album/<action>',
	'galleri/<action:\w+>/<id:\d+>' => 'gallery/album/<action>',
	'galleri/<action:\w+>/<id:\d+>/<pid:\d+>' => 'gallery/album/<action>',

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
	'nyheter/<id:\d+>/' => 'news/view',

	'profil' => '/profile/',
	'profil/<username:\w+>/<action:\w+>' => 'profile/<action>/',
	'profil/<username:\w+>' => '/profile/info/',

	'test' => 'dev/default/test',
	'html' => 'dev/default/html',

	'varslinger' => '/notifications',

	'bigdaddy/<action:\w+>' => 'timetracker/default/<action>',
	'thetrumanshow/<action:\w+>' => 'timetracker/default/<action>',
	'bigdaddy' => 'timetracker/default/index',
	'thetrumanshow' => 'timetracker/default/index',

	'dev/login/<id:\w+>' => 'dev/default/login',
	'<module:(dev|ajax)>/<action:\w+>/<id:\d+>' => '<module>/default/<action>',
	'<module:(dev|ajax)>/<action:\w+>' => '<module>/default/<action>',
	'<controller:\w+>/<id:\d+>' => '<controller>/view',
	'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
	'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
);
