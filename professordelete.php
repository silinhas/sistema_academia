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
$professor_delete = new professor_delete();

// Run the page
$professor_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$professor_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fprofessordelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fprofessordelete = currentForm = new ew.Form("fprofessordelete", "delete");
	loadjs.done("fprofessordelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $professor_delete->showPageHeader(); ?>
<?php
$professor_delete->showMessage();
?>
<form name="fprofessordelete" id="fprofessordelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="professor">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($professor_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($professor_delete->idprofessor->Visible) { // idprofessor ?>
		<th class="<?php echo $professor_delete->idprofessor->headerCellClass() ?>"><span id="elh_professor_idprofessor" class="professor_idprofessor"><?php echo $professor_delete->idprofessor->caption() ?></span></th>
<?php } ?>
<?php if ($professor_delete->nome_professor->Visible) { // nome_professor ?>
		<th class="<?php echo $professor_delete->nome_professor->headerCellClass() ?>"><span id="elh_professor_nome_professor" class="professor_nome_professor"><?php echo $professor_delete->nome_professor->caption() ?></span></th>
<?php } ?>
<?php if ($professor_delete->cpf->Visible) { // cpf ?>
		<th class="<?php echo $professor_delete->cpf->headerCellClass() ?>"><span id="elh_professor_cpf" class="professor_cpf"><?php echo $professor_delete->cpf->caption() ?></span></th>
<?php } ?>
<?php if ($professor_delete->nascimento->Visible) { // nascimento ?>
		<th class="<?php echo $professor_delete->nascimento->headerCellClass() ?>"><span id="elh_professor_nascimento" class="professor_nascimento"><?php echo $professor_delete->nascimento->caption() ?></span></th>
<?php } ?>
<?php if ($professor_delete->sexo->Visible) { // sexo ?>
		<th class="<?php echo $professor_delete->sexo->headerCellClass() ?>"><span id="elh_professor_sexo" class="professor_sexo"><?php echo $professor_delete->sexo->caption() ?></span></th>
<?php } ?>
<?php if ($professor_delete->fone->Visible) { // fone ?>
		<th class="<?php echo $professor_delete->fone->headerCellClass() ?>"><span id="elh_professor_fone" class="professor_fone"><?php echo $professor_delete->fone->caption() ?></span></th>
<?php } ?>
<?php if ($professor_delete->foto->Visible) { // foto ?>
		<th class="<?php echo $professor_delete->foto->headerCellClass() ?>"><span id="elh_professor_foto" class="professor_foto"><?php echo $professor_delete->foto->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$professor_delete->RecordCount = 0;
$i = 0;
while (!$professor_delete->Recordset->EOF) {
	$professor_delete->RecordCount++;
	$professor_delete->RowCount++;

	// Set row properties
	$professor->resetAttributes();
	$professor->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$professor_delete->loadRowValues($professor_delete->Recordset);

	// Render row
	$professor_delete->renderRow();
?>
	<tr <?php echo $professor->rowAttributes() ?>>
<?php if ($professor_delete->idprofessor->Visible) { // idprofessor ?>
		<td <?php echo $professor_delete->idprofessor->cellAttributes() ?>>
<span id="el<?php echo $professor_delete->RowCount ?>_professor_idprofessor" class="professor_idprofessor">
<span<?php echo $professor_delete->idprofessor->viewAttributes() ?>><?php echo $professor_delete->idprofessor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($professor_delete->nome_professor->Visible) { // nome_professor ?>
		<td <?php echo $professor_delete->nome_professor->cellAttributes() ?>>
<span id="el<?php echo $professor_delete->RowCount ?>_professor_nome_professor" class="professor_nome_professor">
<span<?php echo $professor_delete->nome_professor->viewAttributes() ?>><?php echo $professor_delete->nome_professor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($professor_delete->cpf->Visible) { // cpf ?>
		<td <?php echo $professor_delete->cpf->cellAttributes() ?>>
<span id="el<?php echo $professor_delete->RowCount ?>_professor_cpf" class="professor_cpf">
<span<?php echo $professor_delete->cpf->viewAttributes() ?>><?php echo $professor_delete->cpf->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($professor_delete->nascimento->Visible) { // nascimento ?>
		<td <?php echo $professor_delete->nascimento->cellAttributes() ?>>
<span id="el<?php echo $professor_delete->RowCount ?>_professor_nascimento" class="professor_nascimento">
<span<?php echo $professor_delete->nascimento->viewAttributes() ?>><?php echo $professor_delete->nascimento->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($professor_delete->sexo->Visible) { // sexo ?>
		<td <?php echo $professor_delete->sexo->cellAttributes() ?>>
<span id="el<?php echo $professor_delete->RowCount ?>_professor_sexo" class="professor_sexo">
<span<?php echo $professor_delete->sexo->viewAttributes() ?>><?php echo $professor_delete->sexo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($professor_delete->fone->Visible) { // fone ?>
		<td <?php echo $professor_delete->fone->cellAttributes() ?>>
<span id="el<?php echo $professor_delete->RowCount ?>_professor_fone" class="professor_fone">
<span<?php echo $professor_delete->fone->viewAttributes() ?>><?php echo $professor_delete->fone->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($professor_delete->foto->Visible) { // foto ?>
		<td <?php echo $professor_delete->foto->cellAttributes() ?>>
<span id="el<?php echo $professor_delete->RowCount ?>_professor_foto" class="professor_foto">
<span><?php echo GetFileViewTag($professor_delete->foto, $professor_delete->foto->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$professor_delete->Recordset->moveNext();
}
$professor_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $professor_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$professor_delete->showPageFooter();
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
$professor_delete->terminate();
?>