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
$mensalidade_add = new mensalidade_add();

// Run the page
$mensalidade_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mensalidade_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmensalidadeadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fmensalidadeadd = currentForm = new ew.Form("fmensalidadeadd", "add");

	// Validate form
	fmensalidadeadd.validate = function() {
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
			<?php if ($mensalidade_add->cliente_idcliente->Required) { ?>
				elm = this.getElements("x" + infix + "_cliente_idcliente");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_add->cliente_idcliente->caption(), $mensalidade_add->cliente_idcliente->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_add->mes->Required) { ?>
				elm = this.getElements("x" + infix + "_mes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_add->mes->caption(), $mensalidade_add->mes->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_add->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_add->status->caption(), $mensalidade_add->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_add->valor->Required) { ?>
				elm = this.getElements("x" + infix + "_valor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_add->valor->caption(), $mensalidade_add->valor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_add->data_pagamento->Required) { ?>
				elm = this.getElements("x" + infix + "_data_pagamento");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_add->data_pagamento->caption(), $mensalidade_add->data_pagamento->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_data_pagamento");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($mensalidade_add->data_pagamento->errorMessage()) ?>");

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
	fmensalidadeadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmensalidadeadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmensalidadeadd.lists["x_cliente_idcliente"] = <?php echo $mensalidade_add->cliente_idcliente->Lookup->toClientList($mensalidade_add) ?>;
	fmensalidadeadd.lists["x_cliente_idcliente"].options = <?php echo JsonEncode($mensalidade_add->cliente_idcliente->lookupOptions()) ?>;
	fmensalidadeadd.lists["x_mes"] = <?php echo $mensalidade_add->mes->Lookup->toClientList($mensalidade_add) ?>;
	fmensalidadeadd.lists["x_mes"].options = <?php echo JsonEncode($mensalidade_add->mes->lookupOptions()) ?>;
	fmensalidadeadd.lists["x_status"] = <?php echo $mensalidade_add->status->Lookup->toClientList($mensalidade_add) ?>;
	fmensalidadeadd.lists["x_status"].options = <?php echo JsonEncode($mensalidade_add->status->options(FALSE, TRUE)) ?>;
	fmensalidadeadd.lists["x_valor"] = <?php echo $mensalidade_add->valor->Lookup->toClientList($mensalidade_add) ?>;
	fmensalidadeadd.lists["x_valor"].options = <?php echo JsonEncode($mensalidade_add->valor->options(FALSE, TRUE)) ?>;
	loadjs.done("fmensalidadeadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $mensalidade_add->showPageHeader(); ?>
<?php
$mensalidade_add->showMessage();
?>
<form name="fmensalidadeadd" id="fmensalidadeadd" class="<?php echo $mensalidade_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mensalidade">
<?php if ($mensalidade->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$mensalidade_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($mensalidade_add->cliente_idcliente->Visible) { // cliente_idcliente ?>
	<div id="r_cliente_idcliente" class="form-group row">
		<label id="elh_mensalidade_cliente_idcliente" for="x_cliente_idcliente" class="<?php echo $mensalidade_add->LeftColumnClass ?>"><?php echo $mensalidade_add->cliente_idcliente->caption() ?><?php echo $mensalidade_add->cliente_idcliente->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_add->RightColumnClass ?>"><div <?php echo $mensalidade_add->cliente_idcliente->cellAttributes() ?>>
<?php if (!$mensalidade->isConfirm()) { ?>
<span id="el_mensalidade_cliente_idcliente">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mensalidade" data-field="x_cliente_idcliente" data-value-separator="<?php echo $mensalidade_add->cliente_idcliente->displayValueSeparatorAttribute() ?>" id="x_cliente_idcliente" name="x_cliente_idcliente"<?php echo $mensalidade_add->cliente_idcliente->editAttributes() ?>>
			<?php echo $mensalidade_add->cliente_idcliente->selectOptionListHtml("x_cliente_idcliente") ?>
		</select>
</div>
<?php echo $mensalidade_add->cliente_idcliente->Lookup->getParamTag($mensalidade_add, "p_x_cliente_idcliente") ?>
</span>
<?php } else { ?>
<span id="el_mensalidade_cliente_idcliente">
<span<?php echo $mensalidade_add->cliente_idcliente->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_add->cliente_idcliente->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade" data-field="x_cliente_idcliente" name="x_cliente_idcliente" id="x_cliente_idcliente" value="<?php echo HtmlEncode($mensalidade_add->cliente_idcliente->FormValue) ?>">
<?php } ?>
<?php echo $mensalidade_add->cliente_idcliente->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mensalidade_add->mes->Visible) { // mes ?>
	<div id="r_mes" class="form-group row">
		<label id="elh_mensalidade_mes" for="x_mes" class="<?php echo $mensalidade_add->LeftColumnClass ?>"><?php echo $mensalidade_add->mes->caption() ?><?php echo $mensalidade_add->mes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_add->RightColumnClass ?>"><div <?php echo $mensalidade_add->mes->cellAttributes() ?>>
<?php if (!$mensalidade->isConfirm()) { ?>
<span id="el_mensalidade_mes">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mensalidade" data-field="x_mes" data-value-separator="<?php echo $mensalidade_add->mes->displayValueSeparatorAttribute() ?>" id="x_mes" name="x_mes"<?php echo $mensalidade_add->mes->editAttributes() ?>>
			<?php echo $mensalidade_add->mes->selectOptionListHtml("x_mes") ?>
		</select>
</div>
<?php echo $mensalidade_add->mes->Lookup->getParamTag($mensalidade_add, "p_x_mes") ?>
</span>
<?php } else { ?>
<span id="el_mensalidade_mes">
<span<?php echo $mensalidade_add->mes->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_add->mes->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade" data-field="x_mes" name="x_mes" id="x_mes" value="<?php echo HtmlEncode($mensalidade_add->mes->FormValue) ?>">
<?php } ?>
<?php echo $mensalidade_add->mes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mensalidade_add->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_mensalidade_status" for="x_status" class="<?php echo $mensalidade_add->LeftColumnClass ?>"><?php echo $mensalidade_add->status->caption() ?><?php echo $mensalidade_add->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_add->RightColumnClass ?>"><div <?php echo $mensalidade_add->status->cellAttributes() ?>>
<?php if (!$mensalidade->isConfirm()) { ?>
<span id="el_mensalidade_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mensalidade" data-field="x_status" data-value-separator="<?php echo $mensalidade_add->status->displayValueSeparatorAttribute() ?>" id="x_status" name="x_status"<?php echo $mensalidade_add->status->editAttributes() ?>>
			<?php echo $mensalidade_add->status->selectOptionListHtml("x_status") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el_mensalidade_status">
<span<?php echo $mensalidade_add->status->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_add->status->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade" data-field="x_status" name="x_status" id="x_status" value="<?php echo HtmlEncode($mensalidade_add->status->FormValue) ?>">
<?php } ?>
<?php echo $mensalidade_add->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mensalidade_add->valor->Visible) { // valor ?>
	<div id="r_valor" class="form-group row">
		<label id="elh_mensalidade_valor" class="<?php echo $mensalidade_add->LeftColumnClass ?>"><?php echo $mensalidade_add->valor->caption() ?><?php echo $mensalidade_add->valor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_add->RightColumnClass ?>"><div <?php echo $mensalidade_add->valor->cellAttributes() ?>>
<?php if (!$mensalidade->isConfirm()) { ?>
<span id="el_mensalidade_valor">
<div id="tp_x_valor" class="ew-template"><input type="radio" class="custom-control-input" data-table="mensalidade" data-field="x_valor" data-value-separator="<?php echo $mensalidade_add->valor->displayValueSeparatorAttribute() ?>" name="x_valor" id="x_valor" value="{value}"<?php echo $mensalidade_add->valor->editAttributes() ?>></div>
<div id="dsl_x_valor" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $mensalidade_add->valor->radioButtonListHtml(FALSE, "x_valor") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el_mensalidade_valor">
<span<?php echo $mensalidade_add->valor->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_add->valor->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade" data-field="x_valor" name="x_valor" id="x_valor" value="<?php echo HtmlEncode($mensalidade_add->valor->FormValue) ?>">
<?php } ?>
<?php echo $mensalidade_add->valor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mensalidade_add->data_pagamento->Visible) { // data_pagamento ?>
	<div id="r_data_pagamento" class="form-group row">
		<label id="elh_mensalidade_data_pagamento" for="x_data_pagamento" class="<?php echo $mensalidade_add->LeftColumnClass ?>"><?php echo $mensalidade_add->data_pagamento->caption() ?><?php echo $mensalidade_add->data_pagamento->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_add->RightColumnClass ?>"><div <?php echo $mensalidade_add->data_pagamento->cellAttributes() ?>>
<?php if (!$mensalidade->isConfirm()) { ?>
<span id="el_mensalidade_data_pagamento">
<input type="text" data-table="mensalidade" data-field="x_data_pagamento" data-format="7" name="x_data_pagamento" id="x_data_pagamento" maxlength="10" placeholder="<?php echo HtmlEncode($mensalidade_add->data_pagamento->getPlaceHolder()) ?>" value="<?php echo $mensalidade_add->data_pagamento->EditValue ?>"<?php echo $mensalidade_add->data_pagamento->editAttributes() ?>>
<?php if (!$mensalidade_add->data_pagamento->ReadOnly && !$mensalidade_add->data_pagamento->Disabled && !isset($mensalidade_add->data_pagamento->EditAttrs["readonly"]) && !isset($mensalidade_add->data_pagamento->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmensalidadeadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fmensalidadeadd", "x_data_pagamento", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_mensalidade_data_pagamento">
<span<?php echo $mensalidade_add->data_pagamento->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_add->data_pagamento->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade" data-field="x_data_pagamento" name="x_data_pagamento" id="x_data_pagamento" value="<?php echo HtmlEncode($mensalidade_add->data_pagamento->FormValue) ?>">
<?php } ?>
<?php echo $mensalidade_add->data_pagamento->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$mensalidade_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $mensalidade_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$mensalidade->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $mensalidade_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$mensalidade_add->showPageFooter();
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
$mensalidade_add->terminate();
?>