<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>CCB</title>

	<!-- CSS Files -->
	<link rel="stylesheet" href="<?= URL ?>/node_modules/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= URL ?>/node_modules/jquery.growl/stylesheets/jquery.growl.css">
	<link rel="stylesheet" href="<?= URL ?>/css/jquery-ui.css">
	<link href="<?= URL ?>/node_modules/summernote/dist/summernote-bs4.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<link rel="stylesheet" href="<?= URL ?>/css/style4.css">
</head>

<body>

	<div class="wrapper">
		<!-- Sidebar Holder -->
		<nav id="sidebar">
			<div style=" padding: 20px;">
			
				<img src="img/CCB.png" style="width: 100%;">
			</div>
			<ul class="list-unstyled components">
				<li><a href="<?= URL ?>/inicio"><strong>Inicio</strong></a></li>
				<li><a href="<?= URL ?>/novo_evento"><strong>Novo serviço</strong></a></li>
				<li><a href="<?= URL ?>/nova_comum"><strong>Nova Comum</strong></a></li>
			</ul>
		</nav>

		<!-- Page Content Holder -->
		<div id="content">
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn" style="background-color: #033D60;">
					<i class="fas fa-bars"></i><span></span>
				</button>
				<div class="collapse navbar-collapse justify-content-end" id="navbarNav">
					<ul class="navbar-nav">
						<li class="nav-item">
						</li>
					</ul>
				</div>
			</nav>
			<div class="container">
				<!-- conteudo -->
				<?= $this->section('content') ?>
				<!-- conteudo -->
			</div>
		</div>
	</div>
	<!-- Javascript files-->
	<script src="<?= URL ?>/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="<?= URL ?>/node_modules/jquery.growl/javascripts/jquery.growl.js"></script>
	<script src="<?= URL ?>/js/jquery-ui.js"></script>
	<script src="<?= URL ?>/js/funcoes_novoevento.js"></script>
	<script src="<?= URL ?>/js/datepicker-pt-BR.js"></script>
	<script src="<?= URL ?>/node_modules/jquery-validation/dist/jquery.validate.min.js"></script>
	<script src="<?= URL ?>/node_modules/popper.js/dist/umd/popper.min.js"></script>
	<script src="<?= URL ?>/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?= URL ?>/node_modules/summernote/dist/summernote-bs4.js"></script>
	<script src='<?= URL ?>/node_modules/fullcalendar/index.global.js'></script>
</body>
<?= $this->section('js') ?>

</html>