<?php defined('BASEPATH') or exit('No direct script access allowed');

class Colors_model extends MY_Model
{
    public $table = 'colors';
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
