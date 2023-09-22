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
$agenda_edit = new agenda_edit();

// Run the page
$agenda_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$agenda_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fagendaedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fagendaedit = currentForm = new ew.Form("fagendaedit", "edit");

	// Validate form
	fagendaedit.validate = function() {
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
			<?php if ($agenda_edit->idagenda->Required) { ?>
				elm = this.getElements("x" + infix + "_idagenda");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_edit->idagenda->caption(), $agenda_edit->idagenda->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_edit->data->Required) { ?>
				elm = this.getElements("x" + infix + "_data");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_edit->data->caption(), $agenda_edit->data->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_edit->hora->Required) { ?>
				elm = this.getElements("x" + infix + "_hora");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_edit->hora->caption(), $agenda_edit->hora->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_edit->descricao->Required) { ?>
				elm = this.getElements("x" + infix + "_descricao");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_edit->descricao->caption(), $agenda_edit->descricao->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_edit->data_now->Required) { ?>
				elm = this.getElements("x" + infix + "_data_now");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_edit->data_now->caption(), $agenda_edit->data_now->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_edit->professor_idprofessor->Required) { ?>
				elm = this.getElements("x" + infix + "_professor_idprofessor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_edit->professor_idprofessor->caption(), $agenda_edit->professor_idprofessor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_edit->cliente_idcliente->Required) { ?>
				elm = this.getElements("x" + infix + "_cliente_idcliente");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_edit->cliente_idcliente->caption(), $agenda_edit->cliente_idcliente->RequiredErrorMessage)) ?>");
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
	fagendaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fagendaedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fagendaedit.lists["x_data"] = <?php echo $agenda_edit->data->Lookup->toClientList($agenda_edit) ?>;
	fagendaedit.lists["x_data"].options = <?php echo JsonEncode($agenda_edit->data->lookupOptions()) ?>;
	fagendaedit.lists["x_hora"] = <?php echo $agenda_edit->hora->Lookup->toClientList($agenda_edit) ?>;
	fagendaedit.lists["x_hora"].options = <?php echo JsonEncode($agenda_edit->hora->lookupOptions()) ?>;
	fagendaedit.lists["x_descricao"] = <?php echo $agenda_edit->descricao->Lookup->toClientList($agenda_edit) ?>;
	fagendaedit.lists["x_descricao"].options = <?php echo JsonEncode($agenda_edit->descricao->lookupOptions()) ?>;
	fagendaedit.lists["x_data_now"] = <?php echo $agenda_edit->data_now->Lookup->toClientList($agenda_edit) ?>;
	fagendaedit.lists["x_data_now"].options = <?php echo JsonEncode($agenda_edit->data_now->lookupOptions()) ?>;
	fagendaedit.lists["x_professor_idprofessor"] = <?php echo $agenda_edit->professor_idprofessor->Lookup->toClientList($agenda_edit) ?>;
	fagendaedit.lists["x_professor_idprofessor"].options = <?php echo JsonEncode($agenda_edit->professor_idprofessor->lookupOptions()) ?>;
	fagendaedit.lists["x_cliente_idcliente"] = <?php echo $agenda_edit->cliente_idcliente->Lookup->toClientList($agenda_edit) ?>;
	fagendaedit.lists["x_cliente_idcliente"].options = <?php echo JsonEncode($agenda_edit->cliente_idcliente->lookupOptions()) ?>;
	loadjs.done("fagendaedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $agenda_edit->showPageHeader(); ?>
<?php
$agenda_edit->showMessage();
?>
<form name="fagendaedit" id="fagendaedit" class="<?php echo $agenda_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="agenda">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$agenda_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($agenda_edit->idagenda->Visible) { // idagenda ?>
	<div id="r_idagenda" class="form-group row">
		<label id="elh_agenda_idagenda" class="<?php echo $agenda_edit->LeftColumnClass ?>"><?php echo $agenda_edit->idagenda->caption() ?><?php echo $agenda_edit->idagenda->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_edit->RightColumnClass ?>"><div <?php echo $agenda_edit->idagenda->cellAttributes() ?>>
<span id="el_agenda_idagenda">
<span<?php echo $agenda_edit->idagenda->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($agenda_edit->idagenda->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="agenda" data-field="x_idagenda" name="x_idagenda" id="x_idagenda" value="<?php echo HtmlEncode($agenda_edit->idagenda->CurrentValue) ?>">
<?php echo $agenda_edit->idagenda->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_edit->data->Visible) { // data ?>
	<div id="r_data" class="form-group row">
		<label id="elh_agenda_data" for="x_data" class="<?php echo $agenda_edit->LeftColumnClass ?>"><?php echo $agenda_edit->data->caption() ?><?php echo $agenda_edit->data->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_edit->RightColumnClass ?>"><div <?php echo $agenda_edit->data->cellAttributes() ?>>
<span id="el_agenda_data">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_data" data-value-separator="<?php echo $agenda_edit->data->displayValueSeparatorAttribute() ?>" id="x_data" name="x_data"<?php echo $agenda_edit->data->editAttributes() ?>>
			<?php echo $agenda_edit->data->selectOptionListHtml("x_data") ?>
		</select>
</div>
<?php echo $agenda_edit->data->Lookup->getParamTag($agenda_edit, "p_x_data") ?>
</span>
<?php echo $agenda_edit->data->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_edit->hora->Visible) { // hora ?>
	<div id="r_hora" class="form-group row">
		<label id="elh_agenda_hora" for="x_hora" class="<?php echo $agenda_edit->LeftColumnClass ?>"><?php echo $agenda_edit->hora->caption() ?><?php echo $agenda_edit->hora->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_edit->RightColumnClass ?>"><div <?php echo $agenda_edit->hora->cellAttributes() ?>>
<span id="el_agenda_hora">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_hora" data-value-separator="<?php echo $agenda_edit->hora->displayValueSeparatorAttribute() ?>" id="x_hora" name="x_hora"<?php echo $agenda_edit->hora->editAttributes() ?>>
			<?php echo $agenda_edit->hora->selectOptionListHtml("x_hora") ?>
		</select>
</div>
<?php echo $agenda_edit->hora->Lookup->getParamTag($agenda_edit, "p_x_hora") ?>
</span>
<?php echo $agenda_edit->hora->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_edit->descricao->Visible) { // descricao ?>
	<div id="r_descricao" class="form-group row">
		<label id="elh_agenda_descricao" for="x_descricao" class="<?php echo $agenda_edit->LeftColumnClass ?>"><?php echo $agenda_edit->descricao->caption() ?><?php echo $agenda_edit->descricao->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_edit->RightColumnClass ?>"><div <?php echo $agenda_edit->descricao->cellAttributes() ?>>
<span id="el_agenda_descricao">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_descricao" data-value-separator="<?php echo $agenda_edit->descricao->displayValueSeparatorAttribute() ?>" id="x_descricao" name="x_descricao"<?php echo $agenda_edit->descricao->editAttributes() ?>>
			<?php echo $agenda_edit->descricao->selectOptionListHtml("x_descricao") ?>
		</select>
</div>
<?php echo $agenda_edit->descricao->Lookup->getParamTag($agenda_edit, "p_x_descricao") ?>
</span>
<?php echo $agenda_edit->descricao->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_edit->data_now->Visible) { // data_now ?>
	<div id="r_data_now" class="form-group row">
		<label id="elh_agenda_data_now" for="x_data_now" class="<?php echo $agenda_edit->LeftColumnClass ?>"><?php echo $agenda_edit->data_now->caption() ?><?php echo $agenda_edit->data_now->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_edit->RightColumnClass ?>"><div <?php echo $agenda_edit->data_now->cellAttributes() ?>>
<span id="el_agenda_data_now">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_data_now" data-value-separator="<?php echo $agenda_edit->data_now->displayValueSeparatorAttribute() ?>" id="x_data_now" name="x_data_now"<?php echo $agenda_edit->data_now->editAttributes() ?>>
			<?php echo $agenda_edit->data_now->selectOptionListHtml("x_data_now") ?>
		</select>
</div>
<?php echo $agenda_edit->data_now->Lookup->getParamTag($agenda_edit, "p_x_data_now") ?>
</span>
<?php echo $agenda_edit->data_now->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_edit->professor_idprofessor->Visible) { // professor_idprofessor ?>
	<div id="r_professor_idprofessor" class="form-group row">
		<label id="elh_agenda_professor_idprofessor" for="x_professor_idprofessor" class="<?php echo $agenda_edit->LeftColumnClass ?>"><?php echo $agenda_edit->professor_idprofessor->caption() ?><?php echo $agenda_edit->professor_idprofessor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_edit->RightColumnClass ?>"><div <?php echo $agenda_edit->professor_idprofessor->cellAttributes() ?>>
<span id="el_agenda_professor_idprofessor">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_professor_idprofessor" data-value-separator="<?php echo $agenda_edit->professor_idprofessor->displayValueSeparatorAttribute() ?>" id="x_professor_idprofessor" name="x_professor_idprofessor"<?php echo $agenda_edit->professor_idprofessor->editAttributes() ?>>
			<?php echo $agenda_edit->professor_idprofessor->selectOptionListHtml("x_professor_idprofessor") ?>
		</select>
</div>
<?php echo $agenda_edit->professor_idprofessor->Lookup->getParamTag($agenda_edit, "p_x_professor_idprofessor") ?>
</span>
<?php echo $agenda_edit->professor_idprofessor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($agenda_edit->cliente_idcliente->Visible) { // cliente_idcliente ?>
	<div id="r_cliente_idcliente" class="form-group row">
		<label id="elh_agenda_cliente_idcliente" for="x_cliente_idcliente" class="<?php echo $agenda_edit->LeftColumnClass ?>"><?php echo $agenda_edit->cliente_idcliente->caption() ?><?php echo $agenda_edit->cliente_idcliente->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $agenda_edit->RightColumnClass ?>"><div <?php echo $agenda_edit->cliente_idcliente->cellAttributes() ?>>
<span id="el_agenda_cliente_idcliente">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_cliente_idcliente" data-value-separator="<?php echo $agenda_edit->cliente_idcliente->displayValueSeparatorAttribute() ?>" id="x_cliente_idcliente" name="x_cliente_idcliente"<?php echo $agenda_edit->cliente_idcliente->editAttributes() ?>>
			<?php echo $agenda_edit->cliente_idcliente->selectOptionListHtml("x_cliente_idcliente") ?>
		</select>
</div>
<?php echo $agenda_edit->cliente_idcliente->Lookup->getParamTag($agenda_edit, "p_x_cliente_idcliente") ?>
</span>
<?php echo $agenda_edit->cliente_idcliente->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$agenda_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $agenda_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $agenda_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$agenda_edit->showPageFooter();
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
$agenda_edit->terminate();
?>