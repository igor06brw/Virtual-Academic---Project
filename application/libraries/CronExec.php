<?php
echo 'test'; 
require_once '/var/www/vhosts/barcoding.local/httpdocs/beta/index.php'; // adjust path accordingly
$CI =& get_instance();
echo $CI->config->item('base_url'); 