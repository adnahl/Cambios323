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

		/*
		// When the user clicks outside of the password field, hide the message box
		myInput.onblur = function() {
		  document.getElementById("PasswordMessage").style.display = "none";
		}*/

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
		  }

		}
