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
$usuario_add = new usuario_add();

// Run the page
$usuario_add->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuario_add->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fusuarioadd, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "add";
	fusuarioadd = currentForm = new ew.Form("fusuarioadd", "add");

	// Validate form
	fusuarioadd.validate = function() {
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
			<?php if ($usuario_add->nome->Required) { ?>
				elm = this.getElements("x" + infix + "_nome");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario_add->nome->caption(), $usuario_add->nome->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuario_add->_login->Required) { ?>
				elm = this.getElements("x" + infix + "__login");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario_add->_login->caption(), $usuario_add->_login->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuario_add->senha->Required) { ?>
				elm = this.getElements("x" + infix + "_senha");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario_add->senha->caption(), $usuario_add->senha->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuario_add->foto->Required) { ?>
				felm = this.getElements("x" + infix + "_foto");
				elm = this.getElements("fn_x" + infix + "_foto");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $usuario_add->foto->caption(), $usuario_add->foto->RequiredErrorMessage)) ?>");
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
	fusuarioadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fusuarioadd.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fusuarioadd");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $usuario_add->showPageHeader(); ?>
<?php
$usuario_add->showMessage();
?>
<form name="fusuarioadd" id="fusuarioadd" class="<?php echo $usuario_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuario">
<?php if ($usuario->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo (int)$usuario_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($usuario_add->nome->Visible) { // nome ?>
	<div id="r_nome" class="form-group row">
		<label id="elh_usuario_nome" for="x_nome" class="<?php echo $usuario_add->LeftColumnClass ?>"><?php echo $usuario_add->nome->caption() ?><?php echo $usuario_add->nome->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_add->RightColumnClass ?>"><div <?php echo $usuario_add->nome->cellAttributes() ?>>
<?php if (!$usuario->isConfirm()) { ?>
<span id="el_usuario_nome">
<input type="text" data-table="usuario" data-field="x_nome" name="x_nome" id="x_nome" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($usuario_add->nome->getPlaceHolder()) ?>" value="<?php echo $usuario_add->nome->EditValue ?>"<?php echo $usuario_add->nome->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario_nome">
<span<?php echo $usuario_add->nome->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($usuario_add->nome->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_nome" name="x_nome" id="x_nome" value="<?php echo HtmlEncode($usuario_add->nome->FormValue) ?>">
<?php } ?>
<?php echo $usuario_add->nome->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario_add->_login->Visible) { // login ?>
	<div id="r__login" class="form-group row">
		<label id="elh_usuario__login" for="x__login" class="<?php echo $usuario_add->LeftColumnClass ?>"><?php echo $usuario_add->_login->caption() ?><?php echo $usuario_add->_login->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_add->RightColumnClass ?>"><div <?php echo $usuario_add->_login->cellAttributes() ?>>
<?php if (!$usuario->isConfirm()) { ?>
<span id="el_usuario__login">
<input type="text" data-table="usuario" data-field="x__login" name="x__login" id="x__login" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuario_add->_login->getPlaceHolder()) ?>" value="<?php echo $usuario_add->_login->EditValue ?>"<?php echo $usuario_add->_login->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario__login">
<span<?php echo $usuario_add->_login->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($usuario_add->_login->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="usuario" data-field="x__login" name="x__login" id="x__login" value="<?php echo HtmlEncode($usuario_add->_login->FormValue) ?>">
<?php } ?>
<?php echo $usuario_add->_login->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario_add->senha->Visible) { // senha ?>
	<div id="r_senha" class="form-group row">
		<label id="elh_usuario_senha" for="x_senha" class="<?php echo $usuario_add->LeftColumnClass ?>"><?php echo $usuario_add->senha->caption() ?><?php echo $usuario_add->senha->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_add->RightColumnClass ?>"><div <?php echo $usuario_add->senha->cellAttributes() ?>>
<?php if (!$usuario->isConfirm()) { ?>
<span id="el_usuario_senha">
<input type="text" data-table="usuario" data-field="x_senha" name="x_senha" id="x_senha" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuario_add->senha->getPlaceHolder()) ?>" value="<?php echo $usuario_add->senha->EditValue ?>"<?php echo $usuario_add->senha->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario_senha">
<span<?php echo $usuario_add->senha->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($usuario_add->senha->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_senha" name="x_senha" id="x_senha" value="<?php echo HtmlEncode($usuario_add->senha->FormValue) ?>">
<?php } ?>
<?php echo $usuario_add->senha->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario_add->foto->Visible) { // foto ?>
	<div id="r_foto" class="form-group row">
		<label id="elh_usuario_foto" class="<?php echo $usuario_add->LeftColumnClass ?>"><?php echo $usuario_add->foto->caption() ?><?php echo $usuario_add->foto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_add->RightColumnClass ?>"><div <?php echo $usuario_add->foto->cellAttributes() ?>>
<span id="el_usuario_foto">
<div id="fd_x_foto">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $usuario_add->foto->title() ?>" data-table="usuario" data-field="x_foto" name="x_foto" id="x_foto" lang="<?php echo CurrentLanguageID() ?>"<?php echo $usuario_add->foto->editAttributes() ?><?php if ($usuario_add->foto->ReadOnly || $usuario_add->foto->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_foto"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_foto" id= "fn_x_foto" value="<?php echo $usuario_add->foto->Upload->FileName ?>">
<input type="hidden" name="fa_x_foto" id= "fa_x_foto" value="0">
<input type="hidden" name="fs_x_foto" id= "fs_x_foto" value="100">
<input type="hidden" name="fx_x_foto" id= "fx_x_foto" value="<?php echo $usuario_add->foto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_foto" id= "fm_x_foto" value="<?php echo $usuario_add->foto->UploadMaxFileSize ?>">
</div>
<table id="ft_x_foto" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $usuario_add->foto->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$usuario_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $usuario_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$usuario->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $usuario_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?php echo $Language->phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$usuario_add->showPageFooter();
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
$usuario_add->terminate();
?>