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
$mensalidade_list = new mensalidade_list();

// Run the page
$mensalidade_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mensalidade_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$mensalidade_list->isExport()) { ?>
<script>
var fmensalidadelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmensalidadelist = currentForm = new ew.Form("fmensalidadelist", "list");
	fmensalidadelist.formKeyCountName = '<?php echo $mensalidade_list->FormKeyCountName ?>';
	loadjs.done("fmensalidadelist");
});
var fmensalidadelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmensalidadelistsrch = currentSearchForm = new ew.Form("fmensalidadelistsrch");

	// Dynamic selection lists
	// Filters

	fmensalidadelistsrch.filterList = <?php echo $mensalidade_list->getFilterList() ?>;
	loadjs.done("fmensalidadelistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$mensalidade_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($mensalidade_list->TotalRecords > 0 && $mensalidade_list->ExportOptions->visible()) { ?>
<?php $mensalidade_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($mensalidade_list->ImportOptions->visible()) { ?>
<?php $mensalidade_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($mensalidade_list->SearchOptions->visible()) { ?>
<?php $mensalidade_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($mensalidade_list->FilterOptions->visible()) { ?>
<?php $mensalidade_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$mensalidade_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$mensalidade_list->isExport() && !$mensalidade->CurrentAction) { ?>
<form name="fmensalidadelistsrch" id="fmensalidadelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmensalidadelistsrch-search-panel" class="<?php echo $mensalidade_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="mensalidade">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $mensalidade_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($mensalidade_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($mensalidade_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $mensalidade_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($mensalidade_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($mensalidade_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($mensalidade_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($mensalidade_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $mensalidade_list->showPageHeader(); ?>
<?php
$mensalidade_list->showMessage();
?>
<?php if ($mensalidade_list->TotalRecords > 0 || $mensalidade->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($mensalidade_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> mensalidade">
<form name="fmensalidadelist" id="fmensalidadelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mensalidade">
<div id="gmp_mensalidade" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($mensalidade_list->TotalRecords > 0 || $mensalidade_list->isGridEdit()) { ?>
<table id="tbl_mensalidadelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$mensalidade->RowType = ROWTYPE_HEADER;

// Render list options
$mensalidade_list->renderListOptions();

// Render list options (header, left)
$mensalidade_list->ListOptions->render("header", "left");
?>
<?php if ($mensalidade_list->idmensalidade->Visible) { // idmensalidade ?>
	<?php if ($mensalidade_list->SortUrl($mensalidade_list->idmensalidade) == "") { ?>
		<th data-name="idmensalidade" class="<?php echo $mensalidade_list->idmensalidade->headerCellClass() ?>"><div id="elh_mensalidade_idmensalidade" class="mensalidade_idmensalidade"><div class="ew-table-header-caption"><?php echo $mensalidade_list->idmensalidade->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idmensalidade" class="<?php echo $mensalidade_list->idmensalidade->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mensalidade_list->SortUrl($mensalidade_list->idmensalidade) ?>', 1);"><div id="elh_mensalidade_idmensalidade" class="mensalidade_idmensalidade">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mensalidade_list->idmensalidade->caption() ?></span><span class="ew-table-header-sort"><?php if ($mensalidade_list->idmensalidade->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mensalidade_list->idmensalidade->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mensalidade_list->cliente_idcliente->Visible) { // cliente_idcliente ?>
	<?php if ($mensalidade_list->SortUrl($mensalidade_list->cliente_idcliente) == "") { ?>
		<th data-name="cliente_idcliente" class="<?php echo $mensalidade_list->cliente_idcliente->headerCellClass() ?>"><div id="elh_mensalidade_cliente_idcliente" class="mensalidade_cliente_idcliente"><div class="ew-table-header-caption"><?php echo $mensalidade_list->cliente_idcliente->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cliente_idcliente" class="<?php echo $mensalidade_list->cliente_idcliente->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mensalidade_list->SortUrl($mensalidade_list->cliente_idcliente) ?>', 1);"><div id="elh_mensalidade_cliente_idcliente" class="mensalidade_cliente_idcliente">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mensalidade_list->cliente_idcliente->caption() ?></span><span class="ew-table-header-sort"><?php if ($mensalidade_list->cliente_idcliente->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mensalidade_list->cliente_idcliente->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mensalidade_list->mes->Visible) { // mes ?>
	<?php if ($mensalidade_list->SortUrl($mensalidade_list->mes) == "") { ?>
		<th data-name="mes" class="<?php echo $mensalidade_list->mes->headerCellClass() ?>"><div id="elh_mensalidade_mes" class="mensalidade_mes"><div class="ew-table-header-caption"><?php echo $mensalidade_list->mes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="mes" class="<?php echo $mensalidade_list->mes->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mensalidade_list->SortUrl($mensalidade_list->mes) ?>', 1);"><div id="elh_mensalidade_mes" class="mensalidade_mes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mensalidade_list->mes->caption() ?></span><span class="ew-table-header-sort"><?php if ($mensalidade_list->mes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mensalidade_list->mes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mensalidade_list->status->Visible) { // status ?>
	<?php if ($mensalidade_list->SortUrl($mensalidade_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $mensalidade_list->status->headerCellClass() ?>"><div id="elh_mensalidade_status" class="mensalidade_status"><div class="ew-table-header-caption"><?php echo $mensalidade_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $mensalidade_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mensalidade_list->SortUrl($mensalidade_list->status) ?>', 1);"><div id="elh_mensalidade_status" class="mensalidade_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mensalidade_list->status->caption() ?></span><span class="ew-table-header-sort"><?php if ($mensalidade_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mensalidade_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mensalidade_list->valor->Visible) { // valor ?>
	<?php if ($mensalidade_list->SortUrl($mensalidade_list->valor) == "") { ?>
		<th data-name="valor" class="<?php echo $mensalidade_list->valor->headerCellClass() ?>"><div id="elh_mensalidade_valor" class="mensalidade_valor"><div class="ew-table-header-caption"><?php echo $mensalidade_list->valor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="valor" class="<?php echo $mensalidade_list->valor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mensalidade_list->SortUrl($mensalidade_list->valor) ?>', 1);"><div id="elh_mensalidade_valor" class="mensalidade_valor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mensalidade_list->valor->caption() ?></span><span class="ew-table-header-sort"><?php if ($mensalidade_list->valor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mensalidade_list->valor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($mensalidade_list->data_pagamento->Visible) { // data_pagamento ?>
	<?php if ($mensalidade_list->SortUrl($mensalidade_list->data_pagamento) == "") { ?>
		<th data-name="data_pagamento" class="<?php echo $mensalidade_list->data_pagamento->headerCellClass() ?>"><div id="elh_mensalidade_data_pagamento" class="mensalidade_data_pagamento"><div class="ew-table-header-caption"><?php echo $mensalidade_list->data_pagamento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="data_pagamento" class="<?php echo $mensalidade_list->data_pagamento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mensalidade_list->SortUrl($mensalidade_list->data_pagamento) ?>', 1);"><div id="elh_mensalidade_data_pagamento" class="mensalidade_data_pagamento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mensalidade_list->data_pagamento->caption() ?></span><span class="ew-table-header-sort"><?php if ($mensalidade_list->data_pagamento->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mensalidade_list->data_pagamento->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$mensalidade_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($mensalidade_list->ExportAll && $mensalidade_list->isExport()) {
	$mensalidade_list->StopRecord = $mensalidade_list->TotalRecords;
} else {

	// Set the last record to display
	if ($mensalidade_list->TotalRecords > $mensalidade_list->StartRecord + $mensalidade_list->DisplayRecords - 1)
		$mensalidade_list->StopRecord = $mensalidade_list->StartRecord + $mensalidade_list->DisplayRecords - 1;
	else
		$mensalidade_list->StopRecord = $mensalidade_list->TotalRecords;
}
$mensalidade_list->RecordCount = $mensalidade_list->StartRecord - 1;
if ($mensalidade_list->Recordset && !$mensalidade_list->Recordset->EOF) {
	$mensalidade_list->Recordset->moveFirst();
	$selectLimit = $mensalidade_list->UseSelectLimit;
	if (!$selectLimit && $mensalidade_list->StartRecord > 1)
		$mensalidade_list->Recordset->move($mensalidade_list->StartRecord - 1);
} elseif (!$mensalidade->AllowAddDeleteRow && $mensalidade_list->StopRecord == 0) {
	$mensalidade_list->StopRecord = $mensalidade->GridAddRowCount;
}

// Initialize aggregate
$mensalidade->RowType = ROWTYPE_AGGREGATEINIT;
$mensalidade->resetAttributes();
$mensalidade_list->renderRow();
while ($mensalidade_list->RecordCount < $mensalidade_list->StopRecord) {
	$mensalidade_list->RecordCount++;
	if ($mensalidade_list->RecordCount >= $mensalidade_list->StartRecord) {
		$mensalidade_list->RowCount++;

		// Set up key count
		$mensalidade_list->KeyCount = $mensalidade_list->RowIndex;

		// Init row class and style
		$mensalidade->resetAttributes();
		$mensalidade->CssClass = "";
		if ($mensalidade_list->isGridAdd()) {
		} else {
			$mensalidade_list->loadRowValues($mensalidade_list->Recordset); // Load row values
		}
		$mensalidade->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$mensalidade->RowAttrs->merge(["data-rowindex" => $mensalidade_list->RowCount, "id" => "r" . $mensalidade_list->RowCount . "_mensalidade", "data-rowtype" => $mensalidade->RowType]);

		// Render row
		$mensalidade_list->renderRow();

		// Render list options
		$mensalidade_list->renderListOptions();
?>
	<tr <?php echo $mensalidade->rowAttributes() ?>>
<?php

// Render list options (body, left)
$mensalidade_list->ListOptions->render("body", "left", $mensalidade_list->RowCount);
?>
	<?php if ($mensalidade_list->idmensalidade->Visible) { // idmensalidade ?>
		<td data-name="idmensalidade" <?php echo $mensalidade_list->idmensalidade->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_list->RowCount ?>_mensalidade_idmensalidade">
<span<?php echo $mensalidade_list->idmensalidade->viewAttributes() ?>><?php echo $mensalidade_list->idmensalidade->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mensalidade_list->cliente_idcliente->Visible) { // cliente_idcliente ?>
		<td data-name="cliente_idcliente" <?php echo $mensalidade_list->cliente_idcliente->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_list->RowCount ?>_mensalidade_cliente_idcliente">
<span<?php echo $mensalidade_list->cliente_idcliente->viewAttributes() ?>><?php echo $mensalidade_list->cliente_idcliente->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mensalidade_list->mes->Visible) { // mes ?>
		<td data-name="mes" <?php echo $mensalidade_list->mes->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_list->RowCount ?>_mensalidade_mes">
<span<?php echo $mensalidade_list->mes->viewAttributes() ?>><?php echo $mensalidade_list->mes->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mensalidade_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $mensalidade_list->status->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_list->RowCount ?>_mensalidade_status">
<span<?php echo $mensalidade_list->status->viewAttributes() ?>><?php echo $mensalidade_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mensalidade_list->valor->Visible) { // valor ?>
		<td data-name="valor" <?php echo $mensalidade_list->valor->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_list->RowCount ?>_mensalidade_valor">
<span<?php echo $mensalidade_list->valor->viewAttributes() ?>><?php echo $mensalidade_list->valor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($mensalidade_list->data_pagamento->Visible) { // data_pagamento ?>
		<td data-name="data_pagamento" <?php echo $mensalidade_list->data_pagamento->cellAttributes() ?>>
<span id="el<?php echo $mensalidade_list->RowCount ?>_mensalidade_data_pagamento">
<span<?php echo $mensalidade_list->data_pagamento->viewAttributes() ?>><?php echo $mensalidade_list->data_pagamento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$mensalidade_list->ListOptions->render("body", "right", $mensalidade_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$mensalidade_list->isGridAdd())
		$mensalidade_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$mensalidade->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($mensalidade_list->Recordset)
	$mensalidade_list->Recordset->Close();
?>
<?php if (!$mensalidade_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$mensalidade_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $mensalidade_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $mensalidade_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($mensalidade_list->TotalRecords == 0 && !$mensalidade->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $mensalidade_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$mensalidade_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$mensalidade_list->isExport()) { ?>
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
$mensalidade_list->terminate();
?>