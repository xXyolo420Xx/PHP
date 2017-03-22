<html>
<head>
	<title>Vapeadores</title>
	<meta charset="utf8">
	<script src='view/js/funciones.js'></script>
	<script src='view/js/jquery-3.1.1.min.js'></script>
	<script src='view/js/jquery-ui.min.js'></script>
	<link href='view/js/jquery-ui.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="view/css/bootstrap.min.css">
	<script src="view/js/bootstrap.min.js"></script>

</head>
<body>
	<header>
			<nav class='navbar navbar-default'>
				<div class='container-fluid'>
					<div class='navbar-header'>
						<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar1'>
							<span class='sr-only'>Menu</span>
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>
							<span class='icon-bar'></span>
						</button>
						<a class='navbar-brand' href='#'>MVC Simeon Shopov</a>
					</div>
					<div class='collapse navbar-collapse' id='navbar1'>
						<ul class='nav navbar-nav'>
							<li><a href='?pag=info'>¿Qué son?</a></li>
							<li><a href='?pag=atomizadores'>Atomizador</a></li>
							<li><a href='?pag=mods'>Mod</a></li>
							<li><a href='?pag=pilas'>Pilas</a></li>
							<li><a href='?pag=cargadores'>Cargador</a></li>
						</ul>
						<?php if(empty($_SESSION['user'])){ ?>
						<a href='?pag=login'><button class="btn btn-success navbar-btn">Login</button></a>
						<a href='?pag=register'><button class="btn btn-info navbar-btn">Registrarse</button></a><?php }else{ ?>
						<span class="label label-success"><?php echo $_SESSION['user'] ?></span>
						<span class="label label-info"><?php echo $_SESSION['lastlogin'] ?></span>
						<a href='?pag=logout'><button class="btn btn-danger navbar-btn">Salir</button></a>

						<?php } ?>
					</div>
				</div>
			</nav>
		</header>


	<div class='container'>
	<?php echo $content; ?>
	</div>

</body>
	
</html>