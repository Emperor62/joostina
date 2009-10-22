<?php
/**
* @package Joostina
* @copyright Авторские права (C) 2008-2009 Joostina team. Все права защищены.
* @license Лицензия http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, или help/license.php
* Joostina! - свободное программное обеспечение распространяемое по условиям лицензии GNU/GPL
* Для получения информации о используемых расширениях и замечаний об авторском праве, смотрите файл help/copyright.php.
*/

// запрет прямого доступа
defined('_VALID_MOS') or die();

DEFINE('_ABS_PATH','Абсолютный путь( корень сайта )');
DEFINE('_ACCOUNT_ACTIVATION','Использовать активацию нового аккаунта');
DEFINE('_ACCOUNT_ACTIVATION2','Если ДА, то пользователю необходимо будет активировать новый аккаунт, после получения им письма со ссылкой для активации.');
DEFINE('_ADMIN_CAPTCHA','Для авторизации в панели управления');
DEFINE('_ADMIN_CAPTCHA2','Использовать captcha для более безопасной авторизации в панели управления.');
DEFINE('_ADMIN_SESS_TIME','Время существования сессии в панели управления');
DEFINE('_ADMIN_SESS_TIME2','Время, по истечении которого будут отключены пользователи <strong>админцентра</strong> при неактивности. Слишком большое значение уменьшает защищенность сайта!');
DEFINE('_APPLY_TO_DIRS','Применить к существующим каталогам');
DEFINE('_APPLY_TO_DIRS2','Включение этих флагов будет применено ко<em> всем существующим каталогам</em> на сайте.<br/>'.'<b>НЕПРАВИЛЬНОЕ ИСПОЛЬЗОВАНИЕ ЭТОЙ ОПЦИИ МОЖЕТ ПРИВЕСТИ К НЕРАБОТОСПОСОБНОСТИ САЙТА!</b>');
DEFINE('_APPLY_TO_FILES','Применить к существующим файлам');
DEFINE('_APPLY_TO_FILES2','Изменения коснутся <em>всех существующих файлов</em> на сайте.<br/><b>НЕПРАВИЛЬНОЕ ИСПОЛЬЗОВАНИЕ ЭТОЙ ОПЦИИ МОЖЕТ ПРИВЕСТИ К НЕРАБОТОСПОСОБНОСТИ САЙТА!</b>');
DEFINE('_AUTHOR_NAMES','Показать имена авторов');
DEFINE('_AUTHOR_NAMES2','Выберите, показывать ли имена авторов. Это глобальная установка, но она может быть изменена в других местах на уровне меню или объекта.');
DEFINE('_AUTO_PUBLICATION_FRONT','Автоматическая публикация на главной');
DEFINE('_AUTO_PUBLICATION_FRONT2','При включении параметра всё создаваемое содержимое будет автоматически помечено для публикации на главной странице.');
DEFINE('_AUTOCLEAN_CACHE_DIR','Автоматическая очистка каталога кэша');
DEFINE('_AUTOCLEAN_CACHE_DIR2','Автоматически очищать каталог кэша удаляя просроченные файлы.');
DEFINE('_AVAILABLE_CHECK_RIGHTS','доступно');
DEFINE('_BACK_BUTTON','Кнопка Назад (Вернуться)');
DEFINE('_CACHE_DIR','Каталог кэша');
DEFINE('_CACHE_DIR2','Текущий каталог кэша <b>Доступен для записи</b>');
DEFINE('_CACHE_DIR3','Текущий каталог кэша <b>НЕ ДОСТУПЕН ДЛЯ ЗАПИСИ</b> - смените CHMOD каталога на 755 перед включением кэша');
DEFINE('_CACHE_MENU','Кэширование меню панели управления');
DEFINE('_CACHE_MENU2','Включение кэширования меню панели управления. Работает независимо от стандартного кэша.');
DEFINE('_CACHE_OPTIMIZATION','Оптимизация кэширования');
DEFINE('_CACHE_OPTIMIZATION2','Автоматически удаляет из файлов кэша лишние символы тем самым уменьшая размер файлов.');
DEFINE('_CACHE_TIME','Время жизни кэша');
DEFINE('_CANNOT_CACHE','Кэширование не возможно');
DEFINE('_CANNOT_CACHE2','Каталог кэша не доступен для записи.');
DEFINE('_CANNOT_OPEN_CONF_FILE','Ошибка! Невозможно открыть для записи файл конфигурации!');
DEFINE('_CLEAR_FRONTPAGE_LINK','Очистка ссылки на com_frontpage');
DEFINE('_CLEAR_FRONTPAGE_LINK2','Придавать ссылке на компонент главной страницы более короткий вид.');
DEFINE('_COM_CONFIG_CC_LIGIN_LINK','Ник-ссылка');
DEFINE('_COM_CONFIG_CC_LOGIN_TEXT','Ник-текст');
DEFINE('_COM_CONFIG_CC_NAME_LINK','Имя-ссылка');
DEFINE('_COM_CONFIG_CC_NAME_TEXT','Имя-текст');
DEFINE('_COM_CONFIG_CC_TYPE_USER','Тип вывода имени пользователя');
DEFINE('_COM_CONFIG_CC_TYPE_USER_HELP','Выберите тип отображения имени автора публикации');
DEFINE('_COM_CONFIG_COMPONENTS_ACCESS','Блокировка компонентов');
DEFINE('_COM_CONFIG_COMPONENTS_ACCESS_HELP','Разрешить блокировку доступа к компонентам');
DEFINE('_COM_CONFIG_CONTENT_ORDER_BY','Базовая сортировка содержимого по');
DEFINE('_COM_CONFIG_CONTENT_ORDER_BY_HELP','Выберите последовательность сортировки содержимого по умолчанию');
DEFINE('_COM_CONFIG_CONTENT_ORDER_SORT','Порядок сортировки');
DEFINE('_COM_CONFIG_CONTENT_ORDER_SORT_HELP','Выберите порядок сортировки по умолчанию для содержимого');
DEFINE('_COM_CONFIG_COUNT_FOR_USER_BLOCK','Число неудачных авторизаций для блокировки аккаунта');
DEFINE('_COM_CONFIG_ERROR_ALL','Максимум (все)');
DEFINE('_COM_CONFIG_ERROR_HIDE','Отсутствуют');
DEFINE('_COM_CONFIG_ERROR_PARANOIDAL','Максимальная отладка');
DEFINE('_COM_CONFIG_ERROR_SYSTEM','Настройки системы');
DEFINE('_COM_CONFIG_ERROR_TINY','Простые');
DEFINE('_COM_CONFIG_HOURS','ч:');
DEFINE('_COM_CONFIG_MONTH','м');
DEFINE('_COM_CONFIG_SEO_TYPE_1','Название сайта - Заголовок страницы');
DEFINE('_COM_CONFIG_SEO_TYPE_2','Заголовок страницы - Название сайта (по умолчанию)');
DEFINE('_COM_CONFIG_SEO_TYPE_3','Название сайта ( только )');
DEFINE('_COM_CONFIG_SEO_TYPE_4','Заголовок страницы ( только )');
DEFINE('_COM_CONFIG_SITE_LANG','Язык сайта');
DEFINE('_COM_CONFIG_SYTE_URL','URL сайта');
DEFINE('_COM_CONFIG_YEAR','г.');
DEFINE('_COM_CONFIG_TAGS','Показывать тэги');
DEFINE('_COM_CONFIG_TAGS2','Если ДА - тэги будут показаны');
DEFINE('_CONFIG_SAVING','Сохранение конфигурации');
DEFINE('_CONFIGURATION_IS_UPDATED','Конфигурация успешно обновлена');
DEFINE('_CONSTRUCT_ERROR','ошибка сборки');
DEFINE('_CONTACTS_CAPTCHA','Для формы контактов');
DEFINE('_CONTACTS_CAPTCHA2','Использовать captcha для более безопасной формы контактов.');
DEFINE('_CONTENT_NAV','Навигация по содержимому');
DEFINE('_COUNT_CONTENT_HITS','Считать число прочтений содержимого');
DEFINE('_COUNT_CONTENT_HITS2','При выключении параметра статистика прочтений содержимого будет не активна.');
DEFINE('_COUNT_GENERATION_TIME','Рассчитывать время генерации страницы');
DEFINE('_COUNT_GENERATION_TIME2','Если `Да`, то на каждой странице будет отображено время на её генерацию');
DEFINE('_COUNTRY_LOCALE','Локаль страны');
DEFINE('_COUNTRY_LOCALE2','Определяет региональные настройки страны: отображение даты, времени, чисел и т.д.');
DEFINE('_CURR_DATE_TIME_RSS','Текущие дата и время, которые будут показываться в RSS');
DEFINE('_CUSTOM_PRINT','Страница печати из каталога шаблона');
DEFINE('_CUSTOM_PRINT2','Использование произвольной страницы для печатного вида из каталога текущего шаблона');
DEFINE('_DATE_FORMAT_FULL','Полный формат даты и времени');
DEFINE('_DATE_FORMAT_FULL2','Выберите полный формат для отображения даты и времени. Необходимо использовать формат в соответствии с правилами strftime.');
DEFINE('_DATE_FORMAT_TXT','Формат даты');
DEFINE('_DATE_FORMAT2','Выберите формат для отображения даты. Необходимо использовать формат в соответствии с правилами strftime.');
DEFINE('_DATE_TIME_CREATION','Показать дату и время создания');
DEFINE('_DATE_TIME_CREATION2','Если Показать, то показывается дата и время создания статьи. Это глобальная установка, но может быть изменена в других местах на уровне меню или объекта.');
DEFINE('_DATE_TIME_MODIFICATION','Показать дату и время изменения');
DEFINE('_DATE_TIME_MODIFICATION2','Если установлено Показать, то будет показываться дата изменения статьи. Это глобальная установка, но она может быть изменена в других местах.');
DEFINE('_DB_CACHE','Кэш запросов базы данных');
DEFINE('_DB_CACHE_TIME','Время жизни кэша запросов базы данных');
DEFINE('_DB_HOST','Адрес хоста MySQL');
DEFINE('_DB_NAME','База данных MySQL');
DEFINE('_DB_PREFIX','Префикс базы данных MySQL');
DEFINE('_DB_PREFIX2','!! НЕ ИЗМЕНЯЙТЕ, ЕСЛИ У ВАС УЖЕ ЕСТЬ РАБОЧАЯ БАЗА ДАННЫХ. В ПРОТИВНОМ СЛУЧАЕ, ВЫ МОЖЕТЕ ПОТЕРЯТЬ К НЕЙ ДОСТУП !!');
DEFINE('_DB_USER','Имя пользователя БД (MySQL)');
DEFINE('_DEFAULT_EDITOR','WYSIWYG-редактор по умолчанию');
DEFINE('_DIR_CREATION','Создание каталогов');
DEFINE('_DIR_CREATION2','Разрешения доступа к каталогам');
DEFINE('_DIR_CREATION3','Не менять CHMOD для новых каталогов (использовать умолчание сервера)');
DEFINE('_DIR_CREATION4','Установить CHMOD для новых каталогов');
DEFINE('_DIR_CREATION5','Выберите этот пункт для установки разрешений доступа к вновь создаваемым каталогам');
DEFINE('_DISABLE_ACCESS_CHECK_TO_CONTENT','Отключить контроль доступа к содержимому');
DEFINE('_DISABLE_ACCESS_CHECK_TO_CONTENT2','Если `Да`, то контроль доступа к содержимому осуществляться не будет, и всем пользователям будет отображено всё содержимое. Рекомендуется совместно с пунктами отключения авторизации и сессий на фронте.');
DEFINE('_DISABLE_ADMIN_SESS_DEL','Разлогинивать при истечении сессии');
DEFINE('_DISABLE_ADMIN_SESS_DEL2','Удалять сессии после истечения времени существования.');
DEFINE('_DISABLE_BLOCK','Отключить блокировки содержимого');
DEFINE('_DISABLE_BLOCK2','При включении параметра блокировки объектов содержимого не будут проверяться. Не рекомендуется использовать на сайтах с большим числом редакторов.');
DEFINE('_DISABLE_CHECK_CONTENT_DATE','Отключить проверки публикации по датам');
DEFINE('_DISABLE_CHECK_CONTENT_DATE2','Если на сайте не критичны временные промежутки публикации содержимого - то данный параметр лучше активизировать.');
DEFINE('_DISABLE_CONTENT_MAMBOTS','Отключить мамботы группы content');
DEFINE('_DISABLE_CONTENT_MAMBOTS2','Если `Да`, то использование мамботов обработки контента будет прекращено. ВНИМАНИЕ, если на сайте используются мамботы этой группы, то активация параметра не рекомендуется');
DEFINE('_DISABLE_FAVICON','Отключить favicon');
DEFINE('_DISABLE_FAVICON2','Использовать в качестве значка сайта favicon');
DEFINE('_DISABLE_FRONT_SESSIONS','Отключить сессии на фронте');
DEFINE('_DISABLE_FRONT_SESSIONS2','Если `Да`, то будет отключено ведение сессий для каждого пользователя на сайте. Если подсчет числа пользователей не нужен и регистрация отключена - можно выключить.');
DEFINE('_DISABLE_GENERATOR_TAG','Отключить тег Generator');
DEFINE('_DISABLE_GENERATOR_TAG2','Если `Да`, то из кода каждой HTML страницы будет исключен тег name=\\\'Generator\\\'');
DEFINE('_DISABLE_HELP_BUTTON','Отключить кнопку "Помощь"');
DEFINE('_DISABLE_HELP_BUTTON2','Позволяет запретить к показу кнопку помощи тулбара панели управления.');
DEFINE('_DISABLE_IMAGES_TAB','Отключить вкладку "Изображения"');
DEFINE('_DISABLE_IMAGES_TAB2','Позволяет запретить к показу при редактировании содержимого вкладку Изображения.');
DEFINE('_DISABLE_MAINBODY_MAMBOTS','Отключить мамботы группы mainbody');
DEFINE('_DISABLE_MAINBODY_MAMBOTS2','Если `Да`, то использование мамботов обработки стека компонентов (mainbody) будет прекращено.');
DEFINE('_DISABLE_MODULES_WHEN_EDIT','Отключать модули в редактировании');
DEFINE('_DISABLE_MODULES_WHEN_EDIT2','Если `Да`, то на странице редактирования содержимого с фронта будут отключены все модули');
DEFINE('_DISABLE_PATHWAY_ON_FRONT','Скрывать пачвей (pathway) на главной');
DEFINE('_DISABLE_PATHWAY_ON_FRONT2','При включенном режиме строка \\\'Главная\\\' на первой странице сайта будет заменена на символ неразрывного пробела.');
DEFINE('_DISABLE_RSS','Отключить генерацию RSS (syndicate)');
DEFINE('_DISABLE_RSS2','Если `Да`, то будет отключена возможность генерации RSS лент и работа с ними');
DEFINE('_DISABLE_SYSTEM_MAMBOTS','Отключить мамботы группы system');
DEFINE('_DISABLE_SYSTEM_MAMBOTS2','Если `Да`, то использование системных мамботов будет прекращено. ВНИМАНИЕ, если на сайте используются мамботы этой группы, то активация параметра не рекомендуется');
DEFINE('_DISABLE_TPREVIEW','Запретить просмотр позиций модулей шаблона');
DEFINE('_DISABLE_TPREVIEW_INFO','Позволяет отключить просмотр позиций модулей шаблона по адресу  http://www.этот-сайт.ru/?tp=1');
DEFINE('_DO_YOU_REALLY_WANT_DEL_AUTENT_METHOD','Вы действительно хотите изменить `Метод аутентификации сессии`? \n\n Это действие удалит все существующие сессии фронтенда \n\n');
DEFINE('_DYNAMIC_PAGETITLES','Динамические заголовки страниц (теги title)');
DEFINE('_DYNAMIC_PAGETITLES2','Динамическое изменение заголовков страниц в зависимости от текущего просматриваемого содержимого');
DEFINE('_ENABLE_CACHE','Включить кэширование');
DEFINE('_ENABLE_CACHE2','Включение кэширования уменьшает запросы к MySQL нагрузку на сервер');
DEFINE('_ENABLE_GZIP','GZIP-сжатие страниц');
DEFINE('_ENABLE_GZIP2','Поддержка сжатия страниц перед отправкой (если поддерживается). Включение этой функции уменьшает размер загружаемых страниц и приводит к уменьшению трафика. В то же время, это увеличивает нагрузку на сервер.');
DEFINE('_ENABLE_STATS','Включить сбор статистики');
DEFINE('_ENABLE_STATS2','Разрешить/запретить сбор статистики сайта');
DEFINE('_ENABLE_TOC','Оглавление для многостраничных объектов');
DEFINE('_ENABLE_UNPUBLISHED_MAMBOTS', 'Использовать неопубликованные мамботы');
DEFINE('_ENABLE_UNPUBLISHED_MAMBOTS_HELP', 'Некоторые мамботы работают даже в неопубликованном состоянии, и вычищать текст от спецтегов типа {**}/. Если у вас их нет - рекомендуется выбрать НЕТ.');
DEFINE('_ENABLE_USER_REGISTRATION','Разрешить регистрацию пользователей');
DEFINE('_ENABLE_USER_REGISTRATION2','Если ДА, то пользователям будет разрешено регистрироваться на сайте.');
DEFINE('_EVERYDAY_OPTIMIZATION','Ежедневная оптимизация таблиц базы данных');
DEFINE('_EVERYDAY_OPTIMIZATION2','Если `Да`, то каждые сутки база данных будет автоматически оптимизирована для лучшего быстродействия');
DEFINE('_EXT_IND_TAGS','Расширенные теги индексации');
DEFINE('_EXT_IND_TAGS2','Если `Да`, то в код каждой страницы будут добавлены специальные теги для лучшей индексации');
DEFINE('_EXTENDED_DEBUG','Расширенный отладчик');
DEFINE('_EXTENDED_DEBUG2','Использовать на фронте сайта расширенный отладчик выводящий множество информации о сайте.');
DEFINE('_FAVICON_IMAGE','Значок сайта в Закладках браузера');
DEFINE('_FAVICON_IMAGE2','Значок сайта в Закладках (Избранном) браузера. Если не указано или файл значка не найден, по умолчанию будет использоваться файл favicon.ico.');
DEFINE('_FAVICON_IMAGE3','Значок сайта в Закладках');
DEFINE('_FILE_MODE','Создание файлов');
DEFINE('_FILE_MODE2','Разрешения доступа к файлам');
DEFINE('_FILE_MODE3','Не менять CHMOD для новых файлов (использовать умолчание сервера)');
DEFINE('_FILE_MODE4','Установить CHMOD для новых файлов как');
DEFINE('_FILE_MODE5','Выберите этот пункт для установки разрешений доступа к вновь создаваемым файлам');
DEFINE('_FILE_ROOT','Корень файлового менеджера');
DEFINE('_FILE_ROOT2','Корневой каталог для работы компонента управления файлами. Без / в конце. При использовании в Windows (c) путь может начинаться с названия буквы диска.');
DEFINE('_FRONT_SESSION_TIME','Время существования сессии на фронте');
DEFINE('_FRONT_SESSION_TIME2','Время автоотключения пользователя сайта при неактивности. Большое значение этого параметра снижает безопасность.');
DEFINE('_FRONTPAGE','Фронт');
DEFINE('_GLOBAL_CONFIG','Глобальная конфигурация');
DEFINE('_GZ_CSS_JS','Сжатие CSS и JS файлов');
DEFINE('_HELP_SERVER','Сервер помощи');
DEFINE('_HELP_SERVER2','Сервер помощи - Если поле пустое, то файлы помощи будут браться из локальной папки http://адрес_вашего_сайта/help/, Для включения сервера On-Line помощи введите http://help.joom.ru или http://help.joomla.org');
DEFINE('_HTML_CSS_EDITOR','Визуальный редактор для html и css');
DEFINE('_HTML_CSS_EDITOR2','Использовать редактор с подсветкой синтаксиса для редактирования html и css файлов шаблона');
DEFINE('_IGNORE_PROTECTION_WHEN_SAVE','Игнорировать защиту от записи при сохранении');
DEFINE('_INDEX_PRINT_PAGE','Индексация печатной версии');
DEFINE('_INDEX_PRINT_PAGE2','Если `Да`, то печатная версия содержимого будет доступна для индексации');
DEFINE('_IS_SITE_DEBUG','Режим отладки сайта');
DEFINE('_IS_SITE_DEBUG2','Если ДА, то будет показываться диагностическая информация, запросы и ошибки MySQL...');
DEFINE('_ITEMID_COMPAT','Режим работы Itemid');
DEFINE('_LINK_EMAIL','Показать Ссылку E-mail');
DEFINE('_LINK_PRINT','Показать Ссылку Печать');
DEFINE('_LINK_TITLES','Заголовки в виде ссылок');
DEFINE('_LINK_TITLES2','Если ДА, заголовки объектов содержимого начинают работать как гиперссылки на эти объекты');
DEFINE('_LIST_LIMIT','Длина списков (кол-во строк)');
DEFINE('_LIST_LIMIT2','Устанавливает длину списков по умолчанию в панели управления для всех пользователей');
DEFINE('_LOCALE','Локаль');
DEFINE('_MAIL','Почта');
DEFINE('_MAIL_FROM_ADR','Письма от (Mail From)');
DEFINE('_MAIL_FROM_NAME','Отправитель (From Name)');
DEFINE('_MAIL_METHOD','Для отправки почты использовать');
DEFINE('_MEDIA_ROOT','Корень медиа менеджера');
DEFINE('_MEDIA_ROOT2','Корневой каталог для работы компонента управления медиа данными. Путь от корня сайта без / по краям.');
DEFINE('_NOT_AVAILABLE_CHECK_RIGHTS','не доступно');
DEFINE('_O_AS','как');
DEFINE('_O_EXEC','выполнение');
DEFINE('_O_OTHER','Разные');
DEFINE('_O_READ','чтение');
DEFINE('_O_SEARCH','поиск');
DEFINE('_O_WRITE','запись');
DEFINE('_OLD_MYSQL_SUPPORT','Поддержка младших версий MySQL');
DEFINE('_OLD_MYSQL_SUPPORT2','Параметр позволяет отключить автоматический перевод работы БД в режим совместимости с кириллицей');
DEFINE('_OWNER','Владелец');
DEFINE('_PHP_MAIL_FUNCTION','Функцию PHP mail');
DEFINE('_PRINT_EMAIL_ICONS','Значки Печать и E-mail');
DEFINE('_PRINT_EMAIL_ICONS2','Если выбрано Показать, то ссылки Печать и E-mail будут отображаться в виде значков, иначе - простым текстом-ссылкой.');
DEFINE('_PROTECT_AFTER_SAVE','Защитить от записи после сохранения');
DEFINE('_READMORE_LINK','Ссылка "Подробнее..."');
DEFINE('_READMORE_LINK2','Если выбран параметр Показать, то будет показываться ссылка -Подробнее...- для просмотра полного содержимого');
DEFINE('_REDIR_FROM_NOT_WWW','Переадресация с не WWW адресов');
DEFINE('_REDIR_FROM_NOT_WWW2','При заходе на сайт по ссылке site.ru, автоматически будет произведена переадресация на www.site.ru');
DEFINE('_REGISTRATION_CAPTCHA','Для регистрации');
DEFINE('_REGISTRATION_CAPTCHA2','Использовать captcha для более безопасной регистрации.');
DEFINE('_REVISIT_TAG','Значение тега <b>revisit</b>');
DEFINE('_REVISIT_TAG2','Укажите значение тега <b>revisit</b> в днях');
DEFINE('_RG_DISABLE','Выкл. (РЕКОМЕНДУЕТСЯ) - дополнительная защита');
DEFINE('_RG_ENABLE','Вкл. (НЕ РЕКОМЕНДУЕТСЯ) - совместимость со старыми расширениями, при использовании параметра повышается угроза безопасности.');
DEFINE('_SAVE_LAST_PAGE','Запоминать страницу Админцентра при окончании сессии');
DEFINE('_SAVE_LAST_PAGE2','Если сессия работы в панели управления закончилась, и Вы заходите на сайт в течение 10 минут, то при входе вы будете перенаправлены на страницу, с которой произошло отключение');
DEFINE('_SECONDS','секунд');
DEFINE('_SECRET_WORD','Секретное слово');
DEFINE('_SECURITY_LEVEL1','1 уровень защиты - Обратная совместимость');
DEFINE('_SECURITY_LEVEL2','2 уровень защиты - Разрешено для IP-адресов прокси');
DEFINE('_SECURITY_LEVEL3','3 уровень защиты - По умолчанию - наилучший');
DEFINE('_SEF_URLS','Дружественные для поисковых систем URL-ы (SEF)');
DEFINE('_SEF_URLS2','Только для Apache! Перед использованием переименуйте htaccess.txt в .htaccess. Это необходимо для включения модуля apache - mod_rewrite');
DEFINE('_SENDMAIL_PATH','Путь к Sendmail');
DEFINE('_SERVER','Сервер');
DEFINE('_SESSION_TYPE','Метод идентификации сессии');
DEFINE('_SESSION_TYPE2','Не изменяйте, если не знаете, зачем это надо!<br /><br /> Если сайт будет использоваться пользователями службы AOL или пользователями, использующими для доступа на сайт прокси-серверы, то можете использовать настройки 2 уровня');
DEFINE('_SHOW_AUTHOR_TAG','Показывать мета-тег <b>author</b>');
DEFINE('_SHOW_AUTHOR_TAG2','Показывает мета-тег <b>author</b> при просмотре объектов содержимого');
DEFINE('_SHOW_BASE_TAG','Показывать мета-тег <b>base</b>');
DEFINE('_SHOW_BASE_TAG2','Показывает мета-тег <b>base</b> в теле каждой страницы');
DEFINE('_SHOW_READMORE_TO_AUTH','Показывать "Подробнее..." неавторизованным');
DEFINE('_SHOW_READMORE_TO_AUTH2','Если ДА, то неавторизованным пользователям будут показываться ссылки на содержимое с уровнем доступа -Для зарегистрированных-. Для возможности полного просмотра пользователь должен будет авторизоваться.');
DEFINE('_SHOW_TITLE_TAG','Показывать мета-тег <b>title</b>');
DEFINE('_SHOW_TITLE_TAG2','Показывает мета-тег <b>title</b> при просмотре объектов содержимого');
DEFINE('_SITE_AUTH','Авторизация на сайте');
DEFINE('_SITE_AUTH2','Если `Нет`, то страница авторизации на сайте будет отключена, если с ней не связан пункт меню. Также будет отключена возможность регистрации на сайте');
DEFINE('_SITE_DESC','Описание сайта, которое индексируется поисковиками');
DEFINE('_SITE_DESC2',' Вы можете не ограничивать Ваше описание двадцатью словами, в зависимости от Поискового сервера, который Вы планируете использовать. Делайте описание кратким и подходящим для содержания вашего сайта. Вы можете включить некоторые из ваших ключевых слов и ключевых фраз. Так как некоторые поисковые серверы читают больше 20 слов, то Вы можете добавить одно или два предложения. Пожалуйста удостоверьтесь, что самая важная часть вашего описания находится в первых 20 словах.');
DEFINE('_SITE_KEYWORDS','Ключевые слова сайта');
DEFINE('_SITE_NAME','Название сайта');
DEFINE('_SITE_OFFLINE_MESSAGE','Сообщение при выключенном сайте');
DEFINE('_SITE_OFFLINE_MESSAGE2','Сообщение, которое выводится пользователям вместо сайта, когда он находится в выключенном состоянии.');
DEFINE('_SMTP_PASS','Пароль для доступа к SMTP');
DEFINE('_SMTP_PASS2','Заполняется, если для отправки почты используется smtp-сервер с необходимостью авторизации');
DEFINE('_SMTP_SERVER','Адрес SMTP-сервера');
DEFINE('_SMTP_USER','Имя пользователя SMTP');
DEFINE('_SMTP_USER2','Заполняется, если для отправки почты используется smtp-сервер с необходимостью авторизации');
DEFINE('_STATICTICS','Статистика');
DEFINE('_STATS_HITS_DATE','Вести статистику просмотра содержимого по дате');
DEFINE('_STATS_HITS_DATE2','ПРЕДУПРЕЖДЕНИЕ: В этом режиме записываются большие объемы данных!');
DEFINE('_STATS_SEARCH_QUERIES','Статистика поисковых запросов');
DEFINE('_SYSTEM_ERROR_MESSAGE','Сообщение при системной ошибке');
DEFINE('_SYSTEM_ERROR_MESSAGE2','Сообщение, которое выводится пользователям вместо сайта, когда Joostina! не может подключиться к базе данных MySQL.');
DEFINE('_THIS_PARAMS_CONTROL_CONTENT','* Эти параметры контролируют вывод элементов содержимого *');
DEFINE('_TIME_DIFF','Разница со временем сервера, ч');
DEFINE('_TIME_DIFF2','RSS (смещение времени относительно UTC, ч)');
DEFINE('_TIME_OFFSET','Часовой пояс (смещение времени относительно UTC, ч)');
DEFINE('_TIME_OFFSET_M_0','(UTC 00:00) Западно-Европейское время, Лондон, Лиссабон, Касабланка');
DEFINE('_TIME_OFFSET_M_1','(UTC -01:00 час) Азорские острова, Острова Зеленого Мыса');
DEFINE('_TIME_OFFSET_M_10','(UTC -10:00) Гавайи');
DEFINE('_TIME_OFFSET_M_11','(UTC -11:00) остров Мидуэй, Самоа');
DEFINE('_TIME_OFFSET_M_12','(UTC -12:00) Международная линия суточного времени');
DEFINE('_TIME_OFFSET_M_2','(UTC -02:00) Средне-Атлантическое время');
DEFINE('_TIME_OFFSET_M_3','(UTC -03:00) Бразилия, Буэнос Айрес, Джорджтаун');
DEFINE('_TIME_OFFSET_M_3_5','(UTC -03:30) Ньюфаундленд и Лабрадор');
DEFINE('_TIME_OFFSET_M_4','(UTC -04:00) Атлантическое время (Канада), Каракас, Ла-Пас');
DEFINE('_TIME_OFFSET_M_5','(UTC -05:00) Восточное время (США &amp; Канада), Богота, Лайма');
DEFINE('_TIME_OFFSET_M_6','(UTC -06:00) Центральное время  (США &amp; Канада), Мехико');
DEFINE('_TIME_OFFSET_M_7','(UTC -07:00) Время Монтаны (США &amp; Канада)');
DEFINE('_TIME_OFFSET_M_8','(UTC -08:00) Тихоокеанское время (США &amp; Канада)');
DEFINE('_TIME_OFFSET_M_9','(UTC -09:00) Аляска');
DEFINE('_TIME_OFFSET_M_9_5','(UTC -09:30) Тайохае, Маркизские острова');
DEFINE('_TIME_OFFSET_P_1','(UTC +01:00 час) Брюссель, Копенгаген, Мадрид, Париж');
DEFINE('_TIME_OFFSET_P_10','(UTC +10:00) Владивосток, Гуам, Восточная Австралия');
DEFINE('_TIME_OFFSET_P_10_5','(UTC +10:30) остров Lord Howe (Австралия)');
DEFINE('_TIME_OFFSET_P_11','(UTC +11:00) Магадан, Соломоновы острова, Новая Каледония');
DEFINE('_TIME_OFFSET_P_11_5','(UTC +11:30) остров Норфолк');
DEFINE('_TIME_OFFSET_P_12','(UTC +12:00) Камчатка, Окленд, Уэллингтон, Фиджи');
DEFINE('_TIME_OFFSET_P_12_75','(UTC +12:45) Остров Чатем');
DEFINE('_TIME_OFFSET_P_13','(UTC +13:00) Тонга');
DEFINE('_TIME_OFFSET_P_14','(UTC +14:00) Кирибати');
DEFINE('_TIME_OFFSET_P_2','(UTC +02:00) Украина, Киев, Минск, Калининград, Южная Африка');
DEFINE('_TIME_OFFSET_P_3','(UTC +03:00) Москва, Санкт-Петербург, Багдад, Эр-Рияд');
DEFINE('_TIME_OFFSET_P_3_5','(UTC +03:30) Тегеран');
DEFINE('_TIME_OFFSET_P_4','(UTC +04:00) Самара, Баку, Тбилиси, Абу-Даби, Мускат');
DEFINE('_TIME_OFFSET_P_4_5','(UTC +04:30) Кабул');
DEFINE('_TIME_OFFSET_P_5','(UTC +05:00) Оренбург, Екатеринбург, Пермь, Ташкент, Исламабад, Карачи');
DEFINE('_TIME_OFFSET_P_5_5','(UTC +05:30) Бомбей, Калькутта, Мадрас, Нью-Дели');
DEFINE('_TIME_OFFSET_P_5_75','(UTC +05:45) Катманду');
DEFINE('_TIME_OFFSET_P_6','(UTC +06:00) Омск, Новосибирск, Алматы, Дака, Коломбо');
DEFINE('_TIME_OFFSET_P_6_5','(UTC +06:30) Ягун');
DEFINE('_TIME_OFFSET_P_7','(UTC +07:00) Красноярск, Бангкок, Ханой, Джакарта');
DEFINE('_TIME_OFFSET_P_8','(UTC +08:00) Иркутск, Улан-Батор, Пекин, Сингапур, Гонконг');
DEFINE('_TIME_OFFSET_P_8_75','(UTC +08:00) Западная Австралия');
DEFINE('_TIME_OFFSET_P_9','(UTC +09:00) Якутск, Токио, Сеул, Осака, Саппоро');
DEFINE('_TIME_OFFSET_P_9_5','(UTC +09:30) Аделаида, Дарвин');
DEFINE('_TIME_OFFSET2','Текущие дата и время, которые будут показываться на сайте:');
DEFINE('_TITLE_ORDER','Порядок расположения элементов title');
DEFINE('_TITLE_ORDER2','Порядок расположения элементов заголовка страниц (тег title)');
DEFINE('_TITLE_SEPARATOR','Разделитель элементов title');
DEFINE('_TITLE_SEPARATOR2','Разделитель элементов заголовка страниц (тег title). По умолчанию - дефис.');
DEFINE('_UNIQ_ITEMS_IDS','Уникальные идентификаторы новостей');
DEFINE('_UNIQ_ITEMS_IDS2','При включении параметра для каждой новости в списке будет задаваться уникальный идентификатор стиля.');
DEFINE('_UNIQUE_EMAIL','Требовать уникальный E-mail');
DEFINE('_UNIQUE_EMAIL2','Если ДА, то пользователи не смогут создавать несколько аккаунтов с одинаковым адресом e-mail.');
DEFINE('_USE_H1_FOR_HEADERS','Обрамлять заголовки содержимого тегом H1 при полном просмотре');
DEFINE('_USE_H1_FOR_HEADERS2','Обрамлять заголовки тегом h1 только в режиме полного просмотра содержимого ( при нажатии на Подробнее... ).');
DEFINE('_USE_H1_HEADERS_ALWAYS','Обрамлять все заголовки содержимого тегом H1');
DEFINE('_USE_H1_HEADERS_ALWAYS2','Помещать заголовки материала в теги h1.');
DEFINE('_USE_OLD_TOOLBAR','Использовать старое отображение туллбара');
DEFINE('_USE_OLD_TOOLBAR2','При активировании параметра вывод кнопок туллбара будет произведён в режиме таблиц, как было в Joomla.');
DEFINE('_USE_SMTP','Использовать SMTP-авторизацию');
DEFINE('_USE_SMTP2','Выберите ДА, если для отправки почты используется smtp-сервер с необходимостью авторизации');
DEFINE('_USE_TEMPLATE','Использовать шаблон');
DEFINE('_USE_TEMPLATE2','При выборе шаблона он будет использован на всем сайте независимо от привязок к пунктам меню других шаблонов. Для использования нескольких шаблонов выберите \\\'Разные\\\'');
DEFINE('_USER_PARAMS','Параметры пользователя сайта');
DEFINE('_USER_PARAMS2','Если `Нет`, то будет отключена возможность установки пользователем параметров сайта (выбор редактора)');
DEFINE('_VIEW_COUNT2','Если установлено -Показать-, то показывается количество просмотров объекта посетителями сайта. Эта глобальная установка может быть изменена в других местах панели управления.');
DEFINE('_VOTING_ENABLE','Рейтинг/Голосование');
DEFINE('_VOTING_ENABLE2','Если выбран параметр Показать, система --Рейтинг/Голосование-- будет включена');
DEFINE('_C_CONFIG_HTACCESS_RENAME','Необходимо переименовать htaccess.txt в .htaccess');
DEFINE('_GLOBAL_TEMPLATES', 'Шаблоны ядра');
DEFINE('_GLOBAL_TEMPLATES_TIP', '');
DEFINE('_GLOBAL_TEMPLATES_CURTEMPLATE', 'Из текущего шаблона');
DEFINE('_GLOBAL_TEMPLATES_SYSTEMDIR', 'Стандартные');
DEFINE('_MEMCACHE_PERSISTENT', 'Постоянная кеш память');
DEFINE('_MEMORY_CACHE_COMPRESSION', 'Компрессия кеш памяти');
DEFINE('_MEMCACHE_SERVER', 'Memcache Сервер');
DEFINE('_HOST', 'Хост');
DEFINE('_PORT', 'Порт');
DEFINE('_CACHE_KEY_TOOLTIP','Этот ключ предназначен для генерации кеш файлов. Используется системой и не может быть изменен вручную');
DEFINE('_CACHE_KEY_TEXT','Кеш-ключ');
DEFINE('_COM_CONFIG_CONTENT_USE_SAVE_MAMBOT','Разрешить мамботы сохранения содержимого');