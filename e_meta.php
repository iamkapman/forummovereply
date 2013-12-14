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

if (!defined('e107_INIT')) { exit; }

if(e_PAGE == 'forum_viewtopic.php') {
	
	$FORUMTHREADSTYLE = str_replace('{MODOPTIONS}', '<div style="float:right;">{FORUMMOVEREPLY}</div>{MODOPTIONS}', $FORUMTHREADSTYLE);
	$FORUMREPLYSTYLE = str_replace('{MODOPTIONS}', '<div style="float:right;">{FORUMMOVEREPLY}</div>{MODOPTIONS}', $FORUMREPLYSTYLE);
	
}
