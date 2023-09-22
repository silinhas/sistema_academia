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
$agenda_add = new agenda_add();

// Run the page
$agenda_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$agenda_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fagendaadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fagendaadd = currentForm = new ew.Form("fagendaadd", "add");

	// Validate form
	fagendaadd.validate = function() {
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
			<?php if ($agenda_add->data->Required) { ?>
				elm = this.getElements("x" + infix + "_data");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_add->data->caption(), $agenda_add->data->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_add->hora->Required) { ?>
				elm = this.getElements("x" + infix + "_hora");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_add->hora->caption(), $agenda_add->hora->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_add->descricao->Required) { ?>
				elm = this.getElements("x" + infix + "_descricao");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_add->descricao->caption(), $agenda_add->descricao->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_add->data_now->Required) { ?>
				elm = this.getElements("x" + infix + "_data_now");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_add->data_now->caption(), $agenda_add->data_now->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_add->professor_idprofessor->Required) { ?>
				elm = this.getElements("x" + infix + "_professor_idprofessor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_add->professor_idprofessor->caption(), $agenda_add->professor_idprofessor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_add->cliente_idcliente->Required) { ?>
				elm = this.getElements("x" + infix + "_cliente_idcliente");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_add->cliente_idcliente->caption(), $agenda_add->cliente_idcliente->RequiredErrorMessage)) ?>");
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
	fagendaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fagendaadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fagendaadd.lists["x_data"] = <?php echo $agenda_add->data->Lookup->toClientList($agenda_add) ?>;
	fagendaadd.lists["x_data"].options = <?php echo JsonEncode($agenda_add->data->lookupOptions()) ?>;
	fagendaadd.lists["x_hora"] = <?php echo $agenda_add->hora->Lookup->toClientList($agenda_add) ?>;
	fagendaadd.lists["x_hora"].options = <?php echo JsonEncode($agenda_add->hora->lookupOptions()) ?>;
	fagendaadd.lists["x_descricao"] = <?php echo $agenda_add->descricao->Lookup->toClientList($agenda_add) ?>;
	fagendaadd.lists["x_descricao"].options = <?php echo JsonEncode($agenda_add->descricao->lookupOptions()) ?>;
	fagendaadd.lists["x_data_now"] = <?php echo $agenda_add->data_now->Lookup->toClientList($agenda_add) ?>;
	fagendaadd.lists["x_data_now"].options = <?php echo JsonEncode($agenda_add->data_now->lookupOptions()) ?>;
	fagendaadd.lists["x_professor_idprofessor"] = <?php echo $agenda_add->professor_idprofessor->Lookup->toClientList($agenda_add) ?>;
	fagendaadd.lists["x_professor_idprofessor"].options = <?php echo JsonEncode($agenda_add->professor_idprofessor->lookupOptions()) ?>;
	fagendaadd.lists["x_cliente_idcliente"] = <?php echo $agenda_add->cliente_idcliente->Lookup->toClientList($agenda_add) ?>;
	fagendaadd.lists["x_cliente_idcliente"].options = <?php echo JsonEncode($agenda_add->cliente_idcliente->lookupOptions()) ?>;
	loadjs.done("fagendaadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $agenda_add->showPageHeader(); ?>
<?php
$agenda_add->showMessage();
?>
<form name="fagendaadd" id="fagendaadd" class="<?php echo $agenda_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="agenda">
<?php if ($agenda->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$agenda_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($agenda_add->data->Visible) { // data ?>
	<div id="r_data" class="form-group row">
		<label id="elh_agenda_data" for="x_data" class="<?php echo $agenda_add->LeftColumnClass ?>"><?php echo $agenda_add->data->caption() ?><?php echo $agenda_add->data->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_add->RightColumnClass ?>"><div <?php echo $agenda_add->data->cellAttributes() ?>>
<?php if (!$agenda->isConfirm()) { ?>
<span id="el_agenda_data">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_data" data-page="1" data-value-separator="<?php echo $agenda_add->data->displayValueSeparatorAttribute() ?>" id="x_data" name="x_data"<?php echo $agenda_add->data->editAttributes() ?>>
			<?php echo $agenda_add->data->selectOptionListHtml("x_data") ?>
		</select>
</div>
<?php echo $agenda_add->data->Lookup->getParamTag($agenda_add, "p_x_data") ?>
</span>
<?php } else { ?>
<span id="el_agenda_data">
<span<?php echo $agenda_add->data->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($agenda_add->data->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="agenda" data-field="x_data" data-page="1" name="x_data" id="x_data" value="<?php echo HtmlEncode($agenda_add->data->FormValue) ?>">
<?php } ?>
<?php echo $agenda_add->data->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_add->hora->Visible) { // hora ?>
	<div id="r_hora" class="form-group row">
		<label id="elh_agenda_hora" for="x_hora" class="<?php echo $agenda_add->LeftColumnClass ?>"><?php echo $agenda_add->hora->caption() ?><?php echo $agenda_add->hora->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_add->RightColumnClass ?>"><div <?php echo $agenda_add->hora->cellAttributes() ?>>
<?php if (!$agenda->isConfirm()) { ?>
<span id="el_agenda_hora">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_hora" data-page="1" data-value-separator="<?php echo $agenda_add->hora->displayValueSeparatorAttribute() ?>" id="x_hora" name="x_hora"<?php echo $agenda_add->hora->editAttributes() ?>>
			<?php echo $agenda_add->hora->selectOptionListHtml("x_hora") ?>
		</select>
</div>
<?php echo $agenda_add->hora->Lookup->getParamTag($agenda_add, "p_x_hora") ?>
</span>
<?php } else { ?>
<span id="el_agenda_hora">
<span<?php echo $agenda_add->hora->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($agenda_add->hora->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="agenda" data-field="x_hora" data-page="1" name="x_hora" id="x_hora" value="<?php echo HtmlEncode($agenda_add->hora->FormValue) ?>">
<?php } ?>
<?php echo $agenda_add->hora->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_add->descricao->Visible) { // descricao ?>
	<div id="r_descricao" class="form-group row">
		<label id="elh_agenda_descricao" for="x_descricao" class="<?php echo $agenda_add->LeftColumnClass ?>"><?php echo $agenda_add->descricao->caption() ?><?php echo $agenda_add->descricao->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_add->RightColumnClass ?>"><div <?php echo $agenda_add->descricao->cellAttributes() ?>>
<?php if (!$agenda->isConfirm()) { ?>
<span id="el_agenda_descricao">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_descricao" data-page="1" data-value-separator="<?php echo $agenda_add->descricao->displayValueSeparatorAttribute() ?>" id="x_descricao" name="x_descricao"<?php echo $agenda_add->descricao->editAttributes() ?>>
			<?php echo $agenda_add->descricao->selectOptionListHtml("x_descricao") ?>
		</select>
</div>
<?php echo $agenda_add->descricao->Lookup->getParamTag($agenda_add, "p_x_descricao") ?>
</span>
<?php } else { ?>
<span id="el_agenda_descricao">
<span<?php echo $agenda_add->descricao->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($agenda_add->descricao->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="agenda" data-field="x_descricao" data-page="1" name="x_descricao" id="x_descricao" value="<?php echo HtmlEncode($agenda_add->descricao->FormValue) ?>">
<?php } ?>
<?php echo $agenda_add->descricao->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_add->data_now->Visible) { // data_now ?>
	<div id="r_data_now" class="form-group row">
		<label id="elh_agenda_data_now" for="x_data_now" class="<?php echo $agenda_add->LeftColumnClass ?>"><?php echo $agenda_add->data_now->caption() ?><?php echo $agenda_add->data_now->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_add->RightColumnClass ?>"><div <?php echo $agenda_add->data_now->cellAttributes() ?>>
<?php if (!$agenda->isConfirm()) { ?>
<span id="el_agenda_data_now">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_data_now" data-page="1" data-value-separator="<?php echo $agenda_add->data_now->displayValueSeparatorAttribute() ?>" id="x_data_now" name="x_data_now"<?php echo $agenda_add->data_now->editAttributes() ?>>
			<?php echo $agenda_add->data_now->selectOptionListHtml("x_data_now") ?>
		</select>
</div>
<?php echo $agenda_add->data_now->Lookup->getParamTag($agenda_add, "p_x_data_now") ?>
</span>
<?php } else { ?>
<span id="el_agenda_data_now">
<span<?php echo $agenda_add->data_now->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($agenda_add->data_now->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="agenda" data-field="x_data_now" data-page="1" name="x_data_now" id="x_data_now" value="<?php echo HtmlEncode($agenda_add->data_now->FormValue) ?>">
<?php } ?>
<?php echo $agenda_add->data_now->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_add->professor_idprofessor->Visible) { // professor_idprofessor ?>
	<div id="r_professor_idprofessor" class="form-group row">
		<label id="elh_agenda_professor_idprofessor" for="x_professor_idprofessor" class="<?php echo $agenda_add->LeftColumnClass ?>"><?php echo $agenda_add->professor_idprofessor->caption() ?><?php echo $agenda_add->professor_idprofessor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_add->RightColumnClass ?>"><div <?php echo $agenda_add->professor_idprofessor->cellAttributes() ?>>
<?php if (!$agenda->isConfirm()) { ?>
<span id="el_agenda_professor_idprofessor">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_professor_idprofessor" data-page="1" data-value-separator="<?php echo $agenda_add->professor_idprofessor->displayValueSeparatorAttribute() ?>" id="x_professor_idprofessor" name="x_professor_idprofessor"<?php echo $agenda_add->professor_idprofessor->editAttributes() ?>>
			<?php echo $agenda_add->professor_idprofessor->selectOptionListHtml("x_professor_idprofessor") ?>
		</select>
</div>
<?php echo $agenda_add->professor_idprofessor->Lookup->getParamTag($agenda_add, "p_x_professor_idprofessor") ?>
</span>
<?php } else { ?>
<span id="el_agenda_professor_idprofessor">
<span<?php echo $agenda_add->professor_idprofessor->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($agenda_add->professor_idprofessor->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="agenda" data-field="x_professor_idprofessor" data-page="1" name="x_professor_idprofessor" id="x_professor_idprofessor" value="<?php echo HtmlEncode($agenda_add->professor_idprofessor->FormValue) ?>">
<?php } ?>
<?php echo $agenda_add->professor_idprofessor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_add->cliente_idcliente->Visible) { // cliente_idcliente ?>
	<div id="r_cliente_idcliente" class="form-group row">
		<label id="elh_agenda_cliente_idcliente" for="x_cliente_idcliente" class="<?php echo $agenda_add->LeftColumnClass ?>"><?php echo $agenda_add->cliente_idcliente->caption() ?><?php echo $agenda_add->cliente_idcliente->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_add->RightColumnClass ?>"><div <?php echo $agenda_add->cliente_idcliente->cellAttributes() ?>>
<?php if (!$agenda->isConfirm()) { ?>
<span id="el_agenda_cliente_idcliente">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_cliente_idcliente" data-page="1" data-value-separator="<?php echo $agenda_add->cliente_idcliente->displayValueSeparatorAttribute() ?>" id="x_cliente_idcliente" name="x_cliente_idcliente"<?php echo $agenda_add->cliente_idcliente->editAttributes() ?>>
			<?php echo $agenda_add->cliente_idcliente->selectOptionListHtml("x_cliente_idcliente") ?>
		</select>
</div>
<?php echo $agenda_add->cliente_idcliente->Lookup->getParamTag($agenda_add, "p_x_cliente_idcliente") ?>
</span>
<?php } else { ?>
<span id="el_agenda_cliente_idcliente">
<span<?php echo $agenda_add->cliente_idcliente->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($agenda_add->cliente_idcliente->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="agenda" data-field="x_cliente_idcliente" data-page="1" name="x_cliente_idcliente" id="x_cliente_idcliente" value="<?php echo HtmlEncode($agenda_add->cliente_idcliente->FormValue) ?>">
<?php } ?>
<?php echo $agenda_add->cliente_idcliente->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$agenda_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $agenda_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$agenda->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $agenda_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$agenda_add->showPageFooter();
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
$agenda_add->terminate();
?>