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
$usuario_list = new usuario_list();

// Run the page
$usuario_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuario_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$usuario_list->isExport()) { ?>
<script>
var fusuariolist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fusuariolist = currentForm = new ew.Form("fusuariolist", "list");
	fusuariolist.formKeyCountName = '<?php echo $usuario_list->FormKeyCountName ?>';
	loadjs.done("fusuariolist");
});
var fusuariolistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fusuariolistsrch = currentSearchForm = new ew.Form("fusuariolistsrch");

	// Dynamic selection lists
	// Filters

	fusuariolistsrch.filterList = <?php echo $usuario_list->getFilterList() ?>;
	loadjs.done("fusuariolistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$usuario_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($usuario_list->TotalRecords > 0 && $usuario_list->ExportOptions->visible()) { ?>
<?php $usuario_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($usuario_list->ImportOptions->visible()) { ?>
<?php $usuario_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($usuario_list->SearchOptions->visible()) { ?>
<?php $usuario_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($usuario_list->FilterOptions->visible()) { ?>
<?php $usuario_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$usuario_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$usuario_list->isExport() && !$usuario->CurrentAction) { ?>
<form name="fusuariolistsrch" id="fusuariolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fusuariolistsrch-search-panel" class="<?php echo $usuario_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="usuario">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $usuario_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($usuario_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($usuario_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $usuario_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($usuario_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($usuario_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($usuario_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($usuario_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $usuario_list->showPageHeader(); ?>
<?php
$usuario_list->showMessage();
?>
<?php if ($usuario_list->TotalRecords > 0 || $usuario->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($usuario_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> usuario">
<form name="fusuariolist" id="fusuariolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuario">
<div id="gmp_usuario" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($usuario_list->TotalRecords > 0 || $usuario_list->isGridEdit()) { ?>
<table id="tbl_usuariolist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$usuario->RowType = ROWTYPE_HEADER;

// Render list options
$usuario_list->renderListOptions();

// Render list options (header, left)
$usuario_list->ListOptions->render("header", "left");
?>
<?php if ($usuario_list->idusuario->Visible) { // idusuario ?>
	<?php if ($usuario_list->SortUrl($usuario_list->idusuario) == "") { ?>
		<th data-name="idusuario" class="<?php echo $usuario_list->idusuario->headerCellClass() ?>"><div id="elh_usuario_idusuario" class="usuario_idusuario"><div class="ew-table-header-caption"><?php echo $usuario_list->idusuario->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idusuario" class="<?php echo $usuario_list->idusuario->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $usuario_list->SortUrl($usuario_list->idusuario) ?>', 1);"><div id="elh_usuario_idusuario" class="usuario_idusuario">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuario_list->idusuario->caption() ?></span><span class="ew-table-header-sort"><?php if ($usuario_list->idusuario->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($usuario_list->idusuario->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($usuario_list->nome->Visible) { // nome ?>
	<?php if ($usuario_list->SortUrl($usuario_list->nome) == "") { ?>
		<th data-name="nome" class="<?php echo $usuario_list->nome->headerCellClass() ?>"><div id="elh_usuario_nome" class="usuario_nome"><div class="ew-table-header-caption"><?php echo $usuario_list->nome->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nome" class="<?php echo $usuario_list->nome->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $usuario_list->SortUrl($usuario_list->nome) ?>', 1);"><div id="elh_usuario_nome" class="usuario_nome">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuario_list->nome->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($usuario_list->nome->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($usuario_list->nome->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($usuario_list->_login->Visible) { // login ?>
	<?php if ($usuario_list->SortUrl($usuario_list->_login) == "") { ?>
		<th data-name="_login" class="<?php echo $usuario_list->_login->headerCellClass() ?>"><div id="elh_usuario__login" class="usuario__login"><div class="ew-table-header-caption"><?php echo $usuario_list->_login->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_login" class="<?php echo $usuario_list->_login->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $usuario_list->SortUrl($usuario_list->_login) ?>', 1);"><div id="elh_usuario__login" class="usuario__login">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuario_list->_login->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($usuario_list->_login->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($usuario_list->_login->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($usuario_list->senha->Visible) { // senha ?>
	<?php if ($usuario_list->SortUrl($usuario_list->senha) == "") { ?>
		<th data-name="senha" class="<?php echo $usuario_list->senha->headerCellClass() ?>"><div id="elh_usuario_senha" class="usuario_senha"><div class="ew-table-header-caption"><?php echo $usuario_list->senha->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="senha" class="<?php echo $usuario_list->senha->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $usuario_list->SortUrl($usuario_list->senha) ?>', 1);"><div id="elh_usuario_senha" class="usuario_senha">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuario_list->senha->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($usuario_list->senha->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($usuario_list->senha->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($usuario_list->userlevel_id->Visible) { // userlevel_id ?>
	<?php if ($usuario_list->SortUrl($usuario_list->userlevel_id) == "") { ?>
		<th data-name="userlevel_id" class="<?php echo $usuario_list->userlevel_id->headerCellClass() ?>"><div id="elh_usuario_userlevel_id" class="usuario_userlevel_id"><div class="ew-table-header-caption"><?php echo $usuario_list->userlevel_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="userlevel_id" class="<?php echo $usuario_list->userlevel_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $usuario_list->SortUrl($usuario_list->userlevel_id) ?>', 1);"><div id="elh_usuario_userlevel_id" class="usuario_userlevel_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuario_list->userlevel_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($usuario_list->userlevel_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($usuario_list->userlevel_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($usuario_list->foto->Visible) { // foto ?>
	<?php if ($usuario_list->SortUrl($usuario_list->foto) == "") { ?>
		<th data-name="foto" class="<?php echo $usuario_list->foto->headerCellClass() ?>"><div id="elh_usuario_foto" class="usuario_foto"><div class="ew-table-header-caption"><?php echo $usuario_list->foto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="foto" class="<?php echo $usuario_list->foto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $usuario_list->SortUrl($usuario_list->foto) ?>', 1);"><div id="elh_usuario_foto" class="usuario_foto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuario_list->foto->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($usuario_list->foto->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($usuario_list->foto->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$usuario_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($usuario_list->ExportAll && $usuario_list->isExport()) {
	$usuario_list->StopRecord = $usuario_list->TotalRecords;
} else {

	// Set the last record to display
	if ($usuario_list->TotalRecords > $usuario_list->StartRecord + $usuario_list->DisplayRecords - 1)
		$usuario_list->StopRecord = $usuario_list->StartRecord + $usuario_list->DisplayRecords - 1;
	else
		$usuario_list->StopRecord = $usuario_list->TotalRecords;
}
$usuario_list->RecordCount = $usuario_list->StartRecord - 1;
if ($usuario_list->Recordset && !$usuario_list->Recordset->EOF) {
	$usuario_list->Recordset->moveFirst();
	$selectLimit = $usuario_list->UseSelectLimit;
	if (!$selectLimit && $usuario_list->StartRecord > 1)
		$usuario_list->Recordset->move($usuario_list->StartRecord - 1);
} elseif (!$usuario->AllowAddDeleteRow && $usuario_list->StopRecord == 0) {
	$usuario_list->StopRecord = $usuario->GridAddRowCount;
}

// Initialize aggregate
$usuario->RowType = ROWTYPE_AGGREGATEINIT;
$usuario->resetAttributes();
$usuario_list->renderRow();
while ($usuario_list->RecordCount < $usuario_list->StopRecord) {
	$usuario_list->RecordCount++;
	if ($usuario_list->RecordCount >= $usuario_list->StartRecord) {
		$usuario_list->RowCount++;

		// Set up key count
		$usuario_list->KeyCount = $usuario_list->RowIndex;

		// Init row class and style
		$usuario->resetAttributes();
		$usuario->CssClass = "";
		if ($usuario_list->isGridAdd()) {
		} else {
			$usuario_list->loadRowValues($usuario_list->Recordset); // Load row values
		}
		$usuario->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$usuario->RowAttrs->merge(["data-rowindex" => $usuario_list->RowCount, "id" => "r" . $usuario_list->RowCount . "_usuario", "data-rowtype" => $usuario->RowType]);

		// Render row
		$usuario_list->renderRow();

		// Render list options
		$usuario_list->renderListOptions();
?>
	<tr <?php echo $usuario->rowAttributes() ?>>
<?php

// Render list options (body, left)
$usuario_list->ListOptions->render("body", "left", $usuario_list->RowCount);
?>
	<?php if ($usuario_list->idusuario->Visible) { // idusuario ?>
		<td data-name="idusuario" <?php echo $usuario_list->idusuario->cellAttributes() ?>>
<span id="el<?php echo $usuario_list->RowCount ?>_usuario_idusuario">
<span<?php echo $usuario_list->idusuario->viewAttributes() ?>><?php echo $usuario_list->idusuario->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($usuario_list->nome->Visible) { // nome ?>
		<td data-name="nome" <?php echo $usuario_list->nome->cellAttributes() ?>>
<span id="el<?php echo $usuario_list->RowCount ?>_usuario_nome">
<span<?php echo $usuario_list->nome->viewAttributes() ?>><?php echo $usuario_list->nome->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($usuario_list->_login->Visible) { // login ?>
		<td data-name="_login" <?php echo $usuario_list->_login->cellAttributes() ?>>
<span id="el<?php echo $usuario_list->RowCount ?>_usuario__login">
<span<?php echo $usuario_list->_login->viewAttributes() ?>><?php echo $usuario_list->_login->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($usuario_list->senha->Visible) { // senha ?>
		<td data-name="senha" <?php echo $usuario_list->senha->cellAttributes() ?>>
<span id="el<?php echo $usuario_list->RowCount ?>_usuario_senha">
<span<?php echo $usuario_list->senha->viewAttributes() ?>><?php echo $usuario_list->senha->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($usuario_list->userlevel_id->Visible) { // userlevel_id ?>
		<td data-name="userlevel_id" <?php echo $usuario_list->userlevel_id->cellAttributes() ?>>
<span id="el<?php echo $usuario_list->RowCount ?>_usuario_userlevel_id">
<span<?php echo $usuario_list->userlevel_id->viewAttributes() ?>><?php echo $usuario_list->userlevel_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($usuario_list->foto->Visible) { // foto ?>
		<td data-name="foto" <?php echo $usuario_list->foto->cellAttributes() ?>>
<span id="el<?php echo $usuario_list->RowCount ?>_usuario_foto">
<span><?php echo GetFileViewTag($usuario_list->foto, $usuario_list->foto->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$usuario_list->ListOptions->render("body", "right", $usuario_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$usuario_list->isGridAdd())
		$usuario_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$usuario->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($usuario_list->Recordset)
	$usuario_list->Recordset->Close();
?>
<?php if (!$usuario_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$usuario_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $usuario_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $usuario_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($usuario_list->TotalRecords == 0 && !$usuario->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $usuario_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$usuario_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$usuario_list->isExport()) { ?>
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
$usuario_list->terminate();
?>