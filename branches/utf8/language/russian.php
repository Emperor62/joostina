<?php
/**
* @package Joostina
* @copyright Авторские права (C) 2007 Joostina team. Все права защищены.
* @license Лицензия http://www.gnu.org/copyleft/gpl.html GNU/GPL, смотрите LICENSE.php
* Joostina! - свободное программное обеспечение. Эта версия может быть изменена
* в соответствии с Генеральной Общественной Лицензией GNU, поэтому возможно
* её дальнейшее распространение в составе результата работы, лицензированного
* согласно Генеральной Общественной Лицензией GNU или других лицензий свободных
* программ или программ с открытым исходным кодом.
* Для просмотра подробностей и замечаний об авторском праве, смотрите файл COPYRIGHT.php.
*/

// запрет прямого доступа
defined( '_VALID_MOS' ) or die( 'Прямой вызов файла запрещен' );

// Страница сайта не найдена
define( '_404', 'Запрошенная страница не найдена.' );
define( '_404_RTS', 'Вернуться на сайт' );

define( '_SYSERR1', 'Нет поддержки MySQL' );
define( '_SYSERR2', 'Невозможно подключиться к серверу базы данных' );
define( '_SYSERR3', 'Невозможно подключиться к базе данных' );

// общее
DEFINE('_LANGUAGE','ru');
DEFINE('_NOT_AUTH','Извините, но для просмотра этой страницы у Вас недостаточно прав.');
DEFINE('_DO_LOGIN','Вы должны авторизоваться или пройти регистрацию.');
DEFINE('_VALID_AZ09',"Пожалуйста, проверьте, правильно ли написано %s.  Имя не должно содержать пробелов, только символы 0-9,a-z,A-Z и иметь длину не менее %d символов.");
DEFINE('_VALID_AZ09_USER',"Пожалуйста, правильно введите %s. Должно содержать только символы 0-9,a-z,A-Z и иметь длину не менее %d символов.");
DEFINE('_CMN_YES','Да');
DEFINE('_CMN_NO','Нет');
DEFINE('_CMN_SHOW','Показать');
DEFINE('_CMN_HIDE','Скрыть');

DEFINE('_CMN_NAME','Имя');
DEFINE('_CMN_DESCRIPTION','Описание');
DEFINE('_CMN_SAVE','Сохранить');
DEFINE('_CMN_APPLY','Применить');
DEFINE('_CMN_CANCEL','Отмена');
DEFINE('_CMN_PRINT','Печать');
DEFINE('_CMN_EMAIL','E-mail');
DEFINE('_ICON_SEP','|');
DEFINE('_CMN_PARENT','Родитель');
DEFINE('_CMN_ORDERING','Сортировка');
DEFINE('_CMN_ACCESS','Уровень доступа');
DEFINE('_CMN_SELECT','Выбрать');

DEFINE('_CMN_NEXT','След.');
DEFINE('_CMN_NEXT_ARROW',"&nbsp;&raquo;");
DEFINE('_CMN_PREV','Пред.');
DEFINE('_CMN_PREV_ARROW',"&laquo;&nbsp;");

DEFINE('_CMN_SORT_NONE','Без сортировки');
DEFINE('_CMN_SORT_ASC','По возрастанию');
DEFINE('_CMN_SORT_DESC','По убыванию');

DEFINE('_CMN_NEW','Создать');
DEFINE('_CMN_NONE','Нет');
DEFINE('_CMN_LEFT','Слева');
DEFINE('_CMN_RIGHT','Справа');
DEFINE('_CMN_CENTER','По центру');
DEFINE('_CMN_ARCHIVE','Добавить в архив');
DEFINE('_CMN_UNARCHIVE','Извлечь из архива');
DEFINE('_CMN_TOP','Вверху');
DEFINE('_CMN_BOTTOM','Внизу');

DEFINE('_CMN_PUBLISHED','Опубликовано');
DEFINE('_CMN_UNPUBLISHED','Не опубликовано');

DEFINE('_CMN_EDIT_HTML','Редактировать HTML');
DEFINE('_CMN_EDIT_CSS','Редактировать CSS');

DEFINE('_CMN_DELETE','Удалить');

DEFINE('_CMN_FOLDER','Каталог');
DEFINE('_CMN_SUBFOLDER','Подкаталог');
DEFINE('_CMN_OPTIONAL','Не обязательно');
DEFINE('_CMN_REQUIRED','Обязательно');

DEFINE('_CMN_CONTINUE','Продолжить');

DEFINE('_STATIC_CONTENT','Статическое содержимое');

DEFINE('_CMN_NEW_ITEM_LAST','По умолчанию новые объекты будут добавлены в конец списка. Порядок расположения может быть изменен только после сохранения объекта.');
DEFINE('_CMN_NEW_ITEM_FIRST','По умолчанию новые объекты будут добавлены в начало списка. Порядок расположения может быть изменен только после сохранения объекта.');
DEFINE('_LOGIN_INCOMPLETE','Пожалуйста, заполните поля Имя пользователя и Пароль.');
DEFINE('_LOGIN_BLOCKED','Извините, ваша учетная запись заблокирована. За более подробной информацией обратитесь к администратору сайта.');
DEFINE('_LOGIN_INCORRECT','Неправильное имя пользователя (логин) или пароль. Попробуйте ещё раз.');
DEFINE('_LOGIN_NOADMINS','Извините, вы не можете войти на сайт. Администраторы на сайте не зарегистрированы.');
DEFINE('_CMN_JAVASCRIPT','Внимание! Для выполнения данной операции, в вашем браузере должна быть включена поддержка Java-script.');

DEFINE('_NEW_MESSAGE','Вам пришло новое личное сообщение');
DEFINE('_MESSAGE_FAILED','Пользователь заблокировал свой почтовый ящик. Сообщение не доставлено.');

DEFINE('_CMN_IFRAMES', 'Эта страница будет отображена некорректно. Ваш браузер не поддерживает вложенные фреймы (IFrame)');

DEFINE('_INSTALL_3PD_WARN','Предупреждение: Установка сторонних расширений может нарушить безопасность вашего сайта. При обновлении Joomla! сторонние расширения не обновляются.<br />Для получения дополнительной информации о мерах защиты своего сайта и сервера, пожалуйста, посетите <a href="http://forum.joomla.org/index.php/board,267.0.html" target="_blank" style="color: blue; text-decoration: underline;">Форум безопасности Joomla!</a>.');
DEFINE('_INSTALL_WARN','По соображениям безопасности, пожалуйста, удалите папку <strong>installation</strong> с вашего сервера и обновите страницу.');
DEFINE('_TEMPLATE_WARN','<font color=\"red\"><strong>Файл шаблона не найден:</strong></font> <br /> Зайдите в Панель управления сайтом и выберите новый шаблон ');
DEFINE('_NO_PARAMS','Объект не содержит настраиваемых параметров');
DEFINE('_HANDLER','Обработчик для данного типа отсутствует');

/** мамботы */
DEFINE('_TOC_JUMPTO','Оглавление');

/**  содержимое */
DEFINE('_READ_MORE','Подробнее...');
DEFINE('_READ_MORE_REGISTER','Только для зарегистрированных пользователей...');
DEFINE('_MORE','Далее...');
DEFINE('_ON_NEW_CONTENT', "Пользователь [ %s ] добавил новый объект [ %s ]. Раздел: [ %s ]. Категория: [ %s ]" );
DEFINE('_SEL_CATEGORY','- Выберите категорию -');
DEFINE('_SEL_SECTION','- Выберите раздел -');
DEFINE('_SEL_AUTHOR','- Выберите автора -');
DEFINE('_SEL_POSITION','- Выберите позицию -');
DEFINE('_SEL_TYPE','- Выберите тип -');
DEFINE('_EMPTY_CATEGORY','Данная категория не содержит объектов.');
DEFINE('_EMPTY_BLOG','Нет объектов для отображения!');
DEFINE('_NOT_EXIST','Извините, страница не найдена.<br />Пожалуйста, вернитесь на главную страницу сайта.');
DEFINE('_SUBMIT_BUTTON','Отправить');

/** classes/html/modules.php */
DEFINE('_BUTTON_VOTE','Голосовать');
DEFINE('_BUTTON_RESULTS','Результаты');
DEFINE('_USERNAME','Пользователь');
DEFINE('_LOST_PASSWORD','Забыли пароль?');
DEFINE('_PASSWORD','Пароль');
DEFINE('_BUTTON_LOGIN','Войти');
DEFINE('_BUTTON_LOGOUT','Выйти');
DEFINE('_NO_ACCOUNT','Ещё не зарегистрированы?');
DEFINE('_CREATE_ACCOUNT','Регистрация');
DEFINE('_VOTE_POOR','Худшая');
DEFINE('_VOTE_BEST','Лучшая');
DEFINE('_USER_RATING','Рейтинг');
DEFINE('_RATE_BUTTON','Оценить');
DEFINE('_REMEMBER_ME','Запомнить');

/** contact.php */
DEFINE('_ENQUIRY','Контакт');
DEFINE('_ENQUIRY_TEXT','Это сообщение отправлено с сайта %s. Автор сообщения:');
DEFINE('_COPY_TEXT','Это копия сообщения, которое Вы отправили для %s с сайта %s ');
DEFINE('_COPY_SUBJECT','Копия: ');
DEFINE('_THANK_MESSAGE','Спасибо! Сообщение успешно отправлено.');
DEFINE('_CLOAKING','Этот e-mail защищен от спам-ботов. Для его просмотра в вашем браузере должна быть включена поддержка Java-script');
DEFINE('_CONTACT_HEADER_NAME','Имя');
DEFINE('_CONTACT_HEADER_POS','Положение');
DEFINE('_CONTACT_HEADER_EMAIL','E-mail');
DEFINE('_CONTACT_HEADER_PHONE','Телефон');
DEFINE('_CONTACT_HEADER_FAX','Факс');
DEFINE('_CONTACTS_DESC','Список контактов этого сайта.');
DEFINE('_CONTACT_MORE_THAN','Вы не можете вводить более одного адреса e-mail.');

/** classes/html/contact.php */
DEFINE('_CONTACT_TITLE','Обратная связь');
DEFINE('_EMAIL_DESCRIPTION','Отправить e-mail пользователю:');
DEFINE('_NAME_PROMPT',' Введите Ваше имя:');
DEFINE('_EMAIL_PROMPT',' Введите Ваш e-mail:');
DEFINE('_MESSAGE_PROMPT',' Введите текст сообщения:');
DEFINE('_SEND_BUTTON','Отправить');
DEFINE('_CONTACT_FORM_NC','Пожалуйста, заполните форму полностью и правильно.');
DEFINE('_CONTACT_TELEPHONE','Телефон: ');
DEFINE('_CONTACT_MOBILE','Мобильный: ');
DEFINE('_CONTACT_FAX','Факс: ');
DEFINE('_CONTACT_EMAIL','E-mail: ');
DEFINE('_CONTACT_NAME','Имя: ');
DEFINE('_CONTACT_POSITION','Должность: ');
DEFINE('_CONTACT_ADDRESS','Адрес: ');
DEFINE('_CONTACT_MISC','Доп. информация: ');
DEFINE('_CONTACT_SEL','Выберите получателя:');
DEFINE('_CONTACT_NONE','Детали этой контактной записи отсутствуют.');
DEFINE('_CONTACT_ONE_EMAIL','Нельзя вводить более одного адреса email.');
DEFINE('_EMAIL_A_COPY','Отправить копию сообщения на собственный адрес');
DEFINE('_CONTACT_DOWNLOAD_AS','Скачать информацию в формате');
DEFINE('_VCARD','VCard');

/** pageNavigation */
DEFINE('_PN_LT','&lt;');
DEFINE('_PN_RT','&gt;');
DEFINE('_PN_PAGE','Страница');
DEFINE('_PN_OF','из');
DEFINE('_PN_START','[Первая]');
DEFINE('_PN_PREVIOUS','[Предыдущая]');
DEFINE('_PN_NEXT','[Следующая]');
DEFINE('_PN_END','[Последняя]');
DEFINE('_PN_DISPLAY_NR','Показывать');
DEFINE('_PN_RESULTS','Результаты');

/** письмо другу */
DEFINE('_EMAIL_TITLE','Отправить e-mail другу');
DEFINE('_EMAIL_FRIEND','Отправить ссылку страницы на e-mail:');
DEFINE('_EMAIL_FRIEND_ADDR','E-Mail друга:');
DEFINE('_EMAIL_YOUR_NAME','Ваше имя:');
DEFINE('_EMAIL_YOUR_MAIL','Ваш e-mail:');
DEFINE('_SUBJECT_PROMPT',' Тема сообщения:');
DEFINE('_BUTTON_SUBMIT_MAIL','Отправить');
DEFINE('_BUTTON_CANCEL','Отмена');
DEFINE('_EMAIL_ERR_NOINFO','Вы должны правильно ввести свой e-mail и e-mail получателя этого письма.');
DEFINE('_EMAIL_MSG',' Здравствуйте! Следующую ссылку на страницу сайта "%s" отправил Вам %s ( %s ).

Вы сможете просмотреть её по этой ссылке:
%s');
DEFINE('_EMAIL_INFO','Письмо отправил');
DEFINE('_EMAIL_SENT','Ссылка на эту страницу отправлена для');
DEFINE('_PROMPT_CLOSE','Закрыть окно');

/** classes/html/content.php */
DEFINE('_AUTHOR_BY', ' Автор');
DEFINE('_WRITTEN_BY', ' Автор');
DEFINE('_LAST_UPDATED', 'Последнее обновление');
DEFINE('_BACK','Вернуться');
DEFINE('_LEGEND','История');
DEFINE('_DATE','Дата');
DEFINE('_ORDER_DROPDOWN','Порядок');
DEFINE('_HEADER_TITLE','Название');
DEFINE('_HEADER_AUTHOR','Автор');
DEFINE('_HEADER_SUBMITTED','Написан');
DEFINE('_HEADER_HITS','Просмотров');
DEFINE('_E_EDIT','Редактировать');
DEFINE('_E_ADD','Добавить');
DEFINE('_E_WARNUSER','Пожалуйста, нажмите кнопку "Отмена" или "Сохранить", чтобы покинуть эту страницу');
DEFINE('_E_WARNTITLE','Содержимое должно иметь заголовок');
DEFINE('_E_WARNTEXT','Содержимое должно иметь вводный текст');
DEFINE('_E_WARNCAT','Пожалуйста, выберите категорию');
DEFINE('_E_CONTENT','Содержимое');
DEFINE('_E_TITLE','Заголовок:');
DEFINE('_E_CATEGORY','Категория:');
DEFINE('_E_INTRO','Вводный текст');
DEFINE('_E_MAIN','Основной текст');
DEFINE('_E_MOSIMAGE','Вставить тег {mosimage}');
DEFINE('_E_IMAGES','Изображения');
DEFINE('_E_GALLERY_IMAGES','Галерея изображений');
DEFINE('_E_CONTENT_IMAGES','Изображения к тексту');
DEFINE('_E_EDIT_IMAGE','Параметры изображения');
DEFINE('_E_NO_IMAGE','Без изображения');
DEFINE('_E_INSERT','Вставить');
DEFINE('_E_UP','Выше');
DEFINE('_E_DOWN','Ниже');
DEFINE('_E_REMOVE','Удалить');
DEFINE('_E_SOURCE','Название файла:');
DEFINE('_E_ALIGN','Расположение:');
DEFINE('_E_ALT','Альтернативный текст:');
DEFINE('_E_BORDER','Рамка:');
DEFINE('_E_CAPTION','Заголовок');
DEFINE('_E_CAPTION_POSITION','Положение подписи');
DEFINE('_E_CAPTION_ALIGN','Выравнивание подписи');
DEFINE('_E_CAPTION_WIDTH','Ширина подписи');
DEFINE('_E_APPLY','Применить');
DEFINE('_E_PUBLISHING','Публикация');
DEFINE('_E_STATE','Состояние:');
DEFINE('_E_AUTHOR_ALIAS','Псевдоним автора:');
DEFINE('_E_ACCESS_LEVEL','Уровень доступа:');
DEFINE('_E_ORDERING','Порядок:');
DEFINE('_E_START_PUB','Дата начала публикации:');
DEFINE('_E_FINISH_PUB','Дата окончания публикации:');
DEFINE('_E_SHOW_FP','Показывать на главной странице:');
DEFINE('_E_HIDE_TITLE','Скрыть заголовок:');
DEFINE('_E_METADATA','Мета-тэги');
DEFINE('_E_M_DESC','Описание:');
DEFINE('_E_M_KEY','Ключевые слова:');
DEFINE('_E_SUBJECT','Тема:');
DEFINE('_E_EXPIRES','Дата истечения:');
DEFINE('_E_VERSION','Версия:');
DEFINE('_E_ABOUT','Об объекте');
DEFINE('_E_CREATED','Дата создания:');
DEFINE('_E_LAST_MOD','Последнее изменение:');
DEFINE('_E_HITS','Количество просмотров:');
DEFINE('_E_SAVE','Сохранить');
DEFINE('_E_CANCEL','Отмена');
DEFINE('_E_REGISTERED','Только для зарегистрированных пользователей');
DEFINE('_E_ITEM_INFO','Информация');
DEFINE('_E_ITEM_SAVED','Успешно сохранено!');
DEFINE('_ITEM_PREVIOUS','&laquo; ');
DEFINE('_ITEM_NEXT',' &raquo;');
DEFINE('_KEY_NOT_FOUND','Ключ не найден');


/** content.php */
DEFINE('_SECTION_ARCHIVE_EMPTY','В этом разделе архива сейчас нет объектов. Пожалуйста, зайдите позже');
DEFINE('_CATEGORY_ARCHIVE_EMPTY','В этой категории архива сейчас нет объектов. Пожалуйста, зайдите позже');
DEFINE('_HEADER_SECTION_ARCHIVE','Архив разделов');
DEFINE('_HEADER_CATEGORY_ARCHIVE','Архив категорий');
DEFINE('_ARCHIVE_SEARCH_FAILURE','Не найдено архивных записей для %s %s');        // значения месяца, а затем года
DEFINE('_ARCHIVE_SEARCH_SUCCESS','Найдены архивные записи для %s %s');                // значения месяца, а затем года
DEFINE('_FILTER','Фильтр');
DEFINE('_ORDER_DROPDOWN_DA','Дата (по возрастанию)');
DEFINE('_ORDER_DROPDOWN_DD','Дата (по убыванию)');
DEFINE('_ORDER_DROPDOWN_TA','Название (по возрастанию)');
DEFINE('_ORDER_DROPDOWN_TD','Название (по убыванию)');
DEFINE('_ORDER_DROPDOWN_HA','Рейтинг (по возрастанию)');
DEFINE('_ORDER_DROPDOWN_HD','Рейтинг (по убыванию)');
DEFINE('_ORDER_DROPDOWN_AUA','Автор (по возрастанию)');
DEFINE('_ORDER_DROPDOWN_AUD','Автор (по убыванию)');
DEFINE('_ORDER_DROPDOWN_O','По порядку');

/** poll.php */
DEFINE('_ALERT_ENABLED','Cookies должны быть разрешены!');
DEFINE('_ALREADY_VOTE','Вы уже проголосовали в этом опросе!');
DEFINE('_NO_SELECTION','Вы не сделали свой выбор. Пожалуйста, попробуйте ещё раз');
DEFINE('_THANKS','Спасибо за Ваше участие в голосовании!');
DEFINE('_SELECT_POLL','Выберите опрос из списка');

/** classes/html/poll.php */
DEFINE('_JAN','Январь');
DEFINE('_FEB','Февраль');
DEFINE('_MAR','Март');
DEFINE('_APR','Апрель');
DEFINE('_MAY','Май');
DEFINE('_JUN','Июнь');
DEFINE('_JUL','Июль');
DEFINE('_AUG','Август');
DEFINE('_SEP','Сентябрь');
DEFINE('_OCT','Октябрь');
DEFINE('_NOV','Ноябрь');
DEFINE('_DEC','Декабрь');
DEFINE('_POLL_TITLE','Результаты опроса');
DEFINE('_SURVEY_TITLE','Название опроса:');
DEFINE('_NUM_VOTERS','Количество проголосовавших:');
DEFINE('_FIRST_VOTE','Первый голос:');
DEFINE('_LAST_VOTE','Последний голос:');
DEFINE('_SEL_POLL','Выберите опрос:');
DEFINE('_NO_RESULTS','Нет данных по выбранному опросу.');

/** registration.php */
DEFINE('_ERROR_PASS','Извините, такой пользователь не найден.');
DEFINE('_NEWPASS_MSG','Учетная запись пользователя $checkusername соответствует адресу e-mail.\n'
.' Пользователь сайта $mosConfig_live_site сделал запрос на получение нового пароля.\n\n'
.' Ваш новый пароль: $newpass\n\nЕсли Вы не запрашивали изменение пароля, сообщите об этом администратору.'
.' Только Вы можете увидеть это сообщение, больше никто. Если это ошибка, просто зайдите '
.' на сайт, используя новый пароль, и затем, измените его на удобный Вам.');
DEFINE('_NEWPASS_SUB','$_sitename :: Новый пароль для $checkusername');
DEFINE('_NEWPASS_SENT','Новый пароль создан и отправлен пользователю!');
DEFINE('_REGWARN_NAME','Пожалуйста, введите свое настоящее имя (имя, отображаемое на сайте).');
DEFINE('_REGWARN_UNAME','Пожалуйста, введите свое имя пользователя (логин).');
DEFINE('_REGWARN_MAIL','Пожалуйста, правильно введите адрес e-mail.');
DEFINE('_REGWARN_PASS','Пожалуйста, правильно введите пароль. Пароль не должен содержать пробелы, его длина должна быть не меньше 6 символов и он должен состоять только из цифр (0-9) и латинских символов (a-z, A-Z)');
DEFINE('_REGWARN_VPASS1','Пожалуйста, проверьте пароль.');
DEFINE('_REGWARN_VPASS2','Пароль и его подтверждение не совпадают. Пожалуйста, попробуйте ещё раз.');
DEFINE('_REGWARN_INUSE','Это имя пользователя уже используется. Пожалуйста, выберите другое имя.');
DEFINE('_REGWARN_EMAIL_INUSE', 'Этот e-mail уже используется. Если Вы забыли свой пароль, Нажмите на ссылку "Забыли пароль?" и на указанный e-mail будет выслан новый пароль.');
DEFINE('_SEND_SUB','Данные о новом пользователе %s с %s');
DEFINE('_USEND_MSG_ACTIVATE', 'Здравствуйте %s,

Благодарим за регистрацию на сайте %s. Ваша учетная запись успешно создана и должна быть активирована.
Чтобы активировать учетную запись, нажмите на ссылке или скопируйте ее в адресную строку браузера:
%s

После активации Вы можете зайти на сайт %s, используя свое имя пользователя и пароль:

Имя пользователя - %s
Пароль - %s');
DEFINE('_USEND_MSG', "Здравствуйте %s,

Благодарим Вас за регистрацию на сайте %s.

Сейчас Вы можете войти на сайт %s, используя имя пользователя и пароль, введенные вами при регистрации.");
DEFINE('_USEND_MSG_NOPASS','Здравствуйте $name,\n\nВы успешно зарегистрированы на сайте $mosConfig_live_site.\n'
.'Вы можете зайти на сайт $mosConfig_live_site, используя данные, которые Вы указали при регистрации.\n\n'
.'На это письмо не надо отвечать, так как оно создано автоматически и предназначено только для уведомления\n');
DEFINE('_ASEND_MSG','Здравствуйте! Это системное сообщение с сайта %s.

На сайте %s зарегистрировался новый пользователь.

Данные пользователя:
Настоящее имя - %s
Адрес e-mail - %s
Имя пользователя - %s

На это письмо не надо отвечать, так как оно создано автоматически и предназначено только для уведомления');
DEFINE('_REG_COMPLETE_NOPASS','<div class="componentheading">Регистрация завершена!</div><br />&nbsp;&nbsp;'
.'Сейчас Вы можете войти на сайт.<br />&nbsp;&nbsp;');
DEFINE('_REG_COMPLETE', '<div class="componentheading">Регистрация завершена!</div><br />Сейчас Вы можете войти на сайт.');
DEFINE('_REG_COMPLETE_ACTIVATE', '<div class="componentheading">Регистрация завершена!</div><br />Ваша учетная запись создана и должна быть активирована перед тем, как вы ею воспользуетесь. На Ваш e-mail было отправлено письмо со ссылкой, с помощью которой Вы можете активировать свою учетную запись.');
DEFINE('_REG_ACTIVATE_COMPLETE', '<div class="componentheading">Учетная запись активирована!</div><br />Ваша учетная запись активирована. Теперь Вы можете зайти на сайт, используя имя пользователя и пароль, которые Вы ввели при регистрации.');
DEFINE('_REG_ACTIVATE_NOT_FOUND', '<div class="componentheading">Неверная ссылка активации!</div><br />Данная учетная запись отсутствует на сайте или уже активирована.');
DEFINE('_REG_ACTIVATE_FAILURE', '<div class="componentheading">Ошибка активации!</div><br />Активация вашей учетной записи невозможна. Пожалуйста, обратитесь к администратору.');

/** classes/html/registration.php */
DEFINE('_PROMPT_PASSWORD','Забыли пароль?');
DEFINE('_NEW_PASS_DESC','Пожалуйста, введите свои имя пользователя и адрес e-mail, затем нажмите кнопку "Отправить пароль".<br />'
.'Вскоре, на указанный адрес e-mail Вы получите письмо с новым паролем. Используйте этот пароль для входа на сайт.');
DEFINE('_PROMPT_UNAME','Имя пользователя:');
DEFINE('_PROMPT_EMAIL','Адрес e-mail:');
DEFINE('_BUTTON_SEND_PASS','Отправить пароль');
DEFINE('_REGISTER_TITLE','Регистрация');
DEFINE('_REGISTER_NAME','Настоящее имя:');
DEFINE('_REGISTER_UNAME','Имя пользователя:');
DEFINE('_REGISTER_EMAIL','E-mail:');
DEFINE('_REGISTER_PASS','Пароль:');
DEFINE('_REGISTER_VPASS','Подтверждение пароля:');
DEFINE('_REGISTER_REQUIRED','Все поля, отмеченные символом (*), обязательны для заполнения!');
DEFINE('_BUTTON_SEND_REG','Отправить данные');
DEFINE('_SENDING_PASSWORD','Ваш пароль будет отправлен на указанный выше адрес e-mail.<br />Когда Вы получите'
.' новый пароль, Вы сможете зайти на сайт и изменить этот пароль в любое время.');

/** classes/html/search.php */
DEFINE('_SEARCH_TITLE','Поиск');
DEFINE('_PROMPT_KEYWORD','Поиск по ключевой фразе');
DEFINE('_SEARCH_MATCHES','найдено %d совпадений');
DEFINE('_CONCLUSION','Всего найдено $totalRows материалов. Найти <b>$searchword</b> с помощью');
DEFINE('_NOKEYWORD','Ничего не найдено');
DEFINE('_IGNOREKEYWORD','В поиске были пропущены предлоги');
DEFINE('_SEARCH_ANYWORDS','Любое слово');
DEFINE('_SEARCH_ALLWORDS','Все слова');
DEFINE('_SEARCH_PHRASE','Целую фразу');
DEFINE('_SEARCH_NEWEST','По убыванию');
DEFINE('_SEARCH_OLDEST','По возрастанию');
DEFINE('_SEARCH_POPULAR','По популярности');
DEFINE('_SEARCH_ALPHABETICAL','Алфавитный порядок');
DEFINE('_SEARCH_CATEGORY','Раздел / Категория');
DEFINE('_SEARCH_MESSAGE','Текст для поиска должен содержать от 3 до 20 символов');
DEFINE('_SEARCH_ARCHIVED','В архиве');
DEFINE('_SEARCH_CATBLOG','Блог категории');
DEFINE('_SEARCH_CATLIST','Список категории');
DEFINE('_SEARCH_NEWSFEEDS','Ленты новостей');
DEFINE('_SEARCH_SECLIST','Список раздела');
DEFINE('_SEARCH_SECBLOG','Блог раздела');


/** templates/*.php */
DEFINE('_ISO','charset=windows-1251');
DEFINE('_DATE_FORMAT','Сегодня: d.m.Y г.');  //Используйте формат PHP-функции DATE
/**
* измените строчку ниже, для изменения вывода даты на сайте
*
* например, DEFINE("_DATE_FORMAT_LC"," %d %B %Y г. %H:%M"); //Используйте формат PHP-функции strftime
*/
DEFINE('_DATE_FORMAT_LC',$mosConfig_form_date); //Используйте формат PHP-функции strftime
DEFINE('_DATE_FORMAT_LC2',$mosConfig_form_date_full); // Полный формат времени
DEFINE('_SEARCH_BOX','Поиск...');
DEFINE('_NEWSFLASH_BOX','Краткие новости!');
DEFINE('_MAINMENU_BOX','Главное меню');

/** classes/html/usermenu.php */
DEFINE('_UMENU_TITLE','Меню пользователя');
DEFINE('_HI','Здравствуйте, ');

/** user.php */
DEFINE('_SAVE_ERR','Пожалуйста, заполните все поля.');
DEFINE('_THANK_SUB','Спасибо за Ваш материал. Он будет просмотрен администратором перед размещением на сайте.');
DEFINE('_THANK_SUB_PUB','Спасибо за Ваш материал.');
DEFINE('_UP_SIZE','Вы не можете загружать файлы размером больше чем 15Кб.');
DEFINE('_UP_EXISTS','Изображение с именем $userfile_name уже существует. Пожалуйста, измените название файла и попробуйте ещё раз.');
DEFINE('_UP_COPY_FAIL','Ошибка при копировании');
DEFINE('_UP_TYPE_WARN','Вы можете загружать изображения только в формате gif или jpg.');
DEFINE('_MAIL_SUB','Новый материал от пользователя');
DEFINE('_MAIL_MSG','Здравствуйте $adminName,\n\nПользователь $author предлагает новый материал в раздел $type с названием $title'
.' для сайта $mosConfig_live_site.\n\n\n'
.'Пожалуйста, зайдите в панель администратора по адресу $mosConfig_live_site/administrator для просмотра и добавления его в $type.\n\n'
.'На это письмо не надо отвечать, так как оно создано автоматически и предназначено только для уведомления\n');
DEFINE('_PASS_VERR1','Если Вы желаете изменить пароль, пожалуйста, введите его ещё раз для подтверждения изменения.');
DEFINE('_PASS_VERR2','Если Вы решили изменить пароль, пожалуйста, обратите внимание, что пароль и его подтверждение должны совпадать.');
DEFINE('_UNAME_INUSE','Выбранное имя пользователя уже используется.');
DEFINE('_UPDATE','Обновить');
DEFINE('_USER_DETAILS_SAVE','Ваши данные сохранены.');
DEFINE('_USER_LOGIN','Вход пользователя');

/** components/com_user */
DEFINE('_EDIT_TITLE','Личные данные');
DEFINE('_YOUR_NAME','Настоящее имя:');
DEFINE('_EMAIL','Адрес e-mail:');
DEFINE('_UNAME','Имя пользователя:');
DEFINE('_PASS','Пароль:');
DEFINE('_VPASS','Подтверждение пароля:');
DEFINE('_SUBMIT_SUCCESS','Ваша информация принята!');
DEFINE('_SUBMIT_SUCCESS_DESC','Ваша информация успешно отправлена администратору. После просмотра, Ваш материал будет опубликован на этом сайте');
DEFINE('_WELCOME','Добро пожаловать!');
DEFINE('_WELCOME_DESC','Добро пожаловать в раздел пользователя нашего сайта');
DEFINE('_CONF_CHECKED_IN','Все \'заблокированные\' элементы теперь \'разблокированы\'.');
DEFINE('_CHECK_TABLE','Проверка таблицы');
DEFINE('_CHECKED_IN','Проверено ');
DEFINE('_CHECKED_IN_ITEMS','');
DEFINE('_PASS_MATCH','Пароли не совпадают');

/** components/com_banners */
DEFINE('_BNR_CLIENT_NAME','Вы должны ввести имя клиента.');
DEFINE('_BNR_CONTACT','Вы должны выбрать контакт для клиента.');
DEFINE('_BNR_VALID_EMAIL','Адрес электронной почты клиента должен быть правильным.');
DEFINE('_BNR_CLIENT','Вы должны выбрать клиента,');
DEFINE('_BNR_NAME','Введите имя баннера.');
DEFINE('_BNR_IMAGE','Выберите изображения баннера.');
DEFINE('_BNR_URL','Вы должны ввести URL/Код баннера.');

/** components/com_login */
DEFINE('_ALREADY_LOGIN','Вы уже авторизированы!');
DEFINE('_LOGOUT','Нажмите здесь для завершения работы');
DEFINE('_LOGIN_TEXT','Используйте поля "Пользователь" и "Пароль" для доступа к сайту');
DEFINE('_LOGIN_SUCCESS','Вы успешно вошли');
DEFINE('_LOGOUT_SUCCESS','Вы успешно закончили работу с сайтом');
DEFINE('_LOGIN_DESCRIPTION','Вы должны войти на сайт как пользователь, для доступа к закрытым разделам');
DEFINE('_LOGOUT_DESCRIPTION','Вы действительно хотите покинуть профиль?');


/** components/com_weblinks */
DEFINE('_WEBLINKS_TITLE','Ссылки');
DEFINE('_WEBLINKS_DESC','В данном разделе собраны наиболее интересные и полезные ссылки в сети.'
.' <br />Выберите из списка один из разделов, а затем выберите нужную ссылку.');
DEFINE('_HEADER_TITLE_WEBLINKS','Ссылка');
DEFINE('_SECTION','Раздел:');
DEFINE('_SUBMIT_LINK','Отправить ссылку');
DEFINE('_URL','URL:');
DEFINE('_URL_DESC','Описание:');
DEFINE('_NAME','Название:');
DEFINE('_WEBLINK_EXIST','Ссылка с таким именем уже существует. Измените имя и попробуйте ещё раз.');
DEFINE('_WEBLINK_TITLE','Ссылка должна иметь название.');

/** components/com_newfeeds */
DEFINE('_FEED_NAME','Название источника');
DEFINE('_FEED_ARTICLES','Статей');
DEFINE('_FEED_LINK','Ссылка источника');

/** whos_online.php */
DEFINE('_WE_HAVE', 'Сейчас на сайте находятся: <br />');
DEFINE('_AND', ' и ');
DEFINE('_GUEST_COUNT','%s гость');
DEFINE('_GUESTS_COUNT','%s гостей');
DEFINE('_MEMBER_COUNT','%s пользователь');
DEFINE('_MEMBERS_COUNT','%s пользователей');
DEFINE('_ONLINE','');
DEFINE('_NONE','Нет посетителей в онлайн');

/** modules/mod_banners */
DEFINE('_BANNER_ALT','Реклама');

/** modules/mod_random_image */
DEFINE('_NO_IMAGES','Нет изображений');

/** modules/mod_stats.php */
DEFINE('_TIME_STAT','Время');
DEFINE('_MEMBERS_STAT','Пользователей');
DEFINE('_HITS_STAT','Посещений');
DEFINE('_NEWS_STAT','Новостей');
DEFINE('_LINKS_STAT','Ссылок');
DEFINE('_VISITORS','Посетителей');

/** /adminstrator/components/com_menus/admin.menus.html.php */
DEFINE('_MAINMENU_HOME','* Первый по списку опубликованный пункт этого меню [mainmenu] автоматически становится `Главной` страницей сайта *');
DEFINE('_MAINMENU_DEL','* Вы не можете `удалить` это меню, поскольку оно необходимо для нормального функционирования сайта *');
DEFINE('_MENU_GROUP','* Некоторые `Типы меню` появляются более чем в одной группе *');


/** administrators/components/com_users */
DEFINE('_NEW_USER_MESSAGE_SUBJECT', 'Новые данные пользователя' );
DEFINE('_NEW_USER_MESSAGE', 'Здравствуйте, %s


Вы были зарегистрированы Администратором на сайте %s.

Это сообщение содержит Ваши имя пользователя и пароль, для входа на сайт %s:

Имя пользователя - %s
Пароль - %s


На это сообщение не нужно отвечать. Оно сгенерировано роботом рассылок и отправлено только для информирования.');

/** administrators/components/com_massmail */
DEFINE('_MASSMAIL_MESSAGE', "Это сообщение с сайта '%s'

Сообщение:
" );

// Joostina!

DEFINE('_REG_CAPTCHA', 'Введите текст с изображения: *');
DEFINE('_REG_CAPTCHA_VAL', 'Необходимо ввести код с изображения.');
DEFINE('_REG_CAPTCHA_REF', 'Нажмите что бы обновить изображение.');

?>
