<?php
namespace PHPMaker2020\sistema_academia;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$cliente_delete = new cliente_delete();

// Run the page
$cliente_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cliente_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fclientedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fclientedelete = currentForm = new ew.Form("fclientedelete", "delete");
	loadjs.done("fclientedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cliente_delete->showPageHeader(); ?>
<?php
$cliente_delete->showMessage();
?>
<form name="fclientedelete" id="fclientedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cliente">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($cliente_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($cliente_delete->idcliente->Visible) { // idcliente ?>
		<th class="<?php echo $cliente_delete->idcliente->headerCellClass() ?>"><span id="elh_cliente_idcliente" class="cliente_idcliente"><?php echo $cliente_delete->idcliente->caption() ?></span></th>
<?php } ?>
<?php if ($cliente_delete->nomeCliente->Visible) { // nomeCliente ?>
		<th class="<?php echo $cliente_delete->nomeCliente->headerCellClass() ?>"><span id="elh_cliente_nomeCliente" class="cliente_nomeCliente"><?php echo $cliente_delete->nomeCliente->caption() ?></span></th>
<?php } ?>
<?php if ($cliente_delete->cpf->Visible) { // cpf ?>
		<th class="<?php echo $cliente_delete->cpf->headerCellClass() ?>"><span id="elh_cliente_cpf" class="cliente_cpf"><?php echo $cliente_delete->cpf->caption() ?></span></th>
<?php } ?>
<?php if ($cliente_delete->nascimento->Visible) { // nascimento ?>
		<th class="<?php echo $cliente_delete->nascimento->headerCellClass() ?>"><span id="elh_cliente_nascimento" class="cliente_nascimento"><?php echo $cliente_delete->nascimento->caption() ?></span></th>
<?php } ?>
<?php if ($cliente_delete->sexo->Visible) { // sexo ?>
		<th class="<?php echo $cliente_delete->sexo->headerCellClass() ?>"><span id="elh_cliente_sexo" class="cliente_sexo"><?php echo $cliente_delete->sexo->caption() ?></span></th>
<?php } ?>
<?php if ($cliente_delete->telefone->Visible) { // telefone ?>
		<th class="<?php echo $cliente_delete->telefone->headerCellClass() ?>"><span id="elh_cliente_telefone" class="cliente_telefone"><?php echo $cliente_delete->telefone->caption() ?></span></th>
<?php } ?>
<?php if ($cliente_delete->cep->Visible) { // cep ?>
		<th class="<?php echo $cliente_delete->cep->headerCellClass() ?>"><span id="elh_cliente_cep" class="cliente_cep"><?php echo $cliente_delete->cep->caption() ?></span></th>
<?php } ?>
<?php if ($cliente_delete->rua->Visible) { // rua ?>
		<th class="<?php echo $cliente_delete->rua->headerCellClass() ?>"><span id="elh_cliente_rua" class="cliente_rua"><?php echo $cliente_delete->rua->caption() ?></span></th>
<?php } ?>
<?php if ($cliente_delete->bairro->Visible) { // bairro ?>
		<th class="<?php echo $cliente_delete->bairro->headerCellClass() ?>"><span id="elh_cliente_bairro" class="cliente_bairro"><?php echo $cliente_delete->bairro->caption() ?></span></th>
<?php } ?>
<?php if ($cliente_delete->numero->Visible) { // numero ?>
		<th class="<?php echo $cliente_delete->numero->headerCellClass() ?>"><span id="elh_cliente_numero" class="cliente_numero"><?php echo $cliente_delete->numero->caption() ?></span></th>
<?php } ?>
<?php if ($cliente_delete->complemento->Visible) { // complemento ?>
		<th class="<?php echo $cliente_delete->complemento->headerCellClass() ?>"><span id="elh_cliente_complemento" class="cliente_complemento"><?php echo $cliente_delete->complemento->caption() ?></span></th>
<?php } ?>
<?php if ($cliente_delete->cidade->Visible) { // cidade ?>
		<th class="<?php echo $cliente_delete->cidade->headerCellClass() ?>"><span id="elh_cliente_cidade" class="cliente_cidade"><?php echo $cliente_delete->cidade->caption() ?></span></th>
<?php } ?>
<?php if ($cliente_delete->_email->Visible) { // email ?>
		<th class="<?php echo $cliente_delete->_email->headerCellClass() ?>"><span id="elh_cliente__email" class="cliente__email"><?php echo $cliente_delete->_email->caption() ?></span></th>
<?php } ?>
<?php if ($cliente_delete->data_matricula->Visible) { // data_matricula ?>
		<th class="<?php echo $cliente_delete->data_matricula->headerCellClass() ?>"><span id="elh_cliente_data_matricula" class="cliente_data_matricula"><?php echo $cliente_delete->data_matricula->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$cliente_delete->RecordCount = 0;
$i = 0;
while (!$cliente_delete->Recordset->EOF) {
	$cliente_delete->RecordCount++;
	$cliente_delete->RowCount++;

	// Set row properties
	$cliente->resetAttributes();
	$cliente->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$cliente_delete->loadRowValues($cliente_delete->Recordset);

	// Render row
	$cliente_delete->renderRow();
?>
	<tr <?php echo $cliente->rowAttributes() ?>>
<?php if ($cliente_delete->idcliente->Visible) { // idcliente ?>
		<td <?php echo $cliente_delete->idcliente->cellAttributes() ?>>
<span id="el<?php echo $cliente_delete->RowCount ?>_cliente_idcliente" class="cliente_idcliente">
<span<?php echo $cliente_delete->idcliente->viewAttributes() ?>><?php echo $cliente_delete->idcliente->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente_delete->nomeCliente->Visible) { // nomeCliente ?>
		<td <?php echo $cliente_delete->nomeCliente->cellAttributes() ?>>
<span id="el<?php echo $cliente_delete->RowCount ?>_cliente_nomeCliente" class="cliente_nomeCliente">
<span<?php echo $cliente_delete->nomeCliente->viewAttributes() ?>><?php echo $cliente_delete->nomeCliente->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente_delete->cpf->Visible) { // cpf ?>
		<td <?php echo $cliente_delete->cpf->cellAttributes() ?>>
<span id="el<?php echo $cliente_delete->RowCount ?>_cliente_cpf" class="cliente_cpf">
<span<?php echo $cliente_delete->cpf->viewAttributes() ?>><?php echo $cliente_delete->cpf->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente_delete->nascimento->Visible) { // nascimento ?>
		<td <?php echo $cliente_delete->nascimento->cellAttributes() ?>>
<span id="el<?php echo $cliente_delete->RowCount ?>_cliente_nascimento" class="cliente_nascimento">
<span<?php echo $cliente_delete->nascimento->viewAttributes() ?>><?php echo $cliente_delete->nascimento->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente_delete->sexo->Visible) { // sexo ?>
		<td <?php echo $cliente_delete->sexo->cellAttributes() ?>>
<span id="el<?php echo $cliente_delete->RowCount ?>_cliente_sexo" class="cliente_sexo">
<span<?php echo $cliente_delete->sexo->viewAttributes() ?>><?php echo $cliente_delete->sexo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente_delete->telefone->Visible) { // telefone ?>
		<td <?php echo $cliente_delete->telefone->cellAttributes() ?>>
<span id="el<?php echo $cliente_delete->RowCount ?>_cliente_telefone" class="cliente_telefone">
<span<?php echo $cliente_delete->telefone->viewAttributes() ?>><?php echo $cliente_delete->telefone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente_delete->cep->Visible) { // cep ?>
		<td <?php echo $cliente_delete->cep->cellAttributes() ?>>
<span id="el<?php echo $cliente_delete->RowCount ?>_cliente_cep" class="cliente_cep">
<span<?php echo $cliente_delete->cep->viewAttributes() ?>><?php echo $cliente_delete->cep->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente_delete->rua->Visible) { // rua ?>
		<td <?php echo $cliente_delete->rua->cellAttributes() ?>>
<span id="el<?php echo $cliente_delete->RowCount ?>_cliente_rua" class="cliente_rua">
<span<?php echo $cliente_delete->rua->viewAttributes() ?>><?php echo $cliente_delete->rua->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente_delete->bairro->Visible) { // bairro ?>
		<td <?php echo $cliente_delete->bairro->cellAttributes() ?>>
<span id="el<?php echo $cliente_delete->RowCount ?>_cliente_bairro" class="cliente_bairro">
<span<?php echo $cliente_delete->bairro->viewAttributes() ?>><?php echo $cliente_delete->bairro->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente_delete->numero->Visible) { // numero ?>
		<td <?php echo $cliente_delete->numero->cellAttributes() ?>>
<span id="el<?php echo $cliente_delete->RowCount ?>_cliente_numero" class="cliente_numero">
<span<?php echo $cliente_delete->numero->viewAttributes() ?>><?php echo $cliente_delete->numero->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente_delete->complemento->Visible) { // complemento ?>
		<td <?php echo $cliente_delete->complemento->cellAttributes() ?>>
<span id="el<?php echo $cliente_delete->RowCount ?>_cliente_complemento" class="cliente_complemento">
<span<?php echo $cliente_delete->complemento->viewAttributes() ?>><?php echo $cliente_delete->complemento->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente_delete->cidade->Visible) { // cidade ?>
		<td <?php echo $cliente_delete->cidade->cellAttributes() ?>>
<span id="el<?php echo $cliente_delete->RowCount ?>_cliente_cidade" class="cliente_cidade">
<span<?php echo $cliente_delete->cidade->viewAttributes() ?>><?php echo $cliente_delete->cidade->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente_delete->_email->Visible) { // email ?>
		<td <?php echo $cliente_delete->_email->cellAttributes() ?>>
<span id="el<?php echo $cliente_delete->RowCount ?>_cliente__email" class="cliente__email">
<span<?php echo $cliente_delete->_email->viewAttributes() ?>><?php echo $cliente_delete->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente_delete->data_matricula->Visible) { // data_matricula ?>
		<td <?php echo $cliente_delete->data_matricula->cellAttributes() ?>>
<span id="el<?php echo $cliente_delete->RowCount ?>_cliente_data_matricula" class="cliente_data_matricula">
<span<?php echo $cliente_delete->data_matricula->viewAttributes() ?>><?php echo $cliente_delete->data_matricula->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$cliente_delete->Recordset->moveNext();
}
$cliente_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cliente_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$cliente_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$cliente_delete->terminate();
?>