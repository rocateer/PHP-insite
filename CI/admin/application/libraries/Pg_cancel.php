<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2016-01-12
|------------------------------------------------------------------------
*/

Class Pg_function {
	//경고창

	function pg_cancel($pg_gate,$order_number, $pg_tid, $pay_price){

    $rt['pg_tid'] ="pg_1232323";
    $rt['pay_price'] =$pay_price;
    $rt['code'] ="OK";
		return $rt;
	}

}
?>
