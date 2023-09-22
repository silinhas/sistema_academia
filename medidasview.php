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
$medidas_view = new medidas_view();

// Run the page
$medidas_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$medidas_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$medidas_view->isExport()) { ?>
<script>
var fmedidasview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fmedidasview = currentForm = new ew.Form("fmedidasview", "view");
	loadjs.done("fmedidasview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$medidas_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $medidas_view->ExportOptions->render("body") ?>
<?php $medidas_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $medidas_view->showPageHeader(); ?>
<?php
$medidas_view->showMessage();
?>
<form name="fmedidasview" id="fmedidasview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="medidas">
<input type="hidden" name="modal" value="<?php echo (int)$medidas_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($medidas_view->idmedidas->Visible) { // idmedidas ?>
	<tr id="r_idmedidas">
		<td class="<?php echo $medidas_view->TableLeftColumnClass ?>"><span id="elh_medidas_idmedidas"><?php echo $medidas_view->idmedidas->caption() ?></span></td>
		<td data-name="idmedidas" <?php echo $medidas_view->idmedidas->cellAttributes() ?>>
<span id="el_medidas_idmedidas">
<span<?php echo $medidas_view->idmedidas->viewAttributes() ?>><?php echo $medidas_view->idmedidas->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($medidas_view->altura->Visible) { // altura ?>
	<tr id="r_altura">
		<td class="<?php echo $medidas_view->TableLeftColumnClass ?>"><span id="elh_medidas_altura"><?php echo $medidas_view->altura->caption() ?></span></td>
		<td data-name="altura" <?php echo $medidas_view->altura->cellAttributes() ?>>
<span id="el_medidas_altura">
<span<?php echo $medidas_view->altura->viewAttributes() ?>><?php echo $medidas_view->altura->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($medidas_view->peso->Visible) { // peso ?>
	<tr id="r_peso">
		<td class="<?php echo $medidas_view->TableLeftColumnClass ?>"><span id="elh_medidas_peso"><?php echo $medidas_view->peso->caption() ?></span></td>
		<td data-name="peso" <?php echo $medidas_view->peso->cellAttributes() ?>>
<span id="el_medidas_peso">
<span<?php echo $medidas_view->peso->viewAttributes() ?>><?php echo $medidas_view->peso->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($medidas_view->data_cadastro->Visible) { // data_cadastro ?>
	<tr id="r_data_cadastro">
		<td class="<?php echo $medidas_view->TableLeftColumnClass ?>"><span id="elh_medidas_data_cadastro"><?php echo $medidas_view->data_cadastro->caption() ?></span></td>
		<td data-name="data_cadastro" <?php echo $medidas_view->data_cadastro->cellAttributes() ?>>
<span id="el_medidas_data_cadastro">
<span<?php echo $medidas_view->data_cadastro->viewAttributes() ?>><?php echo $medidas_view->data_cadastro->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($medidas_view->cliente_idcliente->Visible) { // cliente_idcliente ?>
	<tr id="r_cliente_idcliente">
		<td class="<?php echo $medidas_view->TableLeftColumnClass ?>"><span id="elh_medidas_cliente_idcliente"><?php echo $medidas_view->cliente_idcliente->caption() ?></span></td>
		<td data-name="cliente_idcliente" <?php echo $medidas_view->cliente_idcliente->cellAttributes() ?>>
<span id="el_medidas_cliente_idcliente">
<span<?php echo $medidas_view->cliente_idcliente->viewAttributes() ?>><?php echo $medidas_view->cliente_idcliente->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$medidas_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$medidas_view->isExport()) { ?>
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
$medidas_view->terminate();
?>