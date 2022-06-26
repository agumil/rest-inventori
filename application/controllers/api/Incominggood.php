<?php defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Incominggood extends RestController
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('incoming_goods_model');
    }

    public function incominggood_get(?string $igid = null)
    {
        if (empty($igid)) {
            $result = $this->incoming_goods_model->get_all_incominggoods();
            $data = [
                'status' => 'success',
                'incominggoods' => $result !== false ? $result : [],
            ];
        }

        if (!empty($igid)) {
            $result = $this->incoming_goods_model->get($igid);
            $data = [
                'status' => 'success',
                'incominggood' => $result !== false ? $result : [],
            ];
        }

        $this->response($data, 200);
    }

    public function incominggood_post()
    {
        $input = $this->post();

        $data = [
            'brand_id' => $input['brand_id'] ?? '',
            'measurement_id' => $input['measurement_id'] ?? '',
            'color_id' => $input['color_id'] ?? '',
            'material' => $input['material'] ?? '',
            'name' => $input['name'] ?? '',
            'quantity' => $input['quantity'] ?? '',
            'weight' => $input['weight'] ?? '',
            'date' => $input['date'] ?? '',
        ];

        $this->form_validation->set_data($data);
        $is_valid = $this->form_validation->run('incominggood_post');
        if (!$is_valid) {
            $this->response([
                'status' => 'error',
                'message' => $this->form_validation->error_string(),
            ], 400);
        }

        $is_inserted = $this->incoming_goods_model->insert($data);
        if (!$is_inserted) {
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

    public function incominggood_put(?string $igid = null)
    {
        if (empty($igid)) {
            $this->response([
                'status' => 'error',
                'message' => 'Incoming Good ID is missing.',
            ], 400);
        }

        $input = $this->put();

        $data = [
            'brand_id' => $input['brand_id'] ?? '',
            'measurement_id' => $input['measurement_id'] ?? '',
            'color_id' => $input['color_id'] ?? '',
            'material' => $input['material'] ?? '',
            'name' => $input['name'] ?? '',
            'quantity' => $input['quantity'] ?? '',
            'weight' => $input['weight'] ?? '',
            'date' => $input['date'] ?? '',
        ];

        $this->form_validation->set_data($data);
        $is_valid = $this->form_validation->run('incominggood_post');
        if (!$is_valid) {
            $this->response([
                'status' => 'error',
                'message' => $this->form_validation->error_string(),
            ], 400);
        }

        $is_updated = $this->incoming_goods_model->update($data, $igid);
        if (!$is_updated) {
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

    public function incominggood_delete(?string $igid = null)
    {
        if (empty($igid)) {
            $this->response([
                'status' => 'error',
                'message' => 'Incoming Good ID is missing.',
            ], 400);
        }

        $is_deleted = $this->incoming_goods_model->delete($igid);
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
