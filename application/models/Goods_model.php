<?php defined('BASEPATH') or exit('No direct script access allowed');

class Goods_model extends MY_Model
{
    public $table = 'goods';
    public $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function truncate()
    {
        $this->db->from($this->table)->truncate();
    }

    public function get_detail(string $good_id)
    {
        return $this->db
            ->select(
                "{$this->table}.name as good_name,
                 {$this->table}.material,
                 {$this->table}.quantity,
                 {$this->table}.weight,
                 brands.name as brand_name,
                 brands.code as brand_code,
                 measurements.name as measurement_name,
                 measurements.unit as measurement_unit,
                 colors.name as color_name,
                 colors.code as color_code,
                ")
            ->from($this->table)
            ->join('brands', "brands.id = {$this->table}.brand_id")
            ->join('measurements', "measurements.id = {$this->table}.measurement_id")
            ->join('colors', "colors.id = {$this->table}.color_id")
            ->where("{$this->table}.id", $good_id)
            ->get()
            ->row();
    }
}
