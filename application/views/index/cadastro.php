<section id="cadastro">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading">Cadastro</h2>
            <h3 class="section-subheading text-muted">Preencha corretamente os dados abaixo:</h3>
          </div>
        </div>
<?php echo form_open('cadastro'); ?>
<!-- INICIO DOS CAMPOS DO FORMULÁRIO -->
<?php echo form_error('dnomecompleto'); ?>
<font class="required"> Nome Completo</font>
<input type="text" placeholder="Digite aqui seu nome completo" class="form-control" name="dnomecompleto" id="dnomecompleto" oninvalid="this.setCustomValidity('Não esqueça de preencher seu nome completo!')"
onchange="this.setCustomValidity('')" value="<?php echo set_value('dnomecompleto');?>" required>
<br>
<font class="required">Email</font> <br>
<?php echo form_error('demail'); ?>
<input type="text" placeholder="Digite aqui seu email La Salle (exemplo@soulasalle.com.br ou exemplo@lasalle.org)" class="form-control" name="demail" id="demail" oninvalid="this.setCustomValidity('Não esqueça de preencher seu email da La Salle!')"
onchange="this.setCustomValidity('')" value="<?php echo set_value('demail');?>" required>
<br>
<font class="required">Matrícula</font> <br>
<?php echo form_error('dmatricula'); ?>
<input type="text" placeholder="Digite sua matrícula da La Salle" class="form-control" name="dmatricula" id="dmatricula" maxlength="10" size="10" oninvalid="this.setCustomValidity('Não esqueça de preencher a sua matricula da La Salle!')"
onchange="this.setCustomValidity('')" value="<?php echo set_value('dmatricula');?>" required>
<br>
<font class="required">CEP</font> <br>
<?php echo form_error('dcep'); ?>
<input type="text" placeholder="Digite aqui o seu CEP" class="form-control" name="dcep" id="dcep" size="10" maxlength="9" onblur="pesquisacep(this.value);" oninvalid="this.setCustomValidity('Não esqueça de preencher seu CEP!')"
onchange="this.setCustomValidity('')" value="<?php echo set_value('dcep');?>" required>
<br>
<font class="required">Logradouro</font> <br>
<?php echo form_error('dlogradouro'); ?>
<input type="text" placeholder="Digite aqui o Logradouro" class="form-control" name="dlogradouro" id="dlogradouro"  oninvalid="this.setCustomValidity('Não esqueça de preencher o Logradouro!')" onchange="this.setCustomValidity('')" value="<?php echo set_value('dlogradouro');?>" required>
<br />
<font class="required">Número</font> <br>
<?php echo form_error('dnumero'); ?>
<input type="text" placeholder="Digite aqui o número" class="form-control" name="dnumero" id="dnumero" oninvalid="this.setCustomValidity('Não esqueça de preencher o número!')" onchange="this.setCustomValidity('')" value="<?php echo set_value('dnumero');?>" required>
<br>
Complemento <br>
<?php echo form_error('dcomplemento'); ?>
<input type="text" placeholder="Digite aqui o complemento" class="form-control" name="dcomplemento" id="dcomplemento" value="<?php echo set_value('dcomplemento');?>">
<br>
<font class="required">Senha</font> <br>
<?php echo form_error('dsenha'); ?>
<input pattern=".{8,30}" type="password" placeholder="Digite sua senha entre 8 e 30 caracteres" oninvalid="this.setCustomValidity('Não esqueça de preencher sua senha (Entre 8 e 30 caracteres)!')" onchange="this.setCustomValidity('')" class="form-control" name="dsenha" id="dsenha" required>
<br>
<font class="required">Confirme a senha</font> <br>
<?php echo form_error('dconfirmasenha'); ?>
<input pattern=".{8,30}" type="password" placeholder="Confirme aqui sua senha" class="form-control" name="dconfirmasenha" oninvalid="this.setCustomValidity('Não esqueça de preencher a confirmação de senha (Entre 8 e 30 caracteres)!')" onchange="this.setCustomValidity('')" id="dconfirmasenha" required>
<br>
<center>
<?php echo form_error('termo'); ?>
<input type="checkbox" name="termo" id="termo" value="1" oninvalid="this.setCustomValidity('É necessária a leitura e aceitação dos termos de uso.')"
onchange="this.setCustomValidity('')" required>&emsp;Declaro que li e estou de acordo com os termos de uso.
<br>
<?php echo form_submit(array('id' => 'submit', 'value' => 'Cadastrar', 'class'=>'btn btn-primary btn-xl text-uppercase')); ?>
<br>
<?php echo form_close(); ?> <br>
</center>
</div>
</section>
