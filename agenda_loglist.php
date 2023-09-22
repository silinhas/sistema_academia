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
$agenda_log_list = new agenda_log_list();

// Run the page
$agenda_log_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$agenda_log_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$agenda_log_list->isExport()) { ?>
<script>
var fagenda_loglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fagenda_loglist = currentForm = new ew.Form("fagenda_loglist", "list");
	fagenda_loglist.formKeyCountName = '<?php echo $agenda_log_list->FormKeyCountName ?>';
	loadjs.done("fagenda_loglist");
});
var fagenda_loglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fagenda_loglistsrch = currentSearchForm = new ew.Form("fagenda_loglistsrch");

	// Dynamic selection lists
	// Filters

	fagenda_loglistsrch.filterList = <?php echo $agenda_log_list->getFilterList() ?>;
	loadjs.done("fagenda_loglistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$agenda_log_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($agenda_log_list->TotalRecords > 0 && $agenda_log_list->ExportOptions->visible()) { ?>
<?php $agenda_log_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($agenda_log_list->ImportOptions->visible()) { ?>
<?php $agenda_log_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($agenda_log_list->SearchOptions->visible()) { ?>
<?php $agenda_log_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($agenda_log_list->FilterOptions->visible()) { ?>
<?php $agenda_log_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$agenda_log_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$agenda_log_list->isExport() && !$agenda_log->CurrentAction) { ?>
<form name="fagenda_loglistsrch" id="fagenda_loglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fagenda_loglistsrch-search-panel" class="<?php echo $agenda_log_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="agenda_log">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $agenda_log_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($agenda_log_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($agenda_log_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $agenda_log_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($agenda_log_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($agenda_log_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($agenda_log_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($agenda_log_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $agenda_log_list->showPageHeader(); ?>
<?php
$agenda_log_list->showMessage();
?>
<?php if ($agenda_log_list->TotalRecords > 0 || $agenda_log->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($agenda_log_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> agenda_log">
<form name="fagenda_loglist" id="fagenda_loglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="agenda_log">
<div id="gmp_agenda_log" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($agenda_log_list->TotalRecords > 0 || $agenda_log_list->isGridEdit()) { ?>
<table id="tbl_agenda_loglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$agenda_log->RowType = ROWTYPE_HEADER;

// Render list options
$agenda_log_list->renderListOptions();

// Render list options (header, left)
$agenda_log_list->ListOptions->render("header", "left");
?>
<?php if ($agenda_log_list->idagenda_log->Visible) { // idagenda_log ?>
	<?php if ($agenda_log_list->SortUrl($agenda_log_list->idagenda_log) == "") { ?>
		<th data-name="idagenda_log" class="<?php echo $agenda_log_list->idagenda_log->headerCellClass() ?>"><div id="elh_agenda_log_idagenda_log" class="agenda_log_idagenda_log"><div class="ew-table-header-caption"><?php echo $agenda_log_list->idagenda_log->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idagenda_log" class="<?php echo $agenda_log_list->idagenda_log->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agenda_log_list->SortUrl($agenda_log_list->idagenda_log) ?>', 1);"><div id="elh_agenda_log_idagenda_log" class="agenda_log_idagenda_log">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agenda_log_list->idagenda_log->caption() ?></span><span class="ew-table-header-sort"><?php if ($agenda_log_list->idagenda_log->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agenda_log_list->idagenda_log->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($agenda_log_list->data->Visible) { // data ?>
	<?php if ($agenda_log_list->SortUrl($agenda_log_list->data) == "") { ?>
		<th data-name="data" class="<?php echo $agenda_log_list->data->headerCellClass() ?>"><div id="elh_agenda_log_data" class="agenda_log_data"><div class="ew-table-header-caption"><?php echo $agenda_log_list->data->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="data" class="<?php echo $agenda_log_list->data->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agenda_log_list->SortUrl($agenda_log_list->data) ?>', 1);"><div id="elh_agenda_log_data" class="agenda_log_data">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agenda_log_list->data->caption() ?></span><span class="ew-table-header-sort"><?php if ($agenda_log_list->data->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agenda_log_list->data->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($agenda_log_list->hora->Visible) { // hora ?>
	<?php if ($agenda_log_list->SortUrl($agenda_log_list->hora) == "") { ?>
		<th data-name="hora" class="<?php echo $agenda_log_list->hora->headerCellClass() ?>"><div id="elh_agenda_log_hora" class="agenda_log_hora"><div class="ew-table-header-caption"><?php echo $agenda_log_list->hora->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hora" class="<?php echo $agenda_log_list->hora->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agenda_log_list->SortUrl($agenda_log_list->hora) ?>', 1);"><div id="elh_agenda_log_hora" class="agenda_log_hora">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agenda_log_list->hora->caption() ?></span><span class="ew-table-header-sort"><?php if ($agenda_log_list->hora->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agenda_log_list->hora->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($agenda_log_list->data_now->Visible) { // data_now ?>
	<?php if ($agenda_log_list->SortUrl($agenda_log_list->data_now) == "") { ?>
		<th data-name="data_now" class="<?php echo $agenda_log_list->data_now->headerCellClass() ?>"><div id="elh_agenda_log_data_now" class="agenda_log_data_now"><div class="ew-table-header-caption"><?php echo $agenda_log_list->data_now->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="data_now" class="<?php echo $agenda_log_list->data_now->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agenda_log_list->SortUrl($agenda_log_list->data_now) ?>', 1);"><div id="elh_agenda_log_data_now" class="agenda_log_data_now">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agenda_log_list->data_now->caption() ?></span><span class="ew-table-header-sort"><?php if ($agenda_log_list->data_now->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agenda_log_list->data_now->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($agenda_log_list->professor->Visible) { // professor ?>
	<?php if ($agenda_log_list->SortUrl($agenda_log_list->professor) == "") { ?>
		<th data-name="professor" class="<?php echo $agenda_log_list->professor->headerCellClass() ?>"><div id="elh_agenda_log_professor" class="agenda_log_professor"><div class="ew-table-header-caption"><?php echo $agenda_log_list->professor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="professor" class="<?php echo $agenda_log_list->professor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agenda_log_list->SortUrl($agenda_log_list->professor) ?>', 1);"><div id="elh_agenda_log_professor" class="agenda_log_professor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agenda_log_list->professor->caption() ?></span><span class="ew-table-header-sort"><?php if ($agenda_log_list->professor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agenda_log_list->professor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($agenda_log_list->cliente->Visible) { // cliente ?>
	<?php if ($agenda_log_list->SortUrl($agenda_log_list->cliente) == "") { ?>
		<th data-name="cliente" class="<?php echo $agenda_log_list->cliente->headerCellClass() ?>"><div id="elh_agenda_log_cliente" class="agenda_log_cliente"><div class="ew-table-header-caption"><?php echo $agenda_log_list->cliente->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cliente" class="<?php echo $agenda_log_list->cliente->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agenda_log_list->SortUrl($agenda_log_list->cliente) ?>', 1);"><div id="elh_agenda_log_cliente" class="agenda_log_cliente">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agenda_log_list->cliente->caption() ?></span><span class="ew-table-header-sort"><?php if ($agenda_log_list->cliente->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agenda_log_list->cliente->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($agenda_log_list->acao->Visible) { // acao ?>
	<?php if ($agenda_log_list->SortUrl($agenda_log_list->acao) == "") { ?>
		<th data-name="acao" class="<?php echo $agenda_log_list->acao->headerCellClass() ?>"><div id="elh_agenda_log_acao" class="agenda_log_acao"><div class="ew-table-header-caption"><?php echo $agenda_log_list->acao->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="acao" class="<?php echo $agenda_log_list->acao->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agenda_log_list->SortUrl($agenda_log_list->acao) ?>', 1);"><div id="elh_agenda_log_acao" class="agenda_log_acao">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agenda_log_list->acao->caption() ?></span><span class="ew-table-header-sort"><?php if ($agenda_log_list->acao->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agenda_log_list->acao->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($agenda_log_list->data_hora->Visible) { // data_hora ?>
	<?php if ($agenda_log_list->SortUrl($agenda_log_list->data_hora) == "") { ?>
		<th data-name="data_hora" class="<?php echo $agenda_log_list->data_hora->headerCellClass() ?>"><div id="elh_agenda_log_data_hora" class="agenda_log_data_hora"><div class="ew-table-header-caption"><?php echo $agenda_log_list->data_hora->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="data_hora" class="<?php echo $agenda_log_list->data_hora->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agenda_log_list->SortUrl($agenda_log_list->data_hora) ?>', 1);"><div id="elh_agenda_log_data_hora" class="agenda_log_data_hora">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agenda_log_list->data_hora->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($agenda_log_list->data_hora->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agenda_log_list->data_hora->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$agenda_log_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($agenda_log_list->ExportAll && $agenda_log_list->isExport()) {
	$agenda_log_list->StopRecord = $agenda_log_list->TotalRecords;
} else {

	// Set the last record to display
	if ($agenda_log_list->TotalRecords > $agenda_log_list->StartRecord + $agenda_log_list->DisplayRecords - 1)
		$agenda_log_list->StopRecord = $agenda_log_list->StartRecord + $agenda_log_list->DisplayRecords - 1;
	else
		$agenda_log_list->StopRecord = $agenda_log_list->TotalRecords;
}
$agenda_log_list->RecordCount = $agenda_log_list->StartRecord - 1;
if ($agenda_log_list->Recordset && !$agenda_log_list->Recordset->EOF) {
	$agenda_log_list->Recordset->moveFirst();
	$selectLimit = $agenda_log_list->UseSelectLimit;
	if (!$selectLimit && $agenda_log_list->StartRecord > 1)
		$agenda_log_list->Recordset->move($agenda_log_list->StartRecord - 1);
} elseif (!$agenda_log->AllowAddDeleteRow && $agenda_log_list->StopRecord == 0) {
	$agenda_log_list->StopRecord = $agenda_log->GridAddRowCount;
}

// Initialize aggregate
$agenda_log->RowType = ROWTYPE_AGGREGATEINIT;
$agenda_log->resetAttributes();
$agenda_log_list->renderRow();
while ($agenda_log_list->RecordCount < $agenda_log_list->StopRecord) {
	$agenda_log_list->RecordCount++;
	if ($agenda_log_list->RecordCount >= $agenda_log_list->StartRecord) {
		$agenda_log_list->RowCount++;

		// Set up key count
		$agenda_log_list->KeyCount = $agenda_log_list->RowIndex;

		// Init row class and style
		$agenda_log->resetAttributes();
		$agenda_log->CssClass = "";
		if ($agenda_log_list->isGridAdd()) {
		} else {
			$agenda_log_list->loadRowValues($agenda_log_list->Recordset); // Load row values
		}
		$agenda_log->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$agenda_log->RowAttrs->merge(["data-rowindex" => $agenda_log_list->RowCount, "id" => "r" . $agenda_log_list->RowCount . "_agenda_log", "data-rowtype" => $agenda_log->RowType]);

		// Render row
		$agenda_log_list->renderRow();

		// Render list options
		$agenda_log_list->renderListOptions();
?>
	<tr <?php echo $agenda_log->rowAttributes() ?>>
<?php

// Render list options (body, left)
$agenda_log_list->ListOptions->render("body", "left", $agenda_log_list->RowCount);
?>
	<?php if ($agenda_log_list->idagenda_log->Visible) { // idagenda_log ?>
		<td data-name="idagenda_log" <?php echo $agenda_log_list->idagenda_log->cellAttributes() ?>>
<span id="el<?php echo $agenda_log_list->RowCount ?>_agenda_log_idagenda_log">
<span<?php echo $agenda_log_list->idagenda_log->viewAttributes() ?>><?php echo $agenda_log_list->idagenda_log->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($agenda_log_list->data->Visible) { // data ?>
		<td data-name="data" <?php echo $agenda_log_list->data->cellAttributes() ?>>
<span id="el<?php echo $agenda_log_list->RowCount ?>_agenda_log_data">
<span<?php echo $agenda_log_list->data->viewAttributes() ?>><?php echo $agenda_log_list->data->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($agenda_log_list->hora->Visible) { // hora ?>
		<td data-name="hora" <?php echo $agenda_log_list->hora->cellAttributes() ?>>
<span id="el<?php echo $agenda_log_list->RowCount ?>_agenda_log_hora">
<span<?php echo $agenda_log_list->hora->viewAttributes() ?>><?php echo $agenda_log_list->hora->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($agenda_log_list->data_now->Visible) { // data_now ?>
		<td data-name="data_now" <?php echo $agenda_log_list->data_now->cellAttributes() ?>>
<span id="el<?php echo $agenda_log_list->RowCount ?>_agenda_log_data_now">
<span<?php echo $agenda_log_list->data_now->viewAttributes() ?>><?php echo $agenda_log_list->data_now->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($agenda_log_list->professor->Visible) { // professor ?>
		<td data-name="professor" <?php echo $agenda_log_list->professor->cellAttributes() ?>>
<span id="el<?php echo $agenda_log_list->RowCount ?>_agenda_log_professor">
<span<?php echo $agenda_log_list->professor->viewAttributes() ?>><?php echo $agenda_log_list->professor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($agenda_log_list->cliente->Visible) { // cliente ?>
		<td data-name="cliente" <?php echo $agenda_log_list->cliente->cellAttributes() ?>>
<span id="el<?php echo $agenda_log_list->RowCount ?>_agenda_log_cliente">
<span<?php echo $agenda_log_list->cliente->viewAttributes() ?>><?php echo $agenda_log_list->cliente->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($agenda_log_list->acao->Visible) { // acao ?>
		<td data-name="acao" <?php echo $agenda_log_list->acao->cellAttributes() ?>>
<span id="el<?php echo $agenda_log_list->RowCount ?>_agenda_log_acao">
<span<?php echo $agenda_log_list->acao->viewAttributes() ?>><?php echo $agenda_log_list->acao->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($agenda_log_list->data_hora->Visible) { // data_hora ?>
		<td data-name="data_hora" <?php echo $agenda_log_list->data_hora->cellAttributes() ?>>
<span id="el<?php echo $agenda_log_list->RowCount ?>_agenda_log_data_hora">
<span<?php echo $agenda_log_list->data_hora->viewAttributes() ?>><?php echo $agenda_log_list->data_hora->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$agenda_log_list->ListOptions->render("body", "right", $agenda_log_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$agenda_log_list->isGridAdd())
		$agenda_log_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$agenda_log->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($agenda_log_list->Recordset)
	$agenda_log_list->Recordset->Close();
?>
<?php if (!$agenda_log_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$agenda_log_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $agenda_log_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $agenda_log_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($agenda_log_list->TotalRecords == 0 && !$agenda_log->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $agenda_log_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$agenda_log_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$agenda_log_list->isExport()) { ?>
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
$agenda_log_list->terminate();
?>