<?php 
	session_start();
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
		<title>Portal - Cambios323</title>
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
		<script src="assets/js/func.js"></script>
		<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

		<style type="text/css">

		/* Style all input fields */
		input {
		  margin-top: 10px;
		}
		/* Style the reset button */
		input[type=reset] {
		  background-color: #CCCCCC;
		 
		}

	</style>

	</head>

	<body bgcolor="white">

	<?php
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
			
			$imagen_perfil = '<img src="images/LoginUserDefault.png" alt="" />';
			$titulo_nombre = $_SESSION['name'];
			$subtitulo_info = "<a href='logout'>Salir</a>";
			$user_email = $_SESSION['name'];
			
			$msg_new_acc = "";
			$msg_acc_email = "";
			$msg_login = "";

			$now = time();            

			if ($now > $_SESSION['expire']){
			    header('Location: ../cambios/logout');
			}
		
	?>

		<!-- Header -->
			<div id="header">

				<div class="top">

					<!-- Logo -->
						<div id="logo">
							<span class="image avatar64">
								<?php echo $imagen_perfil; ?>
							</span>
							
							<h1 id="title">
								<?php echo $titulo_nombre; ?>
							<p>
								<h5>
									<?php echo $subtitulo_info; ?>
								</h5>
							</p>
						</div>

					<!-- Nav -->
						<nav id="nav">
							
							<ul>
							

							<!--<li>&nbsp;</li>-->

							<?php 
								//if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
							?>
								
								<li><a href="../cambios/userportal" id="perfil-link" class="skel-layers-ignoreHref"><span class="icon fa-user">Portal de usuario</span></a></li>


							<?php	
								//} 

							?>

								<li>&nbsp;</li>
								<li><a href="../cambios" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home">Regresar al Inicio</span></a></li>
								
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
	<section id="top" class="one dark cover">
		<div class="container">

			<header>
				Detalles de la Orden
			</header>

			<?php

				if (isset($_POST['tipopersona']) && !empty($_POST['tipopersona']) and 
					isset($_POST['name']) && !empty($_POST['name']) and
					isset($_POST['tipodocumento']) && !empty($_POST['tipodocumento']) and
					isset($_POST['documento']) && !empty($_POST['documento']) and
					isset($_POST['banco']) && !empty($_POST['banco']) and
					isset($_POST['tipodecuenta']) && !empty($_POST['tipodecuenta']) and
					isset($_POST['cuenta']) && !empty($_POST['cuenta']) and
					isset($_POST['monto']) && !empty($_POST['monto']) ) {

						$tipopersona = $_POST['tipopersona'];
						$name = $_POST['name'];
						$tipodocumento = $_POST['tipodocumento'];
						$documento = $_POST['documento'];
						$banco = $_POST['banco'];
						$tipodecuenta = $_POST['tipodecuenta'];
						$cuenta = $_POST['cuenta'];
						$monto = $_POST['monto'];
						$comentario = "";

						if (isset($_POST['comentario']) && !empty($_POST['comentario'])) {
								$comentario = $_POST['comentario'];
							}


					
					$user_email = $_SESSION['email'];

					$time = time();
					//echo "<br><br>".date("d-m-Y | h:i a", $time);

					echo '<header>';
					
					
					include 'conn.php';

					$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

					// Check connection
					if (!$conn) {
						die("Connection failed: " . mysqli_connect_error());
					}

					// Orden
					$query = "INSERT INTO ordenes (user_email, name_type, name, doc_type, doc_number, bank, acc_type, acc_number, amount, tiempo, comment) 
								VALUES ('$user_email', '$tipopersona', '$name','$tipodocumento','$documento','$banco','$tipodecuenta','$cuenta','$monto','$time','$comentario')";

					if (mysqli_query($conn, $query)) {

						$id = mysqli_insert_id($conn);
						echo 	'<p>Orden creada exitosamente.</p>'.
								'<p>Orden n&uacute;mero: '.str_pad(intval($id), 8, '0', STR_PAD_LEFT).'</p>'.
								'<br>
								<form action="generarpdf" method="POST" target="_blank">
									<input id="time" name="time" type="hidden" value='.'"'.$time.'"'.'>
									<input id="id" name="id" type="hidden" value='.'"'.$id.'"'.'>
									<input id="tipopersona" name="tipopersona" type="hidden" value='.'"'.$tipopersona.'"'.'>
									<input id="name" name="name" type="hidden" value='.'"'.$name.'"'.'>
									<input id="tipodocumento" name="tipodocumento" type="hidden" value='.'"'.$tipodocumento.'"'.'>
									<input id="documento" name="documento" type="hidden" value='.'"'.$documento.'"'.'>
									<input id="banco" name="banco" type="hidden" value='.'"'.$banco.'"'.'>
									<input id="tipodecuenta" name="tipodecuenta" type="hidden" value='.'"'.$tipodecuenta.'"'.'>
									<input id="cuenta" name="cuenta" type="hidden" value='.'"'.$cuenta.'"'.'>
									<input id="monto" name="monto" type="hidden" value='.'"'.$monto.'"'.'>
									<input id="comentario" name="comentario" type="hidden" value='.'"'.$comentario.'"'.'>
									<input type="submit" value="Descargar">
								</form>';

					}else{
						echo "La orden no pudo ser creada. <a href='../cambios/userportal'> [ Volver a intentar ]</a>";
					}


					echo '</header> <footer>';

					// Cuenta guardad
					if (isset($_POST['guardarCta']) && !empty($_POST['guardarCta'])){


						if ($_POST['guardarCta'] == 1 || $_POST['guardarCta'] == '1'){

							$search = mysqli_query($conn, "SELECT id FROM cuentas_guardadas WHERE acc_number = '$cuenta'") or die ("Problemas al verificar en cuentas guaradas".mysqli_error($conn));
													    	
					    	$match = mysqli_num_rows($search);


						    if ($match > 0){
						    	echo "La cuenta ya ha sido guardada anteriormente.";

						    }else{

								$query = "INSERT INTO cuentas_guardadas (user_email, name_type, name, doc_type, doc_number, bank, acc_type, acc_number, comment) 
											VALUES ('$user_email', '$tipopersona', '$name','$tipodocumento','$documento','$banco','$tipodecuenta','$cuenta','$comentario')";
								
								if (mysqli_query($conn, $query)) {

									$id = mysqli_insert_id($conn);
									echo '<p>Cuenta guarada exitosamente.</p>';

								}else{
									echo "La cuenta no pudo ser guardada.";
								}
							}
						}

					}


				mysqli_close($conn);	
				
				}else{
					echo "Datos no recibidos. <a href='../cambios/userportal'> [ Regresar ]</a>";
				}

			?>

			</footer>


		</div>
	</section>


</div><!-- end main -->
			

	<!-- Footer -->
		<div id="footer">

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

<?php
}else{
			header('Location: ../cambios/logout');

			echo "<center>Permiso denegado debe iniciar sesi&oacute;n.".
				 "<p><a href='../cambios/logout'>[ Regresar ]</a></p></p></center>"; //porsia
		}

?>


	</body>
</html>