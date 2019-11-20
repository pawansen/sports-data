
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_setting extends Common_Controller {

    public $data = array();
    public $file_data = "";

    public function __construct() {
        parent::__construct();
        $this->is_auth_admin();
    }

    /**
     * @method index
     * @description listing display
     * @return array
     */
    public function index() {

        $this->data['parent'] = "vendorSettings";
        $this->data['title'] = "vendorSettings";
        $this->load->admin_render('add', $this->data, 'inner_script');
    }

    /**
     * @method add_modules
     * @description add dynamic rows
     * @return array
     */
    public function add_modules() {
    	
        $allModules = fantasy_modules();
        // $matchType = array('_t20', '_odi', '_test');
        foreach ($allModules as $key => $value) {
                    $option = array('table' => SETTING,
                        'where' => array('option_name' => $key, 'status' => 1),
                        'single' => true,
                    );
                    $is_value = $this->common_model->customGet($option);
                    
                    if (!empty($is_value)) {
                        $options = array('table' => SETTING,
                            'data' => array(
                                'option_value' => (isset($_POST[$key])) ? $_POST[$key] : "",
                            ),
                            'where' => array('option_name' => $key)
                        );
                        // pr($options);
                        $this->common_model->customUpdate($options);
                    } else {

                        $options = array('table' => SETTING,
                            'data' => array(
                                'option_value' => (isset($_POST[$key])) ? $_POST[$key] : "",
                                'option_name' => $key
                            )
                        );
                        // pr($options);
                        $this->common_model->customInsert($options);
                    }
        }

        $response = array('status' => 1, 'message' => lang('setting_success_message'), 'url' => "");
        echo json_encode($response);
    }
}
