<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function template($title="", $sub_title="", $content, $nav=""){
    // Page detail
    $data["content"] = $content;
    $data["title"] = $title;
    $data["sub_title"] = $sub_title;
    $data["template_path"] = "/OTEC";

    // Navigator bar
    // $nav[0]["page"] = "Home";
    // $nav[0]["icon"] = "fa fa-dashboard";
    // $nav[0]["link"] = "#";
    // $nav[0]["active"] = "";
    $data["nav"] = $nav;
    
    $CI = &get_instance();
    $CI->load->view('template', $data);
}
