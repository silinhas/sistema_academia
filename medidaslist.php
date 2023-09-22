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
$medidas_list = new medidas_list();

// Run the page
$medidas_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$medidas_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$medidas_list->isExport()) { ?>
<script>
var fmedidaslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmedidaslist = currentForm = new ew.Form("fmedidaslist", "list");
	fmedidaslist.formKeyCountName = '<?php echo $medidas_list->FormKeyCountName ?>';
	loadjs.done("fmedidaslist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$medidas_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($medidas_list->TotalRecords > 0 && $medidas_list->ExportOptions->visible()) { ?>
<?php $medidas_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($medidas_list->ImportOptions->visible()) { ?>
<?php $medidas_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$medidas_list->renderOtherOptions();
?>
<?php $medidas_list->showPageHeader(); ?>
<?php
$medidas_list->showMessage();
?>
<?php if ($medidas_list->TotalRecords > 0 || $medidas->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($medidas_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> medidas">
<form name="fmedidaslist" id="fmedidaslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="medidas">
<div id="gmp_medidas" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($medidas_list->TotalRecords > 0 || $medidas_list->isGridEdit()) { ?>
<table id="tbl_medidaslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$medidas->RowType = ROWTYPE_HEADER;

// Render list options
$medidas_list->renderListOptions();

// Render list options (header, left)
$medidas_list->ListOptions->render("header", "left");
?>
<?php if ($medidas_list->idmedidas->Visible) { // idmedidas ?>
	<?php if ($medidas_list->SortUrl($medidas_list->idmedidas) == "") { ?>
		<th data-name="idmedidas" class="<?php echo $medidas_list->idmedidas->headerCellClass() ?>"><div id="elh_medidas_idmedidas" class="medidas_idmedidas"><div class="ew-table-header-caption"><?php echo $medidas_list->idmedidas->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idmedidas" class="<?php echo $medidas_list->idmedidas->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $medidas_list->SortUrl($medidas_list->idmedidas) ?>', 1);"><div id="elh_medidas_idmedidas" class="medidas_idmedidas">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $medidas_list->idmedidas->caption() ?></span><span class="ew-table-header-sort"><?php if ($medidas_list->idmedidas->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($medidas_list->idmedidas->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($medidas_list->altura->Visible) { // altura ?>
	<?php if ($medidas_list->SortUrl($medidas_list->altura) == "") { ?>
		<th data-name="altura" class="<?php echo $medidas_list->altura->headerCellClass() ?>"><div id="elh_medidas_altura" class="medidas_altura"><div class="ew-table-header-caption"><?php echo $medidas_list->altura->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="altura" class="<?php echo $medidas_list->altura->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $medidas_list->SortUrl($medidas_list->altura) ?>', 1);"><div id="elh_medidas_altura" class="medidas_altura">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $medidas_list->altura->caption() ?></span><span class="ew-table-header-sort"><?php if ($medidas_list->altura->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($medidas_list->altura->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($medidas_list->peso->Visible) { // peso ?>
	<?php if ($medidas_list->SortUrl($medidas_list->peso) == "") { ?>
		<th data-name="peso" class="<?php echo $medidas_list->peso->headerCellClass() ?>"><div id="elh_medidas_peso" class="medidas_peso"><div class="ew-table-header-caption"><?php echo $medidas_list->peso->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="peso" class="<?php echo $medidas_list->peso->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $medidas_list->SortUrl($medidas_list->peso) ?>', 1);"><div id="elh_medidas_peso" class="medidas_peso">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $medidas_list->peso->caption() ?></span><span class="ew-table-header-sort"><?php if ($medidas_list->peso->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($medidas_list->peso->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($medidas_list->data_cadastro->Visible) { // data_cadastro ?>
	<?php if ($medidas_list->SortUrl($medidas_list->data_cadastro) == "") { ?>
		<th data-name="data_cadastro" class="<?php echo $medidas_list->data_cadastro->headerCellClass() ?>"><div id="elh_medidas_data_cadastro" class="medidas_data_cadastro"><div class="ew-table-header-caption"><?php echo $medidas_list->data_cadastro->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="data_cadastro" class="<?php echo $medidas_list->data_cadastro->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $medidas_list->SortUrl($medidas_list->data_cadastro) ?>', 1);"><div id="elh_medidas_data_cadastro" class="medidas_data_cadastro">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $medidas_list->data_cadastro->caption() ?></span><span class="ew-table-header-sort"><?php if ($medidas_list->data_cadastro->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($medidas_list->data_cadastro->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($medidas_list->cliente_idcliente->Visible) { // cliente_idcliente ?>
	<?php if ($medidas_list->SortUrl($medidas_list->cliente_idcliente) == "") { ?>
		<th data-name="cliente_idcliente" class="<?php echo $medidas_list->cliente_idcliente->headerCellClass() ?>"><div id="elh_medidas_cliente_idcliente" class="medidas_cliente_idcliente"><div class="ew-table-header-caption"><?php echo $medidas_list->cliente_idcliente->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cliente_idcliente" class="<?php echo $medidas_list->cliente_idcliente->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $medidas_list->SortUrl($medidas_list->cliente_idcliente) ?>', 1);"><div id="elh_medidas_cliente_idcliente" class="medidas_cliente_idcliente">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $medidas_list->cliente_idcliente->caption() ?></span><span class="ew-table-header-sort"><?php if ($medidas_list->cliente_idcliente->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($medidas_list->cliente_idcliente->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$medidas_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($medidas_list->ExportAll && $medidas_list->isExport()) {
	$medidas_list->StopRecord = $medidas_list->TotalRecords;
} else {

	// Set the last record to display
	if ($medidas_list->TotalRecords > $medidas_list->StartRecord + $medidas_list->DisplayRecords - 1)
		$medidas_list->StopRecord = $medidas_list->StartRecord + $medidas_list->DisplayRecords - 1;
	else
		$medidas_list->StopRecord = $medidas_list->TotalRecords;
}
$medidas_list->RecordCount = $medidas_list->StartRecord - 1;
if ($medidas_list->Recordset && !$medidas_list->Recordset->EOF) {
	$medidas_list->Recordset->moveFirst();
	$selectLimit = $medidas_list->UseSelectLimit;
	if (!$selectLimit && $medidas_list->StartRecord > 1)
		$medidas_list->Recordset->move($medidas_list->StartRecord - 1);
} elseif (!$medidas->AllowAddDeleteRow && $medidas_list->StopRecord == 0) {
	$medidas_list->StopRecord = $medidas->GridAddRowCount;
}

// Initialize aggregate
$medidas->RowType = ROWTYPE_AGGREGATEINIT;
$medidas->resetAttributes();
$medidas_list->renderRow();
while ($medidas_list->RecordCount < $medidas_list->StopRecord) {
	$medidas_list->RecordCount++;
	if ($medidas_list->RecordCount >= $medidas_list->StartRecord) {
		$medidas_list->RowCount++;

		// Set up key count
		$medidas_list->KeyCount = $medidas_list->RowIndex;

		// Init row class and style
		$medidas->resetAttributes();
		$medidas->CssClass = "";
		if ($medidas_list->isGridAdd()) {
		} else {
			$medidas_list->loadRowValues($medidas_list->Recordset); // Load row values
		}
		$medidas->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$medidas->RowAttrs->merge(["data-rowindex" => $medidas_list->RowCount, "id" => "r" . $medidas_list->RowCount . "_medidas", "data-rowtype" => $medidas->RowType]);

		// Render row
		$medidas_list->renderRow();

		// Render list options
		$medidas_list->renderListOptions();
?>
	<tr <?php echo $medidas->rowAttributes() ?>>
<?php

// Render list options (body, left)
$medidas_list->ListOptions->render("body", "left", $medidas_list->RowCount);
?>
	<?php if ($medidas_list->idmedidas->Visible) { // idmedidas ?>
		<td data-name="idmedidas" <?php echo $medidas_list->idmedidas->cellAttributes() ?>>
<span id="el<?php echo $medidas_list->RowCount ?>_medidas_idmedidas">
<span<?php echo $medidas_list->idmedidas->viewAttributes() ?>><?php echo $medidas_list->idmedidas->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($medidas_list->altura->Visible) { // altura ?>
		<td data-name="altura" <?php echo $medidas_list->altura->cellAttributes() ?>>
<span id="el<?php echo $medidas_list->RowCount ?>_medidas_altura">
<span<?php echo $medidas_list->altura->viewAttributes() ?>><?php echo $medidas_list->altura->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($medidas_list->peso->Visible) { // peso ?>
		<td data-name="peso" <?php echo $medidas_list->peso->cellAttributes() ?>>
<span id="el<?php echo $medidas_list->RowCount ?>_medidas_peso">
<span<?php echo $medidas_list->peso->viewAttributes() ?>><?php echo $medidas_list->peso->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($medidas_list->data_cadastro->Visible) { // data_cadastro ?>
		<td data-name="data_cadastro" <?php echo $medidas_list->data_cadastro->cellAttributes() ?>>
<span id="el<?php echo $medidas_list->RowCount ?>_medidas_data_cadastro">
<span<?php echo $medidas_list->data_cadastro->viewAttributes() ?>><?php echo $medidas_list->data_cadastro->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($medidas_list->cliente_idcliente->Visible) { // cliente_idcliente ?>
		<td data-name="cliente_idcliente" <?php echo $medidas_list->cliente_idcliente->cellAttributes() ?>>
<span id="el<?php echo $medidas_list->RowCount ?>_medidas_cliente_idcliente">
<span<?php echo $medidas_list->cliente_idcliente->viewAttributes() ?>><?php echo $medidas_list->cliente_idcliente->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$medidas_list->ListOptions->render("body", "right", $medidas_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$medidas_list->isGridAdd())
		$medidas_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$medidas->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($medidas_list->Recordset)
	$medidas_list->Recordset->Close();
?>
<?php if (!$medidas_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$medidas_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $medidas_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $medidas_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($medidas_list->TotalRecords == 0 && !$medidas->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $medidas_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$medidas_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$medidas_list->isExport()) { ?>
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
$medidas_list->terminate();
?>