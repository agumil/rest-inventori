<?php defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class User extends RestController
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('users_model');
    }

    public function user_get(?string $userid = null)
    {
        if (empty($userid)) {
            $result = $this->users_model->get_all();
            $data = [
                'status' => 'success',
                'users' => $result !== false ? $result : [],
            ];
        }

        if (!empty($userid)) {
            $result = $this->users_model->get($userid);
            $data = [
                'status' => 'success',
                'user' => $result !== false ? $result : [],
            ];
        }

        $this->response($data, 200);
    }

    public function user_post()
    {
        $input = $this->input->post();

        $data = [
            'role_id' => $input['role_id'],
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'email' => $input['email'],
            'password' => password_hash($input['password'], PASSWORD_BCRYPT),
        ];

        $is_inserted = $this->users_model->insert($data);
        if ($is_inserted === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }

    public function user_put(?string $userid = null)
    {
        if (empty($userid)) {
            $this->response(['message' => 'error'], 400);
        }

        $input = $this->input->post();

        $data = [
            'role_id' => !empty($input['role_id']) ? $input['role_id'] : '',
            'firstname' => !empty($input['firstname']) ? $input['firstname'] : '',
            'lastname' => !empty($input['lastname']) ? $input['lastname'] : '',
            'email' => !empty($input['email']) ? $input['email'] : '',
            'password' => !empty($input['password']) ? password_hash($input['password'], PASSWORD_BCRYPT) : '',
        ];

        $data = array_unset_empty($data);

        $is_updated = $this->users_model->update($data, $userid);
        if ($is_updated === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }

    public function user_delete(?string $userid = null)
    {
        if (empty($userid)) {
            $this->response(['status' => 'error'], 400);
        }

        $is_deleted = $this->users_model->delete($userid);
        if ($is_deleted === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }
}
