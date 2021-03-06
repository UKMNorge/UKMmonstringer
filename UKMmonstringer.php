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
	if(get_option('site_type') == 'fylke') {
		add_action('UKM_admin_menu', 'UKMmonstringer_menu',100);
		
		add_filter('UKMWPDASH_messages', 'UKMmonstringer_dash');
	}
}

function UKMmonstringer_menu() {
	UKM_add_menu_page('resources','Lokal-mønstringer', 'Lokal-mønstringer', 'editor', 'UKMmonstringer', 'UKMmonstringer', '//ico.ukm.no/mapmarker-bubble-blue-menu.png',20);
	UKM_add_scripts_and_styles('UKMmonstringer', 'UKMMonstringer_script' );
}

function UKMmonstringer_dash( $MESSAGES ) {
	if( get_option('site_type') != 'fylke' )
		return $MESSAGES;

	require_once('monstringer.hook_controller.php');
	if($unregistered > 0)
		$MESSAGES[] = array('level' 	=> 'alert-error',
							'header' 	=> $unregistered . ' av dine lokalmønstringer er ikke registrert!',
							'body' 	=> 'Velg "lokalmønstringer" i menyen til venstre for å se hvilke'
							);
	elseif($is_showtime) {
		$MESSAGES[] = array('level' 	=> 'alert-success',
							'header' 	=> 'Alle dine lokalmønstringer registrert!',
							'body' 	=> 'Det liker vi!'
							);
	}
	return $MESSAGES;
}

function UKMmonstringer() {
	$INFOS = array();
	require_once('monstringer.controller.php');
	echo TWIG('monstringer.twig.html', $INFOS , dirname(__FILE__));
}

## INCLUDE SCRIPTS
function UKMMonstringer_script() {
	wp_enqueue_script('bootstrap_js');
	wp_enqueue_style('bootstrap_css');
	
	wp_enqueue_style( 'UKMMonstringer_style', plugin_dir_url( __FILE__ ) .'UKMmonstringer.css');
	wp_enqueue_script( 'UKMMonstringer_script', plugin_dir_url( __FILE__ ) .'UKMmonstringer.js');

}
