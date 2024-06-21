const checkBots='<div class="form-check form-switch">' +
'<input class="form-check-input justify-content-center" type="checkbox" id="flexSwitchCheckChecked" checked>' +
'</div>';

const uncheckBots='<div class="form-check form-switch">' +
'<input class="form-check-input justify-content-center" type="checkbox" id="flexSwitchCheckChecked">' +
'</div>';




$(document).ready(async () => {
    llenarSelecteModulos();
    validarModulos();
    validarPermiso();
    var columnas = [
        {"data": "Modulo"},
        {"data": "Crear",
         "render":function(data,type,row){
            if(data==null){
                return "No ha creado el permiso"
            }
            return data == 1 ? checkBots : uncheckBots;
         }},
        {"data": "Consultar",
        "render":function(data,type,row){
           if(data==null){
               return "No ha creado el permiso"
           }
           return data == 1 ? checkBots : uncheckBots;
        }},
        {"data": "Eliminar",
        "render":function(data,type,row){
           if(data==null){
               return "No ha creado el permiso"
           }
           return data == 1 ? checkBots : uncheckBots;
        }},
        {"data": "Modificar",
        "render":function(data,type,row){
           if(data==null){
               return "No ha creado el permiso"
           }
           return data == 1 ? checkBots : uncheckBots;
        }}
    ];
    let TablaPermisos;
    $("#roles").on('change', function() {
        var opcion = $(this).val();
        if(TablaPermisos){
            TablaPermisos.destroy();
        }
        TablaPermisos = iniciarTabla(columnas, "permisos", opcion);
    });
    $(document).on('click', '.form-check-input',  function(e){
        var tr = $(this).closest('tr');
        var tdIndex = $(this).closest('td').index();
        var table = $('#TableData').DataTable();
        var row = table.row(tr);
        var data = row.data(); 
        var habilitado;
        // Previene que el switch cambie de estado automáticamente
        e.preventDefault();
        var index = $(this).index();
        console.log('Índice de la fila: ' + tdIndex);
        // Identifica el switch basado en el índice de la columna
        var switchType;
        switch(tdIndex) {
            case 1:
                switchType = 'Crear';
                habilitado=data.Crear;
                break;
            case 2:
                switchType = 'Consultar';
                habilitado=data.Consultar;
                break;
            case 3:
                switchType = 'Eliminar';
                habilitado=data.Eliminar;
                break;
            case 4:
                switchType = 'Modificar';
                habilitado=data.Modificar;
                break;
            // Añade más casos si hay más columnas con switches
        }
        console.log(data.Modulo);
        console.log(switchType);
        // Ahora puedes usar `switchType` para saber qué switch fue clickeado
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Vas a cambiar el permiso de '" + switchType + "' para el módulo: " + data.Modulo,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, cambiar!'
        }).then(async (result) => {
            if (result.isConfirmed) {
                const respuesta = await service.post('permisos',{
                    update:true,
                    Modulo:data.Modulo,
                    Permiso:switchType,
                    Rol: $("#roles").val(),
                    habilitado:habilitado
                });
                if("error" in respuesta){

                }else{
                    Swal.fire({
                        title: "Cambiado el Permiso",
                        text: "Se ha cambiado el permisol modulo",
                        icon: "success"
                      });
                    TablaPermisos.ajax.reload(null,false);
                }
                
            }
        });
    });
    $("#btnNuevo").click(function(){
        datos = 1; //crear         
        idPrecio=null;
        blankForm($("#FormPermisos"));
        $("#FormPermisos").trigger("reset");
        $(".modal-header").css( "background-color", "#d32535");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Registrar Permiso");
        $('#modalCRUD').modal('show');
      });
       //submit el form
    $("#FormPermisos").on("submit", async(event)=>{
        event.preventDefault();
        const form = $("#FormPermisos");
        const formValid = checkFormValidity(form);
        if(formValid){
          const formHTML = document.getElementById("FormPermisos");
          const data = new FormData(formHTML)
          data.append("insert",JSON.stringify(true));
          var option=document.getElementById('roles');
          var opcion=option.value;
          data.append("Rol",opcion);
          const respuesta = await service.post('permisos',data);
          if("error" in respuesta){
            showFormAlerts(form,respuesta.error);
            blankForm(form);
          }else{
            TablaPermisos.ajax.reload(null,false);
            Swal.fire({
              title: "Exito!",
              text: "se ha ingresado la entrada con exito!",
              icon: "success"
            });
            $('#modalCRUD').modal('hide');
          }
          
         }
      });
      
});

async function llenarSelecteModulos(){
    let select= document.getElementById('modulo');
    const respuesta = await service.post('permisos',{solicitarModulo:true});
    respuesta.forEach(element => {
      let option= document.createElement('option');
      option.value=element.idModulo;
      option.text=element.nombre;
      select.appendChild(option);
    });
  }

  function validarModulos(){
    var selectElement = document.getElementById('modulo');
    selectElement.addEventListener('change', validar);
    validar(); // Llama a la función de validación inmediatamente
    function validar() {
      var valorSeleccionado = selectElement.value;
      if(valorSeleccionado=="default"){
        setInvalidInput($("#modulo"),"Debe Seleccionar un Modulo");
      }else{setValidInput($("#modulo"))}
    }
  }

  function validarPermiso(){
    var selectElement = document.getElementById('permisos');
    selectElement.addEventListener('change', validar);
    validar(); // Llama a la función de validación inmediatamente
    function validar() {
      var valorSeleccionado = selectElement.value;
      if(valorSeleccionado=="default"){
        setInvalidInput($("#permisos"),"Debe Seleccionar un Permiso");
      }else{setValidInput($("#permisos"))}
    }
  }