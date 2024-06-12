$(document).ready(async ()=>{
  const permisos = await getPermisos();
  hideByPermisos(permisos);
})

function getPermisos(){
  return service.post('usuarios',{getPermisos: true})
}

function hideByPermisos(permisos){
  if(!_.isEmpty(permisos.Crear)){
    $(".hola").hide();
  }
  if(!_.isEmpty(permisos.Eliminar)){
    $(".hola").hide();
  }
  if(!_.isEmpty(permisos.Modificar)){
    $(".hola").hide();
  }
}