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
$mensalidade_log_view = new mensalidade_log_view();

// Run the page
$mensalidade_log_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mensalidade_log_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$mensalidade_log_view->isExport()) { ?>
<script>
var fmensalidade_logview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fmensalidade_logview = currentForm = new ew.Form("fmensalidade_logview", "view");
	loadjs.done("fmensalidade_logview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$mensalidade_log_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $mensalidade_log_view->ExportOptions->render("body") ?>
<?php $mensalidade_log_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $mensalidade_log_view->showPageHeader(); ?>
<?php
$mensalidade_log_view->showMessage();
?>
<form name="fmensalidade_logview" id="fmensalidade_logview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mensalidade_log">
<input type="hidden" name="modal" value="<?php echo (int)$mensalidade_log_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($mensalidade_log_view->idmensalidade_log->Visible) { // idmensalidade_log ?>
	<tr id="r_idmensalidade_log">
		<td class="<?php echo $mensalidade_log_view->TableLeftColumnClass ?>"><span id="elh_mensalidade_log_idmensalidade_log"><?php echo $mensalidade_log_view->idmensalidade_log->caption() ?></span></td>
		<td data-name="idmensalidade_log" <?php echo $mensalidade_log_view->idmensalidade_log->cellAttributes() ?>>
<span id="el_mensalidade_log_idmensalidade_log">
<span<?php echo $mensalidade_log_view->idmensalidade_log->viewAttributes() ?>><?php echo $mensalidade_log_view->idmensalidade_log->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mensalidade_log_view->cliente->Visible) { // cliente ?>
	<tr id="r_cliente">
		<td class="<?php echo $mensalidade_log_view->TableLeftColumnClass ?>"><span id="elh_mensalidade_log_cliente"><?php echo $mensalidade_log_view->cliente->caption() ?></span></td>
		<td data-name="cliente" <?php echo $mensalidade_log_view->cliente->cellAttributes() ?>>
<span id="el_mensalidade_log_cliente">
<span<?php echo $mensalidade_log_view->cliente->viewAttributes() ?>><?php echo $mensalidade_log_view->cliente->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mensalidade_log_view->mes->Visible) { // mes ?>
	<tr id="r_mes">
		<td class="<?php echo $mensalidade_log_view->TableLeftColumnClass ?>"><span id="elh_mensalidade_log_mes"><?php echo $mensalidade_log_view->mes->caption() ?></span></td>
		<td data-name="mes" <?php echo $mensalidade_log_view->mes->cellAttributes() ?>>
<span id="el_mensalidade_log_mes">
<span<?php echo $mensalidade_log_view->mes->viewAttributes() ?>><?php echo $mensalidade_log_view->mes->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mensalidade_log_view->valor->Visible) { // valor ?>
	<tr id="r_valor">
		<td class="<?php echo $mensalidade_log_view->TableLeftColumnClass ?>"><span id="elh_mensalidade_log_valor"><?php echo $mensalidade_log_view->valor->caption() ?></span></td>
		<td data-name="valor" <?php echo $mensalidade_log_view->valor->cellAttributes() ?>>
<span id="el_mensalidade_log_valor">
<span<?php echo $mensalidade_log_view->valor->viewAttributes() ?>><?php echo $mensalidade_log_view->valor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mensalidade_log_view->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $mensalidade_log_view->TableLeftColumnClass ?>"><span id="elh_mensalidade_log_status"><?php echo $mensalidade_log_view->status->caption() ?></span></td>
		<td data-name="status" <?php echo $mensalidade_log_view->status->cellAttributes() ?>>
<span id="el_mensalidade_log_status">
<span<?php echo $mensalidade_log_view->status->viewAttributes() ?>><?php echo $mensalidade_log_view->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mensalidade_log_view->data_pagamento->Visible) { // data_pagamento ?>
	<tr id="r_data_pagamento">
		<td class="<?php echo $mensalidade_log_view->TableLeftColumnClass ?>"><span id="elh_mensalidade_log_data_pagamento"><?php echo $mensalidade_log_view->data_pagamento->caption() ?></span></td>
		<td data-name="data_pagamento" <?php echo $mensalidade_log_view->data_pagamento->cellAttributes() ?>>
<span id="el_mensalidade_log_data_pagamento">
<span<?php echo $mensalidade_log_view->data_pagamento->viewAttributes() ?>><?php echo $mensalidade_log_view->data_pagamento->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mensalidade_log_view->acao->Visible) { // acao ?>
	<tr id="r_acao">
		<td class="<?php echo $mensalidade_log_view->TableLeftColumnClass ?>"><span id="elh_mensalidade_log_acao"><?php echo $mensalidade_log_view->acao->caption() ?></span></td>
		<td data-name="acao" <?php echo $mensalidade_log_view->acao->cellAttributes() ?>>
<span id="el_mensalidade_log_acao">
<span<?php echo $mensalidade_log_view->acao->viewAttributes() ?>><?php echo $mensalidade_log_view->acao->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($mensalidade_log_view->data_hora->Visible) { // data_hora ?>
	<tr id="r_data_hora">
		<td class="<?php echo $mensalidade_log_view->TableLeftColumnClass ?>"><span id="elh_mensalidade_log_data_hora"><?php echo $mensalidade_log_view->data_hora->caption() ?></span></td>
		<td data-name="data_hora" <?php echo $mensalidade_log_view->data_hora->cellAttributes() ?>>
<span id="el_mensalidade_log_data_hora">
<span<?php echo $mensalidade_log_view->data_hora->viewAttributes() ?>><?php echo $mensalidade_log_view->data_hora->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$mensalidade_log_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$mensalidade_log_view->isExport()) { ?>
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
$mensalidade_log_view->terminate();
?>