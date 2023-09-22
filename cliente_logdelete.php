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
$cliente_log_delete = new cliente_log_delete();

// Run the page
$cliente_log_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cliente_log_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcliente_logdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fcliente_logdelete = currentForm = new ew.Form("fcliente_logdelete", "delete");
	loadjs.done("fcliente_logdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cliente_log_delete->showPageHeader(); ?>
<?php
$cliente_log_delete->showMessage();
?>
<form name="fcliente_logdelete" id="fcliente_logdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cliente_log">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($cliente_log_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($cliente_log_delete->idcliente_log->Visible) { // idcliente_log ?>
		<th class="<?php echo $cliente_log_delete->idcliente_log->headerCellClass() ?>"><span id="elh_cliente_log_idcliente_log" class="cliente_log_idcliente_log"><?php echo $cliente_log_delete->idcliente_log->caption() ?></span></th>
<?php } ?>
<?php if ($cliente_log_delete->nome->Visible) { // nome ?>
		<th class="<?php echo $cliente_log_delete->nome->headerCellClass() ?>"><span id="elh_cliente_log_nome" class="cliente_log_nome"><?php echo $cliente_log_delete->nome->caption() ?></span></th>
<?php } ?>
<?php if ($cliente_log_delete->data_hora->Visible) { // data_hora ?>
		<th class="<?php echo $cliente_log_delete->data_hora->headerCellClass() ?>"><span id="elh_cliente_log_data_hora" class="cliente_log_data_hora"><?php echo $cliente_log_delete->data_hora->caption() ?></span></th>
<?php } ?>
<?php if ($cliente_log_delete->acao->Visible) { // acao ?>
		<th class="<?php echo $cliente_log_delete->acao->headerCellClass() ?>"><span id="elh_cliente_log_acao" class="cliente_log_acao"><?php echo $cliente_log_delete->acao->caption() ?></span></th>
<?php } ?>
<?php if ($cliente_log_delete->foto->Visible) { // foto ?>
		<th class="<?php echo $cliente_log_delete->foto->headerCellClass() ?>"><span id="elh_cliente_log_foto" class="cliente_log_foto"><?php echo $cliente_log_delete->foto->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$cliente_log_delete->RecordCount = 0;
$i = 0;
while (!$cliente_log_delete->Recordset->EOF) {
	$cliente_log_delete->RecordCount++;
	$cliente_log_delete->RowCount++;

	// Set row properties
	$cliente_log->resetAttributes();
	$cliente_log->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$cliente_log_delete->loadRowValues($cliente_log_delete->Recordset);

	// Render row
	$cliente_log_delete->renderRow();
?>
	<tr <?php echo $cliente_log->rowAttributes() ?>>
<?php if ($cliente_log_delete->idcliente_log->Visible) { // idcliente_log ?>
		<td <?php echo $cliente_log_delete->idcliente_log->cellAttributes() ?>>
<span id="el<?php echo $cliente_log_delete->RowCount ?>_cliente_log_idcliente_log" class="cliente_log_idcliente_log">
<span<?php echo $cliente_log_delete->idcliente_log->viewAttributes() ?>><?php echo $cliente_log_delete->idcliente_log->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente_log_delete->nome->Visible) { // nome ?>
		<td <?php echo $cliente_log_delete->nome->cellAttributes() ?>>
<span id="el<?php echo $cliente_log_delete->RowCount ?>_cliente_log_nome" class="cliente_log_nome">
<span<?php echo $cliente_log_delete->nome->viewAttributes() ?>><?php echo $cliente_log_delete->nome->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente_log_delete->data_hora->Visible) { // data_hora ?>
		<td <?php echo $cliente_log_delete->data_hora->cellAttributes() ?>>
<span id="el<?php echo $cliente_log_delete->RowCount ?>_cliente_log_data_hora" class="cliente_log_data_hora">
<span<?php echo $cliente_log_delete->data_hora->viewAttributes() ?>><?php echo $cliente_log_delete->data_hora->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente_log_delete->acao->Visible) { // acao ?>
		<td <?php echo $cliente_log_delete->acao->cellAttributes() ?>>
<span id="el<?php echo $cliente_log_delete->RowCount ?>_cliente_log_acao" class="cliente_log_acao">
<span<?php echo $cliente_log_delete->acao->viewAttributes() ?>><?php echo $cliente_log_delete->acao->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente_log_delete->foto->Visible) { // foto ?>
		<td <?php echo $cliente_log_delete->foto->cellAttributes() ?>>
<span id="el<?php echo $cliente_log_delete->RowCount ?>_cliente_log_foto" class="cliente_log_foto">
<span><?php echo GetFileViewTag($cliente_log_delete->foto, $cliente_log_delete->foto->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$cliente_log_delete->Recordset->moveNext();
}
$cliente_log_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cliente_log_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$cliente_log_delete->showPageFooter();
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
$cliente_log_delete->terminate();
?>