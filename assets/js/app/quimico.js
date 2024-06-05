$(document).ready(()=>{
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
            let icon = data.habilitado == 1 ? 'toggle_on' : 'toggle_off';
            return `<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn ${buttonClass} btn-sm btnBorrar'><i class='material-icons'>${icon}</i></button></div></div>`;
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
  validarNombre($("#nombreQuimico"));
  validarDescripcion($("#Descripcion"));


  //seleciona el icono, valida y muestra una preview y valida que sean los formatos necesarios
  const file = document.getElementById( 'rutaIcono' );
  const img = document.getElementById( 'selectedImg' );
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
          setInvalidInput($("#rutaIcono","formato de foto no valido"));
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
      //si el img tiene un src significa que el usario esta modificando una entrada 
      //pero no necesariamente quiere cambiar de imagen
      if(img.src.length!=0){
        setValidInput($("#rutaIcono"));
      }
      const formValid = checkFormValidity(form);
      if(formValid){
        const formHTML = document.getElementById("FormQuimico");
        const data = new FormData(formHTML)
        const file = document.getElementById('rutaIcono').files[0];
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
            data.append("update",JSON.stringify(true));
            if(file==undefined){
              data.append("fotoOriginal",rutaImagen);
            }
            else{data.append("foto",file);}
            break
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
          $('#modalCRUD').modal('hide');
        }
        
       }
    });
    //funcion para editar un row con el boton editar
    $(document).on("click", ".btnEditar", function(){		        
      datos = 3;//editar
      //capturamos la fila
      fila = $(this).closest("tr");	        
      //capturamos los valores de cada una de las columanas
      quimico_id=fila.find('td:eq(0)').text();
      $("#nombreQuimico").val(fila.find('td:eq(1)').text());
      rutaImagen=fila.find('td:eq(2) img').attr('src');
      rutaAuxiliar=rutaImagen;
      img.src=rutaImagen;
      $("#Descripcion").val(fila.find('td:eq(3)').text());
      $(".modal-header").css("background-color", "#d32535");
      $(".modal-header").css("color", "white" );
      $(".modal-title").text("Editar Quimico");		
      $('#modalCRUD').modal('show');		   
  });

  $(document).on("click", ".btnBorrar", async function(){
    const fila = $(this).closest("tr");           
    quimico_id = fila.find('td:eq(0)').text();
    let habilitado = fila.find('td:eq(4)').text(); 
    habilitado = habilitado.trim() === "1" ? 1 : 0; // Convierte el valor a número
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });

    let title = habilitado ? "¿Estás seguro de que quieres deshabilitar este químico?" : "¿Estás seguro de que quieres habilitar este químico?";
    let confirmText = habilitado ? "¡Sí, deshabilita!" : "¡Sí, habilita!";
    let successTitle = habilitado ? "¡Deshabilitado!" : "¡Habilitado!";
    let successText = habilitado ? "El químico ha sido deshabilitado." : "El químico ha sido habilitado.";

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
                data.append("idQuimico",quimico_id);
                const respuesta = await service.post("quimicos", data);
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
                'El químico no ha sido modificado.',
                'error'
            );
        }
    });
});


})