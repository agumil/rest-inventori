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
            $result = $this->outgoing_goods_model->get_all();
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
        $input = $this->input->post();

        $data = [
            'sku_code' => $input['sku_code'],
            'quantity' => $input['quantity'],
            'weight' => $input['weight'],
            'date' => $input['date'],
        ];

        $is_inserted = $this->outgoing_goods_model->insert($data);
        if ($is_inserted === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }

    public function outgoinggood_put(?string $ogid = null)
    {
        if (empty($ogid)) {
            $this->response(['message' => 'error'], 400);
        }

        $input = $this->input->post();

        $data = [
            'sku_code' => !empty($input['sku_code']) ? $input['sku_code'] : '',
            'quantity' => !empty($input['quantity']) ? $input['quantity'] : '',
            'weight' => !empty($input['weight']) ? $input['weight'] : '',
            'date' => !empty($input['date']) ? $input['date'] : '',
        ];

        $data = array_unset_empty($data);

        $is_updated = $this->outgoing_goods_model->update($data, $ogid);
        if ($is_updated === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }

    public function outgoinggood_delete(?string $ogid = null)
    {
        if (empty($ogid)) {
            $this->response(['status' => 'error'], 400);
        }

        $is_deleted = $this->outgoing_goods_model->delete($ogid);
        if ($is_deleted === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }
}
