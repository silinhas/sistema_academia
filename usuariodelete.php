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
$usuario_delete = new usuario_delete();

// Run the page
$usuario_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuario_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fusuariodelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fusuariodelete = currentForm = new ew.Form("fusuariodelete", "delete");
	loadjs.done("fusuariodelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $usuario_delete->showPageHeader(); ?>
<?php
$usuario_delete->showMessage();
?>
<form name="fusuariodelete" id="fusuariodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuario">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($usuario_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($usuario_delete->idusuario->Visible) { // idusuario ?>
		<th class="<?php echo $usuario_delete->idusuario->headerCellClass() ?>"><span id="elh_usuario_idusuario" class="usuario_idusuario"><?php echo $usuario_delete->idusuario->caption() ?></span></th>
<?php } ?>
<?php if ($usuario_delete->nome->Visible) { // nome ?>
		<th class="<?php echo $usuario_delete->nome->headerCellClass() ?>"><span id="elh_usuario_nome" class="usuario_nome"><?php echo $usuario_delete->nome->caption() ?></span></th>
<?php } ?>
<?php if ($usuario_delete->_login->Visible) { // login ?>
		<th class="<?php echo $usuario_delete->_login->headerCellClass() ?>"><span id="elh_usuario__login" class="usuario__login"><?php echo $usuario_delete->_login->caption() ?></span></th>
<?php } ?>
<?php if ($usuario_delete->senha->Visible) { // senha ?>
		<th class="<?php echo $usuario_delete->senha->headerCellClass() ?>"><span id="elh_usuario_senha" class="usuario_senha"><?php echo $usuario_delete->senha->caption() ?></span></th>
<?php } ?>
<?php if ($usuario_delete->userlevel_id->Visible) { // userlevel_id ?>
		<th class="<?php echo $usuario_delete->userlevel_id->headerCellClass() ?>"><span id="elh_usuario_userlevel_id" class="usuario_userlevel_id"><?php echo $usuario_delete->userlevel_id->caption() ?></span></th>
<?php } ?>
<?php if ($usuario_delete->foto->Visible) { // foto ?>
		<th class="<?php echo $usuario_delete->foto->headerCellClass() ?>"><span id="elh_usuario_foto" class="usuario_foto"><?php echo $usuario_delete->foto->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$usuario_delete->RecordCount = 0;
$i = 0;
while (!$usuario_delete->Recordset->EOF) {
	$usuario_delete->RecordCount++;
	$usuario_delete->RowCount++;

	// Set row properties
	$usuario->resetAttributes();
	$usuario->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$usuario_delete->loadRowValues($usuario_delete->Recordset);

	// Render row
	$usuario_delete->renderRow();
?>
	<tr <?php echo $usuario->rowAttributes() ?>>
<?php if ($usuario_delete->idusuario->Visible) { // idusuario ?>
		<td <?php echo $usuario_delete->idusuario->cellAttributes() ?>>
<span id="el<?php echo $usuario_delete->RowCount ?>_usuario_idusuario" class="usuario_idusuario">
<span<?php echo $usuario_delete->idusuario->viewAttributes() ?>><?php echo $usuario_delete->idusuario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuario_delete->nome->Visible) { // nome ?>
		<td <?php echo $usuario_delete->nome->cellAttributes() ?>>
<span id="el<?php echo $usuario_delete->RowCount ?>_usuario_nome" class="usuario_nome">
<span<?php echo $usuario_delete->nome->viewAttributes() ?>><?php echo $usuario_delete->nome->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuario_delete->_login->Visible) { // login ?>
		<td <?php echo $usuario_delete->_login->cellAttributes() ?>>
<span id="el<?php echo $usuario_delete->RowCount ?>_usuario__login" class="usuario__login">
<span<?php echo $usuario_delete->_login->viewAttributes() ?>><?php echo $usuario_delete->_login->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuario_delete->senha->Visible) { // senha ?>
		<td <?php echo $usuario_delete->senha->cellAttributes() ?>>
<span id="el<?php echo $usuario_delete->RowCount ?>_usuario_senha" class="usuario_senha">
<span<?php echo $usuario_delete->senha->viewAttributes() ?>><?php echo $usuario_delete->senha->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuario_delete->userlevel_id->Visible) { // userlevel_id ?>
		<td <?php echo $usuario_delete->userlevel_id->cellAttributes() ?>>
<span id="el<?php echo $usuario_delete->RowCount ?>_usuario_userlevel_id" class="usuario_userlevel_id">
<span<?php echo $usuario_delete->userlevel_id->viewAttributes() ?>><?php echo $usuario_delete->userlevel_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($usuario_delete->foto->Visible) { // foto ?>
		<td <?php echo $usuario_delete->foto->cellAttributes() ?>>
<span id="el<?php echo $usuario_delete->RowCount ?>_usuario_foto" class="usuario_foto">
<span><?php echo GetFileViewTag($usuario_delete->foto, $usuario_delete->foto->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$usuario_delete->Recordset->moveNext();
}
$usuario_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $usuario_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$usuario_delete->showPageFooter();
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
$usuario_delete->terminate();
?>