<?php

defined('BASEPATH') OR exit('No direct script access allowed');

	if ( ! function_exists('mapping'))
	{
	    function mapping($str = '')
	    {
				$return_msg_arr =  array(
				 'notice' => 'notice_1_0_0',
			 );

				return $return_msg = $return_msg_arr[$str];
	    }
	}
