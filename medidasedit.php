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
$medidas_edit = new medidas_edit();

// Run the page
$medidas_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$medidas_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmedidasedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fmedidasedit = currentForm = new ew.Form("fmedidasedit", "edit");

	// Validate form
	fmedidasedit.validate = function() {
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
			<?php if ($medidas_edit->idmedidas->Required) { ?>
				elm = this.getElements("x" + infix + "_idmedidas");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $medidas_edit->idmedidas->caption(), $medidas_edit->idmedidas->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($medidas_edit->altura->Required) { ?>
				elm = this.getElements("x" + infix + "_altura");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $medidas_edit->altura->caption(), $medidas_edit->altura->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_altura");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($medidas_edit->altura->errorMessage()) ?>");
			<?php if ($medidas_edit->peso->Required) { ?>
				elm = this.getElements("x" + infix + "_peso");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $medidas_edit->peso->caption(), $medidas_edit->peso->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_peso");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($medidas_edit->peso->errorMessage()) ?>");
			<?php if ($medidas_edit->data_cadastro->Required) { ?>
				elm = this.getElements("x" + infix + "_data_cadastro");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $medidas_edit->data_cadastro->caption(), $medidas_edit->data_cadastro->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_data_cadastro");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($medidas_edit->data_cadastro->errorMessage()) ?>");
			<?php if ($medidas_edit->cliente_idcliente->Required) { ?>
				elm = this.getElements("x" + infix + "_cliente_idcliente");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $medidas_edit->cliente_idcliente->caption(), $medidas_edit->cliente_idcliente->RequiredErrorMessage)) ?>");
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
	fmedidasedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmedidasedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmedidasedit.lists["x_cliente_idcliente"] = <?php echo $medidas_edit->cliente_idcliente->Lookup->toClientList($medidas_edit) ?>;
	fmedidasedit.lists["x_cliente_idcliente"].options = <?php echo JsonEncode($medidas_edit->cliente_idcliente->lookupOptions()) ?>;
	loadjs.done("fmedidasedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $medidas_edit->showPageHeader(); ?>
<?php
$medidas_edit->showMessage();
?>
<form name="fmedidasedit" id="fmedidasedit" class="<?php echo $medidas_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="medidas">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$medidas_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($medidas_edit->idmedidas->Visible) { // idmedidas ?>
	<div id="r_idmedidas" class="form-group row">
		<label id="elh_medidas_idmedidas" class="<?php echo $medidas_edit->LeftColumnClass ?>"><?php echo $medidas_edit->idmedidas->caption() ?><?php echo $medidas_edit->idmedidas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $medidas_edit->RightColumnClass ?>"><div <?php echo $medidas_edit->idmedidas->cellAttributes() ?>>
<span id="el_medidas_idmedidas">
<span<?php echo $medidas_edit->idmedidas->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($medidas_edit->idmedidas->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="medidas" data-field="x_idmedidas" name="x_idmedidas" id="x_idmedidas" value="<?php echo HtmlEncode($medidas_edit->idmedidas->CurrentValue) ?>">
<?php echo $medidas_edit->idmedidas->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($medidas_edit->altura->Visible) { // altura ?>
	<div id="r_altura" class="form-group row">
		<label id="elh_medidas_altura" for="x_altura" class="<?php echo $medidas_edit->LeftColumnClass ?>"><?php echo $medidas_edit->altura->caption() ?><?php echo $medidas_edit->altura->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $medidas_edit->RightColumnClass ?>"><div <?php echo $medidas_edit->altura->cellAttributes() ?>>
<span id="el_medidas_altura">
<input type="text" data-table="medidas" data-field="x_altura" name="x_altura" id="x_altura" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($medidas_edit->altura->getPlaceHolder()) ?>" value="<?php echo $medidas_edit->altura->EditValue ?>"<?php echo $medidas_edit->altura->editAttributes() ?>>
</span>
<?php echo $medidas_edit->altura->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($medidas_edit->peso->Visible) { // peso ?>
	<div id="r_peso" class="form-group row">
		<label id="elh_medidas_peso" for="x_peso" class="<?php echo $medidas_edit->LeftColumnClass ?>"><?php echo $medidas_edit->peso->caption() ?><?php echo $medidas_edit->peso->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $medidas_edit->RightColumnClass ?>"><div <?php echo $medidas_edit->peso->cellAttributes() ?>>
<span id="el_medidas_peso">
<input type="text" data-table="medidas" data-field="x_peso" name="x_peso" id="x_peso" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($medidas_edit->peso->getPlaceHolder()) ?>" value="<?php echo $medidas_edit->peso->EditValue ?>"<?php echo $medidas_edit->peso->editAttributes() ?>>
</span>
<?php echo $medidas_edit->peso->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($medidas_edit->data_cadastro->Visible) { // data_cadastro ?>
	<div id="r_data_cadastro" class="form-group row">
		<label id="elh_medidas_data_cadastro" for="x_data_cadastro" class="<?php echo $medidas_edit->LeftColumnClass ?>"><?php echo $medidas_edit->data_cadastro->caption() ?><?php echo $medidas_edit->data_cadastro->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $medidas_edit->RightColumnClass ?>"><div <?php echo $medidas_edit->data_cadastro->cellAttributes() ?>>
<span id="el_medidas_data_cadastro">
<input type="text" data-table="medidas" data-field="x_data_cadastro" data-format="7" name="x_data_cadastro" id="x_data_cadastro" maxlength="10" placeholder="<?php echo HtmlEncode($medidas_edit->data_cadastro->getPlaceHolder()) ?>" value="<?php echo $medidas_edit->data_cadastro->EditValue ?>"<?php echo $medidas_edit->data_cadastro->editAttributes() ?>>
<?php if (!$medidas_edit->data_cadastro->ReadOnly && !$medidas_edit->data_cadastro->Disabled && !isset($medidas_edit->data_cadastro->EditAttrs["readonly"]) && !isset($medidas_edit->data_cadastro->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmedidasedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fmedidasedit", "x_data_cadastro", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php echo $medidas_edit->data_cadastro->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($medidas_edit->cliente_idcliente->Visible) { // cliente_idcliente ?>
	<div id="r_cliente_idcliente" class="form-group row">
		<label id="elh_medidas_cliente_idcliente" for="x_cliente_idcliente" class="<?php echo $medidas_edit->LeftColumnClass ?>"><?php echo $medidas_edit->cliente_idcliente->caption() ?><?php echo $medidas_edit->cliente_idcliente->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $medidas_edit->RightColumnClass ?>"><div <?php echo $medidas_edit->cliente_idcliente->cellAttributes() ?>>
<span id="el_medidas_cliente_idcliente">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="medidas" data-field="x_cliente_idcliente" data-value-separator="<?php echo $medidas_edit->cliente_idcliente->displayValueSeparatorAttribute() ?>" id="x_cliente_idcliente" name="x_cliente_idcliente"<?php echo $medidas_edit->cliente_idcliente->editAttributes() ?>>
			<?php echo $medidas_edit->cliente_idcliente->selectOptionListHtml("x_cliente_idcliente") ?>
		</select>
</div>
<?php echo $medidas_edit->cliente_idcliente->Lookup->getParamTag($medidas_edit, "p_x_cliente_idcliente") ?>
</span>
<?php echo $medidas_edit->cliente_idcliente->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$medidas_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $medidas_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $medidas_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$medidas_edit->showPageFooter();
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
$medidas_edit->terminate();
?>