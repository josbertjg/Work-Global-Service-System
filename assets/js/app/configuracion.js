$(document).ready(async ()=>{
    let user = null;
    let img = document.getElementById( 'userIMG' );
     try{
         user = JSON.parse(localStorage.getItem("user"));
         var np=user.nombre+" "+user.apellido
         $("#ususario").text(np);
         //img.src="";
         var ruta=user.fotoPerfil;
         console.log(ruta);
         img.src = String(ruta); ;
       }catch(e){
         showAlert("error", "Oops, ocurrió un error", "Error al recuperar el usuario logueado")
         //return setTimeout(() => window.location = "", 4000);
       }

})