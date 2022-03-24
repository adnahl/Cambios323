<?php 
	session_start();

	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

		if (isset($_REQUEST['idCuenta'])){

			$idCuenta = 0;
			$idCuenta = $_REQUEST['idCuenta'];


			if ($idCuenta > 0) {

				echo '<center>';

				include 'conn.php';

				$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
				if ($conn->connect_error) {
					die("Conexi&oacute;n fallada: " . $conn->connect_error);
				}

				$query = "SELECT * FROM cuentas_guardadas WHERE id='$idCuenta'"; // ORDER by id DESC LIMIT 50
				$result = $conn->query($query);

				if ($result->num_rows > 0) {

					$sql = "DELETE FROM cuentas_guardadas WHERE id='$idCuenta'";

					if ($conn->query($sql) === TRUE) {
						echo "<p>Cuenta eliminada correctamente.</p>";

					} else {
						echo "<p>Error (La cuenta no pudo ser eliminada): " . $conn->error . "</p>";
					}

				}

				echo '<p><a href="userportal#cuentas">[ Regresar ]</a></p></center>';

				$conn->close();
			}

		
			//$del = mysql_query("DELETE FROM `cust` WHERE `customerNo`='$customerNo'") or die(mysql_error());
			//echo $idCuenta;
		}
	}
?>