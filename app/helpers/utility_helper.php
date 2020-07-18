<?php
//  ignore this file , this file is only for apis and frontend helper
if( !function_exists('get_page_url') ) {
	function get_page_url( $page_slug  = NULL) {
		if( !empty($page_slug) ) {
			$base_url = base_url($page_slug);
		} else {
			$base_url = base_url();
		}
		return $base_url;
	}
}
if( !function_exists('get_image_url') ) {
	function get_image_url( $image_url  = NULL) {
			$base_url = $image_url;
		return $base_url;
	}
}
if( !function_exists('is_home') ) {
	function is_home( ) {
		$is_home = false;
		$CI =& get_instance();
		if( $CI->router->fetch_class() == 'welcome' && $CI->router->fetch_method() == 'index' ) {
			$is_home = true;
		}
		return $is_home;
	}
}
if( !function_exists('ConvertintoString') ) {
	function ConvertintoString( $string ){
		if( is_null($string) || $string =='' ) {
			return "";
		} else {
			return $string;
		}
	}
}
if( !function_exists('allowedtypes') ) {
	function allowedtypes( $type ){
		$allowedArray = array('activity','gole');
		if( in_array($type, $allowedArray) ) {
			return $type;
		} else {
			return 'banners';
		}
	}
}
if (!function_exists('page_url_link')) {
    function page_url_link( $title ){
        if ( !empty($title) ) {
            $catname  = url_title($title, "dash", TRUE);
            return base_url($title);
        } else {
            return base_url();
        }
    }
}
defined('BASEPATH') OR exit('No direct script access allowed');
if(!function_exists('assets_url')) {
    function assets_url($path = '') {
        $return_url = base_url('assets/');
        if(strlen($path) > 0) {
            $return_url .= $path;
        }
        return $return_url;
    }
} 	
if (!function_exists('CALL_WEBMETHOD_GET')) {
	function CALL_WEBMETHOD_GET( $method ,$data=array() ) {
        $base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
        $base_url .= "://".$_SERVER['HTTP_HOST'];
        $base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
		$result = array();
		$params = '';
		if( !empty($data)) {
			foreach($data as $key=>$value)
					$params .= $key.'='.$value.'&';
			$params = trim($params, '&');
			$url = $base_url.'api/'.$method.'?'.$params;
			// used print_r($url) to display api link in home page
			// print_r($url);
	
		} else {
			$url = $base_url.'api/'.$method;
		}
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url );
		curl_setopt($ch, CURLOPT_USERPWD, APIUser.":".APIPASS);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			''.APIKEYNAME.': '.APIKEYs
		));
		$result = curl_exec($ch);
		curl_close ($ch);
		$output = json_decode($result);
		return $output;
	}
}
if (!function_exists('CALL_WEBMETHOD_POST')) {
	function CALL_WEBMETHOD_POST( $method , $apitype, $_param  ) {
		
		if( !empty($_param) ){
			$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
			$base_url .= "://".$_SERVER['HTTP_HOST'];
			$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
			$result = array();
			$_url = $base_url.$apitype.'/'.$method;
			
			$str = json_encode($_param);
			$ch =curl_init();
			curl_setopt($ch,CURLOPT_URL,$_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER,FALSE);
			curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
			curl_setopt($ch, CURLOPT_POST,TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$_param);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			  "Content-Type: multipart/form-data"
			));
			$buffer = curl_exec($ch);
			$err = curl_error($ch);
			curl_close($ch);
			if ($err) {
				echo array(
					'status' =>false,
					'message' => "cURL Error #:" . $err,
					'data' =>""
				);
			} else {
				return $buffer;
			}
		} else {
			echo array(
				'status' =>false,
				'message' =>"Parameters are insufficient",
				'data' =>"",
			);
		}
	}
}
?>