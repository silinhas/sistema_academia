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
$mensalidade_edit = new mensalidade_edit();

// Run the page
$mensalidade_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mensalidade_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmensalidadeedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fmensalidadeedit = currentForm = new ew.Form("fmensalidadeedit", "edit");

	// Validate form
	fmensalidadeedit.validate = function() {
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
			<?php if ($mensalidade_edit->idmensalidade->Required) { ?>
				elm = this.getElements("x" + infix + "_idmensalidade");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_edit->idmensalidade->caption(), $mensalidade_edit->idmensalidade->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_edit->cliente_idcliente->Required) { ?>
				elm = this.getElements("x" + infix + "_cliente_idcliente");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_edit->cliente_idcliente->caption(), $mensalidade_edit->cliente_idcliente->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_edit->mes->Required) { ?>
				elm = this.getElements("x" + infix + "_mes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_edit->mes->caption(), $mensalidade_edit->mes->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_edit->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_edit->status->caption(), $mensalidade_edit->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_edit->valor->Required) { ?>
				elm = this.getElements("x" + infix + "_valor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_edit->valor->caption(), $mensalidade_edit->valor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_edit->data_pagamento->Required) { ?>
				elm = this.getElements("x" + infix + "_data_pagamento");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_edit->data_pagamento->caption(), $mensalidade_edit->data_pagamento->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_data_pagamento");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($mensalidade_edit->data_pagamento->errorMessage()) ?>");

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
	fmensalidadeedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmensalidadeedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmensalidadeedit.lists["x_cliente_idcliente"] = <?php echo $mensalidade_edit->cliente_idcliente->Lookup->toClientList($mensalidade_edit) ?>;
	fmensalidadeedit.lists["x_cliente_idcliente"].options = <?php echo JsonEncode($mensalidade_edit->cliente_idcliente->lookupOptions()) ?>;
	fmensalidadeedit.lists["x_mes"] = <?php echo $mensalidade_edit->mes->Lookup->toClientList($mensalidade_edit) ?>;
	fmensalidadeedit.lists["x_mes"].options = <?php echo JsonEncode($mensalidade_edit->mes->lookupOptions()) ?>;
	fmensalidadeedit.lists["x_status"] = <?php echo $mensalidade_edit->status->Lookup->toClientList($mensalidade_edit) ?>;
	fmensalidadeedit.lists["x_status"].options = <?php echo JsonEncode($mensalidade_edit->status->options(FALSE, TRUE)) ?>;
	fmensalidadeedit.lists["x_valor"] = <?php echo $mensalidade_edit->valor->Lookup->toClientList($mensalidade_edit) ?>;
	fmensalidadeedit.lists["x_valor"].options = <?php echo JsonEncode($mensalidade_edit->valor->options(FALSE, TRUE)) ?>;
	loadjs.done("fmensalidadeedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $mensalidade_edit->showPageHeader(); ?>
<?php
$mensalidade_edit->showMessage();
?>
<form name="fmensalidadeedit" id="fmensalidadeedit" class="<?php echo $mensalidade_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mensalidade">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$mensalidade_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($mensalidade_edit->idmensalidade->Visible) { // idmensalidade ?>
	<div id="r_idmensalidade" class="form-group row">
		<label id="elh_mensalidade_idmensalidade" class="<?php echo $mensalidade_edit->LeftColumnClass ?>"><?php echo $mensalidade_edit->idmensalidade->caption() ?><?php echo $mensalidade_edit->idmensalidade->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_edit->RightColumnClass ?>"><div <?php echo $mensalidade_edit->idmensalidade->cellAttributes() ?>>
<span id="el_mensalidade_idmensalidade">
<span<?php echo $mensalidade_edit->idmensalidade->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_edit->idmensalidade->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade" data-field="x_idmensalidade" name="x_idmensalidade" id="x_idmensalidade" value="<?php echo HtmlEncode($mensalidade_edit->idmensalidade->CurrentValue) ?>">
<?php echo $mensalidade_edit->idmensalidade->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mensalidade_edit->cliente_idcliente->Visible) { // cliente_idcliente ?>
	<div id="r_cliente_idcliente" class="form-group row">
		<label id="elh_mensalidade_cliente_idcliente" for="x_cliente_idcliente" class="<?php echo $mensalidade_edit->LeftColumnClass ?>"><?php echo $mensalidade_edit->cliente_idcliente->caption() ?><?php echo $mensalidade_edit->cliente_idcliente->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_edit->RightColumnClass ?>"><div <?php echo $mensalidade_edit->cliente_idcliente->cellAttributes() ?>>
<span id="el_mensalidade_cliente_idcliente">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mensalidade" data-field="x_cliente_idcliente" data-value-separator="<?php echo $mensalidade_edit->cliente_idcliente->displayValueSeparatorAttribute() ?>" id="x_cliente_idcliente" name="x_cliente_idcliente"<?php echo $mensalidade_edit->cliente_idcliente->editAttributes() ?>>
			<?php echo $mensalidade_edit->cliente_idcliente->selectOptionListHtml("x_cliente_idcliente") ?>
		</select>
</div>
<?php echo $mensalidade_edit->cliente_idcliente->Lookup->getParamTag($mensalidade_edit, "p_x_cliente_idcliente") ?>
</span>
<?php echo $mensalidade_edit->cliente_idcliente->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mensalidade_edit->mes->Visible) { // mes ?>
	<div id="r_mes" class="form-group row">
		<label id="elh_mensalidade_mes" for="x_mes" class="<?php echo $mensalidade_edit->LeftColumnClass ?>"><?php echo $mensalidade_edit->mes->caption() ?><?php echo $mensalidade_edit->mes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_edit->RightColumnClass ?>"><div <?php echo $mensalidade_edit->mes->cellAttributes() ?>>
<span id="el_mensalidade_mes">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mensalidade" data-field="x_mes" data-value-separator="<?php echo $mensalidade_edit->mes->displayValueSeparatorAttribute() ?>" id="x_mes" name="x_mes"<?php echo $mensalidade_edit->mes->editAttributes() ?>>
			<?php echo $mensalidade_edit->mes->selectOptionListHtml("x_mes") ?>
		</select>
</div>
<?php echo $mensalidade_edit->mes->Lookup->getParamTag($mensalidade_edit, "p_x_mes") ?>
</span>
<?php echo $mensalidade_edit->mes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mensalidade_edit->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_mensalidade_status" for="x_status" class="<?php echo $mensalidade_edit->LeftColumnClass ?>"><?php echo $mensalidade_edit->status->caption() ?><?php echo $mensalidade_edit->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_edit->RightColumnClass ?>"><div <?php echo $mensalidade_edit->status->cellAttributes() ?>>
<span id="el_mensalidade_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mensalidade" data-field="x_status" data-value-separator="<?php echo $mensalidade_edit->status->displayValueSeparatorAttribute() ?>" id="x_status" name="x_status"<?php echo $mensalidade_edit->status->editAttributes() ?>>
			<?php echo $mensalidade_edit->status->selectOptionListHtml("x_status") ?>
		</select>
</div>
</span>
<?php echo $mensalidade_edit->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mensalidade_edit->valor->Visible) { // valor ?>
	<div id="r_valor" class="form-group row">
		<label id="elh_mensalidade_valor" class="<?php echo $mensalidade_edit->LeftColumnClass ?>"><?php echo $mensalidade_edit->valor->caption() ?><?php echo $mensalidade_edit->valor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_edit->RightColumnClass ?>"><div <?php echo $mensalidade_edit->valor->cellAttributes() ?>>
<span id="el_mensalidade_valor">
<div id="tp_x_valor" class="ew-template"><input type="radio" class="custom-control-input" data-table="mensalidade" data-field="x_valor" data-value-separator="<?php echo $mensalidade_edit->valor->displayValueSeparatorAttribute() ?>" name="x_valor" id="x_valor" value="{value}"<?php echo $mensalidade_edit->valor->editAttributes() ?>></div>
<div id="dsl_x_valor" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $mensalidade_edit->valor->radioButtonListHtml(FALSE, "x_valor") ?>
</div></div>
</span>
<?php echo $mensalidade_edit->valor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mensalidade_edit->data_pagamento->Visible) { // data_pagamento ?>
	<div id="r_data_pagamento" class="form-group row">
		<label id="elh_mensalidade_data_pagamento" for="x_data_pagamento" class="<?php echo $mensalidade_edit->LeftColumnClass ?>"><?php echo $mensalidade_edit->data_pagamento->caption() ?><?php echo $mensalidade_edit->data_pagamento->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_edit->RightColumnClass ?>"><div <?php echo $mensalidade_edit->data_pagamento->cellAttributes() ?>>
<span id="el_mensalidade_data_pagamento">
<input type="text" data-table="mensalidade" data-field="x_data_pagamento" data-format="7" name="x_data_pagamento" id="x_data_pagamento" maxlength="10" placeholder="<?php echo HtmlEncode($mensalidade_edit->data_pagamento->getPlaceHolder()) ?>" value="<?php echo $mensalidade_edit->data_pagamento->EditValue ?>"<?php echo $mensalidade_edit->data_pagamento->editAttributes() ?>>
<?php if (!$mensalidade_edit->data_pagamento->ReadOnly && !$mensalidade_edit->data_pagamento->Disabled && !isset($mensalidade_edit->data_pagamento->EditAttrs["readonly"]) && !isset($mensalidade_edit->data_pagamento->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmensalidadeedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fmensalidadeedit", "x_data_pagamento", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php echo $mensalidade_edit->data_pagamento->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$mensalidade_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $mensalidade_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $mensalidade_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$mensalidade_edit->showPageFooter();
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
$mensalidade_edit->terminate();
?>