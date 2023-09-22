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
$cliente_list = new cliente_list();

// Run the page
$cliente_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cliente_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cliente_list->isExport()) { ?>
<script>
var fclientelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fclientelist = currentForm = new ew.Form("fclientelist", "list");
	fclientelist.formKeyCountName = '<?php echo $cliente_list->FormKeyCountName ?>';
	loadjs.done("fclientelist");
});
var fclientelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fclientelistsrch = currentSearchForm = new ew.Form("fclientelistsrch");

	// Dynamic selection lists
	// Filters

	fclientelistsrch.filterList = <?php echo $cliente_list->getFilterList() ?>;
	loadjs.done("fclientelistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$cliente_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cliente_list->TotalRecords > 0 && $cliente_list->ExportOptions->visible()) { ?>
<?php $cliente_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cliente_list->ImportOptions->visible()) { ?>
<?php $cliente_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($cliente_list->SearchOptions->visible()) { ?>
<?php $cliente_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($cliente_list->FilterOptions->visible()) { ?>
<?php $cliente_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$cliente_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$cliente_list->isExport() && !$cliente->CurrentAction) { ?>
<form name="fclientelistsrch" id="fclientelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fclientelistsrch-search-panel" class="<?php echo $cliente_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cliente">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $cliente_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($cliente_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($cliente_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $cliente_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($cliente_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($cliente_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($cliente_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($cliente_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $cliente_list->showPageHeader(); ?>
<?php
$cliente_list->showMessage();
?>
<?php if ($cliente_list->TotalRecords > 0 || $cliente->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cliente_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cliente">
<form name="fclientelist" id="fclientelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cliente">
<div id="gmp_cliente" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($cliente_list->TotalRecords > 0 || $cliente_list->isGridEdit()) { ?>
<table id="tbl_clientelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cliente->RowType = ROWTYPE_HEADER;

// Render list options
$cliente_list->renderListOptions();

// Render list options (header, left)
$cliente_list->ListOptions->render("header", "left");
?>
<?php if ($cliente_list->idcliente->Visible) { // idcliente ?>
	<?php if ($cliente_list->SortUrl($cliente_list->idcliente) == "") { ?>
		<th data-name="idcliente" class="<?php echo $cliente_list->idcliente->headerCellClass() ?>"><div id="elh_cliente_idcliente" class="cliente_idcliente"><div class="ew-table-header-caption"><?php echo $cliente_list->idcliente->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="idcliente" class="<?php echo $cliente_list->idcliente->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cliente_list->SortUrl($cliente_list->idcliente) ?>', 1);"><div id="elh_cliente_idcliente" class="cliente_idcliente">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente_list->idcliente->caption() ?></span><span class="ew-table-header-sort"><?php if ($cliente_list->idcliente->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cliente_list->idcliente->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente_list->nomeCliente->Visible) { // nomeCliente ?>
	<?php if ($cliente_list->SortUrl($cliente_list->nomeCliente) == "") { ?>
		<th data-name="nomeCliente" class="<?php echo $cliente_list->nomeCliente->headerCellClass() ?>"><div id="elh_cliente_nomeCliente" class="cliente_nomeCliente"><div class="ew-table-header-caption"><?php echo $cliente_list->nomeCliente->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nomeCliente" class="<?php echo $cliente_list->nomeCliente->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cliente_list->SortUrl($cliente_list->nomeCliente) ?>', 1);"><div id="elh_cliente_nomeCliente" class="cliente_nomeCliente">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente_list->nomeCliente->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cliente_list->nomeCliente->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cliente_list->nomeCliente->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente_list->cpf->Visible) { // cpf ?>
	<?php if ($cliente_list->SortUrl($cliente_list->cpf) == "") { ?>
		<th data-name="cpf" class="<?php echo $cliente_list->cpf->headerCellClass() ?>"><div id="elh_cliente_cpf" class="cliente_cpf"><div class="ew-table-header-caption"><?php echo $cliente_list->cpf->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cpf" class="<?php echo $cliente_list->cpf->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cliente_list->SortUrl($cliente_list->cpf) ?>', 1);"><div id="elh_cliente_cpf" class="cliente_cpf">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente_list->cpf->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cliente_list->cpf->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cliente_list->cpf->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente_list->nascimento->Visible) { // nascimento ?>
	<?php if ($cliente_list->SortUrl($cliente_list->nascimento) == "") { ?>
		<th data-name="nascimento" class="<?php echo $cliente_list->nascimento->headerCellClass() ?>"><div id="elh_cliente_nascimento" class="cliente_nascimento"><div class="ew-table-header-caption"><?php echo $cliente_list->nascimento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nascimento" class="<?php echo $cliente_list->nascimento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cliente_list->SortUrl($cliente_list->nascimento) ?>', 1);"><div id="elh_cliente_nascimento" class="cliente_nascimento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente_list->nascimento->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cliente_list->nascimento->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cliente_list->nascimento->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente_list->sexo->Visible) { // sexo ?>
	<?php if ($cliente_list->SortUrl($cliente_list->sexo) == "") { ?>
		<th data-name="sexo" class="<?php echo $cliente_list->sexo->headerCellClass() ?>"><div id="elh_cliente_sexo" class="cliente_sexo"><div class="ew-table-header-caption"><?php echo $cliente_list->sexo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sexo" class="<?php echo $cliente_list->sexo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cliente_list->SortUrl($cliente_list->sexo) ?>', 1);"><div id="elh_cliente_sexo" class="cliente_sexo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente_list->sexo->caption() ?></span><span class="ew-table-header-sort"><?php if ($cliente_list->sexo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cliente_list->sexo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente_list->telefone->Visible) { // telefone ?>
	<?php if ($cliente_list->SortUrl($cliente_list->telefone) == "") { ?>
		<th data-name="telefone" class="<?php echo $cliente_list->telefone->headerCellClass() ?>"><div id="elh_cliente_telefone" class="cliente_telefone"><div class="ew-table-header-caption"><?php echo $cliente_list->telefone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telefone" class="<?php echo $cliente_list->telefone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cliente_list->SortUrl($cliente_list->telefone) ?>', 1);"><div id="elh_cliente_telefone" class="cliente_telefone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente_list->telefone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cliente_list->telefone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cliente_list->telefone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente_list->cep->Visible) { // cep ?>
	<?php if ($cliente_list->SortUrl($cliente_list->cep) == "") { ?>
		<th data-name="cep" class="<?php echo $cliente_list->cep->headerCellClass() ?>"><div id="elh_cliente_cep" class="cliente_cep"><div class="ew-table-header-caption"><?php echo $cliente_list->cep->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cep" class="<?php echo $cliente_list->cep->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cliente_list->SortUrl($cliente_list->cep) ?>', 1);"><div id="elh_cliente_cep" class="cliente_cep">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente_list->cep->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cliente_list->cep->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cliente_list->cep->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente_list->rua->Visible) { // rua ?>
	<?php if ($cliente_list->SortUrl($cliente_list->rua) == "") { ?>
		<th data-name="rua" class="<?php echo $cliente_list->rua->headerCellClass() ?>"><div id="elh_cliente_rua" class="cliente_rua"><div class="ew-table-header-caption"><?php echo $cliente_list->rua->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rua" class="<?php echo $cliente_list->rua->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cliente_list->SortUrl($cliente_list->rua) ?>', 1);"><div id="elh_cliente_rua" class="cliente_rua">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente_list->rua->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cliente_list->rua->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cliente_list->rua->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente_list->bairro->Visible) { // bairro ?>
	<?php if ($cliente_list->SortUrl($cliente_list->bairro) == "") { ?>
		<th data-name="bairro" class="<?php echo $cliente_list->bairro->headerCellClass() ?>"><div id="elh_cliente_bairro" class="cliente_bairro"><div class="ew-table-header-caption"><?php echo $cliente_list->bairro->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bairro" class="<?php echo $cliente_list->bairro->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cliente_list->SortUrl($cliente_list->bairro) ?>', 1);"><div id="elh_cliente_bairro" class="cliente_bairro">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente_list->bairro->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cliente_list->bairro->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cliente_list->bairro->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente_list->numero->Visible) { // numero ?>
	<?php if ($cliente_list->SortUrl($cliente_list->numero) == "") { ?>
		<th data-name="numero" class="<?php echo $cliente_list->numero->headerCellClass() ?>"><div id="elh_cliente_numero" class="cliente_numero"><div class="ew-table-header-caption"><?php echo $cliente_list->numero->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="numero" class="<?php echo $cliente_list->numero->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cliente_list->SortUrl($cliente_list->numero) ?>', 1);"><div id="elh_cliente_numero" class="cliente_numero">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente_list->numero->caption() ?></span><span class="ew-table-header-sort"><?php if ($cliente_list->numero->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cliente_list->numero->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente_list->complemento->Visible) { // complemento ?>
	<?php if ($cliente_list->SortUrl($cliente_list->complemento) == "") { ?>
		<th data-name="complemento" class="<?php echo $cliente_list->complemento->headerCellClass() ?>"><div id="elh_cliente_complemento" class="cliente_complemento"><div class="ew-table-header-caption"><?php echo $cliente_list->complemento->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="complemento" class="<?php echo $cliente_list->complemento->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cliente_list->SortUrl($cliente_list->complemento) ?>', 1);"><div id="elh_cliente_complemento" class="cliente_complemento">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente_list->complemento->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cliente_list->complemento->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cliente_list->complemento->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente_list->cidade->Visible) { // cidade ?>
	<?php if ($cliente_list->SortUrl($cliente_list->cidade) == "") { ?>
		<th data-name="cidade" class="<?php echo $cliente_list->cidade->headerCellClass() ?>"><div id="elh_cliente_cidade" class="cliente_cidade"><div class="ew-table-header-caption"><?php echo $cliente_list->cidade->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cidade" class="<?php echo $cliente_list->cidade->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cliente_list->SortUrl($cliente_list->cidade) ?>', 1);"><div id="elh_cliente_cidade" class="cliente_cidade">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente_list->cidade->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cliente_list->cidade->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cliente_list->cidade->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente_list->_email->Visible) { // email ?>
	<?php if ($cliente_list->SortUrl($cliente_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $cliente_list->_email->headerCellClass() ?>"><div id="elh_cliente__email" class="cliente__email"><div class="ew-table-header-caption"><?php echo $cliente_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $cliente_list->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cliente_list->SortUrl($cliente_list->_email) ?>', 1);"><div id="elh_cliente__email" class="cliente__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cliente_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cliente_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente_list->data_matricula->Visible) { // data_matricula ?>
	<?php if ($cliente_list->SortUrl($cliente_list->data_matricula) == "") { ?>
		<th data-name="data_matricula" class="<?php echo $cliente_list->data_matricula->headerCellClass() ?>"><div id="elh_cliente_data_matricula" class="cliente_data_matricula"><div class="ew-table-header-caption"><?php echo $cliente_list->data_matricula->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="data_matricula" class="<?php echo $cliente_list->data_matricula->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cliente_list->SortUrl($cliente_list->data_matricula) ?>', 1);"><div id="elh_cliente_data_matricula" class="cliente_data_matricula">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente_list->data_matricula->caption() ?></span><span class="ew-table-header-sort"><?php if ($cliente_list->data_matricula->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cliente_list->data_matricula->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cliente_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cliente_list->ExportAll && $cliente_list->isExport()) {
	$cliente_list->StopRecord = $cliente_list->TotalRecords;
} else {

	// Set the last record to display
	if ($cliente_list->TotalRecords > $cliente_list->StartRecord + $cliente_list->DisplayRecords - 1)
		$cliente_list->StopRecord = $cliente_list->StartRecord + $cliente_list->DisplayRecords - 1;
	else
		$cliente_list->StopRecord = $cliente_list->TotalRecords;
}
$cliente_list->RecordCount = $cliente_list->StartRecord - 1;
if ($cliente_list->Recordset && !$cliente_list->Recordset->EOF) {
	$cliente_list->Recordset->moveFirst();
	$selectLimit = $cliente_list->UseSelectLimit;
	if (!$selectLimit && $cliente_list->StartRecord > 1)
		$cliente_list->Recordset->move($cliente_list->StartRecord - 1);
} elseif (!$cliente->AllowAddDeleteRow && $cliente_list->StopRecord == 0) {
	$cliente_list->StopRecord = $cliente->GridAddRowCount;
}

// Initialize aggregate
$cliente->RowType = ROWTYPE_AGGREGATEINIT;
$cliente->resetAttributes();
$cliente_list->renderRow();
while ($cliente_list->RecordCount < $cliente_list->StopRecord) {
	$cliente_list->RecordCount++;
	if ($cliente_list->RecordCount >= $cliente_list->StartRecord) {
		$cliente_list->RowCount++;

		// Set up key count
		$cliente_list->KeyCount = $cliente_list->RowIndex;

		// Init row class and style
		$cliente->resetAttributes();
		$cliente->CssClass = "";
		if ($cliente_list->isGridAdd()) {
		} else {
			$cliente_list->loadRowValues($cliente_list->Recordset); // Load row values
		}
		$cliente->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cliente->RowAttrs->merge(["data-rowindex" => $cliente_list->RowCount, "id" => "r" . $cliente_list->RowCount . "_cliente", "data-rowtype" => $cliente->RowType]);

		// Render row
		$cliente_list->renderRow();

		// Render list options
		$cliente_list->renderListOptions();
?>
	<tr <?php echo $cliente->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cliente_list->ListOptions->render("body", "left", $cliente_list->RowCount);
?>
	<?php if ($cliente_list->idcliente->Visible) { // idcliente ?>
		<td data-name="idcliente" <?php echo $cliente_list->idcliente->cellAttributes() ?>>
<span id="el<?php echo $cliente_list->RowCount ?>_cliente_idcliente">
<span<?php echo $cliente_list->idcliente->viewAttributes() ?>><?php echo $cliente_list->idcliente->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente_list->nomeCliente->Visible) { // nomeCliente ?>
		<td data-name="nomeCliente" <?php echo $cliente_list->nomeCliente->cellAttributes() ?>>
<span id="el<?php echo $cliente_list->RowCount ?>_cliente_nomeCliente">
<span<?php echo $cliente_list->nomeCliente->viewAttributes() ?>><?php echo $cliente_list->nomeCliente->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente_list->cpf->Visible) { // cpf ?>
		<td data-name="cpf" <?php echo $cliente_list->cpf->cellAttributes() ?>>
<span id="el<?php echo $cliente_list->RowCount ?>_cliente_cpf">
<span<?php echo $cliente_list->cpf->viewAttributes() ?>><?php echo $cliente_list->cpf->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente_list->nascimento->Visible) { // nascimento ?>
		<td data-name="nascimento" <?php echo $cliente_list->nascimento->cellAttributes() ?>>
<span id="el<?php echo $cliente_list->RowCount ?>_cliente_nascimento">
<span<?php echo $cliente_list->nascimento->viewAttributes() ?>><?php echo $cliente_list->nascimento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente_list->sexo->Visible) { // sexo ?>
		<td data-name="sexo" <?php echo $cliente_list->sexo->cellAttributes() ?>>
<span id="el<?php echo $cliente_list->RowCount ?>_cliente_sexo">
<span<?php echo $cliente_list->sexo->viewAttributes() ?>><?php echo $cliente_list->sexo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente_list->telefone->Visible) { // telefone ?>
		<td data-name="telefone" <?php echo $cliente_list->telefone->cellAttributes() ?>>
<span id="el<?php echo $cliente_list->RowCount ?>_cliente_telefone">
<span<?php echo $cliente_list->telefone->viewAttributes() ?>><?php echo $cliente_list->telefone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente_list->cep->Visible) { // cep ?>
		<td data-name="cep" <?php echo $cliente_list->cep->cellAttributes() ?>>
<span id="el<?php echo $cliente_list->RowCount ?>_cliente_cep">
<span<?php echo $cliente_list->cep->viewAttributes() ?>><?php echo $cliente_list->cep->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente_list->rua->Visible) { // rua ?>
		<td data-name="rua" <?php echo $cliente_list->rua->cellAttributes() ?>>
<span id="el<?php echo $cliente_list->RowCount ?>_cliente_rua">
<span<?php echo $cliente_list->rua->viewAttributes() ?>><?php echo $cliente_list->rua->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente_list->bairro->Visible) { // bairro ?>
		<td data-name="bairro" <?php echo $cliente_list->bairro->cellAttributes() ?>>
<span id="el<?php echo $cliente_list->RowCount ?>_cliente_bairro">
<span<?php echo $cliente_list->bairro->viewAttributes() ?>><?php echo $cliente_list->bairro->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente_list->numero->Visible) { // numero ?>
		<td data-name="numero" <?php echo $cliente_list->numero->cellAttributes() ?>>
<span id="el<?php echo $cliente_list->RowCount ?>_cliente_numero">
<span<?php echo $cliente_list->numero->viewAttributes() ?>><?php echo $cliente_list->numero->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente_list->complemento->Visible) { // complemento ?>
		<td data-name="complemento" <?php echo $cliente_list->complemento->cellAttributes() ?>>
<span id="el<?php echo $cliente_list->RowCount ?>_cliente_complemento">
<span<?php echo $cliente_list->complemento->viewAttributes() ?>><?php echo $cliente_list->complemento->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente_list->cidade->Visible) { // cidade ?>
		<td data-name="cidade" <?php echo $cliente_list->cidade->cellAttributes() ?>>
<span id="el<?php echo $cliente_list->RowCount ?>_cliente_cidade">
<span<?php echo $cliente_list->cidade->viewAttributes() ?>><?php echo $cliente_list->cidade->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $cliente_list->_email->cellAttributes() ?>>
<span id="el<?php echo $cliente_list->RowCount ?>_cliente__email">
<span<?php echo $cliente_list->_email->viewAttributes() ?>><?php echo $cliente_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente_list->data_matricula->Visible) { // data_matricula ?>
		<td data-name="data_matricula" <?php echo $cliente_list->data_matricula->cellAttributes() ?>>
<span id="el<?php echo $cliente_list->RowCount ?>_cliente_data_matricula">
<span<?php echo $cliente_list->data_matricula->viewAttributes() ?>><?php echo $cliente_list->data_matricula->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cliente_list->ListOptions->render("body", "right", $cliente_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$cliente_list->isGridAdd())
		$cliente_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$cliente->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cliente_list->Recordset)
	$cliente_list->Recordset->Close();
?>
<?php if (!$cliente_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cliente_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cliente_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cliente_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cliente_list->TotalRecords == 0 && !$cliente->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cliente_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cliente_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cliente_list->isExport()) { ?>
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
$cliente_list->terminate();
?>