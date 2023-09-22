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
$mensalidade_view = new mensalidade_view();

// Run the page
$mensalidade_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mensalidade_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$mensalidade_view->isExport()) { ?>
<script>
var fmensalidadeview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fmensalidadeview = currentForm = new ew.Form("fmensalidadeview", "view");
	loadjs.done("fmensalidadeview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$mensalidade_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $mensalidade_view->ExportOptions->render("body") ?>
<?php $mensalidade_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $mensalidade_view->showPageHeader(); ?>
<?php
$mensalidade_view->showMessage();
?>
<form name="fmensalidadeview" id="fmensalidadeview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mensalidade">
<input type="hidden" name="modal" value="<?php echo (int)$mensalidade_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($mensalidade_view->idmensalidade->Visible) { // idmensalidade ?>
	<tr id="r_idmensalidade">
		<td class="<?php echo $mensalidade_view->TableLeftColumnClass ?>"><span id="elh_mensalidade_idmensalidade"><?php echo $mensalidade_view->idmensalidade->caption() ?></span></td>
		<td data-name="idmensalidade" <?php echo $mensalidade_view->idmensalidade->cellAttributes() ?>>
<span id="el_mensalidade_idmensalidade">
<span<?php echo $mensalidade_view->idmensalidade->viewAttributes() ?>><?php echo $mensalidade_view->idmensalidade->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mensalidade_view->cliente_idcliente->Visible) { // cliente_idcliente ?>
	<tr id="r_cliente_idcliente">
		<td class="<?php echo $mensalidade_view->TableLeftColumnClass ?>"><span id="elh_mensalidade_cliente_idcliente"><?php echo $mensalidade_view->cliente_idcliente->caption() ?></span></td>
		<td data-name="cliente_idcliente" <?php echo $mensalidade_view->cliente_idcliente->cellAttributes() ?>>
<span id="el_mensalidade_cliente_idcliente">
<span<?php echo $mensalidade_view->cliente_idcliente->viewAttributes() ?>><?php echo $mensalidade_view->cliente_idcliente->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mensalidade_view->mes->Visible) { // mes ?>
	<tr id="r_mes">
		<td class="<?php echo $mensalidade_view->TableLeftColumnClass ?>"><span id="elh_mensalidade_mes"><?php echo $mensalidade_view->mes->caption() ?></span></td>
		<td data-name="mes" <?php echo $mensalidade_view->mes->cellAttributes() ?>>
<span id="el_mensalidade_mes">
<span<?php echo $mensalidade_view->mes->viewAttributes() ?>><?php echo $mensalidade_view->mes->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mensalidade_view->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $mensalidade_view->TableLeftColumnClass ?>"><span id="elh_mensalidade_status"><?php echo $mensalidade_view->status->caption() ?></span></td>
		<td data-name="status" <?php echo $mensalidade_view->status->cellAttributes() ?>>
<span id="el_mensalidade_status">
<span<?php echo $mensalidade_view->status->viewAttributes() ?>><?php echo $mensalidade_view->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mensalidade_view->valor->Visible) { // valor ?>
	<tr id="r_valor">
		<td class="<?php echo $mensalidade_view->TableLeftColumnClass ?>"><span id="elh_mensalidade_valor"><?php echo $mensalidade_view->valor->caption() ?></span></td>
		<td data-name="valor" <?php echo $mensalidade_view->valor->cellAttributes() ?>>
<span id="el_mensalidade_valor">
<span<?php echo $mensalidade_view->valor->viewAttributes() ?>><?php echo $mensalidade_view->valor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mensalidade_view->data_pagamento->Visible) { // data_pagamento ?>
	<tr id="r_data_pagamento">
		<td class="<?php echo $mensalidade_view->TableLeftColumnClass ?>"><span id="elh_mensalidade_data_pagamento"><?php echo $mensalidade_view->data_pagamento->caption() ?></span></td>
		<td data-name="data_pagamento" <?php echo $mensalidade_view->data_pagamento->cellAttributes() ?>>
<span id="el_mensalidade_data_pagamento">
<span<?php echo $mensalidade_view->data_pagamento->viewAttributes() ?>><?php echo $mensalidade_view->data_pagamento->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$mensalidade_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$mensalidade_view->isExport()) { ?>
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
$mensalidade_view->terminate();
?>