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
$professor_add = new professor_add();

// Run the page
$professor_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$professor_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fprofessoradd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fprofessoradd = currentForm = new ew.Form("fprofessoradd", "add");

	// Validate form
	fprofessoradd.validate = function() {
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
			<?php if ($professor_add->nome_professor->Required) { ?>
				elm = this.getElements("x" + infix + "_nome_professor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $professor_add->nome_professor->caption(), $professor_add->nome_professor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($professor_add->cpf->Required) { ?>
				elm = this.getElements("x" + infix + "_cpf");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $professor_add->cpf->caption(), $professor_add->cpf->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($professor_add->nascimento->Required) { ?>
				elm = this.getElements("x" + infix + "_nascimento");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $professor_add->nascimento->caption(), $professor_add->nascimento->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nascimento");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($professor_add->nascimento->errorMessage()) ?>");
			<?php if ($professor_add->sexo->Required) { ?>
				elm = this.getElements("x" + infix + "_sexo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $professor_add->sexo->caption(), $professor_add->sexo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($professor_add->fone->Required) { ?>
				elm = this.getElements("x" + infix + "_fone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $professor_add->fone->caption(), $professor_add->fone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($professor_add->foto->Required) { ?>
				felm = this.getElements("x" + infix + "_foto");
				elm = this.getElements("fn_x" + infix + "_foto");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $professor_add->foto->caption(), $professor_add->foto->RequiredErrorMessage)) ?>");
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
	fprofessoradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fprofessoradd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fprofessoradd.lists["x_sexo"] = <?php echo $professor_add->sexo->Lookup->toClientList($professor_add) ?>;
	fprofessoradd.lists["x_sexo"].options = <?php echo JsonEncode($professor_add->sexo->options(FALSE, TRUE)) ?>;
	loadjs.done("fprofessoradd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $professor_add->showPageHeader(); ?>
<?php
$professor_add->showMessage();
?>
<form name="fprofessoradd" id="fprofessoradd" class="<?php echo $professor_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="professor">
<?php if ($professor->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$professor_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($professor_add->nome_professor->Visible) { // nome_professor ?>
	<div id="r_nome_professor" class="form-group row">
		<label id="elh_professor_nome_professor" for="x_nome_professor" class="<?php echo $professor_add->LeftColumnClass ?>"><?php echo $professor_add->nome_professor->caption() ?><?php echo $professor_add->nome_professor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $professor_add->RightColumnClass ?>"><div <?php echo $professor_add->nome_professor->cellAttributes() ?>>
<?php if (!$professor->isConfirm()) { ?>
<span id="el_professor_nome_professor">
<input type="text" data-table="professor" data-field="x_nome_professor" name="x_nome_professor" id="x_nome_professor" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($professor_add->nome_professor->getPlaceHolder()) ?>" value="<?php echo $professor_add->nome_professor->EditValue ?>"<?php echo $professor_add->nome_professor->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_professor_nome_professor">
<span<?php echo $professor_add->nome_professor->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($professor_add->nome_professor->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="professor" data-field="x_nome_professor" name="x_nome_professor" id="x_nome_professor" value="<?php echo HtmlEncode($professor_add->nome_professor->FormValue) ?>">
<?php } ?>
<?php echo $professor_add->nome_professor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($professor_add->cpf->Visible) { // cpf ?>
	<div id="r_cpf" class="form-group row">
		<label id="elh_professor_cpf" for="x_cpf" class="<?php echo $professor_add->LeftColumnClass ?>"><?php echo $professor_add->cpf->caption() ?><?php echo $professor_add->cpf->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $professor_add->RightColumnClass ?>"><div <?php echo $professor_add->cpf->cellAttributes() ?>>
<?php if (!$professor->isConfirm()) { ?>
<span id="el_professor_cpf">
<input type="text" data-table="professor" data-field="x_cpf" name="x_cpf" id="x_cpf" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($professor_add->cpf->getPlaceHolder()) ?>" value="<?php echo $professor_add->cpf->EditValue ?>"<?php echo $professor_add->cpf->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_professor_cpf">
<span<?php echo $professor_add->cpf->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($professor_add->cpf->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="professor" data-field="x_cpf" name="x_cpf" id="x_cpf" value="<?php echo HtmlEncode($professor_add->cpf->FormValue) ?>">
<?php } ?>
<?php echo $professor_add->cpf->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($professor_add->nascimento->Visible) { // nascimento ?>
	<div id="r_nascimento" class="form-group row">
		<label id="elh_professor_nascimento" for="x_nascimento" class="<?php echo $professor_add->LeftColumnClass ?>"><?php echo $professor_add->nascimento->caption() ?><?php echo $professor_add->nascimento->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $professor_add->RightColumnClass ?>"><div <?php echo $professor_add->nascimento->cellAttributes() ?>>
<?php if (!$professor->isConfirm()) { ?>
<span id="el_professor_nascimento">
<input type="text" data-table="professor" data-field="x_nascimento" name="x_nascimento" id="x_nascimento" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($professor_add->nascimento->getPlaceHolder()) ?>" value="<?php echo $professor_add->nascimento->EditValue ?>"<?php echo $professor_add->nascimento->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_professor_nascimento">
<span<?php echo $professor_add->nascimento->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($professor_add->nascimento->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="professor" data-field="x_nascimento" name="x_nascimento" id="x_nascimento" value="<?php echo HtmlEncode($professor_add->nascimento->FormValue) ?>">
<?php } ?>
<?php echo $professor_add->nascimento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($professor_add->sexo->Visible) { // sexo ?>
	<div id="r_sexo" class="form-group row">
		<label id="elh_professor_sexo" for="x_sexo" class="<?php echo $professor_add->LeftColumnClass ?>"><?php echo $professor_add->sexo->caption() ?><?php echo $professor_add->sexo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $professor_add->RightColumnClass ?>"><div <?php echo $professor_add->sexo->cellAttributes() ?>>
<?php if (!$professor->isConfirm()) { ?>
<span id="el_professor_sexo">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="professor" data-field="x_sexo" data-value-separator="<?php echo $professor_add->sexo->displayValueSeparatorAttribute() ?>" id="x_sexo" name="x_sexo"<?php echo $professor_add->sexo->editAttributes() ?>>
			<?php echo $professor_add->sexo->selectOptionListHtml("x_sexo") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el_professor_sexo">
<span<?php echo $professor_add->sexo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($professor_add->sexo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="professor" data-field="x_sexo" name="x_sexo" id="x_sexo" value="<?php echo HtmlEncode($professor_add->sexo->FormValue) ?>">
<?php } ?>
<?php echo $professor_add->sexo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($professor_add->fone->Visible) { // fone ?>
	<div id="r_fone" class="form-group row">
		<label id="elh_professor_fone" for="x_fone" class="<?php echo $professor_add->LeftColumnClass ?>"><?php echo $professor_add->fone->caption() ?><?php echo $professor_add->fone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $professor_add->RightColumnClass ?>"><div <?php echo $professor_add->fone->cellAttributes() ?>>
<?php if (!$professor->isConfirm()) { ?>
<span id="el_professor_fone">
<input type="text" data-table="professor" data-field="x_fone" name="x_fone" id="x_fone" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($professor_add->fone->getPlaceHolder()) ?>" value="<?php echo $professor_add->fone->EditValue ?>"<?php echo $professor_add->fone->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_professor_fone">
<span<?php echo $professor_add->fone->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($professor_add->fone->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="professor" data-field="x_fone" name="x_fone" id="x_fone" value="<?php echo HtmlEncode($professor_add->fone->FormValue) ?>">
<?php } ?>
<?php echo $professor_add->fone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($professor_add->foto->Visible) { // foto ?>
	<div id="r_foto" class="form-group row">
		<label id="elh_professor_foto" class="<?php echo $professor_add->LeftColumnClass ?>"><?php echo $professor_add->foto->caption() ?><?php echo $professor_add->foto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $professor_add->RightColumnClass ?>"><div <?php echo $professor_add->foto->cellAttributes() ?>>
<span id="el_professor_foto">
<div id="fd_x_foto">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $professor_add->foto->title() ?>" data-table="professor" data-field="x_foto" name="x_foto" id="x_foto" lang="<?php echo CurrentLanguageID() ?>"<?php echo $professor_add->foto->editAttributes() ?><?php if ($professor_add->foto->ReadOnly || $professor_add->foto->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_foto"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_foto" id= "fn_x_foto" value="<?php echo $professor_add->foto->Upload->FileName ?>">
<input type="hidden" name="fa_x_foto" id= "fa_x_foto" value="0">
<input type="hidden" name="fs_x_foto" id= "fs_x_foto" value="100">
<input type="hidden" name="fx_x_foto" id= "fx_x_foto" value="<?php echo $professor_add->foto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_foto" id= "fm_x_foto" value="<?php echo $professor_add->foto->UploadMaxFileSize ?>">
</div>
<table id="ft_x_foto" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $professor_add->foto->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$professor_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $professor_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$professor->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $professor_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$professor_add->showPageFooter();
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
$professor_add->terminate();
?>