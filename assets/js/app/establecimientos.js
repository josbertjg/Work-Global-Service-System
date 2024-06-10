$(document).ready(async()=>{
  const permisos = await getPermisos();
  let datos=2;
  hideByPermisos(permisos);
  validarNombre($("#nombreEstablecimiento"));
  validarDescripcion($("#descripcion"));
  validarNumeros($("#number"));
  let idEstablecimiento;
  var columnas = [
    {"data":"idEstablecimientos"},
    {"data":"nombre"},
    {"data":"descripcion" },
    {"data":"sizeE"},
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

  $("#FormEstablecimiento").on("submit", async(event)=>{
    event.preventDefault();
    const form = $("#FormEstablecimiento");
    const formValid = checkFormValidity(form);
    if(formValid){
      const formHTML = document.getElementById("FormEstablecimiento");
      const data = new FormData(formHTML)
      switch(datos){
        //caso uno se crea y agrego la foto
        case 1:
          data.append("insert",JSON.stringify(true));
          break
        case 2:
          idEstablecimiento="prueba";
          break;
        case 3:
          data.append("update",JSON.stringify(true));
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
        $('#modalCRUD').modal('hide');
      }
      
     }
  })

  $(document).on("click", ".btnEditar", function(){		        
    datos = 3;//editar
    var tr = $(this).closest('tr');
    var table = $('#TableData').DataTable();
    var row = table.row(tr);
    var data = row.data(); 
    idEstablecimiento = data.idEstablecimientos; 
    $("#nombreEstablecimiento").val(data.nombre);
    $("#descripcion").val(data.descripcion);
    $("#number").val(data.sizeE);
    $(".modal-header").css("background-color", "#d32535");
    $(".modal-header").css("color", "white" );
    $(".modal-title").text("Editar Establecimiento");		
    $('#modalCRUD').modal('show');		   
});


$(document).on("click", ".btnBorrar", async function(){
  var tr = $(this).closest('tr');
  var table = $('#TableData').DataTable();
  var row = table.row(tr);
  var data = row.data();
  idEstablecimiento=data.idEstablecimientos;
  let habilitado = data.habilitado; 
  const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
          confirmButton: "btn btn-success",
          cancelButton: "btn btn-danger"
      },
      buttonsStyling: false
  });

  let title = habilitado ? "¿Estás seguro de que quieres deshabilitar este Establecimiento?" : "¿Estás seguro de que quieres habilitar este Establecimiento?";
  let confirmText = habilitado ? "¡Sí, deshabilita!" : "¡Sí, habilita!";
  let successTitle = habilitado ? "¡Deshabilitado!" : "¡Habilitado!";
  let successText = habilitado ? "El establecimiento ha sido deshabilitado." : "El establecimiento ha sido habilitado.";

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
              data.append("idEstablecimiento",idEstablecimiento);
              const respuesta = await service.post("establecimientos", data);
              if("error" in respuesta){
                showFormAlerts(respuesta.error);
              } else {
                TablaEstablecimientos.ajax.reload(null,false);
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
              'El Establecimiento no ha sido modificado.',
              'error'
          );
      }
  });
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