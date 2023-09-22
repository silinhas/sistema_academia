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
$agenda_list = new agenda_list();

// Run the page
$agenda_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$agenda_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$agenda_list->isExport()) { ?>
<script>
var fagendalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fagendalist = currentForm = new ew.Form("fagendalist", "list");
	fagendalist.formKeyCountName = '<?php echo $agenda_list->FormKeyCountName ?>';

	// Validate form
	fagendalist.validate = function() {
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
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($agenda_list->idagenda->Required) { ?>
				elm = this.getElements("x" + infix + "_idagenda");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_list->idagenda->caption(), $agenda_list->idagenda->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_list->data->Required) { ?>
				elm = this.getElements("x" + infix + "_data");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_list->data->caption(), $agenda_list->data->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_list->hora->Required) { ?>
				elm = this.getElements("x" + infix + "_hora");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_list->hora->caption(), $agenda_list->hora->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_list->descricao->Required) { ?>
				elm = this.getElements("x" + infix + "_descricao");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_list->descricao->caption(), $agenda_list->descricao->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_list->data_now->Required) { ?>
				elm = this.getElements("x" + infix + "_data_now");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_list->data_now->caption(), $agenda_list->data_now->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_list->professor_idprofessor->Required) { ?>
				elm = this.getElements("x" + infix + "_professor_idprofessor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_list->professor_idprofessor->caption(), $agenda_list->professor_idprofessor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($agenda_list->cliente_idcliente->Required) { ?>
				elm = this.getElements("x" + infix + "_cliente_idcliente");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $agenda_list->cliente_idcliente->caption(), $agenda_list->cliente_idcliente->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		if (gridinsert && addcnt == 0) { // No row added
			ew.alert(ew.language.phrase("NoAddRecord"));
			return false;
		}
		return true;
	}

	// Check empty row
	fagendalist.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "data", false)) return false;
		if (ew.valueChanged(fobj, infix, "hora", false)) return false;
		if (ew.valueChanged(fobj, infix, "descricao", false)) return false;
		if (ew.valueChanged(fobj, infix, "data_now", false)) return false;
		if (ew.valueChanged(fobj, infix, "professor_idprofessor", false)) return false;
		if (ew.valueChanged(fobj, infix, "cliente_idcliente", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fagendalist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fagendalist.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fagendalist.lists["x_data"] = <?php echo $agenda_list->data->Lookup->toClientList($agenda_list) ?>;
	fagendalist.lists["x_data"].options = <?php echo JsonEncode($agenda_list->data->lookupOptions()) ?>;
	fagendalist.lists["x_hora"] = <?php echo $agenda_list->hora->Lookup->toClientList($agenda_list) ?>;
	fagendalist.lists["x_hora"].options = <?php echo JsonEncode($agenda_list->hora->lookupOptions()) ?>;
	fagendalist.lists["x_descricao"] = <?php echo $agenda_list->descricao->Lookup->toClientList($agenda_list) ?>;
	fagendalist.lists["x_descricao"].options = <?php echo JsonEncode($agenda_list->descricao->lookupOptions()) ?>;
	fagendalist.lists["x_data_now"] = <?php echo $agenda_list->data_now->Lookup->toClientList($agenda_list) ?>;
	fagendalist.lists["x_data_now"].options = <?php echo JsonEncode($agenda_list->data_now->lookupOptions()) ?>;
	fagendalist.lists["x_professor_idprofessor"] = <?php echo $agenda_list->professor_idprofessor->Lookup->toClientList($agenda_list) ?>;
	fagendalist.lists["x_professor_idprofessor"].options = <?php echo JsonEncode($agenda_list->professor_idprofessor->lookupOptions()) ?>;
	fagendalist.lists["x_cliente_idcliente"] = <?php echo $agenda_list->cliente_idcliente->Lookup->toClientList($agenda_list) ?>;
	fagendalist.lists["x_cliente_idcliente"].options = <?php echo JsonEncode($agenda_list->cliente_idcliente->lookupOptions()) ?>;
	loadjs.done("fagendalist");
});
var fagendalistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fagendalistsrch = currentSearchForm = new ew.Form("fagendalistsrch");

	// Dynamic selection lists
	// Filters

	fagendalistsrch.filterList = <?php echo $agenda_list->getFilterList() ?>;
	loadjs.done("fagendalistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$agenda_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($agenda_list->TotalRecords > 0 && $agenda_list->ExportOptions->visible()) { ?>
<?php $agenda_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($agenda_list->ImportOptions->visible()) { ?>
<?php $agenda_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($agenda_list->SearchOptions->visible()) { ?>
<?php $agenda_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($agenda_list->FilterOptions->visible()) { ?>
<?php $agenda_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$agenda_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$agenda_list->isExport() && !$agenda->CurrentAction) { ?>
<form name="fagendalistsrch" id="fagendalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fagendalistsrch-search-panel" class="<?php echo $agenda_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="agenda">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $agenda_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($agenda_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($agenda_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $agenda_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($agenda_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($agenda_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($agenda_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($agenda_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $agenda_list->showPageHeader(); ?>
<?php
$agenda_list->showMessage();
?>
<?php if ($agenda_list->TotalRecords > 0 || $agenda->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($agenda_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> agenda">
<form name="fagendalist" id="fagendalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="agenda">
<div id="gmp_agenda" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($agenda_list->TotalRecords > 0 || $agenda_list->isAdd() || $agenda_list->isCopy() || $agenda_list->isGridEdit()) { ?>
<table id="tbl_agendalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$agenda->RowType = ROWTYPE_HEADER;

// Render list options
$agenda_list->renderListOptions();

// Render list options (header, left)
$agenda_list->ListOptions->render("header", "left");
?>
<?php if ($agenda_list->idagenda->Visible) { // idagenda ?>
	<?php if ($agenda_list->SortUrl($agenda_list->idagenda) == "") { ?>
		<th data-name="idagenda" class="<?php echo $agenda_list->idagenda->headerCellClass() ?>"><div id="elh_agenda_idagenda" class="agenda_idagenda"><div class="ew-table-header-caption"><?php echo $agenda_list->idagenda->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idagenda" class="<?php echo $agenda_list->idagenda->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agenda_list->SortUrl($agenda_list->idagenda) ?>', 1);"><div id="elh_agenda_idagenda" class="agenda_idagenda">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agenda_list->idagenda->caption() ?></span><span class="ew-table-header-sort"><?php if ($agenda_list->idagenda->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agenda_list->idagenda->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($agenda_list->data->Visible) { // data ?>
	<?php if ($agenda_list->SortUrl($agenda_list->data) == "") { ?>
		<th data-name="data" class="<?php echo $agenda_list->data->headerCellClass() ?>"><div id="elh_agenda_data" class="agenda_data"><div class="ew-table-header-caption"><?php echo $agenda_list->data->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="data" class="<?php echo $agenda_list->data->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agenda_list->SortUrl($agenda_list->data) ?>', 1);"><div id="elh_agenda_data" class="agenda_data">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agenda_list->data->caption() ?></span><span class="ew-table-header-sort"><?php if ($agenda_list->data->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agenda_list->data->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($agenda_list->hora->Visible) { // hora ?>
	<?php if ($agenda_list->SortUrl($agenda_list->hora) == "") { ?>
		<th data-name="hora" class="<?php echo $agenda_list->hora->headerCellClass() ?>"><div id="elh_agenda_hora" class="agenda_hora"><div class="ew-table-header-caption"><?php echo $agenda_list->hora->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hora" class="<?php echo $agenda_list->hora->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agenda_list->SortUrl($agenda_list->hora) ?>', 1);"><div id="elh_agenda_hora" class="agenda_hora">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agenda_list->hora->caption() ?></span><span class="ew-table-header-sort"><?php if ($agenda_list->hora->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agenda_list->hora->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($agenda_list->descricao->Visible) { // descricao ?>
	<?php if ($agenda_list->SortUrl($agenda_list->descricao) == "") { ?>
		<th data-name="descricao" class="<?php echo $agenda_list->descricao->headerCellClass() ?>"><div id="elh_agenda_descricao" class="agenda_descricao"><div class="ew-table-header-caption"><?php echo $agenda_list->descricao->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descricao" class="<?php echo $agenda_list->descricao->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agenda_list->SortUrl($agenda_list->descricao) ?>', 1);"><div id="elh_agenda_descricao" class="agenda_descricao">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agenda_list->descricao->caption() ?></span><span class="ew-table-header-sort"><?php if ($agenda_list->descricao->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agenda_list->descricao->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($agenda_list->data_now->Visible) { // data_now ?>
	<?php if ($agenda_list->SortUrl($agenda_list->data_now) == "") { ?>
		<th data-name="data_now" class="<?php echo $agenda_list->data_now->headerCellClass() ?>"><div id="elh_agenda_data_now" class="agenda_data_now"><div class="ew-table-header-caption"><?php echo $agenda_list->data_now->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="data_now" class="<?php echo $agenda_list->data_now->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agenda_list->SortUrl($agenda_list->data_now) ?>', 1);"><div id="elh_agenda_data_now" class="agenda_data_now">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agenda_list->data_now->caption() ?></span><span class="ew-table-header-sort"><?php if ($agenda_list->data_now->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agenda_list->data_now->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($agenda_list->professor_idprofessor->Visible) { // professor_idprofessor ?>
	<?php if ($agenda_list->SortUrl($agenda_list->professor_idprofessor) == "") { ?>
		<th data-name="professor_idprofessor" class="<?php echo $agenda_list->professor_idprofessor->headerCellClass() ?>"><div id="elh_agenda_professor_idprofessor" class="agenda_professor_idprofessor"><div class="ew-table-header-caption"><?php echo $agenda_list->professor_idprofessor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="professor_idprofessor" class="<?php echo $agenda_list->professor_idprofessor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agenda_list->SortUrl($agenda_list->professor_idprofessor) ?>', 1);"><div id="elh_agenda_professor_idprofessor" class="agenda_professor_idprofessor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agenda_list->professor_idprofessor->caption() ?></span><span class="ew-table-header-sort"><?php if ($agenda_list->professor_idprofessor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agenda_list->professor_idprofessor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($agenda_list->cliente_idcliente->Visible) { // cliente_idcliente ?>
	<?php if ($agenda_list->SortUrl($agenda_list->cliente_idcliente) == "") { ?>
		<th data-name="cliente_idcliente" class="<?php echo $agenda_list->cliente_idcliente->headerCellClass() ?>"><div id="elh_agenda_cliente_idcliente" class="agenda_cliente_idcliente"><div class="ew-table-header-caption"><?php echo $agenda_list->cliente_idcliente->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cliente_idcliente" class="<?php echo $agenda_list->cliente_idcliente->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agenda_list->SortUrl($agenda_list->cliente_idcliente) ?>', 1);"><div id="elh_agenda_cliente_idcliente" class="agenda_cliente_idcliente">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agenda_list->cliente_idcliente->caption() ?></span><span class="ew-table-header-sort"><?php if ($agenda_list->cliente_idcliente->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agenda_list->cliente_idcliente->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$agenda_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
	if ($agenda_list->isAdd() || $agenda_list->isCopy()) {
		$agenda_list->RowIndex = 0;
		$agenda_list->KeyCount = $agenda_list->RowIndex;
		if ($agenda_list->isCopy() && !$agenda_list->loadRow())
			$agenda->CurrentAction = "add";
		if ($agenda_list->isAdd())
			$agenda_list->loadRowValues();
		if ($agenda->EventCancelled) // Insert failed
			$agenda_list->restoreFormValues(); // Restore form values

		// Set row properties
		$agenda->resetAttributes();
		$agenda->RowAttrs->merge(["data-rowindex" => 0, "id" => "r0_agenda", "data-rowtype" => ROWTYPE_ADD]);
		$agenda->RowType = ROWTYPE_ADD;

		// Render row
		$agenda_list->renderRow();

		// Render list options
		$agenda_list->renderListOptions();
		$agenda_list->StartRowCount = 0;
?>
	<tr <?php echo $agenda->rowAttributes() ?>>
<?php

// Render list options (body, left)
$agenda_list->ListOptions->render("body", "left", $agenda_list->RowCount);
?>
	<?php if ($agenda_list->idagenda->Visible) { // idagenda ?>
		<td data-name="idagenda">
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_idagenda" class="form-group agenda_idagenda"></span>
<input type="hidden" data-table="agenda" data-field="x_idagenda" name="o<?php echo $agenda_list->RowIndex ?>_idagenda" id="o<?php echo $agenda_list->RowIndex ?>_idagenda" value="<?php echo HtmlEncode($agenda_list->idagenda->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($agenda_list->data->Visible) { // data ?>
		<td data-name="data">
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_data" class="form-group agenda_data">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_data" data-value-separator="<?php echo $agenda_list->data->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_data" name="x<?php echo $agenda_list->RowIndex ?>_data"<?php echo $agenda_list->data->editAttributes() ?>>
			<?php echo $agenda_list->data->selectOptionListHtml("x{$agenda_list->RowIndex}_data") ?>
		</select>
</div>
<?php echo $agenda_list->data->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_data") ?>
</span>
<input type="hidden" data-table="agenda" data-field="x_data" name="o<?php echo $agenda_list->RowIndex ?>_data" id="o<?php echo $agenda_list->RowIndex ?>_data" value="<?php echo HtmlEncode($agenda_list->data->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($agenda_list->hora->Visible) { // hora ?>
		<td data-name="hora">
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_hora" class="form-group agenda_hora">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_hora" data-value-separator="<?php echo $agenda_list->hora->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_hora" name="x<?php echo $agenda_list->RowIndex ?>_hora"<?php echo $agenda_list->hora->editAttributes() ?>>
			<?php echo $agenda_list->hora->selectOptionListHtml("x{$agenda_list->RowIndex}_hora") ?>
		</select>
</div>
<?php echo $agenda_list->hora->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_hora") ?>
</span>
<input type="hidden" data-table="agenda" data-field="x_hora" name="o<?php echo $agenda_list->RowIndex ?>_hora" id="o<?php echo $agenda_list->RowIndex ?>_hora" value="<?php echo HtmlEncode($agenda_list->hora->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($agenda_list->descricao->Visible) { // descricao ?>
		<td data-name="descricao">
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_descricao" class="form-group agenda_descricao">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_descricao" data-value-separator="<?php echo $agenda_list->descricao->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_descricao" name="x<?php echo $agenda_list->RowIndex ?>_descricao"<?php echo $agenda_list->descricao->editAttributes() ?>>
			<?php echo $agenda_list->descricao->selectOptionListHtml("x{$agenda_list->RowIndex}_descricao") ?>
		</select>
</div>
<?php echo $agenda_list->descricao->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_descricao") ?>
</span>
<input type="hidden" data-table="agenda" data-field="x_descricao" name="o<?php echo $agenda_list->RowIndex ?>_descricao" id="o<?php echo $agenda_list->RowIndex ?>_descricao" value="<?php echo HtmlEncode($agenda_list->descricao->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($agenda_list->data_now->Visible) { // data_now ?>
		<td data-name="data_now">
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_data_now" class="form-group agenda_data_now">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_data_now" data-value-separator="<?php echo $agenda_list->data_now->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_data_now" name="x<?php echo $agenda_list->RowIndex ?>_data_now"<?php echo $agenda_list->data_now->editAttributes() ?>>
			<?php echo $agenda_list->data_now->selectOptionListHtml("x{$agenda_list->RowIndex}_data_now") ?>
		</select>
</div>
<?php echo $agenda_list->data_now->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_data_now") ?>
</span>
<input type="hidden" data-table="agenda" data-field="x_data_now" name="o<?php echo $agenda_list->RowIndex ?>_data_now" id="o<?php echo $agenda_list->RowIndex ?>_data_now" value="<?php echo HtmlEncode($agenda_list->data_now->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($agenda_list->professor_idprofessor->Visible) { // professor_idprofessor ?>
		<td data-name="professor_idprofessor">
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_professor_idprofessor" class="form-group agenda_professor_idprofessor">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_professor_idprofessor" data-value-separator="<?php echo $agenda_list->professor_idprofessor->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_professor_idprofessor" name="x<?php echo $agenda_list->RowIndex ?>_professor_idprofessor"<?php echo $agenda_list->professor_idprofessor->editAttributes() ?>>
			<?php echo $agenda_list->professor_idprofessor->selectOptionListHtml("x{$agenda_list->RowIndex}_professor_idprofessor") ?>
		</select>
</div>
<?php echo $agenda_list->professor_idprofessor->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_professor_idprofessor") ?>
</span>
<input type="hidden" data-table="agenda" data-field="x_professor_idprofessor" name="o<?php echo $agenda_list->RowIndex ?>_professor_idprofessor" id="o<?php echo $agenda_list->RowIndex ?>_professor_idprofessor" value="<?php echo HtmlEncode($agenda_list->professor_idprofessor->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($agenda_list->cliente_idcliente->Visible) { // cliente_idcliente ?>
		<td data-name="cliente_idcliente">
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_cliente_idcliente" class="form-group agenda_cliente_idcliente">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_cliente_idcliente" data-value-separator="<?php echo $agenda_list->cliente_idcliente->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_cliente_idcliente" name="x<?php echo $agenda_list->RowIndex ?>_cliente_idcliente"<?php echo $agenda_list->cliente_idcliente->editAttributes() ?>>
			<?php echo $agenda_list->cliente_idcliente->selectOptionListHtml("x{$agenda_list->RowIndex}_cliente_idcliente") ?>
		</select>
</div>
<?php echo $agenda_list->cliente_idcliente->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_cliente_idcliente") ?>
</span>
<input type="hidden" data-table="agenda" data-field="x_cliente_idcliente" name="o<?php echo $agenda_list->RowIndex ?>_cliente_idcliente" id="o<?php echo $agenda_list->RowIndex ?>_cliente_idcliente" value="<?php echo HtmlEncode($agenda_list->cliente_idcliente->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$agenda_list->ListOptions->render("body", "right", $agenda_list->RowCount);
?>
<script>
loadjs.ready(["fagendalist", "load"], function() {
	fagendalist.updateLists(<?php echo $agenda_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
<?php
if ($agenda_list->ExportAll && $agenda_list->isExport()) {
	$agenda_list->StopRecord = $agenda_list->TotalRecords;
} else {

	// Set the last record to display
	if ($agenda_list->TotalRecords > $agenda_list->StartRecord + $agenda_list->DisplayRecords - 1)
		$agenda_list->StopRecord = $agenda_list->StartRecord + $agenda_list->DisplayRecords - 1;
	else
		$agenda_list->StopRecord = $agenda_list->TotalRecords;
}

// Restore number of post back records
if ($CurrentForm && ($agenda->isConfirm() || $agenda_list->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($agenda_list->FormKeyCountName) && ($agenda_list->isGridAdd() || $agenda_list->isGridEdit() || $agenda->isConfirm())) {
		$agenda_list->KeyCount = $CurrentForm->getValue($agenda_list->FormKeyCountName);
		$agenda_list->StopRecord = $agenda_list->StartRecord + $agenda_list->KeyCount - 1;
	}
}
$agenda_list->RecordCount = $agenda_list->StartRecord - 1;
if ($agenda_list->Recordset && !$agenda_list->Recordset->EOF) {
	$agenda_list->Recordset->moveFirst();
	$selectLimit = $agenda_list->UseSelectLimit;
	if (!$selectLimit && $agenda_list->StartRecord > 1)
		$agenda_list->Recordset->move($agenda_list->StartRecord - 1);
} elseif (!$agenda->AllowAddDeleteRow && $agenda_list->StopRecord == 0) {
	$agenda_list->StopRecord = $agenda->GridAddRowCount;
}

// Initialize aggregate
$agenda->RowType = ROWTYPE_AGGREGATEINIT;
$agenda->resetAttributes();
$agenda_list->renderRow();
$agenda_list->EditRowCount = 0;
if ($agenda_list->isEdit())
	$agenda_list->RowIndex = 1;
if ($agenda_list->isGridAdd())
	$agenda_list->RowIndex = 0;
if ($agenda_list->isGridEdit())
	$agenda_list->RowIndex = 0;
while ($agenda_list->RecordCount < $agenda_list->StopRecord) {
	$agenda_list->RecordCount++;
	if ($agenda_list->RecordCount >= $agenda_list->StartRecord) {
		$agenda_list->RowCount++;
		if ($agenda_list->isGridAdd() || $agenda_list->isGridEdit() || $agenda->isConfirm()) {
			$agenda_list->RowIndex++;
			$CurrentForm->Index = $agenda_list->RowIndex;
			if ($CurrentForm->hasValue($agenda_list->FormActionName) && ($agenda->isConfirm() || $agenda_list->EventCancelled))
				$agenda_list->RowAction = strval($CurrentForm->getValue($agenda_list->FormActionName));
			elseif ($agenda_list->isGridAdd())
				$agenda_list->RowAction = "insert";
			else
				$agenda_list->RowAction = "";
		}

		// Set up key count
		$agenda_list->KeyCount = $agenda_list->RowIndex;

		// Init row class and style
		$agenda->resetAttributes();
		$agenda->CssClass = "";
		if ($agenda_list->isGridAdd()) {
			$agenda_list->loadRowValues(); // Load default values
		} else {
			$agenda_list->loadRowValues($agenda_list->Recordset); // Load row values
		}
		$agenda->RowType = ROWTYPE_VIEW; // Render view
		if ($agenda_list->isGridAdd()) // Grid add
			$agenda->RowType = ROWTYPE_ADD; // Render add
		if ($agenda_list->isGridAdd() && $agenda->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$agenda_list->restoreCurrentRowFormValues($agenda_list->RowIndex); // Restore form values
		if ($agenda_list->isEdit()) {
			if ($agenda_list->checkInlineEditKey() && $agenda_list->EditRowCount == 0) { // Inline edit
				$agenda->RowType = ROWTYPE_EDIT; // Render edit
			}
		}
		if ($agenda_list->isGridEdit()) { // Grid edit
			if ($agenda->EventCancelled)
				$agenda_list->restoreCurrentRowFormValues($agenda_list->RowIndex); // Restore form values
			if ($agenda_list->RowAction == "insert")
				$agenda->RowType = ROWTYPE_ADD; // Render add
			else
				$agenda->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($agenda_list->isEdit() && $agenda->RowType == ROWTYPE_EDIT && $agenda->EventCancelled) { // Update failed
			$CurrentForm->Index = 1;
			$agenda_list->restoreFormValues(); // Restore form values
		}
		if ($agenda_list->isGridEdit() && ($agenda->RowType == ROWTYPE_EDIT || $agenda->RowType == ROWTYPE_ADD) && $agenda->EventCancelled) // Update failed
			$agenda_list->restoreCurrentRowFormValues($agenda_list->RowIndex); // Restore form values
		if ($agenda->RowType == ROWTYPE_EDIT) // Edit row
			$agenda_list->EditRowCount++;

		// Set up row id / data-rowindex
		$agenda->RowAttrs->merge(["data-rowindex" => $agenda_list->RowCount, "id" => "r" . $agenda_list->RowCount . "_agenda", "data-rowtype" => $agenda->RowType]);

		// Render row
		$agenda_list->renderRow();

		// Render list options
		$agenda_list->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($agenda_list->RowAction != "delete" && $agenda_list->RowAction != "insertdelete" && !($agenda_list->RowAction == "insert" && $agenda->isConfirm() && $agenda_list->emptyRow())) {
?>
	<tr <?php echo $agenda->rowAttributes() ?>>
<?php

// Render list options (body, left)
$agenda_list->ListOptions->render("body", "left", $agenda_list->RowCount);
?>
	<?php if ($agenda_list->idagenda->Visible) { // idagenda ?>
		<td data-name="idagenda" <?php echo $agenda_list->idagenda->cellAttributes() ?>>
<?php if ($agenda->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_idagenda" class="form-group"></span>
<input type="hidden" data-table="agenda" data-field="x_idagenda" name="o<?php echo $agenda_list->RowIndex ?>_idagenda" id="o<?php echo $agenda_list->RowIndex ?>_idagenda" value="<?php echo HtmlEncode($agenda_list->idagenda->OldValue) ?>">
<?php } ?>
<?php if ($agenda->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_idagenda" class="form-group">
<span<?php echo $agenda_list->idagenda->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($agenda_list->idagenda->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="agenda" data-field="x_idagenda" name="x<?php echo $agenda_list->RowIndex ?>_idagenda" id="x<?php echo $agenda_list->RowIndex ?>_idagenda" value="<?php echo HtmlEncode($agenda_list->idagenda->CurrentValue) ?>">
<?php } ?>
<?php if ($agenda->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_idagenda">
<span<?php echo $agenda_list->idagenda->viewAttributes() ?>><?php echo $agenda_list->idagenda->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($agenda_list->data->Visible) { // data ?>
		<td data-name="data" <?php echo $agenda_list->data->cellAttributes() ?>>
<?php if ($agenda->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_data" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_data" data-value-separator="<?php echo $agenda_list->data->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_data" name="x<?php echo $agenda_list->RowIndex ?>_data"<?php echo $agenda_list->data->editAttributes() ?>>
			<?php echo $agenda_list->data->selectOptionListHtml("x{$agenda_list->RowIndex}_data") ?>
		</select>
</div>
<?php echo $agenda_list->data->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_data") ?>
</span>
<input type="hidden" data-table="agenda" data-field="x_data" name="o<?php echo $agenda_list->RowIndex ?>_data" id="o<?php echo $agenda_list->RowIndex ?>_data" value="<?php echo HtmlEncode($agenda_list->data->OldValue) ?>">
<?php } ?>
<?php if ($agenda->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_data" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_data" data-value-separator="<?php echo $agenda_list->data->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_data" name="x<?php echo $agenda_list->RowIndex ?>_data"<?php echo $agenda_list->data->editAttributes() ?>>
			<?php echo $agenda_list->data->selectOptionListHtml("x{$agenda_list->RowIndex}_data") ?>
		</select>
</div>
<?php echo $agenda_list->data->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_data") ?>
</span>
<?php } ?>
<?php if ($agenda->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_data">
<span<?php echo $agenda_list->data->viewAttributes() ?>><?php echo $agenda_list->data->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($agenda_list->hora->Visible) { // hora ?>
		<td data-name="hora" <?php echo $agenda_list->hora->cellAttributes() ?>>
<?php if ($agenda->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_hora" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_hora" data-value-separator="<?php echo $agenda_list->hora->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_hora" name="x<?php echo $agenda_list->RowIndex ?>_hora"<?php echo $agenda_list->hora->editAttributes() ?>>
			<?php echo $agenda_list->hora->selectOptionListHtml("x{$agenda_list->RowIndex}_hora") ?>
		</select>
</div>
<?php echo $agenda_list->hora->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_hora") ?>
</span>
<input type="hidden" data-table="agenda" data-field="x_hora" name="o<?php echo $agenda_list->RowIndex ?>_hora" id="o<?php echo $agenda_list->RowIndex ?>_hora" value="<?php echo HtmlEncode($agenda_list->hora->OldValue) ?>">
<?php } ?>
<?php if ($agenda->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_hora" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_hora" data-value-separator="<?php echo $agenda_list->hora->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_hora" name="x<?php echo $agenda_list->RowIndex ?>_hora"<?php echo $agenda_list->hora->editAttributes() ?>>
			<?php echo $agenda_list->hora->selectOptionListHtml("x{$agenda_list->RowIndex}_hora") ?>
		</select>
</div>
<?php echo $agenda_list->hora->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_hora") ?>
</span>
<?php } ?>
<?php if ($agenda->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_hora">
<span<?php echo $agenda_list->hora->viewAttributes() ?>><?php echo $agenda_list->hora->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($agenda_list->descricao->Visible) { // descricao ?>
		<td data-name="descricao" <?php echo $agenda_list->descricao->cellAttributes() ?>>
<?php if ($agenda->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_descricao" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_descricao" data-value-separator="<?php echo $agenda_list->descricao->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_descricao" name="x<?php echo $agenda_list->RowIndex ?>_descricao"<?php echo $agenda_list->descricao->editAttributes() ?>>
			<?php echo $agenda_list->descricao->selectOptionListHtml("x{$agenda_list->RowIndex}_descricao") ?>
		</select>
</div>
<?php echo $agenda_list->descricao->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_descricao") ?>
</span>
<input type="hidden" data-table="agenda" data-field="x_descricao" name="o<?php echo $agenda_list->RowIndex ?>_descricao" id="o<?php echo $agenda_list->RowIndex ?>_descricao" value="<?php echo HtmlEncode($agenda_list->descricao->OldValue) ?>">
<?php } ?>
<?php if ($agenda->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_descricao" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_descricao" data-value-separator="<?php echo $agenda_list->descricao->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_descricao" name="x<?php echo $agenda_list->RowIndex ?>_descricao"<?php echo $agenda_list->descricao->editAttributes() ?>>
			<?php echo $agenda_list->descricao->selectOptionListHtml("x{$agenda_list->RowIndex}_descricao") ?>
		</select>
</div>
<?php echo $agenda_list->descricao->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_descricao") ?>
</span>
<?php } ?>
<?php if ($agenda->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_descricao">
<span<?php echo $agenda_list->descricao->viewAttributes() ?>><?php echo $agenda_list->descricao->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($agenda_list->data_now->Visible) { // data_now ?>
		<td data-name="data_now" <?php echo $agenda_list->data_now->cellAttributes() ?>>
<?php if ($agenda->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_data_now" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_data_now" data-value-separator="<?php echo $agenda_list->data_now->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_data_now" name="x<?php echo $agenda_list->RowIndex ?>_data_now"<?php echo $agenda_list->data_now->editAttributes() ?>>
			<?php echo $agenda_list->data_now->selectOptionListHtml("x{$agenda_list->RowIndex}_data_now") ?>
		</select>
</div>
<?php echo $agenda_list->data_now->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_data_now") ?>
</span>
<input type="hidden" data-table="agenda" data-field="x_data_now" name="o<?php echo $agenda_list->RowIndex ?>_data_now" id="o<?php echo $agenda_list->RowIndex ?>_data_now" value="<?php echo HtmlEncode($agenda_list->data_now->OldValue) ?>">
<?php } ?>
<?php if ($agenda->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_data_now" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_data_now" data-value-separator="<?php echo $agenda_list->data_now->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_data_now" name="x<?php echo $agenda_list->RowIndex ?>_data_now"<?php echo $agenda_list->data_now->editAttributes() ?>>
			<?php echo $agenda_list->data_now->selectOptionListHtml("x{$agenda_list->RowIndex}_data_now") ?>
		</select>
</div>
<?php echo $agenda_list->data_now->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_data_now") ?>
</span>
<?php } ?>
<?php if ($agenda->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_data_now">
<span<?php echo $agenda_list->data_now->viewAttributes() ?>><?php echo $agenda_list->data_now->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($agenda_list->professor_idprofessor->Visible) { // professor_idprofessor ?>
		<td data-name="professor_idprofessor" <?php echo $agenda_list->professor_idprofessor->cellAttributes() ?>>
<?php if ($agenda->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_professor_idprofessor" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_professor_idprofessor" data-value-separator="<?php echo $agenda_list->professor_idprofessor->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_professor_idprofessor" name="x<?php echo $agenda_list->RowIndex ?>_professor_idprofessor"<?php echo $agenda_list->professor_idprofessor->editAttributes() ?>>
			<?php echo $agenda_list->professor_idprofessor->selectOptionListHtml("x{$agenda_list->RowIndex}_professor_idprofessor") ?>
		</select>
</div>
<?php echo $agenda_list->professor_idprofessor->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_professor_idprofessor") ?>
</span>
<input type="hidden" data-table="agenda" data-field="x_professor_idprofessor" name="o<?php echo $agenda_list->RowIndex ?>_professor_idprofessor" id="o<?php echo $agenda_list->RowIndex ?>_professor_idprofessor" value="<?php echo HtmlEncode($agenda_list->professor_idprofessor->OldValue) ?>">
<?php } ?>
<?php if ($agenda->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_professor_idprofessor" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_professor_idprofessor" data-value-separator="<?php echo $agenda_list->professor_idprofessor->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_professor_idprofessor" name="x<?php echo $agenda_list->RowIndex ?>_professor_idprofessor"<?php echo $agenda_list->professor_idprofessor->editAttributes() ?>>
			<?php echo $agenda_list->professor_idprofessor->selectOptionListHtml("x{$agenda_list->RowIndex}_professor_idprofessor") ?>
		</select>
</div>
<?php echo $agenda_list->professor_idprofessor->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_professor_idprofessor") ?>
</span>
<?php } ?>
<?php if ($agenda->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_professor_idprofessor">
<span<?php echo $agenda_list->professor_idprofessor->viewAttributes() ?>><?php echo $agenda_list->professor_idprofessor->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($agenda_list->cliente_idcliente->Visible) { // cliente_idcliente ?>
		<td data-name="cliente_idcliente" <?php echo $agenda_list->cliente_idcliente->cellAttributes() ?>>
<?php if ($agenda->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_cliente_idcliente" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_cliente_idcliente" data-value-separator="<?php echo $agenda_list->cliente_idcliente->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_cliente_idcliente" name="x<?php echo $agenda_list->RowIndex ?>_cliente_idcliente"<?php echo $agenda_list->cliente_idcliente->editAttributes() ?>>
			<?php echo $agenda_list->cliente_idcliente->selectOptionListHtml("x{$agenda_list->RowIndex}_cliente_idcliente") ?>
		</select>
</div>
<?php echo $agenda_list->cliente_idcliente->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_cliente_idcliente") ?>
</span>
<input type="hidden" data-table="agenda" data-field="x_cliente_idcliente" name="o<?php echo $agenda_list->RowIndex ?>_cliente_idcliente" id="o<?php echo $agenda_list->RowIndex ?>_cliente_idcliente" value="<?php echo HtmlEncode($agenda_list->cliente_idcliente->OldValue) ?>">
<?php } ?>
<?php if ($agenda->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_cliente_idcliente" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_cliente_idcliente" data-value-separator="<?php echo $agenda_list->cliente_idcliente->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_cliente_idcliente" name="x<?php echo $agenda_list->RowIndex ?>_cliente_idcliente"<?php echo $agenda_list->cliente_idcliente->editAttributes() ?>>
			<?php echo $agenda_list->cliente_idcliente->selectOptionListHtml("x{$agenda_list->RowIndex}_cliente_idcliente") ?>
		</select>
</div>
<?php echo $agenda_list->cliente_idcliente->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_cliente_idcliente") ?>
</span>
<?php } ?>
<?php if ($agenda->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $agenda_list->RowCount ?>_agenda_cliente_idcliente">
<span<?php echo $agenda_list->cliente_idcliente->viewAttributes() ?>><?php echo $agenda_list->cliente_idcliente->getViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$agenda_list->ListOptions->render("body", "right", $agenda_list->RowCount);
?>
	</tr>
<?php if ($agenda->RowType == ROWTYPE_ADD || $agenda->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fagendalist", "load"], function() {
	fagendalist.updateLists(<?php echo $agenda_list->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$agenda_list->isGridAdd())
		if (!$agenda_list->Recordset->EOF)
			$agenda_list->Recordset->moveNext();
}
?>
<?php
	if ($agenda_list->isGridAdd() || $agenda_list->isGridEdit()) {
		$agenda_list->RowIndex = '$rowindex$';
		$agenda_list->loadRowValues();

		// Set row properties
		$agenda->resetAttributes();
		$agenda->RowAttrs->merge(["data-rowindex" => $agenda_list->RowIndex, "id" => "r0_agenda", "data-rowtype" => ROWTYPE_ADD]);
		$agenda->RowAttrs->appendClass("ew-template");
		$agenda->RowType = ROWTYPE_ADD;

		// Render row
		$agenda_list->renderRow();

		// Render list options
		$agenda_list->renderListOptions();
		$agenda_list->StartRowCount = 0;
?>
	<tr <?php echo $agenda->rowAttributes() ?>>
<?php

// Render list options (body, left)
$agenda_list->ListOptions->render("body", "left", $agenda_list->RowIndex);
?>
	<?php if ($agenda_list->idagenda->Visible) { // idagenda ?>
		<td data-name="idagenda">
<span id="el$rowindex$_agenda_idagenda" class="form-group agenda_idagenda"></span>
<input type="hidden" data-table="agenda" data-field="x_idagenda" name="o<?php echo $agenda_list->RowIndex ?>_idagenda" id="o<?php echo $agenda_list->RowIndex ?>_idagenda" value="<?php echo HtmlEncode($agenda_list->idagenda->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($agenda_list->data->Visible) { // data ?>
		<td data-name="data">
<span id="el$rowindex$_agenda_data" class="form-group agenda_data">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_data" data-value-separator="<?php echo $agenda_list->data->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_data" name="x<?php echo $agenda_list->RowIndex ?>_data"<?php echo $agenda_list->data->editAttributes() ?>>
			<?php echo $agenda_list->data->selectOptionListHtml("x{$agenda_list->RowIndex}_data") ?>
		</select>
</div>
<?php echo $agenda_list->data->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_data") ?>
</span>
<input type="hidden" data-table="agenda" data-field="x_data" name="o<?php echo $agenda_list->RowIndex ?>_data" id="o<?php echo $agenda_list->RowIndex ?>_data" value="<?php echo HtmlEncode($agenda_list->data->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($agenda_list->hora->Visible) { // hora ?>
		<td data-name="hora">
<span id="el$rowindex$_agenda_hora" class="form-group agenda_hora">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_hora" data-value-separator="<?php echo $agenda_list->hora->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_hora" name="x<?php echo $agenda_list->RowIndex ?>_hora"<?php echo $agenda_list->hora->editAttributes() ?>>
			<?php echo $agenda_list->hora->selectOptionListHtml("x{$agenda_list->RowIndex}_hora") ?>
		</select>
</div>
<?php echo $agenda_list->hora->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_hora") ?>
</span>
<input type="hidden" data-table="agenda" data-field="x_hora" name="o<?php echo $agenda_list->RowIndex ?>_hora" id="o<?php echo $agenda_list->RowIndex ?>_hora" value="<?php echo HtmlEncode($agenda_list->hora->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($agenda_list->descricao->Visible) { // descricao ?>
		<td data-name="descricao">
<span id="el$rowindex$_agenda_descricao" class="form-group agenda_descricao">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_descricao" data-value-separator="<?php echo $agenda_list->descricao->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_descricao" name="x<?php echo $agenda_list->RowIndex ?>_descricao"<?php echo $agenda_list->descricao->editAttributes() ?>>
			<?php echo $agenda_list->descricao->selectOptionListHtml("x{$agenda_list->RowIndex}_descricao") ?>
		</select>
</div>
<?php echo $agenda_list->descricao->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_descricao") ?>
</span>
<input type="hidden" data-table="agenda" data-field="x_descricao" name="o<?php echo $agenda_list->RowIndex ?>_descricao" id="o<?php echo $agenda_list->RowIndex ?>_descricao" value="<?php echo HtmlEncode($agenda_list->descricao->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($agenda_list->data_now->Visible) { // data_now ?>
		<td data-name="data_now">
<span id="el$rowindex$_agenda_data_now" class="form-group agenda_data_now">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_data_now" data-value-separator="<?php echo $agenda_list->data_now->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_data_now" name="x<?php echo $agenda_list->RowIndex ?>_data_now"<?php echo $agenda_list->data_now->editAttributes() ?>>
			<?php echo $agenda_list->data_now->selectOptionListHtml("x{$agenda_list->RowIndex}_data_now") ?>
		</select>
</div>
<?php echo $agenda_list->data_now->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_data_now") ?>
</span>
<input type="hidden" data-table="agenda" data-field="x_data_now" name="o<?php echo $agenda_list->RowIndex ?>_data_now" id="o<?php echo $agenda_list->RowIndex ?>_data_now" value="<?php echo HtmlEncode($agenda_list->data_now->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($agenda_list->professor_idprofessor->Visible) { // professor_idprofessor ?>
		<td data-name="professor_idprofessor">
<span id="el$rowindex$_agenda_professor_idprofessor" class="form-group agenda_professor_idprofessor">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_professor_idprofessor" data-value-separator="<?php echo $agenda_list->professor_idprofessor->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_professor_idprofessor" name="x<?php echo $agenda_list->RowIndex ?>_professor_idprofessor"<?php echo $agenda_list->professor_idprofessor->editAttributes() ?>>
			<?php echo $agenda_list->professor_idprofessor->selectOptionListHtml("x{$agenda_list->RowIndex}_professor_idprofessor") ?>
		</select>
</div>
<?php echo $agenda_list->professor_idprofessor->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_professor_idprofessor") ?>
</span>
<input type="hidden" data-table="agenda" data-field="x_professor_idprofessor" name="o<?php echo $agenda_list->RowIndex ?>_professor_idprofessor" id="o<?php echo $agenda_list->RowIndex ?>_professor_idprofessor" value="<?php echo HtmlEncode($agenda_list->professor_idprofessor->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($agenda_list->cliente_idcliente->Visible) { // cliente_idcliente ?>
		<td data-name="cliente_idcliente">
<span id="el$rowindex$_agenda_cliente_idcliente" class="form-group agenda_cliente_idcliente">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="agenda" data-field="x_cliente_idcliente" data-value-separator="<?php echo $agenda_list->cliente_idcliente->displayValueSeparatorAttribute() ?>" id="x<?php echo $agenda_list->RowIndex ?>_cliente_idcliente" name="x<?php echo $agenda_list->RowIndex ?>_cliente_idcliente"<?php echo $agenda_list->cliente_idcliente->editAttributes() ?>>
			<?php echo $agenda_list->cliente_idcliente->selectOptionListHtml("x{$agenda_list->RowIndex}_cliente_idcliente") ?>
		</select>
</div>
<?php echo $agenda_list->cliente_idcliente->Lookup->getParamTag($agenda_list, "p_x" . $agenda_list->RowIndex . "_cliente_idcliente") ?>
</span>
<input type="hidden" data-table="agenda" data-field="x_cliente_idcliente" name="o<?php echo $agenda_list->RowIndex ?>_cliente_idcliente" id="o<?php echo $agenda_list->RowIndex ?>_cliente_idcliente" value="<?php echo HtmlEncode($agenda_list->cliente_idcliente->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$agenda_list->ListOptions->render("body", "right", $agenda_list->RowIndex);
?>
<script>
loadjs.ready(["fagendalist", "load"], function() {
	fagendalist.updateLists(<?php echo $agenda_list->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if ($agenda_list->isAdd() || $agenda_list->isCopy()) { ?>
<input type="hidden" name="<?php echo $agenda_list->FormKeyCountName ?>" id="<?php echo $agenda_list->FormKeyCountName ?>" value="<?php echo $agenda_list->KeyCount ?>">
<?php } ?>
<?php if ($agenda_list->isGridAdd()) { ?>
<input type="hidden" name="action" id="action" value="gridinsert">
<input type="hidden" name="<?php echo $agenda_list->FormKeyCountName ?>" id="<?php echo $agenda_list->FormKeyCountName ?>" value="<?php echo $agenda_list->KeyCount ?>">
<?php echo $agenda_list->MultiSelectKey ?>
<?php } ?>
<?php if ($agenda_list->isEdit()) { ?>
<input type="hidden" name="<?php echo $agenda_list->FormKeyCountName ?>" id="<?php echo $agenda_list->FormKeyCountName ?>" value="<?php echo $agenda_list->KeyCount ?>">
<?php } ?>
<?php if ($agenda_list->isGridEdit()) { ?>
<input type="hidden" name="action" id="action" value="gridupdate">
<input type="hidden" name="<?php echo $agenda_list->FormKeyCountName ?>" id="<?php echo $agenda_list->FormKeyCountName ?>" value="<?php echo $agenda_list->KeyCount ?>">
<?php echo $agenda_list->MultiSelectKey ?>
<?php } ?>
<?php if (!$agenda->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($agenda_list->Recordset)
	$agenda_list->Recordset->Close();
?>
<?php if (!$agenda_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$agenda_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $agenda_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $agenda_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($agenda_list->TotalRecords == 0 && !$agenda->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $agenda_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$agenda_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$agenda_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$agenda_list->terminate();
?>