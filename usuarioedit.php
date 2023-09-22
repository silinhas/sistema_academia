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
$usuario_edit = new usuario_edit();

// Run the page
$usuario_edit->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuario_edit->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fusuarioedit, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "edit";
	fusuarioedit = currentForm = new ew.Form("fusuarioedit", "edit");

	// Validate form
	fusuarioedit.validate = function() {
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
			<?php if ($usuario_edit->idusuario->Required) { ?>
				elm = this.getElements("x" + infix + "_idusuario");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario_edit->idusuario->caption(), $usuario_edit->idusuario->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuario_edit->nome->Required) { ?>
				elm = this.getElements("x" + infix + "_nome");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario_edit->nome->caption(), $usuario_edit->nome->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuario_edit->_login->Required) { ?>
				elm = this.getElements("x" + infix + "__login");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario_edit->_login->caption(), $usuario_edit->_login->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuario_edit->senha->Required) { ?>
				elm = this.getElements("x" + infix + "_senha");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario_edit->senha->caption(), $usuario_edit->senha->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuario_edit->userlevel_id->Required) { ?>
				elm = this.getElements("x" + infix + "_userlevel_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $usuario_edit->userlevel_id->caption(), $usuario_edit->userlevel_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($usuario_edit->foto->Required) { ?>
				felm = this.getElements("x" + infix + "_foto");
				elm = this.getElements("fn_x" + infix + "_foto");
				if (felm && elm && !ew.hasValue(elm))
					return this.onError(felm, "<?php echo JsEncode(str_replace("%s", $usuario_edit->foto->caption(), $usuario_edit->foto->RequiredErrorMessage)) ?>");
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
	fusuarioedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fusuarioedit.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fusuarioedit.lists["x_userlevel_id"] = <?php echo $usuario_edit->userlevel_id->Lookup->toClientList($usuario_edit) ?>;
	fusuarioedit.lists["x_userlevel_id"].options = <?php echo JsonEncode($usuario_edit->userlevel_id->lookupOptions()) ?>;
	loadjs.done("fusuarioedit");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $usuario_edit->showPageHeader(); ?>
<?php
$usuario_edit->showMessage();
?>
<form name="fusuarioedit" id="fusuarioedit" class="<?php echo $usuario_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuario">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$usuario_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($usuario_edit->idusuario->Visible) { // idusuario ?>
	<div id="r_idusuario" class="form-group row">
		<label id="elh_usuario_idusuario" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario_edit->idusuario->caption() ?><?php echo $usuario_edit->idusuario->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div <?php echo $usuario_edit->idusuario->cellAttributes() ?>>
<span id="el_usuario_idusuario">
<span<?php echo $usuario_edit->idusuario->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($usuario_edit->idusuario->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_idusuario" name="x_idusuario" id="x_idusuario" value="<?php echo HtmlEncode($usuario_edit->idusuario->CurrentValue) ?>">
<?php echo $usuario_edit->idusuario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario_edit->nome->Visible) { // nome ?>
	<div id="r_nome" class="form-group row">
		<label id="elh_usuario_nome" for="x_nome" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario_edit->nome->caption() ?><?php echo $usuario_edit->nome->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div <?php echo $usuario_edit->nome->cellAttributes() ?>>
<span id="el_usuario_nome">
<input type="text" data-table="usuario" data-field="x_nome" name="x_nome" id="x_nome" size="30" maxlength="100" placeholder="<?php echo HtmlEncode($usuario_edit->nome->getPlaceHolder()) ?>" value="<?php echo $usuario_edit->nome->EditValue ?>"<?php echo $usuario_edit->nome->editAttributes() ?>>
</span>
<?php echo $usuario_edit->nome->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario_edit->_login->Visible) { // login ?>
	<div id="r__login" class="form-group row">
		<label id="elh_usuario__login" for="x__login" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario_edit->_login->caption() ?><?php echo $usuario_edit->_login->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div <?php echo $usuario_edit->_login->cellAttributes() ?>>
<span id="el_usuario__login">
<input type="text" data-table="usuario" data-field="x__login" name="x__login" id="x__login" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuario_edit->_login->getPlaceHolder()) ?>" value="<?php echo $usuario_edit->_login->EditValue ?>"<?php echo $usuario_edit->_login->editAttributes() ?>>
</span>
<?php echo $usuario_edit->_login->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario_edit->senha->Visible) { // senha ?>
	<div id="r_senha" class="form-group row">
		<label id="elh_usuario_senha" for="x_senha" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario_edit->senha->caption() ?><?php echo $usuario_edit->senha->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div <?php echo $usuario_edit->senha->cellAttributes() ?>>
<span id="el_usuario_senha">
<input type="text" data-table="usuario" data-field="x_senha" name="x_senha" id="x_senha" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($usuario_edit->senha->getPlaceHolder()) ?>" value="<?php echo $usuario_edit->senha->EditValue ?>"<?php echo $usuario_edit->senha->editAttributes() ?>>
</span>
<?php echo $usuario_edit->senha->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario_edit->userlevel_id->Visible) { // userlevel_id ?>
	<div id="r_userlevel_id" class="form-group row">
		<label id="elh_usuario_userlevel_id" for="x_userlevel_id" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario_edit->userlevel_id->caption() ?><?php echo $usuario_edit->userlevel_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div <?php echo $usuario_edit->userlevel_id->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_usuario_userlevel_id">
<input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($usuario_edit->userlevel_id->EditValue)) ?>">
</span>
<?php } else { ?>
<span id="el_usuario_userlevel_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="usuario" data-field="x_userlevel_id" data-value-separator="<?php echo $usuario_edit->userlevel_id->displayValueSeparatorAttribute() ?>" id="x_userlevel_id" name="x_userlevel_id"<?php echo $usuario_edit->userlevel_id->editAttributes() ?>>
			<?php echo $usuario_edit->userlevel_id->selectOptionListHtml("x_userlevel_id") ?>
		</select>
</div>
<?php echo $usuario_edit->userlevel_id->Lookup->getParamTag($usuario_edit, "p_x_userlevel_id") ?>
</span>
<?php } ?>
<?php echo $usuario_edit->userlevel_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($usuario_edit->foto->Visible) { // foto ?>
	<div id="r_foto" class="form-group row">
		<label id="elh_usuario_foto" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario_edit->foto->caption() ?><?php echo $usuario_edit->foto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div <?php echo $usuario_edit->foto->cellAttributes() ?>>
<span id="el_usuario_foto">
<div id="fd_x_foto">
<div class="input-group">
	<div class="custom-file">
		<input type="file" class="custom-file-input" title="<?php echo $usuario_edit->foto->title() ?>" data-table="usuario" data-field="x_foto" name="x_foto" id="x_foto" lang="<?php echo CurrentLanguageID() ?>"<?php echo $usuario_edit->foto->editAttributes() ?><?php if ($usuario_edit->foto->ReadOnly || $usuario_edit->foto->Disabled) echo " disabled"; ?>>
		<label class="custom-file-label ew-file-label" for="x_foto"><?php echo $Language->phrase("ChooseFile") ?></label>
	</div>
</div>
<input type="hidden" name="fn_x_foto" id= "fn_x_foto" value="<?php echo $usuario_edit->foto->Upload->FileName ?>">
<input type="hidden" name="fa_x_foto" id= "fa_x_foto" value="<?php echo (Post("fa_x_foto") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_foto" id= "fs_x_foto" value="100">
<input type="hidden" name="fx_x_foto" id= "fx_x_foto" value="<?php echo $usuario_edit->foto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_foto" id= "fm_x_foto" value="<?php echo $usuario_edit->foto->UploadMaxFileSize ?>">
</div>
<table id="ft_x_foto" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php echo $usuario_edit->foto->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$usuario_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $usuario_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $usuario_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$usuario_edit->showPageFooter();
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
$usuario_edit->terminate();
?>