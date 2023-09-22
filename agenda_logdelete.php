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
$agenda_log_delete = new agenda_log_delete();

// Run the page
$agenda_log_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$agenda_log_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fagenda_logdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fagenda_logdelete = currentForm = new ew.Form("fagenda_logdelete", "delete");
	loadjs.done("fagenda_logdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $agenda_log_delete->showPageHeader(); ?>
<?php
$agenda_log_delete->showMessage();
?>
<form name="fagenda_logdelete" id="fagenda_logdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="agenda_log">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($agenda_log_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($agenda_log_delete->idagenda_log->Visible) { // idagenda_log ?>
		<th class="<?php echo $agenda_log_delete->idagenda_log->headerCellClass() ?>"><span id="elh_agenda_log_idagenda_log" class="agenda_log_idagenda_log"><?php echo $agenda_log_delete->idagenda_log->caption() ?></span></th>
<?php } ?>
<?php if ($agenda_log_delete->data->Visible) { // data ?>
		<th class="<?php echo $agenda_log_delete->data->headerCellClass() ?>"><span id="elh_agenda_log_data" class="agenda_log_data"><?php echo $agenda_log_delete->data->caption() ?></span></th>
<?php } ?>
<?php if ($agenda_log_delete->hora->Visible) { // hora ?>
		<th class="<?php echo $agenda_log_delete->hora->headerCellClass() ?>"><span id="elh_agenda_log_hora" class="agenda_log_hora"><?php echo $agenda_log_delete->hora->caption() ?></span></th>
<?php } ?>
<?php if ($agenda_log_delete->data_now->Visible) { // data_now ?>
		<th class="<?php echo $agenda_log_delete->data_now->headerCellClass() ?>"><span id="elh_agenda_log_data_now" class="agenda_log_data_now"><?php echo $agenda_log_delete->data_now->caption() ?></span></th>
<?php } ?>
<?php if ($agenda_log_delete->professor->Visible) { // professor ?>
		<th class="<?php echo $agenda_log_delete->professor->headerCellClass() ?>"><span id="elh_agenda_log_professor" class="agenda_log_professor"><?php echo $agenda_log_delete->professor->caption() ?></span></th>
<?php } ?>
<?php if ($agenda_log_delete->cliente->Visible) { // cliente ?>
		<th class="<?php echo $agenda_log_delete->cliente->headerCellClass() ?>"><span id="elh_agenda_log_cliente" class="agenda_log_cliente"><?php echo $agenda_log_delete->cliente->caption() ?></span></th>
<?php } ?>
<?php if ($agenda_log_delete->acao->Visible) { // acao ?>
		<th class="<?php echo $agenda_log_delete->acao->headerCellClass() ?>"><span id="elh_agenda_log_acao" class="agenda_log_acao"><?php echo $agenda_log_delete->acao->caption() ?></span></th>
<?php } ?>
<?php if ($agenda_log_delete->data_hora->Visible) { // data_hora ?>
		<th class="<?php echo $agenda_log_delete->data_hora->headerCellClass() ?>"><span id="elh_agenda_log_data_hora" class="agenda_log_data_hora"><?php echo $agenda_log_delete->data_hora->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$agenda_log_delete->RecordCount = 0;
$i = 0;
while (!$agenda_log_delete->Recordset->EOF) {
	$agenda_log_delete->RecordCount++;
	$agenda_log_delete->RowCount++;

	// Set row properties
	$agenda_log->resetAttributes();
	$agenda_log->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$agenda_log_delete->loadRowValues($agenda_log_delete->Recordset);

	// Render row
	$agenda_log_delete->renderRow();
?>
	<tr <?php echo $agenda_log->rowAttributes() ?>>
<?php if ($agenda_log_delete->idagenda_log->Visible) { // idagenda_log ?>
		<td <?php echo $agenda_log_delete->idagenda_log->cellAttributes() ?>>
<span id="el<?php echo $agenda_log_delete->RowCount ?>_agenda_log_idagenda_log" class="agenda_log_idagenda_log">
<span<?php echo $agenda_log_delete->idagenda_log->viewAttributes() ?>><?php echo $agenda_log_delete->idagenda_log->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($agenda_log_delete->data->Visible) { // data ?>
		<td <?php echo $agenda_log_delete->data->cellAttributes() ?>>
<span id="el<?php echo $agenda_log_delete->RowCount ?>_agenda_log_data" class="agenda_log_data">
<span<?php echo $agenda_log_delete->data->viewAttributes() ?>><?php echo $agenda_log_delete->data->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($agenda_log_delete->hora->Visible) { // hora ?>
		<td <?php echo $agenda_log_delete->hora->cellAttributes() ?>>
<span id="el<?php echo $agenda_log_delete->RowCount ?>_agenda_log_hora" class="agenda_log_hora">
<span<?php echo $agenda_log_delete->hora->viewAttributes() ?>><?php echo $agenda_log_delete->hora->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($agenda_log_delete->data_now->Visible) { // data_now ?>
		<td <?php echo $agenda_log_delete->data_now->cellAttributes() ?>>
<span id="el<?php echo $agenda_log_delete->RowCount ?>_agenda_log_data_now" class="agenda_log_data_now">
<span<?php echo $agenda_log_delete->data_now->viewAttributes() ?>><?php echo $agenda_log_delete->data_now->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($agenda_log_delete->professor->Visible) { // professor ?>
		<td <?php echo $agenda_log_delete->professor->cellAttributes() ?>>
<span id="el<?php echo $agenda_log_delete->RowCount ?>_agenda_log_professor" class="agenda_log_professor">
<span<?php echo $agenda_log_delete->professor->viewAttributes() ?>><?php echo $agenda_log_delete->professor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($agenda_log_delete->cliente->Visible) { // cliente ?>
		<td <?php echo $agenda_log_delete->cliente->cellAttributes() ?>>
<span id="el<?php echo $agenda_log_delete->RowCount ?>_agenda_log_cliente" class="agenda_log_cliente">
<span<?php echo $agenda_log_delete->cliente->viewAttributes() ?>><?php echo $agenda_log_delete->cliente->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($agenda_log_delete->acao->Visible) { // acao ?>
		<td <?php echo $agenda_log_delete->acao->cellAttributes() ?>>
<span id="el<?php echo $agenda_log_delete->RowCount ?>_agenda_log_acao" class="agenda_log_acao">
<span<?php echo $agenda_log_delete->acao->viewAttributes() ?>><?php echo $agenda_log_delete->acao->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($agenda_log_delete->data_hora->Visible) { // data_hora ?>
		<td <?php echo $agenda_log_delete->data_hora->cellAttributes() ?>>
<span id="el<?php echo $agenda_log_delete->RowCount ?>_agenda_log_data_hora" class="agenda_log_data_hora">
<span<?php echo $agenda_log_delete->data_hora->viewAttributes() ?>><?php echo $agenda_log_delete->data_hora->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$agenda_log_delete->Recordset->moveNext();
}
$agenda_log_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $agenda_log_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$agenda_log_delete->showPageFooter();
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
$agenda_log_delete->terminate();
?>