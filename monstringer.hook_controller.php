<?php
$unregistered = 0;
$is_showtime = false;

if( ((int) date('Y') == (int) (get_option('season')-1)) && ((int) date('m') > 10 ) )
	$is_showtime = true;
	
if($is_showtime) {
	$monstring = new monstring( get_option('pl_id') );
	
	$monstringer = $monstring->hent_lokalmonstringer();
	$monstringer = array_unique( $monstringer );
	
	foreach( $monstringer as $plid ) {
		$pl = new monstring( $plid );
		if( !$pl->registered() && $pl->g('pl_name') != 'Gjester' )
			$unregistered++;
	}	
}