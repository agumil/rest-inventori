<?php defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends MY_Model
{
    public $table = 'users';
    public $primary_key = 'id';

    public function __construct()
    {
        $this->soft_deletes = true;

        parent::__construct();
    }

    public function truncate()
    {
        $this->db->from($this->table)->truncate();
    }
}
