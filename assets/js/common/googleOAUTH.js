// Funcion que maneja las respuestas de credenciales de google de manera global en la app
async function googleCredentialResponse (response){
  toggleLoading(true);
  console.log(response.credential);
  const respuesta = await service.post("oauth",{
    gmail_oauth: true, 
    credentials: response.credential
  })
  toggleLoading(false);
  
  if("error" in respuesta){
    return Swal.fire({
      icon: "error",
      title: "Oops...",
      text: respuesta.error
    })
  }
  
  loginUser(respuesta);
}

// Inicializar google OAUTH
function initGoogleOAUTH(){
  google.accounts.id.initialize({
    client_id: $("#g_id_onload").attr("data-client_id"),
    callback: (response)=> googleCredentialResponse(response)
  });
  google.accounts.id.prompt((notification)=>{
    if(notification.isNotDisplayed()){
      document.cookie =  `g_state=;path=/;expires=Thu, 01 Jan 1970 00:00:01 GMT`;
      google.accounts.id.prompt()
    }
  }); // Tambien despliega el modal de cuentas a la derecha
}

$(document).ready(()=>{
  let user  = {};
  try{
    user  = JSON.parse(localStorage.getItem("user"))
  }catch(error){
    return Swal.fire({
      icon: "error",
      title: "Oops, ocurrió un error.",
      text: JSON.stringify(error)
    });
  }

  if(_.isEmpty(user)){
    initGoogleOAUTH();
  }
})