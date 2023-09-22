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
$usuario_view = new usuario_view();

// Run the page
$usuario_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuario_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$usuario_view->isExport()) { ?>
<script>
var fusuarioview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fusuarioview = currentForm = new ew.Form("fusuarioview", "view");
	loadjs.done("fusuarioview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$usuario_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $usuario_view->ExportOptions->render("body") ?>
<?php $usuario_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $usuario_view->showPageHeader(); ?>
<?php
$usuario_view->showMessage();
?>
<form name="fusuarioview" id="fusuarioview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuario">
<input type="hidden" name="modal" value="<?php echo (int)$usuario_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($usuario_view->idusuario->Visible) { // idusuario ?>
	<tr id="r_idusuario">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_idusuario"><?php echo $usuario_view->idusuario->caption() ?></span></td>
		<td data-name="idusuario" <?php echo $usuario_view->idusuario->cellAttributes() ?>>
<span id="el_usuario_idusuario">
<span<?php echo $usuario_view->idusuario->viewAttributes() ?>><?php echo $usuario_view->idusuario->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario_view->nome->Visible) { // nome ?>
	<tr id="r_nome">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_nome"><?php echo $usuario_view->nome->caption() ?></span></td>
		<td data-name="nome" <?php echo $usuario_view->nome->cellAttributes() ?>>
<span id="el_usuario_nome">
<span<?php echo $usuario_view->nome->viewAttributes() ?>><?php echo $usuario_view->nome->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario_view->_login->Visible) { // login ?>
	<tr id="r__login">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario__login"><?php echo $usuario_view->_login->caption() ?></span></td>
		<td data-name="_login" <?php echo $usuario_view->_login->cellAttributes() ?>>
<span id="el_usuario__login">
<span<?php echo $usuario_view->_login->viewAttributes() ?>><?php echo $usuario_view->_login->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario_view->senha->Visible) { // senha ?>
	<tr id="r_senha">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_senha"><?php echo $usuario_view->senha->caption() ?></span></td>
		<td data-name="senha" <?php echo $usuario_view->senha->cellAttributes() ?>>
<span id="el_usuario_senha">
<span<?php echo $usuario_view->senha->viewAttributes() ?>><?php echo $usuario_view->senha->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario_view->userlevel_id->Visible) { // userlevel_id ?>
	<tr id="r_userlevel_id">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_userlevel_id"><?php echo $usuario_view->userlevel_id->caption() ?></span></td>
		<td data-name="userlevel_id" <?php echo $usuario_view->userlevel_id->cellAttributes() ?>>
<span id="el_usuario_userlevel_id">
<span<?php echo $usuario_view->userlevel_id->viewAttributes() ?>><?php echo $usuario_view->userlevel_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario_view->foto->Visible) { // foto ?>
	<tr id="r_foto">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_foto"><?php echo $usuario_view->foto->caption() ?></span></td>
		<td data-name="foto" <?php echo $usuario_view->foto->cellAttributes() ?>>
<span id="el_usuario_foto">
<span><?php echo GetFileViewTag($usuario_view->foto, $usuario_view->foto->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$usuario_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$usuario_view->isExport()) { ?>
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
$usuario_view->terminate();
?>