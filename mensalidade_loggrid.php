<?php
namespace PHPMaker2020\sistema_academia;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($mensalidade_log_grid))
	$mensalidade_log_grid = new mensalidade_log_grid();

// Run the page
$mensalidade_log_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mensalidade_log_grid->Page_Render();
?>
<?php if (!$mensalidade_log_grid->isExport()) { ?>
<script>
var fmensalidade_loggrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fmensalidade_loggrid = new ew.Form("fmensalidade_loggrid", "grid");
	fmensalidade_loggrid.formKeyCountName = '<?php echo $mensalidade_log_grid->FormKeyCountName ?>';

	// Validate form
	fmensalidade_loggrid.validate = function() {
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
			<?php if ($mensalidade_log_grid->idmensalidade_log->Required) { ?>
				elm = this.getElements("x" + infix + "_idmensalidade_log");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_grid->idmensalidade_log->caption(), $mensalidade_log_grid->idmensalidade_log->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_log_grid->cliente->Required) { ?>
				elm = this.getElements("x" + infix + "_cliente");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_grid->cliente->caption(), $mensalidade_log_grid->cliente->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_log_grid->mes->Required) { ?>
				elm = this.getElements("x" + infix + "_mes");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_grid->mes->caption(), $mensalidade_log_grid->mes->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_log_grid->valor->Required) { ?>
				elm = this.getElements("x" + infix + "_valor");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_grid->valor->caption(), $mensalidade_log_grid->valor->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_log_grid->status->Required) { ?>
				elm = this.getElements("x" + infix + "_status");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_grid->status->caption(), $mensalidade_log_grid->status->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_log_grid->data_pagamento->Required) { ?>
				elm = this.getElements("x" + infix + "_data_pagamento");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_grid->data_pagamento->caption(), $mensalidade_log_grid->data_pagamento->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_data_pagamento");
				if (elm && !ew.checkEuroDate(elm.value))
					return this.onError(elm, "<?php echo JsEncode($mensalidade_log_grid->data_pagamento->errorMessage()) ?>");
			<?php if ($mensalidade_log_grid->acao->Required) { ?>
				elm = this.getElements("x" + infix + "_acao");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_grid->acao->caption(), $mensalidade_log_grid->acao->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($mensalidade_log_grid->data_hora->Required) { ?>
				elm = this.getElements("x" + infix + "_data_hora");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $mensalidade_log_grid->data_hora->caption(), $mensalidade_log_grid->data_hora->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_data_hora");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($mensalidade_log_grid->data_hora->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fmensalidade_loggrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "cliente", false)) return false;
		if (ew.valueChanged(fobj, infix, "mes", false)) return false;
		if (ew.valueChanged(fobj, infix, "valor", false)) return false;
		if (ew.valueChanged(fobj, infix, "status", false)) return false;
		if (ew.valueChanged(fobj, infix, "data_pagamento", false)) return false;
		if (ew.valueChanged(fobj, infix, "acao", false)) return false;
		if (ew.valueChanged(fobj, infix, "data_hora", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fmensalidade_loggrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fmensalidade_loggrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fmensalidade_loggrid.lists["x_cliente"] = <?php echo $mensalidade_log_grid->cliente->Lookup->toClientList($mensalidade_log_grid) ?>;
	fmensalidade_loggrid.lists["x_cliente"].options = <?php echo JsonEncode($mensalidade_log_grid->cliente->lookupOptions()) ?>;
	fmensalidade_loggrid.lists["x_valor"] = <?php echo $mensalidade_log_grid->valor->Lookup->toClientList($mensalidade_log_grid) ?>;
	fmensalidade_loggrid.lists["x_valor"].options = <?php echo JsonEncode($mensalidade_log_grid->valor->options(FALSE, TRUE)) ?>;
	fmensalidade_loggrid.lists["x_status"] = <?php echo $mensalidade_log_grid->status->Lookup->toClientList($mensalidade_log_grid) ?>;
	fmensalidade_loggrid.lists["x_status"].options = <?php echo JsonEncode($mensalidade_log_grid->status->options(FALSE, TRUE)) ?>;
	fmensalidade_loggrid.lists["x_acao"] = <?php echo $mensalidade_log_grid->acao->Lookup->toClientList($mensalidade_log_grid) ?>;
	fmensalidade_loggrid.lists["x_acao"].options = <?php echo JsonEncode($mensalidade_log_grid->acao->options(FALSE, TRUE)) ?>;
	loadjs.done("fmensalidade_loggrid");
});
</script>
<?php } ?>
<?php
$mensalidade_log_grid->renderOtherOptions();
?>
<?php if ($mensalidade_log_grid->TotalRecords > 0 || $mensalidade_log->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($mensalidade_log_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> mensalidade_log">
<div id="fmensalidade_loggrid" class="ew-form ew-list-form form-inline">
<div id="gmp_mensalidade_log" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_mensalidade_loggrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$mensalidade_log->RowType = ROWTYPE_HEADER;

// Render list options
$mensalidade_log_grid->renderListOptions();

// Render list options (header, left)
$mensalidade_log_grid->ListOptions->render("header", "left");
?>
<?php if ($mensalidade_log_grid->idmensalidade_log->Visible) { // idmensalidade_log ?>
	<?php if ($mensalidade_log_grid->SortUrl($mensalidade_log_grid->idmensalidade_log) == "") { ?>
		<th data-name="idmensalidade_log" class="<?php echo $mensalidade_log_grid->idmensalidade_log->headerCellClass() ?>"><div id="elh_mensalidade_log_idmensalidade_log" class="mensalidade_log_idmensalidade_log"><div class="ew-table-header-caption"><?php echo $mensalidade_log_grid->idmensalidade_log->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idmensalidade_log" class="<?php echo $mensalidade_log_grid->idmensalidade_log->headerCellClass() ?>"><div><div id="elh_mensalidade_log_idmensalidade_log" class="mensalidade_log_idmensalidade_log">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mensalidade_log_grid->idmensalidade_log->caption() ?></span><span class="ew-table-header-sort"><?php if ($mensalidade_log_grid->idmensalidade_log->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mensalidade_log_grid->idmensalidade_log->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mensalidade_log_grid->cliente->Visible) { // cliente ?>
	<?php if ($mensalidade_log_grid->SortUrl($mensalidade_log_grid->cliente) == "") { ?>
		<th data-name="cliente" class="<?php echo $mensalidade_log_grid->cliente->headerCellClass() ?>"><div id="elh_mensalidade_log_cliente" class="mensalidade_log_cliente"><div class="ew-table-header-caption"><?php echo $mensalidade_log_grid->cliente->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cliente" class="<?php echo $mensalidade_log_grid->cliente->headerCellClass() ?>"><div><div id="elh_mensalidade_log_cliente" class="mensalidade_log_cliente">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mensalidade_log_grid->cliente->caption() ?></span><span class="ew-table-header-sort"><?php if ($mensalidade_log_grid->cliente->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mensalidade_log_grid->cliente->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mensalidade_log_grid->mes->Visible) { // mes ?>
	<?php if ($mensalidade_log_grid->SortUrl($mensalidade_log_grid->mes) == "") { ?>
		<th data-name="mes" class="<?php echo $mensalidade_log_grid->mes->headerCellClass() ?>"><div id="elh_mensalidade_log_mes" class="mensalidade_log_mes"><div class="ew-table-header-caption"><?php echo $mensalidade_log_grid->mes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="mes" class="<?php echo $mensalidade_log_grid->mes->headerCellClass() ?>"><div><div id="elh_mensalidade_log_mes" class="mensalidade_log_mes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mensalidade_log_grid->mes->caption() ?></span><span class="ew-table-header-sort"><?php if ($mensalidade_log_grid->mes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mensalidade_log_grid->mes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mensalidade_log_grid->valor->Visible) { // valor ?>
	<?php if ($mensalidade_log_grid->SortUrl($mensalidade_log_grid->valor) == "") { ?>
		<th data-name="valor" class="<?php echo $mensalidade_log_grid->valor->headerCellClass() ?>"><div id="elh_mensalidade_log_valor" class="mensalidade_log_valor"><div class="ew-table-header-caption"><?php echo $mensalidade_log_grid->valor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="valor" class="<?php echo $mensalidade_log_grid->valor->headerCellClass() ?>"><div><div id="elh_mensalidade_log_valor" class="mensalidade_log_valor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mensalidade_log_grid->valor->caption() ?></span><span class="ew-table-header-sort"><?php if ($mensalidade_log_grid->valor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mensalidade_log_grid->valor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mensalidade_log_grid->status->Visible) { // status ?>
	<?php if ($mensalidade_log_grid->SortUrl($mensalidade_log_grid->status) == "") { ?>
		<th data-name="status" class="<?php echo $mensalidade_log_grid->status->headerCellClass() ?>"><div id="elh_mensalidade_log_status" class="mensalidade_log_status"><div class="ew-table-header-caption"><?php echo $mensalidade_log_grid->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $mensalidade_log_grid->status->headerCellClass() ?>"><div><div id="elh_mensalidade_log_status" class="mensalidade_log_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mensalidade_log_grid->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($mensalidade_log_grid->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mensalidade_log_grid->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mensalidade_log_grid->data_pagamento->Visible) { // data_pagamento ?>
	<?php if ($mensalidade_log_grid->SortUrl($mensalidade_log_grid->data_pagamento) == "") { ?>
		<th data-name="data_pagamento" class="<?php echo $mensalidade_log_grid->data_pagamento->headerCellClass() ?>"><div id="elh_mensalidade_log_data_pagamento" class="mensalidade_log_data_pagamento"><div class="ew-table-header-caption"><?php echo $mensalidade_log_grid->data_pagamento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="data_pagamento" class="<?php echo $mensalidade_log_grid->data_pagamento->headerCellClass() ?>"><div><div id="elh_mensalidade_log_data_pagamento" class="mensalidade_log_data_pagamento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mensalidade_log_grid->data_pagamento->caption() ?></span><span class="ew-table-header-sort"><?php if ($mensalidade_log_grid->data_pagamento->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mensalidade_log_grid->data_pagamento->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mensalidade_log_grid->acao->Visible) { // acao ?>
	<?php if ($mensalidade_log_grid->SortUrl($mensalidade_log_grid->acao) == "") { ?>
		<th data-name="acao" class="<?php echo $mensalidade_log_grid->acao->headerCellClass() ?>"><div id="elh_mensalidade_log_acao" class="mensalidade_log_acao"><div class="ew-table-header-caption"><?php echo $mensalidade_log_grid->acao->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="acao" class="<?php echo $mensalidade_log_grid->acao->headerCellClass() ?>"><div><div id="elh_mensalidade_log_acao" class="mensalidade_log_acao">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mensalidade_log_grid->acao->caption() ?></span><span class="ew-table-header-sort"><?php if ($mensalidade_log_grid->acao->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mensalidade_log_grid->acao->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mensalidade_log_grid->data_hora->Visible) { // data_hora ?>
	<?php if ($mensalidade_log_grid->SortUrl($mensalidade_log_grid->data_hora) == "") { ?>
		<th data-name="data_hora" class="<?php echo $mensalidade_log_grid->data_hora->headerCellClass() ?>"><div id="elh_mensalidade_log_data_hora" class="mensalidade_log_data_hora"><div class="ew-table-header-caption"><?php echo $mensalidade_log_grid->data_hora->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="data_hora" class="<?php echo $mensalidade_log_grid->data_hora->headerCellClass() ?>"><div><div id="elh_mensalidade_log_data_hora" class="mensalidade_log_data_hora">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mensalidade_log_grid->data_hora->caption() ?></span><span class="ew-table-header-sort"><?php if ($mensalidade_log_grid->data_hora->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mensalidade_log_grid->data_hora->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$mensalidade_log_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$mensalidade_log_grid->StartRecord = 1;
$mensalidade_log_grid->StopRecord = $mensalidade_log_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($mensalidade_log->isConfirm() || $mensalidade_log_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($mensalidade_log_grid->FormKeyCountName) && ($mensalidade_log_grid->isGridAdd() || $mensalidade_log_grid->isGridEdit() || $mensalidade_log->isConfirm())) {
		$mensalidade_log_grid->KeyCount = $CurrentForm->getValue($mensalidade_log_grid->FormKeyCountName);
		$mensalidade_log_grid->StopRecord = $mensalidade_log_grid->StartRecord + $mensalidade_log_grid->KeyCount - 1;
	}
}
$mensalidade_log_grid->RecordCount = $mensalidade_log_grid->StartRecord - 1;
if ($mensalidade_log_grid->Recordset && !$mensalidade_log_grid->Recordset->EOF) {
	$mensalidade_log_grid->Recordset->moveFirst();
	$selectLimit = $mensalidade_log_grid->UseSelectLimit;
	if (!$selectLimit && $mensalidade_log_grid->StartRecord > 1)
		$mensalidade_log_grid->Recordset->move($mensalidade_log_grid->StartRecord - 1);
} elseif (!$mensalidade_log->AllowAddDeleteRow && $mensalidade_log_grid->StopRecord == 0) {
	$mensalidade_log_grid->StopRecord = $mensalidade_log->GridAddRowCount;
}

// Initialize aggregate
$mensalidade_log->RowType = ROWTYPE_AGGREGATEINIT;
$mensalidade_log->resetAttributes();
$mensalidade_log_grid->renderRow();
if ($mensalidade_log_grid->isGridAdd())
	$mensalidade_log_grid->RowIndex = 0;
if ($mensalidade_log_grid->isGridEdit())
	$mensalidade_log_grid->RowIndex = 0;
while ($mensalidade_log_grid->RecordCount < $mensalidade_log_grid->StopRecord) {
	$mensalidade_log_grid->RecordCount++;
	if ($mensalidade_log_grid->RecordCount >= $mensalidade_log_grid->StartRecord) {
		$mensalidade_log_grid->RowCount++;
		if ($mensalidade_log_grid->isGridAdd() || $mensalidade_log_grid->isGridEdit() || $mensalidade_log->isConfirm()) {
			$mensalidade_log_grid->RowIndex++;
			$CurrentForm->Index = $mensalidade_log_grid->RowIndex;
			if ($CurrentForm->hasValue($mensalidade_log_grid->FormActionName) && ($mensalidade_log->isConfirm() || $mensalidade_log_grid->EventCancelled))
				$mensalidade_log_grid->RowAction = strval($CurrentForm->getValue($mensalidade_log_grid->FormActionName));
			elseif ($mensalidade_log_grid->isGridAdd())
				$mensalidade_log_grid->RowAction = "insert";
			else
				$mensalidade_log_grid->RowAction = "";
		}

		// Set up key count
		$mensalidade_log_grid->KeyCount = $mensalidade_log_grid->RowIndex;

		// Init row class and style
		$mensalidade_log->resetAttributes();
		$mensalidade_log->CssClass = "";
		if ($mensalidade_log_grid->isGridAdd()) {
			if ($mensalidade_log->CurrentMode == "copy") {
				$mensalidade_log_grid->loadRowValues($mensalidade_log_grid->Recordset); // Load row values
				$mensalidade_log_grid->setRecordKey($mensalidade_log_grid->RowOldKey, $mensalidade_log_grid->Recordset); // Set old record key
			} else {
				$mensalidade_log_grid->loadRowValues(); // Load default values
				$mensalidade_log_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$mensalidade_log_grid->loadRowValues($mensalidade_log_grid->Recordset); // Load row values
		}
		$mensalidade_log->RowType = ROWTYPE_VIEW; // Render view
		if ($mensalidade_log_grid->isGridAdd()) // Grid add
			$mensalidade_log->RowType = ROWTYPE_ADD; // Render add
		if ($mensalidade_log_grid->isGridAdd() && $mensalidade_log->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$mensalidade_log_grid->restoreCurrentRowFormValues($mensalidade_log_grid->RowIndex); // Restore form values
		if ($mensalidade_log_grid->isGridEdit()) { // Grid edit
			if ($mensalidade_log->EventCancelled)
				$mensalidade_log_grid->restoreCurrentRowFormValues($mensalidade_log_grid->RowIndex); // Restore form values
			if ($mensalidade_log_grid->RowAction == "insert")
				$mensalidade_log->RowType = ROWTYPE_ADD; // Render add
			else
				$mensalidade_log->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($mensalidade_log_grid->isGridEdit() && ($mensalidade_log->RowType == ROWTYPE_EDIT || $mensalidade_log->RowType == ROWTYPE_ADD) && $mensalidade_log->EventCancelled) // Update failed
			$mensalidade_log_grid->restoreCurrentRowFormValues($mensalidade_log_grid->RowIndex); // Restore form values
		if ($mensalidade_log->RowType == ROWTYPE_EDIT) // Edit row
			$mensalidade_log_grid->EditRowCount++;
		if ($mensalidade_log->isConfirm()) // Confirm row
			$mensalidade_log_grid->restoreCurrentRowFormValues($mensalidade_log_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$mensalidade_log->RowAttrs->merge(["data-rowindex" => $mensalidade_log_grid->RowCount, "id" => "r" . $mensalidade_log_grid->RowCount . "_mensalidade_log", "data-rowtype" => $mensalidade_log->RowType]);

		// Render row
		$mensalidade_log_grid->renderRow();

		// Render list options
		$mensalidade_log_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($mensalidade_log_grid->RowAction != "delete" && $mensalidade_log_grid->RowAction != "insertdelete" && !($mensalidade_log_grid->RowAction == "insert" && $mensalidade_log->isConfirm() && $mensalidade_log_grid->emptyRow())) {
?>
	<tr <?php echo $mensalidade_log->rowAttributes() ?>>
<?php

// Render list options (body, left)
$mensalidade_log_grid->ListOptions->render("body", "left", $mensalidade_log_grid->RowCount);
?>
	<?php if ($mensalidade_log_grid->idmensalidade_log->Visible) { // idmensalidade_log ?>
		<td data-name="idmensalidade_log" <?php echo $mensalidade_log_grid->idmensalidade_log->cellAttributes() ?>>
<?php if ($mensalidade_log->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_idmensalidade_log" class="form-group"></span>
<input type="hidden" data-table="mensalidade_log" data-field="x_idmensalidade_log" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_idmensalidade_log" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_idmensalidade_log" value="<?php echo HtmlEncode($mensalidade_log_grid->idmensalidade_log->OldValue) ?>">
<?php } ?>
<?php if ($mensalidade_log->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_idmensalidade_log" class="form-group">
<span<?php echo $mensalidade_log_grid->idmensalidade_log->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_log_grid->idmensalidade_log->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_idmensalidade_log" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_idmensalidade_log" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_idmensalidade_log" value="<?php echo HtmlEncode($mensalidade_log_grid->idmensalidade_log->CurrentValue) ?>">
<?php } ?>
<?php if ($mensalidade_log->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_idmensalidade_log">
<span<?php echo $mensalidade_log_grid->idmensalidade_log->viewAttributes() ?>><?php echo $mensalidade_log_grid->idmensalidade_log->getViewValue() ?></span>
</span>
<?php if (!$mensalidade_log->isConfirm()) { ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_idmensalidade_log" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_idmensalidade_log" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_idmensalidade_log" value="<?php echo HtmlEncode($mensalidade_log_grid->idmensalidade_log->FormValue) ?>">
<input type="hidden" data-table="mensalidade_log" data-field="x_idmensalidade_log" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_idmensalidade_log" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_idmensalidade_log" value="<?php echo HtmlEncode($mensalidade_log_grid->idmensalidade_log->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_idmensalidade_log" name="fmensalidade_loggrid$x<?php echo $mensalidade_log_grid->RowIndex ?>_idmensalidade_log" id="fmensalidade_loggrid$x<?php echo $mensalidade_log_grid->RowIndex ?>_idmensalidade_log" value="<?php echo HtmlEncode($mensalidade_log_grid->idmensalidade_log->FormValue) ?>">
<input type="hidden" data-table="mensalidade_log" data-field="x_idmensalidade_log" name="fmensalidade_loggrid$o<?php echo $mensalidade_log_grid->RowIndex ?>_idmensalidade_log" id="fmensalidade_loggrid$o<?php echo $mensalidade_log_grid->RowIndex ?>_idmensalidade_log" value="<?php echo HtmlEncode($mensalidade_log_grid->idmensalidade_log->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($mensalidade_log_grid->cliente->Visible) { // cliente ?>
		<td data-name="cliente" <?php echo $mensalidade_log_grid->cliente->cellAttributes() ?>>
<?php if ($mensalidade_log->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_cliente" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mensalidade_log" data-field="x_cliente" data-value-separator="<?php echo $mensalidade_log_grid->cliente->displayValueSeparatorAttribute() ?>" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_cliente" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_cliente"<?php echo $mensalidade_log_grid->cliente->editAttributes() ?>>
			<?php echo $mensalidade_log_grid->cliente->selectOptionListHtml("x{$mensalidade_log_grid->RowIndex}_cliente") ?>
		</select>
</div>
<?php echo $mensalidade_log_grid->cliente->Lookup->getParamTag($mensalidade_log_grid, "p_x" . $mensalidade_log_grid->RowIndex . "_cliente") ?>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_cliente" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_cliente" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_cliente" value="<?php echo HtmlEncode($mensalidade_log_grid->cliente->OldValue) ?>">
<?php } ?>
<?php if ($mensalidade_log->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_cliente" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mensalidade_log" data-field="x_cliente" data-value-separator="<?php echo $mensalidade_log_grid->cliente->displayValueSeparatorAttribute() ?>" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_cliente" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_cliente"<?php echo $mensalidade_log_grid->cliente->editAttributes() ?>>
			<?php echo $mensalidade_log_grid->cliente->selectOptionListHtml("x{$mensalidade_log_grid->RowIndex}_cliente") ?>
		</select>
</div>
<?php echo $mensalidade_log_grid->cliente->Lookup->getParamTag($mensalidade_log_grid, "p_x" . $mensalidade_log_grid->RowIndex . "_cliente") ?>
</span>
<?php } ?>
<?php if ($mensalidade_log->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_cliente">
<span<?php echo $mensalidade_log_grid->cliente->viewAttributes() ?>><?php echo $mensalidade_log_grid->cliente->getViewValue() ?></span>
</span>
<?php if (!$mensalidade_log->isConfirm()) { ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_cliente" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_cliente" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_cliente" value="<?php echo HtmlEncode($mensalidade_log_grid->cliente->FormValue) ?>">
<input type="hidden" data-table="mensalidade_log" data-field="x_cliente" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_cliente" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_cliente" value="<?php echo HtmlEncode($mensalidade_log_grid->cliente->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_cliente" name="fmensalidade_loggrid$x<?php echo $mensalidade_log_grid->RowIndex ?>_cliente" id="fmensalidade_loggrid$x<?php echo $mensalidade_log_grid->RowIndex ?>_cliente" value="<?php echo HtmlEncode($mensalidade_log_grid->cliente->FormValue) ?>">
<input type="hidden" data-table="mensalidade_log" data-field="x_cliente" name="fmensalidade_loggrid$o<?php echo $mensalidade_log_grid->RowIndex ?>_cliente" id="fmensalidade_loggrid$o<?php echo $mensalidade_log_grid->RowIndex ?>_cliente" value="<?php echo HtmlEncode($mensalidade_log_grid->cliente->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($mensalidade_log_grid->mes->Visible) { // mes ?>
		<td data-name="mes" <?php echo $mensalidade_log_grid->mes->cellAttributes() ?>>
<?php if ($mensalidade_log->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($mensalidade_log_grid->mes->getSessionValue() != "") { ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_mes" class="form-group">
<span<?php echo $mensalidade_log_grid->mes->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_log_grid->mes->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_mes" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_mes" value="<?php echo HtmlEncode($mensalidade_log_grid->mes->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_mes" class="form-group">
<input type="text" data-table="mensalidade_log" data-field="x_mes" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_mes" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_mes" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($mensalidade_log_grid->mes->getPlaceHolder()) ?>" value="<?php echo $mensalidade_log_grid->mes->EditValue ?>"<?php echo $mensalidade_log_grid->mes->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_mes" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_mes" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_mes" value="<?php echo HtmlEncode($mensalidade_log_grid->mes->OldValue) ?>">
<?php } ?>
<?php if ($mensalidade_log->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($mensalidade_log_grid->mes->getSessionValue() != "") { ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_mes" class="form-group">
<span<?php echo $mensalidade_log_grid->mes->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_log_grid->mes->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_mes" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_mes" value="<?php echo HtmlEncode($mensalidade_log_grid->mes->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_mes" class="form-group">
<input type="text" data-table="mensalidade_log" data-field="x_mes" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_mes" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_mes" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($mensalidade_log_grid->mes->getPlaceHolder()) ?>" value="<?php echo $mensalidade_log_grid->mes->EditValue ?>"<?php echo $mensalidade_log_grid->mes->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($mensalidade_log->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_mes">
<span<?php echo $mensalidade_log_grid->mes->viewAttributes() ?>><?php echo $mensalidade_log_grid->mes->getViewValue() ?></span>
</span>
<?php if (!$mensalidade_log->isConfirm()) { ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_mes" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_mes" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_mes" value="<?php echo HtmlEncode($mensalidade_log_grid->mes->FormValue) ?>">
<input type="hidden" data-table="mensalidade_log" data-field="x_mes" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_mes" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_mes" value="<?php echo HtmlEncode($mensalidade_log_grid->mes->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_mes" name="fmensalidade_loggrid$x<?php echo $mensalidade_log_grid->RowIndex ?>_mes" id="fmensalidade_loggrid$x<?php echo $mensalidade_log_grid->RowIndex ?>_mes" value="<?php echo HtmlEncode($mensalidade_log_grid->mes->FormValue) ?>">
<input type="hidden" data-table="mensalidade_log" data-field="x_mes" name="fmensalidade_loggrid$o<?php echo $mensalidade_log_grid->RowIndex ?>_mes" id="fmensalidade_loggrid$o<?php echo $mensalidade_log_grid->RowIndex ?>_mes" value="<?php echo HtmlEncode($mensalidade_log_grid->mes->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($mensalidade_log_grid->valor->Visible) { // valor ?>
		<td data-name="valor" <?php echo $mensalidade_log_grid->valor->cellAttributes() ?>>
<?php if ($mensalidade_log->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_valor" class="form-group">
<div id="tp_x<?php echo $mensalidade_log_grid->RowIndex ?>_valor" class="ew-template"><input type="radio" class="custom-control-input" data-table="mensalidade_log" data-field="x_valor" data-value-separator="<?php echo $mensalidade_log_grid->valor->displayValueSeparatorAttribute() ?>" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_valor" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_valor" value="{value}"<?php echo $mensalidade_log_grid->valor->editAttributes() ?>></div>
<div id="dsl_x<?php echo $mensalidade_log_grid->RowIndex ?>_valor" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $mensalidade_log_grid->valor->radioButtonListHtml(FALSE, "x{$mensalidade_log_grid->RowIndex}_valor") ?>
</div></div>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_valor" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_valor" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_valor" value="<?php echo HtmlEncode($mensalidade_log_grid->valor->OldValue) ?>">
<?php } ?>
<?php if ($mensalidade_log->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_valor" class="form-group">
<div id="tp_x<?php echo $mensalidade_log_grid->RowIndex ?>_valor" class="ew-template"><input type="radio" class="custom-control-input" data-table="mensalidade_log" data-field="x_valor" data-value-separator="<?php echo $mensalidade_log_grid->valor->displayValueSeparatorAttribute() ?>" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_valor" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_valor" value="{value}"<?php echo $mensalidade_log_grid->valor->editAttributes() ?>></div>
<div id="dsl_x<?php echo $mensalidade_log_grid->RowIndex ?>_valor" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $mensalidade_log_grid->valor->radioButtonListHtml(FALSE, "x{$mensalidade_log_grid->RowIndex}_valor") ?>
</div></div>
</span>
<?php } ?>
<?php if ($mensalidade_log->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_valor">
<span<?php echo $mensalidade_log_grid->valor->viewAttributes() ?>><?php echo $mensalidade_log_grid->valor->getViewValue() ?></span>
</span>
<?php if (!$mensalidade_log->isConfirm()) { ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_valor" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_valor" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_valor" value="<?php echo HtmlEncode($mensalidade_log_grid->valor->FormValue) ?>">
<input type="hidden" data-table="mensalidade_log" data-field="x_valor" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_valor" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_valor" value="<?php echo HtmlEncode($mensalidade_log_grid->valor->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_valor" name="fmensalidade_loggrid$x<?php echo $mensalidade_log_grid->RowIndex ?>_valor" id="fmensalidade_loggrid$x<?php echo $mensalidade_log_grid->RowIndex ?>_valor" value="<?php echo HtmlEncode($mensalidade_log_grid->valor->FormValue) ?>">
<input type="hidden" data-table="mensalidade_log" data-field="x_valor" name="fmensalidade_loggrid$o<?php echo $mensalidade_log_grid->RowIndex ?>_valor" id="fmensalidade_loggrid$o<?php echo $mensalidade_log_grid->RowIndex ?>_valor" value="<?php echo HtmlEncode($mensalidade_log_grid->valor->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($mensalidade_log_grid->status->Visible) { // status ?>
		<td data-name="status" <?php echo $mensalidade_log_grid->status->cellAttributes() ?>>
<?php if ($mensalidade_log->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_status" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mensalidade_log" data-field="x_status" data-value-separator="<?php echo $mensalidade_log_grid->status->displayValueSeparatorAttribute() ?>" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_status" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_status"<?php echo $mensalidade_log_grid->status->editAttributes() ?>>
			<?php echo $mensalidade_log_grid->status->selectOptionListHtml("x{$mensalidade_log_grid->RowIndex}_status") ?>
		</select>
</div>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_status" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_status" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($mensalidade_log_grid->status->OldValue) ?>">
<?php } ?>
<?php if ($mensalidade_log->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_status" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mensalidade_log" data-field="x_status" data-value-separator="<?php echo $mensalidade_log_grid->status->displayValueSeparatorAttribute() ?>" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_status" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_status"<?php echo $mensalidade_log_grid->status->editAttributes() ?>>
			<?php echo $mensalidade_log_grid->status->selectOptionListHtml("x{$mensalidade_log_grid->RowIndex}_status") ?>
		</select>
</div>
</span>
<?php } ?>
<?php if ($mensalidade_log->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_status">
<span<?php echo $mensalidade_log_grid->status->viewAttributes() ?>><?php echo $mensalidade_log_grid->status->getViewValue() ?></span>
</span>
<?php if (!$mensalidade_log->isConfirm()) { ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_status" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_status" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($mensalidade_log_grid->status->FormValue) ?>">
<input type="hidden" data-table="mensalidade_log" data-field="x_status" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_status" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($mensalidade_log_grid->status->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_status" name="fmensalidade_loggrid$x<?php echo $mensalidade_log_grid->RowIndex ?>_status" id="fmensalidade_loggrid$x<?php echo $mensalidade_log_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($mensalidade_log_grid->status->FormValue) ?>">
<input type="hidden" data-table="mensalidade_log" data-field="x_status" name="fmensalidade_loggrid$o<?php echo $mensalidade_log_grid->RowIndex ?>_status" id="fmensalidade_loggrid$o<?php echo $mensalidade_log_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($mensalidade_log_grid->status->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($mensalidade_log_grid->data_pagamento->Visible) { // data_pagamento ?>
		<td data-name="data_pagamento" <?php echo $mensalidade_log_grid->data_pagamento->cellAttributes() ?>>
<?php if ($mensalidade_log->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_data_pagamento" class="form-group">
<input type="text" data-table="mensalidade_log" data-field="x_data_pagamento" data-format="7" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento" maxlength="10" placeholder="<?php echo HtmlEncode($mensalidade_log_grid->data_pagamento->getPlaceHolder()) ?>" value="<?php echo $mensalidade_log_grid->data_pagamento->EditValue ?>"<?php echo $mensalidade_log_grid->data_pagamento->editAttributes() ?>>
<?php if (!$mensalidade_log_grid->data_pagamento->ReadOnly && !$mensalidade_log_grid->data_pagamento->Disabled && !isset($mensalidade_log_grid->data_pagamento->EditAttrs["readonly"]) && !isset($mensalidade_log_grid->data_pagamento->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmensalidade_loggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fmensalidade_loggrid", "x<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_data_pagamento" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento" value="<?php echo HtmlEncode($mensalidade_log_grid->data_pagamento->OldValue) ?>">
<?php } ?>
<?php if ($mensalidade_log->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_data_pagamento" class="form-group">
<input type="text" data-table="mensalidade_log" data-field="x_data_pagamento" data-format="7" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento" maxlength="10" placeholder="<?php echo HtmlEncode($mensalidade_log_grid->data_pagamento->getPlaceHolder()) ?>" value="<?php echo $mensalidade_log_grid->data_pagamento->EditValue ?>"<?php echo $mensalidade_log_grid->data_pagamento->editAttributes() ?>>
<?php if (!$mensalidade_log_grid->data_pagamento->ReadOnly && !$mensalidade_log_grid->data_pagamento->Disabled && !isset($mensalidade_log_grid->data_pagamento->EditAttrs["readonly"]) && !isset($mensalidade_log_grid->data_pagamento->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmensalidade_loggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fmensalidade_loggrid", "x<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($mensalidade_log->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_data_pagamento">
<span<?php echo $mensalidade_log_grid->data_pagamento->viewAttributes() ?>><?php echo $mensalidade_log_grid->data_pagamento->getViewValue() ?></span>
</span>
<?php if (!$mensalidade_log->isConfirm()) { ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_data_pagamento" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento" value="<?php echo HtmlEncode($mensalidade_log_grid->data_pagamento->FormValue) ?>">
<input type="hidden" data-table="mensalidade_log" data-field="x_data_pagamento" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento" value="<?php echo HtmlEncode($mensalidade_log_grid->data_pagamento->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_data_pagamento" name="fmensalidade_loggrid$x<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento" id="fmensalidade_loggrid$x<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento" value="<?php echo HtmlEncode($mensalidade_log_grid->data_pagamento->FormValue) ?>">
<input type="hidden" data-table="mensalidade_log" data-field="x_data_pagamento" name="fmensalidade_loggrid$o<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento" id="fmensalidade_loggrid$o<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento" value="<?php echo HtmlEncode($mensalidade_log_grid->data_pagamento->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($mensalidade_log_grid->acao->Visible) { // acao ?>
		<td data-name="acao" <?php echo $mensalidade_log_grid->acao->cellAttributes() ?>>
<?php if ($mensalidade_log->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_acao" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mensalidade_log" data-field="x_acao" data-value-separator="<?php echo $mensalidade_log_grid->acao->displayValueSeparatorAttribute() ?>" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_acao" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_acao"<?php echo $mensalidade_log_grid->acao->editAttributes() ?>>
			<?php echo $mensalidade_log_grid->acao->selectOptionListHtml("x{$mensalidade_log_grid->RowIndex}_acao") ?>
		</select>
</div>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_acao" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_acao" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_acao" value="<?php echo HtmlEncode($mensalidade_log_grid->acao->OldValue) ?>">
<?php } ?>
<?php if ($mensalidade_log->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_acao" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mensalidade_log" data-field="x_acao" data-value-separator="<?php echo $mensalidade_log_grid->acao->displayValueSeparatorAttribute() ?>" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_acao" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_acao"<?php echo $mensalidade_log_grid->acao->editAttributes() ?>>
			<?php echo $mensalidade_log_grid->acao->selectOptionListHtml("x{$mensalidade_log_grid->RowIndex}_acao") ?>
		</select>
</div>
</span>
<?php } ?>
<?php if ($mensalidade_log->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_acao">
<span<?php echo $mensalidade_log_grid->acao->viewAttributes() ?>><?php echo $mensalidade_log_grid->acao->getViewValue() ?></span>
</span>
<?php if (!$mensalidade_log->isConfirm()) { ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_acao" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_acao" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_acao" value="<?php echo HtmlEncode($mensalidade_log_grid->acao->FormValue) ?>">
<input type="hidden" data-table="mensalidade_log" data-field="x_acao" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_acao" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_acao" value="<?php echo HtmlEncode($mensalidade_log_grid->acao->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_acao" name="fmensalidade_loggrid$x<?php echo $mensalidade_log_grid->RowIndex ?>_acao" id="fmensalidade_loggrid$x<?php echo $mensalidade_log_grid->RowIndex ?>_acao" value="<?php echo HtmlEncode($mensalidade_log_grid->acao->FormValue) ?>">
<input type="hidden" data-table="mensalidade_log" data-field="x_acao" name="fmensalidade_loggrid$o<?php echo $mensalidade_log_grid->RowIndex ?>_acao" id="fmensalidade_loggrid$o<?php echo $mensalidade_log_grid->RowIndex ?>_acao" value="<?php echo HtmlEncode($mensalidade_log_grid->acao->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($mensalidade_log_grid->data_hora->Visible) { // data_hora ?>
		<td data-name="data_hora" <?php echo $mensalidade_log_grid->data_hora->cellAttributes() ?>>
<?php if ($mensalidade_log->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_data_hora" class="form-group">
<input type="text" data-table="mensalidade_log" data-field="x_data_hora" data-format="1" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora" maxlength="19" placeholder="<?php echo HtmlEncode($mensalidade_log_grid->data_hora->getPlaceHolder()) ?>" value="<?php echo $mensalidade_log_grid->data_hora->EditValue ?>"<?php echo $mensalidade_log_grid->data_hora->editAttributes() ?>>
<?php if (!$mensalidade_log_grid->data_hora->ReadOnly && !$mensalidade_log_grid->data_hora->Disabled && !isset($mensalidade_log_grid->data_hora->EditAttrs["readonly"]) && !isset($mensalidade_log_grid->data_hora->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmensalidade_loggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fmensalidade_loggrid", "x<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora", {"ignoreReadonly":true,"useCurrent":false,"format":1});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_data_hora" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora" value="<?php echo HtmlEncode($mensalidade_log_grid->data_hora->OldValue) ?>">
<?php } ?>
<?php if ($mensalidade_log->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_data_hora" class="form-group">
<input type="text" data-table="mensalidade_log" data-field="x_data_hora" data-format="1" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora" maxlength="19" placeholder="<?php echo HtmlEncode($mensalidade_log_grid->data_hora->getPlaceHolder()) ?>" value="<?php echo $mensalidade_log_grid->data_hora->EditValue ?>"<?php echo $mensalidade_log_grid->data_hora->editAttributes() ?>>
<?php if (!$mensalidade_log_grid->data_hora->ReadOnly && !$mensalidade_log_grid->data_hora->Disabled && !isset($mensalidade_log_grid->data_hora->EditAttrs["readonly"]) && !isset($mensalidade_log_grid->data_hora->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmensalidade_loggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fmensalidade_loggrid", "x<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora", {"ignoreReadonly":true,"useCurrent":false,"format":1});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($mensalidade_log->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $mensalidade_log_grid->RowCount ?>_mensalidade_log_data_hora">
<span<?php echo $mensalidade_log_grid->data_hora->viewAttributes() ?>><?php echo $mensalidade_log_grid->data_hora->getViewValue() ?></span>
</span>
<?php if (!$mensalidade_log->isConfirm()) { ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_data_hora" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora" value="<?php echo HtmlEncode($mensalidade_log_grid->data_hora->FormValue) ?>">
<input type="hidden" data-table="mensalidade_log" data-field="x_data_hora" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora" value="<?php echo HtmlEncode($mensalidade_log_grid->data_hora->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_data_hora" name="fmensalidade_loggrid$x<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora" id="fmensalidade_loggrid$x<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora" value="<?php echo HtmlEncode($mensalidade_log_grid->data_hora->FormValue) ?>">
<input type="hidden" data-table="mensalidade_log" data-field="x_data_hora" name="fmensalidade_loggrid$o<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora" id="fmensalidade_loggrid$o<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora" value="<?php echo HtmlEncode($mensalidade_log_grid->data_hora->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$mensalidade_log_grid->ListOptions->render("body", "right", $mensalidade_log_grid->RowCount);
?>
	</tr>
<?php if ($mensalidade_log->RowType == ROWTYPE_ADD || $mensalidade_log->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fmensalidade_loggrid", "load"], function() {
	fmensalidade_loggrid.updateLists(<?php echo $mensalidade_log_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$mensalidade_log_grid->isGridAdd() || $mensalidade_log->CurrentMode == "copy")
		if (!$mensalidade_log_grid->Recordset->EOF)
			$mensalidade_log_grid->Recordset->moveNext();
}
?>
<?php
	if ($mensalidade_log->CurrentMode == "add" || $mensalidade_log->CurrentMode == "copy" || $mensalidade_log->CurrentMode == "edit") {
		$mensalidade_log_grid->RowIndex = '$rowindex$';
		$mensalidade_log_grid->loadRowValues();

		// Set row properties
		$mensalidade_log->resetAttributes();
		$mensalidade_log->RowAttrs->merge(["data-rowindex" => $mensalidade_log_grid->RowIndex, "id" => "r0_mensalidade_log", "data-rowtype" => ROWTYPE_ADD]);
		$mensalidade_log->RowAttrs->appendClass("ew-template");
		$mensalidade_log->RowType = ROWTYPE_ADD;

		// Render row
		$mensalidade_log_grid->renderRow();

		// Render list options
		$mensalidade_log_grid->renderListOptions();
		$mensalidade_log_grid->StartRowCount = 0;
?>
	<tr <?php echo $mensalidade_log->rowAttributes() ?>>
<?php

// Render list options (body, left)
$mensalidade_log_grid->ListOptions->render("body", "left", $mensalidade_log_grid->RowIndex);
?>
	<?php if ($mensalidade_log_grid->idmensalidade_log->Visible) { // idmensalidade_log ?>
		<td data-name="idmensalidade_log">
<?php if (!$mensalidade_log->isConfirm()) { ?>
<span id="el$rowindex$_mensalidade_log_idmensalidade_log" class="form-group mensalidade_log_idmensalidade_log"></span>
<?php } else { ?>
<span id="el$rowindex$_mensalidade_log_idmensalidade_log" class="form-group mensalidade_log_idmensalidade_log">
<span<?php echo $mensalidade_log_grid->idmensalidade_log->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_log_grid->idmensalidade_log->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_idmensalidade_log" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_idmensalidade_log" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_idmensalidade_log" value="<?php echo HtmlEncode($mensalidade_log_grid->idmensalidade_log->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_idmensalidade_log" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_idmensalidade_log" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_idmensalidade_log" value="<?php echo HtmlEncode($mensalidade_log_grid->idmensalidade_log->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($mensalidade_log_grid->cliente->Visible) { // cliente ?>
		<td data-name="cliente">
<?php if (!$mensalidade_log->isConfirm()) { ?>
<span id="el$rowindex$_mensalidade_log_cliente" class="form-group mensalidade_log_cliente">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mensalidade_log" data-field="x_cliente" data-value-separator="<?php echo $mensalidade_log_grid->cliente->displayValueSeparatorAttribute() ?>" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_cliente" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_cliente"<?php echo $mensalidade_log_grid->cliente->editAttributes() ?>>
			<?php echo $mensalidade_log_grid->cliente->selectOptionListHtml("x{$mensalidade_log_grid->RowIndex}_cliente") ?>
		</select>
</div>
<?php echo $mensalidade_log_grid->cliente->Lookup->getParamTag($mensalidade_log_grid, "p_x" . $mensalidade_log_grid->RowIndex . "_cliente") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_mensalidade_log_cliente" class="form-group mensalidade_log_cliente">
<span<?php echo $mensalidade_log_grid->cliente->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_log_grid->cliente->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_cliente" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_cliente" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_cliente" value="<?php echo HtmlEncode($mensalidade_log_grid->cliente->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_cliente" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_cliente" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_cliente" value="<?php echo HtmlEncode($mensalidade_log_grid->cliente->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($mensalidade_log_grid->mes->Visible) { // mes ?>
		<td data-name="mes">
<?php if (!$mensalidade_log->isConfirm()) { ?>
<?php if ($mensalidade_log_grid->mes->getSessionValue() != "") { ?>
<span id="el$rowindex$_mensalidade_log_mes" class="form-group mensalidade_log_mes">
<span<?php echo $mensalidade_log_grid->mes->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_log_grid->mes->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_mes" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_mes" value="<?php echo HtmlEncode($mensalidade_log_grid->mes->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_mensalidade_log_mes" class="form-group mensalidade_log_mes">
<input type="text" data-table="mensalidade_log" data-field="x_mes" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_mes" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_mes" size="30" maxlength="45" placeholder="<?php echo HtmlEncode($mensalidade_log_grid->mes->getPlaceHolder()) ?>" value="<?php echo $mensalidade_log_grid->mes->EditValue ?>"<?php echo $mensalidade_log_grid->mes->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_mensalidade_log_mes" class="form-group mensalidade_log_mes">
<span<?php echo $mensalidade_log_grid->mes->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_log_grid->mes->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_mes" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_mes" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_mes" value="<?php echo HtmlEncode($mensalidade_log_grid->mes->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_mes" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_mes" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_mes" value="<?php echo HtmlEncode($mensalidade_log_grid->mes->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($mensalidade_log_grid->valor->Visible) { // valor ?>
		<td data-name="valor">
<?php if (!$mensalidade_log->isConfirm()) { ?>
<span id="el$rowindex$_mensalidade_log_valor" class="form-group mensalidade_log_valor">
<div id="tp_x<?php echo $mensalidade_log_grid->RowIndex ?>_valor" class="ew-template"><input type="radio" class="custom-control-input" data-table="mensalidade_log" data-field="x_valor" data-value-separator="<?php echo $mensalidade_log_grid->valor->displayValueSeparatorAttribute() ?>" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_valor" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_valor" value="{value}"<?php echo $mensalidade_log_grid->valor->editAttributes() ?>></div>
<div id="dsl_x<?php echo $mensalidade_log_grid->RowIndex ?>_valor" data-repeatcolumn="5" class="ew-item-list d-none"><div>
<?php echo $mensalidade_log_grid->valor->radioButtonListHtml(FALSE, "x{$mensalidade_log_grid->RowIndex}_valor") ?>
</div></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_mensalidade_log_valor" class="form-group mensalidade_log_valor">
<span<?php echo $mensalidade_log_grid->valor->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_log_grid->valor->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_valor" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_valor" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_valor" value="<?php echo HtmlEncode($mensalidade_log_grid->valor->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_valor" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_valor" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_valor" value="<?php echo HtmlEncode($mensalidade_log_grid->valor->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($mensalidade_log_grid->status->Visible) { // status ?>
		<td data-name="status">
<?php if (!$mensalidade_log->isConfirm()) { ?>
<span id="el$rowindex$_mensalidade_log_status" class="form-group mensalidade_log_status">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mensalidade_log" data-field="x_status" data-value-separator="<?php echo $mensalidade_log_grid->status->displayValueSeparatorAttribute() ?>" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_status" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_status"<?php echo $mensalidade_log_grid->status->editAttributes() ?>>
			<?php echo $mensalidade_log_grid->status->selectOptionListHtml("x{$mensalidade_log_grid->RowIndex}_status") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_mensalidade_log_status" class="form-group mensalidade_log_status">
<span<?php echo $mensalidade_log_grid->status->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_log_grid->status->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_status" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_status" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($mensalidade_log_grid->status->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_status" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_status" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_status" value="<?php echo HtmlEncode($mensalidade_log_grid->status->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($mensalidade_log_grid->data_pagamento->Visible) { // data_pagamento ?>
		<td data-name="data_pagamento">
<?php if (!$mensalidade_log->isConfirm()) { ?>
<span id="el$rowindex$_mensalidade_log_data_pagamento" class="form-group mensalidade_log_data_pagamento">
<input type="text" data-table="mensalidade_log" data-field="x_data_pagamento" data-format="7" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento" maxlength="10" placeholder="<?php echo HtmlEncode($mensalidade_log_grid->data_pagamento->getPlaceHolder()) ?>" value="<?php echo $mensalidade_log_grid->data_pagamento->EditValue ?>"<?php echo $mensalidade_log_grid->data_pagamento->editAttributes() ?>>
<?php if (!$mensalidade_log_grid->data_pagamento->ReadOnly && !$mensalidade_log_grid->data_pagamento->Disabled && !isset($mensalidade_log_grid->data_pagamento->EditAttrs["readonly"]) && !isset($mensalidade_log_grid->data_pagamento->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmensalidade_loggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fmensalidade_loggrid", "x<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento", {"ignoreReadonly":true,"useCurrent":false,"format":7});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_mensalidade_log_data_pagamento" class="form-group mensalidade_log_data_pagamento">
<span<?php echo $mensalidade_log_grid->data_pagamento->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_log_grid->data_pagamento->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_data_pagamento" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento" value="<?php echo HtmlEncode($mensalidade_log_grid->data_pagamento->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_data_pagamento" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_data_pagamento" value="<?php echo HtmlEncode($mensalidade_log_grid->data_pagamento->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($mensalidade_log_grid->acao->Visible) { // acao ?>
		<td data-name="acao">
<?php if (!$mensalidade_log->isConfirm()) { ?>
<span id="el$rowindex$_mensalidade_log_acao" class="form-group mensalidade_log_acao">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="mensalidade_log" data-field="x_acao" data-value-separator="<?php echo $mensalidade_log_grid->acao->displayValueSeparatorAttribute() ?>" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_acao" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_acao"<?php echo $mensalidade_log_grid->acao->editAttributes() ?>>
			<?php echo $mensalidade_log_grid->acao->selectOptionListHtml("x{$mensalidade_log_grid->RowIndex}_acao") ?>
		</select>
</div>
</span>
<?php } else { ?>
<span id="el$rowindex$_mensalidade_log_acao" class="form-group mensalidade_log_acao">
<span<?php echo $mensalidade_log_grid->acao->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_log_grid->acao->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_acao" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_acao" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_acao" value="<?php echo HtmlEncode($mensalidade_log_grid->acao->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_acao" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_acao" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_acao" value="<?php echo HtmlEncode($mensalidade_log_grid->acao->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($mensalidade_log_grid->data_hora->Visible) { // data_hora ?>
		<td data-name="data_hora">
<?php if (!$mensalidade_log->isConfirm()) { ?>
<span id="el$rowindex$_mensalidade_log_data_hora" class="form-group mensalidade_log_data_hora">
<input type="text" data-table="mensalidade_log" data-field="x_data_hora" data-format="1" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora" maxlength="19" placeholder="<?php echo HtmlEncode($mensalidade_log_grid->data_hora->getPlaceHolder()) ?>" value="<?php echo $mensalidade_log_grid->data_hora->EditValue ?>"<?php echo $mensalidade_log_grid->data_hora->editAttributes() ?>>
<?php if (!$mensalidade_log_grid->data_hora->ReadOnly && !$mensalidade_log_grid->data_hora->Disabled && !isset($mensalidade_log_grid->data_hora->EditAttrs["readonly"]) && !isset($mensalidade_log_grid->data_hora->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fmensalidade_loggrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fmensalidade_loggrid", "x<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora", {"ignoreReadonly":true,"useCurrent":false,"format":1});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_mensalidade_log_data_hora" class="form-group mensalidade_log_data_hora">
<span<?php echo $mensalidade_log_grid->data_hora->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($mensalidade_log_grid->data_hora->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="mensalidade_log" data-field="x_data_hora" name="x<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora" id="x<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora" value="<?php echo HtmlEncode($mensalidade_log_grid->data_hora->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="mensalidade_log" data-field="x_data_hora" name="o<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora" id="o<?php echo $mensalidade_log_grid->RowIndex ?>_data_hora" value="<?php echo HtmlEncode($mensalidade_log_grid->data_hora->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$mensalidade_log_grid->ListOptions->render("body", "right", $mensalidade_log_grid->RowIndex);
?>
<script>
loadjs.ready(["fmensalidade_loggrid", "load"], function() {
	fmensalidade_loggrid.updateLists(<?php echo $mensalidade_log_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($mensalidade_log->CurrentMode == "add" || $mensalidade_log->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $mensalidade_log_grid->FormKeyCountName ?>" id="<?php echo $mensalidade_log_grid->FormKeyCountName ?>" value="<?php echo $mensalidade_log_grid->KeyCount ?>">
<?php echo $mensalidade_log_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($mensalidade_log->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $mensalidade_log_grid->FormKeyCountName ?>" id="<?php echo $mensalidade_log_grid->FormKeyCountName ?>" value="<?php echo $mensalidade_log_grid->KeyCount ?>">
<?php echo $mensalidade_log_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($mensalidade_log->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fmensalidade_loggrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($mensalidade_log_grid->Recordset)
	$mensalidade_log_grid->Recordset->Close();
?>
<?php if ($mensalidade_log_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $mensalidade_log_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($mensalidade_log_grid->TotalRecords == 0 && !$mensalidade_log->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $mensalidade_log_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$mensalidade_log_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$mensalidade_log_grid->terminate();
?>