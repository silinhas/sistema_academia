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
$mensalidade_log_list = new mensalidade_log_list();

// Run the page
$mensalidade_log_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mensalidade_log_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$mensalidade_log_list->isExport()) { ?>
<script>
var fmensalidade_loglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmensalidade_loglist = currentForm = new ew.Form("fmensalidade_loglist", "list");
	fmensalidade_loglist.formKeyCountName = '<?php echo $mensalidade_log_list->FormKeyCountName ?>';
	loadjs.done("fmensalidade_loglist");
});
var fmensalidade_loglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmensalidade_loglistsrch = currentSearchForm = new ew.Form("fmensalidade_loglistsrch");

	// Dynamic selection lists
	// Filters

	fmensalidade_loglistsrch.filterList = <?php echo $mensalidade_log_list->getFilterList() ?>;
	loadjs.done("fmensalidade_loglistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$mensalidade_log_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($mensalidade_log_list->TotalRecords > 0 && $mensalidade_log_list->ExportOptions->visible()) { ?>
<?php $mensalidade_log_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($mensalidade_log_list->ImportOptions->visible()) { ?>
<?php $mensalidade_log_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($mensalidade_log_list->SearchOptions->visible()) { ?>
<?php $mensalidade_log_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($mensalidade_log_list->FilterOptions->visible()) { ?>
<?php $mensalidade_log_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$mensalidade_log_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$mensalidade_log_list->isExport() && !$mensalidade_log->CurrentAction) { ?>
<form name="fmensalidade_loglistsrch" id="fmensalidade_loglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmensalidade_loglistsrch-search-panel" class="<?php echo $mensalidade_log_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="mensalidade_log">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $mensalidade_log_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($mensalidade_log_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($mensalidade_log_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $mensalidade_log_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($mensalidade_log_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($mensalidade_log_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($mensalidade_log_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($mensalidade_log_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $mensalidade_log_list->showPageHeader(); ?>
<?php
$mensalidade_log_list->showMessage();
?>
<?php if ($mensalidade_log_list->TotalRecords > 0 || $mensalidade_log->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($mensalidade_log_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> mensalidade_log">
<form name="fmensalidade_loglist" id="fmensalidade_loglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mensalidade_log">
<div id="gmp_mensalidade_log" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($mensalidade_log_list->TotalRecords > 0 || $mensalidade_log_list->isGridEdit()) { ?>
<table id="tbl_mensalidade_loglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$mensalidade_log->RowType = ROWTYPE_HEADER;

// Render list options
$mensalidade_log_list->renderListOptions();

// Render list options (header, left)
$mensalidade_log_list->ListOptions->render("header", "left");
?>
<?php if ($mensalidade_log_list->idmensalidade_log->Visible) { // idmensalidade_log ?>
	<?php if ($mensalidade_log_list->SortUrl($mensalidade_log_list->idmensalidade_log) == "") { ?>
		<th data-name="idmensalidade_log" class="<?php echo $mensalidade_log_list->idmensalidade_log->headerCellClass() ?>"><div id="elh_mensalidade_log_idmensalidade_log" class="mensalidade_log_idmensalidade_log"><div class="ew-table-header-caption"><?php echo $mensalidade_log_list->idmensalidade_log->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idmensalidade_log" class="<?php echo $mensalidade_log_list->idmensalidade_log->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mensalidade_log_list->SortUrl($mensalidade_log_list->idmensalidade_log) ?>', 1);"><div id="elh_mensalidade_log_idmensalidade_log" class="mensalidade_log_idmensalidade_log">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mensalidade_log_list->idmensalidade_log->caption() ?></span><span class="ew-table-header-sort"><?php if ($mensalidade_log_list->idmensalidade_log->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mensalidade_log_list->idmensalidade_log->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mensalidade_log_list->cliente->Visible) { // cliente ?>
	<?php if ($mensalidade_log_list->SortUrl($mensalidade_log_list->cliente) == "") { ?>
		<th data-name="cliente" class="<?php echo $mensalidade_log_list->cliente->headerCellClass() ?>"><div id="elh_mensalidade_log_cliente" class="mensalidade_log_cliente"><div class="ew-table-header-caption"><?php echo $mensalidade_log_list->cliente->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cliente" class="<?php echo $mensalidade_log_list->cliente->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mensalidade_log_list->SortUrl($mensalidade_log_list->cliente) ?>', 1);"><div id="elh_mensalidade_log_cliente" class="mensalidade_log_cliente">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mensalidade_log_list->cliente->caption() ?></span><span class="ew-table-header-sort"><?php if ($mensalidade_log_list->cliente->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mensalidade_log_list->cliente->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mensalidade_log_list->mes->Visible) { // mes ?>
	<?php if ($mensalidade_log_list->SortUrl($mensalidade_log_list->mes) == "") { ?>
		<th data-name="mes" class="<?php echo $mensalidade_log_list->mes->headerCellClass() ?>"><div id="elh_mensalidade_log_mes" class="mensalidade_log_mes"><div class="ew-table-header-caption"><?php echo $mensalidade_log_list->mes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="mes" class="<?php echo $mensalidade_log_list->mes->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mensalidade_log_list->SortUrl($mensalidade_log_list->mes) ?>', 1);"><div id="elh_mensalidade_log_mes" class="mensalidade_log_mes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mensalidade_log_list->mes->caption() ?></span><span class="ew-table-header-sort"><?php if ($mensalidade_log_list->mes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mensalidade_log_list->mes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mensalidade_log_list->valor->Visible) { // valor ?>
	<?php if ($mensalidade_log_list->SortUrl($mensalidade_log_list->valor) == "") { ?>
		<th data-name="valor" class="<?php echo $mensalidade_log_list->valor->headerCellClass() ?>"><div id="elh_mensalidade_log_valor" class="mensalidade_log_valor"><div class="ew-table-header-caption"><?php echo $mensalidade_log_list->valor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="valor" class="<?php echo $mensalidade_log_list->valor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mensalidade_log_list->SortUrl($mensalidade_log_list->valor) ?>', 1);"><div id="elh_mensalidade_log_valor" class="mensalidade_log_valor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mensalidade_log_list->valor->caption() ?></span><span class="ew-table-header-sort"><?php if ($mensalidade_log_list->valor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mensalidade_log_list->valor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mensalidade_log_list->status->Visible) { // status ?>
	<?php if ($mensalidade_log_list->SortUrl($mensalidade_log_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $mensalidade_log_list->status->headerCellClass() ?>"><div id="elh_mensalidade_log_status" class="mensalidade_log_status"><div class="ew-table-header-caption"><?php echo $mensalidade_log_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $mensalidade_log_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mensalidade_log_list->SortUrl($mensalidade_log_list->status) ?>', 1);"><div id="elh_mensalidade_log_status" class="mensalidade_log_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mensalidade_log_list->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($mensalidade_log_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mensalidade_log_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mensalidade_log_list->data_pagamento->Visible) { // data_pagamento ?>
	<?php if ($mensalidade_log_list->SortUrl($mensalidade_log_list->data_pagamento) == "") { ?>
		<th data-name="data_pagamento" class="<?php echo $mensalidade_log_list->data_pagamento->headerCellClass() ?>"><div id="elh_mensalidade_log_data_pagamento" class="mensalidade_log_data_pagamento"><div class="ew-table-header-caption"><?php echo $mensalidade_log_list->data_pagamento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="data_pagamento" class="<?php echo $mensalidade_log_list->data_pagamento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mensalidade_log_list->SortUrl($mensalidade_log_list->data_pagamento) ?>', 1);"><div id="elh_mensalidade_log_data_pagamento" class="mensalidade_log_data_pagamento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mensalidade_log_list->data_pagamento->caption() ?></span><span class="ew-table-header-sort"><?php if ($mensalidade_log_list->data_pagamento->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mensalidade_log_list->data_pagamento->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mensalidade_log_list->acao->Visible) { // acao ?>
	<?php if ($mensalidade_log_list->SortUrl($mensalidade_log_list->acao) == "") { ?>
		<th data-name="acao" class="<?php echo $mensalidade_log_list->acao->headerCellClass() ?>"><div id="elh_mensalidade_log_acao" class="mensalidade_log_acao"><div class="ew-table-header-caption"><?php echo $mensalidade_log_list->acao->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="acao" class="<?php echo $mensalidade_log_list->acao->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mensalidade_log_list->SortUrl($mensalidade_log_list->acao) ?>', 1);"><div id="elh_mensalidade_log_acao" class="mensalidade_log_acao">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mensalidade_log_list->acao->caption() ?></span><span class="ew-table-header-sort"><?php if ($mensalidade_log_list->acao->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mensalidade_log_list->acao->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mensalidade_log_list->data_hora->Visible) { // data_hora ?>
	<?php if ($mensalidade_log_list->SortUrl($mensalidade_log_list->data_hora) == "") { ?>
		<th data-name="data_hora" class="<?php echo $mensalidade_log_list->data_hora->headerCellClass() ?>"><div id="elh_mensalidade_log_data_hora" class="mensalidade_log_data_hora"><div class="ew-table-header-caption"><?php echo $mensalidade_log_list->data_hora->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="data_hora" class="<?php echo $mensalidade_log_list->data_hora->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mensalidade_log_list->SortUrl($mensalidade_log_list->data_hora) ?>', 1);"><div id="elh_mensalidade_log_data_hora" class="mensalidade_log_data_hora">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mensalidade_log_list->data_hora->caption() ?></span><span class="ew-table-header-sort"><?php if ($mensalidade_log_list->data_hora->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mensalidade_log_list->data_hora->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$mensalidade_log_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($mensalidade_log_list->ExportAll && $mensalidade_log_list->isExport()) {
	$mensalidade_log_list->StopRecord = $mensalidade_log_list->TotalRecords;
} else {

	// Set the last record to display
	if ($mensalidade_log_list->TotalRecords > $mensalidade_log_list->StartRecord + $mensalidade_log_list->DisplayRecords - 1)
		$mensalidade_log_list->StopRecord = $mensalidade_log_list->StartRecord + $mensalidade_log_list->DisplayRecords - 1;
	else
		$mensalidade_log_list->StopRecord = $mensalidade_log_list->TotalRecords;
}
$mensalidade_log_list->RecordCount = $mensalidade_log_list->StartRecord - 1;
if ($mensalidade_log_list->Recordset && !$mensalidade_log_list->Recordset->EOF) {
	$mensalidade_log_list->Recordset->moveFirst();
	$selectLimit = $mensalidade_log_list->UseSelectLimit;
	if (!$selectLimit && $mensalidade_log_list->StartRecord > 1)
		$mensalidade_log_list->Recordset->move($mensalidade_log_list->StartRecord - 1);
} elseif (!$mensalidade_log->AllowAddDeleteRow && $mensalidade_log_list->StopRecord == 0) {
	$mensalidade_log_list->StopRecord = $mensalidade_log->GridAddRowCount;
}

// Initialize aggregate
$mensalidade_log->RowType = ROWTYPE_AGGREGATEINIT;
$mensalidade_log->resetAttributes();
$mensalidade_log_list->renderRow();
while ($mensalidade_log_list->RecordCount < $mensalidade_log_list->StopRecord) {
	$mensalidade_log_list->RecordCount++;
	if ($mensalidade_log_list->RecordCount >= $mensalidade_log_list->StartRecord) {
		$mensalidade_log_list->RowCount++;

		// Set up key count
		$mensalidade_log_list->KeyCount = $mensalidade_log_list->RowIndex;

		// Init row class and style
		$mensalidade_log->resetAttributes();
		$mensalidade_log->CssClass = "";
		if ($mensalidade_log_list->isGridAdd()) {
		} else {
			$mensalidade_log_list->loadRowValues($mensalidade_log_list->Recordset); // Load row values
		}
		$mensalidade_log->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$mensalidade_log->RowAttrs->merge(["data-rowindex" => $mensalidade_log_list->RowCount, "id" => "r" . $mensalidade_log_list->RowCount . "_mensalidade_log", "data-rowtype" => $mensalidade_log->RowType]);

		// Render row
		$mensalidade_log_list->renderRow();

		// Render list options
		$mensalidade_log_list->renderListOptions();
?>
	<tr <?php echo $mensalidade_log->rowAttributes() ?>>
<?php

// Render list options (body, left)
$mensalidade_log_list->ListOptions->render("body", "left", $mensalidade_log_list->RowCount);
?>
	<?php if ($mensalidade_log_list->idmensalidade_log->Visible) { // idmensalidade_log ?>
		<td data-name="idmensalidade_log" <?php echo $mensalidade_log_list->idmensalidade_log->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_log_list->RowCount ?>_mensalidade_log_idmensalidade_log">
<span<?php echo $mensalidade_log_list->idmensalidade_log->viewAttributes() ?>><?php echo $mensalidade_log_list->idmensalidade_log->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mensalidade_log_list->cliente->Visible) { // cliente ?>
		<td data-name="cliente" <?php echo $mensalidade_log_list->cliente->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_log_list->RowCount ?>_mensalidade_log_cliente">
<span<?php echo $mensalidade_log_list->cliente->viewAttributes() ?>><?php echo $mensalidade_log_list->cliente->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mensalidade_log_list->mes->Visible) { // mes ?>
		<td data-name="mes" <?php echo $mensalidade_log_list->mes->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_log_list->RowCount ?>_mensalidade_log_mes">
<span<?php echo $mensalidade_log_list->mes->viewAttributes() ?>><?php echo $mensalidade_log_list->mes->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mensalidade_log_list->valor->Visible) { // valor ?>
		<td data-name="valor" <?php echo $mensalidade_log_list->valor->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_log_list->RowCount ?>_mensalidade_log_valor">
<span<?php echo $mensalidade_log_list->valor->viewAttributes() ?>><?php echo $mensalidade_log_list->valor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mensalidade_log_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $mensalidade_log_list->status->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_log_list->RowCount ?>_mensalidade_log_status">
<span<?php echo $mensalidade_log_list->status->viewAttributes() ?>><?php echo $mensalidade_log_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mensalidade_log_list->data_pagamento->Visible) { // data_pagamento ?>
		<td data-name="data_pagamento" <?php echo $mensalidade_log_list->data_pagamento->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_log_list->RowCount ?>_mensalidade_log_data_pagamento">
<span<?php echo $mensalidade_log_list->data_pagamento->viewAttributes() ?>><?php echo $mensalidade_log_list->data_pagamento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mensalidade_log_list->acao->Visible) { // acao ?>
		<td data-name="acao" <?php echo $mensalidade_log_list->acao->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_log_list->RowCount ?>_mensalidade_log_acao">
<span<?php echo $mensalidade_log_list->acao->viewAttributes() ?>><?php echo $mensalidade_log_list->acao->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mensalidade_log_list->data_hora->Visible) { // data_hora ?>
		<td data-name="data_hora" <?php echo $mensalidade_log_list->data_hora->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_log_list->RowCount ?>_mensalidade_log_data_hora">
<span<?php echo $mensalidade_log_list->data_hora->viewAttributes() ?>><?php echo $mensalidade_log_list->data_hora->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$mensalidade_log_list->ListOptions->render("body", "right", $mensalidade_log_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$mensalidade_log_list->isGridAdd())
		$mensalidade_log_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$mensalidade_log->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($mensalidade_log_list->Recordset)
	$mensalidade_log_list->Recordset->Close();
?>
<?php if (!$mensalidade_log_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$mensalidade_log_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $mensalidade_log_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $mensalidade_log_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($mensalidade_log_list->TotalRecords == 0 && !$mensalidade_log->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $mensalidade_log_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$mensalidade_log_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$mensalidade_log_list->isExport()) { ?>
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
$mensalidade_log_list->terminate();
?>