#
# Данные для таблицы `#__banner`
#
INSERT INTO `#__banner` VALUES (1, 1, 'banner', 'OSM 1', 0, 42, 0, 'osmbanner1.png', 'http://www.opensourcematters.org', '2004-07-07 15:31:29', 1, 0, '0000-00-00 00:00:00', NULL, NULL);
#
# Данные для таблицы `#__bannerclient`
#
INSERT INTO `#__bannerclient` VALUES (1, 'Реклама на нашем сайте', 'Administrator', 'none@none.ru', '', 0, '00:00:00', NULL);

#
# Данные для таблицы `#__categories`
#

INSERT INTO `#__categories` VALUES (1, 0, 'Новое', 'Последние новости', 'taking_notes.jpg', '1', 'left', 'Последние новости от команды разработчиков Joostina!', 1, 0, '0000-00-00 00:00:00', '', 0, 0, 1, '');
INSERT INTO `#__categories` VALUES (2, 0, 'Joostina!', 'Joostina!', 'clock.jpg', 'com_weblinks', 'left', 'Избранные ссылки на сайты, связанные с проектом Joostina!', 1, 0, '0000-00-00 00:00:00', NULL, 0, 0, 0, '');
INSERT INTO `#__categories` VALUES (3, 0, 'Краткие новости', 'Краткие новости', '', '2', 'left', '', 1, 0, '0000-00-00 00:00:00', '', 0, 0, 0, '');
INSERT INTO `#__categories` VALUES (4, 0, 'Joostina!', 'Joostina!', '', 'com_newsfeeds', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 2, 0, 0, '');
INSERT INTO `#__categories` VALUES (5, 0, 'Бизнес: основное', 'Бизнес: основное', '', 'com_newsfeeds', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 1, 0, 0, '');
INSERT INTO `#__categories` VALUES (7, 0, 'Примеры', 'Пример Ча.Во. (FAQ)', 'key.jpg', '3', 'left', 'Здесь Вы найдете ответы на часто задаваемые вопросы.', 1, 0, '0000-00-00 00:00:00', NULL, 0, 0, 2, '');
INSERT INTO `#__categories` VALUES (9, 0, 'Финансы', 'Финансы', '', 'com_newsfeeds', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 5, 0, 0, '');
INSERT INTO `#__categories` VALUES (10, 0, 'Linux', 'Linux', '', 'com_newsfeeds', 'left', '<br />\r\n', 1, 0, '0000-00-00 00:00:00', NULL, 6, 0, 0, '');
INSERT INTO `#__categories` VALUES (11, 0, 'Интернет', 'Интернет', '', 'com_newsfeeds', 'left', '', 1, 0, '0000-00-00 00:00:00', NULL, 7, 0, 0, '');
INSERT INTO `#__categories` VALUES (12, 0, 'Контакты', 'Контакты', '', 'com_contact_details', 'left', 'Подробная контактная информация для этого сайта', 1, 0, '0000-00-00 00:00:00', NULL, 0, 0, 0, '');
INSERT INTO `#__categories` VALUES (13, 0, 'Joomla! по-русски', 'Joomla! по-русски', 'web_links.jpg', 'com_weblinks', 'left', 'Сайты о Joomla! на русском языке.', 1, 0, '0000-00-00 00:00:00', NULL, 0, 0, 0, '');

#
# Данные для таблицы `#__contact_details`
#

INSERT INTO `#__contact_details` VALUES (1, 'Имя', 'Положение', 'Улица', 'Район', 'Область(край)', 'Страна', 'Индекс', 'Телефон', 'Факс', 'Дополнительная информация', '', 'top', 'email@email.com', 1, 1, 0, '0000-00-00 00:00:00', 1, '', 0, 12, 0);

#
# Данные для таблицы `#__content`
#

INSERT INTO `#__content` VALUES (1, 'Спасибо за выбор Joostina!', 'Спасибо за выбор Joostina!', '{mosimage}Поздравляем! Если Вы видите это сообщение &ndash; то Joostina успешно установлена и готова к работе. Благодарим за выбор CMS Joostina, надеемся что она оправдает возложенные на неё ожидания.<br /><p>После установки система уже содержит некоторое количество встроенных расширений, все они настроены на для быстрого начала работы. </p>',
'<br /><br /><h4><font color="#ff6600">Возможности Joostina!:</font></h4>\r\n
<ul>\r\n
<li>Полное управление компонентами базы данных и сайта.</li>\r\n
<li>Разделы новостей, товаров или сервисов полностью доступны для управления и редактирования</li> \r\n
<li>Темы разделов могут быть добавлены при сотрудничестве авторов </li>\r\n
<li>Полная настройка расположения блоков, включая левые, правые и центральные блоки меню </li>\r\n
<li>Загрузка изображений браузером в свою собственную библиотеку, для использования на сайте </li>\r\n
<li>Динамические модули форумов, опросов, голосований с показом результатов </li>\r\n
<li>Совместимость с Linux, FreeBSD, MacOSX server, Solaris и AIX \r\n</li></ul>\r\n
<h4>Большая управляемость:</h4>\r\n
<ul>\r\n
<li>Изменение порядка объектов, включая новости, часто задаваемые вопросы, статьи  и т.д. </li>\r\n
<li>Генератор важных новостей сайта </li>\r\n
<li>Возможность отправки авторами новостей, статей, FAQ и ссылок</li>\r\n
<li>Иерархия объектов - возможно создание разделов, категорий и страниц в желаемом порядке.</li>\r\n
<li>Библиотека изображений - возможность хранения своих документов в форматах PNG, PDF, DOC, XLS, GIF и JPEG прямо на сайте для облегчения дальнейшего использования</li>\r\n
<li>Автоматическое исправление путей. Вставьте изображение и дайте Joomla! исправить ссылку.</li>\r\n
<li>Менеджер новостных лент. Выберите интересные новости из 360 различных служб со всего света.</li>\r\n
<li>Менеджер архива. Можно поместить старые новости и статьи в архив, не удаляя их с сайта.</li>\r\n
<li>Каждый материал сайта можно "Отправить по почте другу" или "Распечатать".</li>\r\n
<li>Встроенный текстовый редактор, похожий на Word Pad.</li>\r\n
<li>Возможность настраивать доступ пользователей к определенным функциям.</li>\r\n
<li>Создание опросов и голосований как для отдельных страниц, так и для всего сайта.</li>\r\n
<li>Модули персональных страниц - возможность "оживить" свой сайт. </li>\r\n
<li>Менеджер шаблонов. Возможность скачать шаблоны и установить их на сайт за несколько секунд.</li>\r\n
<li>Возможность предварительного просмотра материалов перед публикацией.</li>\r\n
<li>Система управления баннерами. Заработайте на своём сайте!</li>
</ul>', 1, 1, 0, 1, '2007-10-14 11:54:06', 62, 'Web Master', '2005-10-14 12:33:27', 62, 0, '0000-00-00 00:00:00', '2007-10-28 00:00:00', '0000-00-00 00:00:00', 'asterisk.png|right|Логотип Joomla!|1|Логотип Joostina!|bottom|center|120', '', '', 1, 0, 1, '', '', 0, 0,'');
INSERT INTO `#__content` VALUES (2, 'Система управления содержимым', 'Система управления содержимым', 'Система управления содержимым/контентом (англ. Content management system, CMS) &mdash; компьютерная программа, используемая для управления содержимым чего-либо (обычно это содержимое рассматривается как неструктурированные данные предметной задачи в противоположность структурированным данным, обычно находящимися под управлением СУБД) . Обычно такие системы используются для хранения и публикации большого количества документов, изображений, музыки или видео.\n<br />','Частным случаем такого рода систем являются системы управления сайтами. Подобные CMS позволяют управлять текстовым и графическим наполнением веб-сайта, предоставляя пользователю удобные инструменты хранения и публикации информации.\n<br />\nСейчас существует множество готовых систем управления содержимым сайта, в том числе и бесплатных. Их можно разделить на три типа, по способу работы:\n<br />\nГенерация страниц по запросу. Системы такого типа работают на основе связки &laquo;Модуль редактирования &rarr; База данных &rarr; Модуль представления&raquo;. Модуль представления генерирует страницу с содержанием при запросе на него, на основе информации из базы данных. Информация в базе данных изменяется с помощью модуля редактирования. Страницы заново создаются сервером при каждом запросе, а это создаёт нагрузку на системные ресурсы. Нагрузка может быть многократно снижена при использовании средств кэширования, которые имеются в современных веб-серверах.<br />\nГенерация страниц при редактировании. Системы этого типа суть программы для редактирования страниц, которые при внесении изменений в содержание сайта создают набор статичных страниц. При таком способе жертвуется интерактивность между посетителем и содержимым сайта.\nСмешанный тип. Как понятно из названия, сочетает в себе преимущества первых двух. Может быть реализован путём кэширования &mdash; модуль представления генерирует страницу один раз, в дальнейшем она в разы быстрее подгружается из кэша. Кэш может обновляться как автоматически, по истечению некоторого срока времени или при внесении изменений в определённые разделы сайта, так и вручную по команде администратора. Другой подход &mdash; сохранение определённых информационных блоков на этапе редактирования сайта и сборка страницы из этих блоков при запросе соответствующей страницы пользователем.<br />\nТермин контент-менеджер обозначает род человеческой деятельности &mdash; редактор сайта.\n<br />\nБольшая часть современных систем управления содержимым реализуется с помощью визуального (WYSIWYG) редактора &mdash; программы, которая создает HTML-код из специальной упрощённой разметки, позволяющей пользователю проще форматировать текст.', 0, 1, 0, 1, '2007-10-28 23:08:06', 62, 'Материал из Википедии — свободной энциклопедии', '2007-10-28 23:08:27', 62, 0, '0000-00-00 00:00:00', '2007-10-28 00:00:00', '0000-00-00 00:00:00', '', '', '', 1, 0, 1, '', '', 0, 0,'');
INSERT INTO `#__content` VALUES (3, 'Краткая новость 2', '', 'Вчера весь персонал серверов в США вышел на забастовку с требованием увеличения оперативной памяти и мощности процессоров. Персонал серверов заявил, что увеличение оперативной памяти необходимо для увеличения скорости передачи данных. В будущем также потребуется увеличение скорости передачи данных в системных платах.', '', 1, 2, 1, 3, '2004-08-09 08:30:34', 62, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2004-08-09 00:00:00', '0000-00-00 00:00:00', '', '', '', 1, 0, 2, '', '', 0, 0,'');
INSERT INTO `#__content` VALUES (4, 'Краткая новость 3', '', 'Aoccdrnig to a rscheearch at an Elingsh uinervtisy, it deosn''t mttaer in waht oredr the ltteers in a wrod are, the olny iprmoetnt tihng is taht frist and lsat ltteer is at the rghit pclae. The rset can be a toatl mses and you can sitll raed it wouthit porbelm. Tihs is bcuseae we do not raed ervey lteter by itslef but the wrod as a wlohe.', '', 1, 2, 1, 3, '2004-08-09 08:30:34', 62, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2004-08-09 00:00:00', '0000-00-00 00:00:00', '', '', '', 1, 0, 3, '', '', 0, 1,'');
INSERT INTO `#__content` VALUES (5, 'Основные положения лицензии Joomla!', '', '<p>Этот веб-сайт работает на <a href="http://www.joostina.ru/">Joostina!</a>  Авторские права на программное обеспечение и встроенные шаблоны с 2007 г. принадлежат <a href="http://www.joostina.ru/">Joostina Team</a>.  Авторские права на все прочее содержимое или данные, включая данные, введенные на этом сайте, а также на шаблоны, добавленные после установки, принадлежат их владельцам.</p><p>Если Вы хотите распространять, копировать или модифицировать Joomla!, то Вы должны сначала ознакомиться с условиями <a href="http://www.gnu.org/copyleft/gpl.html#SEC1">Генеральной Публичной Лицензии GNU</a>.  Если Вы мало знакомы с этой лицензией, то можете прочитать <a href="http://www.gnu.org/copyleft/gpl.html#SEC4">''Как применять это соглашение для своей программы''</a> и <a href="http://www.gnu.org/licenses/gpl-faq.html">''Часто задаваемые вопросы и ответы по Лицензии GNU GPL''</a>.</p>', '', 1, 0, 0, 0, '2004-08-19 20:11:07', 62, '', '2005-08-19 20:14:49', 62, 0, '0000-00-00 00:00:00', '2005-08-19 00:00:00', '0000-00-00 00:00:00', '', '', 'menu_image=\nitem_title=1\npageclass_sfx=\nback_button=\nrating=\nauthor=\ncreatedate=\nmodifydate=\nprint=\nemail=', 1, 0, 11, '', '', 0, 10,'');
INSERT INTO `#__content` VALUES (6, 'Пример новости 1', 'Новость1', '{mosimage}Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,\r\nsed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit\r\namet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam\r\nvoluptua. At vero eos et accusam et justo duo dolores et ea rebum.', '<p>{mosimage}Duis autem vel eum iriure dolor in hendrerit in vulputate\r\nvelit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at\r\nvero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum\r\nzzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor\r\nsit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt\r\nut laoreet dolore magna aliquam erat volutpat.</p>\r\n\r\n<p>Ut wisi enim ad minim veniam, quis nostrud exerci tation\r\nullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis\r\nautem vel eum iriure dolor in hendrerit in vulputate velit esse molestie\r\nconsequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan\r\net iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis\r\ndolore te feugait nulla facilisi.</p>\r\n\r\n<p>Nam liber tempor cum soluta nobis eleifend option congue\r\nnihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum\r\ndolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod\r\ntincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim\r\nveniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut\r\naliquip ex ea commodo consequat.</p>\r\n\r\n<p>Duis autem vel eum iriure dolor in hendrerit in vulputate\r\nvelit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis. At\r\nvero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd\r\ngubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum\r\ndolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor\r\ninvidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero\r\neos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no\r\nsea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit\r\namet, consetetur sadipscing elitr, At accusam aliquyam diam diam dolore dolores\r\nduo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet\r\nclita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero\r\nvoluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet,\r\nconsetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore\r\net dolore magna aliquyam erat.</p>\r\n\r\n<p>Consetetur sadipscing elitr, sed diam nonumy eirmod tempor\r\ninvidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero\r\neos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no\r\nsea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit\r\namet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut\r\nlabore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam\r\net justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata\r\nsanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur\r\nsadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore\r\nmagna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo\r\ndolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est\r\nLorem ipsum dolor sit amet.</p>', 1, 1, 0, 1, '2004-07-07 11:54:06', 62, '', '2004-07-07 18:05:05', 62, 0, '0000-00-00 00:00:00', '2004-07-07 00:00:00', '0000-00-00 00:00:00', 'food/coffee.jpg|left||0\r\nfood/bread.jpg|right||0', '', '', 1, 0, 2, '', '', 0, 4,'');
INSERT INTO `#__content` VALUES (7, 'Пример новости 2', 'Новость2', '<p>{mosimage}Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,\r\nsed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit\r\namet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam\r\nvoluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem\r\nipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At\r\nvero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>', '', 1, 1, 0, 1, '2004-07-07 11:54:06', 62, '', '2004-07-07 18:11:30', 62, 0, '0000-00-00 00:00:00', '2004-07-07 00:00:00', '0000-00-00 00:00:00', 'food/bun.jpg|right||0', '', '', 1, 0, 3, '', '', 0, 2,'');
INSERT INTO `#__content` VALUES (8, 'Пример новости 3', 'Новость3', '<p>{mosimage}Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,\r\nsed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit\r\namet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam\r\nvoluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem\r\nipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At\r\nvero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>', '', 1, 1, 0, 1, '2004-04-12 11:54:06', 62, '', '2004-07-07 18:08:23', 62, 0, '0000-00-00 00:00:00', '2004-07-07 00:00:00', '0000-00-00 00:00:00', 'fruit/pears.jpg|right||0', '', '', 1, 0, 4, '', '', 0, 1,'');
INSERT INTO `#__content` VALUES (9, 'Пример новости 4', 'Новость4', '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,\r\nsed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam\r\nvoluptua. At\r\nvero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>', '<p>{mosimage}Duis autem vel eum iriure dolor in hendrerit in vulputate\r\nvelit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at\r\nvero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum\r\nzzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor\r\nsit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt\r\nut laoreet dolore magna aliquam erat volutpat.</p>\r\n\r\n{mospagebreak}<p>{mosimage}Ut wisi enim ad minim veniam, quis nostrud exerci tation\r\nullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis\r\nautem vel eum iriure dolor in hendrerit in vulputate velit esse molestie\r\nconsequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan\r\net iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis\r\ndolore te feugait nulla facilisi.</p>\r\n\r\n<p>{mosimage}Nam liber tempor cum soluta nobis eleifend option congue\r\nnihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum\r\ndolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod\r\ntincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim\r\nveniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut\r\naliquip ex ea commodo consequat.</p>\r\n\r\n<p>Duis autem vel eum iriure dolor in hendrerit in vulputate\r\nvelit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis. At\r\nvero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd\r\ngubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum\r\ndolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor\r\ninvidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero\r\neos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no\r\nsea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit\r\namet, consetetur sadipscing elitr, At accusam aliquyam diam diam dolore dolores\r\nduo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet\r\nclita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero\r\nvoluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet,\r\nconsetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore\r\net dolore magna aliquyam erat.</p>\r\n\r\n{mospagebreak}<p>Consetetur sadipscing elitr, sed diam nonumy eirmod tempor\r\ninvidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero\r\neos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no\r\nsea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit\r\namet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut\r\nlabore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam\r\net justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata\r\nsanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur\r\nsadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore\r\nmagna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo\r\ndolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est\r\nLorem ipsum dolor sit amet.</p>', 1, 1, 0, 1, '2004-07-07 11:54:06', 62, '', '2004-07-07 18:10:23', 62, 0, '0000-00-00 00:00:00', '2004-07-07 00:00:00', '0000-00-00 00:00:00', 'fruit/strawberry.jpg|left||0\r\nfruit/pears.jpg|right||0\r\nfruit/cherry.jpg|left||0', '', '', 1, 0, 5, '', '', 0, 6,'');
INSERT INTO `#__content` VALUES (10, 'Пример FAQ 1', 'FAQ1', '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,\r\nsed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam\r\nvoluptua. At\r\nvero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>', '', 1, 3, 0, 7, '2004-05-12 11:54:06', 62, '', '2004-07-07 18:10:23', 62, 0, '0000-00-00 00:00:00', '2004-01-01 00:00:00', '0000-00-00 00:00:00', '', '', '', 1, 0, 5, '', '', 0, 8,'');
INSERT INTO `#__content` VALUES (11, 'Пример FAQ 2', 'FAQ2', '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat,\r\nsed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam\r\nvoluptua. At\r\nvero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>', '<p>{mosimage}Duis autem vel eum iriure dolor in hendrerit in vulputate\r\nvelit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at\r\nvero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum\r\nzzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor\r\nsit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt\r\nut laoreet dolore magna aliquam erat volutpat.</p>\r\n\r\n<p>{mosimage}Ut wisi enim ad minim veniam, quis nostrud exerci tation\r\nullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis\r\nautem vel eum iriure dolor in hendrerit in vulputate velit esse molestie\r\nconsequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan\r\net iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis\r\ndolore te feugait nulla facilisi.</p>\r\n\r\n<p>{mosimage}Nam liber tempor cum soluta nobis eleifend option congue\r\nnihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum\r\ndolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod\r\ntincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim\r\nveniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut\r\naliquip ex ea commodo consequat.</p>\r\n\r\n<p>Duis autem vel eum iriure dolor in hendrerit in vulputate\r\nvelit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis. At\r\nvero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd\r\ngubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum\r\ndolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor\r\ninvidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero\r\neos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no\r\nsea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit\r\namet, consetetur sadipscing elitr, At accusam aliquyam diam diam dolore dolores\r\nduo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet\r\nclita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero\r\nvoluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet,\r\nconsetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore\r\net dolore magna aliquyam erat.</p>\r\n\r\n<p>Consetetur sadipscing elitr, sed diam nonumy eirmod tempor\r\ninvidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero\r\neos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no\r\nsea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit\r\namet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut\r\nlabore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam\r\net justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata\r\nsanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur\r\nsadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore\r\nmagna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo\r\ndolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est\r\nLorem ipsum dolor sit amet.</p>', 1, 3, 0, 7, '2004-05-12 11:54:06', 62, 'Web master', '2004-07-07 18:10:23', 62, 0, '0000-00-00 00:00:00', '2004-01-01 00:00:00', '0000-00-00 00:00:00', 'fruit/cherry.jpg|left||0\r\nfruit/peas.jpg|right||0\r\nfood/milk.jpg|left||0', '', '', 1, 0, 5, '', '', 0, 10,'');

#
# Данные для таблицы `#__content_frontpage`
#

INSERT INTO `#__content_frontpage` VALUES (1, 1);
INSERT INTO `#__content_frontpage` VALUES (2, 2);
INSERT INTO `#__content_frontpage` VALUES (3, 3);
INSERT INTO `#__content_frontpage` VALUES (4, 4);

#
# Данные для таблицы `#__menu`
#

INSERT INTO `#__menu` VALUES (2, 'mainmenu', 'Новости', 'index.php?option=com_content&task=section&id=1', 'content_section', 1, 0, 1, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, '');
INSERT INTO `#__menu` VALUES (3, 'mainmenu', 'Контакты', 'index.php?option=com_contact', 'components', 1, 0, 7, 0, 6, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, '');
INSERT INTO `#__menu` VALUES (4, 'mainmenu', 'Ссылки', 'index.php?option=com_weblinks', 'components', 1, 0, 4, 0, 5, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'menu_image=web_links.jpg\npageclass_sfx=\nback_button=\npage_title=1\nheader=\nheadings=1\nhits=\nitem_description=1\nother_cat=1\ndescription=1\ndescription_text=\nimage=-1\nimage_align=right\nweblink_icons=');
INSERT INTO `#__menu` VALUES (5, 'mainmenu', 'Поиск', 'index.php?option=com_search', 'components', 1, 0, 16, 0, 7, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, '');
INSERT INTO `#__menu` VALUES (6, 'mainmenu', 'Лицензия Joostina!', 'index.php?option=com_content&task=view&id=5', 'content_typed', 1, 0, 5, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, '');
INSERT INTO `#__menu` VALUES (7, 'mainmenu', 'Ленты новостей', 'index.php?option=com_newsfeeds', 'components', 1, 0, 12, 0, 8, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1\npageclass_sfx=\nback_button=\npage_title=1\nheader=');
INSERT INTO `#__menu` VALUES (8, 'mainmenu', 'В окне', 'index.php?option=com_wrapper', 'wrapper', 1, 0, 0, 0, 10, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1\npageclass_sfx=\nback_button=\npage_title=1\nheader=\nscrolling=auto\nwidth=100%\nheight=600\nheight_auto=0\nurl=www.joostina.ru');
INSERT INTO `#__menu` VALUES (9, 'mainmenu', 'Блог', 'index.php?option=com_content&task=blogsection&id=0', 'content_blog_section', 1, 0, 0, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1\npageclass_sfx=\nback_button=\nheader=Блог из всех разделов без изображений\npage_title=1\nleading=0\nintro=6\ncolumns=2\nlink=4\norderby_pri=\norderby_sec=\npagination=2\npagination_results=1\nimage=0\ndescription=0\ndescription_image=0\ncategory=0\ncategory_link=0\nitem_title=1\nlink_titles=\nreadmore=\nrating=\nauthor=\ncreatedate=\nmodifydate=\nnprint=\nemail=\nsectionid=');
INSERT INTO `#__menu` VALUES (10, 'othermenu', 'joostina.ru', 'http://www.joostina.ru', 'url', 1, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, '');
INSERT INTO `#__menu` VALUES (11, 'othermenu', 'joom.ru', 'http://www.joom.ru', 'url', 1, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, '');
INSERT INTO `#__menu` VALUES (12, 'othermenu', 'joomlaportal.ru', 'http://www.joomlaportal.ru', 'url', 1, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, '');
INSERT INTO `#__menu` VALUES (13, 'othermenu', 'joomlaforum.ru', 'http://www.joomlaforum.ru', 'url', 1, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, '');
INSERT INTO `#__menu` VALUES (14, 'othermenu', 'joomla-support.ru', 'http://www.joomla-support.ru', 'url', 1, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, '');
INSERT INTO `#__menu` VALUES (15, 'othermenu', 'joomla.ru', 'http://www.joomla.ru', 'url', 1, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, '');
INSERT INTO `#__menu` VALUES (16, 'usermenu', 'Панель управления', 'administrator/', 'url', 1, 0, 0, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1');
INSERT INTO `#__menu` VALUES (17, 'usermenu', 'Ваши данные', 'index.php?option=com_user&task=UserDetails', 'url', 1, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 1, 3, '');
INSERT INTO `#__menu` VALUES (18, 'usermenu', 'Добавить новость', 'index.php?option=com_ja_submit&Itemid=18', 'url', 1, 0, 0, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 1, 2, '');
INSERT INTO `#__menu` VALUES (19, 'usermenu', 'Добавить ссылку', 'index.php?option=com_weblinks&task=new', 'url', 1, 0, 0, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 1, 2, '');
INSERT INTO `#__menu` VALUES (20, 'usermenu', 'Проверить материалы', 'index.php?option=com_user&task=CheckIn', 'url', 1, 0, 0, 0, 5, 0, '0000-00-00 00:00:00', 0, 0, 1, 2, '');
INSERT INTO `#__menu` VALUES (21, 'usermenu', 'Выход', 'index.php?option=com_login', 'components', 1, 0, 15, 0, 5, 0, '0000-00-00 00:00:00', 0, 0, 1, 3, '');
INSERT INTO `#__menu` VALUES (22, 'topmenu', 'Главная', '.', 'url', 1, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, '');
INSERT INTO `#__menu` VALUES (23, 'topmenu', 'Контакты', 'index.php?option=com_contact&Itemid=23', 'url', 1, 0, 0, 0, 2, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, '');
INSERT INTO `#__menu` VALUES (24, 'topmenu', 'Новости', 'index.php?option=com_content&task=section&id=1&Itemid=24', 'url', 1, 0, 0, 0, 3, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, '');
INSERT INTO `#__menu` VALUES (25, 'topmenu', 'Ссылки', 'index.php?option=com_weblinks&Itemid=25', 'url', 1, 0, 0, 0, 4, 0, '0000-00-00 00:00:00', 0, 0, 0, 3, 'menu_image=-1');
INSERT INTO `#__menu` VALUES (26, 'mainmenu', 'Ча.Во. (FAQ)', 'index.php?option=com_content&task=category&sectionid=3&id=7', 'content_category', 1, 0, 7, 0, 9, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, 'menu_image=-1\npage_title=1\npageclass_sfx=\nback_button=\norderby=\ndate_format=\ndate=\nauthor=\ntitle=1\nhits=\nheadings=1\nnavigation=1\norder_select=1\ndisplay=1\ndisplay_num=50\nfilter=1\nfilter_type=title\nother_cat=1\nempty_cat=0\ncat_items=1\ncat_description=1');
# Карта Xmap
INSERT INTO `#__menu` VALUES (27, 'mainmenu', 'Карта сайта', 'index.php?option=com_xmap', 'components', 1, 0, 29, 0, 11, 0, '0000-00-00 00:00:00', 0, 0, 0, 0, '');


# Данные для таблицы `#__newsfeeds`
#

INSERT INTO `#__newsfeeds` VALUES (4, 1, 'Joomla! - Официальные новости', 'http://www.joostina.ru/index.php?option=com_rss_xtd&feed=RSS2.0&type=com_frontpage&Itemid=1', '', 1, 5, 3600, 0, '0000-00-00 00:00:00', 8,0);
INSERT INTO `#__newsfeeds` VALUES (4, 2, 'Joomla! - Новости сообщества', 'http://www.joostina.ru/index.php?option=com_rss_xtd&feed=RSS2.0&type=com_content&task=blogcategory&id=0&Itemid=33', '', 1, 5, 3600, 0, '0000-00-00 00:00:00', 9,0);
INSERT INTO `#__newsfeeds` VALUES (4, 3, 'OpenSourceMatters', 'http://www.opensourcematters.org/index2.php?option=com_rss&feed=RSS2.0&no_html=1', '', 1, 5, 3600, 0, '0000-00-00 00:00:00', 10,0);
INSERT INTO `#__newsfeeds` VALUES (10, 4, 'Linux сегодня', 'http://linuxtoday.com/backend/my-netscape.rdf', '', 1, 3, 3600, 0, '0000-00-00 00:00:00', 1,0);
INSERT INTO `#__newsfeeds` VALUES (5, 5, 'Новости бизнеса', 'http://headlines.internet.com/internetnews/bus-news/news.rss', '', 1, 3, 3600, 0, '0000-00-00 00:00:00', 2,0);
INSERT INTO `#__newsfeeds` VALUES (11, 6, 'Новости веб-разработчиков', 'http://headlines.internet.com/internetnews/wd-news/news.rss', '', 1, 3, 3600, 0, '0000-00-00 00:00:00', 3,0);
INSERT INTO `#__newsfeeds` VALUES (10, 7, 'В центре Linux: Новые продукты', 'http://linuxcentral.com/backend/lcnew.rdf', '', 1, 3, 3600, 0, '0000-00-00 00:00:00', 4,0);
INSERT INTO `#__newsfeeds` VALUES (10, 8, 'В центре Linux: Лучшие продажи', 'http://linuxcentral.com/backend/lcbestns.rdf', '', 1, 3, 3600, 0, '0000-00-00 00:00:00', 5,0);
INSERT INTO `#__newsfeeds` VALUES (10, 9, 'В центре Linux: Ежедневный экстренный выпуск', 'http://linuxcentral.com/backend/lcspecialns.rdf', '', 1, 3, 3600, 0, '0000-00-00 00:00:00', 6,0);
INSERT INTO `#__newsfeeds` VALUES (9, 10, 'Интернет: Финансовые новости', 'http://headlines.internet.com/internetnews/fina-news/news.rss', '', 1, 3, 3600, 0, '0000-00-00 00:00:00', 7,0);
INSERT INTO `#__newsfeeds` VALUES (4, 11, 'Новости Joomla! в России', 'http://joom.ru/index2.php?option=com_rss&feed=RSS2.0&no_html=1', '', 1, 5, 3600, 0, '0000-00-00 00:00:00', 2,0);
INSERT INTO `#__newsfeeds` VALUES (4, 12, 'Форумы о Joomla! в России', 'http://forum.joom.ru/index.php?type=rss;action=.xml', '', 1, 5, 1200, 0, '0000-00-00 00:00:00', 1,0);

#
# Данные для таблицы `#__poll_data`
#

INSERT INTO `#__poll_data` VALUES (1, 14, 'Абсолютно просто', 1);
INSERT INTO `#__poll_data` VALUES (2, 14, 'Разумно просто', 0);
INSERT INTO `#__poll_data` VALUES (3, 14, 'Установил с некоторыми затруднениями', 0);
INSERT INTO `#__poll_data` VALUES (4, 14, 'Пришлось дополнительно настраивать сервер', 0);
INSERT INTO `#__poll_data` VALUES (5, 14, 'Я не разобрался и попросил товарища', 0);
INSERT INTO `#__poll_data` VALUES (6, 14, 'Моя собака убежала с README...', 0);
INSERT INTO `#__poll_data` VALUES (7, 14, '', 0);
INSERT INTO `#__poll_data` VALUES (8, 14, '', 0);
INSERT INTO `#__poll_data` VALUES (9, 14, '', 0);
INSERT INTO `#__poll_data` VALUES (10, 14, '', 0);
INSERT INTO `#__poll_data` VALUES (11, 14, '', 0);
INSERT INTO `#__poll_data` VALUES (12, 14, '', 0);

#
# Данные для таблицы `#__polls`
#

INSERT INTO `#__polls` VALUES (14, 'Как прошла установка?', 1, 0, '0000-00-00 00:00:00', 1, 0, 86400);

#
# Данные для таблицы `#__poll_menu`
#

INSERT INTO `#__poll_menu` VALUES (14, 1);

#
# Данные для таблицы `#__sections`
#

INSERT INTO `#__sections` VALUES (1, 'Новости', 'Новости', 'articles.jpg', 'content', 'right', 'Выберите тему новостей из списка ниже, а затем выберите новость для чтения.', 1, 0, '0000-00-00 00:00:00', 1, 0, 1, '');
INSERT INTO `#__sections` VALUES (2, 'Краткие новости', 'Краткие новости', '', 'content', 'left', '', 1, 0, '0000-00-00 00:00:00', 2, 0, 1, '');
INSERT INTO `#__sections` VALUES (3, 'Ча.Во.', 'Часто Задаваемые Вопросы', 'pastarchives.jpg', 'content', 'left', 'Из списка ниже выберите одну из тем часто задаваемых вопросов, а затем выберите для чтения нужную страницу. Если у Вас есть вопрос, ответ на который Вы не нашли, пожалуйста, задайте его через форму Контакты.', 1, 0, '0000-00-00 00:00:00', 2, 0, 1, '');


#
# Данные для таблицы `#__weblinks`
#

INSERT INTO `#__weblinks` VALUES (1, 2, 0, 'Joostina!', 'http://www.joostina.ru', 'Домашняя страница Joostina!', '2007-10-28 23:20:02', 2, 1, 0, '0000-00-00 00:00:00', 1, 0, 1, 'target=0');
INSERT INTO `#__weblinks` VALUES (2, 2, 0, 'php.net', 'http://www.php.net', 'Язык программирования, на котором написана Joostina!', '2004-07-07 11:33:24', 0, 1, 0, '0000-00-00 00:00:00', 3, 0, 1, '');
INSERT INTO `#__weblinks` VALUES (3, 2, 0, 'MySQL', 'http://www.mysql.com', 'База данных, используемая Joostina!', '2004-07-07 10:18:31', 0, 1, 0, '0000-00-00 00:00:00', 5, 0, 1, '');
INSERT INTO `#__weblinks` VALUES (4, 2, 0, 'Joomla', 'http://www.joostina.ru', 'Официальный сайт Joomla!', '2005-02-14 15:19:02', 2, 1, 0, '0000-00-00 00:00:00', 1, 0, 1, 'target=0');
INSERT INTO `#__weblinks` VALUES (5, 2, 0, 'Joomla! - Форумы', 'http://forum.joomla.org', 'Официальные форумы Joomla!', '2005-02-14 15:19:02', 2, 1, 0, '0000-00-00 00:00:00', 1, 0, 1, 'target=0');
INSERT INTO `#__weblinks` VALUES (6, 13, 0, 'Joom.Ru - Русский дом Joomla!', 'http://joom.ru/', 'Русский дом Joomla!', '2005-10-26 22:07:32', 0, 1, 0, '0000-00-00 00:00:00', 1, 0, 1, 'target=0');
INSERT INTO `#__weblinks` VALUES (7, 13, 0, 'Форумы Joomla!', 'http://joomla-support.ru/', 'Форумы поддержки пользователей Joomla! в России.', '2005-10-26 22:10:39', 0, 1, 0, '0000-00-00 00:00:00', 2, 0, 1, 'target=0');
INSERT INTO `#__weblinks` VALUES (8, 13, 0, 'Joomlaportal.ru!', 'http://joomlaportal.ru/', 'Информация о Joomla! в России', '2005-10-26 22:07:32', 0, 1, 0, '0000-00-00 00:00:00', 1, 0, 1, 'target=0');
INSERT INTO `#__weblinks` VALUES (9, 13, 0, 'Joomlaforum.ru', 'http://www.joomlaforum.ru/', 'Русский форум поддержки Joostina - Joomla.', '2007-10-28 23:21:39', 0, 1, 0, '0000-00-00 00:00:00', 2, 0, 1, 'target=0');
INSERT INTO `#__weblinks` VALUES (10, 13, 0, 'Joomla.ru', 'http://www.joomla.ru/', 'Joomla в России.', '2007-10-28 23:21:39', 0, 1, 0, '0000-00-00 00:00:00', 2, 0, 1, 'target=0');
INSERT INTO `#__weblinks` VALUES (11, 13, 0, 'MyJoomla.ru', 'http://www.myjoomla.ru/', 'Моя Joomla - сайт на Joomla это просто!', '2007-10-28 23:21:39', 0, 1, 0, '0000-00-00 00:00:00', 2, 0, 1, 'target=0');



# Базовая карта для Xmap
INSERT INTO `#__xmap_sitemap` VALUES (1, 'Карта сайта', 1, 1, 1, 1, 1, 'img_grey.gif', 'mainmenu,0,1,1,0.5,daily', '', 1, 0, 900, 1, 0, 0, 0, 0, 0, 0);