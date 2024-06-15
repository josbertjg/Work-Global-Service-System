$(document).ready(async()=>{
  const permisos = await getPermisos();
  hideByPermisos(permisos);
  var rutaImagen="holaPrueba";
  let  datos;
  let quimico_id="";
  let rutaAuxiliar;
  var fila; //captura la fila, para editar o eliminar
  //CRUD C=1 R=2 U=3 D=4
  datos=2;
  //Variables de las columnas del DataTable
  var columnas = [
    {"data":"idQuimico"},
    {"data":"nombre"},
    //agarramos el valor la columna foto y usamos el render para retornar un display img con la ruta 
    //que se almacena en el Mysql
    {"data":"foto",
     "render": function(data, type, row) {
        return type === 'display' ? '<img src="' + data + '" height="50" style="text-align: center;"/>' : data;
     } },
    {"data":"descripcion"},
    {"data":"habilitado"},
    //esta son mis columnas por defualt las que van en acciones
    //aqui uso operadores ternarios para modificar la vista del boton deshabilitar
    //y retorna el display
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
  TablaQuimicos=iniciarTabla(columnas,'quimicos',datos);

  //para limpiar los campos del formulario
  $("#btnNuevo").click(function(){
    datos = 1; //crear         
    quimico_id=null;
    blankForm($("#FormQuimico"));
    $("#FormQuimico").trigger("reset");
    $("#selectedImg").removeAttr("src");
    $("#selectedImg").attr("src","");
    $(".modal-header").css( "background-color", "#d32535");
    $(".modal-header").css( "color", "white" );
    $(".modal-title").text("Registrar Quimico");
    $('#modalCRUD').modal('show');
  });
  //se le da las funciones para validar los campos
  validarFile($("#rutaIcono"));
  validarInputNombre($("#nombreQuimico"));
  validarDescripcion($("#Descripcion"));


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

    //submit el form
    $("#FormQuimico").on("submit", async(event)=>{
      event.preventDefault();
      const form = $("#FormQuimico");
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
        const formHTML = document.getElementById("FormQuimico");
        const data = new FormData(formHTML)
        switch(datos){
          //caso uno se crea y agrego la foto
          case 1:
            data.append("insert",JSON.stringify(true));
            data.append("foto",file);
            break
          case 2:
            quimico_id="prueba";
            break;
          //caso 3 es un update y es lo que comentaba mas arriba
          //si el file esta undefined significa que no hizo cambios en la foto
          case 3:
            // Caso de actualización: verificar si se seleccionó un nuevo archivo
            if(!file) {
              data.append("fotoOriginal", rutaImagen);
              data.append("update1", JSON.stringify(true));
            } else {
              data.append("foto", file);
              data.append("update2", JSON.stringify(true));
            }
            break;
        }
        data.append("idQuimico",quimico_id);
        const respuesta = await service.post("quimicos",data);
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
          $("#rutaIcono").replaceWith($("#rutaIcono").val('').clone(true));
          $('#modalCRUD').modal('hide');
        }
        
       }else{
        $("#selectedImg").removeAttr("src");
        $("#selectedImg").attr("src","");
       }
    });
    //funcion para editar un row con el boton editar
    $(document).on("click", ".btnEditar", function(){		        
      datos = 3;//editar
      var tr = $(this).closest('tr');
      var table = $('#TableData').DataTable();
      var row = table.row(tr);
      var data = row.data(); // Obtiene todos los datos de la fila
      /* Aqui voy a hacer una explicacion, el codigo de arriba se utiliza para contemplar que 
      la tabla puede o no puede estar en modo responsive y que algunas columnas esten ocultas en un row
      de esta manera cuando se capturan todos los datos se usa la variable data para acceder a los atributos
      del ojeto, en este caso los nombre de como lo tenemos en la base de datos */
      quimico_id = data.idQuimico; // Obtiene el ID del químico
  
      nombreQuimico = data.nombre; // Obtiene el nombre del químico
      $("#nombreQuimico").val(nombreQuimico);
      //quimico_id=$(fila).find('td:eq(0)').text();
      rutaImagen=data.foto;
      img.src=rutaImagen;
      $("#Descripcion").val(data.descripcion);
      $(".modal-header").css("background-color", "#d32535");
      $(".modal-header").css("color", "white" );
      $(".modal-title").text("Editar Quimico");		
      $('#modalCRUD').modal('show');		   
  });

  $(document).on("click", ".btnBorrar", async function(){
    var tr = $(this).closest('tr');
    var table = $('#TableData').DataTable();
    var row = table.row(tr);
    var data = row.data();
    quimico_id=data.idQuimico;
    let habilitado = data.habilitado; 
    deshabilitar("quimicos",quimico_id,TablaQuimicos,"quimico",habilitado);
});


})

function getPermisos(){
  return service.post('quimicos',{getPermisos: true})
}

function hideByPermisos(permisos){
  console.log(permisos);
  if(_.isEmpty(permisos.Crear)){
    $("#btnNuevo").hide();
  }

}