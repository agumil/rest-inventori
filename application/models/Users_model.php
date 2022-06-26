<?php defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends MY_Model
{
    public $table = 'users';
    public $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function truncate()
    {
        $this->db->from($this->table)->truncate();
    }

    public function get_all_users()
    {
        return $this->db->select("{$this->table}.*, roles.name AS role_name")
            ->from($this->table)
            ->join('roles', "roles.id = {$this->table}.role_id")
            ->get()
            ->result();
    }
}
