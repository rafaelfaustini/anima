<header class="martelotte">
<div class="container">
<center>
<section id="cadastro">
      <div class="container">
            <h2 class="section-heading text-uppercase sombras">Oferecer carona</h2>
            <h3 class="section-subheading">Preencha corretamente os dados abaixo:</h3>
          </div>
<?php echo form_open('oferece/grava'); ?>
<CENTER>
<!-- INICIO DOS CAMPOS DO FORMULÁRIO -->
<center>
<input id="dusuario" name="dusuario" type="hidden" value="<?php print_r($this->session->userdata('email'));?>">
<font class="required">Meio</font>
<br>
<?php foreach ($local as $info) { ?>
<select class="form-control.col-lg form-control-lg" name="dmeiotransporte" id="select-transporte" onchange="loadestimativa('<?php echo $info->logradourousuario;?>');"><!--> <-- Receber o logradouro dentro dos parenteses dessa função (Parametro)    -->
    <option disabled selected value>Meio de transporte</option>
    <option value="A pé">A pé</option>
    <option value="Carro">Carro</option>
    <option value="bus">Ônibus</option>
    <option value="Uber">Uber</option>
    <option value="Bicicleta">Bicicleta</option>
    <option value="Táxi">Táxi</option>
  </select>
  <br>
  <font class="required" >Origem</font>
  <br>
  <select class="form-control.col-lg form-control-lg" name="dorigem" id="select-origem" onchange="loadestimativa('<?php echo $info->logradourousuario;?>');"><!--> <-- Receber o logradouro dentro dos parenteses dessa função (Parametro)    -->
    <option disabled selected value>Origem</option>
    <option value="<?php echo $info->logradourousuario;?>">Casa (<?php echo $info->logradourousuario;?>)</option>
    <option value="Unilasalle-RJ">Unilasalle-RJ</option>
    <option value="Terminal">Terminal</option>
    <option value="Rodoviária">Rodoviária</option>
    <option value="Barcas">Barcas - Estação Arariboia</option>
    <option value="Mestre dos Sucos">Mestre dos Sucos</option>
  </select>
  <br>
  <font class="required">Destino</font>
  <br>
  <select class="form-control.col-lg form-control-lg" name="ddestino" id="select-destino" onchange="loadestimativa('<?php echo $info->logradourousuario;?>');"><!--> <-- Receber o logradouro dentro dos parenteses dessa função (Parametro)    -->
    <option disabled selected value>Destino</option>
    <option value="Unilasalle-RJ">Unilasalle-RJ</option>
    <option value="<?php echo $info->logradourousuario;?>">Casa (<?php echo $info->logradourousuario;?>)</option>
    <option value="Terminal">Terminal</option>
    <option value="Rodoviária">Rodoviária</option>
    <option value="Barcas">Barcas - Estação Arariboia</option>
    <option value="Mestre dos Sucos">Mestre dos Sucos</option>
  </select></fielset>
 <br>
  <font class="required">Horário</font>
  <br>
  <select class="form-control.col-lg form-control-lg" name="dhorario">
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
<h3 class="section-subheading sombras" id="estimativas"></h3>
<br>
<?php echo form_submit(array('id' => 'submit', 'value' => 'Salvar proposta', 'class'=>'btn btn-primary btn-xl text-uppercase')); ?>
<br>
<?php echo form_close(); ?></div>
<br><br><br><br><br><br><br>
</center>
<?php } ?>
