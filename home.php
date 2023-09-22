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
$home = new home();

// Run the page
$home->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<div class="container mt-4">
	<div class="row">
		<div class="col-md-4">
			<div class="card h-100" style="width: 18rem;">
				<img src="https://cdn.pixabay.com/photo/2021/10/09/16/38/gym-6694666_1280.png" class="card-img-top img-fluid" style="height: 200px;">
				<div class="card-body">
					<h5 class="card-title">Cadastrar Professor</h5>
					<p class="card-text">Clique no botão abaixo para cadastrar um novo professor em nossa academia.</p>
					<a href="https://localhost/sistema_academia/professorlist.php" class="btn btn-primary">Cadastrar</a>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card h-100" style="width: 18rem;">
				<img src="https://cdn.pixabay.com/photo/2017/03/31/17/39/avatar-2191918_1280.png" class="card-img-top img-fluid" style="height: 200px;">
				<div class="card-body">
					<h5 class="card-title">Cadastrar Clientes</h5>
					<p class="card-text">Clique no botão abaixo para cadastrar um novo cliente em nossa academia.</p>
					<a href="https://localhost/sistema_academia/clientelist.php" class="btn btn-primary">Cadastrar</a>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="card h-100" style="width: 18rem;">
				<img src="https://cdn.pixabay.com/photo/2017/06/10/06/39/calender-2389150_1280.png" class="card-img-top img-fluid" style="height: 200px;">
				<div class="card-body">
					<h5 class="card-title">Gerenciar Agenda</h5>
					<p class="card-text">Clique no botão abaixo para acessar e gerenciar a agenda da academia.</p>
					<a href="https://localhost/sistema_academia/agendalist.php" class="btn btn-primary">Gerenciar</a>
				</div>
			</div>
		</div>
	</div>
</div>


<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$home->terminate();
?>