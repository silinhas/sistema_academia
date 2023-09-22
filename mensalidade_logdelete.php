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
$mensalidade_log_delete = new mensalidade_log_delete();

// Run the page
$mensalidade_log_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mensalidade_log_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmensalidade_logdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fmensalidade_logdelete = currentForm = new ew.Form("fmensalidade_logdelete", "delete");
	loadjs.done("fmensalidade_logdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $mensalidade_log_delete->showPageHeader(); ?>
<?php
$mensalidade_log_delete->showMessage();
?>
<form name="fmensalidade_logdelete" id="fmensalidade_logdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mensalidade_log">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($mensalidade_log_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($mensalidade_log_delete->idmensalidade_log->Visible) { // idmensalidade_log ?>
		<th class="<?php echo $mensalidade_log_delete->idmensalidade_log->headerCellClass() ?>"><span id="elh_mensalidade_log_idmensalidade_log" class="mensalidade_log_idmensalidade_log"><?php echo $mensalidade_log_delete->idmensalidade_log->caption() ?></span></th>
<?php } ?>
<?php if ($mensalidade_log_delete->cliente->Visible) { // cliente ?>
		<th class="<?php echo $mensalidade_log_delete->cliente->headerCellClass() ?>"><span id="elh_mensalidade_log_cliente" class="mensalidade_log_cliente"><?php echo $mensalidade_log_delete->cliente->caption() ?></span></th>
<?php } ?>
<?php if ($mensalidade_log_delete->mes->Visible) { // mes ?>
		<th class="<?php echo $mensalidade_log_delete->mes->headerCellClass() ?>"><span id="elh_mensalidade_log_mes" class="mensalidade_log_mes"><?php echo $mensalidade_log_delete->mes->caption() ?></span></th>
<?php } ?>
<?php if ($mensalidade_log_delete->valor->Visible) { // valor ?>
		<th class="<?php echo $mensalidade_log_delete->valor->headerCellClass() ?>"><span id="elh_mensalidade_log_valor" class="mensalidade_log_valor"><?php echo $mensalidade_log_delete->valor->caption() ?></span></th>
<?php } ?>
<?php if ($mensalidade_log_delete->status->Visible) { // status ?>
		<th class="<?php echo $mensalidade_log_delete->status->headerCellClass() ?>"><span id="elh_mensalidade_log_status" class="mensalidade_log_status"><?php echo $mensalidade_log_delete->status->caption() ?></span></th>
<?php } ?>
<?php if ($mensalidade_log_delete->data_pagamento->Visible) { // data_pagamento ?>
		<th class="<?php echo $mensalidade_log_delete->data_pagamento->headerCellClass() ?>"><span id="elh_mensalidade_log_data_pagamento" class="mensalidade_log_data_pagamento"><?php echo $mensalidade_log_delete->data_pagamento->caption() ?></span></th>
<?php } ?>
<?php if ($mensalidade_log_delete->acao->Visible) { // acao ?>
		<th class="<?php echo $mensalidade_log_delete->acao->headerCellClass() ?>"><span id="elh_mensalidade_log_acao" class="mensalidade_log_acao"><?php echo $mensalidade_log_delete->acao->caption() ?></span></th>
<?php } ?>
<?php if ($mensalidade_log_delete->data_hora->Visible) { // data_hora ?>
		<th class="<?php echo $mensalidade_log_delete->data_hora->headerCellClass() ?>"><span id="elh_mensalidade_log_data_hora" class="mensalidade_log_data_hora"><?php echo $mensalidade_log_delete->data_hora->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$mensalidade_log_delete->RecordCount = 0;
$i = 0;
while (!$mensalidade_log_delete->Recordset->EOF) {
	$mensalidade_log_delete->RecordCount++;
	$mensalidade_log_delete->RowCount++;

	// Set row properties
	$mensalidade_log->resetAttributes();
	$mensalidade_log->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$mensalidade_log_delete->loadRowValues($mensalidade_log_delete->Recordset);

	// Render row
	$mensalidade_log_delete->renderRow();
?>
	<tr <?php echo $mensalidade_log->rowAttributes() ?>>
<?php if ($mensalidade_log_delete->idmensalidade_log->Visible) { // idmensalidade_log ?>
		<td <?php echo $mensalidade_log_delete->idmensalidade_log->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_log_delete->RowCount ?>_mensalidade_log_idmensalidade_log" class="mensalidade_log_idmensalidade_log">
<span<?php echo $mensalidade_log_delete->idmensalidade_log->viewAttributes() ?>><?php echo $mensalidade_log_delete->idmensalidade_log->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mensalidade_log_delete->cliente->Visible) { // cliente ?>
		<td <?php echo $mensalidade_log_delete->cliente->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_log_delete->RowCount ?>_mensalidade_log_cliente" class="mensalidade_log_cliente">
<span<?php echo $mensalidade_log_delete->cliente->viewAttributes() ?>><?php echo $mensalidade_log_delete->cliente->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mensalidade_log_delete->mes->Visible) { // mes ?>
		<td <?php echo $mensalidade_log_delete->mes->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_log_delete->RowCount ?>_mensalidade_log_mes" class="mensalidade_log_mes">
<span<?php echo $mensalidade_log_delete->mes->viewAttributes() ?>><?php echo $mensalidade_log_delete->mes->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mensalidade_log_delete->valor->Visible) { // valor ?>
		<td <?php echo $mensalidade_log_delete->valor->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_log_delete->RowCount ?>_mensalidade_log_valor" class="mensalidade_log_valor">
<span<?php echo $mensalidade_log_delete->valor->viewAttributes() ?>><?php echo $mensalidade_log_delete->valor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mensalidade_log_delete->status->Visible) { // status ?>
		<td <?php echo $mensalidade_log_delete->status->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_log_delete->RowCount ?>_mensalidade_log_status" class="mensalidade_log_status">
<span<?php echo $mensalidade_log_delete->status->viewAttributes() ?>><?php echo $mensalidade_log_delete->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mensalidade_log_delete->data_pagamento->Visible) { // data_pagamento ?>
		<td <?php echo $mensalidade_log_delete->data_pagamento->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_log_delete->RowCount ?>_mensalidade_log_data_pagamento" class="mensalidade_log_data_pagamento">
<span<?php echo $mensalidade_log_delete->data_pagamento->viewAttributes() ?>><?php echo $mensalidade_log_delete->data_pagamento->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mensalidade_log_delete->acao->Visible) { // acao ?>
		<td <?php echo $mensalidade_log_delete->acao->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_log_delete->RowCount ?>_mensalidade_log_acao" class="mensalidade_log_acao">
<span<?php echo $mensalidade_log_delete->acao->viewAttributes() ?>><?php echo $mensalidade_log_delete->acao->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mensalidade_log_delete->data_hora->Visible) { // data_hora ?>
		<td <?php echo $mensalidade_log_delete->data_hora->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_log_delete->RowCount ?>_mensalidade_log_data_hora" class="mensalidade_log_data_hora">
<span<?php echo $mensalidade_log_delete->data_hora->viewAttributes() ?>><?php echo $mensalidade_log_delete->data_hora->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$mensalidade_log_delete->Recordset->moveNext();
}
$mensalidade_log_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $mensalidade_log_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$mensalidade_log_delete->showPageFooter();
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
$mensalidade_log_delete->terminate();
?>