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
$mensalidade_delete = new mensalidade_delete();

// Run the page
$mensalidade_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mensalidade_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmensalidadedelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fmensalidadedelete = currentForm = new ew.Form("fmensalidadedelete", "delete");
	loadjs.done("fmensalidadedelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $mensalidade_delete->showPageHeader(); ?>
<?php
$mensalidade_delete->showMessage();
?>
<form name="fmensalidadedelete" id="fmensalidadedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mensalidade">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($mensalidade_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($mensalidade_delete->idmensalidade->Visible) { // idmensalidade ?>
		<th class="<?php echo $mensalidade_delete->idmensalidade->headerCellClass() ?>"><span id="elh_mensalidade_idmensalidade" class="mensalidade_idmensalidade"><?php echo $mensalidade_delete->idmensalidade->caption() ?></span></th>
<?php } ?>
<?php if ($mensalidade_delete->cliente_idcliente->Visible) { // cliente_idcliente ?>
		<th class="<?php echo $mensalidade_delete->cliente_idcliente->headerCellClass() ?>"><span id="elh_mensalidade_cliente_idcliente" class="mensalidade_cliente_idcliente"><?php echo $mensalidade_delete->cliente_idcliente->caption() ?></span></th>
<?php } ?>
<?php if ($mensalidade_delete->mes->Visible) { // mes ?>
		<th class="<?php echo $mensalidade_delete->mes->headerCellClass() ?>"><span id="elh_mensalidade_mes" class="mensalidade_mes"><?php echo $mensalidade_delete->mes->caption() ?></span></th>
<?php } ?>
<?php if ($mensalidade_delete->status->Visible) { // status ?>
		<th class="<?php echo $mensalidade_delete->status->headerCellClass() ?>"><span id="elh_mensalidade_status" class="mensalidade_status"><?php echo $mensalidade_delete->status->caption() ?></span></th>
<?php } ?>
<?php if ($mensalidade_delete->valor->Visible) { // valor ?>
		<th class="<?php echo $mensalidade_delete->valor->headerCellClass() ?>"><span id="elh_mensalidade_valor" class="mensalidade_valor"><?php echo $mensalidade_delete->valor->caption() ?></span></th>
<?php } ?>
<?php if ($mensalidade_delete->data_pagamento->Visible) { // data_pagamento ?>
		<th class="<?php echo $mensalidade_delete->data_pagamento->headerCellClass() ?>"><span id="elh_mensalidade_data_pagamento" class="mensalidade_data_pagamento"><?php echo $mensalidade_delete->data_pagamento->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$mensalidade_delete->RecordCount = 0;
$i = 0;
while (!$mensalidade_delete->Recordset->EOF) {
	$mensalidade_delete->RecordCount++;
	$mensalidade_delete->RowCount++;

	// Set row properties
	$mensalidade->resetAttributes();
	$mensalidade->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$mensalidade_delete->loadRowValues($mensalidade_delete->Recordset);

	// Render row
	$mensalidade_delete->renderRow();
?>
	<tr <?php echo $mensalidade->rowAttributes() ?>>
<?php if ($mensalidade_delete->idmensalidade->Visible) { // idmensalidade ?>
		<td <?php echo $mensalidade_delete->idmensalidade->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_delete->RowCount ?>_mensalidade_idmensalidade" class="mensalidade_idmensalidade">
<span<?php echo $mensalidade_delete->idmensalidade->viewAttributes() ?>><?php echo $mensalidade_delete->idmensalidade->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mensalidade_delete->cliente_idcliente->Visible) { // cliente_idcliente ?>
		<td <?php echo $mensalidade_delete->cliente_idcliente->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_delete->RowCount ?>_mensalidade_cliente_idcliente" class="mensalidade_cliente_idcliente">
<span<?php echo $mensalidade_delete->cliente_idcliente->viewAttributes() ?>><?php echo $mensalidade_delete->cliente_idcliente->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mensalidade_delete->mes->Visible) { // mes ?>
		<td <?php echo $mensalidade_delete->mes->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_delete->RowCount ?>_mensalidade_mes" class="mensalidade_mes">
<span<?php echo $mensalidade_delete->mes->viewAttributes() ?>><?php echo $mensalidade_delete->mes->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mensalidade_delete->status->Visible) { // status ?>
		<td <?php echo $mensalidade_delete->status->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_delete->RowCount ?>_mensalidade_status" class="mensalidade_status">
<span<?php echo $mensalidade_delete->status->viewAttributes() ?>><?php echo $mensalidade_delete->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mensalidade_delete->valor->Visible) { // valor ?>
		<td <?php echo $mensalidade_delete->valor->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_delete->RowCount ?>_mensalidade_valor" class="mensalidade_valor">
<span<?php echo $mensalidade_delete->valor->viewAttributes() ?>><?php echo $mensalidade_delete->valor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($mensalidade_delete->data_pagamento->Visible) { // data_pagamento ?>
		<td <?php echo $mensalidade_delete->data_pagamento->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_delete->RowCount ?>_mensalidade_data_pagamento" class="mensalidade_data_pagamento">
<span<?php echo $mensalidade_delete->data_pagamento->viewAttributes() ?>><?php echo $mensalidade_delete->data_pagamento->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$mensalidade_delete->Recordset->moveNext();
}
$mensalidade_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $mensalidade_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$mensalidade_delete->showPageFooter();
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
$mensalidade_delete->terminate();
?>