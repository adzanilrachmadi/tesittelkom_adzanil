<?php

class Home extends CI_Controller{


    function __construct()
    {
        parent ::__construct();
        $this->load->model("modelpost");
    }
    function index(){
        // $data["post"]= $this->modelpost->get;
        $this->load->view("post");
    }
}