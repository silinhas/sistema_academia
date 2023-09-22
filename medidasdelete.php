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
$medidas_delete = new medidas_delete();

// Run the page
$medidas_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$medidas_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmedidasdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fmedidasdelete = currentForm = new ew.Form("fmedidasdelete", "delete");
	loadjs.done("fmedidasdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $medidas_delete->showPageHeader(); ?>
<?php
$medidas_delete->showMessage();
?>
<form name="fmedidasdelete" id="fmedidasdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="medidas">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($medidas_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($medidas_delete->idmedidas->Visible) { // idmedidas ?>
		<th class="<?php echo $medidas_delete->idmedidas->headerCellClass() ?>"><span id="elh_medidas_idmedidas" class="medidas_idmedidas"><?php echo $medidas_delete->idmedidas->caption() ?></span></th>
<?php } ?>
<?php if ($medidas_delete->altura->Visible) { // altura ?>
		<th class="<?php echo $medidas_delete->altura->headerCellClass() ?>"><span id="elh_medidas_altura" class="medidas_altura"><?php echo $medidas_delete->altura->caption() ?></span></th>
<?php } ?>
<?php if ($medidas_delete->peso->Visible) { // peso ?>
		<th class="<?php echo $medidas_delete->peso->headerCellClass() ?>"><span id="elh_medidas_peso" class="medidas_peso"><?php echo $medidas_delete->peso->caption() ?></span></th>
<?php } ?>
<?php if ($medidas_delete->data_cadastro->Visible) { // data_cadastro ?>
		<th class="<?php echo $medidas_delete->data_cadastro->headerCellClass() ?>"><span id="elh_medidas_data_cadastro" class="medidas_data_cadastro"><?php echo $medidas_delete->data_cadastro->caption() ?></span></th>
<?php } ?>
<?php if ($medidas_delete->cliente_idcliente->Visible) { // cliente_idcliente ?>
		<th class="<?php echo $medidas_delete->cliente_idcliente->headerCellClass() ?>"><span id="elh_medidas_cliente_idcliente" class="medidas_cliente_idcliente"><?php echo $medidas_delete->cliente_idcliente->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$medidas_delete->RecordCount = 0;
$i = 0;
while (!$medidas_delete->Recordset->EOF) {
	$medidas_delete->RecordCount++;
	$medidas_delete->RowCount++;

	// Set row properties
	$medidas->resetAttributes();
	$medidas->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$medidas_delete->loadRowValues($medidas_delete->Recordset);

	// Render row
	$medidas_delete->renderRow();
?>
	<tr <?php echo $medidas->rowAttributes() ?>>
<?php if ($medidas_delete->idmedidas->Visible) { // idmedidas ?>
		<td <?php echo $medidas_delete->idmedidas->cellAttributes() ?>>
<span id="el<?php echo $medidas_delete->RowCount ?>_medidas_idmedidas" class="medidas_idmedidas">
<span<?php echo $medidas_delete->idmedidas->viewAttributes() ?>><?php echo $medidas_delete->idmedidas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($medidas_delete->altura->Visible) { // altura ?>
		<td <?php echo $medidas_delete->altura->cellAttributes() ?>>
<span id="el<?php echo $medidas_delete->RowCount ?>_medidas_altura" class="medidas_altura">
<span<?php echo $medidas_delete->altura->viewAttributes() ?>><?php echo $medidas_delete->altura->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($medidas_delete->peso->Visible) { // peso ?>
		<td <?php echo $medidas_delete->peso->cellAttributes() ?>>
<span id="el<?php echo $medidas_delete->RowCount ?>_medidas_peso" class="medidas_peso">
<span<?php echo $medidas_delete->peso->viewAttributes() ?>><?php echo $medidas_delete->peso->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($medidas_delete->data_cadastro->Visible) { // data_cadastro ?>
		<td <?php echo $medidas_delete->data_cadastro->cellAttributes() ?>>
<span id="el<?php echo $medidas_delete->RowCount ?>_medidas_data_cadastro" class="medidas_data_cadastro">
<span<?php echo $medidas_delete->data_cadastro->viewAttributes() ?>><?php echo $medidas_delete->data_cadastro->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($medidas_delete->cliente_idcliente->Visible) { // cliente_idcliente ?>
		<td <?php echo $medidas_delete->cliente_idcliente->cellAttributes() ?>>
<span id="el<?php echo $medidas_delete->RowCount ?>_medidas_cliente_idcliente" class="medidas_cliente_idcliente">
<span<?php echo $medidas_delete->cliente_idcliente->viewAttributes() ?>><?php echo $medidas_delete->cliente_idcliente->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$medidas_delete->Recordset->moveNext();
}
$medidas_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $medidas_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$medidas_delete->showPageFooter();
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
$medidas_delete->terminate();
?>