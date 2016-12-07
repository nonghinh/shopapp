<?php
//Hàm chuyển chuỗi thường về chuỗi không dấu.
function stripUnicode($str){
	if(!$str) return false;
	$unicode = [
		'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
		'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
		'd' => 'đ',
		'D' => 'Đ',
		'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
		'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
		'i' => 'í|ì|ỉ|ĩ|ị',
		'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
		'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
		'O' => 'Ó|Ò|Ỏ|Ó|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
		'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
		'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
		'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
		'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
	];

	foreach($unicode as $khongdau => $codau){

		$arr = explode("|", $codau);
		$str = str_replace($arr, $khongdau, $str);
	}

	return $str;
}

function getDateTime($time){
	
	$a = preg_split('/[\s,\/,-]+/', $time);
	$res = "$a[2]-$a[1]-$a[0] $a[3]:00";
	return $res;
}
 // function checkDateTime($date){
 // 	if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}\s(0[0-9]|1[0-9]|2[1-3]):(0[0-9]|[1-5][0-9])$/",$date))
 //    {
 //        return true;
 //    }

 //    return false;
 // }
 
function toSlug($str){

	$str = trim($str);
	if($str == "") return "";

	$str = str_replace('"', '', $str);
	$str = str_replace("'", '', $str);
	$str = stripUnicode($str);
	$str = mb_convert_case($str, MB_CASE_LOWER, 'utf-8');
	//
	$str = str_replace(' ', '-', $str);
	return $str.'-'.generateRandomString();
}
function titleSlug($str){

	$str = trim($str);
	if($str == "") return "";

	$str = str_replace('"', '', $str);
	$str = str_replace("'", '', $str);
	$str = stripUnicode($str);
	$str = mb_convert_case($str, MB_CASE_LOWER, 'utf-8');
	//
	$str = str_replace(' ', '-', $str);
	return $str;
}

function getParentCate($data, $parent=0, $str='--', $select=0){
	foreach($data as $val){
		$id = $val['id'];
		$name = $val['name'];
		if($val['parent_id'] == $parent){
			if($select!=0 && $id==$select){
				echo "<option value='$id' selected>$str $name</option>";
			}
			else
				echo "<option value='$id'><i class='fa fa-circle'></i>$str $name</option>";

			getParentCate($data, $id, $str.'|--', $select);
		}
	}
}

function generateRandomString($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function geocodeLocation($location){
	$address = $location; // Google HQ
    $prepAddr = str_replace(' ','+',$address);
    $geocode=file_get_contents("https://maps.google.com/maps/api/geocode/json?address={$prepAddr}");
    $output= json_decode($geocode);
    if($output->results){
	    $latitude = $output->results[0]->geometry->location->lat;
	    $longitude = $output->results[0]->geometry->location->lng;
	    $data = $latitude.','.$longitude;
	    return $data;
	}
	
	return null;
}

function formatTime($datetime){
	$new = date_create($datetime);

	return date_format($new,'d/m/Y H:i');
}
function changeTitle($str){

	$str = trim($str);
	if($str == "") return "";

	$str = str_replace('"', '', $str);
	$str = str_replace("'", '', $str);
	$str = stripUnicode($str);
	$str = mb_convert_case($str, MB_CASE_LOWER, 'utf-8');
	//
	$str = str_replace(' ', '-', $str);
	return $str;
}

function stripTime($time){
	return substr($time, 0, strlen($time) - 3);
}

function cateParent($data, $parent=0, $str='--', $select=0){
	foreach($data as $val){
		$id = $val['id'];
		$name = $val['name'];
		if($val['parent_id'] == $parent){
			if($select!=0 && $id==$select){
				echo "<option value='$id' selected>$str $name</option>";
			}
			else
				echo "<option value='$id'>$str $name</option>";

			cateParent($data, $id, $str.'|--', $select);
		}
	}
}

function curPageURL() {
	$pageURL = 'http';
	// if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

/*
=========================
* Tao cac tag tu key words
=========================
*/
