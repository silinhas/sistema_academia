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
$agenda_log_add = new agenda_log_add();

// Run the page
$agenda_log_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$agenda_log_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fagenda_logadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fagenda_logadd = currentForm = new ew.Form("fagenda_logadd", "add");

	// Validate form
	fagenda_logadd.validate = function() {
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
			<?php if ($agenda_log_add->data->Required) { ?>
				elm = this.getElements("x" + infix + "_data");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_log_add->data->caption(), $agenda_log_add->data->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_data");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($agenda_log_add->data->errorMessage()) ?>");
			<?php if ($agenda_log_add->hora->Required) { ?>
				elm = this.getElements("x" + infix + "_hora");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_log_add->hora->caption(), $agenda_log_add->hora->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_hora");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($agenda_log_add->hora->errorMessage()) ?>");
			<?php if ($agenda_log_add->data_now->Required) { ?>
				elm = this.getElements("x" + infix + "_data_now");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_log_add->data_now->caption(), $agenda_log_add->data_now->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_data_now");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($agenda_log_add->data_now->errorMessage()) ?>");
			<?php if ($agenda_log_add->professor->Required) { ?>
				elm = this.getElements("x" + infix + "_professor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_log_add->professor->caption(), $agenda_log_add->professor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_log_add->cliente->Required) { ?>
				elm = this.getElements("x" + infix + "_cliente");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_log_add->cliente->caption(), $agenda_log_add->cliente->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_log_add->acao->Required) { ?>
				elm = this.getElements("x" + infix + "_acao");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_log_add->acao->caption(), $agenda_log_add->acao->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_log_add->data_hora->Required) { ?>
				elm = this.getElements("x" + infix + "_data_hora");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_log_add->data_hora->caption(), $agenda_log_add->data_hora->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_data_hora");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($agenda_log_add->data_hora->errorMessage()) ?>");

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
	fagenda_logadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fagenda_logadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fagenda_logadd.lists["x_professor"] = <?php echo $agenda_log_add->professor->Lookup->toClientList($agenda_log_add) ?>;
	fagenda_logadd.lists["x_professor"].options = <?php echo JsonEncode($agenda_log_add->professor->lookupOptions()) ?>;
	fagenda_logadd.lists["x_cliente"] = <?php echo $agenda_log_add->cliente->Lookup->toClientList($agenda_log_add) ?>;
	fagenda_logadd.lists["x_cliente"].options = <?php echo JsonEncode($agenda_log_add->cliente->lookupOptions()) ?>;
	fagenda_logadd.lists["x_acao"] = <?php echo $agenda_log_add->acao->Lookup->toClientList($agenda_log_add) ?>;
	fagenda_logadd.lists["x_acao"].options = <?php echo JsonEncode($agenda_log_add->acao->options(FALSE, TRUE)) ?>;
	loadjs.done("fagenda_logadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $agenda_log_add->showPageHeader(); ?>
<?php
$agenda_log_add->showMessage();
?>
<form name="fagenda_logadd" id="fagenda_logadd" class="<?php echo $agenda_log_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="agenda_log">
<?php if ($agenda_log->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$agenda_log_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($agenda_log_add->data->Visible) { // data ?>
	<div id="r_data" class="form-group row">
		<label id="elh_agenda_log_data" for="x_data" class="<?php echo $agenda_log_add->LeftColumnClass ?>"><?php echo $agenda_log_add->data->caption() ?><?php echo $agenda_log_add->data->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_log_add->RightColumnClass ?>"><div <?php echo $agenda_log_add->data->cellAttributes() ?>>
<?php if (!$agenda_log->isConfirm()) { ?>
<span id="el_agenda_log_data">
<input type="text" data-table="agenda_log" data-field="x_data" name="x_data" id="x_data" maxlength="10" placeholder="<?php echo HtmlEncode($agenda_log_add->data->getPlaceHolder()) ?>" value="<?php echo $agenda_log_add->data->EditValue ?>"<?php echo $agenda_log_add->data->editAttributes() ?>>
<?php if (!$agenda_log_add->data->ReadOnly && !$agenda_log_add->data->Disabled && !isset($agenda_log_add->data->EditAttrs["readonly"]) && !isset($agenda_log_add->data->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fagenda_logadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fagenda_logadd", "x_data", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_agenda_log_data">
<span<?php echo $agenda_log_add->data->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($agenda_log_add->data->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="agenda_log" data-field="x_data" name="x_data" id="x_data" value="<?php echo HtmlEncode($agenda_log_add->data->FormValue) ?>">
<?php } ?>
<?php echo $agenda_log_add->data->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_log_add->hora->Visible) { // hora ?>
	<div id="r_hora" class="form-group row">
		<label id="elh_agenda_log_hora" for="x_hora" class="<?php echo $agenda_log_add->LeftColumnClass ?>"><?php echo $agenda_log_add->hora->caption() ?><?php echo $agenda_log_add->hora->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_log_add->RightColumnClass ?>"><div <?php echo $agenda_log_add->hora->cellAttributes() ?>>
<?php if (!$agenda_log->isConfirm()) { ?>
<span id="el_agenda_log_hora">
<input type="text" data-table="agenda_log" data-field="x_hora" name="x_hora" id="x_hora" maxlength="10" placeholder="<?php echo HtmlEncode($agenda_log_add->hora->getPlaceHolder()) ?>" value="<?php echo $agenda_log_add->hora->EditValue ?>"<?php echo $agenda_log_add->hora->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_agenda_log_hora">
<span<?php echo $agenda_log_add->hora->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($agenda_log_add->hora->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="agenda_log" data-field="x_hora" name="x_hora" id="x_hora" value="<?php echo HtmlEncode($agenda_log_add->hora->FormValue) ?>">
<?php } ?>
<?php echo $agenda_log_add->hora->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_log_add->data_now->Visible) { // data_now ?>
	<div id="r_data_now" class="form-group row">
		<label id="elh_agenda_log_data_now" for="x_data_now" class="<?php echo $agenda_log_add->LeftColumnClass ?>"><?php echo $agenda_log_add->data_now->caption() ?><?php echo $agenda_log_add->data_now->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_log_add->RightColumnClass ?>"><div <?php echo $agenda_log_add->data_now->cellAttributes() ?>>
<?php if (!$agenda_log->isConfirm()) { ?>
<span id="el_agenda_log_data_now">
<input type="text" data-table="agenda_log" data-field="x_data_now" data-format="2" name="x_data_now" id="x_data_now" maxlength="10" placeholder="<?php echo HtmlEncode($agenda_log_add->data_now->getPlaceHolder()) ?>" value="<?php echo $agenda_log_add->data_now->EditValue ?>"<?php echo $agenda_log_add->data_now->editAttributes() ?>>
<?php if (!$agenda_log_add->data_now->ReadOnly && !$agenda_log_add->data_now->Disabled && !isset($agenda_log_add->data_now->EditAttrs["readonly"]) && !isset($agenda_log_add->data_now->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fagenda_logadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fagenda_logadd", "x_data_now", {"ignoreReadonly":true,"useCurrent":false,"format":2});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_agenda_log_data_now">
<span<?php echo $agenda_log_add->data_now->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($agenda_log_add->data_now->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="agenda_log" data-field="x_data_now" name="x_data_now" id="x_data_now" value="<?php echo HtmlEncode($agenda_log_add->data_now->FormValue) ?>">
<?php } ?>
<?php echo $agenda_log_add->data_now->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_log_add->professor->Visible) { // professor ?>
	<div id="r_professor" class="form-group row">
		<label id="elh_agenda_log_professor" for="x_professor" class="<?php echo $agenda_log_add->LeftColumnClass ?>"><?php echo $agenda_log_add->professor->caption() ?><?php echo $agenda_log_add->professor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_log_add->RightColumnClass ?>"><div <?php echo $agenda_log_add->professor->cellAttributes() ?>>
<?php if (!$agenda_log->isConfirm()) { ?>
<span id="el_agenda_log_professor">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda_log" data-field="x_professor" data-value-separator="<?php echo $agenda_log_add->professor->displayValueSeparatorAttribute() ?>" id="x_professor" name="x_professor"<?php echo $agenda_log_add->professor->editAttributes() ?>>
			<?php echo $agenda_log_add->professor->selectOptionListHtml("x_professor") ?>
		</select>
</div>
<?php echo $agenda_log_add->professor->Lookup->getParamTag($agenda_log_add, "p_x_professor") ?>
</span>
<?php } else { ?>
<span id="el_agenda_log_professor">
<span<?php echo $agenda_log_add->professor->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($agenda_log_add->professor->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="agenda_log" data-field="x_professor" name="x_professor" id="x_professor" value="<?php echo HtmlEncode($agenda_log_add->professor->FormValue) ?>">
<?php } ?>
<?php echo $agenda_log_add->professor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_log_add->cliente->Visible) { // cliente ?>
	<div id="r_cliente" class="form-group row">
		<label id="elh_agenda_log_cliente" for="x_cliente" class="<?php echo $agenda_log_add->LeftColumnClass ?>"><?php echo $agenda_log_add->cliente->caption() ?><?php echo $agenda_log_add->cliente->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_log_add->RightColumnClass ?>"><div <?php echo $agenda_log_add->cliente->cellAttributes() ?>>
<?php if (!$agenda_log->isConfirm()) { ?>
<span id="el_agenda_log_cliente">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda_log" data-field="x_cliente" data-value-separator="<?php echo $agenda_log_add->cliente->displayValueSeparatorAttribute() ?>" id="x_cliente" name="x_cliente"<?php echo $agenda_log_add->cliente->editAttributes() ?>>
			<?php echo $agenda_log_add->cliente->selectOptionListHtml("x_cliente") ?>
		</select>
</div>
<?php echo $agenda_log_add->cliente->Lookup->getParamTag($agenda_log_add, "p_x_cliente") ?>
</span>
<?php } else { ?>
<span id="el_agenda_log_cliente">
<span<?php echo $agenda_log_add->cliente->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($agenda_log_add->cliente->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="agenda_log" data-field="x_cliente" name="x_cliente" id="x_cliente" value="<?php echo HtmlEncode($agenda_log_add->cliente->FormValue) ?>">
<?php } ?>
<?php echo $agenda_log_add->cliente->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_log_add->acao->Visible) { // acao ?>
	<div id="r_acao" class="form-group row">
		<label id="elh_agenda_log_acao" for="x_acao" class="<?php echo $agenda_log_add->LeftColumnClass ?>"><?php echo $agenda_log_add->acao->caption() ?><?php echo $agenda_log_add->acao->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_log_add->RightColumnClass ?>"><div <?php echo $agenda_log_add->acao->cellAttributes() ?>>
<?php if (!$agenda_log->isConfirm()) { ?>
<span id="el_agenda_log_acao">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda_log" data-field="x_acao" data-value-separator="<?php echo $agenda_log_add->acao->displayValueSeparatorAttribute() ?>" id="x_acao" name="x_acao"<?php echo $agenda_log_add->acao->editAttributes() ?>>
			<?php echo $agenda_log_add->acao->selectOptionListHtml("x_acao") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el_agenda_log_acao">
<span<?php echo $agenda_log_add->acao->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($agenda_log_add->acao->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="agenda_log" data-field="x_acao" name="x_acao" id="x_acao" value="<?php echo HtmlEncode($agenda_log_add->acao->FormValue) ?>">
<?php } ?>
<?php echo $agenda_log_add->acao->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_log_add->data_hora->Visible) { // data_hora ?>
	<div id="r_data_hora" class="form-group row">
		<label id="elh_agenda_log_data_hora" for="x_data_hora" class="<?php echo $agenda_log_add->LeftColumnClass ?>"><?php echo $agenda_log_add->data_hora->caption() ?><?php echo $agenda_log_add->data_hora->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_log_add->RightColumnClass ?>"><div <?php echo $agenda_log_add->data_hora->cellAttributes() ?>>
<?php if (!$agenda_log->isConfirm()) { ?>
<span id="el_agenda_log_data_hora">
<input type="text" data-table="agenda_log" data-field="x_data_hora" data-format="1" name="x_data_hora" id="x_data_hora" maxlength="19" placeholder="<?php echo HtmlEncode($agenda_log_add->data_hora->getPlaceHolder()) ?>" value="<?php echo $agenda_log_add->data_hora->EditValue ?>"<?php echo $agenda_log_add->data_hora->editAttributes() ?>>
<?php if (!$agenda_log_add->data_hora->ReadOnly && !$agenda_log_add->data_hora->Disabled && !isset($agenda_log_add->data_hora->EditAttrs["readonly"]) && !isset($agenda_log_add->data_hora->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fagenda_logadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fagenda_logadd", "x_data_hora", {"ignoreReadonly":true,"useCurrent":false,"format":1});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_agenda_log_data_hora">
<span<?php echo $agenda_log_add->data_hora->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($agenda_log_add->data_hora->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="agenda_log" data-field="x_data_hora" name="x_data_hora" id="x_data_hora" value="<?php echo HtmlEncode($agenda_log_add->data_hora->FormValue) ?>">
<?php } ?>
<?php echo $agenda_log_add->data_hora->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$agenda_log_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $agenda_log_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$agenda_log->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $agenda_log_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$agenda_log_add->showPageFooter();
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
$agenda_log_add->terminate();
?>