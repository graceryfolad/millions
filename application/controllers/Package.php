<?php

/*
 * Generated by CRUDigniter v3.0 Beta 
 * www.crudigniter.com
 */

class Package extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Package_model');
        $this->load->model('Pack_commission_model');
        $this->load->model('Service_model');
    }

    /*
     * Listing of packages
     */

    function index() {
        $data['packages'] = $this->Package_model->get_all_packages();

        $data['_view'] = 'package/index';
        $this->load->view('layouts/main', $data);
    }

    /*
     * Adding a new package
     */

    function add() {
        if (isset($_POST) && count($_POST) > 0) {
            $params = array(
                'pack_name' => $this->input->post('pkname'),
            );

            $package_id = $this->Package_model->add_package($params);
            $allservices = $this->Service_model->get_all_services();
            foreach ($allservices as $serv) {
                $comm[] = array(
                    'pack_id' => $package_id,
                    'ser_code' => $serv['ser_code'],
                    'is_percent' => 1,
                    'comm_per' => 0,
                    'fixedaoumt' => 0,
                );
            }

            $this->Pack_commission_model->add_pack_commission_batch($comm);

            redirect('Admin/Packages');
        } else {
            redirect('Admin/Packages');
        }
    }

    /*
     * Editing a package
     */

    function edit($pack_id) {
        // check if the package exists before trying to edit it
        $data['package'] = $this->Package_model->get_package($pack_id);

        if (isset($data['package']['pack_id'])) {
            if (isset($_POST) && count($_POST) > 0) {
                $params = array(
                    'pack_name' => $this->input->post('pack_name'),
                );

                $this->Package_model->update_package($pack_id, $params);
                redirect('package/index');
            } else {
                $data['_view'] = 'package/edit';
                $this->load->view('layouts/main', $data);
            }
        } else
            show_error('The package you are trying to edit does not exist.');
    }

    /*
     * Deleting package
     */

    function remove($pack_id) {
        $package = $this->Package_model->get_package($pack_id);

        // check if the package exists before trying to delete it
        if (isset($package['pack_id'])) {
            $this->Package_model->delete_package($pack_id);
            redirect('package/index');
        } else
            show_error('The package you are trying to delete does not exist.');
    }

}
