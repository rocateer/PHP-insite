

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
    // $id = $this->get("id");
    // echo $id;

    $this->load->helper("url");
    // echo $this->uri->segment(1);
    if($this->uri->segment(1) == "api"){
      $version_path = $_SERVER['REQUEST_URI'];
      $url = str_replace("api/", "", $version_path);
      $uri = "http://api.life-planner.xyz".$url;
      // echo $uri;
      redirect($uri);
    }



	}
}
