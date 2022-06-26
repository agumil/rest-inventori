<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_outgoing_goods extends CI_Migration
{
    private $options = [
        'ENGINE' => 'InnoDB',
    ];

    private $table = 'outgoing_goods';

    public function __construct()
    {
        parent::__construct();

        $this->load->dbforge();
    }

    public function up()
    {
        $fields = [
            'id' => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'brand_id' => [
                'type' => 'INT',
                'null' => true,
            ],
            'measurement_id' => [
                'type' => 'INT',
            ],
            'color_id' => [
                'type' => 'INT',
            ],
            'material' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'quantity' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'weight' => [
                'type' => 'FLOAT',
                'default' => 0,
            ],
            'date' => [
                'type' => 'DATETIME',
            ],
            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
            'deleted_at datetime default null',
        ];

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', true);
        $this->dbforge->add_key(['brand_id', 'measurement_id', 'color_id']);
        $this->dbforge->create_table($this->table, true, $this->options);
    }

    public function down()
    {
        if ($this->db->table_exists($this->table)) {
            $this->dbforge->drop_table($this->table);
        }
    }
}
