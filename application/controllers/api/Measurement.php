<?php defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Measurement extends RestController
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('measurements_model');
    }

    public function measurement_get(?string $measurementid = null)
    {
        if (empty($measurementid)) {
            $result = $this->measurements_model->get_all();
            $data = [
                'status' => 'success',
                'measurements' => $result !== false ? $result : [],
            ];
        }

        if (!empty($measurementid)) {
            $result = $this->measurements_model->get($measurementid);
            $data = [
                'status' => 'success',
                'measurement' => $result !== false ? $result : [],
            ];
        }

        $this->response($data, 200);
    }

    public function measurement_post()
    {
        $input = $this->post();

        $data = [
            'name' => $input['name'] ?? '',
            'unit' => $input['unit'] ?? '',
        ];

        $this->form_validation->set_data($data);
        $is_valid = $this->form_validation->run('measurement_post');
        if (!$is_valid) {
            $this->response([
                'status' => 'error',
                'message' => $this->form_validation->error_string(),
            ], 400);
        }

        $is_inserted = $this->measurements_model->insert($data);
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

    public function measurement_put(?string $measurementid = null)
    {
        if (empty($measurementid)) {
            $this->response([
                'status' => 'error',
                'message' => 'Measurement ID is missing.',
            ], 400);
        }

        $input = $this->put();

        $data = [
            'name' => $input['name'] ?? '',
            'unit' => $input['unit'] ?? '',
        ];

        $this->form_validation->set_data($data);
        $is_valid = $this->form_validation->run('measurement_post');
        if (!$is_valid) {
            $this->response([
                'status' => 'error',
                'message' => $this->form_validation->error_string(),
            ], 400);
        }

        $is_updated = $this->measurements_model->update($data, $measurementid);
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

    public function measurement_delete(?string $measurementid = null)
    {
        if (empty($measurementid)) {
            $this->response([
                'status' => 'error',
                'message' => 'Measurement ID is missing.',
            ], 400);
        }

        $is_deleted = $this->measurements_model->delete($measurementid);
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
