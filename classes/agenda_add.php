<?php
namespace PHPMaker2020\sistema_academia;

/**
 * Page class
 */
class agenda_add extends agenda
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{5CB0D3D1-109E-4D29-B3C6-8A932EF252A0}";

	// Table name
	public $TableName = 'agenda';

	// Page object name
	public $PageObjName = "agenda_add";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (agenda)
		if (!isset($GLOBALS["agenda"]) || get_class($GLOBALS["agenda"]) == PROJECT_NAMESPACE . "agenda") {
			$GLOBALS["agenda"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["agenda"];
		}

		// Table object (usuario)
		if (!isset($GLOBALS['usuario']))
			$GLOBALS['usuario'] = new usuario();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'agenda');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (usuario)
		$UserTable = $UserTable ?: new usuario();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $agenda;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($agenda);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "agendaview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['idagenda'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->idagenda->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!ValidApiRequest())
			return FALSE;
		$this->setupApiSecurity();

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
		if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
		$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
		if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
	}
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canAdd()) {
				SetStatus(401); // Unauthorized
				return;
			}
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("agendalist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->idagenda->Visible = FALSE;
		$this->data->setVisibility();
		$this->hora->setVisibility();
		$this->descricao->setVisibility();
		$this->data_now->setVisibility();
		$this->professor_idprofessor->setVisibility();
		$this->cliente_idcliente->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		$this->setupLookupOptions($this->data);
		$this->setupLookupOptions($this->hora);
		$this->setupLookupOptions($this->descricao);
		$this->setupLookupOptions($this->data_now);
		$this->setupLookupOptions($this->professor_idprofessor);
		$this->setupLookupOptions($this->cliente_idcliente);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("agendalist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("idagenda") !== NULL) {
				$this->idagenda->setQueryStringValue(Get("idagenda"));
				$this->setKey("idagenda", $this->idagenda->CurrentValue); // Set up key
			} else {
				$this->setKey("idagenda", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("agendalist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "agendalist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "agendaview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		if ($this->isConfirm()) { // Confirm page
			$this->RowType = ROWTYPE_VIEW; // Render view type
		} else {
			$this->RowType = ROWTYPE_ADD; // Render add type
		}

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->idagenda->CurrentValue = NULL;
		$this->idagenda->OldValue = $this->idagenda->CurrentValue;
		$this->data->CurrentValue = NULL;
		$this->data->OldValue = $this->data->CurrentValue;
		$this->hora->CurrentValue = NULL;
		$this->hora->OldValue = $this->hora->CurrentValue;
		$this->descricao->CurrentValue = NULL;
		$this->descricao->OldValue = $this->descricao->CurrentValue;
		$this->data_now->CurrentValue = NULL;
		$this->data_now->OldValue = $this->data_now->CurrentValue;
		$this->professor_idprofessor->CurrentValue = NULL;
		$this->professor_idprofessor->OldValue = $this->professor_idprofessor->CurrentValue;
		$this->cliente_idcliente->CurrentValue = NULL;
		$this->cliente_idcliente->OldValue = $this->cliente_idcliente->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'data' first before field var 'x_data'
		$val = $CurrentForm->hasValue("data") ? $CurrentForm->getValue("data") : $CurrentForm->getValue("x_data");
		if (!$this->data->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->data->Visible = FALSE; // Disable update for API request
			else
				$this->data->setFormValue($val);
		}

		// Check field name 'hora' first before field var 'x_hora'
		$val = $CurrentForm->hasValue("hora") ? $CurrentForm->getValue("hora") : $CurrentForm->getValue("x_hora");
		if (!$this->hora->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->hora->Visible = FALSE; // Disable update for API request
			else
				$this->hora->setFormValue($val);
			$this->hora->CurrentValue = UnFormatDateTime($this->hora->CurrentValue, 4);
		}

		// Check field name 'descricao' first before field var 'x_descricao'
		$val = $CurrentForm->hasValue("descricao") ? $CurrentForm->getValue("descricao") : $CurrentForm->getValue("x_descricao");
		if (!$this->descricao->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->descricao->Visible = FALSE; // Disable update for API request
			else
				$this->descricao->setFormValue($val);
		}

		// Check field name 'data_now' first before field var 'x_data_now'
		$val = $CurrentForm->hasValue("data_now") ? $CurrentForm->getValue("data_now") : $CurrentForm->getValue("x_data_now");
		if (!$this->data_now->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->data_now->Visible = FALSE; // Disable update for API request
			else
				$this->data_now->setFormValue($val);
		}

		// Check field name 'professor_idprofessor' first before field var 'x_professor_idprofessor'
		$val = $CurrentForm->hasValue("professor_idprofessor") ? $CurrentForm->getValue("professor_idprofessor") : $CurrentForm->getValue("x_professor_idprofessor");
		if (!$this->professor_idprofessor->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->professor_idprofessor->Visible = FALSE; // Disable update for API request
			else
				$this->professor_idprofessor->setFormValue($val);
		}

		// Check field name 'cliente_idcliente' first before field var 'x_cliente_idcliente'
		$val = $CurrentForm->hasValue("cliente_idcliente") ? $CurrentForm->getValue("cliente_idcliente") : $CurrentForm->getValue("x_cliente_idcliente");
		if (!$this->cliente_idcliente->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->cliente_idcliente->Visible = FALSE; // Disable update for API request
			else
				$this->cliente_idcliente->setFormValue($val);
		}

		// Check field name 'idagenda' first before field var 'x_idagenda'
		$val = $CurrentForm->hasValue("idagenda") ? $CurrentForm->getValue("idagenda") : $CurrentForm->getValue("x_idagenda");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->data->CurrentValue = $this->data->FormValue;
		$this->hora->CurrentValue = $this->hora->FormValue;
		$this->hora->CurrentValue = UnFormatDateTime($this->hora->CurrentValue, 4);
		$this->descricao->CurrentValue = $this->descricao->FormValue;
		$this->data_now->CurrentValue = $this->data_now->FormValue;
		$this->professor_idprofessor->CurrentValue = $this->professor_idprofessor->FormValue;
		$this->cliente_idcliente->CurrentValue = $this->cliente_idcliente->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->idagenda->setDbValue($row['idagenda']);
		$this->data->setDbValue($row['data']);
		$this->hora->setDbValue($row['hora']);
		$this->descricao->setDbValue($row['descricao']);
		$this->data_now->setDbValue($row['data_now']);
		$this->professor_idprofessor->setDbValue($row['professor_idprofessor']);
		$this->cliente_idcliente->setDbValue($row['cliente_idcliente']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['idagenda'] = $this->idagenda->CurrentValue;
		$row['data'] = $this->data->CurrentValue;
		$row['hora'] = $this->hora->CurrentValue;
		$row['descricao'] = $this->descricao->CurrentValue;
		$row['data_now'] = $this->data_now->CurrentValue;
		$row['professor_idprofessor'] = $this->professor_idprofessor->CurrentValue;
		$row['cliente_idcliente'] = $this->cliente_idcliente->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("idagenda")) != "")
			$this->idagenda->OldValue = $this->getKey("idagenda"); // idagenda
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// idagenda
		// data
		// hora
		// descricao
		// data_now
		// professor_idprofessor
		// cliente_idcliente

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// idagenda
			$this->idagenda->ViewValue = $this->idagenda->CurrentValue;
			$this->idagenda->ViewCustomAttributes = "";

			// data
			$curVal = strval($this->data->CurrentValue);
			if ($curVal != "") {
				$this->data->ViewValue = $this->data->lookupCacheOption($curVal);
				if ($this->data->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`idagenda_log`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->data->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = FormatDateTime($rswrk->fields('df'), 0);
						$this->data->ViewValue = $this->data->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->data->ViewValue = $this->data->CurrentValue;
					}
				}
			} else {
				$this->data->ViewValue = NULL;
			}
			$this->data->ViewCustomAttributes = "";

			// hora
			$curVal = strval($this->hora->CurrentValue);
			if ($curVal != "") {
				$this->hora->ViewValue = $this->hora->lookupCacheOption($curVal);
				if ($this->hora->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`idagenda_log`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->hora->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = FormatDateTime($rswrk->fields('df'), 4);
						$this->hora->ViewValue = $this->hora->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->hora->ViewValue = $this->hora->CurrentValue;
					}
				}
			} else {
				$this->hora->ViewValue = NULL;
			}
			$this->hora->ViewCustomAttributes = "";

			// descricao
			$curVal = strval($this->descricao->CurrentValue);
			if ($curVal != "") {
				$this->descricao->ViewValue = $this->descricao->lookupCacheOption($curVal);
				if ($this->descricao->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`idagenda_log`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->descricao->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->descricao->ViewValue = $this->descricao->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->descricao->ViewValue = $this->descricao->CurrentValue;
					}
				}
			} else {
				$this->descricao->ViewValue = NULL;
			}
			$this->descricao->ViewCustomAttributes = "";

			// data_now
			$curVal = strval($this->data_now->CurrentValue);
			if ($curVal != "") {
				$this->data_now->ViewValue = $this->data_now->lookupCacheOption($curVal);
				if ($this->data_now->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`idagenda_log`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->data_now->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = FormatDateTime($rswrk->fields('df'), 2);
						$this->data_now->ViewValue = $this->data_now->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->data_now->ViewValue = $this->data_now->CurrentValue;
					}
				}
			} else {
				$this->data_now->ViewValue = NULL;
			}
			$this->data_now->ViewCustomAttributes = "";

			// professor_idprofessor
			$curVal = strval($this->professor_idprofessor->CurrentValue);
			if ($curVal != "") {
				$this->professor_idprofessor->ViewValue = $this->professor_idprofessor->lookupCacheOption($curVal);
				if ($this->professor_idprofessor->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`idprofessor`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->professor_idprofessor->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->professor_idprofessor->ViewValue = $this->professor_idprofessor->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->professor_idprofessor->ViewValue = $this->professor_idprofessor->CurrentValue;
					}
				}
			} else {
				$this->professor_idprofessor->ViewValue = NULL;
			}
			$this->professor_idprofessor->ViewCustomAttributes = "";

			// cliente_idcliente
			$curVal = strval($this->cliente_idcliente->CurrentValue);
			if ($curVal != "") {
				$this->cliente_idcliente->ViewValue = $this->cliente_idcliente->lookupCacheOption($curVal);
				if ($this->cliente_idcliente->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`idcliente`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->cliente_idcliente->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->cliente_idcliente->ViewValue = $this->cliente_idcliente->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->cliente_idcliente->ViewValue = $this->cliente_idcliente->CurrentValue;
					}
				}
			} else {
				$this->cliente_idcliente->ViewValue = NULL;
			}
			$this->cliente_idcliente->ViewCustomAttributes = "";

			// data
			$this->data->LinkCustomAttributes = "";
			$this->data->HrefValue = "";
			$this->data->TooltipValue = "";

			// hora
			$this->hora->LinkCustomAttributes = "";
			$this->hora->HrefValue = "";
			$this->hora->TooltipValue = "";

			// descricao
			$this->descricao->LinkCustomAttributes = "";
			$this->descricao->HrefValue = "";
			$this->descricao->TooltipValue = "";

			// data_now
			$this->data_now->LinkCustomAttributes = "";
			$this->data_now->HrefValue = "";
			$this->data_now->TooltipValue = "";

			// professor_idprofessor
			$this->professor_idprofessor->LinkCustomAttributes = "";
			$this->professor_idprofessor->HrefValue = "";
			$this->professor_idprofessor->TooltipValue = "";

			// cliente_idcliente
			$this->cliente_idcliente->LinkCustomAttributes = "";
			$this->cliente_idcliente->HrefValue = "";
			$this->cliente_idcliente->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// data
			$this->data->EditAttrs["class"] = "form-control";
			$this->data->EditCustomAttributes = "";
			$curVal = trim(strval($this->data->CurrentValue));
			if ($curVal != "")
				$this->data->ViewValue = $this->data->lookupCacheOption($curVal);
			else
				$this->data->ViewValue = $this->data->Lookup !== NULL && is_array($this->data->Lookup->Options) ? $curVal : NULL;
			if ($this->data->ViewValue !== NULL) { // Load from cache
				$this->data->EditValue = array_values($this->data->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`idagenda_log`" . SearchString("=", $this->data->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->data->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$rowcnt = count($arwrk);
				for ($i = 0; $i < $rowcnt; $i++) {
					$arwrk[$i][1] = FormatDateTime($arwrk[$i][1], 0);
				}
				$this->data->EditValue = $arwrk;
			}

			// hora
			$this->hora->EditAttrs["class"] = "form-control";
			$this->hora->EditCustomAttributes = "";
			$curVal = trim(strval($this->hora->CurrentValue));
			if ($curVal != "")
				$this->hora->ViewValue = $this->hora->lookupCacheOption($curVal);
			else
				$this->hora->ViewValue = $this->hora->Lookup !== NULL && is_array($this->hora->Lookup->Options) ? $curVal : NULL;
			if ($this->hora->ViewValue !== NULL) { // Load from cache
				$this->hora->EditValue = array_values($this->hora->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`idagenda_log`" . SearchString("=", $this->hora->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->hora->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$rowcnt = count($arwrk);
				for ($i = 0; $i < $rowcnt; $i++) {
					$arwrk[$i][1] = FormatDateTime($arwrk[$i][1], 4);
				}
				$this->hora->EditValue = $arwrk;
			}

			// descricao
			$this->descricao->EditAttrs["class"] = "form-control";
			$this->descricao->EditCustomAttributes = "";
			$curVal = trim(strval($this->descricao->CurrentValue));
			if ($curVal != "")
				$this->descricao->ViewValue = $this->descricao->lookupCacheOption($curVal);
			else
				$this->descricao->ViewValue = $this->descricao->Lookup !== NULL && is_array($this->descricao->Lookup->Options) ? $curVal : NULL;
			if ($this->descricao->ViewValue !== NULL) { // Load from cache
				$this->descricao->EditValue = array_values($this->descricao->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`idagenda_log`" . SearchString("=", $this->descricao->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->descricao->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->descricao->EditValue = $arwrk;
			}

			// data_now
			$this->data_now->EditAttrs["class"] = "form-control";
			$this->data_now->EditCustomAttributes = "";
			$curVal = trim(strval($this->data_now->CurrentValue));
			if ($curVal != "")
				$this->data_now->ViewValue = $this->data_now->lookupCacheOption($curVal);
			else
				$this->data_now->ViewValue = $this->data_now->Lookup !== NULL && is_array($this->data_now->Lookup->Options) ? $curVal : NULL;
			if ($this->data_now->ViewValue !== NULL) { // Load from cache
				$this->data_now->EditValue = array_values($this->data_now->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`idagenda_log`" . SearchString("=", $this->data_now->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->data_now->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$rowcnt = count($arwrk);
				for ($i = 0; $i < $rowcnt; $i++) {
					$arwrk[$i][1] = FormatDateTime($arwrk[$i][1], 2);
				}
				$this->data_now->EditValue = $arwrk;
			}

			// professor_idprofessor
			$this->professor_idprofessor->EditAttrs["class"] = "form-control";
			$this->professor_idprofessor->EditCustomAttributes = "";
			$curVal = trim(strval($this->professor_idprofessor->CurrentValue));
			if ($curVal != "")
				$this->professor_idprofessor->ViewValue = $this->professor_idprofessor->lookupCacheOption($curVal);
			else
				$this->professor_idprofessor->ViewValue = $this->professor_idprofessor->Lookup !== NULL && is_array($this->professor_idprofessor->Lookup->Options) ? $curVal : NULL;
			if ($this->professor_idprofessor->ViewValue !== NULL) { // Load from cache
				$this->professor_idprofessor->EditValue = array_values($this->professor_idprofessor->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`idprofessor`" . SearchString("=", $this->professor_idprofessor->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->professor_idprofessor->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->professor_idprofessor->EditValue = $arwrk;
			}

			// cliente_idcliente
			$this->cliente_idcliente->EditAttrs["class"] = "form-control";
			$this->cliente_idcliente->EditCustomAttributes = "";
			$curVal = trim(strval($this->cliente_idcliente->CurrentValue));
			if ($curVal != "")
				$this->cliente_idcliente->ViewValue = $this->cliente_idcliente->lookupCacheOption($curVal);
			else
				$this->cliente_idcliente->ViewValue = $this->cliente_idcliente->Lookup !== NULL && is_array($this->cliente_idcliente->Lookup->Options) ? $curVal : NULL;
			if ($this->cliente_idcliente->ViewValue !== NULL) { // Load from cache
				$this->cliente_idcliente->EditValue = array_values($this->cliente_idcliente->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`idcliente`" . SearchString("=", $this->cliente_idcliente->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->cliente_idcliente->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->cliente_idcliente->EditValue = $arwrk;
			}

			// Add refer script
			// data

			$this->data->LinkCustomAttributes = "";
			$this->data->HrefValue = "";

			// hora
			$this->hora->LinkCustomAttributes = "";
			$this->hora->HrefValue = "";

			// descricao
			$this->descricao->LinkCustomAttributes = "";
			$this->descricao->HrefValue = "";

			// data_now
			$this->data_now->LinkCustomAttributes = "";
			$this->data_now->HrefValue = "";

			// professor_idprofessor
			$this->professor_idprofessor->LinkCustomAttributes = "";
			$this->professor_idprofessor->HrefValue = "";

			// cliente_idcliente
			$this->cliente_idcliente->LinkCustomAttributes = "";
			$this->cliente_idcliente->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->data->Required) {
			if (!$this->data->IsDetailKey && $this->data->FormValue != NULL && $this->data->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->data->caption(), $this->data->RequiredErrorMessage));
			}
		}
		if ($this->hora->Required) {
			if (!$this->hora->IsDetailKey && $this->hora->FormValue != NULL && $this->hora->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->hora->caption(), $this->hora->RequiredErrorMessage));
			}
		}
		if ($this->descricao->Required) {
			if (!$this->descricao->IsDetailKey && $this->descricao->FormValue != NULL && $this->descricao->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->descricao->caption(), $this->descricao->RequiredErrorMessage));
			}
		}
		if ($this->data_now->Required) {
			if (!$this->data_now->IsDetailKey && $this->data_now->FormValue != NULL && $this->data_now->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->data_now->caption(), $this->data_now->RequiredErrorMessage));
			}
		}
		if ($this->professor_idprofessor->Required) {
			if (!$this->professor_idprofessor->IsDetailKey && $this->professor_idprofessor->FormValue != NULL && $this->professor_idprofessor->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->professor_idprofessor->caption(), $this->professor_idprofessor->RequiredErrorMessage));
			}
		}
		if ($this->cliente_idcliente->Required) {
			if (!$this->cliente_idcliente->IsDetailKey && $this->cliente_idcliente->FormValue != NULL && $this->cliente_idcliente->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cliente_idcliente->caption(), $this->cliente_idcliente->RequiredErrorMessage));
			}
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// data
		$this->data->setDbValueDef($rsnew, $this->data->CurrentValue, NULL, FALSE);

		// hora
		$this->hora->setDbValueDef($rsnew, $this->hora->CurrentValue, NULL, FALSE);

		// descricao
		$this->descricao->setDbValueDef($rsnew, $this->descricao->CurrentValue, "", FALSE);

		// data_now
		$this->data_now->setDbValueDef($rsnew, $this->data_now->CurrentValue, NULL, FALSE);

		// professor_idprofessor
		$this->professor_idprofessor->setDbValueDef($rsnew, $this->professor_idprofessor->CurrentValue, 0, FALSE);

		// cliente_idcliente
		$this->cliente_idcliente->setDbValueDef($rsnew, $this->cliente_idcliente->CurrentValue, 0, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("agendalist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x_data":
					break;
				case "x_hora":
					break;
				case "x_descricao":
					break;
				case "x_data_now":
					break;
				case "x_professor_idprofessor":
					break;
				case "x_cliente_idcliente":
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_data":
							$row[1] = FormatDateTime($row[1], 0);
							$row['df'] = $row[1];
							break;
						case "x_hora":
							$row[1] = FormatDateTime($row[1], 4);
							$row['df'] = $row[1];
							break;
						case "x_descricao":
							break;
						case "x_data_now":
							$row[1] = FormatDateTime($row[1], 2);
							$row['df'] = $row[1];
							break;
						case "x_professor_idprofessor":
							break;
						case "x_cliente_idcliente":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
} // End class
?>