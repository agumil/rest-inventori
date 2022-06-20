<?php defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Brand extends RestController
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('brands_model');
    }

    public function brand_get(?string $brandid = null)
    {
        if (empty($brandid)) {
            $result = $this->brands_model->get_all();
            $data = [
                'status' => 'success',
                'brands' => $result !== false ? $result : [],
            ];
        }

        if (!empty($brandid)) {
            $result = $this->brands_model->get($brandid);
            $data = [
                'status' => 'success',
                'brand' => $result !== false ? $result : [],
            ];
        }

        $this->response($data, 200);
    }

    public function brand_post()
    {
        $input = $this->input->post();

        $data = [
            'name' => $input['name'],
        ];

        $is_inserted = $this->brands_model->insert($data);
        if ($is_inserted === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }

    public function brand_put(?string $brandid = null)
    {
        if (empty($brandid)) {
            $this->response(['message' => 'error'], 400);
        }

        $input = $this->input->post();

        $data = [
            'name' => !empty($input['name']) ? $input['name'] : '',
        ];

        $data = array_unset_empty($data);

        $is_updated = $this->brands_model->update($data, $brandid);
        if ($is_updated === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }

    public function brand_delete(?string $brandid = null)
    {
        if (empty($brandid)) {
            $this->response(['status' => 'error'], 400);
        }

        $is_deleted = $this->brands_model->delete($brandid);
        if ($is_deleted === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }
}
