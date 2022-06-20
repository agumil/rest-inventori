<?php defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Sku extends RestController
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('skus_model');
    }

    public function sku_get(?string $skuid = null)
    {
        if (empty($skuid)) {
            $result = $this->skus_model->get_all();
            $data = [
                'status' => 'success',
                'skus' => $result !== false ? $result : [],
            ];
        }

        if (!empty($skuid)) {
            $result = $this->skus_model->get($skuid);
            $data = [
                'status' => 'success',
                'sku' => $result !== false ? $result : [],
            ];
        }

        $this->response($data, 200);
    }

    public function sku_post()
    {
        $input = $this->input->post();

        $data = [
            'goods_id' => $input['goods_id'],
            'code' => $input['code'],
        ];

        $is_inserted = $this->skus_model->insert($data);
        if ($is_inserted === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }

    public function sku_put(?string $skuid = null)
    {
        if (empty($skuid)) {
            $this->response(['message' => 'error'], 400);
        }

        $input = $this->input->post();

        $data = [
            'goods_id' => !empty($input['goods_id']) ? $input['goods_id'] : '',
            'code' => !empty($input['code']) ? $input['code'] : '',
        ];

        $data = array_unset_empty($data);

        $is_updated = $this->skus_model->update($data, $skuid);
        if ($is_updated === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }

    public function sku_delete(?string $skuid = null)
    {
        if (empty($skuid)) {
            $this->response(['status' => 'error'], 400);
        }

        $is_deleted = $this->skus_model->delete($skuid);
        if ($is_deleted === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }
}
