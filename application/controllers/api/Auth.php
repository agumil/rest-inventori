<?php defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Auth extends RestController
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('users_model');
    }

    public function login_post()
    {
        $data = [
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
        ];

        $this->form_validation->set_data($data);
        $is_valid = $this->form_validation->run('login_post');
        if (!$is_valid) {
            $data = [
                'status' => 'error',
                'message' => $this->form_validation->error_string(),
            ];
            $this->response($data, 400);
        }

        $user = $this->users_model->where('email', $data['email'])->get();
        if ($user === false) {
            $data = [
                'status' => 'error',
                'message' => 'Username or password incorrect.',
            ];
            $this->response($data, 400);
        }

        $is_verified = password_verify($data['password'], $user->password);
        if (!$is_verified) {
            $data = [
                'status' => 'error',
                'message' => 'Username or password incorrect.',
            ];
            $this->response($data, 400);
        }

        $user_data = [
            'userid' => $user->id,
            'roleid' => $user->role_id,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
        ];

        $this->response(['status' => 'success', 'user' => $user_data], 200);
    }
}
