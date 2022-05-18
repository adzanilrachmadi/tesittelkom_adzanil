<?php

class ModelPost extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        // date_timezone_set()
        date_default_timezone_set("Asia/Jakarta");
    }

    function add_post(Post $data): array
    {
        if ($data->validateValue(["id"])) {
            $this->db->insert("post", $data->toArray());
            if ($this->db->affected_rows() > 0) {
                return getResponseWithData(true, "Add post success", array("id_post" => $this->db->insert_id()));
            }
        }
        return getResponse(false, "Add post failed"); //either value invalid or insert fail
    }

    function get_post_by_id(int $id, bool $return_object = true)
    {
        $this->db->where("post.id", $id);
        $data = $this->_get_post($return_object);
        if (sizeof($data) > 0) {
            return $data[0];
        }
        return null;
    }

    function get_posts(int $page = 0, int $after = 0, bool $return_object = true)
    {
        $post_per_page = 20;
        $this->db->where("post.id > $after");
        $this->db->order_by("tanggal", "DESC");
        $this->db->limit($post_per_page, $page * $post_per_page);
        return $this->_get_post($return_object);
    }

    private function _get_post(bool $return_object = true): array
    {
        $this->db->select("post.*, user.username");
        $this->db->join('user', 'user.id = post.id_user', 'left');
        $data = $this->db->get("post")->result_array();
        $data_return = array();
        foreach ($data as $d) {
            if ($return_object) {
                $p = new Post();
                $p->fromArray($d);
                $p->set_comment($this->get_comments($p->id));
                $p->set_likes($this->get_likes($p->id));
                $p->set("i_like", $this->get_likes($p->id), false);
                $data_return[] = $p;
            } else {
                $d["comments"] = $this->get_comments($d["id"]);
                $d["likes"] = $this->get_likes($d["id"]);
                $d["i_like"] = $this->am_i_like($d["id"]);
                $data_return[] = $d;
            }
        }
        return $data_return;
    }

    function add_comment(Comment $data): array
    {
        if ($data->validateValue(["id"])) {
            $this->db->insert("comment", $data->toArray());
            // $id = $this->db->insert_id;
            if ($this->db->affected_rows() > 0) {
                return getResponseWithData(true, "Add comment success", array("comment" => $this->get_comment($this->db->insert_id())));
            }
        } else {
            return getResponse(false, "Add comment failed"); //either value invalid or insert fail
        }
    }

    function get_comment(int $id_comment)
    {
        $this->db->select("comment.*, user.username");
        $this->db->join('user', 'user.id = comment.id_user', 'left');
        $this->db->where("comment.id", $id_comment);
        $data = $this->db->get("comment")->result_array();
        return $data[0];
    }

    function get_comments(int $id_post, int $page = 0): array
    {
        $this->db->select("comment.*, user.username");
        $this->db->join('user', 'user.id = comment.id_user', 'left');
        $this->db->where("id_post", $id_post);
        $post_per_page = 5;
        $this->db->order_by("tanggal", "ASC"); //oldest first
        $this->db->limit($post_per_page, $page * $post_per_page);
        $data = $this->db->get("comment")->result_array();
        return $data;
    }

    function count_like(int $id_post): int
    {

        $this->db->where(array("id_post" => $id_post));
        $this->db->from('likes');
        return $this->db->count_all_results();
    }

    function toggle_like(int $id_post): array
    {
        //check if current user already like post
        $this->db->where(array("id_post" => $id_post, "id_user" => $this->session->userdata("user")["id"]));
        if ($this->db->get("likes")->num_rows() > 0) { // user already like post            
            $this->db->where(array("id_post" => $id_post, "id_user" => $this->session->userdata("user")["id"]));
            $this->db->delete("likes"); //dislike
            return getResponseWithData(true, "Dislike success", array("like" => false, "like_count" => $this->count_like($id_post)));
        } else {
            $this->db->insert("likes", array("id_post" => $id_post, "id_user" => $this->session->userdata("user")["id"])); //like
            return getResponseWithData(true, "Like success", array("like" => true, "like_count" => $this->count_like($id_post)));
        }
    }

    function get_likes(int $id_post): array
    {
        return $this->db->query("SELECT likes.*, user.username FROM (SELECT * from likes WHERE id_post = $id_post) AS likes 
        LEFT JOIN user ON user.id = likes.id_user;")->result_array();
    }

    private function am_i_like(int $id_post): bool
    {
        if (isLoggedIn()) {
            $this->db->where(array("id_post" => $id_post, "id_user" => $this->session->userdata("user")["id"]));
            $this->db->from('likes');
            return $this->db->count_all_results() > 0;
        }
        return false;
    }
}

class Post extends Data
{
    public ?int $id = null;
    public int $id_user = 0;
    public string $foto = "";
    public string $caption = "";
    public string $tanggal = "";

    function __construct()
    {
        // auto generate date 
        // this value will be suppressed when calling init or fromArray
        $this->tanggal = date("Y-m-d H:i:s");
    }

    function init(int $id_user, string $foto, string $caption)
    {
        $this->id_user = $id_user;
        $this->foto = $foto;
        $this->caption = $caption;
    }

    function set_likes(array $data_likes)
    {
        $this->set("likes", $data_likes, false);
    }

    function set_comment(array $data_comment)
    {
        $this->set("comments", $data_comment, false);
    }
}


class Comment extends Data
{
    public ?int $id = null;
    public int $id_user = 0;
    public int $id_post = 0;
    public string $comment = "";
    public string $tanggal = "";

    function __construct()
    {
        // auto generate date 
        // this value will be suppressed when calling init or fromArray
        $this->tanggal = date("Y-m-d H:i:s");
    }

    function init(int $id_user, int $id_post, string $comment)
    {
        $this->id_user = $id_user;
        $this->id_post = $id_post;
        $this->comment = $comment;
    }
}
