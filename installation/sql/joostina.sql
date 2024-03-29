--
-- Структура таблицы `#__attached`
--

CREATE TABLE IF NOT EXISTS `#__attached` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) unsigned NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `file_ext` varchar(5) NOT NULL,
  `file_mime` varchar(20) NOT NULL,
  `file_size` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `#__attached`
--


-- --------------------------------------------------------

--
-- Структура таблицы `#__bookmarks`
--

CREATE TABLE IF NOT EXISTS `#__bookmarks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `obj_id` int(11) unsigned NOT NULL,
  `obj_option` varchar(30) NOT NULL,
  `obj_task` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`obj_id`,`obj_option`,`obj_task`),
  KEY `user_id_2` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `#__bookmarks`
--


-- --------------------------------------------------------

--
-- Структура таблицы `#__comments`
--

CREATE TABLE IF NOT EXISTS `#__comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `obj_id` int(11) unsigned NOT NULL DEFAULT '0',
  `obj_option` varchar(30) NOT NULL,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0',
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_ip` varchar(50) NOT NULL,
  `comment_text` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `state` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `obj_id` (`obj_id`,`obj_option`),
  KEY `state` (`state`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `#__comments`
--

INSERT INTO `#__comments` (`id`, `obj_id`, `obj_option`, `user_id`, `user_name`, `user_email`, `user_ip`, `comment_text`, `created_at`, `state`) VALUES
(1, 1, 'Pages', 1, 'admin', '', '', 'qwewq ew', '2010-05-21 00:42:39', 1),
(2, 1, 'Pages', 1, 'admin', '', '', '1 3ewqe wqeПоддржвает компоненты через плагины, возрождающие добрую традицию register globals. * VirtueMart, очень многофункциональный интернет-магазин, мамонтдинозавр среди расширений сабжа. Это стороннее расширение имеет сотни сторонних расширений. За три года существования версии 1.5 этот монстр так и не переписан на архитектуру MVC и только дополнен множеством костылей в использовании API для работы с этой версией. Ещё один нюанс, который раньше&#8230;', '2010-05-21 00:42:43', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `#__comments_counter`
--

CREATE TABLE IF NOT EXISTS `#__comments_counter` (
  `obj_id` int(11) unsigned NOT NULL,
  `obj_option` varchar(30) NOT NULL,
  `last_user_id` int(11) unsigned NOT NULL,
  `last_comment_id` int(11) unsigned NOT NULL,
  `counter` int(11) unsigned NOT NULL,
  UNIQUE KEY `obj_id` (`obj_id`,`obj_option`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `#__comments_counter`
--

INSERT INTO `#__comments_counter` (`obj_id`, `obj_option`, `last_user_id`, `last_comment_id`, `counter`) VALUES
(1, 'Pages', 1, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `#__components`
--

CREATE TABLE IF NOT EXISTS `#__components` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `menuid` int(11) unsigned NOT NULL DEFAULT '0',
  `parent` int(11) unsigned NOT NULL DEFAULT '0',
  `admin_menu_link` varchar(255) NOT NULL DEFAULT '',
  `admin_menu_alt` varchar(255) NOT NULL DEFAULT '',
  `option` varchar(50) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `admin_menu_img` varchar(255) NOT NULL DEFAULT '',
  `iscore` tinyint(4) NOT NULL DEFAULT '0',
  `params` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `#__components`
--

INSERT INTO `#__components` (`id`, `name`, `link`, `menuid`, `parent`, `admin_menu_link`, `admin_menu_alt`, `option`, `ordering`, `admin_menu_img`, `iscore`, `params`) VALUES
(1, 'Странички', 'option=com_pages', 0, 0, 'option=com_pages', 'Странички', 'com_pages', 0, 'administrator/images/menu/icon-16-featured.png', 0, ''),
(2, 'Авторизация', 'option=com_login', 0, 0, 'option=com_login', 'wqewe', 'com_login', 0, 'administrator/images/menu/icon-16-clear.png', 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `#__config`
--

CREATE TABLE IF NOT EXISTS `#__config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(255) NOT NULL,
  `subgroup` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `#__config`
--


-- --------------------------------------------------------

--
-- Структура таблицы `#__groups`
--

CREATE TABLE IF NOT EXISTS `#__groups` (
  `id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `#__groups`
--

INSERT INTO `#__groups` (`id`, `name`) VALUES
(0, 'Общий'),
(1, 'Участники'),
(2, 'Специальный');

-- --------------------------------------------------------

--
-- Структура таблицы `#__hits`
--

CREATE TABLE IF NOT EXISTS `#__hits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `obj_id` int(11) unsigned NOT NULL,
  `obj_option` varchar(30) NOT NULL,
  `obj_task` varchar(20) NOT NULL,
  `hit` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `obj_id` (`obj_id`,`obj_option`,`obj_task`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `#__hits`
--

INSERT INTO `#__hits` (`id`, `obj_id`, `obj_option`, `obj_task`, `hit`) VALUES
(1, 1, 'pages', 'view', 27);

-- --------------------------------------------------------

--
-- Структура таблицы `#__mambots`
--

CREATE TABLE IF NOT EXISTS `#__mambots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `element` varchar(100) NOT NULL DEFAULT '',
  `folder` varchar(100) NOT NULL DEFAULT '',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `iscore` tinyint(3) NOT NULL DEFAULT '0',
  `client_id` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `params` text,
  PRIMARY KEY (`id`),
  KEY `idx_folder` (`published`,`client_id`,`access`,`folder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `#__mambots`
--


-- --------------------------------------------------------

--
-- Структура таблицы `#__menu`
--

CREATE TABLE IF NOT EXISTS `#__menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menutype` varchar(25) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `link_title` varchar(200) NOT NULL,
  `link` text,
  `type` varchar(50) NOT NULL DEFAULT '',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `parent` int(11) unsigned NOT NULL DEFAULT '0',
  `componentid` int(11) unsigned NOT NULL DEFAULT '0',
  `sublevel` int(11) DEFAULT '0',
  `ordering` int(11) DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pollid` int(11) NOT NULL DEFAULT '0',
  `browserNav` tinyint(4) DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `utaccess` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `params` text,
  PRIMARY KEY (`id`),
  KEY `componentid` (`componentid`,`menutype`,`published`,`access`),
  KEY `menutype` (`menutype`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `#__menu`
--

INSERT INTO `#__menu` (`id`, `menutype`, `name`, `link_title`, `link`, `type`, `published`, `parent`, `componentid`, `sublevel`, `ordering`, `checked_out`, `checked_out_time`, `pollid`, `browserNav`, `access`, `utaccess`, `params`) VALUES
(1, 'mainmenu', 'Главная', 'Главнее не бывает', 'index.php?option=com_pages', 'components', 1, 0, 1, 0, 9999, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, '{ "page_id": "1" }');

-- --------------------------------------------------------

--
-- Структура таблицы `#__modules`
--

CREATE TABLE IF NOT EXISTS `#__modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `content` text,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `position` varchar(10) DEFAULT NULL,
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(50) DEFAULT NULL,
  `numnews` int(11) NOT NULL DEFAULT '0',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `showtitle` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `params` text,
  `iscore` tinyint(4) NOT NULL DEFAULT '0',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  `cache_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `#__modules`
--

INSERT INTO `#__modules` (`id`, `title`, `content`, `ordering`, `position`, `checked_out`, `checked_out_time`, `published`, `module`, `numnews`, `access`, `showtitle`, `params`, `iscore`, `client_id`, `cache_time`) VALUES
(3, 'Главное меню', '', 2, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_menu', 0, 0, 0, '', 0, 0, 32767),
(4, 'Авторизация', '', 1, 'left', 0, '0000-00-00 00:00:00', 1, 'mod_login', 0, 0, 0, '""', 0, 0, 0),
(19, 'Компоненты', '', 2, 'cpanel', 0, '0000-00-00 00:00:00', 1, 'mod_components', 0, 99, 1, '', 0, 1, 0),
(23, 'Последние зарегистрированные пользователи', '', 4, 'advert2', 0, '0000-00-00 00:00:00', 0, 'mod_latest_users', 0, 99, 1, '', 0, 1, 0),
(26, 'Полное меню', '', 1, 'top', 0, '0000-00-00 00:00:00', 1, 'mod_fullmenu', 0, 99, 1, '', 0, 1, 0),
(27, 'Путь', '', 1, 'pathway', 0, '0000-00-00 00:00:00', 1, 'mod_pathway', 0, 99, 1, '', 0, 1, 0),
(28, 'Панель инструментов', '', 1, 'toolbar', 0, '0000-00-00 00:00:00', 1, 'mod_toolbar', 0, 99, 1, '', 0, 1, 0),
(29, 'Системные сообщения', '', 1, 'inset', 0, '0000-00-00 00:00:00', 1, 'mod_mosmsg', 0, 99, 1, '', 0, 1, 0),
(30, 'Кнопки быстрого доступа', '', 1, 'icon', 0, '0000-00-00 00:00:00', 1, 'mod_quickicons', 0, 99, 1, '{ "use_cache": "1", "use_ext": "0" }', 0, 1, 604800);

-- --------------------------------------------------------

--
-- Структура таблицы `#__modules_menu`
--

CREATE TABLE IF NOT EXISTS `#__modules_menu` (
  `moduleid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`moduleid`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `#__modules_menu`
--

INSERT INTO `#__modules_menu` (`moduleid`, `menuid`) VALUES
(1, 0),
(3, 0),
(4, 0),
(10, 1),
(17, 0),
(18, 0),
(30, 0),
(31, 0),
(32, 0),
(33, 0),
(34, 0),
(35, 0),
(36, 0),
(37, 0),
(37, 1),
(38, 0),
(38, 1),
(39, 0),
(39, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `#__pages`
--

CREATE TABLE IF NOT EXISTS `#__pages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `title_page` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `text` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `meta_description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `state` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `state` (`state`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `#__pages`
--

INSERT INTO `#__pages` (`id`, `title`, `title_page`, `slug`, `text`, `meta_keywords`, `meta_description`, `created_at`, `state`) VALUES
(1, 'Joomla!', 'Joomla! CMS - ес, ес, есссс', ' wr wewer wwre r er', 'Mambo, скопипащеный c доработкой напильником в 2005 году как Joomla 1.0. В течение четырёх лет ветку 1.0 допиливали, паралельно уже через 2,5 года выпустив версию 1.5, в которой полностью поменяли архитектуру, переписав расширения на MVC (большинство поддерживаемых расширений уже переписаны с поддержкой MVC и какой-то части API и соглашений Joomla!). Тем не менее всё и сейчас работает через универсальный интерфейс, достаточно посмотреть хотя бы количество кода любого стандартного компонента с небогатой функциональностью, вроде контактов. Сейчас доступна вторая альфа версии 1.6, где обещают расширить систему прав пользователей и сделать неограниченную вложенность категорий (см. ниже).\r\n\r\nНе смотря на лицензию GNU GPL v.2, не является полностью свободной, так как использует с разрешения правообладателя несвободные иконки для тулбара административного интерфейса, из-за чего не попала в ортодоксальный Debian GNU/Linux (и не надо).\r\n\r\nСейчас является самой популярной среди вебконтор-однодневок, фрилансеров и просто людей, которые решили зафигачить себе крутой сайт за один день (впрочем, Ucoz среди последних популярнее).\r\n\r\nОсновноеЕдинственное преимущество перед конкурентами — over 9000 готовых сторонних кривых, ущербных и монструозных свободных и бесплатных расширений, большого количества платных (из них единицы качеством превышают сабж, остальные на том же уровне) и разнообразных шаблонов, бесплатных и платных. Наибольшей популярностью из них пользуются расширения:\r\n\r\n    * Joom!Fish, обеспечивающее многоязычность (в нормальных CMS это реализовано из коробки, из-за чего куда более юзабельно; Джумлу же обычно проще установить отдельно для каждого языка).\r\n    * sh404SEF (стал менее популярным, когда стал платным), изменяющий вид URL (из коробки SEF присутствует, но он ненастраиваемый), что хорошо реализовано из коробки во всех остальных CMS. Поддржвает компоненты через плагины, возрождающие добрую традицию register globals.\r\n    * VirtueMart, очень многофункциональный интернет-магазин, мамонтдинозавр среди расширений сабжа. Это стороннее расширение имеет сотни сторонних расширений. За три года существования версии 1.5 этот монстр так и не переписан на архитектуру MVC и только дополнен множеством костылей в использовании API для работы с этой версией. \r\n\r\nЕщё один нюанс, который раньше был большим приемуществом - большое комьюнити. Но, на данный момент не актуально, поскольку джумла уже достала всех более-менее вменяемых программеров и в комьюнити сейчас ошивается в основном феерическое нубье и школота (ну и deadKrolik, куда ж без него).\r\n\r\nТакже основной компонент «Статьи» (Content) допускает лишь трёхуровневую структуру «Раздел» — «Категория» — «Статья», из-за чего для многих сайтов совершенно неюзабелен.\r\n\r\nПримечательная особенность сабжа в привязке структуры к меню. К меню же привязана куча настроек расшиений-компонентов, которые невозможно задать иначе как созданием пункта в меню (если такой пункт не нужен — то в скрытом меню (недокументированная возможность)).\r\n\r\nПодробная документация для разработчиков написана на языке PHP, есть также обрывки записек тусовки сумасшедших на английском. ', 'хыть', 'ыть', '2010-05-20 00:24:33', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `#__quickicons`
--

CREATE TABLE IF NOT EXISTS `#__quickicons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(64) NOT NULL DEFAULT '',
  `target` varchar(255) NOT NULL DEFAULT '',
  `icon` varchar(100) NOT NULL DEFAULT '',
  `ordering` int(10) unsigned NOT NULL DEFAULT '0',
  `new_window` tinyint(1) NOT NULL DEFAULT '0',
  `published` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `title` varchar(64) NOT NULL DEFAULT '',
  `display` tinyint(1) NOT NULL DEFAULT '0',
  `access` int(11) unsigned NOT NULL DEFAULT '0',
  `gid` int(3) DEFAULT '25',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `#__quickicons`
--

INSERT INTO `#__quickicons` (`id`, `text`, `target`, `icon`, `ordering`, `new_window`, `published`, `title`, `display`, `access`, `gid`) VALUES
(1, 'Комментарии', 'index2.php?option=com_comments', '/administrator/images/quickicons/USB-Connection.png', 5, 0, 1, 'Управление комментариями', 0, 0, 0),
(2, 'Редактор меню', 'index2.php?option=com_menumanager', '/administrator/images/quickicons/Photo-Settings.png', 9, 0, 1, 'Управление объектами меню', 0, 0, 8),
(3, 'Пользователи', 'index2.php?option=com_users', '/administrator/images/quickicons/Power-Save-Settings.png', 10, 0, 1, 'Управление пользователями', 0, 0, 8),
(4, 'Странички', 'index2.php?option=com_pages', '/administrator/images/quickicons/Online-Instruction-Manuals.png', 0, 0, 1, '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `#__session`
--

CREATE TABLE IF NOT EXISTS `#__session` (
  `username` varchar(50) DEFAULT '',
  `time` varchar(14) DEFAULT '',
  `session_id` varchar(200) NOT NULL DEFAULT '0',
  `guest` tinyint(4) DEFAULT '1',
  `userid` int(11) DEFAULT '0',
  `groupname` varchar(50) DEFAULT NULL,
  `gid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_id`(64)),
  KEY `whosonline` (`guest`,`groupname`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `#__session`
--

INSERT INTO `#__session` (`username`, `time`, `session_id`, `guest`, `userid`, `groupname`, `gid`) VALUES
('admin', '1274395566', 'e52b8e9518b6942a055d6e138402cd23', 0, 1, 'SuperAdministrator', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `#__tags`
--

CREATE TABLE IF NOT EXISTS `#__tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `obj_id` int(11) NOT NULL,
  `obj_option` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tag` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `obj_id` (`obj_id`,`obj_option`),
  KEY `tag_text` (`tag`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `#__tags`
--

INSERT INTO `#__tags` (`id`, `obj_id`, `obj_option`, `tag`) VALUES
(12, 1, 'pages', 'уцй'),
(11, 1, 'pages', 'уцй'),
(10, 1, 'pages', 'у12312ууцй'),
(9, 1, 'pages', 'йуцйуцйу'),
(8, 1, 'pages', 'йцуцйуцйу'),
(13, 1, 'pages', 'уцй'),
(14, 1, 'pages', 'уцйуцйуцйу'),
(15, 1, 'pages', '555555555'),
(16, 1, 'pages', '88888'),
(17, 1, 'pages', '00000000');

-- --------------------------------------------------------

--
-- Структура таблицы `#__templates_menu`
--

CREATE TABLE IF NOT EXISTS `#__templates_menu` (
  `template` varchar(50) NOT NULL DEFAULT '',
  `menuid` int(11) NOT NULL DEFAULT '0',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`template`,`menuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `#__templates_menu`
--

INSERT INTO `#__templates_menu` (`template`, `menuid`, `client_id`) VALUES
('newline2', 0, 0),
('joostfree', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `#__template_positions`
--

CREATE TABLE IF NOT EXISTS `#__template_positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(10) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `#__template_positions`
--

INSERT INTO `#__template_positions` (`id`, `position`, `description`) VALUES
(1, 'left', ''),
(2, 'right', ''),
(3, 'top', ''),
(4, 'bottom', ''),
(5, 'inset', ''),
(6, 'banner', ''),
(7, 'header', ''),
(8, 'footer', ''),
(9, 'newsflash', ''),
(10, 'legals', ''),
(11, 'pathway', ''),
(12, 'toolbar', ''),
(13, 'cpanel', ''),
(14, 'user1', ''),
(15, 'user2', ''),
(16, 'user3', ''),
(17, 'user4', ''),
(18, 'user5', ''),
(19, 'user6', ''),
(20, 'user7', ''),
(21, 'user8', ''),
(22, 'user9', ''),
(23, 'advert1', ''),
(24, 'advert2', ''),
(25, 'advert3', ''),
(26, 'icon', ''),
(27, 'debug', '');

-- --------------------------------------------------------

--
-- Структура таблицы `#__trash`
--

CREATE TABLE IF NOT EXISTS `#__trash` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `obj_id` int(11) unsigned NOT NULL,
  `obj_table` varchar(50) NOT NULL,
  `title` varchar(250) NOT NULL,
  `data` longtext NOT NULL,
  `user_id` int(11) NOT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `#__trash`
--


-- --------------------------------------------------------

--
-- Структура таблицы `#__users`
--

CREATE TABLE IF NOT EXISTS `#__users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `openid` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL DEFAULT '',
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `gid` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `groupname` varchar(50) NOT NULL,
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL DEFAULT '',
  `bad_auth_count` int(2) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idxemail` (`email`),
  KEY `block_id` (`state`,`id`),
  KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `#__users`
--

INSERT INTO `#__users` (`id`, `username`, `email`, `openid`, `password`, `state`, `gid`, `groupname`, `registerDate`, `lastvisitDate`, `activation`, `bad_auth_count`) VALUES
(1, 'admin', 'bost568@gmail.com', '', 'e29ee15d7f622a649e700fb352d67c00:OBzKuRoiLAF8aD12', 1, 8, 'SuperAdministrator', '2010-05-20 14:43:52', '2010-05-21 03:52:33', '0', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `#__user_extra`
--

CREATE TABLE IF NOT EXISTS `#__user_extra` (
  `user_id` int(11) NOT NULL,
  `gender` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `about` text,
  `location` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icq` varchar(255) NOT NULL,
  `skype` varchar(255) NOT NULL,
  `jabber` varchar(255) NOT NULL,
  `msn` varchar(255) NOT NULL,
  `yahoo` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `mobil` varchar(255) NOT NULL,
  `birthdate` date DEFAULT '0000-00-00',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `#__user_extra`
--


-- --------------------------------------------------------

--
-- Структура таблицы `#__user_groups`
--

CREATE TABLE IF NOT EXISTS `#__user_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_usergroup_title_lookup` (`title`),
  KEY `idx_usergroup_adjacency_lookup` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `#__user_groups`
--

INSERT INTO `#__user_groups` (`id`, `parent_id`, `title`) VALUES
(1, 0, 'Public'),
(2, 1, 'Registered'),
(3, 2, 'Author'),
(4, 3, 'Editor'),
(5, 4, 'Publisher'),
(6, 1, 'Manager'),
(7, 6, 'Administrator'),
(8, 7, 'SuperAdministrator');
