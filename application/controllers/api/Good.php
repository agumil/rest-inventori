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
            $result = $this->goods_model->get_all();
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
        $input = $this->input->post();

        $data = [
            'name' => $input['name'],
        ];

        $is_inserted = $this->goods_model->insert($data);
        if ($is_inserted === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }

    public function good_put(?string $goodid = null)
    {
        if (empty($goodid)) {
            $this->response(['message' => 'error'], 400);
        }

        $input = $this->input->post();

        $data = [
            'name' => !empty($input['name']) ? $input['name'] : '',
        ];

        $data = array_unset_empty($data);

        $is_updated = $this->goods_model->update($data, $goodid);
        if ($is_updated === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }

    public function good_delete(?string $goodid = null)
    {
        if (empty($goodid)) {
            $this->response(['status' => 'error'], 400);
        }

        $is_deleted = $this->goods_model->delete($goodid);
        if ($is_deleted === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }
}
