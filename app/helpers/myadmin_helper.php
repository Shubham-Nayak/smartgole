<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!function_exists('adminassets_url')) {
    function adminassets_url($path = '') {
        $return_url = base_url('assets/backend/');
        if(strlen($path) > 0) {
            $return_url .= $path;
        }
        return $return_url;
    }
}
if(!function_exists('adminsbase_url')) {
    function adminsbase_url($path = '') {
        $return_url = base_url('administrator/');
        if(strlen($path) > 0) {
            $return_url .= $path;
        }
        return $return_url;
    }
}
function Emptycaptchafolder($dir) {
	$handle=opendir($dir);
	while (($file = readdir($handle))!==false) {
		@unlink($dir.'/'.$file);
	}
	closedir($handle);
}
if(!function_exists('flashmessage')) {
    function flashmessage( $message, $type = 'danger' ) {
        $return_url = '<div class="alert alert-'.$type.' alert-dismissible" role="alert" auto-close="10000"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$message.'</div>';
        return $return_url;
    }
}
function isactivemenu( $method = array(),$sublink = NULL ) {
	$CI =& get_instance();
	$currentmethod = $CI->router->fetch_method();
	if ( in_array($currentmethod, $method) ) {
		if( $sublink ) {
			return 'menu-active';
		} else {
			return 'sub-group-active';
		}
	} else {
		return '';
	}
}










