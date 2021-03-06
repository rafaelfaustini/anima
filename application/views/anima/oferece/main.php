<header class="martelotte" id="wrap">
<div class="container">
<section id="cadastro">
      <div class="container">
            <h2 class="section-heading text-uppercase sombras">Oferecer carona</h2>
            <h3 class="section-subheading">Preencha corretamente os dados abaixo:</h3>
            <!--INICIO DE EXIBE OS ALERTAS GERAIS -->
                <?php foreach ($host as $info) { ?>
                <?php if($info->host == 1){
                  echo '<div class="alert alert-danger" role="alert"><strong>ATENÇÃO! </strong>Você já possui uma proposta de carona ativa. Se fizer nova proposta os passageiros ativos serão retirados da carona e o chat será apagado!<br></div>';
                } ?>
                <?php } ?>
                <?php foreach ($passageiro as $info) { ?>
                 <?php if($info->passageiro != 0){
                  echo '<div class="alert alert-danger" role="alert"><strong>ATENÇÃO! </strong>Você já é passageiro de um carona ativa. Se fizer uma oferta de carona você automaticamente deixará de ser passageiro!<br></div>';
                } ?>
                <?php } ?>
              <!--FIM DE EXIBE OS ALERTAS GERAIS -->
            <?php echo $this->session->flashdata('message');?>
          </div>
<?php echo form_open('oferece/grava'); ?>
<!-- INICIO DOS CAMPOS DO FORMULÁRIO -->
<center>
<input id="dusuario" name="dusuario" type="hidden" value="<?php print_r($this->session->userdata('email'));?>">
<?php foreach ($local as $info) { ?>
<div class="col-8">
<select required class="form-control form-control-md" name="dmeiotransporte" id="select-transporte" onchange="loadestimativa('<?php echo $info->logradourousuario;?>');"><!-- Receber o logradouro dentro dos parenteses dessa função (Parametro)    -->
    <option disabled selected value> Meio de Transporte </option>
    <option value="A pé">A pé</option>
    <option value="Carro">Carro</option>
    <option value="Ônibus">Ônibus</option>
    <option value="Uber">Uber</option>
    <option value="Bicicleta">Bicicleta</option>
    <option value="Táxi">Táxi</option>
  </select>
  <br>
  <select required class="form-control form-control-md" name="dhorario">
    <option disabled selected value> Horário </option>
  <?php
date_default_timezone_set("America/Sao_Paulo");
$now = getdate();
$minutes = $now['minutes'] - $now['minutes']%30;
 //Abaixo ajustamos os intervalos
  $rmin  = $now['minutes']%30;
  if ($rmin > 37){
    $minutes = $now['minutes'] + (30-$rmin);
   }else{
      $minutes = $now['minutes'] - $rmin;
  }
  $rounded = $now['hours'].":".$minutes;
   $range=range(strtotime(date("$rounded")),strtotime("23:00"),30*60);
   foreach($range as $time){
    echo '<option value="'. date("H:i",$time).'">'. date("H:i",$time).'</option>'. date("H:i",$time)."\n";
  }?>
</select>
  <br>
  <select required class="form-control form-control-md" name="dorigem" id="select-origem" onchange="loadestimativa('<?php echo $info->logradourousuario;?>');"><!-- Receber o logradouro dentro dos parenteses dessa função (Parametro)    -->
    <option disabled selected value>Origem</option>
    <option value="<?php echo $info->logradourousuario.' - '.$info->bairrousuario.' - '.$info->cidadeusuario;?>"><?php echo $info->logradourousuario.' - '.$info->bairrousuario.' - '.$info->cidadeusuario;?></option>
    <option value="Unilasalle-RJ">Unilasalle-RJ</option>
    <option value="Terminal">Terminal</option>
    <option value="Rodoviária">Rodoviária</option>
    <option value="Barcas">Barcas - Estação Arariboia</option>
    <option value="Mestre do Suco">Mestre do Suco</option>
    <option value="Plaza Shopping">Plaza Shopping</option>
    <option value="Bay Market">Bay Market</option>
  </select>
  <br>
  <select required class="form-control form-control-md" name="ddestino" id="select-destino" onchange="loadestimativa('<?php echo $info->logradourousuario;?>');"><!-- Receber o logradouro dentro dos parenteses dessa função (Parametro)    -->
    <option disabled selected value>Destino</option>
    <option value="Unilasalle-RJ">Unilasalle-RJ</option>
    <option value="<?php echo $info->logradourousuario.' - '.$info->bairrousuario.' - '.$info->cidadeusuario;?>"><?php echo $info->logradourousuario.' - '.$info->bairrousuario.' - '.$info->cidadeusuario;?></option>
    <option value="Terminal">Terminal</option>
    <option value="Rodoviária">Rodoviária</option>
    <option value="Barcas">Barcas - Estação Arariboia</option>
    <option value="Mestre do Suco">Mestre do Suco</option>
    <option value="Plaza Shopping">Plaza Shopping</option>
    <option value="Bay Market">Bay Market</option>
  </select>
 <input type="hidden" name="dhost" value="1">
<?php foreach ($curso as $infocurso) {
echo '<input type="hidden" name="dcurso" value="'.$infocurso->cursousuario.'">
<input type="hidden" name="despecificacurso" value="'.$infocurso->especifica_cursousuario.'">';
} ?>
<div style="display:none;height:0px;margin-top:10%;margin-bottom: 10%;font-weight: bold;-webkit-text-stroke-width: 0.2px;-webkit-text-stroke-color: black;" class="section-subheading sombras" id="estimativas"></div>
<br>
<?php echo form_submit(array('id' => 'submit', 'value' => 'Salvar proposta', 'class'=>'btn btn-primary btn-l')); ?>
</div>


<?php echo form_close(); ?></div>
</center>
<?php break;} ?>

<!-- INÍCIO DO RODAPÉ -->
<!--<div class="copyright  intro-lead-in sombras text-white" style="background-color:#660298"> -->
<div class="py-0 text-secundary" style="position: fixed; width: 100%; bottom: 0; background-color:#660298;">
&nbsp;
</div>
</style>
</body>
<script src="<?php echo base_url('vendor/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<!-- Plugin JavaScript -->
<script src="<?php echo base_url('vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
<!-- Contato form JavaScript -->
<script src="<?php echo base_url('js/jqBootstrapValidation.js'); ?>"></script>
<script src="<?php echo base_url('js/contato_me.js'); ?>"></script>
<!-- Custom scripts for this template -->
<script src="<?php echo base_url('js/agency.min.js'); ?>"></script>
</html>
