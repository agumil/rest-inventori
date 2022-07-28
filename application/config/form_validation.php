<?php

$config = [
    'login_post' => [
        'email' => [
            'field' => 'email',
            'label' => 'email',
            'rules' => 'required|valid_email',
        ],
        'password' => [
            'field' => 'password',
            'label' => 'password',
            'rules' => 'required',
        ],
    ],
    'user_post' => [
        'role_id' => [
            'field' => 'role_id',
            'label' => 'role_id',
            'rules' => 'required',
        ],
        'firstname' => [
            'field' => 'firstname',
            'label' => 'firstname',
            'rules' => 'required',
        ],
        'lastname' => [
            'field' => 'lastname',
            'label' => 'lastname',
        ],
        'email' => [
            'field' => 'email',
            'label' => 'email',
            'rules' => 'required',
        ],
        'password' => [
            'field' => 'password',
            'label' => 'password',
            'rules' => 'required',
        ],
    ],
    'user_delete' => [
        'userid' => [
            'field' => 'userid',
            'label' => 'userid',
            'rules' => 'required',
        ],
    ],
    'good_post' => [
        'brand_id' => [
            'field' => 'brand_id',
            'label' => 'brand_id',
            'rules' => 'required',
        ],
        'measurement_id' => [
            'field' => 'measurement_id',
            'label' => 'measurement_id',
            'rules' => 'required',
        ],
        'color_id' => [
            'field' => 'color_id',
            'label' => 'color_id',
            'rules' => 'required',
        ],
        'name' => [
            'field' => 'name',
            'label' => 'name',
            'rules' => 'required',
        ],
        'quantity' => [
            'field' => 'quantity',
            'label' => 'quantity',
            'rules' => 'required',
        ],
    ],
    'good_delete' => [
        'good_id' => [
            'field' => 'good_id',
            'label' => 'good_id',
            'rules' => 'required',
        ],
    ],
    'brand_post' => [
        'name' => [
            'field' => 'name',
            'label' => 'name',
            'rules' => 'required',
        ],
        'code' => [
            'field' => 'code',
            'label' => 'code',
            'rules' => 'required',
        ],
    ],
    'brand_delete' => [
        'brand_id' => [
            'field' => 'brand_id',
            'label' => 'brand_id',
            'rules' => 'required',
        ],
    ],
    'color_post' => [
        'name' => [
            'field' => 'name',
            'label' => 'name',
            'rules' => 'required',
        ],
        'code' => [
            'field' => 'code',
            'label' => 'code',
            'rules' => 'required',
        ],
    ],
    'color_delete' => [
        'color_id' => [
            'field' => 'color_id',
            'label' => 'color_id',
            'rules' => 'required',
        ],
    ],
    'material_post' => [
        'name' => [
            'field' => 'name',
            'label' => 'name',
            'rules' => 'required',
        ],
    ],
    'material_delete' => [
        'material_id' => [
            'field' => 'material_id',
            'label' => 'material_id',
            'rules' => 'required',
        ],
    ],
    'measurement_post' => [
        'name' => [
            'field' => 'name',
            'label' => 'name',
            'rules' => 'required',
        ],
        'unit' => [
            'field' => 'unit',
            'label' => 'unit',
            'rules' => 'required',
        ],
    ],
    'measurement_delete' => [
        'measurement_id' => [
            'field' => 'measurement_id',
            'label' => 'measurement_id',
            'rules' => 'required',
        ],
    ],
    'incominggood_post' => [
        'brand_id' => [
            'field' => 'brand_id',
            'label' => 'brand_id',
            'rules' => 'required',
        ],
        'measurement_id' => [
            'field' => 'measurement_id',
            'label' => 'measurement_id',
            'rules' => 'required',
        ],
        'color_id' => [
            'field' => 'color_id',
            'label' => 'color_id',
            'rules' => 'required',
        ],
        'name' => [
            'field' => 'name',
            'label' => 'name',
            'rules' => 'required',
        ],
        'quantity' => [
            'field' => 'quantity',
            'label' => 'quantity',
            'rules' => 'required',
        ],
        'date' => [
            'field' => 'date',
            'label' => 'date',
            'rules' => 'required',
        ],
    ],
    'incominggood_delete' => [
        'incominggood_id' => [
            'field' => 'incominggood_id',
            'label' => 'incominggood_id',
            'rules' => 'required',
        ],
    ],
    'outgoinggood_post' => [
        'brand_id' => [
            'field' => 'brand_id',
            'label' => 'brand_id',
            'rules' => 'required',
        ],
        'measurement_id' => [
            'field' => 'measurement_id',
            'label' => 'measurement_id',
            'rules' => 'required',
        ],
        'color_id' => [
            'field' => 'color_id',
            'label' => 'color_id',
            'rules' => 'required',
        ],
        'name' => [
            'field' => 'name',
            'label' => 'name',
            'rules' => 'required',
        ],
        'quantity' => [
            'field' => 'quantity',
            'label' => 'quantity',
            'rules' => 'required',
        ],
        'date' => [
            'field' => 'date',
            'label' => 'date',
            'rules' => 'required',
        ],
    ],
];
