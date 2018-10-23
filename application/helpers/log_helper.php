<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function action_log($msg=""){
 
    $CI = &get_instance();
    $CI->load->model('M_log');
    $CI->M_log->create_log($msg); 
}
