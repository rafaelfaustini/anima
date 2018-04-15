<?php
class Adere extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('adere_model');
    }
    public function index()
    {
        ob_start();

        if ($this->session->userdata('logado')) {

            $data       = ($this->session->userdata('email'));
            $proponente = $this->input->post('dproponente');

            $aderente = array(
            'proponente' => $this->input->post('dproponente'),
            'cursousuario' => $this->input->post('dcursousuario'),
            'especificacursousuario' => $this->input->post('despecificacursousuario'));

            $id         = $this->adere_model->consultaid($proponente);
            $meio       = $this->adere_model->consultameio($id, $proponente);
            $status     = $this->adere_model->criacarona($id, $data, $meio, $proponente, $aderente);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><strong>Adesão à carona realizada com sucesso! </strong>Acesse os detalhes da carona para interagir com os demais usuários!</div>');
                redirect(base_url('minha'));
            }else{
            redirect(base_url());
        }
    }
}
