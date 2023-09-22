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
$agenda_delete = new agenda_delete();

// Run the page
$agenda_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$agenda_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fagendadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fagendadelete = currentForm = new ew.Form("fagendadelete", "delete");
	loadjs.done("fagendadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $agenda_delete->showPageHeader(); ?>
<?php
$agenda_delete->showMessage();
?>
<form name="fagendadelete" id="fagendadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="agenda">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($agenda_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($agenda_delete->idagenda->Visible) { // idagenda ?>
		<th class="<?php echo $agenda_delete->idagenda->headerCellClass() ?>"><span id="elh_agenda_idagenda" class="agenda_idagenda"><?php echo $agenda_delete->idagenda->caption() ?></span></th>
<?php } ?>
<?php if ($agenda_delete->data->Visible) { // data ?>
		<th class="<?php echo $agenda_delete->data->headerCellClass() ?>"><span id="elh_agenda_data" class="agenda_data"><?php echo $agenda_delete->data->caption() ?></span></th>
<?php } ?>
<?php if ($agenda_delete->hora->Visible) { // hora ?>
		<th class="<?php echo $agenda_delete->hora->headerCellClass() ?>"><span id="elh_agenda_hora" class="agenda_hora"><?php echo $agenda_delete->hora->caption() ?></span></th>
<?php } ?>
<?php if ($agenda_delete->descricao->Visible) { // descricao ?>
		<th class="<?php echo $agenda_delete->descricao->headerCellClass() ?>"><span id="elh_agenda_descricao" class="agenda_descricao"><?php echo $agenda_delete->descricao->caption() ?></span></th>
<?php } ?>
<?php if ($agenda_delete->data_now->Visible) { // data_now ?>
		<th class="<?php echo $agenda_delete->data_now->headerCellClass() ?>"><span id="elh_agenda_data_now" class="agenda_data_now"><?php echo $agenda_delete->data_now->caption() ?></span></th>
<?php } ?>
<?php if ($agenda_delete->professor_idprofessor->Visible) { // professor_idprofessor ?>
		<th class="<?php echo $agenda_delete->professor_idprofessor->headerCellClass() ?>"><span id="elh_agenda_professor_idprofessor" class="agenda_professor_idprofessor"><?php echo $agenda_delete->professor_idprofessor->caption() ?></span></th>
<?php } ?>
<?php if ($agenda_delete->cliente_idcliente->Visible) { // cliente_idcliente ?>
		<th class="<?php echo $agenda_delete->cliente_idcliente->headerCellClass() ?>"><span id="elh_agenda_cliente_idcliente" class="agenda_cliente_idcliente"><?php echo $agenda_delete->cliente_idcliente->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$agenda_delete->RecordCount = 0;
$i = 0;
while (!$agenda_delete->Recordset->EOF) {
	$agenda_delete->RecordCount++;
	$agenda_delete->RowCount++;

	// Set row properties
	$agenda->resetAttributes();
	$agenda->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$agenda_delete->loadRowValues($agenda_delete->Recordset);

	// Render row
	$agenda_delete->renderRow();
?>
	<tr <?php echo $agenda->rowAttributes() ?>>
<?php if ($agenda_delete->idagenda->Visible) { // idagenda ?>
		<td <?php echo $agenda_delete->idagenda->cellAttributes() ?>>
<span id="el<?php echo $agenda_delete->RowCount ?>_agenda_idagenda" class="agenda_idagenda">
<span<?php echo $agenda_delete->idagenda->viewAttributes() ?>><?php echo $agenda_delete->idagenda->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($agenda_delete->data->Visible) { // data ?>
		<td <?php echo $agenda_delete->data->cellAttributes() ?>>
<span id="el<?php echo $agenda_delete->RowCount ?>_agenda_data" class="agenda_data">
<span<?php echo $agenda_delete->data->viewAttributes() ?>><?php echo $agenda_delete->data->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($agenda_delete->hora->Visible) { // hora ?>
		<td <?php echo $agenda_delete->hora->cellAttributes() ?>>
<span id="el<?php echo $agenda_delete->RowCount ?>_agenda_hora" class="agenda_hora">
<span<?php echo $agenda_delete->hora->viewAttributes() ?>><?php echo $agenda_delete->hora->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($agenda_delete->descricao->Visible) { // descricao ?>
		<td <?php echo $agenda_delete->descricao->cellAttributes() ?>>
<span id="el<?php echo $agenda_delete->RowCount ?>_agenda_descricao" class="agenda_descricao">
<span<?php echo $agenda_delete->descricao->viewAttributes() ?>><?php echo $agenda_delete->descricao->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($agenda_delete->data_now->Visible) { // data_now ?>
		<td <?php echo $agenda_delete->data_now->cellAttributes() ?>>
<span id="el<?php echo $agenda_delete->RowCount ?>_agenda_data_now" class="agenda_data_now">
<span<?php echo $agenda_delete->data_now->viewAttributes() ?>><?php echo $agenda_delete->data_now->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($agenda_delete->professor_idprofessor->Visible) { // professor_idprofessor ?>
		<td <?php echo $agenda_delete->professor_idprofessor->cellAttributes() ?>>
<span id="el<?php echo $agenda_delete->RowCount ?>_agenda_professor_idprofessor" class="agenda_professor_idprofessor">
<span<?php echo $agenda_delete->professor_idprofessor->viewAttributes() ?>><?php echo $agenda_delete->professor_idprofessor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($agenda_delete->cliente_idcliente->Visible) { // cliente_idcliente ?>
		<td <?php echo $agenda_delete->cliente_idcliente->cellAttributes() ?>>
<span id="el<?php echo $agenda_delete->RowCount ?>_agenda_cliente_idcliente" class="agenda_cliente_idcliente">
<span<?php echo $agenda_delete->cliente_idcliente->viewAttributes() ?>><?php echo $agenda_delete->cliente_idcliente->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$agenda_delete->Recordset->moveNext();
}
$agenda_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $agenda_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$agenda_delete->showPageFooter();
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
$agenda_delete->terminate();
?>