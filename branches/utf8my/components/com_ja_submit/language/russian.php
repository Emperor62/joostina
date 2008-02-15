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
require(dirname(__FILE__).'/../../../die.php');

#Common
DEFINE("_H_SUBMIT_CONTENT","Отправить свою публикацию");
DEFINE("_H_SUBMIT_DISABLE","Извините, наша система отправки публикаций временно отключена. Загляните позже.");
DEFINE("_H_CANCEL","Отменить");
DEFINE("_H_SUBMIT","Отправить");
DEFINE("_H_IMG","Изображение");
DEFINE("_H_ERROR","Ошибка");
DEFINE("_H_WARNING","Внимание");
DEFINE("_H_YES","Да");
DEFINE("_H_NO","Нет");
DEFINE("_H_SI_REFUSE","Ваш запрос отклонён антиспаминг-роботом");
DEFINE("_H_ADD_MORE","Добавить другую публикацию");
DEFINE("_H_RETURN_FRONTPAGE","Вернуться на главную страницу");

#Edit your rules and guide if enable
DEFINE("_H_SUBMIT_GUIDE","<b>Прочтите правила:</b><br>");
DEFINE("_H_SUBMIT_RULES","
Приветствуются публикации, соответствующие тематике сайта<br>
Выбирайте категорию, точно соответствующую теме Вашего сообщения<br>
Размещающий публикацию несёт персональную ответственность за её содержание и достоверность информации<br>
Не забудьте проверить грамматику<br>
Предложенные публикации могут быть отклонены командой поддержки сайта.<br>
Любые публикации рекламного характера будут отклонены<hr>
");

#UPLOAD CONTENT 
DEFINE("_H_SECTION","Раздел");
DEFINE("_H_CAT","Категория");
DEFINE("_H_UNSUPPORTED_IMAGE","Попытка загрузки изображения недопустимого формата");
DEFINE("_UNABLE_IMAGE","Невозможно загрузить Ваше изображение");
DEFINE("_H_UNSUPPORT_IMAGE_1","Неправильный формат рисунка (тип файла) для вводного текста");
DEFINE("_H_UNSUPPORT_IMAGE_2","Неправильный формат рисунка (тип файла) для основного текста");
DEFINE("_H_ALLOW_IMG_TYPE","Разрешённые типы файлов");
DEFINE("_H_INTRO_IMG","Рисунок для вводного текста");
DEFINE("_H_MAIN_IMG","Рисунок для основного текста");
#EMAIL 
DEFINE("_H_EMAIL_NOTICE","Публикация отправлена в");
DEFINE("_H_AS_FOLLOW","как изложено ниже");
DEFINE("_H_EMAIL_SUBJECT","На Ваш сайт прислана новая публикация");
DEFINE("_H_NAME","Имя");
DEFINE("_H_PLS_LOG_PR","Пожалуйста зарегистрируйтесь в системе");
DEFINE("_H_AUTOSYSTEM","Сообщение сгенерировано роботом и не требует ответа");

DEFINE("_H_FULLNAME","Полное имя");
DEFINE("_H_EMAIL","e-mail");
DEFINE("_H_TITLE","Заголовок");
DEFINE("_H_INTROTEXT","Вводный текст");
DEFINE("_H_REQUIRED","требуется обязательно");
DEFINE("_H_OPTIONAL","может быть");
DEFINE("_H_MAINTEXT","Основной текст");
DEFINE("_H_IMGVERIFY","Код безопасности");
DEFINE("_H_IMGVERIFY_DES","Пожалуйста, введите символы кода безопасности.");
DEFINE("_H_ENTER_NAME","Пожалуйста, введите Ваше ИМЯ");
DEFINE("_H_ENTER_EMAIL","Пожалуйста, введите ПРАВИЛЬНЫЙ адрес e-mail, возможно потребуется дополнительная информация по Вашей публикации");
DEFINE("_H_ENTER_TITLE","Пожалуйста, введите ЗАГОЛОВОК Вашей публикации");
DEFINE("_H_ENTER_TEXT","Пожалуйста, введите ТЕКСТ Вашей публикации");
DEFINE("_H_ENTER_SI","Пожалуйста, точно введите код безопасности перед отправкой публикации.");
DEFINE("_H_CHOOSE_CAT","Пожалуйста, выберите категорию");
DEFINE("_H_UPLOAD","Загрузить на сайт");
DEFINE("_H_MAX_SIZE","Максимальный размер файла");
DEFINE("_H_BYTES","байт");
DEFINE("_H_ENABLE","Активировать?");
DEFINE("_H_ALLOW_EXT","Типы файлов");
DEFINE("_H_THANKS","Благодарим за Вашу публикацию. Перед размещением она будет просмотрена командой поддержки сайта");
DEFINE("_H_THANKS_PUBLISHED","Благодарим за Ваше сообщение, оно опубликовано. По ссылке внизу Вы сможете её просмотреть");

DEFINE("_H_SUCCESS_UP","успешно загружен");
DEFINE("_H_FAILED_UP","ошибка загрузки.");
DEFINE("_H_FILE_LARGER","Размер файла превышает");
?>
