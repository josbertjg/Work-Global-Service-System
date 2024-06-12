//RESTRINGIENDO LETRAS
function soloNumeros(evento) {
  let letra = evento.key;
  regExp = /[0-9]/;
  if (evento.keyCode == 13 || evento.keyCode == 8 || evento.keyCode == 9 || evento.keyCode == 32)
    return true;
  else
    return regExp.test(letra);
}
//RESTRINGIENDO NUMEROS
function soloLetras(evento) {
  let letra = evento.key;
  regExp = /^[A-Za-zñÑ\.]+$/; // /^[A-Za-z]+$/;
  if (evento.keyCode == 13 || evento.keyCode == 8 || evento.keyCode == 9 || evento.keyCode == 32)
    return true;
  else
    return regExp.test(letra);
}
//VALIDANDO CORREO ELECTRONICO
function isCorreo(correo, expReg) {
  if (expReg == undefined) expReg = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return (expReg.test(correo));
}
//VALIDANDO QUE EL NUMERO DADO POR PARAMETRO ESTE DENTRO DE UNA CANTIDAD DETERMINADA
function validarCantidad(num, limite, base) {
  if (base == undefined) base = 0;
  return ((num >= base) && (num <= limite))
}
//VALIDANDO QUE LA CADENA PASADA POR PARAMETRO TENGA UNA CANTIDAD DETERMINADA DE CARACTERES
function validarLength(texto, base) {
  if (base == undefined) base = 1;
  return (texto.trim().length < base);
}
//VALIDAR NUMERO DE TELEFONO
function isTelefono(numero, expReg) {
  if (expReg == undefined) expReg = /^[+]*[(]{0,1}[0-9]{1,3}[)]{0,1}[-\s\./0-9]*$/g;
  return (expReg.test(numero));
  /* FORMATOS PERMITIDOS:
  (123) 456-7890
  +(123) 456-7890
  +(123)-456-7890
  +(123) - 456-7890
  +(123) - 456-78-90
  123-456-7890
  123.456.7890
  1234567890
  +31636363634
  075-63546725
  */
}
// Validar que sea una contraseña
function isContraseña(text){
  const exp = /^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&*()_+[\]{};':"\\|,.<>/?]).{8,}$/;
  return (exp.test(text))
}

function esNumero(cadena) {
  const regExp = /^[0-9]*\.?[0-9]*$/;
  const decimalRegExp = /\./g;
  const match = cadena.match(decimalRegExp);
  if (match != null && match.length > 1) {
    return false;
  }
  return regExp.test(cadena);
}


// Setear un input como invalido
function setInvalidInput(element, invalidMessage = "Este campo es requerido") {
  element.removeClass("is-valid");
  element.addClass("is-invalid");
  $(element.parent()).children(".invalid-tooltip").text(invalidMessage)
  element.attr("isValid",false)
}
// Setear un input como valido
function setValidInput(element) {
  element.removeClass("is-invalid");
  element.addClass("is-valid");
  element.attr("isValid",true)
}
// Chequea si el formulario pasado por parametro es valido o no
function checkFormValidity(element){
  const invalidInputsCount = element.find(".is-invalid").length + element.find("input[isValid=false]").length;
  const invalidInputs = element.find("input[isValid=false]");

  Array.from(invalidInputs).forEach(element => {
    $(element).trigger("blur")
  });

  return invalidInputsCount == 0;
}
// Mostrar alertas dentro de un formulario
function showFormAlerts(element,alerts){
  if(Array.isArray(alerts)){
    alerts.map((alerta)=>{
      element.prepend(`
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>${alerta}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      `);
    })
  }else{
    element.prepend(`
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>${alerts}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    `);
  }
}
// Blanquea los inputs de un formulario
function blankForm(element){
  const inputs = element.find("input");

  Array.from(inputs).forEach(element => {
    $(element).val("");
    $(element).attr("isValid",false);
    $(element).removeClass("is-valid");
    $(element).removeClass("is-invalid");
  });
}
// Valida un input para que sea requerido
function required(element) {
  element.blur(() => {
    if (_.isEmpty(element.val().trim())) {
      setInvalidInput(element)
    } else {
      setValidInput(element)
    }
  })
  element.keyup(() => {
    if (_.isEmpty(element.val().trim())) {
      setInvalidInput(element)
    } else {
      setValidInput(element)
    }
  })

  element.keydown(() => {
    if (_.isEmpty(element.val().trim())) {
      setInvalidInput(element)
    } else {
      setValidInput(element)
    }
  })
}

//validar que un FileChooser no este vacio
function validarFile(element, isRequired = true){
  element.change(()=>{
    if(isRequired)
      if(_.isEmpty(element.val().trim())) return setInvalidInput(element, "Este campo es requerido");
    return setValidInput(element);
  });
}


function validarNumeros(element, isRequired = true) {
  element.blur(() => {
    if(isRequired)
      if(_.isEmpty(element.val())) return setInvalidInput(element, "Ingrese el numero aproximado")
      
    if (!esNumero(element.val().trim())) return setInvalidInput(element, "El numero no es válido")

    if(element.val().length > 1500) return setInvalidInput(element, "el valor no puede superar los 1500.");

    return setValidInput(element)
  })

  element.keyup(() => {
    if(isRequired)
      if(_.isEmpty(element.val().trim())) return setInvalidInput(element, "Este campo es requerido")
     
    if (!esNumero(element.val())) return setInvalidInput(element, "El numero no es válido")

    if(element.val().trim().length > 1500) return setInvalidInput(element, "El valor no puede superar los 1500.");

    return setValidInput(element)
  })

  element.keydown(() => validarLength(element.val(),1500));
}
//valida un input con la logica para solo numeros


// Valida un input con la logica para un correo
function validarCorreo(element, isRequired = true) {
  element.blur(() => {
    if(isRequired)
      if(_.isEmpty(element.val().trim())) return setInvalidInput(element, "Este campo es requerido")
      
    if (!isCorreo(element.val())) return setInvalidInput(element, "El correo no es válido")

    if(element.val().trim().length > 100) return setInvalidInput(element, "El correo no puede tener mas de 100 caracteres.");

    return setValidInput(element)
  })

  element.keyup(() => {
    if(isRequired)
      if(_.isEmpty(element.val().trim())) return setInvalidInput(element, "Este campo es requerido")
     
    if (!isCorreo(element.val())) return setInvalidInput(element, "El correo no es válido")

    if(element.val().trim().length > 100) return setInvalidInput(element, "El correo no puede tener mas de 100 caracteres.");

    return setValidInput(element)
  })

  element.keydown(() => validarLength(element.val(),100));
}
// Valida un input con la logica para una contraseña
function validarContraseña(element, isRequired = true) {
  element.blur(() => {
    if(isRequired)
      if(_.isEmpty(element.val().trim())) return setInvalidInput(element, "Este campo es requerido")
      
    if (!isContraseña(element.val())) return setInvalidInput(element, "La contraseña debe tener al menos un número, una letra minúscula, una letra mayúscula, un caracter especial y una longitud de 8 caracteres.")

    if(element.val().trim().length > 100) return setInvalidInput(element, "La contraseña no puede tener mas de 100 caracteres.");

    return setValidInput(element)
  })

  element.keyup(() => {
    if(isRequired)
      if(_.isEmpty(element.val().trim())) return setInvalidInput(element, "Este campo es requerido")
     
    if (!isContraseña(element.val())) return setInvalidInput(element, "La contraseña debe tener al menos un número, una letra minúscula, una letra mayúscula, un caracter especial y una longitud de 8 caracteres.")

    if(element.val().trim().length > 100) return setInvalidInput(element, "La contraseña no puede tener mas de 100 caracteres.");

    return setValidInput(element)
  })

  element.keydown(() => validarLength(element.val(),100));
}
// Valida un input con la logica para confirmar una contraseña
function validarConfirmarContraseña(confirmPasswordElement, passwordElement, isRequired = true) {
  confirmPasswordElement.blur(() => {
    if(isRequired)
      if(_.isEmpty(confirmPasswordElement.val().trim())) return setInvalidInput(confirmPasswordElement, "Este campo es requerido")
      
    if (confirmPasswordElement.val() != passwordElement.val()) 
      return setInvalidInput(confirmPasswordElement, "Ambas contraseñas deben coincidir.")

    if(confirmPasswordElement.val().trim().length > 100) return setInvalidInput(confirmPasswordElement, "La contraseña no puede tener mas de 100 caracteres.");

    return setValidInput(confirmPasswordElement)
  })

  confirmPasswordElement.keyup(() => {
    if(isRequired)
      if(_.isEmpty(confirmPasswordElement.val().trim())) return setInvalidInput(confirmPasswordElement, "Este campo es requerido")
     
    if (confirmPasswordElement.val() != passwordElement.val()) 
      return setInvalidInput(confirmPasswordElement, "Ambas contraseñas deben coincidir.")

    if(confirmPasswordElement.val().trim().length > 100) return setInvalidInput(confirmPasswordElement, "La contraseña no puede tener mas de 100 caracteres.");

    return setValidInput(confirmPasswordElement)
  })

  confirmPasswordElement.keydown(() => validarLength(confirmPasswordElement.val(),100));
}
// Valida un input con la logica para nombres
function validarNombre(element, isRequired = true) {
  element.blur(() => {
    if(isRequired)
      if(_.isEmpty(element.val().trim())) return setInvalidInput(element, "Este campo es requerido");
      
    if(element.val().trim().length < 2)  return setInvalidInput(element, "El nombre no puede tener menos de dos caracteres.");
    if(element.val().trim().length > 45) return setInvalidInput(element, "El nombre no puede tener mas de 45 caracteres.");

    return setValidInput(element)
  })

  element.keyup(() => {
    if(isRequired)
      if(_.isEmpty(element.val().trim())) return setInvalidInput(element, "Este campo es requerido")
     
    if(element.val().trim().length < 2)  return setInvalidInput(element, "El nombre no puede tener menos de dos caracteres.");
    if(element.val().trim().length > 45) return setInvalidInput(element, "El nombre no puede tener mas de 45 caracteres.");

    return setValidInput(element)
  })

  element.keydown((event) => soloLetras(event) && validarLength(element.val(),45));
  
}


// Valida un input
function validarDescripcion(element, isRequired = true) {
  element.blur(() => {
    if(isRequired)
      if(_.isEmpty(element.val().trim())) return setInvalidInput(element, "Este campo es requerido");
      
    if(element.val().trim().length < 25)  return setInvalidInput(element, "La descripcion  no puede tener menos de 25 caracteres.");
    if(element.val().trim().length > 300) return setInvalidInput(element, "La descripcion no puede tener mas de 300 caracteres.");

    return setValidInput(element)
  })

  element.keyup(() => {
    if(isRequired)
      if(_.isEmpty(element.val().trim())) return setInvalidInput(element, "Este campo es requerido")
     
    if(element.val().trim().length < 25)  return setInvalidInput(element, "La descripcion no puede tener menos de 25 caracteres.");
    if(element.val().trim().length > 300) return setInvalidInput(element, "la descripcion no puede tener mas de 300 caracteres.");

    return setValidInput(element)
  })

  element.keydown(() => validarLength(element.val(),300));
  
}

function validarInputNombre(element, isRequired = true) {
  element.blur(() => {
    if(isRequired)
      if(_.isEmpty(element.val().trim())) return setInvalidInput(element, "Este campo es requerido");
      
    if(element.val().trim().length < 2)  return setInvalidInput(element, "Este Campo  no puede tener menos de 2 caracteres.");
    if(element.val().trim().length > 45) return setInvalidInput(element, "Este no puede tener mas de 45 caracteres.");

    return setValidInput(element)
  })

  element.keyup(() => {
    if(isRequired)
      if(_.isEmpty(element.val().trim())) return setInvalidInput(element, "Este campo es requerido")
     
    if(element.val().trim().length < 2)  return setInvalidInput(element, "Este Campo no puede tener menos de 2 caracteres.");
    if(element.val().trim().length > 45) return setInvalidInput(element, "Este campo no puede tener mas de 45 caracteres.");

    return setValidInput(element)
  })

  element.keydown(() => validarLength(element.val(),45));
  
}