function validarcontraseña(pass1,pass2) {

  if (pass1 != pass2) {
    alertify.error("Las contraseñas no coinciden");
    return false;
  }
  if(pass1.length >= 8)
			{
				var mayuscula = false;
				var minuscula = false;
				var numero = false;
				var caracter_raro = false;

				for(var i = 0;i<pass1.length;i++)
				{
					if(pass1.charCodeAt(i) >= 65 && pass1.charCodeAt(i) <= 90)
					{
						mayuscula = true;
					}
					else if(pass1.charCodeAt(i) >= 97 && pass1.charCodeAt(i) <= 122)
					{
						minuscula = true;
					}
					else if(pass1.charCodeAt(i) >= 48 && pass1.charCodeAt(i) <= 57)
					{
						numero = true;
					}
					else
					{
						caracter_raro = true;
					}
				}
				if(mayuscula == true && minuscula == true && caracter_raro == true && numero == true)
				{
					return true;
				}
			}
      alertify.warning("La contraseña debe de tener al menos 8 caracteres, una mayuscula y un caracter especial");
			return false;
}
