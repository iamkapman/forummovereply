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

if(!is_numeric(e_QUERY)) {
	header('Location: /index.php');
	exit();
}

function get_moder($id) {
	global $sql;
	
	$id = intval($id);
	
	if($sql->db_Select('forum_t', '`thread_forum_id`', "`thread_id` = '{$id}'")) {
		$pr = $sql->db_Fetch();
		if($sql->db_Select('forum', '`forum_moderators`', "`forum_id` = '{$pr[0]}'")) {
			$moder = $sql->db_Fetch();
			return $moder[0];
		}
		else {
			return '250';
		}
	}
	else {
		return '250';
	}
}

$mod = get_moder(e_QUERY);

if(!check_class($mod)) {
	header('Location: /index.php');
	exit();
}

global $sql, $ns;

require_once(HEADERF);

function mv_upd_count($topic) {
	global $sql2;
	
	if(!is_object($sql2)) {
		$sql2 = new db;
	}
	
	$count = $sql2->db_Count('forum_t', '(*)', "WHERE `thread_parent` = '{$topic}'");
	$sql2->db_Select('forum_t', '`thread_user`, `thread_datestamp`', "`thread_parent` = '{$topic}' ORDER BY `thread_datestamp` DESC");
	list($id_user, $last_post) = $sql2->db_Fetch();
	
	return $sql2->db_Update(
		'forum_t',
		"`thread_lastpost` = ".(isset($last_post) ? "'{$last_post}'" : 'thread_datestamp').",
		`thread_lastuser` = ".(isset($id_user) ? "'{$id_user}'" : 'thread_user').",
		`thread_total_replies` = '{$count}'
		WHERE `thread_id` = '{$topic}'");
}

if(isset($_POST['url'])) {
	if(preg_match("#forum_viewtopic\.php\?([0-9]+)#", $_POST['url'], $match)) {
		if($sql->db_Select('forum_t', '`thread_forum_id`', "`thread_id` = '{$match[1]}'")) {
			list($new_forum_id) = $sql->db_Fetch();
			
			$sql->db_Select('forum_t', '`thread_parent`', "`thread_id` = '".e_QUERY."'");
			list($old_topic) = $sql->db_Fetch();
			
			if($sql->db_Update(
				'forum_t',
				"`thread_parent` = '{$match[1]}',
				`thread_forum_id` = '{$new_forum_id}',
				`thread_name` = '',
				`thread_views` = '0',
				`thread_edit_datestamp` = '0',
				`thread_lastuser` = '',
				`thread_total_replies` = '0'
				WHERE `thread_id` = '".e_QUERY."'"
			)) {

				$total_msg = $sql->db_Update('forum_t', "`thread_parent` = '{$match[1]}', `thread_forum_id` = '{$new_forum_id}' WHERE `thread_parent` = '".e_QUERY."'");
				$text = '<div class="forumheader"><a href="'.htmlspecialchars($_POST['url'], ENT_QUOTES).'">Перемещено! (Сообщений: '.intval($total_msg).')</a></div>';
				mv_upd_count($match[1]);

				if($old_topic) {
					mv_upd_count($old_topic);
				}
			}
			else {
				$text = '<div class="forumheader">Не удалось переместить!</div>';
			}
		}
		else {
			$text = 'Указанная Вами тема не найдена!';
		}
	}
	else {
		$text = '<div class="forumheader">Не верно указан URL</div>';
	}
}
else {

	$text = '<form method="POST" action="'.e_SELF.'?'.e_QUERY.'">
	<table width="100%">
		<tr>
			<td class="forumheader3">
				Введите URL темы:
			</td>
			<td class="forumheader3">
				<input type="text" value="" class="tbox" name="url" style="width: 99%;" />
			</td>
		</tr>
		<tr>
			<td class="forumheader3" colspan="2">
				<input type="submit" value="Переместить" class="button" />
			</td>
		</tr>
	</table>
	</form>';
}

$ns->tablerender('Перемещение', $text);

require_once(FOOTERF);