<?php
namespace PHPMaker2020\sistema_academia;

/**
 * Page class
 */
class agenda_log_edit extends agenda_log
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{5CB0D3D1-109E-4D29-B3C6-8A932EF252A0}";

	// Table name
	public $TableName = 'agenda_log';

	// Page object name
	public $PageObjName = "agenda_log_edit";

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

		// Table object (agenda_log)
		if (!isset($GLOBALS["agenda_log"]) || get_class($GLOBALS["agenda_log"]) == PROJECT_NAMESPACE . "agenda_log") {
			$GLOBALS["agenda_log"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["agenda_log"];
		}

		// Table object (usuario)
		if (!isset($GLOBALS['usuario']))
			$GLOBALS['usuario'] = new usuario();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'agenda_log');

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
		global $agenda_log;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($agenda_log);
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
					if ($pageName == "agenda_logview.php")
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
			$key .= @$ar['idagenda_log'];
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
			$this->idagenda_log->Visible = FALSE;
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
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;

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
			if (!$Security->canEdit()) {
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
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("agenda_loglist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->idagenda_log->setVisibility();
		$this->data->setVisibility();
		$this->hora->setVisibility();
		$this->data_now->setVisibility();
		$this->professor->setVisibility();
		$this->cliente->setVisibility();
		$this->acao->setVisibility();
		$this->data_hora->setVisibility();
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
		$this->setupLookupOptions($this->professor);
		$this->setupLookupOptions($this->cliente);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("agenda_loglist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {

			// Load key values
			$loaded = TRUE;
			if (Get("idagenda_log") !== NULL) {
				$this->idagenda_log->setQueryStringValue(Get("idagenda_log"));
				$this->idagenda_log->setOldValue($this->idagenda_log->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->idagenda_log->setQueryStringValue(Key(0));
				$this->idagenda_log->setOldValue($this->idagenda_log->QueryStringValue);
			} elseif (Post("idagenda_log") !== NULL) {
				$this->idagenda_log->setFormValue(Post("idagenda_log"));
				$this->idagenda_log->setOldValue($this->idagenda_log->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->idagenda_log->setQueryStringValue(Route(2));
				$this->idagenda_log->setOldValue($this->idagenda_log->QueryStringValue);
			} else {
				$loaded = FALSE; // Unable to load key
			}

			// Load record
			if ($loaded)
				$loaded = $this->loadRow();
			if (!$loaded) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate();
				return;
			}
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} else {
			if (Post("action") !== NULL) {
				$this->CurrentAction = Post("action"); // Get action code
				if (!$this->isShow()) // Not reload record, handle as postback
					$postBack = TRUE;

				// Load key from Form
				if ($CurrentForm->hasValue("x_idagenda_log")) {
					$this->idagenda_log->setFormValue($CurrentForm->getValue("x_idagenda_log"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("idagenda_log") !== NULL) {
					$this->idagenda_log->setQueryStringValue(Get("idagenda_log"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->idagenda_log->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->idagenda_log->CurrentValue = NULL;
				}
			}

			// Load current record
			$loaded = $this->loadRow();
		}

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("agenda_loglist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "agenda_loglist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'idagenda_log' first before field var 'x_idagenda_log'
		$val = $CurrentForm->hasValue("idagenda_log") ? $CurrentForm->getValue("idagenda_log") : $CurrentForm->getValue("x_idagenda_log");
		if (!$this->idagenda_log->IsDetailKey)
			$this->idagenda_log->setFormValue($val);

		// Check field name 'data' first before field var 'x_data'
		$val = $CurrentForm->hasValue("data") ? $CurrentForm->getValue("data") : $CurrentForm->getValue("x_data");
		if (!$this->data->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->data->Visible = FALSE; // Disable update for API request
			else
				$this->data->setFormValue($val);
			$this->data->CurrentValue = UnFormatDateTime($this->data->CurrentValue, 0);
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

		// Check field name 'data_now' first before field var 'x_data_now'
		$val = $CurrentForm->hasValue("data_now") ? $CurrentForm->getValue("data_now") : $CurrentForm->getValue("x_data_now");
		if (!$this->data_now->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->data_now->Visible = FALSE; // Disable update for API request
			else
				$this->data_now->setFormValue($val);
			$this->data_now->CurrentValue = UnFormatDateTime($this->data_now->CurrentValue, 2);
		}

		// Check field name 'professor' first before field var 'x_professor'
		$val = $CurrentForm->hasValue("professor") ? $CurrentForm->getValue("professor") : $CurrentForm->getValue("x_professor");
		if (!$this->professor->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->professor->Visible = FALSE; // Disable update for API request
			else
				$this->professor->setFormValue($val);
		}

		// Check field name 'cliente' first before field var 'x_cliente'
		$val = $CurrentForm->hasValue("cliente") ? $CurrentForm->getValue("cliente") : $CurrentForm->getValue("x_cliente");
		if (!$this->cliente->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->cliente->Visible = FALSE; // Disable update for API request
			else
				$this->cliente->setFormValue($val);
		}

		// Check field name 'acao' first before field var 'x_acao'
		$val = $CurrentForm->hasValue("acao") ? $CurrentForm->getValue("acao") : $CurrentForm->getValue("x_acao");
		if (!$this->acao->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->acao->Visible = FALSE; // Disable update for API request
			else
				$this->acao->setFormValue($val);
		}

		// Check field name 'data_hora' first before field var 'x_data_hora'
		$val = $CurrentForm->hasValue("data_hora") ? $CurrentForm->getValue("data_hora") : $CurrentForm->getValue("x_data_hora");
		if (!$this->data_hora->IsDetailKey) {
			if (IsApi() && $val === NULL)
				$this->data_hora->Visible = FALSE; // Disable update for API request
			else
				$this->data_hora->setFormValue($val);
			$this->data_hora->CurrentValue = UnFormatDateTime($this->data_hora->CurrentValue, 1);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->idagenda_log->CurrentValue = $this->idagenda_log->FormValue;
		$this->data->CurrentValue = $this->data->FormValue;
		$this->data->CurrentValue = UnFormatDateTime($this->data->CurrentValue, 0);
		$this->hora->CurrentValue = $this->hora->FormValue;
		$this->hora->CurrentValue = UnFormatDateTime($this->hora->CurrentValue, 4);
		$this->data_now->CurrentValue = $this->data_now->FormValue;
		$this->data_now->CurrentValue = UnFormatDateTime($this->data_now->CurrentValue, 2);
		$this->professor->CurrentValue = $this->professor->FormValue;
		$this->cliente->CurrentValue = $this->cliente->FormValue;
		$this->acao->CurrentValue = $this->acao->FormValue;
		$this->data_hora->CurrentValue = $this->data_hora->FormValue;
		$this->data_hora->CurrentValue = UnFormatDateTime($this->data_hora->CurrentValue, 1);
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
		$this->idagenda_log->setDbValue($row['idagenda_log']);
		$this->data->setDbValue($row['data']);
		$this->hora->setDbValue($row['hora']);
		$this->data_now->setDbValue($row['data_now']);
		$this->professor->setDbValue($row['professor']);
		$this->cliente->setDbValue($row['cliente']);
		$this->acao->setDbValue($row['acao']);
		$this->data_hora->setDbValue($row['data_hora']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['idagenda_log'] = NULL;
		$row['data'] = NULL;
		$row['hora'] = NULL;
		$row['data_now'] = NULL;
		$row['professor'] = NULL;
		$row['cliente'] = NULL;
		$row['acao'] = NULL;
		$row['data_hora'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("idagenda_log")) != "")
			$this->idagenda_log->OldValue = $this->getKey("idagenda_log"); // idagenda_log
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
		// idagenda_log
		// data
		// hora
		// data_now
		// professor
		// cliente
		// acao
		// data_hora

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// idagenda_log
			$this->idagenda_log->ViewValue = $this->idagenda_log->CurrentValue;
			$this->idagenda_log->ViewCustomAttributes = "";

			// data
			$this->data->ViewValue = $this->data->CurrentValue;
			$this->data->ViewValue = FormatDateTime($this->data->ViewValue, 0);
			$this->data->ViewCustomAttributes = "";

			// hora
			$this->hora->ViewValue = $this->hora->CurrentValue;
			$this->hora->ViewValue = FormatDateTime($this->hora->ViewValue, 4);
			$this->hora->ViewCustomAttributes = "";

			// data_now
			$this->data_now->ViewValue = $this->data_now->CurrentValue;
			$this->data_now->ViewValue = FormatDateTime($this->data_now->ViewValue, 2);
			$this->data_now->ViewCustomAttributes = "";

			// professor
			$curVal = strval($this->professor->CurrentValue);
			if ($curVal != "") {
				$this->professor->ViewValue = $this->professor->lookupCacheOption($curVal);
				if ($this->professor->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`idprofessor`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->professor->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->professor->ViewValue = $this->professor->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->professor->ViewValue = $this->professor->CurrentValue;
					}
				}
			} else {
				$this->professor->ViewValue = NULL;
			}
			$this->professor->ViewCustomAttributes = "";

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

			// idagenda_log
			$this->idagenda_log->LinkCustomAttributes = "";
			$this->idagenda_log->HrefValue = "";
			$this->idagenda_log->TooltipValue = "";

			// data
			$this->data->LinkCustomAttributes = "";
			$this->data->HrefValue = "";
			$this->data->TooltipValue = "";

			// hora
			$this->hora->LinkCustomAttributes = "";
			$this->hora->HrefValue = "";
			$this->hora->TooltipValue = "";

			// data_now
			$this->data_now->LinkCustomAttributes = "";
			$this->data_now->HrefValue = "";
			$this->data_now->TooltipValue = "";

			// professor
			$this->professor->LinkCustomAttributes = "";
			$this->professor->HrefValue = "";
			$this->professor->TooltipValue = "";

			// cliente
			$this->cliente->LinkCustomAttributes = "";
			$this->cliente->HrefValue = "";
			$this->cliente->TooltipValue = "";

			// acao
			$this->acao->LinkCustomAttributes = "";
			$this->acao->HrefValue = "";
			$this->acao->TooltipValue = "";

			// data_hora
			$this->data_hora->LinkCustomAttributes = "";
			$this->data_hora->HrefValue = "";
			$this->data_hora->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// idagenda_log
			$this->idagenda_log->EditAttrs["class"] = "form-control";
			$this->idagenda_log->EditCustomAttributes = "";
			$this->idagenda_log->EditValue = $this->idagenda_log->CurrentValue;
			$this->idagenda_log->ViewCustomAttributes = "";

			// data
			$this->data->EditAttrs["class"] = "form-control";
			$this->data->EditCustomAttributes = "";
			$this->data->EditValue = HtmlEncode(FormatDateTime($this->data->CurrentValue, 8));
			$this->data->PlaceHolder = RemoveHtml($this->data->caption());

			// hora
			$this->hora->EditAttrs["class"] = "form-control";
			$this->hora->EditCustomAttributes = "";
			$this->hora->EditValue = HtmlEncode($this->hora->CurrentValue);
			$this->hora->PlaceHolder = RemoveHtml($this->hora->caption());

			// data_now
			$this->data_now->EditAttrs["class"] = "form-control";
			$this->data_now->EditCustomAttributes = "";
			$this->data_now->EditValue = HtmlEncode(FormatDateTime($this->data_now->CurrentValue, 2));
			$this->data_now->PlaceHolder = RemoveHtml($this->data_now->caption());

			// professor
			$this->professor->EditAttrs["class"] = "form-control";
			$this->professor->EditCustomAttributes = "";
			$curVal = trim(strval($this->professor->CurrentValue));
			if ($curVal != "")
				$this->professor->ViewValue = $this->professor->lookupCacheOption($curVal);
			else
				$this->professor->ViewValue = $this->professor->Lookup !== NULL && is_array($this->professor->Lookup->Options) ? $curVal : NULL;
			if ($this->professor->ViewValue !== NULL) { // Load from cache
				$this->professor->EditValue = array_values($this->professor->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`idprofessor`" . SearchString("=", $this->professor->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->professor->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->professor->EditValue = $arwrk;
			}

			// cliente
			$this->cliente->EditAttrs["class"] = "form-control";
			$this->cliente->EditCustomAttributes = "";
			$curVal = trim(strval($this->cliente->CurrentValue));
			if ($curVal != "")
				$this->cliente->ViewValue = $this->cliente->lookupCacheOption($curVal);
			else
				$this->cliente->ViewValue = $this->cliente->Lookup !== NULL && is_array($this->cliente->Lookup->Options) ? $curVal : NULL;
			if ($this->cliente->ViewValue !== NULL) { // Load from cache
				$this->cliente->EditValue = array_values($this->cliente->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`idcliente`" . SearchString("=", $this->cliente->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->cliente->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->cliente->EditValue = $arwrk;
			}

			// acao
			$this->acao->EditAttrs["class"] = "form-control";
			$this->acao->EditCustomAttributes = "";
			$this->acao->EditValue = $this->acao->options(TRUE);

			// data_hora
			$this->data_hora->EditAttrs["class"] = "form-control";
			$this->data_hora->EditCustomAttributes = "";
			$this->data_hora->EditValue = HtmlEncode(FormatDateTime($this->data_hora->CurrentValue, 8));
			$this->data_hora->PlaceHolder = RemoveHtml($this->data_hora->caption());

			// Edit refer script
			// idagenda_log

			$this->idagenda_log->LinkCustomAttributes = "";
			$this->idagenda_log->HrefValue = "";

			// data
			$this->data->LinkCustomAttributes = "";
			$this->data->HrefValue = "";

			// hora
			$this->hora->LinkCustomAttributes = "";
			$this->hora->HrefValue = "";

			// data_now
			$this->data_now->LinkCustomAttributes = "";
			$this->data_now->HrefValue = "";

			// professor
			$this->professor->LinkCustomAttributes = "";
			$this->professor->HrefValue = "";

			// cliente
			$this->cliente->LinkCustomAttributes = "";
			$this->cliente->HrefValue = "";

			// acao
			$this->acao->LinkCustomAttributes = "";
			$this->acao->HrefValue = "";

			// data_hora
			$this->data_hora->LinkCustomAttributes = "";
			$this->data_hora->HrefValue = "";
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
		if ($this->idagenda_log->Required) {
			if (!$this->idagenda_log->IsDetailKey && $this->idagenda_log->FormValue != NULL && $this->idagenda_log->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->idagenda_log->caption(), $this->idagenda_log->RequiredErrorMessage));
			}
		}
		if ($this->data->Required) {
			if (!$this->data->IsDetailKey && $this->data->FormValue != NULL && $this->data->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->data->caption(), $this->data->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->data->FormValue)) {
			AddMessage($FormError, $this->data->errorMessage());
		}
		if ($this->hora->Required) {
			if (!$this->hora->IsDetailKey && $this->hora->FormValue != NULL && $this->hora->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->hora->caption(), $this->hora->RequiredErrorMessage));
			}
		}
		if (!CheckTime($this->hora->FormValue)) {
			AddMessage($FormError, $this->hora->errorMessage());
		}
		if ($this->data_now->Required) {
			if (!$this->data_now->IsDetailKey && $this->data_now->FormValue != NULL && $this->data_now->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->data_now->caption(), $this->data_now->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->data_now->FormValue)) {
			AddMessage($FormError, $this->data_now->errorMessage());
		}
		if ($this->professor->Required) {
			if (!$this->professor->IsDetailKey && $this->professor->FormValue != NULL && $this->professor->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->professor->caption(), $this->professor->RequiredErrorMessage));
			}
		}
		if ($this->cliente->Required) {
			if (!$this->cliente->IsDetailKey && $this->cliente->FormValue != NULL && $this->cliente->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cliente->caption(), $this->cliente->RequiredErrorMessage));
			}
		}
		if ($this->acao->Required) {
			if (!$this->acao->IsDetailKey && $this->acao->FormValue != NULL && $this->acao->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->acao->caption(), $this->acao->RequiredErrorMessage));
			}
		}
		if ($this->data_hora->Required) {
			if (!$this->data_hora->IsDetailKey && $this->data_hora->FormValue != NULL && $this->data_hora->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->data_hora->caption(), $this->data_hora->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->data_hora->FormValue)) {
			AddMessage($FormError, $this->data_hora->errorMessage());
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

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// data
			$this->data->setDbValueDef($rsnew, UnFormatDateTime($this->data->CurrentValue, 0), NULL, $this->data->ReadOnly);

			// hora
			$this->hora->setDbValueDef($rsnew, $this->hora->CurrentValue, NULL, $this->hora->ReadOnly);

			// data_now
			$this->data_now->setDbValueDef($rsnew, UnFormatDateTime($this->data_now->CurrentValue, 2), NULL, $this->data_now->ReadOnly);

			// professor
			$this->professor->setDbValueDef($rsnew, $this->professor->CurrentValue, NULL, $this->professor->ReadOnly);

			// cliente
			$this->cliente->setDbValueDef($rsnew, $this->cliente->CurrentValue, NULL, $this->cliente->ReadOnly);

			// acao
			$this->acao->setDbValueDef($rsnew, $this->acao->CurrentValue, "", $this->acao->ReadOnly);

			// data_hora
			$this->data_hora->setDbValueDef($rsnew, UnFormatDateTime($this->data_hora->CurrentValue, 1), CurrentDate(), $this->data_hora->ReadOnly);

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew);
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Clean upload path if any
		if ($editRow) {
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("agenda_loglist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
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
				case "x_professor":
					break;
				case "x_cliente":
					break;
				case "x_acao":
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
						case "x_professor":
							break;
						case "x_cliente":
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

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
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