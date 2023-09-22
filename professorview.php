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
$professor_view = new professor_view();

// Run the page
$professor_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$professor_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$professor_view->isExport()) { ?>
<script>
var fprofessorview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fprofessorview = currentForm = new ew.Form("fprofessorview", "view");
	loadjs.done("fprofessorview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$professor_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $professor_view->ExportOptions->render("body") ?>
<?php $professor_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $professor_view->showPageHeader(); ?>
<?php
$professor_view->showMessage();
?>
<form name="fprofessorview" id="fprofessorview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="professor">
<input type="hidden" name="modal" value="<?php echo (int)$professor_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($professor_view->idprofessor->Visible) { // idprofessor ?>
	<tr id="r_idprofessor">
		<td class="<?php echo $professor_view->TableLeftColumnClass ?>"><span id="elh_professor_idprofessor"><?php echo $professor_view->idprofessor->caption() ?></span></td>
		<td data-name="idprofessor" <?php echo $professor_view->idprofessor->cellAttributes() ?>>
<span id="el_professor_idprofessor">
<span<?php echo $professor_view->idprofessor->viewAttributes() ?>><?php echo $professor_view->idprofessor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($professor_view->nome_professor->Visible) { // nome_professor ?>
	<tr id="r_nome_professor">
		<td class="<?php echo $professor_view->TableLeftColumnClass ?>"><span id="elh_professor_nome_professor"><?php echo $professor_view->nome_professor->caption() ?></span></td>
		<td data-name="nome_professor" <?php echo $professor_view->nome_professor->cellAttributes() ?>>
<span id="el_professor_nome_professor">
<span<?php echo $professor_view->nome_professor->viewAttributes() ?>><?php echo $professor_view->nome_professor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($professor_view->cpf->Visible) { // cpf ?>
	<tr id="r_cpf">
		<td class="<?php echo $professor_view->TableLeftColumnClass ?>"><span id="elh_professor_cpf"><?php echo $professor_view->cpf->caption() ?></span></td>
		<td data-name="cpf" <?php echo $professor_view->cpf->cellAttributes() ?>>
<span id="el_professor_cpf">
<span<?php echo $professor_view->cpf->viewAttributes() ?>><?php echo $professor_view->cpf->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($professor_view->nascimento->Visible) { // nascimento ?>
	<tr id="r_nascimento">
		<td class="<?php echo $professor_view->TableLeftColumnClass ?>"><span id="elh_professor_nascimento"><?php echo $professor_view->nascimento->caption() ?></span></td>
		<td data-name="nascimento" <?php echo $professor_view->nascimento->cellAttributes() ?>>
<span id="el_professor_nascimento">
<span<?php echo $professor_view->nascimento->viewAttributes() ?>><?php echo $professor_view->nascimento->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($professor_view->sexo->Visible) { // sexo ?>
	<tr id="r_sexo">
		<td class="<?php echo $professor_view->TableLeftColumnClass ?>"><span id="elh_professor_sexo"><?php echo $professor_view->sexo->caption() ?></span></td>
		<td data-name="sexo" <?php echo $professor_view->sexo->cellAttributes() ?>>
<span id="el_professor_sexo">
<span<?php echo $professor_view->sexo->viewAttributes() ?>><?php echo $professor_view->sexo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($professor_view->fone->Visible) { // fone ?>
	<tr id="r_fone">
		<td class="<?php echo $professor_view->TableLeftColumnClass ?>"><span id="elh_professor_fone"><?php echo $professor_view->fone->caption() ?></span></td>
		<td data-name="fone" <?php echo $professor_view->fone->cellAttributes() ?>>
<span id="el_professor_fone">
<span<?php echo $professor_view->fone->viewAttributes() ?>><?php echo $professor_view->fone->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($professor_view->foto->Visible) { // foto ?>
	<tr id="r_foto">
		<td class="<?php echo $professor_view->TableLeftColumnClass ?>"><span id="elh_professor_foto"><?php echo $professor_view->foto->caption() ?></span></td>
		<td data-name="foto" <?php echo $professor_view->foto->cellAttributes() ?>>
<span id="el_professor_foto">
<span><?php echo GetFileViewTag($professor_view->foto, $professor_view->foto->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$professor_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$professor_view->isExport()) { ?>
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
$professor_view->terminate();
?>