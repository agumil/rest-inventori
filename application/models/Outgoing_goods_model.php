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

    public function get_all_outgoinggoods()
    {
        $cols = [
            "{$this->table}.*",
            'brands.name AS brand_name',
            'brands.code AS brand_code',
            'measurements.name AS measurement_name',
            'measurements.unit AS measurement_unit',
            'measurements.is_mass AS measurement_is_mass',
            'colors.name AS color_name',
            'colors.code AS color_code',
        ];

        return $this->db->select($cols)
            ->from($this->table)
            ->join('brands', "brands.id = {$this->table}.brand_id")
            ->join('measurements', "measurements.id = {$this->table}.measurement_id")
            ->join('colors', "colors.id = {$this->table}.color_id")
            ->get()
            ->result();
    }
}
