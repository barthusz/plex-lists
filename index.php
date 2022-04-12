<?php
include_once('plex/plex.php');

// Needed properties: IP Adress, Plex token & Plex ID (movies, series etc.)
$plex = new Plex('192.168.68.115','VgXdBYW3v_5K6KA-xYbs', 7);
echo $plex->getlist('Scandinavian');