<?php

use ImageUpload\Images;

require APPPATH . '/controllers/Images.php';

class Auth extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("modeluser");
    }

    // open login page
    function login()
    {
        $this->load->view("login");
    }

    // submit login data
    function submit_login()
    {
        $username = $this->input->post("username");
        $password = $this->input->post("password");
        if ($username == null || $username == "" || $password == null || $password == "") {
            echo json_encode(getResponse(false, "Please fill username and password"));
            return;
        }
        if ($this->modeluser->login($username, $password)) {
            echo json_encode(getResponseWithRedirect(true, "Login success", base_url()));
        } else {
            echo json_encode(getResponse(false, "Username or password mismatch"));
        }
    }

    // open register page
    function register()
    {
        $this->load->view("register");
    }

    // submit register data
    function submit_register()
    {
        $submitted_data = $this->input->post();
        echo $submitted_data["foto"];
        return;
        $data = new DataUser();
        $data_field = $data->getFields();
        // echo json_encode($data_field);
        // return;
        $empty_field = array();
        foreach ($data_field as $f) { //check if all field is send by user
            if (!array_key_exists($f, $submitted_data)) { //any field is not exist on user input data
                $empty_field[] = $f;
            }
        }
        if (sizeof($empty_field) > 0) {
            echo json_encode(getResponseWithData(false, "please fill all field", $empty_field));
            return;
        }
        $image = $submitted_data["foto"];
        $submitted_data["foto"] = $submitted_data["username"] . ".jpg";
        $data->fromArray($submitted_data);
        $add_user_status = $this->modeluser->add_user($data);
        if ($add_user_status["success"]) {
            // uploading profil picture after successfully add user
            Images::save_image($image, "", $submitted_data["username"] . ".jpg");
            $add_user_status["redirect"] = base_url();
            echo json_encode($add_user_status);
        } else {
            echo json_encode($add_user_status);
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url("login"));
    }
}
