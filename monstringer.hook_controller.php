<?php

$monstring = new monstring( get_option('pl_id') );

$monstringer = $monstring->hent_lokalmonstringer();
$monstringer = array_unique( $monstringer );

$unregistered = 0;
foreach( $monstringer as $plid ) {
	$pl = new monstring( $plid );
	if(!$pl->registered)
		$unregistered++;
}

$is_showtime = (int) date('Y') == (int) get_option('season');