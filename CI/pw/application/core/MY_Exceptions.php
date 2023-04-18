<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions {

    /**
     * 404 Page Not Found Handler
     *
     * @access  private
     * @param   string
     * @return  string
     */
    function show_404($page = '', $log_error = TRUE)
    {
        $heading = "404 Page Not Found";
        $message = "The page you requested was not found.";

        // By default we log this, but allow a dev to skip it
        if ($log_error)
        {
            // Custom code here, maybe logging some $_SERVER variables
            // $_SERVER['HTTP_REFERER'] or $_SERVER['REMOTE_ADDR'] perhaps
            // Just add whatever you want to the log message

            log_message('error', '404 Page Not Found ...--> '.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."  ^ address=>".$_SERVER['REMOTE_ADDR']." ^ agent=>".$_SERVER['HTTP_USER_AGENT']);
        }


        echo $this->show_error($heading, $message, 'error_404', 404);
        exit;
    }
}
