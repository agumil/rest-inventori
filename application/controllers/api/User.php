<?php defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('users_model');
    }

    public function user_get(?string $userid = null)
    {
        if (empty($userid)) {
            $result = $this->users_model->get_all_users();
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
        $input = $this->post();

        $data = [
            'role_id' => isset($input['role_id']) ? $input['role_id'] : '',
            'firstname' => isset($input['firstname']) ? $input['firstname'] : '',
            'lastname' => isset($input['lastname']) ? $input['lastname'] : '',
            'email' => isset($input['email']) ? $input['email'] : '',
            'password' => isset($input['password']) ? password_hash($input['password'], PASSWORD_BCRYPT) : '',
        ];

        $this->form_validation->set_data($data);
        $is_valid = $this->form_validation->run('user_post');
        if (!$is_valid) {
            $this->response([
                'status' => 'error',
                'message' => $this->form_validation->error_string(),
            ], 400);
        }

        $is_inserted = $this->users_model->insert($data);
        if ($is_inserted === false) {
            $this->response([
                'status' => 'error',
                'message' => FAILED_INSERT,
            ], 400);
        }

        $this->response(['status' => 'success', 'message' => SUCCESS_INSERT], 200);
    }

    public function user_put(?string $userid = null)
    {
        if (empty($userid)) {
            $this->response(['status' => 'error', 'message' => 'User ID is missing.'], 400);
        }

        $input = $this->put();

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
            $this->response([
                'status' => 'error',
                'message' => FAILED_UPDATE,
            ], 400);
        }

        $this->response([
            'status' => 'success',
            'message' => SUCCESS_UPDATE,
        ], 200);
    }

    public function user_delete(?string $userid = null)
    {
        if (empty($userid)) {
            $this->response([
                'status' => 'error',
                'message' => 'User ID is missing.',
            ], 400);
        }

        $is_deleted = $this->users_model->delete($userid);
        if ($is_deleted === false) {
            $this->response([
                'status' => 'error',
                'message' => FAILED_DELETE,
            ], 400);
        }

        $this->response([
            'status' => 'success',
            'message' => SUCCESS_DELETE,
        ], 200);
    }
}
