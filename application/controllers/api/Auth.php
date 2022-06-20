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
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->users_model->where('email', $email)->get();
        if ($user === false) {
            $data = [
                'status' => 'error',
                'message' => 'Username or password incorrect.',
            ];
            $this->response($data, 400);
        }

        $is_verified = password_verify($password, $user->password);
        if (!$is_verified) {
            $data = [
                'status' => 'error',
                'message' => 'Username or password incorrect.',
            ];
            $this->response($data, 400);
        }

        $_SESSION['userid'] = $user->id;
        $_SESSION['roleid'] = $user->roleid;
        $_SESSION['firstname'] = $user->firstname;
        $_SESSION['lastname'] = $user->lastname;

        $this->response(['status' => 'success'], 200);
    }

    public function logout_post()
    {
        if (!session_destroy()) {
            $this->response(['status' => 'error'], 422);
        }

        $this->response(['status' => 'success'], 200);
    }

}
