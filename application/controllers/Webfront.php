<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This Class used as Webfront management
 * @package   CodeIgniter
 * @category  Controller
 * @author    MobiwebTech Team
 */
class Webfront extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        redirect('pwfpanel');
         //$this->load->view('index.html');
    }

    public function test_mail()
    {
    	$to_email = $_GET['to_email'];
    	var_dump(send_mail('Hellooooo','Test Subject',$to_email));
    }

}

/* End of file Cron.php */
/* Location: ./application/controllers/Webfront.php */
?>
