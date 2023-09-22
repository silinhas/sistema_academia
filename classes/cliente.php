<?php namespace PHPMaker2020\sistema_academia; ?>
<?php

/**
 * Table class for cliente
 */
class cliente extends DbTable
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
	public $idcliente;
	public $nomeCliente;
	public $cpf;
	public $nascimento;
	public $sexo;
	public $telefone;
	public $cep;
	public $rua;
	public $bairro;
	public $numero;
	public $complemento;
	public $cidade;
	public $_email;
	public $data_matricula;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'cliente';
		$this->TableName = 'cliente';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`cliente`";
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

		// idcliente
		$this->idcliente = new DbField('cliente', 'cliente', 'x_idcliente', 'idcliente', '`idcliente`', '`idcliente`', 3, 11, -1, FALSE, '`idcliente`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->idcliente->IsAutoIncrement = TRUE; // Autoincrement field
		$this->idcliente->IsPrimaryKey = TRUE; // Primary key field
		$this->idcliente->Sortable = TRUE; // Allow sort
		$this->idcliente->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['idcliente'] = &$this->idcliente;

		// nomeCliente
		$this->nomeCliente = new DbField('cliente', 'cliente', 'x_nomeCliente', 'nomeCliente', '`nomeCliente`', '`nomeCliente`', 200, 100, -1, FALSE, '`nomeCliente`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nomeCliente->Sortable = TRUE; // Allow sort
		$this->fields['nomeCliente'] = &$this->nomeCliente;

		// cpf
		$this->cpf = new DbField('cliente', 'cliente', 'x_cpf', 'cpf', '`cpf`', '`cpf`', 200, 30, -1, FALSE, '`cpf`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cpf->Sortable = TRUE; // Allow sort
		$this->fields['cpf'] = &$this->cpf;

		// nascimento
		$this->nascimento = new DbField('cliente', 'cliente', 'x_nascimento', 'nascimento', '`nascimento`', '`nascimento`', 200, 20, 0, FALSE, '`nascimento`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nascimento->Sortable = TRUE; // Allow sort
		$this->nascimento->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['nascimento'] = &$this->nascimento;

		// sexo
		$this->sexo = new DbField('cliente', 'cliente', 'x_sexo', 'sexo', '`sexo`', '`sexo`', 200, 45, -1, FALSE, '`sexo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->sexo->Sortable = TRUE; // Allow sort
		$this->sexo->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->sexo->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		switch ($CurrentLanguage) {
			case "pt-BR":
				$this->sexo->Lookup = new Lookup('sexo', 'cliente', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
			default:
				$this->sexo->Lookup = new Lookup('sexo', 'cliente', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
				break;
		}
		$this->sexo->OptionCount = 3;
		$this->fields['sexo'] = &$this->sexo;

		// telefone
		$this->telefone = new DbField('cliente', 'cliente', 'x_telefone', 'telefone', '`telefone`', '`telefone`', 200, 45, -1, FALSE, '`telefone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->telefone->Sortable = TRUE; // Allow sort
		$this->fields['telefone'] = &$this->telefone;

		// cep
		$this->cep = new DbField('cliente', 'cliente', 'x_cep', 'cep', '`cep`', '`cep`', 200, 30, -1, FALSE, '`cep`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cep->Sortable = TRUE; // Allow sort
		$this->fields['cep'] = &$this->cep;

		// rua
		$this->rua = new DbField('cliente', 'cliente', 'x_rua', 'rua', '`rua`', '`rua`', 200, 100, -1, FALSE, '`rua`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rua->Sortable = TRUE; // Allow sort
		$this->fields['rua'] = &$this->rua;

		// bairro
		$this->bairro = new DbField('cliente', 'cliente', 'x_bairro', 'bairro', '`bairro`', '`bairro`', 200, 100, -1, FALSE, '`bairro`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bairro->Sortable = TRUE; // Allow sort
		$this->fields['bairro'] = &$this->bairro;

		// numero
		$this->numero = new DbField('cliente', 'cliente', 'x_numero', 'numero', '`numero`', '`numero`', 3, 11, -1, FALSE, '`numero`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->numero->Sortable = TRUE; // Allow sort
		$this->numero->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['numero'] = &$this->numero;

		// complemento
		$this->complemento = new DbField('cliente', 'cliente', 'x_complemento', 'complemento', '`complemento`', '`complemento`', 200, 100, -1, FALSE, '`complemento`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->complemento->Sortable = TRUE; // Allow sort
		$this->fields['complemento'] = &$this->complemento;

		// cidade
		$this->cidade = new DbField('cliente', 'cliente', 'x_cidade', 'cidade', '`cidade`', '`cidade`', 200, 45, -1, FALSE, '`cidade`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cidade->Sortable = TRUE; // Allow sort
		$this->fields['cidade'] = &$this->cidade;

		// email
		$this->_email = new DbField('cliente', 'cliente', 'x__email', 'email', '`email`', '`email`', 200, 100, -1, FALSE, '`email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_email->Sortable = TRUE; // Allow sort
		$this->fields['email'] = &$this->_email;

		// data_matricula
		$this->data_matricula = new DbField('cliente', 'cliente', 'x_data_matricula', 'data_matricula', '`data_matricula`', CastDateFieldForLike("`data_matricula`", 7, "DB"), 133, 10, 7, FALSE, '`data_matricula`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->data_matricula->Sortable = TRUE; // Allow sort
		$this->data_matricula->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_SEPARATOR"], $Language->phrase("IncorrectDateDMY"));
		$this->fields['data_matricula'] = &$this->data_matricula;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`cliente`";
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
			$this->idcliente->setDbValue($conn->insert_ID());
			$rs['idcliente'] = $this->idcliente->DbValue;
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
			if (array_key_exists('idcliente', $rs))
				AddFilter($where, QuotedName('idcliente', $this->Dbid) . '=' . QuotedValue($rs['idcliente'], $this->idcliente->DataType, $this->Dbid));
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
		$this->idcliente->DbValue = $row['idcliente'];
		$this->nomeCliente->DbValue = $row['nomeCliente'];
		$this->cpf->DbValue = $row['cpf'];
		$this->nascimento->DbValue = $row['nascimento'];
		$this->sexo->DbValue = $row['sexo'];
		$this->telefone->DbValue = $row['telefone'];
		$this->cep->DbValue = $row['cep'];
		$this->rua->DbValue = $row['rua'];
		$this->bairro->DbValue = $row['bairro'];
		$this->numero->DbValue = $row['numero'];
		$this->complemento->DbValue = $row['complemento'];
		$this->cidade->DbValue = $row['cidade'];
		$this->_email->DbValue = $row['email'];
		$this->data_matricula->DbValue = $row['data_matricula'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`idcliente` = @idcliente@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('idcliente', $row) ? $row['idcliente'] : NULL;
		else
			$val = $this->idcliente->OldValue !== NULL ? $this->idcliente->OldValue : $this->idcliente->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@idcliente@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
			return "clientelist.php";
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
		if ($pageName == "clienteview.php")
			return $Language->phrase("View");
		elseif ($pageName == "clienteedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "clienteadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "clientelist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("clienteview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("clienteview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "clienteadd.php?" . $this->getUrlParm($parm);
		else
			$url = "clienteadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("clienteedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("clienteadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("clientedelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "idcliente:" . JsonEncode($this->idcliente->CurrentValue, "number");
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
		if ($this->idcliente->CurrentValue != NULL) {
			$url .= "idcliente=" . urlencode($this->idcliente->CurrentValue);
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
			if (Param("idcliente") !== NULL)
				$arKeys[] = Param("idcliente");
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
				$this->idcliente->CurrentValue = $key;
			else
				$this->idcliente->OldValue = $key;
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
		$this->idcliente->setDbValue($rs->fields('idcliente'));
		$this->nomeCliente->setDbValue($rs->fields('nomeCliente'));
		$this->cpf->setDbValue($rs->fields('cpf'));
		$this->nascimento->setDbValue($rs->fields('nascimento'));
		$this->sexo->setDbValue($rs->fields('sexo'));
		$this->telefone->setDbValue($rs->fields('telefone'));
		$this->cep->setDbValue($rs->fields('cep'));
		$this->rua->setDbValue($rs->fields('rua'));
		$this->bairro->setDbValue($rs->fields('bairro'));
		$this->numero->setDbValue($rs->fields('numero'));
		$this->complemento->setDbValue($rs->fields('complemento'));
		$this->cidade->setDbValue($rs->fields('cidade'));
		$this->_email->setDbValue($rs->fields('email'));
		$this->data_matricula->setDbValue($rs->fields('data_matricula'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// idcliente
		// nomeCliente
		// cpf
		// nascimento
		// sexo
		// telefone
		// cep
		// rua
		// bairro
		// numero
		// complemento
		// cidade
		// email
		// data_matricula
		// idcliente

		$this->idcliente->ViewValue = $this->idcliente->CurrentValue;
		$this->idcliente->ViewCustomAttributes = "";

		// nomeCliente
		$this->nomeCliente->ViewValue = $this->nomeCliente->CurrentValue;
		$this->nomeCliente->ViewCustomAttributes = "";

		// cpf
		$this->cpf->ViewValue = $this->cpf->CurrentValue;
		$this->cpf->ViewCustomAttributes = "";

		// nascimento
		$this->nascimento->ViewValue = $this->nascimento->CurrentValue;
		$this->nascimento->ViewCustomAttributes = "";

		// sexo
		if (strval($this->sexo->CurrentValue) != "") {
			$this->sexo->ViewValue = $this->sexo->optionCaption($this->sexo->CurrentValue);
		} else {
			$this->sexo->ViewValue = NULL;
		}
		$this->sexo->ViewCustomAttributes = "";

		// telefone
		$this->telefone->ViewValue = $this->telefone->CurrentValue;
		$this->telefone->ViewCustomAttributes = "";

		// cep
		$this->cep->ViewValue = $this->cep->CurrentValue;
		$this->cep->ViewCustomAttributes = "";

		// rua
		$this->rua->ViewValue = $this->rua->CurrentValue;
		$this->rua->ViewCustomAttributes = "";

		// bairro
		$this->bairro->ViewValue = $this->bairro->CurrentValue;
		$this->bairro->ViewCustomAttributes = "";

		// numero
		$this->numero->ViewValue = $this->numero->CurrentValue;
		$this->numero->ViewValue = FormatNumber($this->numero->ViewValue, 0, -2, -2, -2);
		$this->numero->ViewCustomAttributes = "";

		// complemento
		$this->complemento->ViewValue = $this->complemento->CurrentValue;
		$this->complemento->ViewCustomAttributes = "";

		// cidade
		$this->cidade->ViewValue = $this->cidade->CurrentValue;
		$this->cidade->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// data_matricula
		$this->data_matricula->ViewValue = $this->data_matricula->CurrentValue;
		$this->data_matricula->ViewValue = FormatDateTime($this->data_matricula->ViewValue, 7);
		$this->data_matricula->ViewCustomAttributes = "";

		// idcliente
		$this->idcliente->LinkCustomAttributes = "";
		$this->idcliente->HrefValue = "";
		$this->idcliente->TooltipValue = "";

		// nomeCliente
		$this->nomeCliente->LinkCustomAttributes = "";
		$this->nomeCliente->HrefValue = "";
		$this->nomeCliente->TooltipValue = "";

		// cpf
		$this->cpf->LinkCustomAttributes = "";
		$this->cpf->HrefValue = "";
		$this->cpf->TooltipValue = "";

		// nascimento
		$this->nascimento->LinkCustomAttributes = "";
		$this->nascimento->HrefValue = "";
		$this->nascimento->TooltipValue = "";

		// sexo
		$this->sexo->LinkCustomAttributes = "";
		$this->sexo->HrefValue = "";
		$this->sexo->TooltipValue = "";

		// telefone
		$this->telefone->LinkCustomAttributes = "";
		$this->telefone->HrefValue = "";
		$this->telefone->TooltipValue = "";

		// cep
		$this->cep->LinkCustomAttributes = "";
		$this->cep->HrefValue = "";
		$this->cep->TooltipValue = "";

		// rua
		$this->rua->LinkCustomAttributes = "";
		$this->rua->HrefValue = "";
		$this->rua->TooltipValue = "";

		// bairro
		$this->bairro->LinkCustomAttributes = "";
		$this->bairro->HrefValue = "";
		$this->bairro->TooltipValue = "";

		// numero
		$this->numero->LinkCustomAttributes = "";
		$this->numero->HrefValue = "";
		$this->numero->TooltipValue = "";

		// complemento
		$this->complemento->LinkCustomAttributes = "";
		$this->complemento->HrefValue = "";
		$this->complemento->TooltipValue = "";

		// cidade
		$this->cidade->LinkCustomAttributes = "";
		$this->cidade->HrefValue = "";
		$this->cidade->TooltipValue = "";

		// email
		$this->_email->LinkCustomAttributes = "";
		$this->_email->HrefValue = "";
		$this->_email->TooltipValue = "";

		// data_matricula
		$this->data_matricula->LinkCustomAttributes = "";
		$this->data_matricula->HrefValue = "";
		$this->data_matricula->TooltipValue = "";

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

		// idcliente
		$this->idcliente->EditAttrs["class"] = "form-control";
		$this->idcliente->EditCustomAttributes = "";
		$this->idcliente->EditValue = $this->idcliente->CurrentValue;
		$this->idcliente->ViewCustomAttributes = "";

		// nomeCliente
		$this->nomeCliente->EditAttrs["class"] = "form-control";
		$this->nomeCliente->EditCustomAttributes = "";
		if (!$this->nomeCliente->Raw)
			$this->nomeCliente->CurrentValue = HtmlDecode($this->nomeCliente->CurrentValue);
		$this->nomeCliente->EditValue = $this->nomeCliente->CurrentValue;
		$this->nomeCliente->PlaceHolder = RemoveHtml($this->nomeCliente->caption());

		// cpf
		$this->cpf->EditAttrs["class"] = "form-control";
		$this->cpf->EditCustomAttributes = "";
		if (!$this->cpf->Raw)
			$this->cpf->CurrentValue = HtmlDecode($this->cpf->CurrentValue);
		$this->cpf->EditValue = $this->cpf->CurrentValue;
		$this->cpf->PlaceHolder = RemoveHtml($this->cpf->caption());

		// nascimento
		$this->nascimento->EditAttrs["class"] = "form-control";
		$this->nascimento->EditCustomAttributes = "";
		if (!$this->nascimento->Raw)
			$this->nascimento->CurrentValue = HtmlDecode($this->nascimento->CurrentValue);
		$this->nascimento->EditValue = $this->nascimento->CurrentValue;
		$this->nascimento->PlaceHolder = RemoveHtml($this->nascimento->caption());

		// sexo
		$this->sexo->EditAttrs["class"] = "form-control";
		$this->sexo->EditCustomAttributes = "";
		$this->sexo->EditValue = $this->sexo->options(TRUE);

		// telefone
		$this->telefone->EditAttrs["class"] = "form-control";
		$this->telefone->EditCustomAttributes = "";
		if (!$this->telefone->Raw)
			$this->telefone->CurrentValue = HtmlDecode($this->telefone->CurrentValue);
		$this->telefone->EditValue = $this->telefone->CurrentValue;
		$this->telefone->PlaceHolder = RemoveHtml($this->telefone->caption());

		// cep
		$this->cep->EditAttrs["class"] = "form-control";
		$this->cep->EditCustomAttributes = "";
		if (!$this->cep->Raw)
			$this->cep->CurrentValue = HtmlDecode($this->cep->CurrentValue);
		$this->cep->EditValue = $this->cep->CurrentValue;
		$this->cep->PlaceHolder = RemoveHtml($this->cep->caption());

		// rua
		$this->rua->EditAttrs["class"] = "form-control";
		$this->rua->EditCustomAttributes = "";
		if (!$this->rua->Raw)
			$this->rua->CurrentValue = HtmlDecode($this->rua->CurrentValue);
		$this->rua->EditValue = $this->rua->CurrentValue;
		$this->rua->PlaceHolder = RemoveHtml($this->rua->caption());

		// bairro
		$this->bairro->EditAttrs["class"] = "form-control";
		$this->bairro->EditCustomAttributes = "";
		if (!$this->bairro->Raw)
			$this->bairro->CurrentValue = HtmlDecode($this->bairro->CurrentValue);
		$this->bairro->EditValue = $this->bairro->CurrentValue;
		$this->bairro->PlaceHolder = RemoveHtml($this->bairro->caption());

		// numero
		$this->numero->EditAttrs["class"] = "form-control";
		$this->numero->EditCustomAttributes = "";
		$this->numero->EditValue = $this->numero->CurrentValue;
		$this->numero->PlaceHolder = RemoveHtml($this->numero->caption());

		// complemento
		$this->complemento->EditAttrs["class"] = "form-control";
		$this->complemento->EditCustomAttributes = "";
		if (!$this->complemento->Raw)
			$this->complemento->CurrentValue = HtmlDecode($this->complemento->CurrentValue);
		$this->complemento->EditValue = $this->complemento->CurrentValue;
		$this->complemento->PlaceHolder = RemoveHtml($this->complemento->caption());

		// cidade
		$this->cidade->EditAttrs["class"] = "form-control";
		$this->cidade->EditCustomAttributes = "";
		if (!$this->cidade->Raw)
			$this->cidade->CurrentValue = HtmlDecode($this->cidade->CurrentValue);
		$this->cidade->EditValue = $this->cidade->CurrentValue;
		$this->cidade->PlaceHolder = RemoveHtml($this->cidade->caption());

		// email
		$this->_email->EditAttrs["class"] = "form-control";
		$this->_email->EditCustomAttributes = "";
		if (!$this->_email->Raw)
			$this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
		$this->_email->EditValue = $this->_email->CurrentValue;
		$this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

		// data_matricula
		$this->data_matricula->EditAttrs["class"] = "form-control";
		$this->data_matricula->EditCustomAttributes = "";
		$this->data_matricula->EditValue = FormatDateTime($this->data_matricula->CurrentValue, 7);
		$this->data_matricula->PlaceHolder = RemoveHtml($this->data_matricula->caption());

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
					$doc->exportCaption($this->idcliente);
					$doc->exportCaption($this->nomeCliente);
					$doc->exportCaption($this->cpf);
					$doc->exportCaption($this->nascimento);
					$doc->exportCaption($this->sexo);
					$doc->exportCaption($this->telefone);
					$doc->exportCaption($this->cep);
					$doc->exportCaption($this->rua);
					$doc->exportCaption($this->bairro);
					$doc->exportCaption($this->numero);
					$doc->exportCaption($this->complemento);
					$doc->exportCaption($this->cidade);
					$doc->exportCaption($this->_email);
					$doc->exportCaption($this->data_matricula);
				} else {
					$doc->exportCaption($this->idcliente);
					$doc->exportCaption($this->nomeCliente);
					$doc->exportCaption($this->cpf);
					$doc->exportCaption($this->nascimento);
					$doc->exportCaption($this->sexo);
					$doc->exportCaption($this->telefone);
					$doc->exportCaption($this->cep);
					$doc->exportCaption($this->rua);
					$doc->exportCaption($this->bairro);
					$doc->exportCaption($this->numero);
					$doc->exportCaption($this->complemento);
					$doc->exportCaption($this->cidade);
					$doc->exportCaption($this->_email);
					$doc->exportCaption($this->data_matricula);
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
						$doc->exportField($this->idcliente);
						$doc->exportField($this->nomeCliente);
						$doc->exportField($this->cpf);
						$doc->exportField($this->nascimento);
						$doc->exportField($this->sexo);
						$doc->exportField($this->telefone);
						$doc->exportField($this->cep);
						$doc->exportField($this->rua);
						$doc->exportField($this->bairro);
						$doc->exportField($this->numero);
						$doc->exportField($this->complemento);
						$doc->exportField($this->cidade);
						$doc->exportField($this->_email);
						$doc->exportField($this->data_matricula);
					} else {
						$doc->exportField($this->idcliente);
						$doc->exportField($this->nomeCliente);
						$doc->exportField($this->cpf);
						$doc->exportField($this->nascimento);
						$doc->exportField($this->sexo);
						$doc->exportField($this->telefone);
						$doc->exportField($this->cep);
						$doc->exportField($this->rua);
						$doc->exportField($this->bairro);
						$doc->exportField($this->numero);
						$doc->exportField($this->complemento);
						$doc->exportField($this->cidade);
						$doc->exportField($this->_email);
						$doc->exportField($this->data_matricula);
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