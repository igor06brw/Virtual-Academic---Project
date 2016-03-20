<?php
$files_path =  realpath(dirname(__FILE__)) . '/Cron/*.php';
foreach (glob($files_path) as $filename) {
  require $filename;
}

Class Cronparser{
	
}