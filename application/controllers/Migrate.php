<?php defined('BASEPATH') or exit('No direct script access allowed');

class Migrate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->input->is_cli_request()) {
            show_404();
        }
    }

    public function up()
    {
        $result = $this->migration->latest();
        if ($result !== false) {
            echo "Berhasil! Seluruh table telah di-update sampai migration terbaru." . PHP_EOL;
        } else {
            echo $this->migration->error_string() . PHP_EOL;
        }
    }

    public function down(?string $input = null)
    {
        $input = strtolower($input);
        $allowed_input = ['y', 't'];

        if (!in_array($input, $allowed_input)) {
            echo "Input anda tidak valid ! Hanya menerima 'y' atau 't'" . PHP_EOL;
            exit;
        }

        if ($input === 't') {
            echo "Exiting program" . PHP_EOL;
            exit;
        }

        $result = $this->migration->version(0);
        if ($result !== false) {
            echo "Berhasil! Seluruh table migration berhasil direset." . PHP_EOL;
        } else {
            echo $this->migration->error_string() . PHP_EOL;
        }
    }
}
