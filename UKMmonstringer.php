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
		add_action('admin_menu', 'UKMmonstringer_menu',100);
		
		add_filter('UKMWPDASH_messages', 'UKMmonstringer_dash');
	}
}

function UKMmonstringer_menu() {
	$page = add_menu_page('Mønstringer', 'Mønstringer', 'editor', 'UKMmonstringer', 'UKMmonstringer', 'http://ico.ukm.no/mapmarker-bubble-blue-menu.png',127);
	add_action( 'admin_print_styles-' . $page, 'UKMMonstringer_script' );
}

function UKMmonstringer_dash( $MESSAGES ) {
	echo 'Hook to messages';
	$MESSAGES[] = array('level' 	=> 'alert-error',
						'header' 	=> 'Flere av dine lokalmønstringer er ikke registrert!',
						'body' 	=> 'Velg "mønstringer" i menyen til venstre for å se hvilke'
						);
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
