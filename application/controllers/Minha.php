<?php

class Minha extends CI_Controller {
function __construct() {
parent::__construct();
$this->load->model('minha_model');
$this->load->model('confirma_model');
}
public function index()
    {ob_start();

if($this->session->userdata('logado')){

        $data['caronas'] = $this->minha_model->minhacarona();
        $data['host'] = $this->confirma_model->confirma_host();

        $host = $this->minha_model->consultahost();
        $data['passageiro'] = $this->minha_model->passageiro($host);

		    $this->load->view('anima/minha/topo');
        $this->load->view('anima/minha/main',$data);
        }else{
                redirect(base_url());
        }
    }
}
