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
$cliente_edit = new cliente_edit();

// Run the page
$cliente_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cliente_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fclienteedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fclienteedit = currentForm = new ew.Form("fclienteedit", "edit");

	// Validate form
	fclienteedit.validate = function() {
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
			<?php if ($cliente_edit->idcliente->Required) { ?>
				elm = this.getElements("x" + infix + "_idcliente");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_edit->idcliente->caption(), $cliente_edit->idcliente->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_edit->nomeCliente->Required) { ?>
				elm = this.getElements("x" + infix + "_nomeCliente");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_edit->nomeCliente->caption(), $cliente_edit->nomeCliente->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_edit->cpf->Required) { ?>
				elm = this.getElements("x" + infix + "_cpf");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_edit->cpf->caption(), $cliente_edit->cpf->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_edit->nascimento->Required) { ?>
				elm = this.getElements("x" + infix + "_nascimento");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_edit->nascimento->caption(), $cliente_edit->nascimento->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nascimento");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cliente_edit->nascimento->errorMessage()) ?>");
			<?php if ($cliente_edit->sexo->Required) { ?>
				elm = this.getElements("x" + infix + "_sexo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_edit->sexo->caption(), $cliente_edit->sexo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_edit->telefone->Required) { ?>
				elm = this.getElements("x" + infix + "_telefone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_edit->telefone->caption(), $cliente_edit->telefone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_edit->cep->Required) { ?>
				elm = this.getElements("x" + infix + "_cep");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_edit->cep->caption(), $cliente_edit->cep->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_edit->rua->Required) { ?>
				elm = this.getElements("x" + infix + "_rua");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_edit->rua->caption(), $cliente_edit->rua->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_edit->bairro->Required) { ?>
				elm = this.getElements("x" + infix + "_bairro");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_edit->bairro->caption(), $cliente_edit->bairro->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_edit->numero->Required) { ?>
				elm = this.getElements("x" + infix + "_numero");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_edit->numero->caption(), $cliente_edit->numero->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_numero");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cliente_edit->numero->errorMessage()) ?>");
			<?php if ($cliente_edit->complemento->Required) { ?>
				elm = this.getElements("x" + infix + "_complemento");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_edit->complemento->caption(), $cliente_edit->complemento->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_edit->cidade->Required) { ?>
				elm = this.getElements("x" + infix + "_cidade");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_edit->cidade->caption(), $cliente_edit->cidade->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_edit->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_edit->_email->caption(), $cliente_edit->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_edit->data_matricula->Required) { ?>
				elm = this.getElements("x" + infix + "_data_matricula");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_edit->data_matricula->caption(), $cliente_edit->data_matricula->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_data_matricula");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cliente_edit->data_matricula->errorMessage()) ?>");

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
	fclienteedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fclienteedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fclienteedit.lists["x_sexo"] = <?php echo $cliente_edit->sexo->Lookup->toClientList($cliente_edit) ?>;
	fclienteedit.lists["x_sexo"].options = <?php echo JsonEncode($cliente_edit->sexo->options(FALSE, TRUE)) ?>;
	loadjs.done("fclienteedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cliente_edit->showPageHeader(); ?>
<?php
$cliente_edit->showMessage();
?>
<form name="fclienteedit" id="fclienteedit" class="<?php echo $cliente_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cliente">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$cliente_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($cliente_edit->idcliente->Visible) { // idcliente ?>
	<div id="r_idcliente" class="form-group row">
		<label id="elh_cliente_idcliente" class="<?php echo $cliente_edit->LeftColumnClass ?>"><?php echo $cliente_edit->idcliente->caption() ?><?php echo $cliente_edit->idcliente->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_edit->RightColumnClass ?>"><div <?php echo $cliente_edit->idcliente->cellAttributes() ?>>
<span id="el_cliente_idcliente">
<span<?php echo $cliente_edit->idcliente->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cliente_edit->idcliente->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="cliente" data-field="x_idcliente" name="x_idcliente" id="x_idcliente" value="<?php echo HtmlEncode($cliente_edit->idcliente->CurrentValue) ?>">
<?php echo $cliente_edit->idcliente->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_edit->nomeCliente->Visible) { // nomeCliente ?>
	<div id="r_nomeCliente" class="form-group row">
		<label id="elh_cliente_nomeCliente" for="x_nomeCliente" class="<?php echo $cliente_edit->LeftColumnClass ?>"><?php echo $cliente_edit->nomeCliente->caption() ?><?php echo $cliente_edit->nomeCliente->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_edit->RightColumnClass ?>"><div <?php echo $cliente_edit->nomeCliente->cellAttributes() ?>>
<span id="el_cliente_nomeCliente">
<input type="text" data-table="cliente" data-field="x_nomeCliente" name="x_nomeCliente" id="x_nomeCliente" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($cliente_edit->nomeCliente->getPlaceHolder()) ?>" value="<?php echo $cliente_edit->nomeCliente->EditValue ?>"<?php echo $cliente_edit->nomeCliente->editAttributes() ?>>
</span>
<?php echo $cliente_edit->nomeCliente->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_edit->cpf->Visible) { // cpf ?>
	<div id="r_cpf" class="form-group row">
		<label id="elh_cliente_cpf" for="x_cpf" class="<?php echo $cliente_edit->LeftColumnClass ?>"><?php echo $cliente_edit->cpf->caption() ?><?php echo $cliente_edit->cpf->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_edit->RightColumnClass ?>"><div <?php echo $cliente_edit->cpf->cellAttributes() ?>>
<span id="el_cliente_cpf">
<input type="text" data-table="cliente" data-field="x_cpf" name="x_cpf" id="x_cpf" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($cliente_edit->cpf->getPlaceHolder()) ?>" value="<?php echo $cliente_edit->cpf->EditValue ?>"<?php echo $cliente_edit->cpf->editAttributes() ?>>
</span>
<?php echo $cliente_edit->cpf->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_edit->nascimento->Visible) { // nascimento ?>
	<div id="r_nascimento" class="form-group row">
		<label id="elh_cliente_nascimento" for="x_nascimento" class="<?php echo $cliente_edit->LeftColumnClass ?>"><?php echo $cliente_edit->nascimento->caption() ?><?php echo $cliente_edit->nascimento->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_edit->RightColumnClass ?>"><div <?php echo $cliente_edit->nascimento->cellAttributes() ?>>
<span id="el_cliente_nascimento">
<input type="text" data-table="cliente" data-field="x_nascimento" name="x_nascimento" id="x_nascimento" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($cliente_edit->nascimento->getPlaceHolder()) ?>" value="<?php echo $cliente_edit->nascimento->EditValue ?>"<?php echo $cliente_edit->nascimento->editAttributes() ?>>
</span>
<?php echo $cliente_edit->nascimento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_edit->sexo->Visible) { // sexo ?>
	<div id="r_sexo" class="form-group row">
		<label id="elh_cliente_sexo" for="x_sexo" class="<?php echo $cliente_edit->LeftColumnClass ?>"><?php echo $cliente_edit->sexo->caption() ?><?php echo $cliente_edit->sexo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_edit->RightColumnClass ?>"><div <?php echo $cliente_edit->sexo->cellAttributes() ?>>
<span id="el_cliente_sexo">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cliente" data-field="x_sexo" data-value-separator="<?php echo $cliente_edit->sexo->displayValueSeparatorAttribute() ?>" id="x_sexo" name="x_sexo"<?php echo $cliente_edit->sexo->editAttributes() ?>>
			<?php echo $cliente_edit->sexo->selectOptionListHtml("x_sexo") ?>
		</select>
</div>
</span>
<?php echo $cliente_edit->sexo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_edit->telefone->Visible) { // telefone ?>
	<div id="r_telefone" class="form-group row">
		<label id="elh_cliente_telefone" for="x_telefone" class="<?php echo $cliente_edit->LeftColumnClass ?>"><?php echo $cliente_edit->telefone->caption() ?><?php echo $cliente_edit->telefone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_edit->RightColumnClass ?>"><div <?php echo $cliente_edit->telefone->cellAttributes() ?>>
<span id="el_cliente_telefone">
<input type="text" data-table="cliente" data-field="x_telefone" name="x_telefone" id="x_telefone" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($cliente_edit->telefone->getPlaceHolder()) ?>" value="<?php echo $cliente_edit->telefone->EditValue ?>"<?php echo $cliente_edit->telefone->editAttributes() ?>>
</span>
<?php echo $cliente_edit->telefone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_edit->cep->Visible) { // cep ?>
	<div id="r_cep" class="form-group row">
		<label id="elh_cliente_cep" for="x_cep" class="<?php echo $cliente_edit->LeftColumnClass ?>"><?php echo $cliente_edit->cep->caption() ?><?php echo $cliente_edit->cep->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_edit->RightColumnClass ?>"><div <?php echo $cliente_edit->cep->cellAttributes() ?>>
<span id="el_cliente_cep">
<input type="text" data-table="cliente" data-field="x_cep" name="x_cep" id="x_cep" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($cliente_edit->cep->getPlaceHolder()) ?>" value="<?php echo $cliente_edit->cep->EditValue ?>"<?php echo $cliente_edit->cep->editAttributes() ?>>
</span>
<?php echo $cliente_edit->cep->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_edit->rua->Visible) { // rua ?>
	<div id="r_rua" class="form-group row">
		<label id="elh_cliente_rua" for="x_rua" class="<?php echo $cliente_edit->LeftColumnClass ?>"><?php echo $cliente_edit->rua->caption() ?><?php echo $cliente_edit->rua->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_edit->RightColumnClass ?>"><div <?php echo $cliente_edit->rua->cellAttributes() ?>>
<span id="el_cliente_rua">
<input type="text" data-table="cliente" data-field="x_rua" name="x_rua" id="x_rua" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($cliente_edit->rua->getPlaceHolder()) ?>" value="<?php echo $cliente_edit->rua->EditValue ?>"<?php echo $cliente_edit->rua->editAttributes() ?>>
</span>
<?php echo $cliente_edit->rua->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_edit->bairro->Visible) { // bairro ?>
	<div id="r_bairro" class="form-group row">
		<label id="elh_cliente_bairro" for="x_bairro" class="<?php echo $cliente_edit->LeftColumnClass ?>"><?php echo $cliente_edit->bairro->caption() ?><?php echo $cliente_edit->bairro->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_edit->RightColumnClass ?>"><div <?php echo $cliente_edit->bairro->cellAttributes() ?>>
<span id="el_cliente_bairro">
<input type="text" data-table="cliente" data-field="x_bairro" name="x_bairro" id="x_bairro" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($cliente_edit->bairro->getPlaceHolder()) ?>" value="<?php echo $cliente_edit->bairro->EditValue ?>"<?php echo $cliente_edit->bairro->editAttributes() ?>>
</span>
<?php echo $cliente_edit->bairro->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_edit->numero->Visible) { // numero ?>
	<div id="r_numero" class="form-group row">
		<label id="elh_cliente_numero" for="x_numero" class="<?php echo $cliente_edit->LeftColumnClass ?>"><?php echo $cliente_edit->numero->caption() ?><?php echo $cliente_edit->numero->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_edit->RightColumnClass ?>"><div <?php echo $cliente_edit->numero->cellAttributes() ?>>
<span id="el_cliente_numero">
<input type="text" data-table="cliente" data-field="x_numero" name="x_numero" id="x_numero" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($cliente_edit->numero->getPlaceHolder()) ?>" value="<?php echo $cliente_edit->numero->EditValue ?>"<?php echo $cliente_edit->numero->editAttributes() ?>>
</span>
<?php echo $cliente_edit->numero->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_edit->complemento->Visible) { // complemento ?>
	<div id="r_complemento" class="form-group row">
		<label id="elh_cliente_complemento" for="x_complemento" class="<?php echo $cliente_edit->LeftColumnClass ?>"><?php echo $cliente_edit->complemento->caption() ?><?php echo $cliente_edit->complemento->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_edit->RightColumnClass ?>"><div <?php echo $cliente_edit->complemento->cellAttributes() ?>>
<span id="el_cliente_complemento">
<input type="text" data-table="cliente" data-field="x_complemento" name="x_complemento" id="x_complemento" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($cliente_edit->complemento->getPlaceHolder()) ?>" value="<?php echo $cliente_edit->complemento->EditValue ?>"<?php echo $cliente_edit->complemento->editAttributes() ?>>
</span>
<?php echo $cliente_edit->complemento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_edit->cidade->Visible) { // cidade ?>
	<div id="r_cidade" class="form-group row">
		<label id="elh_cliente_cidade" for="x_cidade" class="<?php echo $cliente_edit->LeftColumnClass ?>"><?php echo $cliente_edit->cidade->caption() ?><?php echo $cliente_edit->cidade->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_edit->RightColumnClass ?>"><div <?php echo $cliente_edit->cidade->cellAttributes() ?>>
<span id="el_cliente_cidade">
<input type="text" data-table="cliente" data-field="x_cidade" name="x_cidade" id="x_cidade" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($cliente_edit->cidade->getPlaceHolder()) ?>" value="<?php echo $cliente_edit->cidade->EditValue ?>"<?php echo $cliente_edit->cidade->editAttributes() ?>>
</span>
<?php echo $cliente_edit->cidade->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_edit->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_cliente__email" for="x__email" class="<?php echo $cliente_edit->LeftColumnClass ?>"><?php echo $cliente_edit->_email->caption() ?><?php echo $cliente_edit->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_edit->RightColumnClass ?>"><div <?php echo $cliente_edit->_email->cellAttributes() ?>>
<span id="el_cliente__email">
<input type="text" data-table="cliente" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($cliente_edit->_email->getPlaceHolder()) ?>" value="<?php echo $cliente_edit->_email->EditValue ?>"<?php echo $cliente_edit->_email->editAttributes() ?>>
</span>
<?php echo $cliente_edit->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_edit->data_matricula->Visible) { // data_matricula ?>
	<div id="r_data_matricula" class="form-group row">
		<label id="elh_cliente_data_matricula" for="x_data_matricula" class="<?php echo $cliente_edit->LeftColumnClass ?>"><?php echo $cliente_edit->data_matricula->caption() ?><?php echo $cliente_edit->data_matricula->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_edit->RightColumnClass ?>"><div <?php echo $cliente_edit->data_matricula->cellAttributes() ?>>
<span id="el_cliente_data_matricula">
<input type="text" data-table="cliente" data-field="x_data_matricula" data-format="7" name="x_data_matricula" id="x_data_matricula" maxlength="10" placeholder="<?php echo HtmlEncode($cliente_edit->data_matricula->getPlaceHolder()) ?>" value="<?php echo $cliente_edit->data_matricula->EditValue ?>"<?php echo $cliente_edit->data_matricula->editAttributes() ?>>
<?php if (!$cliente_edit->data_matricula->ReadOnly && !$cliente_edit->data_matricula->Disabled && !isset($cliente_edit->data_matricula->EditAttrs["readonly"]) && !isset($cliente_edit->data_matricula->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fclienteedit", "datetimepicker"], function() {
	ew.createDateTimePicker("fclienteedit", "x_data_matricula", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php echo $cliente_edit->data_matricula->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cliente_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cliente_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cliente_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cliente_edit->showPageFooter();
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
$cliente_edit->terminate();
?>