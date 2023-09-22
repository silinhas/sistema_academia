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
$agenda_log_view = new agenda_log_view();

// Run the page
$agenda_log_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$agenda_log_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$agenda_log_view->isExport()) { ?>
<script>
var fagenda_logview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fagenda_logview = currentForm = new ew.Form("fagenda_logview", "view");
	loadjs.done("fagenda_logview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$agenda_log_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $agenda_log_view->ExportOptions->render("body") ?>
<?php $agenda_log_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $agenda_log_view->showPageHeader(); ?>
<?php
$agenda_log_view->showMessage();
?>
<form name="fagenda_logview" id="fagenda_logview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="agenda_log">
<input type="hidden" name="modal" value="<?php echo (int)$agenda_log_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($agenda_log_view->idagenda_log->Visible) { // idagenda_log ?>
	<tr id="r_idagenda_log">
		<td class="<?php echo $agenda_log_view->TableLeftColumnClass ?>"><span id="elh_agenda_log_idagenda_log"><?php echo $agenda_log_view->idagenda_log->caption() ?></span></td>
		<td data-name="idagenda_log" <?php echo $agenda_log_view->idagenda_log->cellAttributes() ?>>
<span id="el_agenda_log_idagenda_log">
<span<?php echo $agenda_log_view->idagenda_log->viewAttributes() ?>><?php echo $agenda_log_view->idagenda_log->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($agenda_log_view->data->Visible) { // data ?>
	<tr id="r_data">
		<td class="<?php echo $agenda_log_view->TableLeftColumnClass ?>"><span id="elh_agenda_log_data"><?php echo $agenda_log_view->data->caption() ?></span></td>
		<td data-name="data" <?php echo $agenda_log_view->data->cellAttributes() ?>>
<span id="el_agenda_log_data">
<span<?php echo $agenda_log_view->data->viewAttributes() ?>><?php echo $agenda_log_view->data->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($agenda_log_view->hora->Visible) { // hora ?>
	<tr id="r_hora">
		<td class="<?php echo $agenda_log_view->TableLeftColumnClass ?>"><span id="elh_agenda_log_hora"><?php echo $agenda_log_view->hora->caption() ?></span></td>
		<td data-name="hora" <?php echo $agenda_log_view->hora->cellAttributes() ?>>
<span id="el_agenda_log_hora">
<span<?php echo $agenda_log_view->hora->viewAttributes() ?>><?php echo $agenda_log_view->hora->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($agenda_log_view->data_now->Visible) { // data_now ?>
	<tr id="r_data_now">
		<td class="<?php echo $agenda_log_view->TableLeftColumnClass ?>"><span id="elh_agenda_log_data_now"><?php echo $agenda_log_view->data_now->caption() ?></span></td>
		<td data-name="data_now" <?php echo $agenda_log_view->data_now->cellAttributes() ?>>
<span id="el_agenda_log_data_now">
<span<?php echo $agenda_log_view->data_now->viewAttributes() ?>><?php echo $agenda_log_view->data_now->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($agenda_log_view->professor->Visible) { // professor ?>
	<tr id="r_professor">
		<td class="<?php echo $agenda_log_view->TableLeftColumnClass ?>"><span id="elh_agenda_log_professor"><?php echo $agenda_log_view->professor->caption() ?></span></td>
		<td data-name="professor" <?php echo $agenda_log_view->professor->cellAttributes() ?>>
<span id="el_agenda_log_professor">
<span<?php echo $agenda_log_view->professor->viewAttributes() ?>><?php echo $agenda_log_view->professor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($agenda_log_view->cliente->Visible) { // cliente ?>
	<tr id="r_cliente">
		<td class="<?php echo $agenda_log_view->TableLeftColumnClass ?>"><span id="elh_agenda_log_cliente"><?php echo $agenda_log_view->cliente->caption() ?></span></td>
		<td data-name="cliente" <?php echo $agenda_log_view->cliente->cellAttributes() ?>>
<span id="el_agenda_log_cliente">
<span<?php echo $agenda_log_view->cliente->viewAttributes() ?>><?php echo $agenda_log_view->cliente->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($agenda_log_view->acao->Visible) { // acao ?>
	<tr id="r_acao">
		<td class="<?php echo $agenda_log_view->TableLeftColumnClass ?>"><span id="elh_agenda_log_acao"><?php echo $agenda_log_view->acao->caption() ?></span></td>
		<td data-name="acao" <?php echo $agenda_log_view->acao->cellAttributes() ?>>
<span id="el_agenda_log_acao">
<span<?php echo $agenda_log_view->acao->viewAttributes() ?>><?php echo $agenda_log_view->acao->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($agenda_log_view->data_hora->Visible) { // data_hora ?>
	<tr id="r_data_hora">
		<td class="<?php echo $agenda_log_view->TableLeftColumnClass ?>"><span id="elh_agenda_log_data_hora"><?php echo $agenda_log_view->data_hora->caption() ?></span></td>
		<td data-name="data_hora" <?php echo $agenda_log_view->data_hora->cellAttributes() ?>>
<span id="el_agenda_log_data_hora">
<span<?php echo $agenda_log_view->data_hora->viewAttributes() ?>><?php echo $agenda_log_view->data_hora->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$agenda_log_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$agenda_log_view->isExport()) { ?>
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
$agenda_log_view->terminate();
?>