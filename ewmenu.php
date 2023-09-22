<?php
namespace PHPMaker2020\sistema_academia;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
	$MenuRelativePath = "";
	$MenuLanguage = &$Language;
} else { // Compat reports
	$LANGUAGE_FOLDER = "../lang/";
	$MenuRelativePath = "../";
	$MenuLanguage = new Language();
}

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(31, "mi_userlevelpermissions", $MenuLanguage->MenuPhrase("31", "MenuText"), $MenuRelativePath . "userlevelpermissionslist.php", -1, "", AllowListMenu('{5CB0D3D1-109E-4D29-B3C6-8A932EF252A0}userlevelpermissions'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(32, "mi_userlevels", $MenuLanguage->MenuPhrase("32", "MenuText"), $MenuRelativePath . "userlevelslist.php", -1, "", AllowListMenu('{5CB0D3D1-109E-4D29-B3C6-8A932EF252A0}userlevels'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(11, "mi_home", $MenuLanguage->MenuPhrase("11", "MenuText"), $MenuRelativePath . "home.php", -1, "", AllowListMenu('{5CB0D3D1-109E-4D29-B3C6-8A932EF252A0}home.php'), FALSE, FALSE, "fa-dumbbell", "", FALSE);
$sideMenu->addMenuItem(10, "mci_Cliente", $MenuLanguage->MenuPhrase("10", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "fa-user", "", FALSE);
$sideMenu->addMenuItem(3, "mi_cliente", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "clientelist.php", 10, "", AllowListMenu('{5CB0D3D1-109E-4D29-B3C6-8A932EF252A0}cliente'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(5, "mi_medidas", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "medidaslist.php", 10, "", AllowListMenu('{5CB0D3D1-109E-4D29-B3C6-8A932EF252A0}medidas'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(29, "mci_Outros", $MenuLanguage->MenuPhrase("29", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "fa-users", "", FALSE);
$sideMenu->addMenuItem(7, "mi_professor", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "professorlist.php", 29, "", AllowListMenu('{5CB0D3D1-109E-4D29-B3C6-8A932EF252A0}professor'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(8, "mi_usuario", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "usuariolist.php", 29, "", AllowListMenu('{5CB0D3D1-109E-4D29-B3C6-8A932EF252A0}usuario'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(22, "mci_Agenda", $MenuLanguage->MenuPhrase("22", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "fa-calendar", "", FALSE);
$sideMenu->addMenuItem(1, "mi_agenda", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "agendalist.php", 22, "", AllowListMenu('{5CB0D3D1-109E-4D29-B3C6-8A932EF252A0}agenda'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(30, "mci_Registro", $MenuLanguage->MenuPhrase("30", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE, "fa-address-card", "", FALSE);
$sideMenu->addMenuItem(2, "mi_agenda_log", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "agenda_loglist.php", 30, "", AllowListMenu('{5CB0D3D1-109E-4D29-B3C6-8A932EF252A0}agenda_log'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(9, "mi_mensalidade_log", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "mensalidade_loglist.php", 30, "", AllowListMenu('{5CB0D3D1-109E-4D29-B3C6-8A932EF252A0}mensalidade_log'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(4, "mi_cliente_log", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "cliente_loglist.php", 30, "", AllowListMenu('{5CB0D3D1-109E-4D29-B3C6-8A932EF252A0}cliente_log'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(6, "mi_mensalidade", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "mensalidadelist.php", 30, "", AllowListMenu('{5CB0D3D1-109E-4D29-B3C6-8A932EF252A0}mensalidade'), FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>