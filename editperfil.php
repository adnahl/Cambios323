<?php 
	session_start();

	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

		$now = time();

	    if ($now > $_SESSION['expire'])
	    {
	        header('Location: ../cambios/logout');
	    }

		$current_email = $_SESSION['email'];

		$_email = "";
		$instagram = "";
		$phone = "";
		$whatsapp = "";
		$telegram = "";

		$editado = '<p><b>Datos Editados:</b></p> <ol>';

		$sql = '';
		$cont_sql = false; //indica si hay un registra anterior
		
		
		if (isset($_POST['_email']) && !empty($_POST['_email'])) {
			$_email = $_POST['_email'];
			$sql = $sql." New_email_temp='$_email'";
			$cont_sql = false;
			$editado = $editado.'<li>Email: para usar el email </strong>'. $_email .'</strong> debe confirmar por el link enviado al email actual.</li>';
		}

		if (isset($_POST['instagram']) && !empty($_POST['instagram'])) {
			$instagram = $_POST['instagram'];
			if ($cont_sql) {
				$sql = $sql . ",";
			}
			$sql = $sql . " Instagram='$instagram'";
			$cont_sql = true;
			$editado = $editado.'<li>Instagram: <strong>'. $instagram .'</strong></li>';
		}

		if (isset($_POST['phone']) && !empty($_POST['phone'])) {
			$phone = $_POST['phone'];
			if ($cont_sql) {
				$sql = $sql . ",";
			}
			$sql = $sql . " Phone=$phone";
			$cont_sql = true;
			$editado = $editado.'<li>Tel&eacute;fono: <strong>'. $phone .'</strong></li>';
		}

		if (isset($_POST['whatsapp']) && !empty($_POST['whatsapp'])) {
			$whatsapp = $_POST['whatsapp'];
			if ($cont_sql) {
				$sql = $sql . ",";
			}
			$sql = $sql . " Whatsapp='$whatsapp'";
			$cont_sql = true;
			$editado = $editado.'<li>Whatsapp: <strong>'. $whatsapp .'</strong></li>';
		}

		if (isset($_POST['telegram']) && !empty($_POST['telegram'])) {
			$telegram = $_POST['telegram'];
			if ($cont_sql) {
				$sql = $sql . ",";
			}
			$sql = $sql . " Telegram='$telegram'";
			$editado = $editado.'<li>Telegram: <strong>'. $telegram .'</strong></li>';
		}

		
		if ($_email=='' && $instagram=='' && $phone=='' && $whatsapp=='' && $telegram==''){
			echo 'none';

		}else{

			

			include 'conn.php';

			$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

			if ($conn->connect_error) {
				die("Conexi&oacute;n fallada: " . $conn->connect_error);
			}

			//$query = "UPDATE users SET New_email_temp='$email', Phone='$phone', Instagram='$instagram', Whatsapp='$whatsapp', Telegram='$telegram' WHERE Email='$current_email'";

			$sql = $sql . " WHERE Email='".$current_email."'";
			$query = 'UPDATE users SET ' . $sql;

			
			if ($conn->query($query) === TRUE) {

				echo "<p style='background:green; color:white; padding: 1em;'>Perfil editado correctamente.</p>";
				
				echo $editado."</ol><hr>";

			} else {

				echo "<p style='background:red; color:white; padding: 1em;'>Error (Perfil no pudo ser editado): " . $conn->error . "</p>";
			}


			if ($_email == ''){
				echo '<p><a href="userportal#perfil">[ Regresar ]</a></p>';
			
			}else{

				//new hash
				$hash = md5(rand(0,1000));
				$query = "UPDATE users SET Hash='$hash' WHERE Email='$current_email'";

				if ($conn->query($query) === TRUE) {

					echo "<p>Cambio de email solicitado.</p>";
				
					//Enviar el email
					$to      = $current_email;
					$subject = 'Verificar cambio de correo - Cambios323';
					$message = '

					Si ha solicitado cambio de correo para: <b>'.$_email.'</b>.

					Puede ingresar con su nuevo correo despues de validar su cuenta, o hacer caso omiso para invalidar el cambio.

					Haga click en el siguiente enlace (o copie y pegue en un navegador) para validar el cambio del correo:
					https://cambios.323factory.com/changeemail?email='.$_email.'&hash='.$hash.''; 
					                  
					$headers = 'From:noreply@323factory.com' . "\r\n"; // Set from headers
					$enviado = mail($to, $subject, $message, $headers); // Send our email

					if ($enviado)
						echo '<p>Email enviado exitosamente.<p>';
					else
						$msg_acc_email = 'Error al enviar el enlace de activaci&oacute;n al email.';

				} else {

					echo "<p>Error en la solicitado para el cambio de email: " . $conn->error . "</p>";
				}
			}
			
			$conn->close();
		}
	}
?>