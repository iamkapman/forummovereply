// <? 
if(!MODERATOR) return '';

global $sql, $post_info;

return '<a href="'.e_PLUGIN.'forum_mr/movereply.php?'.$post_info['thread_id'].'"><img src="'.e_PLUGIN.'forum_mr/admin_move_post.png" alt="Объединить темы / Переместить сообщение" title="Модератор: Объединить темы / Переместить сообщение" style="padding: 0px 5px;" /></a>';