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
$mensalidade_log_edit = new mensalidade_log_edit();

// Run the page
$mensalidade_log_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mensalidade_log_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmensalidade_logedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fmensalidade_logedit = currentForm = new ew.Form("fmensalidade_logedit", "edit");

	// Validate form
	fmensalidade_logedit.validate = function() {
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
			<?php if ($mensalidade_log_edit->idmensalidade_log->Required) { ?>
				elm = this.getElements("x" + infix + "_idmensalidade_log");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_edit->idmensalidade_log->caption(), $mensalidade_log_edit->idmensalidade_log->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_log_edit->cliente->Required) { ?>
				elm = this.getElements("x" + infix + "_cliente");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_edit->cliente->caption(), $mensalidade_log_edit->cliente->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_log_edit->mes->Required) { ?>
				elm = this.getElements("x" + infix + "_mes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_edit->mes->caption(), $mensalidade_log_edit->mes->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_log_edit->valor->Required) { ?>
				elm = this.getElements("x" + infix + "_valor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_edit->valor->caption(), $mensalidade_log_edit->valor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_log_edit->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_edit->status->caption(), $mensalidade_log_edit->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_log_edit->data_pagamento->Required) { ?>
				elm = this.getElements("x" + infix + "_data_pagamento");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_edit->data_pagamento->caption(), $mensalidade_log_edit->data_pagamento->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_data_pagamento");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($mensalidade_log_edit->data_pagamento->errorMessage()) ?>");
			<?php if ($mensalidade_log_edit->acao->Required) { ?>
				elm = this.getElements("x" + infix + "_acao");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_edit->acao->caption(), $mensalidade_log_edit->acao->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_log_edit->data_hora->Required) { ?>
				elm = this.getElements("x" + infix + "_data_hora");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_edit->data_hora->caption(), $mensalidade_log_edit->data_hora->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_data_hora");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($mensalidade_log_edit->data_hora->errorMessage()) ?>");

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
	fmensalidade_logedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmensalidade_logedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmensalidade_logedit.lists["x_cliente"] = <?php echo $mensalidade_log_edit->cliente->Lookup->toClientList($mensalidade_log_edit) ?>;
	fmensalidade_logedit.lists["x_cliente"].options = <?php echo JsonEncode($mensalidade_log_edit->cliente->lookupOptions()) ?>;
	fmensalidade_logedit.lists["x_valor"] = <?php echo $mensalidade_log_edit->valor->Lookup->toClientList($mensalidade_log_edit) ?>;
	fmensalidade_logedit.lists["x_valor"].options = <?php echo JsonEncode($mensalidade_log_edit->valor->options(FALSE, TRUE)) ?>;
	fmensalidade_logedit.lists["x_status"] = <?php echo $mensalidade_log_edit->status->Lookup->toClientList($mensalidade_log_edit) ?>;
	fmensalidade_logedit.lists["x_status"].options = <?php echo JsonEncode($mensalidade_log_edit->status->options(FALSE, TRUE)) ?>;
	fmensalidade_logedit.lists["x_acao"] = <?php echo $mensalidade_log_edit->acao->Lookup->toClientList($mensalidade_log_edit) ?>;
	fmensalidade_logedit.lists["x_acao"].options = <?php echo JsonEncode($mensalidade_log_edit->acao->options(FALSE, TRUE)) ?>;
	loadjs.done("fmensalidade_logedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $mensalidade_log_edit->showPageHeader(); ?>
<?php
$mensalidade_log_edit->showMessage();
?>
<form name="fmensalidade_logedit" id="fmensalidade_logedit" class="<?php echo $mensalidade_log_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mensalidade_log">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$mensalidade_log_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($mensalidade_log_edit->idmensalidade_log->Visible) { // idmensalidade_log ?>
	<div id="r_idmensalidade_log" class="form-group row">
		<label id="elh_mensalidade_log_idmensalidade_log" class="<?php echo $mensalidade_log_edit->LeftColumnClass ?>"><?php echo $mensalidade_log_edit->idmensalidade_log->caption() ?><?php echo $mensalidade_log_edit->idmensalidade_log->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_log_edit->RightColumnClass ?>"><div <?php echo $mensalidade_log_edit->idmensalidade_log->cellAttributes() ?>>
<span id="el_mensalidade_log_idmensalidade_log">
<span<?php echo $mensalidade_log_edit->idmensalidade_log->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_log_edit->idmensalidade_log->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_idmensalidade_log" name="x_idmensalidade_log" id="x_idmensalidade_log" value="<?php echo HtmlEncode($mensalidade_log_edit->idmensalidade_log->CurrentValue) ?>">
<?php echo $mensalidade_log_edit->idmensalidade_log->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mensalidade_log_edit->cliente->Visible) { // cliente ?>
	<div id="r_cliente" class="form-group row">
		<label id="elh_mensalidade_log_cliente" for="x_cliente" class="<?php echo $mensalidade_log_edit->LeftColumnClass ?>"><?php echo $mensalidade_log_edit->cliente->caption() ?><?php echo $mensalidade_log_edit->cliente->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_log_edit->RightColumnClass ?>"><div <?php echo $mensalidade_log_edit->cliente->cellAttributes() ?>>
<span id="el_mensalidade_log_cliente">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mensalidade_log" data-field="x_cliente" data-value-separator="<?php echo $mensalidade_log_edit->cliente->displayValueSeparatorAttribute() ?>" id="x_cliente" name="x_cliente"<?php echo $mensalidade_log_edit->cliente->editAttributes() ?>>
			<?php echo $mensalidade_log_edit->cliente->selectOptionListHtml("x_cliente") ?>
		</select>
</div>
<?php echo $mensalidade_log_edit->cliente->Lookup->getParamTag($mensalidade_log_edit, "p_x_cliente") ?>
</span>
<?php echo $mensalidade_log_edit->cliente->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mensalidade_log_edit->mes->Visible) { // mes ?>
	<div id="r_mes" class="form-group row">
		<label id="elh_mensalidade_log_mes" for="x_mes" class="<?php echo $mensalidade_log_edit->LeftColumnClass ?>"><?php echo $mensalidade_log_edit->mes->caption() ?><?php echo $mensalidade_log_edit->mes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_log_edit->RightColumnClass ?>"><div <?php echo $mensalidade_log_edit->mes->cellAttributes() ?>>
<span id="el_mensalidade_log_mes">
<input type="text" data-table="mensalidade_log" data-field="x_mes" name="x_mes" id="x_mes" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($mensalidade_log_edit->mes->getPlaceHolder()) ?>" value="<?php echo $mensalidade_log_edit->mes->EditValue ?>"<?php echo $mensalidade_log_edit->mes->editAttributes() ?>>
</span>
<?php echo $mensalidade_log_edit->mes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mensalidade_log_edit->valor->Visible) { // valor ?>
	<div id="r_valor" class="form-group row">
		<label id="elh_mensalidade_log_valor" class="<?php echo $mensalidade_log_edit->LeftColumnClass ?>"><?php echo $mensalidade_log_edit->valor->caption() ?><?php echo $mensalidade_log_edit->valor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_log_edit->RightColumnClass ?>"><div <?php echo $mensalidade_log_edit->valor->cellAttributes() ?>>
<span id="el_mensalidade_log_valor">
<div id="tp_x_valor" class="ew-template"><input type="radio" class="custom-control-input" data-table="mensalidade_log" data-field="x_valor" data-value-separator="<?php echo $mensalidade_log_edit->valor->displayValueSeparatorAttribute() ?>" name="x_valor" id="x_valor" value="{value}"<?php echo $mensalidade_log_edit->valor->editAttributes() ?>></div>
<div id="dsl_x_valor" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $mensalidade_log_edit->valor->radioButtonListHtml(FALSE, "x_valor") ?>
</div></div>
</span>
<?php echo $mensalidade_log_edit->valor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mensalidade_log_edit->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_mensalidade_log_status" for="x_status" class="<?php echo $mensalidade_log_edit->LeftColumnClass ?>"><?php echo $mensalidade_log_edit->status->caption() ?><?php echo $mensalidade_log_edit->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_log_edit->RightColumnClass ?>"><div <?php echo $mensalidade_log_edit->status->cellAttributes() ?>>
<span id="el_mensalidade_log_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mensalidade_log" data-field="x_status" data-value-separator="<?php echo $mensalidade_log_edit->status->displayValueSeparatorAttribute() ?>" id="x_status" name="x_status"<?php echo $mensalidade_log_edit->status->editAttributes() ?>>
			<?php echo $mensalidade_log_edit->status->selectOptionListHtml("x_status") ?>
		</select>
</div>
</span>
<?php echo $mensalidade_log_edit->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mensalidade_log_edit->data_pagamento->Visible) { // data_pagamento ?>
	<div id="r_data_pagamento" class="form-group row">
		<label id="elh_mensalidade_log_data_pagamento" for="x_data_pagamento" class="<?php echo $mensalidade_log_edit->LeftColumnClass ?>"><?php echo $mensalidade_log_edit->data_pagamento->caption() ?><?php echo $mensalidade_log_edit->data_pagamento->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_log_edit->RightColumnClass ?>"><div <?php echo $mensalidade_log_edit->data_pagamento->cellAttributes() ?>>
<span id="el_mensalidade_log_data_pagamento">
<input type="text" data-table="mensalidade_log" data-field="x_data_pagamento" data-format="7" name="x_data_pagamento" id="x_data_pagamento" maxlength="10" placeholder="<?php echo HtmlEncode($mensalidade_log_edit->data_pagamento->getPlaceHolder()) ?>" value="<?php echo $mensalidade_log_edit->data_pagamento->EditValue ?>"<?php echo $mensalidade_log_edit->data_pagamento->editAttributes() ?>>
<?php if (!$mensalidade_log_edit->data_pagamento->ReadOnly && !$mensalidade_log_edit->data_pagamento->Disabled && !isset($mensalidade_log_edit->data_pagamento->EditAttrs["readonly"]) && !isset($mensalidade_log_edit->data_pagamento->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmensalidade_logedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fmensalidade_logedit", "x_data_pagamento", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php echo $mensalidade_log_edit->data_pagamento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mensalidade_log_edit->acao->Visible) { // acao ?>
	<div id="r_acao" class="form-group row">
		<label id="elh_mensalidade_log_acao" for="x_acao" class="<?php echo $mensalidade_log_edit->LeftColumnClass ?>"><?php echo $mensalidade_log_edit->acao->caption() ?><?php echo $mensalidade_log_edit->acao->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_log_edit->RightColumnClass ?>"><div <?php echo $mensalidade_log_edit->acao->cellAttributes() ?>>
<span id="el_mensalidade_log_acao">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mensalidade_log" data-field="x_acao" data-value-separator="<?php echo $mensalidade_log_edit->acao->displayValueSeparatorAttribute() ?>" id="x_acao" name="x_acao"<?php echo $mensalidade_log_edit->acao->editAttributes() ?>>
			<?php echo $mensalidade_log_edit->acao->selectOptionListHtml("x_acao") ?>
		</select>
</div>
</span>
<?php echo $mensalidade_log_edit->acao->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mensalidade_log_edit->data_hora->Visible) { // data_hora ?>
	<div id="r_data_hora" class="form-group row">
		<label id="elh_mensalidade_log_data_hora" for="x_data_hora" class="<?php echo $mensalidade_log_edit->LeftColumnClass ?>"><?php echo $mensalidade_log_edit->data_hora->caption() ?><?php echo $mensalidade_log_edit->data_hora->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_log_edit->RightColumnClass ?>"><div <?php echo $mensalidade_log_edit->data_hora->cellAttributes() ?>>
<span id="el_mensalidade_log_data_hora">
<input type="text" data-table="mensalidade_log" data-field="x_data_hora" data-format="1" name="x_data_hora" id="x_data_hora" maxlength="19" placeholder="<?php echo HtmlEncode($mensalidade_log_edit->data_hora->getPlaceHolder()) ?>" value="<?php echo $mensalidade_log_edit->data_hora->EditValue ?>"<?php echo $mensalidade_log_edit->data_hora->editAttributes() ?>>
<?php if (!$mensalidade_log_edit->data_hora->ReadOnly && !$mensalidade_log_edit->data_hora->Disabled && !isset($mensalidade_log_edit->data_hora->EditAttrs["readonly"]) && !isset($mensalidade_log_edit->data_hora->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmensalidade_logedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fmensalidade_logedit", "x_data_hora", {"ignoreReadonly":true,"useCurrent":false,"format":1});
});
</script>
<?php } ?>
</span>
<?php echo $mensalidade_log_edit->data_hora->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$mensalidade_log_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $mensalidade_log_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $mensalidade_log_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$mensalidade_log_edit->showPageFooter();
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
$mensalidade_log_edit->terminate();
?>