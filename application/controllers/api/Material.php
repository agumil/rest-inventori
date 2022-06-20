<?php defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Material extends RestController
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('materials_model');
    }

    public function material_get(?string $materialid = null)
    {
        if (empty($materialid)) {
            $result = $this->materials_model->get_all();
            $data = [
                'status' => 'success',
                'materials' => $result !== false ? $result : [],
            ];
        }

        if (!empty($materialid)) {
            $result = $this->materials_model->get($materialid);
            $data = [
                'status' => 'success',
                'material' => $result !== false ? $result : [],
            ];
        }

        $this->response($data, 200);
    }

    public function material_post()
    {
        $input = $this->input->post();

        $data = [
            'name' => $input['name'],
        ];

        $is_inserted = $this->materials_model->insert($data);
        if ($is_inserted === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }

    public function material_put(?string $materialid = null)
    {
        if (empty($materialid)) {
            $this->response(['message' => 'error'], 400);
        }

        $input = $this->input->post();

        $data = [
            'name' => !empty($input['name']) ? $input['name'] : '',
        ];

        $data = array_unset_empty($data);

        $is_updated = $this->materials_model->update($data, $materialid);
        if ($is_updated === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }

    public function material_delete(?string $materialid = null)
    {
        if (empty($materialid)) {
            $this->response(['status' => 'error'], 400);
        }

        $is_deleted = $this->materials_model->delete($materialid);
        if ($is_deleted === false) {
            $this->response(['status' => 'error'], 400);
        }

        $this->response(['status' => 'success'], 200);
    }
}
