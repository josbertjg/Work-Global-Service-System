$(document).ready(async ()=>{
  var rutaImagen="holaPrueba";
  let datos=2;
  let idServicio;
  const permisos = await getPermisos();
  hideByPermisos(permisos);
  validarNombre($("#nombreServicio"));
  validarDescripcion($("#descripcionServicio"));
  llenarSelect();
  validarSelect();
  var columnas = [
    {"data":"idServicio"},
    {"data":"nombre"},
    {"data":"quimico" },
    {"data":"descripcion"},
    {"data":"fotoServicio",
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
  TablaQuimicos=iniciarTabla(columnas,'servicios',datos);
  $("#btnNuevo").click(function(){
    datos = 1; //crear         
    idServicio=null;
    blankForm($("#FormServicio"));
    $("#FormServicio").trigger("reset");
    $(".modal-header").css( "background-color", "#d32535");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Registrar Servicio");
    $('#modalCRUD').modal('show');
  });
    //seleciona el icono, valida y muestra una preview y valida que sean los formatos necesarios
    let file = document.getElementById( 'rutaIcono' );
    let img = document.getElementById( 'selectedImg' );
    file.addEventListener( 'change', e => {
      var archivo= e.target.files[0];
      if(archivo){
        var permitidos = ['image/png', 'image/jpeg', 'image/jpg']; //
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
  $(document).on("click", ".btnEditar", function(){		        
    datos = 3;//editar
    var tr = $(this).closest('tr');
    var table = $('#TableData').DataTable();
    var row = table.row(tr);
    var data = row.data(); 
    idServicio=data.idServicio;
    $("#nombreServicio").val(data.nombre);
    $("#descripcionServicio").val(data.descripcion);
    rutaImagen=data.fotoServicio;
    img.src=rutaImagen;
    var selectElement = document.getElementById('quimico');
    var textoDataTable = data.quimico;
    for (var i = 0; i < selectElement.options.length; i++) {
      if (selectElement.options[i].text === textoDataTable) {
        selectElement.selectedIndex = i;
        setValidInput($("#quimico"));
        break;
      }
    }
    $(".modal-header").css("background-color", "#d32535");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Servicio");		
    $('#modalCRUD').modal('show');
  });

  //submit el form
  $("#FormServicio").on("submit", async(event)=>{
    event.preventDefault();
    const form = $("#FormServicio");
    if(datos==3){
      setValidInput($("#rutaIcono"));
      if (img.src!="") {
        setValidInput($("#rutaIcono"));
      }
     }
     let file = $("#rutaIcono").get(0).files[0]; // Obtener el archivo del input
     if(datos == 1 && (!file || file.size <= 0)) {
      setInvalidInput($("#rutaIcono"), "Debe seleccionar una imagen");
    }
    const formValid = checkFormValidity(form);
    if(formValid){
      const formHTML = document.getElementById("FormServicio");
      const data = new FormData(formHTML)

      switch(datos){
        //caso uno se crea y agrego la foto
        case 1:
          data.append("insert",JSON.stringify(true));
          break
        case 2:
          idServicio="prueba";
          break;
        case 3:
          if(!file) {
            data.append("fotoOriginal", rutaImagen);
            data.append("update1", JSON.stringify(true));
            console.log("El file no esta definido")
          } else {
            data.append("foto", file);
            data.append("update2", JSON.stringify(true));
            console.log("El file esta definido");
          }
          break;
      }
      data.append("idServicio",idServicio);
      const respuesta = await service.post("servicios",data);
      if("error" in respuesta){
        showFormAlerts(form,respuesta.error);
        blankForm(form);
      }else{
        TablaQuimicos.ajax.reload(null,false);
        Swal.fire({
          title: "Exito!",
          text: "se ha ingresado la entrada con exito!",
          icon: "success"
        });
        $('#modalCRUD').modal('hide');
      }
      
     }
  });
  $(document).on("click", ".btnBorrar", async function(){
    var tr = $(this).closest('tr');
    var table = $('#TableData').DataTable();
    var row = table.row(tr);
    var data = row.data();
    idServicio=data.idServicio;
    let habilitado = data.habilitado; 
    deshabilitar("servicios",idServicio,TablaQuimicos,"Servicio",habilitado);
  }); 

})

async function llenarSelect(){
  let select= document.getElementById('quimico');
  const respuesta = await service.post('servicios',{solicitarQuimico:true});
  respuesta.forEach(element => {
    let option= document.createElement('option');
    option.value=element.idQuimico;
    option.text=element.nombre;
    select.appendChild(option);
  });
}

function validarSelect(){
  var selectElement = document.getElementById('quimico');
  selectElement.addEventListener('change', validar);
  validar(); // Llama a la función de validación inmediatamente
  function validar() {
    var valorSeleccionado = selectElement.value;
    if(valorSeleccionado=="default"){
      setInvalidInput($("#quimico"),"Debe Seleccionar un Quimico");
    }else{setValidInput($("#quimico"))}
  }
}

function getPermisos(){
  return service.post('servicios',{getPermisos: true})
}

function hideByPermisos(permisos){
  console.log(permisos);
  if(_.isEmpty(permisos.Crear)){
    $("#btnNuevo").hide();
  }

}





