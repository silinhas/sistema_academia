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
$agenda_log_edit = new agenda_log_edit();

// Run the page
$agenda_log_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$agenda_log_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fagenda_logedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fagenda_logedit = currentForm = new ew.Form("fagenda_logedit", "edit");

	// Validate form
	fagenda_logedit.validate = function() {
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
			<?php if ($agenda_log_edit->idagenda_log->Required) { ?>
				elm = this.getElements("x" + infix + "_idagenda_log");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_log_edit->idagenda_log->caption(), $agenda_log_edit->idagenda_log->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_log_edit->data->Required) { ?>
				elm = this.getElements("x" + infix + "_data");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_log_edit->data->caption(), $agenda_log_edit->data->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_data");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($agenda_log_edit->data->errorMessage()) ?>");
			<?php if ($agenda_log_edit->hora->Required) { ?>
				elm = this.getElements("x" + infix + "_hora");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_log_edit->hora->caption(), $agenda_log_edit->hora->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_hora");
				if (elm && !ew.checkTime(elm.value))
					return this.onError(elm, "<?php echo JsEncode($agenda_log_edit->hora->errorMessage()) ?>");
			<?php if ($agenda_log_edit->data_now->Required) { ?>
				elm = this.getElements("x" + infix + "_data_now");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_log_edit->data_now->caption(), $agenda_log_edit->data_now->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_data_now");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($agenda_log_edit->data_now->errorMessage()) ?>");
			<?php if ($agenda_log_edit->professor->Required) { ?>
				elm = this.getElements("x" + infix + "_professor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_log_edit->professor->caption(), $agenda_log_edit->professor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_log_edit->cliente->Required) { ?>
				elm = this.getElements("x" + infix + "_cliente");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_log_edit->cliente->caption(), $agenda_log_edit->cliente->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_log_edit->acao->Required) { ?>
				elm = this.getElements("x" + infix + "_acao");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_log_edit->acao->caption(), $agenda_log_edit->acao->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_log_edit->data_hora->Required) { ?>
				elm = this.getElements("x" + infix + "_data_hora");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_log_edit->data_hora->caption(), $agenda_log_edit->data_hora->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_data_hora");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($agenda_log_edit->data_hora->errorMessage()) ?>");

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
	fagenda_logedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fagenda_logedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fagenda_logedit.lists["x_professor"] = <?php echo $agenda_log_edit->professor->Lookup->toClientList($agenda_log_edit) ?>;
	fagenda_logedit.lists["x_professor"].options = <?php echo JsonEncode($agenda_log_edit->professor->lookupOptions()) ?>;
	fagenda_logedit.lists["x_cliente"] = <?php echo $agenda_log_edit->cliente->Lookup->toClientList($agenda_log_edit) ?>;
	fagenda_logedit.lists["x_cliente"].options = <?php echo JsonEncode($agenda_log_edit->cliente->lookupOptions()) ?>;
	fagenda_logedit.lists["x_acao"] = <?php echo $agenda_log_edit->acao->Lookup->toClientList($agenda_log_edit) ?>;
	fagenda_logedit.lists["x_acao"].options = <?php echo JsonEncode($agenda_log_edit->acao->options(FALSE, TRUE)) ?>;
	loadjs.done("fagenda_logedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $agenda_log_edit->showPageHeader(); ?>
<?php
$agenda_log_edit->showMessage();
?>
<form name="fagenda_logedit" id="fagenda_logedit" class="<?php echo $agenda_log_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="agenda_log">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$agenda_log_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($agenda_log_edit->idagenda_log->Visible) { // idagenda_log ?>
	<div id="r_idagenda_log" class="form-group row">
		<label id="elh_agenda_log_idagenda_log" class="<?php echo $agenda_log_edit->LeftColumnClass ?>"><?php echo $agenda_log_edit->idagenda_log->caption() ?><?php echo $agenda_log_edit->idagenda_log->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_log_edit->RightColumnClass ?>"><div <?php echo $agenda_log_edit->idagenda_log->cellAttributes() ?>>
<span id="el_agenda_log_idagenda_log">
<span<?php echo $agenda_log_edit->idagenda_log->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($agenda_log_edit->idagenda_log->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="agenda_log" data-field="x_idagenda_log" name="x_idagenda_log" id="x_idagenda_log" value="<?php echo HtmlEncode($agenda_log_edit->idagenda_log->CurrentValue) ?>">
<?php echo $agenda_log_edit->idagenda_log->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_log_edit->data->Visible) { // data ?>
	<div id="r_data" class="form-group row">
		<label id="elh_agenda_log_data" for="x_data" class="<?php echo $agenda_log_edit->LeftColumnClass ?>"><?php echo $agenda_log_edit->data->caption() ?><?php echo $agenda_log_edit->data->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_log_edit->RightColumnClass ?>"><div <?php echo $agenda_log_edit->data->cellAttributes() ?>>
<span id="el_agenda_log_data">
<input type="text" data-table="agenda_log" data-field="x_data" name="x_data" id="x_data" maxlength="10" placeholder="<?php echo HtmlEncode($agenda_log_edit->data->getPlaceHolder()) ?>" value="<?php echo $agenda_log_edit->data->EditValue ?>"<?php echo $agenda_log_edit->data->editAttributes() ?>>
<?php if (!$agenda_log_edit->data->ReadOnly && !$agenda_log_edit->data->Disabled && !isset($agenda_log_edit->data->EditAttrs["readonly"]) && !isset($agenda_log_edit->data->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fagenda_logedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fagenda_logedit", "x_data", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php echo $agenda_log_edit->data->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_log_edit->hora->Visible) { // hora ?>
	<div id="r_hora" class="form-group row">
		<label id="elh_agenda_log_hora" for="x_hora" class="<?php echo $agenda_log_edit->LeftColumnClass ?>"><?php echo $agenda_log_edit->hora->caption() ?><?php echo $agenda_log_edit->hora->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_log_edit->RightColumnClass ?>"><div <?php echo $agenda_log_edit->hora->cellAttributes() ?>>
<span id="el_agenda_log_hora">
<input type="text" data-table="agenda_log" data-field="x_hora" name="x_hora" id="x_hora" maxlength="10" placeholder="<?php echo HtmlEncode($agenda_log_edit->hora->getPlaceHolder()) ?>" value="<?php echo $agenda_log_edit->hora->EditValue ?>"<?php echo $agenda_log_edit->hora->editAttributes() ?>>
</span>
<?php echo $agenda_log_edit->hora->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_log_edit->data_now->Visible) { // data_now ?>
	<div id="r_data_now" class="form-group row">
		<label id="elh_agenda_log_data_now" for="x_data_now" class="<?php echo $agenda_log_edit->LeftColumnClass ?>"><?php echo $agenda_log_edit->data_now->caption() ?><?php echo $agenda_log_edit->data_now->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_log_edit->RightColumnClass ?>"><div <?php echo $agenda_log_edit->data_now->cellAttributes() ?>>
<span id="el_agenda_log_data_now">
<input type="text" data-table="agenda_log" data-field="x_data_now" data-format="2" name="x_data_now" id="x_data_now" maxlength="10" placeholder="<?php echo HtmlEncode($agenda_log_edit->data_now->getPlaceHolder()) ?>" value="<?php echo $agenda_log_edit->data_now->EditValue ?>"<?php echo $agenda_log_edit->data_now->editAttributes() ?>>
<?php if (!$agenda_log_edit->data_now->ReadOnly && !$agenda_log_edit->data_now->Disabled && !isset($agenda_log_edit->data_now->EditAttrs["readonly"]) && !isset($agenda_log_edit->data_now->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fagenda_logedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fagenda_logedit", "x_data_now", {"ignoreReadonly":true,"useCurrent":false,"format":2});
});
</script>
<?php } ?>
</span>
<?php echo $agenda_log_edit->data_now->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_log_edit->professor->Visible) { // professor ?>
	<div id="r_professor" class="form-group row">
		<label id="elh_agenda_log_professor" for="x_professor" class="<?php echo $agenda_log_edit->LeftColumnClass ?>"><?php echo $agenda_log_edit->professor->caption() ?><?php echo $agenda_log_edit->professor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_log_edit->RightColumnClass ?>"><div <?php echo $agenda_log_edit->professor->cellAttributes() ?>>
<span id="el_agenda_log_professor">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda_log" data-field="x_professor" data-value-separator="<?php echo $agenda_log_edit->professor->displayValueSeparatorAttribute() ?>" id="x_professor" name="x_professor"<?php echo $agenda_log_edit->professor->editAttributes() ?>>
			<?php echo $agenda_log_edit->professor->selectOptionListHtml("x_professor") ?>
		</select>
</div>
<?php echo $agenda_log_edit->professor->Lookup->getParamTag($agenda_log_edit, "p_x_professor") ?>
</span>
<?php echo $agenda_log_edit->professor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_log_edit->cliente->Visible) { // cliente ?>
	<div id="r_cliente" class="form-group row">
		<label id="elh_agenda_log_cliente" for="x_cliente" class="<?php echo $agenda_log_edit->LeftColumnClass ?>"><?php echo $agenda_log_edit->cliente->caption() ?><?php echo $agenda_log_edit->cliente->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_log_edit->RightColumnClass ?>"><div <?php echo $agenda_log_edit->cliente->cellAttributes() ?>>
<span id="el_agenda_log_cliente">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda_log" data-field="x_cliente" data-value-separator="<?php echo $agenda_log_edit->cliente->displayValueSeparatorAttribute() ?>" id="x_cliente" name="x_cliente"<?php echo $agenda_log_edit->cliente->editAttributes() ?>>
			<?php echo $agenda_log_edit->cliente->selectOptionListHtml("x_cliente") ?>
		</select>
</div>
<?php echo $agenda_log_edit->cliente->Lookup->getParamTag($agenda_log_edit, "p_x_cliente") ?>
</span>
<?php echo $agenda_log_edit->cliente->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_log_edit->acao->Visible) { // acao ?>
	<div id="r_acao" class="form-group row">
		<label id="elh_agenda_log_acao" for="x_acao" class="<?php echo $agenda_log_edit->LeftColumnClass ?>"><?php echo $agenda_log_edit->acao->caption() ?><?php echo $agenda_log_edit->acao->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_log_edit->RightColumnClass ?>"><div <?php echo $agenda_log_edit->acao->cellAttributes() ?>>
<span id="el_agenda_log_acao">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda_log" data-field="x_acao" data-value-separator="<?php echo $agenda_log_edit->acao->displayValueSeparatorAttribute() ?>" id="x_acao" name="x_acao"<?php echo $agenda_log_edit->acao->editAttributes() ?>>
			<?php echo $agenda_log_edit->acao->selectOptionListHtml("x_acao") ?>
		</select>
</div>
</span>
<?php echo $agenda_log_edit->acao->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_log_edit->data_hora->Visible) { // data_hora ?>
	<div id="r_data_hora" class="form-group row">
		<label id="elh_agenda_log_data_hora" for="x_data_hora" class="<?php echo $agenda_log_edit->LeftColumnClass ?>"><?php echo $agenda_log_edit->data_hora->caption() ?><?php echo $agenda_log_edit->data_hora->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_log_edit->RightColumnClass ?>"><div <?php echo $agenda_log_edit->data_hora->cellAttributes() ?>>
<span id="el_agenda_log_data_hora">
<input type="text" data-table="agenda_log" data-field="x_data_hora" data-format="1" name="x_data_hora" id="x_data_hora" maxlength="19" placeholder="<?php echo HtmlEncode($agenda_log_edit->data_hora->getPlaceHolder()) ?>" value="<?php echo $agenda_log_edit->data_hora->EditValue ?>"<?php echo $agenda_log_edit->data_hora->editAttributes() ?>>
<?php if (!$agenda_log_edit->data_hora->ReadOnly && !$agenda_log_edit->data_hora->Disabled && !isset($agenda_log_edit->data_hora->EditAttrs["readonly"]) && !isset($agenda_log_edit->data_hora->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fagenda_logedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fagenda_logedit", "x_data_hora", {"ignoreReadonly":true,"useCurrent":false,"format":1});
});
</script>
<?php } ?>
</span>
<?php echo $agenda_log_edit->data_hora->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$agenda_log_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $agenda_log_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $agenda_log_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$agenda_log_edit->showPageFooter();
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
$agenda_log_edit->terminate();
?>