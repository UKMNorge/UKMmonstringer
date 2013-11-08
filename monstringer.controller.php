<?php

$monstring = new monstring( get_option('pl_id') );

$monstringer = $monstring->hent_lokalmonstringer();

var_dump($monstringer);