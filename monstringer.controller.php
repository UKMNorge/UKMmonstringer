<?php

$monstring = new monstring( get_option('pl_id') );

$monstringer = $monstring->hent_lokalmonstringer();

$monstringer = array_unique( $monstringer );

$monstringer_data = array();

foreach( $monstringer as $plid ) {
	$pl = new monstring( $plid );
	$monstringer_data[] = array('name' 		=> $pl->g('pl_name'),
							  'url'			=> $pl->g('url'),
							  'registered' 	=> $pl->registered(),
							  'starter'		=> $pl->g('pl_start'),
							  );
}

$INFOS['monstringer'] = $monstringer_data;
$INFOS['fylke']['name'] = $monstring->g('pl_name');