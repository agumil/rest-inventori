<?php defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Role extends RestController
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('roles_model');
    }

    public function role_get(?string $roleid = null)
    {
        if (empty($roleid)) {
            $result = $this->roles_model->get_all();
            $data = [
                'status' => 'success',
                'roles' => $result !== false ? $result : [],
            ];
        }

        if (!empty($roleid)) {
            $result = $this->roles_model->get($roleid);
            $data = [
                'status' => 'success',
                'role' => $result !== false ? $result : [],
            ];
        }

        $this->response($data, 200);
    }

    public function role_post()
    {
        $input = $this->input->post();

        $data = [
            'name' => $input['name'],
        ];

        $is_inserted = $this->roles_model->insert($data);
        if ($is_inserted === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }

    public function role_put(?string $roleid = null)
    {
        if (empty($roleid)) {
            $this->response(['message' => 'error'], 400);
        }

        $input = $this->input->post();

        $data = [
            'name' => !empty($input['name']) ? $input['name'] : '',
        ];

        $data = array_unset_empty($data);

        $is_updated = $this->roles_model->update($data, $roleid);
        if ($is_updated === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }

    public function role_delete(?string $roleid = null)
    {
        if (empty($roleid)) {
            $this->response(['status' => 'error'], 400);
        }

        $is_deleted = $this->roles_model->delete($roleid);
        if ($is_deleted === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }
}
