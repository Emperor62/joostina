<?php
/**
 * @package Joostina
 * @copyright Авторские права (C) 2008-2010 Joostina team. Все права защищены.
 * @license Лицензия http://www.gnu.org/licenses/gpl-2.0.htm GNU/GPL, или help/license.php
 * Joostina! - свободное программное обеспечение распространяемое по условиям лицензии GNU/GPL
 * Для получения информации о используемых расширениях и замечаний об авторском праве, смотрите файл help/copyright.php.
 */

// запрет прямого доступа
defined('_VALID_MOS') or die();

$search_ignore[] = "в";
$search_ignore[] = "на";
$search_ignore[] = "и";
$search_ignore[] = "или";
$search_ignore[] = "o";
$search_ignore[] = "об";
$search_ignore[] = "под";
$search_ignore[] = "по";
$bad_text = array( ' авле ' , ' без ' , ' больше ' , ' был ' , ' была ' , ' были ' , ' было ' , ' быть ' , ' вам ' , ' вас ' , ' вверх ' , ' видно ' , ' вот ' , ' все ' , ' всегда ' , ' всех ' , ' где ' , ' говорила ' , ' говорим ' , ' говорит ' , ' даже ' , ' два ' , ' для ' , ' его ' , ' ему ' , ' если ' , ' есть ' , ' еще ' , ' затем ' , ' здесь ' , ' знала ' , ' знаю ' , ' иду ' , ' или ' , ' каждый ' , ' кажется ' , ' казалось ' , ' как ' , ' какие ' , ' когда ' , ' которое ' , ' которые ' , ' кто ' , ' меня ' , ' мне ' , ' мог ' , ' могла ' , ' могу ' , ' мое ' , ' моей ' , ' может ' , ' можно ' , ' мои ' , ' мой ' , ' мол ' , ' моя ' , ' надо ' , ' нас ' , ' начал ' , ' начала ' , ' него ' , ' нее ' , ' ней ' , ' немного ' , ' немножко ' , ' нему ' , ' несколько ' , ' нет ' , ' никогда ' , ' них ' , ' ничего ' , ' однако ' , ' она ' , ' они ' , ' оно ' , ' опять ' , ' очень ' , ' под ' , ' пока ' , ' после ' , ' потом ' , ' почти ' , ' при ' , ' про ' , ' раз ' , ' своей ' , ' свой ' ,  ' свою ' ,  ' себе ' ,  ' себя ' ,  ' сейчас ' ,  ' сказал ' ,  ' сказала ' ,  ' слегка ' , ' слишком ' ,  ' словно ' ,  ' снова ' ,  ' стал ' ,  ' стала ' ,  ' стали ' ,  ' так ' ,  ' там ' ,  ' твои ' , ' твоя ' ,  ' тебе ' ,  ' тебя ' ,  ' теперь ' ,  ' тогда ' ,  ' того ' ,  ' тоже ' ,  ' только ' ,  ' три ' ,  ' тут ' , ' уже ' ,  ' хотя ' ,  ' чем ' ,  ' через ' ,  ' что ' ,  ' чтобы ' ,  ' чуть ' ,  ' эта ' ,  ' эти ' ,  ' этих ' ,  ' это ' , ' этого ' ,  ' этой ' ,  ' этом ' ,  ' эту ' );