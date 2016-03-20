<?php

function if_exists($array, $what, $val) {
    foreach ($array as $key => $item)
        if (isset($array[$key]->{$what}) && $array[$key]->{$what} == $val)
            return true;
    return false;
}

function assets_url($echo = 1){
	return base_url() . "assets/";
}


function paginate($total,$currentPage,$controllerURL){
ob_start();
$CI = &get_instance();
$onPage = $CI->config->item('barcoding_admin_page_limit');
$pages = intval($total/$onPage);
$prev = $currentPage-1;
$next = $currentPage+1;
$prevURL = ($prev == 0 ) ? 'javascript:;' : $controllerURL . $prev . "/";
$nextURL = ($next > $pages) ? 'javascript:;' : $controllerURL . $next . "/";
require_once(APPPATH . "views/back/metronic/common/pagination.php");
?>
<?php
return ob_get_clean();
}
function top_default_job($data){
extract($data);  ob_start();
require_once(APPPATH . "views/front/default/job/functions/job_header.php");
?>

<?php
 return ob_get_clean();
}

function lastet_jobs($data){
extract($data);  ob_start();
require_once(APPPATH . "views/front/default/job/functions/lastet_jobs.php");
?>

<?php
 return ob_get_clean();
}




function current_job($data){
extract($data);  ob_start();
require_once(APPPATH . "views/front/default/job/functions/current_job.php");
?>

<?php
 return ob_get_clean();
}