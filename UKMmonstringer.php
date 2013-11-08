<?php  
/* 
Plugin Name: UKM Mønstringer
Plugin URI: http://www.ukm-norge.no
Description: Genererer liste over alle lokalmønstringer i fylket
Author: UKM Norge / M Mandal 
Version: 1.0 
Author URI: http://www.ukm-norge.no
*/

require_once('UKM/inc/twig-admin.inc.php');
require_once('UKM/sql.class.php');
require_once('UKM/monstring.class.php');

## HOOK MENU AND SCRIPTS
if(is_admin()) {
	global $blog_id;
	if(get_option('site_type') != 'kommune')
		add_action('admin_menu', 'UKMmonstringer_menu',100);		
}

function UKMmonstringer_menu() {
	$page = add_menu_page('Mønstringer', 'Mønstringer', 'editor', 'UKMmonstringer', 'UKMmonstringer', 'http://ico.ukm.no/mapmarker-bubble-blue-menu.png',126);
}

function UKMmonstringer() {
	require_once('monstringer.controller.php');
	echo TWIG('monstringer.twig.html', $infos , dirname(__FILE__));
}