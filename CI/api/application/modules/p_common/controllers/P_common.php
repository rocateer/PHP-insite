<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P_common extends MY_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('p_common/model_p_common');
  }

}
?>
