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

@require_once(dirname(__FILE__) . '/../../class2.php');

if(!getperms('P')) {
	exit('You do not have permission');
}

require_once(e_ADMIN.'auth.php');

global $ns;

$text = '<div class="forumheader" style="text-align: center;">Инструкция</div><br />
<div class="forumheader3" style="text-align: left;">
<ol>
	<li>Для объединения тем, кликните на значок <img src="'.e_PLUGIN.'forum_mr/admin_move_post.png" alt="" /> в <b>первом</b> сообщении темы.</li>
	<li>Для переноса отдельного сообщения, кликните на значок <img src="'.e_PLUGIN.'forum_mr/admin_move_post.png" alt="" /> в любом сообщении темы <b>кроме первого</b>.</li>
	<li>Укажите адрес темы в которую необходимо перенести сообщения или с которой необходимо объединить темы.</li>
	<li>Смотрите результат:)</li>
</ol>
</div>
';

$ns->tablerender('Forum Move Reply', $text);

require_once(e_ADMIN.'footer.php');
