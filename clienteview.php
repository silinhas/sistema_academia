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
$cliente_view = new cliente_view();

// Run the page
$cliente_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cliente_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cliente_view->isExport()) { ?>
<script>
var fclienteview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fclienteview = currentForm = new ew.Form("fclienteview", "view");
	loadjs.done("fclienteview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$cliente_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $cliente_view->ExportOptions->render("body") ?>
<?php $cliente_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $cliente_view->showPageHeader(); ?>
<?php
$cliente_view->showMessage();
?>
<form name="fclienteview" id="fclienteview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cliente">
<input type="hidden" name="modal" value="<?php echo (int)$cliente_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($cliente_view->idcliente->Visible) { // idcliente ?>
	<tr id="r_idcliente">
		<td class="<?php echo $cliente_view->TableLeftColumnClass ?>"><span id="elh_cliente_idcliente"><?php echo $cliente_view->idcliente->caption() ?></span></td>
		<td data-name="idcliente" <?php echo $cliente_view->idcliente->cellAttributes() ?>>
<span id="el_cliente_idcliente">
<span<?php echo $cliente_view->idcliente->viewAttributes() ?>><?php echo $cliente_view->idcliente->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente_view->nomeCliente->Visible) { // nomeCliente ?>
	<tr id="r_nomeCliente">
		<td class="<?php echo $cliente_view->TableLeftColumnClass ?>"><span id="elh_cliente_nomeCliente"><?php echo $cliente_view->nomeCliente->caption() ?></span></td>
		<td data-name="nomeCliente" <?php echo $cliente_view->nomeCliente->cellAttributes() ?>>
<span id="el_cliente_nomeCliente">
<span<?php echo $cliente_view->nomeCliente->viewAttributes() ?>><?php echo $cliente_view->nomeCliente->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente_view->cpf->Visible) { // cpf ?>
	<tr id="r_cpf">
		<td class="<?php echo $cliente_view->TableLeftColumnClass ?>"><span id="elh_cliente_cpf"><?php echo $cliente_view->cpf->caption() ?></span></td>
		<td data-name="cpf" <?php echo $cliente_view->cpf->cellAttributes() ?>>
<span id="el_cliente_cpf">
<span<?php echo $cliente_view->cpf->viewAttributes() ?>><?php echo $cliente_view->cpf->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente_view->nascimento->Visible) { // nascimento ?>
	<tr id="r_nascimento">
		<td class="<?php echo $cliente_view->TableLeftColumnClass ?>"><span id="elh_cliente_nascimento"><?php echo $cliente_view->nascimento->caption() ?></span></td>
		<td data-name="nascimento" <?php echo $cliente_view->nascimento->cellAttributes() ?>>
<span id="el_cliente_nascimento">
<span<?php echo $cliente_view->nascimento->viewAttributes() ?>><?php echo $cliente_view->nascimento->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente_view->sexo->Visible) { // sexo ?>
	<tr id="r_sexo">
		<td class="<?php echo $cliente_view->TableLeftColumnClass ?>"><span id="elh_cliente_sexo"><?php echo $cliente_view->sexo->caption() ?></span></td>
		<td data-name="sexo" <?php echo $cliente_view->sexo->cellAttributes() ?>>
<span id="el_cliente_sexo">
<span<?php echo $cliente_view->sexo->viewAttributes() ?>><?php echo $cliente_view->sexo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente_view->telefone->Visible) { // telefone ?>
	<tr id="r_telefone">
		<td class="<?php echo $cliente_view->TableLeftColumnClass ?>"><span id="elh_cliente_telefone"><?php echo $cliente_view->telefone->caption() ?></span></td>
		<td data-name="telefone" <?php echo $cliente_view->telefone->cellAttributes() ?>>
<span id="el_cliente_telefone">
<span<?php echo $cliente_view->telefone->viewAttributes() ?>><?php echo $cliente_view->telefone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente_view->cep->Visible) { // cep ?>
	<tr id="r_cep">
		<td class="<?php echo $cliente_view->TableLeftColumnClass ?>"><span id="elh_cliente_cep"><?php echo $cliente_view->cep->caption() ?></span></td>
		<td data-name="cep" <?php echo $cliente_view->cep->cellAttributes() ?>>
<span id="el_cliente_cep">
<span<?php echo $cliente_view->cep->viewAttributes() ?>><?php echo $cliente_view->cep->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente_view->rua->Visible) { // rua ?>
	<tr id="r_rua">
		<td class="<?php echo $cliente_view->TableLeftColumnClass ?>"><span id="elh_cliente_rua"><?php echo $cliente_view->rua->caption() ?></span></td>
		<td data-name="rua" <?php echo $cliente_view->rua->cellAttributes() ?>>
<span id="el_cliente_rua">
<span<?php echo $cliente_view->rua->viewAttributes() ?>><?php echo $cliente_view->rua->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente_view->bairro->Visible) { // bairro ?>
	<tr id="r_bairro">
		<td class="<?php echo $cliente_view->TableLeftColumnClass ?>"><span id="elh_cliente_bairro"><?php echo $cliente_view->bairro->caption() ?></span></td>
		<td data-name="bairro" <?php echo $cliente_view->bairro->cellAttributes() ?>>
<span id="el_cliente_bairro">
<span<?php echo $cliente_view->bairro->viewAttributes() ?>><?php echo $cliente_view->bairro->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente_view->numero->Visible) { // numero ?>
	<tr id="r_numero">
		<td class="<?php echo $cliente_view->TableLeftColumnClass ?>"><span id="elh_cliente_numero"><?php echo $cliente_view->numero->caption() ?></span></td>
		<td data-name="numero" <?php echo $cliente_view->numero->cellAttributes() ?>>
<span id="el_cliente_numero">
<span<?php echo $cliente_view->numero->viewAttributes() ?>><?php echo $cliente_view->numero->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente_view->complemento->Visible) { // complemento ?>
	<tr id="r_complemento">
		<td class="<?php echo $cliente_view->TableLeftColumnClass ?>"><span id="elh_cliente_complemento"><?php echo $cliente_view->complemento->caption() ?></span></td>
		<td data-name="complemento" <?php echo $cliente_view->complemento->cellAttributes() ?>>
<span id="el_cliente_complemento">
<span<?php echo $cliente_view->complemento->viewAttributes() ?>><?php echo $cliente_view->complemento->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente_view->cidade->Visible) { // cidade ?>
	<tr id="r_cidade">
		<td class="<?php echo $cliente_view->TableLeftColumnClass ?>"><span id="elh_cliente_cidade"><?php echo $cliente_view->cidade->caption() ?></span></td>
		<td data-name="cidade" <?php echo $cliente_view->cidade->cellAttributes() ?>>
<span id="el_cliente_cidade">
<span<?php echo $cliente_view->cidade->viewAttributes() ?>><?php echo $cliente_view->cidade->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente_view->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $cliente_view->TableLeftColumnClass ?>"><span id="elh_cliente__email"><?php echo $cliente_view->_email->caption() ?></span></td>
		<td data-name="_email" <?php echo $cliente_view->_email->cellAttributes() ?>>
<span id="el_cliente__email">
<span<?php echo $cliente_view->_email->viewAttributes() ?>><?php echo $cliente_view->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente_view->data_matricula->Visible) { // data_matricula ?>
	<tr id="r_data_matricula">
		<td class="<?php echo $cliente_view->TableLeftColumnClass ?>"><span id="elh_cliente_data_matricula"><?php echo $cliente_view->data_matricula->caption() ?></span></td>
		<td data-name="data_matricula" <?php echo $cliente_view->data_matricula->cellAttributes() ?>>
<span id="el_cliente_data_matricula">
<span<?php echo $cliente_view->data_matricula->viewAttributes() ?>><?php echo $cliente_view->data_matricula->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$cliente_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cliente_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$cliente_view->terminate();
?>