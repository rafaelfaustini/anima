<?php class Edita_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $CI = &get_instance();
                //$this->db2 = $CI->load->database('Anima', TRUE);
        }

        function dadosUsuario()
        {
            $emailcadastrado = $this->session->userdata('email');
            $query = $this->db->query("SELECT nomecompleto as edita_nomecompleto, curso as cursousuario, especifica_curso as especificacursousuario, matricula as edita_matricula, email as edita_email, logradouro as edita_logradouro, numero as edita_numero, complemento as edita_complemento, cep as edita_cep FROM cadastrousuario WHERE email = '$emailcadastrado'" );
            return $query->result();
        }
}