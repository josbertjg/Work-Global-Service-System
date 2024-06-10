$(document).ready(async ()=>{
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

  $(document).on("click", ".btnEditar", function(){		        
    datos = 3;//editar
    var tr = $(this).closest('tr');
    var table = $('#TableData').DataTable();
    var row = table.row(tr);
    var data = row.data(); 
    idServicio=data.idServicio;
    $("#nombreServicio").val(data.nombre);
    $("#descripcionServicio").val(data.descripcion);
    var selectElement = document.getElementById('quimico');
    var textoDataTable = data.quimico;
    for (var i = 0; i < selectElement.options.length; i++) {
      if (selectElement.options[i].text === textoDataTable) {
        selectElement.selectedIndex = i;
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
          data.append("update",JSON.stringify(true));
          break
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
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });

    let title = habilitado ? "¿Estás seguro de que quieres deshabilitar este Servicio?" : "¿Estás seguro de que quieres habilitar este servicio?";
    let confirmText = habilitado ? "¡Sí, deshabilita!" : "¡Sí, habilita!";
    let successTitle = habilitado ? "¡Deshabilitado!" : "¡Habilitado!";
    let successText = habilitado ? "El servicio ha sido deshabilitado." : "El servicio ha sido habilitado.";

    swalWithBootstrapButtons.fire({
        title: title,
        text: "¿Estas seguro de la accion?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: confirmText,
        cancelButtonText: "¡No, cancela!",
        reverseButtons: true
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const data = new FormData();
                data.append("delete", JSON.stringify(true));
                data.append("habilitado", JSON.stringify(habilitado));
                data.append("idServicio",idServicio);
                const respuesta = await service.post("servicios", data);
                if("error" in respuesta){
                  showFormAlerts(respuesta.error);
                } else {
                  TablaQuimicos.ajax.reload(null,false);
                  swalWithBootstrapButtons.fire(
                    successTitle,
                    successText,
                    'success'
                  );
                }
            } catch (error) {
                console.error("Error:", error);
            }
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire(
                'Cancelado',
                'El servicio no ha sido modificado.',
                'error'
            );
        }
    });
});

})

async function llenarSelect(){
  let select= document.getElementById('quimico');
  const data = new FormData();
  data.append("solicitarQuimico",JSON.stringify(true));
  const respuesta = await service.post('servicios',data);
  respuesta.forEach(element => {
    let option= document.createElement('option');
    option.value=element.idQuimico;
    option.text=element.nombre;
    select.appendChild(option);
  });
}

function validarSelect(){
  var selectElement = document.getElementById('quimico');
  selectElement.addEventListener('change', function() {
  var valorSeleccionado = this.value;
  if(valorSeleccionado=="default"){
    setInvalidInput($("#quimico"),"Debe Seleccionar un Quimico");
  }else{setValidInput($("#quimico"))}
});
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





