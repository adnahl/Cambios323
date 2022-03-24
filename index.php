<?php 
	session_start();
	$msg_new_acc = "";
	$msg_acc_email = "";
	$msg_login = "";
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
	<title>Cambios323</title>
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
	<link rel="stylesheet" href="assets/css/index.css" />


<!--<script type="text/javascript">	/*window.onload=function(){	myModal1.style.display = "block"; };*/ </script>-->

</head>

<body>


<?php
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		
		$titulo_nombre = $_SESSION['name'];
		$subtitulo_info = "<a href='logout'>Salir</a>";
		
		$now = time();            

		if ($now > $_SESSION['expire']){

		    session_destroy();
		    $msg_login = "Su sesi&oacute;n ha expirado.";

		    $titulo_nombre = "Cambios323";
			$subtitulo_info = "R&aacute;pido & Seguro";

		    //exit;
		}
	
	}else{

		$titulo_nombre = "Cambios323";
		$subtitulo_info = "R&aacute;pido & Seguro";


//Verificamos si viene de un registro nuevo
// si es así, validamos y guardamos

if (isset($_POST['name']) && !empty($_POST['name']) AND 
isset($_POST['email']) && !empty($_POST['email']) AND
isset($_POST['password']) && !empty($_POST['password'])) {

	include 'conn.php';

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	// Query to check if the email already exist
	$checkEmail = "SELECT * FROM users WHERE Email = '$_POST[email]' ";

	// Variable $result hold the connection data and the query
	$result = $conn-> query($checkEmail);

	// Variable $count hold the result of the query
	$count = mysqli_num_rows($result);

	// If count == 1 that means the email is already on the database
	if ($count == 1) {
		$msg_new_acc = "El Email ingresado ya existe (<span class='topmsg'>Puede recuperar la contrase&ntilde;a si no la recuerda</span>).";

	} else {
		$email = strtolower($_POST['email']); //minusculas

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			// Return Error - Invalid Email
			$msg_new_acc = "La cuenta no pudo ser creada. <span class='topmsg'>Email no v&aacute;lido.</span>";
		}else{

			// Validate password strength

			$pass = $_POST['password'];

			$uppercase = preg_match('@[A-Z]@', $pass);
			$lowercase = preg_match('@[a-z]@', $pass);
			$number    = preg_match('@[0-9]@', $pass);
			$specialch = preg_match('@[^\w]@', $pass);

			if(!$uppercase || !$lowercase || !$number || !$specialch || strlen($pass) < 8) {
				$msg_new_acc = "La cuenta no pudo ser creada. <small>La contrase&ntilde;a debe ser de al menos 8 caracteres, incucluir almenos una letra min&uacute;scula, una letra may&uacute;scula, un n&uacute;mero y un car&aacute;cter especial.</small>"; 
				//'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';

			} else { // Return to Success

				$name = ucwords(strtolower($_POST['name'])); //Capitalize

				// The password_hash() function convert the password in a hash before send it to the database
				$passHash = password_hash($pass, PASSWORD_DEFAULT);
				
				// Generate random 32 character hash and assign it to a local variable.
				$hash = md5( rand(0,1000) );


				//User IP
				/* function getUserIpAddress() { */

					$userIP = '0';
				    foreach ( [ 'HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR' ] as $key ) {

				        // Comprobamos si existe la clave solicitada en el array de la variable $_SERVER 
				        if ( array_key_exists( $key, $_SERVER ) ) {

				            // Eliminamos los espacios blancos del inicio y final para cada clave que existe en la variable $_SERVER 
				            foreach ( array_map( 'trim', explode( ',', $_SERVER[ $key ] ) ) as $ip ) {

				                // Filtramos* la variable y retorna el primero que pase el filtro
				                if ( filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) !== false ) {
				                    $userIP = $ip; //return $ip;
				                }
				            }
				        }
				    }

				/*    return '?'; // Retornamos '?' si no hay ninguna IP o no pase el filtro
				} */

				$phone = "";
				$instagram = "";
				$telegram = "";
				$whatsapp = "";

				if (isset($_POST['phone']) && !empty($_POST['phone'])){
					$phone = $_POST['phone'];
				}
				if (isset($_POST['instagram']) && !empty($_POST['instagram'])){
					$instagram = $_POST['instagram'];
				}
				if (isset($_POST['telegram']) && !empty($_POST['telegram'])){
					$telegram = $_POST['telegram'];
				}
				if (isset($_POST['whatsapp']) && !empty($_POST['whatsapp'])){
					$whatsapp = $_POST['whatsapp'];
				}
				

				// Query to send Name, Email and Password hash to the database
				$query = "INSERT INTO users (Name, Email, Password, Hash, Phone, Instagram, Telegram, Whatsapp, IP)
					 VALUES ('$name', '$email', '$passHash','$hash','$phone','$instagram','$telegram','$whatsapp','$userIP')";

				if (mysqli_query($conn, $query)) {
					$msg_new_acc = "Cuenta creada exitosamente. Por favor verifique el enlace enviado al email " . $email . " para activar la cuenta.";

					//Enviar el email
					$to      = $email;
					$subject = 'Verificar el registro - Cambios323';
					$message = '

					Gracias por registrarse.

					Su cuenta ha sido creada exitosamente, puede ingresar despues de validar su cuenta con las siguientes credenciales:

					------------------------
					Email: '.$email.'
					Password: '.$pass.'
					------------------------

					Haga click en el siguiente enlace (o copie y pegue en un navegador) para activar su cuenta:
					http://localhost/cambios/verifyemail?email='.$email.'&hash='.$hash.''; 
					                  
					$headers = 'From:noreply@323factory.com' . "\r\n"; // Set from headers
					$enviado = mail($to, $subject, $message, $headers); // Send our email

					if ($enviado)
						$msg_acc_email = 'Email enviado exitosamente.';
					else
						$msg_acc_email = 'Error al enviar el enlace de activaci&oacute;n al email.';

				} else {

					$msg_new_acc = "Error: " . $query . "<br>" . mysqli_error($conn);

				}	
	
				/* EXAMPLE
					http://localhost/cambios/resetpassword?email=adnahl@gmail.com&hash=7143d7fbadfa4693b9eec507d9d37443
				*/
		}
	}
}

mysqli_close($conn);


// login	
} else if (isset($_POST['email_login']) && !empty($_POST['email_login']) AND
			isset($_POST['password_login']) && !empty($_POST['password_login'])) {

	include 'conn.php';

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	// Check connection
	if (!$conn) {
		$msg_login = die("Connection failed: " . mysqli_connect_error());
		exit;
	}

	// data sent from login form
		$email = $_POST['email_login']; 
		$password = $_POST['password_login'];
		
		// Query sent to database
		$result = mysqli_query($conn, "SELECT Email, Password, Name FROM users WHERE Email = '$email'");
		
		// Variable $row hold the result of the query
		$row = mysqli_fetch_assoc($result);

		if($row){
		
			// Variable $hash hold the password hash on database
			$hash = $row['Password'];

			/* 
			password_Verify() function verify if the password entered by the user
			match the password hash on the database. If everything is ok the session
			is created for ten minute.
			*/
			if (password_verify($_POST['password_login'], $hash)) {	
				
				$_SESSION['loggedin'] = true;
				$_SESSION['name'] = $row['Name'];
				$_SESSION['email'] = $row['Email'];
				$_SESSION['start'] = time();
				$_SESSION['expire'] = $_SESSION['start'] + (30 * 60); //30min
				
				$msg_login = "Hola " . $_SESSION['name'] . ", bienvenido.<br><a href='userportal' style='background:#FBD116;'>&nbsp;Ir al Portal de usuario&nbsp;</a>";

				/*$imagen_perfil = '<img src="images/LoginUserDefault.png" alt="" />';*/
				$titulo_nombre = $_SESSION['name'];
				$subtitulo_info = "<a href='logout'>Salir</a>";
			
			} else {
				$msg_login = "Inicio de sesi&oacute;n no exitoso. &iexcl;Email o Contrase&ntilde;a incorrecta!";
			}	

			mysqli_close($conn);

		}else{
				$msg_login = "Inicio de sesi&oacute;n no exitoso. &iexcl;Email o Contrase&ntilde;a incorrecta!";
				mysqli_close($conn);
			}	

	//TODOS antes del loggin
	} else if (isset($_POST['email_recuperar']) && !empty($_POST['email_recuperar'])) {

		// Email
		$email = $_POST['email_recuperar'];

		include 'conn.php';
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		// Query to check if the email already exist
		$checkEmail = "SELECT * FROM users WHERE Email = '$email' ";

		// Variable $result hold the connection data and the query
		$result = $conn-> query($checkEmail);

		// Variable $count hold the result of the query
		$count = mysqli_num_rows($result);

		// If count == 1 that means the email exist
		if ($count == 1) {

			// Generate random 32 character hash and assign it to a local variable.
			$hash = md5( rand(0,1000) );

			// Query to send Name, Email and Password hash to the database
			$query = "UPDATE users SET Hash='$hash', New_password = '1' WHERE Email = '$email'";

			if (mysqli_query($conn, $query)) {
				$msg_new_acc = "Verifique el enlace enviado al email " . $email . " para reiniciar la contrase&ntilde;a.";

				//Enviar el email
				$to      = $email;
				$subject = 'Reiniciar contraseña - Cambios323';
				$message = '

				Haga click en el siguiente enlace (o copie y pegue en un navegador) para reiniciar la contrase&ntilde;a:
				http://localhost/cambios/resetpassword?email='.$email.'&hash='.$hash.'';

				//Ej. http://localhost/cambios/resetpassword?email=adnahl@gmail.com&hash=f61d6947467ccd3aa5af24db320235dd

				                  
				$headers = 'From:noreply@323factory.com' . "\r\n"; // Set from headers
				$enviado = mail($to, $subject, $message, $headers); // Send our email

				if ($enviado)
					$msg_acc_email = 'Email enviado exitosamente. ';
				else
					$msg_acc_email = 'Error al enviar el email para el reinicio de la contrase&ntilde;a.';


			}else{
				$msg_acc_email = 'Error al enviar el email para el reinicio de la contrase&ntilde;a.';
			}

		} else {
			$msg_acc_email = 'Error: email no registrado.';
		}

	}else{
		//$msg_login = "&iexcl;Email o Contrase&ntilde;a no recibida!"; => inicio
	}


//else no ha iniciado sesión
} 

?>

	<!-- Header -->
		<div id="header">

			<div class="top">

				<!-- Logo -->
					<div id="logo">
						<span class="image avatar64">
							<!-- <php echo $imagen_perfil; > -->
							<img src="images/LogoCambios323x64.png" alt="" />
						</span>
						
						<h1 id="title">
							<?php $solo_nombre = explode(" ", $titulo_nombre);
									  echo $solo_nombre[0]; ?>
						<p>
							<h5>
								<?php echo $subtitulo_info; ?>
							</h5>
						</p>
					</div>

				<!-- Nav -->
					<nav id="nav">
						
						<ul>
						

						<?php 

							if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

								echo '<li><a href="userportal" id="login-link" class="skel-layers-ignoreHref"><span class="icon fa-user">Portal de usuario</span></a></li>
									<li>&nbsp;</li>';
							
							} 

						?>

							<li><a href="#top" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home">Inicio</span></a></li>
							<li><a href="#aboutus" id="aboutus-link" class="skel-layers-ignoreHref"><span class="icon fa-book">Nosotros</span></a></li>
							<li><a href="#faq" id="faq-link" class="skel-layers-ignoreHref"><span class="icon fa-question">FAQ</span></a></li>
							<li><a href="#contactanos" id="contactanos-link" class="skel-layers-ignoreHref"><span class="icon fa-envelope">Contactanos</span></a></li>
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

<!-- Mensaje al registrarse -->

<?php 

if ($msg_new_acc != "" || $msg_acc_email != "") {
	echo "<div id='topMSG' align='center'>".
		$msg_new_acc . "<br>" . $msg_acc_email . 
		"<br><button id='hider' style='margin-bottom: 100px;'>Cerrar</button>".
		"</div>";

} else if ($msg_login != "") {
	echo "<div id='topMSG' align='center'>".
		$msg_login .
		"<br><button id='hider' style='margin-bottom: 100px;'>Cerrar</button>".
		"</div>";

		/*udBCW7CBbrCc7XV*/
}

?>




<?php

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	//ocultar menu top
} else {
	
?>

	<div id="topMenu" align="right"> <!-- <div id="topMenu"-->


		<!--<button type="button" id="myBtn_modal" style="margin: 10px 10px;">
			<span class="icon fa-2x fa-edit"></span>
		</button>-->

		<button class="modal-button" href="#myModal1" style="padding: 15px; margin: 10px 10px;">
			<!--<span class="icon fa-2x fa-edit"></span>-->
			Registrarse
		</button>

		<!--<button id="myBtn_modal">Open Modal</button>-->

		<!-- The Modal -->
		<div id="myModal1" class="modal">

  		<!-- Modal content -->
		  <div class="modal-content" align="center">
		    <span class="close_modal">&times;</span>
		    <p>
		      
		    <h2>Registrarse</h2>

					<form action="index" method="POST" class="regForm">
					<div class="row">

						<div class="6u	12u$(mobile)">
							<input type="text" name="name" id="name" placeholder="Nombre Apellido" onkeypress="return check(event)" maxlength=62 required> <p></p>
						</div>

						<div class="6u$ 12u$(mobile)">
							<input type="email" name="email" id="email" aria-describedby="emailHelp" placeholder="E-mail" maxlength=62 onkeyup='check_pass();' required>
							<p align="left"><span id='messageEmail'></span></p>
						</div>

						<div class="6u	12u$(mobile)">
							<input type="password" name="password" id="password" placeholder="Contrase&ntilde;a" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w]).{8,}" onkeyup='check_pass();' maxlength=14 required/> <p></p>
							
							<div align="left" id="PasswordMessage">
							  <b>Requisitos m&iacute;nimos:</b>
							  <p id="letter" class="invalid">Una letra min&uacute;scula</p>
							  <p id="capital" class="invalid">Una letra may&uacute;scula</p>
							  <p id="number" class="invalid">Un n&uacute;mero</p>
							  <p id="especialChar" class="invalid">Un car&aacute;cter especial</p>
							  <p id="length" class="invalid">8 caracteres</p>
							</div>
						</div>

						<div class="6u$ 12u$(mobile)">
							<input type="password" name="confirm_password" id="confirm_password" placeholder="Validar Contrase&ntilde;a" onkeyup='check_pass();' maxlength=12 required/>
							<p align="left"><span id='message'></span></p>
						</div>

						<div class="12u$">- Opcional -</div>


						<div class="6u	12u$(mobile)">
							<input type="text" name="phone" id="phone" placeholder="Tel&eacute;fono" onkeypress="return check_number(event)" maxlength=62>
						</div>

						<div class="6u$	12u$(mobile)">
							<input type="text" name="whatsapp" id="whatsapp" placeholder="Whatsapp" onkeypress="return check_number(event)" maxlength=62>
						</div>

						<div class="6u	12u$(mobile)">
							<input type="text" name="telegram" id="telegram" placeholder="Telegram" maxlength=62> <p></p>
						</div>

						<div class="6u$	12u$(mobile)">
							<input type="text" name="instagram" id="instagram" placeholder="Instagram" maxlength=62> <p></p>
						</div>


						<div class="6u	12u$(mobile)">
							<input type="submit" name="submit" value="Crear cuenta" id="submit" disabled>
						</div>

						<div class="6u$ 12u$(mobile)">
							<input type="reset" name="Reset">
						</div>

					</div>
				</form>

		    </p>
		  </div>

		</div>

		<button class="modal-button" href="#myModal2" style="padding: 15px; margin: 10px 10px;">
			<!--<span class="icon fa-2x fa-user"></span>-->
			Ingresar
		</button>


		<!--<button id="myBtn_modal">Open Modal</button>-->

		<!-- The Modal -->
		<div id="myModal2" class="modal">

  		<!-- Modal content -->
		  <div class="modal-content" align="center">
		    <span class="close_modal">&times;</span>
		    <p>


				<h2>Iniciar sesi&oacute;n</h2>

				<form action="index" method="POST" class="loginForm">
				<div class="row">

				<div class="6u 12u$(mobile)">
					<input type="email" name="email_login" id="email_login" aria-describedby="emailHelp" placeholder="E-mail" maxlength=62 required>
				</div>

				<div class="6u$	12u$(mobile)">
					<input type="password" name="password_login" id="password_login" placeholder="Contrase&ntilde;a" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w]).{8,}" maxlength=14 required/> <p></p>
				</div>

				<div class="6u 12u$(mobile)">
					<input type="submit" name="submit_login" value="Ingresar" id="submit_login" >
				</div>
				<div class="6u$ 12u$(mobile)">
						<input type="reset" name="Reset">
					</div>

				<div class="6u 12u$(mobile)">
					<button class="modal-button" href="#myModal4" style="background-color: #CCCCCC; padding: 5px; margin: 5px 5px;">
						Recuperar contrase&ntilde;a
					</button>
					<!--<small><i><a class="modal-button" href="#myModal4">Olvido la contrase&ntilde;a</a></i></small>-->
				</div>

				</div>
				</form>

			</p>
		  </div>

		</div>


		<div id="myModal4" class="modal">

  		<!-- Modal content -->
		  <div class="modal-content" align="center">
		    <span class="close_modal">&times;</span>
		    <p>


				<h2>Recuperar Contrase&ntilde;a</h2>

				<form action="index" method="POST" class="loginForm">
				<div class="row">

					<div class="6u 12u$(mobile)">
						<input type="email" name="email_recuperar" id="email_recuperar" aria-describedby="emailHelp" placeholder="E-mail" maxlength=62 required>
					</div>

					<div class="6u 12u$(mobile)">
						<input type="submit" name="submit_recuperar" value="Recuperar" id="submit_recuperar" >
					</div>
					
				</div>
				</form>

			</p>
		  </div>

		</div>




		</div><!-- topMenu -->

<?php
}
?>


<div id="main" >

<!-- Intro -->
	<section id="top" class="one dark cover">
			<div class="container">
				
				<!--<span id="holatop" name="holatop" style="position: fixed; z-index: 999; top: 4px;">Hola</span>-->

				<header>
					<img src="images/logoR_fondo.png" alt="" style="padding-bottom: 15px;" />
					<p>


					<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
								echo '<h5 class="typed">¡Cambie de manera rápida y segura!</h5>';

						 } else { ?>

						 <script src="assets/js/dist/typer.min.js"></script>

						<h5 id="info_anim" style="color: #FBD116;"></h5>
						<script type="text/javascript">
							$("#info_anim").typer({
								strings: [
									"↗ Registrarse ↗",
									"¡Cambie de manera rápida y segura!",
									"↗ Iniciar sesión ↗"
								]
							});
						</script>

					<?php } ?>

					</p>

					<hr>
					<p><h3 class="alt">Tasa actual: <span style="font-weight: bolder;">0.0025</span></h3></p>
					<hr>
					</header>

				<footer>


		<button class="modal-button" href="#myModal3" style="padding: 15px; margin: 10px 10px;">
			<!--<span class="icon fa-2x fa-edit"></span>-->
			+ CALCULADORA +
		</button>

		<!--<button id="myBtn_modal">Open Modal</button>-->

		<!-- The Modal -->
		<div id="myModal3" class="modal">

  		<!-- Modal content -->
		  <div class="modal-content" align="center">
		    <span class="close_modal">&times;</span>
			    <p>
			      
			    	<h2>Calculadora</h2>

			    	<p>Tasa actual: 0.0025</p>
			    	<p style="background: #FBD116;">$ <span id="minicop"> 100.000</span> = Bs <span id="miniven">40.000.000</span></p>
			    	<br>


			    	<div align="center" >
						<form>
						<div class="12u$" style="max-width: 400px;">
						<input type="text" id="COP" name="COP" placeholder="Pesos" style="text-align: right;"
							onkeyup="coptoven(this.value)" onchange="coptoven(this.value)"/>
						</div>

						<div class="12u$" style="max-width: 400px;">
						<input type="text" id="VEN" name="VEN" placeholder="Bolivares" style="text-align: right;"
						 	onkeyup="ventocop(this.value)" onchange="ventocop(this.value)"/>
						</div>
						</form>

					<br>
					<p style="font-weight: lighter;"><i>Puede <u>ingresar</u> el monto en <u>Pesos</u> o en <u>Bolivares</u> para calcular su relaci&oacute;n en la otra divisa.</i></p>
					</div>
				 
				</p>
			</div>
		</div>

				</footer>





			</div>
		</section>

<!-- Sobre Cambios 323 -->
	<section id="aboutus" class="two">
		<div class="container">

			<header>
				<h2>&iquest;Qu&eacute; es Cambios 323?</h2>
			</header>

			<p>Es un servicio confiable para el env&iacute;o de remesas a Venezuela desde Colombia con la mejor tasa y la mayor rapidez.</p>
			
		</div>
	</section>

					

<!-- FAQ -->
	<section id="faq" class="three">
		<div class="container">

			<header>
				<h2>Preguntas frecuentes</h2>
			</header>

			<p>Consulte las preguntas frecuentes. En caso de no aclarar su duda contactenos <a href="#contactanos" class="scrolly">aqu&iacute;<a/></p>
			
			<button class="accordion">&iquest;Cu&aacute;les son las formas de pago?</button>
			<div class="panel">
			  <p>
			  <ul>
				<li><strong>&Uacute;nicamente en efectivo. En cualquiera de nuestros siguientes aliados:</strong>
					<ul>
					<li>- FotoStilo: Calle 108 # 8 - 45</li>
					<li>- Coffeecito: Calle 10 sur # 100 - 23</li>
					<li>- Todo Led Colombia: CC Galer&iacute;as, Local 103</li>
					</ul>
				</li>							  
			  </ul>
			  </p>
			</div>


			<button class="accordion">&iquest;Cu&aacute;nto tiempo se demora el env&iacute;o de las remesas?</button>
			<div class="panel">
			  <p>Entre 20 y 80 minutos</p>
			  <p>&nbsp;</p>
			</div>

			<button class="accordion">&iquest;De cu&aacute;nto tiempo dispongo para entregar el dinero luego de generar una nueva orden?</button>
			<div class="panel">
			  <p>No hay tiempo l&iacute;mite. Pero recuerde que el precio ser&aacute; el actual a la entrega del dinero.</p>
			  <p>&nbsp;</p>
			</div>

			<button class="accordion">&iquest;Debo imprimir el recibo generado por cada orden?</button>
			<div class="panel">
			  <p>No es necesario. Solamente debe indicar el n&uacute;mero de la orden antes de entregar el dinero.</p>
			  <p>&nbsp;</p>
			</div>

			
			<script>
			var acc = document.getElementsByClassName("accordion");
			var i;

			for (i = 0; i < acc.length; i++) {
			  acc[i].onclick = function() {
				this.classList.toggle("active");
				var panel = this.nextElementSibling;
				if (panel.style.maxHeight){
				  panel.style.maxHeight = null;
				} else {
				  panel.style.maxHeight = panel.scrollHeight + "px";
				} 
			  }
			}
			</script>

		</div>
	</section>


<!-- contactanos -->
	<section id="contactanos" class="two">
		<div align="center" class="container">
			
			<header>
				<h2>Contactanos</h2>
			</header>
			
			<h4>
			<span class="icon fa-whatsapp"></span>
			<a href="https://wa.link/ri3m4b">&nbsp;Whatsapp:&nbsp;Escribenos</a>
			<p>
			<span class="icon fa-comment"></span>
			<a href="https://t.me/t323factory">&nbsp;Telegram:&nbsp;@t323factory</a><br>
			</p>
			<p>&nbsp;</p>
			</h4>

			<form method="post" action="#">
				<div class="row">
					<div class="6u	12u$(mobile)"><input type="text" name="Nombre" placeholder="Nombre" /></div>
					<div class="6u$ 12u$(mobile)"><input type="text" name="Email" placeholder="Email" /></div>
					
					<div class="12u$"><input type="text" name="Asunto" placeholder="Asunto" /></div>								
					<div class="12u$">
						<textarea name="comentarios" placeholder="Comentarios"></textarea>
					</div>
					
					<div class="6u	12u$(mobile)">
						<input type="submit" value="Enviar" />
					</div>

					<div class="6u$	12u$(mobile)">
						<input type="reset" />
					</div>
				</div>
			</form>

		</div>
	</section>

</div>

		
<!-- Footer -->
	<div id="footer">

	<!-- Copyright -->
		<ul class="copyright">
			<small><li>Todos los derechos reservados</li><li><a href="https://www.323factory.com">323factory</a></li></small>
		</ul>

	</div>

<!-- Scripts -->
	<script type="text/javascript">

	//Toggle login
	var toggle=false,
	loginwindow = document.getElementById('loginWindow');

	//Toggle login
	var toggle_r=false,
	regwindow = document.getElementById('regWindow');

	//Validar contraseña
	var myInput = document.getElementById("password");
	var letter = document.getElementById("letter");
	var capital = document.getElementById("capital");
	var number = document.getElementById("number");
	var length = document.getElementById("length");

	// When the user clicks on the password field, show the message box
	myInput.onfocus = function() {
		document.getElementById("PasswordMessage").style.display = "block";
	}

	// When the user starts to type something inside the password field
	myInput.onkeyup = function() {

	var allIsOk = 0;
	var yes_allIsOk = 5;

	// Validate lowercase letters
	var lowerCaseLetters = /[a-z]/g;
	if(myInput.value.match(lowerCaseLetters)) {  
		letter.classList.remove("invalid");
		letter.classList.add("valid");
		if (allIsOk < yes_allIsOk) allIsOk++;

	} else {
		letter.classList.remove("valid");
		letter.classList.add("invalid");
		if (allIsOk > 0) allIsOk--;
	}

	// Validate capital letters
	var upperCaseLetters = /[A-Z]/g;
	if(myInput.value.match(upperCaseLetters)) {  
		capital.classList.remove("invalid");
		capital.classList.add("valid");
		if (allIsOk < yes_allIsOk) allIsOk++;

	} else {
		capital.classList.remove("valid");
		capital.classList.add("invalid");
		if (allIsOk > 0) allIsOk--;
	}

	// Validate numbers
	var numbers = /[0-9]/g;
	if(myInput.value.match(numbers)) {  
		number.classList.remove("invalid");
		number.classList.add("valid");
		if (allIsOk < yes_allIsOk) allIsOk++;

	} else {
		number.classList.remove("valid");
		number.classList.add("invalid");
		if (allIsOk > 0) allIsOk--;
	}

	// Validate especial characters
	var especialChars = /[^\w]/g;
	if(myInput.value.match(especialChars)) {  
		especialChar.classList.remove("invalid");
		especialChar.classList.add("valid");
		if (allIsOk < yes_allIsOk) allIsOk++;

	} else {
		especialChar.classList.remove("valid");
		especialChar.classList.add("invalid");
		if (allIsOk > 0) allIsOk--;
	}

	// Validate length
	if(myInput.value.length >= 8) {
		length.classList.remove("invalid");
		length.classList.add("valid");
		if (allIsOk < yes_allIsOk) allIsOk++;

	} else {
		length.classList.remove("valid");
		length.classList.add("invalid");
		if (allIsOk > 0) allIsOk--;
	}

	if (allIsOk == 5) {
		//hide the message box
		document.getElementById("PasswordMessage").style.display = "none";
	} }	
	</script>

	<script>
		$( "#hider" ).click(function() {
			$( "#topMSG" ).hide( "slow" );
			$( "#hider" ).hide( "slow" );
		});
	</script>

    <script type="text/javascript">
		function coptoven(val) {
			var cambio = 0.0025;
			val = val * 1.0;

			document.getElementById('minicop').innerHTML = val.toLocaleString('de-DE');
			document.getElementById('miniven').innerHTML = (val/cambio).toLocaleString('de-DE');

			document.getElementById("VEN").value = val/cambio;
		}

		function ventocop(val) {
			var cambio = 0.0025;
			val = val * 1.0;

			document.getElementById('miniven').innerHTML = val.toLocaleString('de-DE');
			document.getElementById('minicop').innerHTML = (val*cambio).toLocaleString('de-DE');

			document.getElementById("COP").value = val*cambio;
		}
	</script>

	<script type="text/javascript">
		// Get the button that opens the modal
		var btn_modal = document.querySelectorAll("button.modal-button");

		// All page modals
		var modals = document.querySelectorAll('.modal');

		// Get the <span> element that closes the modal
		var spans = document.getElementsByClassName("close_modal");

		// When the user clicks the button, open the modal
		for (var i = 0; i < btn_modal.length; i++) {
		 btn_modal[i].onclick = function(e) {
		    e.preventDefault();
		    modal = document.querySelector(e.target.getAttribute("href"));
		    modal.style.display = "block";
		 }
		}

		// When the user clicks on <span> (x), close the modal
		for (var i = 0; i < spans.length; i++) {
		 spans[i].onclick = function() {
		    for (var index in modals) {
		      if (typeof modals[index].style !== 'undefined') modals[index].style.display = "none";    
		    }
		 }
		}

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		    if (event.target.classList.contains('modal')) {
		     for (var index in modals) {
		      if (typeof modals[index].style !== 'undefined') modals[index].style.display = "none";    
		     }
		    }
		}
	</script>

	<!--<script src="assets/js/modal.js"></script>-->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.scrolly.min.js"></script>
	<script src="assets/js/jquery.scrollzer.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>

</body>
</html>