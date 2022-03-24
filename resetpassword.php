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
		<script src="assets/js/func.js"></script>
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
		<section id="top" class="one dark cover"> <!-- style="height: 80vh;" -->
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


						if(isset($_POST['notthis']) && !empty($_POST['notthis']) AND 
							isset($_POST['email']) && !empty($_POST['email']) AND 
								isset($_POST['password']) && !empty($_POST['password']) AND 
									isset($_POST['hash']) && !empty($_POST['hash'])){


							    // Verify data
							    $email = mysqli_real_escape_string($conn, $_POST['email']); // Set email variable
							    $hash = mysqli_real_escape_string($conn, $_POST['hash']); // Set hash variable
							    
							    $query = "SELECT Email, Hash, New_password FROM users WHERE Email='".$email."' AND Hash='".$hash."' AND New_password='1'";

							   	$search = mysqli_query($conn, $query) or die ("Problemas al buscar".mysqli_error($conn));
							    	
						    	$match = mysqli_num_rows($search);
						                  
							    if($match > 0){

							    	//cambiamos el hash por precaución
							    	$new_hash = md5( rand(0,1000) );

							    	// The password_hash() function convert the password in a hash before send it to the database
									$passHash = password_hash($_POST['password'], PASSWORD_DEFAULT);


								   	$query = "UPDATE users SET Password='$passHash', New_password='0', Hash='$new_hash' WHERE Email='".$email."' AND Hash='".$hash."' AND New_password='1'";

						        	if (mysqli_query($conn, $query)){
						        		echo 'Contrase&ntilde;a actualizada exitosamente. Ya puedes ingresar.'; //YEIII

						        	} else {
						        		echo 'Error de conexi&oacute;n con la base de datos volver a intentar desde "Recuperar contrase&ntilde;a" para solicitar un acceso nuevo. Disculpe las moletias causadas.';
						        	}


							    } else {
							    	// Invalid approach
							    	echo 'Enlace no v&aacute;lido, utilice el enlace que se ha enviado a su correo electr&oacute;nico.';
								}



							} else {

             
								if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
								    // Verify data
								    $email = mysqli_real_escape_string($conn, $_GET['email']); // Set email variable
								    $hash = mysqli_real_escape_string($conn, $_GET['hash']); // Set hash variable
								    
								    $query = "SELECT Email, Hash, New_password FROM users WHERE Email='".$email."' AND Hash='".$hash."' AND New_password='1'";

								   	$search = mysqli_query($conn, $query) or die ("Problemas al buscar".mysqli_error($conn));
								    	
							    	$match = mysqli_num_rows($search);
							                  
								    if($match > 0){
								        // We have a match, form to new password

								         	?>

								    		<h2>Nueva contrase&ntilde;a</h2>

											<form action="resetpassword" method="POST" class="regForm">
											<div class="row">

												<!-- hide email -->
												<!-- hide hash -->

												<!-- Cambiar de posicion match para actiuaizar ya que quitarimos el GET --> 

												
												<?php
													echo '
													<input id="notthis" name="notthis" type="hidden" value="1">
													<input id="email" name="email" type="hidden" value='.'"'.$email.'"'.'>
													<input id="hash" name="hash" type="hidden" value='.'"'.$hash.'"'.'>';
												?>


												<div class="6u	12u$(mobile)">
													<input type="password" name="password" id="password" placeholder="Contrase&ntilde;a" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w]).{8,}" onkeyup='check_pass();' maxlength=14 required/> <p></p>
													
													<div align="left" id="PasswordMessage">
													  <b style="color: #fff;">Requisitos m&iacute;nimos:</b>
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

												<div class="6u	12u$(mobile)">
													<input type="submit" name="submit" value="Crear cuenta" id="submit" disabled>
												</div>

												<div class="6u$ 12u$(mobile)">
													<input type="reset" name="Reset">
												</div>

											</div>
											</form>


								    	<?php
								    	

							        }else{ //$match
							        	echo 'Error: Cambio de contrase&ntilde;a no autorizado.';
							        }

							    }else{ //$_GET
							        echo 'Error: La URL no es v&aacute;lida o ha caducado.';
							    }
					                  
					
						} //$_POST


							
 					mysqli_connect_error();
						
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

				<?php mysqli_close($conn); ?>

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
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollzer.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
	</body>
</html>