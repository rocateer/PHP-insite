<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('no_contents')){

  function no_contents($str){

    $return_arr =  array(
      '0' => '조회된 내용이 없습니다.',
      '1' => '등록되었습니다',
  	);
		return $str = $return_arr[$str];
  }
}
