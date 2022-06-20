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
        $input = $this->input->post();

        $data = [
            'name' => $input['name'],
        ];

        $is_inserted = $this->measurements_model->insert($data);
        if ($is_inserted === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }

    public function measurement_put(?string $measurementid = null)
    {
        if (empty($measurementid)) {
            $this->response(['message' => 'error'], 400);
        }

        $input = $this->input->post();

        $data = [
            'name' => !empty($input['name']) ? $input['name'] : '',
        ];

        $data = array_unset_empty($data);

        $is_updated = $this->measurements_model->update($data, $measurementid);
        if ($is_updated === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }

    public function measurement_delete(?string $measurementid = null)
    {
        if (empty($measurementid)) {
            $this->response(['status' => 'error'], 400);
        }

        $is_deleted = $this->measurements_model->delete($measurementid);
        if ($is_deleted === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }
}
