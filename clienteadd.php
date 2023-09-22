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
$cliente_add = new cliente_add();

// Run the page
$cliente_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cliente_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fclienteadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fclienteadd = currentForm = new ew.Form("fclienteadd", "add");

	// Validate form
	fclienteadd.validate = function() {
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
			<?php if ($cliente_add->nomeCliente->Required) { ?>
				elm = this.getElements("x" + infix + "_nomeCliente");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_add->nomeCliente->caption(), $cliente_add->nomeCliente->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_add->cpf->Required) { ?>
				elm = this.getElements("x" + infix + "_cpf");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_add->cpf->caption(), $cliente_add->cpf->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_add->nascimento->Required) { ?>
				elm = this.getElements("x" + infix + "_nascimento");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_add->nascimento->caption(), $cliente_add->nascimento->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nascimento");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cliente_add->nascimento->errorMessage()) ?>");
			<?php if ($cliente_add->sexo->Required) { ?>
				elm = this.getElements("x" + infix + "_sexo");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_add->sexo->caption(), $cliente_add->sexo->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_add->telefone->Required) { ?>
				elm = this.getElements("x" + infix + "_telefone");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_add->telefone->caption(), $cliente_add->telefone->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_add->cep->Required) { ?>
				elm = this.getElements("x" + infix + "_cep");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_add->cep->caption(), $cliente_add->cep->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_add->rua->Required) { ?>
				elm = this.getElements("x" + infix + "_rua");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_add->rua->caption(), $cliente_add->rua->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_add->bairro->Required) { ?>
				elm = this.getElements("x" + infix + "_bairro");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_add->bairro->caption(), $cliente_add->bairro->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_add->numero->Required) { ?>
				elm = this.getElements("x" + infix + "_numero");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_add->numero->caption(), $cliente_add->numero->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_numero");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cliente_add->numero->errorMessage()) ?>");
			<?php if ($cliente_add->complemento->Required) { ?>
				elm = this.getElements("x" + infix + "_complemento");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_add->complemento->caption(), $cliente_add->complemento->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_add->cidade->Required) { ?>
				elm = this.getElements("x" + infix + "_cidade");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_add->cidade->caption(), $cliente_add->cidade->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_add->_email->Required) { ?>
				elm = this.getElements("x" + infix + "__email");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_add->_email->caption(), $cliente_add->_email->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($cliente_add->data_matricula->Required) { ?>
				elm = this.getElements("x" + infix + "_data_matricula");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente_add->data_matricula->caption(), $cliente_add->data_matricula->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_data_matricula");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($cliente_add->data_matricula->errorMessage()) ?>");

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
	fclienteadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fclienteadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fclienteadd.lists["x_sexo"] = <?php echo $cliente_add->sexo->Lookup->toClientList($cliente_add) ?>;
	fclienteadd.lists["x_sexo"].options = <?php echo JsonEncode($cliente_add->sexo->options(FALSE, TRUE)) ?>;
	loadjs.done("fclienteadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $cliente_add->showPageHeader(); ?>
<?php
$cliente_add->showMessage();
?>
<form name="fclienteadd" id="fclienteadd" class="<?php echo $cliente_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cliente">
<?php if ($cliente->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$cliente_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($cliente_add->nomeCliente->Visible) { // nomeCliente ?>
	<div id="r_nomeCliente" class="form-group row">
		<label id="elh_cliente_nomeCliente" for="x_nomeCliente" class="<?php echo $cliente_add->LeftColumnClass ?>"><?php echo $cliente_add->nomeCliente->caption() ?><?php echo $cliente_add->nomeCliente->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_add->RightColumnClass ?>"><div <?php echo $cliente_add->nomeCliente->cellAttributes() ?>>
<?php if (!$cliente->isConfirm()) { ?>
<span id="el_cliente_nomeCliente">
<input type="text" data-table="cliente" data-field="x_nomeCliente" name="x_nomeCliente" id="x_nomeCliente" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($cliente_add->nomeCliente->getPlaceHolder()) ?>" value="<?php echo $cliente_add->nomeCliente->EditValue ?>"<?php echo $cliente_add->nomeCliente->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_cliente_nomeCliente">
<span<?php echo $cliente_add->nomeCliente->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cliente_add->nomeCliente->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cliente" data-field="x_nomeCliente" name="x_nomeCliente" id="x_nomeCliente" value="<?php echo HtmlEncode($cliente_add->nomeCliente->FormValue) ?>">
<?php } ?>
<?php echo $cliente_add->nomeCliente->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_add->cpf->Visible) { // cpf ?>
	<div id="r_cpf" class="form-group row">
		<label id="elh_cliente_cpf" for="x_cpf" class="<?php echo $cliente_add->LeftColumnClass ?>"><?php echo $cliente_add->cpf->caption() ?><?php echo $cliente_add->cpf->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_add->RightColumnClass ?>"><div <?php echo $cliente_add->cpf->cellAttributes() ?>>
<?php if (!$cliente->isConfirm()) { ?>
<span id="el_cliente_cpf">
<input type="text" data-table="cliente" data-field="x_cpf" name="x_cpf" id="x_cpf" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($cliente_add->cpf->getPlaceHolder()) ?>" value="<?php echo $cliente_add->cpf->EditValue ?>"<?php echo $cliente_add->cpf->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_cliente_cpf">
<span<?php echo $cliente_add->cpf->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cliente_add->cpf->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cliente" data-field="x_cpf" name="x_cpf" id="x_cpf" value="<?php echo HtmlEncode($cliente_add->cpf->FormValue) ?>">
<?php } ?>
<?php echo $cliente_add->cpf->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_add->nascimento->Visible) { // nascimento ?>
	<div id="r_nascimento" class="form-group row">
		<label id="elh_cliente_nascimento" for="x_nascimento" class="<?php echo $cliente_add->LeftColumnClass ?>"><?php echo $cliente_add->nascimento->caption() ?><?php echo $cliente_add->nascimento->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_add->RightColumnClass ?>"><div <?php echo $cliente_add->nascimento->cellAttributes() ?>>
<?php if (!$cliente->isConfirm()) { ?>
<span id="el_cliente_nascimento">
<input type="text" data-table="cliente" data-field="x_nascimento" name="x_nascimento" id="x_nascimento" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($cliente_add->nascimento->getPlaceHolder()) ?>" value="<?php echo $cliente_add->nascimento->EditValue ?>"<?php echo $cliente_add->nascimento->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_cliente_nascimento">
<span<?php echo $cliente_add->nascimento->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cliente_add->nascimento->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cliente" data-field="x_nascimento" name="x_nascimento" id="x_nascimento" value="<?php echo HtmlEncode($cliente_add->nascimento->FormValue) ?>">
<?php } ?>
<?php echo $cliente_add->nascimento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_add->sexo->Visible) { // sexo ?>
	<div id="r_sexo" class="form-group row">
		<label id="elh_cliente_sexo" for="x_sexo" class="<?php echo $cliente_add->LeftColumnClass ?>"><?php echo $cliente_add->sexo->caption() ?><?php echo $cliente_add->sexo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_add->RightColumnClass ?>"><div <?php echo $cliente_add->sexo->cellAttributes() ?>>
<?php if (!$cliente->isConfirm()) { ?>
<span id="el_cliente_sexo">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="cliente" data-field="x_sexo" data-value-separator="<?php echo $cliente_add->sexo->displayValueSeparatorAttribute() ?>" id="x_sexo" name="x_sexo"<?php echo $cliente_add->sexo->editAttributes() ?>>
			<?php echo $cliente_add->sexo->selectOptionListHtml("x_sexo") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el_cliente_sexo">
<span<?php echo $cliente_add->sexo->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cliente_add->sexo->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cliente" data-field="x_sexo" name="x_sexo" id="x_sexo" value="<?php echo HtmlEncode($cliente_add->sexo->FormValue) ?>">
<?php } ?>
<?php echo $cliente_add->sexo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_add->telefone->Visible) { // telefone ?>
	<div id="r_telefone" class="form-group row">
		<label id="elh_cliente_telefone" for="x_telefone" class="<?php echo $cliente_add->LeftColumnClass ?>"><?php echo $cliente_add->telefone->caption() ?><?php echo $cliente_add->telefone->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_add->RightColumnClass ?>"><div <?php echo $cliente_add->telefone->cellAttributes() ?>>
<?php if (!$cliente->isConfirm()) { ?>
<span id="el_cliente_telefone">
<input type="text" data-table="cliente" data-field="x_telefone" name="x_telefone" id="x_telefone" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($cliente_add->telefone->getPlaceHolder()) ?>" value="<?php echo $cliente_add->telefone->EditValue ?>"<?php echo $cliente_add->telefone->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_cliente_telefone">
<span<?php echo $cliente_add->telefone->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cliente_add->telefone->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cliente" data-field="x_telefone" name="x_telefone" id="x_telefone" value="<?php echo HtmlEncode($cliente_add->telefone->FormValue) ?>">
<?php } ?>
<?php echo $cliente_add->telefone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_add->cep->Visible) { // cep ?>
	<div id="r_cep" class="form-group row">
		<label id="elh_cliente_cep" for="x_cep" class="<?php echo $cliente_add->LeftColumnClass ?>"><?php echo $cliente_add->cep->caption() ?><?php echo $cliente_add->cep->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_add->RightColumnClass ?>"><div <?php echo $cliente_add->cep->cellAttributes() ?>>
<?php if (!$cliente->isConfirm()) { ?>
<span id="el_cliente_cep">
<input type="text" data-table="cliente" data-field="x_cep" name="x_cep" id="x_cep" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($cliente_add->cep->getPlaceHolder()) ?>" value="<?php echo $cliente_add->cep->EditValue ?>"<?php echo $cliente_add->cep->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_cliente_cep">
<span<?php echo $cliente_add->cep->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cliente_add->cep->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cliente" data-field="x_cep" name="x_cep" id="x_cep" value="<?php echo HtmlEncode($cliente_add->cep->FormValue) ?>">
<?php } ?>
<?php echo $cliente_add->cep->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_add->rua->Visible) { // rua ?>
	<div id="r_rua" class="form-group row">
		<label id="elh_cliente_rua" for="x_rua" class="<?php echo $cliente_add->LeftColumnClass ?>"><?php echo $cliente_add->rua->caption() ?><?php echo $cliente_add->rua->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_add->RightColumnClass ?>"><div <?php echo $cliente_add->rua->cellAttributes() ?>>
<?php if (!$cliente->isConfirm()) { ?>
<span id="el_cliente_rua">
<input type="text" data-table="cliente" data-field="x_rua" name="x_rua" id="x_rua" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($cliente_add->rua->getPlaceHolder()) ?>" value="<?php echo $cliente_add->rua->EditValue ?>"<?php echo $cliente_add->rua->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_cliente_rua">
<span<?php echo $cliente_add->rua->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cliente_add->rua->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cliente" data-field="x_rua" name="x_rua" id="x_rua" value="<?php echo HtmlEncode($cliente_add->rua->FormValue) ?>">
<?php } ?>
<?php echo $cliente_add->rua->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_add->bairro->Visible) { // bairro ?>
	<div id="r_bairro" class="form-group row">
		<label id="elh_cliente_bairro" for="x_bairro" class="<?php echo $cliente_add->LeftColumnClass ?>"><?php echo $cliente_add->bairro->caption() ?><?php echo $cliente_add->bairro->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_add->RightColumnClass ?>"><div <?php echo $cliente_add->bairro->cellAttributes() ?>>
<?php if (!$cliente->isConfirm()) { ?>
<span id="el_cliente_bairro">
<input type="text" data-table="cliente" data-field="x_bairro" name="x_bairro" id="x_bairro" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($cliente_add->bairro->getPlaceHolder()) ?>" value="<?php echo $cliente_add->bairro->EditValue ?>"<?php echo $cliente_add->bairro->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_cliente_bairro">
<span<?php echo $cliente_add->bairro->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cliente_add->bairro->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cliente" data-field="x_bairro" name="x_bairro" id="x_bairro" value="<?php echo HtmlEncode($cliente_add->bairro->FormValue) ?>">
<?php } ?>
<?php echo $cliente_add->bairro->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_add->numero->Visible) { // numero ?>
	<div id="r_numero" class="form-group row">
		<label id="elh_cliente_numero" for="x_numero" class="<?php echo $cliente_add->LeftColumnClass ?>"><?php echo $cliente_add->numero->caption() ?><?php echo $cliente_add->numero->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_add->RightColumnClass ?>"><div <?php echo $cliente_add->numero->cellAttributes() ?>>
<?php if (!$cliente->isConfirm()) { ?>
<span id="el_cliente_numero">
<input type="text" data-table="cliente" data-field="x_numero" name="x_numero" id="x_numero" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($cliente_add->numero->getPlaceHolder()) ?>" value="<?php echo $cliente_add->numero->EditValue ?>"<?php echo $cliente_add->numero->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_cliente_numero">
<span<?php echo $cliente_add->numero->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cliente_add->numero->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cliente" data-field="x_numero" name="x_numero" id="x_numero" value="<?php echo HtmlEncode($cliente_add->numero->FormValue) ?>">
<?php } ?>
<?php echo $cliente_add->numero->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_add->complemento->Visible) { // complemento ?>
	<div id="r_complemento" class="form-group row">
		<label id="elh_cliente_complemento" for="x_complemento" class="<?php echo $cliente_add->LeftColumnClass ?>"><?php echo $cliente_add->complemento->caption() ?><?php echo $cliente_add->complemento->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_add->RightColumnClass ?>"><div <?php echo $cliente_add->complemento->cellAttributes() ?>>
<?php if (!$cliente->isConfirm()) { ?>
<span id="el_cliente_complemento">
<input type="text" data-table="cliente" data-field="x_complemento" name="x_complemento" id="x_complemento" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($cliente_add->complemento->getPlaceHolder()) ?>" value="<?php echo $cliente_add->complemento->EditValue ?>"<?php echo $cliente_add->complemento->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_cliente_complemento">
<span<?php echo $cliente_add->complemento->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cliente_add->complemento->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cliente" data-field="x_complemento" name="x_complemento" id="x_complemento" value="<?php echo HtmlEncode($cliente_add->complemento->FormValue) ?>">
<?php } ?>
<?php echo $cliente_add->complemento->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_add->cidade->Visible) { // cidade ?>
	<div id="r_cidade" class="form-group row">
		<label id="elh_cliente_cidade" for="x_cidade" class="<?php echo $cliente_add->LeftColumnClass ?>"><?php echo $cliente_add->cidade->caption() ?><?php echo $cliente_add->cidade->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_add->RightColumnClass ?>"><div <?php echo $cliente_add->cidade->cellAttributes() ?>>
<?php if (!$cliente->isConfirm()) { ?>
<span id="el_cliente_cidade">
<input type="text" data-table="cliente" data-field="x_cidade" name="x_cidade" id="x_cidade" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($cliente_add->cidade->getPlaceHolder()) ?>" value="<?php echo $cliente_add->cidade->EditValue ?>"<?php echo $cliente_add->cidade->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_cliente_cidade">
<span<?php echo $cliente_add->cidade->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cliente_add->cidade->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cliente" data-field="x_cidade" name="x_cidade" id="x_cidade" value="<?php echo HtmlEncode($cliente_add->cidade->FormValue) ?>">
<?php } ?>
<?php echo $cliente_add->cidade->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_add->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_cliente__email" for="x__email" class="<?php echo $cliente_add->LeftColumnClass ?>"><?php echo $cliente_add->_email->caption() ?><?php echo $cliente_add->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_add->RightColumnClass ?>"><div <?php echo $cliente_add->_email->cellAttributes() ?>>
<?php if (!$cliente->isConfirm()) { ?>
<span id="el_cliente__email">
<input type="text" data-table="cliente" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($cliente_add->_email->getPlaceHolder()) ?>" value="<?php echo $cliente_add->_email->EditValue ?>"<?php echo $cliente_add->_email->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_cliente__email">
<span<?php echo $cliente_add->_email->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cliente_add->_email->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cliente" data-field="x__email" name="x__email" id="x__email" value="<?php echo HtmlEncode($cliente_add->_email->FormValue) ?>">
<?php } ?>
<?php echo $cliente_add->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente_add->data_matricula->Visible) { // data_matricula ?>
	<div id="r_data_matricula" class="form-group row">
		<label id="elh_cliente_data_matricula" for="x_data_matricula" class="<?php echo $cliente_add->LeftColumnClass ?>"><?php echo $cliente_add->data_matricula->caption() ?><?php echo $cliente_add->data_matricula->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_add->RightColumnClass ?>"><div <?php echo $cliente_add->data_matricula->cellAttributes() ?>>
<?php if (!$cliente->isConfirm()) { ?>
<span id="el_cliente_data_matricula">
<input type="text" data-table="cliente" data-field="x_data_matricula" data-format="7" name="x_data_matricula" id="x_data_matricula" maxlength="10" placeholder="<?php echo HtmlEncode($cliente_add->data_matricula->getPlaceHolder()) ?>" value="<?php echo $cliente_add->data_matricula->EditValue ?>"<?php echo $cliente_add->data_matricula->editAttributes() ?>>
<?php if (!$cliente_add->data_matricula->ReadOnly && !$cliente_add->data_matricula->Disabled && !isset($cliente_add->data_matricula->EditAttrs["readonly"]) && !isset($cliente_add->data_matricula->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fclienteadd", "datetimepicker"], function() {
	ew.createDateTimePicker("fclienteadd", "x_data_matricula", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el_cliente_data_matricula">
<span<?php echo $cliente_add->data_matricula->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($cliente_add->data_matricula->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="cliente" data-field="x_data_matricula" name="x_data_matricula" id="x_data_matricula" value="<?php echo HtmlEncode($cliente_add->data_matricula->FormValue) ?>">
<?php } ?>
<?php echo $cliente_add->data_matricula->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cliente_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cliente_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$cliente->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cliente_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cliente_add->showPageFooter();
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
$cliente_add->terminate();
?>