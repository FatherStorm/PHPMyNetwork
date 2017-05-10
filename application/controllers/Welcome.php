<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();

		/* Standard Libraries of codeigniter are required */
		$this->load->database();
		$this->load->helper('url', 'language');
		/* ------------------ */
        $this->load->library(array('ion_auth', 'form_validation','grocery_CRUD','simpleDB'));
        $this->load->model('network_rack_model');
        $this->network_rack = new Network_rack_model();


	}
	public function index()
	{

		$output = new stdClass();
        $output->js_files = array('/assets/network_rack/js/guest.js?'.rand(1,65536));
        $output->devices= $this->network_rack->get_devices(1);
	    $ports=$this->network_rack->get_ports(1);

		$output->ports = array();
		foreach ($ports as $row) {
			$output->ports[$row->device_id][$row->port][$row->side] = $row;
		}
		$output->data = $this->network_rack->get_patches(1);
		$output->title = "My Network Rack";
        $output->loggedIn=$this->ion_auth->logged_in();

		$this->load->view('visitor',$output);
	}
}
