<?php defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Good extends RestController
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('goods_model');
    }

    public function good_get(?string $goodid = null)
    {
        if (empty($goodid)) {
            $result = $this->goods_model->get_all_goods();
            $data = [
                'status' => 'success',
                'goods' => $result !== false ? $result : [],
            ];
        }

        if (!empty($goodid)) {
            $result = $this->goods_model->get($goodid);
            $data = [
                'status' => 'success',
                'good' => $result !== false ? $result : [],
            ];
        }

        $this->response($data, 200);
    }

    public function good_post()
    {
        $input = $this->post();

        $data = [
            'brand_id' => $input['brand_id'] ?? '',
            'measurement_id' => $input['measurement_id'] ?? '',
            'color_id' => $input['color_id'] ?? '',
            'material' => $input['material'] ?? '',
            'name' => $input['name'] ?? '',
            'quantity' => $input['quantity'] ?? '',
        ];

        $this->form_validation->set_data($data);
        $is_valid = $this->form_validation->run('good_post');
        if (!$is_valid) {
            $this->response([
                'status' => 'error',
                'message' => $this->form_validation->error_string(),
            ], 400);
        }

        $is_inserted = $this->goods_model->insert($data);
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

    public function good_put(?string $goodid = null)
    {
        if (empty($goodid)) {
            $this->response([
                'status' => 'error',
                'message' => 'Good ID is missing.',
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
        ];

        $data = array_unset_empty($data);

        $is_updated = $this->goods_model->update($data, $goodid);
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

    public function good_delete(?string $goodid = null)
    {
        if (empty($goodid)) {
            $this->response([
                'status' => 'error',
                'message' => 'Good ID is missing.',
            ], 400);
        }

        $is_deleted = $this->goods_model->delete($goodid);
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
