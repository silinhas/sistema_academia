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
$cliente_log_list = new cliente_log_list();

// Run the page
$cliente_log_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cliente_log_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cliente_log_list->isExport()) { ?>
<script>
var fcliente_loglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcliente_loglist = currentForm = new ew.Form("fcliente_loglist", "list");
	fcliente_loglist.formKeyCountName = '<?php echo $cliente_log_list->FormKeyCountName ?>';
	loadjs.done("fcliente_loglist");
});
var fcliente_loglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcliente_loglistsrch = currentSearchForm = new ew.Form("fcliente_loglistsrch");

	// Dynamic selection lists
	// Filters

	fcliente_loglistsrch.filterList = <?php echo $cliente_log_list->getFilterList() ?>;
	loadjs.done("fcliente_loglistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$cliente_log_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cliente_log_list->TotalRecords > 0 && $cliente_log_list->ExportOptions->visible()) { ?>
<?php $cliente_log_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cliente_log_list->ImportOptions->visible()) { ?>
<?php $cliente_log_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($cliente_log_list->SearchOptions->visible()) { ?>
<?php $cliente_log_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($cliente_log_list->FilterOptions->visible()) { ?>
<?php $cliente_log_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$cliente_log_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$cliente_log_list->isExport() && !$cliente_log->CurrentAction) { ?>
<form name="fcliente_loglistsrch" id="fcliente_loglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcliente_loglistsrch-search-panel" class="<?php echo $cliente_log_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cliente_log">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $cliente_log_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($cliente_log_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($cliente_log_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $cliente_log_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($cliente_log_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($cliente_log_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($cliente_log_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($cliente_log_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $cliente_log_list->showPageHeader(); ?>
<?php
$cliente_log_list->showMessage();
?>
<?php if ($cliente_log_list->TotalRecords > 0 || $cliente_log->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cliente_log_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cliente_log">
<form name="fcliente_loglist" id="fcliente_loglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cliente_log">
<div id="gmp_cliente_log" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($cliente_log_list->TotalRecords > 0 || $cliente_log_list->isGridEdit()) { ?>
<table id="tbl_cliente_loglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cliente_log->RowType = ROWTYPE_HEADER;

// Render list options
$cliente_log_list->renderListOptions();

// Render list options (header, left)
$cliente_log_list->ListOptions->render("header", "left");
?>
<?php if ($cliente_log_list->idcliente_log->Visible) { // idcliente_log ?>
	<?php if ($cliente_log_list->SortUrl($cliente_log_list->idcliente_log) == "") { ?>
		<th data-name="idcliente_log" class="<?php echo $cliente_log_list->idcliente_log->headerCellClass() ?>"><div id="elh_cliente_log_idcliente_log" class="cliente_log_idcliente_log"><div class="ew-table-header-caption"><?php echo $cliente_log_list->idcliente_log->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idcliente_log" class="<?php echo $cliente_log_list->idcliente_log->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cliente_log_list->SortUrl($cliente_log_list->idcliente_log) ?>', 1);"><div id="elh_cliente_log_idcliente_log" class="cliente_log_idcliente_log">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente_log_list->idcliente_log->caption() ?></span><span class="ew-table-header-sort"><?php if ($cliente_log_list->idcliente_log->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cliente_log_list->idcliente_log->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente_log_list->nome->Visible) { // nome ?>
	<?php if ($cliente_log_list->SortUrl($cliente_log_list->nome) == "") { ?>
		<th data-name="nome" class="<?php echo $cliente_log_list->nome->headerCellClass() ?>"><div id="elh_cliente_log_nome" class="cliente_log_nome"><div class="ew-table-header-caption"><?php echo $cliente_log_list->nome->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nome" class="<?php echo $cliente_log_list->nome->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cliente_log_list->SortUrl($cliente_log_list->nome) ?>', 1);"><div id="elh_cliente_log_nome" class="cliente_log_nome">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente_log_list->nome->caption() ?></span><span class="ew-table-header-sort"><?php if ($cliente_log_list->nome->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cliente_log_list->nome->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente_log_list->data_hora->Visible) { // data_hora ?>
	<?php if ($cliente_log_list->SortUrl($cliente_log_list->data_hora) == "") { ?>
		<th data-name="data_hora" class="<?php echo $cliente_log_list->data_hora->headerCellClass() ?>"><div id="elh_cliente_log_data_hora" class="cliente_log_data_hora"><div class="ew-table-header-caption"><?php echo $cliente_log_list->data_hora->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="data_hora" class="<?php echo $cliente_log_list->data_hora->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cliente_log_list->SortUrl($cliente_log_list->data_hora) ?>', 1);"><div id="elh_cliente_log_data_hora" class="cliente_log_data_hora">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente_log_list->data_hora->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cliente_log_list->data_hora->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cliente_log_list->data_hora->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente_log_list->acao->Visible) { // acao ?>
	<?php if ($cliente_log_list->SortUrl($cliente_log_list->acao) == "") { ?>
		<th data-name="acao" class="<?php echo $cliente_log_list->acao->headerCellClass() ?>"><div id="elh_cliente_log_acao" class="cliente_log_acao"><div class="ew-table-header-caption"><?php echo $cliente_log_list->acao->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="acao" class="<?php echo $cliente_log_list->acao->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cliente_log_list->SortUrl($cliente_log_list->acao) ?>', 1);"><div id="elh_cliente_log_acao" class="cliente_log_acao">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente_log_list->acao->caption() ?></span><span class="ew-table-header-sort"><?php if ($cliente_log_list->acao->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cliente_log_list->acao->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente_log_list->foto->Visible) { // foto ?>
	<?php if ($cliente_log_list->SortUrl($cliente_log_list->foto) == "") { ?>
		<th data-name="foto" class="<?php echo $cliente_log_list->foto->headerCellClass() ?>"><div id="elh_cliente_log_foto" class="cliente_log_foto"><div class="ew-table-header-caption"><?php echo $cliente_log_list->foto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="foto" class="<?php echo $cliente_log_list->foto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cliente_log_list->SortUrl($cliente_log_list->foto) ?>', 1);"><div id="elh_cliente_log_foto" class="cliente_log_foto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente_log_list->foto->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cliente_log_list->foto->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cliente_log_list->foto->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cliente_log_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cliente_log_list->ExportAll && $cliente_log_list->isExport()) {
	$cliente_log_list->StopRecord = $cliente_log_list->TotalRecords;
} else {

	// Set the last record to display
	if ($cliente_log_list->TotalRecords > $cliente_log_list->StartRecord + $cliente_log_list->DisplayRecords - 1)
		$cliente_log_list->StopRecord = $cliente_log_list->StartRecord + $cliente_log_list->DisplayRecords - 1;
	else
		$cliente_log_list->StopRecord = $cliente_log_list->TotalRecords;
}
$cliente_log_list->RecordCount = $cliente_log_list->StartRecord - 1;
if ($cliente_log_list->Recordset && !$cliente_log_list->Recordset->EOF) {
	$cliente_log_list->Recordset->moveFirst();
	$selectLimit = $cliente_log_list->UseSelectLimit;
	if (!$selectLimit && $cliente_log_list->StartRecord > 1)
		$cliente_log_list->Recordset->move($cliente_log_list->StartRecord - 1);
} elseif (!$cliente_log->AllowAddDeleteRow && $cliente_log_list->StopRecord == 0) {
	$cliente_log_list->StopRecord = $cliente_log->GridAddRowCount;
}

// Initialize aggregate
$cliente_log->RowType = ROWTYPE_AGGREGATEINIT;
$cliente_log->resetAttributes();
$cliente_log_list->renderRow();
while ($cliente_log_list->RecordCount < $cliente_log_list->StopRecord) {
	$cliente_log_list->RecordCount++;
	if ($cliente_log_list->RecordCount >= $cliente_log_list->StartRecord) {
		$cliente_log_list->RowCount++;

		// Set up key count
		$cliente_log_list->KeyCount = $cliente_log_list->RowIndex;

		// Init row class and style
		$cliente_log->resetAttributes();
		$cliente_log->CssClass = "";
		if ($cliente_log_list->isGridAdd()) {
		} else {
			$cliente_log_list->loadRowValues($cliente_log_list->Recordset); // Load row values
		}
		$cliente_log->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cliente_log->RowAttrs->merge(["data-rowindex" => $cliente_log_list->RowCount, "id" => "r" . $cliente_log_list->RowCount . "_cliente_log", "data-rowtype" => $cliente_log->RowType]);

		// Render row
		$cliente_log_list->renderRow();

		// Render list options
		$cliente_log_list->renderListOptions();
?>
	<tr <?php echo $cliente_log->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cliente_log_list->ListOptions->render("body", "left", $cliente_log_list->RowCount);
?>
	<?php if ($cliente_log_list->idcliente_log->Visible) { // idcliente_log ?>
		<td data-name="idcliente_log" <?php echo $cliente_log_list->idcliente_log->cellAttributes() ?>>
<span id="el<?php echo $cliente_log_list->RowCount ?>_cliente_log_idcliente_log">
<span<?php echo $cliente_log_list->idcliente_log->viewAttributes() ?>><?php echo $cliente_log_list->idcliente_log->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente_log_list->nome->Visible) { // nome ?>
		<td data-name="nome" <?php echo $cliente_log_list->nome->cellAttributes() ?>>
<span id="el<?php echo $cliente_log_list->RowCount ?>_cliente_log_nome">
<span<?php echo $cliente_log_list->nome->viewAttributes() ?>><?php echo $cliente_log_list->nome->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente_log_list->data_hora->Visible) { // data_hora ?>
		<td data-name="data_hora" <?php echo $cliente_log_list->data_hora->cellAttributes() ?>>
<span id="el<?php echo $cliente_log_list->RowCount ?>_cliente_log_data_hora">
<span<?php echo $cliente_log_list->data_hora->viewAttributes() ?>><?php echo $cliente_log_list->data_hora->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente_log_list->acao->Visible) { // acao ?>
		<td data-name="acao" <?php echo $cliente_log_list->acao->cellAttributes() ?>>
<span id="el<?php echo $cliente_log_list->RowCount ?>_cliente_log_acao">
<span<?php echo $cliente_log_list->acao->viewAttributes() ?>><?php echo $cliente_log_list->acao->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente_log_list->foto->Visible) { // foto ?>
		<td data-name="foto" <?php echo $cliente_log_list->foto->cellAttributes() ?>>
<span id="el<?php echo $cliente_log_list->RowCount ?>_cliente_log_foto">
<span><?php echo GetFileViewTag($cliente_log_list->foto, $cliente_log_list->foto->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cliente_log_list->ListOptions->render("body", "right", $cliente_log_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$cliente_log_list->isGridAdd())
		$cliente_log_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$cliente_log->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cliente_log_list->Recordset)
	$cliente_log_list->Recordset->Close();
?>
<?php if (!$cliente_log_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cliente_log_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cliente_log_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cliente_log_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cliente_log_list->TotalRecords == 0 && !$cliente_log->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cliente_log_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cliente_log_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cliente_log_list->isExport()) { ?>
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
$cliente_log_list->terminate();
?>