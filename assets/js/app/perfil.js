$(document).ready(()=>{
  let user = null;
  try{
    user          = JSON.parse(localStorage.getItem("user"));
  }catch(e){
    showAlert("error", "Oops, ocurrió un error", "Error al recuperar los datos guardados en el almacenamiento local")
    return setTimeout(() => window.location = "/", 4000);
  }

  let rol = null;
  console.log(user)
  if(user.idRol == "SAWGS1") rol = "Administrador";
  if(user.idRol == "CLWGS1") rol = "Cliente";
  if(user.idRol == "FGWGS1") rol = "Fumigador";

  $(".img-perfil-user").attr("src",user.fotoPerfil);
  $("#nombre").val(user.nombre);
  $("#apellido").val(user.apellido);
  $("#email").val(user.email);
  $("#rol").val(rol);
})