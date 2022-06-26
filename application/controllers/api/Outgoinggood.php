<?php defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Outgoinggood extends RestController
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('outgoing_goods_model');
    }

    public function outgoinggood_get(?string $ogid = null)
    {
        if (empty($ogid)) {
            $result = $this->outgoing_goods_model->get_all_outgoinggoods();
            $data = [
                'status' => 'success',
                'outgoinggoods' => $result !== false ? $result : [],
            ];
        }

        if (!empty($ogid)) {
            $result = $this->outgoing_goods_model->get($ogid);
            $data = [
                'status' => 'success',
                'outgoinggood' => $result !== false ? $result : [],
            ];
        }

        $this->response($data, 200);
    }

    public function outgoinggood_post()
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
        $is_valid = $this->form_validation->run('outgoinggood_post');
        if (!$is_valid) {
            $this->response([
                'status' => 'error',
                'message' => $this->form_validation->error_string(),
            ], 400);
        }

        $is_inserted = $this->outgoing_goods_model->insert($data);
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

    public function outgoinggood_put(?string $ogid = null)
    {
        if (empty($ogid)) {
            $this->response([
                'status' => 'error',
                'message' => 'Outgoing Good ID is missing.',
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
        $is_valid = $this->form_validation->run('outgoinggood_post');
        if (!$is_valid) {
            $this->response([
                'status' => 'error',
                'message' => $this->form_validation->error_string(),
            ], 400);
        }

        $is_updated = $this->outgoing_goods_model->update($data, $ogid);
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

    public function outgoinggood_delete(?string $ogid = null)
    {
        if (empty($ogid)) {
            $this->response([
                'status' => 'error',
                'message' => 'Outgoing Good ID is missing.',
            ], 400);
        }

        $is_deleted = $this->outgoing_goods_model->delete($ogid);
        if (!$is_deleted) {
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
