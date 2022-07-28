<?php defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class MY_Controller extends RestController
{
    public function set_ajax_response(int $httpcode, string $status, ?string $msg = null, ?array $data = null): void
    {
        $temp = [
            'message' => $msg,
            'httpcode' => $httpcode,
            'status' => $status,
        ];
        $temp = array_merge($temp, $data);

        $this->ajax_response = $temp;
    }

    public function get_ajax_response(): array
    {
        return $this->ajax_response;
    }

    public function return_ajax_response()
    {
        if (!isset($this->ajax_response['httpcode'])) {
            throw new Exception('Parameter httpcode tidak boleh kosong.');
        }

        if (!isset($this->ajax_response['status'])) {
            throw new Exception('Parameter status tidak boleh kosong.');
        }

        if (!in_array($this->ajax_response['status'], ['success', 'failed'])) {
            throw new Exception("Parameter status hanya boleh 'success' atau 'failed'.");
        }

        $this->output
            ->set_header('Access-Control-Allow-Method: GET, POST, OPTIONS, PUT, PATCH, DELETE')
            ->set_header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method')
            ->set_header('Access-Control-Allow-Origin: *')
            ->set_status_header($this->ajax_response['httpcode'])
            ->set_content_type('application/json')
            ->set_output(json_encode($this->ajax_response))
            ->_display();
        exit;
    }
}
