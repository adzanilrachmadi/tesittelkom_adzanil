<?php

class ModelUser extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    function add_user(DataUser $user): array
    {
        // check if username exist
        if ($this->get_user_by_username($user->username) == null) {
            // add validation
            if ($user->validateValue(["id"])) {
                $this->db->insert("user", $user->toArray());
                if ($this->db->affected_rows() > 0) { //return if data successfully inserted
                    return getResponse(true, "Add user success");
                } else {
                    return getResponse(false, "Add user failed");
                }
            }else{
                return getResponse(false, "Data invalid");
            }
        }
        return getResponse(false, "Username already taken");
    }

    function update_user(DataUser $user): bool
    {
        $this->db->where("username", $user->username);
        $this->db->update("user", $user->toArray());
        return $this->db->affected_rows() > 0;
    }

    function get_user_by_username(string $username, bool $return_object = true)
    {
        $this->db->where("MD5(username)", md5($username)); //select username case sensitive
        $data = $this->db->get("user")->result_array();
        if (sizeof($data) > 0) {
            if ($return_object) {
                $user = new DataUser();
                $user->fromArray($data[0]);
                $user->unset("password"); //always unset password
                return $user;
            }
            $data[0]["password"] = null;
            return $data[0];
        }
        return null;
    }

    function get_all_user(bool $return_object = true): array
    {
        $data = $this->db->get("user")->result_array();
        $users = array();
        foreach ($data as $d) {
            if ($return_object) {
                $user = new DataUser();
                $user->fromArray($data[0]);
                $user->unset("password"); //always unset password
                $users[] = $user;
            } else {
                $d["password"] = null;
                $users[] = $d;
            }
            return $users;
        }
        return [];
    }

    function login(string $username, string $password): bool
    {
        $this->db->where("password", DataUser::hash_password($password));
        $data = $this->get_user_by_username($username, false);
        if ($data != null) {
            $this->session->set_userdata("user", $data);
            return true;
        }
        return false;
    }
}

class DataUser extends Data
{
    public ?int $id = null;
    public string $username = "";
    public string $nama = "";
    public ?string $password = "";
    public string $email = "";
    public bool $gender = false;
    public string $foto = "";

    function init(string $username, string $nama, string $password, string $email, bool $gender, string $foto)
    {
        $this->username = $username;
        $this->nama = $nama;
        $this->password = DataUser::hash_password($password);
        $this->email = $email;
        $this->gender = $gender;
        $this->foto = $foto;
    }

    static function hash_password(string $password)
    {
        $algo = hash_algos()[5]; //using sha256
        return hash($algo, $password);
    }

    // override parent to hash password
    function fromArray(array $data, bool $checkKey = true)
    {
        parent::fromArray($data, $checkKey);
        $this->password = DataUser::hash_password($this->password);
    }
}
