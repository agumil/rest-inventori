<?php defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Material extends RestController
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('materials_model');
    }

    public function material_get(?string $materialid = null)
    {
        if (empty($materialid)) {
            $result = $this->materials_model->get_all();
            $data = [
                'status' => 'success',
                'materials' => $result !== false ? $result : [],
            ];
        }

        if (!empty($materialid)) {
            $result = $this->materials_model->get($materialid);
            $data = [
                'status' => 'success',
                'material' => $result !== false ? $result : [],
            ];
        }

        $this->response($data, 200);
    }

    public function material_post()
    {
        $input = $this->post();

        $data = [
            'name' => $input['name'] ?? '',
        ];

        $this->form_validation->set_data($data);
        $is_valid = $this->form_validation->run('material_post');
        if (!$is_valid) {
            $this->response([
                'status' => 'error',
                'message' => $this->form_validation->error_string(),
            ], 400);
        }

        $is_inserted = $this->materials_model->insert($data);
        if ($is_inserted === false) {
            $this->response([
                'status' => 'error',
                'message' => FAILED_INSERT,
            ], 400);
        }

        $this->response([
            'status' => 'success',
            'message' => SUCCESS_INSERT,
        ], 200);
    }

    public function material_put(?string $materialid = null)
    {
        if (empty($materialid)) {
            $this->response([
                'status' => 'error',
                'message' => 'Material ID is missing',
            ], 400);
        }

        $input = $this->put();

        $data = [
            'name' => $input['name'] ?? '',
        ];

        $this->form_validation->set_data($data);
        $is_valid = $this->form_validation->run('material_post');
        if (!$is_valid) {
            $this->response([
                'status' => 'error',
                'message' => $this->form_validation->error_string(),
            ], 400);
        }

        $is_updated = $this->materials_model->update($data, $materialid);
        if ($is_updated === false) {
            $this->response([
                'status' => 'error',
                'message' => FAILED_UPDATE,
            ], 400);
        }

        $this->response([
            'status' => 'success',
            'message' => FAILED_DELETE,
        ], 200);
    }

    public function material_delete(?string $materialid = null)
    {
        if (empty($materialid)) {
            $this->response([
                'status' => 'error',
                'message' => 'Material ID is missing.',
            ], 400);
        }

        $is_deleted = $this->materials_model->delete($materialid);
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
