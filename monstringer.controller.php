<?php

$monstring = new monstring( get_option('pl_id') );

$monstringer = $monstring->hent_lokalmonstringer();

$monstringer = array_unique( $monstringer );

$monstringer_data = array();

foreach( $monstringer as $plid ) {
	$pl = new monstring( $plid );

	$kontakt_arr = array();
	$kontakter = $pl->kontakter();
	foreach( $kontakter as $k ) {
		$kontakt_arr[] = array( 'name'	=> $k->g('name'),
							  'phone'	=> $k->g('tlf'),
							  'mail'	=> $k->g('email'),
							  'picture' => $k->g('picture')
							 );
	}

	$monstringer_data[] = array('name' 		=> $pl->g('pl_name'),
							  'link'		=> $pl->g('link'),
							  'registered' 	=> $pl->registered(),
							  'starter'		=> $pl->starter(),
							  'kommuner'	=> $pl->g('kommuner'),
							  'kontakter'	=> $kontakt_arr,
							  );
}
$INFOS['monstringer'] = $monstringer_data;
$INFOS['fylke']['name'] = $monstring->g('pl_name');