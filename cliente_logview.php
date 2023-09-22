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
$cliente_log_view = new cliente_log_view();

// Run the page
$cliente_log_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cliente_log_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cliente_log_view->isExport()) { ?>
<script>
var fcliente_logview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fcliente_logview = currentForm = new ew.Form("fcliente_logview", "view");
	loadjs.done("fcliente_logview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$cliente_log_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $cliente_log_view->ExportOptions->render("body") ?>
<?php $cliente_log_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $cliente_log_view->showPageHeader(); ?>
<?php
$cliente_log_view->showMessage();
?>
<form name="fcliente_logview" id="fcliente_logview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cliente_log">
<input type="hidden" name="modal" value="<?php echo (int)$cliente_log_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($cliente_log_view->idcliente_log->Visible) { // idcliente_log ?>
	<tr id="r_idcliente_log">
		<td class="<?php echo $cliente_log_view->TableLeftColumnClass ?>"><span id="elh_cliente_log_idcliente_log"><?php echo $cliente_log_view->idcliente_log->caption() ?></span></td>
		<td data-name="idcliente_log" <?php echo $cliente_log_view->idcliente_log->cellAttributes() ?>>
<span id="el_cliente_log_idcliente_log">
<span<?php echo $cliente_log_view->idcliente_log->viewAttributes() ?>><?php echo $cliente_log_view->idcliente_log->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente_log_view->nome->Visible) { // nome ?>
	<tr id="r_nome">
		<td class="<?php echo $cliente_log_view->TableLeftColumnClass ?>"><span id="elh_cliente_log_nome"><?php echo $cliente_log_view->nome->caption() ?></span></td>
		<td data-name="nome" <?php echo $cliente_log_view->nome->cellAttributes() ?>>
<span id="el_cliente_log_nome">
<span<?php echo $cliente_log_view->nome->viewAttributes() ?>><?php echo $cliente_log_view->nome->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente_log_view->data_hora->Visible) { // data_hora ?>
	<tr id="r_data_hora">
		<td class="<?php echo $cliente_log_view->TableLeftColumnClass ?>"><span id="elh_cliente_log_data_hora"><?php echo $cliente_log_view->data_hora->caption() ?></span></td>
		<td data-name="data_hora" <?php echo $cliente_log_view->data_hora->cellAttributes() ?>>
<span id="el_cliente_log_data_hora">
<span<?php echo $cliente_log_view->data_hora->viewAttributes() ?>><?php echo $cliente_log_view->data_hora->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente_log_view->acao->Visible) { // acao ?>
	<tr id="r_acao">
		<td class="<?php echo $cliente_log_view->TableLeftColumnClass ?>"><span id="elh_cliente_log_acao"><?php echo $cliente_log_view->acao->caption() ?></span></td>
		<td data-name="acao" <?php echo $cliente_log_view->acao->cellAttributes() ?>>
<span id="el_cliente_log_acao">
<span<?php echo $cliente_log_view->acao->viewAttributes() ?>><?php echo $cliente_log_view->acao->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente_log_view->foto->Visible) { // foto ?>
	<tr id="r_foto">
		<td class="<?php echo $cliente_log_view->TableLeftColumnClass ?>"><span id="elh_cliente_log_foto"><?php echo $cliente_log_view->foto->caption() ?></span></td>
		<td data-name="foto" <?php echo $cliente_log_view->foto->cellAttributes() ?>>
<span id="el_cliente_log_foto">
<span><?php echo GetFileViewTag($cliente_log_view->foto, $cliente_log_view->foto->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$cliente_log_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cliente_log_view->isExport()) { ?>
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
$cliente_log_view->terminate();
?>