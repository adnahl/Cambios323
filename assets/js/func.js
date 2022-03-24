/* When the user scrolls down, hide the navbar. When the user scrolls up, show the navbar *
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
	var currentScrollPos = window.pageYOffset;

	if (prevScrollpos > currentScrollPos) {
		document.getElementById("holatop").style.top = "0";
	} else {
		document.getElementById("holatop").style.top = "-50px";
	}

prevScrollpos = currentScrollPos;
} */


window.onscroll = function() {
	var currentScrollPos = window.pageYOffset;

	if (50 > currentScrollPos) {
		document.getElementById("loginWindow").style.top = "75px";
		document.getElementById("regWindow").style.top = "75px";

	} else {
		document.getElementById("loginWindow").style.top = "-5000px";
		document.getElementById("regWindow").style.top = "-5000px";
	}
}

//Nombre sólo letras
function check(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8 || tecla == 32) {
        return true;
    }

    // Patron de entrada, sólo letras
    patron = /[A-Za-z]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}


//Sólo números
function check_number(e) {
     tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, sólo números
    patron = /^[0-9]+$/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
   }


//Para el RIF
/*
El primer caracter del RIF debe ser alguno de los siguientes:

V: Venezolano o venezolana.
E: extranjero o extranjera (número de cédula mayor a 80 millones).
P: Pasaporte, por ejemplo es útil para los cantantes que se presentan en nuestro país y que hay que retenerles Impuesto sobre la renta.
J: Persona jurídica, osea, compañías anónimas, sociedades anónimas, S.R.L., etc.
G: Gobierno, entes gubernamentales, de cualquier Poder, estado, municipio e incluso organismos «autónomos» (ejemplo Universidad de Carabobo RIF G-20000041-4).

*/



//Funciones de verificación
function check_pass() {

	//Coincidir contraseña
	if (document.getElementById('password').value == document.getElementById('confirm_password').value) {	 
        document.getElementById('submit').disabled = false;
        /*document.getElementById('message').style.color = 'green';
		document.getElementById('message').innerHTML = 'Matching';*/
		document.getElementById("message").style.display = "none"; //hide

    } else {
        document.getElementById('submit').disabled = true;
        document.getElementById("message").style.display = "block";//show
        document.getElementById('message').style.color = 'red';
		document.getElementById('message').innerHTML = 'No coinciden';//Not matching
    }

	//Verificar Email

	var mailformat=/(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;

	var mailformat2 = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,12}$/;

	if ( (document.getElementById('email').value.length < 7) || 
		 !(document.getElementById('email').value.match(mailformat))|| 
		 	!(document.getElementById('email').value.match(mailformat2))) {

		document.getElementById('submit').disabled = true;
		//document.getElementById("messageEmail").style.display = "block"; //show
		document.getElementById('messageEmail').style.color = 'red';
		document.getElementById('messageEmail').innerHTML = 'Email no v&aacute;lido';
	}else{
		document.getElementById('submit').disabled = false;
		//document.getElementById("messageEmail").style.display = "none"; //hide
		document.getElementById('messageEmail').style.color = 'green';
		document.getElementById('messageEmail').innerHTML = 'Se enviar&aacute; un correo de verificaci&oacute;n para activar la cuenta';
	}

}

