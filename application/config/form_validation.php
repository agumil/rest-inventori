<?php

$config = [
    'login_post' => [
        'email' => [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email',
        ],
        'password' => [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required',
        ],
    ],
    'user_post' => [
        'role_id' => [
            'field' => 'role_id',
            'label' => 'Role',
            'rules' => 'required',
        ],
        'firstname' => [
            'field' => 'firstname',
            'label' => 'First Name',
            'rules' => 'required',
        ],
        'lastname' => [
            'field' => 'lastname',
            'label' => 'Last Name',
        ],
        'email' => [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required',
        ],
        'password' => [
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required',
        ],
    ],
    'user_delete' => [
        'userid' => [
            'field' => 'userid',
            'label' => 'User ID',
            'rules' => 'required',
        ],
    ],
    'good_post' => [
        'brand_id' => [
            'field' => 'brand_id',
            'label' => 'Brand',
            'rules' => 'required',
        ],
        'measurement_id' => [
            'field' => 'measurement_id',
            'label' => 'Measurement',
            'rules' => 'required',
        ],
        'color_id' => [
            'field' => 'color_id',
            'label' => 'Color',
            'rules' => 'required',
        ],
        'name' => [
            'field' => 'name',
            'label' => 'Product Name',
            'rules' => 'required',
        ],
        'quantity' => [
            'field' => 'quantity',
            'label' => 'Quantity',
            'rules' => 'required',
        ],
    ],
    'good_delete' => [
        'good_id' => [
            'field' => 'good_id',
            'label' => 'Good Id',
            'rules' => 'required',
        ],
    ],
    'brand_post' => [
        'name' => [
            'field' => 'name',
            'label' => 'Brand Name',
            'rules' => 'required',
        ],
        'code' => [
            'field' => 'code',
            'label' => 'Brand Code',
            'rules' => 'required',
        ],
    ],
    'brand_delete' => [
        'brand_id' => [
            'field' => 'brand_id',
            'label' => 'Brand Id',
            'rules' => 'required',
        ],
    ],
    'color_post' => [
        'name' => [
            'field' => 'name',
            'label' => 'Color',
            'rules' => 'required',
        ],
        'code' => [
            'field' => 'code',
            'label' => 'Color Code',
            'rules' => 'required',
        ],
    ],
    'color_delete' => [
        'color_id' => [
            'field' => 'color_id',
            'label' => 'Color Id',
            'rules' => 'required',
        ],
    ],
    'material_post' => [
        'name' => [
            'field' => 'name',
            'label' => 'Material Name',
            'rules' => 'required',
        ],
    ],
    'material_delete' => [
        'material_id' => [
            'field' => 'material_id',
            'label' => 'Material Id',
            'rules' => 'required',
        ],
    ],
    'measurement_post' => [
        'name' => [
            'field' => 'name',
            'label' => 'Measurement Name',
            'rules' => 'required',
        ],
        'unit' => [
            'field' => 'unit',
            'label' => 'Measurement Unit',
            'rules' => 'required',
        ],
    ],
    'measurement_delete' => [
        'measurement_id' => [
            'field' => 'measurement_id',
            'label' => 'Measurement Id',
            'rules' => 'required',
        ],
    ],
    'incominggood_post' => [
        'brand_id' => [
            'field' => 'brand_id',
            'label' => 'Brand',
            'rules' => 'required',
        ],
        'measurement_id' => [
            'field' => 'measurement_id',
            'label' => 'Measurement',
            'rules' => 'required',
        ],
        'color_id' => [
            'field' => 'color_id',
            'label' => 'Color',
            'rules' => 'required',
        ],
        'name' => [
            'field' => 'name',
            'label' => 'Product Name',
            'rules' => 'required',
        ],
        'quantity' => [
            'field' => 'quantity',
            'label' => 'Quantity',
            'rules' => 'required',
        ],
        'date' => [
            'field' => 'date',
            'label' => 'Incoming Good Date',
            'rules' => 'required',
        ],
    ],
    'incominggood_delete' => [
        'incominggood_id' => [
            'field' => 'incominggood_id',
            'label' => 'Incoming Good Id',
            'rules' => 'required',
        ],
    ],
    'outgoinggood_post' => [
        'brand_id' => [
            'field' => 'brand_id',
            'label' => 'Brand',
            'rules' => 'required',
        ],
        'measurement_id' => [
            'field' => 'measurement_id',
            'label' => 'Measurement',
            'rules' => 'required',
        ],
        'color_id' => [
            'field' => 'color_id',
            'label' => 'Color',
            'rules' => 'required',
        ],
        'name' => [
            'field' => 'name',
            'label' => 'Product Name',
            'rules' => 'required',
        ],
        'quantity' => [
            'field' => 'quantity',
            'label' => 'Quantity',
            'rules' => 'required',
        ],
        'date' => [
            'field' => 'date',
            'label' => 'Incoming Good Date',
            'rules' => 'required',
        ],
    ],
    'outgoinggood_delete' => [
        'outgonegood_id' => [
            'field' => 'outgonegood_id',
            'label' => 'Incoming Good Id',
            'rules' => 'required',
        ],
    ],
];
