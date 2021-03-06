<?php
class Usuarios extends CI_Controller
{
    public function email_check($email)
    {
        return strpos($email, '@soulasalle.com.br') || strpos($email, '@lasalle.org.br') !== false;
    }
    public function index()
    {
        ob_start();
        // Libs Recaptcha
        require_once('vendor/google/recaptcha/src/ReCaptcha/ReCaptcha.php');
        require_once('vendor/google/recaptcha/src/ReCaptcha/RequestMethod.php');
        require_once('vendor/google/recaptcha/src/ReCaptcha/RequestParameters.php');
        require_once('vendor/google/recaptcha/src/ReCaptcha/Response.php');
        require_once('vendor/google/recaptcha/src/ReCaptcha/RequestMethod/Curl.php');
        require_once('vendor/google/recaptcha/src/ReCaptcha/RequestMethod/CurlPost.php');
        require_once('vendor/google/recaptcha/src/ReCaptcha/RequestMethod/Post.php');
        require_once('vendor/google/recaptcha/src/ReCaptcha/RequestMethod/Socket.php');
        require_once('vendor/google/recaptcha/src/ReCaptcha/RequestMethod/SocketPost.php');
        // end
        $dados['siteKey']   = '6Ld0pkwUAAAAAPoc-WBI4SQmUu6dKz6eJIeUtJn8';
        $dados['secretKey'] = '6Ld0pkwUAAAAALvbTxJS0pMHy5b8iyZps6UU0Ddm';
        // Verifica se o campo com o código do reCaptcha foi enviado para o servidor
        if ($this->input->post('g-recaptcha-response')) {
            // Faz a instanciação e verificação do reCaptcha
            $recaptcha = new \ReCaptcha\ReCaptcha($dados['secretKey']);
            $resp      = $recaptcha->verify($this->input->post('g-recaptcha-response'), $_SERVER['REMOTE_ADDR']);
            if ($resp->isSuccess()) { // Se Recaptcha foi digitado certo executa os procedimentos de validação login e senha
                try {
                    $this->load->library("form_validation");
                    $this->form_validation->set_rules('txt-user', 'Email La Salle', 'required|valid_email|callback_email_check');
                    $this->form_validation->set_message('email_check', '<center><div class="alert alert-danger w-75" role="alert"><strong>É obrigatório o uso de email @soulasalle.com.br ou @lasalle.org.br! </strong>Tente novamente.</div>
</center>');



                    $this->form_validation->set_rules('txt-senha', 'Senha', 'required|min_length[8]');
                    if (!$this->form_validation->run())
                        throw new UnexpectedValueException(validation_errors()); // Erros adversos de validação
                    $user     = $this->input->post('txt-user');
                    $password = $this->input->post('txt-senha');
                    $query    = $this->db->select("*")->from("cadastrousuario")->where("email", $user)->get();
                    $verifica = $this->db->query("SELECT * FROM cadastrousuario  WHERE is_verified = 1 AND email = '$user'");

                    if ($query->num_rows() != 1) {
                        throw new UnexpectedValueException('<center><div class="alert alert-danger w-75" role="alert"><strong>Usuario inexistente, efetue seu cadastro.</strong></div></center>'); // User Incorreto
                    } else if ($verifica->num_rows() == 0) { //NAO ENVIAR ESSE ARQUIVO PARA O SERVIDOR!!!!
                        throw new UnexpectedValueException('<center><div class="alert alert-danger w-75" role="alert">Conta ainda não ativada! </strong>Acesse seu email La Salle e clique no link de ativação.<br>Não deixe de verificar a caixa <i>SPAM</i> de seu email!<br></div></center>'); // Usuário não ativado
                    }
                    $row = $query->row();
                    if (!password_verify($password, $row->senha)) {
                        // Senha Incorreta
                        throw new UnexpectedValueException('<center><div class="alert alert-danger w-75" role="alert"><strong>Senha incorreta! </strong>Tente novamente.</div></center>'); // Exception Senha incorreta
                        $dadosSessao['userlogado'] = NULL;
                        $dadosSessao['logado']     = FALSE;
                        $this->session->set_userdata($dadosSessao);
                        redirect(base_url('indice'));
                    } else {
                        // Logado com sucesso
                        $dadosSessao['userlogado'] = $userlogado[1];
                        $dadosSessao['logado']     = TRUE;
                        $dadosSessao['email']      = $user;
                        $this->session->set_userdata($dadosSessao);
                        redirect(base_url('busca'));
                    }
                }
                catch (Exception $e) {
                    // Pega a mensagem da excessÃ£o e printa
                    $data = array(
                        'e' => $e
                    );
                    $this->load->view('index/topo');
                    $this->load->view('index/inicio', $data);
                    $this->load->view('index/oquee');
                    $this->load->view('index/comofunciona');
                    $this->load->view('index/cadastro');
                    $this->load->view('index/desenvolvedores');
                    $this->load->view('index/contato');
                    $this->load->view('index/rodape');
                }
                catch (\Error $e) {
                    echo $e->getMessage(); // Pega a mensagem de erro e printa
                    $data = array(
                        'e' => $e
                    );
                    $this->load->view('index/topo');
                    $this->load->view('index/inicio', $data);
                    $this->load->view('index/oquee');
                    $this->load->view('index/comofunciona');
                    $this->load->view('index/cadastro');
                    $this->load->view('index/desenvolvedores');
                    $this->load->view('index/contato');
                    $this->load->view('index/rodape');
                }
            } else {
                echo "Problemas ao validar o reCaptcha: " . implode(', ', $resp->getErrorCodes());
            }
        } else {
            $data = "Captcha inválido";
            $this->load->view('index/topo');
            $this->load->view('index/inicio', $data);
            $this->load->view('index/oquee');
            $this->load->view('index/comofunciona');
            $this->load->view('index/cadastro');
            $this->load->view('index/desenvolvedores');
            $this->load->view('index/contato');
            $this->load->view('index/rodape');
        }
    }
}
