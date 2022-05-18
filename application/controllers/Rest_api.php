<?php

use chriskacerguis\RestServer\RestController;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/RestController.php';
require APPPATH . '/libraries/Format.php';

// load image class
use ImageUpload\Images;

require APPPATH . '/controllers/Images.php';

class Rest_api extends RestController
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("modelpost"); //loading model also loading Post and Comment class
    }

    private function checkLogin(): bool
    {
        if (!isLoggedIn()) {
            $this->response(getResponseWithRedirect(false, "Please login", base_url("login"), 401));
            return false;
        }
        return true;
    }

    function get_post_get()
    {
        $data = $this->get();
        $post_data = array();
        if (isset($data["id_post"]) && is_numeric($data["id_post"])) {
            $id_post = (int) $data["id_post"];
            $post_data = $this->modelpost->get_post_by_id($id_post, false);
        } else {
            $page = 0;
            if (isset($data["page"]) && is_numeric($data["page"])) {
                $page = (int)$data["page"] - 1;
            }
            if ($page < 0) {
                $page = 0;
            }
            $post_data = $this->modelpost->get_posts($page, false);
        }
        $this->response(getResponseWithData(true, "Get post success", array("post" => $post_data)));
    }

    function add_post_post()
    {
        $data = $this->post();
        if ($this->checkLogin()) {
            $data["id_user"] =  $this->session->userdata("user")["id"];
            // uploading image
            if (isset($data["foto"]) && $data["foto"] != null && $data["foto"] != "") {
                $image = $data["foto"];
                $upload_result = Images::save_image($image);
                if ($upload_result["success"]) {
                    // if success uploading foto then save post data
                    $data["foto"] = $upload_result["data"]["filename"];
                    $newPost = new Post();
                    $newPost->fromArray($data);
                    $this->response($this->modelpost->add_post($newPost));
                } else {
                    $this->response($upload_result); // send why upload failed
                }
            } else {
                $this->response(getResponse(false, "please upload foto"));
            }
        }
    }

    function add_comment_post()
    {
        $data = $this->post();
        if ($this->checkLogin()) {
            $data["id_user"] =  $this->session->userdata("user")["id"];
            $newComment = new Comment();
            $newComment->fromArray($data);
            $this->response($this->modelpost->add_comment($newComment));
        }
    }

    function add_like_post()
    {
        $id_post = $this->post("id_post");
        if ($this->checkLogin()) {
            $data["id_user"] =  $this->session->userdata("user")["id"];
            $this->response($this->modelpost->toggle_like($id_post));
        }
    }

    function update_post_post()
    {
    }
}
