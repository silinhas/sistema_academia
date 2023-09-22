<?php
namespace PHPMaker2020\sistema_academia;
?>
<?php if ($cliente->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_clientemaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($cliente->idcliente->Visible) { // idcliente ?>
		<tr id="r_idcliente">
			<td class="<?php echo $cliente->TableLeftColumnClass ?>"><?php echo $cliente->idcliente->caption() ?></td>
			<td <?php echo $cliente->idcliente->cellAttributes() ?>>
<span id="el_cliente_idcliente">
<span<?php echo $cliente->idcliente->viewAttributes() ?>><?php echo $cliente->idcliente->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cliente->nomeCliente->Visible) { // nomeCliente ?>
		<tr id="r_nomeCliente">
			<td class="<?php echo $cliente->TableLeftColumnClass ?>"><?php echo $cliente->nomeCliente->caption() ?></td>
			<td <?php echo $cliente->nomeCliente->cellAttributes() ?>>
<span id="el_cliente_nomeCliente">
<span<?php echo $cliente->nomeCliente->viewAttributes() ?>><?php echo $cliente->nomeCliente->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cliente->cpf->Visible) { // cpf ?>
		<tr id="r_cpf">
			<td class="<?php echo $cliente->TableLeftColumnClass ?>"><?php echo $cliente->cpf->caption() ?></td>
			<td <?php echo $cliente->cpf->cellAttributes() ?>>
<span id="el_cliente_cpf">
<span<?php echo $cliente->cpf->viewAttributes() ?>><?php echo $cliente->cpf->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cliente->nascimento->Visible) { // nascimento ?>
		<tr id="r_nascimento">
			<td class="<?php echo $cliente->TableLeftColumnClass ?>"><?php echo $cliente->nascimento->caption() ?></td>
			<td <?php echo $cliente->nascimento->cellAttributes() ?>>
<span id="el_cliente_nascimento">
<span<?php echo $cliente->nascimento->viewAttributes() ?>><?php echo $cliente->nascimento->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cliente->sexo->Visible) { // sexo ?>
		<tr id="r_sexo">
			<td class="<?php echo $cliente->TableLeftColumnClass ?>"><?php echo $cliente->sexo->caption() ?></td>
			<td <?php echo $cliente->sexo->cellAttributes() ?>>
<span id="el_cliente_sexo">
<span<?php echo $cliente->sexo->viewAttributes() ?>><?php echo $cliente->sexo->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cliente->telefone->Visible) { // telefone ?>
		<tr id="r_telefone">
			<td class="<?php echo $cliente->TableLeftColumnClass ?>"><?php echo $cliente->telefone->caption() ?></td>
			<td <?php echo $cliente->telefone->cellAttributes() ?>>
<span id="el_cliente_telefone">
<span<?php echo $cliente->telefone->viewAttributes() ?>><?php echo $cliente->telefone->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cliente->cep->Visible) { // cep ?>
		<tr id="r_cep">
			<td class="<?php echo $cliente->TableLeftColumnClass ?>"><?php echo $cliente->cep->caption() ?></td>
			<td <?php echo $cliente->cep->cellAttributes() ?>>
<span id="el_cliente_cep">
<span<?php echo $cliente->cep->viewAttributes() ?>><?php echo $cliente->cep->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cliente->rua->Visible) { // rua ?>
		<tr id="r_rua">
			<td class="<?php echo $cliente->TableLeftColumnClass ?>"><?php echo $cliente->rua->caption() ?></td>
			<td <?php echo $cliente->rua->cellAttributes() ?>>
<span id="el_cliente_rua">
<span<?php echo $cliente->rua->viewAttributes() ?>><?php echo $cliente->rua->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cliente->bairro->Visible) { // bairro ?>
		<tr id="r_bairro">
			<td class="<?php echo $cliente->TableLeftColumnClass ?>"><?php echo $cliente->bairro->caption() ?></td>
			<td <?php echo $cliente->bairro->cellAttributes() ?>>
<span id="el_cliente_bairro">
<span<?php echo $cliente->bairro->viewAttributes() ?>><?php echo $cliente->bairro->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cliente->numero->Visible) { // numero ?>
		<tr id="r_numero">
			<td class="<?php echo $cliente->TableLeftColumnClass ?>"><?php echo $cliente->numero->caption() ?></td>
			<td <?php echo $cliente->numero->cellAttributes() ?>>
<span id="el_cliente_numero">
<span<?php echo $cliente->numero->viewAttributes() ?>><?php echo $cliente->numero->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cliente->complemento->Visible) { // complemento ?>
		<tr id="r_complemento">
			<td class="<?php echo $cliente->TableLeftColumnClass ?>"><?php echo $cliente->complemento->caption() ?></td>
			<td <?php echo $cliente->complemento->cellAttributes() ?>>
<span id="el_cliente_complemento">
<span<?php echo $cliente->complemento->viewAttributes() ?>><?php echo $cliente->complemento->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cliente->cidade->Visible) { // cidade ?>
		<tr id="r_cidade">
			<td class="<?php echo $cliente->TableLeftColumnClass ?>"><?php echo $cliente->cidade->caption() ?></td>
			<td <?php echo $cliente->cidade->cellAttributes() ?>>
<span id="el_cliente_cidade">
<span<?php echo $cliente->cidade->viewAttributes() ?>><?php echo $cliente->cidade->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cliente->_email->Visible) { // email ?>
		<tr id="r__email">
			<td class="<?php echo $cliente->TableLeftColumnClass ?>"><?php echo $cliente->_email->caption() ?></td>
			<td <?php echo $cliente->_email->cellAttributes() ?>>
<span id="el_cliente__email">
<span<?php echo $cliente->_email->viewAttributes() ?>><?php echo $cliente->_email->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cliente->data_matricula->Visible) { // data_matricula ?>
		<tr id="r_data_matricula">
			<td class="<?php echo $cliente->TableLeftColumnClass ?>"><?php echo $cliente->data_matricula->caption() ?></td>
			<td <?php echo $cliente->data_matricula->cellAttributes() ?>>
<span id="el_cliente_data_matricula">
<span<?php echo $cliente->data_matricula->viewAttributes() ?>><?php echo $cliente->data_matricula->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>