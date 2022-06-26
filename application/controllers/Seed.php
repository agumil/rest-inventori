<?php defined('BASEPATH') or exit('No direct script access allowed');

class Seed extends CI_Controller
{
    private $roles = ['admin', 'staff'];
    private $materials = ['Denim', 'Satin', 'Cotton', 'Spandex', 'Viscose', 'Wool', 'Silk', 'Leather'];
    private $brands = [
        [
            'name' => 'Nike',
            'code' => 'nk',
        ],
        [
            'name' => 'H&M',
            'code' => 'hm',
        ],
        [
            'name' => 'Zara',
            'code' => 'zra',
        ],
        [
            'name' => 'Adidas',
            'code' => 'adds',
        ],
        [
            'name' => 'Uniqlo',
            'code' => 'uqlo',
        ],
        [
            'name' => 'Louis Vuitton',
            'code' => 'lovu',
        ],
        [
            'name' => 'Hermes',
            'code' => 'hrms',
        ],
        [
            'name' => 'Rolex',
            'code' => 'rlex',
        ],
        [
            'name' => 'Gucci',
            'code' => 'gcci',
        ],
        [
            'name' => 'Cartier',
            'code' => 'ctier',
        ],
    ];
    private $measurements = [
        [
            'name' => 'small',
            'unit' => 'S',
            'is_mass' => 0,
        ],
        [
            'name' => 'medium',
            'unit' => 'M',
            'is_mass' => 0,
        ],
        [
            'name' => 'Large',
            'unit' => 'L',
            'is_mass' => 0,
        ],
        [
            'name' => 'Extra Large',
            'unit' => 'XL',
            'is_mass' => 0,
        ],
    ];

    private $colors = [
        [
            'name' => 'red',
            'code' => 'rd',
        ],
        [
            'name' => 'black',
            'code' => 'blck',
        ],
        [
            'name' => 'red black',
            'code' => 'rdblck',
        ],
        [
            'name' => 'maroon',
            'code' => 'mroon',
        ],
        [
            'name' => 'navy',
            'code' => 'nvy',
        ],
    ];

    public function __construct()
    {
        parent::__construct();

        if (!$this->input->is_cli_request()) {
            show_404();
        }

        $this->load->model('roles_model');
        $this->load->model('users_model');
        $this->load->model('materials_model');
        $this->load->model('brands_model');
        $this->load->model('measurements_model');
        $this->load->model('colors_model');
        $this->load->model('goods_model');
        $this->load->model('skus_model');
        $this->load->model('incoming_goods_model');
        $this->load->model('outgoing_goods_model');
    }

    public function reset()
    {
        $this->roles_model->truncate();
        $this->users_model->truncate();
        $this->materials_model->truncate();
        $this->brands_model->truncate();
        $this->measurements_model->truncate();
        $this->colors_model->truncate();
        $this->goods_model->truncate();
        $this->skus_model->truncate();
    }

    public function run()
    {
        try {
            $this->seed_roles();
            $this->seed_users();
            $this->seed_materials();
            $this->seed_brands();
            $this->seed_measurements();
            $this->seed_colors();
            $this->seed_goods();
            $this->seed_skus();
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }

        echo 'Success! All tables has been seeded.' . PHP_EOL;
        return false;
    }

    private function seed_roles()
    {
        $data = [];
        foreach ($this->roles as $role) {
            $data[] = [
                'name' => $role,
            ];
        }

        $result = $this->roles_model->insert($data);
        if ($result === false) {
            throw new Exception("Error seeding roles");
        }
    }

    private function seed_users()
    {
        $num_of_users = 3;

        $faker = Faker\Factory::create();

        $data[] = [
            'role_id' => 1,
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'admin@testmail.dev',
            'password' => password_hash('admin', PASSWORD_BCRYPT),
        ];

        for ($i = 0; $i < $num_of_users; $i++) {
            $data[] = [
                'role_id' => random_int(1, count($this->roles)),
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'email' => $faker->email,
                'password' => password_hash($faker->password, PASSWORD_BCRYPT),
            ];
        }

        $result = $this->users_model->insert($data);
        if ($result === false) {
            throw new Exception("Error seeding users");
        }
    }

    private function seed_materials()
    {
        $data = [];
        foreach ($this->materials as $material) {
            $data[] = [
                'name' => $material,
            ];
        }

        $result = $this->materials_model->insert($data);
        if ($result === false) {
            throw new Exception("Error seeding materials");
        }
    }

    private function seed_brands()
    {
        $result = $this->brands_model->insert($this->brands);
        if ($result === false) {
            throw new Exception("Error seeding brands");
        }
    }

    private function seed_measurements()
    {
        $result = $this->measurements_model->insert($this->measurements);
        if ($result === false) {
            throw new Exception("Error seeding measurements");
        }
    }

    private function seed_colors()
    {
        $result = $this->colors_model->insert($this->colors);
        if ($result === false) {
            throw new Exception("Error seeding measurements");
        }
    }

    private function seed_goods()
    {
        $faker = Faker\Factory::create();
        $num_of_goods = 10;

        $data = [];
        for ($i = 0; $i < $num_of_goods; $i++) {
            $data[] = [
                'brand_id' => random_int(1, count($this->brands)),
                'measurement_id' => random_int(1, count($this->measurements)),
                'color_id' => random_int(1, count($this->colors)),
                'name' => ucwords($faker->words('2', true)),
                'quantity' => 1,
            ];
        }

        $result = $this->goods_model->insert($data);
        if ($result === false) {
            throw new Exception("Error seeding goods");
        }
    }

    private function seed_skus()
    {
        $faker = Faker\Factory::create();

        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $good = $this->goods_model->get_detail($i);

            $data[] = [
                'goods_id' => $i,
                'code' => "SKU-{$good->brand_code}-{$good->color_code}-{$good->measurement_unit}-" . $faker->randomNumber(8),
            ];
        }

        $result = $this->skus_model->insert($data);
        if ($result === false) {
            throw new Exception("Error seeding sku");
        }
    }
}
