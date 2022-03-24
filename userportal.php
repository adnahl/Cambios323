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
		<link rel="stylesheet" href="assets/css/index.css" />


		<style type="text/css">	
			.switch {
			  position: relative;
			  /*display: inline-block; /*center*/
			  width: 60px;
			  height: 34px;
			}

			.switch input { 
			  opacity: 0;
			  width: 0;
			  height: 0;
			}

			.slider {
			  position: absolute;
			  cursor: pointer;
			  top: 0;
			  left: 0;
			  right: 0;
			  bottom: 0;
			  background-color: #ccc;
			  -webkit-transition: .4s;
			  transition: .4s;
			  border-radius: 24px;
			}

			.slider:before {
			  position: absolute;
			  content: "";
			  height: 26px;
			  width: 26px;
			  left: 4px;
			  bottom: 4px;
			  background-color: #fff;
			  -webkit-transition: .4s;
			  transition: .4s;
			  border-radius: 50%;
			}

			input:checked + .slider {
			  background-color: #22408C;
			}

			input:focus + .slider {
			  box-shadow: 0 0 1px #2196F3;
			}

			input:checked + .slider:before {
			  -webkit-transform: translateX(26px);
			  -ms-transform: translateX(26px);
			  transform: translateX(26px);
			}

			p.togglesw {
			  height: auto;
			  left: 70px;
			  position: relative;
			  top: -2px;
			  width: 400px;
			}
		</style>


		<script type="text/javascript">
			$(document).ready(function() {
			    $("#submit").on("click", function() {
			        var condiciones = $("#terminos").is(":checked");
			        if (!condiciones) {
			            alert("Debe aceptar los Terminos y Condiciones");
			            event.preventDefault();
			        }
			    });
			});
		</script>

	</head>

	<body>

<!--<section align="center">
  <h2>Encabezado</h2>
</section>-->


	<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{

    $imagen_perfil = '<img src="images/LoginUserDefault.png" alt="" />';
    $titulo_nombre = $_SESSION['name'];
    $subtitulo_info = "<a href='logout'>Salir</a>";

    $_email = $_SESSION['email'];

    include 'conn.php';

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    // Check connection
    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error());
    }
    else
    {
    	
    	/*************
			Perfil
    	**************/
	    // Query sent to database
	    $result = mysqli_query($conn, "SELECT Phone, Telegram, Whatsapp, Instagram FROM users WHERE Email = '$_email'");

	    // Variable $row hold the result of the query
	    $row = mysqli_fetch_assoc($result);

	    $_telefono = $row['Phone'];
	    $_instagram = $row['Instagram'];
	    $_telegram = $row['Telegram'];
	    $_whatsapp = $row['Whatsapp'];

	}
    mysqli_close($conn);

    $now = time();

    if ($now > $_SESSION['expire'])
    {
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
							

							<!--<li>&nbsp;</li>-->

							<?php
    //if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    
?>
								
								<li><a href="#top" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-arrow-circle-o-up">Arriba</span></a></li>
								
								<li><a href="#neworden" id="neworden-link" class="skel-layers-ignoreHref"><span class="icon fa-pencil">Nueva orden</span></a></li>
								
								<li><a href="#tyc" id="tyc-link" class="skel-layers-ignoreHref"><span class="icon fa-list-alt">Terminos y Condiciones</span></a></li>
								
								
								<li><a href="#cuentas" id="cuentas-link" class="skel-layers-ignoreHref"><span class="icon fa-save">Cuentas guardadas</span></a></li>					
							
								<li><a href="#transacciones" id="transacciones-link" class="skel-layers-ignoreHref"><span class="icon fa-calendar-o">Transacciones</span></a></li>
	
								<!--<li><a href="#" class="skel-layers-ignoreHref"><span class="icon fa-database">2</span></a></li>-->

								<!-- <li>&nbsp;</li> -->
								<li><a href="#perfil" id="perfil-link" class="skel-layers-ignoreHref"><span class="icon fa-user">Mi perfil</span></a></li>

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
				
				<!--------------------
					Modal start 
				--------------------->

				<!-- Edit Perfil - Modal -->
				<div id="myModal1" class="modal">

					<!-- Modal content -->
				  <div class="modal-content" align="center">
				    <span class="close_modal">&times;</span>
				    <p>

				    	<? /* 
				    	USAR???
				    	$key = $_SESSION['key'] = rand(1000, 9999);  //four digits random number
						isset($GLOBALS[$key]);
            			unset($GLOBALS[$key]);

            			$key to email
            			*/ ?>

						<h2>Editar Perfil</h2>

						<form action="editperfil" method="POST">
							<div class="row">

								<div class="6u 12u$(mobile)">
									<input type="email" name="_email" id="_email" aria-describedby="emailHelp" placeholder="Email (contactanos)" maxlength=62 disabled>

									<? /*
										disabled -> AL VERIFICAR EK NUEVO EMAIL ACTUALIZAR LAS BBDD
													PARA HABILITAR CAMBIO DE EMAIL
									*/ ?>


								</div>

								<div class="6u$	12u$(mobile)">
									<input type="text" name="instagram" id="instagram" placeholder="Instagram" maxlength=62>
								</div>

								<div class="6u	12u$(mobile)">
									<input type="text" name="phone" id="phone" placeholder="Tel&eacute;fono" onkeypress="return check_number(event)" maxlength=62>
								</div>

								<div class="6u$	12u$(mobile)">
									<input type="text" name="whatsapp" id="whatsapp" placeholder="Whatsapp" onkeypress="return check_number(event)" maxlength=62>
								</div>

								<div class="6u	12u$(mobile)">
									<input type="text" name="telegram" id="telegram" placeholder="Telegram" maxlength=62>
								</div>

								<div class="6u$	12u$(mobile)">
									<p style="background: #FBD116;">S&oacute;lo completar los campos que va a modificar.</p>
									<!--<input type="text" name="" id="" placeholder="" maxlength=62>-->
								</div>
								

								<div class="6u 12u$(mobile)">
									<input type="submit" name="edit_perfil" value="Editar Perfil" id="edit_perfil" >
								</div>
								<div class="6u$ 12u$(mobile)">
										<input type="reset" name="Reset">
								</div>

							</div>
						</form>

					</p>
				  </div>

				</div>

				<!-------------- 
					Modal end 
				------------ -->
			
				<!--<span id="holatop" name="holatop" style="position: fixed; z-index: 999; top: 4px;">Hola</span> 
				-->

				<header>
					<img src="images/logoR_fondo.png" alt="" style="padding-bottom: 15px;" />
					<p>
						<h5 class="typed">¡Cambie de manera rápida y segura!</h5>
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


	<!-- Formulario Nueva Orden -->
		<section id="neworden" class="two">
			<div class="container">


				<?php
    if (isset($_POST['name_type_load']) && !empty($_POST['name_type_load']) and isset($_POST['name_load']) && !empty($_POST['name_load']) and 
    	isset($_POST['doc_type_load']) && !empty($_POST['doc_type_load']) and 
    	isset($_POST['doc_num_load']) && !empty($_POST['doc_num_load']) and 
    	isset($_POST['bank_load']) && !empty($_POST['bank_load']) and 
    	isset($_POST['divisa']) && !empty($_POST['divisa']) and
    	isset($_POST['acc_type_load']) && !empty($_POST['acc_type_load']) and 
    	isset($_POST['acc_num_load']) && !empty($_POST['acc_num_load']))
    {

        $name_type_load = $_POST['name_type_load'];

        $name_load_format = $_POST['name_load'];
        $name_load = str_replace("_", " ", $name_load_format);

        $doc_type_load = $_POST['doc_type_load'];
        $doc_num_load = $_POST['doc_num_load'];
        $bank_load = $_POST['bank_load'];
        $acc_type_load = $_POST['acc_type_load'];
        $acc_num_load = $_POST['acc_num_load'];
        $divisa = $_POST['divisa'];

        if (isset($_POST['comment_load']) && !empty($_POST['comment_load'])){

            $comment_load_format = $_POST['comment_load'];
            $comment_load = str_replace("_", " ", $comment_load_format);

        } else {
        	$comment_load = "";
        }

        $permite_guardar = false;

    }
    else
    {
        $name_type_load = 0;
        $name_load = "";
        $doc_type_load = 0;
        $doc_num_load = "";
        $bank_load = 0;
        $acc_type_load = 0;
        $acc_num_load = "";
        $comment_load = "";
        $divisa = 0;

        $permite_guardar = true;
    }

    /* al generar calcular se vence en 2 horas <<< NO 
    		
    		date_default_timezone_set('America/Bogota');
    		//date_default_timezone_set('Asia/Tokyo');
    
    		$time = time();
    		echo "<br><br>".date("d-m-Y | h:i a", $time);
    		echo "<br><br>".date("d-m-Y | h:i a", $time + 60 * 120 ); //120min = 2h	*/

    /*$hoy = getdate(); print_r($hoy["year"]); print_r($hoy["mday"]); print_r($hoy["hours"]);*/

?>

				<header>
					<h2 >Generar nueva orden de cambio</h2>

				</header>

				<form action="generarorden" method="POST">
					<div class="row">

					<!--<div class="6u$	12u$(mobile)">
						<!- Fecha automática ->
                	</div>-->

                	<div class="12u$">
						<h3><span style="background: #FBD116;">&nbsp;Datos del beneficiario&nbsp;</span></h3>
					</div>


					<div class="12u$">
						<p>
							<a href="#cuentas" class="skel-layers-ignoreHref"><span class="icon fa-save"> Cargar una cuenta guardada.</span></a>
						</p>
					</div>


					<div class="6u 12u$(mobile)">
						<label>Tipo de persona*</label>
                     	<select name="tipopersona" id="tipopersona" class="form-control">
	                        <option value="1" <?php if ($name_type_load == 1) echo "selected"; ?> >Persona Natural</option>
	                        <option value="2" <?php if ($name_type_load == 2) echo "selected"; ?> >Persona Jur&iacute;dica </option>
                     	</select>
					</div>

					<div class="6u$	12u$(mobile)">
						<label>Nombre de la Persona o Empresa*</label>
						<input type="text" name="name" id="name" placeholder="Nombre completo" onkeypress="return check(event)" maxlength=62 value=<?php echo '"' . $name_load . '"'; ?> required>
					</div>


                	<div class="6u	12u$(mobile)">
						<label>Tipo de documento*</label>
                     	<select name="tipodocumento" id="tipodocumento" class="form-control">
	                        <option value="1" <?php if ($doc_type_load == 1) echo "selected"; ?> >C&eacute;dula de Identidad o Extranjer&iacute;a</option>
	                        <option value="2" <?php if ($doc_type_load == 2) echo "selected"; ?> >RIF Personal. &nbsp;&nbsp;&nbsp;V-</option>
	                        <option value="3" <?php if ($doc_type_load == 3) echo "selected"; ?> >RIF Jur&iacute;dico. &nbsp;&nbsp;&nbsp;J-</option>
	                        <option value="4" <?php if ($doc_type_load == 4) echo "selected"; ?> >RIF Gubernamental. &nbsp;&nbsp;&nbsp;G-</option>
	                        <option value="5" <?php if ($doc_type_load == 5) echo "selected"; ?> >Pasaporte</option>
	                        <option value="6" <?php if ($doc_type_load == 6) echo "selected"; ?> >Otro (Especificar en Indicaci&oacute;n adicional)</option>
                     	</select>
                	</div>

					<div class="6u$	12u$(mobile)">
						<label>N&uacute;mero de documento*</label>
						<input type="text" name="documento" id="documento" placeholder="N&uacute;mero de documento" onkeypress="return check_number(event)" maxlength=15 value=<?php echo '"' . $doc_num_load . '"'; ?> required>
                	</div>	


                	<div  class="6u	12u$(mobile)">
                		<label>Banco*</label>
                     	<select name="banco" id="banco" class="form-control">
	                        <option value= "1" <?php if ($bank_load ==  1) echo "selected"; ?> >BanCaribe</option>
	                        <option value= "2" <?php if ($bank_load ==  2) echo "selected"; ?> >Banco Activo</option>
	                        <option value= "3" <?php if ($bank_load ==  3) echo "selected"; ?> >Banco Bicentenario</option>
	                        <option value= "4" <?php if ($bank_load ==  4) echo "selected"; ?> >Banco de Venezuela</option>
	                        <option value= "5" <?php if ($bank_load ==  5) echo "selected"; ?> >Banco del Tesoro</option>
	                        <option value= "6" <?php if ($bank_load ==  6) echo "selected"; ?> >Banco Exterior</option>
	                        <option value= "7" <?php if ($bank_load ==  7) echo "selected"; ?> >Banco Mercantil</option>
	                        <option value= "8" <?php if ($bank_load ==  8) echo "selected"; ?> >Banco Nacional de Cr&eacute;dito BNC</option>
	                        <option value= "9" <?php if ($bank_load ==  9) echo "selected"; ?> >Banco Plaza</option>
	                        <option value="10" <?php if ($bank_load == 10) echo "selected"; ?> >Banco Sofitasa</option>
	                        <option value="11" <?php if ($bank_load == 11) echo "selected"; ?> >Banesco</option>
	                        <option value="12" <?php if ($bank_load == 12) echo "selected"; ?> >BBVA Provincial</option>
                     	</select>
                	</div>

<!--select#banco option[value="1"] { background-image:url(bancaribe.png); }-->

					<div class="6u$ 12u$(mobile)">
                		<label>Tipo de cuenta*</label>
                     	<select name="tipodecuenta" id="tipodecuenta" class="form-control">
	                        <option value="1" <?php if ($acc_type_load == 1) echo "selected"; ?> >Ahorro</option>
	                        <option value="2" <?php if ($acc_type_load == 2) echo "selected"; ?> >Corriente</option>
                     	</select>
                	</div>                	

					
					<div class="6u 12u$(mobile)">
						<label>N&uacute;mero de Cuenta*</label>
						<input type="text" id="cuenta" name="cuenta" onkeypress="return check_number(event)" maxlength=23 value=<?php echo '"' . $acc_num_load . '"'; ?> required>
					</div>

					<div class="6u$ 12u$(mobile)">
						<label>Divisa*</label>
                     	<select name="divisa" id="divisa" class="form-control">
	                        <option value="1" <?php if ($divisa == 1) echo "selected"; ?> >COP - Pesos Colombianos</option>
	                        <option value="2" <?php if ($divisa == 2) echo "selected"; ?> >Bs - Bol&iacute;vares</option>
	                        <option value="3" <?php if ($divisa == 3) echo "selected"; ?> >USD - D&oacute;lares Americanos</option>
                     	</select>
					</div>

					<div class="6u 12u$(mobile)">
						<label>Monto* </label>
						<input type="number" id="monto" name="monto" value="" min="1000" max="111222333" onkeypress="return check_number(event)" maxlength=9 required>
					</div>

                	<div class="6u$ 12u$(mobile)">
                		<label>Indicaci&oacute;n adicional</label>
                		<textarea id="comentario" name="comentario" maxlength="300" class="form-control" placeholder="Comentario..." ><?php echo $comment_load;?></textarea>
                	</div>


                	<?php if ($permite_guardar) { ?>

	                	<div class="12u$">
	                		<!--<input type="checkbox" name="guardarCta" id="guardarCta" class="far" value="1"> Guardar cuenta.-->

	                		<label class="switch" > <!--style="left: -80px;"-->
	                		  <input type="checkbox" name="guardarCta" id="guardarCta" class="far" value="1">
							  <span class="slider"><p class="togglesw">Guardar cuenta.</p></span>
							  
							</label>
	                	</div>

                	<?php } ?>

                	<div class="12u$">
                		<!--<input type="checkbox" name="terminos" id="terminos" class="far"> Acepto los <a href="#tyc">terminos y condiciones.</a>-->
                		
                		<label class="switch" > <!-- style="left: -172px;" -->
                		  <input type="checkbox" name="terminos" id="terminos" class="far">
						  <span class="slider"><p class="togglesw">Acepto los <a href="#tyc">terminos y condiciones.</a></p></span>
						  
						</label>



                	</div>
                	
                	<div class="6u	12u$(mobile)">
						<input type="submit" name="submit" value="Crear Orden" id="submit" >
					</div>

					<div class="6u$ 12u$(mobile)">
						<input type="reset" name="Reset" onclick="location.href='http://localhost/cambios/userportal#neworden'">
					</div>



					</div>
				</form>
				

			</div>
		</section>



	<!-- Terminos y Condiciones -->
		<section id="tyc" class="three">
			<div class="container" align="left" >
				
				<header>
					<h2>Terminos y Condiciones</h2>
				</header>

				<ol type="1">
					<li>No manejamos cuentas bancarias en Colombia solamente efectivo en los puntos autorizados.</li>
					<li>El tiempo para recibir las remesas en Venezuela suelen tardar menos de 30 minutos pero pueden demorarse horas.</li>
					<li>No nos hacemos responsables si algún dato ingresado en el formulario es incorrecto, por lo que se recomienda verificar bien nombre, documento y número de cuenta del beneficiario.</li>
					<li>Si el monto ingresado en la orden no coincide con el entregado en el punto autorizado no se realizará la transferencia al beneficiario.</li>
					<li>Nos comunicaremos con el remitente unicamente por el medio de comunicación y el número, usuario o correo electrónico indicado.</li>
					<li>Es obligatorio llenar el formulario indicando con todos datos que se soliciten, en caso de no generar una orden o dejar un dato faltante no se realizará la transferencia hasta recibir todos los datos.</li>
					<li>Cada orden enviada es para una única transferencia, si necesita enviar a dos o más cuentas debe crear una orden por cada transferencia.</li>
					<li>Luego de generar una nueva orden dispone de m&aacute;ximo dos hora para entregar el dinero en alguno de nuestros aliados.</li>
					<li>No es necesario imprimir el recibo.</li>
               </ol>

               <footer>
               		
               </footer>


			</div>
		</section>



	<!-- Cuentas guardadas -->
		<section id="cuentas" class="two">
			<div class="container" align="center" >

				<header>
					<h2>Cuentas guardadas</h2>
				</header>


			<div class="table_body">

			<div class="table_main">
			  <table>
			    <thead>
			      <tr>
			        <th>
			          Nombre
			        </th>
			        <th>
			          Banco
			        </th>
			        <th>
			          Cuenta
			        </th>
			        <th>
			          Enviar
			        </th>
			      </tr>
			    </thead>
			   <!-- <tfoot>
			      <tr>
			        <th colspan='5'>
			          Enero
			        </th>
			      </tr>
			    </tfoot> -->
			    <tbody>

				   	<?php

						// Create connection
						$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); //$conn = new mysqli($servername, $username, $password, $dbname);

						// Check connection
						if (!$conn) { //if ($conn->connect_error) {
							die("Connection failed: " . mysqli_connect_error()); //die("Connection failed: " . $conn->connect_error);

						} else {

							/***********************
							Cuentas Guardadas
							************************/

							$query = "SELECT * FROM cuentas_guardadas WHERE user_email='$_email'"; // ORDER by id DESC LIMIT 50
							$result = $conn->query($query);

							if ($result->num_rows > 0) {

								
								// output data of each row
								while($row = $result->fetch_assoc()) {

									echo '<form action="userportal#neworden" method="POST">';
									
					?>

			      <tr>
			        <td data-title='Nombre'>
			        	<input id="name_type_load" name="name_type_load" type="hidden" value=<?php echo $row["name_type"]; ?> >
			        	<input id="name_load" name="name_load" type="hidden" value=<?php echo $row["name"]; ?> >
			        
			        	<input id="doc_type_load" name="doc_type_load" type="hidden" value=<?php echo $row["doc_type"]; ?> >
			        	<input id="doc_num_load" name="doc_num_load" type="hidden" value=<?php echo $row["doc_number"]; ?> >

			          	<?php echo $row["name"]; ?>
			        </td>

			        <td data-title='Banco'>
			        	<input id="bank_load" name="bank_load" type="hidden" value=<?php echo $row["bank"]; ?> >

			        	<?php				        	
				        	switch ($row["bank"]) {
						        case '1': $bank_load_txt = "BanCaribe"; break;
						        case '2': $bank_load_txt = "Activo"; break;
						        case '3': $bank_load_txt = "Bicentenario"; break;
						        case '4': $bank_load_txt = "De Venezuela"; break;
						        case '5': $bank_load_txt = "Del Tesoro"; break;
						        case '6': $bank_load_txt = "Exterior"; break;
						        case '7': $bank_load_txt = "Mercantil"; break;
						        case '8': $bank_load_txt = "BNC"; break;
						        case '9': $bank_load_txt = "Plaza"; break;
						        case '10': $bank_load_txt = "Sofitasa"; break;
						        case '11': $bank_load_txt = "Banesco"; break;
						        case '12': $bank_load_txt = "Provincial"; break;
						        default: $bank_load_txt = ""; break;
						    }				     	
						     	echo $bank_load_txt; 
					     ?>

			        </td>

			        <td data-title='Cuenta'>
			          <input id="acc_type_load" name="acc_type_load" type="hidden" value=<?php echo $row["acc_type"]; ?> >
			          <input id="acc_num_load" name="acc_num_load" type="hidden" value=<?php echo $row["acc_number"]; ?> >
			          
				        <?php
						    if ($row["acc_type"] == 1) {
						        $acc_type_load_txt = " de ahorro: ";
						    }
						    else if ($row["acc_type"] == 2) {
						        $acc_type_load_txt = " corriente: ";
						    }
						    else {
						        $acc_type_load_txt = ": ";
						    }
							
							echo "Cuenta" . $acc_type_load_txt . $row["acc_number"]; 
						?>
			        </td>

			        <td class='select'>

			        	<?php $comment_load_format = str_replace(" ", "_", $row["comment"]); ?>
		          		
			          	<input id="comment_load" name="comment_load" type="hidden" value=<?php echo '"' . $comment_load_format . '"'; ?> >

						<input type="submit" class="btn_cargar" value="Cargar"> 
						<a href ='deleteaccount?idCuenta=<?php echo $row["id"]; ?>' onclick="return confirm('&iquest;Seguro de eliminar la cuenta de <?php echo $row["name"]; ?>?')"><span class="icon fa-trash-o"> </span></a>

			        </td>
			      </tr>

				</form>
			       
			    	<?php
								} //while
		
							} else {
								echo "Sin cuentas guardadas."; //0 results
							}
						}
						mysqli_close($conn); //$conn->close();

						echo "</tbody> </table>";
					?>
			</div>
		</div>

			</div>
		</section>



<!-- Historial de transacciones -->
		<section id="transacciones" class="three">
			<div class="container" align="center" >
				
				<header>
					<h2>Historial de transacciones</h2>
				</header>


<div class="table_body">
  <h1>
 &Uacute;ltimas transaciones
</h1>

<div class="table_main">
  <table>
    <thead>
      <tr>
        <th>
          Orden
        </th>
        <th>
          Fecha
        </th>
        <th>
          Beneficiario
        </th>
        <th>
          Monto
        </th>
        <th>
          Banco
        </th>
        <th>
          Cuenta
        </th>
      </tr>
    </thead>
   <!-- <tfoot>
      <tr>
        <th colspan='5'>
          A&ntilde;o 2021
        </th>
      </tr>
    </tfoot> -->

    <tbody>

    	<?php
			// Create connection
			$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); //$conn = new mysqli($servername, $username, $password, $dbname);

			// Check connection
			if (!$conn) { //if ($conn->connect_error) {
				die("Connection failed: " . mysqli_connect_error()); //die("Connection failed: " . $conn->connect_error);

			} else {

				/*		**********************
					Historal de transacciones
				***********************		*/

				$query = "SELECT * FROM ordenes WHERE user_email='$_email' ORDER by id DESC LIMIT 50";
				$result = $conn->query($query);

				if ($result->num_rows > 0) {

					
					// output data of each row
					while($row = $result->fetch_assoc()) {

						echo '<form action="userportal#neworden" method="POST">';					
					?>


					  <tr>
					    <td data-title='Orden'>
					      <?php echo str_pad(intval($row["id"]), 6, '0', STR_PAD_LEFT); ?>
					    </td>
					    <td data-title='Fecha'>
					     <?php
					     	if ($row["tiempo"]>0) {
					     		echo date("d M Y", $row["tiempo"]);
					     	}else{
					     		echo "";
					     	}
					     ?>
					    </td>
					    <td data-title='Beneficiario'>
					      <?php echo $row["name"]; ?>
					    </td>
					    <td data-title='Monto'>
					      <?php echo $row["amount"]; ?>
					    </td>
					    <td data-title='Banco'>
					    	<?php
						      	switch ($row["bank"]) {
							        case '1': $bank_load_txt = "BanCaribe"; break;
							        case '2': $bank_load_txt = "Activo"; break;
							        case '3': $bank_load_txt = "Bicentenario"; break;
							        case '4': $bank_load_txt = "De Venezuela"; break;
							        case '5': $bank_load_txt = "Del Tesoro"; break;
							        case '6': $bank_load_txt = "Exterior"; break;
							        case '7': $bank_load_txt = "Mercantil"; break;
							        case '8': $bank_load_txt = "BNC"; break;
							        case '9': $bank_load_txt = "Plaza"; break;
							        case '10': $bank_load_txt = "Sofitasa"; break;
							        case '11': $bank_load_txt = "Banesco"; break;
							        case '12': $bank_load_txt = "Provincial"; break;
							        default: $bank_load_txt = ""; break;
							    }				     	
						     	echo $bank_load_txt;
						     ?>
					    </td>
					    <td data-title='Cuenta'>
						    <?php echo "_".substr($row["acc_number"], -8); ?>
					    </td>
					  </tr>

					<?php

				} //while

			} else {
				echo "Sin cuentas guardadas."; //0 results
			}
		}
		mysqli_close($conn); //$conn->close();
	?>

    </tbody>
  </table>


</div>
</div>
			</div>
		</section>



	<!-- Mi Perfil -->
		<section id="perfil" class="two">
			<div class="container" align="center" >
				
				<header>
					<h2>PERFIL</h2>
				</header>

				<img src="images/perfilpic.jpg" style="border-radius: 50%;" width="70" height="70" alt="Adnan Al Hennawi" />
				<p>&nbsp;</p>

				<div align="left" style="background: #22408C; color: #ffffff; float: center; width: 100%; max-width: 400px; box-shadow: 2px 2px 2px 2px lightgrey; padding: 20px;  margin: -80px; font-size: medium;">

						<p align="left" style="float: left; font-weight: bold;">
							Nombre:<br>
							Email:<br>
							Telegram:<br>
							Whatsapp:<br>
							Tel&eacute;fono:<br>
							Instagram:<br>
							
							<!--<a href="#top"><span style="color: #FBD116;" class="icon fa-edit"> Editar Perfil</span></a>-->
							<button class="modal-button" href="#myModal1" style="padding: 15px; margin: 10px 10px; color: #FBD116;">
								Editar Perfil
							</button>
						</p> 

						<p align="right" style="float: right;">
							<?php echo $titulo_nombre; ?><br>
							<?php echo $_email; ?><br>
							<?php echo $_telegram; ?><br>
							<?php echo $_whatsapp; ?><br>
							<?php echo $_telefono; ?><br>
							<?php echo $_instagram; ?><br>
							<br>
						</p> 

						<br><br><br><br><br><br><br><!-- cantidad de campos -->

				</div>

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

    <!-- <script src="js/index.js"></script> -->
	    <script type="text/javascript">
		    $('.button, .close').on('click', function(e) {
			    e.preventDefault();
			    $('.detail, html, body').toggleClass('open');
		    });0
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


		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/jquery.scrolly.min.js"></script>
		<script src="assets/js/jquery.scrollzer.min.js"></script>
		<script src="assets/js/skel.min.js"></script>
		<script src="assets/js/util.js"></script>
		<script src="assets/js/main.js"></script>


<?php
}
else
{
    header('Location: ../cambios/logout');

    echo "<center>Permiso denegado debe iniciar sesi&oacute;n." . "<p><a href='../cambios/logout'>[ Regresar ]</a></p></p></center>"; //porsia
    
}

?>



	</body>
</html>