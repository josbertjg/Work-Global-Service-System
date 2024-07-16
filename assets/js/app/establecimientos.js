$(document).ready(async()=>{
  const permisos = await getPermisos();
  let datos=2;
  let rutaImagen="hola";
  hideByPermisos(permisos);
  validarNombre($("#nombreEstablecimiento"),155);
  validarDescripcion($("#descripcion"),2600);
  validarPrecio($("#number"));
  validarFile($("#rutaIcono"));
  let idEstablecimiento;
  var columnas = [
    {"data":"idEstablecimientos"},
    {"data":"nombre"},
    {"data":"descripcion" },
    {"data":"sizeE"},
    {"data":"icono",
    "render": function(data, type, row) {
       return type === 'display' ? '<img src="' + data + '" height="50" style="text-align: center;"/>' : data;
    } },
    {"data":"habilitado"},
    {"data": null,
     "render": function(data, type, row) {
        if (type === 'display') {
            let buttonClass = data.habilitado == 1 ? 'btn-success' : 'btn-danger';
            let icon = data.habilitado == 1 ? '<i class="fa-solid fa-toggle-on"></i>' : '<i class="fa-solid fa-toggle-off"></i>';
            let buttons = `<div class='text-center'><div class='btn-group'>`;
            if (!_.isEmpty(permisos.Modificar)) {
                buttons += `<button class='btn btn-primary btn-sm btnEditar'><i class="fa-regular fa-pen-to-square"></i></button>`;
            }
            if (!_.isEmpty(permisos.Eliminar)) {
                buttons += `<button class='btn ${buttonClass} btn-sm btnBorrar'>${icon}</button>`;
            }
            buttons += `</div></div>`;
            return buttons;
        }
        return data;
     }
    }
  ];


  //iniciamos el dataTables
  TablaEstablecimientos=iniciarTabla(columnas,'establecimientos',datos);
  $("#btnNuevo").click(function(){
    datos = 1; //crear         
    idEstablecimiento=null;
    blankForm($("#FormEstablecimiento"));
    $("#FormEstablecimiento").trigger("reset");
    $("#selectedImg").removeAttr("src");
    $("#selectedImg").attr("src","");
    $(".modal-header").css( "background-color", "#d32535");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Registrar Establecimiento");
    $('#modalCRUD').modal('show');
  });
 /*  let input = document.querySelector('input[type=number]');
  input.addEventListener('input', function(e) {
    if (e.target.value.trim() === "") {
      setInvalidInput(input,"Este campo es requerido");
    }else if (isNaN(e.target.value)) {
      setInvalidInput(input,"Debes poner un número");
      e.target.value = "";
    } else {
      setValidInput(input);
    }
  }); */
  //seleciona el icono, valida y muestra una preview y valida que sean los formatos necesarios
  let img = document.getElementById( 'selectedImg' );
  $("#rutaIcono").on("change",e => {
    var archivo= e.target.files[0];
    if(archivo){
      var permitidos = ['image/png', 'image/jpeg', 'image/jpg', 'image/svg']; //
      if(permitidos.includes(archivo.type)){
        setValidInput($("#rutaIcono"));
        const reader = new FileReader( );
        reader.onload = function( e ){
          img.src = e.target.result;
        }
        reader.readAsDataURL(e.target.files[0])
        }else{
          setInvalidInput($("#rutaIcono"),"formato de foto no valido");
          Swal.fire({
            title: "Error!",
            text: "Fortmato de foto Invalido!",
            icon: "error"
          });
        }
      }
    });

  $("#FormEstablecimiento").on("submit", async(event)=>{
    event.preventDefault();
    const form = $("#FormEstablecimiento");
    if(datos==3){
      if($("#nombreEstablecimiento").val().length > 2){ 
        setValidInput($("#nombreEstablecimiento"));
        console.log("se esta validando el nombre")  
      }
      setValidInput($("#rutaIcono"));
      console.log("se esta validando al ruta")
      if (img.src!="") {
        setValidInput($("#rutaIcono"));
        console.log("se esta validando la ruta");
      }
     }
    let file = $("#rutaIcono").get(0).files[0]; // Obtener el archivo del input
    if(datos == 1 && (!file || file.size <= 0)) {setInvalidInput($("#rutaIcono"), "Debe seleccionar una imagen");}
    const formValid = checkFormValidity(form);
    if(formValid){
      const formHTML = document.getElementById("FormEstablecimiento");
      const data = new FormData(formHTML)
      switch(datos){
        //caso uno se crea y agrego la foto
        case 1:
          data.append("insert",JSON.stringify(true));
          data.append("foto",file);
          break
        case 2:
          idEstablecimiento="prueba";
          break;
        case 3:
          // Caso de actualización: verificar si se seleccionó un nuevo archivo
          if(!file) {
            console.log("No hay una imagen para seleccionar")
            data.append("fotoOriginal", rutaImagen);
            data.append("update", JSON.stringify(true));
          } else {
            console.log("Hay Imagen seleccionada")
            data.append("foto", file);
            data.append("update1", JSON.stringify(true));
          }
          break
      }
      data.append("idEstablecimiento",idEstablecimiento);
      const respuesta = await service.post("establecimientos",data);
      if("error" in respuesta){
        showFormAlerts(form,respuesta.error);
        blankForm($("#FormEstablecimiento"));
      }else{
        TablaEstablecimientos.ajax.reload(null,false);
        Swal.fire({
          title: "Exito!",
          text: "se ha ingresado la entrada con exito!",
          icon: "success"
        });
        $("#rutaIcono").replaceWith($("#rutaIcono").val('').clone(true));
        $('#modalCRUD').modal('hide');
      }
      
     }else{
      console.log("Error al validar formulario")
      $("#selectedImg").removeAttr("src");
      $("#selectedImg").attr("src","");
     }
  });

  $(document).on("click", ".btnEditar", function(){		        
    datos = 3;//editar
    var tr = $(this).closest('tr');
    var table = $('#TableData').DataTable();
    var row = table.row(tr);
    var data = row.data();
    blankForm($("#FormEstablecimiento"));
    $("#FormEstablecimiento").trigger("reset");
    $("#selectedImg").removeAttr("src");
    $("#selectedImg").attr("src",""); 
    idEstablecimiento = data.idEstablecimientos; 
    rutaImagen=data.icono;
    img.src=rutaImagen;
    $("#nombreEstablecimiento").val(data.nombre);
    $("#descripcion").val(data.descripcion);
    $("#number").val(data.sizeE);
    $(".modal-header").css("background-color", "#d32535");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Establecimiento");	
    setValidInput($("#nombreEstablecimiento"));
    setValidInput($("#number"));
    setValidInput($("#descripcion"));
    $('#modalCRUD').modal('show');		   
});


$(document).on("click", ".btnBorrar", async function(){
  var tr = $(this).closest('tr');
  var table = $('#TableData').DataTable();
  var row = table.row(tr);
  var data = row.data();
  idEstablecimiento=data.idEstablecimientos;
  let habilitado = data.habilitado; 
  deshabilitar("establecimientos",idEstablecimiento,TablaEstablecimientos,"Establecimiento",habilitado);
});

})

function getPermisos(){
  return service.post('establecimientos',{getPermisos: true})
}

function hideByPermisos(permisos){
  console.log(permisos);
  if(_.isEmpty(permisos.Crear)){
    $("#btnNuevo").hide();
  }

}