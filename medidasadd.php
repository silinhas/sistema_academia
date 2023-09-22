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
$medidas_add = new medidas_add();

// Run the page
$medidas_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$medidas_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fmedidasadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fmedidasadd = currentForm = new ew.Form("fmedidasadd", "add");

	// Validate form
	fmedidasadd.validate = function() {
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
			<?php if ($medidas_add->altura->Required) { ?>
				elm = this.getElements("x" + infix + "_altura");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $medidas_add->altura->caption(), $medidas_add->altura->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_altura");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($medidas_add->altura->errorMessage()) ?>");
			<?php if ($medidas_add->peso->Required) { ?>
				elm = this.getElements("x" + infix + "_peso");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $medidas_add->peso->caption(), $medidas_add->peso->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_peso");
				if (elm && !ew.checkNumber(elm.value))
					return this.onError(elm, "<?php echo JsEncode($medidas_add->peso->errorMessage()) ?>");
			<?php if ($medidas_add->data_cadastro->Required) { ?>
				elm = this.getElements("x" + infix + "_data_cadastro");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $medidas_add->data_cadastro->caption(), $medidas_add->data_cadastro->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_data_cadastro");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($medidas_add->data_cadastro->errorMessage()) ?>");
			<?php if ($medidas_add->cliente_idcliente->Required) { ?>
				elm = this.getElements("x" + infix + "_cliente_idcliente");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $medidas_add->cliente_idcliente->caption(), $medidas_add->cliente_idcliente->RequiredErrorMessage)) ?>");
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
	fmedidasadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmedidasadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmedidasadd.lists["x_cliente_idcliente"] = <?php echo $medidas_add->cliente_idcliente->Lookup->toClientList($medidas_add) ?>;
	fmedidasadd.lists["x_cliente_idcliente"].options = <?php echo JsonEncode($medidas_add->cliente_idcliente->lookupOptions()) ?>;
	loadjs.done("fmedidasadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $medidas_add->showPageHeader(); ?>
<?php
$medidas_add->showMessage();
?>
<form name="fmedidasadd" id="fmedidasadd" class="<?php echo $medidas_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="medidas">
<?php if ($medidas->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$medidas_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($medidas_add->altura->Visible) { // altura ?>
	<div id="r_altura" class="form-group row">
		<label id="elh_medidas_altura" for="x_altura" class="<?php echo $medidas_add->LeftColumnClass ?>"><?php echo $medidas_add->altura->caption() ?><?php echo $medidas_add->altura->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $medidas_add->RightColumnClass ?>"><div <?php echo $medidas_add->altura->cellAttributes() ?>>
<?php if (!$medidas->isConfirm()) { ?>
<span id="el_medidas_altura">
<input type="text" data-table="medidas" data-field="x_altura" name="x_altura" id="x_altura" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($medidas_add->altura->getPlaceHolder()) ?>" value="<?php echo $medidas_add->altura->EditValue ?>"<?php echo $medidas_add->altura->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_medidas_altura">
<span<?php echo $medidas_add->altura->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($medidas_add->altura->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="medidas" data-field="x_altura" name="x_altura" id="x_altura" value="<?php echo HtmlEncode($medidas_add->altura->FormValue) ?>">
<?php } ?>
<?php echo $medidas_add->altura->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($medidas_add->peso->Visible) { // peso ?>
	<div id="r_peso" class="form-group row">
		<label id="elh_medidas_peso" for="x_peso" class="<?php echo $medidas_add->LeftColumnClass ?>"><?php echo $medidas_add->peso->caption() ?><?php echo $medidas_add->peso->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $medidas_add->RightColumnClass ?>"><div <?php echo $medidas_add->peso->cellAttributes() ?>>
<?php if (!$medidas->isConfirm()) { ?>
<span id="el_medidas_peso">
<input type="text" data-table="medidas" data-field="x_peso" name="x_peso" id="x_peso" size="30" maxlength="12" placeholder="<?php echo HtmlEncode($medidas_add->peso->getPlaceHolder()) ?>" value="<?php echo $medidas_add->peso->EditValue ?>"<?php echo $medidas_add->peso->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_medidas_peso">
<span<?php echo $medidas_add->peso->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($medidas_add->peso->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="medidas" data-field="x_peso" name="x_peso" id="x_peso" value="<?php echo HtmlEncode($medidas_add->peso->FormValue) ?>">
<?php } ?>
<?php echo $medidas_add->peso->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($medidas_add->data_cadastro->Visible) { // data_cadastro ?>
	<div id="r_data_cadastro" class="form-group row">
		<label id="elh_medidas_data_cadastro" for="x_data_cadastro" class="<?php echo $medidas_add->LeftColumnClass ?>"><?php echo $medidas_add->data_cadastro->caption() ?><?php echo $medidas_add->data_cadastro->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $medidas_add->RightColumnClass ?>"><div <?php echo $medidas_add->data_cadastro->cellAttributes() ?>>
<?php if (!$medidas->isConfirm()) { ?>
<span id="el_medidas_data_cadastro">
<input type="text" data-table="medidas" data-field="x_data_cadastro" data-format="7" name="x_data_cadastro" id="x_data_cadastro" maxlength="10" placeholder="<?php echo HtmlEncode($medidas_add->data_cadastro->getPlaceHolder()) ?>" value="<?php echo $medidas_add->data_cadastro->EditValue ?>"<?php echo $medidas_add->data_cadastro->editAttributes() ?>>
<?php if (!$medidas_add->data_cadastro->ReadOnly && !$medidas_add->data_cadastro->Disabled && !isset($medidas_add->data_cadastro->EditAttrs["readonly"]) && !isset($medidas_add->data_cadastro->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmedidasadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fmedidasadd", "x_data_cadastro", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_medidas_data_cadastro">
<span<?php echo $medidas_add->data_cadastro->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($medidas_add->data_cadastro->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="medidas" data-field="x_data_cadastro" name="x_data_cadastro" id="x_data_cadastro" value="<?php echo HtmlEncode($medidas_add->data_cadastro->FormValue) ?>">
<?php } ?>
<?php echo $medidas_add->data_cadastro->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($medidas_add->cliente_idcliente->Visible) { // cliente_idcliente ?>
	<div id="r_cliente_idcliente" class="form-group row">
		<label id="elh_medidas_cliente_idcliente" for="x_cliente_idcliente" class="<?php echo $medidas_add->LeftColumnClass ?>"><?php echo $medidas_add->cliente_idcliente->caption() ?><?php echo $medidas_add->cliente_idcliente->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $medidas_add->RightColumnClass ?>"><div <?php echo $medidas_add->cliente_idcliente->cellAttributes() ?>>
<?php if (!$medidas->isConfirm()) { ?>
<span id="el_medidas_cliente_idcliente">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="medidas" data-field="x_cliente_idcliente" data-value-separator="<?php echo $medidas_add->cliente_idcliente->displayValueSeparatorAttribute() ?>" id="x_cliente_idcliente" name="x_cliente_idcliente"<?php echo $medidas_add->cliente_idcliente->editAttributes() ?>>
			<?php echo $medidas_add->cliente_idcliente->selectOptionListHtml("x_cliente_idcliente") ?>
		</select>
</div>
<?php echo $medidas_add->cliente_idcliente->Lookup->getParamTag($medidas_add, "p_x_cliente_idcliente") ?>
</span>
<?php } else { ?>
<span id="el_medidas_cliente_idcliente">
<span<?php echo $medidas_add->cliente_idcliente->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($medidas_add->cliente_idcliente->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="medidas" data-field="x_cliente_idcliente" name="x_cliente_idcliente" id="x_cliente_idcliente" value="<?php echo HtmlEncode($medidas_add->cliente_idcliente->FormValue) ?>">
<?php } ?>
<?php echo $medidas_add->cliente_idcliente->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$medidas_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $medidas_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$medidas->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $medidas_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$medidas_add->showPageFooter();
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
$medidas_add->terminate();
?>