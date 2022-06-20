<?php defined('BASEPATH') or exit('No direct script access allowed');

class Roles_model extends MY_Model
{
    public $table = 'roles';
    public $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function truncate()
    {
        $this->db->from($this->table)->truncate();
    }
}
