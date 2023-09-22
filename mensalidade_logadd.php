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
$mensalidade_log_add = new mensalidade_log_add();

// Run the page
$mensalidade_log_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mensalidade_log_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmensalidade_logadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fmensalidade_logadd = currentForm = new ew.Form("fmensalidade_logadd", "add");

	// Validate form
	fmensalidade_logadd.validate = function() {
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
			<?php if ($mensalidade_log_add->cliente->Required) { ?>
				elm = this.getElements("x" + infix + "_cliente");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_add->cliente->caption(), $mensalidade_log_add->cliente->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_log_add->mes->Required) { ?>
				elm = this.getElements("x" + infix + "_mes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_add->mes->caption(), $mensalidade_log_add->mes->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_log_add->valor->Required) { ?>
				elm = this.getElements("x" + infix + "_valor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_add->valor->caption(), $mensalidade_log_add->valor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_log_add->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_add->status->caption(), $mensalidade_log_add->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_log_add->data_pagamento->Required) { ?>
				elm = this.getElements("x" + infix + "_data_pagamento");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_add->data_pagamento->caption(), $mensalidade_log_add->data_pagamento->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_data_pagamento");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($mensalidade_log_add->data_pagamento->errorMessage()) ?>");
			<?php if ($mensalidade_log_add->acao->Required) { ?>
				elm = this.getElements("x" + infix + "_acao");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_add->acao->caption(), $mensalidade_log_add->acao->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_log_add->data_hora->Required) { ?>
				elm = this.getElements("x" + infix + "_data_hora");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_add->data_hora->caption(), $mensalidade_log_add->data_hora->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_data_hora");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($mensalidade_log_add->data_hora->errorMessage()) ?>");

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
	fmensalidade_logadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmensalidade_logadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmensalidade_logadd.lists["x_cliente"] = <?php echo $mensalidade_log_add->cliente->Lookup->toClientList($mensalidade_log_add) ?>;
	fmensalidade_logadd.lists["x_cliente"].options = <?php echo JsonEncode($mensalidade_log_add->cliente->lookupOptions()) ?>;
	fmensalidade_logadd.lists["x_valor"] = <?php echo $mensalidade_log_add->valor->Lookup->toClientList($mensalidade_log_add) ?>;
	fmensalidade_logadd.lists["x_valor"].options = <?php echo JsonEncode($mensalidade_log_add->valor->options(FALSE, TRUE)) ?>;
	fmensalidade_logadd.lists["x_status"] = <?php echo $mensalidade_log_add->status->Lookup->toClientList($mensalidade_log_add) ?>;
	fmensalidade_logadd.lists["x_status"].options = <?php echo JsonEncode($mensalidade_log_add->status->options(FALSE, TRUE)) ?>;
	fmensalidade_logadd.lists["x_acao"] = <?php echo $mensalidade_log_add->acao->Lookup->toClientList($mensalidade_log_add) ?>;
	fmensalidade_logadd.lists["x_acao"].options = <?php echo JsonEncode($mensalidade_log_add->acao->options(FALSE, TRUE)) ?>;
	loadjs.done("fmensalidade_logadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $mensalidade_log_add->showPageHeader(); ?>
<?php
$mensalidade_log_add->showMessage();
?>
<form name="fmensalidade_logadd" id="fmensalidade_logadd" class="<?php echo $mensalidade_log_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mensalidade_log">
<?php if ($mensalidade_log->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$mensalidade_log_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($mensalidade_log_add->cliente->Visible) { // cliente ?>
	<div id="r_cliente" class="form-group row">
		<label id="elh_mensalidade_log_cliente" for="x_cliente" class="<?php echo $mensalidade_log_add->LeftColumnClass ?>"><?php echo $mensalidade_log_add->cliente->caption() ?><?php echo $mensalidade_log_add->cliente->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_log_add->RightColumnClass ?>"><div <?php echo $mensalidade_log_add->cliente->cellAttributes() ?>>
<?php if (!$mensalidade_log->isConfirm()) { ?>
<span id="el_mensalidade_log_cliente">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mensalidade_log" data-field="x_cliente" data-value-separator="<?php echo $mensalidade_log_add->cliente->displayValueSeparatorAttribute() ?>" id="x_cliente" name="x_cliente"<?php echo $mensalidade_log_add->cliente->editAttributes() ?>>
			<?php echo $mensalidade_log_add->cliente->selectOptionListHtml("x_cliente") ?>
		</select>
</div>
<?php echo $mensalidade_log_add->cliente->Lookup->getParamTag($mensalidade_log_add, "p_x_cliente") ?>
</span>
<?php } else { ?>
<span id="el_mensalidade_log_cliente">
<span<?php echo $mensalidade_log_add->cliente->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_log_add->cliente->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_cliente" name="x_cliente" id="x_cliente" value="<?php echo HtmlEncode($mensalidade_log_add->cliente->FormValue) ?>">
<?php } ?>
<?php echo $mensalidade_log_add->cliente->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mensalidade_log_add->mes->Visible) { // mes ?>
	<div id="r_mes" class="form-group row">
		<label id="elh_mensalidade_log_mes" for="x_mes" class="<?php echo $mensalidade_log_add->LeftColumnClass ?>"><?php echo $mensalidade_log_add->mes->caption() ?><?php echo $mensalidade_log_add->mes->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_log_add->RightColumnClass ?>"><div <?php echo $mensalidade_log_add->mes->cellAttributes() ?>>
<?php if (!$mensalidade_log->isConfirm()) { ?>
<span id="el_mensalidade_log_mes">
<input type="text" data-table="mensalidade_log" data-field="x_mes" name="x_mes" id="x_mes" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($mensalidade_log_add->mes->getPlaceHolder()) ?>" value="<?php echo $mensalidade_log_add->mes->EditValue ?>"<?php echo $mensalidade_log_add->mes->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_mensalidade_log_mes">
<span<?php echo $mensalidade_log_add->mes->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_log_add->mes->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_mes" name="x_mes" id="x_mes" value="<?php echo HtmlEncode($mensalidade_log_add->mes->FormValue) ?>">
<?php } ?>
<?php echo $mensalidade_log_add->mes->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mensalidade_log_add->valor->Visible) { // valor ?>
	<div id="r_valor" class="form-group row">
		<label id="elh_mensalidade_log_valor" class="<?php echo $mensalidade_log_add->LeftColumnClass ?>"><?php echo $mensalidade_log_add->valor->caption() ?><?php echo $mensalidade_log_add->valor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_log_add->RightColumnClass ?>"><div <?php echo $mensalidade_log_add->valor->cellAttributes() ?>>
<?php if (!$mensalidade_log->isConfirm()) { ?>
<span id="el_mensalidade_log_valor">
<div id="tp_x_valor" class="ew-template"><input type="radio" class="custom-control-input" data-table="mensalidade_log" data-field="x_valor" data-value-separator="<?php echo $mensalidade_log_add->valor->displayValueSeparatorAttribute() ?>" name="x_valor" id="x_valor" value="{value}"<?php echo $mensalidade_log_add->valor->editAttributes() ?>></div>
<div id="dsl_x_valor" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $mensalidade_log_add->valor->radioButtonListHtml(FALSE, "x_valor") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el_mensalidade_log_valor">
<span<?php echo $mensalidade_log_add->valor->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_log_add->valor->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_valor" name="x_valor" id="x_valor" value="<?php echo HtmlEncode($mensalidade_log_add->valor->FormValue) ?>">
<?php } ?>
<?php echo $mensalidade_log_add->valor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mensalidade_log_add->status->Visible) { // status ?>
	<div id="r_status" class="form-group row">
		<label id="elh_mensalidade_log_status" for="x_status" class="<?php echo $mensalidade_log_add->LeftColumnClass ?>"><?php echo $mensalidade_log_add->status->caption() ?><?php echo $mensalidade_log_add->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_log_add->RightColumnClass ?>"><div <?php echo $mensalidade_log_add->status->cellAttributes() ?>>
<?php if (!$mensalidade_log->isConfirm()) { ?>
<span id="el_mensalidade_log_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mensalidade_log" data-field="x_status" data-value-separator="<?php echo $mensalidade_log_add->status->displayValueSeparatorAttribute() ?>" id="x_status" name="x_status"<?php echo $mensalidade_log_add->status->editAttributes() ?>>
			<?php echo $mensalidade_log_add->status->selectOptionListHtml("x_status") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el_mensalidade_log_status">
<span<?php echo $mensalidade_log_add->status->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_log_add->status->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_status" name="x_status" id="x_status" value="<?php echo HtmlEncode($mensalidade_log_add->status->FormValue) ?>">
<?php } ?>
<?php echo $mensalidade_log_add->status->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mensalidade_log_add->data_pagamento->Visible) { // data_pagamento ?>
	<div id="r_data_pagamento" class="form-group row">
		<label id="elh_mensalidade_log_data_pagamento" for="x_data_pagamento" class="<?php echo $mensalidade_log_add->LeftColumnClass ?>"><?php echo $mensalidade_log_add->data_pagamento->caption() ?><?php echo $mensalidade_log_add->data_pagamento->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_log_add->RightColumnClass ?>"><div <?php echo $mensalidade_log_add->data_pagamento->cellAttributes() ?>>
<?php if (!$mensalidade_log->isConfirm()) { ?>
<span id="el_mensalidade_log_data_pagamento">
<input type="text" data-table="mensalidade_log" data-field="x_data_pagamento" data-format="7" name="x_data_pagamento" id="x_data_pagamento" maxlength="10" placeholder="<?php echo HtmlEncode($mensalidade_log_add->data_pagamento->getPlaceHolder()) ?>" value="<?php echo $mensalidade_log_add->data_pagamento->EditValue ?>"<?php echo $mensalidade_log_add->data_pagamento->editAttributes() ?>>
<?php if (!$mensalidade_log_add->data_pagamento->ReadOnly && !$mensalidade_log_add->data_pagamento->Disabled && !isset($mensalidade_log_add->data_pagamento->EditAttrs["readonly"]) && !isset($mensalidade_log_add->data_pagamento->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmensalidade_logadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fmensalidade_logadd", "x_data_pagamento", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_mensalidade_log_data_pagamento">
<span<?php echo $mensalidade_log_add->data_pagamento->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_log_add->data_pagamento->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_data_pagamento" name="x_data_pagamento" id="x_data_pagamento" value="<?php echo HtmlEncode($mensalidade_log_add->data_pagamento->FormValue) ?>">
<?php } ?>
<?php echo $mensalidade_log_add->data_pagamento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mensalidade_log_add->acao->Visible) { // acao ?>
	<div id="r_acao" class="form-group row">
		<label id="elh_mensalidade_log_acao" for="x_acao" class="<?php echo $mensalidade_log_add->LeftColumnClass ?>"><?php echo $mensalidade_log_add->acao->caption() ?><?php echo $mensalidade_log_add->acao->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_log_add->RightColumnClass ?>"><div <?php echo $mensalidade_log_add->acao->cellAttributes() ?>>
<?php if (!$mensalidade_log->isConfirm()) { ?>
<span id="el_mensalidade_log_acao">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mensalidade_log" data-field="x_acao" data-value-separator="<?php echo $mensalidade_log_add->acao->displayValueSeparatorAttribute() ?>" id="x_acao" name="x_acao"<?php echo $mensalidade_log_add->acao->editAttributes() ?>>
			<?php echo $mensalidade_log_add->acao->selectOptionListHtml("x_acao") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el_mensalidade_log_acao">
<span<?php echo $mensalidade_log_add->acao->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_log_add->acao->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_acao" name="x_acao" id="x_acao" value="<?php echo HtmlEncode($mensalidade_log_add->acao->FormValue) ?>">
<?php } ?>
<?php echo $mensalidade_log_add->acao->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($mensalidade_log_add->data_hora->Visible) { // data_hora ?>
	<div id="r_data_hora" class="form-group row">
		<label id="elh_mensalidade_log_data_hora" for="x_data_hora" class="<?php echo $mensalidade_log_add->LeftColumnClass ?>"><?php echo $mensalidade_log_add->data_hora->caption() ?><?php echo $mensalidade_log_add->data_hora->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $mensalidade_log_add->RightColumnClass ?>"><div <?php echo $mensalidade_log_add->data_hora->cellAttributes() ?>>
<?php if (!$mensalidade_log->isConfirm()) { ?>
<span id="el_mensalidade_log_data_hora">
<input type="text" data-table="mensalidade_log" data-field="x_data_hora" data-format="1" name="x_data_hora" id="x_data_hora" maxlength="19" placeholder="<?php echo HtmlEncode($mensalidade_log_add->data_hora->getPlaceHolder()) ?>" value="<?php echo $mensalidade_log_add->data_hora->EditValue ?>"<?php echo $mensalidade_log_add->data_hora->editAttributes() ?>>
<?php if (!$mensalidade_log_add->data_hora->ReadOnly && !$mensalidade_log_add->data_hora->Disabled && !isset($mensalidade_log_add->data_hora->EditAttrs["readonly"]) && !isset($mensalidade_log_add->data_hora->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmensalidade_logadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fmensalidade_logadd", "x_data_hora", {"ignoreReadonly":true,"useCurrent":false,"format":1});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_mensalidade_log_data_hora">
<span<?php echo $mensalidade_log_add->data_hora->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_log_add->data_hora->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_data_hora" name="x_data_hora" id="x_data_hora" value="<?php echo HtmlEncode($mensalidade_log_add->data_hora->FormValue) ?>">
<?php } ?>
<?php echo $mensalidade_log_add->data_hora->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$mensalidade_log_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $mensalidade_log_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$mensalidade_log->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $mensalidade_log_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$mensalidade_log_add->showPageFooter();
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
$mensalidade_log_add->terminate();
?>