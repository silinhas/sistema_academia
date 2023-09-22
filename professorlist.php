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
$professor_list = new professor_list();

// Run the page
$professor_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$professor_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$professor_list->isExport()) { ?>
<script>
var fprofessorlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fprofessorlist = currentForm = new ew.Form("fprofessorlist", "list");
	fprofessorlist.formKeyCountName = '<?php echo $professor_list->FormKeyCountName ?>';
	loadjs.done("fprofessorlist");
});
var fprofessorlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fprofessorlistsrch = currentSearchForm = new ew.Form("fprofessorlistsrch");

	// Dynamic selection lists
	// Filters

	fprofessorlistsrch.filterList = <?php echo $professor_list->getFilterList() ?>;
	loadjs.done("fprofessorlistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$professor_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($professor_list->TotalRecords > 0 && $professor_list->ExportOptions->visible()) { ?>
<?php $professor_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($professor_list->ImportOptions->visible()) { ?>
<?php $professor_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($professor_list->SearchOptions->visible()) { ?>
<?php $professor_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($professor_list->FilterOptions->visible()) { ?>
<?php $professor_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$professor_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$professor_list->isExport() && !$professor->CurrentAction) { ?>
<form name="fprofessorlistsrch" id="fprofessorlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fprofessorlistsrch-search-panel" class="<?php echo $professor_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="professor">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $professor_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($professor_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($professor_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $professor_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($professor_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($professor_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($professor_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($professor_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $professor_list->showPageHeader(); ?>
<?php
$professor_list->showMessage();
?>
<?php if ($professor_list->TotalRecords > 0 || $professor->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($professor_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> professor">
<form name="fprofessorlist" id="fprofessorlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="professor">
<div id="gmp_professor" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($professor_list->TotalRecords > 0 || $professor_list->isGridEdit()) { ?>
<table id="tbl_professorlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$professor->RowType = ROWTYPE_HEADER;

// Render list options
$professor_list->renderListOptions();

// Render list options (header, left)
$professor_list->ListOptions->render("header", "left");
?>
<?php if ($professor_list->idprofessor->Visible) { // idprofessor ?>
	<?php if ($professor_list->SortUrl($professor_list->idprofessor) == "") { ?>
		<th data-name="idprofessor" class="<?php echo $professor_list->idprofessor->headerCellClass() ?>"><div id="elh_professor_idprofessor" class="professor_idprofessor"><div class="ew-table-header-caption"><?php echo $professor_list->idprofessor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idprofessor" class="<?php echo $professor_list->idprofessor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $professor_list->SortUrl($professor_list->idprofessor) ?>', 1);"><div id="elh_professor_idprofessor" class="professor_idprofessor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $professor_list->idprofessor->caption() ?></span><span class="ew-table-header-sort"><?php if ($professor_list->idprofessor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($professor_list->idprofessor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($professor_list->nome_professor->Visible) { // nome_professor ?>
	<?php if ($professor_list->SortUrl($professor_list->nome_professor) == "") { ?>
		<th data-name="nome_professor" class="<?php echo $professor_list->nome_professor->headerCellClass() ?>"><div id="elh_professor_nome_professor" class="professor_nome_professor"><div class="ew-table-header-caption"><?php echo $professor_list->nome_professor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nome_professor" class="<?php echo $professor_list->nome_professor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $professor_list->SortUrl($professor_list->nome_professor) ?>', 1);"><div id="elh_professor_nome_professor" class="professor_nome_professor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $professor_list->nome_professor->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($professor_list->nome_professor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($professor_list->nome_professor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($professor_list->cpf->Visible) { // cpf ?>
	<?php if ($professor_list->SortUrl($professor_list->cpf) == "") { ?>
		<th data-name="cpf" class="<?php echo $professor_list->cpf->headerCellClass() ?>"><div id="elh_professor_cpf" class="professor_cpf"><div class="ew-table-header-caption"><?php echo $professor_list->cpf->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cpf" class="<?php echo $professor_list->cpf->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $professor_list->SortUrl($professor_list->cpf) ?>', 1);"><div id="elh_professor_cpf" class="professor_cpf">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $professor_list->cpf->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($professor_list->cpf->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($professor_list->cpf->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($professor_list->nascimento->Visible) { // nascimento ?>
	<?php if ($professor_list->SortUrl($professor_list->nascimento) == "") { ?>
		<th data-name="nascimento" class="<?php echo $professor_list->nascimento->headerCellClass() ?>"><div id="elh_professor_nascimento" class="professor_nascimento"><div class="ew-table-header-caption"><?php echo $professor_list->nascimento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nascimento" class="<?php echo $professor_list->nascimento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $professor_list->SortUrl($professor_list->nascimento) ?>', 1);"><div id="elh_professor_nascimento" class="professor_nascimento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $professor_list->nascimento->caption() ?></span><span class="ew-table-header-sort"><?php if ($professor_list->nascimento->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($professor_list->nascimento->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($professor_list->sexo->Visible) { // sexo ?>
	<?php if ($professor_list->SortUrl($professor_list->sexo) == "") { ?>
		<th data-name="sexo" class="<?php echo $professor_list->sexo->headerCellClass() ?>"><div id="elh_professor_sexo" class="professor_sexo"><div class="ew-table-header-caption"><?php echo $professor_list->sexo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sexo" class="<?php echo $professor_list->sexo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $professor_list->SortUrl($professor_list->sexo) ?>', 1);"><div id="elh_professor_sexo" class="professor_sexo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $professor_list->sexo->caption() ?></span><span class="ew-table-header-sort"><?php if ($professor_list->sexo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($professor_list->sexo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($professor_list->fone->Visible) { // fone ?>
	<?php if ($professor_list->SortUrl($professor_list->fone) == "") { ?>
		<th data-name="fone" class="<?php echo $professor_list->fone->headerCellClass() ?>"><div id="elh_professor_fone" class="professor_fone"><div class="ew-table-header-caption"><?php echo $professor_list->fone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fone" class="<?php echo $professor_list->fone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $professor_list->SortUrl($professor_list->fone) ?>', 1);"><div id="elh_professor_fone" class="professor_fone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $professor_list->fone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($professor_list->fone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($professor_list->fone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($professor_list->foto->Visible) { // foto ?>
	<?php if ($professor_list->SortUrl($professor_list->foto) == "") { ?>
		<th data-name="foto" class="<?php echo $professor_list->foto->headerCellClass() ?>"><div id="elh_professor_foto" class="professor_foto"><div class="ew-table-header-caption"><?php echo $professor_list->foto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="foto" class="<?php echo $professor_list->foto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $professor_list->SortUrl($professor_list->foto) ?>', 1);"><div id="elh_professor_foto" class="professor_foto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $professor_list->foto->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($professor_list->foto->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($professor_list->foto->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$professor_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($professor_list->ExportAll && $professor_list->isExport()) {
	$professor_list->StopRecord = $professor_list->TotalRecords;
} else {

	// Set the last record to display
	if ($professor_list->TotalRecords > $professor_list->StartRecord + $professor_list->DisplayRecords - 1)
		$professor_list->StopRecord = $professor_list->StartRecord + $professor_list->DisplayRecords - 1;
	else
		$professor_list->StopRecord = $professor_list->TotalRecords;
}
$professor_list->RecordCount = $professor_list->StartRecord - 1;
if ($professor_list->Recordset && !$professor_list->Recordset->EOF) {
	$professor_list->Recordset->moveFirst();
	$selectLimit = $professor_list->UseSelectLimit;
	if (!$selectLimit && $professor_list->StartRecord > 1)
		$professor_list->Recordset->move($professor_list->StartRecord - 1);
} elseif (!$professor->AllowAddDeleteRow && $professor_list->StopRecord == 0) {
	$professor_list->StopRecord = $professor->GridAddRowCount;
}

// Initialize aggregate
$professor->RowType = ROWTYPE_AGGREGATEINIT;
$professor->resetAttributes();
$professor_list->renderRow();
while ($professor_list->RecordCount < $professor_list->StopRecord) {
	$professor_list->RecordCount++;
	if ($professor_list->RecordCount >= $professor_list->StartRecord) {
		$professor_list->RowCount++;

		// Set up key count
		$professor_list->KeyCount = $professor_list->RowIndex;

		// Init row class and style
		$professor->resetAttributes();
		$professor->CssClass = "";
		if ($professor_list->isGridAdd()) {
		} else {
			$professor_list->loadRowValues($professor_list->Recordset); // Load row values
		}
		$professor->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$professor->RowAttrs->merge(["data-rowindex" => $professor_list->RowCount, "id" => "r" . $professor_list->RowCount . "_professor", "data-rowtype" => $professor->RowType]);

		// Render row
		$professor_list->renderRow();

		// Render list options
		$professor_list->renderListOptions();
?>
	<tr <?php echo $professor->rowAttributes() ?>>
<?php

// Render list options (body, left)
$professor_list->ListOptions->render("body", "left", $professor_list->RowCount);
?>
	<?php if ($professor_list->idprofessor->Visible) { // idprofessor ?>
		<td data-name="idprofessor" <?php echo $professor_list->idprofessor->cellAttributes() ?>>
<span id="el<?php echo $professor_list->RowCount ?>_professor_idprofessor">
<span<?php echo $professor_list->idprofessor->viewAttributes() ?>><?php echo $professor_list->idprofessor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($professor_list->nome_professor->Visible) { // nome_professor ?>
		<td data-name="nome_professor" <?php echo $professor_list->nome_professor->cellAttributes() ?>>
<span id="el<?php echo $professor_list->RowCount ?>_professor_nome_professor">
<span<?php echo $professor_list->nome_professor->viewAttributes() ?>><?php echo $professor_list->nome_professor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($professor_list->cpf->Visible) { // cpf ?>
		<td data-name="cpf" <?php echo $professor_list->cpf->cellAttributes() ?>>
<span id="el<?php echo $professor_list->RowCount ?>_professor_cpf">
<span<?php echo $professor_list->cpf->viewAttributes() ?>><?php echo $professor_list->cpf->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($professor_list->nascimento->Visible) { // nascimento ?>
		<td data-name="nascimento" <?php echo $professor_list->nascimento->cellAttributes() ?>>
<span id="el<?php echo $professor_list->RowCount ?>_professor_nascimento">
<span<?php echo $professor_list->nascimento->viewAttributes() ?>><?php echo $professor_list->nascimento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($professor_list->sexo->Visible) { // sexo ?>
		<td data-name="sexo" <?php echo $professor_list->sexo->cellAttributes() ?>>
<span id="el<?php echo $professor_list->RowCount ?>_professor_sexo">
<span<?php echo $professor_list->sexo->viewAttributes() ?>><?php echo $professor_list->sexo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($professor_list->fone->Visible) { // fone ?>
		<td data-name="fone" <?php echo $professor_list->fone->cellAttributes() ?>>
<span id="el<?php echo $professor_list->RowCount ?>_professor_fone">
<span<?php echo $professor_list->fone->viewAttributes() ?>><?php echo $professor_list->fone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($professor_list->foto->Visible) { // foto ?>
		<td data-name="foto" <?php echo $professor_list->foto->cellAttributes() ?>>
<span id="el<?php echo $professor_list->RowCount ?>_professor_foto">
<span><?php echo GetFileViewTag($professor_list->foto, $professor_list->foto->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$professor_list->ListOptions->render("body", "right", $professor_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$professor_list->isGridAdd())
		$professor_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$professor->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($professor_list->Recordset)
	$professor_list->Recordset->Close();
?>
<?php if (!$professor_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$professor_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $professor_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $professor_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($professor_list->TotalRecords == 0 && !$professor->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $professor_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$professor_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$professor_list->isExport()) { ?>
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
$professor_list->terminate();
?>