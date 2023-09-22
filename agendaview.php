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
$agenda_view = new agenda_view();

// Run the page
$agenda_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$agenda_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$agenda_view->isExport()) { ?>
<script>
var fagendaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fagendaview = currentForm = new ew.Form("fagendaview", "view");
	loadjs.done("fagendaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$agenda_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $agenda_view->ExportOptions->render("body") ?>
<?php $agenda_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $agenda_view->showPageHeader(); ?>
<?php
$agenda_view->showMessage();
?>
<form name="fagendaview" id="fagendaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="agenda">
<input type="hidden" name="modal" value="<?php echo (int)$agenda_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($agenda_view->idagenda->Visible) { // idagenda ?>
	<tr id="r_idagenda">
		<td class="<?php echo $agenda_view->TableLeftColumnClass ?>"><span id="elh_agenda_idagenda"><?php echo $agenda_view->idagenda->caption() ?></span></td>
		<td data-name="idagenda" <?php echo $agenda_view->idagenda->cellAttributes() ?>>
<span id="el_agenda_idagenda">
<span<?php echo $agenda_view->idagenda->viewAttributes() ?>><?php echo $agenda_view->idagenda->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($agenda_view->data->Visible) { // data ?>
	<tr id="r_data">
		<td class="<?php echo $agenda_view->TableLeftColumnClass ?>"><span id="elh_agenda_data"><?php echo $agenda_view->data->caption() ?></span></td>
		<td data-name="data" <?php echo $agenda_view->data->cellAttributes() ?>>
<span id="el_agenda_data">
<span<?php echo $agenda_view->data->viewAttributes() ?>><?php echo $agenda_view->data->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($agenda_view->hora->Visible) { // hora ?>
	<tr id="r_hora">
		<td class="<?php echo $agenda_view->TableLeftColumnClass ?>"><span id="elh_agenda_hora"><?php echo $agenda_view->hora->caption() ?></span></td>
		<td data-name="hora" <?php echo $agenda_view->hora->cellAttributes() ?>>
<span id="el_agenda_hora">
<span<?php echo $agenda_view->hora->viewAttributes() ?>><?php echo $agenda_view->hora->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($agenda_view->descricao->Visible) { // descricao ?>
	<tr id="r_descricao">
		<td class="<?php echo $agenda_view->TableLeftColumnClass ?>"><span id="elh_agenda_descricao"><?php echo $agenda_view->descricao->caption() ?></span></td>
		<td data-name="descricao" <?php echo $agenda_view->descricao->cellAttributes() ?>>
<span id="el_agenda_descricao">
<span<?php echo $agenda_view->descricao->viewAttributes() ?>><?php echo $agenda_view->descricao->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($agenda_view->data_now->Visible) { // data_now ?>
	<tr id="r_data_now">
		<td class="<?php echo $agenda_view->TableLeftColumnClass ?>"><span id="elh_agenda_data_now"><?php echo $agenda_view->data_now->caption() ?></span></td>
		<td data-name="data_now" <?php echo $agenda_view->data_now->cellAttributes() ?>>
<span id="el_agenda_data_now">
<span<?php echo $agenda_view->data_now->viewAttributes() ?>><?php echo $agenda_view->data_now->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($agenda_view->professor_idprofessor->Visible) { // professor_idprofessor ?>
	<tr id="r_professor_idprofessor">
		<td class="<?php echo $agenda_view->TableLeftColumnClass ?>"><span id="elh_agenda_professor_idprofessor"><?php echo $agenda_view->professor_idprofessor->caption() ?></span></td>
		<td data-name="professor_idprofessor" <?php echo $agenda_view->professor_idprofessor->cellAttributes() ?>>
<span id="el_agenda_professor_idprofessor">
<span<?php echo $agenda_view->professor_idprofessor->viewAttributes() ?>><?php echo $agenda_view->professor_idprofessor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($agenda_view->cliente_idcliente->Visible) { // cliente_idcliente ?>
	<tr id="r_cliente_idcliente">
		<td class="<?php echo $agenda_view->TableLeftColumnClass ?>"><span id="elh_agenda_cliente_idcliente"><?php echo $agenda_view->cliente_idcliente->caption() ?></span></td>
		<td data-name="cliente_idcliente" <?php echo $agenda_view->cliente_idcliente->cellAttributes() ?>>
<span id="el_agenda_cliente_idcliente">
<span<?php echo $agenda_view->cliente_idcliente->viewAttributes() ?>><?php echo $agenda_view->cliente_idcliente->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$agenda_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$agenda_view->isExport()) { ?>
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
$agenda_view->terminate();
?>