<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Main extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        /* Standard Libraries of codeigniter are required */
        $this->load->database();
        $this->load->helper('url', 'language');
        /* ------------------ */
        $this->load->library(array('ion_auth', 'form_validation','grocery_CRUD','simpleDB'));

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->load->model('network_rack_model');
        $this->network_rack = new Network_rack_model();
    }

    public function index()
    {

        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
        {
            // redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        } else {
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            //list the users
            $this->data['users'] = $this->ion_auth->users()->result();
            foreach ($this->data['users'] as $k => $user) {
                $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
            }
            # $this->_render_page('auth/index', $this->data);
        }

        $this->data['devices']      = $this->network_rack->get_device_count($this->session->userdata('user_id'));
        $this->data['device_types'] = $this->network_rack->get_device_type_count($this->session->userdata('user_id'));
        $this->data['ports']        = $this->network_rack->get_patch_count($this->session->userdata('user_id'));




        $this->data['title']="Home";
        $this->load->view('home.php', $this->data);
    }

    public function maxPos(){
        die(json_encode($this->network_rack->get_next_position($this->session->userdata('user_id'))));
    }

    public function devices()
    {
        $crud = new grocery_CRUD();
        $crud->set_table('devices');
        $crud->set_relation('device_type', 'device_type', 'name');
        $crud->field_type('user_id', 'hidden', $this->session->userdata('user_id'));
        $crud->where('devices.user_id',$this->session->userdata('user_id'),true,true);
       $crud->unset_operations();

        $crud->unset_columns(array('user_id'));

        $output = $crud->render();

        $output->title = ucwords(str_replace("_", " ", __FUNCTION__));

        $this->load->view('edit_1.php', $output);
    }

    public function add_patch()
    {

        $errors = false;
        $params = array();
        if (!($this->input->get('device_1')) || $this->input->get('device_1') == 0) {
            $errors[] = "Device 1 was not selected";
        }
        if (!($this->input->get('device_2')) || $this->input->get('device_2') == 0) {
            $errors[] = "Device 2 was not selected";
        }
        if (!($this->input->get('port_1')) || $this->input->get('port_1') == 0) {
            $errors[] = "Port 1 was not selected";
        }
        if (!($this->input->get('port_2')) || $this->input->get('port_2') == 0) {
            $errors[] = "Port 2 was not selected";
        }
        if (!($this->input->get('side_1'))) {
            $errors[] = "Side 1 was not selected";
        }
        if (!($this->input->get('side_2'))) {
            $errors[] = "Side 2 was not selected";
        }

        if ($errors !== false && count($errors)) {
            echo json_encode(array('status' => false, 'error' => implode("<br/>", $errors)));
        } else {



            $ports=$this->network_rack->check_port_free( $this->input->get('device_1'), $this->input->get('port_1'), $this->input->get('side_1'), $this->input->get('device_2'), $this->input->get('port_2'), $this->input->get('side_2'),$this->session->userdata('user_id'));
            $message = "";
            if (!count($ports)) {
                $this->network_rack->assign_patch( $this->input->get('device_1'), $this->input->get('port_1'), $this->input->get('side_1'), $this->input->get('device_2'), $this->input->get('port_2'), $this->input->get('side_2'),$this->session->userdata('user_id'));

                $status = true;
            } else {
                $status = false;
                foreach ($ports as $port) {
                    $message .= sprintf("Something is already connected to %s  on the %s  at port # %d<br/>", $port->device_name, $port->side, $port->port);
                }
            }
            echo json_encode(array('status' => $status, 'existing' => $ports, 'message' => $message));
        }

    }

    public function reorder()
    {

        $this->network_rack->reorder($this->session->userdata('user_id'),$this->input->get('order'));
        echo json_encode($this->input->get('order'));

    }

    public function disassociate()
    {
        $devices = $this->input->get('device');
        $ports = $this->input->get('port');
        $side = $this->input->get('side');

        foreach ($devices as $idx => $id) {
            $this->network_rack->delete_patch($this->session->userdata('user_id'),$id,$ports[$idx],$side);
        }
        redirect('main/patches');
    }

    public function patches()
    {
        $output = new stdClass();
        $output->js_files = array('/assets/network_rack/js/patches.js?".rand(1,65536)');
        $output->devices = $this->network_rack->get_devices($this->session->userdata('user_id'));
        $availability = $this->network_rack->get_availability( $this->session->userdata('user_id'));


        foreach ($availability as $row) {
            $output->availability[$row->id] = $row;
        }

        $ports = $this->network_rack->get_user_ports($this->session->userdata('user_id'));

        $output->ports = array();
        foreach ($ports as $row) {
            $output->ports[$row->device_id][$row->port][$row->side] = $row;
        }


        $output->data =  $this->network_rack->get_patches($this->session->userdata('user_id'));
        $output->title = ucwords(str_replace("_", " ", __FUNCTION__));

        $this->load->view('patches.php', $output);
    }

    public function device_types()
    {
        $crud = new grocery_CRUD();


        $crud->set_table('device_type');
        $crud->set_relation('device_type', 'device_type', 'name');
        $crud->unset_columns(array('user_id'));
        $output = $crud->render();
        $output->title = ucwords(str_replace("_", " ", __FUNCTION__));
        $this->load->view('edit_1.php', $output);
    }

}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */
 
 