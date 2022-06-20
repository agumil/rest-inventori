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
            $result = $this->incoming_goods_model->get_all();
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
        $input = $this->input->post();

        $data = [
            'brand_id' => $input['brand_id'],
            'measurement_id' => $input['measurement_id'],
            'color_id' => $input['color_id'],
            'material' => $input['material'],
            'name' => $input['name'],
            'quantity' => $input['quantity'],
            'weight' => $input['weight'],
            'date' => $input['date'],
        ];

        $is_inserted = $this->incoming_goods_model->insert($data);
        if ($is_inserted === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }

    public function incominggood_put(?string $igid = null)
    {
        if (empty($igid)) {
            $this->response(['message' => 'error'], 400);
        }

        $input = $this->input->post();

        $data = [
            'brand_id' => !empty($input['brand_id']) ? $input['brand_id'] : '',
            'measurement_id' => !empty($input['measurement_id']) ? $input['measurement_id'] : '',
            'color_id' => !empty($input['color_id']) ? $input['color_id'] : '',
            'material' => !empty($input['material']) ? $input['material'] : '',
            'name' => !empty($input['name']) ? $input['name'] : '',
            'quantity' => !empty($input['quantity']) ? $input['quantity'] : '',
            'weight' => !empty($input['weight']) ? $input['weight'] : '',
        ];

        $data = array_unset_empty($data);

        $is_updated = $this->incoming_goods_model->update($data, $igid);
        if ($is_updated === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }

    public function incominggood_delete(?string $igid = null)
    {
        if (empty($igid)) {
            $this->response(['status' => 'error'], 400);
        }

        $is_deleted = $this->incoming_goods_model->delete($igid);
        if ($is_deleted === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }
}
