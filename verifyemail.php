<?php 
	session_start();
	$isin = false;
?>

<!DOCTYPE HTML>
<!--
	Telegram: @t323factory || Instagram: @323factory
	
	flag_colors {
		Yellow: #FBD116 
		Blue: #22408C
		Red: #CE2028
	}
-->
<html>
	<head>
		<title>Verificaci&oacute;n de cuenta - Cambios323</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="author" content="323factory" />
		<meta name="copyright" content="323factory.com" />
		<meta name="rating" content="general">
		<meta name="creation_Date" content="Ene/28/2021" />
		<meta name="doc-rights" content="Public" />
		<link href="images/apple-touch-icon.png" rel="apple-touch-icon" sizes="180x180">
		<link href="images/favicon-32x32.png" rel="icon" sizes="32x32" type="image/png">
		<link href="images/favicon-16x16.png" rel="icon" sizes="16x16" type="image/png">
		<link href="images/site.webmanifest" rel="manifest">
		<link rel="stylesheet" href="assets/css/main.css" />
		<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
		<link rel="stylesheet" href="assets/css/index.css" />



	</head>

	<body>


<!-- Header -->
	<div id="header">
		<div class="top">

			<!-- Logo -->
				<div id="logo">
					<span class="image avatar64">
						<img src="images/LogoCambios323x64.png" alt="" />
					</span>
					<h1 id="title"> Cambios323 <p>
					<h5> R&aacute;pido & Seguro </h5>
					</p>
				</div>

			<!-- Nav -->
				<nav id="nav">
					<ul>
						<li><a href=" ../cambios/" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home"> P&aacute;gina Principla</span></a></li>
					</ul>
				</nav>

		</div>

		<div class="bottom">

			<!-- Social Icons -->
				<ul class="icons">
					<li><a href="https://t.me/t323factory" class="icon fa-comment" style="color:#FBD116;" target="_blank"><span class="label">Telegram</span></a></li>
					<li><a href="https://www.instagram.com/323factory/" class="icon fa-instagram"  style="color:#22408C"; target="_blank"><span class="label">Instagram</span></a></li>
					<li><a href="https://wa.link/ri3m4b" class="icon fa-whatsapp" target="_blank"><span class="label">Whatsapp</span></a></li>
				</ul>

		</div>

	</div>


	<!-- Main -->

	
	<div id="main" >

	<!-- Intro -->
		<section id="top" class="one dark cover" style="height: 80vh;">
			<div class="container">

				<header>
					<strong>Verificaci&oacute;n de cuenta</strong>
				</header>


					<div style="background: #22408C; color: #ffffff;">
					<?php 
						
						include 'conn.php';

						$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

						// Check connection
						if (!$conn) {
							die("Connection failed: " . mysqli_connect_error());
						}
             
						if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
						    // Verify data
						    $email = mysqli_real_escape_string($conn, $_GET['email']); // Set email variable
						    $hash = mysqli_real_escape_string($conn, $_GET['hash']); // Set hash variable
						    
						    $query = "SELECT Email, Hash, Active FROM users WHERE Email='".$email."' AND Hash='".$hash."' AND Active='0'";

						   	$search = mysqli_query($conn, $query) or die ("Problemas al buscar".mysqli_error($conn));
						    	
					    	$match = mysqli_num_rows($search);
					                  
						    if($match > 0){

						    	//cambiamos el hash por precaución
							    $new_hash = md5( rand(0,1000) );

						        // We have a match, activate the account
						        $query = "UPDATE users SET Active='1', Hash='$new_hash' WHERE Email='".$email."' AND Hash='".$hash."' AND Active='0'";

						        if (mysqli_query($conn, $query)){
						        	echo 'Cuenta activada exitosamente. Ya puedes ingresar.';

						        }else{
						        	echo 'Error al activar la cuenta. Volver a intentar. En caso de persistir comunicarse con nosotros.</div>';
						        }

						    }else{
						        // No match -> invalid url or account has already been activated.
						        echo 'Error: La URL no es v&aacute;lida o ya fue activada.';
						    }	
					                  
						}else{
						    // Invalid approach
						    echo 'Enlace no v&aacute;lido, utilice el enlace que se ha enviado a su correo electr&oacute;nico.';
						}

					?>

				</div>



				<footer>
					<p><a href=" ../cambios/" >[ Ir a la p&aacute;gina principal ]</a></p>
				</footer>
			</div>
		</section>

	<!-- Sobre Cambios 323 --
		<section id="aboutus" class="two">
			<div class="container">
				<header>
				</header	
			</div>
		</section>-->

</div>
			
		<!-- Footer -->
			<div id="footer" style="height: 20vh;">

				<!-- Copyright -->
					<ul class="copyright">
						<small><li>Todos los derechos reservados</li><li><a href="https://www.323factory.com">323factory</a></li></small>
					</ul>

			</div>


			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollzer.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
	</body>
</html>