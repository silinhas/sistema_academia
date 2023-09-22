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
$cliente_log_edit = new cliente_log_edit();

// Run the page
$cliente_log_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cliente_log_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fcliente_logedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fcliente_logedit = currentForm = new ew.Form("fcliente_logedit", "edit");

	// Validate form
	fcliente_logedit.validate = function() {
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
			<?php if ($cliente_log_edit->idcliente_log->Required) { ?>
				elm = this.getElements("x" + infix + "_idcliente_log");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_log_edit->idcliente_log->caption(), $cliente_log_edit->idcliente_log->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_log_edit->nome->Required) { ?>
				elm = this.getElements("x" + infix + "_nome");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_log_edit->nome->caption(), $cliente_log_edit->nome->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_log_edit->data_hora->Required) { ?>
				elm = this.getElements("x" + infix + "_data_hora");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_log_edit->data_hora->caption(), $cliente_log_edit->data_hora->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_data_hora");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cliente_log_edit->data_hora->errorMessage()) ?>");
			<?php if ($cliente_log_edit->acao->Required) { ?>
				elm = this.getElements("x" + infix + "_acao");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_log_edit->acao->caption(), $cliente_log_edit->acao->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_log_edit->foto->Required) { ?>
				felm = this.getElements("x" + infix + "_foto");
				elm = this.getElements("fn_x" + infix + "_foto");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $cliente_log_edit->foto->caption(), $cliente_log_edit->foto->RequiredErrorMessage)) ?>");
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
	fcliente_logedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fcliente_logedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fcliente_logedit.lists["x_nome"] = <?php echo $cliente_log_edit->nome->Lookup->toClientList($cliente_log_edit) ?>;
	fcliente_logedit.lists["x_nome"].options = <?php echo JsonEncode($cliente_log_edit->nome->lookupOptions()) ?>;
	fcliente_logedit.lists["x_acao"] = <?php echo $cliente_log_edit->acao->Lookup->toClientList($cliente_log_edit) ?>;
	fcliente_logedit.lists["x_acao"].options = <?php echo JsonEncode($cliente_log_edit->acao->options(FALSE, TRUE)) ?>;
	loadjs.done("fcliente_logedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cliente_log_edit->showPageHeader(); ?>
<?php
$cliente_log_edit->showMessage();
?>
<form name="fcliente_logedit" id="fcliente_logedit" class="<?php echo $cliente_log_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cliente_log">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$cliente_log_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($cliente_log_edit->idcliente_log->Visible) { // idcliente_log ?>
	<div id="r_idcliente_log" class="form-group row">
		<label id="elh_cliente_log_idcliente_log" class="<?php echo $cliente_log_edit->LeftColumnClass ?>"><?php echo $cliente_log_edit->idcliente_log->caption() ?><?php echo $cliente_log_edit->idcliente_log->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_log_edit->RightColumnClass ?>"><div <?php echo $cliente_log_edit->idcliente_log->cellAttributes() ?>>
<span id="el_cliente_log_idcliente_log">
<span<?php echo $cliente_log_edit->idcliente_log->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cliente_log_edit->idcliente_log->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="cliente_log" data-field="x_idcliente_log" name="x_idcliente_log" id="x_idcliente_log" value="<?php echo HtmlEncode($cliente_log_edit->idcliente_log->CurrentValue) ?>">
<?php echo $cliente_log_edit->idcliente_log->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_log_edit->nome->Visible) { // nome ?>
	<div id="r_nome" class="form-group row">
		<label id="elh_cliente_log_nome" for="x_nome" class="<?php echo $cliente_log_edit->LeftColumnClass ?>"><?php echo $cliente_log_edit->nome->caption() ?><?php echo $cliente_log_edit->nome->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_log_edit->RightColumnClass ?>"><div <?php echo $cliente_log_edit->nome->cellAttributes() ?>>
<span id="el_cliente_log_nome">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cliente_log" data-field="x_nome" data-value-separator="<?php echo $cliente_log_edit->nome->displayValueSeparatorAttribute() ?>" id="x_nome" name="x_nome"<?php echo $cliente_log_edit->nome->editAttributes() ?>>
			<?php echo $cliente_log_edit->nome->selectOptionListHtml("x_nome") ?>
		</select>
</div>
<?php echo $cliente_log_edit->nome->Lookup->getParamTag($cliente_log_edit, "p_x_nome") ?>
</span>
<?php echo $cliente_log_edit->nome->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_log_edit->data_hora->Visible) { // data_hora ?>
	<div id="r_data_hora" class="form-group row">
		<label id="elh_cliente_log_data_hora" for="x_data_hora" class="<?php echo $cliente_log_edit->LeftColumnClass ?>"><?php echo $cliente_log_edit->data_hora->caption() ?><?php echo $cliente_log_edit->data_hora->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_log_edit->RightColumnClass ?>"><div <?php echo $cliente_log_edit->data_hora->cellAttributes() ?>>
<span id="el_cliente_log_data_hora">
<input type="text" data-table="cliente_log" data-field="x_data_hora" name="x_data_hora" id="x_data_hora" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($cliente_log_edit->data_hora->getPlaceHolder()) ?>" value="<?php echo $cliente_log_edit->data_hora->EditValue ?>"<?php echo $cliente_log_edit->data_hora->editAttributes() ?>>
<?php if (!$cliente_log_edit->data_hora->ReadOnly && !$cliente_log_edit->data_hora->Disabled && !isset($cliente_log_edit->data_hora->EditAttrs["readonly"]) && !isset($cliente_log_edit->data_hora->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fcliente_logedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fcliente_logedit", "x_data_hora", {"ignoreReadonly":true,"useCurrent":false,"format":1});
});
</script>
<?php } ?>
</span>
<?php echo $cliente_log_edit->data_hora->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_log_edit->acao->Visible) { // acao ?>
	<div id="r_acao" class="form-group row">
		<label id="elh_cliente_log_acao" for="x_acao" class="<?php echo $cliente_log_edit->LeftColumnClass ?>"><?php echo $cliente_log_edit->acao->caption() ?><?php echo $cliente_log_edit->acao->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_log_edit->RightColumnClass ?>"><div <?php echo $cliente_log_edit->acao->cellAttributes() ?>>
<span id="el_cliente_log_acao">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cliente_log" data-field="x_acao" data-value-separator="<?php echo $cliente_log_edit->acao->displayValueSeparatorAttribute() ?>" id="x_acao" name="x_acao"<?php echo $cliente_log_edit->acao->editAttributes() ?>>
			<?php echo $cliente_log_edit->acao->selectOptionListHtml("x_acao") ?>
		</select>
</div>
</span>
<?php echo $cliente_log_edit->acao->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_log_edit->foto->Visible) { // foto ?>
	<div id="r_foto" class="form-group row">
		<label id="elh_cliente_log_foto" class="<?php echo $cliente_log_edit->LeftColumnClass ?>"><?php echo $cliente_log_edit->foto->caption() ?><?php echo $cliente_log_edit->foto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_log_edit->RightColumnClass ?>"><div <?php echo $cliente_log_edit->foto->cellAttributes() ?>>
<span id="el_cliente_log_foto">
<div id="fd_x_foto">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $cliente_log_edit->foto->title() ?>" data-table="cliente_log" data-field="x_foto" name="x_foto" id="x_foto" lang="<?php echo CurrentLanguageID() ?>"<?php echo $cliente_log_edit->foto->editAttributes() ?><?php if ($cliente_log_edit->foto->ReadOnly || $cliente_log_edit->foto->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_foto"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_foto" id= "fn_x_foto" value="<?php echo $cliente_log_edit->foto->Upload->FileName ?>">
<input type="hidden" name="fa_x_foto" id= "fa_x_foto" value="<?php echo (Post("fa_x_foto") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_foto" id= "fs_x_foto" value="100">
<input type="hidden" name="fx_x_foto" id= "fx_x_foto" value="<?php echo $cliente_log_edit->foto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_foto" id= "fm_x_foto" value="<?php echo $cliente_log_edit->foto->UploadMaxFileSize ?>">
</div>
<table id="ft_x_foto" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $cliente_log_edit->foto->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cliente_log_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cliente_log_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cliente_log_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cliente_log_edit->showPageFooter();
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
$cliente_log_edit->terminate();
?>