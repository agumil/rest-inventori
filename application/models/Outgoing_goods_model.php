<?php defined('BASEPATH') or exit('No direct script access allowed');

class Outgoing_goods_model extends MY_Model
{
    public $table = 'outgoing_goods';
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
