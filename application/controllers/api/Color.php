<?php defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Color extends RestController
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('colors_model');
    }

    public function color_get(?string $colorid = null)
    {
        if (empty($colorid)) {
            $result = $this->colors_model->get_all();
            $data = [
                'status' => 'success',
                'colors' => $result !== false ? $result : [],
            ];
        }

        if (!empty($colorid)) {
            $result = $this->colors_model->get($colorid);
            $data = [
                'status' => 'success',
                'color' => $result !== false ? $result : [],
            ];
        }

        $this->response($data, 200);
    }

    public function color_post()
    {
        $input = $this->post();

        $data = [
            'name' => $input['name'] ?? '',
            'code' => $input['code'] ?? '',
        ];

        $this->form_validation->set_data($data);
        $is_valid = $this->form_validation->run('color_post');
        if (!$is_valid) {
            $this->response([
                'status' => 'error',
                'message' => $this->form_validation->error_string(),
            ], 400);
        }

        $is_inserted = $this->colors_model->insert($data);
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

    public function color_put(?string $colorid = null)
    {
        if (empty($colorid)) {
            $this->response([
                'status' => 'error',
                'message' => 'Color Id is missing',
            ], 400);
        }

        $input = $this->put();

        $data = [
            'name' => $input['name'] ?? '',
            'code' => $input['code'] ?? '',
        ];

        $this->form_validation->set_data($data);
        $is_valid = $this->form_validation->run('color_post');
        if (!$is_valid) {
            $this->response([
                'status' => 'error',
                'message' => $this->form_validation->error_string(),
            ], 400);
        }

        $is_updated = $this->colors_model->update($data, $colorid);
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

    public function color_delete(?string $colorid = null)
    {
        if (empty($colorid)) {
            $this->response([
                'status' => 'error',
                'message' => 'Color Id is missing',
            ], 400);
        }

        $is_deleted = $this->colors_model->delete($colorid);
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
