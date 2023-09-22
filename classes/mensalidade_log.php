<?php namespace PHPMaker2020\sistema_academia; ?>
<?php

/**
 * Table class for mensalidade_log
 */
class mensalidade_log extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

	// Column CSS classes
	public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
	public $RightColumnClass = "col-sm-10";
	public $OffsetColumnClass = "col-sm-10 offset-sm-2";
	public $TableLeftColumnClass = "w-col-2";

	// Export
	public $ExportDoc;

	// Fields
	public $idmensalidade_log;
	public $cliente;
	public $mes;
	public $valor;
	public $status;
	public $data_pagamento;
	public $acao;
	public $data_hora;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'mensalidade_log';
		$this->TableName = 'mensalidade_log';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`mensalidade_log`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// idmensalidade_log
		$this->idmensalidade_log = new DbField('mensalidade_log', 'mensalidade_log', 'x_idmensalidade_log', 'idmensalidade_log', '`idmensalidade_log`', '`idmensalidade_log`', 3, 11, -1, FALSE, '`idmensalidade_log`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->idmensalidade_log->IsAutoIncrement = TRUE; // Autoincrement field
		$this->idmensalidade_log->IsPrimaryKey = TRUE; // Primary key field
		$this->idmensalidade_log->Sortable = TRUE; // Allow sort
		$this->idmensalidade_log->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['idmensalidade_log'] = &$this->idmensalidade_log;

		// cliente
		$this->cliente = new DbField('mensalidade_log', 'mensalidade_log', 'x_cliente', 'cliente', '`cliente`', '`cliente`', 200, 100, -1, FALSE, '`cliente`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->cliente->Sortable = TRUE; // Allow sort
		$this->cliente->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->cliente->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "pt-BR":
				$this->cliente->Lookup = new Lookup('cliente', 'cliente', FALSE, 'idcliente', ["nomeCliente","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->cliente->Lookup = new Lookup('cliente', 'cliente', FALSE, 'idcliente', ["nomeCliente","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->fields['cliente'] = &$this->cliente;

		// mes
		$this->mes = new DbField('mensalidade_log', 'mensalidade_log', 'x_mes', 'mes', '`mes`', '`mes`', 200, 45, -1, FALSE, '`mes`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->mes->Sortable = TRUE; // Allow sort
		$this->fields['mes'] = &$this->mes;

		// valor
		$this->valor = new DbField('mensalidade_log', 'mensalidade_log', 'x_valor', 'valor', '`valor`', '`valor`', 200, 100, -1, FALSE, '`valor`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->valor->Sortable = TRUE; // Allow sort
		switch ($CurrentLanguage) {
			case "pt-BR":
				$this->valor->Lookup = new Lookup('valor', 'mensalidade_log', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->valor->Lookup = new Lookup('valor', 'mensalidade_log', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->valor->OptionCount = 2;
		$this->fields['valor'] = &$this->valor;

		// status
		$this->status = new DbField('mensalidade_log', 'mensalidade_log', 'x_status', 'status', '`status`', '`status`', 200, 100, -1, FALSE, '`status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->status->Nullable = FALSE; // NOT NULL field
		$this->status->Required = TRUE; // Required field
		$this->status->Sortable = TRUE; // Allow sort
		$this->status->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->status->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "pt-BR":
				$this->status->Lookup = new Lookup('status', 'mensalidade_log', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->status->Lookup = new Lookup('status', 'mensalidade_log', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->status->OptionCount = 2;
		$this->fields['status'] = &$this->status;

		// data_pagamento
		$this->data_pagamento = new DbField('mensalidade_log', 'mensalidade_log', 'x_data_pagamento', 'data_pagamento', '`data_pagamento`', CastDateFieldForLike("`data_pagamento`", 7, "DB"), 133, 10, 7, FALSE, '`data_pagamento`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->data_pagamento->Sortable = TRUE; // Allow sort
		$this->data_pagamento->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
		$this->fields['data_pagamento'] = &$this->data_pagamento;

		// acao
		$this->acao = new DbField('mensalidade_log', 'mensalidade_log', 'x_acao', 'acao', '`acao`', '`acao`', 200, 100, -1, FALSE, '`acao`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->acao->Nullable = FALSE; // NOT NULL field
		$this->acao->Required = TRUE; // Required field
		$this->acao->Sortable = TRUE; // Allow sort
		$this->acao->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->acao->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "pt-BR":
				$this->acao->Lookup = new Lookup('acao', 'mensalidade_log', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->acao->Lookup = new Lookup('acao', 'mensalidade_log', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->acao->OptionCount = 2;
		$this->fields['acao'] = &$this->acao;

		// data_hora
		$this->data_hora = new DbField('mensalidade_log', 'mensalidade_log', 'x_data_hora', 'data_hora', '`data_hora`', CastDateFieldForLike("`data_hora`", 1, "DB"), 133, 10, 1, FALSE, '`data_hora`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->data_hora->Nullable = FALSE; // NOT NULL field
		$this->data_hora->Required = TRUE; // Required field
		$this->data_hora->Sortable = TRUE; // Allow sort
		$this->data_hora->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['data_hora'] = &$this->data_hora;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
	{
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " col-form-label ew-label";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
			$this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
		}
	}

	// Single column sort
	public function updateSort(&$fld)
	{
		if ($this->CurrentOrder == $fld->Name) {
			$sortField = $fld->Expression;
			$lastSort = $fld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`mensalidade_log`";
	}
	public function sqlFrom() // For backward compatibility
	{
		return $this->getSqlFrom();
	}
	public function setSqlFrom($v)
	{
		$this->SqlFrom = $v;
	}
	public function getSqlSelect() // Select
	{
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}
	public function sqlSelect() // For backward compatibility
	{
		return $this->getSqlSelect();
	}
	public function setSqlSelect($v)
	{
		$this->SqlSelect = $v;
	}
	public function getSqlWhere() // Where
	{
		$where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
		return $where;
	}
	public function sqlWhere() // For backward compatibility
	{
		return $this->getSqlWhere();
	}
	public function setSqlWhere($v)
	{
		$this->SqlWhere = $v;
	}
	public function getSqlGroupBy() // Group By
	{
		return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
	}
	public function sqlGroupBy() // For backward compatibility
	{
		return $this->getSqlGroupBy();
	}
	public function setSqlGroupBy($v)
	{
		$this->SqlGroupBy = $v;
	}
	public function getSqlHaving() // Having
	{
		return ($this->SqlHaving != "") ? $this->SqlHaving : "";
	}
	public function sqlHaving() // For backward compatibility
	{
		return $this->getSqlHaving();
	}
	public function setSqlHaving($v)
	{
		$this->SqlHaving = $v;
	}
	public function getSqlOrderBy() // Order By
	{
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
	}
	public function sqlOrderBy() // For backward compatibility
	{
		return $this->getSqlOrderBy();
	}
	public function setSqlOrderBy($v)
	{
		$this->SqlOrderBy = $v;
	}

	// Apply User ID filters
	public function applyUserIDFilters($filter, $id = "")
	{
		return $filter;
	}

	// Check if User ID security allows view all
	public function userIDAllow($id = "")
	{
		$allow = $this->UserIDAllowSecurity;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			case "lookup":
				return (($allow & 256) == 256);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->getRecordCount($sql);
		$this->CurrentFilter = $origFilter;
		return $cnt;
	}

	// Get record count (for current List page)
	public function listRecordCount()
	{
		$filter = $this->getSessionWhere();
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " (" . $names . ") VALUES (" . $values . ")";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->idmensalidade_log->setDbValue($conn->insert_ID());
			$rs['idmensalidade_log'] = $this->idmensalidade_log->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('idmensalidade_log', $rs))
				AddFilter($where, QuotedName('idmensalidade_log', $this->Dbid) . '=' . QuotedValue($rs['idmensalidade_log'], $this->idmensalidade_log->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->idmensalidade_log->DbValue = $row['idmensalidade_log'];
		$this->cliente->DbValue = $row['cliente'];
		$this->mes->DbValue = $row['mes'];
		$this->valor->DbValue = $row['valor'];
		$this->status->DbValue = $row['status'];
		$this->data_pagamento->DbValue = $row['data_pagamento'];
		$this->acao->DbValue = $row['acao'];
		$this->data_hora->DbValue = $row['data_hora'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`idmensalidade_log` = @idmensalidade_log@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('idmensalidade_log', $row) ? $row['idmensalidade_log'] : NULL;
		else
			$val = $this->idmensalidade_log->OldValue !== NULL ? $this->idmensalidade_log->OldValue : $this->idmensalidade_log->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@idmensalidade_log@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "mensalidade_loglist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "mensalidade_logview.php")
			return $Language->phrase("View");
		elseif ($pageName == "mensalidade_logedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "mensalidade_logadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "mensalidade_loglist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("mensalidade_logview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("mensalidade_logview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "mensalidade_logadd.php?" . $this->getUrlParm($parm);
		else
			$url = "mensalidade_logadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("mensalidade_logedit.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline edit URL
	public function getInlineEditUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
		return $this->addMasterUrl($url);
	}

	// Copy URL
	public function getCopyUrl($parm = "")
	{
		$url = $this->keyUrl("mensalidade_logadd.php", $this->getUrlParm($parm));
		return $this->addMasterUrl($url);
	}

	// Inline copy URL
	public function getInlineCopyUrl()
	{
		$url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
		return $this->addMasterUrl($url);
	}

	// Delete URL
	public function getDeleteUrl()
	{
		return $this->keyUrl("mensalidade_logdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "idmensalidade_log:" . JsonEncode($this->idmensalidade_log->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->idmensalidade_log->CurrentValue != NULL) {
			$url .= "idmensalidade_log=" . urlencode($this->idmensalidade_log->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
			return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
		} else {
			return "";
		}
	}

	// Get record keys from Post/Get/Session
	public function getRecordKeys()
	{
		$arKeys = [];
		$arKey = [];
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("idmensalidade_log") !== NULL)
				$arKeys[] = Param("idmensalidade_log");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->idmensalidade_log->CurrentValue = $key;
			else
				$this->idmensalidade_log->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->idmensalidade_log->setDbValue($rs->fields('idmensalidade_log'));
		$this->cliente->setDbValue($rs->fields('cliente'));
		$this->mes->setDbValue($rs->fields('mes'));
		$this->valor->setDbValue($rs->fields('valor'));
		$this->status->setDbValue($rs->fields('status'));
		$this->data_pagamento->setDbValue($rs->fields('data_pagamento'));
		$this->acao->setDbValue($rs->fields('acao'));
		$this->data_hora->setDbValue($rs->fields('data_hora'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// idmensalidade_log
		// cliente
		// mes
		// valor
		// status
		// data_pagamento
		// acao
		// data_hora
		// idmensalidade_log

		$this->idmensalidade_log->ViewValue = $this->idmensalidade_log->CurrentValue;
		$this->idmensalidade_log->ViewCustomAttributes = "";

		// cliente
		$curVal = strval($this->cliente->CurrentValue);
		if ($curVal != "") {
			$this->cliente->ViewValue = $this->cliente->lookupCacheOption($curVal);
			if ($this->cliente->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`idcliente`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->cliente->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->cliente->ViewValue = $this->cliente->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->cliente->ViewValue = $this->cliente->CurrentValue;
				}
			}
		} else {
			$this->cliente->ViewValue = NULL;
		}
		$this->cliente->ViewCustomAttributes = "";

		// mes
		$this->mes->ViewValue = $this->mes->CurrentValue;
		$this->mes->ViewCustomAttributes = "";

		// valor
		if (strval($this->valor->CurrentValue) != "") {
			$this->valor->ViewValue = $this->valor->optionCaption($this->valor->CurrentValue);
		} else {
			$this->valor->ViewValue = NULL;
		}
		$this->valor->ViewCustomAttributes = "";

		// status
		if (strval($this->status->CurrentValue) != "") {
			$this->status->ViewValue = $this->status->optionCaption($this->status->CurrentValue);
		} else {
			$this->status->ViewValue = NULL;
		}
		$this->status->ViewCustomAttributes = "";

		// data_pagamento
		$this->data_pagamento->ViewValue = $this->data_pagamento->CurrentValue;
		$this->data_pagamento->ViewValue = FormatDateTime($this->data_pagamento->ViewValue, 7);
		$this->data_pagamento->ViewCustomAttributes = "";

		// acao
		if (strval($this->acao->CurrentValue) != "") {
			$this->acao->ViewValue = $this->acao->optionCaption($this->acao->CurrentValue);
		} else {
			$this->acao->ViewValue = NULL;
		}
		$this->acao->ViewCustomAttributes = "";

		// data_hora
		$this->data_hora->ViewValue = $this->data_hora->CurrentValue;
		$this->data_hora->ViewValue = FormatDateTime($this->data_hora->ViewValue, 1);
		$this->data_hora->ViewCustomAttributes = "";

		// idmensalidade_log
		$this->idmensalidade_log->LinkCustomAttributes = "";
		$this->idmensalidade_log->HrefValue = "";
		$this->idmensalidade_log->TooltipValue = "";

		// cliente
		$this->cliente->LinkCustomAttributes = "";
		$this->cliente->HrefValue = "";
		$this->cliente->TooltipValue = "";

		// mes
		$this->mes->LinkCustomAttributes = "";
		$this->mes->HrefValue = "";
		$this->mes->TooltipValue = "";

		// valor
		$this->valor->LinkCustomAttributes = "";
		$this->valor->HrefValue = "";
		$this->valor->TooltipValue = "";

		// status
		$this->status->LinkCustomAttributes = "";
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

		// data_pagamento
		$this->data_pagamento->LinkCustomAttributes = "";
		$this->data_pagamento->HrefValue = "";
		$this->data_pagamento->TooltipValue = "";

		// acao
		$this->acao->LinkCustomAttributes = "";
		$this->acao->HrefValue = "";
		$this->acao->TooltipValue = "";

		// data_hora
		$this->data_hora->LinkCustomAttributes = "";
		$this->data_hora->HrefValue = "";
		$this->data_hora->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// idmensalidade_log
		$this->idmensalidade_log->EditAttrs["class"] = "form-control";
		$this->idmensalidade_log->EditCustomAttributes = "";
		$this->idmensalidade_log->EditValue = $this->idmensalidade_log->CurrentValue;
		$this->idmensalidade_log->ViewCustomAttributes = "";

		// cliente
		$this->cliente->EditAttrs["class"] = "form-control";
		$this->cliente->EditCustomAttributes = "";

		// mes
		$this->mes->EditAttrs["class"] = "form-control";
		$this->mes->EditCustomAttributes = "";
		if (!$this->mes->Raw)
			$this->mes->CurrentValue = HtmlDecode($this->mes->CurrentValue);
		$this->mes->EditValue = $this->mes->CurrentValue;
		$this->mes->PlaceHolder = RemoveHtml($this->mes->caption());

		// valor
		$this->valor->EditCustomAttributes = "";
		$this->valor->EditValue = $this->valor->options(FALSE);

		// status
		$this->status->EditAttrs["class"] = "form-control";
		$this->status->EditCustomAttributes = "";
		$this->status->EditValue = $this->status->options(TRUE);

		// data_pagamento
		$this->data_pagamento->EditAttrs["class"] = "form-control";
		$this->data_pagamento->EditCustomAttributes = "";
		$this->data_pagamento->EditValue = FormatDateTime($this->data_pagamento->CurrentValue, 7);
		$this->data_pagamento->PlaceHolder = RemoveHtml($this->data_pagamento->caption());

		// acao
		$this->acao->EditAttrs["class"] = "form-control";
		$this->acao->EditCustomAttributes = "";
		$this->acao->EditValue = $this->acao->options(TRUE);

		// data_hora
		$this->data_hora->EditAttrs["class"] = "form-control";
		$this->data_hora->EditCustomAttributes = "";
		$this->data_hora->EditValue = FormatDateTime($this->data_hora->CurrentValue, 8);
		$this->data_hora->PlaceHolder = RemoveHtml($this->data_hora->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->idmensalidade_log);
					$doc->exportCaption($this->cliente);
					$doc->exportCaption($this->mes);
					$doc->exportCaption($this->valor);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->data_pagamento);
					$doc->exportCaption($this->acao);
					$doc->exportCaption($this->data_hora);
				} else {
					$doc->exportCaption($this->idmensalidade_log);
					$doc->exportCaption($this->cliente);
					$doc->exportCaption($this->mes);
					$doc->exportCaption($this->valor);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->data_pagamento);
					$doc->exportCaption($this->acao);
					$doc->exportCaption($this->data_hora);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->idmensalidade_log);
						$doc->exportField($this->cliente);
						$doc->exportField($this->mes);
						$doc->exportField($this->valor);
						$doc->exportField($this->status);
						$doc->exportField($this->data_pagamento);
						$doc->exportField($this->acao);
						$doc->exportField($this->data_hora);
					} else {
						$doc->exportField($this->idmensalidade_log);
						$doc->exportField($this->cliente);
						$doc->exportField($this->mes);
						$doc->exportField($this->valor);
						$doc->exportField($this->status);
						$doc->exportField($this->data_pagamento);
						$doc->exportField($this->acao);
						$doc->exportField($this->data_hora);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>