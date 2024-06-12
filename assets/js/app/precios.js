$(document).ready(async ()=>{
     let datos=2;
    let idPrecio;
    const permisos = await getPermisos();
    hideByPermisos(permisos);
    llenarSelectServicio();
    llenarSelecteEstablecimiento();
    validarSelectServicio();
    validarSelectEstablecimiento();
    validarNumeros($("#number"));
    var columnas = [
      {"data":"id"},
      {"data":"Servicio"},
      {"data":"Establecimiento" },
      {"data":"precio"},
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
    TablaPrecios=iniciarTabla(columnas,'precios',datos);
    $("#btnNuevo").click(function(){
      datos = 1; //crear         
      idPrecio=null;
      blankForm($("#FormPrecios"));
      $("#FormPrecios").trigger("reset");
      $(".modal-header").css( "background-color", "#d32535");
      $(".modal-header").css( "color", "white" );
      $(".modal-title").text("Registrar Precio de los Servicios");
      $('#modalCRUD').modal('show');
    });
  
    $(document).on("click", ".btnEditar", function(){		        
      datos = 3;//editar
      var tr = $(this).closest('tr');
      var table = $('#TableData').DataTable();
      var row = table.row(tr);
      var data = row.data(); 
      idPrecio=data.id;
      var selectEstablecimiento = document.getElementById('establecimientos');
      var textoEstablecimiento = data.Establecimiento;
      console.log(data);
      for (var i = 0; i < selectEstablecimiento.options.length; i++) {
        if (selectEstablecimiento.options[i].text === textoEstablecimiento) {
          selectEstablecimiento.selectedIndex = i;
          break;
        }
      }
      var selectServicio= document.getElementById('servicios');
      var textoServicio=data.Servicio;
      for (var i=0; i<selectServicio.options.length;i++){
        if(selectServicio.options[i].text===textoServicio){
            selectServicio.selectedIndex=i;
            break;
        }
      }
      $("#number").val(data.precio);
      $(".modal-header").css("background-color", "#d32535");
      $(".modal-header").css("color", "white" );
      $(".modal-title").text("Editar Precio");		
      $('#modalCRUD').modal('show');
    });
  
    //submit el form
    $("#FormPrecios").on("submit", async(event)=>{
      event.preventDefault();
      const form = $("#FormPrecios");
      const formValid = checkFormValidity(form);
      if(formValid){
        const formHTML = document.getElementById("FormPrecios");
        const data = new FormData(formHTML)
        switch(datos){
          case 1:
            data.append("insert",JSON.stringify(true));
            break
          case 2:
            idPrecio="prueba";
            break;
          case 3:
            data.append("update",JSON.stringify(true));
            break
        }
        data.append("id",idPrecio);
        const respuesta = await service.post("precios",data);
        if("error" in respuesta){
          showFormAlerts(form,respuesta.error);
          blankForm(form);
        }else{
          TablaPrecios.ajax.reload(null,false);
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
    idPrecio=data.id;
    let habilitado = data.habilitado;
    deshabilitar("precios",idPrecio,TablaPrecios,"Precio",habilitado); 
    }); 
  
  })
  async function llenarSelectServicio(){
    let select= document.getElementById('servicios');
    const respuesta = await service.post('precios',{solicitarServicio:true});
    respuesta.forEach(element => {
      let option= document.createElement('option');
      option.value=element.idServicio;
      option.text=element.nombre;
      select.appendChild(option);
    });
  }
  async function llenarSelecteEstablecimiento(){
    let select= document.getElementById('establecimientos');
    const respuesta = await service.post('precios',{solicitarEstablecimiento:true});
    respuesta.forEach(element => {
      let option= document.createElement('option');
      option.value=element.idEstablecimientos;
      option.text=element.nombre;
      select.appendChild(option);
    });
  }

  
  function validarSelectEstablecimiento(){
    var selectElement = document.getElementById('establecimientos');
    selectElement.addEventListener('change', function() {
    var valorSeleccionado = this.value;
    if(valorSeleccionado=="default"){
      setInvalidInput($("#establecimientos"),"Debe Seleccionar Establecimiento");
    }else{setValidInput($("#establecimientos"))}
  });
  }

  function validarSelectServicio(){
    var selectElement = document.getElementById('servicios');
    selectElement.addEventListener('change', function() {
    var valorSeleccionado = this.value;
    if(valorSeleccionado=="default"){
      setInvalidInput($("#servicios"),"Debe Seleccionar un Servicio");
    }else{setValidInput($("#servicios"))}
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
  
  
  
  
  
  