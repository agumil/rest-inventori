<?php defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Color extends RestController
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('colors_model');
    }

    public function color_get(?string $colorid = null)
    {
        if (empty($colorid)) {
            $result = $this->colors_model->get_all();
            $data = [
                'status' => 'success',
                'colors' => $result !== false ? $result : [],
            ];
        }

        if (!empty($colorid)) {
            $result = $this->colors_model->get($colorid);
            $data = [
                'status' => 'success',
                'color' => $result !== false ? $result : [],
            ];
        }

        $this->response($data, 200);
    }

    public function color_post()
    {
        $input = $this->input->post();

        $data = [
            'name' => $input['name'],
            'code' => $input['code'],
        ];

        $is_inserted = $this->colors_model->insert($data);
        if ($is_inserted === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }

    public function color_put(?string $colorid = null)
    {
        if (empty($colorid)) {
            $this->response(['message' => 'error'], 400);
        }

        $input = $this->input->post();

        $data = [
            'name' => !empty($input['name']) ? $input['name'] : '',
            'code' => !empty($input['code']) ? $input['code'] : '',
        ];

        $data = array_unset_empty($data);

        $is_updated = $this->colors_model->update($data, $colorid);
        if ($is_updated === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }

    public function color_delete(?string $colorid = null)
    {
        if (empty($colorid)) {
            $this->response(['status' => 'error'], 400);
        }

        $is_deleted = $this->colors_model->delete($colorid);
        if ($is_deleted === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }
}
