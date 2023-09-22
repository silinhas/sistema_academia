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
$professor_edit = new professor_edit();

// Run the page
$professor_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$professor_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fprofessoredit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fprofessoredit = currentForm = new ew.Form("fprofessoredit", "edit");

	// Validate form
	fprofessoredit.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			<?php if ($professor_edit->idprofessor->Required) { ?>
				elm = this.getElements("x" + infix + "_idprofessor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $professor_edit->idprofessor->caption(), $professor_edit->idprofessor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($professor_edit->nome_professor->Required) { ?>
				elm = this.getElements("x" + infix + "_nome_professor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $professor_edit->nome_professor->caption(), $professor_edit->nome_professor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($professor_edit->cpf->Required) { ?>
				elm = this.getElements("x" + infix + "_cpf");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $professor_edit->cpf->caption(), $professor_edit->cpf->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($professor_edit->nascimento->Required) { ?>
				elm = this.getElements("x" + infix + "_nascimento");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $professor_edit->nascimento->caption(), $professor_edit->nascimento->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nascimento");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($professor_edit->nascimento->errorMessage()) ?>");
			<?php if ($professor_edit->sexo->Required) { ?>
				elm = this.getElements("x" + infix + "_sexo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $professor_edit->sexo->caption(), $professor_edit->sexo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($professor_edit->fone->Required) { ?>
				elm = this.getElements("x" + infix + "_fone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $professor_edit->fone->caption(), $professor_edit->fone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($professor_edit->foto->Required) { ?>
				felm = this.getElements("x" + infix + "_foto");
				elm = this.getElements("fn_x" + infix + "_foto");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $professor_edit->foto->caption(), $professor_edit->foto->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
		}

		// Process detail forms
		var dfs = $fobj.find("input[name='detailpage']").get();
		for (var i = 0; i < dfs.length; i++) {
			var df = dfs[i], val = df.value;
			if (val && ew.forms[val])
				if (!ew.forms[val].validate())
					return false;
		}
		return true;
	}

	// Form_CustomValidate
	fprofessoredit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fprofessoredit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fprofessoredit.lists["x_sexo"] = <?php echo $professor_edit->sexo->Lookup->toClientList($professor_edit) ?>;
	fprofessoredit.lists["x_sexo"].options = <?php echo JsonEncode($professor_edit->sexo->options(FALSE, TRUE)) ?>;
	loadjs.done("fprofessoredit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $professor_edit->showPageHeader(); ?>
<?php
$professor_edit->showMessage();
?>
<form name="fprofessoredit" id="fprofessoredit" class="<?php echo $professor_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="professor">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$professor_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($professor_edit->idprofessor->Visible) { // idprofessor ?>
	<div id="r_idprofessor" class="form-group row">
		<label id="elh_professor_idprofessor" class="<?php echo $professor_edit->LeftColumnClass ?>"><?php echo $professor_edit->idprofessor->caption() ?><?php echo $professor_edit->idprofessor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $professor_edit->RightColumnClass ?>"><div <?php echo $professor_edit->idprofessor->cellAttributes() ?>>
<span id="el_professor_idprofessor">
<span<?php echo $professor_edit->idprofessor->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($professor_edit->idprofessor->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="professor" data-field="x_idprofessor" name="x_idprofessor" id="x_idprofessor" value="<?php echo HtmlEncode($professor_edit->idprofessor->CurrentValue) ?>">
<?php echo $professor_edit->idprofessor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($professor_edit->nome_professor->Visible) { // nome_professor ?>
	<div id="r_nome_professor" class="form-group row">
		<label id="elh_professor_nome_professor" for="x_nome_professor" class="<?php echo $professor_edit->LeftColumnClass ?>"><?php echo $professor_edit->nome_professor->caption() ?><?php echo $professor_edit->nome_professor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $professor_edit->RightColumnClass ?>"><div <?php echo $professor_edit->nome_professor->cellAttributes() ?>>
<span id="el_professor_nome_professor">
<input type="text" data-table="professor" data-field="x_nome_professor" name="x_nome_professor" id="x_nome_professor" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($professor_edit->nome_professor->getPlaceHolder()) ?>" value="<?php echo $professor_edit->nome_professor->EditValue ?>"<?php echo $professor_edit->nome_professor->editAttributes() ?>>
</span>
<?php echo $professor_edit->nome_professor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($professor_edit->cpf->Visible) { // cpf ?>
	<div id="r_cpf" class="form-group row">
		<label id="elh_professor_cpf" for="x_cpf" class="<?php echo $professor_edit->LeftColumnClass ?>"><?php echo $professor_edit->cpf->caption() ?><?php echo $professor_edit->cpf->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $professor_edit->RightColumnClass ?>"><div <?php echo $professor_edit->cpf->cellAttributes() ?>>
<span id="el_professor_cpf">
<input type="text" data-table="professor" data-field="x_cpf" name="x_cpf" id="x_cpf" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($professor_edit->cpf->getPlaceHolder()) ?>" value="<?php echo $professor_edit->cpf->EditValue ?>"<?php echo $professor_edit->cpf->editAttributes() ?>>
</span>
<?php echo $professor_edit->cpf->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($professor_edit->nascimento->Visible) { // nascimento ?>
	<div id="r_nascimento" class="form-group row">
		<label id="elh_professor_nascimento" for="x_nascimento" class="<?php echo $professor_edit->LeftColumnClass ?>"><?php echo $professor_edit->nascimento->caption() ?><?php echo $professor_edit->nascimento->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $professor_edit->RightColumnClass ?>"><div <?php echo $professor_edit->nascimento->cellAttributes() ?>>
<span id="el_professor_nascimento">
<input type="text" data-table="professor" data-field="x_nascimento" name="x_nascimento" id="x_nascimento" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($professor_edit->nascimento->getPlaceHolder()) ?>" value="<?php echo $professor_edit->nascimento->EditValue ?>"<?php echo $professor_edit->nascimento->editAttributes() ?>>
</span>
<?php echo $professor_edit->nascimento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($professor_edit->sexo->Visible) { // sexo ?>
	<div id="r_sexo" class="form-group row">
		<label id="elh_professor_sexo" for="x_sexo" class="<?php echo $professor_edit->LeftColumnClass ?>"><?php echo $professor_edit->sexo->caption() ?><?php echo $professor_edit->sexo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $professor_edit->RightColumnClass ?>"><div <?php echo $professor_edit->sexo->cellAttributes() ?>>
<span id="el_professor_sexo">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="professor" data-field="x_sexo" data-value-separator="<?php echo $professor_edit->sexo->displayValueSeparatorAttribute() ?>" id="x_sexo" name="x_sexo"<?php echo $professor_edit->sexo->editAttributes() ?>>
			<?php echo $professor_edit->sexo->selectOptionListHtml("x_sexo") ?>
		</select>
</div>
</span>
<?php echo $professor_edit->sexo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($professor_edit->fone->Visible) { // fone ?>
	<div id="r_fone" class="form-group row">
		<label id="elh_professor_fone" for="x_fone" class="<?php echo $professor_edit->LeftColumnClass ?>"><?php echo $professor_edit->fone->caption() ?><?php echo $professor_edit->fone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $professor_edit->RightColumnClass ?>"><div <?php echo $professor_edit->fone->cellAttributes() ?>>
<span id="el_professor_fone">
<input type="text" data-table="professor" data-field="x_fone" name="x_fone" id="x_fone" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($professor_edit->fone->getPlaceHolder()) ?>" value="<?php echo $professor_edit->fone->EditValue ?>"<?php echo $professor_edit->fone->editAttributes() ?>>
</span>
<?php echo $professor_edit->fone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($professor_edit->foto->Visible) { // foto ?>
	<div id="r_foto" class="form-group row">
		<label id="elh_professor_foto" class="<?php echo $professor_edit->LeftColumnClass ?>"><?php echo $professor_edit->foto->caption() ?><?php echo $professor_edit->foto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $professor_edit->RightColumnClass ?>"><div <?php echo $professor_edit->foto->cellAttributes() ?>>
<span id="el_professor_foto">
<div id="fd_x_foto">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $professor_edit->foto->title() ?>" data-table="professor" data-field="x_foto" name="x_foto" id="x_foto" lang="<?php echo CurrentLanguageID() ?>"<?php echo $professor_edit->foto->editAttributes() ?><?php if ($professor_edit->foto->ReadOnly || $professor_edit->foto->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_foto"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_foto" id= "fn_x_foto" value="<?php echo $professor_edit->foto->Upload->FileName ?>">
<input type="hidden" name="fa_x_foto" id= "fa_x_foto" value="<?php echo (Post("fa_x_foto") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_foto" id= "fs_x_foto" value="100">
<input type="hidden" name="fx_x_foto" id= "fx_x_foto" value="<?php echo $professor_edit->foto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_foto" id= "fm_x_foto" value="<?php echo $professor_edit->foto->UploadMaxFileSize ?>">
</div>
<table id="ft_x_foto" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $professor_edit->foto->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$professor_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $professor_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $professor_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$professor_edit->showPageFooter();
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
$professor_edit->terminate();
?>