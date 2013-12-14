<?php
/*
+-------------------------------------------------------------------------
|
|     Forum move reply version 0.1
|
|     Author: Evlanov Alexander (Kapman)
|     etc@kapman.ru
|     http://kapman.ru
|
|     Released under the terms and conditions of the
|     GNU General Public License (http://gnu.org).
|
+-------------------------------------------------------------------------
*/

$eplug_name 		= 'Forum move reply';
$eplug_version 		= '0.1';
$eplug_description 	= 'Плагин добавляет возможность объединения тем и перемещения сообщений для форума е107';

$eplug_author		= 'Evlanov Alexander (Kapman)';
$eplug_email		= 'etc@kapman.ru';
$eplug_url 			= 'http://kapman.ru';

$eplug_compatible	= 'e107v0.7+';

$eplug_folder		= 'forum_mr';

$eplug_icon 		= $eplug_folder.'/ico32.png';
$eplug_icon_small 	= $eplug_folder.'/ico16.png';

$eplug_conffile    = 'admin_fmr.php';

$eplug_prefs = array(
	'forum_mr_install' => '1',
);
